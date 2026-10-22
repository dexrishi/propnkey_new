@extends('admin.layouts.app')

@section('title', 'Create Image Redirection')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Image Redirection</h3>
                    <div class="card-tools">
                        <a href="{{ route('image-redirections.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('image-redirections.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="old_path" class="form-label">Old Path <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('old_path') is-invalid @enderror" 
                                           id="old_path" name="old_path" value="{{ old('old_path') }}" 
                                           placeholder="uploads/filename.jpg" required>
                                    <div class="form-text">The old path that will be redirected (e.g., uploads/image.jpg)</div>
                                    @error('old_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="new_path" class="form-label">New Path <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('new_path') is-invalid @enderror" 
                                           id="new_path" name="new_path" value="{{ old('new_path') }}" 
                                           placeholder="properties/1/project/uuid.jpg" required>
                                    <div class="form-text">The new path to redirect to (e.g., properties/1/project/uuid.jpg)</div>
                                    @error('new_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="original_filename" class="form-label">Original Filename <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('original_filename') is-invalid @enderror" 
                                           id="original_filename" name="original_filename" value="{{ old('original_filename') }}" 
                                           placeholder="image.jpg" required>
                                    <div class="form-text">The original filename (e.g., image.jpg)</div>
                                    @error('original_filename')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="image_type" class="form-label">Image Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('image_type') is-invalid @enderror" 
                                            id="image_type" name="image_type" required>
                                        <option value="">Select Image Type</option>
                                        <option value="project" {{ old('image_type') == 'project' ? 'selected' : '' }}>Project</option>
                                        <option value="logo" {{ old('image_type') == 'logo' ? 'selected' : '' }}>Logo</option>
                                        <option value="floor_plan" {{ old('image_type') == 'floor_plan' ? 'selected' : '' }}>Floor Plan</option>
                                    </select>
                                    @error('image_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="property_id" class="form-label">Property</label>
                                    <select class="form-select @error('property_id') is-invalid @enderror" 
                                            id="property_id" name="property_id">
                                        <option value="">Select Property (Optional)</option>
                                        @foreach($properties as $property)
                                            <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                                {{ $property->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('property_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="property_image_id" class="form-label">Property Image</label>
                                    <select class="form-select @error('property_image_id') is-invalid @enderror" 
                                            id="property_image_id" name="property_image_id">
                                        <option value="">Select Property Image (Optional)</option>
                                        @foreach($propertyImages as $image)
                                            <option value="{{ $image->id }}" {{ old('property_image_id') == $image->id ? 'selected' : '' }}>
                                                {{ $image->property->name }} - {{ $image->image_path }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('property_image_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-text">Whether this redirection is active</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Redirection
                        </button>
                        <a href="{{ route('image-redirections.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-populate original filename from old path
document.getElementById('old_path').addEventListener('input', function() {
    const oldPath = this.value;
    if (oldPath.startsWith('uploads/')) {
        const filename = oldPath.replace('uploads/', '');
        document.getElementById('original_filename').value = filename;
    }
});

// Auto-populate new path from property image selection
document.getElementById('property_image_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    if (selectedOption.value) {
        const imagePath = selectedOption.text.split(' - ')[1];
        if (imagePath) {
            document.getElementById('new_path').value = imagePath;
        }
    }
});
</script>
@endsection
