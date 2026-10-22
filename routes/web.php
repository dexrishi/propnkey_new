<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SlugListController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\BlogAuthorController;
use App\Http\Controllers\FooterItemController;
use App\Http\Controllers\FooterCategoryController;
use App\Http\Controllers\PropertyCategoryController;
use App\Http\Controllers\PropertyConditionController;
use App\Http\Controllers\PropertyStatusController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\BedroomOptionController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\NewDevelopmentController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\SuperAdminOnly;
use App\Http\Middleware\PreventSeoDelete;
use App\Http\Middleware\SeoRouteRestriction;
use App\Http\Middleware\CheckPermission;
use App\Models\Location;

// Admin property routes use numeric IDs; legacy /properties/{category_slug} uses slugs.
Route::pattern('property', '[0-9]+');

// ========================================
// AUTHENTICATION ROUTES (Public)
// ========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::get('/admin', function () {
    return redirect()->route('login');
});
// Registration disabled - only super admin can create users
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// ========================================
// FRONTEND STATIC PAGES ROUTE (Must come before admin routes to avoid conflicts)
// ========================================
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

Route::get('/pages/{slug}', [HomeController::class, 'staticPage'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('static.page');

// ========================================
// ADMIN ROUTES (Protected by Auth) - Must come before frontend routes
// ========================================
Route::middleware(['auth', CheckPermission::class, SeoRouteRestriction::class, PreventSeoDelete::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile management
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile/edit-profile', [ProfileController::class, 'editProfile'])->name('profile.edit-profile');
    Route::put('/profile/edit-profile', [ProfileController::class, 'updateProfile'])->name('profile.edit-profile.update');
    
    // Site Configuration
    Route::resource('configs', ConfigController::class);
    Route::post('/configs/clear-cache', [ConfigController::class, 'clearCache'])->name('configs.clear-cache');
    Route::post('/configs/bulk-update', [ConfigController::class, 'bulkUpdate'])->name('configs.bulk-update');
    
    // Locations
    Route::resource('locations', LocationController::class);
    Route::post('/locations/{location}/toggle', [LocationController::class, 'toggle'])->name('locations.toggle');
    Route::resource('areas', AreaController::class);
    
    // Partners
    Route::resource('partners', PartnerController::class);
    Route::post('/partners/{partner}/toggle', [PartnerController::class, 'toggle'])->name('partners.toggle');
    
    // Agents
    Route::resource('agents', AgentController::class);
    Route::post('/agents/{agent}/toggle', [AgentController::class, 'toggle'])->name('agents.toggle');
    
    // Amenities
    Route::resource('amenities', AmenityController::class);
    Route::post('/amenities/{amenity}/toggle', [AmenityController::class, 'toggle'])->name('amenities.toggle');
    
    // Pages
    Route::resource('pages', PageController::class);
    Route::post('/pages/{page}/toggle', [PageController::class, 'toggle'])->name('pages.toggle');
    
    // Static Pages
    Route::resource('static-pages', StaticPageController::class);
    
    // Users (Super Admin Only)
    Route::middleware([SuperAdminOnly::class])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('activity-logs', ActivityLogController::class)->only(['index', 'show']);
    });
    
    // Slug Lists
    Route::resource('slug-lists', SlugListController::class);
    Route::post('/slug-lists/{slugList}/toggle', [SlugListController::class, 'toggle'])->name('slug-lists.toggle');
    
    // Menus
    Route::resource('menus', MenuController::class);
    Route::post('/menus/{menu}/toggle', [MenuController::class, 'toggle'])->name('menus.toggle');
    
    // Testimonials
    Route::resource('testimonials', TestimonialController::class);
    Route::post('/testimonials/{testimonial}/toggle', [TestimonialController::class, 'toggle'])->name('testimonials.toggle');
    
    // Blog Categories
    Route::resource('blog-categories', BlogCategoryController::class);
    Route::post('/blog-categories/{blogCategory}/toggle', [BlogCategoryController::class, 'toggle'])->name('blog-categories.toggle');
    
    // Blog Posts
    Route::resource('blog-posts', BlogPostController::class);
    Route::post('/blog-posts/{blogPost}/toggle', [BlogPostController::class, 'toggle'])->name('blog-posts.toggle');

    // Blog Authors (admin and SEO)
    Route::resource('blog-authors', BlogAuthorController::class);
    Route::post('/blog-authors/{blogAuthor}/toggle', [BlogAuthorController::class, 'toggle'])->name('blog-authors.toggle');
    
    // Footer Items
    Route::resource('footer-items', FooterItemController::class);
    Route::post('/footer-items/{footerItem}/toggle', [FooterItemController::class, 'toggle'])->name('footer-items.toggle');
    
    // Footer Categories
    Route::resource('footer-categories', FooterCategoryController::class);
    
    // Badges
    Route::resource('badges', \App\Http\Controllers\Admin\BadgeController::class);

    // Alt Types (property image alt labels)
    Route::resource('alt-types', \App\Http\Controllers\Admin\AltTypeController::class);
    Route::post('/alt-types/{altType}/toggle', [\App\Http\Controllers\Admin\AltTypeController::class, 'toggle'])
        ->name('alt-types.toggle');

    Route::resource('redirections', \App\Http\Controllers\Admin\RedirectionController::class);
    
    // New Developments
    Route::resource('new-developments', NewDevelopmentController::class);
    Route::post('/new-developments/update-sort-order', [NewDevelopmentController::class, 'updateSortOrder'])->name('new-developments.update-sort-order');
    Route::post('/new-developments/{newDevelopment}/restore', [NewDevelopmentController::class, 'restore'])
        ->middleware([SuperAdminOnly::class])
        ->name('new-developments.restore');
    
    // Property Categories
    Route::resource('property-categories', PropertyCategoryController::class);
    Route::post('/property-categories/{propertyCategory}/toggle', [PropertyCategoryController::class, 'toggle'])->name('property-categories.toggle');
    Route::post('/property-categories/update-sort-order', [PropertyCategoryController::class, 'updateSortOrder'])->name('property-categories.update-sort-order');
    Route::post('/property-categories/{propertyCategory}/move-up', [PropertyCategoryController::class, 'moveUp'])->name('property-categories.move-up');
    Route::post('/property-categories/{propertyCategory}/move-down', [PropertyCategoryController::class, 'moveDown'])->name('property-categories.move-down');
    
    // Property Conditions
    Route::resource('property-conditions', PropertyConditionController::class);
    Route::post('/property-conditions/{propertyCondition}/toggle', [PropertyConditionController::class, 'toggle'])->name('property-conditions.toggle');
    
    // Property Types
    Route::resource('property-types', PropertyTypeController::class);
    Route::post('/property-types/{propertyType}/toggle', [PropertyTypeController::class, 'toggle'])->name('property-types.toggle');
    
    // Property Statuses
    Route::resource('property-statuses', PropertyStatusController::class);
    
    // Bedroom Options
    Route::resource('bedroom-options', BedroomOptionController::class);
    Route::post('/bedroom-options/{bedroomOption}/toggle', [BedroomOptionController::class, 'toggle'])->name('bedroom-options.toggle');
    
    // Properties - Admin CRUD
    Route::resource('properties', PropertyController::class);
    Route::post('/properties/{property}/restore', [PropertyController::class, 'restore'])
        ->middleware([SuperAdminOnly::class])
        ->name('properties.restore');
    Route::post('/properties/generate-slug', [PropertyController::class, 'generateSlug'])->name('properties.generate-slug');
    Route::post('/properties/{property}/toggle', [PropertyController::class, 'toggle'])->name('properties.toggle');
    Route::post('/properties/{property}/toggle-featured', [PropertyController::class, 'toggleFeatured'])->name('properties.toggle-featured');
    Route::post('/properties/update-sort-order', [PropertyController::class, 'updateSortOrder'])->name('properties.update-sort-order');
    
    // Property Image Management
    Route::post('/properties/{property}/images/upload', [PropertyController::class, 'uploadImage'])->name('properties.images.upload');
    Route::get('/properties/images/{image}', [PropertyController::class, 'getImage'])->name('properties.images.get');
    Route::post('/properties/images/{image}/regenerate-thumbnail', [PropertyController::class, 'regenerateImageThumbnail'])->name('properties.images.regenerate-thumbnail');
    Route::post('/properties/images/regenerate-all-thumbnails', [PropertyController::class, 'regenerateAllThumbnails'])->name('properties.images.regenerate-all-thumbnails');
    Route::post('/properties/{property}/images/regenerate-thumbnails', [PropertyController::class, 'regeneratePropertyThumbnails'])->name('properties.images.regenerate-property-thumbnails');
    Route::delete('/properties/images/{image}', [PropertyController::class, 'deleteImage'])->name('properties.images.delete');
    Route::put('/properties/images/{image}', [PropertyController::class, 'updateImage'])->name('properties.images.update');
    Route::post('/properties/{property}/images/sort', [PropertyController::class, 'updateImageSortOrder'])->name('properties.images.sort');
    
    // Inquiries
    Route::resource('inquiries', InquiryController::class);
    Route::post('/inquiries/{inquiry}/toggle', [InquiryController::class, 'toggle'])->name('inquiries.toggle');
    Route::post('/inquiries/{inquiry}/restore', [InquiryController::class, 'restore'])->name('inquiries.restore');
    Route::post('/inquiries/{inquiry}/update-status', [InquiryController::class, 'updateStatus'])->name('inquiries.update-status');
    Route::post('/inquiries/{inquiry}/update-notes', [InquiryController::class, 'updateNotes'])->name('inquiries.update-notes');
});

