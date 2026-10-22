<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'slug',
        'sort_order',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($area) {
            if (empty($area->slug)) {
                $area->slug = Str::slug($area->name);
            }
        });

        static::updating(function ($area) {
            if ($area->isDirty('name') && empty($area->slug)) {
                $area->slug = Str::slug($area->name);
            }
        });
    }

    /**
     * Generate unique slug
     */
    public function generateSlug()
    {
        $baseSlug = Str::slug($this->name);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Update slug if name changed
     */
    public function updateSlug()
    {
        if ($this->isDirty('name')) {
            $this->slug = $this->generateSlug();
        }
    }

    /**
     * Get the location that owns the area.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the properties for the area.
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Scope for ordering by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get areas for dropdown filtered by location
     */
    public static function getForSelect($locationId = null)
    {
        $query = static::ordered();
        
        if ($locationId) {
            $query->where('location_id', $locationId);
        }
        
        return $query->pluck('name', 'id');
    }
}
