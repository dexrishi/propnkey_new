<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Redirection extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_url',
        'to_url',
        'type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active redirections
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Find a redirection by from_url
     */
    public static function findRedirect($url)
    {
        // Normalize URL - ensure it starts with /
        $normalizedUrl = '/' . trim($url, '/');
        
        // Try exact match first (normalized)
        $redirect = self::active()
            ->where('from_url', $normalizedUrl)
            ->first();
        
        // If not found, try with original URL
        if (!$redirect) {
            $redirect = self::active()
                ->where('from_url', $url)
                ->first();
        }
        
        return $redirect;
    }
}