// Legacy listing URLs — registered after admin /properties/{property} routes (numeric IDs only)
Route::get('/properties/{category_slug}/{page?}', function (string $category_slug, $page = null) {
    $parameters = ['category_slug' => $category_slug];
    if ($page !== null && $page !== '') {
        $parameters['page'] = $page;
    }

    return redirect()->route('category.direct', $parameters, 302);
})->where([
    // Category slugs are alphabetic (residential, commercial); exclude numeric property IDs.
    'category_slug' => '[a-z][a-z0-9\-]*',
    'page' => '[a-z0-9\-]+',
])->name('category.properties');

// ========================================
// FRONTEND ROUTES (Public)
// ========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'advancedSearch'])->name('property.search');
Route::get('/api/search-suggestions', [HomeController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/api/carousel-properties', [HomeController::class, 'loadCarouselProperties'])->name('carousel.properties');
Route::get('/api/load-more-properties', [HomeController::class, 'loadMoreProperties'])->name('properties.load-more');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/category/{category_slug}', [HomeController::class, 'blogCategory'])->name('blog.category');
Route::get('/blog/{slug}', [HomeController::class, 'blogPost'])->name('blog.post');
// Legacy URL — permanently redirect to canonical location listing
Route::get('/location/{slug}', function (string $slug) {
    return redirect()->route('location.properties', ['location_slug' => $slug], 301);
})->name('location');
// Broken SEO URLs: /property/{category}/properties-in-{city} → /{category}-properties-in-{city}
Route::get('/property/{category_slug}/properties-in-{location_slug}', function (string $category_slug, string $location_slug) {
    $category = \App\Models\PropertyCategory::where('slug', $category_slug)->where('is_active', true)->first();
    $location = \App\Models\Location::where('slug', $location_slug)->where('is_active', true)->first();

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

    abort(404);
})->where([
    'category_slug' => '[a-z0-9\-]+',
    'location_slug' => '[a-z0-9\-]+',
]);

// Property detail route with category slug (e.g., /property/residential/m3m-golfestate-sector-65-gurgaon)
Route::get('/property/{category_slug}/{slug}', [HomeController::class, 'propertyShow'])->name('property.show');
// Legacy property detail URL — redirect to canonical /property/{category}/{slug}
Route::get('/property/{slug}', function (string $slug) {
    $property = \App\Models\Property::with('propertyCategory')
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    $categorySlug = ($property->property_category_id === 4 || $property->is_rental)
        ? 'rental'
        : ($property->propertyCategory->slug ?? 'residential');

    return redirect()->route('property.show', [
        'category_slug' => $categorySlug,
        'slug' => $slug,
    ], 301);
})->where('slug', '[a-z0-9\-]+')->name('property.show.legacy');
// Legacy rental detail URL — redirect to canonical /property/rental/{slug}
Route::get('/rent-property/{slug}', function (string $slug) {
    return redirect()->route('property.show', ['category_slug' => 'rental', 'slug' => $slug], 301);
})->name('rent.property.show');
// Legacy location URLs: /{city}-properties → /properties-in-{city} (active locations only)
$legacyLocationSlugs = Location::where('is_active', true)->pluck('slug')->filter()->implode('|');
if ($legacyLocationSlugs !== '') {
    Route::get('/{location_slug}-properties/{page?}', function (string $location_slug, $page = null) {
        if ($location_slug === 'chail') {
            return redirect()->route('category.location.properties', array_filter([
                'category_slug' => 'holiday-homes',
                'location_slug' => 'chail',
                'page' => $page,
            ]), 301);
        }

        return redirect()->route('location.properties', array_filter([
            'location_slug' => $location_slug,
            'page' => $page,
        ]), 301);
    })
        ->where('location_slug', $legacyLocationSlugs)
        ->where('page', '[a-z0-9\-]+');
}
// Legacy commercial URLs: /commercial/{type} → /commercial-properties/{type}
Route::get('/commercial/{property_type_slug}/{page?}', function (string $property_type_slug, $page = null) {
    return redirect()->route('category.propertytype.properties', array_filter([
        'category_slug' => 'commercial',
        'property_type_slug' => $property_type_slug,
        'page' => $page,
    ]), 301);
})->where('property_type_slug', '[a-z0-9\-]+')->where('page', '[a-z0-9\-]+');
// Legacy residential URLs: /residential/{type} → /residential-properties/{type}
Route::get('/residential/{property_type_slug}/{page?}', function (string $property_type_slug, $page = null) {
    return redirect()->route('category.propertytype.properties', array_filter([
        'category_slug' => 'residential',
        'property_type_slug' => $property_type_slug,
        'page' => $page,
    ]), 301);
})->where('property_type_slug', '[a-z0-9\-]+')->where('page', '[a-z0-9\-]+');
// Legacy holiday home category URL: /holiday-home → /holiday-homes-properties
Route::get('/holiday-home/{page?}', function ($page = null) {
    return redirect()->route('category.direct', array_filter([
        'category_slug' => 'holiday-homes',
        'page' => $page,
    ]), 301);
})->where('page', '[a-z0-9\-]+');
// Legacy holiday home URLs: /holiday-home-in-{city} → /holiday-homes-properties-in-{city}
if ($legacyLocationSlugs !== '') {
    Route::get('/holiday-home-in-{location_slug}/{page?}', function (string $location_slug, $page = null) {
        return redirect()->route('category.location.properties', array_filter([
            'category_slug' => 'holiday-homes',
            'location_slug' => $location_slug,
            'page' => $page,
        ]), 301);
    })
        ->where('location_slug', $legacyLocationSlugs)
        ->where('page', '[a-z0-9\-]+');
}
Route::get('/all-properties-page', [HomeController::class, 'viewAllProperties'])->name('properties.all');
Route::get('/all-properties/{page?}', [HomeController::class, 'allPropertiesLazy'])->name('properties.lazy');
// Location-only route (e.g., /properties-in-gurgaon) - must come before /properties/{category_slug} to prevent conflicts
Route::get('/properties-in-{location_slug}/{page?}', [HomeController::class, 'locationProperties'])->name('location.properties');
// Rise routes (e.g., /high-rise-properties, /low-rise-properties-in-gurgaon) - before category pattern routes
Route::get('/{rise_slug}-properties-in-{location_slug}/{page?}', [HomeController::class, 'riseLocationProperties'])
    ->where('rise_slug', 'high-rise|low-rise')
    ->where('location_slug', '[a-z0-9\-]+')
    ->name('rise.location.properties');
Route::get('/{rise_slug}-properties/{page?}', [HomeController::class, 'riseProperties'])
    ->where('rise_slug', 'high-rise|low-rise')
    ->name('rise.properties');
// Broken SEO URLs: /builder/properties-in-{city} → /properties-in-{city}
Route::get('/builder/properties-in-{location_slug}/{page?}', function (string $location_slug, $page = null) {
    $location = \App\Models\Location::where('slug', $location_slug)->where('is_active', true)->firstOrFail();

    return redirect()->route('location.properties', array_filter([
        'location_slug' => $location->slug,
        'page' => is_numeric($page) ? $page : null,
    ]), 301);
})->where('location_slug', '[a-z0-9\-]+')->where('page', '[0-9]+');

Route::get('/builder/{slug}/{page?}', [HomeController::class, 'partnerShow'])->name('partner.show');

// Recover browser-cached 301s from old /properties/{id}/edit route conflict
Route::get('/{propertyId}-properties/edit', function (string $propertyId) {
    return redirect()->route('properties.edit', (int) $propertyId, 302);
})->where('propertyId', '[0-9]+');
Route::get('/{propertyId}-properties', function (string $propertyId) {
    return redirect()->route('properties.show', (int) $propertyId, 302);
})->where('propertyId', '[0-9]+');

// Pattern routes must come BEFORE generic category route to prevent conflicts
// Category + Location + Condition route (e.g., /commercial-properties-in-gurgaon/resale) - must come before category + location route
Route::get('/{category_slug}-properties-in-{location_slug}/{condition_slug}/{page?}', [HomeController::class, 'categoryLocationConditionProperties'])
    ->where('category_slug', '[a-z0-9\-]+')
    ->where('location_slug', '[a-z0-9\-]+')
    ->where('condition_slug', '[a-z0-9\-]+')
    ->name('category.location.condition.properties');
// Category + Location route (e.g., /residential-properties-in-gurgaon) - must come before property type + location route
Route::get('/{category_slug}-properties-in-{location_slug}/{page?}', [HomeController::class, 'categoryLocationProperties'])
    ->where('category_slug', '[a-z0-9\-]+')
    ->where('location_slug', '[a-z0-9\-]+')
    ->name('category.location.properties');
// Broken SEO URLs: /{category}-properties/properties-in-{city}
// Must stay BEFORE /{category}-properties/{type}-in-{location} (which would parse type=properties)
Route::get('/{category_slug}-properties/properties-in-{location_slug}/{page?}', function (string $category_slug, string $location_slug, $page = null) {
    $category = \App\Models\PropertyCategory::where('slug', $category_slug)->where('is_active', true)->first();
    $location = \App\Models\Location::where('slug', $location_slug)->where('is_active', true)->first();

    if ($category && $location) {
        return redirect()->route('category.location.properties', array_filter([
            'category_slug' => $category->slug,
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

    abort(404);
})->where([
    'category_slug' => '[a-z0-9\-]+',
    'location_slug' => '[a-z0-9\-]+',
])->where('page', '[0-9]+');
// Category + Property Type + Location route (e.g., /residential-properties/apartments-in-gurgaon) - must come before other category routes
Route::get('/{category_slug}-properties/{property_type_slug}-in-{location_slug}/{page?}', [HomeController::class, 'categoryPropertyTypeLocationProperties'])
    ->where('category_slug', '[a-z0-9\-]+')
    ->where('property_type_slug', '[a-z0-9\-]+')
    ->where('location_slug', '[a-z0-9\-]+')
    ->name('category.propertytype.location.properties');
// Category + Condition + Property Type + Location route (e.g., /commercial-properties/resale/apartments-in-gurgaon) - most specific
Route::get('/{category_slug}-properties/{condition_slug}/{property_type_slug}-in-{location_slug}/{page?}', [HomeController::class, 'categoryConditionPropertyTypeLocationProperties'])
    ->where('category_slug', '[a-z0-9\-]+')
    ->where('condition_slug', '[a-z0-9\-]+')
    ->where('property_type_slug', '[a-z0-9\-]+')
    ->where('location_slug', '[a-z0-9\-]+')
    ->name('category.condition.propertytype.location.properties');
// This route requires "-in-" pattern (but NOT "-properties-in-"), so it won't match category routes
Route::get('/{property_type_slug}-in-{location_slug}/{page?}', [HomeController::class, 'propertyTypeLocationProperties'])
    ->where('property_type_slug', '[a-z0-9\-]+')
    ->where('location_slug', '[a-z0-9\-]+')
    ->name('property.type.location');
// Category + Condition + Property Type route (e.g., /commercial-properties/resale/apartments) - must come before category + condition route
Route::get('/{category_slug}-properties/{condition_slug}/{property_type_slug}/{page?}', [HomeController::class, 'categoryConditionPropertyTypeProperties'])->name('category.condition.propertytype.properties');
// Category + Property Type route (e.g., /residential-properties/apartments) - must come before category-only route
Route::get('/{category_slug}-properties/{property_type_slug}/{page?}', [HomeController::class, 'categoryPropertyTypeProperties'])->name('category.propertytype.properties');
// Category + Condition route (e.g., /commercial-properties/resale) - must come before category-only route
Route::get('/{category_slug}-properties/{condition_slug}/{page?}', [HomeController::class, 'categoryConditionProperties'])->name('category.condition.properties');

// Category-only route (e.g., /residential-properties, /commercial-properties, /holiday-homes-properties) - must be after pattern routes, defaults to "new" condition
Route::get('/{category_slug}-properties/{page?}', [HomeController::class, 'categoryProperties'])
    ->where('category_slug', '[a-z][a-z0-9\-]*')
    ->name('category.direct');
Route::post('/property-inquiry', [HomeController::class, 'contactsubmit'])->name('property.inquiry.submit');
Route::post('/contact-submit', [HomeController::class, 'contactsubmit'])->name('contact.submit');

// ========================================
// IMAGE REDIRECTION ROUTES (Public)
// ========================================
Route::get('/uploads/{filename}', function($filename) {
    $oldPath = 'uploads/' . $filename;
    $redirection = \App\Models\ImageRedirection::where('old_path', $oldPath)
        ->where('is_active', true)
        ->first();
    
    if ($redirection) {
        // Record the redirect
        $redirection->recordRedirect();
        
        // Redirect to the new path
        return redirect(asset('storage/' . $redirection->new_path), 301);
    }
    
    // If no redirection found, return 404
    abort(404);
})->where('filename', '.*');

// ========================================
// CATCH-ALL ROUTE FOR FRONTEND PAGES (Must be last)
// ========================================
// Route::get('/{slug}', [HomeController::class, 'page'])->name('page.show');


// ========================================
// TEST ROUTES (Remove in production)
// ========================================
Route::get('/test-config', function () {
    return response()->json([
        'site_name' => config_get('site_name'),
        'contact_email' => config_get('contact_email'),
        'maintenance_mode' => config_get('maintenance_mode'),
        'theme_settings' => config_get('theme_settings'),
        'all_configs' => \App\Helpers\ConfigHelper::all()
    ]);
});
