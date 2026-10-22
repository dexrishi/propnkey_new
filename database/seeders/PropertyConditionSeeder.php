<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyCondition;

class PropertyConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditions = [
            [
                'name' => 'New',
                'slug' => 'new',
                'is_active' => true,
            ],
            [
                'name' => 'Resale',
                'slug' => 'resale',
                'is_active' => true,
            ],
        ];

        foreach ($conditions as $condition) {
            PropertyCondition::create($condition);
        }
    }
}