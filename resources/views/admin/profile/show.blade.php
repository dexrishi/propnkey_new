@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">My Profile</h1>
                <p class="text-muted mb-0">Manage your account information and security</p>
            </div>
            <div>
                <div class="btn-group" role="group">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>Edit Profile
                    </a>
                    <a href="{{ route('profile.password') }}" class="btn btn-outline-warning">
                        <i class="bi bi-key me-2"></i>Change Password
                    </a>
                </div>
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

<!-- Profile Information -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Profile Information</h5>
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
                        <label class="form-label fw-bold">Account Created</label>
                        <p class="mb-0">{{ $user->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="mb-0">{{ $user->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>Edit Profile
                    </a>
                    
                    <a href="{{ route('profile.password') }}" class="btn btn-outline-warning">
                        <i class="bi bi-key me-2"></i>Change Password
                    </a>
                    
                    <a href="{{ route('profile.edit-profile') }}" class="btn btn-outline-info">
                        <i class="bi bi-gear me-2"></i>Edit Profile & Password
                    </a>
                    
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Security Tips -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Security Tips</h6>
            </div>
            <div class="card-body">
                <ul class="small text-muted mb-0">
                    <li>Use a strong, unique password</li>
                    <li>Change your password regularly</li>
                    <li>Never share your login credentials</li>
                    <li>Log out when using shared computers</li>
                    <li>Keep your email address up to date</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection