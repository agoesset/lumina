<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FasilitasTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_authenticated_user_can_view_fasilitas_page(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        $response = $this->get(route('fasilitas'));
        $response->assertStatus(200);
    }

    public function test_fasilitas_page_shows_seeded_data(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        Livewire::test(\App\Livewire\DataFasilitas::class)
            ->assertSee('Mukena')
            ->assertSee('Sarung')
            ->assertSee('Karpet Masjid')
            ->assertSee('Al-Quran')
            ->assertSee('Sajadah')
            ->assertSee('Speaker Masjid')
            ->assertSee('Kipas Angin')
            ->assertSee('Tempat Wudhu');
    }

    public function test_fasilitas_page_supports_search(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        Livewire::test(\App\Livewire\DataFasilitas::class)
            ->set('search', 'Mukena')
            ->assertSee('Mukena')
            ->assertDontSee('Sarung')
            ->assertDontSee('Karpet Masjid');
    }
}
