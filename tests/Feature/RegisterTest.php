<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTruncation;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '(53) 9 9190-0909',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

    public function test_users_can_not_register_with_an_empty_field(): void
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@example.com',
            'phone' => '(53) 9 9190-0909',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors([
            'name' => 'O campo nome é obrigatório.',
        ]);
    }

    public function test_user_name_is_too_short(): void
    {
        $response = $this->post('/register', [
           'name' => 'a',
        ]);

        $response->assertSessionHasErrors([
            'name' => 'O campo nome deve ter pelo menos 3 caracteres.',
        ]);
    }

    public function test_user_name_is_too_long(): void
    {
        $response = $this->post('/register', [
            'name' => str_repeat('a', 61),
        ]);

        $response->assertSessionHasErrors([
            'name' => 'O campo nome não pode ser superior a 60 caracteres.',
        ]);
    }

    public function test_user_email_is_too_short(): void
    {
        $response = $this->post('/register', [
            'email' => 'a',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'O campo email deve ter pelo menos 3 caracteres.',
        ]);
    }

    public function test_user_email_is_too_long(): void
    {
        $response = $this->post('/register', [
            'email' => str_repeat('a', 61),
        ]);

        $response->assertSessionHasErrors([
            'email' => 'O campo email não pode ser superior a 60 caracteres.',
        ]);
    }

    public function test_user_email_must_be_unique(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/register', [
            'email' => $user->email,
        ]);

        $response->assertSessionHasErrors([
           'email' => 'O campo email já está sendo utilizado.'
        ]);
    }

    public function test_user_phone_must_be_unique(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/register', [
            'phone' => $user->phone,
        ]);

        $response->assertSessionHasErrors([
            'phone' => 'O campo telefone já está sendo utilizado.'
        ]);
    }

    public function test_user_phone_is_too_short(): void
    {
        $response = $this->post('/register', [
            'phone' => '1',
        ]);

        $response->assertSessionHasErrors([
            'phone' => 'O campo telefone deve ter pelo menos 16 caracteres.',
        ]);
    }

    public function test_user_phone_is_too_long(): void
    {
        $response = $this->post('/register', [
            'phone' => str_repeat('a', 17),
        ]);

        $response->assertSessionHasErrors([
            'phone' => 'O campo telefone não pode ser superior a 16 caracteres.',
        ]);
    }

    public function test_user_password_is_too_short(): void
    {
        $response = $this->post('/register', [
            'password' => 'a',
        ]);

        $response->assertSessionHasErrors([
            'password' => 'O campo senha deve ter pelo menos 8 caracteres.',
        ]);
    }

    public function test_user_password_is_too_long(): void
    {
        $response = $this->post('/register', [
            'password' => str_repeat('a', 101),
        ]);

        $response->assertSessionHasErrors([
            'password' => 'O campo senha não pode ser superior a 100 caracteres.',
        ]);
    }

    public function test_user_password_must_be_confirmed(): void
    {
        $response = $this->post('/register', [
            'name' => 'Ellen',
            'email' => 'teste@email',
            'phone' => '(53) 9 9190-0909',
            'password' => 'a',
            'password_confirmation' => 'b',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors([
            'password' => 'O campo senha de confirmação não confere.',
        ]);
    }
}
