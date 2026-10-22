@extends('layouts.admin')

@section('title', 'Property Category Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Category: {{ $propertyCategory->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-categories.edit', $propertyCategory->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Category
        </a>
        <a href="{{ route('property-categories.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Categories
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Category Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p class="mb-0">{{ $propertyCategory->name }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <p class="mb-0"><code>{{ $propertyCategory->slug }}</code></p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Heading</label>
                    <p class="mb-0">{{ $propertyCategory->heading ?: 'No heading provided' }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <div class="border rounded p-3 bg-light">
                        {!! $propertyCategory->description ?: '<em class="text-muted">No description provided</em>' !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $propertyCategory->is_active ? 'success' : 'secondary' }}">
                                {{ $propertyCategory->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Display Heading</label>
                        <p class="mb-0">{{ $propertyCategory->display_heading }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Created</label>
                        <p class="mb-0">{{ $propertyCategory->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="mb-0">{{ $propertyCategory->updated_at->format('M d, Y \a\t g:i A') }}</p>
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
                    <a href="{{ route('property-categories.edit', $propertyCategory->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Category
                    </a>
                    
                    <a href="{{ route('property-categories.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Categories
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Category Preview</h6>
            </div>
            <div class="card-body">
                <div class="category-preview">
                    <h4 class="mb-2">{{ $propertyCategory->display_heading }}</h4>
                    <h6 class="text-muted mb-3">{{ $propertyCategory->name }}</h6>
                    <p class="mb-0">{{ $propertyCategory->excerpt ?: 'No description available' }}</p>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Category Details</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <small class="text-muted">Word Count</small>
                        <div>{{ str_word_count(strip_tags($propertyCategory->description)) }}</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Character Count</small>
                        <div>{{ strlen(strip_tags($propertyCategory->description)) }}</div>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">URL Slug</small>
                    <div><code class="small">{{ $propertyCategory->slug }}</code></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
