<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Traits\LogsActivity;

class PropertyTypeController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of property types
     */
    public function index(Request $request)
    {
        $query = PropertyType::query();

        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('heading', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && !empty($request->input('status'))) {
            if ($request->input('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->input('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $propertyTypes = $query->with('propertyCategory')->ordered()->paginate(20);

        return $this->viewWithRoute('admin.property-types.index', compact('propertyTypes'));
    }

    /**
     * Show the form for creating a new property type
     */
    public function create()
    {
        return $this->viewWithRoute('admin.property-types.create');
    }

    /**
     * Store a newly created property type
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'property_category_id' => 'required|exists:property_categories,id',
            'slug' => 'required|string|max:255|unique:property_types,slug',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $propertyType = PropertyType::create($request->all());
        
        // Log the activity
        $this->logCreate($propertyType);

        return redirect()->route('property-types.index')
            ->with('success', 'Property type created successfully.');
    }

    /**
     * Display the specified property type
     */
    public function show(PropertyType $propertyType)
    {
        return $this->viewWithRoute('admin.property-types.show', compact('propertyType'));
    }

    /**
     * Show the form for editing the specified property type
     */
    public function edit(PropertyType $propertyType)
    {
        $propertyType->load('propertyCategory');

        return $this->viewWithRoute('admin.property-types.edit', compact('propertyType'));
    }

    /**
     * Update the specified property type
     */
    public function update(Request $request, PropertyType $propertyType)
    {
        if (auth()->user()?->isSeo()) {
            $request->merge(['property_category_id' => $propertyType->property_category_id]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'property_category_id' => 'required|exists:property_categories,id',
            'slug' => 'required|string|max:255|unique:property_types,slug,' . $propertyType->id,
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        if (auth()->user()?->isSeo()) {
            unset($data['property_category_id']);
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($propertyType);
        
        $propertyType->update($data);
        
        // Log the activity
        $this->logUpdate($propertyType, $oldAttributes);

        return redirect()->route('property-types.index')
            ->with('success', 'Property type updated successfully.');
    }

    /**
     * Remove the specified property type
     */
    public function destroy(PropertyType $propertyType)
    {
        // Log the activity before deletion
        $this->logDelete($propertyType);
        
        $propertyType->delete();
        return redirect()->route('property-types.index')
            ->with('success', 'Property type deleted successfully.');
    }

    /**
     * Toggle property type status
     */
    public function toggle(Request $request, PropertyType $propertyType)
    {
        $propertyType->is_active = !$propertyType->is_active;
        $propertyType->save();

        return response()->json(['is_active' => $propertyType->is_active]);
    }
}