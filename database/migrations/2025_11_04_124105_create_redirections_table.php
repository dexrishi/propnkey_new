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
        Schema::create('redirections', function (Blueprint $table) {
            $table->id();
            $table->string('from_url', 191); // Relative URL (e.g., /old-page) - limited to 191 for index compatibility
            $table->string('to_url', 500); // Can be relative (/new-page) or full URL (https://example.com/page)
            $table->enum('type', ['301', '302'])->default('301'); // 301 Permanent or 302 Temporary
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Index for faster lookups
            $table->index('from_url');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redirections');
    }
};
