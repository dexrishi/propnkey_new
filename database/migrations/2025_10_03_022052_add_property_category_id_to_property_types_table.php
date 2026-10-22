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
        Schema::table('property_types', function (Blueprint $table) {
            $table->unsignedBigInteger('property_category_id')->nullable()->after('id');
            $table->foreign('property_category_id')->references('id')->on('property_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_types', function (Blueprint $table) {
            $table->dropForeign(['property_category_id']);
            $table->dropColumn('property_category_id');
        });
    }
};