@props([
    'searchPlaceholder' => '3 BHK Apartments, Gurgaon',
    'searchIconUrl' => 'https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg',
    'isInnerSearch' => false,
    'currentLocation' => null
])

@php
    // Fetch data within the component
    $propertyCategories = \App\Models\PropertyCategory::with('properties')->get();
    $allLocation = \App\Models\Location::all();
    
    // Fixed price options as per requirement
    $priceOptions = [
        'Below 1 Cr',
        '1 Cr to 2 Cr', 
        '2 Cr to 4 Cr',
        'Above 4 Cr'
    ];
    
    // Get bedroom options from properties that have bedroom_option_id set
    $bedroomOptions = \App\Models\BedroomOption::whereHas('properties')->active()->ordered()->get();
@endphp

<div class="searchbox {{ $isInnerSearch ? 'innerserch' : '' }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="GET" action="{{ route('property.search') }}" id="search-form" class="search_form-container">
                    <div class="search_form-field position-relative">
                        <input class="search_form-textfield w-input" maxlength="256" name="query" placeholder="{{ $searchPlaceholder }}" type="text" id="query" autocomplete="off" value="{{ request('query') }}" />
                        <img loading="lazy" src="{{ $searchIconUrl }}" alt="" class="search_form-icon search_icon" />
                        <div id="search_form-settings_icon_white" class="search_form-icon_white"></div>
                        
                        <!-- Auto-suggestion dropdown -->
                        <div id="search-suggestions" class="search-suggestions" style="display: none;">
                            <div class="suggestions-list"></div>
                        </div>
                    </div>
                    <input type="submit" data-wait="Please wait..." class="search_form-submit {{ $isInnerSearch ? 'desk' : '' }} w-button" value="Search" />
                    @if($isInnerSearch)
                        <input type="submit" data-wait="Please wait..." class="search_form-submit mob w-button" value="" />
                    @endif
                </form>

                    <div class="serchfilter" style="display:none" id="myDivser">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="property-search-tabs">
                            @if($propertyCategories->count() > 0)
                                @foreach($propertyCategories as $key => $category)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#tab{{ $category->id }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <!-- Fallback tabs for home page -->
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">Private Residences</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu1">Rent</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu2">New Developments</a>
                                </li>
                                @endif
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            @if($propertyCategories->count() > 0)
                                @foreach($propertyCategories as $key => $category)
                                    <div class="tab-pane {{ $key == 0 ? 'active' : 'fade' }}" id="tab{{ $category->id }}">
                                        <form method="GET" action="{{ route('property.search') }}">
                                            <input type="hidden" name="form_type" value="{{ strtolower($category->name) }}">
                                            @if($currentLocation)
                                                <input type="hidden" name="location_filter" value="{{ $currentLocation->name }}">
                                            @endif

                                            <div class="accordion" id="accordion_{{ $category->id }}">
                                                <!-- Location -->
                                                <div class="card">
                                                    <div class="card-header" id="heading_location_{{ $category->id }}">
                                                        <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#collapse_location_{{ $category->id }}">
                                                            <span id="location_text_{{ $category->id }}">Location</span>
                                                        </a>
                                                    </div>
                                                    <div id="collapse_location_{{ $category->id }}" class="collapse show" data-parent="#accordion_{{ $category->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @php
                                                                    // Get only locations that have properties in this category
                                                                    $categoryLocations = \App\Models\Location::whereHas('properties', function($query) use ($category) {
                                                                        $query->where('property_category_id', $category->id)
                                                                              ->where('is_active', true);
                                                                    })->orderBy('name')->get();
                                                                @endphp
                                                                @if($categoryLocations->count() > 0)
                                                                    @foreach($categoryLocations as $location)
                                                                        <div class="col-md-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio" name="location" class="form-check-input filter-option" value="{{ $location->name }}">
                                                                                    {{ $location->name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-12">
                                                                        <p class="text-muted">No locations available for this category.</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Price -->
                                                <div class="card">
                                                    <div class="card-header" id="heading_price_{{ $category->id }}">
                                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_price_{{ $category->id }}">
                                                            <span id="price_text_{{ $category->id }}">Price</span>
                                                        </a>
                                                    </div>
                                                <div id="collapse_price_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($priceOptions as $price)
                                                                <div class="col-md-3">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="price" class="form-check-input filter-option" value="{{ $price }}">
                                                                            {{ $price }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <!-- Type -->
                                                <div class="card">
                                                    <div class="card-header" id="heading_type_{{ $category->id }}">
                                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_type_{{ $category->id }}">
                                                            <span id="type_text_{{ $category->id }}">Type</span>
                                                        </a>
                                                    </div>
                                                    <div id="collapse_type_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @php
                                                                    $categoryPropertyTypes = \App\Models\PropertyType::where('property_category_id', $category->id)->active()->ordered()->get();
                                                                @endphp
                                                                @foreach($categoryPropertyTypes as $type)
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="checkbox" name="property_type[]" class="form-check-input filter-option" value="{{ $type->name }}">
                                                                                {{ $type->name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                @if($categoryPropertyTypes->count() == 0)
                                                                    <div class="col-12">
                                                                        <p class="text-muted">No property types available for this category.</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Bedrooms (Residential only) -->
                                                @if(strtolower($category->name) == 'residential')
                                                <div class="card">
                                                    <div class="card-header" id="heading_bedroom_{{ $category->id }}">
                                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_bedroom_{{ $category->id }}">
                                                            <span id="bedroom_text_{{ $category->id }}">Bedrooms</span>
                                                        </a>
                                                    </div>
                                                    <div id="collapse_bedroom_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @foreach($bedroomOptions as $bedroom)
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="checkbox" name="bedroom[]" class="form-check-input filter-option" value="{{ $bedroom->value }}">
                                                                                {{ $bedroom->name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="search_form-filter_footer mt-3">
                                                <button type="submit" class="search_form-filter_submit_button w-button btn btn-primary">Confirm</button>
                                                <button type="button" class="search_form-filter_clear_button w-button btn btn-secondary" onclick="clearSearchFilters(this)">Clear</button>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback content for home page -->
                                <div class="tab-pane active" id="home">
                                    <div class="accordion" id="faq">
                                        <div class="card">
                                            <div class="card-header" id="faqhead1">
                                                <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1"
                                                    aria-expanded="true" aria-controls="faq1">Location</a>
                                            </div>

                                            <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($allLocation as $location)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" value="{{ $location->name }}">
                                                                        {{ $location->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead2">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2"
                                                    aria-expanded="true" aria-controls="faq2">Price</a>
                                            </div>

                                            <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($priceOptions as $price)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input" name="price" value="{{ $price }}">
                                                                        {{ $price }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead3">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3"
                                                    aria-expanded="true" aria-controls="faq3">Type</a>
                                            </div>

                                            <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @php
                                                            $allPropertyTypes = \App\Models\PropertyType::active()->ordered()->get();
                                                        @endphp
                                                        @foreach($allPropertyTypes as $type)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" name="property_type[]" class="form-check-input" value="{{ $type->name }}">
                                                                        {{ $type->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead4">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq4"
                                                    aria-expanded="true" aria-controls="faq4">Bedrooms</a>
                                            </div>

                                            <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($bedroomOptions as $bedroom)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" name="bedroom[]" value="{{ $bedroom->value }}">
                                                                        {{ $bedroom->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead5">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq5"
                                                    aria-expanded="true" aria-controls="faq5">Features</a>
                                            </div>

                                            <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="parking">Parking
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="garden">Garden
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="pool">Swimming Pool
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="gym">Gym
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="menu1">
                                    <!-- Rent tab content - same as home tab -->
                                    <div class="accordion" id="faq_rent">
                                        <div class="card">
                                            <div class="card-header" id="faqhead1_rent">
                                                <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1_rent"
                                                    aria-expanded="true" aria-controls="faq1_rent">Location</a>
                                            </div>

                                            <div id="faq1_rent" class="collapse show" aria-labelledby="faqhead1_rent" data-parent="#faq_rent">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($allLocation as $location)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" value="{{ $location->name }}">
                                                                        {{ $location->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add other rent-specific filters here -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="menu2">
                                    <!-- New Developments tab content -->
                                    <div class="accordion" id="faq_dev">
                                        <div class="card">
                                            <div class="card-header" id="faqhead1_dev">
                                                <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1_dev"
                                                    aria-expanded="true" aria-controls="faq1_dev">Location</a>
                                            </div>

                                            <div id="faq1_dev" class="collapse show" aria-labelledby="faqhead1_dev" data-parent="#faq_dev">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($allLocation as $location)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" value="{{ $location->name }}">
                                                                        {{ $location->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add other development-specific filters here -->
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Property search component loaded');
    
    // Function to update header text based on selected option
    function updateHeaderText(headerId, selectedValue, defaultText) {
        const headerElement = document.getElementById(headerId);
        console.log('Looking for element:', headerId, 'Found:', headerElement);
        if (headerElement) {
            if (selectedValue) {
                headerElement.textContent = `${defaultText}: ${selectedValue}`;
                headerElement.style.color = '#007bff';
                headerElement.style.fontWeight = 'bold';
            } else {
                headerElement.textContent = defaultText;
                headerElement.style.color = '';
                headerElement.style.fontWeight = '';
            }
        }
    }

    // Add event listeners to all filter options
    document.querySelectorAll('.filter-option').forEach(function(option) {
        console.log('Adding listener to:', option);
        
        // Prevent click events from bubbling up to prevent tab changes
        option.addEventListener('click', function(e) {
            e.stopPropagation();
            e.stopImmediatePropagation();
        }, true); // Use capture phase
        
        option.addEventListener('change', function(e) {
            e.stopPropagation(); // Prevent event from bubbling up
            console.log('Filter option changed:', this.name, this.value);
            
            // Get the form and extract category ID from the form's parent tab-pane
            const tabPane = this.closest('.tab-pane');
            const categoryId = tabPane ? tabPane.id.replace('tab', '') : '';
            console.log('Category ID:', categoryId);
            
            // Get the selected values from the form
            const form = this.closest('form');
            const selectedLocation = form.querySelector('input[name="location"]:checked')?.value || '';
            const selectedPrice = form.querySelector('input[name="price"]:checked')?.value || '';
            
            // Handle multi-select for property types
            const selectedPropertyTypes = Array.from(form.querySelectorAll('input[name="property_type[]"]:checked')).map(input => input.value);
            const selectedPropertyType = selectedPropertyTypes.length > 0 ? selectedPropertyTypes.join(', ') : '';
            
            // Handle multi-select for bedrooms
            const selectedBedrooms = Array.from(form.querySelectorAll('input[name="bedroom[]"]:checked')).map(input => input.value);
            const selectedBedroom = selectedBedrooms.length > 0 ? selectedBedrooms.join(', ') : '';
            
            // Update header texts
            updateHeaderText(`location_text_${categoryId}`, selectedLocation, 'Location');
            updateHeaderText(`price_text_${categoryId}`, selectedPrice, 'Price');
            updateHeaderText(`type_text_${categoryId}`, selectedPropertyType, 'Type');
            updateHeaderText(`bedroom_text_${categoryId}`, selectedBedroom, 'Bedrooms');
            
            console.log('Updated headers for category:', categoryId);
            console.log('Selected values:', { selectedLocation, selectedPrice, selectedPropertyType, selectedBedroom });
        });
    });
    
    // Also prevent label clicks from triggering tab changes
    document.querySelectorAll('.form-check-label').forEach(function(label) {
        label.addEventListener('click', function(e) {
            // Only stop propagation if clicking on the label itself, not if clicking on the input
            if (e.target === this || e.target.tagName === 'LABEL') {
                e.stopPropagation();
            }
        }, true); // Use capture phase
    });
    
    // Prevent form check wrapper clicks from bubbling
    document.querySelectorAll('.form-check').forEach(function(formCheck) {
        formCheck.addEventListener('click', function(e) {
            // Only stop if clicking on the wrapper, not on inputs/labels
            if (e.target === this || e.target.classList.contains('form-check')) {
                e.stopPropagation();
            }
        }, true); // Use capture phase
    });
});
</script>

<style>
.serchfilter {
    touch-action: pan-y; /* Allow vertical scrolling on the filter container */
}

.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
}

.suggestion-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: background-color 0.2s;
}

.suggestion-item:hover,
.suggestion-item.selected {
    background-color: #f8f9fa;
}

.suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-content {
    flex: 1;
}

.suggestion-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 2px;
}

.suggestion-subtitle {
    font-size: 12px;
    color: #666;
}

.suggestion-type {
    font-size: 10px;
    background: #e9ecef;
    color: #495057;
    padding: 2px 6px;
    border-radius: 4px;
    text-transform: uppercase;
    font-weight: 500;
}

.loading-suggestion {
    padding: 12px 16px;
    text-align: center;
    color: #666;
    font-style: italic;
}

.no-suggestions {
    padding: 12px 16px;
    text-align: center;
    color: #999;
    font-style: italic;
}

/* Fix search input text color */
.search_form-textfield {
    color: #333 !important;
    border: 1px solid #fff !important;
}

/* White text color only for homepage (when not innerserch) */
.searchbox:not(.innerserch) .search_form-textfield,
.searchbox:not(.innerserch) .search_form-textfield::placeholder {
    color: #fff !important;
}

/* White border only for homepage */
.searchbox:not(.innerserch) .search_form-textfield {
    border: 1px solid #fff !important;
}

/* Black border for inner pages (innerserch) */
.searchbox.innerserch .search_form-textfield {
    border: 1px solid #000 !important;
}

.search_form-textfield:focus,
.search_form-textfield:active,
.search_form-textfield:focus-visible {
    outline: none !important;
    box-shadow: none !important;
}

/* Keep white border on focus for homepage */
.searchbox:not(.innerserch) .search_form-textfield:focus,
.searchbox:not(.innerserch) .search_form-textfield:active,
.searchbox:not(.innerserch) .search_form-textfield:focus-visible {
    color: #fff !important;
    border: 1px solid #fff !important;
}

/* Keep black border on focus for inner pages */
.searchbox.innerserch .search_form-textfield:focus,
.searchbox.innerserch .search_form-textfield:active,
.searchbox.innerserch .search_form-textfield:focus-visible {
    border: 1px solid #000 !important;
}

.search_form-textfield::placeholder {
    color: #999 !important;
}

/* Fix search form corners - input should have left rounded corners, button should have right rounded corners */
.search_form-container {
/*    overflow: hidden;*/
    border-radius: 12px;
}

.search_form-textfield {
    border-radius: 12px 0 0 12px !important;
    border-right: none !important;
}

.search_form-submit {
    border-radius: 0 12px 12px 0 !important;
    margin-left: 0 !important;
}

/* Ensure icons don't overflow corners */
.search_form-field {
    overflow: hidden;
    border-radius: 12px 0 0 12px;
}

.search_form-field .search_form-icon,
.search_form-field .search_form-icon_white {
    z-index: 0;
}

/* Fix tabs layout */
.nav-tabs {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    margin: 0;
    padding: 0 0.5rem 0 0;
    scroll-behavior: smooth;
    touch-action: pan-x pan-y; /* Allow both horizontal and vertical scrolling */
    white-space: nowrap;
    border-bottom: 1px solid #dee2e6;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE and Edge */
}

.nav-tabs::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

.nav-tabs .nav-item {
    flex: 0 0 auto;
    min-width: fit-content;
    white-space: nowrap;
    margin-right: 2px;
    flex-shrink: 0;
}

.nav-tabs .nav-link {
    text-align: center;
    padding: 0.75rem 0.8rem;
    border: none;
    border-bottom: 2px solid transparent;
    background: #f8f9fa;
    color: #6c757d;
    font-weight: 500;
    transition: all 0.3s ease;
    display: block;
    white-space: nowrap;
    flex-shrink: 0;
    min-width: auto;
}

.nav-tabs .nav-link:hover {
    background: #e9ecef;
    color: #495057;
    text-decoration: none;
}

.nav-tabs .nav-link.active {
    background: #000;
    color: #fff;
    border-bottom-color: #000;
}

/* Make filter sections fully clickable */
.card-header {
    padding: 0;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    cursor: pointer;
}

.btn-header-link {
    display: block;
    width: 100%;
    padding: 1rem 1.25rem;
    text-align: left;
    background: none;
    border: none;
    color: #495057;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn-header-link:hover {
    background: #e9ecef;
    color: #495057;
    text-decoration: none;
}

.btn-header-link:focus {
    outline: none;
    box-shadow: none;
}

/* Card body scrolling */
.card-body {
    max-height: 400px;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .nav-tabs {
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        touch-action: pan-x;
        white-space: nowrap;
    }
    
    .nav-tabs .nav-item {
        flex: 0 0 auto;
        min-width: fit-content;
        flex-shrink: 0;
    }
    
    .nav-tabs .nav-link {
        padding: 0.6rem 0.7rem;
        font-size: 0.9rem;
        white-space: nowrap;
        min-width: auto;
    }
    
    .tab-content {
        touch-action: pan-y;
        user-select: none;
    }
    
    .card-body {
        max-height: 300px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Ensure the accordion sections are scrollable */
    .accordion .card {
        overflow: visible;
    }
    
    .accordion .collapse.show {
        overflow: visible;
    }
}

@media (max-width: 576px) {
    .nav-tabs {
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        touch-action: pan-x;
        white-space: nowrap;
    }
    
    .nav-tabs .nav-item {
        flex: 0 0 auto;
        min-width: fit-content;
        flex-shrink: 0;
    }
    
    .nav-tabs .nav-link {
        padding: 0.5rem 0.55rem;
        font-size: 0.85rem;
        white-space: nowrap;
        min-width: auto;
    }
    
    .tab-content {
        touch-action: pan-y;
        user-select: none;
    }
    
    .card-body {
        max-height: 250px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Ensure the accordion sections are scrollable */
    .accordion .card {
        overflow: visible;
    }
    
    .accordion .collapse.show {
        overflow: visible;
    }
}

/* Disabled button styles */
.search_form-filter_submit_button:disabled {
    background-color: #6c757d !important;
    border-color: #6c757d !important;
    color: #fff !important;
    cursor: not-allowed !important;
    opacity: 0.6;
}

.search_form-filter_submit_button:disabled:hover {
    background-color: #6c757d !important;
    border-color: #6c757d !important;
}

/* Ensure accordion titles have normal colors and font weight when no selections */
.btn-header-link span {
    color: #495057 !important;
    font-weight: normal !important;
}

.btn-header-link:hover span {
    color: #495057 !important;
    font-weight: normal !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('query');
    const suggestionsContainer = document.getElementById('search-suggestions');
    const suggestionsList = suggestionsContainer.querySelector('.suggestions-list');
    
    let searchTimeout;
    let currentSuggestions = [];
    let selectedIndex = -1;

    // Auto-suggestion functionality
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            hideSuggestions();
            return;
        }
        
        searchTimeout = setTimeout(() => {
            fetchSuggestions(query);
        }, 300);
    });

    // Handle keyboard navigation
    searchInput.addEventListener('keydown', function(e) {
        switch(e.key) {
            case 'ArrowDown':
                e.preventDefault();
                if (suggestionsContainer.style.display && suggestionsContainer.style.display !== 'none') {
                    selectedIndex = Math.min(selectedIndex + 1, currentSuggestions.length - 1);
                    updateSelection();
                }
                break;
            case 'ArrowUp':
                e.preventDefault();
                if (suggestionsContainer.style.display && suggestionsContainer.style.display !== 'none') {
                    selectedIndex = Math.max(selectedIndex - 1, -1);
                    updateSelection();
                }
                break;
            case 'Enter':
                e.preventDefault();
                // If suggestions are visible and a suggestion is selected, navigate to it
                if (suggestionsContainer.style.display && suggestionsContainer.style.display !== 'none' && selectedIndex >= 0 && currentSuggestions[selectedIndex]) {
                    window.location.href = currentSuggestions[selectedIndex].url;
                } else {
                    // Otherwise, submit the form with the search query
                    const form = document.getElementById('search-form');
                    if (form && searchInput.value.trim()) {
                        form.submit();
                    }
                }
                break;
            case 'Escape':
                hideSuggestions();
                break;
        }
    });

    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            hideSuggestions();
        }
    });

    function fetchSuggestions(query) {
        showLoading();
        
        fetch(`/api/search-suggestions?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(suggestions => {
                currentSuggestions = suggestions;
                displaySuggestions(suggestions);
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
                hideSuggestions();
            });
    }

    function showLoading() {
        suggestionsList.innerHTML = '<div class="loading-suggestion">Searching...</div>';
        showSuggestions();
    }

    function displaySuggestions(suggestions) {
        if (suggestions.length === 0) {
            suggestionsList.innerHTML = '<div class="no-suggestions">No suggestions found</div>';
            showSuggestions();
            return;
        }

        suggestionsList.innerHTML = suggestions.map((suggestion, index) => `
            <div class="suggestion-item" data-index="${index}">
                <div class="suggestion-content">
                    <div class="suggestion-title">${suggestion.title}</div>
                    <div class="suggestion-subtitle">${suggestion.subtitle}</div>
                </div>
                <div class="suggestion-type">${suggestion.type.replace('_', ' ')}</div>
            </div>
        `).join('');

        // Add click handlers
        suggestionsList.querySelectorAll('.suggestion-item').forEach((item, index) => {
            item.addEventListener('click', function() {
                window.location.href = suggestions[index].url;
            });
        });

        showSuggestions();
    }

    function updateSelection() {
        suggestionsList.querySelectorAll('.suggestion-item').forEach((item, index) => {
            item.classList.toggle('selected', index === selectedIndex);
        });
    }

    function showSuggestions() {
        suggestionsContainer.style.display = 'block';
        selectedIndex = -1;
    }

    function hideSuggestions() {
        suggestionsContainer.style.display = 'none';
        selectedIndex = -1;
    }

    // Ensure filter sections are fully clickable
    document.querySelectorAll('.card-header').forEach(header => {
        header.addEventListener('click', function(e) {
            // If clicking on the header itself (not on a child element), trigger the collapse
            if (e.target === this) {
                const toggleBtn = this.querySelector('.btn-header-link');
                if (toggleBtn) {
                    toggleBtn.click();
                }
            }
        });
    });

    // Tab navigation with arrow buttons
    const navTabs = document.querySelector('#property-search-tabs');
    const scrollLeftBtn = document.querySelector('.nav-tabs-scroll-left');
    const scrollRightBtn = document.querySelector('.nav-tabs-scroll-right');
    
    function updateScrollButtons() {
        if (!navTabs) return;
        
        const isAtStart = navTabs.scrollLeft <= 0;
        const isAtEnd = navTabs.scrollLeft >= navTabs.scrollWidth - navTabs.clientWidth - 1;
        
        if (scrollLeftBtn) {
            scrollLeftBtn.disabled = isAtStart;
        }
        if (scrollRightBtn) {
            scrollRightBtn.disabled = isAtEnd;
        }
    }
    
    if (navTabs) {
        // Initial check
        updateScrollButtons();
        
        // Update on scroll
        navTabs.addEventListener('scroll', updateScrollButtons);
        
        // Update on resize
        window.addEventListener('resize', updateScrollButtons);
        
        // Left button click
        if (scrollLeftBtn) {
            scrollLeftBtn.addEventListener('click', function() {
                navTabs.scrollBy({ left: -200, behavior: 'smooth' });
            });
        }
        
        // Right button click
        if (scrollRightBtn) {
            scrollRightBtn.addEventListener('click', function() {
                navTabs.scrollBy({ left: 200, behavior: 'smooth' });
            });
        }
    }
    
    // Swipe functionality for tabs with vertical scroll support
    if (navTabs) {
        let touchStartX = 0;
        let touchEndX = 0;
        let touchStartY = 0;
        let touchEndY = 0;
        let isSwiping = false;
        let scrollDirection = null;

        navTabs.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
            touchStartY = e.changedTouches[0].screenY;
            scrollDirection = null;
            isSwiping = true;
        }, { passive: true });

        navTabs.addEventListener('touchmove', function(e) {
            if (isSwiping) {
                touchEndX = e.changedTouches[0].screenX;
                touchEndY = e.changedTouches[0].screenY;
                
                // Determine scroll direction on first move
                if (scrollDirection === null) {
                    const diffX = Math.abs(touchEndX - touchStartX);
                    const diffY = Math.abs(touchEndY - touchStartY);
                    
                    // If vertical movement is greater, it's a vertical scroll - don't capture
                    if (diffY > diffX && diffY > 10) {
                        scrollDirection = 'vertical';
                        isSwiping = false;
                    } else if (diffX > diffY && diffX > 10) {
                        scrollDirection = 'horizontal';
                    }
                }
            }
        }, { passive: true });

        navTabs.addEventListener('touchend', function(e) {
            if (!isSwiping || scrollDirection === 'vertical') {
                isSwiping = false;
                scrollDirection = null;
                return;
            }
            
            const swipeThreshold = 50; // Minimum distance for a swipe
            const diffX = touchStartX - touchEndX;
            const diffY = Math.abs(touchStartY - touchEndY);

            // Only process horizontal swipes
            if (Math.abs(diffX) > swipeThreshold && Math.abs(diffX) > diffY) {
                const tabs = Array.from(navTabs.querySelectorAll('.nav-link'));
                const activeTab = navTabs.querySelector('.nav-link.active');
                const currentIndex = tabs.indexOf(activeTab);

                if (diffX > 0 && currentIndex < tabs.length - 1) {
                    // Swipe left - go to next tab
                    tabs[currentIndex + 1].click();
                } else if (diffX < 0 && currentIndex > 0) {
                    // Swipe right - go to previous tab
                    tabs[currentIndex - 1].click();
                }
            }

            touchStartX = 0;
            touchEndX = 0;
            touchStartY = 0;
            touchEndY = 0;
            isSwiping = false;
            scrollDirection = null;
        }, { passive: true });

        // Also add swipe to tab content area - but exclude form inputs and scrollable areas
        const tabContent = document.querySelector('.tab-content');
        if (tabContent) {
            let contentTouchStartX = 0;
            let contentTouchEndX = 0;
            let contentTouchStartY = 0;
            let contentTouchEndY = 0;
            let contentIsSwiping = false;
            let touchStartTime = 0;

            tabContent.addEventListener('touchstart', function(e) {
                // Don't start swipe detection if clicking on form inputs, labels, buttons, or inside scrollable card-body
                const target = e.target;
                if (target.tagName === 'INPUT' || 
                    target.tagName === 'LABEL' || 
                    target.tagName === 'BUTTON' ||
                    target.closest('label') ||
                    target.closest('input') ||
                    target.closest('button') ||
                    target.closest('.card-body')) {
                    contentIsSwiping = false;
                    return;
                }
                
                contentTouchStartX = e.changedTouches[0].screenX;
                contentTouchStartY = e.changedTouches[0].screenY;
                touchStartTime = Date.now();
                contentIsSwiping = true;
            }, { passive: true });

            tabContent.addEventListener('touchmove', function(e) {
                if (contentIsSwiping) {
                    contentTouchEndX = e.changedTouches[0].screenX;
                    contentTouchEndY = e.changedTouches[0].screenY;
                }
            }, { passive: true });

            tabContent.addEventListener('touchend', function(e) {
                if (!contentIsSwiping) return;
                
                // Don't trigger swipe if it was a quick tap (likely a click)
                const touchDuration = Date.now() - touchStartTime;
                if (touchDuration < 200) {
                    contentIsSwiping = false;
                    return;
                }
                
                const swipeThreshold = 50;
                const diffX = contentTouchStartX - contentTouchEndX;
                const diffY = Math.abs(contentTouchStartY - contentTouchEndY);

                // Only trigger horizontal swipe if horizontal movement is significantly greater than vertical
                if (Math.abs(diffX) > swipeThreshold && Math.abs(diffX) > diffY * 2) {
                    const tabs = Array.from(navTabs.querySelectorAll('.nav-link'));
                    const activeTab = navTabs.querySelector('.nav-link.active');
                    const currentIndex = tabs.indexOf(activeTab);

                    if (diffX > 0 && currentIndex < tabs.length - 1) {
                        // Swipe left - go to next tab
                        tabs[currentIndex + 1].click();
                    } else if (diffX < 0 && currentIndex > 0) {
                        // Swipe right - go to previous tab
                        tabs[currentIndex - 1].click();
                    }
                }

                contentTouchStartX = 0;
                contentTouchEndX = 0;
                contentTouchStartY = 0;
                contentTouchEndY = 0;
                contentIsSwiping = false;
            }, { passive: true });
        }
    }

    // Initialize button states for all forms
    document.querySelectorAll('form').forEach(form => {
        updateConfirmButtonState(form);
        
        // Add event listeners to all form inputs
        form.querySelectorAll('input[type="radio"], input[type="checkbox"], input[type="text"], select').forEach(input => {
            input.addEventListener('change', function() {
                updateConfirmButtonState(form);
            });
        });
    });

    // Close search filter form when clicking outside
    const searchFilterDiv = document.getElementById('myDivser');
    const searchForm = document.getElementById('search-form');
    const searchBox = document.querySelector('.searchbox');
    
    if (searchFilterDiv) {
        document.addEventListener('click', function(e) {
            // Check if the click is outside the search filter area and search box
            if (searchFilterDiv.style.display !== 'none' && 
                !searchFilterDiv.contains(e.target) && 
                !searchBox.contains(e.target)) {
                // Close the filter form
                searchFilterDiv.style.display = 'none';
            }
        });
    }
});

// Function to check if any selections are made in a form
function hasAnySelections(form) {
    // Check radio buttons
    const checkedRadios = form.querySelectorAll('input[type="radio"]:checked');
    if (checkedRadios.length > 0) {
        return true;
    }
    
    // Check checkboxes (including multi-select arrays)
    const checkedCheckboxes = form.querySelectorAll('input[type="checkbox"]:checked');
    if (checkedCheckboxes.length > 0) {
        return true;
    }
    
    // Check text inputs (excluding hidden inputs)
    const textInputs = form.querySelectorAll('input[type="text"]:not([type="hidden"])');
    for (let input of textInputs) {
        if (input.value.trim() !== '') {
            return true;
        }
    }
    
    // Check select dropdowns
    const selects = form.querySelectorAll('select');
    for (let select of selects) {
        if (select.selectedIndex > 0) {
            return true;
        }
    }
    
    return false;
}

// Function to update confirm button state
function updateConfirmButtonState(form) {
    const confirmButton = form.querySelector('.search_form-filter_submit_button');
    if (confirmButton) {
        const hasSelections = hasAnySelections(form);
        confirmButton.disabled = !hasSelections;
        
        if (hasSelections) {
            confirmButton.title = 'Click to search with selected filters';
        } else {
            confirmButton.title = 'Please select at least one filter option';
        }
    }
}

// Clear search filters function
function clearSearchFilters(button) {
    // Find the form that contains this button
    const form = button.closest('form');
    
    // Clear all radio buttons
    form.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.checked = false;
    });
    
    // Clear all checkboxes (including multi-select arrays)
    form.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false;
    });
    
    // Clear all text inputs
    form.querySelectorAll('input[type="text"]').forEach(input => {
        input.value = '';
    });
    
    // Clear all select dropdowns
    form.querySelectorAll('select').forEach(select => {
        select.selectedIndex = 0;
    });
    
    // Reset filter headers to show default text
    form.querySelectorAll('[id$="_text_"]').forEach(header => {
        const id = header.id;
        
        if (id.includes('location_text_')) {
            header.textContent = 'Location';
        } else if (id.includes('price_text_')) {
            header.textContent = 'Price';
        } else if (id.includes('type_text_')) {
            header.textContent = 'Type';
        } else if (id.includes('bedroom_text_')) {
            header.textContent = 'Bedrooms';
        }
    });
    
    // Also clear any accordion headers that might have selected values
    form.querySelectorAll('.btn-header-link span').forEach(span => {
        if (span.id.includes('location_text_')) {
            span.textContent = 'Location';
        } else if (span.id.includes('price_text_')) {
            span.textContent = 'Price';
        } else if (span.id.includes('type_text_')) {
            span.textContent = 'Type';
        } else if (span.id.includes('bedroom_text_')) {
            span.textContent = 'Bedrooms';
        }
        
        // Reset styling to normal state
        span.style.color = '';
        span.style.fontWeight = 'normal';
    });
    
    // Collapse all accordion sections except the first one
    form.querySelectorAll('.collapse').forEach((collapse, index) => {
        if (index === 0) {
            // Expand the first section (Location)
            collapse.classList.add('show');
        } else {
            // Collapse all other sections
            collapse.classList.remove('show');
        }
    });
    
    // Update confirm button state after clearing
    updateConfirmButtonState(form);
    
    console.log('Search filters cleared');
}
</script>
