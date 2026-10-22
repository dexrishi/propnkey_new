@extends('layouts.admin')

@section('title', 'Inquiry Details - CRM')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Inquiry Details</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('inquiries.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Inquiries
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <!-- Left Column - Inquiry Details -->
    <div class="col-lg-8">
        <!-- Contact Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-circle me-2"></i>Contact Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p class="mb-0">{{ $inquiry->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Company</label>
                        <p class="mb-0">{{ $inquiry->company ?? '—' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="mb-0">
                            <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <p class="mb-0">
                            <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                        </p>
                    </div>
                    @if($inquiry->project_name)
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Project Name</label>
                        <p class="mb-0">{{ $inquiry->project_name }}</p>
                    </div>
                    @endif
                    @if($inquiry->form_name)
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Form Name</label>
                        <p class="mb-0">{{ $inquiry->form_name }}</p>
                    </div>
                    @endif
                    @if($inquiry->url)
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Page URL</label>
                        <p class="mb-0">
                            <a href="{{ $inquiry->url }}" target="_blank" rel="noopener" class="text-break">{{ $inquiry->url }}</a>
                        </p>
                    </div>
                    @endif
                    @if($inquiry->user_message)
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Message</label>
                        <div class="border rounded p-3 bg-light">
                            {{ $inquiry->user_message }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-sticky me-2"></i>Notes
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('inquiries.update-notes', $inquiry->id) }}" method="POST" id="notesForm">
                    @csrf
                    <div class="mb-3">
                        <textarea class="form-control" 
                                  name="notes" 
                                  id="notes" 
                                  rows="8" 
                                  placeholder="Add notes about this inquiry...">{{ old('notes', $inquiry->notes) }}</textarea>
                        <small class="form-text text-muted">Maximum 5000 characters</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Notes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column - CRM Actions -->
    <div class="col-lg-4">
        <!-- Status Card -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-flag me-2"></i>Current Status
                </h5>
            </div>
            <div class="card-body text-center">
                <span class="badge bg-{{ $inquiry->status_badge_color }} fs-6 px-4 py-2 mb-3 d-inline-block">
                    {{ $inquiry->status_label }}
                </span>
                <form action="{{ route('inquiries.update-status', $inquiry->id) }}" method="POST" id="statusForm">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Update Status</label>
                        <select class="form-select" name="status" id="status" required>
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ $inquiry->status == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-repeat me-2"></i>Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ $inquiry->project_name ?? 'Inquiry' }}" 
                       class="btn btn-outline-primary">
                        <i class="bi bi-envelope me-2"></i>Send Email
                    </a>
                    <a href="tel:{{ $inquiry->phone }}" class="btn btn-outline-success">
                        <i class="bi bi-telephone me-2"></i>Call
                    </a>
                    <button type="button" class="btn btn-outline-info" onclick="copyToClipboard('{{ $inquiry->email }}')">
                        <i class="bi bi-clipboard me-2"></i>Copy Email
                    </button>
                    <button type="button" class="btn btn-outline-info" onclick="copyToClipboard('{{ $inquiry->phone }}')">
                        <i class="bi bi-clipboard me-2"></i>Copy Phone
                    </button>
                    <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('Move this inquiry to trash?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-trash me-2"></i>Delete Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Inquiry Meta -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>Information
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Inquiry ID</label>
                    <p class="mb-0">#{{ $inquiry->id }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Created</label>
                    <p class="mb-0">{{ $inquiry->created_at->format('F d, Y \a\t g:i A') }}</p>
                    <small class="text-muted">{{ $inquiry->created_at->diffForHumans() }}</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Last Updated</label>
                    <p class="mb-0">{{ $inquiry->updated_at->format('F d, Y \a\t g:i A') }}</p>
                    <small class="text-muted">{{ $inquiry->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Copied to clipboard: ' + text);
        }, function() {
            alert('Failed to copy to clipboard');
        });
    }

    // Auto-save notes on blur (optional enhancement)
    document.getElementById('notes').addEventListener('blur', function() {
        // Optional: Add auto-save functionality here
    });
</script>
@endpush
@endsection

