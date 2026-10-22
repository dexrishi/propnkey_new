<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\AltType;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;

class AltTypeController extends AdminBaseController
{
    use LogsActivity;

    public function index(Request $request)
    {
        $query = AltType::ordered();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $altTypes = $query->paginate(20)->withQueryString();

        return $this->viewWithRoute('admin.alt-types.index', compact('altTypes'));
    }

    public function create()
    {
        return $this->viewWithRoute('admin.alt-types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:alt_types,name',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = AltType::uniqueSlugFromName($data['name']);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active', true);

        $altType = AltType::create($data);
        $this->logCreate($altType);

        return redirect()->route('alt-types.index')
            ->with('success', 'Alt Type created successfully.');
    }

    public function show(AltType $altType)
    {
        return $this->viewWithRoute('admin.alt-types.show', compact('altType'));
    }

    public function edit(AltType $altType)
    {
        return $this->viewWithRoute('admin.alt-types.edit', compact('altType'));
    }

    public function update(Request $request, AltType $altType)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:alt_types,name,' . $altType->id,
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // Keep existing slug stable so already-saved property images stay linked
        if ($altType->name !== $data['name'] && empty($altType->slug)) {
            $data['slug'] = AltType::uniqueSlugFromName($data['name'], $altType->id);
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        $oldAttributes = $this->getOldAttributes($altType);
        $altType->update($data);
        $this->logUpdate($altType, $oldAttributes);

        return redirect()->route('alt-types.index')
            ->with('success', 'Alt Type updated successfully.');
    }

    public function destroy(AltType $altType)
    {
        $this->logDelete($altType);
        $altType->delete();

        return redirect()->route('alt-types.index')
            ->with('success', 'Alt Type deleted successfully.');
    }

    public function toggle(AltType $altType)
    {
        $oldAttributes = $this->getOldAttributes($altType);
        $altType->update(['is_active' => !$altType->is_active]);
        $this->logUpdate($altType, $oldAttributes);

        return redirect()->back()
            ->with('success', 'Alt Type status updated.');
    }
}
