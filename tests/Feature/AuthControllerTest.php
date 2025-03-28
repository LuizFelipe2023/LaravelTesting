<?php
namespace Tests\Feature;

use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_exists(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    public function test_register_page_exists()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function test_register_user()
    {
        $user = [
            'name' => 'Luiz',
            'email' => 'luiz@mail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];


        $response = $this->post(route('register.post'), $user);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => $user['email'],
        ]);

        $userInDatabase = User::where('email', $user['email'])->first();
        $this->assertTrue(Hash::check('12345678', $userInDatabase->password));
    }

    public function test_login_user()
    {
        $user = User::create([
            'name' => 'Luiz',
            'email' => 'luiz@mail.com',
            'password' => Hash::make('12345678'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_update_password()
    {
        $user = User::create([
            'name' => 'Mario',
            'email' => 'mario@email.com',
            'password' => Hash::make('password')
        ]);

        $this->actingAs($user);

        $response = $this->put(route('auth.update', $user->id), [
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertRedirect('dashboard');

        $this->assertTrue(Hash::check('12345678', $user->fresh()->password));
    }

}
