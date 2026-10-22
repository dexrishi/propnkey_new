@extends('layouts.admin')

@section('title', 'View Footer Category')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">{{ $footerCategory->name }}</h1>
                                <p class="text-muted mb-0">Footer Category Details</p>
                            </div>
                            <div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('footer-categories.edit', $footerCategory) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('footer-categories.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Footer Categories
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Category Details -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Footer Category Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <p class="mb-0">{{ $footerCategory->name }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Sort Order</label>
                                        <p class="mb-0">{{ $footerCategory->sort }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Created</label>
                                        <p class="mb-0">{{ $footerCategory->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="mb-0">{{ $footerCategory->updated_at->format('M d, Y \a\t g:i A') }}</p>
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
                                    <a href="{{ route('footer-categories.edit', $footerCategory) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit Footer Category
                                    </a>
                                    
                                    <form method="POST" action="{{ route('footer-categories.destroy', $footerCategory) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this footer category? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-trash me-2"></i>Delete Footer Category
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('footer-categories.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Footer Categories
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection

