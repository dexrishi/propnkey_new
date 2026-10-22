@extends('layouts.admin')

@section('title', 'Create Configuration')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Configuration</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('configs.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Configurations
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('configs.store') }}" method="POST" enctype="multipart/form-data" id="configForm">
            @csrf
            <div class="mb-3">
                <label for="label" class="form-label">Label</label>
                <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ old('label') }}" placeholder="Enter configuration label">
                @error('label')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                    <option value="">Select type</option>
                    <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                    <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                    <option value="file" {{ old('type') == 'file' ? 'selected' : '' }}>File</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <div id="content-container">
                    <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" value="{{ old('content') }}" placeholder="Enter content">
                </div>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i>Create Configuration
            </button>
        </form>
    </div>
    <div class="col-lg-4">
        <div class="card bg-light mb-3">
            <div class="card-header">Help Panel</div>
            <div class="card-body">
                <h5 class="card-title">Configuration Types</h5>
                <p class="card-text">
                    <strong>Text:</strong> Single line text input for simple values like site name, email, etc.
                </p>
                <p class="card-text">
                    <strong>Textarea:</strong> Multi-line text input for longer content like descriptions, addresses, etc.
                </p>
                <p class="card-text">
                    <strong>File:</strong> File upload for images, documents, videos (MP4), or other files. Max size: 10MB. The file path will be stored.
                </p>
                <h5 class="card-title mt-3">Usage</h5>
                <p class="card-text">
                    Use <code>config_get('label')</code> to retrieve configuration values in your views.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const contentContainer = document.getElementById('content-container');
    const contentInput = document.getElementById('content');

    function updateContentField() {
        const type = typeSelect.value;
        let newField;

        if (type === 'textarea') {
            newField = document.createElement('textarea');
            newField.className = 'form-control';
            newField.name = 'content';
            newField.rows = 5;
            newField.placeholder = 'Enter content';
        } else if (type === 'file') {
            newField = document.createElement('input');
            newField.type = 'file';
            newField.className = 'form-control';
            newField.name = 'content';
            newField.accept = '.jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.txt,.mp4';
            newField.id = 'content';
            
            // Add file info display
            const fileInfo = document.createElement('div');
            fileInfo.className = 'mt-2 text-muted small';
            fileInfo.innerHTML = '<i class="bi bi-info-circle me-1"></i>Supported formats: JPG, PNG, GIF, WEBP, AVIF, PDF, DOC, DOCX, TXT, MP4. Max size: 10MB.';
            
            contentContainer.innerHTML = '';
            contentContainer.appendChild(newField);
            contentContainer.appendChild(fileInfo);
            return;
        } else {
            newField = document.createElement('input');
            newField.type = 'text';
            newField.className = 'form-control';
            newField.name = 'content';
            newField.placeholder = 'Enter content';
        }

        // Preserve value if switching between text and textarea
        if ((type === 'text' || type === 'textarea') && contentInput.value) {
            newField.value = contentInput.value;
        }

        contentContainer.innerHTML = '';
        contentContainer.appendChild(newField);
    }

    typeSelect.addEventListener('change', updateContentField);
});
</script>
@endpush