@extends('layouts.admin')

@section('title', 'Property Condition Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Condition: {{ $propertyCondition->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-conditions.edit', $propertyCondition->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Condition
        </a>
        <a href="{{ route('property-conditions.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Conditions
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Condition Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p class="mb-0">{{ $propertyCondition->name }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <p class="mb-0"><code>{{ $propertyCondition->slug }}</code></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $propertyCondition->is_active ? 'success' : 'secondary' }}">
                                {{ $propertyCondition->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">URL</label>
                        <p class="mb-0">
                            <code class="small">/properties?condition={{ $propertyCondition->slug }}</code>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Created</label>
                        <p class="mb-0">{{ $propertyCondition->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="mb-0">{{ $propertyCondition->updated_at->format('M d, Y \a\t g:i A') }}</p>
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
                    <a href="{{ route('property-conditions.edit', $propertyCondition->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Condition
                    </a>
                    
                    <a href="{{ route('property-conditions.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Conditions
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Condition Preview</h6>
            </div>
            <div class="card-body">
                <div class="condition-preview text-center">
                    <h5 class="mb-2">{{ $propertyCondition->name }}</h5>
                    <code class="small text-muted">{{ $propertyCondition->slug }}</code>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Usage Information</h6>
            </div>
            <div class="card-body">
                <p class="small text-muted mb-2">
                    <strong>Filter Properties:</strong>
                </p>
                <code class="small d-block mb-3">
                    /properties?condition={{ $propertyCondition->slug }}
                </code>
                
                <p class="small text-muted mb-2">
                    <strong>API Usage:</strong>
                </p>
                <code class="small d-block">
                    PropertyCondition::where('slug', '{{ $propertyCondition->slug }}')->first()
                </code>
            </div>
        </div>
    </div>
</div>
@endsection
