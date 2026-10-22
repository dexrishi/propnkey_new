@extends('layouts.admin')

@section('title', 'Edit Menu Item')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Menu Item: {{ $menu->title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('menus.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Menus
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('menus.update', $menu->id) }}" method="POST" id="menuForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $menu->title) }}" 
                       required 
                       autofocus
                       placeholder="Enter menu title">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('url') is-invalid @enderror" 
                       id="url" 
                       name="url" 
                       value="{{ old('url', $menu->url) }}" 
                       required
                       placeholder="Enter menu URL (e.g., /about-us)">
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Enter the URL path for this menu item (e.g., /about-us, /contact, etc.)</div>
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Parent Menu</label>
                <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="">Select parent menu (optional)</option>
                    @foreach($parentMenus as $id => $title)
                        <option value="{{ $id }}" {{ old('parent_id', $menu->parent_id) == $id ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Leave empty to make this a root menu item</div>
            </div>

            <div class="mb-3">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" 
                       class="form-control @error('sort_order') is-invalid @enderror" 
                       id="sort_order" 
                       name="sort_order" 
                       value="{{ old('sort_order', $menu->sort_order) }}"
                       placeholder="Enter sort order">
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Lower numbers appear first in the menu</div>
            </div>

            <div class="mb-3 form-check form-switch">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Menu Item
                </button>
                <a href="{{ route('menus.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
    <div class="col-lg-4">
        <div class="card bg-light mb-3">
            <div class="card-header">Help Panel</div>
            <div class="card-body">
                <h5 class="card-title">Menu Fields</h5>
                <p class="card-text">
                    <strong>Title:</strong> The display name for the menu item.
                </p>
                <p class="card-text">
                    <strong>URL:</strong> The URL path this menu item should link to.
                </p>
                <p class="card-text">
                    <strong>Parent Menu:</strong> Select a parent menu to create a submenu item.
                </p>
                <p class="card-text">
                    <strong>Sort Order:</strong> Controls the display order (lower numbers first).
                </p>
                <p class="card-text">
                    <strong>Is Active:</strong> Toggle to show/hide the menu item.
                </p>
                <h5 class="card-title mt-3">Current Menu Info</h5>
                <p class="card-text">
                    <strong>Current Level:</strong> {{ $menu->level }}<br>
                    <strong>Children Count:</strong> {{ $menu->children->count() }}<br>
                    <strong>Created:</strong> {{ $menu->created_at->format('M d, Y') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection