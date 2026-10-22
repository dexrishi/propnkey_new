<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class UpdatePropertyPricesFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:update-prices-from-json {--dry-run : Run without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update property prices from old.json file based on price and price_type (Cr. or Lakhs)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        $this->info('Starting price update from old.json...');
        
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
        $updatedCount = 0;
        $notFoundCount = 0;
        $skippedCount = 0;
        
        foreach ($properties as $index => $oldProperty) {
            $slug = $oldProperty['slug'] ?? null;
            
            if (!$slug) {
                $this->warn("Skipping property at index {$index}: No slug found");
                $skippedCount++;
                continue;
            }
            
            // Check if price and price_type exist
            if (!isset($oldProperty['price']) || !isset($oldProperty['price_type'])) {
                $this->line("Skipping property '{$oldProperty['name']}' (slug: {$slug}): Missing price or price_type");
                $skippedCount++;
                continue;
            }
            
            $price = $oldProperty['price'];
            $priceType = trim($oldProperty['price_type']);
            
            // Skip if price is empty or invalid
            if (empty($price) || !is_numeric($price)) {
                $this->line("Skipping property '{$oldProperty['name']}' (slug: {$slug}): Invalid price value");
                $skippedCount++;
                continue;
            }
            
            try {
                // Find property by slug
                $property = Property::where('slug', $slug)->first();
                
                if (!$property) {
                    $this->warn("Property not found: {$oldProperty['name']} (slug: {$slug})");
                    $notFoundCount++;
                    continue;
                }
                
                // Convert price based on price_type
                $convertedPrice = $this->convertPrice($price, $priceType);
                
                if ($convertedPrice === null) {
                    $this->warn("Unknown price type '{$priceType}' for property: {$oldProperty['name']} (slug: {$slug})");
                    $skippedCount++;
                    continue;
                }
                
                $oldPrice = $property->price;
                
                $this->line("Processing: {$oldProperty['name']} (slug: {$slug})");
                $this->line("  Price: {$price} {$priceType} → {$convertedPrice} (old: " . ($oldPrice ?? 'null') . ")");
                
                // Update price
                if (!$dryRun) {
                    $property->update(['price' => $convertedPrice]);
                    $updatedCount++;
                    $this->info("  ✓ Updated successfully");
                } else {
                    $this->line("  [DRY RUN] Would update price to: {$convertedPrice}");
                }
                
                $successCount++;
                
            } catch (\Exception $e) {
                $this->error("  ✗ Error processing '{$oldProperty['name']}' (slug: {$slug}): " . $e->getMessage());
                $errorCount++;
            }
        }
        
        $this->newLine();
        $this->info('=== Price Update Summary ===');
        $this->info("Successfully processed: {$successCount}");
        if (!$dryRun) {
            $this->info("  - Updated: {$updatedCount}");
        }
        $this->info("Not found: {$notFoundCount}");
        $this->info("Skipped: {$skippedCount}");
        $this->info("Errors: {$errorCount}");
        
        if ($dryRun) {
            $this->warn('This was a DRY RUN - no changes were made');
        }
        
        return 0;
    }
    
    /**
     * Convert price based on price type
     * 
     * @param float|string $price
     * @param string $priceType
     * @return float|null
     */
    private function convertPrice($price, $priceType)
    {
        $price = (float) $price;
        
        // Normalize price type (handle variations)
        $priceType = trim($priceType);
        $priceTypeLower = strtolower($priceType);
        
        // Handle Crores (Cr., Crore, Crores, etc.)
        if (in_array($priceTypeLower, ['cr.', 'cr', 'crore', 'crores'])) {
            // 1 Crore = 10,000,000
            return $price * 10000000;
        }
        
        // Handle Lakhs (Lakhs, Lakh, Lacs, Lac, etc.)
        if (in_array($priceTypeLower, ['lakhs', 'lakh', 'lacs', 'lac', 'l'])) {
            // 1 Lakh = 100,000
            return $price * 100000;
        }
        
        // Unknown price type
        return null;
    }
}

