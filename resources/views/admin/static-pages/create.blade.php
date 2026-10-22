@extends('layouts.admin')

@section('title', 'Create Static Page')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Create New Static Page</h1>
                                <p class="text-muted mb-0">Add a new static page</p>
                            </div>
                            <div>
                                <a href="{{ route('static-pages.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Static Pages
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
                                <h5 class="card-title mb-0">Static Page Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('static-pages.store') }}" id="staticPageForm">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               required 
                                               autofocus
                                               placeholder="e.g., About Us">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" 
                                               class="form-control @error('slug') is-invalid @enderror" 
                                               id="slug" 
                                               name="slug" 
                                               value="{{ old('slug') }}" 
                                               placeholder="e.g., about-us">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Leave empty to auto-generate from name</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                                  id="content" 
                                                  name="content" 
                                                  rows="15">{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Create Static Page
                                        </button>
                                        <a href="{{ route('static-pages.index') }}" class="btn btn-outline-secondary">
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
                                    <p class="small text-muted mb-1">The page name/title</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Slug</strong>
                                    <p class="small text-muted mb-1">URL-friendly version of the name</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Content</strong>
                                    <p class="small text-muted mb-1">Rich text content using the editor</p>
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
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    // Auto-generate slug from name on focusout (blur)
    nameInput.addEventListener('blur', function() {
        // Only generate slug if slug field is empty
        if (!slugInput.value || slugInput.value.trim() === '') {
            const nameValue = this.value.trim();
            if (nameValue) {
                slugInput.value = nameValue
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
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
            
            // Ensure CKEditor content is synced before form submission
            document.getElementById('staticPageForm').addEventListener('submit', function(e) {
                editor.updateSourceElement();
            });
        })
        .catch(error => {
            console.error('Error initializing CKEditor:', error);
        });
});
</script>
@endpush
@endsection

