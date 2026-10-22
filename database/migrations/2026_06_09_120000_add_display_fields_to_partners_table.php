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
        Schema::table('partners', function (Blueprint $table) {
            if (!Schema::hasColumn('partners', 'display_name')) {
                $table->string('display_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('partners', 'sub_heading')) {
                $table->string('sub_heading')->nullable()->after('display_name');
            }
            if (!Schema::hasColumn('partners', 'description')) {
                $table->text('description')->nullable()->after('sub_heading');
            }
        });
        // Backfill display_name and sub_heading for existing partners
        try {
            \DB::statement("UPDATE partners SET display_name = name WHERE display_name IS NULL OR display_name = ''");
            \DB::statement("UPDATE partners SET sub_heading = CONCAT('Discover premium properties by ', name, '.') WHERE sub_heading IS NULL OR sub_heading = ''");
        } catch (\Exception $e) {
            // Ignore errors during deploy; admin can update later
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            if (Schema::hasColumn('partners', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('partners', 'sub_heading')) {
                $table->dropColumn('sub_heading');
            }
            if (Schema::hasColumn('partners', 'display_name')) {
                $table->dropColumn('display_name');
            }
        });
    }
};
