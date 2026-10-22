<?php

namespace App\Helpers;

use App\Models\Property;

class PropertySchema
{
    private const CITY_REGIONS = [
        'gurgaon' => 'Haryana',
        'gurugram' => 'Haryana',
        'manesar' => 'Haryana',
        'delhi' => 'Delhi',
        'new delhi' => 'Delhi',
        'noida' => 'Uttar Pradesh',
        'kasauli' => 'Himachal Pradesh',
        'chail' => 'Himachal Pradesh',
        'shimla' => 'Himachal Pradesh',
        'goa' => 'Goa',
        'bangalore' => 'Karnataka',
        'bengaluru' => 'Karnataka',
    ];

    public static function toScript(Property $property): string
    {
        $json = json_encode(
            self::graph($property),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_INVALID_UTF8_SUBSTITUTE
        );

        if ($json === false || $json === '' || $json === '[]') {
            return '';
        }

        return '<script type="application/ld+json">' . "\n" . $json . "\n" . '</script>';
    }

    public static function graph(Property $property): array
    {
        $property->loadMissing([
            'location',
            'area',
            'propertyType',
            'propertyCategory',
            'propertyStatus',
            'bedroomOptions',
            'partner',
            'amenities',
            'images',
        ]);

        $pageUrl = self::pageUrl($property);
        $listingId = $pageUrl . '#listing';
        $projectId = $pageUrl . '#project';
        $offerId = $pageUrl . '#offer';
        $breadcrumbId = $pageUrl . '#breadcrumb';
        $organization = self::organizationNode();
        $organizationId = $organization['@id'];

        $images = self::imageUrls($property);
        $isRental = self::isRental($property);
        $price = self::priceAmount($property, $isRental);
        $description = self::description($property);
        $placeDescription = self::placeDescription($property, $description);
        $address = self::address($property);
        $amenities = self::amenities($property);
        $configurations = self::configurations($property);
        $developer = self::developerName($property);
        $mapUrl = self::mapUrl($property);
        $phone = self::phone();

        $place = [
            '@type' => self::placeType($property),
            '@id' => $projectId,
            'name' => self::plain($property->name),
            'url' => $pageUrl,
            'description' => $placeDescription,
            'image' => $images,
            'address' => $address,
            'hasMap' => $mapUrl,
            'geo' => self::geoCoordinates($mapUrl),
            'telephone' => $phone,
            'amenityFeature' => $amenities,
            'additionalProperty' => self::additionalProperties($property, $configurations, $developer),
            'floorSize' => self::floorSize($property),
        ];

        if ($price !== null) {
            $place['offers'] = ['@id' => $offerId];
        }

        $listing = [
            '@type' => 'RealEstateListing',
            '@id' => $listingId,
            'url' => $pageUrl,
            'name' => self::plain($property->name),
            'description' => $description,
            'inLanguage' => 'en-IN',
            'datePosted' => optional($property->created_at)->toDateString(),
            'dateModified' => optional($property->updated_at)->toDateString(),
            'mainEntity' => ['@id' => $projectId],
            'about' => ['@id' => $projectId],
            'breadcrumb' => ['@id' => $breadcrumbId],
            'publisher' => ['@id' => $organizationId],
        ];

        if ($images !== []) {
            $listing['primaryImageOfPage'] = [
                '@type' => 'ImageObject',
                'url' => $images[0],
            ];
        }

        if ($price !== null) {
            $listing['offers'] = ['@id' => $offerId];
        }

        $graph = [
            self::prune($listing),
            self::prune($place),
        ];

        if ($price !== null) {
            $graph[] = self::prune(self::offer(
                $property,
                $offerId,
                $pageUrl,
                $projectId,
                $organizationId,
                $price,
                $isRental
            ));
        }

        $graph[] = self::prune(self::breadcrumb($property, $breadcrumbId, $pageUrl));

        if (!empty($organization['inline'])) {
            unset($organization['inline']);
            $graph[] = self::prune($organization);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => array_values(array_filter($graph)),
        ];
    }

