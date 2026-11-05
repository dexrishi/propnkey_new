@extends('layouts.admin')

@section('title', 'Add New Property Type')

@section('content')
<style>
.pt-form-page .page-header {
    gap: 0.75rem;
}
.pt-form-page .pt-form-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 1.25rem;
    align-items: start;
}
@media (min-width: 992px) {
    .pt-form-page .pt-form-layout {
        grid-template-columns: minmax(0, 1fr) minmax(260px, 320px);
    }
}
.pt-form-page .pt-side-stack {
    display: grid;
    gap: 1rem;
}
@media (min-width: 992px) {
    .pt-form-page .pt-side-stack {
        position: sticky;
        top: 1rem;
    }
}
.pt-form-page .card {
    border: 1px solid #e6ebe8;
    border-radius: 12px;
    box-shadow: none;
}
.pt-form-page .card-header {
    background: #fafbfa;
    border-bottom: 1px solid #eef1ef;
    padding: 0.9rem 1.1rem;
}
.pt-form-page .card-body {
    padding: 1.1rem;
}
.pt-form-page .form-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #3f4743;
}
.pt-form-page .form-control,
.pt-form-page .form-select {
    border-radius: 8px;
}
.pt-form-page .pt-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.65rem;
}
.pt-form-page .type-preview h5 {
    word-break: break-word;
}
.pt-form-page .type-preview code {
    word-break: break-all;
}
.pt-form-page .tips-list li {
    display: flex;
    gap: 0.5rem;
    align-items: flex-start;
    font-size: 0.9rem;
    line-height: 1.45;
    color: #4a524d;
}
@media (max-width: 575.98px) {
    .pt-form-page .page-header h1 {
        font-size: 1.35rem;
    }
    .pt-form-page .pt-actions .btn {
        flex: 1 1 auto;
    }
}
</style>

<div class="pt-form-page">
    <div class="d-flex justify-content-between align-items-center flex-wrap page-header pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 mb-0">Add New Property Type</h1>
        <a href="{{ route('property-types.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back to Types
        </a>
    </div>

    <form action="{{ route('property-types.store') }}" method="POST" id="typeForm">
        @csrf
        <div class="pt-form-layout">
            <div class="pt-form-main">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Type Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}"
                                       placeholder="e.g. Apartment, Villa, Townhouse" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="property_category_id" class="form-label">Property Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('property_category_id') is-invalid @enderror"
                                        id="property_category_id" name="property_category_id" required>
                                    <option value="">Select Property Category</option>
                                    @foreach(\App\Models\PropertyCategory::active()->ordered()->get() as $category)
                                        <option value="{{ $category->id }}" {{ old('property_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('property_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug') }}"
                                       placeholder="url-friendly-slug" required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                                       min="0" placeholder="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-3 d-flex align-items-end">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="heading" class="form-label">Heading</label>
                                <input type="text" class="form-control @error('heading') is-invalid @enderror"
                                       id="heading" name="heading" value="{{ old('heading') }}"
                                       placeholder="Enter heading">
                                @error('heading')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="4"
                                          placeholder="Enter description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SEO Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                       id="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                                       placeholder="Enter meta title">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                          id="meta_description" name="meta_description" rows="3"
                                          placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-actions mb-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Create Type
                    </button>
                    <a href="{{ route('property-types.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </a>
                </div>
            </div>

            <aside class="pt-side-stack">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Preview</h6>
                    </div>
                    <div class="card-body">
                        <div class="type-preview">
                            <h5 id="preview-name" class="mb-2">Type Name</h5>
                            <code id="preview-slug" class="small text-muted mb-2 d-block">type-slug</code>
                            <p id="preview-heading" class="text-muted mb-2"></p>
                            <p id="preview-description" class="small text-muted mb-0"></p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Tips</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled tips-list mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success mt-1"></i>
                                <span><strong>Name:</strong> Clear names like Apartment, Villa, Townhouse</span>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success mt-1"></i>
                                <span><strong>Slug:</strong> lowercase, hyphens only</span>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success mt-1"></i>
                                <span><strong>Sort Order:</strong> lower numbers appear first</span>
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-check-circle text-success mt-1"></i>
                                <span><strong>SEO:</strong> fill meta title/description</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    let slugTouched = {{ old('slug') ? 'true' : 'false' }};

    slugInput.addEventListener('input', function () {
        slugTouched = true;
        updatePreview();
    });

    nameInput.addEventListener('input', function () {
        if (!slugTouched || !slugInput.value) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }
        updatePreview();
    });

    document.getElementById('heading').addEventListener('input', updatePreview);
    document.getElementById('description').addEventListener('input', updatePreview);

    function updatePreview() {
        document.getElementById('preview-name').textContent = nameInput.value || 'Type Name';
        document.getElementById('preview-slug').textContent = slugInput.value || 'type-slug';
        document.getElementById('preview-heading').textContent = document.getElementById('heading').value || '';
        document.getElementById('preview-description').textContent = document.getElementById('description').value || '';
    }

    updatePreview();
});
</script>
@endsection
