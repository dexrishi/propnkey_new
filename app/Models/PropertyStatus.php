<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PropertyStatus extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'sort_order',
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

        static::creating(function ($status) {
            if (empty($status->slug)) {
                $status->slug = Str::slug($status->name);
            }
        });

        static::updating(function ($status) {
            if ($status->isDirty('name') && empty($status->slug)) {
                $status->slug = Str::slug($status->name);
            }
        });
    }

    /**
     * Scope to get active statuses.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort_order, then by name.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Get the properties for this status.
     */
    public function properties()
    {
        return $this->hasMany(Property::class, 'property_status_id');
    }
}
