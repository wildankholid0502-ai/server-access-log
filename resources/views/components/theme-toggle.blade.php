<div x-data="{
    isDark: document.documentElement.classList.contains('dark'),
    toggleTheme() {
        this.isDark = !this.isDark;
        if (this.isDark) {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        }
    }
}" {{ $attributes }}>
    <button @click="toggleTheme()" 
            type="button" 
            aria-label="Toggle theme"
            class="p-2.5 rounded-xl bg-white/80 dark:bg-slate-800/80 backdrop-blur border border-gray-200 dark:border-slate-700/70 text-gray-600 dark:text-amber-400 hover:bg-gray-100 dark:hover:bg-slate-700 shadow-sm transition duration-150 focus:outline-none">
        <!-- Sun Icon (Tampil saat Dark Mode) -->
        <svg x-show="isDark" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <!-- Moon Icon (Tampil saat Light Mode) -->
        <svg x-show="!isDark" class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
    </button>
</div>