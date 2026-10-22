@extends('layouts.admin')

@section('title', 'Create Alt Type')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">Create Alt Type</h1>
                <p class="text-muted mb-0">Add a new image alt type option</p>
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
                <form method="POST" action="{{ route('alt-types.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}"
                               required autofocus placeholder="e.g., Interior, Club House">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" min="0"
                               class="form-control @error('sort_order') is-invalid @enderror"
                               id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                               {{ old('is_active', '1') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active (show in image upload dropdown)</label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Create Alt Type
                        </button>
                        <a href="{{ route('alt-types.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Tips</h6>
            </div>
            <div class="card-body">
                <p class="small text-muted mb-2">These options appear in Property Images → Alt Type dropdown.</p>
                <p class="small text-muted mb-0">Use clear names like <strong>Interior</strong>, <strong>Club House</strong>, <strong>Swimming Pool</strong>.</p>
            </div>
        </div>
    </div>
</div>
@endsection
