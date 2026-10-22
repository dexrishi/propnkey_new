<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyCategory;

class PropertyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Residential',
                'slug' => 'residential',
                'heading' => 'Residential Properties',
                'description' => '<h3>Find Your Dream Home</h3><p>Discover a wide range of residential properties including apartments, houses, villas, and condominiums. Whether you\'re looking for your first home, upgrading to a larger space, or investing in real estate, we have the perfect residential property for you.</p><h4>Property Types:</h4><ul><li>Apartments & Condos</li><li>Single Family Homes</li><li>Townhouses</li><li>Villas & Luxury Homes</li><li>Duplexes & Multi-family</li></ul><p>Our residential properties are located in prime areas with excellent amenities, schools, and transportation links.</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Commercial',
                'slug' => 'commercial',
                'heading' => 'Commercial Properties',
                'description' => '<h3>Grow Your Business</h3><p>Explore our extensive portfolio of commercial properties including office spaces, retail units, warehouses, and industrial facilities. Perfect for businesses looking to establish or expand their operations in prime locations.</p><h4>Property Types:</h4><ul><li>Office Buildings & Spaces</li><li>Retail Shops & Malls</li><li>Warehouses & Industrial</li><li>Restaurants & Hotels</li><li>Medical & Professional Centers</li></ul><p>Our commercial properties offer excellent visibility, accessibility, and growth potential for your business ventures.</p>',
                'is_active' => true,
            ],
            [
                'name' => 'Happy Homes',
                'slug' => 'happy-homes',
                'heading' => 'Happy Homes Collection',
                'description' => '<h3>Where Happiness Lives</h3><p>Welcome to our exclusive Happy Homes collection - carefully curated properties that offer the perfect blend of comfort, style, and functionality. These special properties are designed to bring joy and satisfaction to their residents.</p><h4>Special Features:</h4><ul><li>Premium Locations</li><li>Modern Amenities</li><li>Eco-Friendly Design</li><li>Smart Home Technology</li><li>Community Living</li></ul><p>Each Happy Home is selected for its unique character, excellent condition, and potential to create lasting memories for families and individuals alike.</p>',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            PropertyCategory::create($category);
        }
    }
}