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
        // Ensure badges table exists first
        if (!Schema::hasTable('badges')) {
            Schema::create('badges', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        // Drop the old badge column if it exists
        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'badge')) {
                $table->dropColumn('badge');
            }
        });

        // Add badge_id column if it doesn't exist (separate operation)
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'badge_id')) {
                $table->unsignedBigInteger('badge_id')->nullable()->after('review_count');
            }
        });

        // Add foreign key constraint - skip for now if there are issues
        // The column will be added without foreign key constraint to avoid MySQL 1824 error
        // Foreign key can be added manually later if needed:
        // ALTER TABLE `properties` ADD FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE SET NULL;
        
        // Attempt to add foreign key, but don't fail if it can't be added
        if (Schema::hasColumn('properties', 'badge_id')) {
            try {
                // Use explicit database name to avoid cross-database issues
                $databaseName = DB::connection()->getDatabaseName();
                $foreignKeys = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM information_schema.KEY_COLUMN_USAGE 
                    WHERE TABLE_SCHEMA = ? 
                    AND TABLE_NAME = 'properties' 
                    AND COLUMN_NAME = 'badge_id' 
                    AND REFERENCED_TABLE_NAME = 'badges'
                ", [$databaseName]);
                
                if (empty($foreignKeys)) {
                    // Try adding the foreign key
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    DB::statement('ALTER TABLE `properties` ADD FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE SET NULL');
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                }
            } catch (\Exception $e) {
                // If foreign key can't be added, log it but don't fail the migration
                // The column will still be added successfully
                \Log::warning('Could not add foreign key constraint for properties.badge_id: ' . $e->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop foreign key and badge_id column
            if (Schema::hasColumn('properties', 'badge_id')) {
                $table->dropForeign(['badge_id']);
                $table->dropColumn('badge_id');
            }
            
            // Restore badge column
            if (!Schema::hasColumn('properties', 'badge')) {
                $table->string('badge')->nullable()->after('review_count');
            }
        });
    }
};
