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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('action', 50); // create, update, delete
            $table->string('model_type'); // e.g., App\Models\Property
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('model_name')->nullable(); // Human readable name
            $table->json('old_values')->nullable(); // Previous values before update
            $table->json('new_values')->nullable(); // New values after update
            $table->json('changes')->nullable(); // Only changed fields
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            // Indexes (action limited to 50 chars for index compatibility)
            $table->index('model_id');
            $table->index('user_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
