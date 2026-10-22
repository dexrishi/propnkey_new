@extends('layouts.admin')

@section('title', 'Add New Footer Link')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Footer Link</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('footer-items.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Footer Links
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('footer-items.store') }}" method="POST" id="footerForm">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Footer Link Information</h5>
                </div>
                <div class="card-body">
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}"
                               placeholder="Enter footer link title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- URL -->
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" class="form-control @error('url') is-invalid @enderror"
                               id="url" name="url" value="{{ old('url') }}"
                               placeholder="/about or https://example.com/page">
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Can be a relative path (e.g., /about) or full URL (e.g., https://example.com)</div>
                    </div>

                    <!-- Footer Category -->
                    <div class="mb-3">
                        <label for="footer_category_id" class="form-label">Footer Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('footer_category_id') is-invalid @enderror" 
                                id="footer_category_id" name="footer_category_id" required>
                            <option value="">-- Select Category --</option>
                            @foreach($footerCategories as $category)
                                <option value="{{ $category->id }}" {{ old('footer_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('footer_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sorting -->
                    <div class="mb-3">
                        <label for="sorting" class="form-label">Sorting Order</label>
                        <input type="number" class="form-control @error('sorting') is-invalid @enderror"
                               id="sorting" name="sorting" value="{{ old('sorting', 0) }}">
                        @error('sorting')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Lower numbers appear first</div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status"
                                   {{ old('status', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">
                                Active (visible in footer)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Create Footer Link
                </button>
                <a href="{{ route('footer-items.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Preview -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Preview</h6>
            </div>
            <div class="card-body">
                <div class="seo-preview">
                    <h6 id="preview-title" class="text-primary mb-1">Footer Link Title</h6>
                    <small id="preview-url" class="text-success mb-2 d-block">https://example.com/page</small>
                    <p class="text-muted small mb-0">Category: <span id="preview-category">Category Name</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const urlInput = document.getElementById('url');
    const categoryInput = document.getElementById('footer_category_id');

    function updatePreview() {
        document.getElementById('preview-title').textContent = titleInput.value || 'Footer Link Title';
        document.getElementById('preview-url').textContent = urlInput.value || '/example';
        const selectedOption = categoryInput.options[categoryInput.selectedIndex];
        document.getElementById('preview-category').textContent = selectedOption ? selectedOption.text : 'Category Name';
    }

    titleInput.addEventListener('input', updatePreview);
    urlInput.addEventListener('input', updatePreview);
    categoryInput.addEventListener('change', updatePreview);

    updatePreview();
});
</script>
@endpush
