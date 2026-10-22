@extends('layouts.admin')

@section('title', 'Edit Property Category')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category: {{ $propertyCategory->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-categories.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Categories
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('property-categories.update', $propertyCategory->id) }}" method="POST" id="categoryForm">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $propertyCategory->name) }}" 
                                   placeholder="Enter category name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" value="{{ old('slug', $propertyCategory->slug) }}" 
                                   placeholder="category-slug">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to auto-generate from name</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control @error('heading') is-invalid @enderror" 
                                   id="heading" name="heading" value="{{ old('heading', $propertyCategory->heading) }}" 
                                   placeholder="Enter category heading">
                            @error('heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Optional heading for display purposes</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $propertyCategory->sort_order) }}" 
                                   placeholder="0" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Lower numbers appear first</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="6">{{ old('description', $propertyCategory->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Describe what this property category includes</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $propertyCategory->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible on website)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Category
                </button>
                <a href="{{ route('property-categories.index') }}" class="btn btn-outline-secondary">
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
                <div class="category-preview">
                    <h4 id="preview-heading" class="mb-2">{{ $propertyCategory->display_heading }}</h4>
                    <h6 id="preview-name" class="text-muted mb-3">{{ $propertyCategory->name }}</h6>
                    <p id="preview-description" class="mb-0">{!! $propertyCategory->description ?: 'Category description will appear here...' !!}</p>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Category Stats</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <small class="text-muted">Created</small>
                        <div>{{ $propertyCategory->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Updated</small>
                        <div>{{ $propertyCategory->updated_at->format('M d, Y') }}</div>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Status</small>
                    <div>
                        <span class="badge bg-{{ $propertyCategory->is_active ? 'success' : 'secondary' }}">
                            {{ $propertyCategory->is_active ? 'Active' : 'Inactive' }}
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
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const headingInput = document.getElementById('heading');
    
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
        const name = nameInput.value || 'Category Name';
        const heading = headingInput.value || 'Category Heading';
        
        document.getElementById('preview-name').textContent = name;
        document.getElementById('preview-heading').textContent = heading;
        
        if (window.editor) {
            const description = window.editor.getData();
            document.getElementById('preview-description').innerHTML = 
                description || 'Category description will appear here...';
        }
    }

    // Add event listeners
    headingInput.addEventListener('input', updatePreview);
    slugInput.addEventListener('input', updatePreview);
    
    // Initial preview update
    updatePreview();
});
</script>
@endpush
