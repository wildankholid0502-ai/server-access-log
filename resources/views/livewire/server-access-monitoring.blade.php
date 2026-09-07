<!-- Tambahan: fixed inset-0 z-50 overflow-hidden untuk memaksa full-screen dan menutup gap bawaan Laravel -->
<div x-data="{ 
        sidebarOpen: localStorage.getItem('sidebarOpen') !== null 
            ? localStorage.getItem('sidebarOpen') === 'true' 
            : true,
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        }
     }" 
     class="fixed inset-0 z-50 overflow-hidden bg-[#f3f8f4] dark:bg-[#030504] text-slate-800 dark:text-slate-100 flex font-sans transition-colors duration-200">
    
    <!-- ================= SIDEBAR KIRI (Smooth Mini Sidebar) ================= -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-[76px]'"
           class="bg-white dark:bg-[#060a07] border-r border-slate-200/80 dark:border-[#193521] flex flex-col justify-between py-5 sticky top-0 h-screen z-30 flex-shrink-0 transition-all duration-300 ease-in-out select-none">
        
        <div class="space-y-7">
            <!-- Brand Logo & Name (Fixed Position, Smooth Text Fade) -->
            <div class="flex items-center px-4 h-11 overflow-hidden">
                <!-- Logo Box (Ukuran & Posisi Terkunci) -->
                <div class="w-11 h-11 flex-shrink-0 flex items-center justify-center">
                    <img src="{{ asset('images/logo_pkc_light.png') }}" 
                         alt="Logo Pupuk Kujang" 
                         class="h-9 w-auto object-contain transition-transform duration-300"
                         onerror="this.style.display='none'">
                </div>

                <!-- Teks Pupuk Kujang (Menyusut Halus Tanpa Menggeser Logo) -->
                <div class="ml-3 overflow-hidden transition-all duration-300 whitespace-nowrap"
                     :class="sidebarOpen ? 'max-w-[160px] opacity-100' : 'max-w-0 opacity-0 pointer-events-none'">
                    <h1 class="text-sm font-extrabold text-slate-900 dark:text-white leading-tight">
                        Pupuk Kujang
                    </h1>
                    <p class="text-[8px] font-extrabold text-amber-500 uppercase tracking-wider">
                        Infrastructure Security
                    </p>
                </div>
            </div>

            <!-- Menu Navigation -->
            <div class="space-y-1.5 px-3">
                <!-- Label Menu -->
                <div class="overflow-hidden transition-all duration-300 whitespace-nowrap px-2"
                     :class="sidebarOpen ? 'max-h-6 opacity-100 mb-2' : 'max-h-0 opacity-0 mb-0'">
                    <p class="text-[10px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        Admin Panel
                    </p>
                </div>

                <!-- Dashboard Menu (Active) -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center h-11 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/80 dark:border-emerald-800/40 text-[#087f3f] dark:text-[#16c968] font-bold text-xs transition duration-200 px-3 group"
                   title="Dashboard">
                    <div class="w-6 flex-shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </div>
                    <span class="ml-3 overflow-hidden transition-all duration-300 whitespace-nowrap"
                          :class="sidebarOpen ? 'max-w-[140px] opacity-100' : 'max-w-0 opacity-0'">
                        Dashboard
                    </span>
                </a>

                <!-- QR Akses Menu -->
                <a href="{{ url('/qr-code') }}" 
                   class="flex items-center h-11 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 font-semibold text-xs transition duration-200 px-3 group"
                   title="QR Akses">
                    <div class="w-6 flex-shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <span class="ml-3 overflow-hidden transition-all duration-300 whitespace-nowrap"
                          :class="sidebarOpen ? 'max-w-[140px] opacity-100' : 'max-w-0 opacity-0'">
                        QR Akses
                    </span>
                </a>
            </div>
        </div>

        <!-- Profil User Bawah Sidebar (Posisi Terkunci & Diam seperti Logo) -->
        <div x-data="{ profileMenuOpen: false }" 
             @click.outside="profileMenuOpen = false"
             class="pt-4 border-t border-slate-200/80 dark:border-[#193521] px-4 h-16 relative flex items-center select-none overflow-visible">
            
            <div class="flex items-center w-full h-11">
                <!-- Avatar Box (Ukuran & Posisi Terkunci Diam Persis Logo) -->
                <div @click="if(!sidebarOpen) profileMenuOpen = !profileMenuOpen"
                     :class="!sidebarOpen ? 'cursor-pointer hover:ring-2 hover:ring-emerald-500/50' : ''"
                     class="w-11 h-11 flex-shrink-0 flex items-center justify-center rounded-xl transition">
                    <div class="w-9 h-9 rounded-full bg-[#087f3f] text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->username ?? auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                </div>

                <!-- Nama Username (Menyusut Halus Tanpa Menggeser Avatar) -->
                <div class="ml-3 overflow-hidden transition-all duration-300 whitespace-nowrap min-w-0 flex-1"
                     :class="sidebarOpen ? 'max-w-[100px] opacity-100' : 'max-w-0 opacity-0 pointer-events-none'">
                    <p class="text-xs font-bold text-slate-900 dark:text-white truncate" 
                       title="{{ auth()->user()->username ?? auth()->user()->name }}">
                        {{ auth()->user()->username ?? auth()->user()->name ?? 'User' }}
                    </p>
                </div>

                <!-- Tombol Logout (Tampil Saat Sidebar Terbuka) -->
                <div class="overflow-hidden transition-all duration-300 flex-shrink-0"
                     :class="sidebarOpen ? 'max-w-[32px] opacity-100' : 'max-w-0 opacity-0 pointer-events-none'">
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" 
                                title="Keluar / Log Out" 
                                class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Popover Menu Logout (Muncul Mengambang saat Mini Sidebar & Avatar Diklik) -->
            <div x-show="profileMenuOpen && !sidebarOpen" 
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 translate-x-2"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-2"
                 class="absolute left-full bottom-3 ml-3 w-48 bg-white dark:bg-[#0a100c] border border-slate-200 dark:border-[#193521] rounded-2xl shadow-xl p-2 z-50">
                
                <div class="px-3 py-2 border-b border-slate-100 dark:border-slate-800">
                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Akun Aktif</p>
                    <p class="text-xs font-bold text-slate-900 dark:text-white truncate">
                        {{ auth()->user()->username ?? auth()->user()->name ?? 'User' }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0 pt-1">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition cursor-pointer">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Keluar / Log Out</span>
                    </button>
                </form>
            </div>

        </div>
    </aside>

    <!-- ================= KONTEN UTAMA ================= -->
    <div class="flex-1 flex flex-col min-w-0 h-screen">
        
        <!-- Header Tunggal Dashboard -->
        <header class="h-[74px] flex-shrink-0 bg-white dark:bg-[#060a07] border-b border-slate-200/80 dark:border-[#193521] px-6 sm:px-8 flex items-center justify-between sticky top-0 z-20 transition-colors duration-200">
            <div class="flex items-center gap-4">
                <!-- Tombol Toggle Sidebar -->
                <button type="button" 
                        @click="toggleSidebar()"
                        class="w-9 h-9 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-[#0a100c] text-slate-600 dark:text-slate-300 hover:border-emerald-500 transition cursor-pointer shadow-sm"
                        title="Tampilkan / Sembunyikan Sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <!-- Bingkai jendela -->
                        <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="2" />
                        <!-- Garis pembatas sidebar kiri -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v18" />
                        
                        <!-- Panah < di kolom kanan saat sidebar terbuka -->
                        <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 9l-3 3 3 3" />
                        
                        <!-- Panah > di kolom kanan saat sidebar tertutup -->
                        <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9l3 3-3 3" style="display: none;" />
                    </svg>
                </button>

                <div>
                    <h2 class="text-lg font-black text-slate-900 dark:text-white">Dashboard</h2>
                </div>
            </div>

            <!-- Sisi Kanan: Status & Tombol Mode Tampilan -->
            <div class="flex items-center gap-3">
                

                <!-- Tombol Switch Mode (Dark / Light) -->
                <button type="button" 
                        onclick="document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');"
                        class="w-9 h-9 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-[#0a100c] text-slate-600 dark:text-slate-300 hover:border-emerald-500 transition cursor-pointer shadow-sm"
                        title="Ganti mode tampilan">
                    <svg class="w-4 h-4 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg class="w-4 h-4 hidden dark:block text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>
        </header>

        <!-- Area Isi Dashboard -->
        <main class="p-6 sm:p-8 space-y-6 flex-1 overflow-y-auto">

            <!-- ================= 3 KARTU STATISTIK ================= -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Total Akses -->
                <div class="bg-white dark:bg-[#0a100c] border border-slate-200/80 dark:border-[#193521] p-5 rounded-2xl shadow-sm flex items-start justify-between">
                    <div>
                        <p class="text-[10px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                            Total Akses
                        </p>
                        <h4 class="text-3xl font-black text-slate-900 dark:text-white mt-3 font-mono">
                            {{ $totalAccess }}
                        </h4>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-[#087f3f] dark:text-[#16c968] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                </div>

                <!-- Akses Hari Ini -->
                <div class="bg-white dark:bg-[#0a100c] border border-slate-200/80 dark:border-[#193521] p-5 rounded-2xl shadow-sm flex items-start justify-between">
                    <div>
                        <p class="text-[10px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                            Akses Hari Ini
                        </p>
                        <h4 class="text-3xl font-black text-slate-900 dark:text-white mt-3 font-mono">
                            {{ $todayAccess }}
                        </h4>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-[#087f3f] dark:text-[#16c968] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <!-- Akses Bulan Ini -->
                <div class="bg-white dark:bg-[#0a100c] border border-slate-200/80 dark:border-[#193521] p-5 rounded-2xl shadow-sm flex items-start justify-between">
                    <div>
                        <p class="text-[10px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                            Akses Bulan Ini
                        </p>
                        <h4 class="text-3xl font-black text-slate-900 dark:text-white mt-3 font-mono">
                            {{ $monthAccess }}
                        </h4>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-[#087f3f] dark:text-[#16c968] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- ================= KARTU FILTER DATA AKSES ================= -->
            <div class="bg-white dark:bg-[#0a100c] border border-slate-200/80 dark:border-[#193521] p-6 rounded-2xl shadow-sm space-y-5">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-black text-slate-900 dark:text-white">Filter Data Akses</h4>
                        <p class="text-xs text-slate-400 mt-0.5">
                            Cari nama, departemen, pendamping, tujuan, atau gunakan rentang tanggal.
                        </p>
                    </div>

                    @if(!empty($search) || !empty($selectedCategory) || !empty($startDate) || !empty($endDate))
                        <button type="button" 
                                wire:click="resetFilters" 
                                class="text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline cursor-pointer">
                            Reset Filter
                        </button>
                    @endif
                </div>

                <!-- Input Filter Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Cari Data -->
                    <div>
                        <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                            Cari Data
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input type="text" 
                                   wire:model.live.debounce.400ms="search" 
                                   placeholder="Nama, Departemen..."
                                   class="w-full pl-9 pr-3.5 py-2 bg-[#fbfdfc] dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 focus:border-[#087f3f] focus:outline-none transition">
                        </div>
                    </div>

                    <!-- Filter Tujuan -->
                    <div>
                        <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                            Filter Tujuan
                        </label>
                        <select wire:model.live="selectedCategory"
                                class="w-full px-3 py-2 bg-[#fbfdfc] dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 focus:border-[#087f3f] focus:outline-none transition cursor-pointer">
                            <option value="">Semua Tujuan</option>
                            <option value="Kunjungan">Kunjungan</option>
                            <option value="Maintenance Rutin">Maintenance Rutin</option>
                            <option value="Insidental">Insidental</option>
                        </select>
                    </div>

                    <!-- Dari Tanggal -->
                    <div>
                        <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                            Dari Tanggal
                        </label>
                        <input type="date" 
                               wire:model.live="startDate"
                               class="w-full px-3 py-2 bg-[#fbfdfc] dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 focus:border-[#087f3f] focus:outline-none transition cursor-pointer">
                    </div>

                    <!-- Sampai Tanggal -->
                    <div>
                        <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                            Sampai Tanggal
                        </label>
                        <input type="date" 
                               wire:model.live="endDate"
                               class="w-full px-3 py-2 bg-[#fbfdfc] dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 focus:border-[#087f3f] focus:outline-none transition cursor-pointer">
                    </div>
                </div>

                <!-- Tombol Export CSV & PDF di Bawah Filter -->
                <div class="flex items-center justify-center gap-3 pt-2">
                    <a href="{{ route('access-logs.export', ['search' => $search, 'category' => $selectedCategory, 'start_date' => $startDate, 'end_date' => $endDate]) }}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl border border-[#087f3f] text-[#087f3f] dark:text-[#16c968] font-extrabold text-xs hover:bg-[#087f3f]/10 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Export CSV</span>
                    </a>

                    <a href="{{ route('access-logs.export-pdf', ['search' => $search, 'category' => $selectedCategory, 'start_date' => $startDate, 'end_date' => $endDate]) }}"
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl border border-rose-600 dark:border-rose-500 text-rose-600 dark:text-rose-400 font-extrabold text-xs hover:bg-rose-50 dark:hover:bg-rose-950/30 transition shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Export PDF</span>
                    </a>
                </div>
            </div>

            <!-- ================= TABEL LOG AKSES ================= -->
            <div class="bg-white dark:bg-[#0a100c] border border-slate-200/80 dark:border-[#193521] rounded-2xl shadow-sm p-6 space-y-4">
                <div>
                    <h4 class="text-sm font-black text-slate-900 dark:text-white">Log Akses</h4>
                    <p class="text-xs text-slate-400 mt-0.5">
                        {{ $logs->total() }} data ditampilkan
                    </p>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#070c09]">
                <!-- table-fixed mengunci lebar kolom agar tidak auto-geser -->
                <table class="w-full text-left text-xs border-collapse table-fixed min-w-[950px]">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-slate-800 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500 bg-slate-50/50 dark:bg-slate-900/40">
                            <!-- Pembagian porsi lebar kolom yang terkunci -->
                            <th class="py-3.5 px-3 w-[45px] text-center">No</th>
                            <th class="py-3.5 px-3 w-[95px]">Tanggal</th>
                            <th class="py-3.5 px-3 w-[80px]">Jam</th>
                            <th class="py-3.5 px-3 w-[110px]">No. Tiket</th>
                            <th class="py-3.5 px-3 w-[150px]">Nama</th>
                            <th class="py-3.5 px-3 w-[120px]">Departemen</th>
                            <th class="py-3.5 px-3 w-[130px]">Pendamping</th>
                            <th class="py-3.5 px-3 w-[290px]">Tujuan & Hasil Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60">
                        @forelse($logs as $index => $log)
                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-900/30 transition align-top">
                                <!-- 1. No -->
                                <td class="py-3.5 px-3 text-center text-slate-400 font-mono text-[11px]">
                                    {{ $logs->firstItem() + $index }}
                                </td>

                                <!-- 2. Tanggal -->
                                <td class="py-3.5 px-3 text-slate-600 dark:text-slate-300 font-medium whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($log->logged_at ?? $log->created_at)->format('d/m/Y') }}
                                </td>

                                <!-- 3. Jam -->
                                <td class="py-3.5 px-3 font-bold text-[#087f3f] dark:text-[#16c968] font-mono whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($log->logged_at ?? $log->created_at)->format('H:i:s') }}
                                </td>

                                <!-- 4. No Tiket -->
                                <td class="py-3.5 px-3">
                                    @if($log->ticket_number)
                                        <span class="inline-block px-2 py-0.5 rounded-md bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/50 font-mono text-[10px] font-bold text-[#087f3f] dark:text-[#16c968] truncate max-w-full" title="{{ $log->ticket_number }}">
                                            #{{ $log->ticket_number }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 dark:text-slate-600 font-mono">-</span>
                                    @endif
                                </td>

                                <!-- 5. Nama Pengunjung (Wrap kata panjang jika ada) -->
                                <td class="py-3.5 px-3 font-bold text-slate-900 dark:text-white capitalize break-words leading-relaxed">
                                    {{ $log->visitor_name }}
                                </td>

                                <!-- 6. Departemen -->
                                <td class="py-3.5 px-3 text-slate-600 dark:text-slate-400 uppercase font-medium break-words leading-relaxed">
                                    {{ $log->department }}
                                </td>

                                <!-- 7. Pendamping -->
                                <td class="py-3.5 px-3 text-slate-600 dark:text-slate-400 break-words leading-relaxed">
                                    {{ $log->escort_name }}
                                </td>

                                <!-- 8. Tujuan & Hasil Pemeriksaan -->
                                <td class="py-3.5 px-3">
                                    <div class="space-y-1.5 break-words">
                                        @if($log->category === 'Maintenance Rutin')
                                            <div>
                                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20">
                                                    Maintenance Rutin
                                                </span>
                                            </div>

                                            <!-- Box Metrik Kompak & Rapat -->
                                            <div class="p-2 rounded-lg bg-slate-50 dark:bg-[#040805] border border-slate-200/80 dark:border-slate-800 text-[10px] space-y-1 font-mono w-fit">
                                                <div class="text-emerald-700 dark:text-emerald-400 font-bold border-b border-slate-200 dark:border-slate-800 pb-0.5">
                                                    Ruang: {{ $log->temp_room ?? '-' }}°C | {{ $log->hum_room ?? '-' }}%
                                                </div>
                                                <div class="grid grid-cols-2 gap-x-2.5 gap-y-0.5 text-slate-600 dark:text-slate-400 text-[9px]">
                                                    <div>R1: {{ $log->temp_rack_1 ?? '-' }}°C / {{ $log->hum_rack_1 ?? '-' }}%</div>
                                                    <div>R2: {{ $log->temp_rack_2 ?? '-' }}°C / {{ $log->hum_rack_2 ?? '-' }}%</div>
                                                    <div>R3: {{ $log->temp_rack_3 ?? '-' }}°C / {{ $log->hum_rack_3 ?? '-' }}%</div>
                                                    <div>R4: {{ $log->temp_rack_4 ?? '-' }}°C / {{ $log->hum_rack_4 ?? '-' }}%</div>
                                                    <div>R5: {{ $log->temp_rack_5 ?? '-' }}°C / {{ $log->hum_rack_5 ?? '-' }}%</div>
                                                    <div>R6: {{ $log->temp_rack_6 ?? '-' }}°C / {{ $log->hum_rack_6 ?? '-' }}%</div>
                                                </div>
                                            </div>

                                            @if($log->visual_check)
                                                <div class="text-[10px] text-slate-600 dark:text-slate-300 leading-normal">
                                                    <span class="font-bold text-slate-400">Visual:</span> "{{ $log->visual_check }}"
                                                </div>
                                            @endif

                                            @if($log->notes)
                                                <div class="text-[10px] text-slate-500 dark:text-slate-400 italic leading-normal">
                                                    <span class="font-bold not-italic">Ket:</span> "{{ $log->notes }}"
                                                </div>
                                            @endif

                                        @elseif($log->category === 'Insidental')
                                            <div>
                                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-500/20">
                                                    Insidental
                                                </span>
                                            </div>
                                            @if($log->notes)
                                                <div class="text-[10px] text-slate-500 dark:text-slate-400 italic leading-normal mt-0.5">
                                                    "{{ $log->notes }}"
                                                </div>
                                            @endif

                                        @else
                                            <div>
                                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-500/10 text-[#087f3f] dark:text-[#16c968] border border-emerald-200 dark:border-emerald-500/20">
                                                    Kunjungan
                                                </span>
                                            </div>
                                            @if($log->notes)
                                                <div class="text-[10px] text-slate-500 dark:text-slate-400 italic leading-normal mt-0.5">
                                                    "{{ $log->notes }}"
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-slate-400 text-xs">
                                    Tidak ada data log akses yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

                <!-- Navigasi Pagination -->
                <div class="pt-3">
                    {{ $logs->links() }}
                </div>
            </div>
        </main>
    </div>
</div>