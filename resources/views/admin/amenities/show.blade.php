@extends('layouts.admin')

@section('title', 'View Amenity')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">{{ $amenity->name }}</h1>
                                <p class="text-muted mb-0">Amenity Details</p>
                            </div>
                            <div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('amenities.edit', $amenity) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('amenities.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Amenities
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenity Details -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Amenity Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <p class="mb-0">{{ $amenity->name }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Icon</label>
                                        <p class="mb-0">
                                            @if($amenity->icon)
                                                <i class="{{ $amenity->icon }} fs-4 me-2"></i>
                                                <code>{{ $amenity->icon }}</code>
                                            @else
                                                <i class="bi bi-star fs-4 me-2 text-muted"></i>
                                                <span class="text-muted">No icon set</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Sort Order</label>
                                        <p class="mb-0">
                                            <span class="badge bg-secondary">{{ $amenity->sort_order }}</span>
                                        </p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <p class="mb-0">
                                            @if($amenity->is_active)
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
                                        <p class="mb-0">{{ $amenity->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="mb-0">{{ $amenity->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('amenities.edit', $amenity) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit Amenity
                                    </a>
                                    
                                    <form method="POST" action="{{ route('amenities.destroy', $amenity) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this amenity? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-trash me-2"></i>Delete Amenity
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('amenities.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Amenities
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
