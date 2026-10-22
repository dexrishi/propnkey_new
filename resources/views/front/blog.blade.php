@extends('front.frontlayouts.frontapp')

@section('page-css')
<style>
.blog-post-card {
    background: #1a1a1a;
    border: 1px solid #333;
    border-radius: 4px;
    padding: 30px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-post-card:hover {
    box-shadow: 0 5px 20px rgba(169, 134, 98, 0.2);
    transform: translateY(-5px);
    border-color: #a98862;
}

.blog-post-card.featured {
    border-color: #a98862;
    background: linear-gradient(135deg, rgba(169, 134, 98, 0.1) 0%, rgba(169, 134, 98, 0.05) 100%);
}

.blog-category-badge {
    display: inline-block;
    background: #a98862;
    color: #fff;
    padding: 6px 14px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 15px;
    letter-spacing: 0.5px;
}

.blog-post-title {
    font-size: 24px;
    font-weight: 600;
    color: #e0e0e0;
    margin-bottom: 15px;
    line-height: 1.4;
}

.blog-post-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-post-title a:hover {
    color: #a98862;
}

.blog-post-excerpt {
    color: #b0b0b0;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 20px;
    flex-grow: 1;
}

.blog-post-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #333;
    margin-top: auto;
}

.blog-post-date {
    color: #999;
    font-size: 13px;
}

.blog-read-more {
    color: #a98862;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.blog-read-more:hover {
    color: #8a6f4f;
    text-decoration: none;
}

.blog-read-more i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.blog-read-more:hover i {
    transform: translateX(5px);
}

.blog-sidebar {
    background: #f9f9f9;
    border: 1px solid #e5e5e5;
    border-radius: 4px;
    padding: 30px;
    margin-bottom: 30px;
}

.blog-sidebar-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #a98862;
}

.blog-category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.blog-category-list li {
    margin-bottom: 12px;
}

.blog-category-list a {
    color: #666;
    text-decoration: none;
    font-size: 15px;
    transition: all 0.3s ease;
    display: block;
    padding: 8px 0;
    border-bottom: 1px solid transparent;
}

.blog-category-list a:hover,
.blog-category-list a.active {
    color: #a98862;
    padding-left: 10px;
    border-bottom-color: #a98862;
}

.blog-section-title {
    font-size: 32px;
    font-weight: 600;
    color: #e0e0e0;
    margin-bottom: 40px;
    padding-bottom: 15px;
    border-bottom: 2px solid #a98862;
}

.blog-empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #b0b0b0;
}

.blog-empty-state i {
    font-size: 48px;
    margin-bottom: 20px;
    color: #ddd;
}

.blog-pagination-wrapper {
    margin-top: 50px;
    padding-top: 30px;
    border-top: 1px solid #333;
}

.blog-pagination-wrapper .pagination {
    justify-content: center;
}

.blog-pagination-wrapper .page-link {
    color: #a98862;
    border-color: #e5e5e5;
    padding: 10px 15px;
}

.blog-pagination-wrapper .page-link:hover {
    background-color: #a98862;
    border-color: #a98862;
    color: #fff;
}

.blog-pagination-wrapper .page-item.active .page-link {
    background-color: #a98862;
    border-color: #a98862;
}

.blog-category-description {
    color: #fff;
    font-size: 1rem;
    line-height: 1.6;
    margin-top: 20px;
    text-align: center;
}

.blog-category-description p {
    margin-bottom: 15px;
}

/* Featured Image Styles */
.blog-post-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 4px;
    margin-bottom: 20px;
}

.blog-post-card.list-view {
    flex-direction: row;
    padding: 20px;
}

.blog-post-card.list-view .blog-post-image-wrapper {
    width: 300px;
    min-width: 300px;
    margin-right: 20px;
    margin-bottom: 0;
}

.blog-post-card.list-view .blog-post-image {
    height: 200px;
    margin-bottom: 0;
}

.blog-post-card.list-view .blog-post-content {
    flex: 1;
}

/* View Toggle Buttons */
.blog-view-toggle {
    display: flex;
    gap: 10px;
    margin-bottom: 30px;
    justify-content: flex-end;
}

