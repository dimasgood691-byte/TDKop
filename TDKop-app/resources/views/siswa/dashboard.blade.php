<x-layouts.app title="Dashboard Siswa - TDKop">
    <!-- BUNGKUS KESELURUHAN DENGAN X-DATA -->
    <div x-data="{ activeTab: 'katalog', orderModal: false, selectedProduct: null, selectedImage: null, showImageModal: false }" class="min-h-screen bg-slate-50/50">

        <!-- Navbar Siswa (Glassmorphism Effect) -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/80 shadow-xs transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="bg-gradient-to-tr from-sky-500 via-blue-600 to-indigo-900 text-white px-3.5 py-1.5 rounded-xl font-black text-xl tracking-wider shadow-md shadow-blue-500/20 group-hover:scale-105 group-hover:shadow-lg group-hover:shadow-blue-500/30 transition-all duration-300">TDKop</a>
                    <div>
                        <h1 class="font-extrabold text-tdkop-navy text-sm sm:text-base leading-tight">Dashboard Siswa</h1>
                        <p class="text-[11px] sm:text-xs text-slate-500 font-medium">
                            {{ auth()->user()->name }}
                            <span class="bg-sky-100 text-sky-800 font-bold px-2 py-0.5 rounded-md text-[10px] uppercase tracking-wider ml-1">{{ auth()->user()->class }}</span>
                            <span class="bg-sky-100 text-sky-800 font-bold px-2 py-0.5 rounded-md text-[10px] uppercase tracking-wider ml-1">{{ auth()->user()->major ?? 'Jurusan belum diisi' }}</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-5">
                    {{-- WIDGET POIN SISWA (Modern Pill) --}}
                    <div class="flex items-center gap-2 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/50 pl-2 pr-3 py-1.5 rounded-full shadow-sm">
                        <div class="bg-white rounded-full p-1 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        <div class="text-xs font-bold bg-clip-text text-transparent bg-gradient-to-r from-amber-600 to-orange-600 hidden sm:block">
                            {{ number_format(auth()->user()->points ?? 0) }} pts
                        </div>
                        <div class="text-xs font-bold text-amber-600 block sm:hidden">
                            {{ number_format(auth()->user()->points ?? 0) }}
                        </div>
                    </div>

                    {{-- TOMBOL KERANJANG NAVBAR --}}
                    <button @click="activeTab = 'keranjang'"
                        :class="activeTab === 'keranjang' ? 'text-tdkop-primary bg-blue-50 border-blue-200' : 'text-slate-600 bg-white border-slate-200 hover:bg-slate-50'"
                        class="relative p-2 rounded-full border transition-all duration-200 shadow-sm hover:shadow flex items-center justify-center"
                        title="Keranjang Saya">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        @if($cartItems->sum('quantity') > 0)
                        <span class="absolute -top-1.5 -right-1.5 bg-rose-500 text-white text-[10px] font-bold h-5 w-5 flex items-center justify-center rounded-full border-2 border-white shadow-sm animate-bounce-short">
                            {{ $cartItems->sum('quantity') }}
                        </span>
                        @endif
                    </button>

                    {{-- LOGOUT --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-rose-500 bg-slate-100/50 hover:bg-rose-50 p-2 rounded-full transition-colors" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Hero Greeting Banner -->
            <div class="bg-gradient-to-r from-tdkop-navy via-tdkop-primary to-blue-500 rounded-3xl p-6 sm:p-10 mb-8 shadow-xl shadow-blue-900/10 relative overflow-hidden flex items-center justify-between">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-5 blur-3xl"></div>
                <div class="absolute bottom-0 right-32 w-40 h-40 rounded-full bg-blue-300 opacity-10 blur-2xl"></div>

                <div class="relative z-10">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-2">Halo, {{ auth()->user()->name }}!</h2>
                    <p class="text-blue-100 text-sm sm:text-base max-w-xl">Penuhi Seragam dan perlengkapan sekolahmu dengan mudah di TDKop. Belanja sekarang, kumpulkan poinnya, dan tukarkan dengan hadiah menarik <span class="font-bold text-red-700">!!!</span></p>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 px-5 py-4 rounded-2xl border border-emerald-200 mb-8 text-sm font-bold flex items-center gap-3 shadow-sm animate-fade-in-down">
                <div class="bg-emerald-100 p-1.5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-rose-50 text-rose-700 px-5 py-4 rounded-2xl border border-rose-200 mb-8 text-sm font-bold flex items-center gap-3 shadow-sm animate-fade-in-down">
                <div class="bg-rose-100 p-1.5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                {{ session('error') }}
            </div>
            @endif

            <!-- Tab Switcher -->
            <div class="flex overflow-x-auto pb-4 mb-4 hide-scrollbar">
                <div class="inline-flex bg-white border border-slate-200 p-1.5 rounded-2xl shadow-sm gap-1">
                    <button @click="activeTab = 'katalog'" :class="activeTab === 'katalog' ? 'bg-tdkop-primary text-white shadow-md' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100'" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Katalog Produk
                    </button>
                    <button @click="activeTab = 'riwayat'" :class="activeTab === 'riwayat' ? 'bg-tdkop-primary text-white shadow-md' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100'" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Riwayat Pesanan <span class="bg-white/20 px-2 py-0.5 rounded-full text-xs ml-1">{{ $orders->count() }}</span>
                    </button>
                </div>
            </div>

            <!-- TAB 1: KATALOG BARANG -->
            <div x-show="activeTab === 'katalog'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-7">
                    @forelse($products as $product)
                    <div class="relative group h-full flex flex-col">
                        <div class="absolute -inset-1 bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-600 rounded-3xl blur-md opacity-0 group-hover:opacity-30 transition-all duration-500"></div>

                        <div class="relative bg-white rounded-2xl border border-slate-200/80 overflow-hidden group-hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between h-full shadow-xs hover:shadow-xl">
                            <div>
                                <!-- Image Container -->
                                <div class="h-56 bg-slate-100/80 overflow-hidden relative group/img">
                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        @click="selectedProduct = {{ json_encode($product) }}; orderModal = true"
                                        class="w-full h-full object-cover group-hover/img:scale-110 transition-transform duration-700 ease-out cursor-pointer">
                                    <div @click="selectedProduct = {{ json_encode($product) }}; orderModal = true"
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

                                <button @click="selectedProduct = {{ json_encode($product) }}; orderModal = true"
                                    class="relative group/btn overflow-hidden bg-tdkop-navy hover:bg-tdkop-primary text-white text-xs px-4 py-2.5 rounded-xl font-bold transition-all duration-300 active:scale-95 shadow-xs flex items-center gap-1.5 cursor-pointer">
                                    <span class="relative z-10">Keranjang</span>
                                    <svg class="w-3.5 h-3.5 relative z-10 transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-3xl border border-slate-100 shadow-sm">
                        <p class="text-slate-400 font-medium">Belum ada produk yang tersedia saat ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 2: FITUR KERANJANG & CHECKOUT -->
            <div x-show="activeTab === 'keranjang'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                @if($cartItems->isNotEmpty())
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Kiri: Daftar Item -->
                    <div class="lg:col-span-2 space-y-4">
                        <h2 class="text-xl font-extrabold text-tdkop-navy mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-tdkop-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Barang Belanjaan ({{ $cartItems->count() }})
                        </h2>

                        @php $cartTotal = 0; @endphp
                        @foreach($cartItems as $item)
                        @php
                        $sub = $item->product->price * $item->quantity;
                        $cartTotal += $sub;
                        @endphp
                        <div class="bg-white rounded-3xl p-4 border border-slate-100 shadow-sm flex items-center justify-between gap-4 transition hover:shadow-md">
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-20 bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 shrink-0">
                                    @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-slate-800 text-base sm:text-lg">{{ $item->product->name }}</h4>
                                    <div class="flex flex-wrap items-center gap-2 mt-1">
                                        <span class="bg-slate-100 text-slate-600 text-[10px] font-bold px-2 py-0.5 rounded-md">Ukuran: {{ optional($item->size)->display_name ?? '-' }}</span>
                                        <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-0.5 rounded-md">{{ $item->quantity }} pcs</span>
                                    </div>
                                    <p class="text-sm font-black text-tdkop-primary mt-2">Rp {{ number_format($sub, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <form action="{{ route('siswa.cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all shadow-sm cursor-pointer" title="Hapus Barang">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>

                    <!-- Kanan: Ringkasan Checkout -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-xl shadow-slate-200/50 sticky top-24">
                            <h3 class="font-bold text-slate-800 mb-6 text-lg border-b border-slate-100 pb-4">Ringkasan Belanja</h3>

                            <form action="{{ route('siswa.checkout') }}" method="POST" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Catatan (Opsional)</label>
                                    <textarea name="notes" rows="2" placeholder="Cth: Titip di Pak Koperasi ya..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-tdkop-primary/50 focus:border-tdkop-primary outline-none transition resize-none"></textarea>
                                </div>

                                <div class="bg-gradient-to-br from-slate-50 to-slate-100 p-5 rounded-2xl border border-slate-200/60">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm text-slate-500 font-medium">Total Harga</span>
                                        <span class="text-xl font-black text-tdkop-navy">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-3 border-t border-slate-200/60 mt-3">
                                        <span class="text-xs text-slate-500 font-medium flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            Estimasi Poin
                                        </span>
                                        <span class="text-sm text-amber-600 font-extrabold">+{{ $cartItems->sum('quantity') }} Poin</span>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-tdkop-primary hover:bg-blue-700 text-white py-4 rounded-2xl font-bold text-base transition shadow-lg shadow-blue-600/30 flex items-center justify-center gap-2 cursor-pointer">
                                    Checkout Sekarang
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-white rounded-3xl p-12 border border-slate-100 shadow-sm text-center max-w-2xl mx-auto flex flex-col items-center">
                    <div class="w-32 h-32 bg-blue-50 rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-tdkop-navy mb-2">Keranjang Masih Kosong</h3>
                    <p class="text-slate-500 text-sm mb-8">Wah, belum ada barang yang kamu pilih nih. Yuk lihat-lihat katalog produk koperasi sekarang!</p>
                    <button @click="activeTab = 'katalog'" class="bg-slate-100 text-tdkop-navy hover:bg-tdkop-primary hover:text-white px-8 py-3 rounded-full font-bold text-sm transition-all flex items-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Mulai Belanja
                    </button>
                </div>
                @endif
            </div>

            <!-- TAB 3: RIWAYAT PESANAN -->
            <div x-show="activeTab === 'riwayat'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="space-y-5 max-w-4xl mx-auto">
                    @forelse($orders as $order)
                    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 
                            @if($order->status === 'pending') bg-amber-400 
                            @elseif($order->status === 'processing') bg-blue-400 
                            @elseif($order->status === 'completed') bg-emerald-400 
                            @else bg-rose-400 @endif">
                        </div>

                        <div class="pl-4 w-full md:w-auto flex-grow">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="font-mono font-black text-slate-800 bg-slate-100 px-3 py-1 rounded-lg text-sm tracking-wider">{{ $order->order_number }}</span>
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider flex items-center gap-1.5
                                        @if($order->status === 'pending') bg-amber-50 text-amber-600 border border-amber-200/50
                                        @elseif($order->status === 'processing') bg-blue-50 text-blue-600 border border-blue-200/50
                                        @elseif($order->status === 'completed') bg-emerald-50 text-emerald-600 border border-emerald-200/50
                                        @else bg-rose-50 text-rose-600 border border-rose-200/50 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full 
                                        @if($order->status === 'pending') bg-amber-500 
                                        @elseif($order->status === 'processing') bg-blue-500 
                                        @elseif($order->status === 'completed') bg-emerald-500 
                                        @else bg-rose-500 @endif"></span>
                                    {{ $order->status }}
                                </span>
                            </div>

                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                @foreach($order->details as $detail)
                                <div class="text-sm text-slate-600 mb-1 last:mb-0 flex items-start gap-2">
                                    <span class="text-tdkop-primary mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <span><span class="font-bold text-slate-800">{{ $detail->product->name }}</span> <span class="text-slate-400 text-xs">(Uk: {{ $detail->size->display_name }})</span> — <span class="font-bold">{{ $detail->quantity }} pcs</span></span>
                                </div>
                                @endforeach
                            </div>

                            @if($order->notes)
                            <p class="text-xs text-amber-600 bg-amber-50 inline-block px-3 py-1.5 rounded-lg font-medium mt-3 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Catatan: {{ $order->notes }}
                            </p>
                            @endif
                        </div>

                        <div class="text-right w-full md:w-auto border-t md:border-t-0 pt-4 md:pt-0 border-slate-100 flex flex-col items-end shrink-0 pl-0 md:pl-6 md:border-l">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Transaksi</span>
                            <span class="text-2xl font-black text-tdkop-navy mb-1">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            <span class="text-xs text-slate-500 font-medium block mb-4 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </span>

                            <a href="{{ route('order.receipt', $order->id) }}" target="_blank" class="w-full md:w-auto inline-flex items-center justify-center gap-2 text-sm bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-xl font-bold transition shadow-lg shadow-slate-900/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Cetak Struk
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16 bg-white rounded-3xl border border-slate-100 shadow-sm flex flex-col items-center">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Belum Ada Riwayat Pesanan</h3>
                        <p class="text-slate-400 text-sm mt-1">Pesanan yang kamu buat akan muncul di sini.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- TUNGGAL MODAL PEMESANAN PRODUL (UNIFIED MODAL) -->
            <div x-show="orderModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-md flex items-center justify-center p-4"
                style="display: none;">

                <div @click.away="orderModal = false" class="bg-white rounded-[2rem] max-w-md w-full p-6 sm:p-7 shadow-2xl relative border border-slate-100 max-h-[90vh] overflow-y-auto">
                    <!-- Close Button -->
                    <button @click="orderModal = false" class="absolute top-5 right-5 w-8 h-8 rounded-full bg-slate-100 text-slate-400 hover:text-slate-700 hover:bg-slate-200 font-bold transition-all duration-200 flex items-center justify-center z-20 cursor-pointer">✕</button>

                    <template x-if="selectedProduct">
                        <form action="{{ route('siswa.cart.add') }}" method="POST">
                            @csrf

                            <!-- Banner Image Header -->
                            <div class="relative w-full h-52 bg-slate-100 rounded-2xl overflow-hidden mb-6 group cursor-pointer"
                                @click="selectedImage = '/storage/' + selectedProduct.image; showImageModal = true">
                                <template x-if="selectedProduct.image">
                                    <div class="relative w-full h-full">
                                        <img :src="'/storage/' + selectedProduct.image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent flex flex-col justify-end p-5 text-white">
                                            <h3 class="text-xl font-extrabold leading-snug drop-shadow-sm" x-text="selectedProduct.name"></h3>
                                            <p class="text-sm font-bold text-slate-200 mt-1" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedProduct.price)"></p>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!selectedProduct.image">
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100/80">
                                        <svg class="w-10 h-10 mb-1 opacity-50" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m-9-9l9 5.25" />
                                        </svg>
                                        <span class="text-xs font-semibold">Belum Ada Foto</span>
                                    </div>
                                </template>
                            </div>

                            <!-- Input Forms -->
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-500 mb-2">
                                        Pilih Ukuran Tersedia
                                    </label>
                                    <div class="relative">
                                        <select name="product_stock_id" required
                                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-semibold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition-all appearance-none cursor-pointer">
                                            <option value="" disabled selected>-- Silakan Pilih --</option>
                                            <template x-for="item in selectedProduct.stocks" :key="item.id">
                                                <option :value="item.id" :disabled="item.stock <= 0"
                                                    x-text="item.size.display_name + (item.stock > 0 ? ' (Stok: ' + item.stock + ')' : ' - Habis')">
                                                </option>
                                            </template>
                                        </select>
                                        <svg class="w-4 h-4 text-slate-400 absolute right-4 top-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-500 mb-2">
                                        Jumlah (PCS)
                                    </label>
                                    <input type="number" name="quantity" value="1" min="1" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition-all">
                                </div>

                                <button type="submit"
                                    class="w-full mt-2 bg-tdkop-navy hover:bg-blue-800 text-white font-bold py-3.5 px-6 rounded-2xl shadow-lg shadow-blue-900/20 active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2.5 text-sm cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                                    </svg>
                                    <span>Tambah ke Keranjang</span>
                                </button>
                            </div>
                        </form>
                    </template>
                </div>
            </div>

            <!-- MODAL PREVIEW GAMBAR BESAR -->
            <div x-show="showImageModal" x-transition class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4" style="display: none;">
                <div @click.away="showImageModal = false" class="relative max-w-3xl w-full">
                    <button @click="showImageModal = false" class="absolute -top-12 right-0 text-white font-bold text-xl hover:text-slate-300">✕</button>
                    <img :src="selectedImage" class="w-full h-auto max-h-[85vh] object-contain rounded-2xl shadow-2xl">
                </div>
            </div>

        </main>
    </div>

    <!-- Styles CSS -->
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.4s ease-out forwards;
        }

        @keyframes bounce-short {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15%);
            }
        }
        .animate-bounce-short {
            animation: bounce-short 1s ease-in-out 3;
        }
    </style>
</x-layouts.app>