<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    public const RISE_HIGH = 'high';

    public const RISE_LOW = 'low';

    public const RISE_URL_SLUGS = [
        self::RISE_HIGH => 'high-rise',
        self::RISE_LOW => 'low-rise',
    ];

    protected $fillable = [
        'is_featured',
        'name',
        'slug',
        'alias_name',
        'partner_id',
        'agent_id',
        'location_id',
        'area_id',
        'property_type_id',
        'property_category_id',
        'property_condition_id',
        'rating',
        'review_count',
        'badge_id',
        'locality',
        'address',
        'rera_reg_no',
        'sort_order',
        'home_sort',
        'price',
        'monthly_rent',
        'security_deposit',
        'one_time_fees',
        'total_payable',
        'rent_includes',
        'rent_excludes',
        'rental_process',
        'dos_donts',
        'lock_in_period_days',
        'notice_period_days',
        'terms_conditions',
        'is_rental',
        'area_sq_ft',
        'rise',
        'possession',
        'property_status_id',
        'youtube_url',
        'is_sold',
        'amenities_description',
        'property_description',
        'gallery_description',
        'floor_plan_description',
        'offer_text',
        'meta_title',
        'meta_description',
        'airport',
        'entertainment',
        'national_highway',
        'hospitals',
        'education',
        'project_highlights_title',
        'highlight_images',
        'location_features',
        'price_list',
        'map_code',
        'map_text',
        'is_active',
        'explore_nearby',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_sold' => 'boolean',
        'is_active' => 'boolean',
        'possession' => 'date',
        'rating' => 'decimal:2',
        'price' => 'decimal:2',
        'highlight_images' => 'array',
        'explore_nearby' => 'array',
    ];

    /**
     * Get the partner that owns the property.
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Get the agent that owns the property.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Get the location that owns the property.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the area that owns the property.
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the property type that owns the property.
     */
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    /**
     * Get the property category that owns the property.
     */
    public function propertyCategory()
    {
        return $this->belongsTo(PropertyCategory::class);
    }

    /**
     * Get the property condition that owns the property.
     */
    public function propertyCondition()
    {
        return $this->belongsTo(PropertyCondition::class);
    }

    /**
     * Get the badge that owns the property.
     */
    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    /**
     * Get the bedroom options for the property (multi-select).
     */
    public function bedroomOptions()
    {
        return $this->belongsToMany(BedroomOption::class, 'property_bedroom_options');
    }

    /**
     * Get the property status for the property.
     */
    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class);
    }

    /**
     * Get the amenities for the property.
     */
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'property_amenities');
    }

    /**
     * Get the images for the property.
     */
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function faqs()
    {
        return $this->hasMany(PropertyFaq::class)->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get the logo images for the property.
     */
    public function logos()
    {
        return $this->hasMany(PropertyImage::class)->where('type', 'logo');
    }

    /**
     * Get the first logo image for the property (for backward compatibility).
     */
    public function logo()
    {
        return $this->hasOne(PropertyImage::class)->where('type', 'logo');
    }

    /**
     * Get the project images for the property.
     */
    public function projectImages()
    {
        return $this->hasMany(PropertyImage::class)->where('type', 'project');
    }

    /**
     * Get the floor plan images for the property.
     */
    public function floorPlanImages()
    {
        return $this->hasMany(PropertyImage::class)->where('type', 'floor_plan');
    }

    /**
     * Get the banner image for the property.
     */
    public function bannerImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_banner', true);
    }

    /**
     * Get the thumbnail image for the property.
     */
    public function thumbnailImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_thumbnail', true);
    }

    /**
     * Get the thumbnail 2 image for the property.
     */
    public function thumbnail2Image()
    {
        return $this->hasOne(PropertyImage::class)->where('is_thumbnail_2', true);
    }

    public static function riseValueFromUrlSlug(string $slug): ?string
    {
        $value = array_search($slug, self::RISE_URL_SLUGS, true);

        return $value !== false ? $value : null;
    }

    public static function riseUrlSlug(string $riseValue): ?string
    {
        return self::RISE_URL_SLUGS[$riseValue] ?? null;
    }

    public static function riseLabel(string $riseValue): string
    {
        return $riseValue === self::RISE_HIGH ? 'High Rise' : 'Low Rise';
    }

    /**
     * Scope to get active properties.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by rise (high or low).
     */
    public function scopeByRise($query, string $rise)
    {
        return $query->where('rise', $rise);
    }

    /**
     * Scope to get featured properties.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get available properties (not sold).
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_sold', false);
    }

    /**
     * Scope to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope to order by home sort.
     */
    public function scopeHomeOrdered($query)
    {
        return $query->orderBy('home_sort')->orderBy('name');
    }

    /**
     * Scope to filter by property type.
     */
    public function scopeByType($query, $typeId)
    {
        return $query->where('property_type_id', $typeId);
    }

    /**
     * Scope to filter by location.
     */
    public function scopeByLocation($query, $locationId)
    {
        return $query->where('location_id', $locationId);
    }

    /**
     * Scope to filter by partner.
     */
    public function scopeByPartner($query, $partnerId)
    {
        return $query->where('partner_id', $partnerId);
    }

    /**
     * Scope to filter by agent.
     */
    public function scopeByAgent($query, $agentId)
    {
        return $query->where('agent_id', $agentId);
    }

    /**
     * Scope to search properties.
     */
    public function scopeSearch($query, $search)
    {
        $normalized = strtolower((string) $search);
        $normalized = preg_replace('/\s+/', ' ', trim($normalized));
        $normalized = preg_replace('/[^a-z0-9\s]/', ' ', $normalized);
        $normalized = preg_replace('/\s+/', ' ', trim($normalized));

        $stopWords = ['for', 'in', 'the', 'of', 'and', 'to'];
        $words = array_values(array_filter(
            explode(' ', $normalized),
            fn ($word) => $word !== '' && !in_array($word, $stopWords, true)
        ));

        $processedWords = [];
        $count = count($words);

        for ($i = 0; $i < $count; $i++) {
            $word = $words[$i];

            if (in_array($word, ['sector', 'phase', 'block'], true) && isset($words[$i + 1])) {
                $processedWords[] = $word . ' ' . $words[$i + 1];
                $i++;
                continue;
            }

            if (preg_match('/^\d+bhk$/', $word)) {
                $processedWords[] = $word;
                continue;
            }

            if (strlen($word) >= 3) {
                $processedWords[] = $word;
            }
        }

        if (empty($processedWords)) {
            return $query->whereRaw('1 = 0');
        }

        foreach ($processedWords as $token) {
            // Try both the raw token and a simple singular form so “apartments” matches “apartment”
            $tokenVariants = [$token];
            if (strlen($token) > 3 && substr($token, -1) === 's') {
                $tokenVariants[] = substr($token, 0, -1);
            }

            $tokenVariants = array_unique($tokenVariants);

            $query->where(function ($q) use ($tokenVariants) {
                foreach ($tokenVariants as $variant) {
                    $q->orWhere('name', 'like', "%{$variant}%")
                      ->orWhere('slug', 'like', "%{$variant}%")
                      ->orWhere('alias_name', 'like', "%{$variant}%")
                      ->orWhere('locality', 'like', "%{$variant}%")
                      ->orWhere('address', 'like', "%{$variant}%")
                      ->orWhereHas('location', function ($l) use ($variant) {
                          $l->where('name', 'like', "%{$variant}%");
                      })
                      ->orWhereHas('propertyType', function ($t) use ($variant) {
                          $t->where('name', 'like', "%{$variant}%");
                      })
                      ->orWhereHas('propertyCategory', function ($c) use ($variant) {
                          $c->where('name', 'like', "%{$variant}%");
                      });
                }
            });
        }

        return $query;
    }

    /**
     * Get formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        if (!$this->price) return null;
        
        return \App\Helpers\ConfigHelper::formatPrice($this->price);
    }

    /**
     * Get property type hierarchy.
     */
    public function getTypeHierarchyAttribute()
    {
        if (!$this->propertyType) return null;
        
        $type = $this->propertyType;
        $hierarchy = [];
        
        if ($type->propertyCategory) {
            $hierarchy[] = $type->propertyCategory->name;
        }
        
        if ($type->propertyCondition) {
            $hierarchy[] = $type->propertyCondition->name;
        }
        
        $hierarchy[] = $type->name;
        
        return implode(' ', $hierarchy);
    }

    /**
     * Get property status badge.
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->is_sold) {
            return '<span class="badge bg-danger">Sold</span>';
        }
        
        if ($this->propertyStatus) {
            $status = $this->propertyStatus->slug;
            switch ($status) {
                case 'newly_launched':
                    return '<span class="badge bg-success">Newly Launched</span>';
                case 'ready_to_move':
                    return '<span class="badge bg-primary">Ready to Move</span>';
                case 'under_construction':
                    return '<span class="badge bg-warning">Under Construction</span>';
                default:
                    return '<span class="badge bg-secondary">' . $this->propertyStatus->name . '</span>';
            }
        }
        
        return '<span class="badge bg-secondary">Unknown</span>';
    }
}