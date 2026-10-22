@extends('admin.layouts.app')

@section('title', 'Image Redirections')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Image Redirections</h3>
                    <div class="card-tools">
                        <a href="{{ route('image-redirections.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Redirection
                        </a>
                        <button type="button" class="btn btn-success btn-sm" onclick="populateRedirections()">
                            <i class="fas fa-download"></i> Populate from Mapping
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card-body">
                    <form method="GET" action="{{ route('image-redirections.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="search">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" 
                                           value="{{ request('search') }}" placeholder="Search old path, new path, filename...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="property">Property</label>
                                    <select class="form-select" id="property" name="property">
                                        <option value="">All Properties</option>
                                        @foreach($properties as $property)
                                            <option value="{{ $property->id }}" {{ request('property') == $property->id ? 'selected' : '' }}>
                                                {{ $property->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="type">Image Type</label>
                                    <select class="form-select" id="type" name="type">
                                        <option value="">All Types</option>
                                        <option value="project" {{ request('type') == 'project' ? 'selected' : '' }}>Project</option>
                                        <option value="logo" {{ request('type') == 'logo' ? 'selected' : '' }}>Logo</option>
                                        <option value="floor_plan" {{ request('type') == 'floor_plan' ? 'selected' : '' }}>Floor Plan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">All Status</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('image-redirections.index') }}" class="btn btn-secondary">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Bulk Actions -->
                    <form id="bulkForm" method="POST" action="{{ route('image-redirections.bulk-action') }}" class="mb-3">
                        @csrf
                        <div class="d-flex gap-2 align-items-center">
                            <select name="action" class="form-select" style="width: auto;">
                                <option value="">Bulk Actions</option>
                                <option value="activate">Activate Selected</option>
                                <option value="deactivate">Deactivate Selected</option>
                                <option value="delete">Delete Selected</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-primary" onclick="return confirmBulkAction()">Apply</button>
                            <span class="text-muted" id="selectedCount">0 selected</span>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                    </th>
                                    <th>Old Path</th>
                                    <th>New Path</th>
                                    <th>Property</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Redirects</th>
                                    <th>Last Redirected</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($redirections as $redirection)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="ids[]" value="{{ $redirection->id }}" class="row-checkbox" onchange="updateSelectedCount()">
                                        </td>
                                        <td>
                                            <code>{{ $redirection->old_path }}</code>
                                            <br><small class="text-muted">{{ $redirection->original_filename }}</small>
                                        </td>
                                        <td>
                                            <code>{{ $redirection->new_path }}</code>
                                            <br>
                                            <a href="{{ $redirection->new_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i> View
                                            </a>
                                        </td>
                                        <td>
                                            @if($redirection->property)
                                                <a href="{{ route('properties.show', $redirection->property) }}" class="text-decoration-none">
                                                    {{ $redirection->property->name }}
                                                </a>
                                            @else
                                                <span class="text-muted">No Property</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ ucfirst($redirection->image_type) }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm {{ $redirection->is_active ? 'btn-success' : 'btn-secondary' }}" 
                                                    onclick="toggleStatus({{ $redirection->id }})">
                                                {{ $redirection->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $redirection->redirect_count }}</span>
                                        </td>
                                        <td>
                                            @if($redirection->last_redirected_at)
                                                {{ $redirection->last_redirected_at->diffForHumans() }}
                                            @else
                                                <span class="text-muted">Never</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('image-redirections.show', $redirection) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('image-redirections.edit', $redirection) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-success" onclick="testRedirect({{ $redirection->id }})">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                                <form method="POST" action="{{ route('image-redirections.destroy', $redirection) }}" 
                                                      style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this redirection?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            No image redirections found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($redirections->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $redirections->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    updateSelectedCount();
}

function updateSelectedCount() {
    const selected = document.querySelectorAll('.row-checkbox:checked').length;
    document.getElementById('selectedCount').textContent = selected + ' selected';
}

function confirmBulkAction() {
    const action = document.querySelector('select[name="action"]').value;
    const selected = document.querySelectorAll('.row-checkbox:checked').length;
    
    if (!action) {
        alert('Please select an action');
        return false;
    }
    
    if (selected === 0) {
        alert('Please select at least one redirection');
        return false;
    }
    
    return confirm(`Are you sure you want to ${action} ${selected} redirection(s)?`);
}

function toggleStatus(id) {
    fetch(`/image-redirections/${id}/toggle`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating status');
    });
}

function testRedirect(id) {
    fetch(`/image-redirections/${id}/test`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`Test successful!\nOld URL: ${data.old_url}\nNew URL: ${data.new_url}\nRedirect Count: ${data.redirect_count}`);
            location.reload();
        } else {
            alert('Test failed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error testing redirection');
    });
}

function populateRedirections() {
    if (confirm('This will populate redirections from the mapping file. Continue?')) {
        fetch('/image-redirections/populate', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Successfully populated ${data.count} redirections`);
                location.reload();
            } else {
                alert('Error populating redirections: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error populating redirections');
        });
    }
}
</script>
@endsection
