<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

class CartTest extends TestCase
{
    use DatabaseTruncation;

    protected User $artisan;
    protected User $artisan2;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(CategoriesSeeder::class);

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
        $response = $this->get('/sacola');

        $response->assertStatus(200);
    }

    public function test_product_can_be_added_to_cart(): void
    {
        $product = Product::factory()->create([
            'shop_id' => $this->artisan->shop->id,
        ]);

        $response = $this->post('/cart/add', [
                'shop_id' => $this->artisan->shop->id,
                'id' => $product->id,
                'name' => $product->name,
                'sale_price' => $product->sale_price,
                'image' => $product->image,
                'quantity' => 1,
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/sacola');

        $view = $this->view('cart', [
            'items' => \Cart::content(),
            'shop' => $this->artisan->shop,
        ]);

        $view
            ->assertSee($product->name)
            ->assertSee('Limpar sacola')
            ->assertSee('Continuar');
    }

    public function test_products_from_different_shops_can_not_be_added_to_cart(): void
    {
        // produto que ja esta na sacola

        $product = Product::factory()->create([
            'shop_id' => $this->artisan->shop->id,
        ]);

        \Cart::add([
           'id' => $product->id,
           'name' => $product->name,
           'qty' => 1,
           'price' => $product->sale_price,
           'weight' => 1,
        ]);

        // produto q sera adicionado na sacola e eh de uma loja diferente

        $product2 = Product::factory()->create([
            'shop_id' => $this->artisan2->shop->id,
        ]);

        $response = $this->post('/cart/add', [
                'shop_id' => $this->artisan2->shop->id,
                'id' => $product2->id,
                'name' => $product2->name,
                'sale_price' => $product2->sale_price,
                'image' => $product2->image,
                'quantity' => 1,
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasAll([
                'status' => 'Esvazie sua sacola de compras ou finalize seu pedido antes de comprar um produto desta loja.',
            ]);
    }
}
