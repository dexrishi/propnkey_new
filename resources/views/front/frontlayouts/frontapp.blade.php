<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $pageMeta = isset($pageMeta) ? $pageMeta : null;
        $currentUrl = url()->current();
        $pageTitle = data_get($pageMeta, 'meta_title') ?: \App\Helpers\SiteConfigHelper::homepageTitle();
        $pageDescription = data_get($pageMeta, 'meta_desc') ?: \App\Helpers\SiteConfigHelper::homepageDescription();
        $pageKeywords = data_get($pageMeta, 'meta_keywords') ?: \App\Helpers\SiteConfigHelper::homepageKeywords();
        $ogTitle = data_get($pageMeta, 'og_title') ?: \App\Helpers\SiteConfigHelper::homepageOgTitle($pageTitle);
        $ogDescription = data_get($pageMeta, 'og_description') ?: \App\Helpers\SiteConfigHelper::homepageOgDescription($pageDescription);
        $ogImage = data_get($pageMeta, 'og_image') ?: \App\Helpers\SiteConfigHelper::homepageOgImage();
        $twitterTitle = data_get($pageMeta, 'twitter_title') ?: \App\Helpers\SiteConfigHelper::homepageTwitterTitle($pageTitle);
        $twitterDescription = data_get($pageMeta, 'twitter_description') ?: \App\Helpers\SiteConfigHelper::homepageTwitterDescription($pageDescription);
        $twitterImage = data_get($pageMeta, 'twitter_image') ?: \App\Helpers\SiteConfigHelper::homepageTwitterImage();
        $robots = data_get($pageMeta, 'robots') ?: \App\Helpers\SiteConfigHelper::defaultRobots();
        $canonicalUrl = data_get($pageMeta, 'canonical_url');

        if (!$canonicalUrl && request()->path() === '/') {
            $canonicalUrl = \App\Helpers\SiteConfigHelper::homepageCanonicalUrl($currentUrl);
        }

        $canonicalUrl = $canonicalUrl ?: $currentUrl;
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="{{ $robots }}">
    <meta name="author" content="{{ \App\Helpers\SiteConfigHelper::companyName() }}">
    <meta name="language" content="en">
    <meta name="revisit-after" content="7 days">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:image" content="{{ asset($ogImage) }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ \App\Helpers\SiteConfigHelper::siteName() }}">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $twitterTitle }}">
    <meta name="twitter:description" content="{{ $twitterDescription }}">
    <meta name="twitter:image" content="{{ asset($twitterImage) }}">

    <link rel="icon" type="image/x-icon" href="{{ asset(\App\Helpers\SiteConfigHelper::siteFavicon()) }}">
    @if($headTags = \App\Helpers\SiteConfigHelper::get('head_tags'))
        {!! \App\Helpers\SiteConfigHelper::sanitizeHeadTags($headTags) !!}
    @endif
    @include('front.frontlayouts.front_include.stylesheet')
    @yield('page-css')
    @if($gtmHead = \App\Helpers\SiteConfigHelper::get('gtm_tag_head'))
        {!! $gtmHead !!}
    @endif
</head>

<body>
    @if($gtmBody = \App\Helpers\SiteConfigHelper::get('gtm_tag_body'))
        {!! $gtmBody !!}
    @endif
    @include('front.frontlayouts.front_include.header')

    @yield('content')

    @include('front.frontlayouts.front_include.footer')
    
    @include('front.frontlayouts.front_include.sidebar-enquiry')
    
    @include('front.frontlayouts.front_include.js')
    @yield('page-js')
    
</body>

</html>