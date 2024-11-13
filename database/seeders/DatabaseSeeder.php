<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
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
        // User::factory(5)->create();
        User::factory()->create([
            'name' => 'Tonny Stark',
            'email' => 'test@example.com',
        ]);

        Hotel::factory(30)->create();

        Hotel::query()->each(function(Hotel $hotel) {
            for ($i = 0; $i < random_int(1, 15); $i++) {
                Room::factory()->create(['hotel_id' => $hotel->id]);
            }
        });
    }
}
