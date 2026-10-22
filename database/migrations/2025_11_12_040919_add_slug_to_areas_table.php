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
        if (!Schema::hasColumn('areas', 'slug')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->string('slug', 191)->nullable()->after('name');
            });
        } else {
            // If column exists, ensure it's the right length
            DB::statement('ALTER TABLE `areas` MODIFY COLUMN `slug` VARCHAR(191) NULL');
        }
        
        // Check if unique index exists before adding
        $indexes = DB::select("
            SELECT INDEX_NAME 
            FROM information_schema.STATISTICS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'areas' 
            AND INDEX_NAME = 'areas_slug_unique'
        ");
        
        if (empty($indexes)) {
            // Use raw SQL to create unique index with specific length
            DB::statement('CREATE UNIQUE INDEX `areas_slug_unique` ON `areas` (`slug`(191))');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
