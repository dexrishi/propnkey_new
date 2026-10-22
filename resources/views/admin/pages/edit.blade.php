@extends('layouts.admin')

@section('title', 'Edit Page')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Edit Page</h1>
                                <p class="text-muted mb-0">Update page details</p>
                            </div>
                            <div>
                                <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Pages
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
                                <h5 class="card-title mb-0">Page Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('pages.update', $page) }}" id="pageForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('title') is-invalid @enderror" 
                                                   id="title" 
                                                   name="title" 
                                                   value="{{ old('title', $page->title) }}" 
                                                   required 
                                                   autofocus
                                                   placeholder="e.g., About Us">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="sort_order" class="form-label">Sort Order</label>
                                            <input type="number" 
                                                   class="form-control @error('sort_order') is-invalid @enderror" 
                                                   id="sort_order" 
                                                   name="sort_order" 
                                                   value="{{ old('sort_order', $page->sort_order) }}" 
                                                   min="0"
                                                   placeholder="0">
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" 
                                               class="form-control @error('slug') is-invalid @enderror" 
                                               id="slug" 
                                               name="slug" 
                                               value="{{ old('slug', $page->slug) }}" 
                                               placeholder="e.g., about-us">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Leave empty to auto-generate from title</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                                  id="content" 
                                                  name="content" 
                                                  rows="15">{{ old('content', $page->content) }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active (visible on website)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Update Page
                                        </button>
                                        <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary">
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
                                    <strong>Title</strong>
                                    <p class="small text-muted mb-1">The page title that appears in the browser tab</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Slug</strong>
                                    <p class="small text-muted mb-1">URL-friendly version of the title</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Content</strong>
                                    <p class="small text-muted mb-1">Rich text content using the editor below</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Sort Order</strong>
                                    <p class="small text-muted mb-1">Lower numbers appear first in lists</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Editor Tips</h6>
                            </div>
                            <div class="card-body">
                                <ul class="small text-muted mb-0">
                                    <li>Use headings to structure your content</li>
                                    <li>Add images by clicking the image button</li>
                                    <li>Use lists for better readability</li>
                                    <li>Preview your content before saving</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- TinyMCE -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    
    // Auto-generate slug from title
    titleInput.addEventListener('input', function() {
        if (!slugInput.value) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
        }
    });
    
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            language: 'en',
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            }
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error('Error initializing CKEditor:', error);
        });
});
</script>
@endpush
@endsection
