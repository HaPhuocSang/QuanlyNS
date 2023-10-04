<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
            'id_type'=>rand(1),
            'id_supplier'=>rand(1),
            'id_author'=>rand(1),
            'description'=> fake()->word(),
            'unit_price'=>rand(50000,100000),
            'promotion_price'=>rand(40000,90000),
            'image'=> fake()->word().'.jpg', 
        ];
    }
}
