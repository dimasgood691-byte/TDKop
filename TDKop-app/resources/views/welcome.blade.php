<x-layouts.app title="TDKop - Tradevis Koperasi">
    <!-- Navbar (Clean Glassmorphism) -->
    <!-- Navbar Modern Glassmorphism -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/80 shadow-xs transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand Logo & Name -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 group focus:outline-hidden">
                <div class="bg-gradient-to-tr from-sky-500 via-blue-600 to-indigo-900 text-white px-3.5 py-1.5 rounded-xl font-black text-xl tracking-wider shadow-md shadow-blue-500/20 group-hover:scale-105 group-hover:shadow-lg group-hover:shadow-blue-500/30 transition-all duration-300 flex items-center justify-center">
                    TDKop
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-lg sm:text-xl text-tdkop-navy tracking-tight leading-none group-hover:text-blue-600 transition-colors">
                        Tradevis Koperasi
                    </span>
                    <span class="text-[10px] font-semibold text-slate-400 tracking-wider uppercase hidden sm:block">
                        SMK Negeri 8 Jakarta
                    </span>
                </div>
            </a>
            <!-- Right Action Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                <!-- User Profile & Dashboard Link -->
                <div class="flex items-center gap-2 bg-slate-50 border border-slate-200/80 p-1 pl-3 rounded-xl">
                    <span class="text-xs font-bold text-slate-600 hidden md:inline truncate max-w-[120px]">
                        {{ auth()->user()->name }}
                    </span>
                    @if(auth()->user()->role === 'siswa')
                    <a href="{{ url('dashboard/siswa') }}"
                        class="text-xs font-bold text-sky-700 bg-sky-50 hover:bg-sky-100/80 border border-sky-100 px-3 py-1.5 rounded-lg transition-all active:scale-95 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                        Dashboard
                    </a>
                    @else
                    <a href="{{ url('dashboard/admin') }}"
                        class="text-xs font-bold text-indigo-700 bg-indigo-50 hover:bg-indigo-100/80 border border-indigo-100 px-3 py-1.5 rounded-lg transition-all active:scale-95 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                        Admin Panel
                    </a>
                    @endif
                </div>
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        title="Keluar"
                        class="text-xs font-bold text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-transparent hover:border-rose-100 px-3 py-2 rounded-xl transition-all duration-200 active:scale-95 flex items-center gap-1 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
                @else
                <!-- Guest Action Buttons (Interactive & Modern Hover) -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Tombol Masuk dengan Border Glow Subtle -->
                    <a href="{{ route('login') }}"
                        class="text-xs sm:text-sm font-bold text-slate-700 hover:text-sky-600 bg-transparent hover:bg-sky-50/80 border border-transparent hover:border-sky-200/80 px-4 py-2 rounded-xl transition-all duration-300 active:scale-95 flex items-center gap-1.5 group">
                        <span>Masuk</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-sky-600 group-hover:translate-x-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <!-- Tombol Daftar dengan Ambient Glow & Shine Effect -->
                    <a href="{{ route('register') }}"
                        class="relative group overflow-hidden bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-900 text-white text-xs sm:text-sm px-5 py-2 rounded-xl font-bold shadow-md shadow-blue-500/20 hover:shadow-xl hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-300 active:scale-95 flex items-center justify-center">
                        <!-- Animated Shine Wave Effect -->
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/25 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></span>
                        <!-- Glow Overlay on Hover -->
                        <span class="absolute inset-0 bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <!-- Label Text & Micro-Icon -->
                        <span class="relative z-10 flex items-center gap-1.5">
                            <span>Daftar</span>
                        </span>
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-b from-white via-sky-50/60 to-slate-50 py-24 md:py-36">
        <!-- BACKGROUND ASLI -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(14,165,233,0.22)_1px,transparent_1px),linear-gradient(to_bottom,rgba(14,165,233,0.22)_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] pointer-events-none" style="mask-image: radial-gradient(ellipse at 50% 50%, black 40%, transparent 85%); -webkit-mask-image: radial-gradient(ellipse at 50% 50%, black 40%, transparent 85%);"></div>

        <div class="absolute -top-32 -left-32 w-96 h-96 bg-sky-400/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-32 w-96 h-96 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <!-- KONTEN HERO SECTION -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" data-aos="fade-up">

            <!-- Interactive Pill Tag -->
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500/10 via-blue-500/10 to-indigo-500/10 text-sky-700 border border-sky-200/80 text-xs font-extrabold px-4 py-2 rounded-full uppercase tracking-widest mb-8 shadow-xs backdrop-blur-md hover:scale-105 transition-transform duration-300 cursor-default">
                <span class="w-2.5 h-2.5 rounded-full bg-sky-500 animate-pulse shadow-sm shadow-sky-500"></span>
                <span>Website Resmi Tradevis Koperasi</span>
                <span class="bg-sky-500/20 text-sky-800 text-[10px] px-2 py-0.5 rounded-full font-black">2026</span>
            </div>

            <!-- Headline Utama -->
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black text-tdkop-navy tracking-tight leading-[1.1] mb-6">
                Pesan Seragam & Peralatan <br class="hidden md:inline" />
                Tanpa Antri di <span class="bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-800 bg-clip-text text-transparent drop-shadow-xs">TDKop</span>
            </h1>

            <!-- Deskripsi Interaktif -->
            <p class="text-slate-600 max-w-2xl mx-auto text-base sm:text-lg md:text-xl leading-relaxed mb-10 font-medium">
                Pengalaman belanja kebutuhan siswa/siswi <span class="text-tdkop-navy font-bold underline decoration-sky-400/60 decoration-2 underline-offset-4">SMK Negeri 8 Jakarta</span> yang serba cepat. Cek stok ukuran sekarang juga, amankan pesananmu, tinggal ambil <span class="font-bold text-red-700">!</span>
            </p>

            <!-- Action Call-To-Action (CTA) Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-14">
                <!-- Primary CTA dengan Shine Animation -->
                <a href="#katalog" class="relative group overflow-hidden bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-900 text-white px-8 py-4 rounded-2xl font-extrabold text-base shadow-xl shadow-blue-500/25 hover:shadow-2xl hover:shadow-blue-600/40 hover:-translate-y-1 transition-all duration-300 active:scale-95 w-full sm:w-auto flex items-center justify-center gap-2.5">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></span>
                    <span class="relative z-10">Jelajahi Katalog Produk</span>
                    <svg class="w-5 h-5 relative z-10 group-hover:translate-y-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>

                <!-- Secondary CTA -->
                <a href="{{ route('register') }}" class="bg-white/80 hover:bg-white text-slate-700 hover:text-blue-600 border border-slate-200 hover:border-sky-300 px-7 py-4 rounded-2xl font-bold text-base transition-all duration-300 hover:-translate-y-0.5 active:scale-95 shadow-xs w-full sm:w-auto flex items-center justify-center gap-2">
                    <span>Daftar Sekarang</span>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Katalog Section -->
    <section id="katalog" class="py-16 md:py-24 bg-gradient-to-b from-slate-50 via-slate-100/50 to-slate-50 min-h-screen relative overflow-hidden" x-data="{ selectedProduct: null, showModal: false, showImageModal: false, selectedImage: '' }">
        <!-- Subtle Background Glows -->
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-1/3 -right-20 w-96 h-96 bg-sky-400/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header & Filter Form -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-12 gap-6 bg-white/80 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100/80 border border-sky-200 text-sky-700 text-xs font-bold uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span> Katalog Produk Koperasi
                    </div>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">Pilih produk dan cek ketersediaan ukurannya sekarang !</p>
                </div>

                <!-- Search & Filter Form -->
                <form action="{{ route('home') }}#katalog" method="GET" class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                    <!-- Search Input -->
                    <div class="relative w-full sm:w-64 group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..."
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 hover:bg-white focus:bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 outline-none text-slate-800 placeholder-slate-400 transition-all duration-300 shadow-xs">
                        <svg class="w-4 h-4 text-slate-400 group-focus-within:text-sky-500 absolute left-3.5 top-3.5 pointer-events-none transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <!-- Select Category -->
                    <div class="relative w-full sm:w-auto">
                        <select name="category" onchange="this.form.submit()"
                            class="w-full px-4 py-2.5 bg-slate-50 hover:bg-white focus:bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 outline-none text-slate-700 transition-all duration-300 cursor-pointer shadow-xs font-medium appearance-none pr-9">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full sm:w-auto bg-tdkop-primary hover:bg-blue-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 active:scale-95 shadow-md shadow-blue-900/20 hover:shadow-lg flex items-center justify-center gap-2">
                        <span>Cari</span>
                    </button>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-7">
                @forelse($products as $product)
                <div class="relative group h-full flex flex-col" data-aos="fade-up">
                    <!-- Card Outer Ambient Glow -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-600 rounded-3xl blur-md opacity-0 group-hover:opacity-30 transition-all duration-500"></div>

                    <!-- Product Card Body -->
                    <div class="relative bg-white rounded-2xl border border-slate-200/80 overflow-hidden group-hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between h-full shadow-xs hover:shadow-xl">
                        <div>
                            <!-- Image Container -->
                            <div class="h-56 bg-slate-100/80 overflow-hidden relative group/img">
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    @click="selectedImage = '{{ asset('storage/' . $product->image) }}'; showImageModal = true"
                                    class="w-full h-full object-cover group-hover/img:scale-110 transition-transform duration-700 ease-out cursor-pointer">
                                <div @click="selectedImage = '{{ asset('storage/' . $product->image) }}'; showImageModal = true"
                                    class="absolute inset-0 bg-slate-900/30 opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer backdrop-blur-[2px]">
                                    <span class="bg-white/90 text-slate-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat
                                    </span>
                                </div>
                                @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100/50">
                                    <svg class="w-10 h-10 mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m-9-9l9 5.25" />
                                    </svg>
                                    <span class="text-xs font-semibold text-slate-400">Belum Ada Foto</span>
                                </div>
                                @endif

                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <span class="text-[10px] font-bold text-sky-700 uppercase tracking-wider bg-white/90 backdrop-blur-md px-3 py-1 rounded-lg border border-sky-100 shadow-xs">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Info Content -->
                            <div class="p-5">
                                <h3 class="font-bold text-tdkop-navy text-base group-hover:text-blue-600 transition-colors duration-200 line-clamp-1" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-slate-500 text-xs leading-relaxed mt-2 line-clamp-2 min-h-[2.25rem]">
                                    {{ $product->description }}
                                </p>

                                    <div class="flex flex-wrap gap-1.5 mt-3">
                                        @forelse($product->stocks as $stock)
                                        <span class="text-[10px] font-bold px-2 py-1 rounded-lg border {{ $stock->size->gender_label === 'Laki-laki' ? 'bg-sky-50 text-sky-700 border-sky-100' : ($stock->size->gender_label === 'Perempuan' ? 'bg-pink-50 text-pink-700 border-pink-100' : 'bg-slate-50 text-slate-600 border-slate-200') }}">
                                            {{ $stock->size->display_name }}
                                        </span>
                                        @empty
                                        <span class="text-[10px] text-slate-400">Ukuran belum tersedia</span>
                                        @endforelse
                                    </div>
                            </div>
                        </div>

                        <!-- Footer Action -->
                        <div class="p-4 px-5 border-t border-slate-100 flex items-center justify-between bg-slate-50/60">
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">Harga</span>
                                <span class="text-tdkop-primary font-black text-base sm:text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            <button @click="selectedProduct = {{ json_encode($product) }}; showModal = true"
                                class="relative group/btn overflow-hidden bg-tdkop-navy hover:bg-tdkop-primary text-white text-xs px-4 py-2.5 rounded-xl font-bold transition-all duration-300 active:scale-95 shadow-xs flex items-center gap-1.5">
                                <span class="relative z-10">Cek Stok</span>
                                <svg class="w-3.5 h-3.5 relative z-10 transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20 bg-white/80 backdrop-blur-md rounded-3xl border border-dashed border-slate-300">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <p class="text-slate-700 font-bold text-lg">Produk tidak ditemukan</p>
                    <p class="text-slate-400 text-xs mt-1">Coba gunakan kata kunci lain atau ubah filter kategori Anda.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Modal Detail Stok -->
        <div x-show="showModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-[80] bg-slate-900/60 backdrop-blur-md flex items-center justify-center p-4"
            style="display: none;">

            <div @click.away="showModal = false" class="relative z-10 bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto">
                <button @click.stop="showModal = false" class="absolute top-5 right-5 z-20 w-8 h-8 rounded-full bg-slate-100 text-slate-400 hover:text-slate-700 hover:bg-slate-200 font-bold transition-all duration-200 flex items-center justify-center">✕</button>

                <template x-if="selectedProduct">
                    <div>
                        <!-- Modal Image Banner -->
                        <div class="w-full h-48 bg-slate-100 rounded-2xl overflow-hidden mb-5 border border-slate-100 relative group cursor-pointer"
                            @click="selectedImage = '/storage/' + selectedProduct.image; showImageModal = true">
                            <template x-if="selectedProduct.image">
                                <div class="relative w-full h-full">
                                    <img :src="'/storage/' + selectedProduct.image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-slate-900/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <span class="text-xs text-white bg-black/50 px-3 py-1.5 rounded-full backdrop-blur-xs font-semibold">Klik untuk Melihat</span>
                                    </div>
                                </div>
                            </template>
                            <template x-if="!selectedProduct.image">
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-50">
                                    <svg class="w-8 h-8 mb-1 opacity-75" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m-9-9l9 5.25" />
                                    </svg>
                                    <span class="text-xs font-semibold">Belum Ada Foto</span>
                                </div>
                            </template>
                        </div>

                        <!-- Details -->
                        <span class="text-[10px] font-bold text-sky-700 uppercase tracking-wider bg-sky-50 px-3 py-1 rounded-md border border-sky-100" x-text="selectedProduct.category.name"></span>
                        <h3 class="text-xl font-black text-tdkop-navy mt-2 leading-snug" x-text="selectedProduct.name"></h3>
                        <p class="text-slate-500 text-xs leading-relaxed mt-1.5" x-text="selectedProduct.description"></p>

                        <!-- Price Box -->
                        <div class="mt-4 p-3.5 bg-sky-50/60 rounded-2xl border border-sky-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500">Harga Satuan</span>
                            <span class="text-xl font-black text-tdkop-primary" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedProduct.price)"></span>
                        </div>

                        <hr class="my-5 border-slate-100" />

                        <!-- Stock Status Title -->
                        <h4 class="font-bold text-tdkop-navy text-sm mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-tdkop-primary" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Stok Ukuran Tersedia:
                        </h4>

                        <!-- Stock List -->
                        <div class="space-y-2 max-h-44 overflow-y-auto pr-1">
                            <template x-for="item in selectedProduct.stocks" :key="item.id">
                                <div class="flex justify-between items-center p-3 rounded-xl bg-slate-50 border border-slate-100 text-sm hover:bg-slate-100/80 transition-colors gap-3">
                                    <span class="font-bold text-slate-700" x-text="'Ukuran ' + item.size.name + ' (' + (item.size.gender === 'laki-laki' ? 'Laki-laki' : item.size.gender === 'perempuan' ? 'Perempuan' : 'Umum') + ')' "></span>
                                    <span :class="item.stock > 0 ? 'bg-emerald-100/80 text-emerald-800 border-emerald-200' : 'bg-rose-100/80 text-rose-700 border-rose-200'"
                                        class="px-3 py-1 rounded-lg text-xs font-extrabold border whitespace-nowrap"
                                        x-text="item.stock > 0 ? item.stock + ' Pcs' : 'Habis'"></span>
                                </div>
                            </template>
                        </div>

                        <!-- Call to Action -->
                        <div class="mt-6">
                            @auth
                            @if(auth()->user()->role === 'siswa')
                            <a href="{{ url('dashboard/siswa') }}" class="block text-center w-full bg-tdkop-primary hover:bg-blue-800 text-white py-3.5 rounded-xl font-bold transition-all duration-300 active:scale-95 shadow-md shadow-blue-900/20">
                                Pesan Sekarang (di Dashboard)
                            </a>
                            @else
                            <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-center">
                                <p class="text-xs font-semibold text-amber-700">Login sebagai Siswa untuk memesan produk ini.</p>
                            </div>
                            @endif
                            @else
                            <a href="{{ route('login') }}" class="block text-center w-full bg-tdkop-primary hover:bg-blue-800 text-white py-3.5 rounded-xl font-bold transition-all duration-300 active:scale-95 shadow-md shadow-blue-900/20">
                                Login untuk Memesan
                            </a>
                            @endauth
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Modal Fullscreen Image -->
        <div x-show="showImageModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[90] bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4"
            style="display: none;">

            <button @click.stop="showImageModal = false" class="absolute top-5 right-5 sm:top-8 sm:right-8 z-[100] w-10 h-10 rounded-full bg-white/10 border border-white/20 text-white hover:bg-white/20 hover:scale-105 font-bold transition-all duration-200 flex items-center justify-center backdrop-blur-md shadow-lg">
                ✕
            </button>

            <div @click.away="showImageModal = false" class="relative max-w-5xl w-full max-h-[90vh] flex items-center justify-center"
                x-transition:enter="transition ease-out duration-300 delay-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100">
                <img :src="selectedImage" class="max-w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl ring-1 ring-white/20">
            </div>
        </div>
    </section>

    <!-- Section Tim Developer -->
    <section class="py-20 bg-white text-slate-800 relative overflow-hidden">
        <!-- Ambient Glow Background -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(14,165,233,0.03)_1px,transparent_1px),linear-gradient(to_bottom,rgba(14,165,233,0.03)_1px,transparent_1px)] bg-[size:2.5rem_2.5rem] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] bg-gradient-to-tr from-sky-400/20 via-blue-600/15 to-indigo-900/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Header Section -->
            <div class="text-center mb-12" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500/10 via-blue-500/10 to-indigo-500/10 text-sky-700 border border-sky-200/60 text-[11px] font-extrabold px-3.5 py-1.5 rounded-full uppercase tracking-wider mb-3 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span> Sosok Dibalik Layar
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-tdkop-navy tracking-tight">
                    Tim Developer <span class="bg-gradient-to-r from-sky-500 to-blue-600 bg-clip-text text-transparent">TDKop</span>
                </h2>
                <p class="text-slate-500 text-xs sm:text-sm mt-2.5 max-w-lg mx-auto leading-relaxed font-medium">
                    Kolaborasi Skill siswa SMK Negeri 8 Jakarta dalam menghadirkan pengalaman belanja koperasi sekolah yang modern dan serba cepat.
                </p>
            </div>

            <!-- Grid Cards Developer -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5 lg:gap-6">

                <!-- Anggota 1 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400 via-blue-600 to-indigo-600 rounded-2xl blur-sm opacity-0 group-hover:opacity-60 transition duration-300"></div>
                    <div class="relative bg-white border border-slate-200/80 rounded-xl overflow-hidden shadow-xs group-hover:shadow-xl transition-all duration-300">
                        <div class="h-64 sm:h-72 bg-slate-100 relative overflow-hidden group/photo">
                            <img src="{{ asset('images/11 DIMAS PUTRA MADIADIPURA IMG_0645.JPG') }}" alt="Dimas Putra Madiadipura"
                                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover/photo:scale-105"
                                onerror="this.src='https://ui-avatars.com/api/?name=Dimas+Putra+Madiadipura&background=1E3A8A&color=fff&size=256'">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group/photo:opacity-100 transition-opacity duration-300 flex items-center justify-center p-2">
                                <span class="text-xs font-bold text-white bg-slate-900/80 backdrop-blur-xs px-3 py-1.5 rounded-md border border-white/20">Fullstack Developer</span>
                            </div>
                        </div>
                        <div class="p-5 text-left">
                            <span class="text-sky-700 text-[11px] font-bold bg-sky-50 py-1 px-2.5 rounded-md border border-sky-100 inline-block uppercase tracking-wider mb-2">Fullstack</span>
                            <h3 class="font-extrabold text-tdkop-navy text-base sm:text-lg group-hover:text-blue-600 transition-colors leading-tight">Dimas Putra Madiadipura</h3>
                            <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 text-slate-600 text-xs font-medium">
                                <p class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> XI Rekayasa Perangkat Lunak
                                </p>
                                <p class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> SMKN 8 Jakarta
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Anggota 2 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400 via-blue-600 to-indigo-600 rounded-2xl blur-sm opacity-0 group-hover:opacity-60 transition duration-300"></div>
                    <div class="relative bg-white border border-slate-200/80 rounded-xl overflow-hidden shadow-xs group-hover:shadow-xl transition-all duration-300">
                        <div class="h-64 sm:h-72 bg-slate-100 relative overflow-hidden group/photo">
                            <img src="{{ asset('images/20 MOCHAMAD BILAL RABANI IMG_0654.jpg') }}" alt="Mochamad Bilal Rabani"
                                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover/photo:scale-105"
                                onerror="this.src='https://ui-avatars.com/api/?name=Bilal+Rabani&background=1E3A8A&color=fff&size=256'">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group/photo:opacity-100 transition-opacity duration-300 flex items-center justify-center p-2">
                                <span class="text-xs font-bold text-white bg-slate-900/80 backdrop-blur-xs px-3 py-1.5 rounded-md border border-white/20">UI/UX Maestro</span>
                            </div>
                        </div>
                        <div class="p-5 text-left">
                            <span class="text-sky-700 text-[11px] font-bold bg-sky-50 py-1 px-2.5 rounded-md border border-sky-100 inline-block uppercase tracking-wider mb-2">Frontend / UI UX</span>
                            <h3 class="font-extrabold text-tdkop-navy text-base sm:text-lg group-hover:text-blue-600 transition-colors truncate">Mochamad Bilal Rabani</h3>
                            <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 text-slate-600 text-xs font-medium">
                                <p class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> XI Rekayasa Perangkat Lunak
                                </p>
                                <p class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> SMKN 8 Jakarta
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Anggota 3 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400 via-blue-600 to-indigo-600 rounded-2xl blur-sm opacity-0 group-hover:opacity-60 transition duration-300"></div>
                    <div class="relative bg-white border border-slate-200/80 rounded-xl overflow-hidden shadow-xs group-hover:shadow-xl transition-all duration-300">
                        <div class="h-64 sm:h-72 bg-slate-100 relative overflow-hidden group/photo">
                            <img src="{{ asset('images/7 AULANDRA RIDWAN IMG_0641.jpg') }}" alt="Aulandra Ridwan"
                                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover/photo:scale-105"
                                onerror="this.src='https://ui-avatars.com/api/?name=Aulandra+Ridwan&background=1E3A8A&color=fff&size=256'">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group/photo:opacity-100 transition-opacity duration-300 flex items-center justify-center p-2">
                                <span class="text-xs font-bold text-white bg-slate-900/80 backdrop-blur-xs px-3 py-1.5 rounded-md border border-white/20">FrontEnd Dev</span>
                            </div>
                        </div>
                        <div class="p-5 text-left">
                            <span class="text-sky-700 text-[11px] font-bold bg-sky-50 py-1 px-2.5 rounded-md border border-sky-100 inline-block uppercase tracking-wider mb-2">FrontEnd Developer</span>
                            <h3 class="font-extrabold text-tdkop-navy text-base sm:text-lg group-hover:text-blue-600 transition-colors truncate">Aulandra Ridwan</h3>
                            <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 text-slate-600 text-xs font-medium">
                                <p class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> XI Rekayasa Perangkat Lunak
                                </p>
                                <p class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> SMKN 8 Jakarta
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Anggota 4 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="400">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-sky-400 via-blue-600 to-indigo-600 rounded-2xl blur-sm opacity-0 group-hover:opacity-60 transition duration-300"></div>
                    <div class="relative bg-white border border-slate-200/80 rounded-xl overflow-hidden shadow-xs group-hover:shadow-xl transition-all duration-300">
                        <div class="h-64 sm:h-72 bg-slate-100 relative overflow-hidden group/photo">
                            <img src="{{ asset('images/9 BIMA TEGAR SAPUTRA IMG_0643.jpg') }}" alt="Bima Tegar Saputra"
                                class="w-full h-full object-cover object-top transition-transform duration-500 group-hover/photo:scale-105"
                                onerror="this.src='https://ui-avatars.com/api/?name=Bima+Tegar+Saputra&background=1E3A8A&color=fff&size=256'">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group/photo:opacity-100 transition-opacity duration-300 flex items-center justify-center p-2">
                                <span class="text-xs font-bold text-white bg-slate-900/80 backdrop-blur-xs px-3 py-1.5 rounded-md border border-white/20">Data Strategy</span>
                            </div>
                        </div>
                        <div class="p-5 text-left">
                            <span class="text-sky-700 text-[11px] font-bold bg-sky-50 py-1 px-2.5 rounded-md border border-sky-100 inline-block uppercase tracking-wider mb-2">Data Analyst</span>
                            <h3 class="font-extrabold text-tdkop-navy text-base sm:text-lg group-hover:text-blue-600 transition-colors truncate">Bima Tegar Saputra</h3>
                            <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 text-slate-600 text-xs font-medium">
                                <p class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> XI Rekayasa Perangkat Lunak
                                </p>
                                <p class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> SMKN 8 Jakarta
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer Modern & Interaktif -->
    <footer class="bg-tdkop-navy text-slate-300 border-t border-slate-800/80 relative overflow-hidden">
        <!-- Ambient Glow Background Effects -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12 relative z-10">

            <!-- Section Newsletter / Quick Interactive Card -->
            <div class="mb-14 p-6 sm:p-8 rounded-3xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-md flex flex-col lg:flex-row items-center justify-between gap-6 shadow-xl">
                <div>
                    <span class="inline-block px-3 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-semibold rounded-full mb-2">TDKop : Koperasi Modern SMK 8</span>
                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight">Belanja Kebutuhan Sekolah Lebih Praktis & Cepat</h3>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">Gunakan website TDKop untuk melakukan pemesanan seragam dan atribut sekolah tanpa harus repot mengantri.</p>
                </div>
                <a href="#katalog" class="shrink-0 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-xs rounded-2xl shadow-lg shadow-blue-500/25 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2 group">
                    <span>Jelajahi Katalog</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <!-- Main Footer Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <!-- Brand Column -->
                <div class="md:col-span-1 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-tr from-tdkop-primary to-blue-600 text-white px-3 py-1.5 rounded-2xl font-black text-xl tracking-wider shadow-lg shadow-blue-500/20 hover:scale-105 transition-transform duration-300">
                            TDKop
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Sistem pemesanan digital resmi Koperasi SMK Negeri 8 Jakarta. Belanja seragam & peralatan sekolah tanpa antri.
                    </p>
                    <!-- Status Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        <span>Sistem Koperasi Digital Aktif</span>
                    </div>
                </div>

                <!-- Navigasi -->
                <div>
                    <h4 class="text-white font-bold text-xs mb-5 uppercase tracking-widest text-slate-200 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Navigasi
                    </h4>
                    <ul class="space-y-3 text-xs sm:text-sm">
                        <li>
                            <a href="{{ url('/') }}" class="text-slate-400 hover:text-white hover:translate-x-1.5 transition-all duration-200 inline-flex items-center gap-1.5 group">
                                <span class="text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">›</span> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#katalog" class="text-slate-400 hover:text-white hover:translate-x-1.5 transition-all duration-200 inline-flex items-center gap-1.5 group">
                                <span class="text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">›</span> Katalog Produk
                            </a>
                        </li>
                        @auth
                        @if(auth()->user()->role === 'siswa')
                        <li>
                            <a href="{{ url('dashboard/siswa') }}" class="text-slate-400 hover:text-white hover:translate-x-1.5 transition-all duration-200 inline-flex items-center gap-1.5 group">
                                <span class="text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">›</span> Dashboard Siswa
                            </a>
                        </li>
                        @else
                        <li>
                            <a href="{{ url('dashboard/admin') }}" class="text-slate-400 hover:text-white hover:translate-x-1.5 transition-all duration-200 inline-flex items-center gap-1.5 group">
                                <span class="text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">›</span> Dashboard Admin
                            </a>
                        </li>
                        @endif
                        @else
                        <li>
                            <a href="{{ route('login') }}" class="text-slate-400 hover:text-white hover:translate-x-1.5 transition-all duration-200 inline-flex items-center gap-1.5 group">
                                <span class="text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">›</span> Masuk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-slate-400 hover:text-white hover:translate-x-1.5 transition-all duration-200 inline-flex items-center gap-1.5 group">
                                <span class="text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">›</span> Daftar Akun
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>

                <!-- Kategori -->
                <div>
                    <h4 class="text-white font-bold text-xs mb-5 uppercase tracking-widest text-slate-200 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Kategori
                    </h4>
                    <ul class="space-y-3 text-xs sm:text-sm">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('home', ['category' => $cat->slug]) }}#katalog" class="text-slate-400 hover:text-white hover:translate-x-1.5 transition-all duration-200 inline-flex items-center gap-1.5 group">
                                <span class="text-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity">›</span> {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="text-white font-bold text-xs mb-5 uppercase tracking-widest text-slate-200 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Hubungi Kami
                    </h4>
                    <ul class="space-y-3.5 text-xs sm:text-sm text-slate-400">
                        <li>
                            <a href="https://maps.app.goo.gl/j4B5Kzm5khtEQ5Yq5"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-start gap-3 group">
                                <div class="p-2 rounded-xl bg-slate-800/60 border border-slate-700/50 text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <span class="leading-relaxed hover:text-white transition-colors">Jl. Pejaten Raya, RT.6/RW.6, Pejaten Bar., Ps. Minggu, Jakarta Selatan 12510</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/qr/JMGSZHWLQSDZO1"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center gap-3 group">
                                <div class="p-2 rounded-xl bg-slate-800/60 border border-slate-700/50 text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                </div>
                                <span class="font-medium hover:text-white transition-colors">+62 21-1261-3649</span>
                            </a>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="p-2 rounded-xl bg-slate-800/60 border border-slate-700/50 text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <span class="font-medium hover:text-white transition-colors">koperasismknjkt@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright Area -->
            <div class="border-t border-slate-800/80 mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-400 font-medium text-center md:text-left">
                    &copy; {{ date('Y') }} <span class="text-white font-bold">TDKop</span> &mdash; Koperasi Digital SMK Negeri 8 Jakarta. Seluruh hak cipta dilindungi.
                </p>
                <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                    <span class="inline-block w-2 h-2 rounded-full bg-blue-500"></span>
                    <span>Dibuat untuk mendukung kegiatan koperasi sekolah</span>
                </div>
            </div>
        </div>
    </footer>
</x-layouts.app>