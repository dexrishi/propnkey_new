@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Edit Profile</h1>
                                <p class="text-muted mb-0">Update your account information</p>
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
                                <h5 class="card-title mb-0">Profile Information</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
                                    @csrf
                                    @method('PUT')
                                    
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
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Security Note</h6>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted mb-0">
                                    Changing your email address will require you to use the new email for future logins. 
                                    Make sure you have access to the new email address before making this change.
                                </p>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('profile.password') }}" class="btn btn-outline-warning">
                                        <i class="bi bi-key me-2"></i>Change Password
                                    </a>
                                    
                                    <a href="{{ route('profile.edit-profile') }}" class="btn btn-outline-info">
                                        <i class="bi bi-gear me-2"></i>Edit Profile & Password
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
