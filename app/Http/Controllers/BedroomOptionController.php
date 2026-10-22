<?php

namespace App\Http\Controllers;

use App\Models\BedroomOption;
use Illuminate\Http\Request;

class BedroomOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bedroomOptions = BedroomOption::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.bedroom-options.index', compact('bedroomOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bedroom-options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $bedroomOption = BedroomOption::create([
            'name' => $request->name,
            'value' => $request->value,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        
        // Log the activity
        $this->logCreate($bedroomOption);

        return redirect()->route('bedroom-options.index')
            ->with('success', 'Bedroom option created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BedroomOption $bedroomOption)
    {
        $bedroomOption->load(['properties.location', 'properties.propertyType']);
        return view('admin.bedroom-options.show', compact('bedroomOption'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BedroomOption $bedroomOption)
    {
        return view('admin.bedroom-options.edit', compact('bedroomOption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BedroomOption $bedroomOption)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($bedroomOption);
        
        $bedroomOption->update([
            'name' => $request->name,
            'value' => $request->value,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        
        // Log the activity
        $this->logUpdate($bedroomOption, $oldAttributes);

        return redirect()->route('bedroom-options.index')
            ->with('success', 'Bedroom option updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BedroomOption $bedroomOption)
    {
        // Log the activity before deletion
        $this->logDelete($bedroomOption);
        
        $bedroomOption->delete();

        return redirect()->route('bedroom-options.index')
            ->with('success', 'Bedroom option deleted successfully.');
    }

    /**
     * Toggle the active status of a bedroom option
     */
    public function toggle(BedroomOption $bedroomOption)
    {
        $bedroomOption->update(['is_active' => !$bedroomOption->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $bedroomOption->is_active,
            'message' => 'Status updated successfully'
        ]);
    }
}