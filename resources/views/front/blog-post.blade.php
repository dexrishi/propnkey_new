@extends('front.frontlayouts.frontapp')

@section('page-css')
<style>
/* Blog post spacing */

.blog-post-detail {
    background: #1a1a1a;
    border: 1px solid #333;
    border-radius: 4px;
    padding: 50px;
    margin-bottom: 40px;
    margin-top: 20px;
}

.blog-post-detail-header {
    margin-bottom: 40px;
    padding-bottom: 25px;
    border-bottom: 1px solid #333;
}

.blog-post-detail-category {
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

.blog-post-detail-title {
    font-size: 28px;
    font-weight: 600;
    color: #e0e0e0;
    margin-bottom: 20px;
    line-height: 1.3;
}

.blog-post-detail-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    color: #999;
    font-size: 14px;
}

.blog-post-detail-content {
    color: #b0b0b0;
    font-size: 16px;
    line-height: 1.8;
    margin-top: 30px;
}

.blog-post-detail-content h2,
.blog-post-detail-content h3,
.blog-post-detail-content h4 {
    color: #e0e0e0;
    margin-top: 30px;
    margin-bottom: 15px;
}

.blog-post-detail-content p {
    margin-bottom: 20px;
}

.blog-post-detail-content a {
    color: #a98862;
    text-decoration: none;
}

.blog-post-detail-content a:hover {
    text-decoration: underline;
}

.blog-author-card {
    margin-top: 36px;
    background: #f7f3ee;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(40, 24, 16, 0.08);
    padding: 22px 26px 20px;
    position: relative;
    overflow: hidden;
}

.blog-author-card::before {
    content: "";
    position: absolute;
    left: 0;
    top: 14px;
    bottom: 14px;
    width: 4px;
    border-radius: 0 4px 4px 0;
    background: #6e2430;
}

.blog-author-card-main {
    display: flex;
    align-items: center;
    gap: 16px;
}

.blog-author-photo {
    width: 74px;
    height: 74px;
    border-radius: 50%;
    object-fit: cover;
    flex: 0 0 74px;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(80, 40, 30, 0.12);
}

.blog-author-photo-fallback {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #6e2430;
    color: #fff;
    font-weight: 700;
    letter-spacing: 0.04em;
}

.blog-author-kicker {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6e2430;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 6px;
}

.blog-author-date {
    color: #8d867f;
    font-weight: 500;
    letter-spacing: 0;
    text-transform: none;
    font-size: 14px;
}

.blog-author-date i {
    margin-right: 4px;
}

.blog-author-dot {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: #c4b8ae;
    display: inline-block;
}

.blog-author-name-row {
    display: flex;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 8px;
}

.blog-author-name-row strong {
    color: #6e2430;
    font-family: "Libre Caslon Text", Georgia, serif;
    font-size: 28px;
    font-weight: 700;
    line-height: 1.15;
}

.blog-author-role {
    color: #8a9098;
    font-size: 16px;
}

.blog-author-bio {
    margin: 16px 0 0;
    color: #5f6d7b;
    font-size: 15px;
    line-height: 1.7;
}

.blog-author-more {
    display: inline-block;
    margin-top: 12px;
    padding: 0;
    border: 0;
    background: none;
    color: #6e2430;
    font-weight: 700;
    text-decoration: underline;
    text-underline-offset: 3px;
    cursor: pointer;
}

.blog-post-detail-content .table-responsive,
.blog-post-detail-content figure.table {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin: 25px 0;
}

.blog-post-detail-content table {
    width: 100% !important;
    max-width: 100%;
    border-collapse: collapse !important;
    border-spacing: 0;
    margin: 25px 0;
    background: #222;
    border: 1px solid #444;
    font-size: 15px;
    line-height: 1.5;
}

