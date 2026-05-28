<div x-data="{ modal: @entangle('showModal') }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Laporan Kondisi</h2>
            <p class="text-slate-500">Kelola laporan kondisi fasilitas</p>
        </div>
        <button wire:click="create" class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-primary-500/25 font-medium text-sm hover:shadow-primary-500/40 transition-shadow flex items-center gap-2 self-start">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Laporan
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="p-4 border-b border-slate-100">
            <input type="text" wire:model.live="search" placeholder="Cari laporan..." class="w-full md:w-72 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
        </div>

        {{-- Mobile cards --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse($laporan as $l)
            <div class="p-4 hover:bg-slate-50 transition-colors">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-semibold text-slate-800 truncate">{{ $l->fasilitas->nama }}</h3>
                            <p class="text-xs text-slate-500 truncate">{{ $l->petugas->name }} &middot; {{ $l->tanggal->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0 ml-2">
                        <button wire:click="edit({{ $l->id }})" class="p-2 rounded-xl bg-primary-50 text-primary-600 hover:bg-primary-100 hover:scale-110 transition-all duration-150" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button wire:click="delete({{ $l->id }})" wire:confirm="Yakin hapus laporan ini?" class="p-2 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 hover:scale-110 transition-all duration-150" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    @php
                        $colors = ['baik' => 'bg-emerald-100 text-emerald-700', 'perlu-perawatan' => 'bg-orange-100 text-orange-700', 'rusak' => 'bg-red-100 text-red-700', 'perlu-dicuci' => 'bg-yellow-100 text-yellow-700'];
                        $labels = ['baik' => 'Baik', 'perlu-perawatan' => 'Perlu Perawatan', 'rusak' => 'Rusak', 'perlu-dicuci' => 'Perlu Dicuci'];
                    @endphp
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium {{ $colors[$l->kondisi] }}">
                        @if($l->kondisi === 'baik')
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        @elseif($l->kondisi === 'rusak')
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                        @endif
                        {{ $labels[$l->kondisi] }}
                    </span>
                    <span class="text-xs text-slate-400 truncate max-w-[180px]">{{ $l->catatan ?? '-' }}</span>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-slate-500 text-sm">Tidak ada data laporan</p>
            </div>
            @endforelse
        </div>

        {{-- Desktop table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-primary-50 to-primary-50/50">
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg> Fasilitas</span></th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> Petugas</span></th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Tanggal</span></th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Kondisi</span></th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg> Catatan</span></th>
                        <th class="px-5 py-3.5 text-right text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg> Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($laporan as $l)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <span class="font-semibold text-slate-800">{{ $l->fasilitas->nama }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $l->petugas->name }}</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 text-sm text-slate-700">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $l->tanggal->format('d M Y') }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            @php
                                $colors = ['baik' => 'bg-emerald-100 text-emerald-700', 'perlu-perawatan' => 'bg-orange-100 text-orange-700', 'rusak' => 'bg-red-100 text-red-700', 'perlu-dicuci' => 'bg-yellow-100 text-yellow-700'];
                                $labels = ['baik' => 'Baik', 'perlu-perawatan' => 'Perlu Perawatan', 'rusak' => 'Rusak', 'perlu-dicuci' => 'Perlu Dicuci'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $colors[$l->kondisi] }}">
                                @if($l->kondisi === 'baik')
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                @elseif($l->kondisi === 'rusak')
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                @else
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                @endif
                                {{ $labels[$l->kondisi] }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-600 max-w-[200px] truncate" title="{{ $l->catatan ?? '' }}">{{ $l->catatan ?? '-' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="edit({{ $l->id }})" class="p-2 rounded-xl bg-primary-50 text-primary-600 hover:bg-primary-100 hover:scale-110 active:scale-95 transition-all duration-150 shadow-sm" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button wire:click="delete({{ $l->id }})" wire:confirm="Yakin hapus laporan ini?" class="p-2 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 hover:scale-110 active:scale-95 transition-all duration-150 shadow-sm" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center">
                            <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-slate-500 font-medium">Tidak ada data laporan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50" x-cloak>
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-slate-800">{{ $editId ? 'Edit Laporan Kondisi' : 'Tambah Laporan Kondisi' }}</h3>
                <button @click="modal = false; $wire.resetForm()" class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form wire:submit="save" class="p-5 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Fasilitas</label>
                    <select wire:model="fasilitas_id" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm" required>
                        <option value="">Pilih Fasilitas</option>
                        @foreach($fasilitas as $f)
                        <option value="{{ $f->id }}">{{ $f->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Petugas</label>
                    <select wire:model="petugas_id" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm" required>
                        <option value="">Pilih Petugas</option>
                        @foreach($petugas as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Kondisi</label>
                        <select wire:model="kondisi" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                            <option value="baik">Baik</option>
                            <option value="perlu-perawatan">Perlu Perawatan</option>
                            <option value="rusak">Rusak</option>
                            <option value="perlu-dicuci">Perlu Dicuci</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal</label>
                        <input type="date" wire:model="tanggal" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Catatan</label>
                    <textarea wire:model="catatan" rows="3" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm"></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="modal = false; $wire.resetForm()" class="px-4 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 transition-shadow">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>