@extends('layouts.admin')

@section('title', 'Edit Property Type')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Type: {{ $propertyType->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-types.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Types
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('property-types.update', $propertyType->id) }}" method="POST" id="typeForm">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Type Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $propertyType->name) }}" 
                                   placeholder="Enter type name (e.g., Apartment, Villa, Townhouse)" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="property_category_id" class="form-label">Property Category <span class="text-danger">*</span></label>
                            @if(auth()->user()?->isSeo())
                                <input type="text" class="form-control bg-light" readonly
                                       value="{{ $propertyType->propertyCategory->name ?? '—' }}">
                            @else
                                <select class="form-control @error('property_category_id') is-invalid @enderror" 
                                        id="property_category_id" name="property_category_id" required>
                                    <option value="">Select Property Category</option>
                                    @foreach(\App\Models\PropertyCategory::active()->ordered()->get() as $category)
                                        <option value="{{ $category->id }}" {{ old('property_category_id', $propertyType->property_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            @error('property_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" value="{{ old('slug', $propertyType->slug) }}" 
                                   placeholder="Enter slug" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control @error('heading') is-invalid @enderror" 
                                   id="heading" name="heading" value="{{ old('heading', $propertyType->heading) }}" 
                                   placeholder="Enter heading">
                            @error('heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="Enter description">{{ old('description', $propertyType->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $propertyType->sort_order) }}" 
                                   min="0" placeholder="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $propertyType->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">SEO Settings</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                   id="meta_title" name="meta_title" value="{{ old('meta_title', $propertyType->meta_title) }}" 
                                   placeholder="Enter meta title">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                      id="meta_description" name="meta_description" rows="3" 
                                      placeholder="Enter meta description">{{ old('meta_description', $propertyType->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Type
                </button>
                <a href="{{ route('property-types.index') }}" class="btn btn-outline-secondary">
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
                <div class="type-preview">
                    <h5 id="preview-name" class="mb-2">{{ $propertyType->name }}</h5>
                    <code id="preview-slug" class="small text-muted mb-2 d-block">{{ $propertyType->slug }}</code>
                    <p id="preview-heading" class="text-muted mb-2">{{ $propertyType->heading }}</p>
                    <p id="preview-description" class="small text-muted">{{ $propertyType->description }}</p>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        <strong>Name:</strong> Use clear, descriptive names like "Apartment", "Villa", "Townhouse"
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        <strong>Slug:</strong> URL-friendly version (lowercase, hyphens)
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        <strong>Sort Order:</strong> Lower numbers appear first
                    </li>
                    <li class="mb-0">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        <strong>SEO:</strong> Optimize for search engines
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    nameInput.addEventListener('input', function() {
        if (!slugInput.value) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            slugInput.value = slug;
        }
        updatePreview();
    });
    
    slugInput.addEventListener('input', updatePreview);
    document.getElementById('heading').addEventListener('input', updatePreview);
    document.getElementById('description').addEventListener('input', updatePreview);
    
    function updatePreview() {
        document.getElementById('preview-name').textContent = nameInput.value || 'Type Name';
        document.getElementById('preview-slug').textContent = slugInput.value || 'type-slug';
        document.getElementById('preview-heading').textContent = document.getElementById('heading').value || '';
        document.getElementById('preview-description').textContent = document.getElementById('description').value || '';
    }
    
    // Initial preview update
    updatePreview();
});
</script>
@endsection