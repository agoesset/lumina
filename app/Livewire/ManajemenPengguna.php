<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ManajemenPengguna extends Component
{
    public $search = '';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editId = null;
    public $deleteId = null;
    public $name, $email, $password, $password_confirmation, $role, $status, $tanggal_bergabung;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|in:admin-masjid,petugas-kebersihan,admin-sistem',
        'status' => 'required|in:aktif,nonaktif',
        'tanggal_bergabung' => 'required|date',
    ];

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = 'petugas-kebersihan';
        $this->status = 'aktif';
        $this->tanggal_bergabung = now()->format('Y-m-d');
        $this->editId = null;
        $this->resetValidation();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = $user->role;
        $this->status = $user->status;
        $this->tanggal_bergabung = $user->tanggal_bergabung->format('Y-m-d');
        $this->resetValidation();
        $this->showModal = true;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin-masjid,petugas-kebersihan,admin-sistem',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_bergabung' => 'required|date',
        ];

        if ($this->editId) {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->editId;
        } else {
            $rules['email'] = 'required|email|max:255|unique:users,email';
            $rules['password'] = 'required|string|min:8';
            $rules['password_confirmation'] = 'required|string|min:8|same:password';
        }

        if ($this->editId && $this->password) {
            $rules['password'] = 'required|string|min:8';
            $rules['password_confirmation'] = 'required|string|min:8|same:password';
        }

        $this->validate($rules);

        if ($this->editId) {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'status' => $this->status,
                'tanggal_bergabung' => $this->tanggal_bergabung,
            ];

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            User::where('id', $this->editId)->update($data);

            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Update Pengguna',
                'tipe' => 'update',
                'detail' => "Memperbarui data pengguna: {$this->name}",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => $this->role,
                'status' => $this->status,
                'tanggal_bergabung' => $this->tanggal_bergabung,
            ]);

            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Tambah Pengguna',
                'tipe' => 'create',
                'detail' => "Menambahkan pengguna: {$this->name} ({$this->role})",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->showDeleteModal = false;
    }

    public function executeDelete()
    {
        if ($this->deleteId) {
            $user = User::findOrFail($this->deleteId);
            $nama = $user->name;
            $user->delete();

            \App\Models\LogAktivitas::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'aktivitas' => 'Hapus Pengguna',
                'tipe' => 'delete',
                'detail' => "Menghapus pengguna: {$nama}",
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => now()->format('H:i:s'),
            ]);
        }

        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $newStatus = $user->status === 'aktif' ? 'nonaktif' : 'aktif';
        $user->update(['status' => $newStatus]);

        \App\Models\LogAktivitas::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'aktivitas' => 'Toggle Status Pengguna',
            'tipe' => 'status',
            'detail' => "Mengubah status {$user->name} menjadi {$newStatus}",
            'tanggal' => now()->format('Y-m-d'),
            'waktu' => now()->format('H:i:s'),
        ]);
    }

    public function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials;
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->latest()
            ->get();

        return view('livewire.manajemen-pengguna', ['users' => $users])->layout('layouts.main');
    }
}
