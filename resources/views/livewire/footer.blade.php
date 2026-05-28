<footer class="bg-surface/80 dark:bg-surface-dark/80 backdrop-blur-lg border-t border-slate-200 dark:border-slate-700">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-4">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-2">
                <div class="w-5 h-5 rounded-md bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                    </svg>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    &copy; {{ date('Y') }} <span class="font-semibold text-slate-700 dark:text-slate-300">Sistem Lumina</span>. All rights reserved.
                </p>
            </div>
            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono">v1.0.0 &middot; Laravel {{ app()->version() }}</p>
        </div>
    </div>
</footer>
