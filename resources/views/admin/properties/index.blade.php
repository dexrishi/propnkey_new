@extends('layouts.admin')

@section('title', 'Properties')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2">Properties</h1>
        <p class="text-muted mb-0">
            <strong>Total: {{ $properties->total() }}</strong> properties found
            @if(request()->hasAny(['search', 'partner', 'agent', 'location', 'type', 'category', 'status', 'property_status']))
                <span class="badge bg-info ms-2">Filtered</span>
            @endif
        </p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('properties.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Property
        </a>
    </div>
</div>

<!-- Search and Filter -->
<form method="GET" action="{{ route('properties.index') }}" id="filterForm">
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search properties..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
                @if(request('search') || request('partner') || request('agent') || request('location') || request('type') || request('category') || request('status') || request('property_status'))
                    <a href="{{ route('properties.index') }}" class="btn btn-outline-danger ms-2">
                        <i class="bi bi-x"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <select name="partner" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Partners</option>
                @foreach($partners as $partner)
                    <option value="{{ $partner->id }}" {{ request('partner') == $partner->id ? 'selected' : '' }}>
                        {{ $partner->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="agent" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Agents</option>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}" {{ request('agent') == $agent->id ? 'selected' : '' }}>
                        {{ $agent->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="location" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Locations</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="type" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Types</option>
                @foreach($propertyTypes as $type)
                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                        {{ $type->propertyCategory->name ?? '' }} {{ $type->propertyCondition->name ?? '' }} {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="category" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Categories</option>
                @foreach($propertyCategories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-2">
            <select name="status" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Status</option>
                <option value="featured" {{ request('status') === 'featured' ? 'selected' : '' }}>Featured</option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold" {{ request('status') === 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="property_status" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Property Status</option>
                <option value="newly_launched" {{ request('property_status') === 'newly_launched' ? 'selected' : '' }}>Newly Launched</option>
                <option value="ready_to_move" {{ request('property_status') === 'ready_to_move' ? 'selected' : '' }}>Ready to Move</option>
                <option value="under_construction" {{ request('property_status') === 'under_construction' ? 'selected' : '' }}>Under Construction</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="sort_by" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="sort_order" {{ request('sort_by') === 'sort_order' ? 'selected' : '' }}>Sort Order</option>
                <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Created Date</option>
                <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>Name</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="sort_order" class="form-select" onchange="document.getElementById('filterForm').submit()">
                <option value="asc" {{ request('sort_order') === 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
        </div>
        @if(auth()->user()->isSuperAdmin())
            <div class="col-md-2">
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" value="1" id="showTrashed" name="show_trashed"
                           onchange="document.getElementById('filterForm').submit()"
                           {{ request('show_trashed') ? 'checked' : '' }}>
                    <label class="form-check-label" for="showTrashed">
                        Show trashed
                    </label>
                </div>
            </div>
        @endif
    </div>
</form>

<!-- Properties Table -->
<div class="card">
    <div class="card-body">
        @if($properties->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Highlight Images</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td>
                                    <div>
                                        <strong>{{ $property->name }}</strong>
                                        @if($property->alias_name)
                                            <br><small class="text-muted">{{ $property->alias_name }}</small>
                                        @endif
                                        <br><code class="small">{{ $property->slug }}</code>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        @if($property->propertyCondition)
                                            <span class="badge bg-warning">{{ $property->propertyCondition->name }}</span>
                                        @endif
                                        
                                        @if($property->propertyCategory)
                                            <span class="badge bg-info">{{ $property->propertyCategory->name }}</span>
                                        @endif
                                        
                                        @if($property->propertyType)
                                            <span class="badge bg-primary">{{ $property->propertyType->name }}</span>
                                        @else
                                            <span class="text-muted">No Type</span>
                                        @endif
                                        
                                        @if($property->propertyCategory && strtolower($property->propertyCategory->name) === 'residential')
                                            <div class="mt-1">
                                                @if($property->bedroom_count)
                                                    <small class="text-muted">{{ $property->bedroom_count }} BHK</small>
                                                @endif
                                                @if($property->bathroom_count)
                                                    <small class="text-muted"> | {{ $property->bathroom_count }} Bath</small>
                                                @endif
                                                @if($property->area_sq_ft)
                                                    <br><small class="text-muted">{{ number_format($property->area_sq_ft) }} sq ft</small>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($property->location)
                                        <div>
                                            <strong>{{ $property->location->name }}</strong>
                                            @if($property->locality)
                                                <br><small class="text-muted">{{ $property->locality }}</small>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">No Location</span>
                                    @endif
                                </td>
                                <td>
                                    @if($property->price)
                                        <div>
                                            <strong>{{ $property->formatted_price }}</strong>
                                            @if($property->area_sq_ft)
                                                <br><small class="text-muted">{{ number_format($property->area_sq_ft) }} sq ft</small>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">Price on Request</span>
                                    @endif
                                </td>
                                <td>
                                    @if($property->highlight_images)
                                        <div class="d-flex flex-wrap gap-1">
                                            <div class="position-relative">
                                                <img src="{{ Storage::url($property->highlight_images) }}" 
                                                     alt="Highlight Image" 
                                                     class="img-thumbnail" 
                                                     style="width: 50px; height: 50px; object-fit: cover;"
                                                     data-bs-toggle="tooltip" 
                                                     title="{{ basename($property->highlight_images) }}">
                                            </div>
                                        </div>
                                        <small class="text-muted">1 image</small>
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="mb-1">
                                        {!! $property->status_badge !!}
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                               data-id="{{ $property->id }}"
                                               {{ $property->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input featured-toggle" type="checkbox"
                                               data-id="{{ $property->id }}"
                                               {{ $property->is_featured ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $property->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if(($canDelete ?? true) && request('show_trashed') && auth()->user()->isSuperAdmin())
                                            <form action="{{ route('properties.restore', $property->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success" title="Restore">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $properties->appends(request()->query())->links('pagination.bootstrap-4') }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-house display-1 text-muted"></i>
                <h3 class="mt-3">No Properties Found</h3>
                <p class="text-muted">Get started by adding your first property.</p>
                <a href="{{ route('properties.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Property
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle functionality
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const propertyId = this.dataset.id;
            const isActive = this.checked;
            
            fetch(`/properties/${propertyId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_active: isActive })
            })
            .then(response => response.json())
            .then(data => {
                if (data.is_active !== isActive) {
                    this.checked = data.is_active;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isActive; // Revert on error
            });
        });
    });

    // Featured toggle functionality
    document.querySelectorAll('.featured-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const propertyId = this.dataset.id;
            const isFeatured = this.checked;
            
            fetch(`/properties/${propertyId}/toggle-featured`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_featured: isFeatured })
            })
            .then(response => response.json())
            .then(data => {
                if (data.is_featured !== isFeatured) {
                    this.checked = data.is_featured;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isFeatured; // Revert on error
            });
        });
    });
});
</script>
@endpush
