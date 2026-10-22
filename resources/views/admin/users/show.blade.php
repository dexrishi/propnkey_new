@extends('layouts.admin')

@section('title', 'View User')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">{{ $user->name }}</h1>
                                <p class="text-muted mb-0">User Details</p>
                            </div>
                            <div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Users
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Details -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">User Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <p class="mb-0">{{ $user->name }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <p class="mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Role</label>
                                        <p class="mb-0">
                                            @if($user->role === 'super_admin')
                                                <span class="badge bg-danger">Super Admin</span>
                                            @elseif($user->role === 'seo')
                                                <span class="badge bg-warning text-dark">SEO</span>
                                            @else
                                                <span class="badge bg-primary">Admin</span>
                                            @endif
                                        </p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Created</label>
                                        <p class="mb-0">{{ $user->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="mb-0">{{ $user->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Page Permissions</h5>
                            </div>
                            <div class="card-body">
                                @if($user->isSuperAdmin())
                                    <p class="mb-0 text-muted">Super Admin has full access to all pages.</p>
                                @else
                                    @php $keys = $user->permissionKeys(); @endphp
                                    @if(empty($keys))
                                        <p class="mb-0 text-danger">No page permissions assigned.</p>
                                    @else
                                        <div class="row g-2">
                                            @foreach($permissionCatalog as $key => $meta)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="border rounded px-3 py-2 {{ in_array($key, $keys, true) ? 'bg-success-subtle' : 'bg-light text-muted' }}">
                                                        @if(in_array($key, $keys, true))
                                                            <i class="bi bi-check-circle-fill text-success me-1"></i>
                                                        @else
                                                            <i class="bi bi-x-circle text-muted me-1"></i>
                                                        @endif
                                                        {{ $meta['label'] }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit User
                                    </a>
                                    
                                    @if($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('users.destroy', $user) }}" 
                                              onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="bi bi-trash me-2"></i>Delete User
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Users
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

