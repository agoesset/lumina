<?php

namespace App\Livewire;

use App\Models\Fasilitas;
use Livewire\Component;

class MonitoringKebersihan extends Component
{
    public $search = '';
    public $showModal = false;
    public $editId = null;
    public $status_kebersihan, $status_keharuman;

    protected $rules = [
        'status_kebersihan' => 'required|in:bersih,perlu-dicuci,kotor',
        'status_keharuman' => 'required|in:harum,tidak-harum,netral',
    ];

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $this->editId = $id;
        $this->status_kebersihan = $fasilitas->status_kebersihan;
        $this->status_keharuman = $fasilitas->status_keharuman;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $fasilitas = Fasilitas::findOrFail($this->editId);
        $nama = $fasilitas->nama;

        $fasilitas->update([
            'status_kebersihan' => $this->status_kebersihan,
            'status_keharuman' => $this->status_keharuman,
            'tanggal_pembaruan' => now()->format('Y-m-d'),
        ]);

        \App\Models\LogAktivitas::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'aktivitas' => 'Update Status Kebersihan',
            'tipe' => 'status',
            'detail' => "Memperbarui status kebersihan {$nama}: {$this->status_kebersihan}, keharuman: {$this->status_keharuman}",
            'tanggal' => now()->format('Y-m-d'),
            'waktu' => now()->format('H:i:s'),
        ]);

        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->editId = null;
        $this->status_kebersihan = 'bersih';
        $this->status_keharuman = 'netral';
    }

    public function render()
    {
        $fasilitas = Fasilitas::query()
            ->when($this->search, fn($q) => $q->where('nama', 'like', "%{$this->search}%"))
            ->latest()
            ->get();

        $stats = [
            'bersih' => Fasilitas::where('status_kebersihan', 'bersih')->count(),
            'perlu_dicuci' => Fasilitas::where('status_kebersihan', 'perlu-dicuci')->count(),
            'harum' => Fasilitas::where('status_keharuman', 'harum')->count(),
            'tidak_harum' => Fasilitas::where('status_keharuman', 'tidak-harum')->count(),
        ];

        return view('livewire.monitoring-kebersihan', [
            'fasilitas' => $fasilitas,
            'stats' => $stats,
        ])->layout('layouts.main');
    }
}
