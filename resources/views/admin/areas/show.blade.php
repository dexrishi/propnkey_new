@extends('layouts.admin')

@section('title', 'Area Details')

@section('content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">Area Details</h1>
                <p class="text-muted mb-0">View area information</p>
            </div>
            <div>
                <a href="{{ route('areas.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Areas
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Details -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Area Information</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Name:</dt>
                    <dd class="col-sm-9">{{ $area->name }}</dd>

                    <dt class="col-sm-3">Slug:</dt>
                    <dd class="col-sm-9"><code>{{ $area->slug ?? 'N/A' }}</code></dd>

                    <dt class="col-sm-3">Location:</dt>
                    <dd class="col-sm-9">{{ $area->location ? $area->location->name : 'N/A' }}</dd>

                    <dt class="col-sm-3">Sort Order:</dt>
                    <dd class="col-sm-9">{{ $area->sort_order }}</dd>

                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9">{{ $area->created_at->format('M d, Y H:i') }}</dd>

                    <dt class="col-sm-3">Updated At:</dt>
                    <dd class="col-sm-9">{{ $area->updated_at->format('M d, Y H:i') }}</dd>
                </dl>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('areas.edit', $area->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <form action="{{ route('areas.destroy', $area->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this area?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

