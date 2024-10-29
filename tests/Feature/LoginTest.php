<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTruncation;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_login(): void
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => '123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

    public function test_users_can_not_login_with_an_invalid_email(): void
    {
        $response = $this->post('/login', [
            'email' => 'email@teste',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertInvalid('email');
    }

    public function test_users_can_not_login_with_an_empty_field(): void
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors([
           'email' => 'O campo email é obrigatório.',
           'password' => 'O campo senha é obrigatório.',
        ]);
    }

    public function test_users_can_logout(): void
    {
        $response = $this->actingAs($this->user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/login');
    }
}
