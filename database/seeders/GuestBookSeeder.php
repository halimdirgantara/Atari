<?php

namespace Database\Seeders;

use App\Models\GuestBook;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class GuestBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // GuestBook::factory()->count(10)->create();

        for ($i = 0; $i < 20; $i++) {
            $guestBook = GuestBook::create([
                'host_id' => $hostId = \App\Models\User::inRandomOrder()->first()->id % 10 + 1,
                'organization_id' => \App\Models\User::find($hostId)->organization_id,
                'needs' => $faker->text,
                'check_in' => $faker->dateTime,
                'check_out' => $faker->dateTime,
                'status' => $faker->randomElement(GuestBook::STATUS),
            ]);

            // Sync with guest_book_guest table
            $guestBook->guests()->sync(\App\Models\Guest::inRandomOrder()->pluck('id'));
        }
    }
}
