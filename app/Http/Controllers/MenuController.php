<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Traits\LogsActivity;

class MenuController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of menus
     */
    public function index(Request $request)
    {
        $query = Menu::with('parent', 'children')
            ->orderBy('parent_id')
            ->orderBy('sort_order')
            ->orderBy('title');

        // Add search functionality
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('url', 'like', '%' . $request->search . '%');
        }

        $menus = $query->paginate(20);
        
        return $this->viewWithRoute('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu
     */
    public function create()
    {
        $parentMenus = Menu::getForSelect();
        return $this->viewWithRoute('admin.menus.create', compact('parentMenus'));
    }

    /**
     * Store a newly created menu
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Prepare data properly
        $data = [
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'parent_id' => $request->input('parent_id') ?: null, // Convert empty string to null
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active'), // Properly handle checkbox
        ];

        $menu = Menu::create($data);
        
        // Log the activity
        $this->logCreate($menu);

        return redirect()->route('menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified menu
     */
    public function show(Menu $menu)
    {
        $menu->load('parent', 'children');
        return $this->viewWithRoute('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified menu
     */
    public function edit(Menu $menu)
    {
        $parentMenus = Menu::getForSelect($menu->id);
        return $this->viewWithRoute('admin.menus.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified menu
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id|not_in:' . $menu->id,
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Prepare data properly
        $data = [
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'parent_id' => $request->input('parent_id') ?: null, // Convert empty string to null
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active'), // Properly handle checkbox
        ];
        
        // Prevent setting self as parent
        if ($data['parent_id'] == $menu->id) {
            return redirect()->back()
                ->withErrors(['parent_id' => 'A menu cannot be its own parent.'])
                ->withInput();
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($menu);
        
        $menu->update($data);
        
        // Log the activity
        $this->logUpdate($menu, $oldAttributes);

        return redirect()->route('menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified menu
     */
    public function destroy(Menu $menu)
    {
        // Check if menu has children
        if ($menu->hasChildren()) {
            return redirect()->route('menus.index')
                ->with('error', 'Cannot delete menu with child items. Please delete child items first.');
        }

        // Log the activity before deletion
        $this->logDelete($menu);
        
        $menu->delete();

        return redirect()->route('menus.index')
            ->with('success', 'Menu deleted successfully.');
    }

    /**
     * Toggle active status
     */
    public function toggle(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $menu->is_active
        ]);
    }

    /**
     * Bulk update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menus,id',
            'menus.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->menus as $menuData) {
            Menu::where('id', $menuData['id'])
                ->update(['sort_order' => $menuData['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully.'
        ]);
    }

    /**
     * Get menu hierarchy for AJAX requests
     */
    public function getHierarchy()
    {
        $menus = Menu::getHierarchical();
        return response()->json($menus);
    }
}