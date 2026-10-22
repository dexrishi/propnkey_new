@extends('layouts.admin')

@section('title', 'Configuration Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Configuration: {{ $config->label }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('configs.edit', $config->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Configuration
        </a>
        <a href="{{ route('configs.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Configurations
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Configuration Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Label</label>
                        <p class="mb-0">{{ $config->label }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Type</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $config->type === 'text' ? 'primary' : ($config->type === 'textarea' ? 'info' : 'warning') }}">
                                {{ ucfirst($config->type) }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Content</label>
                        <div class="mb-0">
                            @if($config->type === 'file')
                                @if($config->content)
                                    <a href="{{ Storage::url($config->content) }}" target="_blank" class="text-decoration-none">
                                        <i class="bi bi-file-earmark me-1"></i>View File
                                    </a>
                                @else
                                    <span class="text-muted">No file uploaded</span>
                                @endif
                            @else
                                <div class="border rounded p-3 bg-light">
                                    {{ $config->content ?: 'No content' }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if($config->description)
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p class="mb-0">{{ $config->description }}</p>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Created At</label>
                        <p class="mb-0">{{ $config->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="mb-0">{{ $config->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('configs.edit', $config->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Configuration
                    </a>
                    
                    <a href="{{ route('configs.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Configurations
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Usage Information</h6>
            </div>
            <div class="card-body">
                <p class="small text-muted mb-2">
                    <strong>PHP Usage:</strong>
                </p>
                <code class="small">config_get('{{ $config->label }}')</code>
                
                <p class="small text-muted mb-2 mt-3">
                    <strong>Blade Usage:</strong>
                </p>
                <code class="small">{{ '{{ config_get(\'' . $config->label . '\') }}' }}</code>
            </div>
        </div>
    </div>
</div>
@endsection