.blog-view-toggle button {
    background: #1a1a1a;
    border: 1px solid #333;
    color: #b0b0b0;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.blog-view-toggle button:hover,
.blog-view-toggle button.active {
    background: #a98862;
    border-color: #a98862;
    color: #fff;
}

/* List View Styles */
.blog-posts-list-view .blog-post-card {
    flex-direction: row;
    align-items: flex-start;
}

.blog-posts-list-view .blog-post-image-wrapper {
    width: 300px;
    min-width: 300px;
    margin-right: 20px;
    margin-bottom: 0;
}

.blog-posts-list-view .blog-post-image {
    height: 200px;
    margin-bottom: 0;
}

.blog-posts-list-view .blog-post-content {
    flex: 1;
}

.blog-posts-list-view .col-md-6 {
    flex: 0 0 100%;
    max-width: 100%;
}

@media (max-width: 768px) {
    .blog-post-card {
        padding: 20px;
    }
    
    .blog-post-title {
        font-size: 20px;
    }
    
    .blog-section-title {
        font-size: 24px;
    }
    
    .blog-post-card.list-view,
    .blog-posts-list-view .blog-post-card {
        flex-direction: column;
    }
    
    .blog-post-card.list-view .blog-post-image-wrapper,
    .blog-posts-list-view .blog-post-image-wrapper {
        width: 100%;
        min-width: 100%;
        margin-right: 0;
        margin-bottom: 20px;
    }
    
    .blog-view-toggle {
        justify-content: center;
    }
}
</style>
@endsection

@section('content')

<div class="services_cta_component" 
     @if(isset($category) && $category->featured_image)
         style="background-image: url('{{ asset('storage/' . $category->featured_image) }}'); background-size: cover; background-position: center;"
     @endif>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page_header-heading">
                    @if(isset($category))
                        {{ $category->name }}
                    @else
                        Blog
                    @endif
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="blog-category-description">
                    @if(isset($category))
                        {!! $category->description ?: 'Browse all blog posts in ' . $category->name . ' category.' !!}
                    @else
                        Read our latest blog posts about real estate, property tips, market insights, and more.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sadjkk" style="background: #0d0d11;">
    <div class="container">
        <div class="row align-items-start">
            <!-- Main Content -->
            <div class="col-lg-8">
                @if(isset($featuredPosts) && $featuredPosts->count() > 0)
                    <div class="mb-5">
                        <h2 class="blog-section-title">Featured Posts</h2>
                        <div class="row">
                            @foreach($featuredPosts as $post)
                                <div class="col-md-6 mb-4">
                                    <div class="blog-post-card featured">
                                        <div class="blog-post-image-wrapper">
                                            @if($post->featured_image)
                                                <a href="/blog/{{ $post->slug }}">
                                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                         alt="{{ $post->title }}" 
                                                         class="blog-post-image"
                                                         onerror="this.src='{{ asset('/frontassets/images/placeholder.jpg') }}'">
                                                </a>
                                            @else
                                                <a href="/blog/{{ $post->slug }}">
                                                    <img src="{{ asset('/frontassets/images/placeholder.jpg') }}" 
                                                         alt="{{ $post->title }}" 
                                                         class="blog-post-image">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="blog-post-content">
                                            @if($post->blogCategory)
                                                <span class="blog-category-badge">{{ $post->blogCategory->name }}</span>
                                            @endif
                                            <h3 class="blog-post-title">
                                                <a href="/blog/{{ $post->slug }}">{{ $post->title }}</a>
                                            </h3>
                                            <p class="blog-post-excerpt">
                                                {{ Str::limit(strip_tags($post->description ?? ''), 120) }}
                                            </p>
                                            <div class="blog-post-meta">
                                                <span class="blog-post-date">
                                                    <i class="far fa-calendar-alt"></i>
                                                    @if($post->published_at)
                                                        {{ $post->published_at->format('M d, Y') }}
                                                    @else
                                                        {{ $post->created_at->format('M d, Y') }}
                                                    @endif
                                                </span>
                                                <a href="/blog/{{ $post->slug }}" class="blog-read-more">
                                                    Read More <i class="fal fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="blog-section-title mb-0">All Posts</h2>
                    <div class="blog-view-toggle">
                        <button type="button" class="view-toggle-btn active" data-view="grid" title="Grid View">
                            <i class="fa fa-th"></i>
                        </button>
                        <button type="button" class="view-toggle-btn" data-view="list" title="List View">
                            <i class="fa fa-list"></i>
                        </button>
                    </div>
                </div>
                
                @if($posts->count() > 0)
                    <div class="row blog-posts-container">
                        @foreach($posts as $post)
                            <div class="col-md-6 mb-4">
                                <div class="blog-post-card">
                                    <div class="blog-post-image-wrapper">
                                        @if($post->featured_image)
                                            <a href="/blog/{{ $post->slug }}">
                                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                     alt="{{ $post->title }}" 
                                                     class="blog-post-image"
                                                     onerror="this.src='{{ asset('/frontassets/images/placeholder.jpg') }}'">
                                            </a>
                                        @else
                                            <a href="/blog/{{ $post->slug }}">
                                                <img src="{{ asset('/frontassets/images/placeholder.jpg') }}" 
                                                     alt="{{ $post->title }}" 
                                                     class="blog-post-image">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="blog-post-content">
                                        @if($post->blogCategory)
                                            <span class="blog-category-badge">{{ $post->blogCategory->name }}</span>
                                        @endif
                                        <h3 class="blog-post-title">
                                            <a href="/blog/{{ $post->slug }}">{{ $post->title }}</a>
                                        </h3>
                                        <p class="blog-post-excerpt">
                                            {{ Str::limit(strip_tags($post->description ?? ''), 150) }}
                                        </p>
                                        <div class="blog-post-meta">
                                            <span class="blog-post-date">
                                                <i class="far fa-calendar-alt"></i>
                                                @if($post->published_at)
                                                    {{ $post->published_at->format('M d, Y') }}
                                                @else
                                                    {{ $post->created_at->format('M d, Y') }}
                                                @endif
                                            </span>
                                            <a href="/blog/{{ $post->slug }}" class="blog-read-more">
                                                Read More <i class="fal fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="blog-pagination-wrapper">
                        {{ $posts->links('pagination.bootstrap-4') }}
                    </div>
                @else
                    <div class="blog-empty-state">
                        <i class="far fa-file-alt"></i>
                        <h3>No Blog Posts Available</h3>
                        <p>Please check back later for our latest blog posts.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <h3 class="blog-sidebar-title">Categories</h3>
                    @if($categories->count() > 0)
                        <ul class="blog-category-list">
                            <li>
                                <a href="{{ route('blog') }}" class="{{ !isset($category) && !request('category') ? 'active' : '' }}">
                                    All Categories
                                </a>
                            </li>
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('blog.category', $cat->slug) }}" 
                                       class="{{ (isset($category) && $category->id == $cat->id) || request('category') == $cat->slug ? 'active' : '' }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">No categories available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="luxury">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="before_footer-paragraph">
                    Stay informed with our latest insights, tips, and updates about the real estate market. 
                    <strong class="bold-text-2">Our blog covers everything from property investment strategies to market trends</strong>, 
                    helping you make informed decisions about your real estate journey.
                    <br>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewToggleButtons = document.querySelectorAll('.view-toggle-btn');
    const postsContainer = document.querySelector('.blog-posts-container');
    const savedView = localStorage.getItem('blogView') || 'grid';
    
    // Set initial view
    setView(savedView);
    
    viewToggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.dataset.view;
            setView(view);
            localStorage.setItem('blogView', view);
        });
    });
    
    function setView(view) {
        // Update active button
        viewToggleButtons.forEach(btn => {
            if (btn.dataset.view === view) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
        
        // Update container class
        if (view === 'list') {
            postsContainer.classList.add('blog-posts-list-view');
        } else {
            postsContainer.classList.remove('blog-posts-list-view');
        }
    }
});
</script>
@endsection
