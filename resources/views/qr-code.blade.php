<x-app-layout>
    <x-slot name="title">
        QR Code Akses Ruang Server - Pupuk Kujang
    </x-slot>

    <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-6 bg-[#F8FAF9] dark:bg-[#030504] transition-colors duration-200">
        
        <!-- Tombol Switch Dark / Light Mode (Pojok Kanan Atas) -->
        <div class="absolute top-5 right-5 z-20">
            <button type="button" 
                    onclick="document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');"
                    class="w-10 h-10 flex items-center justify-center rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#060a07] text-slate-600 dark:text-slate-300 hover:border-emerald-500 hover:text-[#087f3f] dark:hover:text-[#16c968] transition cursor-pointer shadow-sm"
                    title="Ganti Mode Tampilan">
                <!-- Ikon Bulan (Tampil saat Light Mode) -->
                <svg class="w-4 h-4 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <!-- Ikon Matahari (Tampil saat Dark Mode) -->
                <svg class="w-4 h-4 hidden dark:block text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
        </div>

        <!-- Kartu Utama QR Code -->
        <div class="w-full max-w-md bg-white dark:bg-[#060a07] border border-slate-200/80 dark:border-[#193521] rounded-3xl p-6 sm:p-8 shadow-xl text-center space-y-6">
            
            <!-- 1. Logo Perusahaan di Atas QR Code -->
            <div class="flex items-center justify-center gap-3">
                <img src="{{ asset('images/logo_pkc_light.png') }}" 
                     alt="Logo Pupuk Kujang" 
                     class="h-11 w-auto object-contain flex-shrink-0"
                     onerror="this.style.display='none'">
                <div class="text-left">
                    <h2 class="text-base font-extrabold text-slate-900 dark:text-white leading-tight">
                        Pupuk Kujang
                    </h2>
                    <p class="text-[9px] font-extrabold text-amber-500 uppercase tracking-wider">
                        Infrastructure Security
                    </p>
                </div>
            </div>

            <!-- Petunjuk Singkat -->
            <p class="text-[10px] font-extrabold text-[#087f3f] dark:text-[#16c968] uppercase tracking-wider">
                Scan QR Code Untuk Membuka Form Akses
            </p>

            <!-- 2. QR Code Box -->
            <div class="flex justify-center items-center p-4 bg-white rounded-2xl border border-slate-200 dark:border-slate-800 shadow-inner w-fit mx-auto">
                <div class="w-64 h-64 flex items-center justify-center [&>svg]:w-full [&>svg]:h-full">
                    {!! $qrCode !!}
                </div>
            </div>

            <!-- 3. Tulisan QR Akses Ruang Server di Bawah QR -->
            <div class="space-y-1">
                <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                    QR Akses Ruang Server
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Arahkan kamera smartphone ke QR Code di atas.
                </p>
            </div>

            <!-- 4. Status Pill Minimalis & Elegan -->
            <div class="flex items-center justify-center gap-2 text-xs">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="font-semibold text-slate-700 dark:text-slate-200">Berlaku hingga 23:59 WIB</span>
                <span class="text-slate-400 text-[10px]">(Reset harian 00.00)</span>
            </div>

            <!-- Tanggal Status -->
            <div class="pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-center gap-2 text-[11px] font-semibold text-slate-400 dark:text-slate-500">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}</span>
            </div>

        </div>
    </div>
</x-app-layout>