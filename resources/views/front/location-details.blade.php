@extends('front.frontlayouts.frontapp')
@section('page-css')

@endsection
@section('content')
<div class="topserch">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="properties_intro-wrapper text-center">
                    <h1 class="properties_intro-heading">
                        {{ $location->heading ?? $location->name }}
                    </h1>
                    @if(!empty($location->meta_title))
                        <h2 class="properties_intro-sub_heading">
                            {{ $location->meta_title }}
                        </h2>
                    @endif
                    <div class="properties_intro-paragraph">
                        @if(!empty($location->site_description))
                            {!! nl2br(e($location->site_description)) !!}
                        @elseif(!empty($location->meta_description))
                            {!! nl2br(e($location->meta_description)) !!}
                        @else
                            Luxury Residences provides you unparalleled access to
                            the finest new developments <br>and private homes. Please savour our curated selection of
                            exquisite properties.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="searchbox innerserch">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search_form-container">
                    <div class="search_form-field">
                        <input class="search_form-textfield w-input" maxlength="256" name="query" placeholder="3 BHK Apartments, Gurgaon" type="text" id="query" />
                        <img loading="lazy" src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg" alt="" class="search_form-icon search_icon" />
                        <div id="search_form-settings_icon_white" class="search_form-icon_white"></div>
                    </div>
                    <input type="submit" data-wait="Please wait..." class="search_form-submit desk w-button" value="Search" />
                    <input type="submit" data-wait="Please wait..." class="search_form-submit mob w-button" value="" />

                    <div class="serchfilter" style="display:none" id="myDivser">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            @foreach($properCategory as $key => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#tab{{ $category->id }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach($properCategory as $key => $category)
                                <div class="tab-pane {{ $key == 0 ? 'active' : 'fade' }}" id="tab{{ $category->id }}">
                                    <form method="GET" action="{{ route('property.search') }}">
                                        <input type="hidden" name="form_type" value="{{ strtolower($category->name) }}">

                                        <div class="accordion" id="accordion_{{ $category->id }}">
                                            <!-- Location -->
                                            <div class="card">
                                                <div class="card-header" id="heading_location_{{ $category->id }}">
                                                    <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#collapse_location_{{ $category->id }}">
                                                        Location <small id="selected_location" class="text-muted ml-2"></small>
                                                    </a>
                                                </div>
                                                <div id="collapse_location_{{ $category->id }}" class="collapse show" data-parent="#accordion_{{ $category->id }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($allLocation as $location)
                                                                <div class="col-md-3">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="location" class="form-check-input filter-option" value="{{ $location->name }}">
                                                                            {{ $location->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Price -->
                                            <div class="card">
                                                <div class="card-header" id="heading_price_{{ $category->id }}">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_price_{{ $category->id }}">
                                                        Price <small id="selected_price" class="text-muted ml-2"></small>
                                                    </a>
                                                </div>
                                                <div id="collapse_price_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($propertiesPrice as $price)
                                                                <div class="col-md-3">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="price" class="form-check-input filter-option" value="{{ $price }}">
                                                                            {{ $price }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Type -->
                                            <div class="card">
                                                <div class="card-header" id="heading_type_{{ $category->id }}">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_type_{{ $category->id }}">
                                                        Type <small id="selected_property_type" class="text-muted ml-2"></small>
                                                    </a>
                                                </div>
                                                <div id="collapse_type_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($propertyTypeAll as $type)
                                                                <div class="col-md-3">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="property_type" class="form-check-input filter-option" value="{{ $type->name }}">
                                                                            {{ $type->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bedrooms (Residential only) -->
                                            @if(strtolower($category->name) == 'residential')
                                            <div class="card">
                                                <div class="card-header" id="heading_bedroom_{{ $category->id }}">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_bedroom_{{ $category->id }}">
                                                        Bedrooms <small id="selected_bedroom" class="text-muted ml-2"></small>
                                                    </a>
                                                </div>
                                                <div id="collapse_bedroom_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($propertiesbedroom as $bedroom)
                                                                <div class="col-md-3">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="bedroom" class="form-check-input filter-option" value="{{ $bedroom }}">
                                                                            {{ $bedroom }} BHK
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="search_form-filter_footer mt-3">
                                            <button type="submit" class="search_form-filter_submit_button w-button btn btn-primary">Confirm</button>
                                            <a href="{{ route('property.search') }}" class="search_form-filter_clear_button w-button btn btn-secondary">Clear</a>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="productlistsec">
    <div class="container">
        <div class="row">
            @forelse($properties as $property)
                <div class="col-md-6">
                    <div class="proboxcat {{ $property->is_sold ? 'soldrel' : '' }}">
                        {{-- Sold Out / Rented Out badge --}}
                        @if($property->is_sold)
                            <span class="sold">
                                <img src="{{ asset($property->property_category_id == 4 ? 'frontassets/images/rented-out.png' : 'frontassets/images/sold-out.png') }}" alt="{{ $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out' }}">
                            </span>
                        @endif

                        {{-- Property Image --}}
                        <div class="proboxcatimg">
                            @php
                                $image = $property->images->where('is_thumbnail', 1)->first() ?? $property->images->first();
                            @endphp
                            <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}">
                                @if($image && $image->image_path)
                                    <img src="{{ $image->listing_image_url }}" 
                                        alt="{{ $image->alt_text }}" 
                                        class="img-fluid"
                                        onerror="this.src='{{ asset('frontassets/images/no-image.jpg') }}'">
                                @else
                                    <img src="{{ asset('frontassets/images/no-image.jpg') }}" 
                                        alt="{{ $property->name }}" 
                                        class="img-fluid">
                                @endif
                            </a>
                        </div>

                        {{-- Property Details --}}
                        <div class="proboxcattext">
                            <h1 class="details_meta-property_title" title="{{ $property->name }}">
                                <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}"
                                   title="{{ $property->name }}">
                                    {{ $property->name }}
                                </a>
                            </h1>

                            <p>
                                {{ $property->propertyType->name ?? '' }} |
                                {{ $property->bedroom_count ?? '-' }} BHK |
                                {{ $property->area_sq_ft }} sq.ft
                            </p>

                            <p>Location: {{ $property->location->name ?? '' }}</p>

                            <div class="search_properties-details_price">
                                <div class="details_price-aed">
                                    {{ \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p>No properties found in this location.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


@endsection

@section('page-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.filter-option').forEach(el => {
    el.addEventListener('change', function() {
        this.closest('form').submit();
    });
});
</script>

@endsection


