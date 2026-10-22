@extends('layouts.admin')

@section('title', 'Static Pages')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Static Pages</h1>
                                <p class="text-muted mb-0">Manage static pages and content</p>
                            </div>
                            <div>
                                <a href="{{ route('static-pages.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Add New Static Page
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

                <!-- Static Pages Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title mb-0">All Static Pages ({{ $staticPages->total() }})</h5>
                            </div>
                            <div class="col-auto">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search static pages..." id="searchInput">
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
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Content Preview</th>
                                        <th>Updated</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($staticPages as $index => $staticPage)
                                        <tr>
                                            <td>{{ $staticPages->firstItem() + $index }}</td>
                                            <td>
                                                <strong>{{ $staticPage->name }}</strong>
                                            </td>
                                            <td>
                                                <code class="small">{{ $staticPage->slug }}</code>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $staticPage->excerpt }}</small>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $staticPage->updated_at->diffForHumans() }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('static.page', $staticPage->slug) }}" class="btn btn-outline-success" title="View on Frontend" target="_blank">
                                                        <i class="bi bi-box-arrow-up-right"></i>
                                                    </a>
                                                    <a href="{{ route('static-pages.show', $staticPage) }}" class="btn btn-outline-info" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('static-pages.edit', $staticPage) }}" class="btn btn-outline-primary" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('static-pages.destroy', $staticPage) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this static page?')">
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
                                            <td colspan="6" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="bi bi-file-text fs-3 d-block mb-2"></i>
                                                    No static pages found
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($staticPages->hasPages())
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if($staticPages->onFirstPage())
                                        <span class="btn btn-outline-secondary disabled">« Previous</span>
                                    @else
                                        <a href="{{ $staticPages->previousPageUrl() }}" class="btn btn-outline-secondary">« Previous</a>
                                    @endif
                                </div>
                                <div class="text-muted">
                                    Showing {{ $staticPages->firstItem() }} to {{ $staticPages->lastItem() }} of {{ $staticPages->total() }} results
                                </div>
                                <div>
                                    @if($staticPages->hasMorePages())
                                        <a href="{{ $staticPages->nextPageUrl() }}" class="btn btn-outline-secondary">Next »</a>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>
@endpush
@endsection

