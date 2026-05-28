<?php

namespace App\Livewire;

use App\Models\Fasilitas;
use App\Models\JadwalPerawatan as JadwalPerawatanModel;
use App\Models\User;
use Livewire\Component;

class JadwalPerawatan extends Component
{
    public $search = '';
    public $showModal = false;
    public $editId = null;
    public $fasilitas_id, $petugas_id, $tanggal, $frekuensi, $status, $catatan;

    protected $rules = [
        'fasilitas_id' => 'required|exists:fasilitas,id',
        'petugas_id' => 'required|exists:users,id',
        'tanggal' => 'required|date',
        'frekuensi' => 'required|in:harian,mingguan,bulanan',
        'status' => 'required|in:belum-dimulai,sedang-berlangsung,selesai',
        'catatan' => 'nullable|string|max:500',
    ];

    public function resetForm()
    {
        $this->fasilitas_id = '';
        $this->petugas_id = '';
        $this->tanggal = now()->format('Y-m-d');
        $this->frekuensi = 'mingguan';
        $this->status = 'belum-dimulai';
        $this->catatan = '';
        $this->editId = null;
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $jadwal = JadwalPerawatanModel::with('fasilitas', 'petugas')->findOrFail($id);
        $this->editId = $id;
        $this->fasilitas_id = $jadwal->fasilitas_id;
        $this->petugas_id = $jadwal->petugas_id;
        $this->tanggal = $jadwal->tanggal->format('Y-m-d');
        $this->frekuensi = $jadwal->frekuensi;
        $this->status = $jadwal->status;
        $this->catatan = $jadwal->catatan;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editId) {
            JadwalPerawatanModel::where('id', $this->editId)->update([
                'fasilitas_id' => $this->fasilitas_id,
                'petugas_id' => $this->petugas_id,
                'tanggal' => $this->tanggal,
                'frekuensi' => $this->frekuensi,
                'status' => $this->status,
                'catatan' => $this->catatan,
            ]);

            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Update Jadwal Perawatan',
                'tipe' => 'update',
                'detail' => "Memperbarui jadwal perawatan ID: {$this->editId}",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        } else {
            JadwalPerawatanModel::create([
                'fasilitas_id' => $this->fasilitas_id,
                'petugas_id' => $this->petugas_id,
                'tanggal' => $this->tanggal,
                'frekuensi' => $this->frekuensi,
                'status' => $this->status,
                'catatan' => $this->catatan,
            ]);

            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Tambah Jadwal Perawatan',
                'tipe' => 'create',
                'detail' => "Menambahkan jadwal perawatan untuk fasilitas ID: {$this->fasilitas_id}",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        $jadwal = JadwalPerawatanModel::findOrFail($id);
        $jadwal->delete();

        \App\Models\LogAktivitas::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'aktivitas' => 'Hapus Jadwal Perawatan',
            'tipe' => 'delete',
            'detail' => "Menghapus jadwal perawatan ID: {$id}",
            'tanggal' => now()->format('Y-m-d'),
            'waktu' => now()->format('H:i:s'),
        ]);
    }

    public function render()
    {
        $jadwal = JadwalPerawatanModel::with(['fasilitas', 'petugas'])
            ->when($this->search, function ($q) {
                $q->whereHas('fasilitas', fn($q) => $q->where('nama', 'like', "%{$this->search}%"))
                    ->orWhereHas('petugas', fn($q) => $q->where('name', 'like', "%{$this->search}%"));
            })
            ->latest('tanggal')
            ->get();

        $fasilitas = Fasilitas::all();
        $petugas = User::where('role', 'petugas-kebersihan')->get();

        return view('livewire.jadwal-perawatan', [
            'jadwal' => $jadwal,
            'fasilitas' => $fasilitas,
            'petugas' => $petugas,
        ])->layout('layouts.main');
    }
}
