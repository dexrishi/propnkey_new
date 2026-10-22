<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\ImageRedirection;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageRedirectionController extends AdminBaseController
{
    /**
     * Display a listing of image redirections
     */
    public function index(Request $request)
    {
        $query = ImageRedirection::with(['property', 'propertyImage']);

        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('old_path', 'like', "%{$search}%")
                  ->orWhere('new_path', 'like', "%{$search}%")
                  ->orWhere('original_filename', 'like', "%{$search}%")
                  ->orWhereHas('property', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('property') && !empty($request->input('property'))) {
            $query->where('property_id', $request->input('property'));
        }

        if ($request->has('type') && !empty($request->input('type'))) {
            $query->where('image_type', $request->input('type'));
        }

        if ($request->has('status') && $request->input('status') !== '') {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $redirections = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get filter options
        $properties = Property::select('id', 'name')->orderBy('name')->get();

        return $this->viewWithRoute('admin.image-redirections.index', compact('redirections', 'properties'));
    }

    /**
     * Show the form for creating a new image redirection
     */
    public function create()
    {
        $properties = Property::select('id', 'name')->orderBy('name')->get();
        $propertyImages = PropertyImage::with('property')->orderBy('created_at', 'desc')->get();
        
        return $this->viewWithRoute('admin.image-redirections.create', compact('properties', 'propertyImages'));
    }

    /**
     * Store a newly created image redirection
     */
    public function store(Request $request)
    {
        $request->validate([
            'old_path' => 'required|string|max:255|unique:image_redirections,old_path',
            'new_path' => 'required|string|max:255',
            'original_filename' => 'required|string|max:255',
            'property_id' => 'nullable|exists:properties,id',
            'image_type' => 'required|in:project,logo,floor_plan',
            'property_image_id' => 'nullable|exists:property_images,id',
            'is_active' => 'boolean',
        ]);

        ImageRedirection::create($request->all());

        return redirect()->route('image-redirections.index')
            ->with('success', 'Image redirection created successfully.');
    }

    /**
     * Display the specified image redirection
     */
    public function show(ImageRedirection $imageRedirection)
    {
        $imageRedirection->load(['property', 'propertyImage']);
        return $this->viewWithRoute('admin.image-redirections.show', compact('imageRedirection'));
    }

    /**
     * Show the form for editing the specified image redirection
     */
    public function edit(ImageRedirection $imageRedirection)
    {
        $properties = Property::select('id', 'name')->orderBy('name')->get();
        $propertyImages = PropertyImage::with('property')->orderBy('created_at', 'desc')->get();
        
        return $this->viewWithRoute('admin.image-redirections.edit', compact('imageRedirection', 'properties', 'propertyImages'));
    }

    /**
     * Update the specified image redirection
     */
    public function update(Request $request, ImageRedirection $imageRedirection)
    {
        $request->validate([
            'old_path' => 'required|string|max:255|unique:image_redirections,old_path,' . $imageRedirection->id,
            'new_path' => 'required|string|max:255',
            'original_filename' => 'required|string|max:255',
            'property_id' => 'nullable|exists:properties,id',
            'image_type' => 'required|in:project,logo,floor_plan',
            'property_image_id' => 'nullable|exists:property_images,id',
            'is_active' => 'boolean',
        ]);

        $imageRedirection->update($request->all());

        return redirect()->route('image-redirections.index')
            ->with('success', 'Image redirection updated successfully.');
    }

    /**
     * Remove the specified image redirection
     */
    public function destroy(ImageRedirection $imageRedirection)
    {
        $imageRedirection->delete();
        return redirect()->route('image-redirections.index')
            ->with('success', 'Image redirection deleted successfully.');
    }

    /**
     * Toggle redirection status
     */
    public function toggle(Request $request, ImageRedirection $imageRedirection)
    {
        $imageRedirection->is_active = !$imageRedirection->is_active;
        $imageRedirection->save();

        return response()->json(['is_active' => $imageRedirection->is_active]);
    }

    /**
     * Test redirection (simulate redirect)
     */
    public function test(ImageRedirection $imageRedirection)
    {
        $imageRedirection->recordRedirect();
        
        return response()->json([
            'success' => true,
            'old_url' => $imageRedirection->old_url,
            'new_url' => $imageRedirection->new_url,
            'redirect_count' => $imageRedirection->redirect_count
        ]);
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:image_redirections,id',
        ]);

        $ids = $request->input('ids');
        $action = $request->input('action');

        switch ($action) {
            case 'activate':
                ImageRedirection::whereIn('id', $ids)->update(['is_active' => true]);
                $message = 'Selected redirections activated successfully.';
                break;
            case 'deactivate':
                ImageRedirection::whereIn('id', $ids)->update(['is_active' => false]);
                $message = 'Selected redirections deactivated successfully.';
                break;
            case 'delete':
                ImageRedirection::whereIn('id', $ids)->delete();
                $message = 'Selected redirections deleted successfully.';
                break;
        }

        return redirect()->route('image-redirections.index')->with('success', $message);
    }

    /**
     * Populate redirections from mapping file
     */
    public function populate(Request $request)
    {
        try {
            $exitCode = \Artisan::call('images:populate-redirections');
            $output = \Artisan::output();
            
            return response()->json([
                'success' => true,
                'message' => 'Redirections populated successfully',
                'output' => $output
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error populating redirections: ' . $e->getMessage()
            ], 500);
        }
    }
}