<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportPropertyProjectImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:import-project-images {--dry-run : Run without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import property project images from API and store them in proper structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        $this->info('Starting import of property project images...');
        
        // Get all properties
        $properties = Property::all();
        $this->info('Found ' . $properties->count() . ' properties to process');

        $successCount = 0;
        $errorCount = 0;
        $mappingData = [];

        foreach ($properties as $property) {
            $this->info("Processing property: {$property->name} (slug: {$property->slug})");

            try {
                // Fetch images from API
                $apiUrl = "https://propnkey.com/api/property_image?slug={$property->slug}";
                $this->info("Fetching images from: {$apiUrl}");

                $response = Http::timeout(30)->get($apiUrl);
                
                if (!$response->successful()) {
                    $this->error("Failed to fetch images: HTTP {$response->status()}");
                    $errorCount++;
                    continue;
                }

                $images = $response->json();
                
                if (empty($images)) {
                    $this->warn("No images found for property: {$property->name}");
                    continue;
                }

                $this->info("Found " . count($images) . " images for property: {$property->name}");

                $propertyMapping = [
                    'property_id' => $property->id,
                    'property_name' => $property->name,
                    'property_slug' => $property->slug,
                    'images' => []
                ];

                foreach ($images as $imageData) {
                    $originalImageName = $imageData['image'];
                    $imageType = $imageData['type'] ?? 'project';
                    $caption = $imageData['caption'] ?? '';
                    $alt = $imageData['alt'] ?? '';
                    $datetime = $imageData['datetime'] ?? now()->toDateTimeString();

                    // Construct full image URL
                    $imageUrl = "http://propnkey.com/uploads/{$originalImageName}";
                    
                    // Generate unique filename
                    $extension = pathinfo($originalImageName, PATHINFO_EXTENSION);
                    $filename = Str::uuid() . '.' . $extension;
                    
                    $this->info("Processing image: {$originalImageName}");

                    if (!$dryRun) {
                        // Download image
                        $imageResponse = Http::timeout(30)->get($imageUrl);
                        
                        if (!$imageResponse->successful()) {
                            $this->error("Failed to download image: {$imageUrl}");
                            continue;
                        }

                        // Create storage path following PropertyController structure
                        $path = 'properties/' . $property->id . '/' . $imageType . '/' . $filename;

                        // Store the image
                        Storage::disk('public')->put($path, $imageResponse->body());
                        
                        // Create property image record
                        $propertyImage = PropertyImage::create([
                            'property_id' => $property->id,
                            'type' => $imageType,
                            'alt_type' => $alt,
                            'image_path' => $path,
                            'caption' => $caption,
                            'sort_order' => PropertyImage::where('property_id', $property->id)
                                ->where('type', $imageType)
                                ->max('sort_order') + 1,
                        ]);

                        // Store mapping data
                        $propertyMapping['images'][] = [
                            'original_url' => $imageUrl,
                            'original_filename' => $originalImageName,
                            'stored_path' => $path,
                            'stored_filename' => $filename,
                            'property_image_id' => $propertyImage->id,
                            'type' => $imageType,
                            'caption' => $caption,
                            'alt' => $alt,
                            'datetime' => $datetime
                        ];

                        $this->info("✓ Image downloaded and stored: {$path}");
                    } else {
                        // Dry run - just show what would be done
                        $propertyMapping['images'][] = [
                            'original_url' => $imageUrl,
                            'original_filename' => $originalImageName,
                            'would_store_as' => "properties/{$property->id}/{$imageType}/" . Str::uuid() . '.' . $extension,
                            'type' => $imageType,
                            'caption' => $caption,
                            'alt' => $alt,
                            'datetime' => $datetime
                        ];
                        
                        $this->info("✓ [DRY RUN] Would download: {$imageUrl}");
                    }
                }

                $mappingData[] = $propertyMapping;
                $successCount++;

            } catch (\Exception $e) {
                $this->error("Error processing property {$property->slug}: " . $e->getMessage());
                $errorCount++;
            }
        }

        // Save mapping data to JSON file
        $mappingFile = storage_path('app/property_images_mapping.json');
        file_put_contents($mappingFile, json_encode($mappingData, JSON_PRETTY_PRINT));
        $this->info("Mapping data saved to: {$mappingFile}");

        $this->info("\nImport completed!");
        $this->info("Successfully processed: {$successCount} properties");
        if ($errorCount > 0) {
            $this->warn("Errors encountered: {$errorCount} properties");
        }

        return 0;
    }
}