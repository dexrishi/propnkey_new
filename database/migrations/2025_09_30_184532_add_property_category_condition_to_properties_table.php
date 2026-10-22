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
            $table->unsignedBigInteger('property_category_id')->nullable()->after('property_type_id');
            $table->unsignedBigInteger('property_condition_id')->nullable()->after('property_category_id');
            
            // Add foreign key constraints
            $table->foreign('property_category_id')->references('id')->on('property_categories')->onDelete('set null');
            $table->foreign('property_condition_id')->references('id')->on('property_conditions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['property_category_id']);
            $table->dropForeign(['property_condition_id']);
            $table->dropColumn(['property_category_id', 'property_condition_id']);
        });
    }
};