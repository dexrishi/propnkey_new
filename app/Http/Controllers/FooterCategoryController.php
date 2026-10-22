<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FooterCategory;
use App\Traits\LogsActivity;

class FooterCategoryController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of footer categories
     */
    public function index(Request $request)
    {
        $query = FooterCategory::ordered();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $footerCategories = $query->paginate(20);
        return $this->viewWithRoute('admin.footer-categories.index', compact('footerCategories'));
    }

    /**
     * Show the form for creating a new footer category
     */
    public function create()
    {
        return $this->viewWithRoute('admin.footer-categories.create');
    }

    /**
     * Store a newly created footer category
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'nullable|integer|min:0',
        ]);

        $footerCategory = FooterCategory::create([
            'name' => $request->name,
            'sort' => $request->sort ?? 0,
        ]);
        
        // Log the activity
        $this->logCreate($footerCategory);

        return redirect()->route('footer-categories.index')
            ->with('success', 'Footer category created successfully.');
    }

    /**
     * Display the specified footer category
     */
    public function show(FooterCategory $footerCategory)
    {
        return $this->viewWithRoute('admin.footer-categories.show', compact('footerCategory'));
    }

    /**
     * Show the form for editing the specified footer category
     */
    public function edit(FooterCategory $footerCategory)
    {
        return $this->viewWithRoute('admin.footer-categories.edit', compact('footerCategory'));
    }

    /**
     * Update the specified footer category
     */
    public function update(Request $request, FooterCategory $footerCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'nullable|integer|min:0',
        ]);

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($footerCategory);
        
        $footerCategory->update([
            'name' => $request->name,
            'sort' => $request->sort ?? 0,
        ]);
        
        // Log the activity
        $this->logUpdate($footerCategory, $oldAttributes);

        return redirect()->route('footer-categories.index')
            ->with('success', 'Footer category updated successfully.');
    }

    /**
     * Remove the specified footer category
     */
    public function destroy(FooterCategory $footerCategory)
    {
        // Log the activity before deletion
        $this->logDelete($footerCategory);
        
        $footerCategory->delete();

        return redirect()->route('footer-categories.index')
            ->with('success', 'Footer category deleted successfully.');
    }
}
