<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::create([
            'name' => 'Celita Artesanatos',
            'url' => 'celitaartesanato',
            'description' => fake()->text(100),
            'user_id' => 3,
            'is_active' => true,
        ]);

        Shop::create([
            'name' => 'Artesanato Maria',
            'url' => 'artesanatomaria',
            'user_id' => 4,
            'is_active' => true,
        ]);
    }
}
