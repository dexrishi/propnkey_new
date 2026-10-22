<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use App\Models\Location;
use App\Models\PropertyType;
use App\Models\PropertyStatus;
use App\Models\PropertyCategory;
use App\Models\BedroomOption;
use App\Models\Amenity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportPropertiesFromOldJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:import-from-old-json {--dry-run : Run without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import/Update properties from old.json file using slug as identifier';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        $this->info('Starting import/update of properties from old.json...');
        
        // Read old.json file
        $jsonPath = base_path('old.json');
        
        if (!file_exists($jsonPath)) {
            $this->error('old.json file not found at: ' . $jsonPath);
            return 1;
        }
        
        $jsonContent = file_get_contents($jsonPath);
        $properties = json_decode($jsonContent, true);
        
        if (!is_array($properties)) {
            $this->error('Invalid JSON format in old.json');
            return 1;
        }
        
        $this->info('Found ' . count($properties) . ' properties to process');
        
        $successCount = 0;
        $errorCount = 0;
        $createdCount = 0;
        $updatedCount = 0;
        
        // Cache for lookups
        $locationCache = [];
        $propertyTypeCache = [];
        $propertyStatusCache = [];
        $propertyCategoryCache = [];
        $bedroomOptionCache = [];
        
        foreach ($properties as $index => $oldProperty) {
            $slug = $oldProperty['slug'] ?? null;
            
            if (!$slug) {
                $this->warn("Skipping property at index {$index}: No slug found");
                $errorCount++;
                continue;
            }
            
            $this->info("Processing property: {$oldProperty['name']} (slug: {$slug})");
            
            try {
                // Find property by slug
                $property = Property::where('slug', $slug)->first();
                $isNew = !$property;
                
                if ($isNew) {
                    $this->line("  → Property not found, will create new one");
                }
                
                // Prepare data (for both create and update)
                $updateData = [];
                
                // Always set slug for new properties
                if ($isNew) {
                    $updateData['slug'] = $slug;
                }
                
                // Direct field matches
                if (isset($oldProperty['name'])) {
                    $updateData['name'] = $oldProperty['name'];
                }
                
                if (isset($oldProperty['address'])) {
                    $updateData['address'] = $oldProperty['address'];
                }
                
                if (isset($oldProperty['locality'])) {
                    $updateData['locality'] = $oldProperty['locality'];
                }
                
                if (isset($oldProperty['price'])) {
                    $updateData['price'] = $this->convertToDecimal($oldProperty['price']);
                }
                
                if (isset($oldProperty['rating'])) {
                    $updateData['rating'] = $this->convertToDecimal($oldProperty['rating']);
                }
                
                if (isset($oldProperty['review_count'])) {
                    $updateData['review_count'] = (int) $oldProperty['review_count'];
                }
                
                // Rise - only set if valid enum value ('high' or 'low')
                if (isset($oldProperty['rise']) && !empty(trim($oldProperty['rise']))) {
                    $riseValue = strtolower(trim($oldProperty['rise']));
                    if (in_array($riseValue, ['high', 'low'])) {
                        $updateData['rise'] = $riseValue;
                    }
                }
                
                if (isset($oldProperty['offer_text'])) {
                    $updateData['offer_text'] = $oldProperty['offer_text'];
                }
                
                if (isset($oldProperty['meta_title'])) {
                    $updateData['meta_title'] = $oldProperty['meta_title'];
                }
                
                if (isset($oldProperty['home_sort'])) {
                    $updateData['home_sort'] = (int) $oldProperty['home_sort'];
                }
                
                if (isset($oldProperty['price_list'])) {
                    $updateData['price_list'] = $oldProperty['price_list'];
                }
                
                // Field name differences
                if (isset($oldProperty['meta_desc'])) {
                    $updateData['meta_description'] = $oldProperty['meta_desc'];
                }
                
                if (isset($oldProperty['sort'])) {
                    $updateData['sort_order'] = (int) $oldProperty['sort'];
                }
                
                if (isset($oldProperty['featured'])) {
                    $updateData['is_featured'] = $this->convertToBoolean($oldProperty['featured']);
                }
                
                if (isset($oldProperty['rera'])) {
                    $updateData['rera_reg_no'] = $oldProperty['rera'];
                }
                
                // Content fields
                if (isset($oldProperty['description'])) {
                    $updateData['property_description'] = $oldProperty['description'];
                }
                
                if (isset($oldProperty['gallery_text'])) {
                    $updateData['gallery_description'] = $oldProperty['gallery_text'];
                }
                
                if (isset($oldProperty['floor_plan_text'])) {
                    $updateData['floor_plan_description'] = $oldProperty['floor_plan_text'];
                }
                
                if (isset($oldProperty['amenities_text'])) {
                    $updateData['amenities_description'] = $oldProperty['amenities_text'];
                }
                
                if (isset($oldProperty['project_highlights'])) {
                    $updateData['project_highlights_title'] = $oldProperty['project_highlights'];
                }
                
                // Location features
                if (isset($oldProperty['feature_airport'])) {
                    $updateData['airport'] = $oldProperty['feature_airport'];
                }
                
                if (isset($oldProperty['feature_entertainment'])) {
                    $updateData['entertainment'] = $oldProperty['feature_entertainment'];
                }
                
                if (isset($oldProperty['feature_nh'])) {
                    $updateData['national_highway'] = $oldProperty['feature_nh'];
                }
                
                if (isset($oldProperty['feature_hospital'])) {
                    $updateData['hospitals'] = $oldProperty['feature_hospital'];
                }
                
                if (isset($oldProperty['feature_education'])) {
                    $updateData['education'] = $oldProperty['feature_education'];
                }
                
                // Area conversion
                if (isset($oldProperty['area'])) {
                    $updateData['area_sq_ft'] = (int) $oldProperty['area'];
                }
                
                // Status conversion
                if (isset($oldProperty['status'])) {
                    $updateData['is_active'] = $this->convertToBoolean($oldProperty['status']);
                }
                
                // Possession - handle invalid date strings like "New Launch", "Upcoming", etc.
                if (isset($oldProperty['possession'])) {
                    $possession = $oldProperty['possession'];
                    
                    // Skip common non-date strings
                    $invalidStrings = ['New Launch', 'Upcoming', 'TBD', 'To Be Announced', 'TBA', ''];
                    
                    if ($possession && !in_array(trim($possession), $invalidStrings)) {
                        try {
                            // Try to parse as date to validate
                            $date = \Carbon\Carbon::parse($possession);
                            $updateData['possession'] = $date->format('Y-m-d');
                        } catch (\Exception $e) {
                            // Skip if date conversion fails - it's not a valid date
                            $this->line("  ⚠ Skipping invalid possession date: '{$possession}'");
                        }
                    }
                }
                
                // Partner ID
                if (isset($oldProperty['partner_id'])) {
                    $updateData['partner_id'] = (int) $oldProperty['partner_id'];
                }
                
                // Location lookup (try by name first, then by slug)
                if (isset($oldProperty['location'])) {
                    $locationName = $oldProperty['location'];
                    if (!isset($locationCache[$locationName])) {
                        $location = Location::where('name', $locationName)->first();
                        if (!$location) {
                            $location = Location::where('slug', Str::slug($locationName))->first();
                        }
                        $locationCache[$locationName] = $location ? $location->id : null;
                    }
                    if ($locationCache[$locationName]) {
                        $updateData['location_id'] = $locationCache[$locationName];
                    }
                }
                
                // Property Type lookup (try by name first, then by slug)
                if (isset($oldProperty['property_type'])) {
                    $typeName = $oldProperty['property_type'];
                    if (!isset($propertyTypeCache[$typeName])) {
                        $propertyType = PropertyType::where('name', $typeName)->first();
                        if (!$propertyType) {
                            $propertyType = PropertyType::where('slug', Str::slug($typeName))->first();
                        }
                        $propertyTypeCache[$typeName] = $propertyType ? $propertyType->id : null;
                    }
                    if ($propertyTypeCache[$typeName]) {
                        $updateData['property_type_id'] = $propertyTypeCache[$typeName];
                    }
                }
                
                // Property Status lookup (try by name first, then by slug)
                if (isset($oldProperty['property_status'])) {
                    $statusName = $oldProperty['property_status'];
                    if (!isset($propertyStatusCache[$statusName])) {
                        $propertyStatus = PropertyStatus::where('name', $statusName)->first();
                        if (!$propertyStatus) {
                            $propertyStatus = PropertyStatus::where('slug', Str::slug($statusName))->first();
                        }
                        $propertyStatusCache[$statusName] = $propertyStatus ? $propertyStatus->id : null;
                    }
                    if ($propertyStatusCache[$statusName]) {
                        $updateData['property_status_id'] = $propertyStatusCache[$statusName];
                    }
                }
                
                // Property Category lookup (from property_type_2, try by name first, then by slug)
                if (isset($oldProperty['property_type_2'])) {
                    $categoryName = $oldProperty['property_type_2'];
                    if (!isset($propertyCategoryCache[$categoryName])) {
                        $propertyCategory = PropertyCategory::where('name', $categoryName)->first();
                        if (!$propertyCategory) {
                            $propertyCategory = PropertyCategory::where('slug', Str::slug($categoryName))->first();
                        }
                        $propertyCategoryCache[$categoryName] = $propertyCategory ? $propertyCategory->id : null;
                    }
                    if ($propertyCategoryCache[$categoryName]) {
                        $updateData['property_category_id'] = $propertyCategoryCache[$categoryName];
                    }
                }
                
                // Clean up empty strings for nullable fields (convert to null)
                $updateData = $this->cleanEmptyStrings($updateData);
                
                // Create or update property
                if (!$dryRun && !empty($updateData)) {
                    if ($isNew) {
                        // Ensure required fields for new properties
                        if (!isset($updateData['name'])) {
                            $this->warn("  ⚠ Skipping creation: Name is required but not found");
                            $errorCount++;
                            continue;
                        }
                        
                        $property = Property::create($updateData);
                        $createdCount++;
                        $this->info("  ✓ Created successfully");
                    } else {
                        $property->update($updateData);
                        $updatedCount++;
                        $this->info("  ✓ Updated successfully");
                    }
                } else {
                    if ($dryRun) {
                        $action = $isNew ? 'create' : 'update';
                        if ($isNew && !isset($updateData['name'])) {
                            $this->warn("  ⚠ [DRY RUN] Would skip: Name is required but not found");
                        } else {
                            $this->line("  [DRY RUN] Would {$action}: " . json_encode($updateData));
                        }
                    }
                }
                
                // Handle relationships (only if property exists, either created or found)
                if (!$dryRun && $property) {
                    // Sync amenities
                    if (isset($oldProperty['amenities']) && is_array($oldProperty['amenities'])) {
                        $amenityIds = [];
                        foreach ($oldProperty['amenities'] as $amenity) {
                            if (isset($amenity['id'])) {
                                $amenityIds[] = (int) $amenity['id'];
                            }
                        }
                        if (!empty($amenityIds)) {
                            $property->amenities()->sync($amenityIds);
                        }
                    }
                    
                    // Sync bedroom options (from bhk)
                    if (isset($oldProperty['bhk'])) {
                        $bhkValue = $oldProperty['bhk'];
                        $bedroomOption = BedroomOption::where('value', $bhkValue)->first();
                        if ($bedroomOption) {
                            $property->bedroomOptions()->sync([$bedroomOption->id]);
                        }
                    }
                }
                
                $successCount++;
                
            } catch (\Exception $e) {
                $this->error("  ✗ Error: " . $e->getMessage());
                $errorCount++;
            }
        }
        
        $this->newLine();
        $this->info('=== Import Summary ===');
        $this->info("Successfully processed: {$successCount}");
        if (!$dryRun) {
            $this->info("  - Created: {$createdCount}");
            $this->info("  - Updated: {$updatedCount}");
        }
        $this->info("Errors: {$errorCount}");
        
        if ($dryRun) {
            $this->warn('This was a DRY RUN - no changes were made');
        }
        
        return 0;
    }
    
    /**
     * Convert string to decimal
     */
    private function convertToDecimal($value)
    {
        if (is_null($value) || $value === '') {
            return null;
        }
        return (float) $value;
    }
    
    /**
     * Convert string to boolean
     */
    private function convertToBoolean($value)
    {
        if (is_bool($value)) {
            return $value;
        }
        if (is_numeric($value)) {
            return (int) $value === 1;
        }
        if (is_string($value)) {
            return in_array(strtolower($value), ['1', 'true', 'yes', 'on']);
        }
        return false;
    }
    
    /**
     * Clean empty strings from update data - convert to null for nullable fields
     */
    private function cleanEmptyStrings($data)
    {
        // Fields that should be null if empty (nullable fields)
        $nullableFields = [
            'address', 'locality', 'rera_reg_no', 'offer_text', 'meta_title', 'meta_description',
            'amenities_description', 'property_description', 'gallery_description', 'floor_plan_description',
            'project_highlights_title', 'price_list', 'airport', 'entertainment', 'national_highway',
            'hospitals', 'education', 'location_features', 'map_code', 'map_text'
        ];
        
        foreach ($data as $key => $value) {
            // Convert empty strings to null for nullable fields
            if (in_array($key, $nullableFields) && $value === '') {
                $data[$key] = null;
            }
        }
        
        return $data;
    }
}

