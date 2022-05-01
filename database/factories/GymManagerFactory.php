<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymManager>
 */
class GymManagerFactory extends Factory
{
    public $characters;
    public $pin;

       
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
     
            "national_id"=>rand(1,500),
            "is_banned"=>$this->faker->boolean(),
            "user_id"=>rand(1,100),
            "gym_id"=>'1'
        ];
    }
}
