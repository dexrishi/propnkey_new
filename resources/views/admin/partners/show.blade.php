@extends('layouts.admin')

@section('title', 'View Partner')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">{{ $partner->name }}</h1>
                                <p class="text-muted mb-0">Partner Details</p>
                            </div>
                            <div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('partners.edit', $partner) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('partners.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Partners
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Partner Details -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Partner Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <p class="mb-0">{{ $partner->name }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Slug</label>
                                        <p class="mb-0"><code>{{ $partner->slug }}</code></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Sort Order</label>
                                        <p class="mb-0">
                                            <span class="badge bg-secondary">{{ $partner->sort_order }}</span>
                                        </p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <p class="mb-0">
                                            @if($partner->is_active)
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
                                        <p class="mb-0">{{ $partner->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="mb-0">{{ $partner->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image and Actions -->
                    <div class="col-lg-4">
                        @if($partner->image)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Partner Logo</h6>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ $partner->image_url }}" alt="{{ $partner->name }}" 
                                         class="img-fluid rounded mb-3" style="max-height: 200px;">
                                    <div>
                                        <a href="{{ $partner->image_url }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye me-1"></i>View Full Size
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('partners.edit', $partner) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit Partner
                                    </a>
                                    
                                    <form method="POST" action="{{ route('partners.destroy', $partner) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this partner? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-trash me-2"></i>Delete Partner
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('partners.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Partners
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
