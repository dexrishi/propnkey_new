<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create root menu items
        $home = Menu::create([
            'title' => 'Home',
            'url' => '/',
            'parent_id' => null,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $about = Menu::create([
            'title' => 'About Us',
            'url' => '/about',
            'parent_id' => null,
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $services = Menu::create([
            'title' => 'Services',
            'url' => '/services',
            'parent_id' => null,
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $contact = Menu::create([
            'title' => 'Contact',
            'url' => '/contact',
            'parent_id' => null,
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // Create submenu items for About Us
        Menu::create([
            'title' => 'Our Team',
            'url' => '/about/team',
            'parent_id' => $about->id,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Our History',
            'url' => '/about/history',
            'parent_id' => $about->id,
            'sort_order' => 2,
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Mission & Vision',
            'url' => '/about/mission',
            'parent_id' => $about->id,
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // Create submenu items for Services
        Menu::create([
            'title' => 'Property Management',
            'url' => '/services/property-management',
            'parent_id' => $services->id,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Maintenance Services',
            'url' => '/services/maintenance',
            'parent_id' => $services->id,
            'sort_order' => 2,
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Tenant Services',
            'url' => '/services/tenant',
            'parent_id' => $services->id,
            'sort_order' => 3,
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Financial Management',
            'url' => '/services/financial',
            'parent_id' => $services->id,
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // Create submenu items for Contact
        Menu::create([
            'title' => 'Office Locations',
            'url' => '/contact/locations',
            'parent_id' => $contact->id,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Get Quote',
            'url' => '/contact/quote',
            'parent_id' => $contact->id,
            'sort_order' => 2,
            'is_active' => true,
        ]);

        // Create some inactive menu items
        Menu::create([
            'title' => 'Blog',
            'url' => '/blog',
            'parent_id' => null,
            'sort_order' => 5,
            'is_active' => false,
        ]);

        Menu::create([
            'title' => 'News',
            'url' => '/news',
            'parent_id' => null,
            'sort_order' => 6,
            'is_active' => false,
        ]);
    }
}