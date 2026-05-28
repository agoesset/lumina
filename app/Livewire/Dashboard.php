<?php

namespace App\Livewire;

use App\Models\Fasilitas;
use App\Models\JadwalPerawatan;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalFasilitas = Fasilitas::count();
        $kondisiBaik = Fasilitas::where('kondisi', 'baik')->count();
        $perluPerawatan = Fasilitas::where('kondisi', 'perlu-perawatan')->count();
        $perluDicuci = Fasilitas::where('kondisi', 'perlu-dicuci')->count();
        $rusak = Fasilitas::where('kondisi', 'rusak')->count();
        $jadwalHariIni = JadwalPerawatan::whereDate('tanggal', now())->count();
        $jadwalMingguIni = JadwalPerawatan::whereBetween('tanggal', [now(), now()->addDays(7)])->count();
        
        $kondisiData = [
            'labels' => ['Baik', 'Perlu Perawatan', 'Perlu Dicuci', 'Rusak'],
            'data' => [$kondisiBaik, $perluPerawatan, $perluDicuci, $rusak],
            'colors' => ['#10b981', '#f59e0b', '#eab308', '#ef4444'],
        ];
        
        $fasilitasTerbaru = Fasilitas::latest()->take(5)->get();
        $jadwalMendatang = JadwalPerawatan::with(['fasilitas', 'petugas'])
            ->where('tanggal', '>=', now()->format('Y-m-d'))
            ->orderBy('tanggal')
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'totalFasilitas' => $totalFasilitas,
            'kondisiBaik' => $kondisiBaik,
            'perluPerawatan' => $perluPerawatan,
            'perluDicuci' => $perluDicuci,
            'rusak' => $rusak,
            'jadwalHariIni' => $jadwalHariIni,
            'jadwalMingguIni' => $jadwalMingguIni,
            'kondisiData' => $kondisiData,
            'fasilitasTerbaru' => $fasilitasTerbaru,
            'jadwalMendatang' => $jadwalMendatang,
        ])->layout('layouts.main');
    }
}
