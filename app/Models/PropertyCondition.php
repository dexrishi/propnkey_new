<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PropertyCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($condition) {
            if (empty($condition->slug)) {
                $condition->slug = Str::slug($condition->name);
            }
        });

        static::updating(function ($condition) {
            if ($condition->isDirty('name') && empty($condition->slug)) {
                $condition->slug = Str::slug($condition->name);
            }
        });
    }

    /**
     * Scope to get active conditions.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by name.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }
}