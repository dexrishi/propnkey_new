<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Location;
use App\Models\Partner;
use App\Models\Property;
use App\Models\PropertyCategory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $this->forceCanonicalRoot();

        $urls = array_merge(
            $this->staticUrls(),
            $this->categoryUrls(),
            $this->riseUrls(),
            $this->riseLocationUrls(),
            $this->locationUrls(),
            $this->categoryLocationUrls(),
            $this->categoryPropertyTypeUrls(),
            $this->categoryPropertyTypeLocationUrls(),
            $this->propertyTypeLocationUrls(),
            $this->partnerUrls(),
            $this->blogCategoryUrls(),
            $this->blogUrls(),
            $this->propertyUrls(),
        );

        $urls = $this->deduplicateUrls($urls);
        $urls = $this->sanitizeUrls($urls);

        return response()
            ->view('sitemap.xml', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    /**
     * Always build sitemap locs from APP_URL (no request host / index.php).
     */
    private function forceCanonicalRoot(): void
    {
        $root = rtrim((string) config('app.url'), '/');
        $root = preg_replace('#/index\.php$#i', '', $root) ?: $root;

        if ($root !== '') {
            URL::forceRootUrl($root);
        }
    }

    private function staticUrls(): array
    {
        $now = now();

        return [
            ['loc' => route('home'), 'lastmod' => $now],
            ['loc' => route('about'), 'lastmod' => $now],
            ['loc' => route('services'), 'lastmod' => $now],
            ['loc' => route('contact'), 'lastmod' => $now],
            ['loc' => route('blog'), 'lastmod' => $now],
            ['loc' => route('properties.all'), 'lastmod' => $now],
        ];
    }

    private function categoryUrls(): array
    {
        return PropertyCategory::query()
            ->active()
            ->select(['slug', 'updated_at'])
            ->get()
            ->map(fn (PropertyCategory $category) => [
                'loc' => route('category.direct', ['category_slug' => $category->slug]),
                'lastmod' => $category->updated_at,
            ])
            ->all();
    }

    private function locationUrls(): array
    {
        return Location::query()
            ->active()
            ->select(['slug', 'updated_at'])
            ->get()
            ->map(fn (Location $location) => [
                'loc' => route('location.properties', ['location_slug' => $location->slug]),
                'lastmod' => $location->updated_at,
            ])
            ->all();
    }

    private function riseUrls(): array
    {
        return collect(Property::RISE_URL_SLUGS)
            ->map(function (string $riseSlug, string $riseValue) {
                $lastmod = Property::query()
                    ->active()
                    ->byRise($riseValue)
                    ->max('updated_at');

                if (!$lastmod) {
                    return null;
                }

                return [
                    'loc' => route('rise.properties', ['rise_slug' => $riseSlug]),
                    'lastmod' => $lastmod,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    private function riseLocationUrls(): array
    {
        return DB::table('properties')
            ->where('properties.is_active', true)
            ->whereNull('properties.deleted_at')
            ->whereNotNull('properties.location_id')
            ->whereIn('properties.rise', [Property::RISE_HIGH, Property::RISE_LOW])
            ->join('locations', function ($join) {
                $join->on('properties.location_id', '=', 'locations.id')
                    ->where('locations.is_active', true);
            })
            ->select(
                'properties.rise',
                'locations.slug as location_slug',
                DB::raw('MAX(properties.updated_at) as lastmod')
            )
            ->groupBy('properties.rise', 'locations.slug')
            ->get()
            ->map(function ($row) {
                $riseSlug = Property::riseUrlSlug($row->rise);

                if (!$riseSlug) {
                    return null;
                }

                return [
                    'loc' => route('rise.location.properties', [
                        'rise_slug' => $riseSlug,
                        'location_slug' => $row->location_slug,
                    ]),
                    'lastmod' => $row->lastmod,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    private function categoryLocationUrls(): array
    {
        return $this->activePropertyCombosQuery()
            ->select(
                'property_categories.slug as category_slug',
                'locations.slug as location_slug',
                DB::raw('MAX(properties.updated_at) as lastmod')
            )
            ->groupBy('property_categories.slug', 'locations.slug')
            ->get()
            ->map(fn ($row) => [
                'loc' => route('category.location.properties', [
                    'category_slug' => $row->category_slug,
                    'location_slug' => $row->location_slug,
                ]),
                'lastmod' => $row->lastmod,
            ])
            ->all();
    }

    private function categoryPropertyTypeUrls(): array
    {
        return $this->activePropertyCombosQuery()
            ->join('property_types', function ($join) {
                $join->on('properties.property_type_id', '=', 'property_types.id')
                    ->where('property_types.is_active', true);
            })
            ->select(
                'property_categories.slug as category_slug',
                'property_types.slug as property_type_slug',
                DB::raw('MAX(properties.updated_at) as lastmod')
            )
            ->groupBy('property_categories.slug', 'property_types.slug')
            ->get()
            ->map(fn ($row) => [
                'loc' => route('category.propertytype.properties', [
                    'category_slug' => $row->category_slug,
                    'property_type_slug' => $row->property_type_slug,
                ]),
                'lastmod' => $row->lastmod,
            ])
            ->all();
    }

    private function categoryPropertyTypeLocationUrls(): array
    {
        return $this->activePropertyCombosQuery()
            ->join('property_types', function ($join) {
                $join->on('properties.property_type_id', '=', 'property_types.id')
                    ->where('property_types.is_active', true);
            })
            ->select(
                'property_categories.slug as category_slug',
                'property_types.slug as property_type_slug',
                'locations.slug as location_slug',
                DB::raw('MAX(properties.updated_at) as lastmod')
            )
            ->groupBy('property_categories.slug', 'property_types.slug', 'locations.slug')
            ->get()
            ->map(fn ($row) => [
                'loc' => route('category.propertytype.location.properties', [
                    'category_slug' => $row->category_slug,
                    'property_type_slug' => $row->property_type_slug,
                    'location_slug' => $row->location_slug,
                ]),
                'lastmod' => $row->lastmod,
            ])
            ->all();
    }

    /**
     * Property-type + location listings without a category prefix in the URL.
     */
    private function propertyTypeLocationUrls(): array
    {
        return DB::table('properties')
            ->where('properties.is_active', true)
            ->whereNull('properties.deleted_at')
            ->whereNotNull('properties.property_type_id')
            ->whereNotNull('properties.location_id')
            ->join('property_types', function ($join) {
                $join->on('properties.property_type_id', '=', 'property_types.id')
                    ->where('property_types.is_active', true)
                    ->whereNull('property_types.property_category_id');
            })
            ->join('locations', function ($join) {
                $join->on('properties.location_id', '=', 'locations.id')
                    ->where('locations.is_active', true);
            })
            ->select(
                'property_types.slug as property_type_slug',
                'locations.slug as location_slug',
                DB::raw('MAX(properties.updated_at) as lastmod')
            )
            ->groupBy('property_types.slug', 'locations.slug')
            ->get()
            ->map(fn ($row) => [
                'loc' => route('property.type.location', [
                    'property_type_slug' => $row->property_type_slug,
                    'location_slug' => $row->location_slug,
                ]),
                'lastmod' => $row->lastmod,
            ])
            ->all();
    }

    private function partnerUrls(): array
    {
        return Partner::query()
            ->active()
            ->whereHas('properties', fn ($query) => $query->where('is_active', true))
            ->select(['slug', 'updated_at'])
            ->get()
            ->filter(fn (Partner $partner) => $this->isSafeSlug($partner->slug))
            ->map(fn (Partner $partner) => [
                'loc' => route('partner.show', ['slug' => $partner->slug]),
                'lastmod' => $partner->updated_at,
            ])
            ->values()
            ->all();
    }

    private function blogCategoryUrls(): array
    {
        return BlogCategory::query()
            ->active()
            ->select(['slug', 'updated_at'])
            ->get()
            ->filter(fn (BlogCategory $category) => $this->isSafeSlug($category->slug))
            ->map(fn (BlogCategory $category) => [
                'loc' => route('blog.category', ['category_slug' => $category->slug]),
                'lastmod' => $category->updated_at,
            ])
            ->values()
            ->all();
    }

    private function blogUrls(): array
    {
        return BlogPost::query()
            ->published()
            ->select(['slug', 'updated_at'])
            ->get()
            ->filter(fn (BlogPost $post) => $this->isSafeSlug($post->slug))
            ->map(fn (BlogPost $post) => [
                'loc' => route('blog.post', ['slug' => $post->slug]),
                'lastmod' => $post->updated_at,
            ])
            ->values()
            ->all();
    }

    private function isSafeSlug(?string $slug): bool
    {
        return is_string($slug)
            && $slug !== ''
            && (bool) preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug);
    }

    private function propertyUrls(): array
    {
        return Property::query()
            ->active()
            ->whereHas('propertyCategory', fn ($query) => $query->where('is_active', true))
            ->with(['propertyCategory:id,slug'])
            ->select(['slug', 'property_category_id', 'updated_at'])
            ->get()
            ->map(function (Property $property) {
                $loc = $this->propertyCanonicalUrl($property);

                if (!$loc) {
                    return null;
                }

                return [
                    'loc' => $loc,
                    'lastmod' => $property->updated_at,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    private function propertyCanonicalUrl(Property $property): ?string
    {
        if (!$property->propertyCategory || !$property->slug) {
            return null;
        }

        if (!$this->isSafeSlug($property->slug) || !$this->isSafeSlug($property->propertyCategory->slug)) {
            return null;
        }

        return route('property.show', [
            'category_slug' => $property->propertyCategory->slug,
            'slug' => $property->slug,
        ]);
    }

    private function activePropertyCombosQuery()
    {
        return DB::table('properties')
            ->where('properties.is_active', true)
            ->whereNull('properties.deleted_at')
            ->whereNotNull('properties.location_id')
            ->join('property_categories', function ($join) {
                $join->on('properties.property_category_id', '=', 'property_categories.id')
                    ->where('property_categories.is_active', true);
            })
            ->join('locations', function ($join) {
                $join->on('properties.location_id', '=', 'locations.id')
                    ->where('locations.is_active', true);
            });
    }

    private function deduplicateUrls(array $urls): array
    {
        $seen = [];
        $unique = [];

        foreach ($urls as $entry) {
            $loc = $this->normalizeLoc($entry['loc'] ?? '');
            if ($loc === '' || isset($seen[$loc])) {
                continue;
            }

            $seen[$loc] = true;
            $entry['loc'] = $loc;
            $unique[] = $entry;
        }

        return $unique;
    }

    private function sanitizeUrls(array $urls): array
    {
        return array_values(array_filter($urls, function (array $entry) {
            $loc = $entry['loc'] ?? '';

            if ($loc === '' || !preg_match('#^https?://#i', $loc)) {
                return false;
            }

            if (stripos($loc, 'index.php') !== false) {
                return false;
            }

            // Never publish the broken SEO patterns clients reported
            if (preg_match('#/builder/properties-in-#i', $loc)) {
                return false;
            }
            if (preg_match('#/property/[^/]+/properties-in-#i', $loc)) {
                return false;
            }
            if (preg_match('#-properties/properties-in-#i', $loc)) {
                return false;
            }

            return true;
        }));
    }

    private function normalizeLoc(string $loc): string
    {
        $loc = trim($loc);
        $loc = preg_replace('#/index\.php(?=/|$)#i', '', $loc) ?? $loc;

        return rtrim($loc, '/');
    }
}
