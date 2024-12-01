<?php
// database/seeders/VenueSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venues')->insert([
            [
                'name' => 'Venue 1',
                'postcode' => '1010',
                'city' => 'Budapest',
                'address' => '123 Main Street',
                'latitude' => '47.4979',
                'longitude' => '19.0402',
                'capacity' => 200,
                'phone' => '123-456-7890',
                'email' => 'venue1@example.com',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Venue 2',
                'postcode' => '1020',
                'city' => 'Debrecen',
                'address' => '456 Another Street',
                'latitude' => '47.5316',
                'longitude' => '21.6276',
                'capacity' => 500,
                'phone' => '987-654-3210',
                'email' => 'venue2@example.com',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more venues if needed
        ]);
    }
}
