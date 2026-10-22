<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Add bedroom_option_id
            $table->unsignedBigInteger('bedroom_option_id')->nullable()->after('property_type_id');
            $table->foreign('bedroom_option_id')->references('id')->on('bedroom_options')->onDelete('set null');
            
            // Remove bedroom_count and bathroom_count columns
            $table->dropColumn(['bedroom_count', 'bathroom_count']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['bedroom_option_id']);
            $table->dropColumn('bedroom_option_id');
            
            // Add back the old columns
            $table->integer('bedroom_count')->nullable();
            $table->integer('bathroom_count')->nullable();
        });
    }
};