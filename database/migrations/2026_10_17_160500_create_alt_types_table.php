<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alt_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $defaults = [
            'Interior',
            'Exterior',
            'Amenity',
            'Landscape',
            'Lobby',
            'Garden',
            'Parking',
            'Balcony',
            'Kitchen',
            'Bedroom',
            'Living Room',
            'Bathroom',
            'Floor Plan',
        ];

        $now = now();
        foreach ($defaults as $index => $name) {
            DB::table('alt_types')->insert([
                'name' => $name,
                'slug' => Str::slug($name, '_'),
                'sort_order' => $index + 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Grant alt-types permission to SEO users (and anyone who already has properties)
        if (Schema::hasTable('user_permissions')) {
            $userIds = User::query()
                ->where(function ($q) {
                    $q->where('role', 'seo')
                        ->orWhere('role', 'admin')
                        ->orWhere('role', 'super_admin');
                })
                ->pluck('id');

            foreach ($userIds as $userId) {
                $exists = DB::table('user_permissions')
                    ->where('user_id', $userId)
                    ->where('permission', 'alt-types')
                    ->exists();

                if (!$exists) {
                    // Only auto-grant to SEO by default; admin/super_admin already get all via role checks
                    $user = User::find($userId);
                    if ($user && $user->isSeo()) {
                        DB::table('user_permissions')->insert([
                            'user_id' => $userId,
                            'permission' => 'alt-types',
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    } elseif ($user && !$user->isSuperAdmin()) {
                        // Admin users: add if they have properties permission (typical full access)
                        $hasProperties = DB::table('user_permissions')
                            ->where('user_id', $userId)
                            ->where('permission', 'properties')
                            ->exists();
                        if ($hasProperties) {
                            DB::table('user_permissions')->insert([
                                'user_id' => $userId,
                                'permission' => 'alt-types',
                                'created_at' => $now,
                                'updated_at' => $now,
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('user_permissions')) {
            DB::table('user_permissions')->where('permission', 'alt-types')->delete();
        }

        Schema::dropIfExists('alt_types');
    }
};
