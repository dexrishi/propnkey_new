@extends('layouts.admin')

@section('title', 'Testimonial Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Testimonial: {{ $testimonial->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Testimonial
        </a>
        <a href="{{ route('testimonials.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Testimonials
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Testimonial Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="text-center">
                            @if($testimonial->image)
                                <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" 
                                     class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
                            @else
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                     style="width: 120px; height: 120px; font-size: 2rem;">
                                    {{ $testimonial->initials }}
                                </div>
                            @endif
                            <h4 class="mb-1">{{ $testimonial->name }}</h4>
                            <p class="text-muted mb-0">{{ $testimonial->designation }}</p>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Testimonial Comment</h6>
                            <div class="border rounded p-3 bg-light">
                                <p class="mb-0 fst-italic">"{{ $testimonial->comment }}"</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-2">Sort Order</h6>
                                <span class="badge bg-secondary fs-6">{{ $testimonial->sort_order }}</span>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-2">Status</h6>
                                <span class="badge bg-{{ $testimonial->is_active ? 'success' : 'secondary' }} fs-6">
                                    {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-2">Created</h6>
                                <p class="mb-0">{{ $testimonial->created_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <h6 class="text-muted mb-2">Last Updated</h6>
                                <p class="mb-0">{{ $testimonial->updated_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
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
                    <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Testimonial
                    </a>
                    
                    <a href="{{ route('testimonials.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Testimonials
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Testimonial Preview</h6>
            </div>
            <div class="card-body">
                <div class="testimonial-preview text-center p-3 border rounded">
                    <div class="mb-3">
                        @if($testimonial->image)
                            <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" 
                                 class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                        @else
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 60px; height: 60px;">
                                {{ $testimonial->initials }}
                            </div>
                        @endif
                    </div>
                    <h6 class="mb-1">{{ $testimonial->name }}</h6>
                    <small class="text-muted mb-2 d-block">{{ $testimonial->designation }}</small>
                    <p class="fst-italic small mb-0">"{{ Str::limit($testimonial->comment, 100) }}"</p>
                </div>
            </div>
        </div>

        @if($testimonial->image)
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Image Information</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" 
                         class="img-fluid rounded mb-2" style="max-height: 200px;">
                    <p class="small text-muted mb-0">
                        <a href="{{ $testimonial->image_url }}" target="_blank" class="text-decoration-none">
                            <i class="bi bi-download me-1"></i>Download Image
                        </a>
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Usage Information</h6>
            </div>
            <div class="card-body">
                <p class="small text-muted mb-2">
                    <strong>Display on Website:</strong>
                </p>
                <code class="small d-block mb-3">
                    @foreach(Testimonial::active()->ordered()->get() as $t)
                        @if($t->id === $testimonial->id)
                            ✓ This testimonial will appear in position {{ $loop->iteration }}
                        @endif
                    @endforeach
                </code>
                
                <p class="small text-muted mb-2">
                    <strong>Total Active Testimonials:</strong>
                </p>
                <span class="badge bg-info">{{ Testimonial::active()->count() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
