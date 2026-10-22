<?php

namespace App\Helpers;

use App\Models\SiteConfig;

class ConfigHelper
{
    /**
     * Get a configuration value with caching
     */
    public static function get($label, $default = null)
    {
        return SiteConfig::getValue($label, $default);
    }

    /**
     * Set a configuration value
     */
    public static function set($label, $content, $type = 'text', $description = null)
    {
        return SiteConfig::setValue($label, $content, $type, $description);
    }

    /**
     * Get all active configurations
     */
    public static function all()
    {
        return SiteConfig::getAllActive();
    }

    /**
     * Clear configuration cache
     */
    public static function clearCache()
    {
        return SiteConfig::clearCache();
    }

    /**
     * Get site name
     */
    public static function siteName()
    {
        return static::get('site_name', config('app.name'));
    }

    /**
     * Get site description
     */
    public static function siteDescription()
    {
        return static::get('site_description', 'A powerful property management platform');
    }

    /**
     * Get contact email
     */
    public static function contactEmail()
    {
        return static::get('contact_email', 'contact@propnkey.com');
    }

    /**
     * Get contact phone
     */
    public static function contactPhone()
    {
        return static::get('contact_phone', '+1 (555) 123-4567');
    }

    /**
     * Get contact address
     */
    public static function contactAddress()
    {
        return static::get('contact_address', '123 Property Street, City, State 12345');
    }

    /**
     * Check if maintenance mode is enabled
     */
    public static function isMaintenanceMode()
    {
        return static::get('maintenance_mode', false);
    }

    /**
     * Check if registration is enabled
     */
    public static function isRegistrationEnabled()
    {
        return static::get('registration_enabled', true);
    }

    /**
     * Get maximum file upload size
     */
    public static function maxFileUploadSize()
    {
        return static::get('max_file_upload_size', 10485760); // 10MB
    }

    /**
     * Get allowed file types
     */
    public static function allowedFileTypes()
    {
        return static::get('allowed_file_types', ['jpg', 'jpeg', 'png', 'gif', 'pdf']);
    }

    /**
     * Get currency
     */
    public static function currency()
    {
        return static::get('currency', 'USD');
    }

    /**
     * Get timezone
     */
    public static function timezone()
    {
        return static::get('timezone', 'America/New_York');
    }

    /**
     * Get social media URLs
     */
    public static function socialMedia()
    {
        return [
            'facebook' => static::get('facebook_url'),
            'twitter' => static::get('twitter_url'),
            'linkedin' => static::get('linkedin_url'),
            'instagram' => static::get('instagram_url'),
        ];
    }

    /**
     * Get theme settings
     */
    public static function themeSettings()
    {
        return static::get('theme_settings', [
            'primary_color' => '#0d6efd',
            'secondary_color' => '#6c757d',
            'font_family' => 'Inter'
        ]);
    }

    /**
     * Get notification settings
     */
    public static function notificationSettings()
    {
        return static::get('notification_settings', [
            'email' => true,
            'sms' => false,
            'push' => true,
            'frequency' => 'daily'
        ]);
    }

    /**
     * Get SMTP settings
     */
    public static function smtpSettings()
    {
        return [
            'host' => static::get('smtp_host', 'smtp.gmail.com'),
            'port' => static::get('smtp_port', 587),
            'username' => static::get('smtp_username', 'noreply@propnkey.com'),
            'encryption' => static::get('smtp_encryption', 'tls'),
        ];
    }

    /**
     * Check if a feature is enabled
     */
    public static function isFeatureEnabled($feature)
    {
        return static::get("enable_{$feature}", false);
    }

    /**
     * Get configurations by type
     */
    public static function getByType($type)
    {
        return SiteConfig::getByType($type);
    }

    /**
     * Check if configuration exists
     */
    public static function exists($label)
    {
        return SiteConfig::exists($label);
    }

    /**
     * Format property price for display
     * 
     * @param float|null $price
     * @param string|null $unit
     * @return string
     */
    public static function formatPrice($price)
    {
        // Ensure price is a numeric value to prevent errors
        $price = (float) $price;

        if ($price <= 0) {
            return 'Price on Request';
        }

        if ($price < 100000) {
            // Less than 1 lakh, show in thousands
            $priceInThousands = $price / 1000;
            $formattedPrice = number_format($priceInThousands, 0);
            return "₹ {$formattedPrice}K";
        } elseif ($price < 10000000) {
            // Less than 1 crore, show in lakhs (truncate to 2 decimals, no rounding)
            $priceInLakhs = floor($price / 1000) / 100;
            $formattedPrice = number_format($priceInLakhs, 2, '.', '');
            return "₹ {$formattedPrice} Lakhs";
        } else {
            // 1 crore or more, show in crores (truncate to 2 decimals, no rounding)
            $priceInCrores = floor($price / 100000) / 100;
            $formattedPrice = number_format($priceInCrores, 2, '.', '');
            return "₹ {$formattedPrice} Cr";
        }
    }

