<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedroomOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope for active bedroom options
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered bedroom options
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get all active bedroom options ordered
     */
    public static function getActiveOptions()
    {
        return static::active()->ordered()->get();
    }

    /**
     * Get the properties for the bedroom option.
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_bedroom_options');
    }
}