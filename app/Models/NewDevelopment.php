<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewDevelopment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'sort_order',
    ];

    /**
     * Get the property that belongs to this new development
     */
    public function property()
    {
        return $this->belongsTo(Property::class)->withTrashed();
    }

    /**
     * Scope for ordering by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }
}
