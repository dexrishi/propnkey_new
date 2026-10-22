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
            // Residential-specific fields
            $table->enum('rise', ['high', 'low'])->nullable()->after('area_sq_ft');
            $table->integer('bedroom_count')->nullable()->after('rise');
            $table->integer('bathroom_count')->nullable()->after('bedroom_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['rise', 'bedroom_count', 'bathroom_count']);
        });
    }
};
