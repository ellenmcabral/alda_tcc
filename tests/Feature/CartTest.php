<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected User $artisan;

    protected User $artisan2;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(CategoriesSeeder::class);

        $this->user = User::factory()->create();

        $this->artisan = User::factory()->create();
        $this->artisan2 = User::factory()->create();

        Shop::create([
            'name' => 'Loja Teste',
            'url' => 'lojateste',
            'user_id' => $this->artisan->id,
        ]);
        Shop::create([
            'name' => 'Teste loja',
            'url' => 'testeloja',
            'user_id' => $this->artisan2->id,
        ]);
    }

    public function test_cart_page_can_be_rendered(): void
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
    }

    public function test_product_can_be_added_to_cart(): void
    {
        $product = Product::factory()->create([
            'shop_id' => $this->artisan->shop->id,
            'category_id' => Category::where('description', 'Aquarela')->first()->id,
        ]);

        $response = $this->actingAs($this->user)
            ->post('/cart/add', [
                'shop_id' => $this->artisan->shop->id,
                'id' => $product->id,
                'name' => 'Produto Teste',
                'sale_price' => 20,
                'image' => 'image.jpg',
                'quantity' => 1,
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/cart');

        $view = $this->view('cart', [
            'items' => \Cart::content(),
            'shop' => $this->artisan->shop,
        ]);

        $view->assertSee('Produto Teste');
        $view->assertSee('R$ 20,00');
        $view->assertSee('Limpar sacola');
        $view->assertSee('Continuar encomenda');
    }

    public function test_products_from_different_shops_can_not_be_added_to_cart(): void
    {
        // produto que ja esta na sacola

        $product = Product::factory()->create([
            'shop_id' => $this->artisan->shop->id,
            'category_id' => Category::where('description', 'Aquarela')->first()->id,
        ]);

        \Cart::add([
           'id' => $product->id,
           'name' => 'Produto Teste',
           'qty' => 1,
           'price' => 20,
           'weight' => 1,
        ]);

        // produto q sera adicionado na sacola e eh de uma loja diferente

        $product2 = Product::factory()->create([
            'shop_id' => $this->artisan2->shop->id,
            'category_id' => Category::where('description', 'Aquarela')->first()->id,
        ]);

        $response = $this->actingAs($this->user)
            ->post('/cart/add', [
                'shop_id' => $this->artisan2->shop->id,
                'id' => $product2->id,
                'name' => 'Teste Produto',
                'sale_price' => 20,
                'image' => 'image.jpg',
                'quantity' => 1,
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasAll([
                'status' => 'product-not-added',
            ]);

        $view = $this->view('products.show', [
            'product' => $product,
        ]);

        $view->assertSee('Esvazie sua sacola de compras');
    }
}
