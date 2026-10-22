<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class PartnerController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of partners
     */
    public function index()
    {
        $partners = Partner::ordered()->paginate(20);
        return $this->viewWithRoute('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new partner
     */
    public function create()
    {
        return $this->viewWithRoute('admin.partners.create');
    }

    /**
     * Store a newly created partner
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'display_name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:partners,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif,svg|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('partners', $filename, 'public');
            $data['image'] = $path;
        }

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $partner = Partner::create($data);
        
        // Log the activity
        $this->logCreate($partner);

        return redirect()->route('partners.index')
            ->with('success', 'Partner created successfully.');
    }

    /**
     * Display the specified partner
     */
    public function show(Partner $partner)
    {
        return $this->viewWithRoute('admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified partner
     */
    public function edit(Partner $partner)
    {
        return $this->viewWithRoute('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified partner
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'display_name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:partners,slug,' . $partner->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif,svg|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }
            
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('partners', $filename, 'public');
            $data['image'] = $path;
        }

        // Generate slug if not provided or if name changed
        if (empty($data['slug']) || $partner->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($partner);
        
        $partner->update($data);
        
        // Log the activity
        $this->logUpdate($partner, $oldAttributes);

        return redirect()->route('partners.index')
            ->with('success', 'Partner updated successfully.');
    }

    /**
     * Remove the specified partner
     */
    public function destroy(Partner $partner)
    {
        // Delete associated image if exists
        if ($partner->image && Storage::disk('public')->exists($partner->image)) {
            Storage::disk('public')->delete($partner->image);
        }
        
        // Log the activity before deletion
        $this->logDelete($partner);
        
        $partner->delete();

        return redirect()->route('partners.index')
            ->with('success', 'Partner deleted successfully.');
    }

    /**
     * Toggle active status
     */
    public function toggle(Partner $partner)
    {
        $partner->update(['is_active' => !$partner->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $partner->is_active
        ]);
    }

    /**
     * Bulk update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'partners' => 'required|array',
            'partners.*.id' => 'required|exists:partners,id',
            'partners.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->partners as $partnerData) {
            Partner::where('id', $partnerData['id'])
                ->update(['sort_order' => $partnerData['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully.'
        ]);
    }
}