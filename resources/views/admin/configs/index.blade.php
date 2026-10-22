@extends('layouts.admin')

@section('title', 'Site Configurations')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Site Configurations</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('configs.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Configuration
        </a>
        <form action="{{ route('configs.clear-cache') }}" method="POST" class="d-inline ms-2">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-warning">
                <i class="bi bi-arrow-clockwise me-2"></i>Clear Cache
            </button>
        </form>
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
        <form action="{{ route('configs.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search configurations..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search me-1"></i>Search
            </button>
            @if(request('search'))
                <a href="{{ route('configs.index') }}" class="btn btn-outline-danger ms-2">
                    <i class="bi bi-x-circle me-1"></i>Clear
                </a>
            @endif
        </form>
    </div>
    <div class="col-md-6 text-end">
        @if(request('search'))
            <div class="text-muted">
                <i class="bi bi-search me-1"></i>Search results for: "<strong>{{ request('search') }}</strong>"
            </div>
        @endif
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Label</th>
                <th scope="col">Type</th>
                <th scope="col">Content</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($configs as $config)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $config->label }}</td>
                    <td>
                        <span class="badge bg-{{ $config->type === 'text' ? 'primary' : ($config->type === 'textarea' ? 'info' : 'warning') }}">
                            {{ ucfirst($config->type) }}
                        </span>
                    </td>
                    <td>
                        @if($config->type === 'file')
                            @if($config->content)
                                <a href="{{ Storage::url($config->content) }}" target="_blank" class="text-decoration-none">
                                    <i class="bi bi-file-earmark me-1"></i>View File
                                </a>
                            @else
                                <span class="text-muted">No file</span>
                            @endif
                        @else
                            {{ Str::limit($config->content, 50) }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('configs.show', $config->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('configs.edit', $config->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('configs.destroy', $config->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this configuration?');">
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
                    <td colspan="5" class="text-center py-4">
                        @if(request('search'))
                            <div class="text-muted">
                                <i class="bi bi-search display-4 d-block mb-3"></i>
                                <h5>No configurations found</h5>
                                <p>No configurations match your search criteria "<strong>{{ request('search') }}</strong>"</p>
                                <a href="{{ route('configs.index') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-left me-1"></i>View All Configurations
                                </a>
                            </div>
                        @else
                            <div class="text-muted">
                                <i class="bi bi-gear display-4 d-block mb-3"></i>
                                <h5>No configurations found</h5>
                                <p>Start by creating your first configuration.</p>
                                <a href="{{ route('configs.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i>Add Configuration
                                </a>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($configs->count() > 0)
<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        Showing {{ $configs->firstItem() }} to {{ $configs->lastItem() }} of {{ $configs->total() }} results
        @if(request('search'))
            for "<strong>{{ request('search') }}</strong>"
        @endif
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            @if ($configs->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $configs->previousPageUrl() }}">Previous</a></li>
            @endif

            @if ($configs->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $configs->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </nav>
</div>
@endif
@endsection