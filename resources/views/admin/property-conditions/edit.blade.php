@extends('layouts.admin')

@section('title', 'Edit Property Condition')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Condition: {{ $propertyCondition->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-conditions.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Conditions
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('property-conditions.update', $propertyCondition->id) }}" method="POST" id="conditionForm">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Condition Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $propertyCondition->name) }}" 
                                   placeholder="Enter condition name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" value="{{ old('slug', $propertyCondition->slug) }}" 
                                   placeholder="condition-slug">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to auto-generate from name</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $propertyCondition->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible on website)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Condition
                </button>
                <a href="{{ route('property-conditions.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Preview</h6>
            </div>
            <div class="card-body">
                <div class="condition-preview">
                    <h5 id="preview-name" class="mb-2">{{ $propertyCondition->name }}</h5>
                    <code id="preview-slug" class="small text-muted">{{ $propertyCondition->slug }}</code>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Condition Stats</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <small class="text-muted">Created</small>
                        <div>{{ $propertyCondition->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Updated</small>
                        <div>{{ $propertyCondition->updated_at->format('M d, Y') }}</div>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Status</small>
                    <div>
                        <span class="badge bg-{{ $propertyCondition->is_active ? 'success' : 'secondary' }}">
                            {{ $propertyCondition->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    nameInput.addEventListener('input', function() {
        if (!slugInput.value) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
        }
        updatePreview();
    });

    // Update preview
    function updatePreview() {
        const name = nameInput.value || 'Condition Name';
        const slug = slugInput.value || 'condition-slug';
        
        document.getElementById('preview-name').textContent = name;
        document.getElementById('preview-slug').textContent = slug;
    }

    // Add event listeners
    slugInput.addEventListener('input', updatePreview);
    
    // Initial preview update
    updatePreview();
});
</script>
@endpush
