<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Database\Seeders\CategoriesSeeder;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use DatabaseTruncation;

    protected User $user;
    protected User $artisan;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(CategoriesSeeder::class);

        $this->user = User::factory()->create();
        $this->artisan = User::factory()->create();

        Shop::factory()->create([
            'user_id' => $this->artisan->id,
        ]);
    }

    public function test_registered_users_can_access_checkout(): void
    {
        $product = Product::factory()->create([
            'shop_id' => $this->artisan->shop->id,
            'image' => '1.jpg'
        ]);

        $response = $this->actingAs($this->user)
            ->post('/cart/add', [
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

        $this
            ->get('/checkout')
            ->assertStatus(200)
            ->assertSee('Finalizar');
    }

    public function test_non_registered_users_can_not_access_checkout(): void
    {
        $response = $this->get('/checkout');

        $response
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
