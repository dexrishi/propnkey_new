@extends('layouts.admin')

@section('title', 'Edit New Development')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Edit New Development</h1>
                                <p class="text-muted mb-0">Update development details</p>
                            </div>
                            <div>
                                <a href="{{ route('new-developments.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to New Developments
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
                                <h5 class="card-title mb-0">Development Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('new-developments.update', $newDevelopment->id) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3">
                                        <label for="property_id" class="form-label">Property <span class="text-danger">*</span></label>
                                        <select class="form-select select2-property @error('property_id') is-invalid @enderror" 
                                                id="property_id" 
                                                name="property_id" 
                                                required>
                                            <option value="">Select a property...</option>
                                            @foreach($properties as $property)
                                                <option value="{{ $property->id }}" 
                                                        {{ old('property_id', $newDevelopment->property_id) == $property->id ? 'selected' : '' }}>
                                                    {{ $property->name }} 
                                                    @if($property->location)
                                                        - {{ $property->location->name }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('property_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Select a property to display in the New Developments section</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="sort_order" class="form-label">Sort Order</label>
                                        <input type="number" 
                                               class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" 
                                               name="sort_order" 
                                               value="{{ old('sort_order', $newDevelopment->sort_order) }}" 
                                               min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Lower numbers appear first. You can also reorder items by dragging them on the list page.</div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Update Development
                                        </button>
                                        <a href="{{ route('new-developments.index') }}" class="btn btn-outline-secondary">
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
                                    <strong>Property</strong>
                                    <p class="small text-muted mb-1">Select a property from the dropdown. The current property is pre-selected.</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Sort Order</strong>
                                    <p class="small text-muted mb-1">Controls the display order. Lower numbers appear first. You can also reorder items by dragging them on the list page.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 for property dropdown
    $('#property_id').select2({
        theme: 'bootstrap-5',
        placeholder: 'Select a property...',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
@endsection

