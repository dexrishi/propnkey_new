<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Location;
use App\Traits\LogsActivity;

class AreaController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of areas
     */
    public function index()
    {
        $areas = Area::with('location')->ordered()->paginate(20);
        return $this->viewWithRoute('admin.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new area
     */
    public function create()
    {
        $locations = Location::active()->ordered()->get();
        return $this->viewWithRoute('admin.areas.create', compact('locations'));
    }

    /**
     * Store a newly created area
     */
    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'nullable|exists:locations,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:areas,slug',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        
        // Convert empty string to null for location_id
        if (isset($data['location_id']) && $data['location_id'] === '') {
            $data['location_id'] = null;
        }
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $baseSlug = \Illuminate\Support\Str::slug($data['name']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure slug is unique
            while (Area::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }
        
        // Set default sort_order if not provided
        if (!isset($data['sort_order']) || $data['sort_order'] === '') {
            $data['sort_order'] = 0;
        }

        $area = Area::create($data);
        
        // Log the activity
        $this->logCreate($area);

        return redirect()->route('areas.index')
            ->with('success', 'Area created successfully.');
    }

    /**
     * Display the specified area
     */
    public function show(Area $area)
    {
        $area->load('location');
        return $this->viewWithRoute('admin.areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified area
     */
    public function edit(Area $area)
    {
        $locations = Location::active()->ordered()->get();
        return $this->viewWithRoute('admin.areas.edit', compact('area', 'locations'));
    }

    /**
     * Update the specified area
     */
    public function update(Request $request, Area $area)
    {
        if (auth()->user()?->isSeo()) {
            $request->merge(['location_id' => $area->location_id]);
        }

        $request->validate([
            'location_id' => 'nullable|exists:locations,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:areas,slug,' . $area->id,
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        if (auth()->user()?->isSeo()) {
            unset($data['location_id']);
        }
        
        // Convert empty string to null for location_id
        if (isset($data['location_id']) && $data['location_id'] === '') {
            $data['location_id'] = null;
        }
        
        // Generate slug if not provided or if name changed
        if (empty($data['slug']) || $area->name !== $data['name']) {
            $baseSlug = \Illuminate\Support\Str::slug($data['name']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure slug is unique
            while (Area::where('slug', $slug)->where('id', '!=', $area->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }
        
        // Set default sort_order if not provided
        if (!isset($data['sort_order']) || $data['sort_order'] === '') {
            $data['sort_order'] = 0;
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($area);
        
        $area->update($data);
        
        // Log the activity
        $this->logUpdate($area, $oldAttributes);

        return redirect()->route('areas.index')
            ->with('success', 'Area updated successfully.');
    }

    /**
     * Remove the specified area
     */
    public function destroy(Area $area)
    {
        // Log the activity before deletion
        $this->logDelete($area);
        
        $area->delete();

        return redirect()->route('areas.index')
            ->with('success', 'Area deleted successfully.');
    }
}
