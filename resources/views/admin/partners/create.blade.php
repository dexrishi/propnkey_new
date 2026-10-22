@extends('layouts.admin')

@section('title', 'Create Partner')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Create New Partner</h1>
                                <p class="text-muted mb-0">Add a new business partner</p>
                            </div>
                            <div>
                                <a href="{{ route('partners.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Partners
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Partner Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('partners.store') }}" enctype="multipart/form-data" id="partnerForm">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name') }}" 
                                                   required 
                                                   autofocus
                                                   placeholder="e.g., ABC Corporation">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="display_name" class="form-label">Display Name</label>
                                            <input type="text"
                                                   class="form-control @error('display_name') is-invalid @enderror"
                                                   id="display_name"
                                                   name="display_name"
                                                   value="{{ old('display_name') }}"
                                                   placeholder="Optional name for display, e.g., Sobha Realty">
                                            @error('display_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Optional: show a different developer name on listing pages</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="slug" class="form-label">Slug</label>
                                            <input type="text" 
                                                   class="form-control @error('slug') is-invalid @enderror" 
                                                   id="slug" 
                                                   name="slug" 
                                                   value="{{ old('slug') }}" 
                                                   placeholder="e.g., abc-corporation">
                                            @error('slug')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Leave empty to auto-generate from name</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="sort_order" class="form-label">Sort Order</label>
                                            <input type="number" 
                                                   class="form-control @error('sort_order') is-invalid @enderror" 
                                                   id="sort_order" 
                                                   name="sort_order" 
                                                   value="{{ old('sort_order', 0) }}" 
                                                   min="0"
                                                   placeholder="0">
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="image" class="form-label">Logo/Image</label>
                                            <input type="file" 
                                                   class="form-control @error('image') is-invalid @enderror" 
                                                   id="image" 
                                                   name="image" 
                                                   accept="image/*">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Recommended size: 200x100px or similar aspect ratio</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active (visible on website)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="sub_heading" class="form-label">Sub Heading</label>
                                        <input type="text" class="form-control @error('sub_heading') is-invalid @enderror" id="sub_heading" name="sub_heading" value="{{ old('sub_heading') }}" placeholder="e.g., Discover premium properties by {Developer}">
                                        @error('sub_heading')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Developer Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Short description about the developer">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Optional description shown on the developer/builder listing page.</div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Create Partner
                                        </button>
                                        <a href="{{ route('partners.index') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle me-2"></i>Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Help Panel -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Field Guidelines</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Name</strong>
                                    <p class="small text-muted mb-1">The display name for this partner</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Slug</strong>
                                    <p class="small text-muted mb-1">URL-friendly version of the name</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Sort Order</strong>
                                    <p class="small text-muted mb-1">Lower numbers appear first in lists</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Logo/Image</strong>
                                    <p class="small text-muted mb-1">Partner logo or image (optional)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    // Auto-generate slug from name
    nameInput.addEventListener('input', function() {
        if (!slugInput.value) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
        }
    });
});
</script>
@endpush
@endsection
