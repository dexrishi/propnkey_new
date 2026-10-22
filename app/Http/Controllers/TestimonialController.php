<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\LogsActivity;

class TestimonialController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of testimonials
     */
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%");
        }

        $testimonials = $query->ordered()->paginate(20);
        return $this->viewWithRoute('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial
     */
    public function create()
    {
        return $this->viewWithRoute('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'comment' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048', // Max 2MB
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                
                // Ensure directory exists
                $directory = storage_path('app/public/testimonials');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                    \Log::info('Created testimonials directory: ' . $directory);
                }
                
                // Generate unique filename
                $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                
                // Store the image
                $path = $image->storeAs('testimonials', $filename, 'public');
                
                if ($path) {
                    $imagePath = $path;
                    \Log::info('Testimonial image stored successfully: ' . $imagePath);
                } else {
                    \Log::error('Failed to store testimonial image - path is null');
                }
            } catch (\Exception $e) {
                \Log::error('Error uploading testimonial image: ' . $e->getMessage());
            }
        }

        $testimonial = Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'comment' => $request->comment,
            'image' => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);
        
        // Log the activity
        $this->logCreate($testimonial);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Display the specified testimonial
     */
    public function show(Testimonial $testimonial)
    {
        return $this->viewWithRoute('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified testimonial
     */
    public function edit(Testimonial $testimonial)
    {
        return $this->viewWithRoute('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'comment' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048', // Max 2MB
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $imagePath = $testimonial->image;
        if ($request->hasFile('image')) {
            try {
                // Delete old image if exists
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                    \Log::info('Deleted old testimonial image: ' . $imagePath);
                }
                
                $image = $request->file('image');
                
                // Ensure directory exists
                $directory = storage_path('app/public/testimonials');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                // Generate unique filename
                $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                
                // Store the image
                $path = $image->storeAs('testimonials', $filename, 'public');
                
                if ($path) {
                    $imagePath = $path;
                    \Log::info('Testimonial image updated successfully: ' . $imagePath);
                } else {
                    \Log::error('Failed to store testimonial image - path is null');
                }
            } catch (\Exception $e) {
                \Log::error('Error uploading testimonial image: ' . $e->getMessage());
            }
        } elseif ($request->input('remove_image')) {
            // Remove image if checkbox is checked
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = null;
        }

        // Get old attributes before update
        $oldAttributes = method_exists($testimonial, 'getOriginal') ? $testimonial->getOriginal() : [];
        
        $testimonial->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'comment' => $request->comment,
            'image' => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);
        
        // Log the activity
        $this->logUpdate($testimonial, $oldAttributes);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified testimonial
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete image if exists
        if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
            Storage::disk('public')->delete($testimonial->image);
        }
        
        // Log the activity before deletion
        $this->logDelete($testimonial);
        
        $testimonial->delete();
        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    /**
     * Toggle testimonial status
     */
    public function toggle(Request $request, Testimonial $testimonial)
    {
        $testimonial->is_active = !$testimonial->is_active;
        $testimonial->save();

        return response()->json(['is_active' => $testimonial->is_active]);
    }

    /**
     * Update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $sortOrder = $request->input('sort_order');

        foreach ($sortOrder as $index => $id) {
            Testimonial::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 'success']);
    }
}