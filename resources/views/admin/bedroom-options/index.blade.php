@extends('layouts.admin')

@section('title', 'Bedroom Options')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bedroom Options</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('bedroom-options.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Option
        </a>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('bedroom-options.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search bedroom options..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('bedroom-options.index') }}" class="btn btn-outline-danger ms-2">
                    <i class="bi bi-x"></i>
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Bedroom Options Table -->
<div class="card">
    <div class="card-body">
        @if($bedroomOptions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bedroomOptions as $option)
                            <tr>
                                <td>
                                    <strong>{{ $option->name }}</strong>
                                </td>
                                <td>
                                    <code class="small">{{ $option->value ?: 'N/A' }}</code>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $option->sort_order }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="{{ $option->id }}" 
                                               {{ $option->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('bedroom-options.show', $option) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('bedroom-options.edit', $option) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('bedroom-options.destroy', $option) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this bedroom option?')">
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
                {{ $bedroomOptions->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-door-open display-1 text-muted"></i>
                <h3 class="mt-3">No Bedroom Options Found</h3>
                <p class="text-muted">Get started by adding your first bedroom option.</p>
                <a href="{{ route('bedroom-options.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Option
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
            const optionId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/bedroom-options/${optionId}/toggle`, {
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
