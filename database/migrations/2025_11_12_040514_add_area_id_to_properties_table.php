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
        // Ensure areas table exists first
        if (!Schema::hasTable('areas')) {
            return; // Skip if areas table doesn't exist yet
        }
        
        if (!Schema::hasColumn('properties', 'area_id')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->unsignedBigInteger('area_id')->nullable()->after('location_id');
            });
        }
        
        // Add foreign key constraint separately if it doesn't exist
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'properties' 
            AND COLUMN_NAME = 'area_id' 
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
        
        if (empty($foreignKeys)) {
            // Disable foreign key checks temporarily
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            try {
                DB::statement('ALTER TABLE `properties` ADD CONSTRAINT `properties_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL');
            } finally {
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });
    }
};
