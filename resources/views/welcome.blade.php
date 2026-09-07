<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server Access Log - Pupuk Kujang</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_pkc_light.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_pkc_light.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen bg-[#F8FAF9] dark:bg-[#030504] text-slate-800 dark:text-slate-100 flex flex-col justify-between transition-colors duration-200">

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
    </header>

    <!-- Area Konten Utama -->
    <main class="flex-1 flex flex-col items-center justify-center px-4 py-10 sm:py-14">

        <!-- Kartu Putih Menu Akses -->
        <div class="w-full max-w-[420px] bg-white dark:bg-[#060a07] border border-slate-200/80 dark:border-[#193521] rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-200/40 dark:shadow-none space-y-6 text-center">
            
            <!-- Logo Perusahaan di Dalam Kartu -->
            <div class="flex justify-center -mt-1 mb-2">
                <img src="{{ asset('images/logo_pkc_light.png') }}" 
                     alt="Logo Pupuk Kujang" 
                     class="h-16 w-auto object-contain"
                     onerror="this.style.display='none'">
            </div>

            <!-- Identitas Card -->
            <div class="space-y-1">
                <h3 class="text-lg font-black text-slate-900 dark:text-white">
                    Pupuk Kujang Cikampek
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Pilih akses masuk untuk mengelola data atau scan perizinan masuk ruang server.
                </p>
            </div>

            <!-- Tombol Navigasi / Aksi -->
            <div class="pt-2 flex flex-col sm:flex-row gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="w-full py-2.5 px-4 bg-[#087f3f] hover:bg-[#066833] text-white font-bold text-xs rounded-xl shadow-sm hover:shadow transition duration-150 text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Buka Dashboard</span>
                    </a>
                @else
                    <!-- Tombol Log in -->
                    <a href="{{ route('login') }}" 
                       class="w-full py-2.5 px-4 bg-[#087f3f] hover:bg-[#066833] text-white font-bold text-xs rounded-xl shadow-sm hover:shadow transition duration-150 text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Log in</span>
                    </a>

                    <!-- Tombol Register (Jika rute tersedia) -->
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="w-full py-2.5 px-4 bg-slate-50 dark:bg-[#040805] hover:bg-slate-100 dark:hover:bg-slate-900 border border-slate-200 dark:border-[#193521] text-slate-700 dark:text-slate-200 font-bold text-xs rounded-xl transition duration-150 text-center flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span>Register</span>
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Footer Teks Bawah -->
        <p class="mt-8 text-[11px] text-slate-400 dark:text-slate-500 tracking-wide font-medium">
            Create by Teknologi Informasi • Pupuk Kujang Cikampek
        </p>
    </main>

</body>
</html>