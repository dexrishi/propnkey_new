@extends('front.frontlayouts.frontapp')
@section('page-css')

@endsection
@section('content')

<div class="property_intro_component"
   style="background-image:url('https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/66fd2d4bc4d7fe4ef025dd34_DSC09561-MLS.jpg')">
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
               <p>{{ $property->alias_name }}</p>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6 col-md-6">
               <div class="projDetBann">
                  <ul>
                     <li>
                        <div class="icon"><img
                           src="https://www.reiasindia.com/assets/img/project-detail/arr.png" alt="">
                        </div>
                        <div class="txt">
                           <div class="projn">Proprty Type</div>
                           <div class="projsqf">{{ $property->propertyType->name }}</div>
                        </div>
                     </li>
                     <li>
                        <div class="icon"><img
                           src="https://www.reiasindia.com/assets/img/project-detail/build.png" alt="">
                        </div>
                        <div class="txt">
                           <div class="projn">Project Size</div>
                           <div class="projsqf">{{ $property->area_sq_ft }} sq.ft</div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="asuPri">
                  <p>₹ {{ number_format($property->price, 2) }} {{ $property->price_unit }}</p>
               </div>
               <div class="btn_btn">
                  <a href="" class="wts">
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
            <div class="overview">
               <h3 class="infoo">Overview</h3>
                <p>
                    {{ \Illuminate\Support\Str::limit(strip_tags($property->property_description), 250) }}
                </p>
               
               <div class="redmore" id="hiddenText" style="display:none">
                  <p>{{ $property->property_description }}</p>
               </div>
               <button type="button" class="btnred read-mr-sec" id="toggleButton"><span>Read
               More</span></button>
            </div>
            @if($property->images->count())
                <div class="gallery-sec" id="photo">
                    <h3 class="property_detail-features_heading">Gallery</h3>
                    <div class="gallery">

                        @foreach($property->images as $key => $image)
                            @php
                                $thumb = asset(
                                    'storage/properties/' . $property->id . '/project/thumbnails/' .
                                    pathinfo($image->image_path, PATHINFO_FILENAME) . '_thumb.' .
                                    pathinfo($image->image_path, PATHINFO_EXTENSION)
                                );
                                $original = asset('storage/properties/' . $property->id . '/project/' . $image->image_path);
                            @endphp

                            <a data-fancybox="gallery" 
                            data-caption="{{ $property->name }} - Image {{ $key+1 }}"
                            href="{{ $original }}"
                            class="{{ $key === 0 ? 'large' : '' }}">
                                <img class="card-img-top img-fluid"
                                    src="{{ $thumb }}"
                                    alt="{{ $property->name }} Image {{ $key+1 }}">
                            </a>
                        @endforeach

                        {{-- Show all photos link --}}
                        @if($property->images->count() > 3)
                            <a data-fancybox="gallery"
                            href="{{ asset('storage/properties/'.$property->id.'/project/'.$property->images->first()->image_path) }}"
                            class="clink">
                            Show all photos
                            </a>
                        @endif

                    </div>
                     @if(!empty($property->gallery_description))
                    <div class="gallery-desc mt-3">
                        <p>
                            {{ \Illuminate\Support\Str::limit($property->gallery_description, 150) }}
                        </p>

                        <div class="redmore" id="hiddenText" style="display:none">
                            <p>{{ $property->gallery_description }}</p>
                        </div>

                        <button type="button" id="toggleBtn" class="btnred read-mr-sec">Read More</button>
                    </div>
                    @endif
                </div>
            @endif

            <div class="amenities">
               <h3 class="property_detail-features_heading">Features</h3>
                <p>
                    {{ \Illuminate\Support\Str::limit(strip_tags($property->location_features), 200) }}
                </p>
                <div class="redmore" id="hiddenText1" style="display:none">
                    <p>{{ $property->location_features }}</p>
                </div>
               <button type="button" class="p-0 btnred read-mr-sec" id="toggleButton1"><span>Read
               More</span></button>
               <div role="list" class="property_detail-features_box_wrapper w-dyn-items">
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719ea21adf4fb7d9d93fd94_3.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Balcony</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e93958f940f15693b85e_6.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Central AC</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719ea1823e110b56a5c0c44_5.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Built in Wardrobes</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e8ed26b167bd3f81671f_10.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Covered Parking</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e8b97c64bc246ca67bb2_1.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Furnished</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e905ace6365af6df0d4d_11.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Kitchen Appliances</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e8cf39820388274e78c5_12.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Lobby in Building</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719ea688ed7097fbf2bc80a_2.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Maids Room</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e969514df18dcfd78444_18.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Shared Gym</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e837f627545a87f707d3_19.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Shared Pool</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e82657a0438d8f7d1c08_20.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Shared Spa</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e99d7c64bc246ca72375_17.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Security</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719ea5cc542b2520c5f58d3_24.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">View Of Water</h3>
                  </div>
                  <div role="listitem" class="property_detail-features_box w-dyn-item">
                     <img
                        src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc468081cf/6719e94e7d41ccf378f94d90_25.01-70x70-Blue%20Beetle-ABC-262932.svg"
                        loading="lazy" alt="" class="icon-embed-custom2">
                     <h3 class="property_detail-features_box_heading">Walk in Closet</h3>
                  </div>
               </div>
            </div>
            <div class="overview">
               <h3 class="property_detail-features_heading">Highlights</h3>
                <p>
                    {{ \Illuminate\Support\Str::limit(strip_tags($property->project_highlights_title), 250) }}
                </p>
                <div class="redmore" id="hiddenText" style="display:none">
                    <p>{{ $property->project_highlights_title }}</p>
                </div>
               <button type="button" class="btnred read-mr-sec" id="toggleButton"><span>Read
               More</span></button>
            </div>
            <div class="overview mt-4">
               <h3 class="property_detail-features_heading">Floor Plans</h3>
               <p>{{ $property->floor_plan_description }}</p>
               <div class="row">
                  <div class="col-md-6">
                     <div class="fplx">
                        <a data-fancybox="floor" data-caption="Diamond Ring"
                           href="images/b9c5a8c8b000d079b17bdb09ba77106b.jpg">
                        <img src="images/b9c5a8c8b000d079b17bdb09ba77106b.jpg" alt="Balcony View">
                        </a>
                        <div class="ftext">
                           <h4>Master Floor Plan</h4>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="fplx">
                        <a data-fancybox="floor" data-caption="Diamond Ring"
                           href="images/b9c5a8c8b000d079b17bdb09ba77106b.jpg">
                        <img src="images/b9c5a8c8b000d079b17bdb09ba77106b.jpg" alt="Balcony View">
                        </a>
                        <div class="ftext">
                           <h4>Master Floor Plan</h4>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="fplx">
                        <a data-fancybox="floor" data-caption="Diamond Ring"
                           href="images/b9c5a8c8b000d079b17bdb09ba77106b.jpg">
                        <img src="images/b9c5a8c8b000d079b17bdb09ba77106b.jpg" alt="Balcony View">
                        </a>
                        <div class="ftext">
                           <h4>Master Floor Plan</h4>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="fplx">
                        <a data-fancybox="floor" data-caption="Diamond Ring"
                           href="images/b9c5a8c8b000d079b17bdb09ba77106b.jpg">
                        <img src="images/b9c5a8c8b000d079b17bdb09ba77106b.jpg" alt="Balcony View">
                        </a>
                        <div class="ftext">
                           <h4>Master Floor Plan</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="overview mt-4">
               <h3 class="property_detail-features_heading">Price List</h3>
               <div class="price-list-content">
                  @if(!empty($property->price_list))
                     {!! \App\Helpers\ConfigHelper::themePriceListHtml($property->price_list, $property->name) !!}
                  @else
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
                              <td>3 BHK</td>
                              <td>2850 sq.ft.</td>
                              <td>₹5.3 Crore*</td>
                           </tr>
                           <tr>
                              <td>3 BHK</td>
                              <td>2952 sq.ft.</td>
                              <td><a data-bs-target="#popup-form" data-bs-toggle="modal" href="#">Get price</a></td>
                           </tr>
                           <tr>
                              <td>3 BHK</td>
                              <td>3043 sq.ft.</td>
                              <td><a data-bs-target="#popup-form" data-bs-toggle="modal" href="#">Get price</a></td>
                           </tr>
                           <tr>
                              <td>3 BHK</td>
                              <td>3505 sq.ft.</td>
                              <td><a data-bs-target="#popup-form" data-bs-toggle="modal" href="#">Get price</a></td>
                           </tr>
                        </tbody>
                     </table>
                  @endif
               </div>
            </div>

            @include('front.partials.property-faqs')

            <div class="overview mt-5">
               <h3 class="property_detail-features_heading">Location Features</h3>
               <ul class="conectivity-div">
                  <li>
                     <i class="fas fa-plane fa-2x"></i>
                     <div class="small-font">
                        <h3>30</h3>
                        <p>Minutes</p>
                        <span>International Airport</span>
                     </div>
                  </li>
                  <li>
                     <i class="fas fa-film fa-2x"></i>
                     <div class="small-font">
                        <h3>10</h3>
                        <p>Minutes</p>
                        <span>Entertainment Hub</span>
                     </div>
                  </li>
                  <li>
                     <i class="fas fa-road fa-2x"></i>
                     <div class="small-font">
                        <h3>10</h3>
                        <p>Minutes</p>
                        <span>National Highway</span>
                     </div>
                  </li>
                  <li>
                     <i class="fas fa-clinic-medical fa-2x"></i>
                     <div class="small-font">
                        <h3>8</h3>
                        <p>Minutes</p>
                        <span>World Class Hospital</span>
                     </div>
                  </li>
                  <li>
                     <i class="fas fa-graduation-cap fa-2x"></i>
                     <div class="small-font">
                        <h3>2</h3>
                        <p>Minutes</p>
                        <span>Educational Institute</span>
                     </div>
                  </li>
               </ul>
               <div class="content mt-5">
                  <p>
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque aut deserunt dolorum illo numquam quisquam ipsa voluptates nihil! Porro voluptas cumque neque nostrum maxime quod, libero voluptatum nam voluptatibus quia.
                  </p>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias quos iusto hic. Nisi assumenda temporibus sed eveniet iusto error, ratione laudantium nihil, aspernatur expedita sapiente. Vitae, eligendi. Voluptatibus, aliquam dolor?</p>
               </div>
            </div>
            <div class="overview mt-4" id="map">
               <h3 class="property_detail-features_heading">Map</h3>
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28021.515400933837!2d77.21230518200733!3d28.609092569641824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2db961be393%3A0xf6c7ef5ee6dd10ae!2sIndia%20Gate%2C%20New%20Delhi%2C%20Delhi!5e0!3m2!1sen!2sin!4v1740051648991!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
         </div>
         <div class="col-md-4">
            <div class="rightform">
               <div class="middlw">
                  <div class="form-wrapper">
                     <p>Say Hello!</p>
                     <h4>  Real Estate Experts</h4>
                     <form id="enquiryForm" class="form" method="post">
                        <input type="hidden" name="project_name" value="Adani Samsara Ivana">
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
                           <textarea name="message" class="form-control" id="" cols="30" rows="3" placeholder="Message"></textarea>
                        </div>
                        <div class="link_btn"> <button type="submit" name="submit" class="btn"><span>SUBMIT</span></button></div>
                     </form>
                  </div>
                  <div class="containerbox">
                     <h4>New Launch Property</h4>
                     <div class="grid-container">
                        <div class="property">
                           <img src="images/prominent-swastik-greens-1.jpg" alt="Swastik Greens">
                           <div class="property-title">Prominent Swastik Greens</div>
                        </div>
                        <div class="property">
                           <img src="images/prominent-swastik-greens-1.jpg" alt="Swastik Greens">
                           <div class="property-title">Emaar Marbella Phase 2 Plots</div>
                        </div>
                        <div class="property">
                           <img src="images/prominent-swastik-greens-1.jpg" alt="Swastik Greens">
                           <div class="property-title">JMS Primeland Plots</div>
                        </div>
                        <div class="property">
                           <img src="images/prominent-swastik-greens-1.jpg" alt="Swastik Greens">
                           <div class="property-title">Emerald Hills Villa Plots</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="simir ptb">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3 class="property_detail-features_heading">Similar Properties</h3>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="owl-carousel smisslider">
               <div class="simitem">
                  <div class="proboxcat">
                     <div class="proboxcatimg">
                        <a href="">
                        <img src="images/DSC08587-MLS.jpg" alt="" class="img-fluid">
                        </a>
                     </div>
                     <div class="proboxcattext">
                        <h1 class="details_meta-property_title">Chic European Style Penthouse with Amazing Views</h1>
                        <p>Penthouse | 3 | 4,077 sq.ft | 379 sq.m</p>
                        <p>Location:
                           Al Mesk Tower, Dubai, Dubai Marina
                        </p>
                        <div class="search_properties-details_price">
                           <div fs-cmsfilter-field="price" class="details_price-aed">RS 13,900,000</div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="simitem">
                  <div class="proboxcat">
                     <div class="proboxcatimg">
                        <a href="">
                        <img src="images/DSC08587-MLS.jpg" alt="" class="img-fluid">
                        </a>
                     </div>
                     <div class="proboxcattext">
                        <h1 class="details_meta-property_title">Chic European Style Penthouse with Amazing Views</h1>
                        <p>Penthouse | 3 | 4,077 sq.ft | 379 sq.m</p>
                        <p>Location:
                           Al Mesk Tower, Dubai, Dubai Marina
                        </p>
                        <div class="search_properties-details_price">
                           <div fs-cmsfilter-field="price" class="details_price-aed">RS 13,900,000</div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="simitem">
                  <div class="proboxcat">
                     <div class="proboxcatimg">
                        <a href="">
                        <img src="images/DSC08587-MLS.jpg" alt="" class="img-fluid">
                        </a>
                     </div>
                     <div class="proboxcattext">
                        <h1 class="details_meta-property_title">Chic European Style Penthouse with Amazing Views</h1>
                        <p>Penthouse | 3 | 4,077 sq.ft | 379 sq.m</p>
                        <p>Location:
                           Al Mesk Tower, Dubai, Dubai Marina
                        </p>
                        <div class="search_properties-details_price">
                           <div fs-cmsfilter-field="price" class="details_price-aed">RS 13,900,000</div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="simitem">
                  <div class="proboxcat">
                     <div class="proboxcatimg">
                        <a href="">
                        <img src="images/DSC08587-MLS.jpg" alt="" class="img-fluid">
                        </a>
                     </div>
                     <div class="proboxcattext">
                        <h1 class="details_meta-property_title">Chic European Style Penthouse with Amazing Views</h1>
                        <p>Penthouse | 3 | 4,077 sq.ft | 379 sq.m</p>
                        <p>Location:
                           Al Mesk Tower, Dubai, Dubai Marina
                        </p>
                        <div class="search_properties-details_price">
                           <div fs-cmsfilter-field="price" class="details_price-aed">RS 13,900,000</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="counter">
               <span id="currentSlide6">1</span> / <span id="totalSlides6"></span>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="myModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal body -->
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
            <h4>What's on your Mind</h4>
            <p>We’re here to help! Tell us what you’re looking for and we’ll get you connected to the right
               people.
            </p>
            <div class="form-wrapper">
               <form id="enquiryForm" class="form" method="post">
                  <input type="hidden" name="project_name" value="Adani Samsara Ivana">
                  <div class="form-group">
                     <input type="text" class="form-control" name="name" required="" placeholder="Name">
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control" name="company" required=""
                        placeholder="Company">
                  </div>
                  <div class="form-group">
                     <input type="email" class="form-control" name="email" required="" placeholder="Email">
                  </div>
                  <div class="form-group">
                     <input type="tel" class="form-control" name="phone" required="" placeholder="Phone">
                  </div>
                  <div class="form-group">
                     <textarea name="message" class="form-control" id="" cols="30" rows="4"
                        placeholder="Message"></textarea>
                  </div>
                  <div class="link_btn"> <button type="submit" name="submit"
                     class="btn"><span>SUBMIT</span></button></div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection

