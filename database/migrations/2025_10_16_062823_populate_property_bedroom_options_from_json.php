<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Populate the pivot table from the bedroom_configs JSON field
        DB::table('properties')->whereNotNull('bedroom_configs')->orderBy('id')->chunk(100, function ($properties) {
            foreach ($properties as $property) {
                $bedroomConfigs = json_decode($property->bedroom_configs, true);
                
                if (is_array($bedroomConfigs)) {
                    foreach ($bedroomConfigs as $bedroomOptionId) {
                        // Insert into pivot table if not already exists
                        DB::table('property_bedroom_options')->updateOrInsert(
                            [
                                'property_id' => $property->id,
                                'bedroom_option_id' => $bedroomOptionId
                            ],
                            [
                                'created_at' => now(),
                                'updated_at' => now()
                            ]
                        );
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Clear the pivot table
        DB::table('property_bedroom_options')->truncate();
    }
};
