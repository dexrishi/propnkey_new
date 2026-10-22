<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'type',
        'content',
        'description',
    ];

    /**
     * Get a configuration value by label
     */
    public static function getValue($label, $default = null)
    {
        $cacheKey = "site_config_{$label}";
        
        return Cache::remember($cacheKey, 3600, function () use ($label, $default) {
            $config = static::where('label', $label)->first();
            
            if (!$config) {
                return $default;
            }
            
            return static::castValue($config->content, $config->type);
        });
    }

    /**
     * Set a configuration value
     */
    public static function setValue($label, $content, $type = 'text', $description = null)
    {
        $config = static::updateOrCreate(
            ['label' => $label],
            [
                'content' => $content,
                'type' => $type,
                'description' => $description,
            ]
        );
        
        // Clear cache
        Cache::forget("site_config_{$label}");
        
        return $config;
    }

    /**
     * Cast value based on type
     */
    public static function castValue($content, $type)
    {
        if ($content === null) {
            return null;
        }

        switch ($type) {
            case 'textarea':
            case 'file':
            case 'text':
            default:
                return $content;
        }
    }

    /**
     * Get all configurations
     */
    public static function getAll()
    {
        return Cache::remember('site_configs_all', 3600, function () {
            return static::all()
                ->pluck('content', 'label')
                ->map(function ($content, $label) {
                    $config = static::where('label', $label)->first();
                    return static::castValue($content, $config->type);
                });
        });
    }

    /**
     * Clear all configuration cache
     */
    public static function clearCache()
    {
        $configs = static::pluck('label');
        foreach ($configs as $label) {
            Cache::forget("site_config_{$label}");
        }
        Cache::forget('site_configs_all');
    }

    /**
     * Get configurations by type
     */
    public static function getByType($type)
    {
        return static::where('type', $type)
            ->get()
            ->mapWithKeys(function ($config) {
                return [$config->label => static::castValue($config->content, $config->type)];
            });
    }

    /**
     * Check if a configuration exists
     */
    public static function exists($label)
    {
        return static::where('label', $label)->exists();
    }
}