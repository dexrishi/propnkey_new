<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'model_name',
        'old_values',
        'new_values',
        'changes',
        'description',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'changes' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that performed the action
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the model instance
     */
    public function getModelInstance()
    {
        if ($this->model_type && $this->model_id) {
            return $this->model_type::find($this->model_id);
        }
        return null;
    }

    /**
     * Get changes count safely (handles both array and string)
     */
    public function getChangesCountAttribute()
    {
        // Get raw attribute value to avoid cast recursion
        $changes = $this->getAttribute('changes');
        
        if (is_null($changes)) {
            return 0;
        }
        
        // If it's a string, decode it
        if (is_string($changes)) {
            $decoded = json_decode($changes, true);
            return is_array($decoded) ? count($decoded) : 0;
        }
        
        // If it's already an array, return count
        return is_array($changes) ? count($changes) : 0;
    }

    /**
     * Scope for filtering by action
     */
    public function scopeByAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope for filtering by model type
     */
    public function scopeByModel($query, string $modelType)
    {
        return $query->where('model_type', $modelType);
    }

    /**
     * Scope for filtering by user
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get formatted changes for display
     */
    public function getFormattedChangesAttribute()
    {
        // Get raw attribute value to avoid cast recursion
        $changes = $this->getAttribute('changes');
        
        // Handle string case (if cast didn't work)
        if (is_string($changes)) {
            $changes = json_decode($changes, true);
        }
        
        if (!$changes || !is_array($changes)) {
            return [];
        }

        $formatted = [];
        foreach ($changes as $field => $change) {
            $formatted[] = [
                'field' => $field,
                'old' => $change['old'] ?? null,
                'new' => $change['new'] ?? null,
            ];
        }
        return $formatted;
    }
}
