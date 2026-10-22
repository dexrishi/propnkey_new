@extends('front.frontlayouts.frontapp')

@section('title', $property->name . ' - Rent Property Details')

@section('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('frontassets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontassets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
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
</style>
@endsection

@section('content')

{!! \App\Helpers\PropertySchema::toScript($property) !!}

<div class="property_intro_component"
   style="background-image:url('{{ $property->images->where('is_banner', true)->first() ? $property->images->where('is_banner', true)->first()->image_url : ($property->images->first() ? $property->images->first()->image_url : asset('frontassets/images/placeholder.jpg')) }}')">
   <div class="btnlist">
      <div class="container mt-5">
         <div class="row">
         </div>
      </div>
   </div>
   <div class="bottomsectin">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h3 class="adnami">{{ $property->name }}</h3>
               <p>{{ $property->alias_name ?: $property->location->name }}</p>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6 col-md-6">
               <div class="projDetBann">
                  <ul>
                     <li>
                        <div class="icon">
                           <i class="far fa-building text-white"></i>
                        </div>
                        <div class="txt">
                           <div class="projn">Property Type</div>
                           <div class="projsqf">{{ $property->propertyType->name ?? 'N/A' }}</div>
                        </div>
                     </li>
                     <li>
                        <div class="icon">
                           <i class="fas fa-pencil-ruler text-white"></i>
                        </div>
                        <div class="txt">
                           <div class="projn">Project Size</div>
                           <div class="projsqf">{{ $property->area_sq_ft ?? 'N/A' }} SqFt</div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-6 col-md-6" style="position: relative;">
               @php
                  $displayRent = $property->monthly_rent ?: $property->price;
                  $formattedRent = $displayRent
                     ? \App\Helpers\ConfigHelper::formatPrice($displayRent)
                     : null;
               @endphp
               <div class="asuPri">
                  <p>{{ $formattedRent ?: 'Assured Best Price' }}</p>
               </div>
               <div class="btn_btn">
                  <a href="https://wa.me/{{ \App\Helpers\SiteConfigHelper::get('whatsapp_number', '919999964462') }}?text=Hi, I'm interested in renting {{ $property->name }}" class="wts" target="_blank">
                     <span>Whatsapp</span>
                  </a>
                  <a href="javascript:void(0);" class="cal" onclick="openEnquiryPopup({name: '{{ addslashes($property->name) }}'}); return false;">
                     <span>Get a Call back</span>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="property_intro-overlay"></div>
</div>

<div class="middilesectionddetails">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="overview-menu">
               <ul>
                  <li> <a href="#over" class="now activ"><i class="fal fa-street-view"></i> Overview</a> </li>
                  <li> <a href="#gal" class="now"><i class="fal fa-photo-video"></i> Gallery</a> </li>
                  <li> <a href="#amen" class="now"><i class="fal fa-home"></i> Amenities</a> </li>
                  <li> <a href="#rent" class="now"><i class="fal fa-rupee-sign"></i> Rent details</a> </li>
                  @if(!empty(trim(strip_tags($property->price_list ?? ''))))
                  <li> <a href="#price-list" class="now"><i class="fal fa-list-alt"></i> Price List</a> </li>
                  @endif
                  @if($property->faqs->count())
                  <li> <a href="#faq" class="now"><i class="fal fa-question-circle"></i> FAQs</a> </li>
                  @endif
                  <li> <a href="#terms" class="now"><i class="fal fa-check-circle"></i> Terms of stay</a> </li>
               </ul>
            </div>
            
            @if(!empty(trim(strip_tags($property->property_description))) || !empty(trim(strip_tags($property->gallery_description))))
            <div class="about_prop">
               <h3 class="property_detail-features_heading">About this Property</h3>
               @if(!empty(trim(strip_tags($property->property_description))))
               <div class="property-description">
                  {!! $property->property_description !!}
               </div>
               @endif
               @if(!empty(trim(strip_tags($property->gallery_description))))
               <div class="redmore" id="hiddenText" style="display:none">
                  <div class="gallery-description">
                     {!! $property->gallery_description !!}
                  </div>
               </div>
               <button type="button" class="btnred read-mr-sec" id="toggleButton"><span>More Details</span></button>
               @endif
            </div>
            @endif
            
            @if(($property->bedroomOptions && $property->bedroomOptions->count() > 0) || $property->area_sq_ft || $property->possession || $property->rise || $property->property_status)
            <div class="overview-list mt-4" id="over">
               <h3 class="property_detail-features_heading mb-4">Overview</h3>
               <ul class="over">
                  @if($property->bedroomOptions && $property->bedroomOptions->count() > 0)
                     <li><i class="fas fa-bed"></i> {{ $property->bedroomOptions->pluck('name')->join(', ') }}</li>
                  @endif
                  @if($property->area_sq_ft)
                     <li><i class="fas fa-ruler-vertical"></i> {{ number_format($property->area_sq_ft) }} (sq.ft)</li>
                  @endif
                  @if($property->possession)
                     <li><i class="fas fa-vote-yea"></i> Year of const.: {{ $property->possession->format('Y') }}</li>
                  @endif
                  @if($property->rise)
                     <li><i class="fas fa-arrow-up"></i> {{ ucfirst($property->rise) }} rise</li>
                  @endif
                  @if($property->propertyStatus)
                     <li><i class="fas fa-home"></i> {{ $property->propertyStatus->name }}</li>
                  @endif
               </ul>
            </div>
            @endif

            @if(!empty(trim(strip_tags($property->price_list ?? ''))))
            <div class="overview mt-4" id="price-list">
               <h3 class="property_detail-features_heading">Price List</h3>
               <div class="price-list-content">
                  {!! \App\Helpers\ConfigHelper::themePriceListHtml($property->price_list, $property->name) !!}
               </div>
            </div>
            @endif
            
            <div class="gallery-sec mt-4" id="gal">
               <h3 class="property_detail-features_heading">Property Gallery</h3>
               <div class="gallery">
                  @if($property->images->where('type', 'project')->count() > 0)
                     @php
                        $galleryImages = $property->images->where('type', 'project')->sortBy('sort_order')->values();
                        $visibleGalleryImages = $galleryImages->take(3);
                        $hiddenGalleryImages = $galleryImages->slice(3)->values();
                     @endphp
                     @foreach($visibleGalleryImages as $index => $image)
                        <a data-fancybox="gallery" data-caption="{{ $property->name }} - Image {{ $index + 1 }}"
                           href="{{ $image->image_url }}" class="{{ $index === 0 ? 'large' : '' }}">
                           <img class="card-img-top img-fluid"
                                src="{{ $image->image_url }}"
                                alt="{{ $image->alt_text }}"
                                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                decoding="async">
                        </a>
                     @endforeach
                     @if($hiddenGalleryImages->count() > 0)
                        <a data-fancybox="gallery" data-caption="{{ $property->name }} - All Photos"
                           href="{{ $hiddenGalleryImages->first()->image_url }}" class="clink">
                           Show all photos
                        </a>
                        <div class="gallery-hidden-items">
                           @foreach($hiddenGalleryImages as $image)
                              <a data-fancybox="gallery" data-caption="{{ $property->name }} - Image"
                                 href="{{ $image->image_url }}">
                                 <img src="{{ $image->listing_image_url }}" alt="{{ $image->alt_text }}">
                              </a>
                           @endforeach
                        </div>
                     @endif
                  @else
                     <p>No images available for this property.</p>
                  @endif
               </div>
            </div>
            
            @if(!empty(trim(strip_tags($property->rent_includes))) || ($property->amenities->count() > 0) || ($property->bedroomOptions && $property->bedroomOptions->count() > 0))
            <div class="amenities" id="amen">
               <h3 class="property_detail-features_heading">Rent Includes</h3>
               <div class="row">
                  <div class="col-md-6">
                     <div class="boxone">
                        <div class="boxhead">
                           <h4>House & Living room</h4>
                        </div>
                        <div class="boxtext">
                           @if(!empty(trim(strip_tags($property->rent_includes))))
                              {!! $property->rent_includes !!}
                           @else
                              <ul>
                                 @if($property->bedroomOptions && $property->bedroomOptions->count() > 0)
                                    <li><i class="fas fa-bed"></i> {{ $property->bedroomOptions->pluck('name')->join(', ') }}</li>
                                 @endif
                                 <li><i class="fas fa-ruler-vertical"></i> {{ $property->area_sq_ft ? number_format($property->area_sq_ft) . ' (sq.ft)' : 'Area not specified' }}</li>
                                 @if($property->possession)
                                    <li><i class="fas fa-vote-yea"></i> Year of const.: {{ $property->possession->format('Y') }}</li>
                                 @endif
                              </ul>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="boxone">
                        <div class="boxhead">
                           <h4>Kitchen & Bed room</h4>
                        </div>
                        <div class="boxtext">
                           @if($property->amenities->count() > 0)
                              <ul>
                                 @foreach($property->amenities->take(6) as $amenity)
                                    <li><i class="fas fa-check"></i> {{ $amenity->name }}</li>
                                 @endforeach
                              </ul>
                           @else
                              <p>Standard amenities included</p>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endif

            @if($property->monthly_rent || $property->price || $property->security_deposit || $property->one_time_fees || $property->total_payable)
            <div class="overview mt-4" id="rent">
               <h3 class="property_detail-features_heading">Rent & Deposit</h3>
               <ul class="pricelista">
                  @if($property->monthly_rent || $property->price)
                     <li>
                        <div class="rent">
                           <h4>Monthly rent</h4>
                        </div>
                        <div class="rprice">{{ \App\Helpers\ConfigHelper::formatPrice($property->monthly_rent ?: $property->price) }}</div>
                     </li>
                  @endif
                  @if($property->security_deposit)
                     <li>
                        <div class="rent">
                           <h4>Security deposit</h4>
                           <p>Fully refundable if vacated in original condition</p>
                        </div>
                        <div class="rprice">₹ {{ number_format($property->security_deposit) }}</div>
                     </li>
                  @endif
                  @if($property->one_time_fees)
                     <li>
                        <div class="rent">
                           <h4>One time fees</h4>
                           <p>One time accommodation convenience fee</p>
                        </div>
                        <div class="rprice">₹ {{ number_format($property->one_time_fees) }}</div>
                     </li>
                  @endif
                  @if($property->total_payable)
                     <li>
                        <div class="rent">
                           <h4>Total payable amount</h4>
                           <p>Includes monthly rent, security deposit and one time fees.</p>
                        </div>
                        <div class="rprice">₹ {{ number_format($property->total_payable) }}</div>
                     </li>
                  @endif
               </ul>
            </div>
            @endif

            @if($property->faqs->count())
            <div id="faq">
               @include('front.partials.property-faqs')
            </div>
            @endif
            
            @if(!empty(trim(strip_tags($property->rent_excludes))))
            <div class="Rent-excludes mt-4">
               <h3 class="property_detail-features_heading">Rent excludes</h3>
               <ul class="over">
                  {!! $property->rent_excludes !!}
               </ul>
            </div>
            @endif
            
            @php
               $exploreNearby = $property->explore_nearby ?? [];
               if (is_string($exploreNearby)) {
                   $exploreNearby = json_decode($exploreNearby, true) ?? [];
               }
               if (!is_array($exploreNearby)) {
                   $exploreNearby = [];
               }
               $hasExploreNearby = !empty($exploreNearby);
               $hasLocationFeatures = !empty(trim(strip_tags($property->location_features)));
               $hasMapCode = !empty($property->map_code);
            @endphp
            @if($hasExploreNearby || $hasLocationFeatures || $hasMapCode)
            <div class="overview mt-4">
               <h3 class="property_detail-features_heading">Explore Nearby</h3>
               @if($hasExploreNearby)
                  <ul class="over">
                     @foreach($exploreNearby as $item)
                        <li><i class="fas fa-map-marker-alt"></i> {{ $item }}</li>
                     @endforeach
                  </ul>
               @elseif($hasLocationFeatures)
                  <div class="location-features-content">
                     {!! $property->location_features !!}
                  </div>
               @endif

               @if($hasMapCode)
                  {!! $property->map_code !!}
               @endif
            </div>
            @endif
            
            @if($property->rental_process)
               <div class="overview mt-4">
                  <h3 class="property_detail-features_heading">Rental Process Needs to Follow</h3>
                  <div class="rental-process-content">
                     {!! $property->rental_process !!}
                  </div>
               </div>
            @endif
            
            @if($property->dos_donts)
               <div class="overview mt-4" id="terms">
                  <h3 class="property_detail-features_heading">Dos and Don'ts</h3>
                  <div class="dos-donts-content">
                     {!! $property->dos_donts !!}
                  </div>
                  @if($property->lock_in_period_days)
                     <p>Lock-in period: {{ $property->lock_in_period_days }} Days</p>
                  @endif
                  @if($property->notice_period_days)
                     <p>Notice period: {{ $property->notice_period_days }} Days</p>
                  @endif
               </div>
            @endif
            
            @if($property->terms_conditions)
               <div class="overview mt-4">
                  <h3 class="property_detail-features_heading">Terms & Conditions</h3>
                  <div class="terms-conditions-content">
                     {!! $property->terms_conditions !!}
                  </div>
               </div>
            @endif
         </div>
         
         <div class="col-md-4">
            <div class="rightform">
               <div class="middlw">
                  <div class="rentappoint">
                     <div class="rentcard">
                        <div class="ppprice">
                           <div>
                              <strong>{{ ($property->monthly_rent || $property->price) ? \App\Helpers\ConfigHelper::formatPrice($property->monthly_rent ?: $property->price) : 'Contact' }}</strong>
                              <span>Rent/ month</span>
                           </div>
                           <div>
                              <strong>{{ $property->security_deposit ? \App\Helpers\ConfigHelper::formatPrice($property->security_deposit) : 'Contact' }}</strong>
                              <span>Deposit</span>
                           </div>
                        </div>

                        <div class="form-wrapper">
                           <p>Say Hello!</p>
                           <h4>Real Estate Experts</h4>
                           <form id="rentEnquiryForm" class="form" method="post" action="{{ route('contact.submit') }}">
                              @csrf
                              <input type="hidden" name="project_name" value="{{ $property->name }}">
                              <input type="hidden" name="form_name" value="Rent Property Page - Enquiry Form">
                              <input type="hidden" name="url" value="{{ url()->current() }}">
                              <div class="form-group">
                                 <input type="text" class="form-control" name="name" id="rentEnquiryName" required="" placeholder="Name">
                              </div>
                              <div class="form-group">
                                 <input type="text" class="form-control" name="company" id="rentEnquiryCompany" placeholder="Company">
                              </div>
                              <div class="form-group">
                                 <input type="email" class="form-control" name="email" id="rentEnquiryEmail" required="" placeholder="Email">
                              </div>
                              <div class="form-group">
                                 <input type="tel" class="form-control" name="phone" id="rentEnquiryPhone" required="" placeholder="Phone">
                              </div>
                              <div class="form-group">
                                 <textarea name="message" class="form-control" id="rentEnquiryMessage" cols="30" rows="3" placeholder="Message"></textarea>
                              </div>
                              <div class="link_btn"> 
                                 <button type="submit" name="submit" class="btn enquiry-submit-btn-rent"><span>SUBMIT</span></button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@if($similarProperties && $similarProperties->count())
<div class="simir ptb">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3 class="property_detail-features_heading">Similar Rental</h3>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="owl-carousel smisslider">
               @foreach($similarProperties as $similarProperty)
               <div class="simitem">
                  <div class="proboxcat">
                     <div class="proboxcatimg">
                        <a href="{{ route('property.show', [$similarProperty->propertyCategory->slug ?? 'residential', $similarProperty->slug]) }}">
                           @php
                              $image = $similarProperty->images->where('is_thumbnail', 1)->first() ?? $similarProperty->images->first();
                           @endphp
                           @if($image && $image->image_path)
                              <img src="{{ $image->listing_image_url }}" 
                                   alt="{{ $image->alt_text }}" 
                                   class="img-fluid"
                                   onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                           @else
                              <img src="https://via.placeholder.com/400x300?text=No+Image" 
                                   alt="{{ $similarProperty->name }}" 
                                   class="img-fluid">
                           @endif
                        </a>
                     </div>
                     <div class="proboxcattext">
                        <h1 class="details_meta-property_title" title="{{ $similarProperty->name }}">
                           <a href="{{ route('property.show', [$similarProperty->propertyCategory->slug ?? 'residential', $similarProperty->slug]) }}"
                              title="{{ $similarProperty->name }}">
                              {{ $similarProperty->name }}
                           </a>
                        </h1>
                        <p>{{ $similarProperty->propertyType->name ?? '' }} | {{ $similarProperty->bedroomOptions && $similarProperty->bedroomOptions->count() > 0 ? $similarProperty->bedroomOptions->pluck('name')->join(', ') : '-' }} | {{ $similarProperty->area_sq_ft ?? 'N/A' }} sq.ft</p>
                        <p>Location: {{ $similarProperty->location->name ?? 'Location not specified' }}</p>
                        <div class="search_properties-details_price">
                           <div class="details_price-aed">{{ \App\Helpers\ConfigHelper::formatPrice($similarProperty->monthly_rent ?: $similarProperty->price) }}</div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
            <div class="counter">
               <span id="currentSlide6">1</span> / <span id="totalSlides6"></span>
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
               <form id="enquiryForm" class="form" method="post" action="{{ route('contact.submit') }}">
                  @csrf
                  <input type="hidden" name="project_name" value="{{ $property->name }}">
                  <input type="hidden" name="form_name" value="Rent Property Page - Modal Enquiry">
                  <input type="hidden" name="url" value="{{ url()->current() }}">
                  <div class="form-group">
                     <input type="text" class="form-control" name="name" required="" placeholder="Name">
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control" name="company" required="" placeholder="Company">
                  </div>
                  <div class="form-group">
                     <input type="email" class="form-control" name="email" required="" placeholder="Email">
                  </div>
                  <div class="form-group">
                     <input type="tel" class="form-control" name="phone" required="" placeholder="Phone">
                  </div>
                  <div class="form-group">
                     <textarea name="message" class="form-control" id="" cols="30" rows="4" placeholder="Message"></textarea>
                  </div>
                  <div class="link_btn"> 
                     <button type="submit" name="submit" class="btn"><span>SUBMIT</span></button>
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
$(document).ready(function() {
    // Mobile menu toggle
    $('#nav-icon3').click(function(){
        $(this).toggleClass('open');
    });

    // Share button toggle
    document.getElementById("nav-icon3").onclick = function() {
        var div = document.getElementById("myDiv");
        if (div.style.display === "none") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    };

    // Share options toggle
    document.getElementById("search_form-settings_icon_white").onclick = function() {
        var div = document.getElementById("myDivser");
        if (div.style.display === "none") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    };

    // Read more toggles
    $("#toggleButton").click(function() {
        $("#hiddenText").slideToggle();
    });

    $("#toggleButton1").click(function() {
        $("#hiddenText1").slideToggle();
    });

    $("#toggleButton2").click(function() {
        $("#hiddenText2").slideToggle();
    });

    // Similar properties carousel
    var owl = $(".smisslider");
    owl.owlCarousel({
        items: 1,
        loop: true,
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
        navText: ["&#8592;", "&#8594;"],
        onInitialized: updateCounter,
        onTranslated: updateCounter
    });

    function updateCounter(event) {
        var totalItems = event.item.count;
        var currentIndex = event.item.index - event.relatedTarget._clones.length / 2 + 1;

        if (currentIndex > totalItems) {
            currentIndex = 1;
        }

        $("#currentSlide6").text(currentIndex);
        $("#totalSlides6").text(totalItems);
    }


    // Navigation menu smooth scroll
    document.querySelectorAll('.now').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active from all
            document.querySelectorAll('.now').forEach(nav => {
                nav.classList.remove('activ');
            });

            // Add active to clicked link
            this.classList.add('activ');

            // Scroll to section
            const section = document.querySelector(this.getAttribute('href'));
            section.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Phone input
    $("#mobile_code").intlTelInput({
        initialCountry: "in",
        separateDialCode: true,
    });

    // Handle rent property form submission (rentEnquiryForm)
    $('#rentEnquiryForm').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var form = $(this);
        var submitBtn = form.find('.enquiry-submit-btn-rent');
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

    // Handle modal form submission (enquiryForm) - Update modal form handler
    $('#enquiryForm').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
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
});
</script>
@endsection