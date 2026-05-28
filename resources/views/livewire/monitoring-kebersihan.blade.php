<div x-data="{ modal: @entangle('showModal') }">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Monitoring Kebersihan</h2>
            <p class="text-slate-500">Pantau status kebersihan dan keharuman fasilitas</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl card-shadow p-4 border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Bersih</p>
                    <p class="text-2xl font-bold text-emerald-600">{{ $stats['bersih'] }}</p>
                </div>
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl card-shadow p-4 border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Perlu Dicuci</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['perlu_dicuci'] }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl card-shadow p-4 border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Harum</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $stats['harum'] }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl card-shadow p-4 border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Tidak Harum</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['tidak_harum'] }}</p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="p-4 border-b border-slate-100">
            <input type="text" wire:model.live="search" placeholder="Cari fasilitas..." class="w-full md:w-72 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
        </div>

        {{-- Mobile cards --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse($fasilitas as $f)
            <div class="p-4 hover:bg-slate-50 transition-colors">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-semibold text-slate-800 truncate">{{ $f->nama }}</h3>
                            <p class="text-xs text-slate-500 truncate">{{ $f->kategori }} &middot; {{ $f->lokasi }}</p>
                        </div>
                    </div>
                    <button wire:click="edit({{ $f->id }})" class="px-3 py-1.5 text-xs font-medium bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 transition-shadow shrink-0 ml-2">Update</button>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    @php
                        $kebersihanColors = ['bersih' => 'bg-emerald-100 text-emerald-700', 'perlu-dicuci' => 'bg-yellow-100 text-yellow-700', 'kotor' => 'bg-red-100 text-red-700'];
                        $kebersihanLabels = ['bersih' => 'Bersih', 'perlu-dicuci' => 'Perlu Dicuci', 'kotor' => 'Kotor'];
                        $keharumanColors = ['harum' => 'bg-emerald-100 text-emerald-700', 'tidak-harum' => 'bg-red-100 text-red-700', 'netral' => 'bg-slate-100 text-slate-700'];
                        $keharumanLabels = ['harum' => 'Harum', 'tidak-harum' => 'Tidak Harum', 'netral' => 'Netral'];
                    @endphp
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium {{ $kebersihanColors[$f->status_kebersihan] }}">{{ $kebersihanLabels[$f->status_kebersihan] }}</span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium {{ $keharumanColors[$f->status_keharuman] }}">{{ $keharumanLabels[$f->status_keharuman] }}</span>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-slate-500 text-sm">Tidak ada data fasilitas</p>
            </div>
            @endforelse
        </div>

        {{-- Desktop table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-primary-50 to-primary-50/50">
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg> Nama</span></th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg> Kategori</span></th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg> Lokasi</span></th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Kebersihan</span></th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Keharuman</span></th>
                        <th class="px-5 py-3.5 text-right text-xs font-semibold text-primary-700 uppercase tracking-wider"><span class="inline-flex items-center gap-2"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg> Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($fasilitas as $f)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <span class="font-semibold text-slate-800">{{ $f->nama }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $f->kategori }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $f->lokasi }}</td>
                        <td class="px-5 py-4">
                            @php
                                $kebersihanColors = ['bersih' => 'bg-emerald-100 text-emerald-700', 'perlu-dicuci' => 'bg-yellow-100 text-yellow-700', 'kotor' => 'bg-red-100 text-red-700'];
                                $kebersihanLabels = ['bersih' => 'Bersih', 'perlu-dicuci' => 'Perlu Dicuci', 'kotor' => 'Kotor'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $kebersihanColors[$f->status_kebersihan] }}">
                                @if($f->status_kebersihan === 'bersih')
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                @elseif($f->status_kebersihan === 'kotor')
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                @else
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                                @endif
                                {{ $kebersihanLabels[$f->status_kebersihan] }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            @php
                                $keharumanColors = ['harum' => 'bg-emerald-100 text-emerald-700', 'tidak-harum' => 'bg-red-100 text-red-700', 'netral' => 'bg-slate-100 text-slate-700'];
                                $keharumanLabels = ['harum' => 'Harum', 'tidak-harum' => 'Tidak Harum', 'netral' => 'Netral'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $keharumanColors[$f->status_keharuman] }}">
                                @if($f->status_keharuman === 'harum')
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @elseif($f->status_keharuman === 'tidak-harum')
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                @else
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                @endif
                                {{ $keharumanLabels[$f->status_keharuman] }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end">
                                <button wire:click="edit({{ $f->id }})" class="px-3.5 py-2 text-xs font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 transition-shadow flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    Update
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center">
                            <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="text-slate-500 font-medium">Tidak ada data fasilitas</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50" x-cloak>
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-slate-800">Update Status Kebersihan</h3>
                <button @click="modal = false; $wire.resetForm()" class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form wire:submit="save" class="p-5 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Status Kebersihan</label>
                    <select wire:model="status_kebersihan" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                        <option value="bersih">Bersih</option>
                        <option value="perlu-dicuci">Perlu Dicuci</option>
                        <option value="kotor">Kotor</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Status Keharuman</label>
                    <select wire:model="status_keharuman" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                        <option value="harum">Harum</option>
                        <option value="tidak-harum">Tidak Harum</option>
                        <option value="netral">Netral</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="modal = false; $wire.resetForm()" class="px-4 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 transition-shadow">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>