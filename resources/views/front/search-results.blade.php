@extends('front.frontlayouts.frontapp')
@section('page-css')
<!-- Add any page-specific CSS here -->
@endsection

@section('content')

{{-- Top Section --}}
<div class="topserch">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="properties_intro-wrapper text-center">
                    <h1 class="properties_intro-heading">
                        {{ $location->heading ?? ucfirst($formType ?? 'Search Results') }}
                    </h1>
                    @if(!empty($location->meta_title))
                        <h2 class="properties_intro-sub_heading">
                            {{ $location->meta_title }}
                        </h2>
                    @endif
                    <div class="properties_intro-paragraph">
                        @if(!empty($location->site_description))
                            {!! nl2br(e($location->site_description)) !!}
                        @elseif(!empty($location->meta_description))
                            {!! nl2br(e($location->meta_description)) !!}
                        @else
                            Browse our curated selection of exquisite properties.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Search Filter Section --}}
<div class="searchbox innerserch">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="GET" action="{{ route('property.search') }}" id="search-form" class="search_form-container">
                    <div class="search_form-field position-relative">
                        <input class="search_form-textfield w-input" maxlength="256" name="query" placeholder="3 BHK Apartments, Gurgaon" type="text" id="query" autocomplete="off" value="{{ request('query') }}" />
                        <img loading="lazy" src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg" alt="" class="search_form-icon search_icon" />
                        <div id="search_form-settings_icon_white" class="search_form-icon_white"></div>
                        
                        <!-- Auto-suggestion dropdown -->
                        <div id="search-suggestions" class="search-suggestions" style="display: none;">
                            <div class="suggestions-list"></div>
                        </div>
                    </div>
                    <input type="submit" data-wait="Please wait..." class="search_form-submit desk w-button" value="Search" />
                    <input type="submit" data-wait="Please wait..." class="search_form-submit mob w-button" value="" />
                </form>

                    <div class="serchfilter" style="display:none" id="myDivser">
                        <ul class="nav nav-tabs">
                            @foreach($properCategory as $key => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#tab{{ $category->id }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach($properCategory as $key => $category)
                                <div class="tab-pane {{ $key == 0 ? 'active' : 'fade' }}" id="tab{{ $category->id }}">
                                    <form method="GET" action="{{ route('property.search') }}">
                                        <input type="hidden" name="form_type" value="{{ strtolower($category->name) }}">
                                        <div class="accordion" id="accordion_{{ $category->id }}">
                                            {{-- Location --}}
                                            <div class="card">
                                                <div class="card-header" id="heading_location_{{ $category->id }}">
                                                    <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#collapse_location_{{ $category->id }}">
                                                        Location <small id="selected_location" class="text-muted ml-2"></small>
                                                    </a>
                                                </div>
                                                <div id="collapse_location_{{ $category->id }}" class="collapse show" data-parent="#accordion_{{ $category->id }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($allLocation as $loc)
                                                                <div class="col-md-3">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="location" class="form-check-input filter-option" value="{{ $loc->name }}" {{ request('location') == $loc->name ? 'checked' : '' }}>
                                                                            {{ $loc->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Price --}}
                                            <div class="card">
                                                <div class="card-header" id="heading_price_{{ $category->id }}">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_price_{{ $category->id }}">
                                                        Price <small id="selected_price" class="text-muted ml-2"></small>
                                                    </a>
                                                </div>
                                                <div id="collapse_price_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($propertiesPrice as $price)
                                                                <div class="col-md-3">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="price" class="form-check-input filter-option" value="{{ $price }}" {{ request('price') == $price ? 'checked' : '' }}>
                                                                            {{ $price }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Property Type --}}
                                            <div class="card">
                                                <div class="card-header" id="heading_type_{{ $category->id }}">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_type_{{ $category->id }}">
                                                        Type <small id="selected_property_type" class="text-muted ml-2"></small>
                                                    </a>
                                                </div>
                                                <div id="collapse_type_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($propertyTypeAll as $type)
                                                                <div class="col-md-3">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" name="property_type" class="form-check-input filter-option" value="{{ $type->name }}" {{ request('property_type') == $type->name ? 'checked' : '' }}>
                                                                            {{ $type->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Bedrooms --}}
                                            @if(strtolower($category->name) == 'residential')
                                                <div class="card">
                                                    <div class="card-header" id="heading_bedroom_{{ $category->id }}">
                                                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#collapse_bedroom_{{ $category->id }}">
                                                            Bedrooms <small id="selected_bedroom" class="text-muted ml-2"></small>
                                                        </a>
                                                    </div>
                                                    <div id="collapse_bedroom_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @foreach($propertiesbedroom as $bedroom)
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="bedroom" class="form-check-input filter-option" value="{{ $bedroom }}" {{ request('bedroom') == $bedroom ? 'checked' : '' }}>
                                                                                {{ $bedroom }} BHK
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
                                            <a href="{{ route('property.search') }}" class="search_form-filter_clear_button w-button btn btn-secondary">Clear</a>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Properties Listing --}}
