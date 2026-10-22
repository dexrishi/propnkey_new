@extends('front.frontlayouts.frontapp')

@section('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('frontassets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontassets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* Property hero — clearer hierarchy over banner */
.property_intro_component.pd-hero {
    display: flex;
    align-items: flex-end;
    min-height: 620px;
    background-position: center;
    background-repeat: no-repeat;
}

.pd-hero-overlay {
    background: linear-gradient(
        180deg,
        rgba(10, 12, 14, 0.12) 0%,
        rgba(10, 12, 14, 0.22) 50%,
        rgba(8, 10, 12, 0.42) 100%
    ) !important;
    z-index: 0 !important;
}

.pd-hero-bottom {
    position: relative !important;
    bottom: auto !important;
    left: auto !important;
    width: 100%;
    z-index: 1;
    padding: 0 0 24px;
}

.pd-hero-panel {
    display: grid;
    grid-template-columns: minmax(0, 1.4fr) minmax(260px, 320px);
    gap: 20px;
    align-items: end;
    background: rgba(0, 0, 0, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.22);
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
    border-radius: 16px;
    padding: 18px 22px;
    box-shadow: none;
}

.pd-hero-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 8px;
}

.pd-hero-chip {
    display: inline-flex;
    align-items: center;
    padding: 5px 12px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.16);
    border: 1px solid rgba(255, 255, 255, 0.28);
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.02em;
}

.pd-hero-chip-accent {
    background: rgba(169, 136, 98, 0.9);
    border-color: rgba(169, 136, 98, 0.95);
}

.pd-hero-title {
    margin: 0 0 14px;
    color: #fff;
    font-size: clamp(1.5rem, 2.2vw, 2.05rem);
    font-weight: 700;
    line-height: 1.2;
    font-family: Graphiklcg, sans-serif;
    text-shadow: 0 2px 12px rgba(0, 0, 0, 0.35);
}

.pd-hero-specs {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.pd-hero-spec {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.28);
    border: 1px solid rgba(255, 255, 255, 0.12);
}

.pd-hero-spec-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.35);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    flex-shrink: 0;
    background: rgba(255, 255, 255, 0.06);
    font-size: 0.85rem;
}

.pd-hero-spec-label {
    display: block;
    color: rgba(255, 255, 255, 0.72);
    font-size: 12px;
    margin-bottom: 2px;
}

.pd-hero-spec-value {
    display: block;
    color: #fff;
    font-size: 15px;
    font-weight: 650;
    line-height: 1.25;
}

.pd-hero-aside {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.pd-hero-price-card {
    background: rgba(255, 255, 255, 0.95);
    color: #1a1f1c;
    border-radius: 12px;
    padding: 12px 16px;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
}

.pd-hero-price-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: #6b746f;
    margin-bottom: 4px;
}

.pd-hero-price-value {
    font-size: 1.35rem;
    font-weight: 700;
    color: #1a1f1c;
    line-height: 1.2;
}

.pd-hero-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.pd-hero-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 12px;
    border-radius: 999px;
    font-weight: 650;
    font-size: 0.88rem;
    text-decoration: none !important;
    transition: transform 0.15s ease, background 0.15s ease, box-shadow 0.15s ease;
}

.pd-hero-btn:hover {
    transform: translateY(-1px);
}

.pd-hero-btn-wa {
    background: #25d366;
    color: #fff !important;
    box-shadow: 0 8px 18px rgba(37, 211, 102, 0.28);
}

.pd-hero-btn-wa:hover {
    background: #1ebe57;
    color: #fff !important;
}

