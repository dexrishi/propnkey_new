@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h1 class="h3 mb-1">Welcome back, {{ $user->name }}!</h1>
                <p class="text-muted mb-0">Here's an overview of your inquiries.</p>
            </div>
        </div>
    </div>
</div>

<!-- Total Inquiries Card -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-2">Total Inquiries</h6>
                        <h2 class="mb-0">{{ number_format($totalInquiries) }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-inbox fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inquiry Statistics by Status -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bar-chart me-2"></i>Inquiries by Status
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($statusOptions as $statusKey => $statusLabel)
                        @php
                            $count = $statusCounts[$statusKey] ?? 0;
                            $badgeColors = [
                                'new' => 'secondary',
                                'contacted' => 'info',
                                'qualified' => 'primary',
                                'proposal' => 'warning',
                                'negotiation' => 'warning',
                                'won' => 'success',
                                'lost' => 'danger',
                            ];
                            $badgeColor = $badgeColors[$statusKey] ?? 'secondary';
                        @endphp
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card border-{{ $badgeColor }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-1">{{ $statusLabel }}</h6>
                                            <h3 class="mb-0">{{ number_format($count) }}</h3>
                                        </div>
                                        <div>
                                            <span class="badge bg-{{ $badgeColor }} fs-6">
                                                {{ $totalInquiries > 0 ? number_format(($count / $totalInquiries) * 100, 1) : 0 }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Properties by Category -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-building me-2"></i>Properties by Category
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($propertyStatsByCategory as $category)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-1">{{ $category->name }}</h6>
                                            <div class="d-flex gap-3">
                                                <div>
                                                    <span class="text-muted small">Total:</span>
                                                    <strong class="text-primary">{{ $category->total_count ?? 0 }}</strong>
                                                </div>
                                                <div>
                                                    <span class="text-muted small">Active:</span>
                                                    <strong class="text-success">{{ $category->active_count ?? 0 }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="bi bi-folder fs-3 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Properties by Type -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-house me-2"></i>Properties by Type
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($propertyStatsByType as $type)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card border-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-1">{{ $type->name }}</h6>
                                            @if($type->propertyCategory)
                                                <small class="text-muted">{{ $type->propertyCategory->name }}</small>
                                            @endif
                                            <div class="d-flex gap-3 mt-2">
                                                <div>
                                                    <span class="text-muted small">Total:</span>
                                                    <strong class="text-info">{{ $type->total_count ?? 0 }}</strong>
                                                </div>
                                                <div>
                                                    <span class="text-muted small">Active:</span>
                                                    <strong class="text-success">{{ $type->active_count ?? 0 }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="bi bi-house-door fs-3 text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Inquiries -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history me-2"></i>Recent Inquiries
                </h5>
                <a href="{{ route('inquiries.index') }}" class="btn btn-sm btn-outline-primary">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body">
                @if($recentInquiries->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Project</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentInquiries as $inquiry)
                                    <tr>
                                        <td>
                                            <strong>{{ $inquiry->name }}</strong>
                                            @if($inquiry->company)
                                                <br><small class="text-muted">{{ $inquiry->company }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                                        </td>
                                        <td>
                                            <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                                        </td>
                                        <td>{{ $inquiry->project_name ?? '—' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $inquiry->status_badge_color }}">
                                                {{ $inquiry->status_label }}
                                            </span>
                                        </td>
                                        <td>{{ $inquiry->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('inquiries.show', $inquiry->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                        <p class="text-muted">No inquiries found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection