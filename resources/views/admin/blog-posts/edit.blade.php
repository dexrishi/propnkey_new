@extends('layouts.admin')

@section('title', 'Edit Blog Post')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post: {{ $blogPost->title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('blog-posts.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Posts
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('blog-posts.update', $blogPost->id) }}" method="POST" id="postForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Post Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                               id="featured_image" name="featured_image" 
                               accept="image/*" onchange="previewImage(this)">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Recommended size: 1200x630px. Max file size: 2MB. Leave empty to keep current image.</div>
                        @if($blogPost->featured_image)
                            <div class="mt-2">
                                <label class="form-label">Current Featured Image:</label>
                                <div>
                                    <img src="{{ asset('storage/' . $blogPost->featured_image) }}" 
                                         alt="Current featured image" 
                                         class="img-thumbnail" 
                                         style="max-width: 300px; max-height: 200px;">
                                </div>
                            </div>
                        @endif
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <label class="form-label">New Image Preview:</label>
                            <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $blogPost->title) }}" 
                                   placeholder="Enter post title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="blog_category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            @if(auth()->user()?->isSeo())
                                <input type="text" class="form-control bg-light" readonly
                                       value="{{ $blogPost->blogCategory->name ?? '—' }}">
                            @else
                                <select class="form-select @error('blog_category_id') is-invalid @enderror" 
                                        id="blog_category_id" name="blog_category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('blog_category_id', $blogPost->blog_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            @error('blog_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="blog_author_id" class="form-label">Written by</label>
                        <select class="form-select @error('blog_author_id') is-invalid @enderror"
                                id="blog_author_id" name="blog_author_id">
                            <option value="">No author</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ (string) old('blog_author_id', $blogPost->blog_author_id) === (string) $author->id ? 'selected' : '' }}>
                                    {{ $author->name }} — {{ $author->designation }}
                                </option>
                            @endforeach
                        </select>
                        @error('blog_author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug', $blogPost->slug) }}" 
                               placeholder="post-slug">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Edit manually if needed. Leave empty to auto-generate from title.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="10">{{ old('description', $blogPost->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Write your blog post content here</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                   id="meta_title" name="meta_title" value="{{ old('meta_title', $blogPost->meta_title) }}" 
                                   placeholder="SEO title for search engines" maxlength="255">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Recommended: 50-60 characters</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="date" class="form-control @error('published_at') is-invalid @enderror" 
                                   id="published_at" name="published_at" 
                                   value="{{ old('published_at', $blogPost->published_at ? $blogPost->published_at->format('Y-m-d') : '') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to publish immediately</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                  id="meta_description" name="meta_description" rows="3" 
                                  placeholder="SEO description for search engines" maxlength="500">{{ old('meta_description', $blogPost->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Recommended: 150-160 characters</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                       {{ old('is_active', $blogPost->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active (visible on website)
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" 
                                       {{ old('is_featured', $blogPost->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Featured Post
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Post
                </button>
                <a href="{{ route('blog-posts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Post Stats</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <small class="text-muted">Reading Time</small>
                        <div class="h6 mb-0">{{ $blogPost->reading_time }}</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Word Count</small>
                        <div class="h6 mb-0">{{ str_word_count(strip_tags($blogPost->description)) }}</div>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Created</small>
                    <div>{{ $blogPost->created_at->format('M d, Y') }}</div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Updated</small>
                    <div>{{ $blogPost->updated_at->format('M d, Y') }}</div>
                </div>
                @if($blogPost->published_at)
                <div class="mt-2">
                    <small class="text-muted">Published</small>
                    <div>{{ $blogPost->published_at->format('M d, Y') }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor
    let editorInstance = null;
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
            editorInstance = editor;
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });

    // Ensure CKEditor content is synced before form submission
    const postForm = document.getElementById('postForm');
    if (postForm) {
        postForm.addEventListener('submit', function(e) {
            if (editorInstance) {
                // Update the textarea with CKEditor content
                editorInstance.updateSourceElement();
            }
        });
    }

    // Image preview function
    window.previewImage = function(input) {
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            };
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
});
</script>
@endpush
