<?php

namespace App\Helpers;

use App\Models\Location;
use App\Models\Property;
use Illuminate\Support\Str;

class PropertySlugHelper
{
    /**
     * Build unique property slug: project-name-locality-city
     * without repeating locality/city segments already present in earlier parts.
     */
    public static function build(
        ?string $name,
        ?string $locality = null,
        Location|int|string|null $location = null,
        ?int $excludePropertyId = null
    ): string {
        $cityName = self::resolveCityName($location);

        $parts = [];
        if (!empty($name)) {
            $parts[] = Str::slug($name);
        }
        if (!empty($locality)) {
            $parts[] = Str::slug($locality);
        }
        if (!empty($cityName)) {
            $parts[] = Str::slug($cityName);
        }

        $baseSlug = self::joinWithoutDuplicates($parts);

        if ($baseSlug === '') {
            $baseSlug = 'property';
        }

        return self::makeUnique($baseSlug, $excludePropertyId);
    }

    /**
     * Join slug parts, skipping any part already present as a trailing suffix.
     *
     * @param  array<int, string|null>  $parts
     */
    public static function joinWithoutDuplicates(array $parts): string
    {
        $slug = '';

        foreach ($parts as $part) {
            $part = self::normalizePart((string) ($part ?? ''));
            if ($part === '') {
                continue;
            }

            $slug = self::appendPart($slug, $part);
        }

        return self::collapseRepeatedSequences($slug);
    }

    private static function resolveCityName(Location|int|string|null $location): ?string
    {
        if ($location instanceof Location) {
            return $location->name;
        }

        if (is_numeric($location)) {
            return Location::query()->find((int) $location)?->name;
        }

        if (is_string($location) && $location !== '') {
            return $location;
        }

        return null;
    }

    private static function normalizePart(string $part): string
    {
        $part = Str::slug($part);
        $part = trim($part, '-');

        return preg_replace('/-+/', '-', $part) ?: '';
    }

    private static function appendPart(string $base, string $part): string
    {
        if ($base === '') {
            return $part;
        }

        if ($base === $part || str_ends_with($base, '-' . $part)) {
            return $base;
        }

        return $base . '-' . $part;
    }

    /**
     * Collapse consecutive duplicate tokens and trailing repeated sequences
     * (e.g. sector-22-gurgaon-sector-22-gurgaon → sector-22-gurgaon).
     */
    private static function collapseRepeatedSequences(string $slug): string
    {
        $tokens = array_values(array_filter(explode('-', $slug), fn ($token) => $token !== ''));

        if ($tokens === []) {
            return '';
        }

        $result = [];
        foreach ($tokens as $token) {
            if ($result !== [] && end($result) === $token) {
                continue;
            }
            $result[] = $token;
        }

        $changed = true;
        while ($changed && count($result) >= 2) {
            $changed = false;
            $count = count($result);
            $maxLen = intdiv($count, 2);

            for ($len = $maxLen; $len >= 1; $len--) {
                $tail = array_slice($result, -$len);
                $prev = array_slice($result, -$len * 2, $len);

                if ($tail === $prev) {
                    $result = array_slice($result, 0, -$len);
                    $changed = true;
                    break;
                }
            }
        }

        return implode('-', $result);
    }

    public static function makeUnique(string $baseSlug, ?int $excludePropertyId = null): string
    {
        $slug = $baseSlug;
        $counter = 1;

        while (
            Property::query()
                ->where('slug', $slug)
                ->when($excludePropertyId, fn ($query) => $query->where('id', '!=', $excludePropertyId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
