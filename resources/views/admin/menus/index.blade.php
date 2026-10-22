@extends('layouts.admin')

@section('title', 'Menus')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Menus</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('menus.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Menu Item
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
        <form action="{{ route('menus.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search menus..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">URL</th>
                <th scope="col">Parent</th>
                <th scope="col">Level</th>
                <th scope="col">Sort Order</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $menu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span style="padding-left: {{ $menu->level * 20 }}px;">
                            {{ $menu->title }}
                        </span>
                    </td>
                    <td>{{ $menu->url }}</td>
                    <td>
                        @if($menu->parent)
                            {{ $menu->parent->title }}
                        @else
                            <span class="text-muted">Root</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $menu->level == 0 ? 'primary' : ($menu->level == 1 ? 'info' : 'secondary') }}">
                            Level {{ $menu->level }}
                        </span>
                    </td>
                    <td>{{ $menu->sort_order }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-status" type="checkbox" role="switch" id="statusToggle{{ $menu->id }}"
                                data-id="{{ $menu->id }}" {{ $menu->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusToggle{{ $menu->id }}">
                                {{ $menu->is_active ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this menu item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <div class="text-muted">
                            <i class="bi bi-menu-button-wide fs-1 d-block mb-3"></i>
                            <h5>No menu items found</h5>
                            <p>Start by creating your first menu item.</p>
                            <a href="{{ route('menus.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Add New Menu Item
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($menus->count() > 0 || $menus->hasPages())
<div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted">
        @if(method_exists($menus, 'total') && method_exists($menus, 'firstItem') && method_exists($menus, 'lastItem'))
            @if($menus->total() > 0)
                Showing {{ $menus->firstItem() }} to {{ $menus->lastItem() }} of {{ $menus->total() }} results
            @else
                No menu items found
            @endif
        @else
            {{ $menus->count() }} menu item(s)
        @endif
    </div>
    @if(method_exists($menus, 'hasPages') && $menus->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            @if (method_exists($menus, 'onFirstPage') && $menus->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @elseif(method_exists($menus, 'previousPageUrl'))
                <li class="page-item"><a class="page-link" href="{{ $menus->previousPageUrl() }}">Previous</a></li>
            @endif

            @if (method_exists($menus, 'hasMorePages') && $menus->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $menus->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </nav>
    @endif
</div>
@endif
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.toggle-status').on('change', function() {
        var menuId = $(this).data('id');
        var isActive = $(this).is(':checked');
        var statusText = $(this).next('.form-check-label');

        $.post("{{ url('menus') }}/" + menuId + "/toggle", {
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