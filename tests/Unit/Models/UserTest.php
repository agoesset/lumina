<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_fillable_attributes(): void
    {
        $user = User::find(1);

        $this->assertEquals('Admin Masjid', $user->name);
        $this->assertEquals('admin@masjid.com', $user->email);
        $this->assertEquals('admin-masjid', $user->role);
        $this->assertEquals('aktif', $user->status);
        $this->assertEquals('2024-01-01', $user->tanggal_bergabung->format('Y-m-d'));
    }

    public function test_hidden_attributes(): void
    {
        $user = User::find(1);
        $array = $user->toArray();

        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
    }

    public function test_password_is_hashed(): void
    {
        $user = User::find(1);

        $this->assertNotEquals('admin123', $user->password);
        $this->assertTrue(password_verify('admin123', $user->password));
    }

    public function test_tanggal_bergabung_is_date_cast(): void
    {
        $user = User::find(5);

        $this->assertInstanceOf(\Carbon\Carbon::class, $user->tanggal_bergabung);
        $this->assertEquals('2024-03-15', $user->tanggal_bergabung->format('Y-m-d'));
    }

    public function test_user_has_many_jadwal_perawatan(): void
    {
        $petugas = User::where('role', 'petugas-kebersihan')->first();

        $this->assertTrue($petugas->jadwalPerawatan->count() > 0);
        $this->assertInstanceOf(\App\Models\JadwalPerawatan::class, $petugas->jadwalPerawatan->first());
    }

    public function test_user_has_many_laporan_kondisi(): void
    {
        $petugas = User::where('role', 'petugas-kebersihan')->first();

        $this->assertTrue($petugas->laporanKondisi->count() > 0);
        $this->assertInstanceOf(\App\Models\LaporanKondisi::class, $petugas->laporanKondisi->first());
    }

    public function test_user_has_many_riwayat_perawatan(): void
    {
        $petugas = User::where('role', 'petugas-kebersihan')->first();

        $this->assertTrue($petugas->riwayatPerawatan->count() > 0);
        $this->assertInstanceOf(\App\Models\RiwayatPerawatan::class, $petugas->riwayatPerawatan->first());
    }

    public function test_user_has_many_log_aktivitas(): void
    {
        $user = User::find(1);

        $this->assertTrue($user->logAktivitas->count() > 0);
        $this->assertInstanceOf(\App\Models\LogAktivitas::class, $user->logAktivitas->first());
    }
}
