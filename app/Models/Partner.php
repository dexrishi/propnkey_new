<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'slug',
        'image',
        'sort_order',
        'is_active',
        'sub_heading',
        'description',
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

        static::creating(function ($partner) {
            if (empty($partner->slug)) {
                $partner->slug = Str::slug($partner->name);
            }
        });

        static::updating(function ($partner) {
            if ($partner->isDirty('name') && empty($partner->slug)) {
                $partner->slug = Str::slug($partner->name);
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
     * Scope for active partners
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
     * Get partners for dropdown
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
     * Get the properties for the partner.
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get the active properties for the partner.
     */
    public function activeProperties()
    {
        return $this->hasMany(Property::class)->where('is_active', true);
    }
}