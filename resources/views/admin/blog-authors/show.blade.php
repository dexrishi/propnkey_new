@extends('layouts.admin')

@section('title', $blogAuthor->name)

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $blogAuthor->name }}</h1>
    <a href="{{ route('blog-authors.edit', $blogAuthor) }}" class="btn btn-warning btn-sm">Edit</a>
</div>

<div class="card">
    <div class="card-body">
        <p class="mb-1"><strong>Designation:</strong> {{ $blogAuthor->designation }}</p>
        <p class="mb-1"><strong>Posts:</strong> {{ $blogAuthor->posts_count }}</p>
        <p class="mb-3"><strong>Status:</strong> {{ $blogAuthor->is_active ? 'Active' : 'Inactive' }}</p>
        <p class="mb-0">{{ $blogAuthor->bio }}</p>
    </div>
</div>
@endsection