.blog-post-detail-content table th,
.blog-post-detail-content table td {
    padding: 12px 16px !important;
    border: 1px solid #444 !important;
    color: #d0d0d0;
    text-align: left;
    vertical-align: top;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.blog-post-detail-content table th {
    background: #2a2a2a !important;
    color: #e8e8e8 !important;
    font-weight: 600 !important;
    white-space: nowrap;
}

.blog-post-detail-content table thead th {
    background: #333 !important;
    color: #fff !important;
    border-bottom: 2px solid #a98862 !important;
}

.blog-post-detail-content table tbody tr:nth-child(even) td {
    background: #1f1f1f !important;
}

.blog-post-detail-content table tbody tr:hover td {
    background: #2c2c2c !important;
}

.blog-post-detail-content table td[style],
.blog-post-detail-content table th[style] {
    /* Keep TinyMCE inline widths but enforce readable cell spacing */
    min-width: 80px;
}

.blog-post-detail-content ul,
.blog-post-detail-content ol {
    margin-bottom: 20px;
    padding-left: 24px;
}

.blog-post-detail-content li {
    margin-bottom: 8px;
}

.blog-sidebar-card {
    background: #fff;
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

.blog-recent-post {
    padding: 15px 0;
    border-bottom: 1px solid #e5e5e5;
}

.blog-recent-post:last-child {
    border-bottom: none;
}

.blog-recent-post-title {
    font-size: 15px;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.blog-recent-post-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-recent-post-title a:hover {
    color: #a98862;
}

.blog-recent-post-date {
    color: #999;
    font-size: 13px;
}

.blog-related-card {
    background: #1a1a1a;
    border: 1px solid #333;
    border-radius: 4px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-related-card:hover {
    box-shadow: 0 5px 20px rgba(169, 134, 98, 0.2);
    transform: translateY(-5px);
    border-color: #a98862;
}

.blog-related-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 4px;
    display: block;
}

.blog-related-title {
    font-size: 18px;
    font-weight: 600;
    color: #e0e0e0;
    margin-bottom: 10px;
    line-height: 1.4;
}

.blog-related-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-related-title a:hover {
    color: #a98862;
}

.blog-related-excerpt {
    color: #b0b0b0;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 15px;
    flex-grow: 1;
}

.blog-related-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid #333;
    margin-top: auto;
}

.blog-related-date {
    color: #999;
    font-size: 12px;
}

.blog-related-link {
    color: #a98862;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.blog-related-link:hover {
    color: #8a6f4f;
    text-decoration: none;
}

.blog-related-section {
    margin-top: 50px;
    padding-top: 30px;
    border-top: 1px solid #333;
}

.blog-related-section-title {
    font-size: 28px;
    font-weight: 600;
    color: #e0e0e0;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #a98862;
}

.blog-post-featured-image {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
    border-radius: 4px;
    margin-bottom: 30px;
}

@media (max-width: 768px) {
    .blog-post-detail {
        padding: 25px;
    }
    
    .blog-post-detail-title {
        font-size: 22px;
    }
    
    
    .blog-post-detail-content {
        font-size: 15px;
    }

    .blog-post-detail-content table {
        font-size: 13px;
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .blog-post-detail-content table th,
    .blog-post-detail-content table td {
        padding: 10px 12px !important;
        min-width: 100px;
    }
    
    .blog-post-featured-image {
        max-height: 300px;
    }
    
    .sadjkk {
        padding-top: 80px !important;
    }
}
</style>
@endsection

@section('content')

<div class="sadjkk" style="padding-top: 120px;">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="blog-post-detail">
                    <div class="blog-post-detail-header">
                        @if($post->blogCategory)
                            <span class="blog-post-detail-category">{{ $post->blogCategory->name }}</span>
                        @endif
                        <h1 class="blog-post-detail-title">{{ $post->title }}</h1>
                        <div class="blog-post-detail-meta">
                            <span>
                                <i class="far fa-calendar-alt"></i>
                                @if($post->published_at)
                                    {{ $post->published_at->format('M d, Y') }}
                                @else
                                    {{ $post->created_at->format('M d, Y') }}
                                @endif
                            </span>
                            @if($post->reading_time)
                                <span>
                                    <i class="far fa-clock"></i>
                                    {{ $post->reading_time }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="blog-post-featured-image"
                             onerror="this.style.display='none'">
                    @endif
                    
                    <div class="blog-post-detail-content">
                        {!! $post->description !!}
                    </div>

                    @include('front.partials.blog-author')
                </div>

                @if($relatedPosts->count() > 0)
                    <div class="blog-related-section">
                        <h2 class="blog-related-section-title">Related Posts</h2>
                        <div class="row">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-md-4 mb-4">
                                    <div class="blog-related-card">
                                        @if($relatedPost->featured_image)
                                            <a href="/blog/{{ $relatedPost->slug }}">
                                                <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" 
                                                     alt="{{ $relatedPost->title }}" 
                                                     class="blog-related-image"
                                                     style="margin-bottom: 15px;"
                                                     onerror="this.style.display='none'">
                                            </a>
                                        @endif
                                        @if($relatedPost->blogCategory)
                                            <span class="blog-category-badge" style="margin-bottom: 10px;">{{ $relatedPost->blogCategory->name }}</span>
                                        @endif
                                        <h3 class="blog-related-title">
                                            <a href="/blog/{{ $relatedPost->slug }}">{{ $relatedPost->title }}</a>
                                        </h3>
                                        <p class="blog-related-excerpt">
                                            {{ Str::limit(strip_tags($relatedPost->description ?? ''), 100) }}
                                        </p>
                                        <div class="blog-related-meta">
                                            <span class="blog-related-date">
                                                @if($relatedPost->published_at)
                                                    {{ $relatedPost->published_at->format('M d, Y') }}
                                                @else
                                                    {{ $relatedPost->created_at->format('M d, Y') }}
                                                @endif
                                            </span>
                                            <a href="/blog/{{ $relatedPost->slug }}" class="blog-related-link">
                                                Read <i class="fal fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar-card">
                    <h3 class="blog-sidebar-title">Categories</h3>
                    @if($categories->count() > 0)
                        <ul class="blog-category-list">
                            <li>
                                <a href="{{ route('blog') }}">
                                    All Categories
                                </a>
                            </li>
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('blog.category', $cat->slug) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">No categories available.</p>
                    @endif
                </div>

                @if($recentPosts->count() > 0)
                    <div class="blog-sidebar-card">
                        <h3 class="blog-sidebar-title">Recent Posts</h3>
                        @foreach($recentPosts as $recentPost)
                            <div class="blog-recent-post">
                                <h4 class="blog-recent-post-title">
                                    <a href="/blog/{{ $recentPost->slug }}">{{ $recentPost->title }}</a>
                                </h4>
                                <div class="blog-recent-post-date">
                                    @if($recentPost->published_at)
                                        {{ $recentPost->published_at->format('M d, Y') }}
                                    @else
                                        {{ $recentPost->created_at->format('M d, Y') }}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="luxury">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="before_footer-paragraph">
                    <a href="/blog" style="color: #a98862; text-decoration: none; font-weight: 600;">
                        <i class="fal fa-arrow-left"></i> Back to Blog
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var more = document.getElementById('blog-author-more');
    var bio = document.getElementById('blog-author-bio');
    var full = document.getElementById('blog-author-bio-full');
    if (!more || !bio || !full) return;
    more.addEventListener('click', function () {
        bio.textContent = full.textContent;
        more.remove();
    });
});
</script>
@endsection

