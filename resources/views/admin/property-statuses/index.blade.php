@extends('layouts.admin')

@section('title', 'Property Statuses')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Property Statuses</h3>
                    <a href="{{ route('property-statuses.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add New Status
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th>Properties Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($propertyStatuses as $status)
                                    <tr>
                                        <td>{{ $status->id }}</td>
                                        <td>{{ $status->name }}</td>
                                        <td>
                                            <code>{{ $status->slug }}</code>
                                        </td>
                                        <td>{{ Str::limit($status->description, 50) }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $status->sort_order }}</span>
                                        </td>
                                        <td>
                                            @if($status->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $status->properties_count ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('property-statuses.show', $status) }}" 
                                                   class="btn btn-sm btn-outline-info" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('property-statuses.edit', $status) }}" 
                                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('property-statuses.destroy', $status) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this property status?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox"></i> No property statuses found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($propertyStatuses->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $propertyStatuses->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
