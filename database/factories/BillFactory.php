<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
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
            'id_customer'=>rand(1,5),
            'date_order'=> now(),
            'total'=>rand(100000,200000),
            'payment'=> fake()->word(),
            'note'=>fake()->word(),
        ];
    }
}
