<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('slug_list', 'faq_items')) {
            Schema::table('slug_list', function (Blueprint $table) {
                $table->json('faq_items')->nullable()->after('bottom_description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('slug_list', 'faq_items')) {
            Schema::table('slug_list', function (Blueprint $table) {
                $table->dropColumn('faq_items');
            });
        }
    }
};