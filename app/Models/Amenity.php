<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active amenities
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get amenities for dropdown
     */
    public static function getForSelect()
    {
        return static::active()
            ->ordered()
            ->pluck('name', 'id');
    }

    /**
     * Get icon HTML
     */
    public function getIconHtmlAttribute()
    {
        if ($this->icon) {
            return '<i class="' . $this->icon . '"></i>';
        }
        return '<i class="bi bi-star"></i>';
    }
}