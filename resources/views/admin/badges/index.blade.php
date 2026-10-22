@extends('layouts.admin')

@section('title', 'Badges')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Badges</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('badges.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Badge
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('badges.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search badges..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($badges as $badge)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $badge->name }}</td>
                    <td>
                        <a href="{{ route('badges.show', $badge->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('badges.edit', $badge->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('badges.destroy', $badge->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this badge?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No badges found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        Showing {{ $badges->firstItem() ?? 0 }} to {{ $badges->lastItem() ?? 0 }} of {{ $badges->total() ?? 0 }} results
    </div>
    <nav aria-label="Page navigation">
        {{ $badges->links() }}
    </nav>
</div>
@endsection

