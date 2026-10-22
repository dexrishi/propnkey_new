@extends('admin.layouts.app')

@section('title', 'View Image Redirection')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Image Redirection Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('image-redirections.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <a href="{{ route('image-redirections.edit', $imageRedirection) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Redirection Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Old Path:</strong></td>
                                    <td><code>{{ $imageRedirection->old_path }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>New Path:</strong></td>
                                    <td><code>{{ $imageRedirection->new_path }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Original Filename:</strong></td>
                                    <td>{{ $imageRedirection->original_filename }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Image Type:</strong></td>
                                    <td><span class="badge bg-info">{{ ucfirst($imageRedirection->image_type) }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge {{ $imageRedirection->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $imageRedirection->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5>URLs</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Old URL:</strong></td>
                                    <td>
                                        <a href="{{ $imageRedirection->old_url }}" target="_blank" class="text-decoration-none">
                                            {{ $imageRedirection->old_url }}
                                            <i class="fas fa-external-link-alt ms-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>New URL:</strong></td>
                                    <td>
                                        <a href="{{ $imageRedirection->new_url }}" target="_blank" class="text-decoration-none">
                                            {{ $imageRedirection->new_url }}
                                            <i class="fas fa-external-link-alt ms-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Related Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Property:</strong></td>
                                    <td>
                                        @if($imageRedirection->property)
                                            <a href="{{ route('properties.show', $imageRedirection->property) }}" class="text-decoration-none">
                                                {{ $imageRedirection->property->name }}
                                            </a>
                                        @else
                                            <span class="text-muted">No Property</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Property Image:</strong></td>
                                    <td>
                                        @if($imageRedirection->propertyImage)
                                            <a href="{{ route('properties.show', $imageRedirection->propertyImage->property) }}" class="text-decoration-none">
                                                View Property Image
                                            </a>
                                        @else
                                            <span class="text-muted">No Property Image</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5>Statistics</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Redirect Count:</strong></td>
                                    <td><span class="badge bg-primary">{{ $imageRedirection->redirect_count }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Last Redirected:</strong></td>
                                    <td>
                                        @if($imageRedirection->last_redirected_at)
                                            {{ $imageRedirection->last_redirected_at->diffForHumans() }}
                                            <br><small class="text-muted">{{ $imageRedirection->last_redirected_at->format('Y-m-d H:i:s') }}</small>
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Created:</strong></td>
                                    <td>{{ $imageRedirection->created_at->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated:</strong></td>
                                    <td>{{ $imageRedirection->updated_at->diffForHumans() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Image Preview -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Image Preview</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Old Image (Redirected From)</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <img src="{{ $imageRedirection->old_url }}" 
                                                 alt="Old Image" 
                                                 class="img-fluid" 
                                                 style="max-height: 200px; object-fit: cover;"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <div style="display: none;" class="text-muted">
                                                <i class="fas fa-image fa-3x"></i><br>
                                                Image not found or not accessible
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">New Image (Redirected To)</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <img src="{{ $imageRedirection->new_url }}" 
                                                 alt="New Image" 
                                                 class="img-fluid" 
                                                 style="max-height: 200px; object-fit: cover;"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <div style="display: none;" class="text-muted">
                                                <i class="fas fa-image fa-3x"></i><br>
                                                Image not found or not accessible
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-success" onclick="testRedirect({{ $imageRedirection->id }})">
                        <i class="fas fa-play"></i> Test Redirection
                    </button>
                    <button type="button" class="btn btn-warning" onclick="toggleStatus({{ $imageRedirection->id }})">
                        <i class="fas fa-toggle-{{ $imageRedirection->is_active ? 'on' : 'off' }}"></i> 
                        {{ $imageRedirection->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                    <a href="{{ route('image-redirections.edit', $imageRedirection) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('image-redirections.destroy', $imageRedirection) }}" 
                          style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this redirection?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>
@endsection
