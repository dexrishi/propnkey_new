@extends('layouts.admin')

@section('title', 'Add New Testimonial')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Testimonial</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('testimonials.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Testimonials
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data" id="testimonialForm">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Testimonial Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Enter full name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                                   id="designation" name="designation" value="{{ old('designation') }}" 
                                   placeholder="e.g., CEO, Manager, Customer" required>
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Testimonial Comment <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" 
                                  id="comment" name="comment" rows="4" 
                                  placeholder="Enter the testimonial comment" required>{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Share what the person said about your service or product.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Upload a profile photo (optional). Max size: 2MB</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" 
                                   min="0" placeholder="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Lower numbers appear first</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible on website)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Create Testimonial
                </button>
                <a href="{{ route('testimonials.index') }}" class="btn btn-outline-secondary">
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
                <div class="testimonial-preview text-center">
                    <div class="mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                             style="width: 80px; height: 80px;" id="preview-avatar">
                            <span id="preview-initials">JD</span>
                        </div>
                    </div>
                    <h6 id="preview-name" class="mb-1">John Doe</h6>
                    <small id="preview-designation" class="text-muted mb-3 d-block">CEO, Company</small>
                    <p id="preview-comment" class="fst-italic">"This is a sample testimonial comment..."</p>
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
                        Use real customer testimonials
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Include specific details
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Keep comments concise
                    </li>
                    <li class="mb-0">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Use high-quality images
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const designationInput = document.getElementById('designation');
    const commentInput = document.getElementById('comment');
    const imageInput = document.getElementById('image');
    
    const previewName = document.getElementById('preview-name');
    const previewDesignation = document.getElementById('preview-designation');
    const previewComment = document.getElementById('preview-comment');
    const previewInitials = document.getElementById('preview-initials');
    const previewAvatar = document.getElementById('preview-avatar');

    function updatePreview() {
        // Update name
        previewName.textContent = nameInput.value || 'John Doe';
        
        // Update designation
        previewDesignation.textContent = designationInput.value || 'CEO, Company';
        
        // Update comment
        previewComment.textContent = commentInput.value || '"This is a sample testimonial comment..."';
        
        // Update initials
        const name = nameInput.value || 'John Doe';
        const words = name.split(' ');
        let initials = '';
        words.forEach(word => {
            if (word.length > 0) {
                initials += word.charAt(0).toUpperCase();
            }
        });
        previewInitials.textContent = initials.substring(0, 2);
    }

    function updateImagePreview() {
        const file = imageInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewAvatar.innerHTML = `<img src="${e.target.result}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">`;
            };
            reader.readAsDataURL(file);
        } else {
            previewAvatar.innerHTML = `<span id="preview-initials">${previewInitials.textContent}</span>`;
        }
    }

    // Add event listeners
    nameInput.addEventListener('input', updatePreview);
    designationInput.addEventListener('input', updatePreview);
    commentInput.addEventListener('input', updatePreview);
    imageInput.addEventListener('change', updateImagePreview);

    // Initial preview update
    updatePreview();
});
</script>
@endpush
