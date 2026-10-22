<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'phone',
        'whatsapp',
        'email',
        'bio',
        'image',
        'is_active',
        'show_in_about_page',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_in_about_page' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Scope for active agents
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering by name
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    /**
     * Get agents for dropdown
     */
    public static function getForSelect()
    {
        return static::active()
            ->ordered()
            ->pluck('name', 'id');
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Get formatted phone number
     */
    public function getFormattedPhoneAttribute()
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone);
        
        if (strlen($phone) === 10) {
            return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
        }
        
        return $this->phone;
    }

    /**
     * Get initials for avatar
     */
    public function getInitialsAttribute()
    {
        $names = explode(' ', $this->name);
        $initials = '';
        
        foreach ($names as $name) {
            if (!empty($name)) {
                $initials .= strtoupper(substr($name, 0, 1));
            }
        }
        
        return substr($initials, 0, 2);
    }

    /**
     * Scope for featured agents
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}