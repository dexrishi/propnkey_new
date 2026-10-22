<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportPropertyHighlightImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:import-highlight-images {--base-url=} {--dry-run : Run without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import property highlight images from JSON data and download them to storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseUrl = $this->option('base-url');
        $dryRun = $this->option('dry-run');
        
        if (!$baseUrl) {
            $this->error('Please provide --base-url option with the base URL for the images');
            return 1;
        }

        $this->info('Starting import of property highlight images...');
        
        // Load property data from JSON
        $jsonPath = base_path('data/property.json');
        if (!file_exists($jsonPath)) {
            $this->error('Property JSON file not found at: ' . $jsonPath);
            return 1;
        }

        $propertiesData = json_decode(file_get_contents($jsonPath), true);
        if (!$propertiesData) {
            $this->error('Failed to parse property JSON file');
            return 1;
        }

        $this->info('Found ' . count($propertiesData) . ' properties in JSON file');

        $successCount = 0;
        $errorCount = 0;

        foreach ($propertiesData as $propertyData) {
            $slug = $propertyData['slug'] ?? null;
            $highlightImage = $propertyData['project_highlights_image'] ?? null;
            
            if (!$slug || !$highlightImage) {
                $this->warn("Skipping property: missing slug or highlight image");
                continue;
            }

            // Find property by slug
            $property = Property::where('slug', $slug)->first();
            if (!$property) {
                $this->warn("Property not found for slug: {$slug}");
                continue;
            }

            $this->info("Processing property: {$property->name} (slug: {$slug})");

            try {
                // Download image
                $imageUrl = rtrim($baseUrl, '/') . '/' . $highlightImage;
                $this->info("Downloading image from: {$imageUrl}");

                if (!$dryRun) {
                    $response = Http::timeout(30)->get($imageUrl);
                    
                    if (!$response->successful()) {
                        $this->error("Failed to download image: HTTP {$response->status()}");
                        $errorCount++;
                        continue;
                    }

                    // Generate unique filename
                    $extension = pathinfo($highlightImage, PATHINFO_EXTENSION);
                    $filename = 'highlight_' . $property->slug . '_' . time() . '.' . $extension;
                    $path = 'properties/highlights/' . $filename;

                    // Store image
                    Storage::disk('public')->put($path, $response->body());
                    
                    // Update property with highlight image (store only path as string)
                    $property->update(['highlight_images' => $path]);
                    
                    $this->info("✓ Image downloaded and saved: {$path}");
                } else {
                    $this->info("✓ [DRY RUN] Would download: {$imageUrl}");
                }

                $successCount++;

            } catch (\Exception $e) {
                $this->error("Error processing property {$slug}: " . $e->getMessage());
                $errorCount++;
            }
        }

        $this->info("\nImport completed!");
        $this->info("Successfully processed: {$successCount} properties");
        if ($errorCount > 0) {
            $this->warn("Errors encountered: {$errorCount} properties");
        }

        return 0;
    }
}