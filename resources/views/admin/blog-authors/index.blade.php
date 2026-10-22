@extends('layouts.admin')

@section('title', 'Blog Authors')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Blog Authors</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('blog-authors.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add Author
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('blog-authors.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search authors..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm align-middle">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Posts</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($authors as $author)
                <tr>
                    <td>
                        @if($author->photo_url)
                            <img src="{{ $author->photo_url }}" alt="{{ $author->name }}" class="rounded-circle" width="48" height="48" style="object-fit: cover;">
                        @else
                            <span class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">{{ $author->initials }}</span>
                        @endif
                    </td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->designation }}</td>
                    <td>{{ $author->posts_count }}</td>
                    <td>
                        <form action="{{ route('blog-authors.toggle', $author) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-{{ $author->is_active ? 'success' : 'secondary' }}">
                                {{ $author->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('blog-authors.edit', $author) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if(auth()->user()->canDelete())
                            <form action="{{ route('blog-authors.destroy', $author) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this author? Posts will keep their content without this byline.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No blog authors yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $authors->links() }}
@endsection
