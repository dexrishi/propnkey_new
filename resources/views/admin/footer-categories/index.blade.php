@extends('layouts.admin')

@section('title', 'Footer Categories')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Footer Categories</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('footer-categories.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Footer Category
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
        <form action="{{ route('footer-categories.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search footer categories..." value="{{ request('search') }}">
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
                <th scope="col">Sort Order</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($footerCategories as $footerCategory)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $footerCategory->name }}</td>
                    <td>{{ $footerCategory->sort }}</td>
                    <td>
                        <a href="{{ route('footer-categories.show', $footerCategory->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('footer-categories.edit', $footerCategory->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('footer-categories.destroy', $footerCategory->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this footer category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        Showing {{ $footerCategories->firstItem() }} to {{ $footerCategories->lastItem() }} of {{ $footerCategories->total() }} results
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            @if ($footerCategories->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $footerCategories->previousPageUrl() }}">Previous</a></li>
            @endif

            @if ($footerCategories->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $footerCategories->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </nav>
</div>
@endsection

