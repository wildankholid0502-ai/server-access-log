<div class="min-h-screen w-full bg-[#F8FAF9] dark:bg-[#030504] flex flex-col justify-between text-slate-800 dark:text-slate-100 relative font-sans transition-colors duration-200">
    
    <!-- Topbar Header -->
    <header class="w-full bg-white dark:bg-[#060a07] border-b border-emerald-100 dark:border-[#193521] px-6 sm:px-12 py-3.5 flex items-center justify-between sticky top-0 z-40 shadow-sm transition-colors duration-200">
        <div class="flex items-center gap-3">
            <!-- Logo Pupuk Kujang -->
            <img src="{{ asset('images/logo_pkc_light.png') }}" 
                alt="Logo Pupuk Kujang" 
                class="h-10 w-auto object-contain"
                onerror="this.style.display='none'">
            <div>
                <h1 class="text-base font-extrabold text-slate-900 dark:text-white leading-tight">
                    Pupuk Kujang
                </h1>
                <p class="text-[9px] font-extrabold text-amber-500 uppercase tracking-widest">
                    Infrastructure Security
                </p>
            </div>
        </div>

        <!-- Tombol Dark/Light Mode (Ikon SVG Dashboard) -->
        <button type="button" 
                id="themeToggleBtn"
                onclick="toggleTheme()" 
                class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-[#193521] bg-slate-50 dark:bg-[#0a100c] text-slate-600 dark:text-slate-300 hover:border-emerald-500 transition shadow-sm cursor-pointer"
                title="Ganti mode tampilan"
                aria-label="Ganti mode tampilan">
            <!-- Ikon Bulan (Aktif saat Mode Terang) -->
            <svg id="themeIconMoon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
            <!-- Ikon Matahari (Aktif saat Mode Gelap) -->
            <svg id="themeIconSun" class="w-5 h-5 hidden dark:block text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </button>
    </header>

    <!-- Area Konten Form Tengah -->
    <<!-- Area Konten Form Tengah (Background Polos Bersih) -->
<main class="flex-1 flex flex-col items-center justify-center px-4 py-8 sm:py-12 w-full bg-[#F8FAF9] dark:bg-[#030504]">
        
        <div class="w-full max-w-2xl mx-auto">
            
            @if(!$isTokenValid)
                <div class="bg-white dark:bg-[#0a100c] border border-rose-200 dark:border-rose-900/40 p-8 rounded-3xl shadow-xl text-center space-y-4">
                    <div class="w-16 h-16 bg-rose-100 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-full flex items-center justify-center mx-auto text-3xl">
                        ⚠️
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">QR Code / Tautan Kedaluwarsa</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Masa berlaku token telah habis. Silakan pindai ulang QR Code fisik terbaru di pintu ruang server.
                    </p>
                </div>
            @elseif($isSubmitted)
                <div class="bg-white dark:bg-[#0a100c] border border-emerald-200 dark:border-[#193521] p-8 rounded-3xl shadow-xl text-center space-y-4">
                    <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center mx-auto text-3xl font-bold">
                        ✓
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Akses Berhasil Dicatat</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Terima kasih! Izin akses masuk Anda ke ruang server telah berhasil dicatat di sistem monitoring.
                    </p>
                    <button wire:click="$set('isSubmitted', false)" class="mt-4 px-6 py-2.5 bg-[#087f3f] hover:bg-[#055c2c] text-white text-xs font-bold rounded-xl shadow-md transition active:scale-95">
                        Isi Formulir Baru
                    </button>
                </div>
            @else
                <!-- Header Judul Form -->
                <div class="text-center mb-6 space-y-1.5">
                    <span class="inline-block text-[11px] font-extrabold tracking-widest text-[#087f3f] dark:text-[#16c968] uppercase">
                        Secure Access System
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Formulir Akses Ruang Server
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                        Lengkapi data berikut sebelum memasuki ruang server.
                    </p>
                </div>

                <!-- Kartu Putih/Gelap Form -->
                <div class="bg-white dark:bg-[#0a100c] border border-slate-200 dark:border-[#193521] dark:border-t-2 dark:border-t-[#087f3f] rounded-3xl p-6 sm:p-9 shadow-xl shadow-slate-950/5">

                    <form wire:submit="submit" class="space-y-5">
    
                <!-- Kotak Peringatan jika ada input yang belum lengkap -->
                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900/60 text-rose-600 dark:text-rose-400 text-xs">
                        <p class="font-bold mb-1">Mohon lengkapi data berikut:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Input Nomor Tiket -->
                <div class="space-y-1.5">
                    <label for="ticket_number" class="block text-[11px] font-extrabold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                        Nomor Tiket <span class="text-amber-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="ticket_number" wire:model="ticket_number" 
                            placeholder="Masukkan Nomor Tiket"
                            class="w-full px-4 py-3 bg-slate-50 dark:bg-[#040805] border border-slate-200 dark:border-[#193521] text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 rounded-xl text-sm focus:outline-none focus:border-[#087f3f] focus:ring-1 focus:ring-[#087f3f] transition">
                    @error('ticket_number') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label for="visitor_name" class="block text-[11px] font-extrabold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                        Nama Lengkap <span class="text-amber-500">*</span>
                    </label>
                    <input type="text" id="visitor_name" wire:model="visitor_name" 
                        placeholder="Masukkan Nama Lengkap"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-[#040805] border border-slate-200 dark:border-[#193521] text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 rounded-xl text-sm focus:outline-none focus:border-[#087f3f] focus:ring-1 focus:ring-[#087f3f] transition">
                    @error('visitor_name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Departemen -->
                <div>
                    <label for="department" class="block text-[11px] font-extrabold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                        Departemen <span class="text-amber-500">*</span>
                    </label>
                    <input type="text" id="department" wire:model="department" 
                        placeholder="Masukkan Nama Departemen"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-[#040805] border border-slate-200 dark:border-[#193521] text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 rounded-xl text-sm focus:outline-none focus:border-[#087f3f] focus:ring-1 focus:ring-[#087f3f] transition">
                    @error('department') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Pendamping -->
                <div>
                    <label for="escort_name" class="block text-[11px] font-extrabold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                        Pendamping <span class="text-amber-500">*</span>
                    </label>
                    <select id="escort_name" wire:model="escort_name"
                            class="w-full px-4 py-3 bg-slate-50 dark:bg-[#040805] border border-slate-200 dark:border-[#193521] text-slate-900 dark:text-slate-100 rounded-xl text-sm focus:outline-none focus:border-[#087f3f] focus:ring-1 focus:ring-[#087f3f] transition cursor-pointer">
                        <option value="">Pilih pendamping</option>
                        @foreach($escorts as $escort)
                            <option value="{{ $escort }}">{{ $escort }}</option>
                        @endforeach
                    </select>
                    @error('escort_name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Tujuan Akses -->
                <div class="pt-2">
                    <label for="category" class="block text-[11px] font-extrabold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                        Tujuan Akses <span class="text-amber-500">*</span>
                    </label>
                    <select id="category" wire:model.live="category"
                            class="w-full px-4 py-3 bg-slate-50 dark:bg-[#040805] border border-slate-200 dark:border-[#193521] text-slate-900 dark:text-slate-100 rounded-xl text-sm focus:outline-none focus:border-[#087f3f] focus:ring-1 focus:ring-[#087f3f] transition cursor-pointer">
                        <option value="">Pilih tujuan akses</option>
                        <option value="Kunjungan">Kunjungan</option>
                        <option value="Maintenance Rutin">Maintenance Rutin</option>
                        <option value="Insidental">Insidental</option>
                    </select>
                    @error('category') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Catatan (Kunjungan & Insidental) -->
                @if($category === 'Insidental' || $category === 'Kunjungan')
                    <div class="pt-2 transition-all duration-200">
                        <label for="notes" class="block text-[11px] font-extrabold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Catatan <span class="text-amber-500">*</span>
                        </label>
                        <textarea id="notes" wire:model="notes" rows="3" 
                                placeholder="Jelaskan keperluan akses..."
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-[#040805] border border-slate-200 dark:border-[#193521] text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-600 rounded-xl text-sm focus:outline-none focus:border-[#087f3f] focus:ring-1 focus:ring-[#087f3f] transition"></textarea>
                        @error('notes') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                @endif

                <!-- Parameter Ruang Server (Maintenance Rutin) -->
                @if($category === 'Maintenance Rutin')
                <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 dark:bg-[#0a100c] border border-slate-200 dark:border-[#193521] space-y-4">
                    <!-- Header Section -->
                    <div>
                        <h5 class="text-xs font-extrabold text-slate-900 dark:text-white flex items-center gap-1.5">
                            Pemeriksaan Suhu & Kelembaban (7 Titik)
                        </h5>
                        <p class="text-[10px] text-slate-400">Catat suhu (°C) dan kelembaban (%) pada ruangan dan masing-masing rak server.</p>
                    </div>

                    <!-- Grid Cards Suhu & Kelembaban -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        
                        <!-- 1. Suhu & Kelembaban Ruangan (1 Card Sendiri Penuh) -->
                        <div class="col-span-1 sm:col-span-2 p-3.5 bg-white dark:bg-[#040805] rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
                            <p class="text-xs font-bold text-emerald-700 dark:text-emerald-400 mb-2.5 flex items-center gap-1.5">
                                Suhu & Kelembaban Ruang Server
                            </p>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-[10px] text-slate-400 font-semibold block mb-1">Suhu (°C)</label>
                                    <input type="text" wire:model="temp_room" placeholder="" class="w-full px-3 py-2 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-[#fbfdfc] dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="text-[10px] text-slate-400 font-semibold block mb-1">Kelembaban (%)</label>
                                    <input type="text" wire:model="hum_room" placeholder="" class="w-full px-3 py-2 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-[#fbfdfc] dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                        <!-- Rak 1 & 2 -->
                        <div class="p-3.5 bg-white dark:bg-[#040805] rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Rak Server 1</p>
                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Suhu (°C)</label>
                                    <input type="text" wire:model="temp_rack_1" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Kelembaban (%)</label>
                                    <input type="text" wire:model="hum_rack_1" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                        <div class="p-3.5 bg-white dark:bg-[#040805] rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Rak Server 2</p>
                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Suhu (°C)</label>
                                    <input type="text" wire:model="temp_rack_2" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Kelembaban (%)</label>
                                    <input type="text" wire:model="hum_rack_2" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                        <!-- Rak 3 & 4 -->
                        <div class="p-3.5 bg-white dark:bg-[#040805] rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Rak Server 3</p>
                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Suhu (°C)</label>
                                    <input type="text" wire:model="temp_rack_3" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Kelembaban (%)</label>
                                    <input type="text" wire:model="hum_rack_3" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                        <div class="p-3.5 bg-white dark:bg-[#040805] rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Rak Server 4</p>
                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Suhu (°C)</label>
                                    <input type="text" wire:model="temp_rack_4" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Kelembaban (%)</label>
                                    <input type="text" wire:model="hum_rack_4" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                        <!-- Rak 5 & 6 -->
                        <div class="p-3.5 bg-white dark:bg-[#040805] rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Rak Server 5</p>
                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Suhu (°C)</label>
                                    <input type="text" wire:model="temp_rack_5" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Kelembaban (%)</label>
                                    <input type="text" wire:model="hum_rack_5" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                        <div class="p-3.5 bg-white dark:bg-[#040805] rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Rak Server 6</p>
                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Suhu (°C)</label>
                                    <input type="text" wire:model="temp_rack_6" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="text-[9px] text-slate-400 font-semibold block mb-1">Kelembaban (%)</label>
                                    <input type="text" wire:model="hum_rack_6" placeholder="" class="w-full px-2.5 py-1.5 border border-slate-200 dark:border-slate-800 rounded-lg text-xs bg-slate-50 dark:bg-black/20 focus:outline-none focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Bagian Bawah: Hasil Pemeriksaan Visual -->
                    <div class="space-y-1.5 pt-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                            Hasil Pemeriksaan Visual <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                            wire:model="visual_check" 
                            placeholder="Contoh: Lampu indikator server normal, kabel rapi, AC berfungsi baik" 
                            class="w-full px-3.5 py-2.5 bg-white dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 focus:border-[#087f3f] focus:outline-none transition">
                        @error('visual_check') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <!-- Bagian Bawah: Catatan Tambahan / Lainnya -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                            Catatan Tambahan / Lainnya <span class="text-slate-400 font-normal">(Opsional)</span>
                        </label>
                        <textarea wire:model="notes" 
                                rows="2" 
                                placeholder="Tambahkan catatan khusus jika ada temuan atau kendala..." 
                                class="w-full px-3.5 py-2 bg-white dark:bg-[#040805] border border-slate-200 dark:border-[#193521] rounded-xl text-xs text-slate-900 dark:text-slate-100 focus:border-[#087f3f] focus:outline-none transition"></textarea>
                        @error('notes') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endif

                <!-- Tombol Submit -->
                <div class="pt-3">
                    <button type="submit" 
                            class="w-full py-3.5 px-4 bg-[#087f3f] hover:bg-[#055c2c] text-white font-bold text-sm rounded-xl shadow-lg shadow-[#087f3f]/20 transition duration-150 active:scale-[0.99] cursor-pointer">
                        <span wire:loading.remove wire:target="submit">Simpan Data Akses</span>
                        <span wire:loading wire:target="submit">Menyimpan data...</span>
                    </button>
                </div>

            </form>
                </div>
            @endif

        </div>

    </main>

    <!-- Footer Bawah -->
    <footer class="w-full py-4 text-center text-[11px] text-slate-400 dark:text-[#637568] border-t border-slate-200/60 dark:border-[#193521]">
        Create by Teknologi Informasi &bull; Pupuk Kujang Cikampek
    </footer>

    <script>
    function updateThemeUI(isDark) {
        const moonIcon = document.getElementById('themeIconMoon');
        const sunIcon = document.getElementById('themeIconSun');

        if (isDark) {
            document.documentElement.classList.add('dark');
            document.body.classList.remove('light');
            if (moonIcon) moonIcon.classList.add('hidden');
            if (sunIcon) sunIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            document.body.classList.add('light');
            if (moonIcon) moonIcon.classList.remove('hidden');
            if (sunIcon) sunIcon.classList.add('hidden');
        }
    }

    function toggleTheme() {
        const isCurrentlyDark = document.documentElement.classList.contains('dark');
        const newTheme = isCurrentlyDark ? 'light' : 'dark';
        localStorage.setItem('akses-theme', newTheme);
        updateThemeUI(newTheme === 'dark');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('akses-theme') || 'dark';
        updateThemeUI(savedTheme === 'dark');
    });

    // Menangani rendering ulang Livewire saat navigasi / validasi form
    document.addEventListener('livewire:navigated', () => {
        const savedTheme = localStorage.getItem('akses-theme') || 'dark';
        updateThemeUI(savedTheme === 'dark');
    });
    </script>
</div>