<div class="productlistsec">
    <div class="container">
        <div class="row">
            @forelse($properties as $property)
                <div class="col-md-6">
                    <div class="proboxcat {{ $property->is_sold ? 'soldrel' : '' }}">
                        @if($property->is_sold)
                            <span class="sold">
                                <img src="{{ asset($property->property_category_id == 4 ? 'frontassets/images/rented-out.png' : 'frontassets/images/sold-out.png') }}" alt="{{ $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out' }}">
                            </span>
                        @endif
                        <div class="proboxcatimg">
                            @php
                                $image = $property->images->where('is_thumbnail', 1)->first() ?? $property->images->first();
                            @endphp
                            <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}">
                                @if($image && $image->image_path)
                                    <img src="{{ $image->listing_image_url }}" 
                                        alt="{{ $image->alt_text }}" 
                                        class="img-fluid"
                                        onerror="this.src='{{ asset('frontassets/images/no-image.jpg') }}'">
                                @else
                                    <img src="{{ asset('frontassets/images/no-image.jpg') }}" 
                                        alt="{{ $property->name }}" 
                                        class="img-fluid">
                                @endif
                            </a>
                        </div>

                        <div class="proboxcattext">
                            <h1 class="details_meta-property_title" title="{{ $property->name }}">
                                <a href="{{ route('property.show', [$property->propertyCategory->slug ?? 'residential', $property->slug]) }}"
                                   title="{{ $property->name }}">
                                    {{ $property->name }}
                                </a>
                            </h1>
                            <p>
                                {{ $property->propertyType->name ?? '-' }} |
                                {{ $property->bedroom_count ?? '-' }} BHK |
                                {{ $property->area_sq_ft ?? '-' }} sq.ft
                            </p>
                            <p>Location: {{ $property->location->name ?? '-' }}</p>
                            <div class="search_properties-details_price">
                                <div class="details_price-aed">
                                    {{ \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p>No properties found matching your search.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script>
    // Auto submit filters
    document.querySelectorAll('.filter-option').forEach(el => {
        el.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });
    
    // Smart search suggestions
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('query');
        const suggestionsContainer = document.getElementById('search-suggestions');
        const suggestionsList = suggestionsContainer ? suggestionsContainer.querySelector('.suggestions-list') : null;
        
        if (!searchInput) {
            console.error('Search input not found');
            return;
        }
        
        if (!suggestionsContainer) {
            console.error('Suggestions container not found');
            return;
        }
        
        if (!suggestionsList) {
            console.error('Suggestions list not found');
            return;
        }
        
        console.log('All elements found, initializing search...');
        
        let searchTimeout;
        let currentSuggestions = [];
        let selectedIndex = -1;
        
        // Auto-suggestion functionality
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            console.log('Input event triggered, query:', query);
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                hideSuggestions();
                return;
            }
            
            searchTimeout = setTimeout(() => {
                console.log('Fetching suggestions for:', query);
                fetchSuggestions(query);
            }, 300);
        });
        
        // Also trigger on focus if there's a value
        searchInput.addEventListener('focus', function() {
            const query = this.value.trim();
            if (query.length >= 2 && currentSuggestions.length > 0) {
                showSuggestions();
            }
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
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(suggestions => {
                    console.log('Received suggestions:', suggestions);
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
            console.log('Displaying suggestions:', suggestions);
            console.log('Suggestions count:', suggestions.length);
            
            if (suggestions.length === 0) {
                suggestionsList.innerHTML = '<div class="no-suggestions">No suggestions found</div>';
                showSuggestions();
                return;
            }
            
            // Clear previous content
            suggestionsList.innerHTML = '';
            
            // Create suggestion items
            suggestions.forEach((suggestion, index) => {
                const escapedTitle = (suggestion.title || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                const escapedSubtitle = (suggestion.subtitle || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                const escapedType = (suggestion.type || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                
                const item = document.createElement('div');
                item.className = 'suggestion-item';
                item.setAttribute('data-index', index);
                item.innerHTML = `
                    <div class="suggestion-content">
                        <div class="suggestion-title">${escapedTitle}</div>
                        <div class="suggestion-subtitle">${escapedSubtitle}</div>
                    </div>
                    <div class="suggestion-type">${escapedType.replace('_', ' ')}</div>
                `;
                
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Clicked suggestion:', suggestion);
                    if (suggestion.url) {
                        window.location.href = suggestion.url;
                    }
                });
                
                suggestionsList.appendChild(item);
            });
            
            console.log('Suggestions rendered, showing dropdown...');
            showSuggestions();
            
            // Force a reflow to ensure display
            suggestionsContainer.offsetHeight;
        }
        
        function updateSelection() {
            suggestionsList.querySelectorAll('.suggestion-item').forEach((item, index) => {
                item.classList.toggle('selected', index === selectedIndex);
            });
        }
        
        function showSuggestions() {
            if (suggestionsContainer) {
                suggestionsContainer.style.display = 'block';
                suggestionsContainer.style.visibility = 'visible';
                suggestionsContainer.classList.add('show');
                console.log('Showing suggestions container', {
                    display: suggestionsContainer.style.display,
                    visibility: suggestionsContainer.style.visibility,
                    computed: window.getComputedStyle(suggestionsContainer).display,
                    zIndex: window.getComputedStyle(suggestionsContainer).zIndex,
                    position: window.getComputedStyle(suggestionsContainer).position
                });
            }
            selectedIndex = -1;
        }
        
        function hideSuggestions() {
            if (suggestionsContainer) {
                suggestionsContainer.style.display = 'none';
                suggestionsContainer.style.visibility = 'hidden';
                suggestionsContainer.classList.remove('show');
            }
            selectedIndex = -1;
        }
    });
</script>
@endsection
