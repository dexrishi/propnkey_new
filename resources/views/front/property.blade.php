@extends('front.frontlayouts.frontapp')
@section('content')
<div class="topserch">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="properties_intro-wrapper text-center">
                    <h1 class="properties_intro-heading">
                        @if(isset($pageMeta['slugList']) && $pageMeta['slugList']->headline)
                            {{ $pageMeta['slugList']->headline }}
                        @elseif(isset($query) && $query)
                            Search Results for "{{ $query }}"
                        @elseif(isset($propertyType) && isset($location))
                            {{ $propertyType->heading ?: ($propertyType->name . ' in ' . $location->name) }}
                        @elseif(isset($propertyType))
                            {{ $propertyType->heading ?: ($propertyType->name . ' Properties') }}
                        @elseif(isset($propertyCategory))
                            {{ $propertyCategory->name }} Properties
                        @elseif(isset($location))
                            {{ $location->name }} Properties
                        @elseif(isset($partner))
                            {{ $partner->display_name ?: $partner->name }} Properties
                        @else
                            All Properties
                        @endif
                    </h1>
                    <h2 class="properties_intro-sub_heading">
                        @if(isset($pageMeta['slugList']) && $pageMeta['slugList']->heading_2)
                            {{ $pageMeta['slugList']->heading_2 }}
                        @elseif(isset($query) && $query)
                            @if($properties->count() > 0)
                                Found {{ $properties->total() }} {{ $properties->total() == 1 ? 'property' : 'properties' }} matching your search
                            @else
                                No properties found matching your search
                            @endif
                        @elseif(isset($propertyType) && isset($location))
                            Explore premium {{ $propertyType->name }} in {{ $location->name }}.
                        @elseif(isset($propertyType))
                            {{ $propertyType->heading ? ('Explore listings for ' . $propertyType->name . '.') : ('Explore premium properties in the ' . $propertyType->name . ' category.') }}
                        @elseif(isset($propertyCategory))
                            Discover premium {{ $propertyCategory->name }} properties.
                        @elseif(isset($location))
                            Discover premium properties in {{ $location->name }}.
                        @elseif(isset($partner))
                            {{ $partner->sub_heading ?: ('Discover premium properties by ' . ($partner->display_name ?: $partner->name) . '.') }}
                        @else
                            Browse our complete collection of premium properties.
                        @endif
                    </h2>
                    <div class="properties_intro-paragraph">
                        @if(isset($pageMeta['slugList']) && $pageMeta['slugList']->description)
                            {!! $pageMeta['slugList']->description !!}
                        @elseif(isset($query) && $query)
                            @if($properties->count() > 0)
                                Browse through our curated selection of properties matching "{{ $query }}". Find the perfect property that meets your requirements and preferences.
                            @else
                                We couldn't find any properties matching "{{ $query }}". Try adjusting your search terms or browse through our complete collection of premium properties.
                            @endif
                        @elseif(isset($propertyType) && isset($location))
                            {!! $propertyType->description ?: ('Find top-quality ' . $propertyType->name . ' in ' . $location->name . '. Our collection offers exclusive homes and investments in this prime location. Browse now and make your dream property a reality.') !!}
                        @elseif(isset($propertyType))
                            {!! $propertyType->description ?: ('Find top-quality properties in the ' . $propertyType->name . ' segment. Our collection offers exclusive homes and investments tailored for your lifestyle. Browse now and make your dream property a reality.') !!}
                        @elseif(isset($propertyCategory))
                            Find top-quality {{ $propertyCategory->name }} properties. Our collection offers exclusive homes and investments in this category. Browse now and make your dream property a reality.
                        @elseif(isset($location))
                            {{ $location->meta_description ?: ('Find top-quality properties in ' . $location->name . '. Our collection offers exclusive homes and investments in this prime location. Browse now and make your dream property a reality.') }}
                        @elseif(isset($partner))
                            {!! $partner->description ?: ('Find top-quality properties by ' . ($partner->display_name ?: $partner->name) . '. Our collection offers exclusive homes and investments from this trusted developer. Browse now and make your dream property a reality.') !!}
                        @else
                            Discover our extensive collection of premium properties across all categories and locations. From luxury apartments to commercial spaces, find your perfect property investment. Browse our complete portfolio and make your dream property a reality.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<x-property-search 
    :searchPlaceholder="'3 BHK Apartments, Gurgaon'"
    :searchIconUrl="'https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg'"
    :isInnerSearch="true"
    :currentLocation="$location ?? null"
