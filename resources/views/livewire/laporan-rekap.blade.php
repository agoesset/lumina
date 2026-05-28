<div x-data="{ donutData: {{ json_encode($this->donutData) }}, barData: {{ json_encode($this->barData) }}, metric1: {{ $this->performanceMetrics['persentase_kondisi_baik'] }}, metric2: {{ $this->performanceMetrics['persentase_jadwal_selesai'] }} }"
     x-init="
        if (donutData.data.length && donutData.data.reduce((a,b)=>a+b,0) > 0) {
            new Chart($refs.donutChart.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: donutData.labels,
                    datasets: [{
                        data: donutData.data,
                        backgroundColor: donutData.colors,
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } },
                    cutout: '65%'
                }
            });
        }
        if (barData.data.length) {
            new Chart($refs.barChart.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: barData.labels,
                    datasets: [{
                        label: 'Jumlah Perawatan',
                        data: barData.data,
                        backgroundColor: '#059669',
                        borderRadius: 6,
                        barThickness: 24
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#e2e8f0' }, ticks: { color: '#64748b' } },
                        x: { grid: { display: false }, ticks: { color: '#64748b' } }
                    }
                }
            });
        }
     ">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <div class="mb-8 animate-fade-in flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Laporan Rekap</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Ringkasan data dan metrik performa</p>
        </div>
        <div class="flex gap-2">
            <button class="px-4 py-2.5 text-sm font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                PDF
            </button>
            <button class="px-4 py-2.5 text-sm font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Excel
            </button>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5 mb-8">
        <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center">
            <div class="flex gap-3 w-full lg:w-auto">
                <input type="date" wire:model.live="filterTanggalMulai" class="w-full lg:w-48 px-4 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
                <span class="text-slate-400 self-center hidden lg:inline">-</span>
                <input type="date" wire:model.live="filterTanggalSelesai" class="w-full lg:w-48 px-4 py-2.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 text-sm">
            </div>
            <button wire:click="resetFilters" class="px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                Reset
            </button>
        </div>
    </div>

    {{-- Performance Metrics with Gauges & Progress --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        @php
            $metrics = [
                ['label' => 'Tingkat Kesehatan Fasilitas', 'value' => $this->performanceMetrics['persentase_kondisi_baik'], 'color' => 'text-primary-500', 'bg' => 'bg-primary-500'],
                ['label' => 'Jadwal Selesai', 'value' => $this->performanceMetrics['persentase_jadwal_selesai'], 'color' => 'text-blue-500', 'bg' => 'bg-blue-500'],
                ['label' => 'Petugas Aktif', 'value' => $this->performanceMetrics['total_petugas'], 'suffix' => ' orang', 'color' => 'text-accent-500', 'bg' => 'bg-accent-500', 'hideGauge' => true],
                ['label' => 'Total Pengguna', 'value' => $this->performanceMetrics['total_pengguna'], 'suffix' => ' orang', 'color' => 'text-slate-700 dark:text-slate-200', 'bg' => 'bg-slate-500', 'hideGauge' => true],
            ];
        @endphp

        @foreach($metrics as $metric)
            <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5 flex flex-col items-center text-center">
                @if(empty($metric['hideGauge']))
                    <div class="relative w-28 h-28 mb-3">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="42" fill="none" stroke="#e2e8f0" stroke-width="10" class="dark:stroke-slate-700"/>
                            <circle cx="50" cy="50" r="42" fill="none" stroke="currentColor" stroke-width="10"
                                stroke-dasharray="264"
                                stroke-dashoffset="{{ 264 - (264 * $metric['value'] / 100) }}"
                                stroke-linecap="round"
                                class="{{ $metric['color'] }} transition-all duration-1000"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-bold text-slate-800 dark:text-slate-100">{{ $metric['value'] }}%</span>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-300">{{ $metric['label'] }}</p>
                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-1.5 mt-3">
                        <div class="{{ $metric['bg'] }} h-1.5 rounded-full transition-all duration-1000" style="width: {{ $metric['value'] }}%"></div>
                    </div>
                @else
                    <div class="w-14 h-14 rounded-2xl {{ str_replace('text-', 'bg-', $metric['color']) }} bg-opacity-10 dark:bg-opacity-20 flex items-center justify-center {{ $metric['color'] }} mb-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <p class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $metric['value'] }}{{ $metric['suffix'] ?? '' }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $metric['label'] }}</p>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5">
            <h3 class="font-semibold text-slate-800 dark:text-slate-100 mb-4">Distribusi Kondisi Fasilitas</h3>
            <div class="relative h-64">
                <canvas x-ref="donutChart"></canvas>
                @if(array_sum($this->donutData['data']) === 0)
                    <div class="absolute inset-0 flex items-center justify-center text-sm text-slate-400">Tidak ada data</div>
                @endif
            </div>
        </div>

        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow p-5">
            <h3 class="font-semibold text-slate-800 dark:text-slate-100 mb-4">Perawatan Bulanan</h3>
            <div class="relative h-64">
                <canvas x-ref="barChart"></canvas>
                @if(empty($this->barData['data']))
                    <div class="absolute inset-0 flex items-center justify-center text-sm text-slate-400">Tidak ada data</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Summary Tables --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Fasilitas --}}
        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h3 class="font-semibold text-slate-800 dark:text-slate-100">Statistik Fasilitas</h3>
            </div>
            <div class="p-5 space-y-5">
                <div class="flex justify-between items-center">
                    <span class="text-slate-600 dark:text-slate-300">Total Fasilitas</span>
                    <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $this->fasilitasStats['total'] }}</span>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 mb-3">Kondisi</p>
                    <div class="space-y-3">
                        @php
                            $kondisiRows = [
                                ['label' => 'Baik', 'key' => 'kondisi_baik', 'color' => 'bg-emerald-500'],
                                ['label' => 'Perlu Perawatan', 'key' => 'kondisi_perlu_perawatan', 'color' => 'bg-amber-500'],
                                ['label' => 'Rusak', 'key' => 'kondisi_rusak', 'color' => 'bg-red-500'],
                                ['label' => 'Perlu Dicuci', 'key' => 'kondisi_perlu_dicuci', 'color' => 'bg-yellow-400'],
                            ];
                        @endphp
                        @foreach($kondisiRows as $row)
                            @php $val = $this->fasilitasStats[$row['key']]; $pct = $this->fasilitasStats['total'] > 0 ? round(($val / $this->fasilitasStats['total']) * 100, 1) : 0; @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="flex items-center gap-2 text-slate-600 dark:text-slate-300"><span class="w-2.5 h-2.5 rounded-full {{ $row['color'] }}"></span> {{ $row['label'] }}</span>
                                    <span class="font-medium text-slate-700 dark:text-slate-200">{{ $val }} ({{ $pct }}%)</span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5">
                                    <div class="{{ $row['color'] }} h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-slate-100 dark:border-slate-700 pt-4">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 mb-3">Kebersihan</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-slate-600 dark:text-slate-300">Bersih</span><span class="font-medium text-slate-700 dark:text-slate-200">{{ $this->fasilitasStats['kebersihan_bersih'] }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600 dark:text-slate-300">Perlu Dicuci</span><span class="font-medium text-slate-700 dark:text-slate-200">{{ $this->fasilitasStats['kebersihan_perlu_dicuci'] }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600 dark:text-slate-300">Kotor</span><span class="font-medium text-slate-700 dark:text-slate-200">{{ $this->fasilitasStats['kebersihan_kotor'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jadwal --}}
        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h3 class="font-semibold text-slate-800 dark:text-slate-100">Statistik Jadwal Perawatan</h3>
            </div>
            <div class="p-5 space-y-5">
                <div class="flex justify-between items-center">
                    <span class="text-slate-600 dark:text-slate-300">Total Jadwal</span>
                    <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $this->jadwalStats['total'] }}</span>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 mb-3">Status</p>
                    <div class="space-y-3">
                        @php
                            $jadwalStatusRows = [
                                ['label' => 'Belum Dimulai', 'key' => 'belum_dimulai', 'color' => 'bg-slate-500'],
                                ['label' => 'Sedang Berlangsung', 'key' => 'sedang_berlangsung', 'color' => 'bg-blue-500'],
                                ['label' => 'Selesai', 'key' => 'selesai', 'color' => 'bg-emerald-500'],
                            ];
                        @endphp
                        @foreach($jadwalStatusRows as $row)
                            @php $val = $this->jadwalStats[$row['key']]; $pct = $this->jadwalStats['total'] > 0 ? round(($val / $this->jadwalStats['total']) * 100, 1) : 0; @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="flex items-center gap-2 text-slate-600 dark:text-slate-300"><span class="w-2.5 h-2.5 rounded-full {{ $row['color'] }}"></span> {{ $row['label'] }}</span>
                                    <span class="font-medium text-slate-700 dark:text-slate-200">{{ $val }} ({{ $pct }}%)</span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5">
                                    <div class="{{ $row['color'] }} h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-slate-100 dark:border-slate-700 pt-4">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 mb-3">Frekuensi</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-slate-600 dark:text-slate-300">Harian</span><span class="font-medium text-slate-700 dark:text-slate-200">{{ $this->jadwalStats['harian'] }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600 dark:text-slate-300">Mingguan</span><span class="font-medium text-slate-700 dark:text-slate-200">{{ $this->jadwalStats['mingguan'] }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600 dark:text-slate-300">Bulanan</span><span class="font-medium text-slate-700 dark:text-slate-200">{{ $this->jadwalStats['bulanan'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        {{-- Laporan Kondisi --}}
        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h3 class="font-semibold text-slate-800 dark:text-slate-100">Statistik Laporan Kondisi</h3>
            </div>
            <div class="p-5 space-y-5">
                <div class="flex justify-between items-center">
                    <span class="text-slate-600 dark:text-slate-300">Total Laporan</span>
                    <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $this->laporanStats['total'] }}</span>
                </div>
                <div class="space-y-3">
                    @php
                        $laporanRows = [
                            ['label' => 'Baik', 'key' => 'kondisi_baik', 'color' => 'bg-emerald-500'],
                            ['label' => 'Perlu Perawatan', 'key' => 'kondisi_perlu_perawatan', 'color' => 'bg-amber-500'],
                            ['label' => 'Rusak', 'key' => 'kondisi_rusak', 'color' => 'bg-red-500'],
                            ['label' => 'Perlu Dicuci', 'key' => 'kondisi_perlu_dicuci', 'color' => 'bg-yellow-400'],
                        ];
                    @endphp
                    @foreach($laporanRows as $row)
                        @php $val = $this->laporanStats[$row['key']]; $pct = $this->laporanStats['total'] > 0 ? round(($val / $this->laporanStats['total']) * 100, 1) : 0; @endphp
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="flex items-center gap-2 text-slate-600 dark:text-slate-300"><span class="w-2.5 h-2.5 rounded-full {{ $row['color'] }}"></span> {{ $row['label'] }}</span>
                                <span class="font-medium text-slate-700 dark:text-slate-200">{{ $val }} ({{ $pct }}%)</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5">
                                <div class="{{ $row['color'] }} h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Riwayat --}}
        <div class="bg-surface dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-slate-700 card-shadow overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h3 class="font-semibold text-slate-800 dark:text-slate-100">Statistik Riwayat Perawatan</h3>
            </div>
            <div class="p-5 space-y-5">
                <div class="flex justify-between items-center">
                    <span class="text-slate-600 dark:text-slate-300">Total Perawatan</span>
                    <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $this->riwayatStats['total'] }}</span>
                </div>
                <div>
                    @php $val = $this->riwayatStats['kondisi_sesudah_baik']; $pct = $this->riwayatStats['total'] > 0 ? round(($val / $this->riwayatStats['total']) * 100, 1) : 0; @endphp
                    <div class="flex justify-between text-sm mb-1">
                        <span class="flex items-center gap-2 text-slate-600 dark:text-slate-300"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Sesudah Baik</span>
                        <span class="font-medium text-slate-700 dark:text-slate-200">{{ $val }} ({{ $pct }}%)</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5">
                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
