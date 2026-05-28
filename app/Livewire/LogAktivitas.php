<?php

namespace App\Livewire;

use App\Models\LogAktivitas as LogAktivitasModel;
use Carbon\Carbon;
use Livewire\Component;

class LogAktivitas extends Component
{
    public $search = '';
    public $filterTipe = '';
    public $filterTanggalMulai = '';
    public $filterTanggalSelesai = '';

    public function getLogsProperty()
    {
        return LogAktivitasModel::with('user')
            ->when($this->search, function ($q) {
                $q->where('aktivitas', 'like', "%{$this->search}%")
                    ->orWhere('detail', 'like', "%{$this->search}%")
                    ->orWhere('user_name', 'like', "%{$this->search}%");
            })
            ->when($this->filterTipe, fn($q) => $q->where('tipe', $this->filterTipe))
            ->when($this->filterTanggalMulai, fn($q) => $q->where('tanggal', '>=', $this->filterTanggalMulai))
            ->when($this->filterTanggalSelesai, fn($q) => $q->where('tanggal', '<=', $this->filterTanggalSelesai))
            ->latest('tanggal')
            ->latest('waktu')
            ->get();
    }

    public function resetFilters()
    {
        $this->filterTipe = '';
        $this->filterTanggalMulai = '';
        $this->filterTanggalSelesai = '';
        $this->search = '';
    }

    public function getTipeStyle($tipe)
    {
        return match($tipe) {
            'create' => ['icon' => 'plus', 'color' => 'text-emerald-600 dark:text-emerald-400', 'bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'badge' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400', 'label' => 'Tambah'],
            'update' => ['icon' => 'pencil', 'color' => 'text-blue-600 dark:text-blue-400', 'bg' => 'bg-blue-50 dark:bg-blue-900/20', 'badge' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400', 'label' => 'Ubah'],
            'delete' => ['icon' => 'trash', 'color' => 'text-red-600 dark:text-red-400', 'bg' => 'bg-red-50 dark:bg-red-900/20', 'badge' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400', 'label' => 'Hapus'],
            'status' => ['icon' => 'arrow-path', 'color' => 'text-amber-600 dark:text-amber-400', 'bg' => 'bg-amber-50 dark:bg-amber-900/20', 'badge' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400', 'label' => 'Status'],
            default => ['icon' => 'information-circle', 'color' => 'text-slate-600 dark:text-slate-400', 'bg' => 'bg-slate-50 dark:bg-slate-800', 'badge' => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400', 'label' => $tipe],
        };
    }

    public function formatTimestamp($tanggal, $waktu)
    {
        $datetime = Carbon::parse($tanggal->format('Y-m-d') . ' ' . $waktu);

        if ($datetime->isToday()) {
            return ['relative' => 'Hari ini', 'exact' => $datetime->format('H:i')];
        }
        if ($datetime->isYesterday()) {
            return ['relative' => 'Kemarin', 'exact' => $datetime->format('H:i')];
        }

        return ['relative' => $datetime->diffForHumans(), 'exact' => $datetime->translatedFormat('d M Y H:i')];
    }

    public function render()
    {
        return view('livewire.log-aktivitas')->layout('layouts.main');
    }
}
