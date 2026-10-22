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
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->enum('type', ['logo', 'project', 'floor_plan'])->default('project');
            $table->string('alt_type')->nullable(); // floor_plan, interior, exterior, etc.
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->boolean('is_banner')->default(false);
            $table->boolean('is_thumbnail')->default(false);
            $table->boolean('is_thumbnail_2')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes for better performance
            $table->index(['property_id', 'type']);
            $table->index(['property_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};