<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'featured_image',
        'is_active',
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
     * Get the blog posts for the category.
     */
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    /**
     * Get the active blog posts for the category.
     */
    public function activeBlogPosts()
    {
        return $this->hasMany(BlogPost::class)->where('is_active', true);
    }

    /**
     * Scope to get active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the category's meta title or fallback to name.
     */
    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->name;
    }

    /**
     * Get the category's meta description or fallback to truncated description.
     */
    public function getMetaDescriptionAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        if ($this->description) {
            return Str::limit(strip_tags($this->description), 160);
        }
        
        return null;
    }
}