@extends('layouts.admin')

@section('title', 'Edit Alt Type')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">Edit Alt Type</h1>
                <p class="text-muted mb-0">Update alt type details</p>
            </div>
            <a href="{{ route('alt-types.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Alt Types
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Alt Type Details</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('alt-types.update', $altType) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $altType->name) }}"
                               required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" min="0"
                               class="form-control @error('sort_order') is-invalid @enderror"
                               id="sort_order" name="sort_order"
                               value="{{ old('sort_order', $altType->sort_order) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                               {{ old('is_active', $altType->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active (show in image upload dropdown)</label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Update Alt Type
                        </button>
                        <a href="{{ route('alt-types.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
