<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agent;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agents = [
            [
                'name' => 'John Smith',
                'designation' => 'Senior Property Manager',
                'phone' => '(555) 123-4567',
                'image' => null, // Placeholder, actual image upload handled via UI
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Johnson',
                'designation' => 'Property Consultant',
                'phone' => '(555) 234-5678',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Michael Brown',
                'designation' => 'Leasing Specialist',
                'phone' => '(555) 345-6789',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Emily Davis',
                'designation' => 'Property Analyst',
                'phone' => '(555) 456-7890',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'David Wilson',
                'designation' => 'Maintenance Coordinator',
                'phone' => '(555) 567-8901',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Lisa Anderson',
                'designation' => 'Client Relations Manager',
                'phone' => '(555) 678-9012',
                'image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Robert Taylor',
                'designation' => 'Property Inspector',
                'phone' => '(555) 789-0123',
                'image' => null,
                'is_active' => false,
            ],
            [
                'name' => 'Jennifer Martinez',
                'designation' => 'Marketing Coordinator',
                'phone' => '(555) 890-1234',
                'image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($agents as $agentData) {
            Agent::create($agentData);
        }
    }
}