<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing amenities (handle foreign key constraints)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Amenity::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Read amenities from JSON file
        $jsonPath = base_path('data.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->error('data.json file not found!');
            return;
        }
        
        $jsonData = file_get_contents($jsonPath);
        $amenities = json_decode($jsonData, true);
        
        if (!$amenities) {
            $this->command->error('Invalid JSON data in data.json file!');
            return;
        }
        
        $this->command->info('Importing ' . count($amenities) . ' amenities from data.json...');
        
        // Icon mapping for common amenities
        $iconMap = [
            'wifi' => 'bi bi-wifi',
            'gym' => 'bi bi-activity',
            'air conditioner' => 'bi bi-thermometer',
            'pool' => 'bi bi-water',
            'swimming pool' => 'bi bi-water',
            'car parking' => 'bi bi-car-front',
            'security' => 'bi bi-shield-check',
            'water supply' => 'bi bi-droplet',
            'elevators' => 'bi bi-arrow-up-circle',
            'elevator' => 'bi bi-arrow-up-circle',
            'power backup' => 'bi bi-lightning',
            'walking' => 'bi bi-person-walking',
            'jogging' => 'bi bi-person-running',
            'play area' => 'bi bi-controller',
            'club house' => 'bi bi-house',
            'rooftop' => 'bi bi-building',
            'sky lounge' => 'bi bi-cup-hot',
            'spa' => 'bi bi-heart',
            'restaurant' => 'bi bi-cup-hot',
            'party hall' => 'bi bi-music-note',
            'cinema' => 'bi bi-film',
            'library' => 'bi bi-book',
            'tennis' => 'bi bi-trophy',
            'badminton' => 'bi bi-trophy',
            'games' => 'bi bi-controller',
            'cctv' => 'bi bi-camera-video',
            'camera' => 'bi bi-camera',
            'garden' => 'bi bi-flower1',
            'fitness' => 'bi bi-activity',
            'golf' => 'bi bi-trophy',
            'kitchen' => 'bi bi-house-gear',
            'smart' => 'bi bi-cpu',
            'lock' => 'bi bi-lock',
            'light' => 'bi bi-lightbulb',
            'intercom' => 'bi bi-telephone',
            'helipad' => 'bi bi-airplane',
            'amphitheater' => 'bi bi-mic',
            'cafeteria' => 'bi bi-cup-hot',
            'rain' => 'bi bi-cloud-rain',
            'water' => 'bi bi-droplet',
            'fire' => 'bi bi-fire',
            'aerobics' => 'bi bi-activity',
            'card' => 'bi bi-suit-spade',
            'billiards' => 'bi bi-circle',
            'banquet' => 'bi bi-calendar-event',
            'sun' => 'bi bi-sun',
            'court' => 'bi bi-trophy',
            'lawn' => 'bi bi-flower1',
            'community' => 'bi bi-people',
            'table tennis' => 'bi bi-trophy',
            'vastu' => 'bi bi-compass',
            'lobby' => 'bi bi-door-open',
            'multipurpose' => 'bi bi-grid-3x3',
            'yoga' => 'bi bi-heart',
            'meditation' => 'bi bi-heart',
            'children' => 'bi bi-people',
            'theatre' => 'bi bi-film',
            'basketball' => 'bi bi-trophy',
            'steam' => 'bi bi-cloud',
            'sauna' => 'bi bi-thermometer',
            'massage' => 'bi bi-hand-index',
            'pond' => 'bi bi-water',
            'servant' => 'bi bi-person',
            'laundry' => 'bi bi-basket',
            'jacuzzi' => 'bi bi-water',
            'italian' => 'bi bi-flag',
            'lakeside' => 'bi bi-water',
            'boardwalk' => 'bi bi-walk',
            'toddlers' => 'bi bi-people',
            'heated' => 'bi bi-thermometer',
            'skywalk' => 'bi bi-walk',
            'art' => 'bi bi-palette',
            'crafts' => 'bi bi-brush',
            'infinity' => 'bi bi-infinity',
            'hammock' => 'bi bi-moon',
            'outdoor' => 'bi bi-sun',
            'sunset' => 'bi bi-sunset',
            'acupressure' => 'bi bi-heart',
            'grand' => 'bi bi-star',
            'concierge' => 'bi bi-person-badge',
            'world' => 'bi bi-globe',
            'class' => 'bi bi-star',
        ];
        
        foreach ($amenities as $index => $amenityData) {
            $name = $amenityData['name'];
            $status = $amenityData['status'] == '1';
            $sortOrder = (int) $amenityData['sort'];
            
            // Find appropriate icon based on name
            $icon = 'bi bi-star'; // default icon
            $nameLower = strtolower($name);
            
            foreach ($iconMap as $keyword => $iconClass) {
                if (strpos($nameLower, $keyword) !== false) {
                    $icon = $iconClass;
                    break;
                }
            }
            
            Amenity::create([
                'name' => $name,
                'icon' => $icon,
                'sort_order' => $sortOrder,
                'is_active' => $status,
            ]);
            
            $this->command->info('Imported: ' . $name . ' (Icon: ' . $icon . ')');
        }
        
        $this->command->info('Successfully imported ' . count($amenities) . ' amenities!');
    }
}