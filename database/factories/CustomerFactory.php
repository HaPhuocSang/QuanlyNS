<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name'=> fake()->name(),
            'gender'=>fake()->word(),
            'email' => fake()->word().'@gmail.com',
            'address'=> fake()->word(),
            'phone_number'=>fake()->word(),
            'note'=>fake()->word(),
        ];
    }
}
