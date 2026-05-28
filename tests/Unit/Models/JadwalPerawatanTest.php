<?php

namespace Tests\Unit\Models;

use App\Models\Fasilitas;
use App\Models\JadwalPerawatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JadwalPerawatanTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_fillable_attributes(): void
    {
        $jadwal = JadwalPerawatan::find(1);

        $this->assertEquals(2, $jadwal->fasilitas_id);
        $this->assertEquals(2, $jadwal->petugas_id);
        $this->assertEquals('2024-12-30', $jadwal->tanggal->format('Y-m-d'));
        $this->assertEquals('mingguan', $jadwal->frekuensi);
        $this->assertEquals('belum-dimulai', $jadwal->status);
        $this->assertEquals('Cuci sarung yang kotor', $jadwal->catatan);
    }

    public function test_tanggal_is_date_cast(): void
    {
        $jadwal = JadwalPerawatan::find(2);

        $this->assertInstanceOf(\Carbon\Carbon::class, $jadwal->tanggal);
        $this->assertEquals('2024-12-31', $jadwal->tanggal->format('Y-m-d'));
    }

    public function test_jadwal_belongs_to_fasilitas(): void
    {
        $jadwal = JadwalPerawatan::find(1);

        $this->assertInstanceOf(Fasilitas::class, $jadwal->fasilitas);
        $this->assertEquals('Sarung', $jadwal->fasilitas->nama);
    }

    public function test_jadwal_belongs_to_petugas(): void
    {
        $jadwal = JadwalPerawatan::find(1);

        $this->assertInstanceOf(User::class, $jadwal->petugas);
        $this->assertEquals('Petugas Kebersihan', $jadwal->petugas->name);
    }

    public function test_jadwal_with_no_catatan_is_nullable(): void
    {
        $jadwal = JadwalPerawatan::create([
            'fasilitas_id' => 1,
            'petugas_id' => 1,
            'tanggal' => '2024-12-30',
            'frekuensi' => 'harian',
            'status' => 'belum-dimulai',
        ]);

        $this->assertNull($jadwal->catatan);
    }
}
