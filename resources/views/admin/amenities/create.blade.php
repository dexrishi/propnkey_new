@extends('layouts.admin')

@section('title', 'Create Amenity')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Create New Amenity</h1>
                                <p class="text-muted mb-0">Add a new property amenity</p>
                            </div>
                            <div>
                                <a href="{{ route('amenities.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Amenities
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
                                <h5 class="card-title mb-0">Amenity Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('amenities.store') }}" id="amenityForm">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name') }}" 
                                                   required 
                                                   autofocus
                                                   placeholder="e.g., Swimming Pool">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="sort_order" class="form-label">Sort Order</label>
                                            <input type="number" 
                                                   class="form-control @error('sort_order') is-invalid @enderror" 
                                                   id="sort_order" 
                                                   name="sort_order" 
                                                   value="{{ old('sort_order', 0) }}" 
                                                   min="0"
                                                   placeholder="0">
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon Class</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i id="iconPreview" class="bi bi-star"></i>
                                            </span>
                                            <input type="text" 
                                                   class="form-control @error('icon') is-invalid @enderror" 
                                                   id="icon" 
                                                   name="icon" 
                                                   value="{{ old('icon') }}" 
                                                   placeholder="e.g., bi bi-water">
                                            @error('icon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-text">Enter Bootstrap Icons class (e.g., bi bi-water, bi bi-wifi, bi bi-car-front)</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active (visible on website)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Create Amenity
                                        </button>
                                        <a href="{{ route('amenities.index') }}" class="btn btn-outline-secondary">
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
                                    <p class="small text-muted mb-1">The display name for this amenity</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Sort Order</strong>
                                    <p class="small text-muted mb-1">Lower numbers appear first in lists</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Icon Class</strong>
                                    <p class="small text-muted mb-1">Bootstrap Icons class name (optional)</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Popular Icons</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" data-icon="bi bi-water">
                                            <i class="bi bi-water me-1"></i>Water
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" data-icon="bi bi-wifi">
                                            <i class="bi bi-wifi me-1"></i>WiFi
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" data-icon="bi bi-car-front">
                                            <i class="bi bi-car-front me-1"></i>Parking
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" data-icon="bi bi-shield-check">
                                            <i class="bi bi-shield-check me-1"></i>Security
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" data-icon="bi bi-thermometer">
                                            <i class="bi bi-thermometer me-1"></i>AC
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" data-icon="bi bi-tv">
                                            <i class="bi bi-tv me-1"></i>TV
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('icon');
    const iconPreview = document.getElementById('iconPreview');
    
    // Update icon preview when typing
    iconInput.addEventListener('input', function() {
        const iconClass = this.value || 'bi bi-star';
        iconPreview.className = iconClass;
    });
    
    // Icon button click handlers
    document.querySelectorAll('.icon-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const iconClass = this.dataset.icon;
            iconInput.value = iconClass;
            iconPreview.className = iconClass;
        });
    });
});
</script>
@endpush
@endsection
