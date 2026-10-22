<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'parent_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the parent menu item
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get the child menu items
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    }

    /**
     * Get all descendants (children, grandchildren, etc.)
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    /**
     * Scope for active menus
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for root menus (no parent)
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope for ordering by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Get menus for dropdown (excluding self and descendants)
     */
    public static function getForSelect($excludeId = null)
    {
        $query = static::active()->root()->ordered();
        
        if ($excludeId) {
            $excludeIds = [$excludeId];
            $menu = static::find($excludeId);
            if ($menu) {
                $excludeIds = array_merge($excludeIds, $menu->descendants->pluck('id')->toArray());
            }
            $query->whereNotIn('id', $excludeIds);
        }
        
        return $query->pluck('title', 'id');
    }

    /**
     * Get hierarchical menu structure
     */
    public static function getHierarchical()
    {
        return static::with('children')
            ->root()
            ->active()
            ->ordered()
            ->get();
    }

    /**
     * Get menu depth level
     */
    public function getLevelAttribute()
    {
        $level = 0;
        $parent = $this->parent;
        
        while ($parent) {
            $level++;
            $parent = $parent->parent;
        }
        
        return $level;
    }

    /**
     * Get formatted title with indentation
     */
    public function getFormattedTitleAttribute()
    {
        $indent = str_repeat('— ', $this->level);
        return $indent . $this->title;
    }

    /**
     * Check if menu has children
     */
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    /**
     * Get all ancestors
     */
    public function getAncestors()
    {
        $ancestors = collect();
        $parent = $this->parent;
        
        while ($parent) {
            $ancestors->prepend($parent);
            $parent = $parent->parent;
        }
        
        return $ancestors;
    }

    /**
     * Get breadcrumb trail
     */
    public function getBreadcrumbAttribute()
    {
        $breadcrumb = $this->getAncestors();
        $breadcrumb->push($this);
        return $breadcrumb;
    }
}