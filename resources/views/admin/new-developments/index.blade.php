@extends('layouts.admin')

@section('title', 'New Developments')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">New Developments</h1>
                                <p class="text-muted mb-0">Manage properties in the New Developments section</p>
                            </div>
                            <div>
                                @if(auth()->user()->isSuperAdmin())
                                    <a href="{{ route('new-developments.index', ['show_trashed' => request('show_trashed') ? null : 1]) }}" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-trash me-1"></i>{{ request('show_trashed') ? 'Show Active' : 'Show Trashed' }}
                                    </a>
                                @endif
                                <a href="{{ route('new-developments.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Add New Development
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- New Developments Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All New Developments ({{ $newDevelopments->count() }})</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Property</th>
                                        <th>Location</th>
                                        <th>Price</th>
                                        <th>Sort Order</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @forelse($newDevelopments as $development)
                                        <tr data-id="{{ $development->id }}">
                                            <td>
                                                <i class="bi bi-grip-vertical text-muted" style="cursor: move;"></i>
                                            </td>
                                            <td>
                                                <strong>{{ $development->property->name ?? 'N/A' }}</strong>
                                            </td>
                                            <td>
                                                @if($development->property && $development->property->location)
                                                    <span class="text-muted">{{ $development->property->location->name }}</span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($development->property)
                                                    {{ \App\Helpers\ConfigHelper::formatPrice($development->property->price, $development->property->price_unit) }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $development->sort_order }}</span>
                                            </td>
                                            <td>
                                                @if(request('show_trashed') && auth()->user()->isSuperAdmin())
                                                    <form action="{{ route('new-developments.restore', $development->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="bi bi-arrow-counterclockwise"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('new-developments.edit', $development->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('new-developments.destroy', $development->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Move this entry to trash?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <p class="text-muted mb-0">No new developments added yet.</p>
                                                <a href="{{ route('new-developments.create') }}" class="btn btn-primary btn-sm mt-2">
                                                    <i class="bi bi-plus-circle me-2"></i>Add First Development
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sortable functionality
    const sortable = document.getElementById('sortable');
    if (sortable) {
        new Sortable(sortable, {
            handle: '.bi-grip-vertical',
            animation: 150,
            onEnd: function(evt) {
                const items = Array.from(sortable.children);
                const developments = items.map((item, index) => ({
                    id: item.dataset.id,
                    sort_order: index
                }));

                fetch('/new-developments/update-sort-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ developments: developments })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update sort order badges
                        items.forEach((item, index) => {
                            const badge = item.querySelector('.badge');
                            if (badge) {
                                badge.textContent = index;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Reload page to reset order
                    location.reload();
                });
            }
        });
    }
});
</script>
@endpush

