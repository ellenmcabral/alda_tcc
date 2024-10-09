<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 15; $i++) {
            Product::factory()->create([
                'shop_id' => 1,
                'image' => $i . '.jpg',
            ]);
        }

        for($i = 16; $i <= 21; $i++) {
            Product::factory()->create([
                'shop_id' => 2,
                'image' => $i . '.jpg',
            ]);
        }
    }
}
