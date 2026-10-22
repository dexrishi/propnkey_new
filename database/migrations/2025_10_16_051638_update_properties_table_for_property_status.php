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
        // Check if property_status_id column already exists
        if (!Schema::hasColumn('properties', 'property_status_id')) {
            Schema::table('properties', function (Blueprint $table) {
                // Add new foreign key column
                $table->foreignId('property_status_id')->nullable()->after('property_status');
            });
        }
        
        // Migrate existing data
        $statuses = [
            'newly_launched' => 'Newly Launched',
            'ready_to_move' => 'Ready to Move',
            'under_construction' => 'Under Construction'
        ];
        
        foreach ($statuses as $slug => $name) {
            // Check if status already exists
            if (!DB::table('property_statuses')->where('slug', $slug)->exists()) {
                DB::table('property_statuses')->insert([
                    'name' => $name,
                    'slug' => $slug,
                    'is_active' => true,
                    'sort_order' => array_search($slug, array_keys($statuses)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        // Update properties table to use new foreign key (skip if already done)
        if (Schema::hasColumn('properties', 'property_status')) {
            foreach ($statuses as $slug => $name) {
                $statusId = DB::table('property_statuses')->where('slug', $slug)->value('id');
                DB::table('properties')
                    ->where('property_status', $slug)
                    ->update(['property_status_id' => $statusId]);
            }
            
            // Drop the old enum column
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn('property_status');
            });
        }
        
        // Skip foreign key constraint for now - will add manually later
        // Schema::table('properties', function (Blueprint $table) {
        //     $table->foreign('property_status_id')->references('id')->on('property_statuses')->onDelete('set null');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Add back the enum column
            $table->enum('property_status', ['newly_launched', 'ready_to_move', 'under_construction'])->nullable();
        });
        
        // Migrate data back to enum
        $statuses = [
            'newly_launched' => 'Newly Launched',
            'ready_to_move' => 'Ready to Move',
            'under_construction' => 'Under Construction'
        ];
        
        foreach ($statuses as $slug => $name) {
            $statusId = DB::table('property_statuses')->where('slug', $slug)->value('id');
            DB::table('properties')
                ->where('property_status_id', $statusId)
                ->update(['property_status' => $slug]);
        }
        
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['property_status_id']);
            $table->dropColumn('property_status_id');
        });
        
        // Drop the property_statuses table
        Schema::dropIfExists('property_statuses');
    }
};
