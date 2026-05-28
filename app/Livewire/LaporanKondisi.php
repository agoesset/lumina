<?php

namespace App\Livewire;

use App\Models\Fasilitas;
use App\Models\LaporanKondisi as LaporanKondisiModel;
use App\Models\User;
use Livewire\Component;

class LaporanKondisi extends Component
{
    public $search = '';
    public $showModal = false;
    public $editId = null;
    public $fasilitas_id, $petugas_id, $kondisi, $catatan, $tanggal;

    protected $rules = [
        'fasilitas_id' => 'required|exists:fasilitas,id',
        'petugas_id' => 'required|exists:users,id',
        'kondisi' => 'required|in:baik,perlu-perawatan,rusak,perlu-dicuci',
        'catatan' => 'nullable|string|max:500',
        'tanggal' => 'required|date',
    ];

    public function resetForm()
    {
        $this->fasilitas_id = '';
        $this->petugas_id = '';
        $this->kondisi = 'baik';
        $this->catatan = '';
        $this->tanggal = now()->format('Y-m-d');
        $this->editId = null;
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $laporan = LaporanKondisiModel::with('fasilitas', 'petugas')->findOrFail($id);
        $this->editId = $id;
        $this->fasilitas_id = $laporan->fasilitas_id;
        $this->petugas_id = $laporan->petugas_id;
        $this->kondisi = $laporan->kondisi;
        $this->catatan = $laporan->catatan;
        $this->tanggal = $laporan->tanggal->format('Y-m-d');
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editId) {
            LaporanKondisiModel::where('id', $this->editId)->update([
                'fasilitas_id' => $this->fasilitas_id,
                'petugas_id' => $this->petugas_id,
                'kondisi' => $this->kondisi,
                'catatan' => $this->catatan,
                'tanggal' => $this->tanggal,
            ]);

            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Update Laporan Kondisi',
                'tipe' => 'update',
                'detail' => "Memperbarui laporan kondisi ID: {$this->editId}",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        } else {
            LaporanKondisiModel::create([
                'fasilitas_id' => $this->fasilitas_id,
                'petugas_id' => $this->petugas_id,
                'kondisi' => $this->kondisi,
                'catatan' => $this->catatan,
                'tanggal' => $this->tanggal,
            ]);

            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Tambah Laporan Kondisi',
                'tipe' => 'create',
                'detail' => "Menambahkan laporan kondisi untuk fasilitas ID: {$this->fasilitas_id}",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        $laporan = LaporanKondisiModel::findOrFail($id);
        $laporan->delete();

        \App\Models\LogAktivitas::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'aktivitas' => 'Hapus Laporan Kondisi',
            'tipe' => 'delete',
            'detail' => "Menghapus laporan kondisi ID: {$id}",
            'tanggal' => now()->format('Y-m-d'),
            'waktu' => now()->format('H:i:s'),
        ]);
    }

    public function render()
    {
        $laporan = LaporanKondisiModel::with(['fasilitas', 'petugas'])
            ->when($this->search, function ($q) {
                $q->whereHas('fasilitas', fn($q) => $q->where('nama', 'like', "%{$this->search}%"))
                    ->orWhereHas('petugas', fn($q) => $q->where('name', 'like', "%{$this->search}%"));
            })
            ->latest('tanggal')
            ->get();

        $fasilitas = Fasilitas::all();
        $petugas = User::where('role', 'petugas-kebersihan')->get();

        return view('livewire.laporan-kondisi', [
            'laporan' => $laporan,
            'fasilitas' => $fasilitas,
            'petugas' => $petugas,
        ])->layout('layouts.main');
    }
}
