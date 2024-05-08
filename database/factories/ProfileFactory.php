<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'biographie'=>fake()->sentence(),
            'avatar'=>'avatar.png',
            'dob'=>fake()->date($format = 'd-m-Y', $max = 'now'),
            'gender'=>fake()->randomElement(['male','female']),
            'phone'=>fake()->phoneNumber(),
            'email'=>fake()->safeEmail(),
            'user_id'=>User::Factory(),


        ];
    }
}
