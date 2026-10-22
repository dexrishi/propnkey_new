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
        // Add the new site config for similar properties budget range
        DB::table('site_configs')->insert([
            'label' => 'similar_properties_budget_range',
            'content' => '20',
            'description' => 'Budget range percentage for similar properties (e.g., 20 means 20% less to 20% more)',
            'type' => 'text',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_configs')->where('label', 'similar_properties_budget_range')->delete();
    }
};
