@extends('layouts.admin')

@section('title', 'Edit Bedroom Option')

@section('content')
<!-- Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Bedroom Option</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('bedroom-options.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Options
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('bedroom-options.update', $bedroomOption) }}" method="POST" id="bedroomOptionForm">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Bedroom Option Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $bedroomOption->name) }}" 
                                   placeholder="e.g., 1 BHK, 2 BHK, 3+ BHK" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="value" class="form-label">Value</label>
                            <input type="text" class="form-control @error('value') is-invalid @enderror" 
                                   id="value" name="value" value="{{ old('value', $bedroomOption->value) }}" 
                                   placeholder="e.g., 1, 2, 3">
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Optional value for filtering</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $bedroomOption->sort_order) }}" 
                                   min="0" placeholder="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Lower numbers appear first</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $bedroomOption->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                            <div class="form-text">Only active options will be shown in filters</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('bedroom-options.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Update Bedroom Option
                </button>
            </div>
        </form>
    </div>

    <!-- Help Card -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>Help
                </h5>
            </div>
            <div class="card-body">
                <h6>Bedroom Option Guidelines:</h6>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check text-success me-2"></i>Use clear, descriptive names</li>
                    <li><i class="bi bi-check text-success me-2"></i>Examples: "1 BHK", "2 BHK", "3+ BHK"</li>
                    <li><i class="bi bi-check text-success me-2"></i>Value field is optional for filtering</li>
                    <li><i class="bi bi-check text-success me-2"></i>Sort order determines display sequence</li>
                    <li><i class="bi bi-check text-success me-2"></i>Only active options appear in property filters</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-suggest value based on name
    const nameInput = document.getElementById('name');
    
    if (nameInput) {
        nameInput.addEventListener('input', function() {
            const valueInput = document.getElementById('value');
            if (valueInput && !valueInput.value) {
                const value = this.value.match(/\d+/);
                if (value) {
                    valueInput.value = value[0];
                }
            }
        });
    }
});
</script>
@endpush
