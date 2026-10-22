@csrf
@if($author->exists)
    @method('PUT')
@endif

<div class="mb-3">
    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror"
           id="name" name="name" value="{{ old('name', $author->name) }}"
           required maxlength="120">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('designation') is-invalid @enderror"
           id="designation" name="designation" value="{{ old('designation', $author->designation) }}"
           required maxlength="160">
    @error('designation')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="photo" class="form-label">Photo @if(!$author->exists)<span class="text-danger">*</span>@endif</label>
    <input type="file" class="form-control @error('photo') is-invalid @enderror"
           id="photo" name="photo" accept="image/jpeg,image/png,image/webp" {{ $author->exists ? '' : 'required' }}>
    @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="form-text">Square photo works best. JPG, PNG or WEBP, up to 2 MB.</div>
    @if($author->photo_url)
        <img src="{{ $author->photo_url }}" alt="{{ $author->name }}" class="rounded-circle mt-3" width="72" height="72" style="object-fit: cover;">
    @endif
</div>

<div class="mb-3">
    <label for="bio" class="form-label">Bio <span class="text-danger">*</span></label>
    <textarea class="form-control @error('bio') is-invalid @enderror"
              id="bio" name="bio" rows="6" required maxlength="2000">{{ old('bio', $author->bio) }}</textarea>
    @error('bio')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-check mb-4">
    <input type="hidden" name="is_active" value="0">
    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
           {{ old('is_active', $author->exists ? ($author->is_active ? '1' : '0') : '1') == '1' ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Active (show in the blog author dropdown)</label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-circle me-2"></i>{{ $author->exists ? 'Update Author' : 'Create Author' }}
    </button>
    <a href="{{ route('blog-authors.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
