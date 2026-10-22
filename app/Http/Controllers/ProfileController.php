<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfileController extends AdminBaseController
{
    /**
     * Display the user's profile
     */
    public function show()
    {
        $user = Auth::user();
        return $this->viewWithRoute('admin.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the user's profile
     */
    public function edit()
    {
        $user = Auth::user();
        return $this->viewWithRoute('admin.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the form for changing the user's password
     */
    public function editPassword()
    {
        return $this->viewWithRoute('admin.profile.edit-password');
    }

    /**
     * Update the user's password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Password updated successfully.');
    }

    /**
     * Show the form for editing the user's profile with password change
     */
    public function editProfile()
    {
        $user = Auth::user();
        return $this->viewWithRoute('admin.profile.edit-profile', compact('user'));
    }

    /**
     * Update the user's profile information and password
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['current_password'] = 'required|current_password';
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $request->validate($rules);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        $message = 'Profile updated successfully.';
        if ($request->filled('password')) {
            $message = 'Profile and password updated successfully.';
        }

        return redirect()->route('profile.show')
            ->with('success', $message);
    }
}