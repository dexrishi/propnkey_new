@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Testimonials</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Testimonial
        </a>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('testimonials.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search testimonials..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('testimonials.index') }}" class="btn btn-outline-danger ms-2">
                    <i class="bi bi-x"></i>
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Testimonials Table -->
<div class="card">
    <div class="card-body">
        @if($testimonials->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Comment</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach($testimonials as $testimonial)
                            <tr data-id="{{ $testimonial->id }}">
                                <td>
                                    @if($testimonial->image)
                                        <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                    @else
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            {{ $testimonial->initials }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $testimonial->name }}</strong>
                                </td>
                                <td>{{ $testimonial->designation }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ $testimonial->comment }}">
                                        {{ Str::limit($testimonial->comment, 100) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $testimonial->sort_order }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="{{ $testimonial->id }}" 
                                               {{ $testimonial->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('testimonials.show', $testimonial) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
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
                {{ $testimonials->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-chat-quote display-1 text-muted"></i>
                <h3 class="mt-3">No Testimonials Found</h3>
                <p class="text-muted">Get started by adding your first testimonial.</p>
                <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Testimonial
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle functionality
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const testimonialId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/testimonials/${testimonialId}/toggle`, {
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

    // Sortable functionality
    const sortable = Sortable.create(document.getElementById('sortable'), {
        animation: 150,
        handle: 'tr',
        onEnd: function(evt) {
            const sortOrder = Array.from(document.getElementById('sortable').children).map((row, index) => {
                return row.dataset.id;
            });

            fetch('/testimonials/update-sort-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ sort_order: sortOrder })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Reload page to update sort order display
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});
</script>
@endpush
