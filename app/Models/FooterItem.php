<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterItem extends Model
{
    protected $fillable = [
        'title',
        'url',
        'sorting',
        'footer_category_id',
        'status'
    ];

    /**
     * Get the footer category that owns the footer item.
     */
    public function footerCategory()
    {
        return $this->belongsTo(FooterCategory::class);
    }

    protected $casts = [
        'status' => 'boolean',
    ];
}
