@extends('layouts.admin')

@section('title', 'Blog Post Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Post: {{ $blogPost->title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('blog-posts.edit', $blogPost->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Post
        </a>
        <a href="{{ route('blog-posts.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Posts
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Post Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-bold">Title</label>
                        <p class="mb-0">{{ $blogPost->title }}</p>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <p class="mb-0">
                            <span class="badge bg-secondary">{{ $blogPost->blogCategory->name }}</span>
                        </p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Slug</label>
                    <p class="mb-0"><code>{{ $blogPost->slug }}</code></p>
                </div>

                @if($blogPost->featured_image)
                <div class="mb-3">
                    <label class="form-label fw-bold">Featured Image</label>
                    <div>
                        <img src="{{ asset('storage/' . $blogPost->featured_image) }}" 
                             alt="{{ $blogPost->title }}" 
                             class="img-fluid rounded" 
                             style="max-width: 100%; max-height: 400px;">
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label fw-bold">Content</label>
                    <div class="border rounded p-3 bg-light">
                        {!! $blogPost->description !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Meta Title</label>
                        <p class="mb-0">{{ $blogPost->meta_title ?: $blogPost->title }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Meta Description</label>
                        <p class="mb-0">{{ $blogPost->meta_description ?: 'Auto-generated from content' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $blogPost->is_active ? 'success' : 'secondary' }}">
                                {{ $blogPost->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Featured</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $blogPost->is_featured ? 'warning' : 'secondary' }}">
                                {{ $blogPost->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Reading Time</label>
                        <p class="mb-0">{{ $blogPost->reading_time }}</p>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Word Count</label>
                        <p class="mb-0">{{ str_word_count(strip_tags($blogPost->description)) }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Created</label>
                        <p class="mb-0">{{ $blogPost->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Updated</label>
                        <p class="mb-0">{{ $blogPost->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Written by</label>
                        <p class="mb-0">{{ $blogPost->blogAuthor->name ?? '—' }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Published</label>
                        <p class="mb-0">
                            @if($blogPost->published_at)
                                {{ $blogPost->published_at->format('M d, Y') }}
                            @else
                                <span class="text-muted">Not published</span>
                            @endif
                        </p>
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
                    <a href="{{ route('blog-posts.edit', $blogPost->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Post
                    </a>
                    
                    <a href="{{ route('blog-posts.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Posts
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Post Excerpt</h6>
            </div>
            <div class="card-body">
                <p class="small mb-0">{{ $blogPost->excerpt }}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Category Information</h6>
            </div>
            <div class="card-body">
                <h6 class="mb-1">{{ $blogPost->blogCategory->name }}</h6>
                <p class="small text-muted mb-2">{{ Str::limit(strip_tags($blogPost->blogCategory->description), 100) }}</p>
                <a href="{{ route('blog-categories.show', $blogPost->blogCategory) }}" class="btn btn-sm btn-outline-primary">
                    View Category
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