.pd-hero-btn-call {
    background: #111;
    color: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.pd-hero-btn-call:hover {
    background: #000;
    color: #fff !important;
}

@media (max-width: 991px) {
    .property_intro_component.pd-hero {
        min-height: 560px;
    }

    .pd-hero-panel {
        grid-template-columns: 1fr;
        gap: 16px;
        padding: 16px 18px;
    }

    .pd-hero-aside {
        order: -1;
    }
}

@media (max-width: 575px) {
    .pd-hero-specs {
        grid-template-columns: 1fr;
    }

    .pd-hero-actions {
        grid-template-columns: 1fr;
    }

    .pd-hero-bottom {
        padding-bottom: 20px;
    }

    .pd-hero-panel {
        border-radius: 14px;
        padding: 18px;
    }
}

/* Location Features Mobile Responsive - Keep original design, 2 columns on mobile */
@media (max-width: 768px) {
    .conectivity-div {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: space-between;
    }
    
    .conectivity-div li {
        flex: 0 0 calc(50% - 4px);
        min-width: 0;
        box-sizing: border-box;
    }
}

@media (max-width: 576px) {
    .conectivity-div {
        gap: 6px;
    }
    
    .conectivity-div li {
        flex: 0 0 calc(50% - 3px);
        padding: 8px 4px;
    }
    
    .conectivity-div li i {
        font-size: 1.2rem !important;
    }
    
    .conectivity-div li h3 {
        font-size: 14px !important;
    }
    
    .conectivity-div li p {
        font-size: 11px !important;
    }
    
    .conectivity-div li span {
        font-size: 10px !important;
    }
}

/* Highlights Content Styling */
.highlights-content ul {
    margin: 0;
    padding-left: 20px;
}

.highlights-content li {
    margin-bottom: 8px;
    line-height: 1.5;
}

.highlights-content p {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* Overview Content Styling */
.overview-content ul {
    margin: 0;
    padding-left: 20px;
}

.overview-content li {
    margin-bottom: 8px;
    line-height: 1.5;
}

.overview-content p {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* Features Content Styling */
.features-content ul {
    margin: 0;
    padding-left: 20px;
}

.features-content li {
    margin-bottom: 8px;
    line-height: 1.5;
}

.features-content p {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* Amenities Description Styling */
.amenities-content ul {
    margin: 0;
    padding-left: 20px;
}

.amenities-content li {
    margin-bottom: 8px;
    line-height: 1.5;
}

.amenities-content p {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* Keep spacing even between amenities description and cards */
.amenities .property_detail-features_box_wrapper {
    margin-bottom: 1.5rem;
}

.amenities .amenities-desc {
    margin-bottom: 1.5rem;
}

.amenities .amenities-content > *:last-child {
    margin-bottom: 0;
}

.amenities .amenity-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    font-size: 1.5rem;
    color: #fff;
}

/* Gallery Content Styling */
.gallery-content ul {
    margin: 0;
    padding-left: 20px;
}

.gallery-content li {
    margin-bottom: 8px;
    line-height: 1.5;
}

.gallery-content p {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* Floor Plan Description Styling */
.floor-plan-description ul {
    margin: 0;
    padding-left: 20px;
}

.floor-plan-description li {
    margin-bottom: 8px;
    line-height: 1.5;
}

.floor-plan-description p {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* Similar Properties Section - Fix sizing to match reference */
.simir .proboxcattext {
    padding: 15px;
}

.simir .details_meta-property_title {
    font-size: 18px !important;
    font-weight: 400;
    line-height: 1.35;
    margin-bottom: 10px;
    font-family: Graphiklcg, sans-serif;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 100%;
}

.simir .details_meta-property_title a {
    color: #000;
    text-decoration: none;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.simir .details_meta-property_title a:hover {
    text-decoration: underline;
}

.simir .proboxcattext p {
    font-size: 11px;
    margin-bottom: 8px;
    line-height: 1.4;
    font-family: Graphiklcg, sans-serif;
}

.simir .proboxcatimg img {
    width: 100%;
    height: auto;
    min-height: 200px;
    max-height: 250px;
    object-fit: cover;
    border-radius: 5px;
}

.simir .proboxcat {
    background: #fff;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.simir .details_price-aed {
    font-size: 15px;
    font-weight: 400;
    color: #a98862;
    margin-top: 6px;
    font-family: Graphiklcg, sans-serif;
}

/* Property Detail Banner Layout Fix */
.bottomsectin .row {
    display: flex;
    flex-wrap: wrap;
}

.bottomsectin .col-lg-6.col-md-6 {
    position: relative;
}

@media (min-width: 768px) {
    .bottomsectin .col-lg-6.col-md-6 {
        display: flex;
        flex-direction: column;
    }
}

/* Similar Properties Carousel Styling - Unique Class */
.property-detail-similar-props-carousel {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative;
    width: 100%;
    overflow: hidden;
}

.property-detail-similar-props-carousel .property-detail-similar-props-item {
    padding: 0 10px;
    display: block !important;
    visibility: visible !important;
}

.property-detail-similar-props-carousel .owl-stage-outer {
    overflow: hidden;
    position: relative;
    width: 100%;
    -webkit-transform: translate3d(0px, 0px, 0px);
    transform: translate3d(0px, 0px, 0px);
}

.property-detail-similar-props-carousel .owl-stage {
    position: relative;
    -ms-touch-action: pan-Y;
    touch-action: manipulation;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
}

.property-detail-similar-props-carousel .owl-item {
    position: relative;
    min-height: 1px;
    float: left;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-tap-highlight-color: transparent;
    -webkit-touch-callout: none;
}

.property-detail-similar-props-carousel .owl-item .property-detail-similar-props-item {
    width: 100%;
}

.property-detail-similar-props-carousel .owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    margin: 0;
    transform: translateY(-50%);
    pointer-events: none;
    z-index: 10;
    display: block !important;
}

.property-detail-similar-props-carousel .owl-nav button {
    background: #a98862 !important;
    color: #fff !important;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin: 0;
    font-size: 22px;
    line-height: 1;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: flex !important;
    align-items: center;
    justify-content: center;
    pointer-events: all;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    position: absolute;
}

.property-detail-similar-props-carousel .owl-nav button:hover {
    background: #8a6f4f !important;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.property-detail-similar-props-carousel .owl-nav button.owl-prev {
    left: -60px;
}

.property-detail-similar-props-carousel .owl-nav button.owl-next {
    right: -60px;
}

.property-detail-similar-props-carousel .owl-nav button i {
    display: block;
    line-height: 1;
}

.property-detail-similar-props-carousel .owl-dots {
    text-align: center;
    margin-top: 20px;
    display: block !important;
}

.property-detail-similar-props-carousel .owl-dots button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #ddd !important;
    margin: 0 5px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-block;
}

.property-detail-similar-props-carousel .owl-dots button.active {
    background: #a98862 !important;
    width: 30px;
    border-radius: 6px;
}

@media (max-width: 768px) {
    .property-detail-similar-props-carousel .owl-nav button.owl-prev {
        left: 5px;
        width: 35px;
        height: 35px;
        font-size: 18px;
    }
    
    .property-detail-similar-props-carousel .owl-nav button.owl-next {
        right: 5px;
        width: 35px;
        height: 35px;
        font-size: 18px;
    }
}

@media (min-width: 769px) and (max-width: 1200px) {
    .property-detail-similar-props-carousel .owl-nav button.owl-prev {
        left: -50px;
    }
    
    .property-detail-similar-props-carousel .owl-nav button.owl-next {
        right: -50px;
    }
}

</style>
@endsection

@section('content')

{!! \App\Helpers\PropertySchema::toScript($property) !!}

@php
    $bannerImage = $property->images->where('is_banner', true)->first()
        ?: $property->images->first();
    $bannerUrl = $bannerImage
        ? $bannerImage->image_url
        : asset('frontassets/images/placeholder.jpg');
    $statusName = $property->propertyStatus->name ?? null;
    $priceLabel = \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit);
@endphp
<div class="property_intro_component pd-hero"
   style="background-image:url('{{ $bannerUrl }}')">
   <div class="property_intro-overlay pd-hero-overlay"></div>
   <div class="bottomsectin pd-hero-bottom">
      <div class="container">
         <div class="pd-hero-panel">
            <div class="pd-hero-main">
               @if($statusName)
               <div class="pd-hero-chips">
                  <span class="pd-hero-chip">{{ $statusName }}</span>
               </div>
               @endif

               <h1 class="pd-hero-title">{{ $property->name }}</h1>

               <div class="pd-hero-specs">
                  <div class="pd-hero-spec">
                     <div class="pd-hero-spec-icon"><i class="far fa-building"></i></div>
                     <div>
                        <span class="pd-hero-spec-label">Property Type</span>
                        <strong class="pd-hero-spec-value">{{ $property->propertyType->name ?? 'N/A' }}</strong>
                     </div>
                  </div>
                  @if(!empty($property->area_sq_ft))
                  <div class="pd-hero-spec">
                     <div class="pd-hero-spec-icon"><i class="fas fa-ruler-combined"></i></div>
                     <div>
                        <span class="pd-hero-spec-label">Project Size</span>
                        <strong class="pd-hero-spec-value">{{ number_format((float) $property->area_sq_ft) }} SqFt</strong>
                     </div>
                  </div>
                  @endif
               </div>
            </div>

            <div class="pd-hero-aside">
               <div class="pd-hero-price-card">
                  <span class="pd-hero-price-label">Starting Price</span>
                  <div class="pd-hero-price-value">{{ $priceLabel }}</div>
               </div>
               <div class="pd-hero-actions">
                  <a href="https://wa.me/{{ \App\Helpers\SiteConfigHelper::whatsappNumber() }}?text={{ rawurlencode("Hi, I'm interested in {$property->name}") }}"
                     class="pd-hero-btn pd-hero-btn-wa" target="_blank" rel="noopener">
                     <i class="fab fa-whatsapp"></i>
                     <span>WhatsApp</span>
                  </a>
                  <a href="javascript:void(0);"
                     class="pd-hero-btn pd-hero-btn-call"
                     onclick="openEnquiryPopup({name: '{{ addslashes($property->name) }}'}); return false;">
                     <i class="fas fa-phone-alt"></i>
                     <span>Get a Callback</span>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="middilesectionddetails">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="overview">
               <h3 class="infoo">Overview</h3>
               <div class="overview-content">
                  {!! $property->property_description !!}
               </div>
            </div>

            @if($property->images->where('type', 'project')->count())
            @php
                $galleryImages = $property->images->where('type', 'project')->sortBy('sort_order')->values();
                $visibleGalleryImages = $galleryImages->take(3);
                $hiddenGalleryImages = $galleryImages->slice(3)->values();
            @endphp
            <div class="gallery-sec" id="photo">
                <h3 class="property_detail-features_heading">Gallery</h3>
                <div class="gallery">
                    @foreach($visibleGalleryImages as $key => $image)
                            <a data-fancybox="gallery" 
                               data-caption="{{ $property->name }} - Image {{ $key+1 }}"
                               href="{{ $image->image_url }}"
                               class="{{ $key === 0 ? 'large' : '' }}">
                                <img class="card-img-top img-fluid"
                                    src="{{ $image->image_url }}"
                                    alt="{{ $image->alt_text }}"
                                    loading="{{ $key === 0 ? 'eager' : 'lazy' }}"
                                    decoding="async"
                                    onerror="this.src='https://via.placeholder.com/800x600?text=No+Image'">
                            </a>
                    @endforeach

                    @if($hiddenGalleryImages->count() > 0)
                        <a data-fancybox="gallery"
                           href="{{ $hiddenGalleryImages->first()->image_url }}"
                           class="clink">
                           Show all photos ({{ $galleryImages->count() }})
                        </a>
                        <div class="gallery-hidden-items">
                            @foreach($hiddenGalleryImages as $index => $image)
                                <a data-fancybox="gallery" 
                                   data-caption="{{ $property->name }} - Image {{ $index + 4 }}"
                                   href="{{ $image->image_url }}">
                                    <img src="{{ $image->thumbnail_url }}"
                                        alt="{{ $image->alt_text }}">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                @if(!empty($property->gallery_description))
                <div class="gallery-desc mt-3">
                    <div class="gallery-content">
                        {!! $property->gallery_description !!}
                    </div>
                </div>
                @endif
            </div>
            @endif

            @if($property->amenities->count() > 0)
            <div class="amenities">
               <h3 class="property_detail-features_heading">Featured Amenities</h3>

               @if(!empty(trim(strip_tags($property->amenities_description ?? ''))))
               <div class="amenities-desc">
                  <div class="amenities-content">
                     {!! $property->amenities_description !!}
                  </div>
               </div>
               @endif

               @if($property->amenities->count())
               <div role="list" class="property_detail-features_box_wrapper w-dyn-items">
                  @foreach($property->amenities as $amenity)
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <i class="{{ $amenity->icon ?: 'bi bi-star' }} amenity-icon" aria-hidden="true"></i>
                     <h3 class="property_detail-features_box_heading">{{ $amenity->name }}</h3>
                  </div>
                  @endforeach
               </div>
               @endif
            </div>
            @endif

            @if(!empty(trim(strip_tags($property->project_highlights_title))))
            <div class="overview">
               <h3 class="property_detail-features_heading">Highlights</h3>
               <div class="highlights-content">
                  {!! $property->project_highlights_title !!}
               </div>
            </div>
            @endif

            @if($property->floorPlanImages->count() || !empty(trim(strip_tags($property->floor_plan_description ?? ''))))
            <div class="overview mt-4">
               <h3 class="property_detail-features_heading">Floor Plans</h3>
               @if(!empty(trim(strip_tags($property->floor_plan_description ?? ''))))
               <div class="floor-plan-description">
                  {!! $property->floor_plan_description !!}
               </div>
               @endif
               @if($property->floorPlanImages->count())
               <div class="row">
                  @foreach($property->floorPlanImages as $index => $floorPlan)
                  <div class="col-md-6">
                     <div class="fplx">
                        <a data-fancybox="floor" data-caption="{{ $floorPlan->caption ?: $floorPlan->alt_text }}"
                           href="{{ $floorPlan->image_url }}">
                        <img src="{{ $floorPlan->thumbnail_url }}" 
                             alt="{{ $floorPlan->alt_text }}"
                             onerror="this.src='https://via.placeholder.com/400x300?text=No+Floor+Plan'">
                        </a>
                        <div class="ftext">
                           <h4>{{ $floorPlan->caption ?: 'Floor Plan ' . ($index + 1) }}</h4>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
               @endif
            </div>
            @endif

            <div class="overview mt-4">
               <h3 class="property_detail-features_heading">Price List</h3>
               @if($property->price_list)
               <div class="price-list-content">
                  {!! \App\Helpers\ConfigHelper::themePriceListHtml($property->price_list, $property->name) !!}
               </div>
               @else
               <div class="price-list-content">
                  <table class="table table-bordered text-center theme-price-table">
                     <thead class="thead-dark">
                        <tr>
                           <th scope="col">Type</th>
                           <th scope="col">Area (in SQ.FT)</th>
                           <th scope="col">Price</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           @php
                              $isCommercialForPriceList = strtolower($property->propertyCategory->slug ?? '') === 'commercial'
                                 || strtolower($property->propertyCategory->name ?? '') === 'commercial';
                              $priceListType = $isCommercialForPriceList
                                 ? ($property->propertyType->name ?? 'N/A')
                                 : ($property->bedroomOptions && $property->bedroomOptions->count() > 0
                                    ? $property->bedroomOptions->pluck('name')->join(', ')
                                    : ($property->propertyType->name ?? 'N/A'));
                           @endphp
                           <td>{{ $priceListType }}</td>
                           <td>{{ $property->area_sq_ft ?? 'N/A' }} sq.ft.</td>
                           <td>{{ \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) }}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               @endif
            </div>

                @include('front.partials.property-faqs')

            @php
                $locationMinutes = function ($value) {
                    $text = trim(strip_tags((string) ($value ?? '')));
                    if ($text === '' || !is_numeric($text)) {
                        return null;
                    }
                    $minutes = (float) $text;
                    return $minutes > 0 ? $text : null;
                };

                $airportMinutes = $locationMinutes($property->airport);
                $entertainmentMinutes = $locationMinutes($property->entertainment);
                $highwayMinutes = $locationMinutes($property->national_highway);
                $hospitalsMinutes = $locationMinutes($property->hospitals);
                $educationMinutes = $locationMinutes($property->education);
                $hasLocationText = !empty(trim(strip_tags($property->location_features ?? '')));
                $hasConnectivityItems = $airportMinutes || $entertainmentMinutes || $highwayMinutes || $hospitalsMinutes || $educationMinutes;
                $showLocationFeatures = $hasConnectivityItems || $hasLocationText;
            @endphp

            @if($showLocationFeatures)
            <div class="overview mt-5">
               <h3 class="property_detail-features_heading">Location Features</h3>
               @if($hasConnectivityItems)
               <ul class="conectivity-div">
                  @if($airportMinutes)
                  <li>
                     <i class="fas fa-plane fa-2x"></i>
                     <div class="small-font">
                        <h3>{{ $airportMinutes }}</h3>
                        <p>Minutes</p>
                        <span>International Airport</span>
                     </div>
                  </li>
                  @endif
                  @if($entertainmentMinutes)
                  <li>
                     <i class="fas fa-film fa-2x"></i>
                     <div class="small-font">
                        <h3>{{ $entertainmentMinutes }}</h3>
                        <p>Minutes</p>
                        <span>Entertainment Hub</span>
                     </div>
                  </li>
                  @endif
                  @if($highwayMinutes)
                  <li>
                     <i class="fas fa-road fa-2x"></i>
                     <div class="small-font">
                        <h3>{{ $highwayMinutes }}</h3>
                        <p>Minutes</p>
                        <span>National Highway</span>
                     </div>
                  </li>
                  @endif
                  @if($hospitalsMinutes)
                  <li>
                     <i class="fas fa-clinic-medical fa-2x"></i>
                     <div class="small-font">
                        <h3>{{ $hospitalsMinutes }}</h3>
                        <p>Minutes</p>
                        <span>World Class Hospital</span>
                     </div>
                  </li>
                  @endif
                  @if($educationMinutes)
                  <li>
                     <i class="fas fa-graduation-cap fa-2x"></i>
                     <div class="small-font">
                        <h3>{{ $educationMinutes }}</h3>
                        <p>Minutes</p>
                        <span>Educational Institute</span>
                     </div>
                  </li>
                  @endif
               </ul>
               @endif
               
               @if($hasLocationText)
               <div class="content mt-5">
                  {!! $property->location_features !!}
               </div>
               @endif
            </div>
            @endif

            @if(!empty($property->youtube_url))
            <div class="youtube-video mt-4">
               <h3 class="property_detail-features_heading">Video Tour</h3>
               <div class="video-wrapper" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000;">
                  @php
                     // Extract YouTube video ID from URL
                     $youtube_id = '';
                     if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $property->youtube_url, $id)) {
                        $youtube_id = $id[1];
                     } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $property->youtube_url, $id)) {
                        $youtube_id = $id[1];
                     } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $property->youtube_url, $id)) {
                        $youtube_id = $id[1];
                     }
                  @endphp
                  
                  @if($youtube_id)
                     <iframe 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                        src="https://www.youtube.com/embed/{{ $youtube_id }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                     </iframe>
                  @else
                     <p class="text-muted">Invalid YouTube URL</p>
                  @endif
               </div>
            </div>
            @endif

            @if($property->map_code)
            <div class="overview mt-4" id="map">
               <h3 class="property_detail-features_heading">Map</h3>
               {!! $property->map_code !!}
            </div>
            @endif
         </div>

         <div class="col-md-4">
            <div class="rightform">
               <div class="middlw">
                  <!-- Property Card -->
                  <div class="property-card">
                     <div class="property-price">{{ \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) }}</div>
                     
                     <div class="property-details mt-3">
                        <p><strong>Project name:</strong> {{ $property->name }}</p>
                        <p><strong>Location:</strong> {{ $property->location->name ?? 'Location not specified' }}</p>
                        @php
                            $isCommercialProperty = strtolower($property->propertyCategory->slug ?? '') === 'commercial'
                                || strtolower($property->propertyCategory->name ?? '') === 'commercial';
                        @endphp
                        @unless($isCommercialProperty)
                        <p><strong>Bedrooms:</strong> {{ $property->bedroomOptions && $property->bedroomOptions->count() > 0 ? $property->bedroomOptions->pluck('name')->join(', ') : 'N/A' }}</p>
                        @endunless
                        <p><strong>Property Type:</strong> {{ $property->propertyType->name ?? 'N/A' }}</p>
                        <p><strong>Size:</strong> {{ $property->area_sq_ft ?? 'N/A' }} sq.ft</p>
                        <p><strong>Status:</strong> {{ $property->propertyStatus->name ?? 'Available' }}</p>
                     </div>
                  </div>
                  
                  <div class="form-wrapper">
                     <p>Say Hello!</p>
                     <h4>Real Estate Experts</h4>
                     <form id="enquiryForm" class="form" method="post" action="{{ route('contact.submit') }}">
                        @csrf
                        <input type="hidden" name="project_name" value="{{ $property->name }}">
                        <input type="hidden" name="form_name" value="Property Page - Enquiry Form">
                        <input type="hidden" name="url" value="{{ url()->current() }}">
                        <div class="form-group">
                           <input type="text" class="form-control" name="name" id="enquiryName" required="" placeholder="Name">
                        </div>
                        <div class="form-group">
                           <input type="email" class="form-control" name="email" id="enquiryEmail" required="" placeholder="Email">
                        </div>
                        <div class="form-group">
                           <input type="tel" class="form-control" name="phone" id="enquiryPhone" required="" placeholder="Phone">
                        </div>
                        <div class="form-group">
                           <textarea name="message" class="form-control" id="enquiryMessage" cols="30" rows="3" placeholder="Message"></textarea>
                        </div>
                        <div class="link_btn"> 
                           <button type="submit" name="submit" class="btn enquiry-submit-btn"><span>SUBMIT</span></button>
                        </div>
                     </form>
                  </div>
                  
                  <div class="containerbox">
                     <h4>New Launch Property</h4>
                     <div class="grid-container">
                        @php
                           $latestProperties = \App\Models\Property::with(['images', 'location', 'propertyType'])
                              ->where('is_active', true)
                              ->where('id', '!=', $property->id)
                              ->orderBy('created_at', 'desc')
                              ->limit(4)
                              ->get();
                        @endphp
                        
                        @foreach($latestProperties as $latestProperty)
                        <div class="property">
                           @php
                              $image = $latestProperty->images->where('is_thumbnail', 1)->first() ?? $latestProperty->images->first();
                           @endphp
                           <a href="{{ route('property.show', [$latestProperty->propertyCategory->slug ?? 'residential', $latestProperty->slug]) }}">
                              @if($image && $image->image_path)
                                 <img src="{{ $image->listing_image_url }}" 
                                      alt="{{ $image->alt_text }}"
                                      loading="lazy"
                                      decoding="async"
                                      onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                              @else
                                 <img src="https://via.placeholder.com/400x300?text=No+Image" 
                                      alt="{{ $latestProperty->name }}">
                              @endif
                           </a>
                           <div class="property-title">
                              <a class="text-white" href="{{ route('property.show', [$latestProperty->propertyCategory->slug ?? 'residential', $latestProperty->slug]) }}">
                                 {{ $latestProperty->name }}
                              </a>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@if($similarProperties && $similarProperties->count() > 0)
