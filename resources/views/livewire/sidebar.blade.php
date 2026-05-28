@php
$menuGroups = [
    'Utama' => [
        ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>'],
    ],
    'Master Data' => [
        ['route' => 'fasilitas', 'label' => 'Data Fasilitas', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>'],
        ['route' => 'monitoring-kebersihan', 'label' => 'Monitoring', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
        ['route' => 'jadwal-perawatan', 'label' => 'Jadwal Perawatan', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
    ],
    'Laporan' => [
        ['route' => 'laporan-kondisi', 'label' => 'Laporan Kondisi', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'],
        ['route' => 'riwayat-perawatan', 'label' => 'Riwayat', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
        ['route' => 'laporan-rekap', 'label' => 'Rekap', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'],
    ],
    'Sistem' => [
        ['route' => 'log-aktivitas', 'label' => 'Log Aktivitas', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>'],
        ['route' => 'manajemen-pengguna', 'label' => 'Pengguna', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>'],
    ],
];
@endphp

<div>
<!-- Desktop Sidebar -->
<aside class="hidden lg:flex flex-col w-64 bg-surface dark:bg-surface-dark border-r border-slate-200 dark:border-slate-700 h-[calc(100vh-4rem)] sticky top-16">
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-6">
        @foreach($menuGroups as $groupName => $items)
        <div>
            <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">{{ $groupName }}</p>
            <ul class="space-y-0.5">
                @foreach($items as $item)
                <li>
                    <a
                        href="{{ route($item['route']) }}"
                        @class([
                            'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200',
                            'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300 shadow-sm' => request()->routeIs($item['route']),
                            'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-slate-200' => !request()->routeIs($item['route']),
                        ])
                    >
                        <span @class([
                            'flex items-center justify-center w-8 h-8 rounded-lg transition-colors',
                            'bg-primary-100 dark:bg-primary-800/50 text-primary-600 dark:text-primary-300' => request()->routeIs($item['route']),
                            'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 group-hover:bg-slate-200 dark:group-hover:bg-slate-700' => !request()->routeIs($item['route']),
                        ])>
                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                        </span>
                        {{ $item['label'] }}
                        @if(request()->routeIs($item['route']))
                        <span class="ml-auto w-1.5 h-1.5 rounded-full bg-primary-500"></span>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </nav>
    
    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-slate-200 dark:border-slate-700">
        <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl p-3 text-white shadow-lg shadow-primary-500/20">
            <p class="text-xs font-medium opacity-90">Sistem Lumina v1.0</p>
            <p class="text-[10px] opacity-70 mt-0.5">{{ now()->locale('id')->isoFormat('dddd, D MMM YYYY') }}</p>
        </div>
    </div>
</aside>

<!-- Mobile Drawer -->
<div 
    x-data="{ open: false }" 
    @toggle-mobile-sidebar.window="open = !open"
    class="lg:hidden"
>
    <!-- Backdrop -->
    <div 
        x-show="open" 
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40"
        x-cloak
    ></div>
    
    <!-- Drawer -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 w-72 bg-surface dark:bg-surface-dark border-r border-slate-200 dark:border-slate-700 z-50 shadow-2xl"
        x-cloak
    >
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="font-bold text-slate-800 dark:text-white">Sistem Lumina</span>
            </div>
            <button @click="open = false" class="p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <nav class="p-4 space-y-6 overflow-y-auto h-[calc(100vh-4rem)]">
            @foreach($menuGroups as $groupName => $items)
            <div>
                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">{{ $groupName }}</p>
                <ul class="space-y-0.5">
                    @foreach($items as $item)
                    <li>
                        <a
                            href="{{ route($item['route']) }}"
                            @click="open = false"
                            @class([
                                'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all',
                                'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' => request()->routeIs($item['route']),
                                'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' => !request()->routeIs($item['route']),
                            ])
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                            {{ $item['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </nav>
    </div>
</div>
</div>
