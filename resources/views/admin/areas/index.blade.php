@extends('layouts.admin')

@section('title', 'Areas')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Areas</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('areas.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Area
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

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Location</th>
                <th scope="col">Sort Order</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($areas as $area)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $area->name }}</td>
                    <td><code>{{ $area->slug ?? 'N/A' }}</code></td>
                    <td>{{ $area->location ? $area->location->name : 'N/A' }}</td>
                    <td>{{ $area->sort_order }}</td>
                    <td>
                        <a href="{{ route('areas.show', $area->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('areas.edit', $area->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('areas.destroy', $area->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this area?');">
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
                    <td colspan="6" class="text-center">No areas found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        Showing {{ $areas->firstItem() }} to {{ $areas->lastItem() }} of {{ $areas->total() }} results
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            @if ($areas->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $areas->previousPageUrl() }}">Previous</a></li>
            @endif

            @if ($areas->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $areas->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </nav>
</div>
@endsection

