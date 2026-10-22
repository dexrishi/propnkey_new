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
        // Double-check and add columns if they don't exist (using raw SQL for robustness)
        if (!Schema::hasColumn('inquiries', 'status')) {
            \DB::statement("ALTER TABLE `inquiries` ADD COLUMN `status` ENUM('new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost') NOT NULL DEFAULT 'new' AFTER `project_name`");
        }
        
        if (!Schema::hasColumn('inquiries', 'notes')) {
            \DB::statement("ALTER TABLE `inquiries` ADD COLUMN `notes` TEXT NULL AFTER `status`");
        }
        
        // Update existing records
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
        // No rollback needed - this is a verification migration
    }
};
