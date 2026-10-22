@extends('layouts.admin')

@section('title', 'Property Details')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Property: {{ $property->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-sm btn-warning me-2">
            <i class="bi bi-pencil me-2"></i>Edit Property
        </a>
        <a href="{{ route('properties.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Properties
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Basic Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Property Name</label>
                        <p class="mb-0">{{ $property->name }}</p>
                        @if($property->alias_name)
                            <small class="text-muted">{{ $property->alias_name }}</small>
                        @endif
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <p class="mb-0"><code>{{ $property->slug }}</code></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Badge</label>
                        <p class="mb-0">
                            @if($property->badge)
                                <span class="badge bg-info">{{ $property->badge->name }}</span>
                            @else
                                <span class="text-muted">No badge</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="mb-0">
                            {!! $property->status_badge !!}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Featured</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $property->is_featured ? 'success' : 'secondary' }}">
                                {{ $property->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sold</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $property->is_sold ? 'danger' : 'success' }}">
                                {{ $property->is_sold ? 'Yes' : 'No' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Relationships -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Relationships</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Partner</label>
                        <p class="mb-0">
                            @if($property->partner)
                                <a href="{{ route('partners.show', $property->partner) }}" class="text-decoration-none">
                                    {{ $property->partner->name }}
                                </a>
                            @else
                                <span class="text-muted">No partner assigned</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Agent</label>
                        <p class="mb-0">
                            @if($property->agent)
                                <a href="{{ route('agents.show', $property->agent) }}" class="text-decoration-none">
                                    {{ $property->agent->name }} - {{ $property->agent->designation }}
                                </a>
                            @else
                                <span class="text-muted">No agent assigned</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Location</label>
                        <p class="mb-0">
                            @if($property->location)
                                <a href="{{ route('locations.show', $property->location) }}" class="text-decoration-none">
                                    {{ $property->location->name }}
                                </a>
                            @else
                                <span class="text-muted">No location assigned</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Property Type</label>
                        <p class="mb-0">
                            @if($property->propertyType)
                                <span class="badge bg-primary">{{ $property->propertyType->name }}</span>
                            @else
                                <span class="text-muted">No type assigned</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Property Category</label>
                        <p class="mb-0">
                            @if($property->propertyCategory)
                                <a href="{{ route('property-categories.show', $property->propertyCategory) }}" class="text-decoration-none">
                                    {{ $property->propertyCategory->name }}
                                </a>
                            @else
                                <span class="text-muted">No category assigned</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Property Condition</label>
                        <p class="mb-0">
                            @if($property->propertyCondition)
                                <a href="{{ route('property-conditions.show', $property->propertyCondition) }}" class="text-decoration-none">
                                    {{ $property->propertyCondition->name }}
                                </a>
                            @else
                                <span class="text-muted">No condition assigned</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating & Reviews -->
        @if($property->rating || $property->review_count)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Rating & Reviews</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Rating</label>
                        <p class="mb-0">
                            @if($property->rating)
                                <span class="badge bg-warning">{{ $property->rating }}/5</span>
                            @else
                                <span class="text-muted">No rating</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Review Count</label>
                        <p class="mb-0">{{ $property->review_count ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Location Details -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Location Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Locality</label>
                        <p class="mb-0">{{ $property->locality ?: 'Not specified' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">RERA Registration</label>
                        <p class="mb-0">{{ $property->rera_reg_no ?: 'Not specified' }}</p>
                    </div>
                </div>

                @if($property->address)
                <div class="mb-3">
                    <label class="form-label fw-bold">Address</label>
                    <p class="mb-0">{{ $property->address }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Pricing -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Pricing</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Price</label>
                        <p class="mb-0">
                            @if($property->price)
                                <strong>{{ $property->formatted_price }}</strong>
                            @else
                                <span class="text-muted">Price on Request</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Area</label>
                        <p class="mb-0">
                            @if($property->area_sq_ft)
                                {{ number_format($property->area_sq_ft) }} sq ft
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </p>
                    </div>
                </div>

                @if($property->possession)
                <div class="mb-3">
                    <label class="form-label fw-bold">Possession Date</label>
                    <p class="mb-0">{{ $property->possession->format('M d, Y') }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Amenities -->
        @if($property->amenities->count() > 0 || $property->amenities_description)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Amenities</h5>
            </div>
            <div class="card-body">
                @if($property->amenities->count() > 0)
                <div class="mb-3">
                    <label class="form-label fw-bold">Selected Amenities</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($property->amenities as $amenity)
                            <span class="badge bg-primary">{{ $amenity->name }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($property->amenities_description)
                <div class="mb-3">
                    <label class="form-label fw-bold">Amenities Description</label>
                    <p class="mb-0">{{ $property->amenities_description }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Descriptions -->
        @if($property->property_description || $property->gallery_description || $property->floor_plan_description || $property->offer_text)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Descriptions</h5>
            </div>
            <div class="card-body">
                @if($property->property_description)
                <div class="mb-3">
                    <label class="form-label fw-bold">Property Description</label>
                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($property->property_description)) !!}
                    </div>
                </div>
                @endif

                @if($property->gallery_description)
                <div class="mb-3">
                    <label class="form-label fw-bold">Gallery Description</label>
                    <p class="mb-0">{{ $property->gallery_description }}</p>
                </div>
                @endif

                @if($property->floor_plan_description)
                <div class="mb-3">
                    <label class="form-label fw-bold">Floor Plan Description</label>
                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($property->floor_plan_description)) !!}
                    </div>
                </div>
                @endif

                @if($property->offer_text)
                <div class="mb-3">
                    <label class="form-label fw-bold">Offer Text</label>
                    <p class="mb-0">{{ $property->offer_text }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Location Features -->
        @if($property->airport || $property->entertainment || $property->national_highway || $property->hospitals || $property->education)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Location Features</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($property->airport)
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Airport</label>
                        <p class="mb-0">{{ $property->airport }}</p>
                    </div>
                    @endif

                    @if($property->entertainment)
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Entertainment</label>
                        <p class="mb-0">{{ $property->entertainment }}</p>
                    </div>
                    @endif

                    @if($property->national_highway)
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">National Highway</label>
                        <p class="mb-0">{{ $property->national_highway }}</p>
                    </div>
                    @endif

                    @if($property->hospitals)
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Hospitals</label>
                        <p class="mb-0">{{ $property->hospitals }}</p>
                    </div>
                    @endif

                    @if($property->education)
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Education</label>
                        <p class="mb-0">{{ $property->education }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Project Details -->
        @if($property->project_highlights_title || $property->location_features || $property->price_list)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Project Details</h5>
            </div>
            <div class="card-body">
                @if($property->project_highlights_title)
                <div class="mb-3">
                    <label class="form-label fw-bold">Project Highlights</label>
                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($property->project_highlights_title)) !!}
                    </div>
                </div>
                @endif

                @if($property->location_features)
                <div class="mb-3">
                    <label class="form-label fw-bold">Location Features</label>
                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($property->location_features)) !!}
                    </div>
                </div>
                @endif

                @if($property->price_list)
                <div class="mb-3">
                    <label class="form-label fw-bold">Price List</label>
                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($property->price_list)) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Map -->
        @if($property->map_code || $property->map_text)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Map</h5>
            </div>
            <div class="card-body">
                @if($property->map_code)
                <div class="mb-3">
                    <label class="form-label fw-bold">Map Code</label>
                    <div class="border rounded p-3 bg-light">
                        <code>{{ $property->map_code }}</code>
                    </div>
                </div>
                @endif

                @if($property->map_text)
                <div class="mb-3">
                    <label class="form-label fw-bold">Map Text</label>
                    <p class="mb-0">{{ $property->map_text }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- SEO -->
        @if($property->meta_title || $property->meta_description)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">SEO</h5>
            </div>
            <div class="card-body">
                @if($property->meta_title)
                <div class="mb-3">
                    <label class="form-label fw-bold">Meta Title</label>
                    <p class="mb-0">{{ $property->meta_title }}</p>
                </div>
                @endif

                @if($property->meta_description)
                <div class="mb-3">
                    <label class="form-label fw-bold">Meta Description</label>
                    <p class="mb-0">{{ $property->meta_description }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Property
                    </a>
                    
                    <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Properties
                    </a>
                </div>
            </div>
        </div>

        <!-- Property Stats -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Property Stats</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <small class="text-muted">Created</small>
                        <div>{{ $property->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Updated</small>
                        <div>{{ $property->updated_at->format('M d, Y') }}</div>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Status</small>
                    <div>
                        <span class="badge bg-{{ $property->is_active ? 'success' : 'secondary' }}">
                            {{ $property->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Sort Order</small>
                    <div>{{ $property->sort_order }}</div>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Home Sort</small>
                    <div>{{ $property->home_sort }}</div>
                </div>
            </div>
        </div>

        <!-- Property Preview -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Property Preview</h6>
            </div>
            <div class="card-body">
                <h5 class="mb-2">{{ $property->name }}</h5>
                @if($property->alias_name)
                    <p class="text-muted small mb-2">{{ $property->alias_name }}</p>
                @endif
                <code class="small text-muted mb-2 d-block">{{ $property->slug }}</code>
                @if($property->propertyType)
                    <div class="mb-2">
                        <span class="badge bg-primary">{{ $property->propertyType->propertyCategory->name ?? '' }}</span>
                        <span class="badge bg-secondary">{{ $property->propertyType->propertyCondition->name ?? '' }}</span>
                        <br><small>{{ $property->propertyType->name }}</small>
                    </div>
                @endif
                <div class="mb-2">
                    <strong>{{ $property->formatted_price ?: 'Price on Request' }}</strong>
                    @if($property->area_sq_ft)
                        <br><small class="text-muted">{{ number_format($property->area_sq_ft) }} sq ft</small>
                    @endif
                </div>
                <div class="mb-2">
                    {!! $property->status_badge !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
