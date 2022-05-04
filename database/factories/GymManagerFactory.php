<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymManager>
 */
class GymManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'national_id' => rand(0000000000000000,9999999999999999),
            'is_banned' => $this->faker->boolean(),
            'user_id'=>rand(1,100),
            'gym_id'=>rand(1, 100),
        ];
    }
}
