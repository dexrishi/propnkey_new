@extends('layouts.admin')

@section('title', 'Edit Blog Author')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">Edit Blog Author</h1>
                <p class="text-muted mb-0">{{ $blogAuthor->name }}</p>
            </div>
            <a href="{{ route('blog-authors.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Authors
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Author Details</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('blog-authors.update', $blogAuthor) }}" enctype="multipart/form-data">
                    @include('admin.blog-authors._form', ['author' => $blogAuthor])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
