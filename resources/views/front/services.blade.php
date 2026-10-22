@extends('front.frontlayouts.frontapp')

@section('page-css')

@endsection

@section('content')

<div class="services_cta_component">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page_header-heading">{{ \App\Helpers\SiteConfigHelper::get('our_services_title', 'Our services') }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>{!! \App\Helpers\SiteConfigHelper::get('our_services_description', 'Luxury Residences provides a definitive suite of support that extends across the diverse and ever changing world of real estate, finance, lifestyle management, development, interior design and legal services.') !!}</p>
            </div>
        </div>
    </div>
</div>

<div class="sadjkk">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($propertyCategories) && $propertyCategories->count() > 0)
                    @foreach($propertyCategories as $category)
                        <div class="about_services-box">
                            <div class="row">
                                <div class="col-md-5">
                                    <h2 class="about_services-box_heading">
                                        <?php $catSlug = preg_replace('/-properties$/', '', $category->slug); ?>
                                        <a href="{{ route('category.direct', ['category_slug' => $catSlug]) }}" style="color: inherit; text-decoration: none;">{{ $category->name }}</a>
                                    </h2>
                                </div>
                                <div class="col-md-7">
                                    <p class="about_services-box_paragraph">
                                        @if($category->description)
                                            {!! $category->description !!}
                                        @else
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="about_services-box">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 class="about_services-box_heading">No Services Available</h2>
                            </div>
                            <div class="col-md-8">
                                <p class="about_services-box_paragraph">Please check back later for our services.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="luxury">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="before_footer-paragraph">
                    Propnkey is built on a foundation of trust and discretion. We handle your most important real estate matters with the care they deserve, pairing white-glove customer service with global market capabilities to deliver exceptional outcomes.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')

@endsection