<div class="simir ptb" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3 class="property_detail-features_heading">Similar Properties</h3>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12" style="position: relative;">
            <div class="owl-carousel property-detail-similar-props-carousel">
               @foreach($similarProperties as $similarProperty)
               <div class="property-detail-similar-props-item">
                  <div class="proboxcat {{ $similarProperty->is_sold ? 'soldrel' : '' }}" style="display: block !important;">
                     @if($similarProperty->is_sold)
                        <span class="sold">
                            <img src="{{ asset($similarProperty->property_category_id == 4 ? 'frontassets/images/rented-out.png' : 'frontassets/images/sold-out.png') }}" alt="{{ $similarProperty->property_category_id == 4 ? 'Rented Out' : 'Sold Out' }}" style="width: 200px;">
                        </span>
                     @endif
                     <div class="proboxcatimg" style="position: relative; display: block !important;">
                        @if($similarProperty->badge)
                           <span class="property-badge" style="position: absolute; top: 10px; left: 10px; z-index: 10; background: #a98862; color: #fff; padding: 5px 12px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">{{ $similarProperty->badge->name }}</span>
                        @endif
                        <a href="{{ route('property.show', [$similarProperty->propertyCategory->slug ?? 'residential', $similarProperty->slug]) }}" style="display: block;">
                           @php
                              $image = $similarProperty->images->where('is_thumbnail', 1)->first() ?? $similarProperty->images->first();
                           @endphp
                           @if($image && $image->image_path)
                              <img src="{{ $image->listing_image_url }}" 
                                   alt="{{ $image->alt_text ?? $similarProperty->name }}" 
                                   class="img-fluid"
                                   loading="lazy"
                                   decoding="async"
                                   style="width: 100%; height: 250px; object-fit: cover; display: block;"
                                   onerror="this.src='{{ asset('/frontassets/images/placeholder.jpg') }}'; this.onerror=null;">
                           @else
                              <img src="{{ asset('/frontassets/images/placeholder.jpg') }}" 
                                   alt="{{ $similarProperty->name }}" 
                                   class="img-fluid"
                                   style="width: 100%; height: 250px; object-fit: cover; display: block;">
                           @endif
                        </a>
                     </div>
                     <div class="proboxcattext" style="display: block !important;">
                        <h3 class="details_meta-property_title" title="{{ $similarProperty->name }}">
                           <a href="{{ route('property.show', [$similarProperty->propertyCategory->slug ?? 'residential', $similarProperty->slug]) }}"
                              title="{{ $similarProperty->name }}">
                              {{ $similarProperty->name }}
                           </a>
                        </h3>
                        <p>{{ $similarProperty->propertyType->name ?? '' }} | {{ $similarProperty->bedroomOptions && $similarProperty->bedroomOptions->count() > 0 ? $similarProperty->bedroomOptions->pluck('name')->join(', ') : '-' }} | {{ $similarProperty->area_sq_ft ?? 'N/A' }} sq.ft</p>
                        <p>Location: {{ $similarProperty->location->name ?? 'Location not specified' }}</p>
                        <div class="search_properties-details_price">
                           <div class="details_price-aed">{{ \App\Helpers\ConfigHelper::formatPrice($similarProperty->price, $similarProperty->price_unit) }}</div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
