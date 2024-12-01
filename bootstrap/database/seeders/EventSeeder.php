<?php

// database/seeders/EventSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'name' => 'Music Concert',
                'slug' => 'music-concert',
                'organization_id' => 1,
                'type' => 'concert',
                'qr_generation' => 'enabled',
                'town' => 'Budapest',
                'venue' => 'Venue 1',  // You can use venue name directly or use venue_id for foreign key
                'address' => '123 Main Street',
                'max_attendee' => 200,
                'description' => 'A live music concert with various artists.',
                'entrance_start' => now(),
                'entrance_end' => now()->addHours(2),
                'date' => now()->addDays(7),
                'image' => 'concert_image.jpg',
                'image_secondary' => 'concert_image_secondary.jpg',
                'responsible_id' => 1,
                'active' => 1,
                'venue_id' => 1,  // Assuming venue_id from the venue table
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Comedy Night',
                'slug' => 'comedy-night',
                'organization_id' => 1,
                'type' => 'comedy',
                'qr_generation' => 'disabled',
                'town' => 'Debrecen',
                'venue' => 'Venue 2',  // You can use venue name directly or use venue_id for foreign key
                'address' => '456 Another Street',
                'max_attendee' => 500,
                'description' => 'Stand-up comedy with famous comedians.',
                'entrance_start' => now(),
                'entrance_end' => now()->addHours(1),
                'date' => now()->addDays(14),
                'image' => 'comedy_image.jpg',
                'image_secondary' => 'comedy_image_secondary.jpg',
                'responsible_id' => 2,
                'active' => 1,
                'venue_id' => 2,  // Assuming venue_id from the venue table
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more events if needed
        ]);
    }
}

