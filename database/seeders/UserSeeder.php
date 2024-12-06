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
            'address' => 'Sekadau',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'organization_id' => '1',
        ]);
    }
}