    private static function pageUrl(Property $property): string
    {
        $categorySlug = $property->propertyCategory->slug ?? null;

        if ($categorySlug && $property->slug) {
            return route('property.show', [
                'category_slug' => $categorySlug,
                'slug' => $property->slug,
            ]);
        }

        return url()->current();
    }

    private static function isRental(Property $property): bool
    {
        $categorySlug = strtolower((string) ($property->propertyCategory->slug ?? ''));

        return (bool) $property->is_rental || $categorySlug === 'rental';
    }

    private static function placeType(Property $property): string
    {
        $typeSlug = strtolower((string) ($property->propertyType->slug ?? ''));
        $categorySlug = strtolower((string) ($property->propertyCategory->slug ?? ''));

        if (in_array($typeSlug, ['villa', 'independent-houses', 'builder-floors', 'cottage'], true)) {
            return ($categorySlug === 'holiday-homes' || $typeSlug === 'cottage')
                ? 'VacationRental'
                : 'House';
        }

        if ($typeSlug === 'retail-shops' || ($categorySlug === 'commercial' && !in_array($typeSlug, ['apartments', 'penthouse', 'studio-apartments'], true))) {
            return 'Place';
        }

        if ($categorySlug === 'holiday-homes' || $typeSlug === 'holiday-homes') {
            return 'VacationRental';
        }

        if (self::isRental($property)) {
            return 'Apartment';
        }

        return 'ApartmentComplex';
    }

    private static function imageUrls(Property $property): array
    {
        $images = $property->images->filter(function ($image) {
            return $image->is_active !== false && filled($image->image_path);
        });

        $project = $images->where('type', 'project');
        $chosen = $project->isNotEmpty()
            ? $project
            : $images->reject(fn ($image) => in_array($image->type, ['logo', 'floor_plan'], true));

        if ($chosen->isEmpty()) {
            $chosen = $images;
        }

        return $chosen
            ->sortBy([
                ['is_banner', 'desc'],
                ['sort_order', 'asc'],
                ['id', 'asc'],
            ])
            ->map(fn ($image) => $image->image_url)
            ->filter(fn ($url) => is_string($url) && preg_match('#^https?://#i', $url))
            ->unique()
            ->take(8)
            ->values()
            ->all();
    }

    private static function description(Property $property): string
    {
        $text = self::plain($property->meta_description, 500);
        if (mb_strlen($text) >= 40) {
            return $text;
        }

        $fromBody = self::plain($property->property_description, 500);
        if (mb_strlen($fromBody) >= 40) {
            return $fromBody;
        }

        return self::fallbackDescription($property);
    }

    private static function placeDescription(Property $property, string $listingDescription): string
    {
        $fromBody = self::plain($property->property_description, 800);
        if (mb_strlen($fromBody) >= 40) {
            return $fromBody;
        }

        return $listingDescription;
    }

    private static function fallbackDescription(Property $property): string
    {
        $name = self::plain($property->name);
        $type = self::plain(optional($property->propertyType)->name);
        $place = self::placeLabel($property);

        $sentence = $name;
        if ($type !== '') {
            $sentence .= ' is a ' . $type . ' project';
        }
        if ($place !== '') {
            $sentence .= ' in ' . $place;
        }

        return rtrim($sentence, '.') . '.';
    }

    private static function placeLabel(Property $property): string
    {
        $parts = array_filter([
            self::locality($property),
            self::plain(optional($property->location)->name),
        ]);

        return implode(', ', $parts);
    }

    private static function locality(Property $property): string
    {
        $locality = self::plain($property->locality);
        if ($locality !== '') {
            return $locality;
        }

        return self::plain(optional($property->area)->name);
    }

    private static function address(Property $property): ?array
    {
        $city = self::plain(optional($property->location)->name);
        $locality = self::locality($property);
        $street = self::plain($property->address, 240);
        $region = self::CITY_REGIONS[strtolower($city)] ?? null;
        $postalCode = null;

        if ($street !== '' && preg_match('/\b([1-9][0-9]{5})\b/', $street, $match)) {
            $postalCode = $match[1];
        }

        if ($city !== '' && $locality !== '') {
            $locality = trim((string) preg_replace('/,?\s*' . preg_quote($city, '/') . '$/iu', '', $locality));
        }

        if ($street !== '' && ($street === self::plain($property->name) || mb_strlen($street) < 8)) {
            $street = '';
        }

        if ($locality === '' && $city === '' && $street === '') {
            return null;
        }

        return self::prune([
            '@type' => 'PostalAddress',
            'streetAddress' => $street,
            'addressLocality' => $locality,
            'addressCity' => $city,
            'addressRegion' => $region,
            'postalCode' => $postalCode,
            'addressCountry' => 'IN',
        ]);
    }

