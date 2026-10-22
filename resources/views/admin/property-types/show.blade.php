@extends('layouts.admin')

@section('title', 'Property Type Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Type: {{ $propertyType->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-types.edit', $propertyType->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Type
        </a>
        <a href="{{ route('property-types.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Types
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Type Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p class="mb-0">{{ $propertyType->name }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <p class="mb-0"><code>{{ $propertyType->slug }}</code></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Heading</label>
                        <p class="mb-0">{{ $propertyType->heading ?: 'No heading set' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p class="mb-0">{{ $propertyType->description ?: 'No description set' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sort Order</label>
                        <p class="mb-0">
                            <span class="badge bg-info">{{ $propertyType->sort_order }}</span>
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="mb-0">
                            @if($propertyType->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Created</label>
                        <p class="mb-0">{{ $propertyType->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="mb-0">{{ $propertyType->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Information -->
        @if($propertyType->meta_title || $propertyType->meta_description)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">SEO Information</h5>
            </div>
            <div class="card-body">
                @if($propertyType->meta_title)
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Meta Title</label>
                        <p class="mb-0">{{ $propertyType->meta_title }}</p>
                    </div>
                </div>
                @endif

                @if($propertyType->meta_description)
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Meta Description</label>
                        <p class="mb-0">{{ $propertyType->meta_description }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('property-types.edit', $propertyType->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Type
                    </a>
                    <a href="{{ route('property-types.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Types
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Type Preview</h6>
            </div>
            <div class="card-body">
                <div class="type-preview">
                    <h5 class="mb-2">{{ $propertyType->name }}</h5>
                    <code class="small text-muted mb-2 d-block">{{ $propertyType->slug }}</code>
                    @if($propertyType->heading)
                        <p class="text-muted mb-2">{{ $propertyType->heading }}</p>
                    @endif
                    @if($propertyType->description)
                        <p class="small text-muted">{{ Str::limit($propertyType->description, 100) }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="mb-1 text-primary">{{ $propertyType->properties_count ?? 0 }}</h4>
                            <small class="text-muted">Properties</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="mb-1 text-success">{{ $propertyType->sort_order }}</h4>
                        <small class="text-muted">Sort Order</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection