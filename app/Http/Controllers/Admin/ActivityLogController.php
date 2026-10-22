<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends AdminBaseController
{
    /**
     * Display a listing of activity logs
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->orderBy('created_at', 'desc');
        
        // Filter by action
        if ($request->has('action') && $request->action) {
            $query->where('action', $request->action);
        }
        
        // Filter by model type
        if ($request->has('model_type') && $request->model_type) {
            // Try to find full class name from basename
            $modelType = $request->model_type;
            $fullClassName = 'App\\Models\\' . $modelType;
            if (class_exists($fullClassName)) {
                $query->where('model_type', $fullClassName);
            } else {
                // Fallback: search by basename
                $query->where('model_type', 'like', '%\\' . $modelType);
            }
        }
        
        // Filter by user
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }
        
        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('model_name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        $logs = $query->paginate(50);
        
        // Get unique model types for filter
        $modelTypes = ActivityLog::select('model_type')
            ->distinct()
            ->orderBy('model_type')
            ->pluck('model_type')
            ->map(function($type) {
                return [
                    'basename' => class_basename($type),
                    'full' => $type
                ];
            })
            ->unique('basename')
            ->values()
            ->pluck('basename');
        
        return $this->viewWithRoute('admin.activity-logs.index', compact('logs', 'modelTypes'));
    }

    /**
     * Display the specified activity log
     */
    public function show(ActivityLog $activityLog)
    {
        $activityLog->load('user');
        return $this->viewWithRoute('admin.activity-logs.show', compact('activityLog'));
    }
}
