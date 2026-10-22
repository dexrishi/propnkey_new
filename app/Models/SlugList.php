<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugList extends Model
{
    use HasFactory;

    protected $table = 'slug_list';

    protected $fillable = [
        'slug',
        'meta_title',
        'meta_desc',
        'meta_description',
        'headline',
        'heading_2',
        'description',
        'bottom_headline',
        'bottom_description',
        'faq_items',
        'is_active',
    ];

    protected $casts = [
        'faq_items' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active slug lists
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Provide a consistent accessor for `meta_desc` whether the DB column
     * is `meta_desc` or `meta_description` (migration history has both).
     */
    public function getMetaDescAttribute()
    {
        if (array_key_exists('meta_desc', $this->attributes) && !empty($this->attributes['meta_desc'])) {
            return $this->attributes['meta_desc'];
        }
        return $this->attributes['meta_description'] ?? null;
    }

    /**
     * Provide the reverse accessor too so code that expects `meta_description`
     * will also work.
     */
    public function getMetaDescriptionAttribute()
    {
        if (array_key_exists('meta_description', $this->attributes) && !empty($this->attributes['meta_description'])) {
            return $this->attributes['meta_description'];
        }
        return $this->attributes['meta_desc'] ?? null;
    }

    /**
     * Scope for ordering by slug
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('slug');
    }

    /**
     * Get slug lists for dropdown
     */
    public static function getForSelect()
    {
        return static::active()
            ->ordered()
            ->pluck('slug', 'id');
    }

    /**
     * Get excerpt of description
     */
    public function getExcerptAttribute($length = 150)
    {
        $description = strip_tags($this->description);
        return \Illuminate\Support\Str::limit($description, $length);
    }

    /**
     * Get formatted slug
     */
    public function getFormattedSlugAttribute()
    {
        if (str_starts_with($this->slug, 'http')) {
            return $this->slug;
        }
        return '/' . ltrim($this->slug, '/');
    }
}