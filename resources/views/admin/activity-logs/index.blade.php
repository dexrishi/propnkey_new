@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Activity Logs</h1>
                                <p class="text-muted mb-0">Track all system activities and changes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('activity-logs.index') }}" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Action</label>
                                <select name="action" class="form-select">
                                    <option value="">All Actions</option>
                                    <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>Create</option>
                                    <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>Update</option>
                                    <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>Delete</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Model Type</label>
                                <select name="model_type" class="form-select">
                                    <option value="">All Models</option>
                                    @foreach($modelTypes as $type)
                                        <option value="{{ $type }}" {{ request('model_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">User</label>
                                <input type="text" name="user_id" class="form-control" placeholder="User ID" value="{{ request('user_id') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Search</label>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    @if(request()->hasAny(['action', 'model_type', 'user_id', 'search']))
                                        <a href="{{ route('activity-logs.index') }}" class="btn btn-outline-danger">
                                            <i class="bi bi-x"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Activity Logs Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All Activity Logs ({{ $logs->total() }})</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Action</th>
                                        <th>User</th>
                                        <th>Model</th>
                                        <th>Description</th>
                                        <th>Changes</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($logs as $log)
                                        <tr>
                                            <td>{{ $log->id }}</td>
                                            <td>
                                                @if($log->action == 'create')
                                                    <span class="badge bg-success">Create</span>
                                                @elseif($log->action == 'update')
                                                    <span class="badge bg-primary">Update</span>
                                                @elseif($log->action == 'delete')
                                                    <span class="badge bg-danger">Delete</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($log->action) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($log->user)
                                                    <strong>{{ $log->user->name }}</strong><br>
                                                    <small class="text-muted">{{ $log->user->email }}</small>
                                                @else
                                                    <span class="text-muted">System</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ class_basename($log->model_type) }}</strong><br>
                                                <small class="text-muted">{{ $log->model_name }}</small>
                                            </td>
                                            <td>{{ $log->description }}</td>
                                            <td>
                                                @if($log->action == 'update' && $log->changes_count > 0)
                                                    <span class="badge bg-info">{{ $log->changes_count }} field(s) changed</span>
                                                @elseif($log->action == 'create')
                                                    <span class="badge bg-success">New record</span>
                                                @elseif($log->action == 'delete')
                                                    <span class="badge bg-danger">Deleted</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $log->created_at->format('M d, Y') }}<br>
                                                <small class="text-muted">{{ $log->created_at->format('h:i A') }}</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('activity-logs.show', $log) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <p class="text-muted mb-0">No activity logs found.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($logs->hasPages())
                        <div class="card-footer">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>

@endsection