/>

<div class="productlistsec">
    <div class="container">
        <div class="row">
            @forelse($properties as $property)
                <div class="col-md-6">
                    <div class="proboxcat {{ $property->is_sold ? 'soldrel' : '' }}">
                        {{-- Sold Out / Rented Out badge --}}
                        @if($property->is_sold)
                            <span class="sold">
                                <img src="{{ asset($property->property_category_id == 4 ? 'frontassets/images/rented-out.png' : 'frontassets/images/sold-out.png') }}" alt="{{ $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out' }}" style="width: 200px;">
                            </span>
                        @endif

                        {{-- Property Image --}}
                        <div class="proboxcatimg" style="position: relative;">
                            @if($property->badge)
                                <span class="property-badge" style="position: absolute; top: 10px; left: 10px; z-index: 2; background: #a98862; color: #fff; padding: 5px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-transform: uppercase; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">{{ $property->badge->name }}</span>
                            @endif
                            @php
                                $image = $property->images->where('is_thumbnail', 1)->first()
                                    ?? $property->images->where('type', 'project')->first()
                                    ?? $property->images->first();
                            @endphp
                            <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}">
                                @if($image && $image->image_path)
                                    <img src="{{ $image->listing_image_url }}" 
                                        alt="{{ $image->alt_text }}" 
                                        class="img-fluid"
                                        loading="lazy"
                                        decoding="async"
                                        width="1200"
                                        height="800"
                                        onerror="this.src='https://via.placeholder.com/1200x800?text=No+Image'">
                                @else
                                     <img src="https://via.placeholder.com/1200x800?text=No+Image" 
                                        alt="{{ $property->name }}" 
                                        class="img-fluid"
                                        width="1200"
                                        height="800">
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
                                {{ $property->bedroomOptions && $property->bedroomOptions->count() > 0 ? $property->bedroomOptions->pluck('name')->join(', ') : '-' }} | 
                                {{ $property->area_sq_ft ?? 'N/A' }} sq.ft
                            </p>

                            <p>Location: {{ $property->location->name ?? 'Location not specified' }}</p>

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
                    <div class="alert alert-info text-center">
                        <h4>No Properties Found</h4>
                        <p>
                            @if(isset($query) && $query)
                                No properties found matching "{{ $query }}". Try adjusting your search terms or browse through our complete collection.
                            @elseif(isset($propertyType) && isset($location))
                                No {{ $propertyType->name }} properties found in {{ $location->name }}.
                            @elseif(isset($propertyType))
                                No properties found in the {{ $propertyType->name }} category.
                            @elseif(isset($propertyCategory))
                                No properties found in the {{ $propertyCategory->name }} category.
                            @elseif(isset($location))
                                No properties found in {{ $location->name }}.
                            @elseif(isset($partner))
                                No properties found by {{ $partner->name }}.
                            @else
                                No properties found.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Sentinel element for Intersection Observer -->
        <div id="scroll-sentinel" style="height: 1px; visibility: hidden;"></div>
        
        <!-- Infinite Scroll Loading Indicator -->
        <div id="infinite-scroll-loader" style="display: none;" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading more properties...</p>
        </div>
        
        <!-- End of Results Message -->
        <div id="no-more-properties" style="display: none;" class="text-center py-5">
            <p class="text-muted">No more properties to load.</p>
        </div>
    </div>
</div>

@php
    $hasSlugBottomSection = isset($pageMeta['slugList']) && ($pageMeta['slugList']->bottom_headline || $pageMeta['slugList']->bottom_description);
    $fallbackBottomHeadline = isset($location) && !empty($location->site_description) ? ($location->heading ?: ('About ' . $location->name)) : null;
    $fallbackBottomDescription = isset($location) ? ($location->site_description ?: null) : null;
    $listingFaqItems = isset($pageMeta['slugList']) ? ($pageMeta['slugList']->faq_items ?? []) : [];
@endphp

