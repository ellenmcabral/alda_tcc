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
            'name' => str_replace('.', '', fake()->text(20)),
            'description' => fake()->text(250),
            'image' => 'product-image.jpg',
            'url' => str_replace(array(' ', '.'), array('-', ''), fake()->text(20)),
            'sale_price' => fake()->numberBetween(10, 300),
            'stock' => false,
            'deadline' => fake()->numberBetween(3, 60),
            'category_id' => fake()->numberBetween(1, 59),
        ];
    }
}
