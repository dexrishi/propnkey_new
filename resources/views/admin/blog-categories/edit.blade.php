@extends('layouts.admin')

@section('title', 'Edit Blog Category')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category: {{ $blogCategory->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('blog-categories.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Categories
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('blog-categories.update', $blogCategory->id) }}" method="POST" id="categoryForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        @if($blogCategory->featured_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $blogCategory->featured_image) }}" 
                                     alt="{{ $blogCategory->name }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 300px; max-height: 200px; display: block;">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                    <label class="form-check-label" for="remove_image">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                               id="featured_image" name="featured_image" 
                               accept="image/*" onchange="previewImage(this)">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Recommended size: 1920x1080px. Max file size: 2MB</div>
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $blogCategory->name) }}" 
                                   placeholder="Enter category name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" value="{{ old('slug', $blogCategory->slug) }}" 
                                   placeholder="category-slug">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to auto-generate from name</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="6">{{ old('description', $blogCategory->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Describe what this category is about</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                   id="meta_title" name="meta_title" value="{{ old('meta_title', $blogCategory->meta_title) }}" 
                                   placeholder="SEO title for search engines" maxlength="255">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Recommended: 50-60 characters</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                      id="meta_description" name="meta_description" rows="3" 
                                      placeholder="SEO description for search engines" maxlength="500">{{ old('meta_description', $blogCategory->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Recommended: 150-160 characters</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   {{ old('is_active', $blogCategory->is_active) ? 'checked' : '' }}>
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
                <a href="{{ route('blog-categories.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">SEO Preview</h6>
            </div>
            <div class="card-body">
                <div class="seo-preview">
                    <h6 id="preview-title" class="text-primary mb-1">{{ $blogCategory->name }}</h6>
                    <small id="preview-url" class="text-success mb-2 d-block">yoursite.com/blog/category/{{ $blogCategory->slug }}</small>
                    <p id="preview-description" class="text-muted small mb-0">{{ Str::limit(strip_tags($blogCategory->description), 160) }}</p>
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
                        <small class="text-muted">Total Posts</small>
                        <div class="h5 mb-0">{{ $blogCategory->blogPosts()->count() }}</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Active Posts</small>
                        <div class="h5 mb-0">{{ $blogCategory->activeBlogPosts()->count() }}</div>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Created</small>
                    <div>{{ $blogCategory->created_at->format('M d, Y') }}</div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Updated</small>
                    <div>{{ $blogCategory->updated_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let editorInstance;
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            editorInstance = editor;
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    // Sync CKEditor content before form submission
    const categoryForm = document.getElementById('categoryForm');
    if (categoryForm) {
        categoryForm.addEventListener('submit', function() {
            if (editorInstance) {
                const descriptionInput = document.getElementById('description');
                descriptionInput.value = editorInstance.getData();
            }
        });
    }

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
        const name = nameInput.value || 'Category Name';
        const slug = slugInput.value || 'category-slug';
        
        document.getElementById('preview-title').textContent = name;
        document.getElementById('preview-url').textContent = `yoursite.com/blog/category/${slug}`;
        
        if (window.editor) {
            const description = window.editor.getData();
            document.getElementById('preview-description').textContent = 
                description ? description.replace(/<[^>]*>/g, '').substring(0, 160) + '...' : 'Category description will appear here...';
        }
    }

    // Add event listeners
    slugInput.addEventListener('input', updatePreview);
    
    // Initial preview update
    updatePreview();
});

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endpush
