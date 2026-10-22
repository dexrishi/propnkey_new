<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing partners (handle foreign key constraints)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Partner::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Read partners from JSON file
        $jsonPath = base_path('data/partner.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->error('data/partner.json file not found!');
            return;
        }
        
        $jsonData = file_get_contents($jsonPath);
        $partners = json_decode($jsonData, true);
        
        if (!$partners) {
            $this->command->error('Invalid JSON data in data/partner.json file!');
            return;
        }
        
        $this->command->info('Importing ' . count($partners) . ' partners from data/partner.json...');
        
        // Create storage directory for partner images
        $storagePath = storage_path('app/public/partners');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }
        
        foreach ($partners as $index => $partnerData) {
            $name = trim($partnerData['name']); // Remove any leading/trailing spaces
            $status = $partnerData['status'] == '1';
            $image = $partnerData['image'];
            
            // Download image if it exists
            $imagePath = null;
            if ($image) {
                $imagePath = $this->downloadImage($image, $storagePath);
            }
            
            Partner::create([
                'name' => $name,
                'slug' => \Str::slug($name),
                'image' => $imagePath,
                'sort_order' => $index + 1, // Use array index + 1 as sort order
                'is_active' => $status,
            ]);
            
            $this->command->info('Imported: ' . $name . ($imagePath ? ' - Image: ' . $imagePath : ' - No image') . ' - ' . ($status ? 'Active' : 'Inactive'));
        }
        
        $this->command->info('Successfully imported ' . count($partners) . ' partners!');
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
                return 'partners/' . $filename;
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
                return 'partners/' . $filename;
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