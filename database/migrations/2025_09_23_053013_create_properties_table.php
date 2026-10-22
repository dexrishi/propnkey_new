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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->boolean('is_featured')->default(false);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('alias_name')->nullable();
            
            // Relationships
            $table->foreignId('partner_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('agent_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('property_type_id')->nullable()->constrained()->onDelete('set null');
            
            // Rating & Reviews
            $table->decimal('rating', 3, 2)->nullable();
            $table->integer('review_count')->default(0);
            $table->string('badge')->nullable();
            
            // Location Details
            $table->string('locality')->nullable();
            $table->text('address')->nullable();
            $table->string('rera_reg_no')->nullable();
            
            // Sorting
            $table->integer('sort_order')->default(0);
            $table->integer('home_sort')->default(0);
            
            // Pricing
            $table->decimal('price', 15, 2)->nullable();
            $table->enum('price_unit', ['lakhs', 'cr'])->default('lakhs');
            
            // Property Details
            $table->integer('area_sq_ft')->nullable();
            $table->date('possession')->nullable();
            $table->enum('property_status', ['newly_launched', 'ready_to_move', 'under_construction'])->nullable();
            $table->boolean('is_sold')->default(false);
            
            // Descriptions
            $table->text('amenities_description')->nullable();
            $table->longText('property_description')->nullable();
            $table->text('gallery_description')->nullable();
            $table->longText('floor_plan_description')->nullable();
            $table->text('offer_text')->nullable();
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            // Location Features
            $table->text('airport')->nullable();
            $table->text('entertainment')->nullable();
            $table->text('national_highway')->nullable();
            $table->text('hospitals')->nullable();
            $table->text('education')->nullable();
            
            // Project Details
            $table->longText('project_highlights_title')->nullable();
            $table->longText('location_features')->nullable();
            $table->longText('price_list')->nullable();
            
            // Map
            $table->text('map_code')->nullable();
            $table->text('map_text')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};