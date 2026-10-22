<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Http\Controllers\AdminBaseController;

class InquiryController extends AdminBaseController
{
    public function index(Request $request)
    {
        $query = Inquiry::latest();
        $showTrashed = $request->boolean('show_trashed');

        if ($showTrashed) {
            $query->onlyTrashed();
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('company', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%')
                  ->orWhere('phone', 'like', '%'.$request->search.'%')
                  ->orWhere('project_name', 'like', '%'.$request->search.'%')
                  ->orWhere('form_name', 'like', '%'.$request->search.'%');
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->paginate(20);
        $statusOptions = Inquiry::getStatusOptions();

        return $this->viewWithRoute('admin.inquiries.index', compact('inquiries', 'statusOptions'));
    }

    public function show(Inquiry $inquiry)
    {
        $statusOptions = Inquiry::getStatusOptions();
        return $this->viewWithRoute('admin.inquiries.show', compact('inquiry', 'statusOptions'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,qualified,proposal,negotiation,won,lost',
        ]);

        $inquiry->update([
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('success', 'Status updated successfully.');
    }

    public function updateNotes(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'notes' => 'nullable|string|max:5000',
        ]);

        $inquiry->update([
            'notes' => $request->notes,
        ]);

        return redirect()->back()
            ->with('success', 'Notes updated successfully.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('inquiries.index')
            ->with('success', 'Inquiry moved to trash successfully.');
    }

    public function restore(int $inquiryId)
    {
        $inquiry = Inquiry::onlyTrashed()->findOrFail($inquiryId);
        $inquiry->restore();

        return redirect()->route('inquiries.index', ['show_trashed' => 1])
            ->with('success', 'Inquiry restored successfully.');
    }
}
