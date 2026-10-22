@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Blog Posts</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('blog-posts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Post
        </a>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-3">
    <div class="col-md-4">
        <form method="GET" action="{{ route('blog-posts.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search posts..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('blog-posts.index') }}" class="btn btn-outline-danger ms-2">
                    <i class="bi bi-x"></i>
                </a>
            @endif
        </form>
    </div>
    <div class="col-md-3">
        <select name="category" class="form-select" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <div class="col-md-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="featured" value="1" 
                   {{ request('featured') ? 'checked' : '' }} onchange="this.form.submit()">
            <label class="form-check-label">Featured Only</label>
        </div>
    </div>
</div>

<!-- Posts Table -->
<div class="card">
    <div class="card-body">
        @if($posts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Excerpt</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Published</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    @if($post->featured_image)
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                             alt="{{ $post->title }}" 
                                             class="img-thumbnail" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $post->title }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $post->slug }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $post->blogCategory->name }}</span>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ strip_tags($post->excerpt) }}">
                                        {{ $post->excerpt }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="{{ $post->id }}" 
                                               {{ $post->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input featured-toggle" type="checkbox" 
                                               data-id="{{ $post->id }}" 
                                               {{ $post->is_featured ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    @if($post->published_at)
                                        <small class="text-muted">{{ $post->published_at->format('M d, Y') }}</small>
                                    @else
                                        <span class="text-muted">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('blog-posts.show', $post) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('blog-posts.edit', $post) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('blog-posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-file-text display-1 text-muted"></i>
                <h3 class="mt-3">No Blog Posts Found</h3>
                <p class="text-muted">Get started by adding your first blog post.</p>
                <a href="{{ route('blog-posts.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Post
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle functionality
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const postId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/blog-posts/${postId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_active: isActive })
            })
            .then(response => response.json())
            .then(data => {
                if (data.is_active !== isActive) {
                    this.checked = data.is_active;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isActive; // Revert on error
            });
        });
    });

    // Featured toggle functionality
    document.querySelectorAll('.featured-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const postId = this.dataset.id;
            const isFeatured = this.checked;
            
            fetch(`/blog-posts/${postId}/toggle-featured`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_featured: isFeatured })
            })
            .then(response => response.json())
            .then(data => {
                if (data.is_featured !== isFeatured) {
                    this.checked = data.is_featured;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isFeatured; // Revert on error
            });
        });
    });
});
</script>
@endpush
