@extends('layouts.admin')

@section('title', 'Property Categories')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Property Categories</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('property-categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Category
        </a>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('property-categories.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search categories..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('property-categories.index') }}" class="btn btn-outline-danger ms-2">
                    <i class="bi bi-x"></i>
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Categories Table -->
<div class="card">
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Sort</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Heading</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $index => $category)
                            <tr data-id="{{ $category->id }}">
                                <td>
                                    <div class="d-flex flex-column align-items-center">
                                        <button class="btn btn-sm btn-outline-secondary move-up" data-id="{{ $category->id }}" title="Move Up">
                                            <i class="bi bi-chevron-up"></i>
                                        </button>
                                        <span class="badge bg-secondary mt-1">{{ $category->sort_order }}</span>
                                        <button class="btn btn-sm btn-outline-secondary move-down" data-id="{{ $category->id }}" title="Move Down">
                                            <i class="bi bi-chevron-down"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                </td>
                                <td>
                                    <code class="small">{{ $category->slug }}</code>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 150px;" title="{{ $category->heading }}">
                                        {{ $category->heading ?: 'N/A' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ strip_tags($category->description) }}">
                                        {{ $category->excerpt ?: 'No description' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="{{ $category->id }}" 
                                               {{ $category->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('property-categories.show', $category) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('property-categories.edit', $category) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('property-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property category?')">
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
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-building display-1 text-muted"></i>
                <h3 class="mt-3">No Property Categories Found</h3>
                <p class="text-muted">Get started by adding your first property category.</p>
                <a href="{{ route('property-categories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Category
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
            const categoryId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/property-categories/${categoryId}/toggle`, {
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

    // Move up functionality
    document.querySelectorAll('.move-up').forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.dataset.id;
            
            fetch(`/property-categories/${categoryId}/move-up`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

    // Move down functionality
    document.querySelectorAll('.move-down').forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.dataset.id;
            
            fetch(`/property-categories/${categoryId}/move-down`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>
@endpush
