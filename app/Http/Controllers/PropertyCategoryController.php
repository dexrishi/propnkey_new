<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyCategory;
use App\Traits\LogsActivity;
use Illuminate\Support\Str;

class PropertyCategoryController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of property categories
     */
    public function index(Request $request)
    {
        $query = PropertyCategory::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('heading', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $categories = $query->ordered()->paginate(20);
        return $this->viewWithRoute('admin.property-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new property category
     */
    public function create()
    {
        return $this->viewWithRoute('admin.property-categories.create');
    }

    /**
     * Store a newly created property category
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_categories,slug',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        
        // Set default sort_order if not provided
        if (empty($data['sort_order'])) {
            $data['sort_order'] = PropertyCategory::max('sort_order') + 1;
        }

        $propertyCategory = PropertyCategory::create($data);
        
        // Log the activity
        $this->logCreate($propertyCategory);

        return redirect()->route('property-categories.index')
            ->with('success', 'Property category created successfully.');
    }

    /**
     * Display the specified property category
     */
    public function show(PropertyCategory $propertyCategory)
    {
        return $this->viewWithRoute('admin.property-categories.show', compact('propertyCategory'));
    }

    /**
     * Show the form for editing the specified property category
     */
    public function edit(PropertyCategory $propertyCategory)
    {
        return $this->viewWithRoute('admin.property-categories.edit', compact('propertyCategory'));
    }

    /**
     * Update the specified property category
     */
    public function update(Request $request, PropertyCategory $propertyCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_categories,slug,' . $propertyCategory->id,
            'heading' => 'nullable|string|max:255',
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
        $oldAttributes = $propertyCategory->getOriginal();
        
        $propertyCategory->update($data);
        
        // Log the activity
        $this->logUpdate($propertyCategory, $oldAttributes);

        return redirect()->route('property-categories.index')
            ->with('success', 'Property category updated successfully.');
    }

    /**
     * Remove the specified property category
     */
    public function destroy(PropertyCategory $propertyCategory)
    {
        abort_unless(auth()->user()?->canDelete(), 403, 'SEO staff cannot delete records.');

        // Log the activity before deletion
        $this->logDelete($propertyCategory);
        
        $propertyCategory->delete();
        return redirect()->route('property-categories.index')
            ->with('success', 'Property category deleted successfully.');
    }

    /**
     * Toggle category status
     */
    public function toggle(Request $request, PropertyCategory $propertyCategory)
    {
        $propertyCategory->is_active = !$propertyCategory->is_active;
        $propertyCategory->save();

        return response()->json(['is_active' => $propertyCategory->is_active]);
    }

    /**
     * Update sort order for categories
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|integer|exists:property_categories,id',
            'categories.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->categories as $categoryData) {
            PropertyCategory::where('id', $categoryData['id'])
                ->update(['sort_order' => $categoryData['sort_order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Move category up in sort order
     */
    public function moveUp(PropertyCategory $propertyCategory)
    {
        $previousCategory = PropertyCategory::where('sort_order', '<', $propertyCategory->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        if ($previousCategory) {
            $tempOrder = $propertyCategory->sort_order;
            $propertyCategory->sort_order = $previousCategory->sort_order;
            $previousCategory->sort_order = $tempOrder;
            
            $propertyCategory->save();
            $previousCategory->save();
        }

        return redirect()->route('property-categories.index')
            ->with('success', 'Category moved up successfully.');
    }

    /**
     * Move category down in sort order
     */
    public function moveDown(PropertyCategory $propertyCategory)
    {
        $nextCategory = PropertyCategory::where('sort_order', '>', $propertyCategory->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        if ($nextCategory) {
            $tempOrder = $propertyCategory->sort_order;
            $propertyCategory->sort_order = $nextCategory->sort_order;
            $nextCategory->sort_order = $tempOrder;
            
            $propertyCategory->save();
            $nextCategory->save();
        }

        return redirect()->route('property-categories.index')
            ->with('success', 'Category moved down successfully.');
    }
}