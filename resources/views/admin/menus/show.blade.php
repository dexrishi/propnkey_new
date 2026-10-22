@extends('layouts.admin')

@section('title', 'Menu Item Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Menu Item: {{ $menu->title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Menu Item
        </a>
        <a href="{{ route('menus.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Menus
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Menu Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Title</label>
                        <p class="mb-0">{{ $menu->title }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">URL</label>
                        <p class="mb-0">
                            <a href="{{ $menu->url }}" target="_blank" class="text-decoration-none">
                                {{ $menu->url }} <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Parent Menu</label>
                        <p class="mb-0">
                            @if($menu->parent)
                                <a href="{{ route('menus.show', $menu->parent->id) }}" class="text-decoration-none">
                                    {{ $menu->parent->title }}
                                </a>
                            @else
                                <span class="text-muted">Root Menu Item</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Level</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $menu->level == 0 ? 'primary' : ($menu->level == 1 ? 'info' : 'secondary') }}">
                                Level {{ $menu->level }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sort Order</label>
                        <p class="mb-0">{{ $menu->sort_order }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $menu->is_active ? 'success' : 'danger' }}">
                                {{ $menu->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Created At</label>
                        <p class="mb-0">{{ $menu->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="mb-0">{{ $menu->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($menu->children->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Child Menu Items ({{ $menu->children->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($menu->children as $child)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $child->title }}</h6>
                                <p class="mb-1 text-muted">{{ $child->url }}</p>
                                <small class="text-muted">Level {{ $child->level }} • Sort Order: {{ $child->sort_order }}</small>
                            </div>
                            <div>
                                <a href="{{ route('menus.show', $child->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('menus.edit', $child->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Menu Item
                    </a>
                    
                    <a href="{{ route('menus.create') }}?parent={{ $menu->id }}" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add Child Menu
                    </a>
                    
                    <a href="{{ route('menus.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Menus
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Menu Hierarchy</h6>
            </div>
            <div class="card-body">
                @if($menu->allParents()->count() > 0)
                    <h6 class="text-muted">Parent Chain:</h6>
                    <ul class="list-unstyled mb-3">
                        @foreach($menu->allParents() as $parent)
                            <li class="mb-1">
                                <a href="{{ route('menus.show', $parent->id) }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-up-right me-1"></i>{{ $parent->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if($menu->children->count() > 0)
                    <h6 class="text-muted">Children:</h6>
                    <ul class="list-unstyled">
                        @foreach($menu->children as $child)
                            <li class="mb-1">
                                <a href="{{ route('menus.show', $child->id) }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-down-right me-1"></i>{{ $child->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection