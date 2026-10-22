@extends('layouts.admin')

@section('title', 'View Agent')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">{{ $agent->name }}</h1>
                                <p class="text-muted mb-0">Agent Details</p>
                            </div>
                            <div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('agents.edit', $agent) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('agents.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Agents
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Agent Details -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Agent Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <p class="mb-0">{{ $agent->name }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Designation</label>
                                        <p class="mb-0">{{ $agent->designation }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Phone</label>
                                        <p class="mb-0">
                                            <a href="tel:{{ $agent->phone }}" class="text-decoration-none">
                                                {{ $agent->formatted_phone }}
                                            </a>
                                        </p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <p class="mb-0">
                                            @if($agent->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    @if($agent->whatsapp)
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">WhatsApp</label>
                                        <p class="mb-0">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->whatsapp) }}" 
                                               target="_blank" 
                                               class="text-decoration-none">
                                                {{ $agent->whatsapp }}
                                            </a>
                                        </p>
                                    </div>
                                    @endif
                                    
                                    @if($agent->email)
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <p class="mb-0">
                                            <a href="mailto:{{ $agent->email }}" class="text-decoration-none">
                                                {{ $agent->email }}
                                            </a>
                                        </p>
                                    </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Show in About Page</label>
                                        <p class="mb-0">
                                            @if($agent->show_in_about_page)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Featured</label>
                                        <p class="mb-0">
                                            @if($agent->is_featured)
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-star-fill me-1"></i>Featured
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if($agent->bio)
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold">Bio</label>
                                        <div class="border rounded p-3 bg-light">
                                            {!! $agent->bio !!}
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Created</label>
                                        <p class="mb-0">{{ $agent->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="mb-0">{{ $agent->updated_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions & Photo -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('agents.edit', $agent) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-2"></i>Edit Agent
                                    </a>
                                    
                                    <form method="POST" action="{{ route('agents.destroy', $agent) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this agent? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-trash me-2"></i>Delete Agent
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('agents.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Agents
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Photo -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Profile Photo</h6>
                            </div>
                            <div class="card-body text-center">
                                @if($agent->image)
                                    <img src="{{ $agent->image_url }}" 
                                         alt="{{ $agent->name }}" 
                                         class="img-fluid rounded-circle mb-3" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                    <p class="text-muted small mb-0">Professional Photo</p>
                                @else
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                         style="width: 150px; height: 150px; font-size: 48px; font-weight: bold;">
                                        {{ $agent->initials }}
                                    </div>
                                    <p class="text-muted small mb-0">No photo uploaded</p>
                                @endif
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Contact Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-telephone me-2"></i>
                                    <a href="tel:{{ $agent->phone }}" class="text-decoration-none">
                                        {{ $agent->formatted_phone }}
                                    </a>
                                </div>
                                @if($agent->whatsapp)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-whatsapp me-2"></i>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->whatsapp) }}" 
                                       target="_blank" 
                                       class="text-decoration-none">
                                        {{ $agent->whatsapp }}
                                    </a>
                                </div>
                                @endif
                                @if($agent->email)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-envelope me-2"></i>
                                    <a href="mailto:{{ $agent->email }}" class="text-decoration-none">
                                        {{ $agent->email }}
                                    </a>
                                </div>
                                @endif
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-briefcase me-2"></i>
                                    <span>{{ $agent->designation }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
