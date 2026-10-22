<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'meta_title',
        'meta_description',
        'heading',
        'site_description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            if (empty($location->slug)) {
                $location->slug = Str::slug($location->name);
            }
        });

        static::updating(function ($location) {
            if ($location->isDirty('name') && empty($location->slug)) {
                $location->slug = Str::slug($location->name);
            }
        });
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * Scope for active locations
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
     * Get locations for dropdown
     */
    public static function getForSelect()
    {
        return static::active()
            ->ordered()
            ->pluck('name', 'id');
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
     * Get the properties for the location.
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get the active properties for the location.
     */
    public function activeProperties()
    {
        return $this->hasMany(Property::class)->where('is_active', true);
    }

    /**
     * Locations that have at least one active property with the given rise.
     */
    public function scopeWithActiveRiseProperties($query, string $rise)
    {
        return $query->whereHas('properties', function ($q) use ($rise) {
            $q->where('is_active', true)->where('rise', $rise);
        });
    }

    /**
     * Active locations that have listed properties for a rise type.
     */
    public static function withListedRiseProperties(string $rise)
    {
        return static::active()
            ->withActiveRiseProperties($rise)
            ->ordered()
            ->get();
    }

    /**
     * Canonical URL for rise + location listing (e.g. high-rise-properties-in-gurgaon).
     */
    public function risePropertiesUrl(string $rise): ?string
    {
        $riseSlug = Property::riseUrlSlug($rise);

        if (!$riseSlug) {
            return null;
        }

        return route('rise.location.properties', [
            'rise_slug' => $riseSlug,
            'location_slug' => $this->slug,
        ]);
    }
}