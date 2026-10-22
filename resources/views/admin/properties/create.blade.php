@extends('layouts.admin')

@section('title', 'Add New Property')

@push('styles')
@include('admin.properties.partials.wizard-styles')
@endpush

@section('content')
<div class="property-edit-wizard" id="propertyCreateWizard">
<div class="pe-hero">
    <div>
        <div class="pe-hero-kicker">Property Creator</div>
        <h1>Add New Property</h1>
        <p class="pe-hero-sub">Fill details step by step — create when you&rsquo;re ready on the last step.</p>
    </div>
    <div class="pe-hero-actions">
        <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary pe-btn">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

<nav class="pe-steps" id="peStepsNav" aria-label="Create steps">
    <button type="button" class="pe-step-btn is-active" data-goto-step="1">
        <span class="pe-step-num">1</span>
        <span class="pe-step-label">Basics</span>
        <span class="pe-step-hint">Name, type, status</span>
    </button>
    <button type="button" class="pe-step-btn" data-goto-step="2">
        <span class="pe-step-num">2</span>
        <span class="pe-step-label">Location & Price</span>
        <span class="pe-step-hint">Area, rent, pricing</span>
    </button>
    <button type="button" class="pe-step-btn" data-goto-step="3">
        <span class="pe-step-num">3</span>
        <span class="pe-step-label">Content</span>
        <span class="pe-step-hint">Amenities & copy</span>
    </button>
    <button type="button" class="pe-step-btn" data-goto-step="4">
        <span class="pe-step-num">4</span>
        <span class="pe-step-label">Project & Map</span>
        <span class="pe-step-hint">Highlights, map</span>
    </button>
    <button type="button" class="pe-step-btn" data-goto-step="5">
        <span class="pe-step-num">5</span>
        <span class="pe-step-label">SEO & Publish</span>
        <span class="pe-step-hint">Meta & create</span>
    </button>
</nav>

<div class="pe-progress" aria-hidden="true">
    <div class="pe-progress-bar" id="peProgressBar"></div>
</div>

