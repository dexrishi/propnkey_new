<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Partner;
use App\Models\Agent;
use App\Models\Location;
use App\Models\PropertyType;
use App\Models\PropertyCategory;
use App\Models\PropertyCondition;
use App\Models\Amenity;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing properties (handle foreign key constraints)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Property::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Read properties from JSON file
        $jsonPath = base_path('data/property.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->error('data/property.json file not found!');
            return;
        }
        
        $jsonData = file_get_contents($jsonPath);
        $properties = json_decode($jsonData, true);
        
        if (!$properties) {
            $this->command->error('Invalid JSON data in data/property.json file!');
            return;
        }
        
        $this->command->info('Importing ' . count($properties) . ' properties from data/property.json...');
        
        // Get default IDs for relationships
        $defaultAgent = Agent::first();
        $defaultCategory = PropertyCategory::first();
        $defaultCondition = PropertyCondition::first();
        
        if (!$defaultAgent) {
            $this->command->error('No agents found! Please seed agents first.');
            return;
        }
        
        if (!$defaultCategory) {
            $this->command->error('No property categories found! Please seed property categories first.');
            return;
        }
        
        if (!$defaultCondition) {
            $this->command->error('No property conditions found! Please seed property conditions first.');
            return;
        }
        
        foreach ($properties as $index => $propertyData) {
            try {
                // Map property type
                $propertyType = $this->getPropertyType($propertyData['property_type_2'] ?? 'Apartments');
                
                // Map location
                $location = $this->getLocation($propertyData['location'] ?? 'Bangalore');
                
                // Map partner
                $partner = $this->getPartner($propertyData['partner_id'] ?? 1);
                
                // Map amenities
                $amenityIds = $this->getAmenityIds($propertyData['amenities'] ?? []);
                
                // Convert price
                $price = $this->convertPrice($propertyData['price'] ?? '0', $propertyData['price_type'] ?? 'Cr.');
                $priceUnit = $this->getPriceUnit($propertyData['price_type'] ?? 'Cr.');
                
                // Map property status
                $propertyStatus = $this->mapPropertyStatus($propertyData['property_status'] ?? 'Newly Launched');
                
                // Map rise
                $rise = $this->mapRise($propertyData['rise'] ?? 'high');
                
                // Extract BHK and bathroom info
                $bhkInfo = $this->extractBHKInfo($propertyData['bhk'] ?? '');
                $bathroomCount = (int) ($propertyData['bathroom'] ?? 0);
                
                $property = Property::create([
                    'is_featured' => ($propertyData['featured'] ?? '0') == '1',
                    'name' => $propertyData['name'] ?? 'Property ' . ($index + 1),
                    'slug' => $propertyData['slug'] ?? Str::slug($propertyData['name'] ?? 'property-' . ($index + 1)),
                    'alias_name' => null,
                    'partner_id' => $partner->id,
                    'agent_id' => $defaultAgent->id,
                    'location_id' => $location->id,
                    'property_type_id' => $propertyType->id,
                    'property_category_id' => $defaultCategory->id,
                    'property_condition_id' => $defaultCondition->id,
                    'rating' => (float) ($propertyData['rating'] ?? 0),
                    'review_count' => (int) ($propertyData['review_count'] ?? 0),
                    'badge' => $propertyData['tag'] ?? null,
                    'locality' => $propertyData['locality'] ?? null,
                    'address' => $propertyData['address'] ?? null,
                    'rera_reg_no' => $propertyData['rera'] ?? null,
                    'sort_order' => (int) ($propertyData['sort'] ?? 90),
                    'home_sort' => (int) ($propertyData['home_sort'] ?? 90),
                    'price' => $price,
                    'price_unit' => $priceUnit,
                    'area_sq_ft' => (int) ($propertyData['area'] ?? 0),
                    'rise' => $rise,
                    'bedroom_count' => $bhkInfo['bedrooms'],
                    'bathroom_count' => $bathroomCount,
                    'possession' => $this->mapPossession($propertyData['possession'] ?? ''),
                    'property_status' => $propertyStatus,
                    'is_sold' => false,
                    'amenities_description' => $propertyData['amenities_text'] ?? null,
                    'property_description' => $propertyData['description'] ?? null,
                    'gallery_description' => $propertyData['gallery_text'] ?? null,
                    'floor_plan_description' => $propertyData['floor_plan_text'] ?? null,
                    'offer_text' => $propertyData['offer_text'] ?? null,
                    'meta_title' => $propertyData['meta_title'] ?? null,
                    'meta_description' => $propertyData['meta_desc'] ?? null,
                    'airport' => $propertyData['feature_airport'] ?? null,
                    'entertainment' => $propertyData['feature_entertainment'] ?? null,
                    'national_highway' => $propertyData['feature_nh'] ?? null,
                    'hospitals' => $propertyData['feature_hospital'] ?? null,
                    'education' => $propertyData['feature_education'] ?? null,
                    'project_highlights_title' => $propertyData['project_highlights'] ?? null,
                    'location_features' => null,
                    'price_list' => $propertyData['price_list'] ?? null,
                    'map_code' => null,
                    'map_text' => null,
                    'is_active' => ($propertyData['status'] ?? '1') == '1',
                ]);
                
                // Attach amenities
                if (!empty($amenityIds)) {
                    $property->amenities()->attach($amenityIds);
                }
                
                $this->command->info('Imported: ' . $property->name . ' (Slug: ' . $property->slug . ') - ' . ($property->is_active ? 'Active' : 'Inactive'));
                
            } catch (\Exception $e) {
                $this->command->error('Error importing property ' . ($propertyData['name'] ?? 'Unknown') . ': ' . $e->getMessage());
                continue;
            }
        }
        
        $this->command->info('Successfully imported ' . count($properties) . ' properties!');
    }
    
    private function getPropertyType($typeName)
    {
        $typeName = trim($typeName);
        
        // Try to find exact match first
        $propertyType = PropertyType::where('name', $typeName)->first();
        if ($propertyType) {
            return $propertyType;
        }
        
        // Try to find by slug
        $slug = Str::slug($typeName);
        $propertyType = PropertyType::where('slug', $slug)->first();
        if ($propertyType) {
            return $propertyType;
        }
        
        // Default to first available property type
        return PropertyType::first() ?? PropertyType::create([
            'name' => $typeName,
            'slug' => $slug,
            'is_active' => true,
        ]);
    }
    
    private function getLocation($locationName)
    {
        $locationName = trim($locationName);
        
        // Try to find exact match first
        $location = Location::where('name', $locationName)->first();
        if ($location) {
            return $location;
        }
        
        // Try to find by slug
        $slug = Str::slug($locationName);
        $location = Location::where('slug', $slug)->first();
        if ($location) {
            return $location;
        }
        
        // Default to first available location
        return Location::first() ?? Location::create([
            'name' => $locationName,
            'slug' => $slug,
            'is_active' => true,
        ]);
    }
    
    private function getPartner($partnerId)
    {
        $partner = Partner::find($partnerId);
        if ($partner) {
            return $partner;
        }
        
        // Default to first available partner
        return Partner::first() ?? Partner::create([
            'name' => 'Default Partner',
            'slug' => 'default-partner',
            'is_active' => true,
        ]);
    }
    
    private function getAmenityIds($amenities)
    {
        $amenityIds = [];
        
        foreach ($amenities as $amenityData) {
            $amenityName = $amenityData['name'] ?? '';
            if (empty($amenityName)) continue;
            
            $amenity = Amenity::where('name', $amenityName)->first();
            if ($amenity) {
                $amenityIds[] = $amenity->id;
            }
        }
        
        return $amenityIds;
    }
    
    private function convertPrice($price, $priceType)
    {
        $price = (float) $price;
        
        if (strtolower($priceType) === 'cr.' || strtolower($priceType) === 'cr') {
            return $price * 10000000; // Convert crores to rupees
        } else {
            return $price * 100000; // Convert lakhs to rupees
        }
    }
    
    private function getPriceUnit($priceType)
    {
        if (strtolower($priceType) === 'cr.' || strtolower($priceType) === 'cr') {
            return 'cr';
        } else {
            return 'lakhs';
        }
    }
    
    private function mapPropertyStatus($status)
    {
        $statusMap = [
            'Newly Launched' => 'newly_launched',
            'Ready to Move' => 'ready_to_move',
            'Under Construction' => 'under_construction',
        ];
        
        return $statusMap[$status] ?? 'newly_launched';
    }
    
    private function mapRise($rise)
    {
        return strtolower($rise) === 'high' ? 'high' : 'low';
    }
    
    private function extractBHKInfo($bhkString)
    {
        $bhkString = trim($bhkString);
        
        // Extract numbers from BHK string (e.g., "2, 3" or "3, 4" or "4")
        preg_match_all('/\d+/', $bhkString, $matches);
        
        if (!empty($matches[0])) {
            $bedrooms = (int) $matches[0][0]; // Take the first number as bedroom count
        } else {
            $bedrooms = 0;
        }
        
        return [
            'bedrooms' => $bedrooms,
        ];
    }
    
    private function mapPossession($possession)
    {
        if (empty($possession)) {
            return null;
        }
        
        // Try to parse as date
        $date = \DateTime::createFromFormat('Y-m-d', $possession);
        if ($date) {
            return $date->format('Y-m-d');
        }
        
        // If it's a text like "ONGOING", "New Launch", etc., return null
        return null;
    }
}