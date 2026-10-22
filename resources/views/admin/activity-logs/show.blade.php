@extends('layouts.admin')

@section('title', 'Activity Log Details')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Activity Log Details</h1>
                                <p class="text-muted mb-0">View detailed information about this activity</p>
                            </div>
                            <div>
                                <a href="{{ route('activity-logs.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Logs
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Log Details -->
                <div class="row">
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <dl class="row mb-0">
                                    <dt class="col-sm-4">Action:</dt>
                                    <dd class="col-sm-8">
                                        @if($activityLog->action == 'create')
                                            <span class="badge bg-success">Create</span>
                                        @elseif($activityLog->action == 'update')
                                            <span class="badge bg-primary">Update</span>
                                        @elseif($activityLog->action == 'delete')
                                            <span class="badge bg-danger">Delete</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($activityLog->action) }}</span>
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">User:</dt>
                                    <dd class="col-sm-8">
                                        @if($activityLog->user)
                                            <strong>{{ $activityLog->user->name }}</strong><br>
                                            <small class="text-muted">{{ $activityLog->user->email }}</small>
                                        @else
                                            <span class="text-muted">System</span>
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">Model Type:</dt>
                                    <dd class="col-sm-8">
                                        <code>{{ $activityLog->model_type }}</code>
                                    </dd>

                                    <dt class="col-sm-4">Model Name:</dt>
                                    <dd class="col-sm-8">{{ $activityLog->model_name }}</dd>

                                    <dt class="col-sm-4">Model ID:</dt>
                                    <dd class="col-sm-8">{{ $activityLog->model_id ?? 'N/A' }}</dd>

                                    <dt class="col-sm-4">Description:</dt>
                                    <dd class="col-sm-8">{{ $activityLog->description }}</dd>

                                    <dt class="col-sm-4">Date & Time:</dt>
                                    <dd class="col-sm-8">
                                        {{ $activityLog->created_at->format('F d, Y h:i A') }}<br>
                                        <small class="text-muted">{{ $activityLog->created_at->diffForHumans() }}</small>
                                    </dd>

                                    <dt class="col-sm-4">IP Address:</dt>
                                    <dd class="col-sm-8">
                                        <code>{{ $activityLog->ip_address ?? 'N/A' }}</code>
                                    </dd>

                                    <dt class="col-sm-4">User Agent:</dt>
                                    <dd class="col-sm-8">
                                        <small class="text-muted">{{ $activityLog->user_agent ?? 'N/A' }}</small>
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <!-- Changes Comparison (for updates) -->
                        @php
                            $changes = is_array($activityLog->changes) ? $activityLog->changes : (is_string($activityLog->changes) ? json_decode($activityLog->changes, true) : []);
                            
                            // Filter changes to only show fields where old and new values are different
                            $filteredChanges = [];
                            if (is_array($changes)) {
                                foreach ($changes as $field => $change) {
                                    $oldValue = $change['old'] ?? null;
                                    $newValue = $change['new'] ?? null;
                                    
                                    // Compare values (handle arrays, null, and regular values)
                                    $oldStr = is_array($oldValue) ? json_encode($oldValue) : (string)$oldValue;
                                    $newStr = is_array($newValue) ? json_encode($newValue) : (string)$newValue;
                                    
                                    // Only include if values are different
                                    if ($oldStr !== $newStr) {
                                        $filteredChanges[$field] = $change;
                                    }
                                }
                            }
                        @endphp
                        @if($activityLog->action == 'update' && !empty($filteredChanges))
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Changes Made</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Field</th>
                                                    <th>Old Value</th>
                                                    <th>New Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($filteredChanges as $field => $change)
                                                    <tr>
                                                        <td><strong>{{ ucwords(str_replace('_', ' ', $field)) }}</strong></td>
                                                        <td>
                                                            @if(is_null($change['old']))
                                                                <span class="text-muted">(empty)</span>
                                                            @elseif(is_array($change['old']))
                                                                <pre class="mb-0">{{ json_encode($change['old'], JSON_PRETTY_PRINT) }}</pre>
                                                            @else
                                                                {{ $change['old'] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(is_null($change['new']))
                                                                <span class="text-muted">(empty)</span>
                                                            @elseif(is_array($change['new']))
                                                                <pre class="mb-0">{{ json_encode($change['new'], JSON_PRETTY_PRINT) }}</pre>
                                                            @else
                                                                {{ $change['new'] }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Old Values (for deletes) -->
                        @if($activityLog->action == 'delete' && $activityLog->old_values)
                            <div class="card mb-4">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="card-title mb-0">Deleted Record Data</h5>
                                </div>
                                <div class="card-body">
                                    <pre class="mb-0">{{ json_encode($activityLog->old_values, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </div>
                        @endif

                        <!-- New Values (for creates) -->
                        @if($activityLog->action == 'create' && $activityLog->new_values)
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white">
                                    <h5 class="card-title mb-0">Created Record Data</h5>
                                </div>
                                <div class="card-body">
                                    <pre class="mb-0">{{ json_encode($activityLog->new_values, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <!-- Quick Actions -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('activity-logs.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Logs
                                </a>
                            </div>
                        </div>

                        <!-- Related Information -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Related Information</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-2">
                                    <strong>Log ID:</strong> {{ $activityLog->id }}
                                </p>
                                <p class="text-muted small mb-2">
                                    <strong>Created:</strong> {{ $activityLog->created_at->diffForHumans() }}
                                </p>
                                @if($activityLog->model_id)
                                    <p class="text-muted small mb-0">
                                        <strong>Record ID:</strong> {{ $activityLog->model_id }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

@endsection

