<?php

namespace App\Livewire;

use App\Models\Fasilitas;
use App\Models\RiwayatPerawatan as RiwayatPerawatanModel;
use Livewire\Component;

class RiwayatPerawatan extends Component
{
    public $search = '';
    public $filterFasilitas = '';
    public $filterTanggalMulai = '';
    public $filterTanggalSelesai = '';

    public function getRiwayatProperty()
    {
        return RiwayatPerawatanModel::with(['fasilitas', 'petugas'])
            ->when($this->search, function ($q) {
                $q->whereHas('fasilitas', fn($q) => $q->where('nama', 'like', "%{$this->search}%"))
                    ->orWhereHas('petugas', fn($q) => $q->where('name', 'like', "%{$this->search}%"))
                    ->orWhere('aktivitas', 'like', "%{$this->search}%");
            })
            ->when($this->filterFasilitas, fn($q) => $q->where('fasilitas_id', $this->filterFasilitas))
            ->when($this->filterTanggalMulai, fn($q) => $q->where('tanggal', '>=', $this->filterTanggalMulai))
            ->when($this->filterTanggalSelesai, fn($q) => $q->where('tanggal', '<=', $this->filterTanggalSelesai))
            ->latest('tanggal')
            ->get();
    }

    public function getTimelineGroupsProperty()
    {
        return $this->riwayat->groupBy(function ($item) {
            return $item->tanggal->format('Y-m-d');
        })->sortKeysDesc();
    }

    public function getSummaryProperty()
    {
        $riwayat = $this->riwayat;

        return [
            'total' => $riwayat->count(),
            'kondisi_baik' => $riwayat->where('kondisi_sesudah', 'baik')->count(),
            'kondisi_rusak' => $riwayat->where('kondisi_sesudah', 'rusak')->count(),
            'improvement' => $riwayat->count() > 0
                ? round(($riwayat->where('kondisi_sesudah', 'baik')->count() / $riwayat->count()) * 100, 1)
                : 0,
        ];
    }

    public function resetFilters()
    {
        $this->filterFasilitas = '';
        $this->filterTanggalMulai = '';
        $this->filterTanggalSelesai = '';
        $this->search = '';
    }

    public function render()
    {
        $fasilitas = Fasilitas::all();

        return view('livewire.riwayat-perawatan', [
            'fasilitas' => $fasilitas,
        ])->layout('layouts.main');
    }
}
