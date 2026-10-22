<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Support\AdminPermissions;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('permission', 100);
            $table->timestamps();

            $table->unique(['user_id', 'permission']);
            $table->index('permission');
        });

        // Seed existing users so current access is preserved
        $now = now();
        $users = DB::table('users')->select('id', 'role')->get();

        foreach ($users as $user) {
            if ($user->role === 'super_admin') {
                continue; // Super admin always has full access
            }

            $permissions = AdminPermissions::defaultsForRole($user->role ?: 'admin');
            $rows = [];
            foreach ($permissions as $permission) {
                $rows[] = [
                    'user_id' => $user->id,
                    'permission' => $permission,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($rows)) {
                DB::table('user_permissions')->insert($rows);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};
