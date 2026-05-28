<div class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <!-- Decorative circles -->
    <div class="absolute top-20 left-20 w-72 h-72 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-20 w-96 h-96 bg-accent-400/10 rounded-full blur-3xl"></div>
    
    <!-- Card -->
    <div class="relative w-full max-w-md mx-4 animate-slide-up">
        <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-slate-700/50 overflow-hidden">
            <!-- Top accent bar -->
            <div class="h-1.5 bg-gradient-to-r from-primary-500 via-accent-400 to-primary-600"></div>
            
            <div class="p-8 md:p-10">
                <!-- Logo Section -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-lg shadow-primary-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Sistem Lumina</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manajemen Fasilitas Ibadah</p>
                </div>
                
                <!-- Error Message -->
                @if($error)
                <div class="mb-6 p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 flex items-start gap-2.5 animate-fade-in">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-red-700 dark:text-red-300">{{ $error }}</p>
                </div>
                @endif
                
                <!-- Form -->
                <form wire:submit="login" class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                id="email"
                                wire:model="email" 
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-all placeholder:text-slate-400"
                                placeholder="admin@masjid.com"
                                required
                            >
                        </div>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password</label>
                        <div class="relative" x-data="{ show: false }">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                :type="show ? 'text' : 'password'"
                                id="password"
                                wire:model="password" 
                                class="w-full pl-11 pr-11 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:border-primary-500 transition-all placeholder:text-slate-400"
                                placeholder="Masukkan password"
                                required
                            >
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                <svg x-show="!show" class="w-5 h-5 text-slate-400 hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="show" class="w-5 h-5 text-slate-400 hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 011.555-2.865m3.9-3.9A9.966 9.966 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.054 10.054 0 01-2.69 4.378m-3.9-3.9L12 12m0 0l-3 3m3-3l3 3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-600 dark:text-slate-400">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">Lupa password?</a>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full py-3.5 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 transition-all active:scale-[0.98] flex items-center justify-center gap-2"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Masuk ke Sistem</span>
                        <span wire:loading>Memproses...</span>
                        <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <svg wire:loading class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
                
                <!-- Demo Credentials -->
                <div class="mt-8 p-4 rounded-2xl bg-primary-50/80 dark:bg-primary-900/20 border border-primary-100 dark:border-primary-800/30">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs font-bold text-primary-800 dark:text-primary-300 uppercase tracking-wide">Demo Credentials</p>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center gap-2 p-2 rounded-lg bg-white dark:bg-slate-700/50 border border-primary-100 dark:border-slate-600">
                            <span class="w-2 h-2 rounded-full bg-primary-500"></span>
                            <span class="font-mono text-slate-700 dark:text-slate-300">admin@masjid.com</span>
                            <span class="text-slate-400">/</span>
                            <span class="font-mono text-slate-500">admin123</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 rounded-lg bg-white dark:bg-slate-700/50 border border-primary-100 dark:border-slate-600">
                            <span class="w-2 h-2 rounded-full bg-accent-500"></span>
                            <span class="font-mono text-slate-700 dark:text-slate-300">petugas@masjid.com</span>
                            <span class="text-slate-400">/</span>
                            <span class="font-mono text-slate-500">petugas123</span>
                        </div>
                        <div class="flex items-center gap-2 p-2 rounded-lg bg-white dark:bg-slate-700/50 border border-primary-100 dark:border-slate-600">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            <span class="font-mono text-slate-700 dark:text-slate-300">sistem@masjid.com</span>
                            <span class="text-slate-400">/</span>
                            <span class="font-mono text-slate-500">sistem123</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom text -->
        <p class="text-center text-xs text-white/60 mt-6">Sistem Manajemen Fasilitas Ibadah v1.0</p>
    </div>
</div>
