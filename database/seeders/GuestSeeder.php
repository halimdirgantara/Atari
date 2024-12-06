<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory\Faker::create();

        for ($i = 0; $i < 10; $i++) {
            \App\Models\Guest::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'organization' => $faker->company,
                'identity_id' => $faker->uuid,
                'identity_file' => $faker->imageUrl,
                'guest_token' => $faker->uuid,
            ]);
        }
    }
    }
}
