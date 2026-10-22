<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BedroomOption;

class BedroomOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bedroomOptions = [
            ['name' => '1 BHK', 'value' => '1', 'sort_order' => 1],
            ['name' => '2 BHK', 'value' => '2', 'sort_order' => 2],
            ['name' => '3 BHK', 'value' => '3', 'sort_order' => 3],
            ['name' => '4 BHK', 'value' => '4', 'sort_order' => 4],
            ['name' => '5 BHK', 'value' => '5', 'sort_order' => 5],
            ['name' => '5.5 BHK', 'value' => '5.5', 'sort_order' => 6],
            ['name' => '10 BHK', 'value' => '10', 'sort_order' => 7],
            ['name' => '2, 3 BHK', 'value' => '2,3', 'sort_order' => 8],
            ['name' => '2, 3, 4 BHK', 'value' => '2,3,4', 'sort_order' => 9],
            ['name' => '3, 4 BHK', 'value' => '3,4', 'sort_order' => 10],
            ['name' => '3, 4, 5 BHK', 'value' => '3,4,5', 'sort_order' => 11],
            ['name' => '4, 5 BHK', 'value' => '4,5', 'sort_order' => 12],
            ['name' => 'Studios & 1 BHK', 'value' => 'studio,1', 'sort_order' => 13],
        ];

        foreach ($bedroomOptions as $option) {
            BedroomOption::create($option);
        }
    }
}