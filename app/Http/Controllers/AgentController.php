<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class AgentController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of agents
     */
    public function index()
    {
        $agents = Agent::ordered()->paginate(20);
        return $this->viewWithRoute('admin.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new agent
     */
    public function create()
    {
        return $this->viewWithRoute('admin.agents.create');
    }

    /**
     * Store a newly created agent
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'is_active' => 'boolean',
            'show_in_about_page' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        
        // Handle checkboxes (they don't send value if unchecked)
        $data['is_active'] = $request->boolean('is_active');
        $data['show_in_about_page'] = $request->boolean('show_in_about_page');
        $data['is_featured'] = $request->boolean('is_featured');
        
        // If this agent is being set as featured, unfeature all other agents
        if ($data['is_featured']) {
            Agent::where('id', '!=', 0)->update(['is_featured' => false]);
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('agents', 'public');
        }

        $agent = Agent::create($data);
        
        // Log the activity
        $this->logCreate($agent);

        return redirect()->route('agents.index')
            ->with('success', 'Agent created successfully.');
    }

    /**
     * Display the specified agent
     */
    public function show(Agent $agent)
    {
        return $this->viewWithRoute('admin.agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified agent
     */
    public function edit(Agent $agent)
    {
        return $this->viewWithRoute('admin.agents.edit', compact('agent'));
    }

    /**
     * Update the specified agent
     */
    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'is_active' => 'boolean',
            'show_in_about_page' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        
        // Handle checkboxes (they don't send value if unchecked)
        $data['is_active'] = $request->boolean('is_active');
        $data['show_in_about_page'] = $request->boolean('show_in_about_page');
        $isFeatured = $request->boolean('is_featured');
        
        // If this agent is being set as featured, unfeature all other agents
        if ($isFeatured) {
            Agent::where('id', '!=', $agent->id)->update(['is_featured' => false]);
        }
        $data['is_featured'] = $isFeatured;
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($agent->image) {
                Storage::disk('public')->delete($agent->image);
            }
            $data['image'] = $request->file('image')->store('agents', 'public');
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($agent);
        
        $agent->update($data);
        
        // Log the activity
        $this->logUpdate($agent, $oldAttributes);

        return redirect()->route('agents.index')
            ->with('success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified agent
     */
    public function destroy(Agent $agent)
    {
        // Delete image if exists
        if ($agent->image) {
            Storage::disk('public')->delete($agent->image);
        }

        // Log the activity before deletion
        $this->logDelete($agent);
        
        $agent->delete();

        return redirect()->route('agents.index')
            ->with('success', 'Agent deleted successfully.');
    }

    /**
     * Toggle active status
     */
    public function toggle(Agent $agent)
    {
        $agent->update(['is_active' => !$agent->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $agent->is_active
        ]);
    }
}