@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Change Password</h1>
                                <p class="text-muted mb-0">Update your account password</p>
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
                                <h5 class="card-title mb-0">Password Change</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.password.update') }}" id="passwordForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control @error('current_password') is-invalid @enderror" 
                                               id="current_password" 
                                               name="current_password" 
                                               required 
                                               autofocus
                                               placeholder="Enter your current password">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               required
                                               placeholder="Enter your new password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Password must be at least 8 characters long</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control @error('password_confirmation') is-invalid @enderror" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               required
                                               placeholder="Confirm your new password">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-key me-2"></i>Change Password
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
                                <h6 class="card-title mb-0">Security Tips</h6>
                            </div>
                            <div class="card-body">
                                <ul class="small text-muted mb-0">
                                    <li>Use a unique password for this account</li>
                                    <li>Consider using a password manager</li>
                                    <li>Change your password regularly</li>
                                    <li>Never share your password with anyone</li>
                                    <li>Log out when using shared computers</li>
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
                                        <i class="bi bi-pencil me-2"></i>Edit Profile
                                    </a>
                                    
                                    <a href="{{ route('profile.edit-profile') }}" class="btn btn-outline-info">
                                        <i class="bi bi-gear me-2"></i>Edit Profile & Password
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
    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    function checkPasswordMatch() {
        if (passwordConfirmation.value && passwordInput.value !== passwordConfirmation.value) {
            passwordConfirmation.setCustomValidity('Passwords do not match');
        } else {
            passwordConfirmation.setCustomValidity('');
        }
    }
    
    passwordInput.addEventListener('input', checkPasswordMatch);
    passwordConfirmation.addEventListener('input', checkPasswordMatch);
});
</script>
@endpush
@endsection
