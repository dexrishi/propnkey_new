@extends('layouts.admin')

@section('title', 'Alt Type Details')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">{{ $altType->name }}</h1>
                <p class="text-muted mb-0">Alt Type details</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('alt-types.edit', $altType) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
                <a href="{{ route('alt-types.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $altType->name }}</dd>

            <dt class="col-sm-3">Sort Order</dt>
            <dd class="col-sm-9">{{ $altType->sort_order }}</dd>

            <dt class="col-sm-3">Status</dt>
            <dd class="col-sm-9">
                <span class="badge bg-{{ $altType->is_active ? 'success' : 'secondary' }}">
                    {{ $altType->is_active ? 'Active' : 'Inactive' }}
                </span>
            </dd>

            <dt class="col-sm-3">Created</dt>
            <dd class="col-sm-9">{{ $altType->created_at->format('M d, Y g:i A') }}</dd>

            <dt class="col-sm-3">Updated</dt>
            <dd class="col-sm-9">{{ $altType->updated_at->format('M d, Y g:i A') }}</dd>
        </dl>
    </div>
</div>
@endsection