@if($hasSlugBottomSection || $fallbackBottomDescription)
@once
<style>
    .listing-bottom-intro {
        margin-top: 70px;
        padding: 64px 0 56px;
        background-color: #f5f3f0;
        background-image:
            radial-gradient(ellipse at 20% 30%, rgba(255, 255, 255, 0.75) 0%, transparent 55%),
            radial-gradient(ellipse at 80% 70%, rgba(192, 150, 101, 0.08) 0%, transparent 50%),
            linear-gradient(180deg, #f7f4f0 0%, #f1eee9 45%, #f8f6f3 100%);
        background-size: cover;
    }
    .listing-bottom-intro-inner {
        max-width: 920px;
        margin: 0 auto;
        text-align: center;
    }
    .listing-bottom-intro-title {
        margin: 0 0 22px;
        color: #a8815a;
        font-family: "Libre Caslon Text", "Times New Roman", serif;
        font-size: clamp(1.35rem, 2.4vw, 1.85rem);
        font-style: italic;
        font-weight: 400;
        line-height: 1.45;
        letter-spacing: 0.01em;
    }
    .listing-bottom-intro-copy {
        margin: 0 auto;
        max-width: 820px;
        color: #4a4642;
        font-family: Graphiklcg, sans-serif;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.85;
    }
    .listing-bottom-intro-copy p {
        margin: 0;
        color: inherit;
    }
    @media (max-width: 767px) {
        .listing-bottom-intro {
            margin-top: 48px;
            padding: 42px 0 36px;
        }
        .listing-bottom-intro-title {
            margin-bottom: 16px;
            font-size: 1.2rem;
        }
        .listing-bottom-intro-copy {
            font-size: 0.95rem;
            line-height: 1.75;
        }
    }
</style>
@endonce
<section class="listing-bottom-intro">
    <div class="container">
        <div class="listing-bottom-intro-inner">
            @if($hasSlugBottomSection && $pageMeta['slugList']->bottom_headline)
                <h2 class="listing-bottom-intro-title">{{ $pageMeta['slugList']->bottom_headline }}</h2>
            @elseif($fallbackBottomHeadline)
                <h2 class="listing-bottom-intro-title">{{ $fallbackBottomHeadline }}</h2>
            @endif
            @if($hasSlugBottomSection && $pageMeta['slugList']->bottom_description)
                <div class="listing-bottom-intro-copy">
                    {!! $pageMeta['slugList']->bottom_description !!}
                </div>
            @elseif($fallbackBottomDescription)
                <div class="listing-bottom-intro-copy">
                    {!! nl2br(e($fallbackBottomDescription)) !!}
                </div>
            @endif
        </div>
    </div>
</section>
@endif

@include('front.partials.listing-faqs', ['faqItems' => $listingFaqItems, 'faqSectionId' => 'listingPageFaqAccordion'])

@endsection

@section('page-js')
<script>
$(document).ready(function() {
    var currentPage = {{ $properties->currentPage() }};
    var lastPage = {{ $properties->lastPage() }};
    var isLoading = false;
    var hasMore = {{ $properties->hasMorePages() ? 'true' : 'false' }};
    var observer = null;
    
    // Get current route parameters for AJAX request
    var requestData = {
        page: currentPage + 1
    };
    
    // Add query parameters if they exist
    @if(isset($query) && $query)
        requestData.query = '{{ $query }}';
    @endif
    
    @if(isset($location) && $location)
        requestData.location = '{{ is_object($location) ? $location->slug : $location }}';
    @elseif(request()->has('location'))
        requestData.location = '{{ request('location') }}';
    @endif
    
    @if(isset($propertyCategory) && $propertyCategory)
        requestData.category_slug = '{{ $propertyCategory->slug }}';
    @elseif(request()->has('category'))
        requestData.category = '{{ request('category') }}';
    @endif
    
    @if(isset($propertyType) && $propertyType)
        requestData.property_type_slug = '{{ $propertyType->slug }}';
    @elseif(request()->has('type'))
        requestData.type = '{{ request('type') }}';
    @elseif(request()->has('property_type'))
        requestData.property_type = @json(request('property_type'));
    @endif
    
    @if(isset($partner) && $partner)
        requestData.partner_slug = '{{ $partner->slug }}';
    @elseif(request()->has('partner'))
        requestData.partner = '{{ request('partner') }}';
    @endif
    
    @if(request()->has('price'))
        requestData.price = '{{ request('price') }}';
    @endif
    
    @if(request()->has('bedroom'))
        requestData.bedroom = @json(request('bedroom'));
    @endif
    
    @if(request()->has('form_type'))
        requestData.form_type = '{{ request('form_type') }}';
    @endif
    
    // Get location slug from route if available
    @if(isset($location) && is_object($location))
        requestData.location_slug = '{{ $location->slug }}';
    @endif
    
    // Infinite scroll function
    function loadMoreProperties() {
        if (isLoading || !hasMore) {
            return;
        }
        
        isLoading = true;
        // Show loader before the sentinel
        var $sentinel = $('#scroll-sentinel');
        var $loader = $('#infinite-scroll-loader');
        var $noMore = $('#no-more-properties');
        
        $loader.insertBefore($sentinel).show();
        $noMore.hide();
        
        requestData.page = currentPage + 1;
        
        $.ajax({
            url: '/api/load-more-properties',
            method: 'GET',
            data: requestData,
            success: function(response) {
                if (response.html && response.html.trim() !== '') {
                    // Hide loader first
                    $loader.hide();
                    
                    // Append new properties to the row
                    $('.productlistsec .row').append(response.html);
                    
                    // Update page info
                    currentPage = response.current_page;
                    hasMore = response.has_more;
                    
                    // Move loader back to its position after the new content
                    $loader.insertBefore($sentinel);
                    
                    // Show "no more" message if we've reached the end
                    if (!hasMore) {
                        $sentinel.hide();
                        $noMore.insertAfter($sentinel).show();
                        // Disconnect observer when no more data
                        if (observer) {
                            observer.disconnect();
                        }
                    }
                } else {
                    hasMore = false;
                    $loader.hide();
                    $sentinel.hide();
                    $noMore.insertAfter($sentinel).show();
                    // Disconnect observer when no more data
                    if (observer) {
                        observer.disconnect();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading properties:', error);
                $loader.hide();
                hasMore = false;
                $sentinel.hide();
                $noMore.insertAfter($sentinel).show();
                // Disconnect observer on error
                if (observer) {
                    observer.disconnect();
                }
            },
            complete: function() {
                isLoading = false;
            }
        });
    }
    
    // Setup Intersection Observer for better scroll detection
    function setupIntersectionObserver() {
        // Check if Intersection Observer is supported
        if ('IntersectionObserver' in window) {
            var sentinel = document.getElementById('scroll-sentinel');
            
            if (sentinel) {
                observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        // When sentinel enters viewport, load more
                        if (entry.isIntersecting && hasMore && !isLoading) {
                            loadMoreProperties();
                        }
                    });
                }, {
                    root: null, // viewport
                    rootMargin: '100px', // Start loading 100px before sentinel enters viewport
                    threshold: 0.1
                });
                
                observer.observe(sentinel);
            }
        } else {
            // Fallback to scroll event for older browsers
            $(window).scroll(function() {
                var sentinel = $('#scroll-sentinel');
                if (sentinel.length) {
                    var sentinelTop = sentinel.offset().top;
                    var windowBottom = $(window).scrollTop() + $(window).height();
                    
                    // If sentinel is in viewport or about to enter
                    if (windowBottom >= sentinelTop - 100 && hasMore && !isLoading) {
                        loadMoreProperties();
                    }
                }
            });
        }
    }
    
    // Initialize observer
    setupIntersectionObserver();
    
    // If no properties initially, hide sentinel
    if (!hasMore) {
        $('#scroll-sentinel').hide();
        $('#no-more-properties').show();
    }
});
</script>

<style>
#infinite-scroll-loader {
    padding: 40px 0;
    min-height: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

#infinite-scroll-loader .spinner-border {
    width: 3rem;
    height: 3rem;
    border-width: 0.25em;
}

#infinite-scroll-loader p {
    margin-top: 1rem;
    color: #6c757d;
    font-size: 14px;
}

#no-more-properties {
    padding: 40px 0;
    color: #6c757d;
    font-size: 14px;
    text-align: center;
}

#scroll-sentinel {
    margin: 0;
    padding: 0;
}
</style>
@endsection


