@extends('layouts.admin')

@section('title', 'Create Footer Category')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Create New Footer Category</h1>
                                <p class="text-muted mb-0">Add a new footer category</p>
                            </div>
                            <div>
                                <a href="{{ route('footer-categories.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Footer Categories
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
                                <h5 class="card-title mb-0">Footer Category Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('footer-categories.store') }}" id="footerCategoryForm">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               required 
                                               autofocus
                                               placeholder="e.g., Company">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="sort" class="form-label">Sort Order</label>
                                        <input type="number" 
                                               class="form-control @error('sort') is-invalid @enderror" 
                                               id="sort" 
                                               name="sort" 
                                               value="{{ old('sort', 0) }}" 
                                               min="0"
                                               placeholder="e.g., 1">
                                        @error('sort')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Lower numbers appear first. Default is 0.</div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Create Footer Category
                                        </button>
                                        <a href="{{ route('footer-categories.index') }}" class="btn btn-outline-secondary">
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
                                    <p class="small text-muted mb-1">Name of the footer category (e.g., Company, Resources, Services)</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Sort Order</strong>
                                    <p class="small text-muted mb-1">Numeric value to control display order. Lower numbers appear first.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

