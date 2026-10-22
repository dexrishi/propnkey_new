<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SiteConfigSeeder::class,
            LocationSeeder::class,
            PartnerSeeder::class,
            AmenitySeeder::class,
            PageSeeder::class,
            SlugListSeeder::class,
            MenuSeeder::class,
            AgentSeeder::class,
        ]);
    }
}
