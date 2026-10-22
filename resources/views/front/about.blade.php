@extends('front.frontlayouts.frontapp')
@section('page-css')

@endsection

@section('content')
<div class="abtfirst">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="our-story-heading_component"><span class="our-story-heading_welcome">Welcome
                        to<br></span>Our Story</h2>
                <p>{!! \App\Helpers\SiteConfigHelper::get('about_description') !!}</p>
            </div>
        </div>
    </div>

</div>
<div class="abtsecond">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="infocus-intro_heading">{!! \App\Helpers\SiteConfigHelper::get('about_page_in_focus_title', 'In Focus') !!}</h2>
                <p class="infocus-intro_p">{!! \App\Helpers\SiteConfigHelper::get('about_page_in_focus_description') !!}<br></p>
            </div>
            <div class="col-md-6">
                <div class="infocus_col">
                    <div class="infocus-counter_component">
                        <div class="infocus-counter_title">{!! \App\Helpers\SiteConfigHelper::get('about_us_count_1_title', '2B+') !!}<br>
                        </div>
                        <div class="infocus-counter_description">{!! \App\Helpers\SiteConfigHelper::get('about_us_count_1_description', 'AED of transaction value recorded since 2022') !!}<br>
                        </div>
                    </div>
                    <div class="infocus-counter_component">
                        <div class="infocus-counter_title">{!! \App\Helpers\SiteConfigHelper::get('about_us_count_2_title', '40+') !!}<br></div>
                        <div class="infocus-counter_description">{!! \App\Helpers\SiteConfigHelper::get('about_us_count_2_description', 'Years of combined team experience') !!}<br></div>
                    </div>
                    <div class="infocus-counter_component">
                        <div class="infocus-counter_title">{!! \App\Helpers\SiteConfigHelper::get('about_us_count_3_title', '1<sup>st</sup>') !!}<br></div>
                        <div class="infocus-counter_description">{!! \App\Helpers\SiteConfigHelper::get('about_us_count_3_description', '') !!}<br></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section_team-intro">
    @php
        $teamBgImage = \App\Helpers\SiteConfigHelper::get('about_our_team_bg_image');
        // If image path exists and doesn't start with '/', it's a storage path
        if ($teamBgImage && !str_starts_with($teamBgImage, '/')) {
            $teamBgImageUrl = asset('storage/' . $teamBgImage);
        } elseif ($teamBgImage) {
            $teamBgImageUrl = asset($teamBgImage);
        } else {
            $teamBgImageUrl = asset('/frontassets/images/placeholder.jpg');
        }
    @endphp
    <img src="{{ $teamBgImageUrl }}"
        loading="lazy" sizes="100vw"
        alt="Our Team" class="team-intro_img">
    <div class="team-intro_overlay">
        <h2 class="team-intro_heading">Our Team</h2>
    </div>
</div>
@if(isset($featuredAgent) && $featuredAgent)
<div class="memberhigh">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="tembox text-center">
                    @if($featuredAgent->image_url)
                        <img src="{{ $featuredAgent->image_url }}"
                            loading="lazy" 
                            alt="{{ $featuredAgent->name }}" 
                            class="member-highlight_img">
                    @else
                        <div class="member-highlight_img-placeholder" style="width: 200px; height: 200px; background-color: #ddd; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #666; border-radius: 50%; margin: 0 auto 20px auto;">
                            {{ $featuredAgent->initials }}
                        </div>
                    @endif
                    <div class="member-highlight_name">{{ $featuredAgent->name }}<br></div>
                    <div class="member-highlight_designation">{{ $featuredAgent->designation }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="temboxtext">
                    @if($featuredAgent->bio)
                        {!! $featuredAgent->bio !!}
                    @else
                        <p>No biography available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(isset($agents) && $agents->count() > 0)
<div class="members">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="team-grid w-dyn-items">
                    @foreach($agents as $agent)
                    <div class="member_component w-dyn-item">
                        @if($agent->image_url)
                            <img src="{{ $agent->image_url }}" 
                                 loading="lazy" 
                                 alt="{{ $agent->name }}" 
                                 class="members_image">
                        @else
                            <div class="members_image-placeholder">
                                {{ $agent->initials }}
                            </div>
                        @endif
                        <div class="members_name">{{ $agent->name }}</div>
                        <div class="members_designation">{{ $agent->designation }}</div>
                        <div class="member_actions">
                            <a href="#" class="member_show-more">Show more</a>
                            <a href="tel:{{ $agent->phone }}" class="member_contact-link phone w-inline-block">
                                <i class="fas fa-phone-alt"></i>
                            </a>
                            @if($agent->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->whatsapp) }}" 
                               target="_blank"
                               class="member_contact-link whatsapp w-inline-block">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            @endif
                            @if($agent->email)
                            <a href="mailto:{{ $agent->email }}" 
                               class="member_contact-link email w-inline-block">
                                <i class="far fa-envelope-open"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="section_bottom-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>{!! \App\Helpers\SiteConfigHelper::get('about_page_bottom_content_description', 'The mission of Luxury Residences is to disrupt the current status quo. Our plan is to masterfully blend the traditional business values of trust, integrity and long term relationships with a cutting edge attitude to brand strategies and marketing assets, whilst embracing a data driven tech-enabled platform leveraged by an unrivaled Private Client Advisor dedicated to you.') !!}</p>
                <div class="bottom-content_caption">{!! \App\Helpers\SiteConfigHelper::get('about_page_bottom_content_caption', 'Welcome to <span class="decorate">Luxury Residences</span> the home of sophisticated and<br><span class="decorate"> luxurious living</span>') !!} <br> <br> </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')

@endsection
