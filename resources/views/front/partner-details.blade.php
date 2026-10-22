@extends('front.frontlayouts.frontapp')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <!-- Partner Header -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($partner->image)
                        <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}" class="mb-3" style="max-height: 100px;">
                    @endif
                    <h1 class="mb-3">{{ $partner->name }}</h1>
                    <p class="text-muted">{{ $properties->total() }} {{ $properties->total() == 1 ? 'Property' : 'Properties' }} Available</p>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('partner.show', $partner->slug) }}" class="row">
                        <div class="col-md-3">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach($propertyCategories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="location">Location</label>
                            <select name="location" id="location" class="form-control">
                                <option value="">All Locations</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="type">Property Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">All Types</option>
                                @foreach($propertyTypes as $type)
                                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Properties Grid -->
            <div class="row">
                @forelse($properties as $property)
                    <div class="col-md-4 mb-4">
                        <div class="card property-card h-100">
                            @php
                                $image = $property->images->where('is_thumbnail', 1)->first() ?? $property->images->first();
                            @endphp
                            @if($image && $image->image_path)
                                <img src="{{ $image->listing_image_url }}"
                                     class="card-img-top" alt="{{ $image->alt_text ?? $property->name }}" style="height: 250px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                @if($property->is_sold)
                                    <div class="position-absolute" style="top: 0; left: 0; width: 100%; height: 100%; z-index: 5; display: flex; justify-content: center; align-items: center; pointer-events: none;">
                                        <img src="{{ asset($property->property_category_id == 4 ? 'frontassets/images/rented-out.png' : 'frontassets/images/sold-out.png') }}" alt="{{ $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out' }}" style="max-width: 120px; max-height: 120px; width: auto; height: auto;">
                                    </div>
                                @endif
                                
                                <h5 class="card-title" title="{{ $property->name }}">
                                    <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}" class="text-decoration-none" title="{{ $property->name }}">
                                        {{ $property->name }}
                                    </a>
                                </h5>
                                
                                <p class="card-text">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    {{ $property->location ? $property->location->name : 'Location not specified' }}
                                </p>
                                
                                @if($property->propertyType)
                                    <p class="card-text">
                                        <strong>Type:</strong> {{ $property->propertyType->name }}
                                    </p>
                                @endif
                                
                                @if($property->area_sq_ft)
                                    <p class="card-text">
                                        <strong>Area:</strong> {{ number_format($property->area_sq_ft) }} sq.ft
                                    </p>
                                @endif
                                
                                <div class="mt-auto">
                                    @if($property->price)
                                        <h6 class="text-primary">{{ \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) }}</h6>
                                    @else
                                        <h6 class="text-primary">Price on Request</h6>
                                    @endif
                                    
                                    <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}" class="btn btn-outline-primary btn-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-info text-center">
                            <h4>No Properties Found</h4>
                            <p>{{ $partner->name }} doesn't have any properties matching your criteria.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($properties->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $properties->links('pagination.bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
