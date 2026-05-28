<?php

namespace Tests\Unit\Models;

use App\Models\Fasilitas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FasilitasTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_fillable_attributes(): void
    {
        $fasilitas = Fasilitas::find(1);

        $this->assertEquals('Mukena', $fasilitas->nama);
        $this->assertEquals('Perlengkapan Sholat', $fasilitas->kategori);
        $this->assertEquals(50, $fasilitas->jumlah);
        $this->assertEquals('baik', $fasilitas->kondisi);
        $this->assertEquals('Lantai 1 - Area Wanita', $fasilitas->lokasi);
        $this->assertEquals('bersih', $fasilitas->status_kebersihan);
        $this->assertEquals('harum', $fasilitas->status_keharuman);
        $this->assertEquals('2024-12-28', $fasilitas->tanggal_pembaruan->format('Y-m-d'));
        $this->assertEquals('2024-12-25', $fasilitas->tanggal_terakhir_perawatan->format('Y-m-d'));
    }

    public function test_jumlah_is_integer_cast(): void
    {
        $fasilitas = Fasilitas::find(2);

        $this->assertIsInt($fasilitas->jumlah);
        $this->assertEquals(80, $fasilitas->jumlah);
    }

    public function test_tanggal_pembaruan_is_date_cast(): void
    {
        $fasilitas = Fasilitas::find(3);

        $this->assertInstanceOf(\Carbon\Carbon::class, $fasilitas->tanggal_pembaruan);
        $this->assertEquals('2024-12-29', $fasilitas->tanggal_pembaruan->format('Y-m-d'));
    }

    public function test_tanggal_terakhir_perawatan_is_date_cast(): void
    {
        $fasilitas = Fasilitas::find(4);

        $this->assertInstanceOf(\Carbon\Carbon::class, $fasilitas->tanggal_terakhir_perawatan);
        $this->assertEquals('2024-12-20', $fasilitas->tanggal_terakhir_perawatan->format('Y-m-d'));
    }

    public function test_fasilitas_has_many_jadwal_perawatan(): void
    {
        $fasilitas = Fasilitas::find(2);

        $this->assertTrue($fasilitas->jadwalPerawatan->count() > 0);
        $this->assertInstanceOf(\App\Models\JadwalPerawatan::class, $fasilitas->jadwalPerawatan->first());
    }

    public function test_fasilitas_has_many_laporan_kondisi(): void
    {
        $fasilitas = Fasilitas::find(2);

        $this->assertTrue($fasilitas->laporanKondisi->count() > 0);
        $this->assertInstanceOf(\App\Models\LaporanKondisi::class, $fasilitas->laporanKondisi->first());
    }

    public function test_fasilitas_has_many_riwayat_perawatan(): void
    {
        $fasilitas = Fasilitas::find(3);

        $this->assertTrue($fasilitas->riwayatPerawatan->count() > 0);
        $this->assertInstanceOf(\App\Models\RiwayatPerawatan::class, $fasilitas->riwayatPerawatan->first());
    }
}
