<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StaticPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($staticPage) {
            if (empty($staticPage->slug)) {
                $staticPage->slug = Str::slug($staticPage->name);
            }
        });

        static::updating(function ($staticPage) {
            if ($staticPage->isDirty('name') && empty($staticPage->slug)) {
                $staticPage->slug = Str::slug($staticPage->name);
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
     * Get excerpt of content
     */
    public function getExcerptAttribute($length = 150)
    {
        $content = strip_tags($this->content);
        return Str::limit($content, $length);
    }
}
