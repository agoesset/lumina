<div x-data="{ expanded: null }">
    <div class="mb-8 animate-fade-in">
        <h2 class="text-3xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Riwayat Perawatan</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-1">Histori perawatan fasilitas masjid</p>
    </div>

    {{-- Summary Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Perawatan</p>
                    <p class="text-2xl font-bold text-slate-800 dark:text-slate-100 mt-1">{{ $this->summary['total'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center text-primary-600 dark:text-primary-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Kondisi Baik</p>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ $this->summary['kondisi_baik'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Kondisi Rusak</p>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-1">{{ $this->summary['kondisi_rusak'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-600 dark:text-red-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Tingkat Perbaikan</p>
                    <p class="text-2xl font-bold text-primary-600 dark:text-primary-400 mt-1">{{ $this->summary['improvement'] }}%</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center text-primary-600 dark:text-primary-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5 mb-8">
        <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center">
            <div class="relative flex-1 w-full lg:w-auto">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" wire:model.live="search" placeholder="Cari riwayat..." class="w-full lg:w-72 pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
            </div>

            <select wire:model.live="filterFasilitas" class="w-full lg:w-56 px-4 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                <option value="">Semua Fasilitas</option>
                @foreach($fasilitas as $f)
                    <option value="{{ $f->id }}">{{ $f->nama }}</option>
                @endforeach
            </select>

            <div class="flex gap-3 w-full lg:w-auto">
                <input type="date" wire:model.live="filterTanggalMulai" class="w-full lg:w-40 px-4 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                <span class="text-slate-400 self-center hidden lg:inline">-</span>
                <input type="date" wire:model.live="filterTanggalSelesai" class="w-full lg:w-40 px-4 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
            </div>

            <button wire:click="resetFilters" class="px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                Reset
            </button>
        </div>
    </div>

    {{-- Timeline --}}
    <div class="space-y-10">
        @forelse($this->timelineGroups as $date => $items)
            <div class="animate-slide-up">
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-px flex-1 bg-slate-200 dark:bg-slate-700"></div>
                    <span class="text-sm font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-4 py-1.5 rounded-full border border-slate-200 dark:border-slate-700">
                        {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
                    </span>
                    <div class="h-px flex-1 bg-slate-200 dark:bg-slate-700"></div>
                </div>

                <div class="relative pl-8 space-y-6">
                    <div class="absolute left-[15px] top-0 bottom-0 w-px bg-slate-200 dark:bg-slate-700"></div>

                    @foreach($items as $item)
                        <div class="relative">
                            <div class="absolute -left-[23px] top-2 w-3 h-3 rounded-full bg-primary-500 ring-4 ring-white dark:ring-slate-900"></div>

                            <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5 transition-all hover:card-shadow-hover">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-xs font-semibold text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 px-2 py-0.5 rounded-md">{{ $item->fasilitas->nama }}</span>
                                            <span class="text-xs text-slate-400">{{ $item->petugas->name }}</span>
                                        </div>
                                        <h3 class="font-semibold text-slate-800 dark:text-slate-100">{{ $item->aktivitas }}</h3>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-slate-500 dark:text-slate-400">Sebelum:</span>
                                            @php
                                                $kondisiColors = [
                                                    'baik' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                    'perlu-perawatan' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                                    'rusak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                                    'perlu-dicuci' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                                ];
                                                $kondisiLabels = [
                                                    'baik' => 'Baik',
                                                    'perlu-perawatan' => 'Perlu Perawatan',
                                                    'rusak' => 'Rusak',
                                                    'perlu-dicuci' => 'Perlu Dicuci',
                                                ];
                                            @endphp
                                            <span class="px-2 py-1 rounded-lg text-xs font-medium {{ $kondisiColors[$item->kondisi_sebelum] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400' }}">
                                                {{ $kondisiLabels[$item->kondisi_sebelum] ?? '-' }}
                                            </span>
                                        </div>
                                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-slate-500 dark:text-slate-400">Sesudah:</span>
                                            <span class="px-2 py-1 rounded-lg text-xs font-medium {{ $kondisiColors[$item->kondisi_sesudah] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400' }}">
                                                {{ $kondisiLabels[$item->kondisi_sesudah] ?? '-' }}
                                            </span>
                                        </div>
                                    </div>

                                    <button @click="expanded === {{ $item->id }} ? expanded = null : expanded = {{ $item->id }}" class="text-sm text-primary-600 dark:text-primary-400 font-medium hover:underline flex items-center gap-1">
                                        <span x-text="expanded === {{ $item->id }} ? 'Sembunyikan' : 'Detail'"></span>
                                        <svg class="w-4 h-4 transition-transform" :class="expanded === {{ $item->id }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                </div>

                                <div x-show="expanded === {{ $item->id }}" x-collapse x-cloak class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <p class="text-slate-500 dark:text-slate-400 mb-1">Catatan</p>
                                            <p class="text-slate-800 dark:text-slate-200">{{ $item->catatan ?? 'Tidak ada catatan' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-slate-500 dark:text-slate-400 mb-1">Petugas</p>
                                            <p class="text-slate-800 dark:text-slate-200">{{ $item->petugas->name }} ({{ $item->petugas->email }})</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Tidak ada data</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Tidak ada riwayat perawatan yang sesuai dengan filter.</p>
            </div>
        @endforelse
    </div>
</div>
