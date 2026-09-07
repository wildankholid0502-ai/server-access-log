<x-guest-layout>
    <x-slot name="title">
        Register Admin - Pupuk Kujang
    </x-slot>

    <div class="min-h-screen bg-[#F8FAF9] dark:bg-[#030504] text-slate-800 dark:text-slate-100 flex flex-col justify-between font-sans transition-colors duration-200">

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

        <!-- Area Konten Utama Form Register -->
        <main class="flex-1 flex flex-col items-center justify-center px-4 py-10 sm:py-14">
            
            <!-- Judul & Sub-judul Halaman -->
            <div class="text-center mb-6 space-y-1">
                <p class="text-[10px] font-extrabold text-[#087f3f] dark:text-[#16c968] uppercase tracking-widest">
                    SECURE ADMIN SYSTEM
                </p>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                    Register Admin
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Buat akun untuk mengelola sistem akses ruang server.
                </p>
            </div>

            <!-- Kartu Putih Form Register -->
            <div class="w-full max-w-[420px] bg-white dark:bg-[#060a07] border border-slate-200/80 dark:border-[#193521] rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-200/40 dark:shadow-none space-y-6">
                
                <!-- Logo di Bagian Atas Form -->
                <div class="flex justify-center -mt-1 mb-2">
                    <img src="{{ asset('images/logo_pkc_light.png') }}" 
                         alt="Logo Pupuk Kujang" 
                         class="h-16 w-auto object-contain"
                         onerror="this.style.display='none'">
                </div>

                <!-- Form Register -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Input Nama Pengguna (Username) -->
                    <div>
                        <label for="username" class="block text-[10px] font-extrabold text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1.5">
                            NAMA PENGGUNA <span class="text-rose-500">*</span>
                        </label>
                        <input id="username" 
                               type="text" 
                               name="username" 
                               value="{{ old('username') }}" 
                               required 
                               autofocus 
                               autocomplete="username" 
                               placeholder="Masukkan nama pengguna"
                               class="w-full px-3.5 py-2.5 bg-[#fbfdfc] dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:border-[#087f3f] focus:ring-1 focus:ring-[#087f3f] transition">
                        <x-input-error :messages="$errors->get('username')" class="mt-1.5" />
                    </div>

                    <!-- Input Password -->
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" 
                                id="password" 
                                name="password" 
                                required 
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="w-full pl-3.5 pr-10 py-2.5 bg-[#fbfdfc] dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 focus:border-[#087f3f] focus:outline-none transition">

                            <button type="button" 
                                    @click="show = !show" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition cursor-pointer">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                                <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-1.5">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="w-full pl-3.5 pr-10 py-2.5 bg-[#fbfdfc] dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 focus:border-[#087f3f] focus:outline-none transition">

                            <button type="button" 
                                    @click="show = !show" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition cursor-pointer">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                                <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Tombol Buat Akun Admin -->
                    <div class="pt-2">
                        <button type="submit" 
                                class="w-full py-2.5 px-4 bg-[#087f3f] hover:bg-[#066833] text-white font-bold text-xs rounded-xl shadow-sm hover:shadow transition duration-150 cursor-pointer text-center">
                            Buat Akun Admin
                        </button>
                    </div>
                </form>

                <!-- Tautan Balik ke Login -->
                <div class="pt-2 text-center border-t border-slate-100 dark:border-slate-800/80">
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Sudah memiliki akun? 
                        <a href="{{ route('login') }}" class="font-bold text-[#087f3f] dark:text-[#16c968] hover:underline">
                            Login Admin
                        </a>
                    </p>
                </div>

            </div>

            <!-- Footer Teks Bawah -->
            <p class="mt-8 text-[11px] text-slate-400 dark:text-slate-500 tracking-wide font-medium">
                Create by Teknologi Informasi • Pupuk Kujang Cikampek
            </p>
        </main>
    </div>
</x-guest-layout>