    /**
     * Normalize TinyMCE/CKEditor price-list HTML to the front theme table markup.
     * First data row keeps its price; extra rows show a Get Quote button.
     */
    public static function themePriceListHtml(?string $html, ?string $propertyName = null): string
    {
        if (blank($html) || blank(trim(strip_tags($html)))) {
            return '';
        }

        // Unwrap editor figure wrappers
        $html = preg_replace('/<\/?figure\b[^>]*>/i', '', $html) ?? $html;

        // Strip TinyMCE inline layout attrs that break the theme table
        $html = preg_replace('/\s(?:style|width|align|height)="[^"]*"/i', '', $html) ?? $html;

        // If table has no <thead>, promote first header-like row
        if (stripos($html, '<thead') === false && preg_match('/<table\b[^>]*>/i', $html)) {
            $html = preg_replace_callback(
                '/(<table\b[^>]*>\s*)(?:<tbody\b[^>]*>\s*)?<tr\b[^>]*>(.*?)<\/tr>/is',
                function (array $matches) {
                    $rowInner = $matches[2];
                    $rowInner = preg_replace('/<td\b/i', '<th', $rowInner) ?? $rowInner;
                    $rowInner = preg_replace('/<\/td>/i', '</th>', $rowInner) ?? $rowInner;

                    return $matches[1] . '<thead class="thead-dark"><tr>' . $rowInner . '</tr></thead><tbody>';
                },
                $html,
                1
            ) ?? $html;

            // Ensure tbody is closed if we opened it
            if (stripos($html, '<tbody>') !== false && stripos($html, '</tbody>') === false) {
                $html = preg_replace('/<\/table>/i', '</tbody></table>', $html, 1) ?? $html;
            }
        }

        // Apply theme table classes (match theme/detail.php)
        $html = preg_replace_callback('/<table\b([^>]*)>/i', function (array $matches) {
            $attrs = $matches[1] ?? '';
            if (preg_match('/\bclass\s*=\s*([\'"])(.*?)\1/i', $attrs, $classMatch)) {
                $classes = trim($classMatch[2] . ' table table-bordered text-center theme-price-table');
                $attrs = preg_replace('/\bclass\s*=\s*[\'"].*?[\'"]/i', ' class="' . e($classes) . '"', $attrs, 1);
            } else {
                $attrs .= ' class="table table-bordered text-center theme-price-table"';
            }

            return '<table' . $attrs . '>';
        }, $html) ?? $html;

        $html = preg_replace('/<thead\b[^>]*>/i', '<thead class="thead-dark">', $html) ?? $html;

        // Drop empty editor paragraphs
        $html = preg_replace('/<p>(?:\s|&nbsp;|<br\s*\/?>)*<\/p>/i', '', $html) ?? $html;

        return self::maskExtraPriceListRows(trim($html), $propertyName);
    }

    /**
     * Keep price on the first body row; replace later price cells with Get Quote CTA.
     */
    public static function maskExtraPriceListRows(string $html, ?string $propertyName = null): string
    {
        if ($html === '' || stripos($html, '<table') === false) {
            return $html;
        }

        $quoteHtml = '<a href="javascript:void(0);" class="price-list-get-quote"'
            . ' onclick="openEnquiryPopup({name: \'' . addslashes(html_entity_decode($propertyName ?? '', ENT_QUOTES, 'UTF-8')) . '\'}); return false;">'
            . 'Get Quote</a>';

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $wrapped = '<div id="price-list-root">' . $html . '</div>';
        $dom->loadHTML('<?xml encoding="UTF-8">' . $wrapped, LIBXML_HTML_NODEFDTD);
        $xpath = new \DOMXPath($dom);

        foreach ($xpath->query('//*[@id="price-list-root"]//table') as $table) {
            $rows = $xpath->query('.//tbody/tr', $table);
            if ($rows->length === 0) {
                // Fallback: all direct tr under table, skip header-like first row with th
                $rows = $xpath->query('./tr', $table);
            }

            $dataIndex = 0;
            foreach ($rows as $row) {
                /** @var \DOMElement $row */
                $ths = $xpath->query('./th', $row);
                if ($ths->length > 0 && $xpath->query('./td', $row)->length === 0) {
                    continue; // header row inside tbody
                }

                if ($dataIndex === 0) {
                    $dataIndex++;
                    continue;
                }

                $tds = $xpath->query('./td', $row);
                if ($tds->length === 0) {
                    $dataIndex++;
                    continue;
                }

                $priceCell = $tds->item($tds->length - 1);
                if (!$priceCell) {
                    $dataIndex++;
                    continue;
                }

                while ($priceCell->firstChild) {
                    $priceCell->removeChild($priceCell->firstChild);
                }

                $fragment = $dom->createDocumentFragment();
                $tmp = new \DOMDocument('1.0', 'UTF-8');
                $tmp->loadHTML('<?xml encoding="UTF-8"><div id="q">' . $quoteHtml . '</div>', LIBXML_HTML_NODEFDTD);
                foreach ($tmp->getElementById('q')->childNodes as $child) {
                    $fragment->appendChild($dom->importNode($child, true));
                }
                $priceCell->appendChild($fragment);

                $dataIndex++;
            }
        }

        $root = $dom->getElementById('price-list-root');
        if (!$root) {
            libxml_clear_errors();
            return $html;
        }

        $out = '';
        foreach ($root->childNodes as $child) {
            $out .= $dom->saveHTML($child);
        }
        libxml_clear_errors();

        return trim($out);
    }
}
