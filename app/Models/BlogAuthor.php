<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogAuthor extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'photo',
        'bio',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        return asset('storage/' . $this->photo);
    }

    public function getInitialsAttribute(): string
    {
        $parts = preg_split('/\s+/', trim($this->name)) ?: [];
        $letters = '';

        foreach (array_slice($parts, 0, 2) as $part) {
            $letters .= mb_strtoupper(mb_substr($part, 0, 1));
        }

        return $letters !== '' ? $letters : 'A';
    }
}
