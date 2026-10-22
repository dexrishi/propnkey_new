<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing locations (handle foreign key constraints)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Location::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Read locations from JSON file
        $jsonPath = base_path('data/location.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->error('data/location.json file not found!');
            return;
        }
        
        $jsonData = file_get_contents($jsonPath);
        $locations = json_decode($jsonData, true);
        
        if (!$locations) {
            $this->command->error('Invalid JSON data in data/location.json file!');
            return;
        }
        
        $this->command->info('Importing ' . count($locations) . ' locations from data/location.json...');
        
        // Create storage directory for location images
        $storagePath = storage_path('app/public/locations');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }
        
        foreach ($locations as $index => $locationData) {
            $name = $locationData['name'];
            $slug = $locationData['slug'];
            $sortOrder = (int) $locationData['sort'];
            $status = $locationData['status'] == '1';
            $image = $locationData['image'];
            $country = $locationData['country'];
            
            // Download image if it exists
            $imagePath = null;
            if ($image) {
                $imagePath = $this->downloadImage($image, $storagePath);
            }
            
            Location::create([
                'name' => $name,
                'slug' => $slug,
                'sort_order' => $sortOrder,
                'meta_title' => $locationData['meta_title'],
                'meta_description' => $locationData['meta_desc'],
                'heading' => $locationData['heading'],
                'site_description' => $locationData['description'],
                'image' => $imagePath,
                'is_active' => $status,
            ]);
            
            $this->command->info('Imported: ' . $name . ' (' . $country . ')' . ($imagePath ? ' - Image: ' . $imagePath : ' - No image'));
        }
        
        $this->command->info('Successfully imported ' . count($locations) . ' locations!');
    }
    
    /**
     * Download image from propnkey.com
     */
    private function downloadImage($filename, $storagePath)
    {
        $imageUrl = 'https://propnkey.com/uploads/' . $filename;
        
        try {
            // Check if file already exists
            $localPath = $storagePath . '/' . $filename;
            if (file_exists($localPath)) {
                return 'locations/' . $filename;
            }
            
            // Download the image
            $imageData = file_get_contents($imageUrl);
            
            if ($imageData === false) {
                $this->command->warn('Failed to download image: ' . $imageUrl);
                return null;
            }
            
            // Save the image
            file_put_contents($localPath, $imageData);
            
            // Verify the file was saved
            if (file_exists($localPath)) {
                return 'locations/' . $filename;
            } else {
                $this->command->warn('Failed to save image: ' . $filename);
                return null;
            }
            
        } catch (\Exception $e) {
            $this->command->warn('Error downloading image ' . $filename . ': ' . $e->getMessage());
            return null;
        }
    }
}