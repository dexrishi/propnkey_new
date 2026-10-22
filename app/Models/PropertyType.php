<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'heading',
        'description',
        'meta_title',
        'meta_description',
        'sort_order',
        'is_active',
        'property_category_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the property category that owns the property type.
     */
    public function propertyCategory()
    {
        return $this->belongsTo(PropertyCategory::class);
    }

    /**
     * Get the properties for the property type.
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }


    /**
     * Scope to get active property types.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort order and name.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}