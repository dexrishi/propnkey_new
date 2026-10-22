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
        // Drop existing table if it exists
        Schema::dropIfExists('inquiries');
        
        // Create new table with proper structure
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('company', 255)->nullable();
            $table->string('email', 150);
            $table->string('phone', 20);
            $table->text('user_message')->nullable();
            $table->string('project_name', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        
        // Recreate old structure
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('phone', 20);
            $table->string('email', 150);
            $table->text('user_message');
            $table->timestamps();
        });
    }
};