    private static function mapUrl(Property $property): ?string
    {
        $code = html_entity_decode((string) $property->map_code, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if (preg_match('/src=["\']([^"\']+)["\']/i', $code, $match)) {
            $url = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if (preg_match('#^https?://#i', $url)) {
                return $url;
            }
        }

        if (preg_match('#^https?://#i', trim($code))) {
            return trim($code);
        }

        $query = self::placeLabel($property);
        $name = self::plain($property->name);
        if ($name !== '') {
            $query = trim($name . ($query !== '' ? ', ' . $query : ''));
        }

        if ($query === '') {
            return null;
        }

        return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($query);
    }

    private static function geoCoordinates(?string $mapUrl): ?array
    {
        if (!$mapUrl || !preg_match('/!2d(-?\d+(?:\.\d+)?)!3d(-?\d+(?:\.\d+)?)/', $mapUrl, $match)) {
            return null;
        }

        $longitude = (float) $match[1];
        $latitude = (float) $match[2];

        // Ignore coarse or placeholder pins such as 28.4 / 77.1.
        if (!preg_match('/\.\d{4,}/', $match[1]) || !preg_match('/\.\d{4,}/', $match[2])) {
            return null;
        }

        if ($latitude < -90 || $latitude > 90 || $longitude < -180 || $longitude > 180) {
            return null;
        }

        return [
            '@type' => 'GeoCoordinates',
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }

    private static function amenities(Property $property): array
    {
        $seen = [];
        $features = [];

        foreach ($property->amenities->sortBy([['sort_order', 'asc'], ['name', 'asc']]) as $amenity) {
            $name = self::plain($amenity->name);
            $key = strtolower($name);
            if ($name === '' || isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;
            $features[] = [
                '@type' => 'LocationFeatureSpecification',
                'name' => $name,
                'value' => true,
            ];
        }

        return $features;
    }

    private static function configurations(Property $property): string
    {
        $names = $property->bedroomOptions
            ->sortBy(function ($option) {
                if (preg_match('/(\d+(?:\.\d+)?)/', (string) $option->name, $match)) {
                    return (float) $match[1];
                }

                return 1000 + (int) $option->sort_order;
            })
            ->map(fn ($option) => self::plain($option->name))
            ->filter()
            ->unique()
            ->values()
            ->all();

        $count = count($names);
        if ($count === 0) {
            return '';
        }
        if ($count === 1) {
            return $names[0];
        }
        if ($count === 2) {
            return $names[0] . ' and ' . $names[1];
        }

        $last = array_pop($names);

        return implode(', ', $names) . ' and ' . $last;
    }

    private static function additionalProperties(Property $property, string $configurations, string $developer): array
    {
        $items = [];

        $typeName = self::plain(optional($property->propertyType)->name);
        if ($typeName !== '') {
            $items[] = self::propertyValue('Property Type', $typeName);
        }

        if ($configurations !== '') {
            $items[] = self::propertyValue('Configurations', $configurations);
        }

        $area = self::areaNumber($property);
        if ($area !== null) {
            $formatted = floor($area) == $area
                ? number_format($area)
                : number_format($area, 2);
            $items[] = self::propertyValue('Advertised Area', $formatted . ' sq. ft.');
        }

        if ($property->is_sold) {
            $items[] = self::propertyValue('Project Status', 'Sold');
        } else {
            $status = self::plain(optional($property->propertyStatus)->name);
            if ($status !== '') {
                $items[] = self::propertyValue('Project Status', $status);
            }
        }

        if ($developer !== '') {
            $items[] = self::propertyValue('Developer', $developer);
        }

        $rera = self::plain($property->rera_reg_no);
        if (mb_strlen($rera) >= 5) {
            $items[] = self::propertyValue('RERA Registration', $rera);
        }

        $possession = $property->possession;
        if ($possession && (int) $possession->format('Y') >= 1990) {
            $items[] = self::propertyValue('Possession', $possession->format('F Y'));
        }

        $rise = (string) $property->rise;
        if (isset(Property::RISE_URL_SLUGS[$rise])) {
            $items[] = self::propertyValue('Rise', Property::riseLabel($rise));
        }

        return $items;
    }

    private static function propertyValue(string $name, string $value): array
    {
        return [
            '@type' => 'PropertyValue',
            'name' => $name,
            'value' => $value,
        ];
    }

    private static function floorSize(Property $property): ?array
    {
        $area = self::areaNumber($property);
        if ($area === null) {
            return null;
        }

        return [
            '@type' => 'QuantitativeValue',
            'value' => floor($area) == $area ? (int) $area : round($area, 2),
            'unitCode' => 'FTK',
            'unitText' => 'sq. ft.',
        ];
    }

    private static function areaNumber(Property $property): ?float
    {
        if ($property->area_sq_ft === null || $property->area_sq_ft === '') {
            return null;
        }

        $area = (float) $property->area_sq_ft;

        return $area > 0 ? $area : null;
    }

    private static function developerName(Property $property): string
    {
        $partner = $property->partner;
        if (!$partner) {
            return '';
        }

        return self::plain($partner->display_name ?: $partner->name);
    }

    private static function priceAmount(Property $property, bool $isRental): ?int
    {
        $raw = $isRental
            ? ($property->monthly_rent ?: $property->price)
            : $property->price;

        if ($raw === null || $raw === '') {
            return null;
        }

        $amount = (float) $raw;
        if ($amount <= 0) {
            return null;
        }

        return (int) round($amount);
    }

    private static function offer(
        Property $property,
        string $offerId,
        string $pageUrl,
        string $projectId,
        string $organizationId,
        int $price,
        bool $isRental
    ): array {
        $categoryName = self::plain(optional($property->propertyCategory)->name);
        $offerName = self::plain($property->name);
        if ($isRental) {
            $offerName .= ' Rental Listing';
        } elseif ($categoryName !== '') {
            $offerName .= ' ' . $categoryName . ' Listing';
        } else {
            $offerName .= ' Listing';
        }

        $offer = [
            '@type' => 'Offer',
            '@id' => $offerId,
            'url' => $pageUrl,
            'name' => $offerName,
            'price' => $price,
            'priceCurrency' => 'INR',
            'availability' => self::availability($property),
            'businessFunction' => $isRental ? 'https://schema.org/LeaseOut' : 'https://schema.org/Sell',
            'itemOffered' => ['@id' => $projectId],
            'seller' => ['@id' => $organizationId],
        ];

        $categorySlug = strtolower((string) ($property->propertyCategory->slug ?? ''));
        if ($categorySlug === 'resale') {
            $offer['itemCondition'] = 'https://schema.org/UsedCondition';
        } elseif (!$isRental) {
            $offer['itemCondition'] = 'https://schema.org/NewCondition';
        }

        if ($isRental) {
            $offer['priceSpecification'] = [
                '@type' => 'UnitPriceSpecification',
                'price' => $price,
                'priceCurrency' => 'INR',
                'unitCode' => 'MON',
                'unitText' => 'month',
            ];
        }

        return $offer;
    }

    private static function availability(Property $property): string
    {
        if ($property->is_sold) {
            return 'https://schema.org/SoldOut';
        }

        $status = strtolower((string) ($property->propertyStatus->slug ?? ''));
        if (in_array($status, ['under_construction', 'upcoming-projects', 'newly_launched'], true)) {
            return 'https://schema.org/PreOrder';
        }

        return 'https://schema.org/InStock';
    }

    private static function breadcrumb(Property $property, string $breadcrumbId, string $pageUrl): array
    {
        $items = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => url('/'),
            ],
        ];

        $category = $property->propertyCategory;
        if ($category && $category->slug) {
            $label = self::plain($category->name);
            if ($label !== '' && !preg_match('/propert|homes/i', $label)) {
                $label .= ' Properties';
            }

            $items[] = [
                '@type' => 'ListItem',
                'position' => count($items) + 1,
                'name' => $label,
                'item' => route('category.direct', ['category_slug' => $category->slug]),
            ];
        }

        $items[] = [
            '@type' => 'ListItem',
            'position' => count($items) + 1,
            'name' => self::plain($property->name),
            'item' => $pageUrl,
        ];

        return [
            '@type' => 'BreadcrumbList',
            '@id' => $breadcrumbId,
            'itemListElement' => $items,
        ];
    }

    private static function organizationNode(): array
    {
        $head = (string) SiteConfigHelper::get('head_tags', '');
        if (preg_match('/"@id"\s*:\s*"(https?:\/\/[^"\s]+#organization)"/i', $head, $match)) {
            return ['@id' => $match[1], 'inline' => false];
        }

        $organizationId = rtrim(url('/'), '/') . '/#organization';
        $phone = self::phone();
        $organization = self::organization($organizationId, $phone);
        $organization['inline'] = true;

        return $organization;
    }

    private static function organization(string $organizationId, ?string $phone): array
    {
        $logo = self::logoUrl();
        $email = self::plain(SiteConfigHelper::contactEmail());
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || str_ends_with(strtolower($email), '@luxuryresidences.com')) {
            $email = '';
        }

        $sameAs = array_values(array_filter(
            SiteConfigHelper::socialUrls(),
            fn ($url) => is_string($url) && preg_match('#^https?://#i', $url)
        ));

        $organization = [
            '@type' => 'Organization',
            '@id' => $organizationId,
            'name' => self::plain(SiteConfigHelper::companyName() ?: SiteConfigHelper::siteName()),
            'url' => url('/'),
            'telephone' => $phone,
            'email' => $email,
            'sameAs' => $sameAs,
        ];

        if ($logo) {
            $organization['logo'] = [
                '@type' => 'ImageObject',
                'url' => $logo,
            ];
        }

        return $organization;
    }

