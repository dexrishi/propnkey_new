<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Support\AdminPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(UserPermission::class);
    }

    /**
     * Permission keys assigned to this user.
     */
    public function permissionKeys(): array
    {
        if ($this->isSuperAdmin()) {
            return AdminPermissions::allKeys();
        }

        if ($this->relationLoaded('permissions')) {
            return $this->permissions->pluck('permission')->unique()->values()->all();
        }

        return $this->permissions()->pluck('permission')->unique()->values()->all();
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return in_array($permission, $this->permissionKeys(), true);
    }

    public function hasAnyPermission(array $permissions): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Replace all assignable permissions for this user.
     */
    public function syncPermissions(array $permissions): void
    {
        $allowed = AdminPermissions::assignableKeys();
        $permissions = array_values(array_unique(array_intersect($permissions, $allowed)));

        $this->permissions()->delete();

        foreach ($permissions as $permission) {
            $this->permissions()->create(['permission' => $permission]);
        }
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is SEO
     */
    public function isSeo(): bool
    {
        return $this->role === 'seo';
    }

    /**
     * SEO staff can create and update but never delete.
     */
    public function canDelete(): bool
    {
        return !$this->isSeo();
    }

    /**
     * Scope for super admins
     */
    public function scopeSuperAdmins($query)
    {
        return $query->where('role', 'super_admin');
    }

    /**
     * Scope for admins
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope for SEO users
     */
    public function scopeSeoUsers($query)
    {
        return $query->where('role', 'seo');
    }
}
