<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Badge;
use App\Traits\LogsActivity;

class BadgeController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of badges
     */
    public function index(Request $request)
    {
        $query = Badge::orderBy('name', 'asc');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $badges = $query->paginate(20);
        return $this->viewWithRoute('admin.badges.index', compact('badges'));
    }

    /**
     * Show the form for creating a new badge
     */
    public function create()
    {
        return $this->viewWithRoute('admin.badges.create');
    }

    /**
     * Store a newly created badge
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:badges,name',
        ]);

        $badge = Badge::create([
            'name' => $request->name,
        ]);
        
        // Log the activity
        $this->logCreate($badge);

        return redirect()->route('badges.index')
            ->with('success', 'Badge created successfully.');
    }

    /**
     * Display the specified badge
     */
    public function show(Badge $badge)
    {
        return $this->viewWithRoute('admin.badges.show', compact('badge'));
    }

    /**
     * Show the form for editing the specified badge
     */
    public function edit(Badge $badge)
    {
        return $this->viewWithRoute('admin.badges.edit', compact('badge'));
    }

    /**
     * Update the specified badge
     */
    public function update(Request $request, Badge $badge)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:badges,name,' . $badge->id,
        ]);

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($badge);
        
        $badge->update([
            'name' => $request->name,
        ]);
        
        // Log the activity
        $this->logUpdate($badge, $oldAttributes);

        return redirect()->route('badges.index')
            ->with('success', 'Badge updated successfully.');
    }

    /**
     * Remove the specified badge
     */
    public function destroy(Badge $badge)
    {
        // Log the activity before deletion
        $this->logDelete($badge);
        
        $badge->delete();

        return redirect()->route('badges.index')
            ->with('success', 'Badge deleted successfully.');
    }
}
