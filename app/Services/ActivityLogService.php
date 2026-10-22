<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogService
{
    /**
     * Log a create action
     */
    public static function logCreate(Model $model, array $attributes = [])
    {
        return self::log('create', $model, null, $attributes);
    }

    /**
     * Log an update action
     */
    public static function logUpdate(Model $model, array $oldValues = [], array $newValues = [])
    {
        $changes = [];
        foreach ($newValues as $key => $value) {
            if (!isset($oldValues[$key]) || $oldValues[$key] != $value) {
                $changes[$key] = [
                    'old' => $oldValues[$key] ?? null,
                    'new' => $value
                ];
            }
        }

        return self::log('update', $model, $oldValues, $newValues, $changes);
    }

    /**
     * Log a delete action
     */
    public static function logDelete(Model $model, array $attributes = [])
    {
        return self::log('delete', $model, $attributes, null);
    }

    /**
     * Main logging method
     */
    protected static function log(string $action, Model $model, ?array $oldValues = null, ?array $newValues = null, ?array $changes = null)
    {
        $user = Auth::user();
        
        // Get model name (human readable)
        $modelName = self::getModelName($model);
        
        // Build description
        $description = self::buildDescription($action, $model, $modelName);
        
        return ActivityLog::create([
            'user_id' => $user ? $user->id : null,
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id ?? null,
            'model_name' => $modelName,
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'changes' => $changes ? json_encode($changes) : null,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Get human readable model name
     */
    protected static function getModelName(Model $model): string
    {
        // Try common name fields
        if (isset($model->name)) {
            return $model->name;
        }
        if (isset($model->title)) {
            return $model->title;
        }
        if (isset($model->email)) {
            return $model->email;
        }
        
        // Fallback to model class name
        $className = class_basename(get_class($model));
        return $className . ' #' . ($model->id ?? 'N/A');
    }

    /**
     * Build description text
     */
    protected static function buildDescription(string $action, Model $model, string $modelName): string
    {
        $user = Auth::user();
        $userName = $user ? $user->name : 'System';
        $modelType = class_basename(get_class($model));
        
        switch ($action) {
            case 'create':
                return "{$userName} created {$modelType}: {$modelName}";
            case 'update':
                return "{$userName} updated {$modelType}: {$modelName}";
            case 'delete':
                return "{$userName} deleted {$modelType}: {$modelName}";
            default:
                return "{$userName} performed {$action} on {$modelType}: {$modelName}";
        }
    }
}

