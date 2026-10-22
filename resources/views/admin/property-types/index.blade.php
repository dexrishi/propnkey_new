@extends('layouts.admin')

@section('title', 'Property Types')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Property Types</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-types.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Type
        </a>
    </div>
</div>

<!-- Search and Filter -->
<form method="GET" action="{{ route('property-types.index') }}" id="filterForm">
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search types..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('property-types.index') }}" class="btn btn-outline-danger ms-2">
                        <i class="bi bi-x"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>
</form>

<!-- Types Table -->
<div class="card">
    <div class="card-body">
        @if($propertyTypes->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Heading</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($propertyTypes as $propertyType)
                            <tr>
                                <td>
                                    <strong>{{ $propertyType->name }}</strong>
                                </td>
                                <td>
                                    @if($propertyType->propertyCategory)
                                        <span class="badge bg-primary">{{ $propertyType->propertyCategory->name }}</span>
                                    @else
                                        <span class="text-muted">No Category</span>
                                    @endif
                                </td>
                                <td>
                                    <code class="small">{{ $propertyType->slug }}</code>
                                </td>
                                <td>
                                    {{ $propertyType->heading ?: '-' }}
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $propertyType->sort_order }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="{{ $propertyType->id }}" 
                                               {{ $propertyType->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $propertyType->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('property-types.show', $propertyType) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('property-types.edit', $propertyType) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('property-types.destroy', $propertyType) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property type?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $propertyTypes->links('pagination.bootstrap-4') }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-house display-1 text-muted"></i>
                <h3 class="mt-3">No Property Types Found</h3>
                <p class="text-muted">Get started by adding your first property type.</p>
                <a href="{{ route('property-types.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Type
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle functionality
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const typeId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/property-types/${typeId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_active: isActive })
            })
            .then(response => response.json())
            .then(data => {
                if (data.is_active !== isActive) {
                    this.checked = data.is_active;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isActive; // Revert on error
            });
        });
    });
});
</script>
@endpush
