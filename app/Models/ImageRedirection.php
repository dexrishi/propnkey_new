<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageRedirection extends Model
{
    use HasFactory;

    protected $fillable = [
        'old_path',
        'new_path',
        'original_filename',
        'property_id',
        'image_type',
        'property_image_id',
        'is_active',
        'redirect_count',
        'last_redirected_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_redirected_at' => 'datetime',
    ];

    /**
     * Get the property that owns the image redirection.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the property image that owns the redirection.
     */
    public function propertyImage(): BelongsTo
    {
        return $this->belongsTo(PropertyImage::class);
    }

    /**
     * Scope a query to only include active redirections.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Increment redirect count and update last redirected timestamp.
     */
    public function recordRedirect()
    {
        $this->increment('redirect_count');
        $this->update(['last_redirected_at' => now()]);
    }

    /**
     * Get the full URL for the old path.
     */
    public function getOldUrlAttribute()
    {
        return url('uploads/' . $this->original_filename);
    }

    /**
     * Get the full URL for the new path.
     */
    public function getNewUrlAttribute()
    {
        return asset('storage/' . $this->new_path);
    }
}