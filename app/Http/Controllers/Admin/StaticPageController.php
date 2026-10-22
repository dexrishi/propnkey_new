<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\StaticPage;
use Illuminate\Support\Str;
use App\Traits\LogsActivity;

class StaticPageController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of static pages
     */
    public function index(Request $request)
    {
        $query = StaticPage::orderBy('name', 'asc');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
            });
        }
        
        $staticPages = $query->paginate(20);
        return $this->viewWithRoute('admin.static-pages.index', compact('staticPages'));
    }

    /**
     * Show the form for creating a new static page
     */
    public function create()
    {
        return $this->viewWithRoute('admin.static-pages.create');
    }

    /**
     * Store a newly created static page
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:static_pages,slug',
            'content' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $baseSlug = Str::slug($data['name']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure slug is unique
            while (StaticPage::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }

        $staticPage = StaticPage::create($data);
        
        // Log the activity
        $this->logCreate($staticPage);

        return redirect()->route('static-pages.index')
            ->with('success', 'Static page created successfully.');
    }

    /**
     * Display the specified static page
     */
    public function show(StaticPage $staticPage)
    {
        return $this->viewWithRoute('admin.static-pages.show', compact('staticPage'));
    }

    /**
     * Show the form for editing the specified static page
     */
    public function edit(StaticPage $staticPage)
    {
        return $this->viewWithRoute('admin.static-pages.edit', compact('staticPage'));
    }

    /**
     * Update the specified static page
     */
    public function update(Request $request, StaticPage $staticPage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:static_pages,slug,' . $staticPage->id,
            'content' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided or if name changed
        if (empty($data['slug']) || $staticPage->name !== $data['name']) {
            $baseSlug = Str::slug($data['name']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure slug is unique
            while (StaticPage::where('slug', $slug)->where('id', '!=', $staticPage->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($staticPage);
        
        $staticPage->update($data);
        
        // Log the activity
        $this->logUpdate($staticPage, $oldAttributes);

        return redirect()->route('static-pages.index')
            ->with('success', 'Static page updated successfully.');
    }

    /**
     * Remove the specified static page
     */
    public function destroy(StaticPage $staticPage)
    {
        // Log the activity before deletion
        $this->logDelete($staticPage);
        
        $staticPage->delete();

        return redirect()->route('static-pages.index')
            ->with('success', 'Static page deleted successfully.');
    }
}
