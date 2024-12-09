<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GuestFactory extends Factory
{
    protected $model = Guest::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'organization' => $this->faker->company,
            'identity_id' => $this->faker->numerify('################'),
            'identity_file' => $this->faker->imageUrl,
            'guest_token' => Str::random(10),
        ];
    }
}
