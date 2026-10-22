<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Redirection;
use App\Traits\LogsActivity;

class RedirectionController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of redirections
     */
    public function index(Request $request)
    {
        $query = Redirection::orderBy('created_at', 'desc');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('from_url', 'like', '%' . $request->search . '%')
                  ->orWhere('to_url', 'like', '%' . $request->search . '%');
            });
        }
        
        $redirections = $query->paginate(20);
        return $this->viewWithRoute('admin.redirections.index', compact('redirections'));
    }

    /**
     * Show the form for creating a new redirection
     */
    public function create()
    {
        return $this->viewWithRoute('admin.redirections.create');
    }

    /**
     * Store a newly created redirection
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_url' => 'required|string|max:255|unique:redirections,from_url',
            'to_url' => 'required|string|max:500',
            'type' => 'required|in:301,302',
            'is_active' => 'boolean',
        ]);

        // Normalize from_url to always start with /
        $fromUrl = '/' . trim($request->from_url, '/');
        
        $redirection = Redirection::create([
            'from_url' => $fromUrl,
            'to_url' => $request->to_url,
            'type' => $request->type,
            'is_active' => $request->boolean('is_active', true),
        ]);
        
        // Log the activity
        $this->logCreate($redirection);

        return redirect()->route('redirections.index')
            ->with('success', 'Redirection created successfully.');
    }

    /**
     * Display the specified redirection
     */
    public function show(Redirection $redirection)
    {
        return $this->viewWithRoute('admin.redirections.show', compact('redirection'));
    }

    /**
     * Show the form for editing the specified redirection
     */
    public function edit(Redirection $redirection)
    {
        return $this->viewWithRoute('admin.redirections.edit', compact('redirection'));
    }

    /**
     * Update the specified redirection
     */
    public function update(Request $request, Redirection $redirection)
    {
        $request->validate([
            'from_url' => 'required|string|max:255|unique:redirections,from_url,' . $redirection->id,
            'to_url' => 'required|string|max:500',
            'type' => 'required|in:301,302',
            'is_active' => 'boolean',
        ]);

        // Normalize from_url to always start with /
        $fromUrl = '/' . trim($request->from_url, '/');

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($redirection);
        
        $redirection->update([
            'from_url' => $fromUrl,
            'to_url' => $request->to_url,
            'type' => $request->type,
            'is_active' => $request->boolean('is_active', true),
        ]);
        
        // Log the activity
        $this->logUpdate($redirection, $oldAttributes);

        return redirect()->route('redirections.index')
            ->with('success', 'Redirection updated successfully.');
    }

    /**
     * Remove the specified redirection
     */
    public function destroy(Redirection $redirection)
    {
        // Log the activity before deletion
        $this->logDelete($redirection);
        
        $redirection->delete();

        return redirect()->route('redirections.index')
            ->with('success', 'Redirection deleted successfully.');
    }
}
