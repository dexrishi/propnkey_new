@extends('layouts.admin')

@section('title', 'Edit Configuration')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Configuration: {{ $config->label }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('configs.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Configurations
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('configs.update', $config->id) }}" method="POST" enctype="multipart/form-data" id="configForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="label" class="form-label">Label</label>
                <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ old('label', $config->label) }}" placeholder="Enter configuration label">
                @error('label')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                    <option value="">Select type</option>
                    <option value="text" {{ old('type', $config->type) == 'text' ? 'selected' : '' }}>Text</option>
                    <option value="textarea" {{ old('type', $config->type) == 'textarea' ? 'selected' : '' }}>Textarea</option>
                    <option value="file" {{ old('type', $config->type) == 'file' ? 'selected' : '' }}>File</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <div id="content-container">
                    @if($config->type === 'textarea')
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" placeholder="Enter content">{{ old('content', $config->content) }}</textarea>
                    @elseif($config->type === 'file')
                        <input type="file" class="form-control @error('content') is-invalid @enderror" id="content" name="content" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.txt,.mp4">
                        @if($config->content)
                            <div class="mt-2 p-2 bg-light rounded">
                                <strong>Current file:</strong> 
                                <a href="{{ Storage::url($config->content) }}" target="_blank" class="text-decoration-none ms-2">
                                    <i class="bi bi-file-earmark me-1"></i>View File
                                </a>
                                <br>
                                <small class="text-muted">Upload a new file to replace the current one.</small>
                            </div>
                        @else
                            <div class="mt-2 text-muted small">
                                <i class="bi bi-info-circle me-1"></i>No file currently uploaded. Supported formats: JPG, PNG, GIF, WEBP, AVIF, PDF, DOC, DOCX, TXT, MP4. Max size: 10MB.
                            </div>
                        @endif
                    @else
                        <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" value="{{ old('content', $config->content) }}" placeholder="Enter content">
                    @endif
                </div>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description', $config->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Configuration
                </button>
                <a href="{{ route('configs.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </a>
            </div>
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
                    <strong>File:</strong> File upload for images, documents, or other files. The file path will be stored.
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
    const currentContent = '{{ old('content', $config->content) }}';

    function updateContentField() {
        const type = typeSelect.value;
        let newField;

        if (type === 'textarea') {
            newField = document.createElement('textarea');
            newField.className = 'form-control';
            newField.name = 'content';
            newField.rows = 5;
            newField.placeholder = 'Enter content';
            newField.value = currentContent;
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
            newField.value = currentContent;
        }

        contentContainer.innerHTML = '';
        contentContainer.appendChild(newField);
    }

    typeSelect.addEventListener('change', updateContentField);
});
</script>
@endpush