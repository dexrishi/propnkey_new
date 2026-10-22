<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyCondition;
use Illuminate\Support\Str;

class PropertyConditionController extends AdminBaseController
{
    /**
     * Display a listing of property conditions
     */
    public function index(Request $request)
    {
        $query = PropertyCondition::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }

        $conditions = $query->ordered()->paginate(20);
        return $this->viewWithRoute('admin.property-conditions.index', compact('conditions'));
    }

    /**
     * Show the form for creating a new property condition
     */
    public function create()
    {
        return $this->viewWithRoute('admin.property-conditions.create');
    }

    /**
     * Store a newly created property condition
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_conditions,slug',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $propertyCondition = PropertyCondition::create($data);
        
        // Log the activity
        $this->logCreate($propertyCondition);

        return redirect()->route('property-conditions.index')
            ->with('success', 'Property condition created successfully.');
    }

    /**
     * Display the specified property condition
     */
    public function show(PropertyCondition $propertyCondition)
    {
        return $this->viewWithRoute('admin.property-conditions.show', compact('propertyCondition'));
    }

    /**
     * Show the form for editing the specified property condition
     */
    public function edit(PropertyCondition $propertyCondition)
    {
        return $this->viewWithRoute('admin.property-conditions.edit', compact('propertyCondition'));
    }

    /**
     * Update the specified property condition
     */
    public function update(Request $request, PropertyCondition $propertyCondition)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_conditions,slug,' . $propertyCondition->id,
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($propertyCondition);
        
        $propertyCondition->update($data);
        
        // Log the activity
        $this->logUpdate($propertyCondition, $oldAttributes);

        return redirect()->route('property-conditions.index')
            ->with('success', 'Property condition updated successfully.');
    }

    /**
     * Remove the specified property condition
     */
    public function destroy(PropertyCondition $propertyCondition)
    {
        // Log the activity before deletion
        $this->logDelete($propertyCondition);
        
        $propertyCondition->delete();
        return redirect()->route('property-conditions.index')
            ->with('success', 'Property condition deleted successfully.');
    }

    /**
     * Toggle condition status
     */
    public function toggle(Request $request, PropertyCondition $propertyCondition)
    {
        $propertyCondition->is_active = !$propertyCondition->is_active;
        $propertyCondition->save();

        return response()->json(['is_active' => $propertyCondition->is_active]);
    }
}