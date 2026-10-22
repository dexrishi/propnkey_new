@extends('layouts.admin')

@section('title', 'Locations')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Locations</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('locations.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Location
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('locations.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search locations..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Heading</th>
                <th scope="col">Sort Order</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($location->image_url)
                            <img src="{{ $location->image_url }}" alt="{{ $location->name }}" class="rounded" width="40" height="40" style="object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded bg-secondary text-white" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($location->name, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->slug }}</td>
                    <td>{{ Str::limit($location->heading, 30) }}</td>
                    <td>{{ $location->sort_order }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-status" type="checkbox" role="switch" id="statusToggle{{ $location->id }}"
                                data-id="{{ $location->id }}" {{ $location->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusToggle{{ $location->id }}">
                                {{ $location->is_active ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('locations.show', $location->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this location?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        Showing {{ $locations->firstItem() }} to {{ $locations->lastItem() }} of {{ $locations->total() }} results
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            @if ($locations->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $locations->previousPageUrl() }}">Previous</a></li>
            @endif

            @if ($locations->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $locations->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </nav>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.toggle-status').on('change', function() {
        var locationId = $(this).data('id');
        var isActive = $(this).is(':checked');
        var statusText = $(this).next('.form-check-label');

        $.post("{{ url('locations') }}/" + locationId + "/toggle", {
            _token: '{{ csrf_token() }}',
            is_active: isActive
        }, function(response) {
            if (response.is_active) {
                statusText.text('Active');
            } else {
                statusText.text('Inactive');
            }
            console.log('Status toggled successfully.');
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error toggling status:", textStatus, errorThrown);
        });
    });
</script>
@endpush