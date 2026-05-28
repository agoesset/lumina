<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_guest_can_access_login_page(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();

        Livewire::test(\App\Livewire\Login::class)
            ->set('email', 'admin@masjid.com')
            ->set('password', 'admin123')
            ->call('login')
            ->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        Livewire::test(\App\Livewire\Login::class)
            ->set('email', 'admin@masjid.com')
            ->set('password', 'wrong-password')
            ->call('login')
            ->assertSet('error', 'Email atau password salah.');

        $this->assertGuest();
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        Livewire::test(\App\Livewire\Header::class)
            ->call('logout')
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_nonaktif_user_cannot_login(): void
    {
        Livewire::test(\App\Livewire\Login::class)
            ->set('email', 'fatimah@masjid.com')
            ->set('password', 'password')
            ->call('login')
            ->assertSet('error', 'Akun Anda telah dinonaktifkan.');

        $this->assertGuest();
    }
}
