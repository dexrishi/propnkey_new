<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Traits\LogsActivity;

class AmenityController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of amenities
     */
    public function index()
    {
        $amenities = Amenity::ordered()->paginate(20);
        return $this->viewWithRoute('admin.amenities.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new amenity
     */
    public function create()
    {
        return $this->viewWithRoute('admin.amenities.create');
    }

    /**
     * Store a newly created amenity
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $amenity = Amenity::create($data);
        
        // Log the activity
        $this->logCreate($amenity);

        return redirect()->route('amenities.index')
            ->with('success', 'Amenity created successfully.');
    }

    /**
     * Display the specified amenity
     */
    public function show(Amenity $amenity)
    {
        return $this->viewWithRoute('admin.amenities.show', compact('amenity'));
    }

    /**
     * Show the form for editing the specified amenity
     */
    public function edit(Amenity $amenity)
    {
        return $this->viewWithRoute('admin.amenities.edit', compact('amenity'));
    }

    /**
     * Update the specified amenity
     */
    public function update(Request $request, Amenity $amenity)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($amenity);
        
        $amenity->update($data);
        
        // Log the activity
        $this->logUpdate($amenity, $oldAttributes);

        return redirect()->route('amenities.index')
            ->with('success', 'Amenity updated successfully.');
    }

    /**
     * Remove the specified amenity
     */
    public function destroy(Amenity $amenity)
    {
        // Log the activity before deletion
        $this->logDelete($amenity);
        
        $amenity->delete();

        return redirect()->route('amenities.index')
            ->with('success', 'Amenity deleted successfully.');
    }

    /**
     * Toggle active status
     */
    public function toggle(Amenity $amenity)
    {
        $amenity->update(['is_active' => !$amenity->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $amenity->is_active
        ]);
    }

    /**
     * Bulk update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'amenities' => 'required|array',
            'amenities.*.id' => 'required|exists:amenities,id',
            'amenities.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->amenities as $amenityData) {
            Amenity::where('id', $amenityData['id'])
                ->update(['sort_order' => $amenityData['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully.'
        ]);
    }
}