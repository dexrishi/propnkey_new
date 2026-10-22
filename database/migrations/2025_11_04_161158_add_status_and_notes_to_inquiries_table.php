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
        // Check if columns exist before adding
        if (!Schema::hasColumn('inquiries', 'status')) {
            Schema::table('inquiries', function (Blueprint $table) {
                $table->enum('status', ['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'])->default('new')->after('project_name');
            });
        }
        
        if (!Schema::hasColumn('inquiries', 'notes')) {
            Schema::table('inquiries', function (Blueprint $table) {
                $table->text('notes')->nullable()->after('status');
            });
        }
        
        // Update existing records to have default status
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
        Schema::table('inquiries', function (Blueprint $table) {
            if (Schema::hasColumn('inquiries', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('inquiries', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
};
