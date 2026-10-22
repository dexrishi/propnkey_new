<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ImageRedirection;
use App\Models\Property;
use App\Models\PropertyImage;

class PopulateImageRedirections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:populate-redirections {--force : Force recreate all redirections}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate image redirections table from mapping file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force');
        
        if ($force) {
            $this->info('Clearing existing redirections...');
            ImageRedirection::truncate();
        }

        $mappingFile = storage_path('app/property_images_mapping.json');
        
        if (!file_exists($mappingFile)) {
            $this->error('Mapping file not found: ' . $mappingFile);
            return 1;
        }

        $this->info('Reading mapping file...');
        $mappingData = json_decode(file_get_contents($mappingFile), true);
        
        if (!$mappingData) {
            $this->error('Failed to parse mapping file');
            return 1;
        }

        $this->info('Processing ' . count($mappingData) . ' properties...');
        
        $created = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($mappingData as $propertyData) {
            $propertyId = $propertyData['property_id'];
            $propertyName = $propertyData['property_name'];
            
            $this->info("Processing property: {$propertyName} (ID: {$propertyId})");
            
            foreach ($propertyData['images'] as $imageData) {
                $originalFilename = $imageData['original_filename'];
                $storedPath = $imageData['stored_path'];
                $imageType = $imageData['type'] ?? 'project';
                $propertyImageId = $imageData['property_image_id'] ?? null;
                
                // Create old path (uploads/filename)
                $oldPath = 'uploads/' . $originalFilename;
                
                // Check if redirection already exists
                if (!$force && ImageRedirection::where('old_path', $oldPath)->exists()) {
                    $skipped++;
                    continue;
                }
                
                try {
                    ImageRedirection::updateOrCreate(
                        ['old_path' => $oldPath],
                        [
                            'new_path' => $storedPath,
                            'original_filename' => $originalFilename,
                            'property_id' => $propertyId,
                            'image_type' => $imageType,
                            'property_image_id' => $propertyImageId,
                            'is_active' => true,
                        ]
                    );
                    $created++;
                } catch (\Exception $e) {
                    $this->error("Error creating redirection for {$oldPath}: " . $e->getMessage());
                    $errors++;
                }
            }
        }

        $this->info("\nRedirection population completed!");
        $this->info("Created: {$created} redirections");
        $this->info("Skipped: {$skipped} redirections");
        if ($errors > 0) {
            $this->warn("Errors: {$errors} redirections");
        }

        return 0;
    }
}