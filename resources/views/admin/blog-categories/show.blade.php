@extends('layouts.admin')

@section('title', 'Blog Category Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Category: {{ $blogCategory->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('blog-categories.edit', $blogCategory->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Category
        </a>
        <a href="{{ route('blog-categories.index') }}" class="btn btn-sm btn-secondary">
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
                        <p class="mb-0">{{ $blogCategory->name }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <p class="mb-0"><code>{{ $blogCategory->slug }}</code></p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <div class="border rounded p-3 bg-light">
                        {!! $blogCategory->description ?: '<em class="text-muted">No description provided</em>' !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Meta Title</label>
                        <p class="mb-0">{{ $blogCategory->meta_title ?: $blogCategory->name }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Meta Description</label>
                        <p class="mb-0">{{ $blogCategory->meta_description ?: 'Auto-generated from description' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $blogCategory->is_active ? 'success' : 'secondary' }}">
                                {{ $blogCategory->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Posts Count</label>
                        <p class="mb-0">
                            <span class="badge bg-info">{{ $blogCategory->blogPosts()->count() }}</span>
                            <small class="text-muted">({{ $blogCategory->activeBlogPosts()->count() }} active)</small>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Created</label>
                        <p class="mb-0">{{ $blogCategory->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="mb-0">{{ $blogCategory->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($blogCategory->blogPosts()->count() > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Posts in This Category</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogCategory->blogPosts()->latest()->limit(5)->get() as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <span class="badge bg-{{ $post->is_active ? 'success' : 'secondary' }}">
                                            {{ $post->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('blog-posts.show', $post) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($blogCategory->blogPosts()->count() > 5)
                    <div class="text-center mt-3">
                        <a href="{{ route('blog-posts.index', ['category' => $blogCategory->id]) }}" class="btn btn-sm btn-outline-primary">
                            View All Posts in This Category
                        </a>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('blog-categories.edit', $blogCategory->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Category
                    </a>
                    
                    <a href="{{ route('blog-posts.create', ['category' => $blogCategory->id]) }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add Post to This Category
                    </a>
                    
                    <a href="{{ route('blog-categories.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Categories
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">SEO Preview</h6>
            </div>
            <div class="card-body">
                <div class="seo-preview">
                    <h6 class="text-primary mb-1">{{ $blogCategory->meta_title ?: $blogCategory->name }}</h6>
                    <small class="text-success mb-2 d-block">yoursite.com/blog/category/{{ $blogCategory->slug }}</small>
                    <p class="text-muted small mb-0">{{ $blogCategory->meta_description ?: Str::limit(strip_tags($blogCategory->description), 160) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
