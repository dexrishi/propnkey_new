<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminSidebar extends Component
{
    public $currentRoute;

    /**
     * Create a new component instance.
     */
    public function __construct($currentRoute = null)
    {
        $this->currentRoute = $currentRoute ?? request()->route()->getName();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.admin-sidebar', [
            'menuItems' => $this->getFilteredMenuItems(),
            'canUsePropertyTools' => auth()->check()
                && auth()->user()->hasPermission('properties')
                && !auth()->user()->isSeo(),
        ]);
    }

    /**
     * Check if a route is active
     */
    public function isActive($route)
    {
        return $this->currentRoute === $route;
    }

    /**
     * Check if any of the given routes are active
     */
    public function isActiveAny(array $routes): bool
    {
        foreach ($routes as $route) {
            if ($this->isActive($route)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Build a leaf menu link.
     */
    private function link(string $route, string $icon, string $label, ?string $permission = null, array $activeRoutes = [], array $extra = []): array
    {
        $activeRoutes = $activeRoutes ?: [$route];

        return array_merge([
            'type' => 'link',
            'route' => $route,
            'icon' => $icon,
            'label' => $label,
            'permission' => $permission,
            'active' => $this->isActiveAny($activeRoutes),
        ], $extra);
    }

    /**
     * Build a collapsible group.
     */
    private function group(string $id, string $icon, string $label, array $children): array
    {
        return [
            'type' => 'group',
            'id' => $id,
            'icon' => $icon,
            'label' => $label,
            'children' => $children,
            'active' => collect($children)->contains(fn ($child) => !empty($child['active'])),
        ];
    }

    /**
     * Get menu items
     */
    public function getMenuItems()
    {
        return [
            $this->link('dashboard', 'bi-speedometer2', 'Dashboard'),
            $this->link('inquiries.index', 'bi-envelope', 'Inquiries', 'inquiries'),

            $this->group('website', 'bi-globe2', 'Website', [
                $this->link('configs.index', 'bi-gear', 'Site Configs', 'configs', [
                    'configs.index', 'configs.create', 'configs.edit', 'configs.show',
                ]),
                $this->link('pages.index', 'bi-file-text', 'Pages', 'pages', [
                    'pages.index', 'pages.create', 'pages.edit', 'pages.show',
                ]),
                $this->link('static-pages.index', 'bi-file-earmark-text', 'Static Pages', 'static-pages', [
                    'static-pages.index', 'static-pages.create', 'static-pages.edit', 'static-pages.show',
                ]),
                $this->link('menus.index', 'bi-list-ul', 'Menus', 'menus', [
                    'menus.index', 'menus.create', 'menus.edit', 'menus.show',
                ]),
                $this->link('slug-lists.index', 'bi-link-45deg', 'Slug List', 'slug-lists', [
                    'slug-lists.index', 'slug-lists.create', 'slug-lists.edit', 'slug-lists.show',
                ]),
                $this->link('footer-items.index', 'bi-layout-text-sidebar', 'Footer Items', 'footer-items', [
                    'footer-items.index', 'footer-items.create', 'footer-items.edit', 'footer-items.show',
                ]),
                $this->link('footer-categories.index', 'bi-tags', 'Footer Categories', 'footer-categories', [
                    'footer-categories.index', 'footer-categories.create', 'footer-categories.edit', 'footer-categories.show',
                ]),
                $this->link('redirections.index', 'bi-arrow-left-right', 'URL Redirections', 'redirections', [
                    'redirections.index', 'redirections.create', 'redirections.edit', 'redirections.show',
                ]),
            ]),

            $this->group('masters', 'bi-collection', 'Masters', [
                $this->link('locations.index', 'bi-geo-alt', 'Locations', 'locations', [
                    'locations.index', 'locations.create', 'locations.edit', 'locations.show',
                ]),
                $this->link('partners.index', 'bi-handshake', 'Partners', 'partners', [
                    'partners.index', 'partners.create', 'partners.edit', 'partners.show',
                ]),
                $this->link('amenities.index', 'bi-star', 'Amenities', 'amenities', [
                    'amenities.index', 'amenities.create', 'amenities.edit', 'amenities.show',
                ]),
                $this->link('agents.index', 'bi-person-badge', 'Agents', 'agents', [
                    'agents.index', 'agents.create', 'agents.edit', 'agents.show',
                ]),
                $this->link('testimonials.index', 'bi-chat-quote', 'Testimonials', 'testimonials', [
                    'testimonials.index', 'testimonials.create', 'testimonials.edit', 'testimonials.show',
                ]),
                $this->link('badges.index', 'bi-award', 'Badges', 'badges', [
                    'badges.index', 'badges.create', 'badges.edit', 'badges.show',
                ]),
                $this->link('alt-types.index', 'bi-card-image', 'Alt Types', 'alt-types', [
                    'alt-types.index', 'alt-types.create', 'alt-types.edit', 'alt-types.show',
                ]),
            ]),

            $this->group('blog', 'bi-journal-text', 'Blog', [
                $this->link('blog-categories.index', 'bi-folder', 'Blog Categories', 'blog-categories', [
                    'blog-categories.index', 'blog-categories.create', 'blog-categories.edit', 'blog-categories.show',
                ]),
                $this->link('blog-posts.index', 'bi-file-text', 'Blog Posts', 'blog-posts', [
                    'blog-posts.index', 'blog-posts.create', 'blog-posts.edit', 'blog-posts.show',
                ]),
                $this->link('blog-authors.index', 'bi-person-circle', 'Blog Authors', 'blog-authors', [
                    'blog-authors.index', 'blog-authors.create', 'blog-authors.edit', 'blog-authors.show',
                ], [
                    'roles' => ['super_admin', 'admin', 'seo'],
                ]),
            ]),

            $this->group('properties', 'bi-building', 'Properties', [
                $this->link('properties.index', 'bi-building', 'All Properties', 'properties', [
                    'properties.index', 'properties.create', 'properties.edit', 'properties.show',
                ]),
                $this->link('new-developments.index', 'bi-stars', 'New Developments', 'new-developments', [
                    'new-developments.index', 'new-developments.create', 'new-developments.edit', 'new-developments.show',
                ]),
                $this->link('property-categories.index', 'bi-building', 'Property Categories', 'property-categories', [
                    'property-categories.index', 'property-categories.create', 'property-categories.edit', 'property-categories.show',
                ]),
                $this->link('property-conditions.index', 'bi-tag', 'Property Conditions', 'property-conditions', [
                    'property-conditions.index', 'property-conditions.create', 'property-conditions.edit', 'property-conditions.show',
                ]),
                $this->link('property-types.index', 'bi-house', 'Property Types', 'property-types', [
                    'property-types.index', 'property-types.create', 'property-types.edit', 'property-types.show',
                ]),
                $this->link('property-statuses.index', 'bi-check-circle', 'Property Statuses', 'property-statuses', [
                    'property-statuses.index', 'property-statuses.create', 'property-statuses.edit', 'property-statuses.show',
                ]),
                $this->link('bedroom-options.index', 'bi-door-open', 'Bedroom Options', 'bedroom-options', [
                    'bedroom-options.index', 'bedroom-options.create', 'bedroom-options.edit', 'bedroom-options.show',
                ]),
            ]),

            $this->link('profile.show', 'bi-person', 'My Profile', null, [
                'profile.show', 'profile.edit', 'profile.password', 'profile.edit-profile',
            ]),

            $this->group('system', 'bi-shield-lock', 'System', [
                $this->link('users.index', 'bi-people', 'Users', 'users', [
                    'users.index', 'users.create', 'users.edit', 'users.show',
                ], [
                    'super_admin_only' => true,
                ]),
                $this->link('activity-logs.index', 'bi-clock-history', 'Activity Logs', 'activity-logs', [
                    'activity-logs.index', 'activity-logs.show',
                ], [
                    'super_admin_only' => true,
                ]),
            ]),
        ];
    }

    /**
     * Whether the authenticated user may see a leaf item.
     */
    private function userCanSee(array $item, $user): bool
    {
        if (!empty($item['super_admin_only'])) {
            return $user->isSuperAdmin();
        }

        if (!empty($item['roles']) && !in_array($user->role, $item['roles'], true)) {
            return false;
        }

        if (empty($item['permission'])) {
            return true;
        }

        return $user->hasPermission($item['permission']);
    }

    /**
     * Get menu items filtered by user permissions
     */
    public function getFilteredMenuItems()
    {
        $user = auth()->user();

        if (!$user) {
            return [];
        }

        $filtered = [];

        foreach ($this->getMenuItems() as $item) {
            if (($item['type'] ?? 'link') === 'group') {
                $children = array_values(array_filter(
                    $item['children'] ?? [],
                    fn ($child) => $this->userCanSee($child, $user)
                ));

                if ($children === []) {
                    continue;
                }

                $item['children'] = $children;
                $item['active'] = collect($children)->contains(fn ($child) => !empty($child['active']));
                $filtered[] = $item;
                continue;
            }

            if ($this->userCanSee($item, $user)) {
                $filtered[] = $item;
            }
        }

        return $filtered;
    }
}
