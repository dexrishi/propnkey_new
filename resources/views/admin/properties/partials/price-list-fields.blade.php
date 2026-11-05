@php
    $priceListHtml = old('price_list', isset($property) ? ($property->price_list ?? '') : '');
    $priceListHasContent = !blank(trim(strip_tags($priceListHtml)));

    $defaultPriceTypes = [];
    if (old('bedroom_configs') && isset($bedroomOptions)) {
        $selectedIds = collect(old('bedroom_configs'))->map(fn ($id) => (int) $id);
        $defaultPriceTypes = collect($bedroomOptions)
            ->filter(fn ($opt) => $selectedIds->contains((int) $opt->id))
            ->pluck('name')
            ->values()
            ->all();
    } elseif (isset($property) && $property->bedroomOptions) {
        $defaultPriceTypes = $property->bedroomOptions->pluck('name')->values()->all();
    }

    if (empty($defaultPriceTypes)) {
        $defaultPriceTypes = ['3 BHK', '3.5 BHK', '4 BHK'];
    }
@endphp

<div class="mb-3" id="priceListEditorWrap"
     data-has-content="{{ $priceListHasContent ? '1' : '0' }}"
     data-default-types='@json($defaultPriceTypes)'>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
        <div>
            <label for="price_list" class="form-label mb-0">Price List</label>
            <div class="form-text mt-0">Step 1 ke selected Bedroom Configuration se table auto banegi — Area / Price yahan bharo</div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="insertPriceListTableBtn">
            <i class="bi bi-arrow-repeat me-1"></i>Reset from BHK
        </button>
    </div>

    <textarea class="form-control @error('price_list') is-invalid @enderror"
              id="price_list"
              name="price_list"
              rows="8"
              placeholder="Price list table">{{ $priceListHtml }}</textarea>
    @error('price_list')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
