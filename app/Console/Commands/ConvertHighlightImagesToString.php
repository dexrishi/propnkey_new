<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;

class ConvertHighlightImagesToString extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:convert-highlight-images-to-string';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert highlight images from array to single string path';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to convert highlight images to string format...');
        
        $properties = Property::whereNotNull('highlight_images')->get();
        $this->info('Found ' . $properties->count() . ' properties with highlight images');
        
        $updatedCount = 0;
        
        foreach ($properties as $property) {
            if ($property->highlight_images && is_array($property->highlight_images) && count($property->highlight_images) > 0) {
                // Take only the first image path
                $firstImagePath = $property->highlight_images[0];
                
                // Update the property with just the string path
                $property->update(['highlight_images' => $firstImagePath]);
                $updatedCount++;
                
                $this->info("Updated property: {$property->name} - Single image: {$firstImagePath}");
            }
        }
        
        $this->info("\nConversion completed!");
        $this->info("Updated {$updatedCount} properties");
        
        return 0;
    }
}