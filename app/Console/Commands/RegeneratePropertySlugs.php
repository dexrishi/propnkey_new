<?php

namespace App\Console\Commands;

use App\Helpers\PropertySlugHelper;
use App\Models\Property;
use App\Models\Redirection;
use Illuminate\Console\Command;

class RegeneratePropertySlugs extends Command
{
    protected $signature = 'properties:regenerate-slugs
                            {--id= : Specific property ID to regenerate, or minimum ID to regenerate all above}
                            {--all : Regenerate all properties}
                            {--duplicates-only : Only fix slugs with repeated city/locality endings}
                            {--no-redirects : Do not create 301 redirects for changed slugs}';

    protected $description = 'Regenerate property slugs in format: project-name-locality-city (without duplicate endings)';

    public function handle()
    {
        $propertyId = $this->option('id');
        $all = $this->option('all');
        $duplicatesOnly = $this->option('duplicates-only');
        $withRedirects = !$this->option('no-redirects');

        if (!$propertyId && !$all && !$duplicatesOnly) {
            $this->error('Please provide --id=MIN_ID, --all, or --duplicates-only.');
            $this->info('Examples:');
            $this->info('  php artisan properties:regenerate-slugs --duplicates-only');
            $this->info('  php artisan properties:regenerate-slugs --id=92');
            $this->info('  php artisan properties:regenerate-slugs --all');

            return 1;
        }

        $query = Property::query()->with(['location', 'propertyCategory:id,slug']);

        if ($propertyId) {
            $query->where('id', '>=', $propertyId)->orderBy('id');
            $this->info("Regenerating slugs for properties with ID >= {$propertyId}...");
        } elseif ($duplicatesOnly) {
            $this->info('Regenerating slugs that look duplicated...');
        } else {
            $this->info('Regenerating slugs for all properties...');
        }

        $properties = $query->get();

        if ($duplicatesOnly) {
            $properties = $properties->filter(fn (Property $property) => $this->looksDuplicated($property->slug));
        }

        if ($properties->isEmpty()) {
            $this->warn('No matching properties found.');

            return 0;
        }

        $total = $properties->count();
        $updated = 0;
        $unchanged = 0;
        $redirects = 0;

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($properties as $property) {
            $oldSlug = $property->slug;
            $newSlug = PropertySlugHelper::build(
                $property->name,
                $property->locality,
                $property->location,
                $property->id
            );

            if ($newSlug !== $oldSlug) {
                $property->slug = $newSlug;
                $property->save();
                $updated++;

                if ($withRedirects && $oldSlug && $property->propertyCategory) {
                    if ($this->createSlugRedirect($property, $oldSlug, $newSlug)) {
                        $redirects++;
                    }
                }
            } else {
                $unchanged++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Completed!');
        $this->info("  - Total checked: {$total}");
        $this->info("  - Updated: {$updated}");
        $this->info("  - Unchanged: {$unchanged}");
        if ($withRedirects) {
            $this->info("  - Redirects created: {$redirects}");
        }

        return 0;
    }

    private function looksDuplicated(?string $slug): bool
    {
        if (!$slug) {
            return false;
        }

        $tokens = array_values(array_filter(explode('-', $slug), fn ($t) => $t !== ''));
        $count = count($tokens);

        if ($count < 2) {
            return false;
        }

        // consecutive duplicate token: gurgaon-gurgaon
        for ($i = 1; $i < $count; $i++) {
            if ($tokens[$i] === $tokens[$i - 1]) {
                return true;
            }
        }

        // trailing repeated sequence: sector-22-gurgaon-sector-22-gurgaon
        $maxLen = intdiv($count, 2);
        for ($len = 1; $len <= $maxLen; $len++) {
            $tail = array_slice($tokens, -$len);
            $prev = array_slice($tokens, -$len * 2, $len);
            if ($tail === $prev) {
                return true;
            }
        }

        return false;
    }

    private function createSlugRedirect(Property $property, string $oldSlug, string $newSlug): bool
    {
        $categorySlug = $property->propertyCategory->slug ?? null;
        if (!$categorySlug) {
            return false;
        }

        $from = '/property/' . $categorySlug . '/' . $oldSlug;
        $to = '/property/' . $categorySlug . '/' . $newSlug;

        if ($from === $to) {
            return false;
        }

        Redirection::updateOrCreate(
            ['from_url' => $from],
            [
                'to_url' => $to,
                'type' => '301',
                'is_active' => true,
            ]
        );

        return true;
    }
}
