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
        // Check and drop foreign key constraints if they exist
        $constraints = \DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'property_types' AND CONSTRAINT_NAME LIKE '%foreign'");
        
        foreach ($constraints as $constraint) {
            if (strpos($constraint->CONSTRAINT_NAME, 'property_condition_id') !== false || 
                strpos($constraint->CONSTRAINT_NAME, 'property_category_id') !== false) {
                \DB::statement("ALTER TABLE property_types DROP FOREIGN KEY {$constraint->CONSTRAINT_NAME}");
            }
        }
        
        Schema::table('property_types', function (Blueprint $table) {
            // Drop the columns
            $table->dropColumn(['property_category_id', 'property_condition_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_types', function (Blueprint $table) {
            $table->unsignedBigInteger('property_category_id')->nullable()->after('id');
            $table->unsignedBigInteger('property_condition_id')->nullable()->after('property_category_id');
            
            // Add foreign key constraints
            $table->foreign('property_category_id')->references('id')->on('property_categories')->onDelete('set null');
            $table->foreign('property_condition_id')->references('id')->on('property_conditions')->onDelete('set null');
        });
    }
};