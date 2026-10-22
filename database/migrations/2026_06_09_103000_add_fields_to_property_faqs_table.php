<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_faqs', function (Blueprint $table) {
            if (!Schema::hasColumn('property_faqs', 'property_id')) {
                $table->foreignId('property_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            }

            if (!Schema::hasColumn('property_faqs', 'question')) {
                $table->string('question')->nullable()->after('property_id');
            }

            if (!Schema::hasColumn('property_faqs', 'answer')) {
                $table->text('answer')->nullable()->after('question');
            }

            if (!Schema::hasColumn('property_faqs', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0)->after('answer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('property_faqs', function (Blueprint $table) {
            if (Schema::hasColumn('property_faqs', 'property_id')) {
                $table->dropForeign(['property_id']);
                $table->dropColumn('property_id');
            }

            foreach (['question', 'answer', 'sort_order'] as $column) {
                if (Schema::hasColumn('property_faqs', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};