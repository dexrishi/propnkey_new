@extends('layouts.admin')

@section('title', 'Create Location')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Create New Location</h1>
                                <p class="text-muted mb-0">Add a new property location</p>
                            </div>
                            <div>
                                <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Locations
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
                                <h5 class="card-title mb-0">Location Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('locations.store') }}" enctype="multipart/form-data" id="locationForm">
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
                                                   placeholder="e.g., Downtown Office">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="slug" class="form-label">Slug</label>
                                            <input type="text" 
                                                   class="form-control @error('slug') is-invalid @enderror" 
                                                   id="slug" 
                                                   name="slug" 
                                                   value="{{ old('slug') }}" 
                                                   placeholder="e.g., downtown-office">
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
                                            <label for="heading" class="form-label">Heading</label>
                                            <input type="text" 
                                                   class="form-control @error('heading') is-invalid @enderror" 
                                                   id="heading" 
                                                   name="heading" 
                                                   value="{{ old('heading') }}" 
                                                   placeholder="e.g., Welcome to Downtown">
                                            @error('heading')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control @error('meta_title') is-invalid @enderror" 
                                               id="meta_title" 
                                               name="meta_title" 
                                               value="{{ old('meta_title') }}" 
                                               placeholder="SEO title for search engines">
                                        @error('meta_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                                  id="meta_description" 
                                                  name="meta_description" 
                                                  rows="2" 
                                                  placeholder="SEO description for search engines">{{ old('meta_description') }}</textarea>
                                        @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Keep it under 160 characters for best SEO results</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="site_description" class="form-label">Site Description</label>
                                        <textarea class="form-control @error('site_description') is-invalid @enderror" 
                                                  id="site_description" 
                                                  name="site_description" 
                                                  rows="4" 
                                                  placeholder="Detailed description of the location">{{ old('site_description') }}</textarea>
                                        @error('site_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" 
                                               class="form-control @error('image') is-invalid @enderror" 
                                               id="image" 
                                               name="image" 
                                               accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Recommended size: 800x600px or similar aspect ratio</div>
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

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Create Location
                                        </button>
                                        <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary">
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
                                    <p class="small text-muted mb-1">The display name for this location</p>
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
                                    <strong>Meta Title</strong>
                                    <p class="small text-muted mb-1">Appears in browser tabs and search results</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Meta Description</strong>
                                    <p class="small text-muted mb-1">Brief description for search engines</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Heading</strong>
                                    <p class="small text-muted mb-1">Main heading for the location page</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Site Description</strong>
                                    <p class="small text-muted mb-1">Detailed description for visitors</p>
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
    
    // Character counter for meta description
    const metaDescInput = document.getElementById('meta_description');
    const metaDescHelp = metaDescInput.nextElementSibling;
    
    metaDescInput.addEventListener('input', function() {
        const length = this.value.length;
        const helpText = `Keep it under 160 characters for best SEO results (${length}/160)`;
        metaDescHelp.textContent = helpText;
        
        if (length > 160) {
            metaDescHelp.classList.add('text-warning');
            metaDescHelp.classList.remove('text-muted');
        } else {
            metaDescHelp.classList.remove('text-warning');
            metaDescHelp.classList.add('text-muted');
        }
    });
});
</script>
@endpush
@endsection
