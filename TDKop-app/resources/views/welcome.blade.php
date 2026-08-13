<x-layouts.app title="TDKop - Koperasi Digital SMK Negeri 8 Jakarta">
    <!-- Navbar (Putih Clean) -->
    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-tdkop-primary text-white p-2 rounded-xl font-bold text-xl tracking-wider transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/30">
                    TDK
                </div>
                <span class="font-bold text-xl text-tdkop-navy hidden sm:inline">TDKop</span>
            </div>

            <div class="flex items-center space-x-3 sm:space-x-4">
                @auth
                @if(auth()->user()->role === 'siswa')
                <a href="{{ url('dashboard/siswa') }}" class="text-sm font-semibold text-tdkop-primary hover:text-blue-800 hover:bg-sky-50 px-3 py-2 rounded-lg transition-all duration-300 hover:scale-105 active:scale-95 inline-block">Dashboard Siswa</a>
                @else
                <a href="{{ url('dashboard/admin') }}" class="text-sm font-semibold text-tdkop-primary hover:text-blue-800 hover:bg-sky-50 px-3 py-2 rounded-lg transition-all duration-300 hover:scale-105 active:scale-95 inline-block">Dashboard Admin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 font-semibold hover:text-red-700 hover:bg-red-50 px-3 py-2 rounded-lg transition-all duration-300 hover:scale-105 active:scale-95 inline-block">Logout</button>
                </form>
                @else
                <!-- Tombol Tanpa Latar (Masuk) dengan Animasi Hover Keren -->
                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-tdkop-primary hover:bg-sky-100/60 px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 active:scale-95 hover:shadow-md hover:shadow-sky-200/50 inline-block">Masuk</a>
                <!-- Tombol Berlatar (Daftar) -->
                <a href="{{ route('register') }}" class="bg-tdkop-primary text-white text-sm px-4 py-2 rounded-xl font-medium hover:bg-blue-800 transition-all duration-300 hover:scale-105 active:scale-95 shadow-sm hover:shadow-lg hover:shadow-blue-900/30 inline-block">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section (Gradient Abu-abu Terang Soft) -->
    <section class="bg-gradient-to-b from-slate-200 via-slate-100 to-slate-200/80 py-16 md:py-24 border-b border-slate-300/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <span class="bg-sky-100 text-tdkop-accent border border-sky-200 text-xs font-bold px-3.5 py-1.5 rounded-full uppercase tracking-wider mb-4 inline-block shadow-sm">
                Koperasi Sekolah Digital
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-tdkop-navy tracking-tight leading-tight mb-4">
                Pesan Seragam & Peralatan Sekolah <br class="hidden md:inline" /> Tanpa Antre di TDKop
            </h1>
            <p class="text-slate-600 max-w-2xl mx-auto text-lg mb-8">
                Sistem pemesanan online resmi Koperasi SMKN 8 Jakarta. Cek ketersediaan stok, pilih ukuran, dan ambil barang tanpa harus berdesakan.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#katalog" class="bg-tdkop-primary text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-blue-900/20 hover:bg-blue-800 transition-all duration-300 hover:scale-110 active:scale-95 hover:shadow-xl hover:shadow-blue-900/40 inline-block">
                    Lihat Katalog Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Katalog Section (Latar Abu-abu Terang Fade Gradasi) -->
    <section id="katalog" class="py-16 bg-gradient-to-b from-slate-200/80 via-slate-100 to-slate-200 min-h-screen" x-data="{ selectedProduct: null, showModal: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-tdkop-navy">Katalog Produk</h2>
                    <p class="text-slate-500 text-sm mt-1">Pilih produk dan cek ketersediaan ukurannya</p>
                </div>

                <!-- Search & Filter (Dengan Animasi & Glow Saat Focus/Hover) -->
                <form action="{{ route('home') }}" method="GET" class="flex flex-wrap items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..."
                        class="px-4 py-2 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 outline-none bg-white text-slate-800 placeholder-slate-400 transition-all duration-300 hover:scale-[1.02] focus:scale-[1.02] hover:border-sky-400 hover:shadow-md hover:shadow-sky-100">

                    <select name="category" onchange="this.form.submit()"
                        class="px-4 py-2 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-sky-400 focus:border-sky-400 outline-none bg-white text-slate-800 transition-all duration-300 hover:scale-[1.02] focus:scale-[1.02] hover:border-sky-400 hover:shadow-md hover:shadow-sky-100 cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-tdkop-primary text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-blue-800 transition-all duration-300 hover:scale-110 active:scale-95 hover:shadow-lg hover:shadow-blue-900/30">
                        Cari
                    </button>
                </form>
            </div>

            <!-- List Grid Produk (Card dengan Glow Biru di Belakang) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-7">
                @forelse($products as $product)
                <div class="relative group" data-aos="fade-up">
                    <!-- Glow Efek Biru di Belakang Card Produk -->
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-sky-400 to-blue-600 rounded-2xl blur-md opacity-0 group-hover:opacity-80 transition duration-500 group-hover:duration-200"></div>

                    <!-- Isi Card Utama -->
                    <div class="relative bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden group-hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between h-full">
                        <div>
                            <div class="h-48 bg-slate-100 flex items-center justify-center p-4 overflow-hidden group-hover:bg-sky-50/50 transition-colors duration-300">
                                <span class="text-slate-400 font-medium text-sm group-hover:text-tdkop-primary transition-colors">[ Preview {{ $product->name }} ]</span>
                            </div>
                            <div class="p-4">
                                <span class="text-[10px] font-bold text-tdkop-accent uppercase tracking-wider bg-sky-50 px-2 py-1 rounded border border-sky-100">
                                    {{ $product->category->name }}
                                </span>
                                <h3 class="font-bold text-tdkop-navy text-lg mt-2 line-clamp-1 group-hover:text-blue-700 transition-colors">{{ $product->name }}</h3>
                                <p class="text-slate-500 text-xs mt-1 line-clamp-2">{{ $product->description }}</p>
                            </div>
                        </div>

                        <div class="p-4 border-t border-slate-100 flex items-center justify-between bg-slate-50/60">
                            <div>
                                <span class="text-xs text-slate-400 block">Harga</span>
                                <span class="text-tdkop-primary font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            <button @click="selectedProduct = {{ json_encode($product) }}; showModal = true"
                                class="bg-tdkop-navy text-white text-xs px-3.5 py-2 rounded-lg font-semibold hover:bg-tdkop-primary transition-all duration-300 hover:scale-110 active:scale-95 hover:shadow-lg hover:shadow-blue-500/30">
                                Cek Stok
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 bg-white/80 backdrop-blur-sm rounded-2xl border border-slate-300">
                    <p class="text-slate-400 font-medium">Produk tidak ditemukan.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Modal Detail Stok -->
        <div x-show="showModal"
            x-transition
            class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4"
            style="display: none;">
            <div @click.away="showModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative border border-slate-200">
                <button @click="showModal = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 font-bold transition-all duration-300 hover:scale-125 hover:rotate-90">✕</button>

                <template x-if="selectedProduct">
                    <div>
                        <span class="text-xs font-bold text-tdkop-accent uppercase tracking-wider bg-sky-50 px-2 py-1 rounded" x-text="selectedProduct.category.name"></span>
                        <h3 class="text-xl font-bold text-tdkop-navy mt-2" x-text="selectedProduct.name"></h3>
                        <p class="text-slate-500 text-sm mt-1" x-text="selectedProduct.description"></p>

                        <div class="my-4">
                            <span class="text-xs text-slate-400 block mb-1">Harga Satuan</span>
                            <span class="text-2xl font-extrabold text-tdkop-primary" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedProduct.price)"></span>
                        </div>

                        <hr class="my-4 border-slate-100" />

                        <h4 class="font-bold text-tdkop-navy text-sm mb-3">Ketersediaan Stok berdasarkan Ukuran:</h4>

                        <div class="space-y-2 max-h-40 overflow-y-auto pr-1">
                            <template x-for="item in selectedProduct.stocks" :key="item.id">
                                <div class="flex justify-between items-center p-2 rounded-lg bg-slate-50 text-sm transition-all duration-300 hover:scale-[1.02] hover:shadow-sm">
                                    <span class="font-semibold text-slate-700" x-text="'Ukuran ' + item.size.name"></span>
                                    <span :class="item.stock > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'"
                                        class="px-2 py-0.5 rounded text-xs font-bold"
                                        x-text="item.stock > 0 ? item.stock + ' Pcs' : 'Habis'"></span>
                                </div>
                            </template>
                        </div>

                        <div class="mt-6">
                            @auth
                            @if(auth()->user()->role === 'siswa')
                            <a href="{{ url('dashboard/siswa') }}" class="block text-center w-full bg-tdkop-primary text-white py-3 rounded-xl font-semibold hover:bg-blue-800 transition-all duration-300 hover:scale-105 active:scale-95 hover:shadow-lg hover:shadow-blue-900/20">
                                Pesan Sekarang (di Dashboard)
                            </a>
                            @else
                            <p class="text-xs text-slate-400 text-center">Login sebagai Siswa untuk memesan.</p>
                            @endif
                            @else
                            <a href="{{ route('login') }}" class="block text-center w-full bg-tdkop-primary text-white py-3 rounded-xl font-semibold hover:bg-blue-800 transition-all duration-300 hover:scale-105 active:scale-95 hover:shadow-lg hover:shadow-blue-900/20">
                                Login untuk Memesan
                            </a>
                            @endauth
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Tim Pengembang / Pencipta (Latar Abu-abu Terang Kontak Gradasi & Card Glow Biru) -->
    <section class="py-16 bg-gradient-to-b from-slate-200 via-slate-100 to-slate-300/80 border-t border-slate-300/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="bg-sky-100 text-tdkop-accent border border-sky-200 text-xs font-bold px-3.5 py-1.5 rounded-full uppercase tracking-wider mb-3 inline-block shadow-sm">
                    Dibalik TDKop
                </span>
                <h2 class="text-3xl font-extrabold text-tdkop-navy">Tim Pengembang</h2>
                <p class="text-slate-600 text-sm mt-2 max-w-xl mx-auto">
                    Sistem ini dirancang dan dikembangkan oleh siswa SMK Negeri 8 Jakarta.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <!-- Anggota 1 -->
                <div class="relative group" data-aos="fade-up">
                    <!-- Glow Biru di Belakang Card Pengembang -->
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400 via-blue-500 to-cyan-400 rounded-2xl blur-md opacity-0 group-hover:opacity-85 transition duration-500 group-hover:duration-200"></div>

                    <!-- Card Utama -->
                    <div class="relative bg-white rounded-2xl border border-slate-200/80 overflow-hidden text-center group-hover:-translate-y-2 transition-all duration-300 shadow-sm">
                        <div class="h-40 sm:h-48 bg-slate-200 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('images/team/anggota1.jpg') }}" alt="Nama Anggota 1"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.src='https://ui-avatars.com/api/?name=Anggota+1&background=1E3A8A&color=fff&size=256'">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-tdkop-navy text-sm group-hover:text-blue-700 transition-colors">Nama Anggota 1</h3>
                            <p class="text-tdkop-accent text-xs font-semibold mt-1">Project Leader / Backend</p>
                            <p class="text-slate-400 text-[11px] mt-1">Kelas XII RPL 1</p>
                        </div>
                    </div>
                </div>

                <!-- Anggota 2 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400 via-blue-500 to-cyan-400 rounded-2xl blur-md opacity-0 group-hover:opacity-85 transition duration-500 group-hover:duration-200"></div>

                    <div class="relative bg-white rounded-2xl border border-slate-200/80 overflow-hidden text-center group-hover:-translate-y-2 transition-all duration-300 shadow-sm">
                        <div class="h-40 sm:h-48 bg-slate-200 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('images/team/anggota2.jpg') }}" alt="Nama Anggota 2"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.src='https://ui-avatars.com/api/?name=Anggota+2&background=1E3A8A&color=fff&size=256'">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-tdkop-navy text-sm group-hover:text-blue-700 transition-colors">Nama Anggota 2</h3>
                            <p class="text-tdkop-accent text-xs font-semibold mt-1">Frontend Developer</p>
                            <p class="text-slate-400 text-[11px] mt-1">Kelas XII RPL 1</p>
                        </div>
                    </div>
                </div>

                <!-- Anggota 3 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400 via-blue-500 to-cyan-400 rounded-2xl blur-md opacity-0 group-hover:opacity-85 transition duration-500 group-hover:duration-200"></div>

                    <div class="relative bg-white rounded-2xl border border-slate-200/80 overflow-hidden text-center group-hover:-translate-y-2 transition-all duration-300 shadow-sm">
                        <div class="h-40 sm:h-48 bg-slate-200 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('images/team/anggota3.jpg') }}" alt="Nama Anggota 3"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.src='https://ui-avatars.com/api/?name=Anggota+3&background=1E3A8A&color=fff&size=256'">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-tdkop-navy text-sm group-hover:text-blue-700 transition-colors">Nama Anggota 3</h3>
                            <p class="text-tdkop-accent text-xs font-semibold mt-1">UI/UX Designer</p>
                            <p class="text-slate-400 text-[11px] mt-1">Kelas XII RPL 1</p>
                        </div>
                    </div>
                </div>

                <!-- Anggota 4 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400 via-blue-500 to-cyan-400 rounded-2xl blur-md opacity-0 group-hover:opacity-85 transition duration-500 group-hover:duration-200"></div>

                    <div class="relative bg-white rounded-2xl border border-slate-200/80 overflow-hidden text-center group-hover:-translate-y-2 transition-all duration-300 shadow-sm">
                        <div class="h-40 sm:h-48 bg-slate-200 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('images/team/anggota4.jpg') }}" alt="Nama Anggota 4"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.src='https://ui-avatars.com/api/?name=Anggota+4&background=1E3A8A&color=fff&size=256'">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-tdkop-navy text-sm group-hover:text-blue-700 transition-colors">Nama Anggota 4</h3>
                            <p class="text-tdkop-accent text-xs font-semibold mt-1">Quality Assurance</p>
                            <p class="text-slate-400 text-[11px] mt-1">Kelas XII RPL 1</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-tdkop-navy text-slate-300 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-tdkop-primary text-white p-2 rounded-xl font-bold text-xl tracking-wider transition-transform duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/20">
                            TDK
                        </div>
                        <span class="font-bold text-xl text-white">TDKop</span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Sistem pemesanan digital resmi Koperasi SMK Negeri 8 Jakarta. Belanja seragam & peralatan sekolah tanpa antre.
                    </p>
                </div>

                <!-- Navigasi -->
                <div>
                    <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-white transition-all duration-300 inline-block hover:scale-105 hover:translate-x-1">Beranda</a></li>
                        <li><a href="#katalog" class="hover:text-white transition-all duration-300 inline-block hover:scale-105 hover:translate-x-1">Katalog Produk</a></li>
                        @auth
                            @if(auth()->user()->role === 'siswa')
                            <li><a href="{{ url('dashboard/siswa') }}" class="hover:text-white transition-all duration-300 inline-block hover:scale-105 hover:translate-x-1">Dashboard Siswa</a></li>
                            @else
                            <li><a href="{{ url('dashboard/admin') }}" class="hover:text-white transition-all duration-300 inline-block hover:scale-105 hover:translate-x-1">Dashboard Admin</a></li>
                            @endif
                        @else
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-all duration-300 inline-block hover:scale-105 hover:translate-x-1">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-all duration-300 inline-block hover:scale-105 hover:translate-x-1">Daftar Akun</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Kategori -->
                <div>
                    <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Kategori</h4>
                    <ul class="space-y-2 text-sm">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('home', ['category' => $cat->slug]) }}" class="hover:text-white transition-all duration-300 inline-block hover:scale-105 hover:translate-x-1">
                                {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Kontak</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li class="flex items-start gap-2 transition-transform duration-300 hover:translate-x-1 hover:text-white">
                            <span>📍</span>
                            <span>Jl. Pejaten Raya, RT.6/RW.6, Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510</span>
                        </li>
                        <li class="flex items-center gap-2 transition-transform duration-300 hover:translate-x-1 hover:text-white">
                            <span>📞</span>
                            <span>(021) 7996493</span>
                        </li>
                        <li class="flex items-center gap-2 transition-transform duration-300 hover:translate-x-1 hover:text-white">
                            <span>✉️</span>
                            <span>smkn8jakarta.sch.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 mt-10 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} TDKop &mdash; Koperasi Digital SMK Negeri 8 Jakarta. Seluruh hak cipta dilindungi.
                </p>
                <div class="flex items-center gap-4 text-xs text-slate-500">
                    <span>Dibuat untuk mendukung kegiatan koperasi sekolah</span>
                </div>
            </div>
        </div>
    </footer>
</x-layouts.app>