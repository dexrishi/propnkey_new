<?php

namespace App\Support;

class AdminPermissions
{
    /**
     * All assignable admin module permissions.
     * Each key maps to route names / prefixes used for access checks.
     */
    public static function catalog(): array
    {
        return [
            'dashboard' => [
                'label' => 'Dashboard',
                'icon' => 'bi-speedometer2',
                'routes' => ['dashboard'],
            ],
            'inquiries' => [
                'label' => 'Inquiries',
                'icon' => 'bi-envelope',
                'prefixes' => ['inquiries.'],
            ],
            'configs' => [
                'label' => 'Site Configs',
                'icon' => 'bi-gear',
                'prefixes' => ['configs.'],
            ],
            'locations' => [
                'label' => 'Locations',
                'icon' => 'bi-geo-alt',
                'prefixes' => ['locations.', 'areas.'],
            ],
            'partners' => [
                'label' => 'Partners',
                'icon' => 'bi-handshake',
                'prefixes' => ['partners.'],
            ],
            'amenities' => [
                'label' => 'Amenities',
                'icon' => 'bi-star',
                'prefixes' => ['amenities.'],
            ],
            'pages' => [
                'label' => 'Pages',
                'icon' => 'bi-file-text',
                'prefixes' => ['pages.'],
            ],
            'static-pages' => [
                'label' => 'Static Pages',
                'icon' => 'bi-file-earmark-text',
                'prefixes' => ['static-pages.'],
            ],
            'slug-lists' => [
                'label' => 'Slug List',
                'icon' => 'bi-link-45deg',
                'prefixes' => ['slug-lists.'],
            ],
            'menus' => [
                'label' => 'Menus',
                'icon' => 'bi-list-ul',
                'prefixes' => ['menus.'],
            ],
            'agents' => [
                'label' => 'Agents',
                'icon' => 'bi-person-badge',
                'prefixes' => ['agents.'],
            ],
            'testimonials' => [
                'label' => 'Testimonials',
                'icon' => 'bi-chat-quote',
                'prefixes' => ['testimonials.'],
            ],
            'blog-categories' => [
                'label' => 'Blog Categories',
                'icon' => 'bi-folder',
                'prefixes' => ['blog-categories.'],
            ],
            'blog-posts' => [
                'label' => 'Blog Posts',
                'icon' => 'bi-file-text',
                'prefixes' => ['blog-posts.'],
            ],
            'blog-authors' => [
                'label' => 'Blog Authors',
                'icon' => 'bi-person-circle',
                'prefixes' => ['blog-authors.'],
            ],
            'property-categories' => [
                'label' => 'Property Categories',
                'icon' => 'bi-building',
                'prefixes' => ['property-categories.'],
            ],
            'property-conditions' => [
                'label' => 'Property Conditions',
                'icon' => 'bi-tag',
                'prefixes' => ['property-conditions.'],
            ],
            'property-types' => [
                'label' => 'Property Types',
                'icon' => 'bi-house',
                'prefixes' => ['property-types.'],
            ],
            'property-statuses' => [
                'label' => 'Property Statuses',
                'icon' => 'bi-check-circle',
                'prefixes' => ['property-statuses.'],
            ],
            'bedroom-options' => [
                'label' => 'Bedroom Options',
                'icon' => 'bi-door-open',
                'prefixes' => ['bedroom-options.'],
            ],
            'properties' => [
                'label' => 'Properties',
                'icon' => 'bi-building',
                'prefixes' => ['properties.'],
            ],
            'new-developments' => [
                'label' => 'New Developments',
                'icon' => 'bi-stars',
                'prefixes' => ['new-developments.'],
            ],
            'footer-items' => [
                'label' => 'Footer Items',
                'icon' => 'bi-layout-text-sidebar',
                'prefixes' => ['footer-items.'],
            ],
            'footer-categories' => [
                'label' => 'Footer Categories',
                'icon' => 'bi-tags',
                'prefixes' => ['footer-categories.'],
            ],
            'badges' => [
                'label' => 'Badges',
                'icon' => 'bi-award',
                'prefixes' => ['badges.'],
            ],
            'alt-types' => [
                'label' => 'Alt Types',
                'icon' => 'bi-tags',
                'prefixes' => ['alt-types.'],
            ],
            'redirections' => [
                'label' => 'URL Redirections',
                'icon' => 'bi-arrow-left-right',
                'path' => '/redirections',
                'prefixes' => ['redirections.'],
            ],
        ];
    }

    /**
     * Permissions only Super Admin can use (not assignable).
     */
    public static function superAdminOnly(): array
    {
        return [
            'users' => [
                'label' => 'Users',
                'icon' => 'bi-people',
                'prefixes' => ['users.'],
            ],
            'activity-logs' => [
                'label' => 'Activity Logs',
                'icon' => 'bi-clock-history',
                'prefixes' => ['activity-logs.'],
            ],
        ];
    }

    public static function assignableKeys(): array
    {
        return array_keys(self::catalog());
    }

    public static function allKeys(): array
    {
        return array_merge(self::assignableKeys(), array_keys(self::superAdminOnly()));
    }

    public static function labels(): array
    {
        $labels = [];
        foreach (self::catalog() as $key => $meta) {
            $labels[$key] = $meta['label'];
        }
        return $labels;
    }

    /**
     * Default permissions when creating a user with a given role.
     */
    public static function defaultsForRole(string $role): array
    {
        return match ($role) {
            'super_admin' => self::assignableKeys(),
            'seo' => [
                'dashboard',
                'properties',
                'property-categories',
                'property-statuses',
                'property-types',
                'property-conditions',
                'locations',
                'partners',
                'pages',
                'static-pages',
                'blog-categories',
                'blog-posts',
                'blog-authors',
                'slug-lists',
                'redirections',
                'alt-types',
            ],
            default => self::assignableKeys(), // admin gets all assignable by default
        };
    }

    /**
     * Routes always allowed for any authenticated user.
     */
    public static function alwaysAllowedRoutes(): array
    {
        return [
            'logout',
            'profile.show',
            'profile.edit',
            'profile.update',
            'profile.password',
            'profile.password.update',
            'profile.edit-profile',
            'profile.edit-profile.update',
        ];
    }

    /**
     * Resolve permission key for a route name.
     */
    public static function permissionForRoute(?string $routeName): ?string
    {
        if (!$routeName) {
            return null;
        }

        if (in_array($routeName, self::alwaysAllowedRoutes(), true)) {
            return null; // always allowed sentinel handled by middleware
        }

        $all = array_merge(self::catalog(), self::superAdminOnly());

        foreach ($all as $key => $meta) {
            if (!empty($meta['routes']) && in_array($routeName, $meta['routes'], true)) {
                return $key;
            }

            foreach ($meta['prefixes'] ?? [] as $prefix) {
                if ($routeName === rtrim($prefix, '.') || str_starts_with($routeName, $prefix)) {
                    return $key;
                }
            }
        }

        return null;
    }

    /**
     * Map sidebar route name to permission key.
     */
    public static function permissionForMenuRoute(string $menuRoute): ?string
    {
        if ($menuRoute === 'profile.show') {
            return null; // always visible
        }

        return self::permissionForRoute($menuRoute);
    }
}
