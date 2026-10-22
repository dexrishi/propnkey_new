<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'blog_category_id',
        'blog_author_id',
        'description',
        'meta_title',
        'meta_description',
        'featured_image',
        'is_active',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            // Only auto-generate slug if title changed and slug is empty
            if ($post->isDirty('title') && (empty($post->slug) || $post->slug === '')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Get the blog category that owns the post.
     */
    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function blogAuthor(): BelongsTo
    {
        return $this->belongsTo(BlogAuthor::class);
    }

    /**
     * Scope to get active posts.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get featured posts.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_active', true)
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope to order by published date.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Get the post's meta title or fallback to title.
     */
    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->title;
    }

    /**
     * Get the post's meta description or fallback to truncated description.
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

    /**
     * Get the post's excerpt (first paragraph or truncated description).
     */
    public function getExcerptAttribute()
    {
        if ($this->description) {
            $text = strip_tags($this->description);
            return Str::limit($text, 200);
        }
        
        return null;
    }

    /**
     * Get the post's reading time estimate.
     */
    public function getReadingTimeAttribute()
    {
        if ($this->description) {
            $wordCount = str_word_count(strip_tags($this->description));
            $minutes = ceil($wordCount / 200); // Average reading speed: 200 words per minute
            return $minutes . ' min read';
        }
        
        return null;
    }
}