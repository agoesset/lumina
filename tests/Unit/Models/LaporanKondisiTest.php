<?php

namespace Tests\Unit\Models;

use App\Models\Fasilitas;
use App\Models\LaporanKondisi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporanKondisiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_fillable_attributes(): void
    {
        $laporan = LaporanKondisi::find(1);

        $this->assertEquals(2, $laporan->fasilitas_id);
        $this->assertEquals(2, $laporan->petugas_id);
        $this->assertEquals('perlu-dicuci', $laporan->kondisi);
        $this->assertEquals('Beberapa sarung terlihat kotor dan perlu segera dicuci', $laporan->catatan);
        $this->assertEquals('2024-12-27', $laporan->tanggal->format('Y-m-d'));
    }

    public function test_tanggal_is_date_cast(): void
    {
        $laporan = LaporanKondisi::find(2);

        $this->assertInstanceOf(\Carbon\Carbon::class, $laporan->tanggal);
        $this->assertEquals('2024-12-20', $laporan->tanggal->format('Y-m-d'));
    }

    public function test_laporan_belongs_to_fasilitas(): void
    {
        $laporan = LaporanKondisi::find(1);

        $this->assertInstanceOf(Fasilitas::class, $laporan->fasilitas);
        $this->assertEquals('Sarung', $laporan->fasilitas->nama);
    }

    public function test_laporan_belongs_to_petugas(): void
    {
        $laporan = LaporanKondisi::find(1);

        $this->assertInstanceOf(User::class, $laporan->petugas);
        $this->assertEquals('Petugas Kebersihan', $laporan->petugas->name);
    }

    public function test_foto_url_is_nullable(): void
    {
        $laporan = LaporanKondisi::find(1);

        $this->assertNull($laporan->foto_url);
    }

    public function test_laporan_create_with_foto_url(): void
    {
        $fasilitas = Fasilitas::find(1);
        $petugas = User::find(1);

        $laporan = LaporanKondisi::create([
            'fasilitas_id' => $fasilitas->id,
            'petugas_id' => $petugas->id,
            'kondisi' => 'baik',
            'catatan' => 'Test',
            'tanggal' => '2024-12-30',
            'foto_url' => 'https://example.com/foto.jpg',
        ]);

        $this->assertEquals('https://example.com/foto.jpg', $laporan->foto_url);
    }
}
