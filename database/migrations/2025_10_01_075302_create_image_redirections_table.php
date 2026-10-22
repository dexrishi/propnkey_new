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
        Schema::create('image_redirections', function (Blueprint $table) {
            $table->id();
            $table->string('old_path')->unique(); // uploads/filename.jpg
            $table->string('new_path'); // properties/1/project/uuid.jpg
            $table->string('original_filename'); // filename.jpg
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('image_type')->default('project'); // project, logo, floor_plan
            $table->unsignedBigInteger('property_image_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('redirect_count')->default(0);
            $table->timestamp('last_redirected_at')->nullable();
            $table->timestamps();
            
            $table->index(['old_path']);
            $table->index(['property_id']);
            $table->index(['is_active']);
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('property_image_id')->references('id')->on('property_images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_redirections');
    }
};