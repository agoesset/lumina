<div x-data="{ modal: @entangle('showModal'), deleteModal: @entangle('showDeleteModal') }">
    <div class="mb-8 animate-fade-in flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Manajemen Pengguna</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola data pengguna sistem</p>
        </div>
        <button wire:click="create" class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-primary-500/25 font-medium text-sm flex items-center gap-2 hover:shadow-primary-500/40 transition-shadow self-start">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Pengguna
        </button>
    </div>

    {{-- Search --}}
    <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5 mb-8">
        <div class="relative w-full md:w-96">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" wire:model.live="search" placeholder="Cari pengguna..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
        </div>
    </div>

    {{-- User Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($users as $user)
            @php
                $roleStyles = [
                    'admin-masjid' => ['bg' => 'bg-purple-100 dark:bg-purple-900/20', 'text' => 'text-purple-700 dark:text-purple-400', 'label' => 'Admin Masjid'],
                    'petugas-kebersihan' => ['bg' => 'bg-blue-100 dark:bg-blue-900/20', 'text' => 'text-blue-700 dark:text-blue-400', 'label' => 'Petugas Kebersihan'],
                    'admin-sistem' => ['bg' => 'bg-rose-100 dark:bg-rose-900/20', 'text' => 'text-rose-700 dark:text-rose-400', 'label' => 'Admin Sistem'],
                ];
                $roleStyle = $roleStyles[$user->role] ?? ['bg' => 'bg-slate-100 dark:bg-slate-800', 'text' => 'text-slate-700 dark:text-slate-400', 'label' => $user->role];
            @endphp
            <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5 flex flex-col transition-all hover:card-shadow-hover">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 text-white flex items-center justify-center font-bold text-sm shrink-0">
                            {{ $this->getInitials($user->name) }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-semibold text-slate-800 dark:text-slate-100 truncate">{{ $user->name }}</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0 ml-2">
                        <div class="w-2.5 h-2.5 rounded-full {{ $user->status === 'aktif' ? 'bg-emerald-500' : 'bg-slate-400' }}"></div>
                        <span class="text-xs text-slate-500 dark:text-slate-400">{{ $user->status === 'aktif' ? 'Aktif' : 'Nonaktif' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 mb-5">
                    <span class="px-2.5 py-1 rounded-lg text-xs font-medium {{ $roleStyle['bg'] }} {{ $roleStyle['text'] }}">{{ $roleStyle['label'] }}</span>
                </div>

                <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
                    <button wire:click="toggleStatus({{ $user->id }})" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $user->status === 'aktif' ? 'bg-primary-500' : 'bg-slate-300 dark:bg-slate-600' }}" title="Ubah status">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $user->status === 'aktif' ? 'translate-x-6' : 'translate-x-1' }}"></span>
                    </button>

                    <div class="flex items-center gap-2">
                        <button wire:click="edit({{ $user->id }})" class="p-2 rounded-xl bg-primary-50 text-primary-600 hover:bg-primary-100 hover:text-primary-700 hover:scale-110 active:scale-95 transition-all duration-150 shadow-sm" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button wire:click="confirmDelete({{ $user->id }})" class="p-2 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 hover:scale-110 active:scale-95 transition-all duration-150 shadow-sm" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Tidak ada data</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Tidak ada pengguna yang sesuai dengan pencarian.</p>
            </div>
        @endforelse
    </div>

    {{-- Create/Edit Modal --}}
    <div x-show="modal" class="fixed inset-0 z-50 flex items-center justify-center" x-cloak>
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="modal = false; $wire.resetForm()"></div>
        <div class="relative bg-surface dark:bg-surface-dark rounded-2xl shadow-2xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto border border-slate-200 dark:border-slate-700 animate-scale-in">
            <div class="p-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">{{ $editId ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h3>
                <button @click="modal = false; $wire.resetForm()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form wire:submit="save" class="p-5 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama</label>
                    <input type="text" wire:model="name" class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                    @error('name') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <input type="email" wire:model="email" class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                    @error('email') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Password {{ $editId ? '(opsional)' : '' }}</label>
                        <input type="password" wire:model="password" class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                        @error('password') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Konfirmasi Password</label>
                        <input type="password" wire:model="password_confirmation" class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                        @error('password_confirmation') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Role</label>
                        <select wire:model="role" class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                            <option value="admin-masjid">Admin Masjid</option>
                            <option value="petugas-kebersihan">Petugas Kebersihan</option>
                            <option value="admin-sistem">Admin Sistem</option>
                        </select>
                        @error('role') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                        <select wire:model="status" class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        @error('status') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tanggal Bergabung</label>
                    <input type="date" wire:model="tanggal_bergabung" class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                    @error('tanggal_bergabung') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" @click="modal = false; $wire.resetForm()" class="px-4 py-2.5 text-sm font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 transition-shadow">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-show="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center" x-cloak>
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="deleteModal = false; $wire.cancelDelete()"></div>
        <div class="relative bg-surface dark:bg-surface-dark rounded-2xl shadow-2xl w-full max-w-sm mx-4 border border-slate-200 dark:border-slate-700 animate-scale-in p-6 text-center">
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-500">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-2">Konfirmasi Hapus</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-center gap-3">
                <button @click="deleteModal = false; $wire.cancelDelete()" class="px-4 py-2.5 text-sm font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">Batal</button>
                <button wire:click="executeDelete" class="px-4 py-2.5 text-sm font-medium bg-red-500 hover:bg-red-600 text-white rounded-xl transition-colors">Hapus</button>
            </div>
        </div>
    </div>
</div>
