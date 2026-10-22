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
        // Ensure footer_categories table exists first
        if (!Schema::hasTable('footer_categories')) {
            Schema::create('footer_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('sort')->default(0);
                $table->timestamps();
            });
        }

        Schema::table('footer_items', function (Blueprint $table) {
            // Add footer_category_id column if it doesn't exist
            if (!Schema::hasColumn('footer_items', 'footer_category_id')) {
                $table->unsignedBigInteger('footer_category_id')->nullable()->after('id');
            }
        });

        // Add foreign key separately to avoid issues
        if (Schema::hasTable('footer_categories') && Schema::hasColumn('footer_items', 'footer_category_id')) {
            try {
                Schema::table('footer_items', function (Blueprint $table) {
                    $table->foreign('footer_category_id')->references('id')->on('footer_categories')->onDelete('set null');
                });
            } catch (\Exception $e) {
                // Foreign key might already exist, ignore
            }
        }

        // Drop columns if they exist
        Schema::table('footer_items', function (Blueprint $table) {
            if (Schema::hasColumn('footer_items', 'slug')) {
                $table->dropColumn('slug');
            }
            
            if (Schema::hasColumn('footer_items', 'category_name')) {
                $table->dropColumn('category_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('footer_items', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['footer_category_id']);
            $table->dropColumn('footer_category_id');
            
            // Re-add slug column
            $table->string('slug')->unique()->after('title');
            
            // Re-add category_name column
            $table->string('category_name')->nullable()->after('sorting');
        });
    }
};
