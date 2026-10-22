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
        Schema::table('inquiries', function (Blueprint $table) {
            if (!Schema::hasColumn('inquiries', 'form_name')) {
                $table->string('form_name', 255)->nullable()->after('project_name');
            }
            if (!Schema::hasColumn('inquiries', 'url')) {
                $table->string('url', 500)->nullable()->after('form_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            if (Schema::hasColumn('inquiries', 'form_name')) {
                $table->dropColumn('form_name');
            }
            if (Schema::hasColumn('inquiries', 'url')) {
                $table->dropColumn('url');
            }
        });
    }
};