    private static function logoUrl(): ?string
    {
        $logo = SiteConfigHelper::siteLogo();
        if (!is_string($logo) || trim($logo) === '' || $logo === '#') {
            return null;
        }

        if (preg_match('#^https?://#i', $logo)) {
            return $logo;
        }

        return asset($logo);
    }

    private static function phone(): ?string
    {
        $raw = (string) SiteConfigHelper::officePhone();
        $digits = preg_replace('/\D+/', '', $raw) ?? '';

        if ($digits === '' || in_array($digits, ['15551234567', '97142836681'], true)) {
            return null;
        }

        if (strlen($digits) === 10) {
            return '+91' . $digits;
        }

        if (strlen($digits) === 12 && str_starts_with($digits, '91')) {
            return '+' . $digits;
        }

        if (strlen($digits) >= 8 && str_starts_with(trim($raw), '+')) {
            return '+' . $digits;
        }

        return null;
    }

    private static function plain(?string $value, int $limit = 0): string
    {
        $text = html_entity_decode(strip_tags((string) $value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = str_replace("\xc2\xa0", ' ', $text);
        $text = preg_replace('/\s+/u', ' ', $text) ?? $text;
        $text = trim($text);

        if ($limit > 0 && mb_strlen($text) > $limit) {
            $cut = mb_substr($text, 0, $limit);
            $lastSpace = mb_strrpos($cut, ' ');
            if ($lastSpace !== false && $lastSpace > (int) ($limit * 0.6)) {
                $cut = mb_substr($cut, 0, $lastSpace);
            }
            $text = rtrim($cut, " \t,.;:-") . '…';
        }

        return $text;
    }

    private static function prune(array $data): array
    {
        $clean = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = self::prune($value);
                if ($value === []) {
                    continue;
                }
            }

            if ($value === null || $value === '') {
                continue;
            }

            $clean[$key] = $value;
        }

        if (array_is_list($data)) {
            return array_values($clean);
        }

        return $clean;
    }
}
