<?php

namespace Tests\Feature;

use App\Models\CommissionProduct;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\Shop;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\ShippingAddressesSeeder;
use Database\Seeders\StatusesSeeder;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

class CommissionTest extends TestCase
{
    use DatabaseTruncation;

    protected User $user;
    protected User $artisan;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->artisan = User::factory()->create();

        Shop::factory()->create([
           'user_id' => $this->artisan->id,
        ]);

        $this->seed([
            CategoriesSeeder::class,
            ShippingAddressesSeeder::class,
            StatusesSeeder::class,
        ]);
    }

    public function test_users_can_finish_a_commission(): void
    {
        $product = Product::factory()->create([
            'shop_id' => $this->artisan->shop->id,
        ]);

        $product2 = Product::factory()->create([
            'shop_id' => $this->artisan->shop->id,
        ]);

        $this->actingAs($this->user)
            ->post('/cart/add', [
                'shop_id' => $this->artisan->shop->id,
                'id' => $product->id,
                'name' => $product->name,
                'sale_price' => $product->sale_price,
                'quantity' => 1,
            ],
            [
                'shop_id' => $this->artisan->shop->id,
                'id' => $product2->id,
                'name' => $product2->name,
                'sale_price' => $product2->sale_price,
                'quantity' => 1,
            ])
            ->assertStatus(302)
            ->assertRedirect('/sacola');

        $this->view('cart', [
            'items' => \Cart::content(),
            'shop' => $this->artisan->shop,
        ])
            ->assertSee($product->name)
            ->assertSee('Limpar sacola')
            ->assertSee('Continuar');

        $this
            ->get('/checkout')
            ->assertStatus(200)
            ->assertSee('Finalizar');


        $response = $this->post('/pedidos',[
            'total' => \Cart::total(),
            'payment' => 'pix',
            'user_id' => $this->user->id,
            'shop_id' => $this->artisan->shop->id,
            'shipping_address_id' => $this->user->shippingAddresses()->first()->id,
            'status_id' => 1,
        ]);

        $this
            ->assertDatabaseCount('commissions', 1)
            ->assertDatabaseCount('commission_products', 1)
            ->assertDatabaseHas('commission_products', [
                'product_id' => $product->id,
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/pedidos');
    }
}
