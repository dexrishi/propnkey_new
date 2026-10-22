<?php

namespace App\Helpers;

use App\Models\SiteConfig;

class SiteConfigHelper
{
    /**
     * Get a site configuration value
     */
    public static function get($label, $default = null)
    {
        return SiteConfig::getValue($label, $default);
    }
    
    /**
     * Get site name
     */
    public static function siteName()
    {
        return self::get('site_name', 'Propnkey');
    }
    
    /**
     * Get site logo
     */
    public static function siteLogo()
    {
        $logo = self::get('site_logo', '/frontassets/images/logo.svg');
        
        // If logo is a storage path (doesn't start with / and contains configs/), prepend storage/
        if ($logo && !str_starts_with($logo, '/') && str_contains($logo, 'configs/')) {
            return 'storage/' . $logo;
        }
        
        // If it's already a full path (starts with /), return as is
        return $logo;
    }
    
    /**
     * Get company name
     */
    public static function companyName()
    {
        return self::get('company_name', 'Luxury Residences Real Estate LLC');
    }
    
    /**
     * Get contact email
     */
    public static function contactEmail()
    {
        return self::get('contact_email', 'contactus@luxuryresidences.com');
    }
    
    /**
     * Get office phone
     */
    public static function officePhone()
    {
        return self::get('contact_phone', '+971 4 283 6681');
    }
    
    /**
     * Get WhatsApp number
     */
    public static function whatsappNumber()
    {
        return self::get('whatsapp', '919999964462');
    }
    
    /**
     * Get office address
     */
    public static function officeAddress()
    {
        return self::get('office_address', 'Office 410, The Onyx Tower 2<br>The Greens, Dubai, UAE,<br>P.O. Box 451733');
    }
    
    /**
     * Get header tagline
     */
    public static function headerTagline()
    {
        return self::get('header_tagline', 'Elegant Luxury<br>properties in the heart <br><span class="of-dubai">of Dubai</span>');
    }
    
    /**
     * Get copyright text
     */
    public static function copyrightText()
    {
        return self::get('copyright_text', 'Copyright © All rights reserved. 2025');
    }
    
    /**
     * Get social media URLs
     */
    public static function socialUrls()
    {
        return [
            'facebook' => self::get('facebook_url', '#'),
            'instagram' => self::get('instagram_url', '#'),
            'linkedin' => self::get('linkedin_url', '#'),
            'youtube' => self::get('youtube_url', '#'),
            'tiktok' => self::get('tiktok_url', '#'),
            'twitter' => self::get('twitter_url', '#'),
        ];
    }

    // Homepage Meta Tags
    public static function homepageTitle($default = 'Propnkey - Luxury Real Estate')
    {
        return self::get('homepage_title', $default);
    }

    public static function homepageDescription($default = 'A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.')
    {
        return self::get('homepage_description', $default);
    }

    public static function homepageKeywords($default = 'luxury real estate, penthouse, mansion, villa, branded residences, property, real estate agency')
    {
        return self::get('homepage_keywords', $default);
    }

    public static function defaultRobots($default = 'index, follow')
    {
        return self::get('default_robots', $default);
    }

    public static function homepageCanonicalUrl($default = null)
    {
        return self::get('homepage_canonical_url', $default);
    }

    // Open Graph Meta Tags
    public static function homepageOgTitle($default = 'Propnkey - Luxury Real Estate')
    {
        return self::get('homepage_og_title', $default);
    }

    public static function homepageOgDescription($default = 'A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.')
    {
        return self::get('homepage_og_description', $default);
    }

    public static function homepageOgImage($default = '/frontassets/images/logo.svg')
    {
        return self::get('homepage_og_image', $default);
    }

    // Twitter Card Meta Tags
    public static function homepageTwitterTitle($default = 'Propnkey - Luxury Real Estate')
    {
        return self::get('homepage_twitter_title', $default);
    }

    public static function homepageTwitterDescription($default = 'A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.')
    {
        return self::get('homepage_twitter_description', $default);
    }

    public static function homepageTwitterImage($default = '/frontassets/images/logo.svg')
    {
        return self::get('homepage_twitter_image', $default);
    }

    // Favicon
    public static function siteFavicon($default = '/frontassets/img/favicon.png')
    {
        return self::get('site_favicon', $default);
    }

    /**
     * Remove SEO tags from custom head HTML that are already rendered by the layout.
     */
    public static function sanitizeHeadTags($html)
    {
        if (blank($html)) {
            return $html;
        }

        $patterns = [
            '/<title\b[^>]*>.*?<\/title>/is',
            '/<meta\b[^>]*charset=["\'][^"\']*["\'][^>]*>/is',
            '/<meta\b[^>]*name=["\'](?:description|keywords|robots|author|language|revisit-after|twitter:card|twitter:title|twitter:description|twitter:image)["\'][^>]*>/is',
            '/<meta\b[^>]*property=["\'](?:og:title|og:description|og:image|og:url|og:type|og:site_name)["\'][^>]*>/is',
            '/<link\b[^>]*rel=["\']canonical["\'][^>]*>/is',
        ];

        $sanitized = preg_replace($patterns, '', $html);

        return trim((string) $sanitized);
    }
    
    /**
     * Get Google reCAPTCHA site key
     */
    public static function recaptchaSiteKey($default = '6LfSnNkrAAAAAOikQGl3aBi8BK_g4wBEDtSx86O2')
    {
        $key = self::get('recaptcha_site_key');
        // If key is null, empty, or whitespace, return default
        if (empty($key) || trim($key) === '') {
            return $default;
        }
        return trim($key);
    }
    
    /**
     * Get Google reCAPTCHA secret key
     */
    public static function recaptchaSecretKey($default = '')
    {
        return self::get('recaptcha_secret_key', $default);
    }
}
