@extends('layouts.admin')

@section('title', 'Users')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Users</h1>
                                <p class="text-muted mb-0">Manage system users</p>
                            </div>
                            <div>
                                <a href="{{ route('users.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Add New User
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Users Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title mb-0">All Users ({{ $users->total() }})</h5>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2">
                                    <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">All Roles</option>
                                        <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="seo" {{ request('role') == 'seo' ? 'selected' : '' }}>SEO</option>
                                    </select>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search users..." name="search" value="{{ request('search') }}">
                                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        <th>Created</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $index => $user)
                                        <tr>
                                            <td>{{ $users->firstItem() + $index }}</td>
                                            <td>
                                                <strong>{{ $user->name }}</strong>
                                                @if($user->id === auth()->id())
                                                    <span class="badge bg-info ms-2">You</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->role === 'super_admin')
                                                    <span class="badge bg-danger">Super Admin</span>
                                                @elseif($user->role === 'seo')
                                                    <span class="badge bg-warning text-dark">SEO</span>
                                                @else
                                                    <span class="badge bg-primary">Admin</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->isSuperAdmin())
                                                    <span class="badge bg-success">All</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $user->permissions->count() }} pages</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $user->created_at->format('M d, Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('users.show', $user) }}" class="btn btn-outline-info" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @if($user->id !== auth()->id())
                                                        <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="bi bi-people fs-3 d-block mb-2"></i>
                                                    No users found
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($users->hasPages())
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if($users->onFirstPage())
                                        <span class="btn btn-outline-secondary disabled">« Previous</span>
                                    @else
                                        <a href="{{ $users->previousPageUrl() }}" class="btn btn-outline-secondary">« Previous</a>
                                    @endif
                                </div>
                                <div class="text-muted">
                                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                                </div>
                                <div>
                                    @if($users->hasMorePages())
                                        <a href="{{ $users->nextPageUrl() }}" class="btn btn-outline-secondary">Next »</a>
                                    @else
                                        <span class="btn btn-outline-secondary disabled">Next »</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

