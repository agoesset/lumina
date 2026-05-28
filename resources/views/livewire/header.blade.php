<header 
    class="bg-surface/80 dark:bg-surface-dark/80 backdrop-blur-lg border-b border-slate-200 dark:border-slate-700 sticky top-0 z-40"
    x-data="{ userOpen: false, notifOpen: false }"
>
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="flex justify-between items-center h-16">
            <!-- Left: Mobile menu toggle + Brand -->
            <div class="flex items-center gap-3">
                <button 
                    @click="$dispatch('toggle-mobile-sidebar')"
                    class="lg:hidden p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                    aria-label="Toggle navigation"
                >
                    <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-lg shadow-primary-500/25 group-hover:shadow-primary-500/40 transition-shadow">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent">Sistem Lumina</h1>
                        <p class="text-[10px] text-slate-400 -mt-0.5 font-medium tracking-wide">MANAJEMEN FASILITAS IBADAH</p>
                    </div>
                </a>
            </div>
            
            <!-- Right: Actions -->
            <div class="flex items-center gap-2">
                
                <!-- User Dropdown -->
                <div class="relative">
                    <button 
                        @click="userOpen = !userOpen" 
                        @click.away="userOpen = false"
                        class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                    >
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white text-sm font-bold shadow-md">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-slate-400 leading-tight">{{ str_replace('-', ' ', auth()->user()->role) }}</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div 
                        x-show="userOpen" 
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 bg-surface dark:bg-surface-dark rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 py-2 z-50"
                        x-cloak
                    >
                        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700">
                            <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <button wire:click="logout" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
