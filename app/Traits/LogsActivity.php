<?php

namespace App\Traits;

use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;

trait LogsActivity
{
    /**
     * Log create action
     */
    protected function logCreate(Model $model)
    {
        ActivityLogService::logCreate($model, $model->getAttributes());
    }

    /**
     * Log update action
     */
    protected function logUpdate(Model $model, array $oldAttributes = [])
    {
        $newAttributes = $model->getAttributes();
        ActivityLogService::logUpdate($model, $oldAttributes, $newAttributes);
    }

    /**
     * Log delete action
     */
    protected function logDelete(Model $model)
    {
        ActivityLogService::logDelete($model, $model->getAttributes());
    }

    /**
     * Get old attributes before update
     */
    protected function getOldAttributes(Model $model): array
    {
        return $model->getOriginal();
    }
}

