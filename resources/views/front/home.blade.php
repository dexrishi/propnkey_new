@extends('front.frontlayouts.frontapp')

@section('page-css')
<style>
/* Ensure carousel items have equal height */
.projextt .owl-stage {
    display: flex;
    align-items: stretch;
}

.projextt .owl-item {
    display: flex;
    align-items: stretch;
}

.projextt .slide {
    display: flex;
    align-items: stretch;
    height: 100%;
}

.projextt .samplebox {
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
}

.projextt .sampletext {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* View All Category Card Hover Effect */
.view-all-category-link {
    height: 100%;
    display: flex;
}

.view-all-category-link:hover .view-all-category-card {
    border-color: #a98862;
    background: rgba(169, 134, 98, 0.1);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(169, 134, 98, 0.2);
}

.view-all-category-link:hover .view-all-icon {
    transform: translateX(10px);
}

.view-all-category-link .view-all-category-card .sampleimg {
    transition: background 0.3s ease;
}

.view-all-category-link:hover .view-all-category-card .sampleimg {
    background: linear-gradient(135deg, rgba(169, 134, 98, 0.15) 0%, rgba(169, 134, 98, 0.1) 100%) !important;
}

/* Make location property cards fully clickable */
.location-property-card-link {
    display: block;
    text-decoration: none;
    color: inherit;
    transition: opacity 0.3s ease;
}

.location-property-card-link:hover {
    opacity: 0.95;
}

.location-property-card-link .locabox {
    cursor: pointer;
    height: 100%;
}

.location-property-card-link .btnbox .enc,
.location-property-card-link .btnbox .view {
    cursor: pointer;
    pointer-events: auto;
}

.location-property-card-link .btnbox .app {
    pointer-events: auto;
}

/* Fix location property buttons on mobile - make them visible without hover */
@media only screen and (max-width: 767px) {
    
    /* Ensure buttons are properly sized and visible on mobile */
    .btnbox {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        flex-wrap: nowrap;
    }
    
    .btnbox .enc,
    .btnbox .view {
        flex: 1;
        min-width: 0;
        padding: 10px 12px;
        font-size: 12px;
        white-space: nowrap;
        text-align: center;
    }
    
    .btnbox .app {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
    }
    
    /* Hide project count on mobile for developers section */
    .developssec .devatext {
        display: none !important;
    }
}

/* Property name truncation for residential properties */
.projextt .sampletext p {
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    line-height: 1.4;
    max-height: 2.8em; /* 2 lines * 1.4 line-height */
}

.projextt .sampletext p a {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    word-break: break-word;
    text-decoration: none;
    color: inherit;
}

/* Ensure property name doesn't break layout */
.projextt .sampletext {
    min-height: 0;
}

/* Location property name truncation — one line so card heights match */
.location-property-card-link .locatext h6 {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    line-height: 1.35;
    max-width: 100%;
    margin-bottom: 0.5rem;
}

.location-property-card-link .locatext h6 a {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
@endsection

@section('content')

    <!-- Hero Banner Section -->
    <div class="banner-section">
        <div class="videosec">
            @php
                $heroMediaUrl = \App\Helpers\SiteConfigHelper::get('hero_video_url', '');
                $isVideo = false;
                
                // If it's a storage path (doesn't contain 'http'), prepend storage URL
                if ($heroMediaUrl && strpos($heroMediaUrl, 'http') !== 0) {
                    $heroMediaUrl = asset('storage/' . $heroMediaUrl);
                }
                
                // Check if it's a video file
                if ($heroMediaUrl) {
                    $extension = strtolower(pathinfo(parse_url($heroMediaUrl, PHP_URL_PATH), PATHINFO_EXTENSION));
                    $videoExtensions = ['mp4', 'webm', 'ogg', 'avi', 'mov', 'wmv'];
                    $isVideo = in_array($extension, $videoExtensions);
                }
            @endphp
            
            @if($heroMediaUrl)
                @if($isVideo)
                    <video autoplay loop muted playsinline webkit-playsinline>
                        <source src="{{ $heroMediaUrl }}">
                    </video>
                @else
                    <img src="{{ $heroMediaUrl }}" alt="Hero Image" style="width: 100%; object-fit: cover; object-position: center;">
                @endif
            @endif
            
            <div class="hero_title-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="padding-global">
                                <div class="w-layout-blockcontainer hero_container w-container">
                                    <h1 class="hero_title">{{ \App\Helpers\SiteConfigHelper::get('hero_title_line1', 'The home of sophisticated') }}</h1>
                                    <h1 class="hero_title text-align-right">{{ \App\Helpers\SiteConfigHelper::get('hero_title_line2', 'and luxurious') }}</h1>
                                    <h1 class="hero_sub-title">{{ \App\Helpers\SiteConfigHelper::get('hero_subtitle', 'living') }}</h1>
                                    <p class="hero_description">{{ \App\Helpers\SiteConfigHelper::get('hero_description', 'A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Component -->
    <x-property-search 
        :searchPlaceholder="\App\Helpers\SiteConfigHelper::get('search_placeholder', '3 BHK Apartments, Gurgaon')"
        :searchIconUrl="\App\Helpers\SiteConfigHelper::get('search_icon_url', 'https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg')"
        :isInnerSearch="false"
    />

    <!-- Private Residences Section -->
    <div class="projextt ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="stitle">
                        {!! nl2br(e(\App\Helpers\SiteConfigHelper::get('private_residences_title_1', 'Private'))) !!} <br>
                        {!! nl2br(e(\App\Helpers\SiteConfigHelper::get('private_residences_title_2', 'Residences'))) !!}
                    </h2>
                    <h2 class="private_properties-sub1 margin-top-1">
                        {{ \App\Helpers\SiteConfigHelper::get('private_residences_title_3', 'Collection') }}
                    </h2>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <!-- Navigation Pills -->
                    <ul class="nav nav-pills" role="tablist">
                        @if(isset($propertyCategories) && $propertyCategories->count() > 0)
                            @foreach($propertyCategories as $index => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" data-toggle="tab" href="#category-{{ $category->slug }}" role="tab" aria-controls="category-{{ $category->slug }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}" data-category-name="{{ $category->name }}" data-category-slug="{{ $category->slug }}">
                                        <span class="category-name">{{ $category->name }}</span>
                                        <span class="badge badge-light">{{ $category->properties_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <!-- Fallback to default tabs if no categories -->
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#default1" role="tab">All Properties</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        @if(isset($propertyCategories) && $propertyCategories->count() > 0)
                            @foreach($propertyCategories as $index => $category)
                                <div class="tab-pane {{ $index === 0 ? 'active' : 'fade' }}" id="category-{{ $category->slug }}" role="tabpanel">
                                    <div class="owl-carousel slider{{ $category->id }}" data-category-id="{{ $category->id }}" data-loaded="{{ $category->properties->count() }}" data-offset="{{ $category->properties->count() }}">
                                        @forelse($category->properties as $property)
                                            <div class="slide">
                                                <div class="samplebox {{ $property->is_sold ? 'soldrel' : '' }}">
                                                    @if($property->is_sold)
                                                        <span class="sold">
                                                            <img src="{{ asset($property->property_category_id == 4 ? 'frontassets/images/rented-out.png' : 'frontassets/images/sold-out.png') }}" alt="{{ $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out' }}">
                                                        </span>
                                                    @endif
                                                    
                                                    <div class="sampleimg" style="position: relative;">
                                                        @if($property->badge)
                                                            <span class="property-badge" style="position: absolute; top: 10px; left: 10px; z-index: 10; background: #a98862; color: #fff; padding: 5px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-transform: uppercase; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">{{ $property->badge->name }}</span>
                                                        @endif
                                                        <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}">
                                                            @php
                                                                $image = $property->images->where('is_thumbnail', 1)->first() ?? $property->images->first();
                                                            @endphp
                                                            @if($image && $image->image_path)
                                                                <img src="{{ $image->listing_image_url }}" alt="{{ $image->alt_text ?? $property->name }}" class="private_properties_image">
                                                            @else
                                                                <img src="{{ asset('/frontassets/images/placeholder.jpg') }}" alt="{{ $property->name }}" class="private_properties_image">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="sampletext">
                                                        <span><i class="fas fa-map-marker-alt"></i> {{ $property->location ? $property->location->name : 'Location not specified' }}</span>
                                                        <p><a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}" title="{{ $property->name }}">{{ $property->name }}</a></p>
                                                        
                                                        <div class="private_property-footer">
                                                            <div class="private_property-footer_left">
                                                                <div class="private_property-price_aed">{{ \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) }}</div>
                                                            </div>
                                                            <div class="private_property-footer_right">
                                                                @if($property->propertyType)
                                                                    <div class="private_property-amenties w-embed">{{ $property->propertyType->name }}</div>
                                                                @endif
                                                                @if($property->area_sq_ft)
                                                                    <div class="private_property-amenties">{{ number_format($property->area_sq_ft) }} sq.ft</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="slide">
                                                <div class="samplebox">
                                                    <div class="sampletext text-center">
                                                        <p>No properties available in this category.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                        
                                        <!-- View All Category Properties Card - Only show if more than 20 properties -->
                                        @if(($category->properties_count ?? $category->properties->count()) > 20)
                                        <div class="slide">
                                            <a href="/{{ $category->slug }}-properties" class="view-all-category-link" style="text-decoration: none; display: block; height: 100%;">
                                                <div class="samplebox view-all-category-card" style="cursor: pointer; border: 2px dashed #a98862; background: rgba(169, 134, 98, 0.05); transition: all 0.3s ease; height: 28rem; display: flex; align-items: center; justify-content: center; border-radius: 3px;">
                                                    <div style="text-align: center; padding: 20px;">
                                                        <i class="fas fa-arrow-right view-all-icon" style="font-size: 48px; color: #a98862; margin-bottom: 20px; display: block; transition: transform 0.3s ease;"></i>
                                                        <h3 style="color: #a98862; font-weight: 600; margin-bottom: 10px; font-size: 1.5rem; margin: 0 0 10px 0;">View All</h3>
                                                        <p style="color: #333; font-size: 18px; font-weight: 500; margin: 0;">{{ $category->name }} Properties</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="counter">
                                        <span id="currentSlide{{ $category->id }}">1</span> / <span id="totalSlides{{ $category->id }}"></span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback content if no categories -->
                            <div class="tab-pane active" id="default1" role="tabpanel">
                                <div class="owl-carousel slider1">
                                    <div class="slide">
                                        <div class="samplebox">
                                            <div class="sampletext text-center">
                                                <p>No property categories available.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-12 text-center mt-4">
                    @if(isset($propertyCategories) && $propertyCategories->count() > 0)
                        @php
                            $firstCategory = $propertyCategories->first();
                        @endphp
                        <a href="/{{ $firstCategory->slug }}-properties" class="private_property-button" id="viewAllResidencesBtn" data-default-text="View All Residences">
                            <div class="private_property-button_text">View All {{ $firstCategory->name }} Properties <i class="fal fa-arrow-right"></i></div>
                        </a>
                    @else
                        <a href="/all-properties" class="private_property-button">
                            <div class="private_property-button_text">View All Residences <i class="fal fa-arrow-right"></i></div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- New Developments Section -->
    @php
        // Get new developments from the new_developments table, ordered by sort_order
        $newDevelopments = \App\Models\NewDevelopment::with(['property.images', 'property.location', 'property.propertyType', 'property.badge', 'property.propertyCategory'])
            ->whereHas('property', function($query) {
                $query->where('is_active', true);
            })
            ->ordered()
            ->get();
        
        // Extract properties from new developments
        $latestProperties = $newDevelopments->map(function($development) {
            return $development->property;
        })->filter(); // Remove any null properties
    @endphp
    
    @if($latestProperties->count() > 0)
    <div class="develp">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="stitle new_devs">{{ \App\Helpers\SiteConfigHelper::get('new_developments_title', 'New Developments') }}</h2>
                    <div class="new_developments-text">{{ \App\Helpers\SiteConfigHelper::get('new_developments_description', 'A curated selection of the finest new developments that perfectly embody world class design, lifestyle and quality.') }}</div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    @foreach($latestProperties as $property)
                        <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}" class="devbox-link" style="display: block; text-decoration: none;">
                            @php
                                $bgImage = $property->images->where('is_thumbnail', 1)->first() ?? $property->images->first();
                                $bgImageUrl = $bgImage && $bgImage->image_path ? asset('storage/' . $bgImage->image_path) : asset('/frontassets/images/placeholder.jpg');
                            @endphp
                            <div class="devbox {{ $property->is_sold ? 'soldrel' : '' }}" 
                                 style="background-image: url('{{ $bgImageUrl }}'); position: relative;">
                                @if($property->is_sold)
                                    <span class="sold">
                                        <img src="{{ asset($property->property_category_id == 4 ? 'frontassets/images/rented-out.png' : 'frontassets/images/sold-out.png') }}" alt="{{ $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out' }}">
                                    </span>
                                @endif
                                
                                @if($property->badge)
                                    <span class="property-badge" style="position: absolute; top: 15px; left: 15px; z-index: 10; background: #a98862; color: #fff; padding: 6px 14px; border-radius: 4px; font-size: 12px; font-weight: 600; text-transform: uppercase; box-shadow: 0 2px 6px rgba(0,0,0,0.3);">{{ $property->badge->name }}</span>
                                @endif
                                
                                <h3 class="new_developments-list_item_title" title="{{ $property->name }}">{{ $property->name }}</h3>
                                
                                <div class="pricelist">
                                    <div class="locatin">
                                        <p><span> Location:</span> {{ $property->location ? $property->location->name : 'Location not specified' }}</p>
                                        <p><span>Prices from:</span> {{ \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) }}</p>
                                    </div>
                                    <div class="conbtn">
                                        <span>View more details <i class="fal fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="col-md-12 text-center mt-5">
                    <a href="/all-properties" class="private_property-button">
                        <div class="private_property-button_text">View All New Developments <i class="fal fa-arrow-right"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

<style>
/* Make devbox clickable */
.devbox-link {
    display: block;
    text-decoration: none;
    color: inherit;
    transition: opacity 0.3s ease;
}

.devbox-link:hover {
    opacity: 0.95;
}

.devbox-link .devbox {
    cursor: pointer;
}

.devbox-link .new_developments-list_item_title {
    color: #fff !important;
    text-decoration: none;
}

/* Style the conbtn span to look like the original link */
.devbox-link .conbtn span {
    display: inline-block;
    border: 1px solid #fff;
    color: #fff;
    text-align: center;
    background-color: transparent;
    border-radius: 50px;
    padding: .8rem 1.5rem;
    font-family: Graphiklcg, sans-serif;
    font-size: 16px;
    text-decoration: none;
    font-weight: 400;
    transition: all 0.3s ease;
}

.devbox-link:hover .conbtn span {
    background-color: rgba(255, 255, 255, 0.1);
}
</style>

    <!-- Locations Section -->
    <div class="location ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="stitle">{{ \App\Helpers\SiteConfigHelper::get('locations_title', 'Locations') }}</h2>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <!-- Navigation Pills -->
                    <ul class="nav nav-pills" role="tablist">
                        @if(isset($locations) && $locations->count() > 0)
                            @foreach($locations as $index => $location)
                                <li class="nav-item">
                                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" data-toggle="tab" href="#location-{{ $location->slug }}" role="tab" aria-controls="location-{{ $location->slug }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                        {{ $location->name }}
                                        <span class="badge badge-light">{{ $location->properties_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <!-- Fallback if no locations -->
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#defaultLocation" role="tab">All Locations</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        @if(isset($locations) && $locations->count() > 0)
                            @foreach($locations as $index => $location)
                                <div class="tab-pane container {{ $index === 0 ? 'active' : 'fade' }}" id="location-{{ $location->slug }}" role="tabpanel">
                                    <div class="owl-carousel locasslider">
                                        @forelse($location->properties as $property)
                                            <div class="pslider {{ $property->is_sold ? 'soldrel' : '' }}">
                                                @if($property->is_sold)
                                                    <span class="sold">
                                                        <img src="{{ asset($property->property_category_id == 4 ? 'frontassets/images/rented-out.png' : 'frontassets/images/sold-out.png') }}" alt="{{ $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out' }}">
                                                    </span>
                                                @endif
                                                
                                                <div class="location-property-card-link" 
                                                     data-property-url="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}"
                                                     style="display: block; text-decoration: none; color: inherit; cursor: pointer;">
                                                <div class="locabox">
                                                        <div class="location-property-image">
                                                            @php
                                                                $image = $property->images->where('is_thumbnail', 1)->first() ?? $property->images->first();
                                                            @endphp
                                                            @if($image && $image->image_path)
                                                                <img src="{{ $image->listing_image_url }}" alt="{{ $image->alt_text ?? $property->name }}" class="img-fluid">
                                                        @else
                                                            <img src="{{ asset('/frontassets/images/placeholder.jpg') }}" alt="{{ $property->name }}" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="locatext">
                                                            <h6 style="color: inherit; text-decoration: none;" title="{{ $property->name }}">{{ $property->name }}</h6>
                                                        <p class="lctn"><i class="fas fa-map-marker-alt"></i> {{ $location->name }}</p>
                                                        
                                                        <div class="btnbox">
                                                            <a href="javascript:void(0)" 
                                                               class="enc" 
                                                                   data-property-name="{{ addslashes($property->name) }}">Enquire Now</a>
                                                                    <a class="view" href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}">View Details</a>
                                                                <a href="https://wa.me/{{ \App\Helpers\SiteConfigHelper::whatsappNumber() }}?text=Hi, I'm interested in {{ urlencode($property->name) }}" 
                                                                   target="_blank" 
                                                                   class="app">
                                                                <i class="fab fa-whatsapp"></i>
                                                            </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="pslider">
                                                <div class="locabox">
                                                    <div class="locatext text-center">
                                                        <h6>No Properties Available</h6>
                                                        <p class="lctn">No properties found in {{ $location->name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    
                                    <div class="col-md-12 text-center mt-5">
                                        <a href="{{ route('location.properties', $location->slug) }}" class="private_property-button">
                                            <div class="private_property-button_text">View All Properties in {{ $location->name }} <i class="fal fa-arrow-right"></i></div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback content if no locations -->
                            <div class="tab-pane container active" id="defaultLocation" role="tabpanel">
                                <div class="owl-carousel locasslider">
                                    <div class="pslider">
                                        <div class="locabox">
                                            <div class="locatext text-center">
                                                <h6>No Locations Available</h6>
                                                <p class="lctn">No locations found in the system</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="servi ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="our_services-heading">{{ \App\Helpers\SiteConfigHelper::get('our_services_title', 'Our services') }}</h1>
                    <div class="our_services-text">{{ \App\Helpers\SiteConfigHelper::get('our_services_description', 'Luxury Residences provide a singular destination for your real estate, financial, lifestyle, legal and immigration requirements. Our suite of specialist services will ensure all of your needs are dealt with effectively and discreetly to your utmost satisfaction.') }}<br></div>
                </div>
                
                <div class="col-md-6">
                    <div class="our_services-right_box">
                        @if(isset($propertyCategories) && $propertyCategories->count() > 0)
                            @foreach($propertyCategories->take(5) as $category)
                                <a href="/{{ $category->slug }}-properties" class="our_services-link w-inline-block">
                                    <div class="our_services-link_text">{{ $category->name }}</div>
                                </a>
                            @endforeach
                        @endif
                        
                        <a href="{{ route('services') }}" class="our_services_right_box-button w-inline-block">
                            <div class="private_property-button_text">View More </div><i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="about ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="our-story-heading_component mb-4">
                        <span class="our-story-heading_welcome">
                            {{ \App\Helpers\SiteConfigHelper::get('about_title', 'About') }} Propnkey
                        </span>
                    </h2>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="abtimg">
                        @php
                            $aboutImage1 = \App\Helpers\SiteConfigHelper::get('about_image_1');
                            $aboutImage2 = \App\Helpers\SiteConfigHelper::get('about_image_2');
                        @endphp
                        @if($aboutImage1)
                            <img src="{{ asset('storage/' . ltrim($aboutImage1, '/')) }}" alt="" class="left_image-1">
                        @endif
                        @if($aboutImage2)
                            <img src="{{ asset('storage/' . ltrim($aboutImage2, '/')) }}" alt="" class="left_image-2">
                        @endif
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="abttext">
                        <p>{{ \App\Helpers\SiteConfigHelper::get('about_description', 'An international collective of best-in-class real estate aficionados who have come together to pioneer a shared vision of innovative excellence. Headquartered in Dubai, the most exciting luxury real estate market on the planet, it is our philosophy to offer world class service, advice and access to the finest homes. Hosting an award winning and highly experienced team drawn from leading international brands we offer a refreshing, dynamic and highly effective approach to the global citizen with regards to their real estate and related lifestyle and investment requirements.') }}</p>
                        <a href="{{ route('about') }}" class="our_services_right_box-button w-inline-block">
                            <div class="private_property-button_text">{{ \App\Helpers\SiteConfigHelper::get('about_button_text', 'View More') }} </div><i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Developers Section -->
    <div class="developssec ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="stitle new_dev">{{ \App\Helpers\SiteConfigHelper::get('developers_title', 'Developers') }}</h2>
                    <!-- Cache bust: {{ time() }} -->
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel devslider">
                        @if(isset($partners) && $partners->count() > 0)
                            @php
                                $partnerChunks = $partners->chunk(2); // Group partners in pairs of 2
                            @endphp
                            
                            @foreach($partnerChunks as $chunk)
                                <div class="devitem">
                                    @foreach($chunk as $partner)
                                        <div class="devabox">
                                            <div class="devimg">
                                                <a href="/builder/{{ $partner->slug }}">
                                                    @if($partner->image)
                                                        <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}">
                                                    @else
                                                        <img src="{{ asset('/frontassets/images/placeholder-partner.png') }}" alt="{{ $partner->name }}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="devatext">
                                                <p class="mb-0">{{ $partner->active_properties_count }} {{ $partner->active_properties_count == 1 ? 'Project' : 'Projects' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback content if no partners -->
                            <div class="devitem">
                                <div class="devabox">
                                    <div class="devimg">
                                        <img src="{{ asset('/frontassets/images/placeholder-partner.png') }}" alt="No Partners">
                                    </div>
                                    <div class="devatext">
                                        <h5>No Partners Available</h5>
                                        <p class="mb-0">0 Projects</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="counter">
                        <span id="currentSlide6">1</span> / <span id="totalSlides6"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="stitle new_dev">{{ \App\Helpers\SiteConfigHelper::get('testimonials_title', 'Testimonials') }}</h2>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel testslider">
                        @if(isset($testimonials) && $testimonials->count() > 0)
                            @foreach($testimonials as $testimonial)
                                <div class="testitem">
                                    <div class="testbox">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="testimonial-comment">{{ $testimonial->comment }}</p>
                                        
                                        <div class="tinfo">
                                            <div class="timg">
                                                @if($testimonial->image)
                                                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                                                @else
                                                    <div class="testimonial-avatar">
                                                        {{ $testimonial->initials }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ttext">
                                                <h5>{{ $testimonial->name }}</h5>
                                                <p>{{ $testimonial->designation }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback testimonials if none exist -->
                            <div class="testitem">
                                <div class="testbox">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="testimonial-comment">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quod ullam officia quaerat velit optio dolore explicabo a nobis asperiores. Neque enim quasi illum fuga odit atque mollitia beatae alias.</p>
                                    <div class="tinfo">
                                        <div class="timg">
                                            <img src="{{ asset('/frontassets/images/dlf-logo.png') }}" alt="">
                                        </div>
                                        <div class="ttext">
                                            <h5>Sample Customer</h5>
                                            <p>Happy Client</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="counter">
                        <span id="currentSlide10">1</span> / <span id="totalSlides10"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
/* Make testimonial items equal height */
.testslider .owl-stage {
    display: flex;
    align-items: stretch;
}

.testslider .owl-item {
    display: flex;
    align-items: stretch;
}

.testitem {
    height: 100%;
    display: flex;
    align-items: stretch;
}

.testbox {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 100%;
    flex: 1;
}

.testimonial-comment {
    flex: 1;
    display: flex;
    align-items: flex-start;
}
</style>

<script>
$(document).ready(function() {
    // Function to match testimonial box heights dynamically
    function matchTestimonialHeights() {
        var maxHeight = 0;
        
        // Reset heights first
        $('.testitem').css('height', 'auto');
        
        // Find the tallest testimonial box
        $('.testitem').each(function() {
            var height = $(this).outerHeight();
            if (height > maxHeight) {
                maxHeight = height;
            }
        });
        
        // Set all boxes to the same height
        if (maxHeight > 0) {
            $('.testitem').css('height', maxHeight + 'px');
        }
    }
    
    // Match heights on page load
    setTimeout(matchTestimonialHeights, 300);
    
    // Match heights after carousel initialization
    if ($('.testslider').length) {
        $('.testslider').on('initialized.owl.carousel', function() {
            setTimeout(matchTestimonialHeights, 300);
        });
        
        $('.testslider').on('translated.owl.carousel', function() {
            setTimeout(matchTestimonialHeights, 300);
        });
        
        $('.testslider').on('changed.owl.carousel', function() {
            setTimeout(matchTestimonialHeights, 300);
        });
    }
    
    // Also match on window resize
    $(window).on('resize', function() {
        setTimeout(matchTestimonialHeights, 300);
    });
});
</script>

    <!-- Property Enquiry Modal -->
    <div class="modal fade" id="propertyEnquiryModal" tabindex="-1" role="dialog" aria-labelledby="propertyEnquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content enquiry-modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
                <div class="modal-body enquiry-modal-body">
                    <div class="enquiry-form-wrapper">
                        <h4 class="enquiry-form-title">Let's Stay in Touch</h4>
                        <p class="enquiry-form-subtitle">Fill in your details and we'll get back to you shortly</p>
                        
                        <form id="propertyEnquiryForm" action="{{ route('property.inquiry.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="project_name" id="enquiryProjectName">
                            <input type="hidden" name="form_name" value="Home Enquiry Modal">
                            <input type="hidden" name="url" value="{{ url()->current() }}">
                            
                            <div class="form-group enquiry-form-group">
                                <div class="enquiry-input-wrapper">
                                    <i class="fas fa-user enquiry-input-icon"></i>
                                    <input type="text" 
                                           class="form-control enquiry-form-control" 
                                           id="enquiryFullName" 
                                           name="full_name" 
                                           placeholder="Full name" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="form-group enquiry-form-group">
                                <div class="enquiry-input-wrapper">
                                    <i class="fas fa-envelope enquiry-input-icon"></i>
                                    <input type="email" 
                                           class="form-control enquiry-form-control" 
                                           id="enquiryEmail" 
                                           name="email" 
                                           placeholder="Email address" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="form-group enquiry-form-group">
                                <div class="enquiry-input-wrapper">
                                    <i class="fas fa-phone enquiry-input-icon"></i>
                                    <input type="tel" 
                                           class="form-control enquiry-form-control" 
                                           id="enquiryPhone" 
                                           name="phone" 
                                           placeholder="Mobile number" 
                                           required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn enquiry-submit-btn">
                                <span>Submit</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-css-inline')
<style>
    .enquiry-modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
        margin: 0 auto;
        position: relative;
    }
    
    #propertyEnquiryModal .modal-dialog {
        margin: 1.75rem auto;
        max-width: 500px;
        width: 90%;
        position: relative;
        pointer-events: none;
    }
    
    #propertyEnquiryModal .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
        margin: 1.75rem auto;
    }
    
    .enquiry-modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        margin-left: auto;
        margin-right: auto;
    }
    
    .enquiry-modal-content .close {
        position: absolute;
        top: 15px;
        right: 20px;
        z-index: 10;
        color: #4a5568;
        font-size: 28px;
        font-weight: 300;
        opacity: 0.7;
        transition: all 0.3s;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: transparent;
    }
    
    .enquiry-modal-content .close:hover {
        opacity: 1;
        background: rgba(0, 0, 0, 0.05);
        color: #2d3748;
    }
    
    .enquiry-modal-body {
        padding: 0;
        background: #ffffff;
    }
    
    .enquiry-form-wrapper {
        padding: 50px 40px;
        text-align: center;
    }
    
    .enquiry-form-title {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        margin: 0 0 15px 0;
        letter-spacing: -0.3px;
    }
    
    .enquiry-form-subtitle {
        color: #718096;
        font-size: 14px;
        margin: 0 0 35px 0;
        line-height: 1.6;
    }
    
    .enquiry-form-group {
        margin-bottom: 20px;
        text-align: left;
    }
    
    .enquiry-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .enquiry-input-icon {
        position: absolute;
        left: 18px;
        color: #718096;
        font-size: 16px;
        z-index: 1;
        pointer-events: none;
    }
    
    .enquiry-form-control {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px 18px 14px 50px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #ffffff;
        width: 100%;
        font-family: inherit;
        color: #2d3748;
    }
    
    .enquiry-form-control:focus {
        border-color: #667eea;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    
    .enquiry-form-control::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }
    
    .enquiry-submit-btn {
        width: 100%;
        background: #2d3748;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 14px 24px;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 10px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(45, 55, 72, 0.2);
    }
    
    .enquiry-submit-btn:hover {
        background: #1a202c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(45, 55, 72, 0.3);
        color: #fff;
    }
    
    .enquiry-submit-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(45, 55, 72, 0.2);
    }
    
    @media (max-width: 576px) {
        .enquiry-modal-content {
            border-radius: 12px;
            margin: 20px;
        }
        
        .enquiry-modal-content .close {
            top: 12px;
            right: 15px;
            font-size: 24px;
            width: 32px;
            height: 32px;
        }
        
        .enquiry-form-wrapper {
            padding: 40px 30px;
        }
        
        .enquiry-form-title {
            font-size: 24px;
            margin-bottom: 12px;
        }
        
        .enquiry-form-subtitle {
            font-size: 13px;
            margin-bottom: 30px;
        }
        
        .enquiry-form-group {
            margin-bottom: 18px;
        }
        
        .enquiry-form-control {
            padding: 12px 16px 12px 45px;
            font-size: 14px;
        }
        
        .enquiry-input-icon {
            left: 16px;
            font-size: 15px;
        }
        
        .enquiry-submit-btn {
            padding: 12px 20px;
            font-size: 14px;
        }
    }
</style>
@endsection

@section('page-js')
    <!-- Hero Video iOS Compatibility -->
    <script>
        $(document).ready(function() {
            // Handle iOS video playback
            var heroVideo = document.querySelector('.videosec video');
            if (heroVideo) {
                // Set playsinline attribute programmatically for iOS
                heroVideo.setAttribute('playsinline', '');
                heroVideo.setAttribute('webkit-playsinline', '');
                
                // Attempt to play video (iOS may still require user interaction)
                var playPromise = heroVideo.play();
                
                // Handle play promise for better error handling
                if (playPromise !== undefined) {
                    playPromise.then(function() {
                        // Video is playing
                        console.log('Hero video is playing');
                    }).catch(function(error) {
                        // Autoplay was prevented - this is normal on iOS
                        console.log('Video autoplay prevented:', error);
                        
                        // Try to play on first user interaction
                        var playOnInteraction = function() {
                            heroVideo.play().catch(function(e) {
                                console.log('Could not play video:', e);
                            });
                            // Remove listeners after first attempt
                            document.removeEventListener('touchstart', playOnInteraction);
                            document.removeEventListener('click', playOnInteraction);
                        };
                        
                        document.addEventListener('touchstart', playOnInteraction, { once: true });
                        document.addEventListener('click', playOnInteraction, { once: true });
                    });
                }
            }
        });
    </script>
    
    <!-- Enquiry Modal JavaScript -->
    <script>
        function openEnquiryModal(property) {
            // Set property name in hidden field
            document.getElementById('enquiryProjectName').value = property.name;
            
            // Reset form
            document.getElementById('propertyEnquiryForm').reset();
            document.getElementById('enquiryProjectName').value = property.name;
            
            // Show modal using Bootstrap
            $('#propertyEnquiryModal').modal('show');
        }
        
        // Handle form submission
        $(document).ready(function() {
            $('#propertyEnquiryForm').on('submit', function(e) {
                e.preventDefault();
                
                var form = $(this);
                var submitBtn = form.find('.enquiry-submit-btn');
                var originalText = submitBtn.html();
                
                // Disable button and show loading
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Submitting...');
                
                // Get form values
                var fullName = $('#enquiryFullName').val().trim();
                
                // Create form data
                var formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('name', fullName);
                formData.append('email', $('#enquiryEmail').val());
                formData.append('phone', $('#enquiryPhone').val());
                formData.append('message', ''); // Optional for property inquiries
                formData.append('project_name', $('#enquiryProjectName').val());
                formData.append('form_name', $('input[name="form_name"]', form).val() || 'Home Enquiry Modal');
                formData.append('url', $('input[name="url"]', form).val() || window.location.href);
                
                // Submit via AJAX
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        // Show success message
                        submitBtn.html('<i class="fas fa-check"></i> Submitted!');
                        submitBtn.css('background', '#48bb78');
                        
                        var successMessage = response.message || 'Thank you! Your enquiry has been submitted successfully. We will contact you soon.';
                        
                        // Reset form after 2 seconds and close modal
                        setTimeout(function() {
                            form[0].reset();
                            $('#propertyEnquiryModal').modal('hide');
                            submitBtn.html(originalText);
                            submitBtn.prop('disabled', false);
                            submitBtn.css('background', '');
                            
                            alert(successMessage);
                        }, 2000);
                    },
                    error: function(xhr) {
                        // Show error message
                        submitBtn.html('<i class="fas fa-exclamation-triangle"></i> Error');
                        submitBtn.css('background', '#f56565');
                        
                        setTimeout(function() {
                            submitBtn.html(originalText);
                            submitBtn.prop('disabled', false);
                            submitBtn.css('background', '');
                            
                            var errorMsg = 'An error occurred. Please try again.';
                            if (xhr.responseJSON) {
                                if (xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                } else if (xhr.responseJSON.errors) {
                                    // Handle validation errors
                                    var errors = [];
                                    $.each(xhr.responseJSON.errors, function(key, value) {
                                        errors.push(value[0]);
                                    });
                                    errorMsg = errors.join('\n');
                                }
                            }
                            alert(errorMsg);
                        }, 2000);
                    }
                });
            });
        });
    </script>
    
    <!-- Initialize Swiper -->
    <script>
        $(document).ready(function() {
            var owl = $(".slider1");

            owl.owlCarousel({
                items: 1,
                loop: false,
                nav: true,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 3,
                        nav: true,
                        loop: false
                    }
                },
                navText: ["&#8592;", "&#8594;"], // Left & Right Arrows
                onInitialized: updateCounter,
                onTranslated: updateCounter
            });

            function updateCounter(event) {
                var totalItems = event.item.count;
                var currentIndex = event.item.index - event.relatedTarget._clones.length / 2 + 1;

                if (currentIndex > totalItems) {
                    currentIndex = 1;
                }

                $("#currentSlide").text(currentIndex);
                $("#totalSlides").text(totalItems);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var owl = $(".slider2");

            owl.owlCarousel({
                items: 1,
                loop: false,
                nav: true,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 3,
                        nav: true,
                        loop: false
                    }
                },
                navText: ["&#8592;", "&#8594;"], // Left & Right Arrows
                onInitialized: updateCounter,
                onTranslated: updateCounter
            });

            function updateCounter(event) {
                var totalItems = event.item.count;
                var currentIndex = event.item.index - event.relatedTarget._clones.length / 2 + 1;

                if (currentIndex > totalItems) {
                    currentIndex = 1;
                }

                $("#currentSlide1").text(currentIndex);
                $("#totalSlides1").text(totalItems);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var owl = $(".slider3");

            owl.owlCarousel({
                items: 1,
                loop: false,
                nav: true,
                dots: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 3,
                        nav: true,
                        loop: false
                    }
                },
                navText: ["&#8592;", "&#8594;"], // Left & Right Arrows
                onInitialized: updateCounter,
                onTranslated: updateCounter
            });

            function updateCounter(event) {
                var totalItems = event.item.count;
                var currentIndex = event.item.index - event.relatedTarget._clones.length / 2 + 1;

                if (currentIndex > totalItems) {
                    currentIndex = 1;
                }

                $("#currentSlide3").text(currentIndex);
                $("#totalSlides3").text(totalItems);
            }
        });
    </script>

    <script>
        // Function to initialize location carousel
        function initializeLocationCarousel($carousel) {
            if (!$carousel.length || $carousel.data('owl.carousel')) {
                return; // Already initialized or doesn't exist
            }
            
            var itemCount = $carousel.children('.pslider').length;
            // Use smaller margin on mobile devices
            var isMobile = $(window).width() <= 767;
            var carouselMargin = isMobile ? 5 : 10;
            
            $carousel.owlCarousel({
                loop: false, // Disable loop - no infinite scroll
                margin: carouselMargin,
                startPosition: 0, // Start at first slide
                pullDrag: true,
                freeDrag: false,
                autoplay: true, // Enable autoplay
                autoplayTimeout: 5000, // 5 seconds between slides
                autoplayHoverPause: true, // Pause on hover
                autoplaySpeed: 1000, // Transition speed
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true,
                        loop: false, // No loop on mobile
                        startPosition: 0, // Ensure mobile starts at first slide
                        pullDrag: true,
                        freeDrag: false,
                        autoplay: true,
                        autoplayTimeout: 5000
                    },
                    600: {
                        items: 1,
                        nav: false,
                        loop: false, // No loop on tablet
                        startPosition: 0,
                        pullDrag: true,
                        freeDrag: false,
                        autoplay: true,
                        autoplayTimeout: 5000
                    },
                    1000: {
                        items: 3,
                        nav: true,
                        loop: false, // No loop on desktop
                        startPosition: 0,
                        pullDrag: true,
                        freeDrag: false,
                        autoplay: true,
                        autoplayTimeout: 5000
                    }
                },
                onInitialized: function(event) {
                    // Ensure carousel starts at position 0 - reset immediately
                    var carousel = event.target;
                    var owl = $(carousel).data('owl.carousel');
                    if (owl && owl.current() !== 0) {
                        owl.goTo(0, 0, true);
                    }
                    
                    // Also reset after a short delay to catch any late initialization
                    setTimeout(function() {
                        var owl = $(carousel).data('owl.carousel');
                        if (owl && owl.current() !== 0) {
                            owl.goTo(0, 0, true);
                        }
                        // Ensure autoplay starts
                        setTimeout(function() {
                            var owl = $(carousel).data('owl.carousel');
                            if (owl) {
                                owl.trigger('stop.owl.autoplay');
                                owl.trigger('play.owl.autoplay', [5000]);
                            }
                        }, 100);
                    }, 50);
                },
                onTranslate: function(event) {
                    // Prevent scrolling before position 0
                    var carousel = event.target;
                    var owl = $(carousel).data('owl.carousel');
                    if (owl && owl.current() < 0) {
                        owl.goTo(0, 0, true);
                    }
                },
                onTranslated: function(event) {
                    // Ensure we don't go below position 0
                    var carousel = event.target;
                    var owl = $(carousel).data('owl.carousel');
                    if (owl && owl.current() < 0) {
                        owl.goTo(0, 0, true);
                    }
                    
                    // Check if we've reached the end and need to restart
                    if (owl) {
                        var totalItems = event.item.count;
                        var currentIndex = event.item.index + 1;
                        var itemsPerView = $(window).width() >= 1000 ? 3 : 1;
                        var maxIndex = totalItems - itemsPerView + 1;
                        
                        if (currentIndex >= maxIndex) {
                            // Reached the end, restart from beginning after autoplay timeout
                            setTimeout(function() {
                                owl.trigger('stop.owl.autoplay');
                                owl.goTo(0, 1000, false);
                                setTimeout(function() {
                                    owl.trigger('play.owl.autoplay', [5000]);
                                }, 1000);
                            }, 5000);
                        }
                    }
                }
            });
        }
        
        // Initialize location carousels on page load (only for active tab)
        $(document).ready(function() {
            $('.tab-pane.active .locasslider').each(function() {
                initializeLocationCarousel($(this));
            });
        });
        
        // Make location property cards clickable
        $(document).on('click', '.location-property-card-link', function(e) {
            // Don't navigate if clicking on buttons or links
            if ($(e.target).closest('.btnbox').length || 
                $(e.target).hasClass('enc') || 
                $(e.target).hasClass('view') || 
                $(e.target).hasClass('app') ||
                $(e.target).closest('.enc').length ||
                $(e.target).closest('.app').length ||
                $(e.target).closest('a').length) {
                return;
            }
            
            // Navigate to property detail page
            var propertyUrl = $(this).data('property-url');
            if (propertyUrl) {
                window.location.href = propertyUrl;
            }
        });
        
        // Handle Enquire Now button separately
        $(document).on('click', '.location-property-card-link .enc', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var propertyName = $(this).data('property-name') || $(this).closest('.location-property-card-link').find('h6').text().trim();
            if (typeof openEnquiryPopup === 'function') {
                openEnquiryPopup({name: propertyName});
            }
            return false;
        });
        
        // Handle WhatsApp button separately - stop propagation so card doesn't navigate
        $(document).on('click', '.location-property-card-link .app', function(e) {
            e.stopPropagation();
            // Let the default link behavior happen (open WhatsApp in new tab)
        });
    </script>

    <script>
        $(document).ready(function() {
            var owl = $(".testslider");

            owl.owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                autoplaySpeed: 1000,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true
                    },
                    600: {
                        items: 1,
                        nav: false,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true
                    },
                    1000: {
                        items: 2,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true
                    }
                },
                navText: ["&#8592;", "&#8594;"], // Left & Right Arrows
                onInitialized: updateCounter,
                onTranslated: updateCounter
            });

            function updateCounter(event) {
                var totalItems = event.item.count;
                var currentIndex = event.item.index + 1;
                
                // Handle looped carousel index calculation
                if (event.relatedTarget && event.relatedTarget._clones) {
                    var clones = event.relatedTarget._clones.length;
                    if (clones > 0) {
                        // For looped carousel, adjust index
                        var realIndex = currentIndex;
                        if (realIndex > totalItems) {
                            realIndex = realIndex - totalItems;
                        }
                        if (realIndex < 1) {
                            realIndex = totalItems + realIndex;
                        }
                        currentIndex = realIndex;
                    }
                }

                if (currentIndex > totalItems) {
                    currentIndex = 1;
                }
                if (currentIndex < 1) {
                    currentIndex = totalItems;
                }

                $("#currentSlide10").text(currentIndex);
                $("#totalSlides10").text(totalItems);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var owl = $(".devslider");

            owl.owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                autoplaySpeed: 1000,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true
                    },
                    600: {
                        items: 1,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true
                    }
                },
                navText: ["&#8592;", "&#8594;"], // Left & Right Arrows
                onInitialized: updateCounter,
                onTranslated: updateCounter
            });

            function updateCounter(event) {
                var totalItems = event.item.count;
                var currentIndex = event.item.index + 1;
                
                // Handle looped carousel index calculation
                if (event.relatedTarget && event.relatedTarget._clones) {
                    var clones = event.relatedTarget._clones.length;
                    if (clones > 0) {
                        // For looped carousel, adjust index
                        var realIndex = currentIndex;
                        if (realIndex > totalItems) {
                            realIndex = realIndex - totalItems;
                        }
                        if (realIndex < 1) {
                            realIndex = totalItems + realIndex;
                        }
                        currentIndex = realIndex;
                    }
                }

                if (currentIndex > totalItems) {
                    currentIndex = 1;
                }
                if (currentIndex < 1) {
                    currentIndex = totalItems;
                }

                $("#currentSlide6").text(currentIndex);
                $("#totalSlides6").text(totalItems);
            }
        });
    </script>

    <!-- Initialize dynamic carousels for tabs -->
    <script>
        $(document).ready(function() {
            // Function to initialize a carousel
            function initializeCarousel(selector, categoryId) {
                var carousel = $(selector);
                
                // Check if carousel exists and isn't already initialized
                if (carousel.length && !carousel.data('owl.carousel')) {
                    carousel.owlCarousel({
                        items: 1,
                        loop: false, // Disable loop - no infinite scroll
                        nav: true,
                        dots: false,
                        startPosition: 0, // Start at first slide
                        pullDrag: true,
                        freeDrag: false,
                        autoplay: true, // Enable autoplay
                        autoplayTimeout: 5000, // 5 seconds between slides
                        autoplayHoverPause: true, // Pause on hover
                        autoplaySpeed: 1000, // Transition speed
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 1,
                                nav: true,
                                loop: false, // No loop on mobile
                                startPosition: 0, // Ensure mobile starts at first slide
                                pullDrag: true,
                                freeDrag: false,
                                autoplay: true,
                                autoplayTimeout: 5000
                            },
                            600: {
                                items: 1,
                                nav: false,
                                loop: false, // No loop on tablet
                                startPosition: 0,
                                pullDrag: true,
                                freeDrag: false,
                                autoplay: true,
                                autoplayTimeout: 5000
                            },
                            1000: {
                                items: 3,
                                nav: true,
                                loop: false, // No loop on desktop
                                startPosition: 0,
                                pullDrag: true,
                                freeDrag: false,
                                autoplay: true,
                                autoplayTimeout: 5000
                            }
                        },
                        navText: ["&#8592;", "&#8594;"],
                        onInitialized: function(event) {
                            if (categoryId) {
                                var totalItems = event.item.count;
                                $("#totalSlides" + categoryId).text(totalItems);
                                $("#currentSlide" + categoryId).text(1);
                                console.log('Carousel initialized:', {
                                    categoryId: categoryId,
                                    totalItems: totalItems
                                });
                            }
                            
                            // Ensure carousel starts at position 0 - reset immediately
                            var carousel = event.target;
                            var owl = $(carousel).data('owl.carousel');
                            if (owl && owl.current() !== 0) {
                                owl.goTo(0, 0, true);
                            }
                            
                            // Also reset after a short delay to catch any late initialization
                            setTimeout(function() {
                                var owl = $(carousel).data('owl.carousel');
                                if (owl && owl.current() !== 0) {
                                    owl.goTo(0, 0, true);
                                }
                                // Ensure autoplay starts - use setTimeout to ensure carousel is fully ready
                                setTimeout(function() {
                                    var owl = $(carousel).data('owl.carousel');
                                    if (owl) {
                                        // Stop any existing autoplay first
                                        owl.trigger('stop.owl.autoplay');
                                        // Start autoplay with 5 second timeout
                                        owl.trigger('play.owl.autoplay', [5000]);
                                    }
                                }, 100);
                            }, 50);
                        },
                        onTranslate: function(event) {
                            // Prevent scrolling before position 0
                            var carousel = event.target;
                            var owl = $(carousel).data('owl.carousel');
                            if (owl && owl.current() < 0) {
                                owl.goTo(0, 0, true);
                            }
                        },
                        onTranslated: function(event) {
                            // Ensure we don't go below position 0
                            var carousel = event.target;
                            var owl = $(carousel).data('owl.carousel');
                            if (owl && owl.current() < 0) {
                                owl.goTo(0, 0, true);
                            }
                            
                            // Check if we've reached the end and need to restart
                            if (categoryId && owl) {
                                var totalItems = event.item.count;
                                var currentIndex = event.item.index + 1;
                                var itemsPerView = $(window).width() >= 1000 ? 3 : 1;
                                var maxIndex = totalItems - itemsPerView + 1;
                                
                                if (currentIndex >= maxIndex) {
                                    // Reached the end, restart from beginning
                                    setTimeout(function() {
                                        // Stop current autoplay
                                        owl.trigger('stop.owl.autoplay');
                                        // Go to beginning
                                        owl.goTo(0, 1000, false);
                                        // Restart autoplay after transition
                                        setTimeout(function() {
                                            owl.trigger('play.owl.autoplay', [5000]);
                                        }, 1000);
                                    }, 5000);
                                }
                            }
                        },
                        onChanged: function(event) {
                            // Prevent scrolling before position 0
                            var carousel = event.target;
                            var owl = $(carousel).data('owl.carousel');
                            if (owl && owl.current() < 0) {
                                owl.goTo(0, 0, true);
                                return;
                            }
                            
                            // This event fires when carousel changes (more reliable than onTranslated)
                            if (categoryId) {
                                var currentIndex = event.item.index + 1;
                                var totalItems = event.item.count;
                                
                                // Handle index calculation for non-loop carousel
                                if (currentIndex < 1) {
                                    currentIndex = 1;
                                    // Reset to position 0 if we somehow got below 1
                                    if (owl) {
                                        owl.goTo(0, 0, true);
                                    }
                                }
                                if (currentIndex > totalItems) {
                                    currentIndex = totalItems;
                                }
                                
                                $("#currentSlide" + categoryId).text(currentIndex);
                                
                                // Check if we've reached the end - restart from beginning
                                var itemsPerView = $(window).width() >= 1000 ? 3 : 1;
                                var maxIndex = totalItems - itemsPerView + 1;
                                
                                if (currentIndex >= maxIndex && owl) {
                                    // Reached the end, restart from beginning after autoplay timeout
                                    setTimeout(function() {
                                        // Stop current autoplay
                                        owl.trigger('stop.owl.autoplay');
                                        // Go to beginning
                                        owl.goTo(0, 1000, false);
                                        // Restart autoplay after transition
                                        setTimeout(function() {
                                            owl.trigger('play.owl.autoplay', [5000]);
                                        }, 1000);
                                    }, 5000); // Wait 5 seconds (autoplay timeout) before restarting
                                }
                                
                            }
                        },
                        onTranslated: function(event) {
                            if (categoryId) {
                                var totalItems = event.item.count;
                                var currentIndex = event.item.index + 1;
                                
                                // Handle index calculation for non-loop carousel
                                if (currentIndex < 1) {
                                    currentIndex = 1;
                                }
                                if (currentIndex > totalItems) {
                                    currentIndex = totalItems;
                                }
                                
                                $("#currentSlide" + categoryId).text(currentIndex);
                                
                                // Check if we've reached the end and need to restart autoplay
                                var itemsPerView = $(window).width() >= 1000 ? 3 : 1;
                                var maxIndex = totalItems - itemsPerView + 1;
                                var carousel = event.target;
                                var owl = $(carousel).data('owl.carousel');
                                
                                if (currentIndex >= maxIndex && owl) {
                                    // Reached the end, restart from beginning after autoplay timeout
                                    setTimeout(function() {
                                        // Stop current autoplay
                                        owl.trigger('stop.owl.autoplay');
                                        // Go to beginning
                                        owl.goTo(0, 1000, false);
                                        // Restart autoplay after transition
                                        setTimeout(function() {
                                            owl.trigger('play.owl.autoplay', [5000]);
                                        }, 1000);
                                    }, 5000);
                                }
                            }
                        }
                    });
                }
            }

            // Initialize carousels for visible tabs on page load
            $('.tab-pane.active .owl-carousel').each(function() {
                var $this = $(this);
                var categoryId = $this.data('category-id');
                
                if (categoryId) {
                    var sliderClass = $this.attr('class').split(' ').find(cls => cls.startsWith('slider'));
                    if (sliderClass) {
                        initializeCarousel('.' + sliderClass, categoryId);
                    }
                } else if ($this.hasClass('locasslider')) {
                    // Location carousel - initialize if not already initialized
                    if (!$this.data('owl.carousel')) {
                        initializeLocationCarousel($this);
                    }
                }
            });

            // Initialize carousels when tabs are switched
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var targetId = $(e.target).attr('href');
                var $tabPane = $(targetId);
                
                // Update "View All Residences" button based on selected category
                if (targetId.startsWith('#category')) {
                    var categoryName = $(e.target).data('category-name') || $(e.target).find('.category-name').text().trim();
                    var categorySlug = $(e.target).data('category-slug');
                    var $viewAllBtn = $('#viewAllResidencesBtn');
                    
                    if ($viewAllBtn.length && categorySlug && categoryName) {
                        // Update button text and href
                        $viewAllBtn.attr('href', '/' + categorySlug + '-properties');
                        $viewAllBtn.find('.private_property-button_text').html('View All ' + categoryName + ' Properties <i class="fal fa-arrow-right"></i>');
                    }
                }
                
                // Initialize category carousels
                $tabPane.find('.owl-carousel').each(function() {
                    var $this = $(this);
                    var categoryId = $this.data('category-id');
                    
                    if (categoryId) {
                        var sliderClass = $this.attr('class').split(' ').find(cls => cls.startsWith('slider'));
                        if (sliderClass) {
                            initializeCarousel('.' + sliderClass, categoryId);
                        }
                    } else if ($this.hasClass('locasslider')) {
                        // Location carousel - check if already initialized
                        if ($this.data('owl.carousel')) {
                            // Carousel is already initialized, just refresh it
                            $this.trigger('refresh.owl.carousel');
                        } else {
                            // Initialize the carousel if it has content
                            if ($this.children('.pslider').length > 0) {
                                initializeLocationCarousel($this);
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection