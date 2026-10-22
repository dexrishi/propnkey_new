@extends('layouts.admin')

@section('title', 'Edit Property SEO')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit SEO: {{ $property->name }}</h1>
    <a href="{{ route('properties.index') }}" class="btn btn-sm btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to Properties
    </a>
</div>

<form action="{{ route('properties.update', $property->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Slug & SEO Fields</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                       id="slug" name="slug" value="{{ old('slug', $property->slug) }}"
                       placeholder="property-slug" required>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                       id="meta_title" name="meta_title" value="{{ old('meta_title', $property->meta_title) }}"
                       placeholder="SEO title">
                <div class="form-text"><span id="meta_title_count">{{ strlen(old('meta_title', $property->meta_title ?? '')) }}</span> characters</div>
                @error('meta_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control @error('meta_description') is-invalid @enderror"
                          id="meta_description" name="meta_description" rows="4"
                          placeholder="SEO description">{{ old('meta_description', $property->meta_description) }}</textarea>
                <div class="form-text"><span id="meta_description_count">{{ strlen(old('meta_description', $property->meta_description ?? '')) }}</span> characters</div>
                @error('meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save me-2"></i>Update SEO
    </button>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const metaTitleInput = document.getElementById('meta_title');
    const metaDescriptionInput = document.getElementById('meta_description');
    const metaTitleCount = document.getElementById('meta_title_count');
    const metaDescriptionCount = document.getElementById('meta_description_count');

    function updateSeoCharacterCounts() {
        if (metaTitleInput && metaTitleCount) {
            metaTitleCount.textContent = metaTitleInput.value.length;
        }
        if (metaDescriptionInput && metaDescriptionCount) {
            metaDescriptionCount.textContent = metaDescriptionInput.value.length;
        }
    }

    if (metaTitleInput) {
        metaTitleInput.addEventListener('input', updateSeoCharacterCounts);
    }
    if (metaDescriptionInput) {
        metaDescriptionInput.addEventListener('input', updateSeoCharacterCounts);
    }
});
</script>
@endpush
