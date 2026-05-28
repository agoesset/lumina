<?php

namespace App\Livewire;

use App\Models\Fasilitas;
use Livewire\Component;

class DataFasilitas extends Component
{
    public $search = '';
    public $showModal = false;
    public $editId = null;
    public $nama, $kategori, $jumlah, $kondisi, $lokasi, $status_kebersihan, $status_keharuman, $tanggal_pembaruan;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'kategori' => 'required|string|max:255',
        'jumlah' => 'required|integer|min:1',
        'kondisi' => 'required|in:baik,perlu-perawatan,rusak,perlu-dicuci',
        'lokasi' => 'required|string|max:255',
        'status_kebersihan' => 'required|in:bersih,perlu-dicuci,kotor',
        'status_keharuman' => 'required|in:harum,tidak-harum,netral',
        'tanggal_pembaruan' => 'required|date',
    ];

    public function resetForm()
    {
        $this->nama = '';
        $this->kategori = '';
        $this->jumlah = 1;
        $this->kondisi = 'baik';
        $this->lokasi = '';
        $this->status_kebersihan = 'bersih';
        $this->status_keharuman = 'netral';
        $this->tanggal_pembaruan = now()->format('Y-m-d');
        $this->editId = null;
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $this->editId = $id;
        $this->nama = $fasilitas->nama;
        $this->kategori = $fasilitas->kategori;
        $this->jumlah = $fasilitas->jumlah;
        $this->kondisi = $fasilitas->kondisi;
        $this->lokasi = $fasilitas->lokasi;
        $this->status_kebersihan = $fasilitas->status_kebersihan;
        $this->status_keharuman = $fasilitas->status_keharuman;
        $this->tanggal_pembaruan = $fasilitas->tanggal_pembaruan->format('Y-m-d');
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editId) {
            Fasilitas::where('id', $this->editId)->update([
                'nama' => $this->nama,
                'kategori' => $this->kategori,
                'jumlah' => $this->jumlah,
                'kondisi' => $this->kondisi,
                'lokasi' => $this->lokasi,
                'status_kebersihan' => $this->status_kebersihan,
                'status_keharuman' => $this->status_keharuman,
                'tanggal_pembaruan' => $this->tanggal_pembaruan,
            ]);
            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Update Fasilitas',
                'tipe' => 'update',
                'detail' => "Memperbarui data: {$this->nama}",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        } else {
            Fasilitas::create([
                'nama' => $this->nama,
                'kategori' => $this->kategori,
                'jumlah' => $this->jumlah,
                'kondisi' => $this->kondisi,
                'lokasi' => $this->lokasi,
                'status_kebersihan' => $this->status_kebersihan,
                'status_keharuman' => $this->status_keharuman,
                'tanggal_pembaruan' => $this->tanggal_pembaruan,
            ]);
            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Tambah Fasilitas',
                'tipe' => 'create',
                'detail' => "Menambahkan fasilitas: {$this->nama} ({$this->jumlah} unit)",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $nama = $fasilitas->nama;
        $fasilitas->delete();

        \App\Models\LogAktivitas::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'aktivitas' => 'Hapus Fasilitas',
            'tipe' => 'delete',
            'detail' => "Menghapus fasilitas: {$nama}",
            'tanggal' => now()->format('Y-m-d'),
            'waktu' => now()->format('H:i:s'),
        ]);
    }

    public function render()
    {
        $fasilitas = Fasilitas::query()
            ->when($this->search, fn($q) => $q->where('nama', 'like', "%{$this->search}%"))
            ->latest()
            ->get();

        return view('livewire.data-fasilitas', ['fasilitas' => $fasilitas])->layout('layouts.main');
    }
}
