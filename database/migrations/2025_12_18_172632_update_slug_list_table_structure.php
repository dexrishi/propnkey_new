<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if columns exist before modifying
        $hasUrl = Schema::hasColumn('slug_list', 'url');
        $hasHeading = Schema::hasColumn('slug_list', 'heading');
        $hasMetaDescription = Schema::hasColumn('slug_list', 'meta_description');
        
        if ($hasUrl) {
            // Add new slug column
            Schema::table('slug_list', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('id');
            });
            
            // Copy data
            DB::statement('UPDATE slug_list SET slug = url WHERE slug IS NULL');
            
            // Make slug required and unique, then drop url
            Schema::table('slug_list', function (Blueprint $table) {
                $table->string('slug')->nullable(false)->unique()->change();
                $table->dropColumn('url');
            });
        }
        
        if ($hasHeading) {
            // Add new headline column
            Schema::table('slug_list', function (Blueprint $table) {
                $table->string('headline')->nullable()->after('meta_title');
            });
            
            // Copy data
            DB::statement('UPDATE slug_list SET headline = heading WHERE headline IS NULL');
            
            // Drop old column
            Schema::table('slug_list', function (Blueprint $table) {
                $table->dropColumn('heading');
            });
        }
        
        if ($hasMetaDescription) {
            // Add new meta_desc column
            Schema::table('slug_list', function (Blueprint $table) {
                $table->text('meta_desc')->nullable()->after('headline');
            });
            
            // Copy data
            DB::statement('UPDATE slug_list SET meta_desc = meta_description WHERE meta_desc IS NULL');
            
            // Drop old column
            Schema::table('slug_list', function (Blueprint $table) {
                $table->dropColumn('meta_description');
            });
        }
        
        // Add new fields
        if (!Schema::hasColumn('slug_list', 'bottom_headline')) {
        Schema::table('slug_list', function (Blueprint $table) {
                $table->string('bottom_headline')->nullable()->after('description');
            });
        }
        
        if (!Schema::hasColumn('slug_list', 'bottom_description')) {
            Schema::table('slug_list', function (Blueprint $table) {
                $table->longText('bottom_description')->nullable()->after('bottom_headline');
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $hasSlug = Schema::hasColumn('slug_list', 'slug');
        $hasHeadline = Schema::hasColumn('slug_list', 'headline');
        $hasMetaDesc = Schema::hasColumn('slug_list', 'meta_desc');
        
        // Drop new fields
        if (Schema::hasColumn('slug_list', 'bottom_description')) {
            Schema::table('slug_list', function (Blueprint $table) {
                $table->dropColumn('bottom_description');
            });
        }
        
        if (Schema::hasColumn('slug_list', 'bottom_headline')) {
            Schema::table('slug_list', function (Blueprint $table) {
                $table->dropColumn('bottom_headline');
            });
        }
        
        if ($hasSlug) {
            // Add back url column
            Schema::table('slug_list', function (Blueprint $table) {
                $table->string('url')->nullable()->after('id');
            });
            
            // Copy data back
            DB::statement('UPDATE slug_list SET url = slug WHERE url IS NULL');
            
            // Make url required and unique, then drop slug
            Schema::table('slug_list', function (Blueprint $table) {
                $table->string('url')->nullable(false)->unique()->change();
                $table->dropColumn('slug');
            });
        }
        
        if ($hasHeadline) {
            // Add back heading column
            Schema::table('slug_list', function (Blueprint $table) {
                $table->string('heading')->nullable()->after('meta_title');
            });
            
            // Copy data back
            DB::statement('UPDATE slug_list SET heading = headline WHERE heading IS NULL');
            
            // Drop headline
            Schema::table('slug_list', function (Blueprint $table) {
                $table->dropColumn('headline');
            });
        }
        
        if ($hasMetaDesc) {
            // Add back meta_description column
            Schema::table('slug_list', function (Blueprint $table) {
                $table->text('meta_description')->nullable()->after('heading');
            });
            
            // Copy data back
            DB::statement('UPDATE slug_list SET meta_description = meta_desc WHERE meta_description IS NULL');
            
            // Drop meta_desc
        Schema::table('slug_list', function (Blueprint $table) {
                $table->dropColumn('meta_desc');
        });
        }
    }
};
