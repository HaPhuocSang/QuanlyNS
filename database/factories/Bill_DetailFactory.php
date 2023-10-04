<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill_Detail>
 */
class Bill_DetailFactory extends Factory
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
            'id_bill'=>rand(1,5),
            'id_book'=>rand(1,5),
            'quantity'=>rand(1,5),
            'unit_price'=>rand(100000,500000),
        ];
    }
}
