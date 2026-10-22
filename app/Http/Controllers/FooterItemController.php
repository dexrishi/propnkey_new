<?php

namespace App\Http\Controllers;

use App\Models\FooterItem;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class FooterItemController extends Controller
{
    use LogsActivity;
    // List all footer items
    public function index(Request $request)
    {
        $query = FooterItem::with('footerCategory')->orderBy('sorting');

        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhere('url', 'like', "%{$request->search}%")
                  ->orWhereHas('footerCategory', function($q) use ($request) {
                      $q->where('name', 'like', "%{$request->search}%");
                  });
        }

        $items = $query->paginate(10);

        return view('admin.footer-link.index', compact('items'));
    }

    // Show create form
    public function create()
    {
        $footerCategories = \App\Models\FooterCategory::ordered()->get();
        return view('admin.footer-link.create', compact('footerCategories'));
    }

    // Store new footer item
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'sorting' => 'nullable|integer',
            'footer_category_id' => 'required|exists:footer_categories,id',
            'status' => 'nullable',
        ]);

        $footerItem = FooterItem::create([
            'title' => $request->title,
            'url' => $request->url,
            'sorting' => $request->sorting ?? 0,
            'footer_category_id' => $request->footer_category_id,
            'status' => $request->has('status'),
        ]);
        
        // Log the activity
        $this->logCreate($footerItem);

        return redirect()->route('footer-items.index')->with('success', 'Footer item created successfully!');
    }

    // Show edit form
    public function edit(FooterItem $footerItem)
    {
        $footerCategories = \App\Models\FooterCategory::ordered()->get();
        return view('admin.footer-link.edit', compact('footerItem', 'footerCategories'));
    }

    public function update(Request $request, FooterItem $footerItem)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'sorting' => 'nullable|integer',
            'footer_category_id' => 'required|exists:footer_categories,id',
            'status' => 'nullable',
        ]);

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($footerItem);
        
        $footerItem->update([
            'title' => $request->title,
            'url' => $request->url,
            'sorting' => $request->sorting ?? 0,
            'footer_category_id' => $request->footer_category_id,
            'status' => $request->has('status'),
        ]);
        
        // Log the activity
        $this->logUpdate($footerItem, $oldAttributes);

        return redirect()->route('footer-items.index')->with('success', 'Footer item updated successfully!');
    }

    // Delete footer item
    public function destroy(FooterItem $footerItem)
    {
        // Log the activity before deletion
        $this->logDelete($footerItem);
        
        $footerItem->delete();
        return redirect()->route('footer-items.index')->with('success', 'Footer item deleted successfully!');
    }

    // Toggle status (active/inactive)
    public function toggle(Request $request, FooterItem $footerItem)
    {
        $footerItem->status = $request->input('status') ? 1 : 0;
        $footerItem->save();

        return response()->json(['status' => (bool)$footerItem->status]);
    }
}
