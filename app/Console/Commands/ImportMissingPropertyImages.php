<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportMissingPropertyImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:import-missing-images {--dry-run : Run without making changes} {--all : Import images for all properties, not just those without images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import property images from API for properties that do not have images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $importAll = $this->option('all');
        
        $this->info('Starting import of missing property images...');
        
        // Get properties without images or all properties if --all flag is set
        if ($importAll) {
            $properties = Property::all();
            $this->info('Processing all properties (--all flag set)');
        } else {
            // Get properties that don't have any images
            $properties = Property::whereDoesntHave('images')->get();
            $this->info('Found ' . $properties->count() . ' properties without images');
        }
        
        if ($properties->isEmpty()) {
            $this->info('No properties found to process.');
            return 0;
        }

        $successCount = 0;
        $errorCount = 0;
        $totalImagesDownloaded = 0;

        foreach ($properties as $property) {
            $this->info("\nProcessing property: {$property->name} (slug: {$property->slug})");

            try {
                // Fetch images from API
                $apiUrl = "https://propnkey.com/api/property_image?slug={$property->slug}";
                $this->line("Fetching images from: {$apiUrl}");

                // Disable SSL verification for localhost development
                $response = Http::timeout(30)
                    ->withoutVerifying()
                    ->get($apiUrl);
                
                if (!$response->successful()) {
                    $this->error("Failed to fetch images: HTTP {$response->status()}");
                    $errorCount++;
                    continue;
                }

                $images = $response->json();
                
                if (empty($images) || !is_array($images)) {
                    $this->warn("No images found for property: {$property->name}");
                    continue;
                }

                $this->info("Found " . count($images) . " images for property: {$property->name}");

                $imagesDownloaded = 0;

                foreach ($images as $imageData) {
                    $imageUrl = $imageData['image_url'] ?? null;
                    
                    if (!$imageUrl) {
                        $this->warn("Skipping image: No image_url found");
                        continue;
                    }

                    // Normalize image type (API returns "floor plan" but we need "floor_plan")
                    $imageType = $this->normalizeImageType($imageData['type'] ?? 'project');
                    $caption = $imageData['caption'] ?? '';
                    $alt = $imageData['alt'] ?? '';
                    
                    // Get file extension from URL or original filename
                    $originalImageName = $imageData['image'] ?? '';
                    $extension = $this->getFileExtension($imageUrl, $originalImageName);
                    
                    if (!$extension) {
                        $this->warn("Skipping image: Could not determine file extension for {$imageUrl}");
                        continue;
                    }
                    
                    // Generate unique filename
                    $filename = Str::uuid() . '.' . $extension;
                    
                    $this->line("  Downloading: {$imageUrl}");

                    if (!$dryRun) {
                        // Download image (disable SSL verification for localhost)
                        $imageResponse = Http::timeout(30)
                            ->withoutVerifying()
                            ->get($imageUrl);
                        
                        if (!$imageResponse->successful()) {
                            $this->error("  ✗ Failed to download image: {$imageUrl}");
                            continue;
                        }

                        // Create storage path following PropertyController structure
                        $path = 'properties/' . $property->id . '/' . $imageType . '/' . $filename;

                        // Ensure directory exists
                        $directory = dirname(storage_path('app/public/' . $path));
                        if (!file_exists($directory)) {
                            mkdir($directory, 0755, true);
                        }

                        // Store the image
                        Storage::disk('public')->put($path, $imageResponse->body());
                        
                        // Check if image already exists (avoid duplicates)
                        $existingImage = PropertyImage::where('property_id', $property->id)
                            ->where('image_path', $path)
                            ->first();
                        
                        if ($existingImage) {
                            $this->line("  ⚠ Image already exists, skipping database record");
                            continue;
                        }
                        
                        // Get max sort order for this property and type
                        $maxSortOrder = PropertyImage::where('property_id', $property->id)
                            ->where('type', $imageType)
                            ->max('sort_order') ?? 0;
                        
                        // Create property image record
                        $propertyImage = PropertyImage::create([
                            'property_id' => $property->id,
                            'type' => $imageType,
                            'alt_type' => $alt ?: null,
                            'image_path' => $path,
                            'caption' => $caption ?: null,
                            'sort_order' => $maxSortOrder + 1,
                            'is_active' => true,
                        ]);

                        $this->info("  ✓ Image downloaded and stored: {$path}");
                        $imagesDownloaded++;
                    } else {
                        // Dry run - just show what would be done
                        $this->info("  [DRY RUN] Would download: {$imageUrl}");
                        $this->line("    → Would store as: properties/{$property->id}/{$imageType}/{$filename}");
                        $imagesDownloaded++;
                    }
                }

                if ($imagesDownloaded > 0) {
                    $this->info("  ✓ Successfully processed {$imagesDownloaded} image(s) for {$property->name}");
                    $totalImagesDownloaded += $imagesDownloaded;
                    $successCount++;
                } else {
                    $this->warn("  ⚠ No images were downloaded for {$property->name}");
                }

            } catch (\Exception $e) {
                $this->error("  ✗ Error processing property {$property->slug}: " . $e->getMessage());
                $this->error("    " . $e->getTraceAsString());
                $errorCount++;
            }
        }

        $this->newLine();
        $this->info('=== Import Summary ===');
        $this->info("Successfully processed: {$successCount} properties");
        $this->info("Total images downloaded: {$totalImagesDownloaded}");
        if ($errorCount > 0) {
            $this->warn("Errors encountered: {$errorCount} properties");
        }
        
        if ($dryRun) {
            $this->warn('This was a DRY RUN - no changes were made');
        }

        return 0;
    }
    
    /**
     * Normalize image type from API format to database format
     */
    private function normalizeImageType($type)
    {
        $type = strtolower(trim($type));
        
        // Map API types to database types
        $typeMap = [
            'floor plan' => 'floor_plan',
            'floorplan' => 'floor_plan',
            'project' => 'project',
            'logo' => 'logo',
        ];
        
        return $typeMap[$type] ?? 'project';
    }
    
    /**
     * Get file extension from URL or filename
     */
    private function getFileExtension($url, $originalFilename = '')
    {
        // Try to get extension from original filename first
        if ($originalFilename) {
            $ext = pathinfo($originalFilename, PATHINFO_EXTENSION);
            if ($ext) {
                return strtolower($ext);
            }
        }
        
        // Try to get extension from URL
        $urlPath = parse_url($url, PHP_URL_PATH);
        if ($urlPath) {
            $ext = pathinfo($urlPath, PATHINFO_EXTENSION);
            if ($ext) {
                return strtolower($ext);
            }
        }
        
        // Default to jpg if we can't determine
        return 'jpg';
    }
}

