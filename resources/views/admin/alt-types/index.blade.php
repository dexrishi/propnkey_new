@extends('layouts.admin')

@section('title', 'Alt Types')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Alt Types</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('alt-types.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add Alt Type
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('alt-types.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search alt types..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Sort</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($altTypes as $altType)
                <tr>
                    <td>{{ $altTypes->firstItem() + $loop->index }}</td>
                    <td>{{ $altType->name }}</td>
                    <td>{{ $altType->sort_order }}</td>
                    <td>
                        <form action="{{ route('alt-types.toggle', $altType) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-{{ $altType->is_active ? 'success' : 'secondary' }}">
                                {{ $altType->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('alt-types.show', $altType) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('alt-types.edit', $altType) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if(auth()->user()->canDelete())
                            <form action="{{ route('alt-types.destroy', $altType) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this Alt Type?');">
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
                    <td colspan="5" class="text-center">No alt types found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        Showing {{ $altTypes->firstItem() ?? 0 }} to {{ $altTypes->lastItem() ?? 0 }} of {{ $altTypes->total() ?? 0 }} results
    </div>
    <nav aria-label="Page navigation">
        {{ $altTypes->links() }}
    </nav>
</div>
@endsection
