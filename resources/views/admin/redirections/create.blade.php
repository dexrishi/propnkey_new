@extends('layouts.admin')

@section('title', 'Create Redirection')

@section('content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">Create New Redirection</h1>
                <p class="text-muted mb-0">Add a new URL redirection rule</p>
            </div>
            <div>
                <a href="{{ route('redirections.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Redirections
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
                <h5 class="card-title mb-0">Redirection Details</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('redirections.store') }}" id="redirectionForm">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="from_url" class="form-label">From URL <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('from_url') is-invalid @enderror" 
                               id="from_url" 
                               name="from_url" 
                               value="{{ old('from_url') }}" 
                               required 
                               autofocus
                               placeholder="/old-page or /old-page.html">
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle"></i> Enter the relative URL that should be redirected (e.g., /old-page, /products/old-product)
                        </small>
                        @error('from_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="to_url" class="form-label">To URL <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('to_url') is-invalid @enderror" 
                               id="to_url" 
                               name="to_url" 
                               value="{{ old('to_url') }}" 
                               required
                               placeholder="/new-page or https://example.com/page">
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle"></i> Enter the destination URL (relative like /new-page or full URL like https://example.com/page)
                        </small>
                        @error('to_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Redirect Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                                id="type" 
                                name="type" 
                                required>
                            <option value="301" {{ old('type', '301') == '301' ? 'selected' : '' }}>301 - Permanent Redirect</option>
                            <option value="302" {{ old('type') == '302' ? 'selected' : '' }}>302 - Temporary Redirect</option>
                        </select>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle"></i> 301 is for permanent moves (better for SEO), 302 is for temporary redirects
                        </small>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle"></i> Only active redirections will be processed
                        </small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Create Redirection
                        </button>
                        <a href="{{ route('redirections.index') }}" class="btn btn-outline-secondary">
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
                    <strong>From URL</strong>
                    <p class="small text-muted mb-1">The URL that visitors will try to access (e.g., /old-page). Must start with /</p>
                </div>
                <div class="mb-3">
                    <strong>To URL</strong>
                    <p class="small text-muted mb-1">The destination URL. Can be relative (/new-page) or full URL (https://example.com)</p>
                </div>
                <div class="mb-3">
                    <strong>Redirect Type</strong>
                    <p class="small text-muted mb-1"><strong>301:</strong> Permanent (SEO-friendly)<br><strong>302:</strong> Temporary</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

