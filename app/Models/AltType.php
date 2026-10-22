<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AltType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (AltType $altType) {
            if (empty($altType->slug) && !empty($altType->name)) {
                $altType->slug = static::uniqueSlugFromName($altType->name, $altType->id);
            } elseif (!empty($altType->slug)) {
                $altType->slug = Str::slug($altType->slug, '_');
            }
        });
    }

    public static function uniqueSlugFromName(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name, '_');
        if ($base === '') {
            $base = 'alt-type';
        }

        $slug = $base;
        $counter = 1;

        while (static::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base . '_' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public static function optionsForSelect(): array
    {
        return static::query()
            ->active()
            ->ordered()
            ->get(['slug', 'name'])
            ->pluck('name', 'slug')
            ->toArray();
    }
}
