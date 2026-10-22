<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Partner;
use App\Models\Agent;
use App\Models\Location;
use App\Models\PropertyType;
use App\Models\PropertyCategory;
use App\Models\PropertyCondition;
use App\Models\Amenity;
use App\Models\BedroomOption;
use App\Models\PropertyStatus;
use App\Models\Badge;
use App\Models\Area;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Support\SeoRestrictions;
use App\Traits\LogsActivity;

class PropertyController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of properties
     */
    public function index(Request $request)
    {
        $query = Property::with(['partner', 'agent', 'location', 'propertyType', 'propertyCategory', 'propertyCondition', 'amenities', 'badge']);

        $showTrashed = $request->boolean('show_trashed') && auth()->user()?->isSuperAdmin();
        if ($showTrashed) {
            $query->onlyTrashed();
        }

        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->search($search);
        }

        if ($request->has('partner') && !empty($request->input('partner'))) {
            $query->byPartner($request->input('partner'));
        }

        if ($request->has('agent') && !empty($request->input('agent'))) {
            $query->byAgent($request->input('agent'));
        }

        if ($request->has('location') && !empty($request->input('location'))) {
            $query->byLocation($request->input('location'));
        }

        if ($request->has('type') && !empty($request->input('type'))) {
            $query->byType($request->input('type'));
        }

        if ($request->has('category') && !empty($request->input('category'))) {
            $query->where('property_category_id', $request->input('category'));
        }

        if ($request->has('status') && !empty($request->input('status'))) {
            if ($request->input('status') === 'featured') {
                $query->featured();
            } elseif ($request->input('status') === 'available') {
                $query->available();
            } elseif ($request->input('status') === 'sold') {
                $query->where('is_sold', true);
            }
        }

        if ($request->has('property_status') && !empty($request->input('property_status'))) {
            $query->where('property_status_id', $request->input('property_status'));
        }

        // Handle sorting
        $sortBy = $request->input('sort_by', 'sort_order');
        $sortOrder = $request->input('sort_order', 'asc');
        
        // Validate sort order
        $sortOrder = in_array(strtolower($sortOrder), ['asc', 'desc']) ? strtolower($sortOrder) : 'asc';
        
        if ($sortBy === 'created_at') {
            $query->orderBy('created_at', $sortOrder);
        } elseif ($sortBy === 'name') {
            $query->orderBy('name', $sortOrder);
        } elseif ($sortBy === 'sort_order') {
            $query->orderBy('sort_order', $sortOrder)->orderBy('name', $sortOrder);
        } else {
            // Default sorting - respect sort_order parameter
            $query->orderBy('sort_order', $sortOrder)->orderBy('name', $sortOrder);
        }
        
        $properties = $query->paginate(20)->withQueryString();
        
        // Get filter options
        $partners = Partner::active()->ordered()->get();
        $agents = Agent::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $propertyTypes = PropertyType::active()->ordered()->get();
        $propertyCategories = PropertyCategory::active()->ordered()->get();

        return $this->viewWithRoute('admin.properties.index', compact('properties', 'partners', 'agents', 'locations', 'propertyTypes', 'propertyCategories'));
    }

    /**
     * Show the form for creating a new property
     */
    public function create()
    {
        $partners = Partner::active()->ordered()->get();
        $agents = Agent::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $propertyTypes = PropertyType::active()->ordered()->get();
        $propertyCategories = PropertyCategory::active()->ordered()->get();
        $propertyConditions = PropertyCondition::active()->ordered()->get();
        $amenities = Amenity::active()->ordered()->get();
        $bedroomOptions = BedroomOption::active()->ordered()->get();
        $propertyStatuses = PropertyStatus::active()->ordered()->get();
        $badges = Badge::orderBy('name', 'asc')->get();
        $areas = Area::ordered()->get();

        return $this->viewWithRoute('admin.properties.create', compact('partners', 'agents', 'locations', 'propertyTypes', 'propertyCategories', 'propertyConditions', 'amenities', 'bedroomOptions', 'propertyStatuses', 'badges', 'areas'));
    }

    /**
     * Store a newly created property
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:properties,slug',
            'alias_name' => 'nullable|string|max:255',
            'partner_id' => 'nullable|exists:partners,id',
            'agent_id' => 'nullable|exists:agents,id',
            'location_id' => 'nullable|exists:locations,id',
            'area_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Allow null, empty string, or 0
                    if ($value === null || $value === '' || $value === '0' || $value === 0) {
                        return;
                    }
                    
                    // Convert to integer
                    $areaId = (int) $value;
                    
                    // Check if area exists
                    if ($areaId > 0 && !Area::where('id', $areaId)->exists()) {
                        $fail('The selected area does not exist. Please select a valid area or leave it empty.');
                    }
                },
            ],
            'property_type_id' => 'nullable|exists:property_types,id',
            'property_category_id' => 'nullable|exists:property_categories,id',
            'property_condition_id' => 'nullable|exists:property_conditions,id',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'badge_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Allow null, empty string, or 0
                    if ($value === null || $value === '' || $value === 0 || $value === '0') {
                        return;
                    }
                    
                    // Convert to integer
                    $badgeId = (int) $value;
                    
                    // Check if badge exists
                    if ($badgeId > 0 && !Badge::where('id', $badgeId)->exists()) {
                        $fail('The selected badge does not exist. Please select a valid badge or leave it empty.');
                    }
                },
            ],
            'locality' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'rera_reg_no' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'home_sort' => 'nullable|integer',
            'price' => 'nullable|numeric|min:0',
            'monthly_rent' => 'nullable|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'one_time_fees' => 'nullable|numeric|min:0',
            'total_payable' => 'nullable|numeric|min:0',
            'rent_includes' => 'nullable|string',
            'rent_excludes' => 'nullable|string',
            'rental_process' => 'nullable|string',
            'dos_donts' => 'nullable|string',
            'lock_in_period_days' => 'nullable|integer|min:0',
            'notice_period_days' => 'nullable|integer|min:0',
            'terms_conditions' => 'nullable|string',
            'is_rental' => 'boolean',
            'area_sq_ft' => 'nullable|integer|min:0',
            'rise' => 'nullable|in:high,low',
            'bedroom_configs' => 'nullable|array',
            'bedroom_configs.*' => 'exists:bedroom_options,id',
            'possession' => 'nullable|date',
            'property_status_id' => 'nullable|exists:property_statuses,id',
            'youtube_url' => 'nullable|url',
            'is_sold' => 'boolean',
            'is_featured' => 'boolean',
            'amenities_description' => 'nullable|string',
            'property_description' => 'nullable|string',
            'gallery_description' => 'nullable|string',
            'floor_plan_description' => 'nullable|string',
            'offer_text' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'airport' => 'nullable|string',
            'entertainment' => 'nullable|string',
            'national_highway' => 'nullable|string',
            'hospitals' => 'nullable|string',
            'education' => 'nullable|string',
            'project_highlights_title' => 'nullable|string',
            'highlight_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:5120',
            'location_features' => 'nullable|string',
            'price_list' => 'nullable|string',
            'faq_questions' => 'nullable|array',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers' => 'nullable|array',
            'faq_answers.*' => 'nullable|string',
            'map_code' => 'nullable|string',
            'map_text' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        // Auto-set is_rental to true if category is rental (ID 4)
        $data = $request->except(['amenities', 'highlight_image', 'bedroom_configs', 'explore_nearby', 'explore_nearby_json', 'faq_questions', 'faq_answers']);
        if ($request->property_category_id == 4) {
            $data['is_rental'] = true;
        }

        // Rental pages show monthly_rent; fall back to price when rent amount wasn't filled separately
        if (!empty($data['is_rental']) && empty($data['monthly_rent']) && !empty($data['price'])) {
            $data['monthly_rent'] = $data['price'];
        }
        
        // Set is_active to false by default if not explicitly provided or if it's empty/0
        if (!isset($data['is_active']) || $data['is_active'] === null || $data['is_active'] === '' || $data['is_active'] === '0' || $data['is_active'] === 0) {
            $data['is_active'] = false;
        } else {
            // Convert checkbox value to boolean (if it's '1' or 1, set to true)
            $data['is_active'] = (bool) $data['is_active'];
        }

        // Handle explore_nearby - convert to JSON array
        if ($request->has('explore_nearby_json') && !empty($request->explore_nearby_json)) {
            $exploreNearby = json_decode($request->explore_nearby_json, true);
            if (is_array($exploreNearby)) {
                // Filter out empty values
                $exploreNearby = array_filter($exploreNearby, function($item) {
                    return !empty(trim($item));
                });
                $data['explore_nearby'] = array_values($exploreNearby); // Re-index array
            } else {
                $data['explore_nearby'] = null;
            }
        } elseif ($request->has('explore_nearby') && is_array($request->explore_nearby)) {
            // Fallback: if JSON wasn't provided, use array input
            $exploreNearby = array_filter($request->explore_nearby, function($item) {
                return !empty(trim($item));
            });
            $data['explore_nearby'] = array_values($exploreNearby);
        } else {
            $data['explore_nearby'] = null;
        }

        // Handle area_id - ensure it's valid or null
        // Get area_id from request
        $areaIdValue = $request->input('area_id');
        
        // Process area_id if it's provided in the request
        if ($areaIdValue !== null) {
            // Convert empty/zero values to null
            if ($areaIdValue === '' || $areaIdValue === '0' || $areaIdValue === 0) {
                $data['area_id'] = null;
            } else {
                // Convert to integer and verify it exists
                $areaId = (int) $areaIdValue;
                if ($areaId > 0) {
                    // Verify area exists using direct DB query
                    $areaExists = DB::table('areas')->where('id', $areaId)->exists();
                    if ($areaExists) {
                        $data['area_id'] = $areaId;
                    } else {
                        // Area doesn't exist, set to null
                        $data['area_id'] = null;
                    }
                } else {
                    $data['area_id'] = null;
                }
            }
        } else {
            // If not provided, set to null for new properties
            $data['area_id'] = null;
        }

        // Handle badge_id - ensure it's valid or null
        // Convert empty string to null
        if (isset($data['badge_id']) && ($data['badge_id'] === '' || $data['badge_id'] === '0' || $data['badge_id'] === 0)) {
            $data['badge_id'] = null;
        } elseif (isset($data['badge_id']) && $data['badge_id'] !== null) {
            // Verify badge exists
            $badgeId = (int) $data['badge_id'];
            if ($badgeId > 0) {
                if (!Badge::where('id', $badgeId)->exists()) {
                    // Badge doesn't exist, set to null
                    $data['badge_id'] = null;
                } else {
                    $data['badge_id'] = $badgeId;
                }
            } else {
                $data['badge_id'] = null;
            }
        } else {
            $data['badge_id'] = null;
        }

        // Generate slug if not provided or empty (format: project-name-locality-city)
        if (empty($data['slug'])) {
            $data['slug'] = \App\Helpers\PropertySlugHelper::build(
                $data['name'] ?? null,
                $data['locality'] ?? null,
                $data['location_id'] ?? null
            );
        }

        $property = Property::create($data);
        
        // Log the activity
        $this->logCreate($property);

        // Handle bedroom configurations
        if ($request->has('bedroom_configs')) {
            $property->bedroomOptions()->sync($request->input('bedroom_configs'));
        }

        $this->syncPropertyFaqs(
            $property,
            $request->input('faq_questions', []),
            $request->input('faq_answers', [])
        );

        // Handle highlight image
        if ($request->hasFile('highlight_image')) {
            $file = $request->file('highlight_image');
            $filename = 'highlight_' . $property->slug . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('properties/highlights', $filename, 'public');
            
            // Store only the path as string
            $property->update(['highlight_images' => $path]);
        }

        // Sync amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->input('amenities'));
        }

        return redirect()->route('properties.index')
            ->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified property
     */
    public function show(Property $property)
    {
        $property->load(['partner', 'agent', 'location', 'propertyType', 'propertyCategory', 'propertyCondition', 'amenities', 'badge']);
        return $this->viewWithRoute('admin.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified property
     */
    public function edit(Property $property)
    {
        $partners = Partner::active()->ordered()->get();
        $agents = Agent::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $propertyTypes = PropertyType::active()->ordered()->get();
        $propertyCategories = PropertyCategory::active()->ordered()->get();
        $propertyConditions = PropertyCondition::active()->ordered()->get();
        $amenities = Amenity::active()->ordered()->get();
        $bedroomOptions = BedroomOption::active()->ordered()->get();
        $propertyStatuses = PropertyStatus::active()->ordered()->get();
        $badges = Badge::orderBy('name', 'asc')->get();
        $areas = Area::ordered()->get();
        
        $property->load([
            'amenities',
            'bedroomOptions',
            'partner',
            'agent',
            'location',
            'propertyCategory',
            'propertyType',
            'propertyCondition',
            'faqs',
        ]);

        $relationshipsReadonly = auth()->user()?->isSeo() ?? false;

        return $this->viewWithRoute('admin.properties.edit', compact(
            'property',
            'partners',
            'agents',
            'locations',
            'propertyTypes',
            'propertyCategories',
            'propertyConditions',
            'amenities',
            'bedroomOptions',
            'propertyStatuses',
            'badges',
            'areas',
            'relationshipsReadonly'
        ));
    }

    /**
     * Update the specified property
     */
    public function update(Request $request, Property $property)
    {
        $isSeoUser = auth()->user()?->isSeo() ?? false;

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:properties,slug,' . $property->id,
            'alias_name' => 'nullable|string|max:255',
            'partner_id' => 'nullable|exists:partners,id',
            'agent_id' => 'nullable|exists:agents,id',
            'location_id' => 'nullable|exists:locations,id',
            'area_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Allow null, empty string, or 0
                    if ($value === null || $value === '' || $value === '0' || $value === 0) {
                        return;
                    }
                    
                    // Convert to integer
                    $areaId = (int) $value;
                    
                    // Check if area exists
                    if ($areaId > 0 && !Area::where('id', $areaId)->exists()) {
                        $fail('The selected area does not exist. Please select a valid area or leave it empty.');
                    }
                },
            ],
            'property_type_id' => 'nullable|exists:property_types,id',
            'property_category_id' => 'nullable|exists:property_categories,id',
            'property_condition_id' => 'nullable|exists:property_conditions,id',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'badge_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Allow null, empty string, or 0
                    if ($value === null || $value === '' || $value === 0 || $value === '0') {
                        return;
                    }
                    
                    // Convert to integer
                    $badgeId = (int) $value;
                    
                    // Check if badge exists
                    if ($badgeId > 0 && !Badge::where('id', $badgeId)->exists()) {
                        $fail('The selected badge does not exist. Please select a valid badge or leave it empty.');
                    }
                },
            ],
            'locality' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'rera_reg_no' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'home_sort' => 'nullable|integer',
            'price' => 'nullable|numeric|min:0',
            'monthly_rent' => 'nullable|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'one_time_fees' => 'nullable|numeric|min:0',
            'total_payable' => 'nullable|numeric|min:0',
            'rent_includes' => 'nullable|string',
            'rent_excludes' => 'nullable|string',
            'rental_process' => 'nullable|string',
            'dos_donts' => 'nullable|string',
            'lock_in_period_days' => 'nullable|integer|min:0',
            'notice_period_days' => 'nullable|integer|min:0',
            'terms_conditions' => 'nullable|string',
            'is_rental' => 'boolean',
            'area_sq_ft' => 'nullable|integer|min:0',
            'rise' => 'nullable|in:high,low',
            'bedroom_configs' => 'nullable|array',
            'bedroom_configs.*' => 'exists:bedroom_options,id',
            'possession' => 'nullable|date',
            'property_status_id' => 'nullable|exists:property_statuses,id',
            'youtube_url' => 'nullable|url',
            'is_sold' => 'boolean',
            'is_featured' => 'boolean',
            'amenities_description' => 'nullable|string',
            'property_description' => 'nullable|string',
            'gallery_description' => 'nullable|string',
            'floor_plan_description' => 'nullable|string',
            'offer_text' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'airport' => 'nullable|string',
            'entertainment' => 'nullable|string',
            'national_highway' => 'nullable|string',
            'hospitals' => 'nullable|string',
            'education' => 'nullable|string',
            'project_highlights_title' => 'nullable|string',
            'highlight_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:5120',
            'remove_highlight_image' => 'nullable|boolean',
            'location_features' => 'nullable|string',
            'price_list' => 'nullable|string',
            'faq_questions' => 'nullable|array',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers' => 'nullable|array',
            'faq_answers.*' => 'nullable|string',
            'map_code' => 'nullable|string',
            'map_text' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        // Auto-set is_rental to true if category is rental (ID 4)
        $data = $request->except(['amenities', 'highlight_image', 'remove_highlight_image', 'bedroom_configs', 'explore_nearby', 'explore_nearby_json', 'faq_questions', 'faq_answers']);
        $categoryIdForRental = $isSeoUser
            ? $property->property_category_id
            : $request->property_category_id;
        if ($categoryIdForRental == 4) {
            $data['is_rental'] = true;
        }

        // Rental pages show monthly_rent; fall back to price when rent amount wasn't filled separately
        if (!empty($data['is_rental']) && empty($data['monthly_rent']) && !empty($data['price'])) {
            $data['monthly_rent'] = $data['price'];
        }

        if ($isSeoUser) {
            $data = SeoRestrictions::stripPropertyRelationshipFields($data);
        }

        // Handle explore_nearby - convert to JSON array
        if ($request->has('explore_nearby_json') && !empty($request->explore_nearby_json)) {
            $exploreNearby = json_decode($request->explore_nearby_json, true);
            if (is_array($exploreNearby)) {
                // Filter out empty values
                $exploreNearby = array_filter($exploreNearby, function($item) {
                    return !empty(trim($item));
                });
                $data['explore_nearby'] = array_values($exploreNearby); // Re-index array
            } else {
                $data['explore_nearby'] = null;
            }
        } elseif ($request->has('explore_nearby') && is_array($request->explore_nearby)) {
            // Fallback: if JSON wasn't provided, use array input
            $exploreNearby = array_filter($request->explore_nearby, function($item) {
                return !empty(trim($item));
            });
            $data['explore_nearby'] = array_values($exploreNearby);
        } else {
            $data['explore_nearby'] = null;
        }

        // Handle area_id - ensure it's valid or null
        // Get area_id from request (it should be in $data from except(), but get it directly to be sure)
        $areaIdValue = $request->input('area_id');
        
        // Process area_id if it's provided in the request
        if ($areaIdValue !== null) {
            // Convert empty/zero values to null
            if ($areaIdValue === '' || $areaIdValue === '0' || $areaIdValue === 0) {
                $data['area_id'] = null;
            } else {
                // Convert to integer and verify it exists
                $areaId = (int) $areaIdValue;
                if ($areaId > 0) {
                    // Verify area exists using direct DB query
                    $areaExists = DB::table('areas')->where('id', $areaId)->exists();
                    if ($areaExists) {
                        $data['area_id'] = $areaId;
                    } else {
                        // Area doesn't exist - set to null to prevent foreign key error
                        $data['area_id'] = null;
                    }
                } else {
                    $data['area_id'] = null;
                }
            }
        }
        // If area_id is not in request, it won't be in $data either, so existing value is preserved

        // Handle badge_id - ensure it's valid or null
        // Validation should have caught invalid badge_ids, but double-check here
        if (isset($data['badge_id'])) {
            $badgeIdValue = $data['badge_id'];
            
            // Convert empty/zero values to null
            if ($badgeIdValue === '' || $badgeIdValue === '0' || $badgeIdValue === 0 || $badgeIdValue === null) {
                $data['badge_id'] = null;
            } else {
                // Convert to integer and verify it exists
                $badgeId = (int) $badgeIdValue;
                if ($badgeId > 0) {
                    // Double-check badge exists (validation should have caught this, but be safe)
                    if (Badge::where('id', $badgeId)->exists()) {
                        $data['badge_id'] = $badgeId;
                    } else {
                        // Badge doesn't exist - set to null to prevent foreign key error
                        $data['badge_id'] = null;
                    }
                } else {
                    $data['badge_id'] = null;
                }
            }
        } else {
            $data['badge_id'] = null;
        }

        // Get old attributes before update
        $oldAttributes = $property->getOriginal();
        
        // Wrap update in try-catch to handle any foreign key constraint errors
        try {
            $property->update($data);
        } catch (\Illuminate\Database\QueryException $e) {
            // If it's a foreign key constraint error for area_id, set it to null and retry
            if (strpos($e->getMessage(), 'area_id_foreign') !== false && isset($data['area_id'])) {
                $data['area_id'] = null;
                $property->update($data);
            } else {
                // Re-throw if it's a different error
                throw $e;
            }
        }
        
        // Log the activity
        $this->logUpdate($property, $oldAttributes);

        // Handle bedroom configurations (SEO staff cannot change mappings)
        if (!$isSeoUser) {
            if ($request->has('bedroom_configs')) {
                $property->bedroomOptions()->sync($request->input('bedroom_configs'));
            } else {
                $property->bedroomOptions()->detach();
            }
        }

        // Handle highlight image
        $currentHighlightImage = $property->highlight_images;
        
        // Remove image if marked for deletion
        if ($request->has('remove_highlight_image') && $currentHighlightImage) {
            // Delete file from storage
            Storage::disk('public')->delete($currentHighlightImage);
            $property->update(['highlight_images' => null]);
        }
        
        // Add new highlight image
        if ($request->hasFile('highlight_image')) {
            // Delete old image if exists
            if ($currentHighlightImage) {
                Storage::disk('public')->delete($currentHighlightImage);
            }
            
            $file = $request->file('highlight_image');
            $filename = 'highlight_' . $property->slug . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('properties/highlights', $filename, 'public');
            
            // Store only the path as string
            $property->update(['highlight_images' => $path]);
        }

        // Sync amenities (SEO staff cannot change mappings)
        if (!$isSeoUser) {
            if ($request->has('amenities')) {
                $property->amenities()->sync($request->input('amenities'));
            } else {
                $property->amenities()->detach();
            }
        }

        $this->syncPropertyFaqs(
            $property,
            $request->input('faq_questions', []),
            $request->input('faq_answers', [])
        );

        return redirect()->route('properties.edit', $property)
            ->with('success', 'Property updated successfully.');
    }

    private function syncPropertyFaqs(Property $property, array $questions = [], array $answers = []): void
    {
        $property->faqs()->delete();

        $faqRows = [];
        $rowCount = max(count($questions), count($answers));

        for ($index = 0; $index < $rowCount; $index++) {
            $question = trim((string) ($questions[$index] ?? ''));
            $answer = trim((string) ($answers[$index] ?? ''));

            if ($question === '' || trim(strip_tags($answer)) === '') {
                continue;
            }

            $faqRows[] = [
                'question' => $question,
                'answer' => $answer,
                'sort_order' => count($faqRows),
            ];
        }

        if (!empty($faqRows)) {
            $property->faqs()->createMany($faqRows);
        }
    }

    /**
     * Remove the specified property
     */
    public function destroy(Property $property)
    {
        abort_unless(auth()->user()?->canDelete(), 403, 'SEO staff cannot delete records.');

        // Log the activity before deletion
        $this->logDelete($property);
        
        $property->delete();
        return redirect()->route('properties.index')
            ->with('success', 'Property moved to trash successfully.');
    }

    /**
     * Restore a soft deleted property
     */
    public function restore(int $propertyId)
    {
        abort_unless(auth()->user()?->isSuperAdmin(), 403, 'Unauthorized. Super Admin access required.');

        $property = Property::onlyTrashed()->findOrFail($propertyId);
        $property->restore();

        return redirect()->route('properties.index', ['show_trashed' => 1])
            ->with('success', 'Property restored successfully.');
    }

    /**
     * Toggle property status
     */
    public function toggle(Request $request, Property $property)
    {
        $property->is_active = !$property->is_active;
        $property->save();

        return response()->json(['is_active' => $property->is_active]);
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Request $request, Property $property)
    {
        $property->is_featured = !$property->is_featured;
        $property->save();

        return response()->json(['is_featured' => $property->is_featured]);
    }

    /**
     * Update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'properties' => 'required|array',
            'properties.*.id' => 'required|exists:properties,id',
            'properties.*.sort_order' => 'required|integer',
        ]);

        foreach ($request->input('properties') as $propertyData) {
            Property::where('id', $propertyData['id'])
                ->update(['sort_order' => $propertyData['sort_order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Upload image for property
     */
    public function uploadImage(Request $request, Property $property)
    {
        try {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:10240',
                'images' => 'nullable|array|min:1',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,avif|max:10240',
                'type' => 'required|in:logo,project,floor_plan',
                'alt_type' => 'nullable|string|max:255',
                'caption' => 'nullable|string|max:500',
            ]);

            $files = [];
            if ($request->hasFile('images')) {
                $files = $request->file('images');
            } elseif ($request->hasFile('image')) {
                $files = [$request->file('image')];
            }

            if (empty($files)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please select at least one image.',
                ], 422);
            }

            $type = $request->input('type');
            $altType = $request->input('alt_type') ?: null;
            $caption = $request->input('caption');
            $uploaded = [];
            $failed = 0;
            $sortOrder = (int) PropertyImage::where('property_id', $property->id)->where('type', $type)->max('sort_order');

            foreach ($files as $image) {
                if (!$image || !$image->isValid()) {
                    $failed++;
                    continue;
                }

                try {
                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $path = 'properties/' . $property->id . '/' . $type . '/' . $filename;

                    $mainDir = storage_path('app/public/' . dirname($path));
                    if (!file_exists($mainDir)) {
                        mkdir($mainDir, 0755, true);
                    }

                    Storage::disk('public')->putFileAs(
                        dirname($path),
                        $image,
                        basename($path)
                    );

                    if (!Storage::disk('public')->exists($path)) {
                        throw new \Exception('Failed to store full image at: ' . $path);
                    }

                    try {
                        $this->createThumbnail($path);
                    } catch (\Exception $thumbError) {
                        \Log::error('Thumbnail creation failed: ' . $thumbError->getMessage());
                    }

                    $sortOrder++;
                    $propertyImage = PropertyImage::create([
                        'property_id' => $property->id,
                        'type' => $type,
                        'alt_type' => $altType,
                        'image_path' => $path,
                        'caption' => $caption,
                        'sort_order' => $sortOrder,
                    ]);

                    $uploaded[] = $propertyImage->load('property');
                } catch (\Exception $fileError) {
                    $failed++;
                    \Log::error('Image upload item error: ' . $fileError->getMessage());
                }
            }

            if (empty($uploaded)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No images were uploaded successfully.',
                    'failed' => $failed,
                ], 500);
            }

            $count = count($uploaded);

            return response()->json([
                'success' => true,
                'image' => $uploaded[0],
                'images' => $uploaded,
                'failed' => $failed,
                'message' => $count === 1
                    ? 'Image uploaded successfully.'
                    : $count . ' images uploaded successfully.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Image upload error: ' . $e->getMessage());
            \Log::error('Image upload stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Error uploading image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete property image
     */
    public function deleteImage(PropertyImage $image)
    {
        // Delete files from storage
        if (Storage::exists('public/' . $image->image_path)) {
            Storage::delete('public/' . $image->image_path);
        }

        // Delete thumbnail
        $path = pathinfo($image->image_path);
        $thumbnailPath = $path['dirname'] . '/thumbnails/' . $path['filename'] . '_thumb.' . $path['extension'];
        if (Storage::exists('public/' . $thumbnailPath)) {
            Storage::delete('public/' . $thumbnailPath);
        }

        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.'
        ]);
    }

    /**
     * Get image data for editing
     */
    public function getImage(PropertyImage $image)
    {
        return response()->json($image);
    }

    /**
     * Regenerate thumbnails for all images of one property
     */
    public function regeneratePropertyThumbnails(Property $property)
    {
        $images = PropertyImage::where('property_id', $property->id)->get();
        $result = $this->regenerateThumbnailsBatch($images);

        return $this->redirectWithThumbnailRegenerationResult(
            $result,
            'Property "' . $property->name . '":'
        );
    }

    /**
     * Regenerate thumbnails for all property images site-wide
     */
    public function regenerateAllThumbnails()
    {
        $result = [
            'regenerated' => 0,
            'skipped' => 0,
            'failed' => 0,
            'errors' => [],
        ];

        PropertyImage::orderBy('id')->chunk(100, function ($images) use (&$result) {
            $batch = $this->regenerateThumbnailsBatch($images);
            $result['regenerated'] += $batch['regenerated'];
            $result['skipped'] += $batch['skipped'];
            $result['failed'] += $batch['failed'];

            if (count($result['errors']) < 15) {
                $result['errors'] = array_merge($result['errors'], $batch['errors']);
            }
        });

        return $this->redirectWithThumbnailRegenerationResult($result, 'All properties:');
    }

    /**
     * Regenerate thumbnail for existing image
     */
    public function regenerateImageThumbnail(PropertyImage $image)
    {
        try {
            if (!Storage::disk('public')->exists($image->image_path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Original image not found. Please re-upload this image.'
                ], 404);
            }

            $this->createThumbnail($image->image_path);

            return response()->json([
                'success' => true,
                'image' => $image->fresh(),
                'message' => 'Thumbnail regenerated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Thumbnail regeneration failed for image ' . $image->id . ': ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to regenerate thumbnail: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update image properties
     */
    public function updateImage(Request $request, PropertyImage $image)
    {
        $request->validate([
            'caption' => 'nullable|string|max:500',
            'alt_type' => 'nullable|string|max:255',
            'is_banner' => 'boolean',
            'is_thumbnail' => 'boolean',
            'is_thumbnail_2' => 'boolean',
        ]);

        // If setting as banner, unset other banners of same type
        if ($request->input('is_banner')) {
            PropertyImage::where('property_id', $image->property_id)
                ->where('type', $image->type)
                ->where('id', '!=', $image->id)
                ->update(['is_banner' => false]);
        }

        // If setting as thumbnail, unset other thumbnails of same type
        if ($request->input('is_thumbnail')) {
            PropertyImage::where('property_id', $image->property_id)
                ->where('type', $image->type)
                ->where('id', '!=', $image->id)
                ->update(['is_thumbnail' => false]);
        }

        // If setting as thumbnail 2, unset other thumbnail 2s of same type
        if ($request->input('is_thumbnail_2')) {
            PropertyImage::where('property_id', $image->property_id)
                ->where('type', $image->type)
                ->where('id', '!=', $image->id)
                ->update(['is_thumbnail_2' => false]);
        }

        $image->update($request->only(['caption', 'alt_type', 'is_banner', 'is_thumbnail', 'is_thumbnail_2']));

        return response()->json([
            'success' => true,
            'image' => $image->fresh(),
            'message' => 'Image updated successfully.'
        ]);
    }

    /**
     * Update image sort order
     */
    public function updateImageSortOrder(Request $request, Property $property)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:property_images,id',
            'images.*.sort_order' => 'required|integer',
        ]);

        foreach ($request->input('images') as $imageData) {
            PropertyImage::where('id', $imageData['id'])
                ->where('property_id', $property->id)
                ->update(['sort_order' => $imageData['sort_order']]);
        }

        return response()->json(['message' => 'Image sort order updated successfully.']);
    }

    /**
     * Create thumbnail for image
     */
    private function createThumbnail($path)
    {
        $thumbnailPath = dirname($path) . '/thumbnails/' . pathinfo($path, PATHINFO_FILENAME) . '_thumb.' . pathinfo($path, PATHINFO_EXTENSION);
        
        // Create thumbnails directory if it doesn't exist
        $thumbnailDir = storage_path('app/public/' . dirname($thumbnailPath));
        if (!file_exists($thumbnailDir)) {
            mkdir($thumbnailDir, 0755, true);
        }

        // Get the full image path from storage
        $fullImagePath = storage_path('app/public/' . $path);
        if (!file_exists($fullImagePath)) {
            throw new \Exception('Full image not found at: ' . $fullImagePath);
        }
        
        // Create thumbnail using GD
        $img = imagecreatefromstring(file_get_contents($fullImagePath));
        $width = imagesx($img);
        $height = imagesy($img);

        // Listing/card landscape thumb (2x of ~600x410 card image area)
        $pathInfo = pathinfo($path);
        $thumbnailPathListing = dirname($path) . '/thumbnails/' . $pathInfo['filename'] . '_thumb_listing.' . $pathInfo['extension'];
        $this->generateAndSaveCroppedThumb($img, $width, $height, 1200, 800, storage_path('app/public/' . $thumbnailPathListing), $path);

        // First thumbnail: homepage/card size (2x for sharper retina display)
        $this->generateAndSaveCroppedThumb($img, $width, $height, 772, 896, storage_path('app/public/' . $thumbnailPath), $path);

        // Second thumbnail: similar properties / cards landscape
        $thumbnailPath373 = dirname($path) . '/thumbnails/' . $pathInfo['filename'] . '_thumb_373x250.' . $pathInfo['extension'];
        $fullPath373 = storage_path('app/public/' . $thumbnailPath373);
        $this->generateAndSaveCroppedThumb($img, $width, $height, 746, 500, $fullPath373, $path);

        // Gallery side tile (landscape) for consistent property detail gallery
        $thumbnailPathGallery = dirname($path) . '/thumbnails/' . $pathInfo['filename'] . '_thumb_gallery.' . $pathInfo['extension'];
        $this->generateAndSaveCroppedThumb($img, $width, $height, 1200, 900, storage_path('app/public/' . $thumbnailPathGallery), $path);

        imagedestroy($img);
    }

    /**
     * Helper to crop/resize and save thumbnail in same format as original.
     */
    private function generateAndSaveCroppedThumb($img, $width, $height, $thumbWidth, $thumbHeight, $fullPath, $originalPath)
    {
        $targetRatio = $thumbWidth / $thumbHeight;
        $sourceRatio = $width / $height;

        if ($sourceRatio > $targetRatio) {
            $srcHeight = $height;
            $srcWidth = (int) round($height * $targetRatio);
            $srcX = (int) round(($width - $srcWidth) / 2);
            $srcY = 0;
        } else {
            $srcWidth = $width;
            $srcHeight = (int) round($width / $targetRatio);
            $srcX = 0;
            $srcY = (int) round(($height - $srcHeight) / 2);
        }

        $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled(
            $thumb,
            $img,
            0,
            0,
            $srcX,
            $srcY,
            $thumbWidth,
            $thumbHeight,
            $srcWidth,
            $srcHeight
        );

        $extension = strtolower(pathinfo($originalPath, PATHINFO_EXTENSION));

        // Ensure directory exists
        $dir = dirname($fullPath);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        switch ($extension) {
            case 'png':
                imagepng($thumb, $fullPath, 6);
                break;
            case 'gif':
                imagegif($thumb, $fullPath);
                break;
            case 'webp':
                imagewebp($thumb, $fullPath, 90);
                break;
            case 'avif':
                if (function_exists('imageavif')) {
                    imageavif($thumb, $fullPath, 70);
                } else {
                    throw new \Exception('AVIF thumbnail generation is not supported on this server.');
                }
                break;
            case 'jpg':
            case 'jpeg':
            default:
                imagejpeg($thumb, $fullPath, 92);
                break;
        }

        imagedestroy($thumb);
    }

    /**
     * Regenerate thumbnails for a collection of property images.
     */
    private function regenerateThumbnailsBatch($images): array
    {
        $regenerated = 0;
        $skipped = 0;
        $failed = 0;
        $errors = [];

        foreach ($images as $image) {
            if (!Storage::disk('public')->exists($image->image_path)) {
                $skipped++;
                continue;
            }

            try {
                $this->createThumbnail($image->image_path);
                $regenerated++;
            } catch (\Exception $e) {
                $failed++;
                if (count($errors) < 15) {
                    $errors[] = 'Image #' . $image->id . ': ' . $e->getMessage();
                }
                \Log::error('Thumbnail regeneration failed for image ' . $image->id . ': ' . $e->getMessage());
            }
        }

        return compact('regenerated', 'skipped', 'failed', 'errors');
    }

    /**
     * Redirect back with thumbnail regeneration summary.
     */
    private function redirectWithThumbnailRegenerationResult(array $result, string $context = '')
    {
        $message = sprintf(
            '%s Regenerated %d thumbnail(s). Skipped %d (missing original). Failed %d.',
            trim($context),
            $result['regenerated'],
            $result['skipped'],
            $result['failed']
        );

        if (!empty($result['errors'])) {
            $message .= ' Errors: ' . implode(' | ', array_slice($result['errors'], 0, 5));
        }

        $flashKey = $result['failed'] > 0 ? 'warning' : 'success';

        return redirect()->back()->with($flashKey, $message);
    }

    /**
     * Generate slug from name via AJAX
     */
    public function generateSlug(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'locality' => 'nullable|string|max:255',
            'location_id' => 'nullable|exists:locations,id',
        ]);

        $excludeId = $request->filled('property_id') ? (int) $request->property_id : null;

        $slug = \App\Helpers\PropertySlugHelper::build(
            $request->name,
            $request->locality,
            $request->location_id,
            $excludeId
        );

        return response()->json([
            'slug' => $slug
        ]);
    }

}