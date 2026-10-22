@extends('layouts.admin')

@section('title', 'Agents')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Agents</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('agents.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Agent
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
        <form action="{{ route('agents.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search agents..." value="{{ request('search') }}">
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
                <th scope="col">Designation</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Show in About</th>
                <th scope="col">Featured</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agents as $agent)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($agent->image_url)
                            <img src="{{ $agent->image_url }}" alt="{{ $agent->name }}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary text-white" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($agent->name, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $agent->name }}</td>
                    <td>{{ $agent->designation }}</td>
                    <td><a href="tel:{{ $agent->phone }}">{{ $agent->formatted_phone }}</a></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-status" type="checkbox" role="switch" id="statusToggle{{ $agent->id }}"
                                data-id="{{ $agent->id }}" {{ $agent->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusToggle{{ $agent->id }}">
                                {{ $agent->is_active ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                    </td>
                    <td>
                        @if($agent->show_in_about_page)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        @if($agent->is_featured)
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-star-fill me-1"></i>Featured
                            </span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('agents.show', $agent->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this agent?');">
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
        Showing {{ $agents->firstItem() }} to {{ $agents->lastItem() }} of {{ $agents->total() }} results
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            @if ($agents->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $agents->previousPageUrl() }}">Previous</a></li>
            @endif

            @if ($agents->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $agents->nextPageUrl() }}">Next</a></li>
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
        var agentId = $(this).data('id');
        var isActive = $(this).is(':checked');
        var statusText = $(this).next('.form-check-label');

        $.post("{{ url('agents') }}/" + agentId + "/toggle", {
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