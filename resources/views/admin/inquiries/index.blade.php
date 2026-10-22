@extends('layouts.admin')

@section('title', 'Inquiries - CRM')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Inquiries - CRM</h1>
    <a href="{{ route('inquiries.index', array_merge(request()->except('page'), ['show_trashed' => request('show_trashed') ? null : 1])) }}"
       class="btn btn-outline-secondary">
        <i class="bi bi-trash me-1"></i>{{ request('show_trashed') ? 'Show Active' : 'Show Trashed' }}
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Filters -->
<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('inquiries.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search inquiries..." value="{{ request('search') }}">
            <select name="status" class="form-select" style="max-width: 200px;">
                <option value="">All Statuses</option>
                @foreach($statusOptions as $value => $label)
                    <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i> Filter
            </button>
            @if(request('search') || request('status'))
                <a href="{{ route('inquiries.index') }}" class="btn btn-outline-danger">
                    <i class="bi bi-x-circle"></i> Clear
                </a>
            @endif
        </form>
    </div>
    <div class="col-md-6 text-end">
        <div class="btn-group" role="group">
            @foreach($statusOptions as $value => $label)
                <a href="{{ route('inquiries.index', ['status' => $value]) }}" 
                   class="btn btn-sm btn-outline-{{ $value == 'new' ? 'primary' : ($value == 'won' ? 'success' : ($value == 'lost' ? 'danger' : 'secondary')) }}"
                   style="{{ request('status') == $value ? 'font-weight: bold;' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Inquiries Table -->
<div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Project</th>
                <th>Form</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inquiries as $inquiry)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <strong>{{ $inquiry->name }}</strong>
                        @if($inquiry->notes)
                            <i class="bi bi-sticky-fill text-warning" title="Has notes"></i>
                        @endif
                    </td>
                    <td>{{ $inquiry->company ?? '—' }}</td>
                    <td>
                        <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                    </td>
                    <td>
                        <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                    </td>
                    <td>{{ $inquiry->project_name ?? '—' }}</td>
                    <td>{{ $inquiry->form_name ?? '—' }}</td>
                    <td>
                        <span class="badge bg-{{ $inquiry->status_badge_color }}">
                            {{ $inquiry->status_label }}
                        </span>
                    </td>
                    <td>{{ $inquiry->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            @if(!request('show_trashed'))
                            <a href="{{ route('inquiries.show', $inquiry->id) }}" class="btn btn-info" title="View Details">
                                <i class="bi bi-eye"></i>
                            </a>
                            @endif
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><h6 class="dropdown-header">Quick Status Update</h6></li>
                                @foreach($statusOptions as $value => $label)
                                    <li>
                                        <form action="{{ route('inquiries.update-status', $inquiry->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="{{ $value }}">
                                            <button type="submit" class="dropdown-item {{ $inquiry->status == $value ? 'active' : '' }}">
                                                {{ $label }}
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                                <li><hr class="dropdown-divider"></li>
                                @if(request('show_trashed'))
                                    <li>
                                        <form action="{{ route('inquiries.restore', $inquiry->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-success">
                                                <i class="bi bi-arrow-counterclockwise me-2"></i>Restore
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Move this inquiry to trash?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center py-4">
                        <div class="text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            <h5>No inquiries found</h5>
                            <p>No inquiries match your current filters.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Pagination: keep directly under the table to avoid layout gaps -->
    <div class="d-flex justify-content-between align-items-center mt-3 admin-pagination">
        <div class="text-muted">
            Showing {{ $inquiries->firstItem() ?? 0 }} to {{ $inquiries->lastItem() ?? 0 }} of {{ $inquiries->total() ?? 0 }} results
        </div>
        <nav aria-label="Page navigation" class="ms-3 admin-pagination-nav">
            {{ $inquiries->appends(request()->query())->links() }}
        </nav>
    </div>
</div>
@endsection
