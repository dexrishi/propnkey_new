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
        Schema::create('bedroom_options', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "1 BHK", "2 BHK", "3 BHK", etc.
            $table->string('value'); // e.g., "1", "2", "3", etc.
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bedroom_options');
    }
};