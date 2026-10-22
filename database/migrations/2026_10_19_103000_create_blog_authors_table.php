<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('photo')->nullable();
            $table->text('bio');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->foreignId('blog_author_id')
                ->nullable()
                ->after('blog_category_id')
                ->constrained('blog_authors')
                ->nullOnDelete();
        });

        if (!Schema::hasTable('user_permissions')) {
            return;
        }

        $now = now();
        $userIds = User::query()
            ->whereIn('role', ['admin', 'seo'])
            ->pluck('id');

        foreach ($userIds as $userId) {
            $exists = DB::table('user_permissions')
                ->where('user_id', $userId)
                ->where('permission', 'blog-authors')
                ->exists();

            if (!$exists) {
                DB::table('user_permissions')->insert([
                    'user_id' => $userId,
                    'permission' => 'blog-authors',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('user_permissions')) {
            DB::table('user_permissions')->where('permission', 'blog-authors')->delete();
        }

        Schema::table('blog_posts', function (Blueprint $table) {
            if (Schema::hasColumn('blog_posts', 'blog_author_id')) {
                $table->dropConstrainedForeignId('blog_author_id');
            }
        });

        Schema::dropIfExists('blog_authors');
    }
};
