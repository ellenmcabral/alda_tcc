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
            'name' => 'Celita Artesanatos - Feitos com Muito Amor',
            'url' => 'celitaartesanatocomamor',
            'description' => fake()->text(),
            'user_id' => 3,
            'is_active' => true,
        ]);

        Shop::create([
            'name' => 'Jaci Costuras, Laços e outros Tecidos',
            'url' => 'jacicosturaselaços',
            'user_id' => 4,
            'is_active' => true,
        ]);
    }
}
