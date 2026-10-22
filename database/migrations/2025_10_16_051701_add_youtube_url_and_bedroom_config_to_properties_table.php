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
        Schema::table('properties', function (Blueprint $table) {
            // Add YouTube URL field if it doesn't exist
            if (!Schema::hasColumn('properties', 'youtube_url')) {
                $table->string('youtube_url')->nullable()->after('property_description');
            }
            
            // Add bedroom_configs if it doesn't exist
            if (!Schema::hasColumn('properties', 'bedroom_configs')) {
                $table->json('bedroom_configs')->nullable()->after('bedroom_option_id');
            }
        });
        
        // Migrate existing bedroom_option_id data to bedroom_configs
        DB::table('properties')->whereNotNull('bedroom_option_id')->orderBy('id')->chunk(100, function ($properties) {
            foreach ($properties as $property) {
                if ($property->bedroom_option_id) {
                    DB::table('properties')
                        ->where('id', $property->id)
                        ->update(['bedroom_configs' => json_encode([$property->bedroom_option_id])]);
                }
            }
        });
        
        // Drop the old bedroom_option_id column if it exists
        if (Schema::hasColumn('properties', 'bedroom_option_id')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropForeign(['bedroom_option_id']);
                $table->dropColumn('bedroom_option_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Add back bedroom_option_id column
            $table->foreignId('bedroom_option_id')->nullable()->constrained('bedroom_options')->onDelete('set null');
        });
        
        // Migrate bedroom_configs data back to bedroom_option_id (take first value)
        DB::table('properties')->whereNotNull('bedroom_configs')->orderBy('id')->chunk(100, function ($properties) {
            foreach ($properties as $property) {
                $configs = json_decode($property->bedroom_configs, true);
                if (is_array($configs) && !empty($configs)) {
                    DB::table('properties')
                        ->where('id', $property->id)
                        ->update(['bedroom_option_id' => $configs[0]]);
                }
            }
        });
        
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['youtube_url', 'bedroom_configs']);
        });
    }
};
