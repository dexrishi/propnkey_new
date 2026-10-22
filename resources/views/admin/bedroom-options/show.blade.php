@extends('layouts.admin')

@section('title', 'View Bedroom Option')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">View Bedroom Option</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('bedroom-options.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Options
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Bedroom Option Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p class="form-control-plaintext">{{ $bedroomOption->name }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Value</label>
                        <p class="form-control-plaintext">{{ $bedroomOption->value ?: 'N/A' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sort Order</label>
                        <p class="form-control-plaintext">{{ $bedroomOption->sort_order }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="form-control-plaintext">
                            <span class="badge {{ $bedroomOption->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $bedroomOption->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Created At</label>
                        <p class="form-control-plaintext">{{ $bedroomOption->created_at->format('M d, Y H:i') }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Updated At</label>
                        <p class="form-control-plaintext">{{ $bedroomOption->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Properties using this bedroom option -->
        @if($bedroomOption->properties->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Properties using this bedroom option</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bedroomOption->properties->take(10) as $property)
                                    <tr>
                                        <td>
                                            <a href="{{ route('properties.show', $property) }}" class="text-decoration-none">
                                                {{ $property->title }}
                                            </a>
                                        </td>
                                        <td>{{ $property->location->name ?? 'N/A' }}</td>
                                        <td>{{ $property->propertyType->name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge {{ $property->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $property->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($bedroomOption->properties->count() > 10)
                        <div class="text-center mt-3">
                            <small class="text-muted">Showing first 10 of {{ $bedroomOption->properties->count() }} properties</small>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Action Card -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-gear me-2"></i>Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('bedroom-options.edit', $bedroomOption) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit Bedroom Option
                    </a>
                    <a href="{{ route('bedroom-options.index') }}" class="btn btn-secondary">
                        <i class="bi bi-list me-2"></i>All Bedroom Options
                    </a>
                </div>
                
                <hr>
                
                <div class="d-grid">
                    <form action="{{ route('bedroom-options.destroy', $bedroomOption) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this bedroom option? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>Delete Bedroom Option
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Statistics Card -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bar-chart me-2"></i>Statistics
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-primary mb-1">{{ $bedroomOption->properties->count() }}</h4>
                            <small class="text-muted">Properties</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success mb-1">{{ $bedroomOption->properties->where('is_active', true)->count() }}</h4>
                        <small class="text-muted">Active</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
