<?php

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

class ShopCreateTest extends TestCase
{
    use DatabaseTruncation;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);

        $this->user = User::factory()->create();

        $this->user->syncPermissions('create shop');
    }

    public function test_create_a_shop_screen_can_be_rendered(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get('/loja/criar');

        $response->assertStatus(200);
    }

    public function test_users_can_create_a_shop(): void
    {
        $shop = [
            'name' => 'Test Shop',
            'url' => 'urlteste',
        ];

        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', $shop);

        $response
            ->assertStatus(302)
            ->assertSee('inicio');

        $this->assertDatabaseHas('shops', $shop);
    }

    public function test_users_can_not_create_a_shop_with_empty_field(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => '',
                'url' => 'teste',
            ]);

        $response
            ->assertStatus(302)
            ->assertInvalid(['name']);
    }

    public function test_shop_name_is_too_short(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => 'a',
                'url' => 'teste',
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name' => 'O campo nome deve ter pelo menos 3 caracteres.',
            ]);
    }

    public function test_shop_name_is_too_long(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => str_repeat('a', 61),
                'url' => 'teste',
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name' => 'O campo nome não pode ser superior a 60 caracteres.',
            ]);
    }

    public function test_shop_name_is_the_min_amount_required(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => str_repeat('a', 3),
                'url' => 'teste',
            ]);

        $response
            ->assertStatus(302)
            ->assertValid(['name']);
    }

    public function test_shop_name_is_the_max_amount_required(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => str_repeat('a', 60),
                'url' => 'teste',
            ]);

        $response
            ->assertStatus(302)
            ->assertValid(['name']);
    }

    public function test_shop_url_has_blank_spaces(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => 'teste',
                'url' => 'teste de loja'
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors([
               'url' => 'O campo url só pode conter letras, números e traços.'
            ]);
    }

    public function test_shop_url_is_too_short(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => 'teste',
                'url' => 'a',
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'url' => 'O campo url deve ter pelo menos 3 caracteres.',
            ]);
    }

    public function test_shop_url_is_too_long(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
               'name' => 'teste',
               'url' => str_repeat('a', 61),
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors([
               'url' => 'O campo url não pode ser superior a 60 caracteres.'
            ]);
    }

    public function test_shop_url_is_the_min_amount_required(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => 'teste',
                'url' => str_repeat('a', 3),
            ]);

        $response
            ->assertStatus(302)
            ->assertValid(['url']);
    }

    public function test_shop_url_is_the_max_amount_required(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => 'teste',
                'url' => str_repeat('a', 60),
            ]);

        $response
            ->assertStatus(302)
            ->assertValid(['url']);
    }

    public function test_shop_url_is_not_unique(): void
    {
        $otherUser = User::factory()->create();

        Shop::create([
            'name' => 'Teste',
            'url' => 'testeloja',
            'user_id' => $otherUser->id,
        ]);

        $response = $this
            ->actingAs($this->user)
            ->post('/loja/criar', [
                'name' => 'loja teste',
                'url' => 'testeloja',
            ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'url' => 'O campo url já está sendo utilizado.'
            ]);
    }
}
