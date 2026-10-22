@extends('layouts.admin')

@section('title', 'Pages')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Pages</h1>
                                <p class="text-muted mb-0">Manage static pages and content</p>
                            </div>
                            <div>
                                <a href="{{ route('pages.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Add New Page
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

                <!-- Pages Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title mb-0">All Pages ({{ $pages->total() }})</h5>
                            </div>
                            <div class="col-auto">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search pages..." id="searchInput">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Content Preview</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th>Updated</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @forelse($pages as $page)
                                        <tr data-id="{{ $page->id }}">
                                            <td>
                                                <i class="bi bi-grip-vertical text-muted" style="cursor: move;"></i>
                                            </td>
                                            <td>
                                                <strong>{{ $page->title }}</strong>
                                            </td>
                                            <td>
                                                <code class="small">{{ $page->slug }}</code>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $page->excerpt }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $page->sort_order }}</span>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input toggle-status" 
                                                           type="checkbox" 
                                                           data-id="{{ $page->id }}"
                                                           {{ $page->is_active ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $page->updated_at->diffForHumans() }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('pages.edit', $page) }}" class="btn btn-outline-primary" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('pages.destroy', $page) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this page?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="bi bi-file-text fs-3 d-block mb-2"></i>
                                                    No pages found
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($pages->hasPages())
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if($pages->onFirstPage())
                                        <span class="btn btn-outline-secondary disabled">« Previous</span>
                                    @else
                                        <a href="{{ $pages->previousPageUrl() }}" class="btn btn-outline-secondary">« Previous</a>
                                    @endif
                                </div>
                                <div class="text-muted">
                                    Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} results
                                </div>
                                <div>
                                    @if($pages->hasMorePages())
                                        <a href="{{ $pages->nextPageUrl() }}" class="btn btn-outline-secondary">Next »</a>
                                    @else
                                        <span class="btn btn-outline-secondary disabled">Next »</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle status functionality
    document.querySelectorAll('.toggle-status').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const pageId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/pages/${pageId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_active: isActive })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
                    alert.style.top = '20px';
                    alert.style.right = '20px';
                    alert.style.zIndex = '9999';
                    alert.innerHTML = `
                        <i class="bi bi-check-circle me-2"></i>Page status updated successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    document.body.appendChild(alert);
                    
                    // Auto remove after 3 seconds
                    setTimeout(() => {
                        alert.remove();
                    }, 3000);
                } else {
                    // Revert toggle on error
                    this.checked = !isActive;
                    alert('Failed to update page status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isActive;
                alert('An error occurred while updating the page');
            });
        });
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // Sortable functionality
    const sortable = document.getElementById('sortable');
    if (sortable) {
        new Sortable(sortable, {
            handle: '.bi-grip-vertical',
            animation: 150,
            onEnd: function(evt) {
                const items = Array.from(sortable.children);
                const pages = items.map((item, index) => ({
                    id: item.dataset.id,
                    sort_order: index
                }));

                fetch('/pages/update-sort-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ pages: pages })
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
@endsection
