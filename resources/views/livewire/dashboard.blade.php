<div class="animate-fade-in space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Dashboard</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Ringkasan data fasilitas ibadah</p>
        </div>
        <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700">
            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total -->
        <div class="bg-surface dark:bg-surface-dark rounded-2xl p-5 border border-slate-200 dark:border-slate-700 card-shadow hover:card-shadow-hover transition-all duration-300 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Fasilitas</p>
                    <p class="text-3xl font-bold text-slate-800 dark:text-white mt-1 group-hover:text-primary-600 transition-colors">{{ $totalFasilitas }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-1 text-xs text-primary-600">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span class="font-medium">Data lengkap tersedia</span>
            </div>
        </div>

        <!-- Baik -->
        <div class="bg-surface dark:bg-surface-dark rounded-2xl p-5 border border-slate-200 dark:border-slate-700 card-shadow hover:card-shadow-hover transition-all duration-300 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kondisi Baik</p>
                    <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $kondisiBaik }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5">
                <div class="bg-emerald-500 h-1.5 rounded-full transition-all" style="width: {{ $totalFasilitas > 0 ? ($kondisiBaik / $totalFasilitas * 100) : 0 }}%"></div>
            </div>
        </div>

        <!-- Perlu Perhatian -->
        <div class="bg-surface dark:bg-surface-dark rounded-2xl p-5 border border-slate-200 dark:border-slate-700 card-shadow hover:card-shadow-hover transition-all duration-300 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Perlu Perhatian</p>
                    <p class="text-3xl font-bold text-amber-600 mt-1">{{ $perluPerawatan + $perluDicuci + $rusak }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex gap-2 text-[10px]">
                <span class="px-1.5 py-0.5 rounded-md bg-amber-100 dark:bg-amber-900/30 text-amber-700">{{ $perluPerawatan }} perawatan</span>
                <span class="px-1.5 py-0.5 rounded-md bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700">{{ $perluDicuci }} cuci</span>
                <span class="px-1.5 py-0.5 rounded-md bg-red-100 dark:bg-red-900/30 text-red-700">{{ $rusak }} rusak</span>
            </div>
        </div>

        <!-- Jadwal -->
        <div class="bg-surface dark:bg-surface-dark rounded-2xl p-5 border border-slate-200 dark:border-slate-700 card-shadow hover:card-shadow-hover transition-all duration-300 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Jadwal Minggu Ini</p>
                    <p class="text-3xl font-bold text-primary-600 mt-1">{{ $jadwalMingguIni }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-1 text-xs">
                <span class="w-2 h-2 rounded-full {{ $jadwalHariIni > 0 ? 'bg-primary-500 animate-pulse' : 'bg-slate-300' }}"></span>
                <span class="text-slate-500 dark:text-slate-400">{{ $jadwalHariIni }} hari ini</span>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Donut Chart -->
        <div class="bg-surface dark:bg-surface-dark rounded-2xl p-6 border border-slate-200 dark:border-slate-700 card-shadow">
            <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-4">Distribusi Kondisi Fasilitas</h3>
            <div class="relative h-64">
                <canvas id="kondisiChart"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-2">
                @foreach(['Baik' => ['count' => $kondisiBaik, 'color' => 'bg-emerald-500'], 'Perlu Perawatan' => ['count' => $perluPerawatan, 'color' => 'bg-amber-500'], 'Perlu Dicuci' => ['count' => $perluDicuci, 'color' => 'bg-yellow-500'], 'Rusak' => ['count' => $rusak, 'color' => 'bg-red-500']] as $label => $data)
                <div class="flex items-center gap-2 text-xs">
                    <span class="w-2.5 h-2.5 rounded-full {{ $data['color'] }}"></span>
                    <span class="text-slate-600 dark:text-slate-400">{{ $label }}</span>
                    <span class="ml-auto font-bold text-slate-800 dark:text-white">{{ $data['count'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Facilities -->
        <div class="bg-surface dark:bg-surface-dark rounded-2xl p-6 border border-slate-200 dark:border-slate-700 card-shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-800 dark:text-white">Fasilitas Terbaru</h3>
                <a href="{{ route('fasilitas') }}" class="text-xs font-medium text-primary-600 hover:text-primary-700 transition-colors">Lihat Semua &rarr;</a>
            </div>
            <div class="space-y-3">
                @foreach($fasilitasTerbaru as $f)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:border-primary-200 dark:hover:border-primary-800 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/50 dark:to-primary-800/30 flex items-center justify-center shrink-0">
                        <span class="text-sm font-bold text-primary-700 dark:text-primary-300">{{ substr($f->nama, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-800 dark:text-white truncate">{{ $f->nama }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $f->kategori }} &middot; {{ $f->lokasi }}</p>
                    </div>
                    @php
                        $badgeColors = ['baik' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300', 'perlu-perawatan' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300', 'rusak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300', 'perlu-dicuci' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300'];
                        $badgeLabels = ['baik' => 'Baik', 'perlu-perawatan' => 'Perawatan', 'rusak' => 'Rusak', 'perlu-dicuci' => 'Cuci'];
                    @endphp
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $badgeColors[$f->kondisi] }}">{{ $badgeLabels[$f->kondisi] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Upcoming Schedule -->
        <div class="bg-surface dark:bg-surface-dark rounded-2xl p-6 border border-slate-200 dark:border-slate-700 card-shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-800 dark:text-white">Jadwal Mendatang</h3>
                <a href="{{ route('jadwal-perawatan') }}" class="text-xs font-medium text-primary-600 hover:text-primary-700 transition-colors">Lihat Semua &rarr;</a>
            </div>
            <div class="space-y-3">
                @forelse($jadwalMendatang as $j)
                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/30 dark:to-primary-800/20 flex flex-col items-center justify-center shrink-0 border border-primary-100 dark:border-primary-800/30">
                        <span class="text-[10px] font-bold text-primary-600 dark:text-primary-400 uppercase">{{ $j->tanggal->format('M') }}</span>
                        <span class="text-lg font-bold text-primary-700 dark:text-primary-300 leading-none">{{ $j->tanggal->format('d') }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-800 dark:text-white truncate">{{ $j->fasilitas->nama }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $j->catatan ?? 'Tanpa catatan' }}</p>
                        <div class="flex items-center gap-2 mt-1.5">
                            @php
                                $statusColors = ['belum-dimulai' => 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300', 'sedang-berlangsung' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300', 'selesai' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300'];
                                $statusLabels = ['belum-dimulai' => 'Belum', 'sedang-berlangsung' => 'Berlangsung', 'selesai' => 'Selesai'];
                                $freqColors = ['harian' => 'bg-purple-100 text-purple-700', 'mingguan' => 'bg-indigo-100 text-indigo-700', 'bulanan' => 'bg-pink-100 text-pink-700'];
                            @endphp
                            <span class="px-1.5 py-0.5 rounded-md text-[10px] font-medium {{ $statusColors[$j->status] }}">{{ $statusLabels[$j->status] }}</span>
                            <span class="px-1.5 py-0.5 rounded-md text-[10px] font-medium {{ $freqColors[$j->frekuensi] ?? 'bg-slate-100 text-slate-600' }}">{{ ucfirst($j->frekuensi) }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Tidak ada jadwal mendatang</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('kondisiChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($kondisiData['labels']),
                datasets: [{
                    data: @json($kondisiData['data']),
                    backgroundColor: @json($kondisiData['colors']),
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { size: 13, family: 'Inter' },
                        bodyFont: { size: 13, family: 'Inter' }
                    }
                }
            }
        });
    }
});
</script>
