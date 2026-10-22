<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;

class SimplifyHighlightImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:simplify-highlight-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simplify highlight images data to store only paths';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to simplify highlight images data...');
        
        $properties = Property::whereNotNull('highlight_images')->get();
        $this->info('Found ' . $properties->count() . ' properties with highlight images');
        
        $updatedCount = 0;
        
        foreach ($properties as $property) {
            if ($property->highlight_images && is_array($property->highlight_images)) {
                $simplifiedImages = [];
                
                foreach ($property->highlight_images as $image) {
                    if (is_array($image) && isset($image['path'])) {
                        // Store only the path
                        $simplifiedImages[] = $image['path'];
                    } elseif (is_string($image)) {
                        // If it's already just a string path, keep it
                        $simplifiedImages[] = $image;
                    }
                }
                
                // Update the property with simplified data
                $property->update(['highlight_images' => $simplifiedImages]);
                $updatedCount++;
                
                $this->info("Updated property: {$property->name} - " . count($simplifiedImages) . " images");
            }
        }
        
        $this->info("\nSimplification completed!");
        $this->info("Updated {$updatedCount} properties");
        
        return 0;
    }
}