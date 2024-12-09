<?php

namespace Tests\Feature;

use App\Models\ProductImage;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
use Database\Seeders\CategoriesSeeder;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use DatabaseTruncation;

    protected User $user;
    protected Shop $shop;
    protected Product $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(CategoriesSeeder::class);

        $this->user = User::factory()->create();

        $this->shop = Shop::create([
            'name' => 'Celita Artesanatos',
            'url' => 'celitaartesanatos',
            'description' => fake()->text(),
            'image' => 'shop-1.jpg',
            'user_id' => $this->user->id,
            'is_active' => true,
        ]);

        $this->product = Product::factory()->create([
            'shop_id' => $this->shop->id,
        ]);
        ProductImage::create([
            'image' => '1.jpg',
            'is_default' => true,
            'product_id' => $this->product->id,
        ]);

        for($i = 2; $i <= 11; $i++) {
            Product::factory()->create([
                'shop_id' => 1,
            ]);
            ProductImage::create([
                'image' => $i . '.jpg',
                'is_default' => true,
                'product_id' => $i,
            ]);
            User::factory()->create();
            Shop::factory()->create([
                'user_id' => $i,
            ]);
        }
    }

    public function test_search_paginated_products_page_can_be_rendered(): void
    {
        $response = $this->post('/busca', [
            'search_type' => 'Produtos',
        ]);

        $response
            ->assertStatus(200)
            ->assertSee(['resultados', 'Produtos', $this->product->name]);
    }

    public function test_search_paginated_shops_page_can_be_rendered(): void
    {
        $response = $this->post('/busca', [
            'search_type' => 'Lojas',
        ]);

        $response
            ->assertStatus(200)
            ->assertSee(['resultados', 'Lojas', $this->shop->name]);
    }

    public function test_users_can_search_a_product(): void
    {
        $response = $this->post('/busca', [
            'search_type' => 'Produtos',
            'search_text' => $this->product->name,
        ]);

        $response
            ->assertStatus(200)
            ->assertSee($this->product->name);
    }

    public function test_users_can_search_a_shop(): void
    {
        $response = $this->post('/busca', [
            'search_type' => 'Lojas',
            'search_text' => $this->shop->name,
        ]);

        $response
            ->assertStatus(200)
            ->assertSee($this->shop->name);
    }

    public function test_search_page_must_show_message_when_no_results_are_found(): void
    {
        $response = $this->post('/busca', [
           'search_type' => 'Produtos',
           'search_text' => 'No results',
        ]);

        $response
            ->assertStatus(200)
            ->assertSee('Nenhum resultado');
    }
}
