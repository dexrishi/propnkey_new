<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyCategory;
use App\Models\Partner;
use App\Models\Agent;
use App\Models\PropertyType;
use App\Models\PropertyCondition;
use App\Models\Amenity;
use App\Models\BedroomOption;
use App\Models\Inquiry;
use App\Models\SlugList;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\StaticPage;
use App\Helpers\SiteConfigHelper;
use Mail;

class HomeController extends Controller
{
    /**
     * Get meta data from slug_list table based on current URL path
     * Returns array with meta_title and meta_desc, or null if not found
     */
    protected function getMetaFromSlugList($path = null)
    {
        if (!$path) {
            $path = request()->path();
        }
        
        // Remove leading slash and normalize
        $path = ltrim($path, '/');
        
        // Try exact match first (without leading slash)
        $slugList = SlugList::where('slug', $path)
            ->where('is_active', true)
            ->first();
        
        // If not found, try with leading slash
        if (!$slugList) {
            $slugList = SlugList::where('slug', '/' . $path)
                ->where('is_active', true)
                ->first();
        }
        
        // If still not found, try without query parameters
        if (!$slugList && strpos($path, '?') !== false) {
            $pathWithoutQuery = explode('?', $path)[0];
            $slugList = SlugList::where('slug', $pathWithoutQuery)
                ->where('is_active', true)
                ->first();
        }
        
        if ($slugList) {
            return [
                'meta_title' => $slugList->meta_title,
                // Support both meta_desc and meta_description (migration differences)
                'meta_desc' => $slugList->meta_desc ?? $slugList->meta_description ?? null,
                'meta_description' => $slugList->meta_description ?? $slugList->meta_desc ?? null,
                'headline' => $slugList->headline,
                'heading_2' => $slugList->heading_2,
                'description' => $slugList->description,
                'bottom_headline' => $slugList->bottom_headline,
                'bottom_description' => $slugList->bottom_description,
                'slugList' => $slugList
            ];
        }
        
        return null;
    }
    
    public function index()
    {
       // Get locations with their latest properties (20 per location)
       $locations = Location::where('is_active', true)
           ->orderBy('sort_order', 'asc')
           ->withCount(['properties' => function($query) {
               $query->where('is_active', true);
           }])
           ->with(['properties' => function($query) {
               $query->where('is_active', true)
                     ->with(['images', 'propertyType', 'badge', 'propertyCategory'])
                     ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                     ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
                     ->orderBy('created_at', 'desc')
                     ->limit(20);
           }])
           ->get();
       
       // Get property categories with their latest properties
       $propertyCategories = PropertyCategory::active()
           ->ordered()
           ->withCount(['properties' => function($query) {
               $query->where('is_active', true);
           }])
           ->with(['properties' => function($query) {
               $query->where('is_active', true)
                     ->with(['images', 'location', 'propertyType', 'badge', 'propertyCategory'])
                     ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                     ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
                     ->orderBy('created_at', 'desc')
                     ->limit(20); // Initial load: 20 properties
           }])
           ->get();
       
       // Get partners with their property counts
       $partners = Partner::active()
           ->ordered()
           ->withCount('activeProperties')
           ->get();
       
       // Get testimonials
       $testimonials = \App\Models\Testimonial::active()
           ->ordered()
           ->get();
       
       // Check slug_list for meta data
       $slugListMeta = $this->getMetaFromSlugList();
       $pageMeta = $slugListMeta ?: null;
       
       return view('front.home', compact('locations', 'propertyCategories', 'partners', 'testimonials', 'pageMeta'));
    }

    public function about()
    {
        // Get featured agent (if any)
        $featuredAgent = Agent::where('show_in_about_page', true)
            ->where('is_active', true)
            ->where('is_featured', true)
            ->first();
        
        // Get all other agents (excluding featured if exists)
        $agents = Agent::where('show_in_about_page', true)
            ->where('is_active', true)
            ->when($featuredAgent, function($query) use ($featuredAgent) {
                return $query->where('id', '!=', $featuredAgent->id);
            })
            ->ordered()
            ->get();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: null;
        
        return view('front.about', compact('agents', 'featuredAgent', 'pageMeta'));
    }

    public function services()
    {
        $propertyCategories = PropertyCategory::with('properties')
            ->where('is_active', true)
            ->ordered()
            ->get();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: null;
        
        return view('front.services', compact('propertyCategories', 'pageMeta'));
    }

    public function contact()
    {
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: null;
        
        return view('front.contact', compact('pageMeta'));
    }

