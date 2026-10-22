<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewDevelopment;
use App\Models\Property;
use App\Http\Controllers\AdminBaseController;
use App\Traits\LogsActivity;
use Illuminate\Validation\Rule;

class NewDevelopmentController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of new developments
     */
    public function index()
    {
        $showTrashed = request()->boolean('show_trashed') && auth()->user()?->isSuperAdmin();

        $query = NewDevelopment::with('property')->ordered();
        if ($showTrashed) {
            $query->onlyTrashed();
        }

        $newDevelopments = $query->get();
        return $this->viewWithRoute('admin.new-developments.index', compact('newDevelopments'));
    }

    /**
     * Show the form for creating a new new development
     */
    public function create()
    {
        // Get all active properties that are not already in new developments
        $existingPropertyIds = NewDevelopment::pluck('property_id')->toArray();
        $properties = Property::where('is_active', true)
            ->whereNotIn('id', $existingPropertyIds)
            ->orderBy('name')
            ->get();
        
        return $this->viewWithRoute('admin.new-developments.create', compact('properties'));
    }

    /**
     * Store a newly created new development
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => [
                'required',
                'exists:properties,id',
                Rule::unique('new_developments', 'property_id')->whereNull('deleted_at'),
            ],
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Get the maximum sort_order and add 1
        $maxSortOrder = NewDevelopment::max('sort_order') ?? 0;
        $sortOrder = $request->sort_order ?? ($maxSortOrder + 1);

        $newDevelopment = NewDevelopment::create([
            'property_id' => $request->property_id,
            'sort_order' => $sortOrder,
        ]);
        
        // Log the activity
        $this->logCreate($newDevelopment);

        return redirect()->route('new-developments.index')
            ->with('success', 'New development added successfully.');
    }

    /**
     * Show the form for editing the specified new development
     */
    public function edit(NewDevelopment $newDevelopment)
    {
        // Get all active properties, including the current one
        $existingPropertyIds = NewDevelopment::where('id', '!=', $newDevelopment->id)
            ->pluck('property_id')
            ->toArray();
        
        $properties = Property::where('is_active', true)
            ->where(function($query) use ($newDevelopment, $existingPropertyIds) {
                $query->where('id', $newDevelopment->property_id)
                      ->orWhereNotIn('id', $existingPropertyIds);
            })
            ->orderBy('name')
            ->get();
        
        return $this->viewWithRoute('admin.new-developments.edit', compact('newDevelopment', 'properties'));
    }

    /**
     * Update the specified new development
     */
    public function update(Request $request, NewDevelopment $newDevelopment)
    {
        $request->validate([
            'property_id' => [
                'required',
                'exists:properties,id',
                Rule::unique('new_developments', 'property_id')
                    ->ignore($newDevelopment->id)
                    ->whereNull('deleted_at'),
            ],
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($newDevelopment);
        
        $newDevelopment->update([
            'property_id' => $request->property_id,
            'sort_order' => $request->sort_order ?? $newDevelopment->sort_order,
        ]);
        
        // Log the activity
        $this->logUpdate($newDevelopment, $oldAttributes);

        return redirect()->route('new-developments.index')
            ->with('success', 'New development updated successfully.');
    }

    /**
     * Remove the specified new development
     */
    public function destroy(NewDevelopment $newDevelopment)
    {
        // Log the activity before deletion
        $this->logDelete($newDevelopment);
        
        $newDevelopment->delete();

        return redirect()->route('new-developments.index')
            ->with('success', 'New development moved to trash successfully.');
    }

    /**
     * Restore a soft deleted new development
     */
    public function restore(int $newDevelopmentId)
    {
        abort_unless(auth()->user()?->isSuperAdmin(), 403, 'Unauthorized. Super Admin access required.');

        $newDevelopment = NewDevelopment::onlyTrashed()->findOrFail($newDevelopmentId);
        $newDevelopment->restore();

        return redirect()->route('new-developments.index', ['show_trashed' => 1])
            ->with('success', 'New development restored successfully.');
    }

    /**
     * Update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'developments' => 'required|array',
            'developments.*.id' => 'required|exists:new_developments,id',
            'developments.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->developments as $developmentData) {
            NewDevelopment::where('id', $developmentData['id'])
                ->update(['sort_order' => $developmentData['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully.'
        ]);
    }
}
