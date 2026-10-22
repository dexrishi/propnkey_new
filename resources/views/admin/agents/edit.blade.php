@extends('layouts.admin')

@section('title', 'Edit Agent')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Edit Agent</h1>
                                <p class="text-muted mb-0">Update agent details</p>
                            </div>
                            <div>
                                <a href="{{ route('agents.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Agents
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
                                <h5 class="card-title mb-0">Agent Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('agents.update', $agent) }}" enctype="multipart/form-data" id="agentForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', $agent->name) }}" 
                                                   required 
                                                   autofocus
                                                   placeholder="e.g., John Doe">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('designation') is-invalid @enderror" 
                                                   id="designation" 
                                                   name="designation" 
                                                   value="{{ old('designation', $agent->designation) }}" 
                                                   required
                                                   placeholder="e.g., Senior Property Manager">
                                            @error('designation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                            <input type="tel" 
                                                   class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" 
                                                   name="phone" 
                                                   value="{{ old('phone', $agent->phone) }}" 
                                                   required
                                                   placeholder="e.g., (555) 123-4567">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="whatsapp" class="form-label">WhatsApp</label>
                                            <input type="tel" 
                                                   class="form-control @error('whatsapp') is-invalid @enderror" 
                                                   id="whatsapp" 
                                                   name="whatsapp" 
                                                   value="{{ old('whatsapp', $agent->whatsapp) }}" 
                                                   placeholder="e.g., (555) 123-4567">
                                            @error('whatsapp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Optional: WhatsApp number</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $agent->email) }}" 
                                               placeholder="e.g., agent@example.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Optional: Email address</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="bio" class="form-label">Bio</label>
                                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                                  id="bio" 
                                                  name="bio" 
                                                  rows="10"
                                                  placeholder="Enter agent biography...">{{ old('bio', $agent->bio) }}</textarea>
                                        @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Optional: Add a detailed biography for the agent</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Profile Photo</label>
                                        <input type="file" 
                                               class="form-control @error('image') is-invalid @enderror" 
                                               id="image" 
                                               name="image" 
                                               accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Upload a new profile photo (JPEG, PNG, JPG, GIF, WEBP, AVIF - Max 2MB)</div>
                                    </div>

                                    <!-- Current Image -->
                                    @if($agent->image)
                                        <div class="mb-3">
                                            <label class="form-label">Current Photo</label>
                                            <div>
                                                <img src="{{ $agent->image_url }}" 
                                                     alt="{{ $agent->name }}" 
                                                     class="img-thumbnail" 
                                                     style="max-width: 200px; max-height: 200px;">
                                            </div>
                                            <div class="form-text">Upload a new image to replace the current one</div>
                                        </div>
                                    @endif

                                    <!-- Image Preview -->
                                    <div class="mb-3" id="imagePreview" style="display: none;">
                                        <label class="form-label">New Photo Preview</label>
                                        <div>
                                            <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="hidden" name="is_active" value="0">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active', $agent->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active (visible on website)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="hidden" name="show_in_about_page" value="0">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="show_in_about_page" 
                                                   name="show_in_about_page" 
                                                   value="1" 
                                                   {{ old('show_in_about_page', $agent->show_in_about_page) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="show_in_about_page">
                                                Show in about page?
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="hidden" name="is_featured" value="0">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_featured" 
                                                   name="is_featured" 
                                                   value="1" 
                                                   {{ old('is_featured', $agent->is_featured) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                <strong>Mark as Featured Agent</strong>
                                                <small class="d-block text-muted">Only one agent can be featured at a time. Setting this will unfeature any other featured agent.</small>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Update Agent
                                        </button>
                                        <a href="{{ route('agents.index') }}" class="btn btn-outline-secondary">
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
                                    <p class="small text-muted mb-1">Full name of the agent</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Designation</strong>
                                    <p class="small text-muted mb-1">Job title or position</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Phone</strong>
                                    <p class="small text-muted mb-1">Contact phone number</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Profile Photo</strong>
                                    <p class="small text-muted mb-1">Professional headshot (optional)</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Image Guidelines</h6>
                            </div>
                            <div class="card-body">
                                <ul class="small text-muted mb-0">
                                    <li>Use high-quality professional photos</li>
                                    <li>Recommended size: 400x400 pixels</li>
                                    <li>Supported formats: JPEG, PNG, JPG, GIF, WEBP, AVIF</li>
                                    <li>Maximum file size: 2MB</li>
                                    <li>Square images work best</li>
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
    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Initialize CKEditor for bio
    ClassicEditor
        .create(document.querySelector('#bio'), {
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
            window.bioEditor = editor;
        })
        .catch(error => {
            console.error('Error initializing CKEditor for bio:', error);
        });
});
</script>
@endpush
@endsection
