<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use App\Traits\LogsActivity;

class PageController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of pages
     */
    public function index()
    {
        $pages = Page::ordered()->paginate(20);
        return $this->viewWithRoute('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page
     */
    public function create()
    {
        return $this->viewWithRoute('admin.pages.create');
    }

    /**
     * Store a newly created page
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $page = Page::create($data);
        
        // Log the activity
        $this->logCreate($page);

        return redirect()->route('pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified page
     */
    public function show(Page $page)
    {
        return $this->viewWithRoute('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified page
     */
    public function edit(Page $page)
    {
        return $this->viewWithRoute('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified page
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided or if title changed
        if (empty($data['slug']) || $page->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($page);
        
        $page->update($data);
        
        // Log the activity
        $this->logUpdate($page, $oldAttributes);

        return redirect()->route('pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified page
     */
    public function destroy(Page $page)
    {
        // Log the activity before deletion
        $this->logDelete($page);
        
        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Page deleted successfully.');
    }

    /**
     * Toggle active status
     */
    public function toggle(Page $page)
    {
        $page->update(['is_active' => !$page->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $page->is_active
        ]);
    }

    /**
     * Bulk update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'pages' => 'required|array',
            'pages.*.id' => 'required|exists:pages,id',
            'pages.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->pages as $pageData) {
            Page::where('id', $pageData['id'])
                ->update(['sort_order' => $pageData['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully.'
        ]);
    }
}