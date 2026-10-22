<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogAuthor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class BlogPostController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of blog posts
     */
    public function index(Request $request)
    {
        $query = BlogPost::with(['blogCategory', 'blogAuthor']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->has('category')) {
            $query->where('blog_category_id', $request->input('category'));
        }

        if ($request->has('status')) {
            if ($request->input('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->input('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $posts = $query->latest('created_at')->paginate(20);
        $categories = BlogCategory::active()->orderBy('name')->get();

        return $this->viewWithRoute('admin.blog-posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new blog post
     */
    public function create()
    {
        $categories = BlogCategory::active()->orderBy('name')->get();
        $authors = BlogAuthor::active()->orderBy('name')->get();
        return $this->viewWithRoute('admin.blog-posts.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created blog post
     */
    public function store(Request $request)
    {
        // Debug: Log request data
        \Log::info('Blog Post Store - Request Data:', [
            'has_file' => $request->hasFile('featured_image'),
            'file_valid' => $request->hasFile('featured_image') ? $request->file('featured_image')->isValid() : false,
            'file_size' => $request->hasFile('featured_image') ? $request->file('featured_image')->getSize() : null,
            'file_mime' => $request->hasFile('featured_image') ? $request->file('featured_image')->getMimeType() : null,
            'file_error' => $request->hasFile('featured_image') ? $request->file('featured_image')->getError() : null,
            'file_error_message' => $request->hasFile('featured_image') ? $request->file('featured_image')->getErrorMessage() : null,
            'all_inputs' => $request->except(['featured_image', '_token']),
            'content_type' => $request->header('Content-Type'),
            'content_length' => $request->header('Content-Length'),
        ]);

        // Normalize checkbox values before validation (checkboxes send "on" when checked, nothing when unchecked)
        $request->merge([
            'is_active' => $request->has('is_active') ? true : false,
            'is_featured' => $request->has('is_featured') ? true : false,
            'blog_author_id' => $request->filled('blog_author_id') ? $request->input('blog_author_id') : null,
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'blog_author_id' => 'nullable|exists:blog_authors,id',
            'description' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Get all data except the file
        $data = $request->except(['featured_image']);
        
        // Handle boolean fields (checkboxes)
        $data['is_active'] = $request->has('is_active') ? (bool) $request->input('is_active') : false;
        $data['is_featured'] = $request->has('is_featured') ? (bool) $request->input('is_featured') : false;
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                $image = $request->file('featured_image');
                
                \Log::info('Blog Post Image upload attempt:', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'is_valid' => $image->isValid(),
                    'error' => $image->getError(),
                ]);
                
                // Ensure directory exists
                $directory = storage_path('app/public/blog-posts');
                if (!file_exists($directory)) {
                    if (!mkdir($directory, 0755, true)) {
                        \Log::error('Failed to create blog-posts directory: ' . $directory);
                        throw new \Exception('Failed to create directory for image upload');
                    }
                    \Log::info('Created directory: ' . $directory);
                }
                
                // Generate unique filename
                $filename = time() . '_' . Str::slug($data['title']) . '.' . $image->getClientOriginalExtension();
                \Log::info('Attempting to store file:', ['filename' => $filename, 'directory' => 'blog-posts']);
                
                // Store the image using storeAs with public disk
                $path = $image->storeAs('blog-posts', $filename, 'public');
                
                \Log::info('File storage result:', [
                    'path' => $path, 
                    'exists' => $path ? Storage::disk('public')->exists($path) : false,
                    'full_path' => $path ? storage_path('app/public/' . $path) : null
                ]);
                
                if ($path) {
                    // Verify file actually exists
                    $fullPath = storage_path('app/public/' . $path);
                    if (file_exists($fullPath)) {
                        $data['featured_image'] = $path;
                        \Log::info('Featured image stored successfully:', ['path' => $path, 'size' => filesize($fullPath)]);
                    } else {
                        \Log::error('File was reported as stored but does not exist at: ' . $fullPath);
                    }
                } else {
                    \Log::error('Failed to store featured image - path is null or false');
                }
            } catch (\Exception $e) {
                \Log::error('Error uploading featured image:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        } else {
            \Log::warning('No featured image file in request');
        }
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Set published_at if not provided and post is active
        if (empty($data['published_at']) && $data['is_active']) {
            $data['published_at'] = now();
        }

        \Log::info('Creating blog post with data:', $data);
        
        $blogPost = BlogPost::create($data);
        
        // Log the activity
        $this->logCreate($blogPost);
        
        \Log::info('Blog post created:', ['id' => $blogPost->id, 'featured_image' => $blogPost->featured_image]);

        return redirect()->route('blog-posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified blog post
     */
    public function show(BlogPost $blogPost)
    {
        $blogPost->load(['blogCategory', 'blogAuthor']);
        return $this->viewWithRoute('admin.blog-posts.show', compact('blogPost'));
    }

    /**
     * Show the form for editing the specified blog post
     */
    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::active()->orderBy('name')->get();
        $authors = BlogAuthor::query()
            ->where(function ($query) use ($blogPost) {
                $query->where('is_active', true);
                if ($blogPost->blog_author_id) {
                    $query->orWhere('id', $blogPost->blog_author_id);
                }
            })
            ->orderBy('name')
            ->get();
        return $this->viewWithRoute('admin.blog-posts.edit', compact('blogPost', 'categories', 'authors'));
    }

    /**
     * Update the specified blog post
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        if (auth()->user()?->isSeo()) {
            $request->merge(['blog_category_id' => $blogPost->blog_category_id]);
        }

        \Log::info('Blog Post Update - Request received:', [
            'blog_post_id' => $blogPost->id,
            'method' => $request->method(),
            'has_description' => $request->has('description'),
            'description_length' => $request->has('description') ? strlen($request->input('description')) : 0,
            'all_inputs' => array_keys($request->except(['_token', '_method', 'featured_image'])),
            'title' => $request->input('title'),
            'blog_category_id' => $request->input('blog_category_id'),
        ]);

        \Log::info('Blog Post Update - About to validate');
        
        // Normalize checkbox values before validation (checkboxes send "on" when checked, nothing when unchecked)
        $request->merge([
            'is_active' => $request->has('is_active') ? true : false,
            'is_featured' => $request->has('is_featured') ? true : false,
            'blog_author_id' => $request->filled('blog_author_id') ? $request->input('blog_author_id') : null,
        ]);
        
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $blogPost->id,
                'blog_category_id' => 'required|exists:blog_categories,id',
                'blog_author_id' => 'nullable|exists:blog_authors,id',
                'description' => 'required|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
                'is_active' => 'boolean',
                'is_featured' => 'boolean',
                'published_at' => 'nullable|date',
            ]);
            
            \Log::info('Blog Post Update - Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Blog Post Update - Validation failed:', [
                'errors' => $e->errors(),
                'message' => $e->getMessage(),
            ]);
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Blog Post Update - Unexpected error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }

        // Get all data except the file
        $data = $request->except(['featured_image']);

        if (auth()->user()?->isSeo()) {
            unset($data['blog_category_id']);
        }
        
        \Log::info('Blog Post Update - Data before processing:', [
            'title' => $data['title'] ?? null,
            'description_length' => isset($data['description']) ? strlen($data['description']) : 0,
            'blog_category_id' => $data['blog_category_id'] ?? null,
        ]);
        
        // Handle boolean fields (checkboxes)
        $data['is_active'] = $request->has('is_active') ? (bool) $request->input('is_active') : false;
        $data['is_featured'] = $request->has('is_featured') ? (bool) $request->input('is_featured') : false;
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            try {
                $image = $request->file('featured_image');
                
                \Log::info('Image update attempt:', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'is_valid' => $image->isValid(),
                ]);
                
                // Delete old image if exists
                if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                    Storage::disk('public')->delete($blogPost->featured_image);
                    \Log::info('Deleted old image:', ['path' => $blogPost->featured_image]);
                }
                
                // Ensure directory exists
                $directory = storage_path('app/public/blog-posts');
                if (!file_exists($directory)) {
                    if (!mkdir($directory, 0755, true)) {
                        \Log::error('Failed to create blog-posts directory: ' . $directory);
                        throw new \Exception('Failed to create directory for image upload');
                    }
                }
                
                // Generate unique filename
                $filename = time() . '_' . Str::slug($data['title']) . '.' . $image->getClientOriginalExtension();
                
                // Store the image using storeAs with public disk
                $path = $image->storeAs('blog-posts', $filename, 'public');
                
                \Log::info('File storage result:', [
                    'path' => $path, 
                    'exists' => $path ? Storage::disk('public')->exists($path) : false,
                    'full_path' => $path ? storage_path('app/public/' . $path) : null
                ]);
                
                if ($path) {
                    // Verify file actually exists
                    $fullPath = storage_path('app/public/' . $path);
                    if (file_exists($fullPath)) {
                        $data['featured_image'] = $path;
                        \Log::info('Featured image updated successfully:', ['path' => $path, 'size' => filesize($fullPath)]);
                    } else {
                        \Log::error('File was reported as stored but does not exist at: ' . $fullPath);
                    }
                } else {
                    \Log::error('Failed to store featured image - path is null or false');
                }
            } catch (\Exception $e) {
                \Log::error('Error uploading featured image:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Set published_at if not provided and post is active
        if (empty($data['published_at']) && $data['is_active'] && !$blogPost->published_at) {
            $data['published_at'] = now();
        }

        \Log::info('Blog Post Update - Data to save:', [
            'title' => $data['title'] ?? null,
            'description_length' => isset($data['description']) ? strlen($data['description']) : 0,
            'featured_image' => $data['featured_image'] ?? null,
            'is_active' => $data['is_active'] ?? false,
            'is_featured' => $data['is_featured'] ?? false,
            'all_data_keys' => array_keys($data),
        ]);

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($blogPost);
        
        // Get original values for comparison
        $originalTitle = $blogPost->title;
        $originalDescription = $blogPost->description;
        
        \Log::info('Blog Post Update - Before update:', [
            'original_title' => $originalTitle,
            'new_title' => $data['title'] ?? null,
            'original_description_length' => strlen($originalDescription),
            'new_description_length' => isset($data['description']) ? strlen($data['description']) : 0,
        ]);

        try {
            $result = $blogPost->update($data);
            
            // Log the activity
            $this->logUpdate($blogPost, $oldAttributes);
            
            \Log::info('Blog Post Update - Update result:', [
                'result' => $result,
                'blog_post_id' => $blogPost->id,
                'was_changed' => $blogPost->wasChanged(),
                'changes' => $blogPost->getChanges(),
                'dirty' => $blogPost->getDirty(),
            ]);

            // Refresh to get latest data
            $blogPost->refresh();
            
            \Log::info('Blog Post Update - After refresh:', [
                'current_title' => $blogPost->title,
                'current_description_length' => strlen($blogPost->description),
            ]);

            if (!$result) {
                \Log::error('Blog Post Update - Update returned false!', [
                    'blog_post_id' => $blogPost->id,
                    'data' => $data,
                ]);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to update blog post. Please try again.');
            }
        } catch (\Exception $e) {
            \Log::error('Blog Post Update - Exception during update:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }

        return redirect()->route('blog-posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified blog post
     */
    public function destroy(BlogPost $blogPost)
    {
        // Delete featured image if exists
        if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }
        
        // Log the activity before deletion
        $this->logDelete($blogPost);
        
        $blogPost->delete();
        return redirect()->route('blog-posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Toggle post status
     */
    public function toggle(Request $request, BlogPost $blogPost)
    {
        $blogPost->is_active = !$blogPost->is_active;
        
        // Set published_at if activating and not already set
        if ($blogPost->is_active && !$blogPost->published_at) {
            $blogPost->published_at = now();
        }
        
        $blogPost->save();

        return response()->json(['is_active' => $blogPost->is_active]);
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Request $request, BlogPost $blogPost)
    {
        $blogPost->is_featured = !$blogPost->is_featured;
        $blogPost->save();

        return response()->json(['is_featured' => $blogPost->is_featured]);
    }
}