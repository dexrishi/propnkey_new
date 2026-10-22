<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'user_message',
        'project_name',
        'form_name',
        'url',
        'status',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get status options
     */
    public static function getStatusOptions()
    {
        return [
            'new' => 'New',
            'contacted' => 'Contacted',
            'qualified' => 'Qualified',
            'proposal' => 'Proposal',
            'negotiation' => 'Negotiation',
            'won' => 'Won',
            'lost' => 'Lost',
        ];
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColorAttribute()
    {
        $colors = [
            'new' => 'secondary',
            'contacted' => 'info',
            'qualified' => 'primary',
            'proposal' => 'warning',
            'negotiation' => 'warning',
            'won' => 'success',
            'lost' => 'danger',
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return self::getStatusOptions()[$this->status] ?? 'Unknown';
    }
}
