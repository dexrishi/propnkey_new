@extends('layouts.admin')

@section('title', 'Edit Profile & Password')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Edit Profile & Password</h1>
                                <p class="text-muted mb-0">Update your account information and security</p>
                            </div>
                            <div>
                                <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Account Information</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.edit-profile.update') }}" id="profileForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <!-- Profile Information -->
                                    <div class="mb-4">
                                        <h6 class="text-primary mb-3">Profile Information</h6>
                                        
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', $user->name) }}" 
                                                   required 
                                                   autofocus
                                                   placeholder="Enter your full name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email', $user->email) }}" 
                                                   required
                                                   placeholder="Enter your email address">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password Section -->
                                    <div class="mb-4">
                                        <h6 class="text-primary mb-3">Password (Optional)</h6>
                                        <p class="text-muted small mb-3">Leave password fields empty if you don't want to change your password</p>
                                        
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" 
                                                   class="form-control @error('current_password') is-invalid @enderror" 
                                                   id="current_password" 
                                                   name="current_password" 
                                                   placeholder="Enter your current password">
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" 
                                                   class="form-control @error('password') is-invalid @enderror" 
                                                   id="password" 
                                                   name="password" 
                                                   placeholder="Enter your new password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Password must be at least 8 characters long</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                            <input type="password" 
                                                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                   id="password_confirmation" 
                                                   name="password_confirmation" 
                                                   placeholder="Confirm your new password">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Update Profile
                                        </button>
                                        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle me-2"></i>Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Help Panel -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Field Guidelines</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Name</strong>
                                    <p class="small text-muted mb-1">Your full name as it appears on your account</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Email</strong>
                                    <p class="small text-muted mb-1">Your email address for login and notifications</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Password</strong>
                                    <p class="small text-muted mb-1">Leave empty if you don't want to change it</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Password Requirements</h6>
                            </div>
                            <div class="card-body">
                                <ul class="small text-muted mb-0">
                                    <li>At least 8 characters long</li>
                                    <li>Mix of uppercase and lowercase letters</li>
                                    <li>Include numbers and special characters</li>
                                    <li>Don't use common words or phrases</li>
                                    <li>Don't reuse your current password</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit Profile Only
                                    </a>
                                    
                                    <a href="{{ route('profile.password') }}" class="btn btn-outline-warning">
                                        <i class="bi bi-key me-2"></i>Change Password Only
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password validation
    const currentPassword = document.getElementById('current_password');
    const passwordInput = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    function validatePasswordFields() {
        const hasPassword = passwordInput.value.length > 0;
        const hasConfirmation = passwordConfirmation.value.length > 0;
        const hasCurrent = currentPassword.value.length > 0;
        
        // If password is provided, current password is required
        if (hasPassword && !hasCurrent) {
            currentPassword.setCustomValidity('Current password is required when changing password');
        } else {
            currentPassword.setCustomValidity('');
        }
        
        // If password is provided, confirmation is required
        if (hasPassword && !hasConfirmation) {
            passwordConfirmation.setCustomValidity('Password confirmation is required');
        } else if (hasPassword && hasConfirmation && passwordInput.value !== passwordConfirmation.value) {
            passwordConfirmation.setCustomValidity('Passwords do not match');
        } else {
            passwordConfirmation.setCustomValidity('');
        }
    }
    
    currentPassword.addEventListener('input', validatePasswordFields);
    passwordInput.addEventListener('input', validatePasswordFields);
    passwordConfirmation.addEventListener('input', validatePasswordFields);
});
</script>
@endpush
@endsection
