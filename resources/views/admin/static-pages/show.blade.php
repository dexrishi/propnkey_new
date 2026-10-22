@extends('layouts.admin')

@section('title', 'View Static Page')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">{{ $staticPage->name }}</h1>
                                <p class="text-muted mb-0">Static Page Details</p>
                            </div>
                            <div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('static-pages.edit', $staticPage) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('static-pages.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Static Pages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Static Page Details -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Static Page Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <p class="mb-0">{{ $staticPage->name }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Slug</label>
                                        <p class="mb-0"><code>{{ $staticPage->slug }}</code></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Created</label>
                                        <p class="mb-0">{{ $staticPage->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="mb-0">{{ $staticPage->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($staticPage->content)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Content Preview</h5>
                                </div>
                                <div class="card-body">
                                    <div class="content-preview">
                                        {!! $staticPage->content !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('static-pages.edit', $staticPage) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit Static Page
                                    </a>
                                    
                                    <form method="POST" action="{{ route('static-pages.destroy', $staticPage) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this static page? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-trash me-2"></i>Delete Static Page
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('static-pages.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Static Pages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.content-preview {
    max-height: 500px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 1rem;
    background-color: #f8f9fa;
}

.content-preview h1,
.content-preview h2,
.content-preview h3,
.content-preview h4,
.content-preview h5,
.content-preview h6 {
    margin-top: 1rem;
    margin-bottom: 0.5rem;
}

.content-preview p {
    margin-bottom: 1rem;
}

.content-preview ul,
.content-preview ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.content-preview blockquote {
    border-left: 4px solid #dee2e6;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    color: #6c757d;
}

.content-preview table {
    width: 100%;
    margin-bottom: 1rem;
    border-collapse: collapse;
}

.content-preview table th,
.content-preview table td {
    padding: 0.5rem;
    border: 1px solid #dee2e6;
}

.content-preview table th {
    background-color: #f8f9fa;
    font-weight: bold;
}
</style>
@endpush
@endsection