@else
<div class="simir ptb">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3 class="property_detail-features_heading">Similar Properties</h3>
            <div class="alert alert-warning">
               <strong>No similar properties found.</strong>
            </div>
         </div>
      </div>
   </div>
</div>
@endif

<div class="modal fade" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
            <h4>What's on your Mind</h4>
            <p>We're here to help! Tell us what you're looking for and we'll get you connected to the right people.</p>
            <div class="form-wrapper">
               <form id="enquiryFormModal" class="form" method="post" action="{{ route('contact.submit') }}">
                  @csrf
                  <input type="hidden" name="project_name" value="{{ $property->name }}">
                  <input type="hidden" name="form_name" value="Property Page - Modal Enquiry">
                  <input type="hidden" name="url" value="{{ url()->current() }}">
                  <div class="form-group">
                     <input type="text" class="form-control" name="name" id="modalEnquiryName" required="" placeholder="Name">
                  </div>
                  <div class="form-group">
                     <input type="email" class="form-control" name="email" id="modalEnquiryEmail" required="" placeholder="Email">
                  </div>
                  <div class="form-group">
                     <input type="tel" class="form-control" name="phone" id="modalEnquiryPhone" required="" placeholder="Phone">
                  </div>
                  <div class="form-group">
                     <textarea name="message" class="form-control" id="modalEnquiryMessage" cols="30" rows="4" placeholder="Message"></textarea>
                  </div>
                  <div class="link_btn"> 
                     <button type="submit" name="submit" class="btn enquiry-submit-btn-modal"><span>SUBMIT</span></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('page-js')
