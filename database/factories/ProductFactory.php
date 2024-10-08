<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => str_replace('.', '', fake()->text(150)),
            'description' => fake()->text(700),
            'sale_price' => fake()->numberBetween(5, 300),
            'stock' => fake()->numberBetween(0, 10),
            'deadline' => fake()->numberBetween(0, 30),
            'category_id' => fake()->numberBetween(1, 59),
        ];
    }
}
