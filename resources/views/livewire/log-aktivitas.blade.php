<div>
    <div class="mb-8 animate-fade-in flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Log Aktivitas</h2>
            <p class="text-slate-500 mt-1">Riwayat aktivitas sistem</p>
        </div>
        <button class="px-4 py-2.5 text-sm font-medium bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors flex items-center gap-2 self-start">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Export CSV
        </button>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 card-shadow p-5 mb-8 space-y-4">
        <div class="flex flex-wrap gap-2">
            @php
                $tipeOptions = [
                    '' => 'Semua',
                    'create' => 'Create',
                    'update' => 'Update',
                    'delete' => 'Delete',
                    'status' => 'Status',
                ];
            @endphp
            @foreach($tipeOptions as $value => $label)
                <button wire:click="$set('filterTipe', '{{ $value }}')" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ $filterTipe === $value ? 'bg-primary-500 text-white shadow-lg shadow-primary-500/25' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center">
            <div class="relative flex-1 w-full lg:w-auto">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" wire:model.live="search" placeholder="Cari aktivitas..." class="w-full lg:w-72 pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
            </div>

            <div class="flex gap-3 w-full lg:w-auto">
                <input type="date" wire:model.live="filterTanggalMulai" class="w-full lg:w-40 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                <span class="text-slate-400 self-center hidden lg:inline">-</span>
                <input type="date" wire:model.live="filterTanggalSelesai" class="w-full lg:w-40 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
            </div>

            <button wire:click="resetFilters" class="px-4 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">
                Reset
            </button>
        </div>
    </div>

    {{-- Mobile cards --}}
    <div class="md:hidden space-y-3">
        @forelse($this->logs as $log)
            @php
                $style = $this->getTipeStyle($log->tipe);
                $time = $this->formatTimestamp($log->tanggal, $log->waktu);
            @endphp
            <div class="bg-white rounded-2xl border border-slate-200 card-shadow p-4 hover:card-shadow-hover transition-shadow">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl {{ $style['bg'] }} flex items-center justify-center shrink-0">
                        @if($style['icon'] === 'plus')
                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        @elseif($style['icon'] === 'pencil')
                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        @elseif($style['icon'] === 'trash')
                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        @elseif($style['icon'] === 'arrow-path')
                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                        @else
                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-800 text-sm">{{ $log->aktivitas }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $log->user_name }}</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-lg text-xs font-medium {{ $style['badge'] }} shrink-0">{{ $style['label'] }}</span>
                </div>
                <div class="flex items-center justify-between text-xs text-slate-400">
                    <span>{{ $time['relative'] }} &middot; {{ $time['exact'] }}</span>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-200 card-shadow p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800">Tidak ada data</h3>
                <p class="text-slate-500 mt-1">Tidak ada log aktivitas yang sesuai dengan filter.</p>
            </div>
        @endforelse
    </div>

    {{-- Desktop table --}}
    <div class="hidden md:block bg-white rounded-2xl border border-slate-200 card-shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-primary-50 to-primary-50/50">
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider">Aktivitas</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider">Pengguna</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider">Waktu</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider">Tipe</th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-primary-700 uppercase tracking-wider">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($this->logs as $log)
                        @php
                            $style = $this->getTipeStyle($log->tipe);
                            $time = $this->formatTimestamp($log->tanggal, $log->waktu);
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl {{ $style['bg'] }} flex items-center justify-center shrink-0">
                                        @if($style['icon'] === 'plus')
                                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        @elseif($style['icon'] === 'pencil')
                                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        @elseif($style['icon'] === 'trash')
                                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        @elseif($style['icon'] === 'arrow-path')
                                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                                        @else
                                            <svg class="w-4 h-4 {{ $style['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @endif
                                    </div>
                                    <span class="font-medium text-slate-800 text-sm">{{ $log->aktivitas }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-slate-600">{{ $log->user_name }}</td>
                            <td class="px-5 py-4">
                                <div class="text-sm">
                                    <span class="font-medium text-slate-700">{{ $time['relative'] }}</span>
                                    <span class="text-slate-400 text-xs block">{{ $time['exact'] }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-medium {{ $style['badge'] }}">{{ $style['label'] }}</span>
                            </td>
                            <td class="px-5 py-4 text-sm text-slate-600 max-w-xs truncate" title="{{ $log->detail }}">{{ $log->detail }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                </div>
                                <h3 class="text-lg font-semibold text-slate-800">Tidak ada data</h3>
                                <p class="text-slate-500 mt-1">Tidak ada log aktivitas yang sesuai dengan filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>