<script src="{{ asset('frontassets/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontassets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontassets/js/owl.carousel.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>

<script>
(function($) {
    'use strict';
    
$(document).ready(function() {
    // Ensure jQuery is available
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded!');
        return;
    }
    // Mobile menu toggle
    $('#nav-icon3').click(function(){
        $(this).toggleClass('open');
    });

    // Share button toggle - with null check
    var navIcon3 = document.getElementById("nav-icon3");
    if (navIcon3) {
        navIcon3.onclick = function() {
            var div = document.getElementById("myDiv");
            if (div) {
                if (div.style.display === "none") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
        };
    }

    // Share options toggle - with null check
    var searchSettingsIcon = document.getElementById("search_form-settings_icon_white");
    if (searchSettingsIcon) {
        searchSettingsIcon.onclick = function() {
            var div = document.getElementById("myDivser");
            if (div) {
                if (div.style.display === "none") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
        };
    }

    // Phone input
    $("#mobile_code").intlTelInput({
        initialCountry: "in",
        separateDialCode: true,
    });

    // Handle right side form submission (enquiryForm)
    $('#enquiryForm').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var form = $(this);
        var submitBtn = form.find('.enquiry-submit-btn');
        var originalText = submitBtn.find('span').text();
        
        // Disable button and show loading
        submitBtn.prop('disabled', true);
        submitBtn.find('span').text('Submitting...');
        
        // Create form data
        var formData = new FormData(this);
        
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
                submitBtn.find('span').text('Submitted!');
                submitBtn.css('background', '#48bb78');
                
                var successMessage = response.message || 'Thank you! Your enquiry has been submitted successfully. We will contact you soon.';
                
                setTimeout(function() {
                    form[0].reset();
                    submitBtn.find('span').text(originalText);
                    submitBtn.prop('disabled', false);
                    submitBtn.css('background', '');
                    alert(successMessage);
                }, 2000);
            },
            error: function(xhr) {
                submitBtn.find('span').text('Error');
                submitBtn.css('background', '#f56565');
                
                setTimeout(function() {
                    submitBtn.find('span').text(originalText);
                    submitBtn.prop('disabled', false);
                    submitBtn.css('background', '');
                    
                    var errorMsg = 'An error occurred. Please try again.';
                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if (xhr.responseJSON.errors) {
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
        
        return false;
    });

    // Handle modal form submission (enquiryFormModal)
    $('#enquiryFormModal').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var form = $(this);
        var submitBtn = form.find('.enquiry-submit-btn-modal');
        var originalText = submitBtn.find('span').text();
        
        // Disable button and show loading
        submitBtn.prop('disabled', true);
        submitBtn.find('span').text('Submitting...');
        
        // Create form data
        var formData = new FormData(this);
        
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
                submitBtn.find('span').text('Submitted!');
                submitBtn.css('background', '#48bb78');
                
                var successMessage = response.message || 'Thank you! Your enquiry has been submitted successfully. We will contact you soon.';
                
                setTimeout(function() {
                    form[0].reset();
                    $('#myModal').modal('hide');
                    submitBtn.find('span').text(originalText);
                    submitBtn.prop('disabled', false);
                    submitBtn.css('background', '');
                    alert(successMessage);
                }, 2000);
            },
            error: function(xhr) {
                submitBtn.find('span').text('Error');
                submitBtn.css('background', '#f56565');
                
                setTimeout(function() {
                    submitBtn.find('span').text(originalText);
                    submitBtn.prop('disabled', false);
                    submitBtn.css('background', '');
                    
                    var errorMsg = 'An error occurred. Please try again.';
                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if (xhr.responseJSON.errors) {
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
        
        return false;
    });

    // Initialize Similar Properties Carousel with unique class
    function initSimilarPropertiesCarousel() {
        var $similarCarousel = $('.property-detail-similar-props-carousel');
        if ($similarCarousel.length && typeof $.fn.owlCarousel !== 'undefined') {
            var itemCount = $similarCarousel.find('.property-detail-similar-props-item').length;
            
            console.log('Initializing carousel with', itemCount, 'items');
            
            // Destroy any existing instance first
            if ($similarCarousel.data('owl.carousel')) {
                try {
                    $similarCarousel.trigger('destroy.owl.carousel');
                } catch(e) {
                    console.log('Error destroying carousel:', e);
                }
                $similarCarousel.removeClass('owl-carousel owl-loaded');
                $similarCarousel.find('.owl-stage-outer').children().unwrap();
            }
            
            // Only initialize if there are items
            if (itemCount > 0) {
                // Initialize new carousel
                $similarCarousel.owlCarousel({
                    loop: itemCount > 3,
                    margin: 20,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    autoplaySpeed: 1000,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true,
                            dots: true,
                            loop: itemCount > 1
                        },
                        600: {
                            items: 2,
                            nav: true,
                            dots: true,
                            loop: itemCount > 2
                        },
                        1000: {
                            items: 3,
                            nav: true,
                            dots: true,
                            loop: itemCount > 3
                        }
                    },
                    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
                    onInitialized: function(event) {
                        console.log('Similar properties carousel initialized successfully with', itemCount, 'items');
                        $similarCarousel.css({
                            'display': 'block',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    },
                    onRefreshed: function(event) {
                        console.log('Carousel refreshed');
                    }
                });
            } else {
                console.log('No items found in carousel');
            }
        } else {
            console.log('Carousel element not found or Owl Carousel not loaded');
        }
    }
    
    // Try to initialize immediately
    initSimilarPropertiesCarousel();
    
    // Also try after a short delay in case DOM isn't ready
    setTimeout(initSimilarPropertiesCarousel, 300);
    
    // Try again after page fully loads
    $(window).on('load', function() {
        setTimeout(initSimilarPropertiesCarousel, 100);
    });
});
})(jQuery);
</script>
@endsection
