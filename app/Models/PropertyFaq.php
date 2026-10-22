<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyFaq extends Model
{
    protected $fillable = [
        'property_id',
        'question',
        'answer',
        'sort_order',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
