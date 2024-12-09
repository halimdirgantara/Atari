<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Super Admin',
            'nip' => '1',
            'nik' => '1',
            'phone' => '6281251413425',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'organization_id' => '1',
        ]);

        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'nip' => $faker->numerify('################'),
                'nik' => $faker->numerify('################'),
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'organization_id' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
