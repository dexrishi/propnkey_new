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
        // Update any inquiries with NULL or empty status to 'new'
        \DB::table('inquiries')
            ->whereNull('status')
            ->orWhere('status', '')
            ->update(['status' => 'new']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed for data updates
    }
};
