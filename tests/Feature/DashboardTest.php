<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_dashboard_shows_total_fasilitas(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        Livewire::test(\App\Livewire\Dashboard::class)
            ->assertSee('8');
    }

    public function test_dashboard_shows_kondisi_baik_stat(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        Livewire::test(\App\Livewire\Dashboard::class)
            ->assertSee('Kondisi Baik');
    }

    public function test_dashboard_shows_recent_facility_list(): void
    {
        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        Livewire::test(\App\Livewire\Dashboard::class)
            ->assertSee('Fasilitas Terbaru')
            ->assertSee('Mukena')
            ->assertSee('Karpet Masjid');
    }

    public function test_dashboard_shows_upcoming_schedule(): void
    {
        Carbon::setTestNow(Carbon::parse('2024-12-28'));

        $user = User::where('email', 'admin@masjid.com')->first();
        $this->actingAs($user);

        Livewire::test(\App\Livewire\Dashboard::class)
            ->assertSee('Jadwal Mendatang')
            ->assertSee('Cuci sarung');

        Carbon::setTestNow();
    }
}
