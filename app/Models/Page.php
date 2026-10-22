<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'sort_order',
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

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * Scope for active pages
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
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Get pages for dropdown
     */
    public static function getForSelect()
    {
        return static::active()
            ->ordered()
            ->pluck('title', 'id');
    }

    /**
     * Generate unique slug
     */
    public function generateSlug()
    {
        $baseSlug = Str::slug($this->title);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Update slug if title changed
     */
    public function updateSlug()
    {
        if ($this->isDirty('title')) {
            $this->slug = $this->generateSlug();
        }
    }

    /**
     * Get excerpt of content
     */
    public function getExcerptAttribute($length = 150)
    {
        $content = strip_tags($this->content);
        return Str::limit($content, $length);
    }
}