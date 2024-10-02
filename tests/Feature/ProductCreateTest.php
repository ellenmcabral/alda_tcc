<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCreateTest extends TestCase
{
    use RefreshDatabase;

    protected User $artisan;
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            RoleSeeder::class,
            CategoriesSeeder::class,
        ]);

        $this->artisan = User::factory()->create();

        $this->user = User::factory()->create();

        Shop::create([
            'name' => 'Loja Teste',
            'url' => 'lojateste',
            'user_id' => $this->artisan->id,
        ]);

        $this->artisan->syncRoles('artisan');
    }

    /**
     * Create a product page can be rendered to artisans
     */
    public function test_create_a_product_page_can_be_rendered_to_artisans(): void
    {
        $response = $this
            ->actingAs($this->artisan)
            ->get('/artisan/products/create');

        $response->assertStatus(200);
    }

    /**
     * Create a product page can not be rendered to non artisans
     */
    public function test_create_a_product_page_can_not_be_rendered_to_non_artisans(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get('/artisan/products/create');

        $response->assertStatus(403);
    }

    public function test_create_a_product_page_can_not_be_rendered_to_non_registered(): void
    {
        $response = $this->get('/artisan/products/create');

        $response
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * Artisans can create a product
     */
    public function test_artisans_can_create_a_product(): void
    {
        $product = [
            'name' => 'Produto Teste',
            'image' => 'no-image.jpg',
            'sale_price' => 48,
            'shop_id' => $this->artisan->shop->id,
            'category_id' => Category::first()->id,
        ];

        $response = $this
            ->actingAs($this->artisan)
            ->post('/artisan/products', $product);

        $response
            ->assertStatus(302)
            ->assertRedirect('/artisan/products');

        $this->assertDatabaseHas('products', $product);

        $lastProduct = Product::latest()->first();

        $this->assertEquals($product['name'], $lastProduct->name);
    }

    public function test_artisans_can_not_create_a_product_with_empty_field(): void
    {
        $response = $this
            ->actingAs($this->artisan)
            ->post('/artisan/products', [
                'name' => '',
            ]);

        $response
            ->assertStatus(302)
            ->assertInvalid('name');
    }

    public function test_product_name_is_too_short(): void
    {
        $response = $this
            ->actingAs($this->artisan)
            ->post('/artisan/products', [
                'name' => 'a',
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name' => 'O campo nome deve ter pelo menos 3 caracteres.',
            ]);
    }

    public function test_product_name_is_too_long(): void
    {
        $response = $this
            ->actingAs($this->artisan)
            ->post('/artisan/products', [
                'name' => str_repeat('a', 151),
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name' => 'O campo nome não pode ser superior a 150 caracteres.',
            ]);
    }

    public function test_product_name_is_the_min_amount_required()
    {
        $response = $this
            ->actingAs($this->artisan)
            ->post('/artisan/products', [
                'name' => str_repeat('a', 3),
                'image' => 'no-image.jpg',
                'sale_price' => 48,
                'shop_id' => $this->artisan->shop->id,
                'category_id' => Category::first()->id,
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/artisan/products')
            ->assertValid(['name']);
    }

    public function test_product_name_is_the_max_amount_required()
    {
        $response = $this
            ->actingAs($this->artisan)
            ->post('/artisan/products', [
                'name' => str_repeat('a', 150),
                'image' => 'no-image.jpg',
                'sale_price' => 48,
                'shop_id' => $this->artisan->shop->id,
                'category_id' => Category::first()->id,
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/artisan/products')
            ->assertValid(['name']);
    }
}