<form action="{{ route('properties.store') }}" method="POST" id="propertyForm" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        <div class="col-lg-8">
            <div class="wizard-step is-active" data-step="1">
            <div class="pe-step-panel-title">
                <span class="icon"><i class="bi bi-building"></i></span>
                <div>
                    <h2>Basic Information</h2>
                    <p>Name, classification, and visibility settings</p>
                </div>
            </div>
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Property Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Enter property name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" value="{{ old('slug') }}" 
                                   placeholder="property-slug" required>
                            <small class="form-text text-muted">
                                <i class="bi bi-info-circle"></i> Auto-generated from name. You can edit it if needed.
                            </small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="alias_name" class="form-label">Alias Name</label>
                            <input type="text" class="form-control @error('alias_name') is-invalid @enderror" 
                                   id="alias_name" name="alias_name" value="{{ old('alias_name') }}" 
                                   placeholder="Alternative name">
                            @error('alias_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="badge_id" class="form-label">Badge</label>
                            <select class="form-select @error('badge_id') is-invalid @enderror" 
                                    id="badge_id" name="badge_id">
                                <option value="">Select a badge</option>
                                @foreach($badges as $badge)
                                    <option value="{{ $badge->id }}" {{ old('badge_id') == $badge->id ? 'selected' : '' }}>
                                        {{ $badge->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('badge_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input type="hidden" name="is_featured" value="0">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Featured Property
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input type="hidden" name="is_sold" value="0">
                                <input class="form-check-input" type="checkbox" id="is_sold" name="is_sold" value="1"
                                       {{ old('is_sold') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_sold">
                                    Sold Property
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Relationships -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Relationships</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="partner_id" class="form-label">Partner</label>
                            <select class="form-select @error('partner_id') is-invalid @enderror" 
                                    id="partner_id" name="partner_id">
                                <option value="">Select Partner</option>
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('partner_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="agent_id" class="form-label">Agent</label>
                            <select class="form-select @error('agent_id') is-invalid @enderror" 
                                    id="agent_id" name="agent_id">
                                <option value="">Select Agent</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }} - {{ $agent->designation }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="location_id" class="form-label">Location</label>
                            <select class="form-select @error('location_id') is-invalid @enderror" 
                                    id="location_id" name="location_id">
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="locality" class="form-label">Locality</label>
                            <input type="text" class="form-control @error('locality') is-invalid @enderror"
                                   id="locality" name="locality" value="{{ old('locality') }}"
                                   placeholder="e.g., Whitefield, Koramangala">
                            @error('locality')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="property_condition_id" class="form-label">Property Condition</label>
                            <select class="form-select @error('property_condition_id') is-invalid @enderror" 
                                    id="property_condition_id" name="property_condition_id">
                                <option value="">Select Property Condition</option>
                                @foreach($propertyConditions as $condition)
                                    <option value="{{ $condition->id }}" {{ old('property_condition_id') == $condition->id ? 'selected' : '' }}>
                                        {{ $condition->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('property_condition_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="property_category_id" class="form-label">Property Category</label>
                            <select class="form-select @error('property_category_id') is-invalid @enderror" 
                                    id="property_category_id" name="property_category_id">
                                <option value="">Select Property Category</option>
                                @foreach($propertyCategories as $category)
                                    <option value="{{ $category->id }}"
                                            data-slug="{{ $category->slug }}"
                                            {{ old('property_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('property_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="property_type_id" class="form-label">Property Type</label>
                            <select class="form-select @error('property_type_id') is-invalid @enderror" 
                                    id="property_type_id" name="property_type_id">
                                <option value="">Select Property Type</option>
                                @foreach($propertyTypes as $type)
                                    <option value="{{ $type->id }}"
                                            data-category-id="{{ $type->property_category_id }}"
                                            {{ old('property_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Types filter by category. Resale &amp; Rental show Residential + Commercial types.</div>
                            @error('property_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Residential Details -->
            @php
                $currentRise = old('rise', '');
                $selectedBedrooms = collect(old('bedroom_configs', []))->map(fn ($id) => (int) $id);
            @endphp
            <div class="card mb-4" id="residentialFields" style="display: none;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Residential Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label mb-2">Rise</label>
                        <div class="pe-choice-group" role="radiogroup" aria-label="Rise">
                            <label class="pe-choice">
                                <input type="radio" name="rise" id="rise_none" value="" {{ $currentRise === '' || $currentRise === null ? 'checked' : '' }}>
                                <span><i class="bi bi-dash-circle"></i> Not set</span>
                            </label>
                            <label class="pe-choice">
                                <input type="radio" name="rise" id="rise_high" value="high" {{ $currentRise === 'high' ? 'checked' : '' }}>
                                <span><i class="bi bi-building"></i> High Rise</span>
                            </label>
                            <label class="pe-choice">
                                <input type="radio" name="rise" id="rise_low" value="low" {{ $currentRise === 'low' ? 'checked' : '' }}>
                                <span><i class="bi bi-house"></i> Low Rise</span>
                            </label>
                        </div>
                        @error('rise')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label mb-2">Bedroom Configuration</label>
                        <div class="pe-chip-grid" id="bedroom_configs">
                            @foreach($bedroomOptions as $bedroomOption)
                                <label class="pe-chip">
                                    <input type="checkbox"
                                           name="bedroom_configs[]"
                                           value="{{ $bedroomOption->id }}"
                                           {{ $selectedBedrooms->contains((int) $bedroomOption->id) ? 'checked' : '' }}>
                                    <span>{{ $bedroomOption->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="form-text mt-2">Tap to select one or more configurations</div>
                        @error('bedroom_configs')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Rating & Reviews -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Rating & Reviews</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="rating" class="form-label">Rating (0-5)</label>
                            <input type="number" class="form-control @error('rating') is-invalid @enderror" 
                                   id="rating" name="rating" value="{{ old('rating') }}" 
                                   min="0" max="5" step="0.1" placeholder="4.5">
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="review_count" class="form-label">Review Count</label>
                            <input type="number" class="form-control @error('review_count') is-invalid @enderror" 
                                   id="review_count" name="review_count" value="{{ old('review_count', 0) }}" 
                                   min="0" placeholder="150">
                            @error('review_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            </div>{{-- end wizard step 1 --}}

            <div class="wizard-step" data-step="2">
            <div class="pe-step-panel-title">
                <span class="icon"><i class="bi bi-geo-alt"></i></span>
                <div>
                    <h2>Location & Pricing</h2>
                    <p>Where it is, what it costs, and rental options</p>
                </div>
            </div>
            <!-- Location Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Location Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="rera_reg_no" class="form-label">RERA Registration Number</label>
                        <input type="text" class="form-control @error('rera_reg_no') is-invalid @enderror"
                               id="rera_reg_no" name="rera_reg_no" value="{{ old('rera_reg_no') }}"
                               placeholder="e.g., RERA123456789">
                        @error('rera_reg_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="3" 
                                  placeholder="Full address of the property">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pricing</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price (in Rupees)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" 
                                   min="0" step="0.01" placeholder="5000000">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price Display</label>
                            <div class="form-control-plaintext bg-light p-3 rounded" id="priceDisplay">
                                Price on Request
                            </div>
                            <small class="form-text text-muted">Live preview of price in Indian numbering system</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="area_sq_ft" class="form-label">Area (Sq Ft)</label>
                            <input type="number" class="form-control @error('area_sq_ft') is-invalid @enderror" 
                                   id="area_sq_ft" name="area_sq_ft" value="{{ old('area_sq_ft') }}" 
                                   min="0" placeholder="1200">
                            @error('area_sq_ft')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="possession" class="form-label">Possession Date</label>
                            <input type="date" class="form-control @error('possession') is-invalid @enderror" 
                                   id="possession" name="possession" value="{{ old('possession') }}">
                            @error('possession')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="property_status_id" class="form-label">Property Status</label>
                        <select class="form-select @error('property_status_id') is-invalid @enderror" 
                                id="property_status_id" name="property_status_id">
                            <option value="">Select Status</option>
                            @foreach($propertyStatuses as $status)
                                <option value="{{ $status->id }}" {{ old('property_status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('property_status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Rental Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Rental Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input type="hidden" name="is_rental" value="0">
                                <input class="form-check-input" type="checkbox" id="is_rental" name="is_rental" value="1"
                                       {{ old('is_rental') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_rental">
                                    This is a rental property
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="rentalFields" style="display: {{ (old('is_rental') || old('property_category_id') == 4) ? 'block' : 'none' }};">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="monthly_rent" class="form-label">Monthly Rent (₹)</label>
                                <input type="number" class="form-control @error('monthly_rent') is-invalid @enderror" 
                                       id="monthly_rent" name="monthly_rent" value="{{ old('monthly_rent') }}" 
                                       min="0" step="0.01" placeholder="13200">
                                @error('monthly_rent')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="security_deposit" class="form-label">Security Deposit (₹)</label>
                                <input type="number" class="form-control @error('security_deposit') is-invalid @enderror" 
                                       id="security_deposit" name="security_deposit" value="{{ old('security_deposit') }}" 
                                       min="0" step="0.01" placeholder="13200">
                                @error('security_deposit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="one_time_fees" class="form-label">One Time Fees (₹)</label>
                                <input type="number" class="form-control @error('one_time_fees') is-invalid @enderror" 
                                       id="one_time_fees" name="one_time_fees" value="{{ old('one_time_fees') }}" 
                                       min="0" step="0.01" placeholder="7800">
                                @error('one_time_fees')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="total_payable" class="form-label">Total Payable (₹)</label>
                                <input type="number" class="form-control @error('total_payable') is-invalid @enderror" 
                                       id="total_payable" name="total_payable" value="{{ old('total_payable') }}" 
                                       min="0" step="0.01" placeholder="34200">
                                @error('total_payable')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lock_in_period_days" class="form-label">Lock-in Period (Days)</label>
                                <input type="number" class="form-control @error('lock_in_period_days') is-invalid @enderror" 
                                       id="lock_in_period_days" name="lock_in_period_days" value="{{ old('lock_in_period_days') }}" 
                                       min="0" placeholder="180">
                                @error('lock_in_period_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="notice_period_days" class="form-label">Notice Period (Days)</label>
                                <input type="number" class="form-control @error('notice_period_days') is-invalid @enderror" 
                                       id="notice_period_days" name="notice_period_days" value="{{ old('notice_period_days') }}" 
                                       min="0" placeholder="45">
                                @error('notice_period_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="rent_includes" class="form-label">Rent Includes</label>
                            <textarea class="form-control @error('rent_includes') is-invalid @enderror" 
                                      id="rent_includes" name="rent_includes" rows="4" 
                                      placeholder="What's included in the rent">{{ old('rent_includes') }}</textarea>
                            @error('rent_includes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rent_excludes" class="form-label">Rent Excludes</label>
                            <textarea class="form-control @error('rent_excludes') is-invalid @enderror" 
                                      id="rent_excludes" name="rent_excludes" rows="3" 
                                      placeholder="What's not included in the rent">{{ old('rent_excludes') }}</textarea>
                            @error('rent_excludes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rental_process" class="form-label">Rental Process</label>
                            <textarea class="form-control @error('rental_process') is-invalid @enderror" 
                                      id="rental_process" name="rental_process" rows="4" 
                                      placeholder="Steps to follow for rental process">{{ old('rental_process') }}</textarea>
                            @error('rental_process')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dos_donts" class="form-label">Dos and Don'ts</label>
                            <textarea class="form-control @error('dos_donts') is-invalid @enderror" 
                                      id="dos_donts" name="dos_donts" rows="4" 
                                      placeholder="Rules and guidelines for tenants">{{ old('dos_donts') }}</textarea>
                            @error('dos_donts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="terms_conditions" class="form-label">Terms & Conditions</label>
                            <textarea class="form-control @error('terms_conditions') is-invalid @enderror" 
                                      id="terms_conditions" name="terms_conditions" rows="4" 
                                      placeholder="Rental terms and conditions">{{ old('terms_conditions') }}</textarea>
                            @error('terms_conditions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Explore Nearby Section -->
                        <div class="mb-3">
                            <label class="form-label">Explore Nearby</label>
                            <div id="exploreNearbyContainer">
                                @php
                                    $exploreNearby = old('explore_nearby', []);
                                    if (is_string($exploreNearby)) {
                                        $exploreNearby = json_decode($exploreNearby, true) ?? [];
                                    }
                                    if (!is_array($exploreNearby)) {
                                        $exploreNearby = [];
                                    }
                                @endphp
                                @if(!empty($exploreNearby))
                                    @foreach($exploreNearby as $index => $item)
                                        <div class="input-group mb-2 explore-nearby-item" data-index="{{ $index }}">
                                            <input type="text" 
                                                   class="form-control explore-nearby-input" 
                                                   name="explore_nearby[{{ $index }}]" 
                                                   value="{{ $item }}" 
                                                   placeholder="e.g., Hospital 3kms, Mall 1km">
                                            <button type="button" class="btn btn-outline-danger remove-explore-nearby" type="button">
                                                <i class="bi bi-trash"></i> Remove
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 explore-nearby-item" data-index="0">
                                        <input type="text" 
                                               class="form-control explore-nearby-input" 
                                               name="explore_nearby[0]" 
                                               value="" 
                                               placeholder="e.g., Hospital 3kms, Mall 1km">
                                        <button type="button" class="btn btn-outline-danger remove-explore-nearby" type="button">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-primary mt-2" id="addExploreNearby">
                                <i class="bi bi-plus-circle"></i> Add More
                            </button>
                            <input type="hidden" id="explore_nearby_json" name="explore_nearby_json">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sorting -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sorting</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" 
                                   min="0" placeholder="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="home_sort" class="form-label">Home Sort Order</label>
                            <input type="number" class="form-control @error('home_sort') is-invalid @enderror" 
                                   id="home_sort" name="home_sort" value="{{ old('home_sort', 0) }}" 
                                   min="0" placeholder="0">
                            @error('home_sort')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            </div>{{-- end wizard step 2 --}}

            <div class="wizard-step" data-step="3">
            <div class="pe-step-panel-title">
                <span class="icon"><i class="bi bi-card-text"></i></span>
                <div>
                    <h2>Content & Amenities</h2>
                    <p>Descriptions, amenities, and location feature minutes</p>
                </div>
            </div>
            <!-- Amenities -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Amenities</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="amenities" class="form-label">Select Amenities</label>
                        <select class="form-select @error('amenities') is-invalid @enderror" 
                                id="amenities" name="amenities[]" multiple>
                            @foreach($amenities as $amenity)
                                <option value="{{ $amenity->id }}" {{ in_array($amenity->id, old('amenities', [])) ? 'selected' : '' }}>
                                    {{ $amenity->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('amenities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amenities_description" class="form-label">Amenities Description</label>
                        <textarea class="form-control @error('amenities_description') is-invalid @enderror" 
                                  id="amenities_description" name="amenities_description" rows="3" 
                                  placeholder="Describe the amenities available">{{ old('amenities_description') }}</textarea>
                        @error('amenities_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Descriptions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Descriptions</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="property_description" class="form-label">Property Description</label>
                        <textarea class="form-control @error('property_description') is-invalid @enderror" 
                                  id="property_description" name="property_description" rows="5" 
                                  placeholder="Detailed description of the property">{{ old('property_description') }}</textarea>
                        @error('property_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="youtube_url" class="form-label">YouTube URL</label>
                        <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" 
                               id="youtube_url" name="youtube_url" 
                               value="{{ old('youtube_url') }}" 
                               placeholder="https://www.youtube.com/watch?v=...">
                        @error('youtube_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Optional: Add a YouTube video URL for the property</div>
                    </div>

                    <div class="mb-3">
                        <label for="gallery_description" class="form-label">Gallery Description</label>
                        <textarea class="form-control @error('gallery_description') is-invalid @enderror" 
                                  id="gallery_description" name="gallery_description" rows="3" 
                                  placeholder="Description for property gallery">{{ old('gallery_description') }}</textarea>
                        @error('gallery_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="floor_plan_description" class="form-label">Floor Plan Description</label>
                        <textarea class="form-control @error('floor_plan_description') is-invalid @enderror" 
                                  id="floor_plan_description" name="floor_plan_description" rows="5" 
                                  placeholder="Detailed floor plan description">{{ old('floor_plan_description') }}</textarea>
                        @error('floor_plan_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="offer_text" class="form-label">Offer Text</label>
                        <textarea class="form-control @error('offer_text') is-invalid @enderror" 
                                  id="offer_text" name="offer_text" rows="2" 
                                  placeholder="Special offers or deals">{{ old('offer_text') }}</textarea>
                        @error('offer_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Location Features -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Location Features</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Enter distance in minutes. Use <strong>0</strong> or leave empty to hide on the website.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="airport" class="form-label">Airport (minutes)</label>
                            <input type="number" min="0" step="1" class="form-control @error('airport') is-invalid @enderror"
                                   id="airport" name="airport" value="{{ old('airport') }}" placeholder="e.g. 30">
                            @error('airport')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="entertainment" class="form-label">Entertainment (minutes)</label>
                            <input type="number" min="0" step="1" class="form-control @error('entertainment') is-invalid @enderror"
                                   id="entertainment" name="entertainment" value="{{ old('entertainment') }}" placeholder="e.g. 10">
                            @error('entertainment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="national_highway" class="form-label">National Highway (minutes)</label>
                            <input type="number" min="0" step="1" class="form-control @error('national_highway') is-invalid @enderror"
                                   id="national_highway" name="national_highway" value="{{ old('national_highway') }}" placeholder="e.g. 5">
                            @error('national_highway')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="hospitals" class="form-label">Hospitals (minutes)</label>
                            <input type="number" min="0" step="1" class="form-control @error('hospitals') is-invalid @enderror"
                                   id="hospitals" name="hospitals" value="{{ old('hospitals') }}" placeholder="e.g. 8">
                            @error('hospitals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-0">
                        <label for="education" class="form-label">Education (minutes)</label>
                        <input type="number" min="0" step="1" class="form-control @error('education') is-invalid @enderror"
                               id="education" name="education" value="{{ old('education') }}" placeholder="e.g. 2">
                        @error('education')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Location Features Description</h5>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <label for="location_features" class="form-label">Location Features</label>
                        <textarea class="form-control @error('location_features') is-invalid @enderror"
                                  id="location_features" name="location_features" rows="4"
                                  placeholder="Detailed location features">{{ old('location_features') }}</textarea>
                        @error('location_features')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            </div>{{-- end wizard step 3 --}}

            <div class="wizard-step" data-step="4">
            <div class="pe-step-panel-title">
                <span class="icon"><i class="bi bi-map"></i></span>
                <div>
                    <h2>Project & Map</h2>
                    <p>Highlights, FAQ, price list, and map embed</p>
                </div>
            </div>
            <!-- Project Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Project Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="project_highlights_title" class="form-label">Project Highlights Title</label>
                        <textarea class="form-control @error('project_highlights_title') is-invalid @enderror" 
                                  id="project_highlights_title" name="project_highlights_title" rows="3" 
                                  placeholder="Key highlights of the project">{{ old('project_highlights_title') }}</textarea>
                        @error('project_highlights_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="highlight_image" class="form-label">Highlight Image</label>
                        <input type="file" class="form-control @error('highlight_image') is-invalid @enderror" 
                               id="highlight_image" name="highlight_image" 
                               accept="image/*" placeholder="Select highlight image">
                        <div class="form-text">Select one image to showcase property highlights. Supported formats: JPG, PNG, GIF, WEBP, AVIF</div>
                        @error('highlight_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Image Preview Container -->
                        <div id="highlight-image-preview" class="mt-3" style="display: none;">
                            <h6>Selected Image:</h6>
                            <div id="highlight-image-list" class="row"></div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="price_list" class="form-label">Price List</label>
                        <textarea class="form-control @error('price_list') is-invalid @enderror" 
                                  id="price_list" name="price_list" rows="3" 
                                  placeholder="Detailed price list">{{ old('price_list') }}</textarea>
                        @error('price_list')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @include('admin.properties.partials.faq-fields')
                </div>
            </div>

            <!-- Map -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Map</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="map_code" class="form-label">Google Map Embed Code</label>
                        <textarea class="form-control @error('map_code') is-invalid @enderror" 
                                  id="map_code" name="map_code" rows="8" 
                                  placeholder="Paste your Google Maps embed iframe code here (e.g., &lt;iframe src=&quot;https://www.google.com/maps/embed?pb=...&quot;&gt;&lt;/iframe&gt;)">{{ old('map_code') }}</textarea>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle"></i> Paste the complete Google Maps embed iframe code. You can get this from Google Maps by clicking "Share" → "Embed a map" → Copy the iframe code.
                        </small>
                        @error('map_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="map_text" class="form-label">Map Text</label>
                        <textarea class="form-control @error('map_text') is-invalid @enderror" 
                                  id="map_text" name="map_text" rows="2" 
                                  placeholder="Map description or directions">{{ old('map_text') }}</textarea>
                        @error('map_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            </div>{{-- end wizard step 4 --}}

            <div class="wizard-step" data-step="5">
            <div class="pe-step-panel-title">
                <span class="icon"><i class="bi bi-search"></i></span>
                <div>
                    <h2>SEO & Publish</h2>
                    <p>Search metadata — gallery images can be added after creating</p>
                </div>
            </div>
            <!-- SEO -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">SEO</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                               id="meta_title" name="meta_title" value="{{ old('meta_title') }}" 
                               placeholder="SEO title">
                        <div class="form-text"><span id="meta_title_count">{{ strlen(old('meta_title', '')) }}</span> characters</div>
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                  id="meta_description" name="meta_description" rows="3" 
                                  placeholder="SEO description">{{ old('meta_description') }}</textarea>
                        <div class="form-text"><span id="meta_description_count">{{ strlen(old('meta_description', '')) }}</span> characters</div>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="alert alert-light border mb-0">
                <i class="bi bi-images me-2 text-success"></i>
                After creating the property, open Edit to upload gallery images.
            </div>
            </div>{{-- end wizard step 5 --}}
        </div>

        <div class="col-lg-4">
            <div class="pe-sidebar">
            <!-- Preview Card -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Live Preview</h6>
                </div>
                <div class="card-body">
                    <h5 id="preview-name" class="mb-2">Property Name</h5>
                    <p id="preview-alias" class="text-muted small mb-2">Alias Name</p>
                    <code id="preview-slug" class="small text-muted mb-2 d-block">property-slug</code>
                    <div id="preview-type" class="mb-2">
                        <span class="badge bg-primary">Category</span>
                        <span class="badge bg-secondary">Condition</span>
                        <br><small>Type</small>
                    </div>
                    <div id="preview-price" class="mb-2">
                        <strong>Price</strong>
                        <br><small class="text-muted">Area</small>
                    </div>
                    <div id="preview-status" class="mb-2">
                        <span class="badge bg-success">Status</span>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">Tips</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Use descriptive property names
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Keep slugs URL-friendly
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Add all relevant amenities
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Complete SEO fields for better search
                        </li>
                    </ul>
                </div>
            </div>
            </div>{{-- pe-sidebar --}}
        </div>
    </div>

    <div class="pe-nav">
        <div class="pe-nav-inner">
            <div class="pe-nav-meta">
                Step <strong id="peCurrentStepLabel">1</strong> of <strong>5</strong>
                <span class="d-none d-md-inline"> · <span id="peCurrentStepName">Basics</span></span>
            </div>
            <div class="pe-nav-actions">
                <button type="button" class="btn btn-outline-secondary pe-btn" id="pePrevBtn" disabled>
                    <i class="bi bi-arrow-left me-1"></i>Previous
                </button>
                <button type="button" class="btn btn-primary pe-btn pe-btn-primary" id="peNextBtn">
                    Next<i class="bi bi-arrow-right ms-1"></i>
                </button>
                <button type="submit" class="btn btn-success pe-btn d-none" id="peSaveBtn">
                    <i class="bi bi-save me-1"></i>Create Property
                </button>
                <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary pe-btn d-none d-sm-inline-flex">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</form>
</div>{{-- property-edit-wizard --}}
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Step wizard (same flow as edit)
    const stepNames = {
        1: 'Basics',
        2: 'Location & Price',
        3: 'Content',
        4: 'Project & Map',
        5: 'SEO & Publish'
    };
    let currentStep = 1;
    const totalSteps = 5;

    function goToStep(step) {
        step = Math.max(1, Math.min(totalSteps, Number(step) || 1));
        currentStep = step;

        document.querySelectorAll('.wizard-step').forEach(function (el) {
            el.classList.toggle('is-active', Number(el.dataset.step) === step);
        });
        document.querySelectorAll('[data-goto-step]').forEach(function (btn) {
            const n = Number(btn.dataset.gotoStep);
            btn.classList.toggle('is-active', n === step);
            btn.classList.toggle('is-done', n < step);
        });

        const progress = document.getElementById('peProgressBar');
        if (progress) {
            progress.style.width = ((step / totalSteps) * 100) + '%';
        }

        const label = document.getElementById('peCurrentStepLabel');
        const name = document.getElementById('peCurrentStepName');
        if (label) label.textContent = String(step);
        if (name) name.textContent = stepNames[step] || '';

        const prevBtn = document.getElementById('pePrevBtn');
        const nextBtn = document.getElementById('peNextBtn');
        const saveBtn = document.getElementById('peSaveBtn');
        if (prevBtn) prevBtn.disabled = step === 1;
        if (nextBtn) nextBtn.classList.toggle('d-none', step === totalSteps);
        if (saveBtn) saveBtn.classList.toggle('d-none', step !== totalSteps);

        if (typeof window.initPropertyEditors === 'function') {
            setTimeout(window.initPropertyEditors, 80);
        }
        if (typeof window.initFaqEditors === 'function') {
            setTimeout(window.initFaqEditors, 100);
        }
        if (step === 2 && typeof window.toggleRentalFields === 'function') {
            window.toggleRentalFields();
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.querySelectorAll('[data-goto-step]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            goToStep(btn.dataset.gotoStep);
        });
    });
    const prevBtnEl = document.getElementById('pePrevBtn');
    const nextBtnEl = document.getElementById('peNextBtn');
    if (prevBtnEl) {
        prevBtnEl.addEventListener('click', function () { goToStep(currentStep - 1); });
    }
    if (nextBtnEl) {
        nextBtnEl.addEventListener('click', function () { goToStep(currentStep + 1); });
    }

    const invalid = document.querySelector('#propertyForm .is-invalid');
    if (invalid) {
        const stepEl = invalid.closest('.wizard-step');
        if (stepEl && stepEl.dataset.step) {
            goToStep(stepEl.dataset.step);
        }
    } else {
        goToStep(1);
    }

    // Initialize Select2 for amenities
    if (document.getElementById('amenities')) {
        $('#amenities').select2({
            theme: 'bootstrap-5',
            placeholder: 'Select amenities',
            allowClear: true
        });
    }

    // Update preview
    function updatePreview() {
        const name = document.getElementById('name').value || 'Property Name';
        const alias = document.getElementById('alias_name').value || 'Alias Name';
        const slug = document.getElementById('slug').value || 'property-slug';
        const price = document.getElementById('price').value || '0';
        // Price unit is now automatically determined
        const area = document.getElementById('area_sq_ft').value || '0';
        const status = document.getElementById('property_status_id').value || '';
        
        document.getElementById('preview-name').textContent = name;
        document.getElementById('preview-alias').textContent = alias;
        document.getElementById('preview-slug').textContent = slug;
        
        // Format price using Indian numbering system
        const formattedPrice = formatPriceIndian(parseFloat(price) || 0);
        document.getElementById('preview-price').innerHTML = `<strong>${formattedPrice}</strong><br><small class="text-muted">${area ? area + ' sq ft' : 'Area not specified'}</small>`;
        
        // Format status
        const statusText = status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
        document.getElementById('preview-status').innerHTML = `<span class="badge bg-success">${statusText}</span>`;
    }

    // Show/hide residential fields based on property category
    function toggleResidentialFields() {
        const propertyCategorySelect = document.getElementById('property_category_id');
        const residentialFields = document.getElementById('residentialFields');
        
        if (propertyCategorySelect.value) {
            // Get the selected option text to check if it's residential or holiday homes
            const selectedOption = propertyCategorySelect.options[propertyCategorySelect.selectedIndex];
            const optionText = selectedOption.text.toLowerCase();
            
            // Show residential fields if the property category contains "residential" or "holiday"
            if (optionText.includes('residential') || optionText.includes('holiday')) {
                residentialFields.style.display = 'block';
            } else {
                residentialFields.style.display = 'none';
                // Clear residential field values when hidden
                const riseNone = document.getElementById('rise_none');
                if (riseNone) {
                    riseNone.checked = true;
                }
                residentialFields.querySelectorAll('input[name="bedroom_configs[]"]').forEach(function (cb) {
                    cb.checked = false;
                });
            }
        } else {
            residentialFields.style.display = 'none';
        }
    }

    // Auto-generate slug from name (only on create form)
    let slugManuallyEdited = false;
    let isGeneratingSlug = false;
    
    // Check if slug already has a value (from old input or pre-filled)
    const slugField = document.getElementById('slug');
    if (slugField.value && slugField.value.trim().length > 0) {
        slugManuallyEdited = true; // Don't auto-generate if slug already exists
    }
    
    // Track if slug is manually edited
    slugField.addEventListener('input', function() {
        // Check if user is typing (not programmatically setting)
        if (!isGeneratingSlug) {
            slugManuallyEdited = true;
        }
        updatePreview();
    });
    
    // Function to generate slug with all required fields
    function generateSlugFromFields() {
        const name = document.getElementById('name')?.value.trim();
        const locality = document.getElementById('locality')?.value.trim();
        const locationId = document.getElementById('location_id')?.value;
        
        // Only auto-generate if slug hasn't been manually edited and name is not empty
        if (!slugManuallyEdited && name && name.length > 0) {
            generateSlug(name, locality, locationId);
        }
    }
    
    // Generate slug from name, locality, and location via AJAX
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value.trim();
        
        // Only auto-generate if slug hasn't been manually edited and name is not empty
        if (!slugManuallyEdited && name.length > 0) {
            // Debounce: wait 500ms after user stops typing
            clearTimeout(this.slugTimeout);
            this.slugTimeout = setTimeout(function() {
                generateSlugFromFields();
            }, 500);
        }
        
        updatePreview();
    });
    
    // Also generate slug when locality or location changes
    const localityField = document.getElementById('locality');
    const locationField = document.getElementById('location_id');
    
    if (localityField) {
        localityField.addEventListener('input', function() {
            if (!slugManuallyEdited) {
                clearTimeout(this.slugTimeout);
                this.slugTimeout = setTimeout(function() {
                    generateSlugFromFields();
                }, 500);
            }
        });
    }
    
    if (locationField) {
        locationField.addEventListener('change', function() {
            if (!slugManuallyEdited) {
                generateSlugFromFields();
            }
        });
    }
    
    // Function to generate slug via AJAX
    function generateSlug(name, locality, locationId) {
        if (!name || name.length === 0) {
            return;
        }
        
        isGeneratingSlug = true;
        
        const requestData = { name: name };
        if (locality && locality.length > 0) {
            requestData.locality = locality;
        }
        if (locationId && locationId.length > 0) {
            requestData.location_id = locationId;
        }
        
        fetch('{{ route("properties.generate-slug") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.slug && !slugManuallyEdited) {
                document.getElementById('slug').value = data.slug;
                updatePreview();
            }
            isGeneratingSlug = false;
        })
        .catch(error => {
            console.error('Error generating slug:', error);
            isGeneratingSlug = false;
        });
    }
    
    // Add event listeners
    document.getElementById('alias_name').addEventListener('input', updatePreview);
    document.getElementById('price').addEventListener('input', updatePreview);
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
    // Live price formatting function
    function formatPriceIndian(price) {
        if (!price || price <= 0) {
            return 'Price on Request';
        }

        if (price < 100000) {
            // Less than 1 lakh, show in thousands
            const priceInThousands = price / 1000;
            const formattedPrice = Math.round(priceInThousands);
            return "₹ " + formattedPrice + "K";
        } else if (price < 10000000) {
            // Less than 1 crore, show in lakhs (truncate to 2 decimals, no rounding)
            const priceInLakhs = Math.floor(price / 1000) / 100;
            return "₹ " + priceInLakhs.toFixed(2) + " Lakhs";
        } else {
            // 1 crore or more, show in crores (truncate to 2 decimals, no rounding)
            const priceInCrores = Math.floor(price / 100000) / 100;
            return "₹ " + priceInCrores.toFixed(2) + " Cr";
        }
    }

    // Update price display in real-time
    function updatePriceDisplay() {
        const price = parseFloat(document.getElementById('price').value) || 0;
        document.getElementById('priceDisplay').textContent = formatPriceIndian(price);
    }

    // Add event listener for live price updates
    document.getElementById('price').addEventListener('input', updatePriceDisplay);
    document.getElementById('area_sq_ft').addEventListener('input', updatePreview);
    document.getElementById('property_status_id').addEventListener('change', updatePreview);
    document.getElementById('property_category_id').addEventListener('change', toggleResidentialFields);
    
    // Toggle rental fields visibility
    function toggleRentalFields() {
        const isRentalCheckbox = document.getElementById('is_rental');
        const rentalFields = document.getElementById('rentalFields');
        const categorySelect = document.getElementById('property_category_id');
        if (!isRentalCheckbox || !rentalFields || !categorySelect) {
            return;
        }

        // Show rental fields if rental checkbox is checked OR category is rental (ID 4)
        if (isRentalCheckbox.checked || categorySelect.value == 4) {
            rentalFields.style.display = 'block';
            if (categorySelect.value == 4) {
                isRentalCheckbox.checked = true;
            }
            ['rent_includes', 'rent_excludes', 'rental_process', 'dos_donts', 'terms_conditions'].forEach(function (textareaId) {
                const textarea = document.getElementById(textareaId);
                if (!textarea || textarea.dataset.editorReady === '1') {
                    return;
                }
                if (typeof tinymce !== 'undefined' && tinymce.get(textareaId)) {
                    textarea.dataset.editorReady = '1';
                    return;
                }
                ClassicEditor
                    .create(textarea, window.getAdminCkeditorConfig({ height: 240, min_height: 160 }))
                    .then(function (api) {
                        if (api && api._skippedHidden) {
                            return;
                        }
                        textarea.dataset.editorReady = '1';
                    })
                    .catch(function (error) {
                        console.error('Error initializing editor for', textareaId, ':', error);
                    });
            });
        } else {
            rentalFields.style.display = 'none';
            if (categorySelect.value != 4) {
                isRentalCheckbox.checked = false;
            }
        }
    }

    document.getElementById('is_rental').addEventListener('change', toggleRentalFields);
    document.getElementById('property_category_id').addEventListener('change', toggleRentalFields);
    
    // Explore Nearby functionality
    function updateExploreNearbyJSON() {
        const items = [];
        document.querySelectorAll('.explore-nearby-input').forEach(function(input) {
            const value = input.value.trim();
            if (value) {
                items.push(value);
            }
        });
        document.getElementById('explore_nearby_json').value = JSON.stringify(items);
    }

    // Add new explore nearby item
    document.getElementById('addExploreNearby').addEventListener('click', function() {
        const container = document.getElementById('exploreNearbyContainer');
        const existingItems = container.querySelectorAll('.explore-nearby-item');
        const nextIndex = existingItems.length;
        
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 explore-nearby-item';
        newItem.setAttribute('data-index', nextIndex);
        newItem.innerHTML = `
            <input type="text" 
                   class="form-control explore-nearby-input" 
                   name="explore_nearby[${nextIndex}]" 
                   value="" 
                   placeholder="e.g., Hospital 3kms, Mall 1km">
            <button type="button" class="btn btn-outline-danger remove-explore-nearby" type="button">
                <i class="bi bi-trash"></i> Remove
            </button>
        `;
        container.appendChild(newItem);
        updateExploreNearbyJSON();
        
        // Focus on the new input
        newItem.querySelector('.explore-nearby-input').focus();
    });

    // Remove explore nearby item
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-explore-nearby')) {
            const item = e.target.closest('.explore-nearby-item');
            const container = document.getElementById('exploreNearbyContainer');
            const items = container.querySelectorAll('.explore-nearby-item');
            
            // Don't remove if it's the last item
            if (items.length > 1) {
                item.remove();
                // Reindex remaining items
                container.querySelectorAll('.explore-nearby-item').forEach(function(el, index) {
                    el.setAttribute('data-index', index);
                    const input = el.querySelector('.explore-nearby-input');
                    input.setAttribute('name', 'explore_nearby[' + index + ']');
                });
                updateExploreNearbyJSON();
            } else {
                // Clear the input instead of removing
                item.querySelector('.explore-nearby-input').value = '';
                updateExploreNearbyJSON();
            }
        }
    });

    // Update JSON when input changes
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('explore-nearby-input')) {
            updateExploreNearbyJSON();
        }
    });

    // Initialize JSON on page load
    updateExploreNearbyJSON();

    // Initial preview update and residential fields check
    updatePreview();
    toggleResidentialFields();
    toggleRentalFields();
    updateSeoCharacterCounts();

    // Highlight image preview functionality
    const highlightImageInput = document.getElementById('highlight_image');
    const previewContainer = document.getElementById('highlight-image-preview');
    const imageList = document.getElementById('highlight-image-list');

    highlightImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file && file.type.startsWith('image/')) {
            previewContainer.style.display = 'block';
            imageList.innerHTML = '';
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-3 mb-2';
                col.innerHTML = `
                    <div class="card">
                        <img src="${e.target.result}" class="card-img-top" style="height: 100px; object-fit: cover;" alt="Preview">
                        <div class="card-body p-2">
                            <small class="text-muted">${file.name}</small>
                        </div>
                    </div>
                `;
                imageList.appendChild(col);
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });

    // Initialize TinyMCE for description textarea fields (skip hidden ones)
    const textareaIds = [
        'property_description',
        'gallery_description', 
        'floor_plan_description',
        'offer_text',
        'amenities_description',
        'location_features',
        'project_highlights_title',
        'price_list',
        'address',
        'rent_includes',
        'rent_excludes',
        'rental_process',
        'dos_donts',
        'terms_conditions'
    ];

    window.initPropertyEditors = function initPropertyEditors() {
        textareaIds.forEach(function(textareaId) {
            const textarea = document.getElementById(textareaId);
            if (!textarea) {
                return;
            }

            if (typeof tinymce !== 'undefined' && tinymce.get(textarea.id || textareaId)) {
                textarea.dataset.editorReady = '1';
                return;
            }

            if (textarea.dataset.editorReady === '1') {
                return;
            }

            const inactiveStep = textarea.closest('.wizard-step:not(.is-active)');
            const hiddenParent = textarea.closest('[style*="display: none"], [hidden]');
            if (inactiveStep || hiddenParent) {
                return;
            }

            ClassicEditor
                .create(textarea, window.getAdminCkeditorConfig({ height: 240, min_height: 160 }))
                .then(function (api) {
                    if (api && api._skippedHidden) {
                        return;
                    }
                    textarea.dataset.editorReady = '1';
                })
                .catch(function (error) {
                    console.error('Error initializing editor for', textareaId, ':', error);
                });
        });
    };

    window.toggleRentalFields = toggleRentalFields;

    // Defer so page layout paints first
    setTimeout(window.initPropertyEditors, 50);
});
</script>
@include('admin.properties.partials.faq-script')
@include('admin.properties.partials.category-type-filter')
@endpush
