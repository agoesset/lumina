<?php

namespace Tests\Unit\Models;

use App\Models\Fasilitas;
use App\Models\RiwayatPerawatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RiwayatPerawatanTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_fillable_attributes(): void
    {
        $riwayat = RiwayatPerawatan::find(1);

        $this->assertEquals(3, $riwayat->fasilitas_id);
        $this->assertEquals(2, $riwayat->petugas_id);
        $this->assertEquals('2024-12-29', $riwayat->tanggal->format('Y-m-d'));
        $this->assertEquals('Vakum Karpet', $riwayat->aktivitas);
        $this->assertEquals('perlu-perawatan', $riwayat->kondisi_sebelum);
        $this->assertEquals('baik', $riwayat->kondisi_sesudah);
        $this->assertEquals('Karpet sudah divakum dan bersih dari debu', $riwayat->catatan);
    }

    public function test_tanggal_is_date_cast(): void
    {
        $riwayat = RiwayatPerawatan::find(2);

        $this->assertInstanceOf(\Carbon\Carbon::class, $riwayat->tanggal);
        $this->assertEquals('2024-12-29', $riwayat->tanggal->format('Y-m-d'));
    }

    public function test_riwayat_belongs_to_fasilitas(): void
    {
        $riwayat = RiwayatPerawatan::find(1);

        $this->assertInstanceOf(Fasilitas::class, $riwayat->fasilitas);
        $this->assertEquals('Karpet Masjid', $riwayat->fasilitas->nama);
    }

    public function test_riwayat_belongs_to_petugas(): void
    {
        $riwayat = RiwayatPerawatan::find(1);

        $this->assertInstanceOf(User::class, $riwayat->petugas);
        $this->assertEquals('Petugas Kebersihan', $riwayat->petugas->name);
    }

    public function test_riwayat_create_with_full_attributes(): void
    {
        $fasilitas = Fasilitas::find(1);
        $petugas = User::find(1);

        $riwayat = RiwayatPerawatan::create([
            'fasilitas_id' => $fasilitas->id,
            'petugas_id' => $petugas->id,
            'tanggal' => '2024-12-30',
            'aktivitas' => 'Test Aktivitas',
            'kondisi_sebelum' => 'baik',
            'kondisi_sesudah' => 'baik',
            'catatan' => 'Test catatan',
        ]);

        $this->assertInstanceOf(RiwayatPerawatan::class, $riwayat);
        $this->assertEquals('Test Aktivitas', $riwayat->aktivitas);
    }
}
