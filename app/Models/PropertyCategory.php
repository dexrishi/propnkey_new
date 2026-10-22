<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PropertyCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'heading',
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

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Scope to get active categories.
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
     * Get the category's heading or fallback to name.
     */
    public function getDisplayHeadingAttribute()
    {
        return $this->heading ?: $this->name;
    }

    /**
     * Get the category's description excerpt.
     */
    public function getExcerptAttribute()
    {
        if ($this->description) {
            return Str::limit(strip_tags($this->description), 200);
        }
        
        return null;
    }

    /**
     * Get the properties for the category.
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get the active properties for the category.
     */
    public function activeProperties()
    {
        return $this->hasMany(Property::class)->where('is_active', true);
    }

    /**
     * Get the latest properties for the category.
     */
    public function latestProperties($limit = 6)
    {
        return $this->hasMany(Property::class)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit($limit);
    }
}