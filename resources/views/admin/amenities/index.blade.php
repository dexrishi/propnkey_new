@extends('layouts.admin')

@section('title', 'Amenities')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Amenities</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('amenities.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Amenity
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
        <form action="{{ route('amenities.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search amenities..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Icon</th>
                <th scope="col">Name</th>
                <th scope="col">Sort Order</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($amenities as $amenity)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($amenity->icon)
                            <i class="{{ $amenity->icon }} fs-4"></i>
                        @else
                            <i class="bi bi-star fs-4 text-muted"></i>
                        @endif
                    </td>
                    <td>{{ $amenity->name }}</td>
                    <td>{{ $amenity->sort_order }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-status" type="checkbox" role="switch" id="statusToggle{{ $amenity->id }}"
                                data-id="{{ $amenity->id }}" {{ $amenity->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusToggle{{ $amenity->id }}">
                                {{ $amenity->is_active ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('amenities.show', $amenity->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('amenities.edit', $amenity->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('amenities.destroy', $amenity->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this amenity?');">
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
        Showing {{ $amenities->firstItem() }} to {{ $amenities->lastItem() }} of {{ $amenities->total() }} results
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            @if ($amenities->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $amenities->previousPageUrl() }}">Previous</a></li>
            @endif

            @if ($amenities->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $amenities->nextPageUrl() }}">Next</a></li>
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
        var amenityId = $(this).data('id');
        var isActive = $(this).is(':checked');
        var statusText = $(this).next('.form-check-label');

        $.post("{{ url('amenities') }}/" + amenityId + "/toggle", {
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