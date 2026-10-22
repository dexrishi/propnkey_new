@extends('front.frontlayouts.frontapp')

@section('content')
<div class="container py-5" style="margin-top: 80px;">
    <div class="row">
        <div class="col-lg-12">
            <!-- Page Title -->
            <div class="mb-4">
                <h1 class="display-4 mb-3">{{ $staticPage->name }}</h1>
            </div>

            <!-- Page Content -->
            <div class="static-page-content">
                {!! $staticPage->content !!}
            </div>
        </div>
    </div>
</div>

@push('page-css')
<style>
    .static-page-content {
        line-height: 1.8;
        color: #333;
    }

    .static-page-content h1,
    .static-page-content h2,
    .static-page-content h3,
    .static-page-content h4,
    .static-page-content h5,
    .static-page-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .static-page-content h1 {
        font-size: 2.5rem;
        border-bottom: 2px solid #a98862;
        padding-bottom: 0.5rem;
    }

    .static-page-content h2 {
        font-size: 2rem;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 0.5rem;
    }

    .static-page-content h3 {
        font-size: 1.5rem;
    }

    .static-page-content p {
        margin-bottom: 1.5rem;
    }

    .static-page-content ul,
    .static-page-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    .static-page-content li {
        margin-bottom: 0.5rem;
    }

    .static-page-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .static-page-content blockquote {
        border-left: 4px solid #a98862;
        padding-left: 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #666;
    }

    .static-page-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
    }

    .static-page-content table th,
    .static-page-content table td {
        padding: 0.75rem;
        border: 1px solid #ddd;
        text-align: left;
    }

    .static-page-content table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .static-page-content a {
        color: #a98862;
        text-decoration: none;
    }

    .static-page-content a:hover {
        color: #8a6d4f;
        text-decoration: underline;
    }

    .static-page-content code {
        background-color: #f4f4f4;
        padding: 0.2rem 0.4rem;
        border-radius: 3px;
        font-family: 'Courier New', monospace;
        font-size: 0.9em;
    }

    .static-page-content pre {
        background-color: #f4f4f4;
        padding: 1rem;
        border-radius: 5px;
        overflow-x: auto;
        margin: 1.5rem 0;
    }

    .static-page-content pre code {
        background-color: transparent;
        padding: 0;
    }
</style>
@endpush

@push('page-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Find all links within the static page content
    const staticPageContent = document.querySelector('.static-page-content');
    if (staticPageContent) {
        const links = staticPageContent.querySelectorAll('a');
        links.forEach(function(link) {
            // Only add target="_blank" if it's an external link or doesn't already have a target
            if (!link.hasAttribute('target')) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
            }
        });
    }
});
</script>
@endpush

@endsection

