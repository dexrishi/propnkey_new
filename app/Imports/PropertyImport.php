<?php

namespace App\Imports;

use App\Models\Property;
use App\Models\Location;
use App\Models\PropertyType;
use App\Models\PropertyCategory;
use App\Models\PropertyCondition;
use App\Models\PropertyStatus;
use App\Models\BedroomOption;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PropertyImport
{
    protected $errors = [];
    protected $previewData = [];
    protected $rowNumber = 0;
    protected $isFirstImport = true;

    /**
     * Read Excel file and return preview data with validation
     */
    public function preview($filePath)
    {
        $this->errors = [];
        $this->previewData = [];
        
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            
            // Skip header row (row 1)
            $headerRow = array_shift($rows);
            
            // Map header columns
            $columnMap = $this->mapColumns($headerRow);
            
            foreach ($rows as $index => $row) {
                $this->rowNumber = $index + 2; // +2 because we removed header and arrays are 0-indexed
                
                if ($this->isEmptyRow($row)) {
                    continue;
                }
                
                $data = $this->mapRowData($row, $columnMap);
                $validation = $this->validateRow($data);
                
                // Merge validated data (with resolved IDs) back into data
                $validatedData = array_merge($data, $validation['data']);
                
                $this->previewData[] = [
                    'row' => $this->rowNumber,
                    'data' => $validatedData,
                    'errors' => $validation['errors'],
                    'warnings' => $validation['warnings'],
                ];
            }
            
            return [
                'success' => true,
                'data' => $this->previewData,
                'total_rows' => count($this->previewData),
                'errors_count' => count(array_filter($this->previewData, fn($item) => !empty($item['errors']))),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Import properties from validated data
     */
    public function import($validatedRows)
    {
        $imported = 0;
        $failed = 0;
        $errors = [];
        
        // Reset first import flag
        $this->isFirstImport = true;
        
        foreach ($validatedRows as $rowData) {
            try {
                $property = $this->createProperty($rowData);
                
                if ($property) {
                    $imported++;
                } else {
                    $failed++;
                    $errors[] = "Row {$rowData['row']}: Failed to create property";
                }
            } catch (\Exception $e) {
                $failed++;
                $errors[] = "Row {$rowData['row']}: " . $e->getMessage();
            }
        }
        
        return [
            'imported' => $imported,
            'failed' => $failed,
            'errors' => $errors,
        ];
    }

    /**
     * Map Excel columns to our field names
     */
    protected function mapColumns($headerRow)
    {
        $map = [];
        $expectedColumns = [
            'name', 'address', 'location', 'locality', 'property_type', 'property_type_2',
            'price', 'price_type', 'area', 'bhk', 'bathroom', 'status', 'property_status',
            'possession', 'feature_airport', 'feature_entertainment', 'feature_nh',
            'feature_hospital', 'feature_education', 'rera', 'rise', 'rating', 'review_count'
        ];
        
        foreach ($headerRow as $index => $header) {
            $header = strtolower(trim($header));
            if (in_array($header, $expectedColumns)) {
                $map[$header] = $index;
            }
        }
        
        return $map;
    }

    /**
     * Map row data to property fields
     */
    protected function mapRowData($row, $columnMap)
    {
        $data = [];
        
        // Direct mappings
        $data['name'] = $this->getCellValue($row, $columnMap, 'name');
        $data['address'] = $this->getCellValue($row, $columnMap, 'address');
        $data['locality'] = $this->getCellValue($row, $columnMap, 'locality');
        
        // Clean price - remove commas and convert to numeric
        $priceValue = $this->getCellValue($row, $columnMap, 'price');
        $data['price'] = $this->cleanNumericValue($priceValue);
        
        // Clean area - remove commas and convert to numeric
        $areaValue = $this->getCellValue($row, $columnMap, 'area');
        $data['area_sq_ft'] = $this->cleanNumericValue($areaValue);
        $data['rise'] = $this->getCellValue($row, $columnMap, 'rise');
        
        // Clean numeric fields - remove commas
        $ratingValue = $this->getCellValue($row, $columnMap, 'rating');
        $data['rating'] = $this->cleanNumericValue($ratingValue);
        
        $reviewCountValue = $this->getCellValue($row, $columnMap, 'review_count');
        $data['review_count'] = $this->cleanNumericValue($reviewCountValue);
        $data['rera_reg_no'] = $this->getCellValue($row, $columnMap, 'rera');
        
        // Feature fields
        $data['airport'] = $this->getCellValue($row, $columnMap, 'feature_airport');
        $data['entertainment'] = $this->getCellValue($row, $columnMap, 'feature_entertainment');
        $data['national_highway'] = $this->getCellValue($row, $columnMap, 'feature_nh');
        $data['hospitals'] = $this->getCellValue($row, $columnMap, 'feature_hospital');
        $data['education'] = $this->getCellValue($row, $columnMap, 'feature_education');
        
        // Date field
        $possession = $this->getCellValue($row, $columnMap, 'possession');
        if ($possession) {
            $data['possession'] = $this->parseDate($possession);
        }
        
        // Relationship lookups (will be resolved in validateRow)
        $data['location_name'] = $this->getCellValue($row, $columnMap, 'location');
        $data['property_type_name'] = $this->getCellValue($row, $columnMap, 'property_type');
        $data['property_type_2_name'] = $this->getCellValue($row, $columnMap, 'property_type_2');
        $data['property_status_name'] = $this->getCellValue($row, $columnMap, 'property_status');
        $data['bhk_value'] = $this->getCellValue($row, $columnMap, 'bhk');
        $data['bathroom'] = $this->getCellValue($row, $columnMap, 'bathroom');
        $data['status'] = $this->getCellValue($row, $columnMap, 'status');
        $data['price_type'] = $this->getCellValue($row, $columnMap, 'price_type');
        
        return $data;
    }

    /**
     * Validate row data
     */
    protected function validateRow($data)
    {
        $errors = [];
        $warnings = [];
        
        // Required fields
        if (empty($data['name'])) {
            $errors[] = 'Name is required';
        }
        
        // Validate location
        if (!empty($data['location_name'])) {
            $location = Location::where('name', 'like', '%' . $data['location_name'] . '%')->first();
            if (!$location) {
                $warnings[] = "Location '{$data['location_name']}' not found";
            } else {
                $data['location_id'] = $location->id;
            }
        }
        
        // Validate property_type - this maps to PropertyCategory
        if (!empty($data['property_type_name'])) {
            $category = PropertyCategory::where('name', 'like', '%' . trim($data['property_type_name']) . '%')->first();
            if (!$category) {
                $warnings[] = "Property Type '{$data['property_type_name']}' not found (checked as category)";
            } else {
                $data['property_category_id'] = $category->id;
            }
        }
        
        // Validate property_type_2 - this maps to PropertyType
        if (!empty($data['property_type_2_name'])) {
            $propertyType = PropertyType::where('name', 'like', '%' . trim($data['property_type_2_name']) . '%')->first();
            if (!$propertyType) {
                $warnings[] = "Property Type 2 '{$data['property_type_2_name']}' not found (checked as property type)";
            } else {
                $data['property_type_id'] = $propertyType->id;
            }
        }
        
        // Validate property status
        if (!empty($data['property_status_name'])) {
            $status = PropertyStatus::where('name', 'like', '%' . trim($data['property_status_name']) . '%')
                ->orWhere('slug', 'like', '%' . Str::slug(trim($data['property_status_name'])) . '%')
                ->first();
            if (!$status) {
                $warnings[] = "Property Status '{$data['property_status_name']}' not found";
            } else {
                $data['property_status_id'] = $status->id;
            }
        }
        
        // Validate BHK (bedroom option) - handle comma-separated values
        if (!empty($data['bhk_value'])) {
            $bhkValues = array_map('trim', explode(',', $data['bhk_value']));
            $bedroomOptionIds = [];
            $notFoundBhks = [];
            
            foreach ($bhkValues as $bhkValue) {
                if (empty($bhkValue)) {
                    continue;
                }
                
                $bhk = BedroomOption::where('name', 'like', '%' . $bhkValue . '%')
                    ->orWhere('value', 'like', '%' . $bhkValue . '%')
                    ->first();
                
                if ($bhk) {
                    $bedroomOptionIds[] = $bhk->id;
                } else {
                    $notFoundBhks[] = $bhkValue;
                }
            }
            
            if (!empty($notFoundBhks)) {
                $warnings[] = "BHK '" . implode(', ', $notFoundBhks) . "' not found";
            }
            
            if (!empty($bedroomOptionIds)) {
                $data['bedroom_option_ids'] = $bedroomOptionIds;
            }
        }
        
        // Validate numeric fields
        if (!empty($data['price']) && !is_numeric($data['price'])) {
            $errors[] = 'Price must be numeric';
        }
        
        if (!empty($data['area_sq_ft']) && !is_numeric($data['area_sq_ft'])) {
            $errors[] = 'Area must be numeric';
        }
        
        if (!empty($data['rating']) && (!is_numeric($data['rating']) || $data['rating'] < 0 || $data['rating'] > 5)) {
            $errors[] = 'Rating must be a number between 0 and 5';
        }
        
        if (!empty($data['review_count']) && (!is_numeric($data['review_count']) || $data['review_count'] < 0)) {
            $errors[] = 'Review count must be a non-negative number';
        }
        
        // Store validated data
        $data['validated'] = true;
        
        return [
            'errors' => $errors,
            'warnings' => $warnings,
            'data' => $data,
        ];
    }

    /**
     * Create property from validated data
     */
    protected function createProperty($rowData)
    {
        $data = $rowData['data'];
        
        if (!empty($rowData['errors'])) {
            return null;
        }
        
        $slug = \App\Helpers\PropertySlugHelper::build(
            $data['name'] ?? null,
            $data['locality'] ?? null,
            $data['location_id'] ?? null
        );
        
        // Prepare property data
        $propertyData = [
            'name' => $data['name'],
            'slug' => $slug,
            'address' => $data['address'] ?? null,
            'locality' => $data['locality'] ?? null,
            'location_id' => $data['location_id'] ?? null,
            'property_type_id' => $data['property_type_id'] ?? null,
            'property_category_id' => $data['property_category_id'] ?? null,
            'property_condition_id' => $data['property_condition_id'] ?? null,
            'property_status_id' => $data['property_status_id'] ?? null,
            'price' => !empty($data['price']) ? (float)$data['price'] : null,
            'area_sq_ft' => !empty($data['area_sq_ft']) ? (int)$data['area_sq_ft'] : null,
            'rise' => $data['rise'] ?? null,
            'rating' => !empty($data['rating']) ? (float)$data['rating'] : null,
            'review_count' => !empty($data['review_count']) ? (int)$data['review_count'] : 0,
            'rera_reg_no' => $data['rera_reg_no'] ?? null,
            'possession' => $data['possession'] ?? null,
            'airport' => $data['airport'] ?? null,
            'entertainment' => $data['entertainment'] ?? null,
            'national_highway' => $data['national_highway'] ?? null,
            'hospitals' => $data['hospitals'] ?? null,
            'education' => $data['education'] ?? null,
            'is_active' => !empty($data['status']) && strtolower($data['status']) === 'active',
            'is_sold' => !empty($data['status']) && strtolower($data['status']) === 'sold',
        ];
        
        // Debug first import - show SQL query
        $shouldDebug = $this->isFirstImport;
        if ($this->isFirstImport) {
            DB::enableQueryLog();
            $this->isFirstImport = false;
        }
        
        // Create the property
        $property = Property::create($propertyData);
        
        // Debug first import - show SQL query after creation
        if ($shouldDebug) {
            $queries = DB::getQueryLog();
            $insertQuery = array_filter($queries, function($q) {
                return stripos($q['query'], 'insert') !== false;
            });
            
            dd([
                'row_data' => $rowData,
                'property_data' => $propertyData,
                'slug' => $slug,
                'created_property' => $property ? $property->toArray() : null,
                'property_id' => $property ? $property->id : null,
                'all_queries' => $queries,
                'insert_queries' => $insertQuery,
                'last_query' => end($queries),
                'property_exists_after_create' => $property ? Property::find($property->id) : null,
            ]);
        }
        
        // Attach bedroom options if found (can be multiple, comma-separated)
        if (!empty($data['bedroom_option_ids']) && is_array($data['bedroom_option_ids'])) {
            $property->bedroomOptions()->attach($data['bedroom_option_ids']);
        }
        
        return $property;
    }

    /**
     * Get cell value from row
     */
    protected function getCellValue($row, $columnMap, $columnName)
    {
        if (!isset($columnMap[$columnName])) {
            return null;
        }
        
        $index = $columnMap[$columnName];
        return isset($row[$index]) ? trim($row[$index]) : null;
    }

    /**
     * Check if row is empty
     */
    protected function isEmptyRow($row)
    {
        return empty(array_filter($row, fn($cell) => !empty(trim($cell ?? ''))));
    }

    /**
     * Clean numeric value by removing commas and non-numeric characters (except decimal point)
     */
    protected function cleanNumericValue($value)
    {
        if (empty($value)) {
            return null;
        }
        
        // Convert to string and remove commas and any other non-numeric characters except decimal point
        $cleaned = preg_replace('/[^0-9.]/', '', (string)$value);
        
        // Return null if empty, otherwise return the cleaned value
        return empty($cleaned) ? null : $cleaned;
    }

    /**
     * Parse date from Excel
     */
    protected function parseDate($value)
    {
        if (empty($value)) {
            return null;
        }
        
        // If it's an Excel date serial number
        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Exception $e) {
                // Try parsing as regular date
            }
        }
        
        // Try parsing as date string
        try {
            $date = \DateTime::createFromFormat('Y-m-d', $value);
            if ($date) {
                return $date->format('Y-m-d');
            }
            
            $date = \DateTime::createFromFormat('d/m/Y', $value);
            if ($date) {
                return $date->format('Y-m-d');
            }
            
            $date = new \DateTime($value);
            return $date->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}

