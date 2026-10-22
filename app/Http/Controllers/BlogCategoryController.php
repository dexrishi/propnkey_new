<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class BlogCategoryController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of blog categories
     */
    public function index(Request $request)
    {
        $query = BlogCategory::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $categories = $query->orderBy('name')->paginate(20);
        return $this->viewWithRoute('admin.blog-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new blog category
     */
    public function create()
    {
        return $this->viewWithRoute('admin.blog-categories.create');
    }

    /**
     * Store a newly created blog category
     */
    public function store(Request $request)
    {
        // Normalize checkbox values before validation (checkboxes send "on" when checked, nothing when unchecked)
        $request->merge([
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_categories,slug',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['featured_image']);
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle boolean field (already normalized, but keep for consistency)
        $data['is_active'] = $request->has('is_active') ? (bool) $request->input('is_active') : false;

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                $image = $request->file('featured_image');
                $directory = storage_path('app/public/blog-categories');
                if (!file_exists($directory)) {
                    if (!mkdir($directory, 0755, true)) {
                        throw new \Exception('Failed to create directory for image upload');
                    }
                }

                $filename = time() . '_' . Str::slug($data['name']) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('blog-categories', $filename, 'public');

                if ($path) {
                    $data['featured_image'] = $path;
                }
            } catch (\Exception $e) {
                \Log::error('Error uploading blog category featured image: ' . $e->getMessage());
            }
        }

        $blogCategory = BlogCategory::create($data);
        
        // Log the activity
        $this->logCreate($blogCategory);

        return redirect()->route('blog-categories.index')
            ->with('success', 'Blog category created successfully.');
    }

    /**
     * Display the specified blog category
     */
    public function show(BlogCategory $blogCategory)
    {
        $blogCategory->load('blogPosts');
        return $this->viewWithRoute('admin.blog-categories.show', compact('blogCategory'));
    }

    /**
     * Show the form for editing the specified blog category
     */
    public function edit(BlogCategory $blogCategory)
    {
        return $this->viewWithRoute('admin.blog-categories.edit', compact('blogCategory'));
    }

    /**
     * Update the specified blog category
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        // Normalize checkbox values before validation (checkboxes send "on" when checked, nothing when unchecked)
        $request->merge([
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_categories,slug,' . $blogCategory->id,
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['featured_image']);
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle boolean field (already normalized, but keep for consistency)
        $data['is_active'] = $request->has('is_active') ? (bool) $request->input('is_active') : false;

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                // Delete old image if exists
                if ($blogCategory->featured_image && Storage::disk('public')->exists($blogCategory->featured_image)) {
                    Storage::disk('public')->delete($blogCategory->featured_image);
                }

                $image = $request->file('featured_image');
                $directory = storage_path('app/public/blog-categories');
                if (!file_exists($directory)) {
                    if (!mkdir($directory, 0755, true)) {
                        throw new \Exception('Failed to create directory for image upload');
                    }
                }

                $filename = time() . '_' . Str::slug($data['name']) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('blog-categories', $filename, 'public');

                if ($path) {
                    $data['featured_image'] = $path;
                }
            } catch (\Exception $e) {
                \Log::error('Error uploading blog category featured image: ' . $e->getMessage());
            }
        } elseif ($request->input('remove_image')) {
            if ($blogCategory->featured_image && Storage::disk('public')->exists($blogCategory->featured_image)) {
                Storage::disk('public')->delete($blogCategory->featured_image);
            }
            $data['featured_image'] = null;
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($blogCategory);
        
        $blogCategory->update($data);
        
        // Log the activity
        $this->logUpdate($blogCategory, $oldAttributes);

        return redirect()->route('blog-categories.index')
            ->with('success', 'Blog category updated successfully.');
    }

    /**
     * Remove the specified blog category
     */
    public function destroy(BlogCategory $blogCategory)
    {
        // Check if category has posts
        if ($blogCategory->blogPosts()->count() > 0) {
            return redirect()->route('blog-categories.index')
                ->with('error', 'Cannot delete category with existing blog posts. Please move or delete the posts first.');
        }

        // Delete featured image if exists
        if ($blogCategory->featured_image && Storage::disk('public')->exists($blogCategory->featured_image)) {
            Storage::disk('public')->delete($blogCategory->featured_image);
        }

        // Log the activity before deletion
        $this->logDelete($blogCategory);
        
        $blogCategory->delete();
        return redirect()->route('blog-categories.index')
            ->with('success', 'Blog category deleted successfully.');
    }

    /**
     * Toggle category status
     */
    public function toggle(Request $request, BlogCategory $blogCategory)
    {
        $blogCategory->is_active = !$blogCategory->is_active;
        $blogCategory->save();

        return response()->json(['is_active' => $blogCategory->is_active]);
    }
}