@section('page-js')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js">
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>
    <script>
    $("#mobile_code").intlTelInput({
        initialCountry: "in",
        separateDialCode: true,
        // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    });
    </script>
    <script>
    document.getElementById("search_form-settings_icon_white").onclick = function() {
        var div = document.getElementById("myDivser");
        if (div.style.display === "none") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    };
    </script>
    <script>
    $(document).ready(function() {

        $("#toggleButton").click(function() {

            $("#hiddenText").slideToggle();

        });

    });
    </script>
     <script>
    $(document).ready(function() {

        $("#toggleButton1").click(function() {

            $("#hiddenText1").slideToggle();

        });

    });
    </script>
    <script>
        $(document).ready(function() {
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

                $("#currentSlide6").text(currentIndex);
                $("#totalSlides6").text(totalItems);
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const hiddenText = document.getElementById("hiddenText");
            const toggleBtn = document.getElementById("toggleBtn");

            if(toggleBtn){
                toggleBtn.addEventListener("click", function() {
                    if (hiddenText.style.display === "none") {
                        hiddenText.style.display = "block";
                        toggleBtn.textContent = "Read Less";
                    } else {
                        hiddenText.style.display = "none";
                        toggleBtn.textContent = "Read More";
                    }
                });
            }
        });
    </script>
@endsection


