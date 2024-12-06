<?php

namespace Database\Factories;

use App\Models\GuestBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestBookFactory extends Factory
{
    protected $model = GuestBook::class;

    public function definition()
    {
        return [
            // 'guest_id' => \App\Models\Organization::inRandomOrder()->first()->id, // Assuming you have a Guest factory
            'host_id' => \App\Models\Organization::inRandomOrder()->first()->id, // Assuming you have a User factory
            'organization_id' => \App\Models\Organization::inRandomOrder()->first()->id,
            'needs' => $this->faker->text,
            'check_in' => $this->faker->dateTime,
            'check_out' => $this->faker->dateTime,
            'status' => 'pending', // Default status
        ];
    }
}
