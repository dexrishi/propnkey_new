@extends('layouts.admin')

@section('title', 'URL Redirections')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">URL Redirections</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('redirections.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Redirection
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
        <form action="{{ route('redirections.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by URL..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">From URL</th>
                <th scope="col">To URL</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Created</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($redirections as $redirection)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><code>{{ $redirection->from_url }}</code></td>
                    <td>
                        @if(filter_var($redirection->to_url, FILTER_VALIDATE_URL))
                            <a href="{{ $redirection->to_url }}" target="_blank" class="text-decoration-none">
                                {{ Str::limit($redirection->to_url, 50) }}
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        @else
                            <code>{{ $redirection->to_url }}</code>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $redirection->type == '301' ? 'primary' : 'warning' }}">
                            {{ $redirection->type }}
                        </span>
                    </td>
                    <td>
                        @if($redirection->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $redirection->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('redirections.show', $redirection->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('redirections.edit', $redirection->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('redirections.destroy', $redirection->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this redirection?');">
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
                    <td colspan="7" class="text-center">No redirections found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        Showing {{ $redirections->firstItem() ?? 0 }} to {{ $redirections->lastItem() ?? 0 }} of {{ $redirections->total() ?? 0 }} results
    </div>
    <nav aria-label="Page navigation">
        {{ $redirections->links() }}
    </nav>
</div>
@endsection

