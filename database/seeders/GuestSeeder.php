<?php

namespace Database\Seeders;

use App\Models\Guest;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Guest::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'organization' => $faker->company,
                'identity_id' => $faker->numerify('################'),
                'identity_file' => $faker->imageUrl,
                'guest_token' => Str::random(10),
            ]);
        }
    }
}
