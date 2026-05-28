<?php

namespace Tests\Feature;

use App\Models\Fasilitas;
use App\Models\JadwalPerawatan;
use App\Models\LaporanKondisi;
use App\Models\LogAktivitas;
use App\Models\RiwayatPerawatan;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_creates_5_users(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 5);
    }

    public function test_seeder_creates_8_fasilitas(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('fasilitas', 8);
    }

    public function test_seeder_creates_5_jadwal_perawatan(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('jadwal_perawatans', 5);
    }

    public function test_seeder_creates_4_laporan_kondisi(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('laporan_kondisis', 4);
    }

    public function test_seeder_creates_3_riwayat_perawatan(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('riwayat_perawatans', 3);
    }

    public function test_seeder_creates_8_log_aktivitas(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('log_aktivitas', 8);
    }
}
