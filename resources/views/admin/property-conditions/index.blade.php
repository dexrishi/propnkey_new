@extends('layouts.admin')

@section('title', 'Property Conditions')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Property Conditions</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-conditions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Condition
        </a>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('property-conditions.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search conditions..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('property-conditions.index') }}" class="btn btn-outline-danger ms-2">
                    <i class="bi bi-x"></i>
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Conditions Table -->
<div class="card">
    <div class="card-body">
        @if($conditions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($conditions as $condition)
                            <tr>
                                <td>
                                    <strong>{{ $condition->name }}</strong>
                                </td>
                                <td>
                                    <code class="small">{{ $condition->slug }}</code>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="{{ $condition->id }}" 
                                               {{ $condition->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $condition->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('property-conditions.show', $condition) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('property-conditions.edit', $condition) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('property-conditions.destroy', $condition) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property condition?')">
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
                {{ $conditions->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-tag display-1 text-muted"></i>
                <h3 class="mt-3">No Property Conditions Found</h3>
                <p class="text-muted">Get started by adding your first property condition.</p>
                <a href="{{ route('property-conditions.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Condition
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
            const conditionId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/property-conditions/${conditionId}/toggle`, {
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
