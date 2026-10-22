@extends('layouts.admin')

@section('title', 'Edit Slug')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Edit Slug</h1>
                                <p class="text-muted mb-0">Update slug details</p>
                            </div>
                            <div>
                                <a href="{{ route('slug-lists.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Slug List
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
                                <h5 class="card-title mb-0">Slug Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('slug-lists.update', $slugList) }}" id="slugForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('slug') is-invalid @enderror" 
                                               id="slug" 
                                               name="slug" 
                                               value="{{ old('slug', $slugList->slug) }}" 
                                               required 
                                               autofocus
                                               placeholder="e.g., about-us or /about-us">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Enter the slug path (with or without leading slash)</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control @error('meta_title') is-invalid @enderror" 
                                               id="meta_title" 
                                               name="meta_title" 
                                               value="{{ old('meta_title', $slugList->meta_title) }}" 
                                               maxlength="255"
                                               placeholder="e.g., About Us - Company Name">
                                        @error('meta_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">SEO title for search engines (max 255 characters)</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_desc" class="form-label">Meta Description</label>
                                        <textarea class="form-control @error('meta_desc') is-invalid @enderror" 
                                                  id="meta_desc" 
                                                  name="meta_desc" 
                                                  rows="3" 
                                                  maxlength="500"
                                                  placeholder="Brief description for search engines">{{ old('meta_desc', $slugList->meta_desc) }}</textarea>
                                        @error('meta_desc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">SEO description for search engines (max 500 characters)</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="headline" class="form-label">Headline</label>
                                        <input type="text" 
                                               class="form-control @error('headline') is-invalid @enderror" 
                                               id="headline" 
                                               name="headline" 
                                               value="{{ old('headline', $slugList->headline) }}" 
                                               maxlength="255"
                                               placeholder="e.g., About Our Company">
                                        @error('headline')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Main headline for the page</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="heading_2" class="form-label">Heading 2</label>
                                        <input type="text" 
                                               class="form-control @error('heading_2') is-invalid @enderror" 
                                               id="heading_2" 
                                               name="heading_2" 
                                               value="{{ old('heading_2', $slugList->heading_2) }}" 
                                               maxlength="255"
                                               placeholder="e.g., Subheading or secondary title">
                                        @error('heading_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Secondary heading (H2) for the page</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" 
                                                  name="description" 
                                                  rows="15">{{ old('description', $slugList->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Rich text content using the editor</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="bottom_headline" class="form-label">Bottom Headline</label>
                                        <input type="text" 
                                               class="form-control @error('bottom_headline') is-invalid @enderror" 
                                               id="bottom_headline" 
                                               name="bottom_headline" 
                                               value="{{ old('bottom_headline', $slugList->bottom_headline) }}" 
                                               maxlength="255"
                                               placeholder="e.g., Contact Us Today">
                                        @error('bottom_headline')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Bottom section headline</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="bottom_description" class="form-label">Bottom Description</label>
                                        <textarea class="form-control @error('bottom_description') is-invalid @enderror" 
                                                  id="bottom_description" 
                                                  name="bottom_description" 
                                                  rows="10">{{ old('bottom_description', $slugList->bottom_description) }}</textarea>
                                        @error('bottom_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Rich text content for bottom section</div>
                                    </div>

                                    @include('admin.slug-list.partials.faq-fields')

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active', $slugList->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active (visible on website)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Update Slug
                                        </button>
                                        <a href="{{ route('slug-lists.index') }}" class="btn btn-outline-secondary">
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
                                    <strong>Slug</strong> <span class="text-danger">*</span>
                                    <p class="small text-muted mb-1">The slug path for this entry (e.g., about-us, contact, services)</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Meta Title</strong>
                                    <p class="small text-muted mb-1">SEO title that appears in search results</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Meta Description</strong>
                                    <p class="small text-muted mb-1">SEO description for search engines</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Headline</strong>
                                    <p class="small text-muted mb-1">Main headline displayed on the page</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Heading 2</strong>
                                    <p class="small text-muted mb-1">Secondary heading (H2) displayed on the page</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Description</strong>
                                    <p class="small text-muted mb-1">Rich text content using the editor</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Bottom Headline</strong>
                                    <p class="small text-muted mb-1">Headline for the bottom section</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Bottom Description</strong>
                                    <p class="small text-muted mb-1">Rich text content for bottom section</p>
                                </div>

                                <div class="mb-3">
                                    <strong>Page FAQs</strong>
                                    <p class="small text-muted mb-1">Use for listing routes like location, category, category + location, and category + type pages</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">SEO Tips</h6>
                            </div>
                            <div class="card-body">
                                <ul class="small text-muted mb-0">
                                    <li>Use descriptive, keyword-rich URLs</li>
                                    <li>Keep meta titles under 60 characters</li>
                                    <li>Write compelling meta descriptions</li>
                                    <li>Use proper heading hierarchy</li>
                                    <li>Include relevant keywords naturally</li>
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
    // Character counters
    const metaTitleInput = document.getElementById('meta_title');
    const metaDescInput = document.getElementById('meta_desc');
    
    // Add character counters
    function addCharacterCounter(input, maxLength) {
        if (!input) return;
        const counter = document.createElement('div');
        counter.className = 'form-text text-end';
        counter.innerHTML = `<span class="char-count">${input.value.length}</span>/${maxLength}`;
        input.parentNode.appendChild(counter);
        
        input.addEventListener('input', function() {
            const count = this.value.length;
            counter.querySelector('.char-count').textContent = count;
            if (count > maxLength * 0.9) {
                counter.classList.add('text-warning');
            } else {
                counter.classList.remove('text-warning');
            }
        });
    }
    
    addCharacterCounter(metaTitleInput, 255);
    addCharacterCounter(metaDescInput, 500);
    
    // Initialize CKEditor for description
    ClassicEditor
        .create(document.querySelector('#description'), {
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
            window.descriptionEditor = editor;
        })
        .catch(error => {
            console.error('Error initializing CKEditor for description:', error);
        });
    
    // Initialize CKEditor for bottom_description
    ClassicEditor
        .create(document.querySelector('#bottom_description'), {
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
            window.bottomDescriptionEditor = editor;
        })
        .catch(error => {
            console.error('Error initializing CKEditor for bottom_description:', error);
        });
});
</script>
@include('admin.slug-list.partials.faq-script')
@endpush
@endsection
