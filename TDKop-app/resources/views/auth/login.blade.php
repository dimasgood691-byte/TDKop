<x-layouts.app title="Login TDKop">
    <div class="min-h-screen flex" x-data="{ role: 'siswa', showPassword: false }">

        <!-- ==================== PANEL KIRI (Branding) ==================== -->
        <div class="hidden lg:flex lg:w-[45%] relative overflow-hidden bg-gradient-to-br from-tdkop-primary to-tdkop-navy flex-col justify-between p-10 xl:p-14">

            <!-- Dekorasi lingkaran -->
            <div class="pointer-events-none absolute -top-24 -right-24 w-80 h-80 bg-white/10 rounded-full"></div>
            <div class="pointer-events-none absolute top-1/3 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="pointer-events-none absolute -bottom-32 -left-16 w-72 h-72 bg-white/5 rounded-full"></div>

            <!-- Logo & Nama Sekolah -->
            <!-- Logo & Nama Sekolah -->
            <a href="{{ url('/') }}" class="relative z-10 flex items-center gap-3 w-fit group">
                <div class="bg-white/15 border border-white/20 backdrop-blur-sm p-2 rounded-2xl transition-all duration-300 group-hover:scale-110 group-hover:bg-white/25">
                    <!-- Mengganti div huruf TDK dengan gambar logo -->
                    <img
                        src="{{ asset('images/logo-smkn-8-jkt.png') }}"
                        alt="Logo SMKN 8 Jakarta"
                        class="w-9 h-9 object-contain">
                </div>
                <div>
                    <h2 class="text-white font-bold text-base leading-tight transition-colors duration-300 group-hover:text-blue-100">SMK Negeri 8 Jakarta</h2>
                    <p class="text-blue-100 text-xs">Koperasi Sekolah Digital</p>
                </div>
            </a>

            <!-- Headline & Fitur -->
            <div class="relative z-10">
                <h1 class="text-white text-3xl xl:text-4xl font-extrabold leading-tight mb-4">
                    Sistem Koperasi <br /> Digital Sekolah
                </h1>
                <p class="text-blue-100 text-sm leading-relaxed mb-8 max-w-sm">
                    Pesan seragam, buku, dan peralatan sekolah, pantau ketersediaan stok, dan lacak riwayat pesanan dalam satu dashboard terpadu.
                </p>

                <div class="space-y-4">
                    <div class="flex items-start gap-3 transition-transform duration-300 hover:translate-x-1">
                        <div class="bg-white/15 border border-white/20 p-2.5 rounded-xl shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                <path d="M3 6h18" />
                                <path d="M16 10a4 4 0 0 1-8 0" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-sm">Belanja Tanpa Antre</h3>
                            <p class="text-blue-100 text-xs mt-0.5">Pesan dari rumah, ambil barang langsung di koperasi</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 transition-transform duration-300 hover:translate-x-1">
                        <div class="bg-white/15 border border-white/20 p-2.5 rounded-xl shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <path d="M9 8h6M9 12h6M9 16h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-sm">Stok Real-time</h3>
                            <p class="text-blue-100 text-xs mt-0.5">Cek ketersediaan ukuran dan jumlah barang secara langsung</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 transition-transform duration-300 hover:translate-x-1">
                        <div class="bg-white/15 border border-white/20 p-2.5 rounded-xl shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3v18h18" />
                                <path d="m19 9-5 5-4-4-3 3" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-sm">Riwayat Pesanan</h3>
                            <p class="text-blue-100 text-xs mt-0.5">Pantau status dan histori seluruh pesananmu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <p class="relative z-10 text-blue-200/70 text-xs">
                &copy; {{ date('Y') }} SMK Negeri 8 Jakarta. Seluruh hak dilindungi.
            </p>
        </div>

        <!-- ==================== PANEL KANAN (Form Login) ==================== -->
        <div class="w-full lg:w-[55%] flex items-center justify-center bg-white p-6 sm:p-10">
            <div class="w-full max-w-sm" data-aos="fade-up">

                <!-- Logo mobile (tampil hanya di layar kecil) -->
                <a href="{{ url('/') }}" class="flex lg:hidden items-center gap-3 mb-8 w-fit group">
                    <div class="bg-tdkop-primary text-white font-bold text-lg w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:bg-tdkop-navy">
                        TDK
                    </div>
                    <div>
                        <h2 class="text-tdkop-navy font-bold text-sm leading-tight transition-colors duration-300 group-hover:text-tdkop-primary">SMK Negeri 8 Jakarta</h2>
                        <p class="text-slate-400 text-xs">Koperasi Sekolah Digital</p>
                    </div>
                </a>

                <h1 class="text-2xl sm:text-3xl font-bold text-tdkop-navy flex items-center gap-2">
                    Selamat datang <span>👋</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 mb-6">Masuk ke akun Anda untuk melanjutkan</p>

                @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-3.5 rounded-xl mb-5 text-sm border border-red-100">
                    {{ $errors->first() }}
                </div>
                @endif

                <!-- Tab Pilihan Peran -->
                <div class="grid grid-cols-2 gap-1 bg-slate-100 p-1 rounded-xl mb-6">
                    <button type="button" @click="role = 'siswa'"
                        :class="role === 'siswa' ? 'bg-white text-tdkop-navy shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                        class="flex items-center justify-center gap-1.5 py-2 rounded-lg text-sm font-semibold transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                            <path d="M6 12v5c0 1.1 2.7 2 6 2s6-.9 6-2v-5" />
                        </svg>
                        Siswa
                    </button>
                    <button type="button" @click="role = 'admin'"
                        :class="role === 'admin' ? 'bg-white text-tdkop-navy shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                        class="flex items-center justify-center gap-1.5 py-2 rounded-lg text-sm font-semibold transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Admin / Staff
                    </button>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" :value="role">

                    <!-- Username / NIS -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            <span x-text="role === 'siswa' ? 'Username / NIS' : 'Username / NIP'"></span>
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                    <path d="M2 8h20" />
                                    <path d="M6 16h4" />
                                </svg>
                            </span>
                            <input type="text" name="username" required
                                :placeholder="role === 'siswa' ? 'Masukkan NIS' : 'Masukkan NIP'"
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-xl text-sm outline-none
                                       transition-all duration-300 ease-out
                                       hover:border-tdkop-primary hover:shadow-sm
                                       focus:ring-2 focus:ring-tdkop-primary/40 focus:border-tdkop-primary focus:scale-[1.02] focus:shadow-md">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                            </span>
                            <input :type="showPassword ? 'text' : 'password'" name="password" required placeholder="••••••••"
                                class="w-full pl-10 pr-11 py-2.5 border border-slate-300 rounded-xl text-sm outline-none
                                       transition-all duration-300 ease-out
                                       hover:border-tdkop-primary hover:shadow-sm
                                       focus:ring-2 focus:ring-tdkop-primary/40 focus:border-tdkop-primary focus:scale-[1.02] focus:shadow-md">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-tdkop-primary transition-all duration-300 hover:scale-125">
                                <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 7 10 7a13.16 13.16 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <path d="M1 1l22 22" />
                                    <path d="M6.06 6.06A13.9 13.9 0 0 0 2 11s3.5 7 10 7a9.14 9.14 0 0 0 5-1.5" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Ingat saya & Lupa kata sandi -->
                    <div class="flex items-center justify-between text-sm pt-1">
                        <label class="flex items-center gap-2 text-slate-600 cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-tdkop-primary focus:ring-tdkop-primary/40 transition-all duration-300">
                            Ingat saya
                        </label>
                        <a href="{{ route('password.request') }}" class="text-tdkop-primary font-medium hover:text-tdkop-navy transition-all duration-300 hover:underline">
                            Lupa kata sandi?
                        </a>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-tdkop-primary text-white py-3 rounded-xl font-semibold
                               transition-all duration-300 hover:scale-[1.02] active:scale-95 hover:-translate-y-0.5
                               hover:bg-tdkop-navy shadow-md hover:shadow-xl hover:shadow-blue-900/25">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <path d="M10 17l5-5-5-5" />
                            <path d="M15 12H3" />
                        </svg>
                        Masuk
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-tdkop-accent font-semibold hover:underline transition-all duration-300">
                        Daftar Siswa
                    </a>
                </p>
                <p class="text-center text-xs text-slate-400 mt-2">
                    Butuh akun Admin/Staff? Hubungi administrator koperasi.
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>