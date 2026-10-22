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
        Schema::table('properties', function (Blueprint $table) {
            // Rent-specific fields
            $table->decimal('monthly_rent', 15, 2)->nullable()->after('price');
            $table->decimal('security_deposit', 15, 2)->nullable()->after('monthly_rent');
            $table->decimal('one_time_fees', 15, 2)->nullable()->after('security_deposit');
            $table->decimal('total_payable', 15, 2)->nullable()->after('one_time_fees');
            $table->text('rent_includes')->nullable()->after('total_payable');
            $table->text('rent_excludes')->nullable()->after('rent_includes');
            $table->text('rental_process')->nullable()->after('rent_excludes');
            $table->text('dos_donts')->nullable()->after('rental_process');
            $table->integer('lock_in_period_days')->nullable()->after('dos_donts');
            $table->integer('notice_period_days')->nullable()->after('lock_in_period_days');
            $table->text('terms_conditions')->nullable()->after('notice_period_days');
            $table->boolean('is_rental')->default(false)->after('terms_conditions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'monthly_rent',
                'security_deposit', 
                'one_time_fees',
                'total_payable',
                'rent_includes',
                'rent_excludes',
                'rental_process',
                'dos_donts',
                'lock_in_period_days',
                'notice_period_days',
                'terms_conditions',
                'is_rental'
            ]);
        });
    }
};
