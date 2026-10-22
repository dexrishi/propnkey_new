<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $currentRoute = 'dashboard';
        
        // Check if status column exists
        $hasStatusColumn = \Illuminate\Support\Facades\Schema::hasColumn('inquiries', 'status');
        
        // Get inquiry statistics
        $inquiryStats = [];
        $statusCounts = [];
        $statusOptions = [];
        
        if ($hasStatusColumn) {
            try {
                $inquiryStats = \App\Models\Inquiry::selectRaw('status, COUNT(*) as count')
                    ->groupBy('status')
                    ->pluck('count', 'status')
                    ->toArray();
                
                // Get status options for proper ordering
                $statusOptions = \App\Models\Inquiry::getStatusOptions();
                
                // Initialize all statuses with 0
                foreach ($statusOptions as $key => $label) {
                    $statusCounts[$key] = $inquiryStats[$key] ?? 0;
                }
            } catch (\Exception $e) {
                \Log::error('Error fetching inquiry stats: ' . $e->getMessage());
                $statusOptions = \App\Models\Inquiry::getStatusOptions();
                foreach ($statusOptions as $key => $label) {
                    $statusCounts[$key] = 0;
                }
            }
        } else {
            // If column doesn't exist, show empty stats
            $statusOptions = \App\Models\Inquiry::getStatusOptions();
            foreach ($statusOptions as $key => $label) {
                $statusCounts[$key] = 0;
            }
        }
        
        // Get total inquiries
        $totalInquiries = \App\Models\Inquiry::count();
        
        // Get last 5 inquiries
        $recentInquiries = \App\Models\Inquiry::latest()
            ->limit(5)
            ->get();
        
        // Get property statistics by category
        $propertyStatsByCategory = \App\Models\PropertyCategory::withCount([
            'properties as total_count',
            'properties as active_count' => function($query) {
                $query->where('is_active', true);
            }
        ])->get();
        
        // Get property statistics by type
        $propertyStatsByType = \App\Models\PropertyType::withCount([
            'properties as total_count',
            'properties as active_count' => function($query) {
                $query->where('is_active', true);
            }
        ])->get();
        
        $totalPropertyImages = \App\Models\PropertyImage::count();

        return view('dashboard', compact('user', 'currentRoute', 'statusCounts', 'statusOptions', 'totalInquiries', 'recentInquiries', 'propertyStatsByCategory', 'propertyStatsByType', 'totalPropertyImages'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /**
     * Show the registration form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Default role for any registration (though registration is disabled)
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
