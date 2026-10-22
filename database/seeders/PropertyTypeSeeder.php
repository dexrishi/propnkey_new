<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing property types (handle foreign key constraints)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PropertyType::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Read property types from JSON file
        $jsonPath = base_path('data/property_type.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->error('data/property_type.json file not found!');
            return;
        }
        
        $jsonData = file_get_contents($jsonPath);
        $propertyTypes = json_decode($jsonData, true);
        
        if (!$propertyTypes) {
            $this->command->error('Invalid JSON data in data/property_type.json file!');
            return;
        }
        
        $this->command->info('Importing ' . count($propertyTypes) . ' property types from data/property_type.json...');
        
        foreach ($propertyTypes as $index => $typeData) {
            $name = $typeData['name'];
            $slug = $typeData['slug'];
            $status = $typeData['status'] == '1';
            $sortOrder = (int) $typeData['sort'];
            $heading = $typeData['heading'] ?: null;
            $description = $typeData['description'] ?: null;
            $metaTitle = $typeData['meta_title'] ?: null;
            $metaDescription = $typeData['meta_desc'] ?: null;
            
            PropertyType::create([
                'name' => $name,
                'slug' => $slug,
                'heading' => $heading,
                'description' => $description,
                'meta_title' => $metaTitle,
                'meta_description' => $metaDescription,
                'sort_order' => $sortOrder,
                'is_active' => $status,
            ]);
            
            $this->command->info('Imported: ' . $name . ' (Slug: ' . $slug . ') - ' . ($status ? 'Active' : 'Inactive'));
        }
        
        $this->command->info('Successfully imported ' . count($propertyTypes) . ' property types!');
    }
}