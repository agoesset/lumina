<?php

namespace App\Livewire;

use App\Models\Fasilitas;
use App\Models\JadwalPerawatan;
use App\Models\LaporanKondisi;
use App\Models\RiwayatPerawatan;
use App\Models\User;
use Livewire\Component;

class LaporanRekap extends Component
{
    public $filterTanggalMulai = '';
    public $filterTanggalSelesai = '';

    public function applyDateRange($query)
    {
        return $query
            ->when($this->filterTanggalMulai, fn($q) => $q->where('tanggal', '>=', $this->filterTanggalMulai))
            ->when($this->filterTanggalSelesai, fn($q) => $q->where('tanggal', '<=', $this->filterTanggalSelesai));
    }

    public function getFasilitasStatsProperty()
    {
        $query = Fasilitas::query();

        return [
            'total' => (clone $query)->count(),
            'kondisi_baik' => (clone $query)->where('kondisi', 'baik')->count(),
            'kondisi_perlu_perawatan' => (clone $query)->where('kondisi', 'perlu-perawatan')->count(),
            'kondisi_rusak' => (clone $query)->where('kondisi', 'rusak')->count(),
            'kondisi_perlu_dicuci' => (clone $query)->where('kondisi', 'perlu-dicuci')->count(),
            'kebersihan_bersih' => (clone $query)->where('status_kebersihan', 'bersih')->count(),
            'kebersihan_perlu_dicuci' => (clone $query)->where('status_kebersihan', 'perlu-dicuci')->count(),
            'kebersihan_kotor' => (clone $query)->where('status_kebersihan', 'kotor')->count(),
            'keharuman_harum' => (clone $query)->where('status_keharuman', 'harum')->count(),
            'keharuman_tidak_harum' => (clone $query)->where('status_keharuman', 'tidak-harum')->count(),
            'keharuman_netral' => (clone $query)->where('status_keharuman', 'netral')->count(),
        ];
    }

    public function getLaporanStatsProperty()
    {
        $query = $this->applyDateRange(LaporanKondisi::query());

        return [
            'total' => (clone $query)->count(),
            'kondisi_baik' => (clone $query)->where('kondisi', 'baik')->count(),
            'kondisi_perlu_perawatan' => (clone $query)->where('kondisi', 'perlu-perawatan')->count(),
            'kondisi_rusak' => (clone $query)->where('kondisi', 'rusak')->count(),
            'kondisi_perlu_dicuci' => (clone $query)->where('kondisi', 'perlu-dicuci')->count(),
        ];
    }

    public function getJadwalStatsProperty()
    {
        $query = $this->applyDateRange(JadwalPerawatan::query());

        return [
            'total' => (clone $query)->count(),
            'belum_dimulai' => (clone $query)->where('status', 'belum-dimulai')->count(),
            'sedang_berlangsung' => (clone $query)->where('status', 'sedang-berlangsung')->count(),
            'selesai' => (clone $query)->where('status', 'selesai')->count(),
            'harian' => (clone $query)->where('frekuensi', 'harian')->count(),
            'mingguan' => (clone $query)->where('frekuensi', 'mingguan')->count(),
            'bulanan' => (clone $query)->where('frekuensi', 'bulanan')->count(),
        ];
    }

    public function getRiwayatStatsProperty()
    {
        $query = $this->applyDateRange(RiwayatPerawatan::query());

        return [
            'total' => (clone $query)->count(),
            'kondisi_sesudah_baik' => (clone $query)->where('kondisi_sesudah', 'baik')->count(),
        ];
    }

    public function getPerformanceMetricsProperty()
    {
        $totalFasilitas = Fasilitas::count();
        $kondisiBaik = Fasilitas::where('kondisi', 'baik')->count();
        $jadwalSelesai = JadwalPerawatan::where('status', 'selesai')->count();
        $jadwalTotal = JadwalPerawatan::count();

        return [
            'persentase_kondisi_baik' => $totalFasilitas > 0 ? round(($kondisiBaik / $totalFasilitas) * 100, 1) : 0,
            'persentase_jadwal_selesai' => $jadwalTotal > 0 ? round(($jadwalSelesai / $jadwalTotal) * 100, 1) : 0,
            'total_petugas' => User::where('role', 'petugas-kebersihan')->where('status', 'aktif')->count(),
            'total_pengguna' => User::count(),
        ];
    }

    public function getDonutDataProperty()
    {
        $stats = $this->fasilitasStats;
        return [
            'labels' => ['Baik', 'Perlu Perawatan', 'Rusak', 'Perlu Dicuci'],
            'data' => [
                $stats['kondisi_baik'],
                $stats['kondisi_perlu_perawatan'],
                $stats['kondisi_rusak'],
                $stats['kondisi_perlu_dicuci'],
            ],
            'colors' => ['#10b981', '#f59e0b', '#ef4444', '#eab308'],
        ];
    }

    public function getBarDataProperty()
    {
        $query = RiwayatPerawatan::query();
        $query = $this->applyDateRange($query);

        $items = $query->get()->groupBy(fn($item) => $item->tanggal->format('Y-m'))->sortKeys();

        if ($items->isEmpty()) {
            return ['labels' => [], 'data' => []];
        }

        return [
            'labels' => $items->keys()->map(fn($b) => \Carbon\Carbon::createFromFormat('Y-m', $b)->translatedFormat('M Y'))->values(),
            'data' => $items->map->count()->values(),
        ];
    }

    public function resetFilters()
    {
        $this->filterTanggalMulai = '';
        $this->filterTanggalSelesai = '';
    }

    public function render()
    {
        return view('livewire.laporan-rekap')->layout('layouts.main');
    }
}