    public function blog(Request $request)
    {
        $query = BlogPost::with('blogCategory')
            ->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });

        // Filter by category if provided (for backward compatibility with query params)
        if ($request->has('category') && $request->category) {
            $query->whereHas('blogCategory', function($q) use ($request) {
                $q->where('slug', $request->category)->where('is_active', true);
            });
        }

        // Get featured posts
        $featuredPosts = BlogPost::with('blogCategory')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->limit(3)
            ->get();

        // Get all posts with pagination
        $posts = $query->latest('published_at')->paginate(12);
        
        // Set pagination path
        if ($request->has('category') && $request->category) {
            $posts->setPath(route('blog.category', $request->category));
        } else {
            $posts->setPath(route('blog'));
        }
        
        // Get all active categories
        $categories = BlogCategory::active()->orderBy('name')->get();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => 'Blog',
            'meta_desc' => 'Read our latest blog posts about real estate, property tips, and more.'
        ];
        
        return view('front.blog', compact('posts', 'categories', 'featuredPosts', 'pageMeta'));
    }

    public function blogCategory($category_slug)
    {
        // Find the category
        $category = BlogCategory::where('slug', $category_slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get posts for this category
        $query = BlogPost::with('blogCategory')
            ->where('is_active', true)
            ->where('blog_category_id', $category->id)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });

        // Get featured posts (all featured, not just from this category)
        $featuredPosts = BlogPost::with('blogCategory')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->limit(3)
            ->get();

        // Get all posts with pagination
        $posts = $query->latest('published_at')->paginate(12);
        
        // Set pagination path to preserve category in URL
        $posts->setPath(route('blog.category', $category_slug));
        
        // Get all active categories
        $categories = BlogCategory::active()->orderBy('name')->get();
        
        // Set page meta from category
        $pageMeta = [
            'meta_title' => $category->meta_title ?: $category->name . ' - Blog',
            'meta_desc' => $category->meta_description ?: 'Browse all blog posts in ' . $category->name . ' category.'
        ];
        
        return view('front.blog', compact('posts', 'categories', 'featuredPosts', 'pageMeta', 'category'));
    }

    public function blogPost($slug)
    {
        $post = BlogPost::with(['blogCategory', 'blogAuthor'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->firstOrFail();
        
        // Get related posts (same category, excluding current post)
        $relatedPosts = BlogPost::with('blogCategory')
            ->where('is_active', true)
            ->where('id', '!=', $post->id)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->when($post->blogCategory, function($query) use ($post) {
                return $query->where('blog_category_id', $post->blog_category_id);
            })
            ->latest('published_at')
            ->limit(3)
            ->get();
        
        // Get all active categories for sidebar
        $categories = BlogCategory::active()->orderBy('name')->get();
        
        // Get recent posts for sidebar
        $recentPosts = BlogPost::with('blogCategory')
            ->where('is_active', true)
            ->where('id', '!=', $post->id)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->limit(5)
            ->get();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList('blog/' . $slug);
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $post->meta_title ?? $post->title,
            'meta_desc' => $post->meta_description ?? Str::limit(strip_tags($post->description ?? ''), 160)
        ];
        
        return view('front.blog-post', compact('post', 'relatedPosts', 'categories', 'recentPosts', 'pageMeta'));
    }

    public function location($slug)
    {
        $location = Location::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList('location/' . $slug);
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $location->meta_title ?? $location->name . ' Properties',
            'meta_desc' => $location->meta_description ?? $location->site_description ?? null
        ];
        
        $properties = Property::with(['location', 'images', 'propertyType', 'propertyCategory'])
        ->where('location_id', $location->id)
        ->where('is_active', true)
        ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
        ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
        ->orderBy('created_at', 'desc')
        ->paginate(12);
        
        // Get required variables for the view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();

        return view('front.location-details', compact(
            'location', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    public function show($slug)
    {
        $property = Property::with(['location', 'images', 'propertyType', 'faqs'])
            ->where('slug', $slug)
            ->firstOrFail();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $property->meta_title ?? $property->name,
            'meta_desc' => $property->meta_description ?? strip_tags($property->property_description ?? '')
        ];
        
        return view('front.property-details', compact('property', 'pageMeta'));
    }

    public function propertyShow($category_slug, $slug)
    {
        // Legacy/broken links sometimes put a location listing slug here
        if (preg_match('/^properties-in-(.+)$/', $slug, $matches)) {
            $location = Location::where('slug', $matches[1])->where('is_active', true)->first();
            $category = PropertyCategory::where('slug', $category_slug)->where('is_active', true)->first();

            if ($category && $location) {
                return redirect()->route('category.location.properties', [
                    'category_slug' => $category->slug,
                    'location_slug' => $location->slug,
                ], 301);
            }

            if ($location) {
                return redirect()->route('location.properties', [
                    'location_slug' => $location->slug,
                ], 301);
            }
        }

        // First check if it's an individual property
            $property = Property::with([
                'location',
                'area',
                'images',
                'propertyType',
                'propertyCategory',
                'propertyStatus',
                'bedroomOptions',
                'partner',
                'amenities',
                'floorPlanImages',
                'faqs',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->whereHas('propertyCategory', function($query) use ($category_slug) {
                $query->where('slug', $category_slug)->where('is_active', true);
            })
            ->firstOrFail();
            
        if ($property) {
            // Check if property category is rental (ID 4) and redirect to rental view
            if ($property->property_category_id == 4) {
                return $this->rentPropertyShow($slug);
            }
            
            // Get budget range percentage from site configs (default 20%)
            $budgetRangePercentage = (int) \App\Helpers\SiteConfigHelper::get('similar_properties_budget_range', 20);
            
            // Get similar properties (same property type AND same location/city, excluding current property)
            $similarProperties = Property::with(['images', 'location', 'propertyType', 'bedroomOptions', 'propertyCategory', 'badge'])
                ->where('is_active', true)
                ->where('id', '!=', $property->id);
            
            // Build query: Must match both property type AND location if both are available
            if ($property->property_type_id && $property->location_id) {
                // Both filters: same type AND same location
                $similarProperties->where('property_type_id', $property->property_type_id)
                                  ->where('location_id', $property->location_id);
            } elseif ($property->property_type_id) {
                // Only property type filter (fallback if location is not set)
                $similarProperties->where('property_type_id', $property->property_type_id);
            } elseif ($property->location_id) {
                // Only location filter (fallback if property type is not set)
                $similarProperties->where('location_id', $property->location_id);
            } else {
                // If neither property_type_id nor location_id is set, get any active properties
                // This is a fallback to ensure something is shown
            }
            
            // Apply budget range filter if property has a price
            if ($property->price && $property->price > 0) {
                $minPrice = $property->price * (1 - $budgetRangePercentage / 100);
                $maxPrice = $property->price * (1 + $budgetRangePercentage / 100);
                
                $similarProperties->whereBetween('price', [$minPrice, $maxPrice]);
            }
            
            $similarProperties = $similarProperties->orderBy('created_at', 'desc')->limit(4)->get();
            
            // If no similar properties found with strict filters, try more flexible approach
            if ($similarProperties->count() == 0 && $property->property_type_id && $property->location_id) {
                // Try with just same location (broader search)
                $similarProperties = Property::with(['images', 'location', 'propertyType', 'bedroomOptions'])
                    ->where('is_active', true)
                    ->where('id', '!=', $property->id)
                    ->where('location_id', $property->location_id);
                
                // Apply budget range filter if property has a price
                if ($property->price && $property->price > 0) {
                    $minPrice = $property->price * (1 - $budgetRangePercentage / 100);
                    $maxPrice = $property->price * (1 + $budgetRangePercentage / 100);
                    
                    $similarProperties->whereBetween('price', [$minPrice, $maxPrice]);
                }
                
                $similarProperties = $similarProperties->orderBy('created_at', 'desc')->limit(4)->get();
            }
            
            // If still no results, try with just same property type
            if ($similarProperties->count() == 0 && $property->property_type_id) {
                $similarProperties = Property::with(['images', 'location', 'propertyType', 'bedroomOptions', 'propertyCategory', 'badge'])
                    ->where('is_active', true)
                    ->where('id', '!=', $property->id)
                    ->where('property_type_id', $property->property_type_id);
                
                // Apply budget range filter if property has a price
                if ($property->price && $property->price > 0) {
                    $minPrice = $property->price * (1 - $budgetRangePercentage / 100);
                    $maxPrice = $property->price * (1 + $budgetRangePercentage / 100);
                    
                    $similarProperties->whereBetween('price', [$minPrice, $maxPrice]);
                }
                
                $similarProperties = $similarProperties->orderBy('created_at', 'desc')->limit(4)->get();
            }

            // dd($similarProperties);

            // Check slug_list for meta data
            $slugListMeta = $this->getMetaFromSlugList('property/' . $category_slug . '/' . $slug);
            $pageMeta = $slugListMeta ?: [
                'meta_title' => $property->meta_title ?? $property->name,
                'meta_desc' => $property->meta_description ?? strip_tags($property->property_description ?? '')
            ];
            
            return view('front.property-details-new', compact('property', 'similarProperties', 'pageMeta'));
        }
        
        // If not a property, check for PropertyType slug
        $properCategory = PropertyCategory::all();
        $allLocation = Location::all();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::all();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();

        $propertyType = PropertyType::where('slug', $slug)->first();
        if ($propertyType) {
            $properties = Property::with(['location', 'images', 'propertyType', 'propertyCategory'])
                ->where('property_type_id', $propertyType->id)
                ->where('is_active', true)
                ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            // Check slug_list for meta data
            $slugListMeta = $this->getMetaFromSlugList();
            $pageMeta = $slugListMeta ?: [
                'meta_title' => ($propertyType->name ?? '') . ' Properties',
                'meta_desc' => $propertyType->meta_description ?? null
            ];
            
            return view('front.property', compact(
                'propertyType', 'properties',
                'properCategory','allLocation',
                'propertiesPrice','propertyTypeAll','propertiesbedroom', 'pageMeta'
            ));
        }

        // Check for Location slug
        $location = Location::where('slug', $slug)->first();
        if ($location) {
            $properties = Property::with(['location', 'images'])
                ->where('location_id', $location->id)
                ->where('is_active', true)
                ->get();

            // Check slug_list for meta data
            $slugListMeta = $this->getMetaFromSlugList();
            $pageMeta = $slugListMeta ?: [
                'meta_title' => $location->meta_title ?? $location->name . ' Properties',
                'meta_desc' => $location->meta_description ?? $location->site_description ?? null
            ];
            
            return view('front.location-details', compact(
                'location','properties',
                'properCategory','allLocation',
                'propertiesPrice','propertyTypeAll','propertiesbedroom', 'pageMeta'
            ));
        }

        abort(404);
    }


    public function advancedSearch(Request $request)
    {
        $query = $request->input('query');
        $formType = $request->input('form_type');
        $location = $request->input('location');
        $price = $request->input('price');
        $propertyType = $request->input('property_type'); // Can be array for multi-select
        $bedroom = $request->input('bedroom'); // Can be array for multi-select

        // If there's a text query, perform search and show results
        if ($request->filled('query')) {
            $page = $request->input('page', 1);
            
            // Start building the query
            $propertyQuery = Property::with(['images', 'location', 'propertyType', 'propertyCategory', 'bedroomOptions', 'badge'])
                ->where('is_active', true);
            
            // Apply text search
            $propertyQuery->search($query);
            
            // Apply filters if provided
            if ($location) {
                $locationModel = Location::where('name', $location)->first();
                if ($locationModel) {
                    $propertyQuery->where('location_id', $locationModel->id);
                }
            }
            
            if ($propertyType) {
                if (is_array($propertyType)) {
                    $typeIds = PropertyType::whereIn('name', $propertyType)->pluck('id');
                    if ($typeIds->isNotEmpty()) {
                        $propertyQuery->whereIn('property_type_id', $typeIds);
                    }
                } else {
                    $typeModel = PropertyType::where('name', $propertyType)->first();
                    if ($typeModel) {
                        $propertyQuery->where('property_type_id', $typeModel->id);
                    }
                }
            }
            
            if ($bedroom) {
                if (is_array($bedroom)) {
                    $bedroomIds = BedroomOption::whereIn('value', $bedroom)->pluck('id');
                    if ($bedroomIds->isNotEmpty()) {
                        $propertyQuery->whereHas('bedroomOptions', function($q) use ($bedroomIds) {
                            $q->whereIn('bedroom_options.id', $bedroomIds);
                        });
                    }
                } else {
                    $bedroomModel = BedroomOption::where('value', $bedroom)->first();
                    if ($bedroomModel) {
                        $propertyQuery->whereHas('bedroomOptions', function($q) use ($bedroomModel) {
                            $q->where('bedroom_options.id', $bedroomModel->id);
                        });
                    }
                }
            }
            
            // Apply price filter if provided
            if ($price) {
                $propertyQuery->where(function($q) use ($price) {
                    if ($price === 'Below 1 Cr') {
                        $q->where('price', '<', 10000000);
                    } elseif ($price === '1 Cr to 2 Cr') {
                        $q->whereBetween('price', [10000000, 20000000]);
                    } elseif ($price === '2 Cr to 4 Cr') {
                        $q->whereBetween('price', [20000000, 40000000]);
                    } elseif ($price === 'Above 4 Cr') {
                        $q->where('price', '>', 40000000);
                    }
                });
            }
            
            // Paginate results
            $properties = $propertyQuery->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
                ->orderBy('created_at', 'desc')
                ->paginate(12, ['*'], 'page', $page)
                ->withQueryString(); // Preserve query parameters in pagination links
            
            // Get required variables for the property view
            $properCategory = PropertyCategory::active()->ordered()->get();
            $allLocation = Location::active()->ordered()->get();
            $propertiesPrice = Property::pluck('price')->unique()->values();
            $propertyTypeAll = PropertyType::active()->ordered()->get();
            $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
            
            // Get current location if set
            $locationModel = null;
            if ($location) {
                $locationModel = Location::where('name', $location)->first();
            }
            
            // Check slug_list for meta data
            $slugListMeta = $this->getMetaFromSlugList();
            $pageMeta = $slugListMeta ?: [
                'meta_title' => 'Search Results' . ($query ? ' for "' . $query . '"' : ''),
                'meta_desc' => 'Property search results'
            ];
            
            return view('front.property', compact(
                'properties', 'query', 'properCategory', 
                'allLocation', 'propertiesPrice', 'propertyTypeAll', 
                'propertiesbedroom', 'location', 'pageMeta'
            ));
        }

        // If no text query, use existing filter-based logic
        $url = $this->buildSearchUrl($formType, $location, $price, $propertyType, $bedroom);
        
        // Redirect to the appropriate URL
        return redirect($url);
    }

    /**
     * Build search URL based on selected filters
     */
    private function buildSearchUrl($formType, $location, $price, $propertyType, $bedroom)
    {
        // Get slugs for location and property type
        $locationSlug = null;
        $propertyTypeSlug = null;
        
        if ($location) {
            $locationModel = Location::where('name', $location)->first();
            $locationSlug = $locationModel ? $locationModel->slug : null;
        }
        
        // Handle property type (can be array for multi-select)
        $isMultiSelectType = false;
        if ($propertyType) {
            if (is_array($propertyType)) {
                $isMultiSelectType = count($propertyType) > 1;
                // For single selection in array, use that type
                // For multi-select, we'll handle it differently in URL building
                $firstType = $propertyType[0];
                $propertyTypeModel = PropertyType::where('name', $firstType)->first();
                $propertyTypeSlug = $propertyTypeModel ? $propertyTypeModel->slug : null;
            } else {
                $propertyTypeModel = PropertyType::where('name', $propertyType)->first();
                $propertyTypeSlug = $propertyTypeModel ? $propertyTypeModel->slug : null;
            }
        }

        // Case 1: Both property type and location selected
        if ($propertyTypeSlug && $locationSlug) {
            // Get category for property type to build proper URL
            $propertyTypeModel = PropertyType::where('slug', $propertyTypeSlug)->first();
            $categorySlug = $propertyTypeModel && $propertyTypeModel->propertyCategory ? $propertyTypeModel->propertyCategory->slug : null;
            
            // If multiple property types selected, go to location page with params
            if ($isMultiSelectType) {
                if ($categorySlug) {
                    $baseUrl = "/{$categorySlug}-properties-in-{$locationSlug}";
                } else {
                    $baseUrl = "/properties-in-{$locationSlug}";
                }
                $params = [];
                
                if ($propertyType) {
                    $params['property_type'] = is_array($propertyType) ? $propertyType : [$propertyType];
                }
                if ($price) $params['price'] = $price;
                if ($bedroom) {
                    $params['bedroom'] = is_array($bedroom) ? $bedroom : [$bedroom];
                }
                
                return $baseUrl . (empty($params) ? '' : '?' . http_build_query($params));
            } else {
                // Single property type - use category + property type + location route if category exists
                if ($categorySlug) {
                    $baseUrl = "/{$categorySlug}-properties/{$propertyTypeSlug}-in-{$locationSlug}";
                } else {
                    $baseUrl = "/{$propertyTypeSlug}-in-{$locationSlug}";
                }
                $params = [];
                
                if ($price) $params['price'] = $price;
                if ($bedroom) {
                    $params['bedroom'] = is_array($bedroom) ? $bedroom : [$bedroom];
                }
                
                return $baseUrl . (empty($params) ? '' : '?' . http_build_query($params));
            }
        }
        
        // Case 2: Only property type selected
        if ($propertyTypeSlug) {
            // Get category for property type
            $propertyTypeModel = PropertyType::where('slug', $propertyTypeSlug)->first();
            $categorySlug = $propertyTypeModel && $propertyTypeModel->propertyCategory ? $propertyTypeModel->propertyCategory->slug : null;
            
            // If multiple property types selected, go to all properties with params
            if ($isMultiSelectType) {
                $baseUrl = "/all-properties";
                $params = [];
                
                if ($propertyType) {
                    $params['property_type'] = is_array($propertyType) ? $propertyType : [$propertyType];
                }
                if ($location) $params['location'] = $location;
                if ($price) $params['price'] = $price;
                if ($bedroom) {
                    $params['bedroom'] = is_array($bedroom) ? $bedroom : [$bedroom];
                }
                
                return $baseUrl . (empty($params) ? '' : '?' . http_build_query($params));
            } else {
                // Single property type - use category + property type route if category exists
                if ($categorySlug) {
                    $baseUrl = "/{$categorySlug}-properties/{$propertyTypeSlug}";
                } else {
                    // Fallback to all properties with type filter
                    $baseUrl = "/all-properties";
                    $params = ['property_type' => $propertyTypeSlug];
                    if ($location) $params['location'] = $location;
                    if ($price) $params['price'] = $price;
                    if ($bedroom) {
                        $params['bedroom'] = is_array($bedroom) ? $bedroom : [$bedroom];
                    }
                    return $baseUrl . '?' . http_build_query($params);
                }
                $params = [];
                
                if ($location) {
                    // If location is also selected, use category + property type + location route
                    $locationModel = Location::where('name', $location)->first();
                    if ($locationModel) {
                        $baseUrl = "/{$categorySlug}-properties/{$propertyTypeSlug}-in-{$locationModel->slug}";
                    } else {
                        $params['location'] = $location;
                    }
                }
                if ($price) $params['price'] = $price;
                if ($bedroom) {
                    $params['bedroom'] = is_array($bedroom) ? $bedroom : [$bedroom];
                }
                
                return $baseUrl . (empty($params) ? '' : '?' . http_build_query($params));
            }
        }
        
        // Case 3: Property category (form_type) - check this before location-only to prioritize category+location
        if ($formType) {
            $categorySlug = PropertyCategory::where('name', $formType)->value('slug');
            if ($categorySlug) {
                $baseUrl = "/{$categorySlug}-properties";
            $params = [];
                
                // If location is also selected, use category + location route
                if ($location && $locationSlug) {
                    $baseUrl = "/{$categorySlug}-properties-in-{$locationSlug}";
                } elseif ($location) {
                    // Location name provided but slug not found, add as param
                    $params['location'] = $location;
                }
            
            if ($propertyType) {
                // Handle property type as array or single value
                $params['property_type'] = is_array($propertyType) ? $propertyType : [$propertyType];
            }
            if ($price) $params['price'] = $price;
            if ($bedroom) {
                // Handle bedroom as array or single value
                $params['bedroom'] = is_array($bedroom) ? $bedroom : [$bedroom];
            }
            
            return $baseUrl . (empty($params) ? '' : '?' . http_build_query($params));
        }
        }
        
        // Case 4: Only location selected (no category/form_type)
        if ($locationSlug) {
            $baseUrl = "/properties-in-{$locationSlug}";
                $params = [];
                
            if ($propertyType) {
                // Handle property type as array or single value
                $params['property_type'] = is_array($propertyType) ? $propertyType : [$propertyType];
                }
                if ($price) $params['price'] = $price;
                if ($bedroom) {
                    // Handle bedroom as array or single value
                    $params['bedroom'] = is_array($bedroom) ? $bedroom : [$bedroom];
                }
                
                return $baseUrl . (empty($params) ? '' : '?' . http_build_query($params));
        }
        
        // Case 5: Default fallback to all properties with filters
        $params = [];
        if ($location) $params['location'] = $location;
        if ($price) $params['price'] = $price;
        if ($propertyType) {
            // Handle property type as array or single value
            $params['property_type'] = is_array($propertyType) ? $propertyType : [$propertyType];
        }
        if ($bedroom) {
            // Handle bedroom as array or single value
            $params['bedroom'] = is_array($bedroom) ? $bedroom : [$bedroom];
        }
        
        return '/all-properties' . (empty($params) ? '' : '?' . http_build_query($params));
    }

    /**
     * Verify Google reCAPTCHA response
     */
    private function verifyRecaptcha($recaptchaResponse)
    {
        if (empty($recaptchaResponse)) {
            return false;
        }
        
        $secretKey = SiteConfigHelper::recaptchaSecretKey();
        if (empty($secretKey)) {
            // If no secret key configured, skip verification (for development)
            return true;
        }
        
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => request()->ip()
        ];
        
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json = json_decode($result, true);
        
        return isset($json['success']) && $json['success'] === true;
    }

    public function contactsubmit(Request $request)
    {
        // Check if this is a property inquiry (has project_name) or regular contact form
        $isPropertyInquiry = $request->has('project_name');
        
        // Validation rules
        $rules = [
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'company' => 'nullable|string|max:255',
        ];
        
        if ($isPropertyInquiry) {
            // Property inquiry: message optional, recaptcha optional but validate if present
            $rules['message'] = 'nullable|string|max:1000';
            $rules['project_name'] = 'nullable|string|max:255';
        } else {
            // Regular contact form: message required, recaptcha required
            $rules['message'] = 'required|string|max:1000';
        }
        
        $request->validate($rules);
        
        // Validate reCAPTCHA manually (require for all public inquiry forms)
        $recaptchaResponse = $request->input('g-recaptcha-response');
        if (empty($recaptchaResponse)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please complete the reCAPTCHA verification.',
                    'errors' => ['g-recaptcha-response' => ['Please complete the reCAPTCHA verification.']]
                ], 422);
            }
            return back()->withErrors(['g-recaptcha-response' => 'Please complete the reCAPTCHA verification.'])->withInput();
        }

        if (!$this->verifyRecaptcha($recaptchaResponse)) {
            // Log failed verification for monitoring
            \Log::warning('reCAPTCHA verification failed for contact form', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'form' => $request->input('form_name') ?? null,
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'reCAPTCHA verification failed. Please try again.',
                    'errors' => ['g-recaptcha-response' => ['reCAPTCHA verification failed. Please try again.']]
                ], 422);
            }

            return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.'])->withInput();
        }

        // Data prepare
        $inquiryData = [
            'name' => $request->name ?? $request->full_name ?? $request->first_name ?? '',
            'company' => $request->company ?? null,
            'phone' => $request->phone,
            'email' => $request->email,
            'user_message' => $request->message ?? '',
            'project_name' => $request->project_name ?? null,
            'form_name' => $request->form_name ?? null,
            'url' => $request->input('url') ?? $request->input('inquiry_url') ?? $request->header('HTTP_REFERER'),
        ];
        
        Inquiry::create($inquiryData);

        // Send mail (to admin) - Commented out for now
        // $subject = $isPropertyInquiry 
        //     ? 'New Property Inquiry: ' . ($inquiryData['project_name'] ?? 'General Inquiry') . ' - ' . $inquiryData['name']
        //     : 'New Contact Inquiry from ' . $inquiryData['name'];
        
        // Mail::send('emails.inquiry', $inquiryData, function ($mail) use ($inquiryData, $subject) {
        //     $mail->to('nitai.system@gmail.com', 'Admin')
        //          ->subject($subject)
        //          ->replyTo($inquiryData['email'], $inquiryData['name']);
        // });

        // Return JSON for AJAX requests (property inquiry), or redirect for regular form
        if ($request->expectsJson() || $isPropertyInquiry) {
            return response()->json([
                'success' => true,
                'message' => 'Your inquiry has been submitted successfully. We will contact you soon.'
            ]);
        }

        return back()->with('success', 'Your inquiry has been submitted successfully. We will contact you soon.');
    }

    /**
     * View all properties
     */
    public function viewAllProperties(Request $request)
    {
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('is_active', true);

        // Apply filters
        if ($request->filled('category')) {
            // Handle both ID and slug for category
            $category = PropertyCategory::where('slug', $request->category)->orWhere('id', $request->category)->first();
            if ($category) {
                $query->where('property_category_id', $category->id);
            }
        }

        if ($request->filled('location')) {
            // Handle both ID and slug for location
            $location = Location::where('slug', $request->location)->orWhere('id', $request->location)->first();
            if ($location) {
                $query->where('location_id', $location->id);
            }
        }

        if ($request->filled('type')) {
            // Handle both ID and slug for type
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        $propertyCategories = PropertyCategory::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $propertyTypes = PropertyType::active()->ordered()->get();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList('all-properties-page');
        $pageMeta = $slugListMeta ?: [
            'meta_title' => 'All Properties',
            'meta_desc' => 'Browse all available properties'
        ];
        
        return view('front.all-properties', compact('properties', 'propertyCategories', 'locations', 'propertyTypes', 'pageMeta'));
    }

    /**
     * Show all properties with lazy loading (8 per page)
     */
    public function allPropertiesLazy(Request $request, $page = 1)
    {
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory', 'partner'])
            ->where('is_active', true);

        // Apply filters if provided
        if ($request->filled('category')) {
            $category = PropertyCategory::where('slug', $request->category)->orWhere('id', $request->category)->first();
            if ($category) {
                $query->where('property_category_id', $category->id);
            }
        }

        if ($request->filled('location')) {
            $location = Location::where('slug', $request->location)->orWhere('id', $request->location)->first();
            if ($location) {
                $query->where('location_id', $location->id);
            }
        }

        if ($request->filled('type')) {
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        if ($request->filled('partner')) {
            $partner = Partner::where('slug', $request->partner)->orWhere('id', $request->partner)->first();
            if ($partner) {
                $query->where('partner_id', $partner->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList('all-properties');
        $pageMeta = $slugListMeta ?: [
            'meta_title' => 'All Properties',
            'meta_desc' => 'Browse all available properties'
        ];
        
        return view('front.property', compact(
            'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show partner details with their properties
     */
    public function partnerShow(Request $request, $slug, $page = 1)
    {
        // Broken SEO URLs: /builder/properties-in-{city}
        if (preg_match('/^properties-in-(.+)$/', $slug, $matches)) {
            $location = Location::where('slug', $matches[1])->where('is_active', true)->first();
            if ($location) {
                return redirect()->route('location.properties', array_filter([
                    'location_slug' => $location->slug,
                    'page' => is_numeric($page) ? $page : null,
                ]), 301);
            }
        }

        $partner = Partner::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList('builder/' . $slug);
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $partner->meta_title ?? $partner->name . ' Properties',
            'meta_desc' => $partner->meta_description ?? $partner->description ?? null
        ];
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('partner_id', $partner->id)
            ->where('is_active', true);

        // Apply filters
        if ($request->filled('category')) {
            $query->where('property_category_id', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location_id', $request->location);
        }

        if ($request->filled('type')) {
            $query->where('property_type_id', $request->type);
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        return view('front.property', compact(
            'partner', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties for a specific location using location slug
     */
    public function locationProperties(Request $request, $location_slug, $page = 1)
    {
        // Location slug is already extracted from the URL pattern (e.g., "properties-in-gurgaon" -> "gurgaon")
        $location = Location::where('slug', $location_slug)->where('is_active', true)->firstOrFail();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList('properties-in-' . $location_slug);
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $location->meta_title ?? 'Properties in ' . $location->name,
            'meta_desc' => $location->meta_description ?? $location->site_description ?? null
        ];
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('location_id', $location->id)
            ->where('is_active', true);

        // Apply filters
        if ($request->filled('category')) {
            $category = PropertyCategory::where('slug', $request->category)->orWhere('id', $request->category)->first();
            if ($category) {
                $query->where('property_category_id', $category->id);
            }
        }

        if ($request->filled('location')) {
            $filterLocation = Location::where('slug', $request->location)->orWhere('id', $request->location)->first();
            if ($filterLocation) {
                $query->where('location_id', $filterLocation->id);
            }
        }

        if ($request->filled('type')) {
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data (already set above)
        
        return view('front.property', compact(
            'location', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties for a specific category using category slug
     */
    public function categoryProperties(Request $request, $category_slug, $page = 1)
    {
        // Extract category slug from the URL pattern (e.g., "residential-properties" -> "residential", "holiday-homes-properties" -> "holiday-homes")
        // Remove "-properties" from the end of the slug
        $categorySlug = preg_replace('/-properties$/', '', $category_slug);
        
        // Try to find the category by slug
        $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->first();
        
        // If not found, try alternative slug formats (e.g., if database has "holiday_homes" but URL has "holiday-homes")
        if (!$propertyCategory) {
            $alternativeSlug = str_replace('-', '_', $categorySlug);
            $propertyCategory = PropertyCategory::where('slug', $alternativeSlug)->where('is_active', true)->first();
        }
        
        // If still not found, try case-insensitive search
        if (!$propertyCategory) {
            $propertyCategory = PropertyCategory::whereRaw('LOWER(slug) = ?', [strtolower($categorySlug)])
                ->where('is_active', true)
                ->first();
        }
        
        // If still not found, throw 404
        if (!$propertyCategory) {
            abort(404, "Property category not found: {$categorySlug}");
        }
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory', 'propertyCondition'])
            ->where('property_category_id', $propertyCategory->id)
            ->where('is_active', true);
        
        // Only filter by condition if explicitly requested via query parameter
        // Don't apply default "new" condition filter to show all properties in the category

        // Check if $page is actually a property type slug (non-numeric)
        $propertyTypeSlug = null;
        $actualPage = 1;
        
        if (!is_numeric($page)) {
            // Try to find a property type with this slug within the category
            $propertyType = PropertyType::where('slug', $page)
                ->where('is_active', true)
                ->first();
            
            if ($propertyType) {
                // It's a property type slug, filter by it
                $propertyTypeSlug = $page;
                $query->where('property_type_id', $propertyType->id);
                $actualPage = 1; // Reset to page 1 for property type filtering
            } else {
                // Not a valid property type, try to parse as page number or default to 1
                $actualPage = is_numeric($page) ? (int)$page : 1;
            }
        } else {
            // It's a numeric page number
            $actualPage = (int)$page;
        }

        // Apply additional filters
        if ($request->filled('location')) {
            $location = Location::where('slug', $request->location)->orWhere('id', $request->location)->first();
            if ($location) {
                $query->where('location_id', $location->id);
            }
        }

        // If property type wasn't set from URL slug, check query parameter
        if (!$propertyTypeSlug && $request->filled('type')) {
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $actualPage);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Get property type if it was set from URL slug
        $propertyType = null;
        if ($propertyTypeSlug) {
            $propertyType = PropertyType::where('slug', $propertyTypeSlug)
                ->where('is_active', true)
                ->first();
        }
        
        // Check slug_list for meta data using the actual request path
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $propertyCategory->meta_title ?? $propertyCategory->name . ' Properties',
            'meta_desc' => $propertyCategory->meta_description ?? $propertyCategory->description ?? null
        ];
        
        return view('front.property', compact(
            'propertyCategory', 'propertyType', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by category and condition
     */
    public function categoryConditionProperties(Request $request, $category_slug, $condition_slug, $page = null)
    {
        // Handle empty page parameter (trailing slash)
        $page = ($page === null || $page === '') ? 1 : (int)$page;
        
        // Extract category slug from the URL pattern (e.g., "residential-properties" -> "residential")
        $categorySlug = str_replace('-properties', '', $category_slug);
        
        $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->firstOrFail();
        $propertyCondition = PropertyCondition::where('slug', $condition_slug)->where('is_active', true)->firstOrFail();
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory', 'propertyCondition'])
            ->where('property_category_id', $propertyCategory->id)
            ->where('property_condition_id', $propertyCondition->id)
            ->where('is_active', true);

        // Apply additional filters
        if ($request->filled('location')) {
            $location = Location::where('slug', $request->location)->orWhere('id', $request->location)->first();
            if ($location) {
                $query->where('location_id', $location->id);
            }
        }

        if ($request->filled('type')) {
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        if ($request->filled('price')) {
            $price = $request->price;
            if (is_numeric($price)) {
                $query->where('price', '<=', $price);
            }
        }

        if ($request->filled('bedroom')) {
            $bedroomIds = is_array($request->bedroom) ? $request->bedroom : [$request->bedroom];
            $query->whereHas('bedroomOptions', function($q) use ($bedroomIds) {
                $q->whereIn('bedroom_options.id', $bedroomIds);
            });
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => ($propertyCategory->name ?? '') . ' ' . ($propertyCondition->name ?? '') . ' Properties',
            'meta_desc' => $propertyCategory->meta_description ?? null
        ];
        
        return view('front.property', compact(
            'propertyCategory', 'propertyCondition', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by category, condition, and property type
     */
    public function categoryConditionPropertyTypeProperties(Request $request, $category_slug, $condition_slug, $property_type_slug, $page = null)
    {
        // Handle empty page parameter (trailing slash)
        $page = ($page === null || $page === '') ? 1 : (int)$page;
        
        // Extract category slug from the URL pattern (e.g., "residential-properties" -> "residential")
        $categorySlug = str_replace('-properties', '', $category_slug);
        
        $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->firstOrFail();
        $propertyCondition = PropertyCondition::where('slug', $condition_slug)->where('is_active', true)->firstOrFail();
        $propertyType = PropertyType::where('slug', $property_type_slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory', 'propertyCondition'])
            ->where('property_category_id', $propertyCategory->id)
            ->where('property_condition_id', $propertyCondition->id)
            ->where('property_type_id', $propertyType->id)
            ->where('is_active', true);

        // Apply additional filters
        if ($request->filled('location')) {
            $location = Location::where('slug', $request->location)->orWhere('id', $request->location)->first();
            if ($location) {
                $query->where('location_id', $location->id);
            }
        }

        if ($request->filled('price')) {
            $price = $request->price;
            if (is_numeric($price)) {
                $query->where('price', '<=', $price);
            }
        }

        if ($request->filled('bedroom')) {
            $bedroomIds = is_array($request->bedroom) ? $request->bedroom : [$request->bedroom];
            $query->whereHas('bedroomOptions', function($q) use ($bedroomIds) {
                $q->whereIn('bedroom_options.id', $bedroomIds);
            });
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => ($propertyCategory->name ?? '') . ' ' . ($propertyCondition->name ?? '') . ' ' . ($propertyType->name ?? '') . ' Properties',
            'meta_desc' => $propertyCategory->meta_description ?? $propertyType->meta_description ?? null
        ];
        
        return view('front.property', compact(
            'propertyCategory', 'propertyCondition', 'propertyType', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by category, condition, property type, and location
     */
    public function categoryConditionPropertyTypeLocationProperties(Request $request, $category_slug, $condition_slug, $property_type_slug, $location_slug, $page = null)
    {
        // Handle empty page parameter (trailing slash)
        $page = ($page === null || $page === '') ? 1 : (int)$page;
        
        // Extract category slug from the URL pattern (e.g., "residential-properties" -> "residential")
        $categorySlug = str_replace('-properties', '', $category_slug);
        
        // Extract property type slug from the URL pattern (e.g., "apartments-in-gurgaon" -> "apartments")
        $propertyTypeSlug = str_replace('-in-' . $location_slug, '', $property_type_slug);
        
        $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->firstOrFail();
        $propertyCondition = PropertyCondition::where('slug', $condition_slug)->where('is_active', true)->firstOrFail();
        $propertyType = PropertyType::where('slug', $propertyTypeSlug)
            ->where('is_active', true)
            ->firstOrFail();
        $location = Location::where('slug', $location_slug)->where('is_active', true)->firstOrFail();
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory', 'propertyCondition'])
            ->where('property_category_id', $propertyCategory->id)
            ->where('property_condition_id', $propertyCondition->id)
            ->where('property_type_id', $propertyType->id)
            ->where('location_id', $location->id)
            ->where('is_active', true);

        // Apply additional filters
        if ($request->filled('price')) {
            $price = $request->price;
            if (is_numeric($price)) {
                $query->where('price', '<=', $price);
            }
        }

        if ($request->filled('bedroom')) {
            $bedroomIds = is_array($request->bedroom) ? $request->bedroom : [$request->bedroom];
            $query->whereHas('bedroomOptions', function($q) use ($bedroomIds) {
                $q->whereIn('bedroom_options.id', $bedroomIds);
            });
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => ($propertyCategory->name ?? '') . ' ' . ($propertyCondition->name ?? '') . ' ' . ($propertyType->name ?? '') . ' in ' . ($location->name ?? ''),
            'meta_desc' => $propertyCategory->meta_description ?? $propertyType->meta_description ?? null
        ];
        
        return view('front.property', compact(
            'propertyCategory', 'propertyCondition', 'propertyType', 'location', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by category, location, and condition
     */
    public function categoryLocationConditionProperties(Request $request, $category_slug, $location_slug, $condition_slug, $page = null)
    {
        // Handle empty page parameter (trailing slash)
        $page = ($page === null || $page === '') ? 1 : (int)$page;
        
        // Extract category slug from the URL pattern (e.g., "residential-properties" -> "residential")
        $categorySlug = str_replace('-properties', '', $category_slug);
        
        $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->firstOrFail();
        $location = Location::where('slug', $location_slug)->where('is_active', true)->firstOrFail();
        $propertyCondition = PropertyCondition::where('slug', $condition_slug)->where('is_active', true)->firstOrFail();
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory', 'propertyCondition'])
            ->where('property_category_id', $propertyCategory->id)
            ->where('location_id', $location->id)
            ->where('property_condition_id', $propertyCondition->id)
            ->where('is_active', true);

        // Apply additional filters
        if ($request->filled('type')) {
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        if ($request->filled('price')) {
            $price = $request->price;
            if (is_numeric($price)) {
                $query->where('price', '<=', $price);
            }
        }

        if ($request->filled('bedroom')) {
            $bedroomIds = is_array($request->bedroom) ? $request->bedroom : [$request->bedroom];
            $query->whereHas('bedroomOptions', function($q) use ($bedroomIds) {
                $q->whereIn('bedroom_options.id', $bedroomIds);
            });
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => ($propertyCategory->name ?? '') . ' Properties in ' . ($location->name ?? '') . ' - ' . ($propertyCondition->name ?? ''),
            'meta_desc' => $propertyCategory->meta_description ?? $location->meta_description ?? null
        ];
        
        return view('front.property', compact(
            'propertyCategory', 'location', 'propertyCondition', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by category and location
     */
    public function categoryLocationProperties(Request $request, $category_slug, $location_slug, $page = null)
    {
        // Handle empty page parameter (trailing slash)
        $page = ($page === null || $page === '') ? 1 : (int)$page;
        
        // Extract category slug from the URL pattern
        // The route pattern is: /{category_slug}-properties-in-{location_slug}
        // So category_slug might be "residential" or "residential-properties-in" depending on how Laravel matches
        // We need to extract just the category part before "-properties-in-"
        $categorySlug = preg_replace('/-properties-in-.*$/', '', $category_slug);
        $categorySlug = str_replace('-properties', '', $categorySlug);
        
        // Also handle case where location_slug might contain the full remaining part
        // If location_slug is empty or seems wrong, try to extract from category_slug
        if (empty($location_slug) || strpos($category_slug, '-properties-in-') !== false) {
            // Try to extract both from category_slug if it contains the full pattern
            if (preg_match('/^(.+?)-properties-in-(.+)$/', $category_slug, $matches)) {
                $categorySlug = $matches[1];
                $location_slug = $matches[2];
            }
        }
        
        $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->firstOrFail();
        $location = Location::where('slug', $location_slug)->where('is_active', true)->firstOrFail();
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('property_category_id', $propertyCategory->id)
            ->where('location_id', $location->id)
            ->where('is_active', true);

        // Apply additional filters
        if ($request->filled('type')) {
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => ($propertyCategory->name ?? '') . ' Properties in ' . ($location->name ?? ''),
            'meta_desc' => $propertyCategory->meta_description ?? $location->meta_description ?? null
        ];
        
        return view('front.property', compact(
            'propertyCategory', 'location', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by category and property type
     */
    public function categoryPropertyTypeProperties(Request $request, $category_slug, $property_type_slug, $page = 1)
    {
        // Extract category slug from the URL pattern (e.g., "residential-properties" -> "residential")
        $categorySlug = str_replace('-properties', '', $category_slug);
        
        $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->firstOrFail();
        
        // Check if this is actually a property type or a condition
        // Types are shared across categories (e.g. apartments used by resale/rental/holiday-homes)
        $propertyType = PropertyType::where('slug', $property_type_slug)
            ->where('is_active', true)
            ->first();
        
        // Broken SEO URLs: /{category}-properties/properties-in-{city}
        if (preg_match('/^properties-in-(.+)$/', $property_type_slug, $matches)) {
            $location = Location::where('slug', $matches[1])->where('is_active', true)->first();
            if ($location) {
                return redirect()->route('category.location.properties', array_filter([
                    'category_slug' => $propertyCategory->slug,
                    'location_slug' => $location->slug,
                    'page' => is_numeric($page) ? $page : null,
                ]), 301);
            }
        }

        // If not a property type, check if it's a condition
        if (!$propertyType) {
            $propertyCondition = PropertyCondition::where('slug', $property_type_slug)->where('is_active', true)->first();
            if ($propertyCondition) {
                // Redirect to condition route
                return redirect()->route('category.condition.properties', [$category_slug, $property_type_slug, $page], 301);
            }
            // If neither, return 404
            abort(404);
        }
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('property_category_id', $propertyCategory->id)
            ->where('property_type_id', $propertyType->id)
            ->where('is_active', true);

        // Apply additional filters
        if ($request->filled('location')) {
            $location = Location::where('slug', $request->location)->orWhere('id', $request->location)->first();
            if ($location) {
                $query->where('location_id', $location->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => ($propertyCategory->name ?? '') . ' ' . ($propertyType->name ?? '') . ' Properties',
            'meta_desc' => $propertyCategory->meta_description ?? $propertyType->meta_description ?? null
        ];
        
        return view('front.property', compact(
            'propertyCategory', 'propertyType', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by category, property type, and location
     */
    public function categoryPropertyTypeLocationProperties(Request $request, $category_slug, $property_type_slug, $location_slug, $page = 1)
    {
        // Extract category slug from the URL pattern (e.g., "residential-properties" -> "residential")
        $categorySlug = str_replace('-properties', '', $category_slug);
        
        // Extract property type slug from the URL pattern (e.g., "apartments-in-gurgaon" -> "apartments")
        $propertyTypeSlug = str_replace('-in-' . $location_slug, '', $property_type_slug);

        // Broken SEO URLs like /residential-properties/properties-in-gurgaon
        // get parsed as type=properties + location=gurgaon — send them to the category+location listing
        if ($propertyTypeSlug === 'properties') {
            $location = Location::where('slug', $location_slug)->where('is_active', true)->first();
            $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->first();
            if ($propertyCategory && $location) {
                return redirect()->route('category.location.properties', array_filter([
                    'category_slug' => $propertyCategory->slug,
                    'location_slug' => $location->slug,
                    'page' => is_numeric($page) ? $page : null,
                ]), 301);
            }
            if ($location) {
                return redirect()->route('location.properties', array_filter([
                    'location_slug' => $location->slug,
                    'page' => is_numeric($page) ? $page : null,
                ]), 301);
            }
        }
        
        $propertyCategory = PropertyCategory::where('slug', $categorySlug)->where('is_active', true)->firstOrFail();
        // Types are shared across categories — do not require property_types.property_category_id match
        $propertyType = PropertyType::where('slug', $propertyTypeSlug)
            ->where('is_active', true)
            ->firstOrFail();
        $location = Location::where('slug', $location_slug)->where('is_active', true)->firstOrFail();
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('property_category_id', $propertyCategory->id)
            ->where('property_type_id', $propertyType->id)
            ->where('location_id', $location->id)
            ->where('is_active', true);

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList();
        $pageMeta = $slugListMeta ?: [
            'meta_title' => ($propertyCategory->name ?? '') . ' ' . ($propertyType->name ?? '') . ' in ' . ($location->name ?? ''),
            'meta_desc' => $propertyCategory->meta_description ?? $propertyType->meta_description ?? null
        ];
        
        return view('front.property', compact(
            'propertyCategory', 'propertyType', 'location', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by property type and location
     */
    public function propertyTypeLocationProperties(Request $request, $property_type_slug, $location_slug, $page = 1)
    {
        $propertyType = PropertyType::where('slug', $property_type_slug)->where('is_active', true)->firstOrFail();
        $location = Location::where('slug', $location_slug)->where('is_active', true)->firstOrFail();
        
        // Check slug_list for meta data
        $slugListMeta = $this->getMetaFromSlugList($property_type_slug . '-in-' . $location_slug);
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $propertyType->name . ' in ' . $location->name,
            'meta_desc' => $propertyType->meta_description ?? $location->meta_description ?? null
        ];
        
        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('property_type_id', $propertyType->id)
            ->where('location_id', $location->id)
            ->where('is_active', true);

        // Apply additional filters
        if ($request->filled('category')) {
            $category = PropertyCategory::where('slug', $request->category)->orWhere('id', $request->category)->first();
            if ($category) {
                $query->where('property_category_id', $category->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
            
        // Get required variables for the property view
        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();
        
        return view('front.property', compact(
            'propertyType', 'location', 'properties', 'properCategory', 
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by rise (high-rise or low-rise).
     */
    public function riseProperties(Request $request, $rise_slug, $page = 1)
    {
        $rise = Property::riseValueFromUrlSlug($rise_slug);

        if (!$rise) {
            abort(404);
        }

        $riseLabel = Property::riseLabel($rise);
        $slugListMeta = $this->getMetaFromSlugList("{$rise_slug}-properties");
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $riseLabel . ' Properties',
            'meta_desc' => 'Browse ' . strtolower($riseLabel) . ' properties for sale and rent.',
        ];

        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('is_active', true)
            ->byRise($rise);

        if ($request->filled('category')) {
            $category = PropertyCategory::where('slug', $request->category)->orWhere('id', $request->category)->first();
            if ($category) {
                $query->where('property_category_id', $category->id);
            }
        }

        if ($request->filled('location')) {
            $filterLocation = Location::where('slug', $request->location)->orWhere('id', $request->location)->first();
            if ($filterLocation) {
                $query->where('location_id', $filterLocation->id);
            }
        }

        if ($request->filled('type')) {
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
            ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);

        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->withActiveRiseProperties($rise)->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();

        return view('front.property', compact(
            'properties', 'properCategory',
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show properties filtered by rise and location.
     */
    public function riseLocationProperties(Request $request, $rise_slug, $location_slug, $page = 1)
    {
        $rise = Property::riseValueFromUrlSlug($rise_slug);

        if (!$rise) {
            abort(404);
        }

        $location = Location::where('slug', $location_slug)->where('is_active', true)->firstOrFail();

        $riseLabel = Property::riseLabel($rise);
        $slugListMeta = $this->getMetaFromSlugList("{$rise_slug}-properties-in-{$location_slug}");
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $riseLabel . ' Properties in ' . $location->name,
            'meta_desc' => $location->meta_description ?? $location->site_description ?? null,
        ];

        $query = Property::with(['images', 'location', 'propertyType', 'propertyCategory'])
            ->where('location_id', $location->id)
            ->where('is_active', true)
            ->byRise($rise);

        if ($request->filled('category')) {
            $category = PropertyCategory::where('slug', $request->category)->orWhere('id', $request->category)->first();
            if ($category) {
                $query->where('property_category_id', $category->id);
            }
        }

        if ($request->filled('type')) {
            $type = PropertyType::where('slug', $request->type)->orWhere('id', $request->type)->first();
            if ($type) {
                $query->where('property_type_id', $type->id);
            }
        }

        $properties = $query->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
            ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);

        $properCategory = PropertyCategory::active()->ordered()->get();
        $allLocation = Location::active()->withActiveRiseProperties($rise)->ordered()->get();
        $propertiesPrice = Property::pluck('price')->unique()->values();
        $propertyTypeAll = PropertyType::active()->ordered()->get();
        $propertiesbedroom = Property::with('bedroomOptions')->get()->pluck('bedroomOptions.*.name')->flatten()->filter()->unique()->values();

        return view('front.property', compact(
            'location', 'properties', 'properCategory',
            'allLocation', 'propertiesPrice', 'propertyTypeAll', 'propertiesbedroom', 'pageMeta'
        ));
    }

    /**
     * Show rent property details
     */
    public function rentPropertyShow($slug)
    {
        $property = Property::with([
                'images',
                'location',
                'area',
                'propertyType',
                'propertyCategory',
                'propertyStatus',
                'bedroomOptions',
                'partner',
                'amenities',
                'faqs',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->where('is_rental', true)
            ->firstOrFail();

        // Check slug_list for meta data (canonical path is /property/rental/{slug})
        $slugListMeta = $this->getMetaFromSlugList('property/rental/' . $slug)
            ?: $this->getMetaFromSlugList('rent-property/' . $slug);
        $pageMeta = $slugListMeta ?: [
            'meta_title' => $property->meta_title ?? $property->name,
            'meta_desc' => $property->meta_description ?? strip_tags($property->property_description ?? '')
        ];

        // Get similar rental properties
        $similarProperties = Property::with(['images', 'location', 'propertyType', 'bedroomOptions', 'propertyCategory'])
            ->where('is_active', true)
            ->where('is_rental', true)
            ->where('id', '!=', $property->id)
            ->where(function($query) use ($property) {
                if ($property->property_type_id) {
                    $query->where('property_type_id', $property->property_type_id);
                }
                if ($property->location_id) {
                    $query->orWhere('location_id', $property->location_id);
                }
            })
            ->limit(4)
            ->get();

        return view('front.rent-property-details', compact('property', 'similarProperties', 'pageMeta'));
    }

    /**
     * Search API for auto-suggestions
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = [];

        // Search Properties
        $properties = Property::with(['location', 'propertyType', 'propertyCategory'])
            ->where('is_active', true)
            ->where('name', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($properties as $property) {
            $categorySlug = $property->propertyCategory ? $property->propertyCategory->slug : 'residential';
            $suggestions[] = [
                'type' => 'property',
                'title' => $property->name,
                'subtitle' => $property->location->name . ' • ' . $property->propertyType->name,
                'url' => route('property.show', [$categorySlug, $property->slug])
            ];
        }

        // Search Locations
        $locations = Location::where('is_active', true)
            ->where('name', 'like', "%{$query}%")
            ->limit(3)
            ->get();

        foreach ($locations as $location) {
            $suggestions[] = [
                'type' => 'location',
                'title' => $location->name . ' Properties',
                'subtitle' => 'View all properties in ' . $location->name,
                'url' => route('location.properties', $location->slug)
            ];
        }

        // Search Property Types
        $propertyTypes = PropertyType::where('is_active', true)
            ->where('name', 'like', "%{$query}%")
            ->limit(3)
            ->get();

        foreach ($propertyTypes as $type) {
            // PropertyType should link to category + property type listing page
            if ($type->propertyCategory) {
                $categorySlug = $type->propertyCategory->slug;
                $url = route('category.propertytype.properties', [$categorySlug . '-properties', $type->slug]);
            } else {
                // Fallback if no category
                $url = '#';
            }
            $suggestions[] = [
                'type' => 'property_type',
                'title' => $type->name,
                'subtitle' => 'View all ' . strtolower($type->name) . ' properties',
                'url' => $url
            ];
        }

        // Search Property Categories
        $categories = PropertyCategory::where('is_active', true)
            ->where('name', 'like', "%{$query}%")
            ->limit(3)
            ->get();

        foreach ($categories as $category) {
            $suggestions[] = [
                'type' => 'category',
                'title' => $category->name,
                'subtitle' => 'View all ' . strtolower($category->name) . ' properties',
                'url' => route('category.direct', ['category_slug' => $category->slug])
            ];
        }

        // Search Partners
        $partners = Partner::where('is_active', true)
            ->where('name', 'like', "%{$query}%")
            ->limit(3)
            ->get();

        foreach ($partners as $partner) {
            $suggestions[] = [
                'type' => 'partner',
                'title' => $partner->name . ' Properties',
                'subtitle' => 'View properties by ' . $partner->name,
                'url' => route('partner.show', $partner->slug)
            ];
        }

        // Limit total suggestions
        $suggestions = array_slice($suggestions, 0, 10);

        return response()->json($suggestions);
    }

    /**
     * AJAX endpoint to load more properties for carousel
     */
    public function loadCarouselProperties(Request $request)
    {
        $categoryId = $request->input('category_id');
        $offset = (int) $request->input('offset', 0);
        $limit = (int) $request->input('limit', 3);
        
        if (!$categoryId) {
            return response()->json(['error' => 'Category ID is required'], 400);
        }
        
        $properties = Property::with(['images', 'location', 'propertyType', 'badge', 'propertyCategory'])
            ->where('property_category_id', $categoryId)
            ->where('is_active', true)
            ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();
        
        $html = '';
        foreach ($properties as $property) {
            $image = $property->images->where('is_banner', true)->first() 
                ?? $property->images->first();
            $imageUrl = $image 
                ? asset('storage/' . $image->image_path) 
                : asset('/frontassets/images/placeholder.jpg');
            
            $html .= '<div class="slide">';
            $html .= '<div class="samplebox ' . ($property->is_sold ? 'soldrel' : '') . '">';
            if ($property->is_sold) {
                $soldOutImage = $property->property_category_id == 4 
                    ? asset('frontassets/images/rented-out.png') 
                    : asset('frontassets/images/sold-out.png');
                $soldOutAlt = $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out';
                $html .= '<span class="sold"><img src="' . $soldOutImage . '" alt="' . $soldOutAlt . '"></span>';
            }
            $categorySlug = $property->propertyCategory ? $property->propertyCategory->slug : 'residential';
            $html .= '<div class="sampleimg">';
            $html .= '<a href="' . route('property.show', [$categorySlug, $property->slug]) . '">';
            $html .= '<img src="' . $imageUrl . '" alt="' . htmlspecialchars($property->name) . '" class="private_properties_image">';
            $html .= '</a>';
            $html .= '</div>';
            $html .= '<div class="sampletext">';
            $html .= '<span><i class="fas fa-map-marker-alt"></i> ' . ($property->location ? htmlspecialchars($property->location->name) : 'Location not specified') . '</span>';
            $html .= '<p><a href="' . route('property.show', [$categorySlug, $property->slug]) . '">' . htmlspecialchars($property->name) . '</a></p>';
            $html .= '<div class="private_property-footer">';
            $html .= '<div class="private_property-footer_left">';
            $html .= '<div class="private_property-price_aed">' . \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) . '</div>';
            $html .= '</div>';
            $html .= '<div class="private_property-footer_right">';
            if ($property->propertyType) {
                $html .= '<div class="private_property-amenties w-embed">' . htmlspecialchars($property->propertyType->name) . '</div>';
            }
            if ($property->area_sq_ft) {
                $html .= '<div class="private_property-amenties">' . number_format($property->area_sq_ft) . ' sq.ft</div>';
            }
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        
        return response()->json([
            'html' => $html,
            'count' => $properties->count(),
            'has_more' => $properties->count() === $limit
        ]);
    }

    /**
     * AJAX endpoint to load more properties for infinite scroll
     */
    public function loadMoreProperties(Request $request)
    {
        $page = (int) $request->input('page', 1);
        $query = $request->input('query');
        $formType = $request->input('form_type');
        $location = $request->input('location');
        $price = $request->input('price');
        $propertyType = $request->input('property_type');
        $bedroom = $request->input('bedroom');
        $category = $request->input('category');
        $type = $request->input('type');
        $partner = $request->input('partner');
        $locationSlug = $request->input('location_slug');
        $categorySlug = $request->input('category_slug');
        $propertyTypeSlug = $request->input('property_type_slug');
        $partnerSlug = $request->input('partner_slug');
        
        // Start building the query
        $propertyQuery = Property::with(['images', 'location', 'propertyType', 'propertyCategory', 'bedroomOptions', 'badge'])
            ->where('is_active', true);
        
        // Apply text search if provided
        if ($query) {
            $propertyQuery->search($query);
        }
        
        // Apply filters
        if ($location) {
            $locationModel = Location::where('name', $location)->orWhere('slug', $location)->first();
            if ($locationModel) {
                $propertyQuery->where('location_id', $locationModel->id);
            }
        }
        
        if ($locationSlug) {
            $locationModel = Location::where('slug', $locationSlug)->first();
            if ($locationModel) {
                $propertyQuery->where('location_id', $locationModel->id);
            }
        }
        
        if ($category) {
            $categoryModel = PropertyCategory::where('slug', $category)->orWhere('id', $category)->first();
            if ($categoryModel) {
                $propertyQuery->where('property_category_id', $categoryModel->id);
            }
        }
        
        if ($categorySlug) {
            $categoryModel = PropertyCategory::where('slug', $categorySlug)->first();
            if ($categoryModel) {
                $propertyQuery->where('property_category_id', $categoryModel->id);
            }
        }
        
        if ($type) {
            $typeModel = PropertyType::where('slug', $type)->orWhere('id', $type)->first();
            if ($typeModel) {
                $propertyQuery->where('property_type_id', $typeModel->id);
            }
        }
        
        if ($propertyTypeSlug) {
            $typeModel = PropertyType::where('slug', $propertyTypeSlug)->first();
            if ($typeModel) {
                $propertyQuery->where('property_type_id', $typeModel->id);
            }
        }
        
        if ($propertyType) {
            if (is_array($propertyType)) {
                $typeIds = PropertyType::whereIn('name', $propertyType)->pluck('id');
                if ($typeIds->isNotEmpty()) {
                    $propertyQuery->whereIn('property_type_id', $typeIds);
                }
            } else {
                $typeModel = PropertyType::where('name', $propertyType)->first();
                if ($typeModel) {
                    $propertyQuery->where('property_type_id', $typeModel->id);
                }
            }
        }
        
        if ($bedroom) {
            if (is_array($bedroom)) {
                $bedroomIds = BedroomOption::whereIn('value', $bedroom)->pluck('id');
                if ($bedroomIds->isNotEmpty()) {
                    $propertyQuery->whereHas('bedroomOptions', function($q) use ($bedroomIds) {
                        $q->whereIn('bedroom_options.id', $bedroomIds);
                    });
                }
            } else {
                $bedroomModel = BedroomOption::where('value', $bedroom)->first();
                if ($bedroomModel) {
                    $propertyQuery->whereHas('bedroomOptions', function($q) use ($bedroomModel) {
                        $q->where('bedroom_options.id', $bedroomModel->id);
                    });
                }
            }
        }
        
        if ($partner) {
            $partnerModel = Partner::where('slug', $partner)->orWhere('id', $partner)->first();
            if ($partnerModel) {
                $propertyQuery->where('partner_id', $partnerModel->id);
            }
        }
        
        if ($partnerSlug) {
            $partnerModel = Partner::where('slug', $partnerSlug)->first();
            if ($partnerModel) {
                $propertyQuery->where('partner_id', $partnerModel->id);
            }
        }
        
        // Apply price filter if provided
        if ($price) {
            $propertyQuery->where(function($q) use ($price) {
                if ($price === 'Below 1 Cr') {
                    $q->where('price', '<', 10000000);
                } elseif ($price === '1 Cr to 2 Cr') {
                    $q->whereBetween('price', [10000000, 20000000]);
                } elseif ($price === '2 Cr to 4 Cr') {
                    $q->whereBetween('price', [20000000, 40000000]);
                } elseif ($price === 'Above 4 Cr') {
                    $q->where('price', '>', 40000000);
                }
            });
        }
        
        // Paginate results
        $properties = $propertyQuery->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
                ->orderByRaw('CASE WHEN location_id = 1 THEN 0 ELSE 1 END')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ['*'], 'page', $page);
        
        // Generate HTML for properties
        $html = '';
        foreach ($properties as $property) {
            $image = $property->images->where('is_thumbnail', 1)->first() ?? $property->images->first();
            $imageUrl = $image && $image->image_path 
                ? $image->listing_image_url 
                : 'https://via.placeholder.com/1200x800?text=No+Image';
            
            $html .= '<div class="col-md-6">';
            $html .= '<div class="proboxcat ' . ($property->is_sold ? 'soldrel' : '') . '">';
            
            if ($property->is_sold) {
                $soldOutImage = $property->property_category_id == 4 
                    ? asset('frontassets/images/rented-out.png') 
                    : asset('frontassets/images/sold-out.png');
                $soldOutAlt = $property->property_category_id == 4 ? 'Rented Out' : 'Sold Out';
                $html .= '<span class="sold"><img src="' . $soldOutImage . '" alt="' . $soldOutAlt . '"></span>';
            }
            
            $categorySlug = $property->propertyCategory->slug ?? 'residential';
            $propertyUrl = route('property.show', [$categorySlug, $property->slug]);
            
            $html .= '<div class="proboxcatimg" style="position: relative;">';
            if ($property->badge) {
                $html .= '<span class="property-badge" style="position: absolute; top: 10px; left: 10px; z-index: 10; background: #a98862; color: #fff; padding: 5px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-transform: uppercase; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">' . htmlspecialchars($property->badge->name) . '</span>';
            }
            $html .= '<a href="' . $propertyUrl . '">';
            $html .= '<img src="' . $imageUrl . '" alt="' . htmlspecialchars($property->name) . '" class="img-fluid" onerror="this.src=\'https://via.placeholder.com/400x300?text=No+Image\'">';
            $html .= '</a>';
            $html .= '</div>';
            
            $html .= '<div class="proboxcattext">';
            $html .= '<h1 class="details_meta-property_title">';
            $html .= '<a href="' . $propertyUrl . '">' . htmlspecialchars($property->name) . '</a>';
            $html .= '</h1>';
            
            $html .= '<p>';
            $html .= ($property->propertyType ? htmlspecialchars($property->propertyType->name) : '') . ' | ';
            $html .= ($property->bedroomOptions && $property->bedroomOptions->count() > 0 
                ? htmlspecialchars($property->bedroomOptions->pluck('name')->join(', ')) 
                : '-') . ' | ';
            $html .= ($property->area_sq_ft ?? 'N/A') . ' sq.ft';
            $html .= '</p>';
            
            $html .= '<p>Location: ' . ($property->location ? htmlspecialchars($property->location->name) : 'Location not specified') . '</p>';
            
            $html .= '<div class="search_properties-details_price">';
            $html .= '<div class="details_price-aed">' . \App\Helpers\ConfigHelper::formatPrice($property->price, $property->price_unit) . '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        
        return response()->json([
            'html' => $html,
            'has_more' => $properties->hasMorePages(),
            'current_page' => $properties->currentPage(),
            'last_page' => $properties->lastPage()
        ]);
    }

    /**
     * Display a static page by slug
     */
    public function staticPage($slug)
    {
        // Find static page by slug (exact match first)
        $staticPage = StaticPage::where('slug', $slug)->first();
        
        if (!$staticPage) {
            abort(404, 'Static page not found');
        }
        
        // Process content to add target="_blank" to all links that don't already have a target attribute
        $content = $staticPage->content;
        if ($content) {
            // Use regex to add target="_blank" and rel="noopener noreferrer" to all anchor tags
            // This pattern matches <a> tags that don't already have a target attribute
            $content = preg_replace_callback(
                '/<a\s+([^>]*?)>/i',
                function($matches) {
                    $attributes = $matches[1];
                    // Check if target attribute already exists
                    if (preg_match('/target\s*=\s*["\']/', $attributes)) {
                        // Target already exists, just add rel if not present
                        if (!preg_match('/rel\s*=\s*["\']/', $attributes)) {
                            return '<a ' . $attributes . ' rel="noopener noreferrer">';
                        }
                        return $matches[0];
                    } else {
                        // Add target="_blank" and rel="noopener noreferrer"
                        return '<a ' . $attributes . ' target="_blank" rel="noopener noreferrer">';
                    }
                },
                $content
            );
            $staticPage->content = $content;
        }
        
        // Get excerpt from content (strip HTML and limit to 150 chars)
        $excerpt = strip_tags($staticPage->content);
        $excerpt = \Illuminate\Support\Str::limit($excerpt, 150);
        
        // Get meta data for the page
        $pageMeta = [
            'meta_title' => $staticPage->name . ' - ' . SiteConfigHelper::siteName(),
            'meta_desc' => $excerpt ?: SiteConfigHelper::homepageDescription(),
        ];
        
        return view('front.static-page', compact('staticPage', 'pageMeta'));
    }

}
