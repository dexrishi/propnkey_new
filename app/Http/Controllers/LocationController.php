<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class LocationController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of locations
     */
    public function index()
    {
        $locations = Location::ordered()->paginate(20);
        return $this->viewWithRoute('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new location
     */
    public function create()
    {
        return $this->viewWithRoute('admin.locations.create');
    }

    /**
     * Store a newly created location
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:locations,slug',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'heading' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('locations', $filename, 'public');
            $data['image'] = $path;
        }

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $location = Location::create($data);
        
        // Log the activity
        $this->logCreate($location);

        return redirect()->route('locations.index')
            ->with('success', 'Location created successfully.');
    }

    /**
     * Display the specified location
     */
    public function show(Location $location)
    {
        return $this->viewWithRoute('admin.locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified location
     */
    public function edit(Location $location)
    {
        return $this->viewWithRoute('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified location
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:locations,slug,' . $location->id,
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'heading' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($location->image && Storage::disk('public')->exists($location->image)) {
                Storage::disk('public')->delete($location->image);
            }
            
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('locations', $filename, 'public');
            $data['image'] = $path;
        }

        // Generate slug if not provided or if name changed
        if (empty($data['slug']) || $location->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($location);
        
        $location->update($data);
        
        // Log the activity
        $this->logUpdate($location, $oldAttributes);

        return redirect()->route('locations.index')
            ->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified location
     */
    public function destroy(Location $location)
    {
        // Delete associated image if exists
        if ($location->image && Storage::disk('public')->exists($location->image)) {
            Storage::disk('public')->delete($location->image);
        }
        
        // Log the activity before deletion
        $this->logDelete($location);
        
        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Location deleted successfully.');
    }

    /**
     * Toggle active status
     */
    public function toggle(Location $location)
    {
        $location->update(['is_active' => !$location->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $location->is_active
        ]);
    }

    /**
     * Bulk update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'locations' => 'required|array',
            'locations.*.id' => 'required|exists:locations,id',
            'locations.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->locations as $locationData) {
            Location::where('id', $locationData['id'])
                ->update(['sort_order' => $locationData['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully.'
        ]);
    }
}