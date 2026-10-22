<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort',
    ];

    /**
     * Scope for ordering by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Get the footer items for the category.
     */
    public function footerItems()
    {
        return $this->hasMany(FooterItem::class);
    }
}
