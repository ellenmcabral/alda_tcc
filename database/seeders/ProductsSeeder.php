<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
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
            ]);

            ProductImage::create([
                'image' => $i . '.jpg',
                'is_default' => true,
                'product_id' => $i,
            ]);
        }

        for($i = 16; $i <= 21; $i++) {
            Product::factory()->create([
                'shop_id' => 2,
            ]);

            ProductImage::create([
                'image' => $i . '.jpg',
                'is_default' => true,
                'product_id' => $i,
            ]);
        }
    }
}
