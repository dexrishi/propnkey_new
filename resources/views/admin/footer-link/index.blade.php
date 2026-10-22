@extends('layouts.admin')

@section('title', 'Footer Links')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Footer Links</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('footer-items.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Link
        </a>
    </div>
</div>

<!-- Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Search -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('footer-items.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" 
                   placeholder="Search footer links..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('footer-items.index') }}" class="btn btn-outline-danger ms-2">
                    <i class="bi bi-x"></i>
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Footer Links Table -->
<div class="card">
    <div class="card-body">
        @if($items->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Category</th>
                            <th>Sorting</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td><strong>{{ $item->title }}</strong></td>
                                <td>
                                    @if($item->url)
                                        <a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ $item->footerCategory->name ?? '—' }}</td>
                                <td>{{ $item->sorting }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="{{ $item->id }}" 
                                               {{ $item->status ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('footer-items.edit', $item) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('footer-items.destroy', $item) }}" method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Are you sure you want to delete this footer link? This action cannot be undone.');">
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
                {{ $items->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-link-45deg display-1 text-muted"></i>
                <h3 class="mt-3">No Footer Links Found</h3>
                <p class="text-muted">Get started by adding your first footer link.</p>
                <a href="{{ route('footer-items.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Link
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const itemId = this.dataset.id;
            const isActive = this.checked;

            fetch(`{{ url('/footer-items') }}/${itemId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: isActive })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status !== isActive) {
                    this.checked = data.status;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isActive; // Revert on error
                alert('Something went wrong! Please try again.');
            });
        });
    });
});
</script>
@endpush
