@extends('layouts.admin')

@section('title', 'View Slug')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">{{ $slugList->headline ?: $slugList->slug }}</h1>
                                <p class="text-muted mb-0">Slug Details</p>
                            </div>
                            <div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('slug-list.edit', $slugList) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('slug-lists.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Slug List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slug Details -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Slug Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Slug</label>
                                        <p class="mb-0"><code>{{ $slugList->formatted_slug }}</code></p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <p class="mb-0">
                                            @if($slugList->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if($slugList->meta_title)
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Meta Title</label>
                                        <p class="mb-0">{{ $slugList->meta_title }}</p>
                                    </div>
                                @endif

                                @if($slugList->meta_desc)
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Meta Description</label>
                                        <p class="mb-0">{{ $slugList->meta_desc }}</p>
                                    </div>
                                @endif

                                @if($slugList->headline)
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Headline</label>
                                        <p class="mb-0">{{ $slugList->headline }}</p>
                                    </div>
                                @endif
                                
                                @if($slugList->heading_2)
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Heading 2</label>
                                        <p class="mb-0">{{ $slugList->heading_2 }}</p>
                                    </div>
                                @endif
                                
                                @if($slugList->bottom_headline)
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Bottom Headline</label>
                                        <p class="mb-0">{{ $slugList->bottom_headline }}</p>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Created</label>
                                        <p class="mb-0">{{ $slugList->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="mb-0">{{ $slugList->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($slugList->description)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Description Preview</h5>
                                </div>
                                <div class="card-body">
                                    <div class="content-preview">
                                        {!! $slugList->description !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        @if($slugList->bottom_description)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Bottom Description Preview</h5>
                                </div>
                                <div class="card-body">
                                    <div class="content-preview">
                                        {!! $slugList->bottom_description !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($slugList->faq_items))
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">FAQ Preview</h5>
                                </div>
                                <div class="card-body">
                                    @foreach($slugList->faq_items as $faqItem)
                                        @if(!empty($faqItem['question'] ?? null) && !empty($faqItem['answer'] ?? null))
                                            <div class="border rounded p-3 {{ $loop->last ? '' : 'mb-3' }}">
                                                <div class="fw-semibold mb-2">{{ $faqItem['question'] }}</div>
                                                <div class="text-muted mb-0">{!! nl2br(e($faqItem['answer'])) !!}</div>
                                            </div>
                                        @endif
                                    @endforeach
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
                                    <a href="{{ route('slug-lists.edit', $slugList) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit Slug
                                    </a>
                                    
                                    <form method="POST" action="{{ route('slug-lists.destroy', $slugList) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this slug? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-trash me-2"></i>Delete Slug
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('slug-lists.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Slug List
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Preview -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">SEO Preview</h6>
                            </div>
                            <div class="card-body">
                                <div class="seo-preview">
                                    <div class="seo-title">
                                        {{ $slugList->meta_title ?: $slugList->headline ?: $slugList->slug }}
                                    </div>
                                    <div class="seo-url">
                                        {{ url($slugList->formatted_slug) }}
                                    </div>
                                    <div class="seo-description">
                                        {{ $slugList->meta_desc ?: $slugList->excerpt }}
                                    </div>
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

.seo-preview {
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    padding: 12px;
    background: #fff;
}

.seo-title {
    color: #1a0dab;
    font-size: 18px;
    line-height: 1.2;
    margin-bottom: 3px;
    text-decoration: none;
    cursor: pointer;
}

.seo-title:hover {
    text-decoration: underline;
}

.seo-url {
    color: #006621;
    font-size: 14px;
    line-height: 1.2;
    margin-bottom: 3px;
}

.seo-description {
    color: #545454;
    font-size: 14px;
    line-height: 1.4;
}
</style>
@endpush
@endsection
