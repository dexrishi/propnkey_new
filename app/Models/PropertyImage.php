<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'type',
        'alt_type',
        'image_path',
        'caption',
        'is_banner',
        'is_thumbnail',
        'is_thumbnail_2',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_banner' => 'boolean',
        'is_thumbnail' => 'boolean',
        'is_thumbnail_2' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the property that owns the image.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Scope to get active images.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order images by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Scope to filter by type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get banner images.
     */
    public function scopeBanner($query)
    {
        return $query->where('is_banner', true);
    }

    /**
     * Scope to get thumbnail images.
     */
    public function scopeThumbnail($query)
    {
        return $query->where('is_thumbnail', true);
    }

    /**
     * Scope to get thumbnail 2 images.
     */
    public function scopeThumbnail2($query)
    {
        return $query->where('is_thumbnail_2', true);
    }

    /**
     * Accessor for full image URL.
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Accessor for thumbnail URL.
     * Prefers sharp listing/gallery sizes over tiny legacy thumbs (e.g. 300x200)
     * so property cards do not look blurry when stretched.
     */
    public function getThumbnailUrlAttribute()
    {
        $path = pathinfo($this->image_path);
        $base = $path['dirname'] . '/thumbnails/' . $path['filename'];
        $ext = $path['extension'];

        $candidates = [
            $base . '_thumb_listing.' . $ext,
            $base . '_thumb_gallery.' . $ext,
            $base . '_thumb_373x250.' . $ext,
            $base . '_thumb.' . $ext,
        ];

        $tinyFallback = null;

        foreach ($candidates as $candidate) {
            $fullPath = storage_path('app/public/' . $candidate);
            if (!file_exists($fullPath)) {
                continue;
            }

            $size = @getimagesize($fullPath);
            if ($size && ($size[0] ?? 0) >= 600) {
                return asset('storage/' . $candidate);
            }

            // Remember tiny thumb only as last resort before full image
            $tinyFallback = $candidate;
        }

        // Full original is sharper than upscaling a 300x200 thumb on listing cards
        if (file_exists(storage_path('app/public/' . $this->image_path))) {
            return $this->image_url;
        }

        return $tinyFallback ? asset('storage/' . $tinyFallback) : $this->image_url;
    }

    /**
     * High-quality image for listing/grid cards.
     */
    public function getListingImageUrlAttribute()
    {
        return $this->thumbnail_url;
    }

    /**
     * Get the alt text for the image.
     */
    public function getAltTextAttribute()
    {
        if ($this->alt_type) {
            return ucfirst(str_replace('_', ' ', $this->alt_type));
        }
        
        return $this->caption ?: $this->property->name . ' - ' . ucfirst($this->type);
    }

    /**
     * Get the display name for the image type.
     */
    public function getTypeDisplayAttribute()
    {
        return match($this->type) {
            'logo' => 'Logo',
            'project' => 'Project',
            'floor_plan' => 'Floor Plan',
            default => ucfirst($this->type)
        };
    }

    /**
     * Get the display name for the alt type.
     */
    public function getAltTypeDisplayAttribute()
    {
        if (!$this->alt_type) {
            return null;
        }

        $fromMaster = AltType::query()->where('slug', $this->alt_type)->value('name');
        if ($fromMaster) {
            return $fromMaster;
        }

        return ucfirst(str_replace('_', ' ', $this->alt_type));
    }
}