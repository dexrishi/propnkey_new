<?php

namespace App\Http\Controllers;

use App\Models\PropertyStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\LogsActivity;

class PropertyStatusController extends Controller
{
    use LogsActivity;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertyStatuses = PropertyStatus::withCount('properties')->ordered()->paginate(10);
        return view('admin.property-statuses.index', compact('propertyStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.property-statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_statuses,slug',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        
        // Set default sort order if not provided
        if (empty($data['sort_order'])) {
            $data['sort_order'] = PropertyStatus::max('sort_order') + 1;
        }

        $propertyStatus = PropertyStatus::create($data);
        
        // Log the activity
        $this->logCreate($propertyStatus);

        return redirect()->route('property-statuses.index')
            ->with('success', 'Property status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyStatus $propertyStatus)
    {
        $propertyStatus->loadCount('properties');
        return view('admin.property-statuses.show', compact('propertyStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyStatus $propertyStatus)
    {
        return view('admin.property-statuses.edit', compact('propertyStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyStatus $propertyStatus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_statuses,slug,' . $propertyStatus->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($propertyStatus);
        
        $propertyStatus->update($data);
        
        // Log the activity
        $this->logUpdate($propertyStatus, $oldAttributes);

        return redirect()->route('property-statuses.index')
            ->with('success', 'Property status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyStatus $propertyStatus)
    {
        // Check if any properties are using this status
        if ($propertyStatus->properties()->count() > 0) {
            return redirect()->route('property-statuses.index')
                ->with('error', 'Cannot delete property status. It is being used by properties.');
        }

        // Log the activity before deletion
        $this->logDelete($propertyStatus);
        
        $propertyStatus->delete();

        return redirect()->route('property-statuses.index')
            ->with('success', 'Property status deleted successfully.');
    }
}
