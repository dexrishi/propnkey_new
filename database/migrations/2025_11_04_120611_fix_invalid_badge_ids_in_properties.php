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
        // Fix invalid badge_ids by setting them to null
        // Get all valid badge IDs
        $validBadgeIds = DB::table('badges')->pluck('id')->toArray();
        
        if (empty($validBadgeIds)) {
            // If no badges exist, set all badge_ids to null
            DB::table('properties')
                ->whereNotNull('badge_id')
                ->update(['badge_id' => null]);
        } else {
            // Set badge_id to null for properties with invalid badge_ids
            DB::table('properties')
                ->whereNotNull('badge_id')
                ->whereNotIn('badge_id', $validBadgeIds)
                ->update(['badge_id' => null]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse this migration as we don't know what the original values were
    }
};
