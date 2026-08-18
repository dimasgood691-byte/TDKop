<x-layouts.app title="Dashboard Admin - TDKop">
    <!-- Navbar Admin (TIDAK DIUBAH) -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/80 shadow-xs transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand & User Profile Info -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="bg-gradient-to-tr from-sky-500 via-blue-600 to-indigo-900 text-white px-3.5 py-1.5 rounded-xl font-black text-xl tracking-wider shadow-md shadow-blue-500/20 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                    TDKop
                </a>
                <div>
                    <h1 class="font-extrabold text-tdkop-navy text-sm sm:text-base leading-tight">Dashboard Pengurus Koperasi</h1>
                    <p class="text-[11px] sm:text-xs text-slate-500 font-medium">
                        {{ auth()->user()->name }}
                        <span class="bg-sky-100 text-sky-800 font-bold px-2 py-0.5 rounded-md text-[10px] uppercase tracking-wider ml-1">
                            {{ auth()->user()->role }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Logout Action -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-rose-500 bg-slate-100/50 hover:bg-rose-50 p-2 rounded-full transition-colors" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ activeTab: 'orders', createModal: false, zoomImage: null }">

        <!-- Alerts -->
        @if(session('success'))
        <div class="bg-emerald-50 text-emerald-800 p-4 rounded-2xl border border-emerald-200 mb-6 text-sm font-semibold flex items-center gap-3 shadow-sm">
            <span class="bg-emerald-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">✓</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 text-red-800 p-4 rounded-2xl border border-red-200 mb-6 text-sm font-semibold shadow-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- HERO BANNER -->
        <div class="bg-gradient-to-r from-slate-900 via-blue-950 to-indigo-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl mb-8 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10">
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight mb-2">
                    Halo, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm max-w-2xl leading-relaxed">
                    Kelola pesanan siswa, pantau stok barang, dan perbarui katalog produk Koperasi SMK 8 dengan cepat dan praktis dari panel ini.
                </p>
            </div>
        </div>

        <!-- SUMMARY STATS CARDS -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Total Pesanan</span>
                    <span class="text-2xl sm:text-3xl font-black text-slate-800">{{ $totalOrders }}</span>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Perlu Diproses</span>
                    <span class="text-2xl sm:text-3xl font-black text-amber-500">{{ $pendingOrders }}</span>
                </div>
                <div class="p-3 bg-amber-50 text-amber-500 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Pendapatan</span>
                    <span class="text-xl sm:text-2xl font-black text-emerald-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Jenis Produk</span>
                    <span class="text-2xl sm:text-3xl font-black text-indigo-600">{{ $totalProducts }}</span>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- PILL TAB CONTROLS -->
        <div class="bg-slate-100/80 p-1.5 rounded-2xl inline-flex gap-2 mb-8 border border-slate-200/50">
            <button @click="activeTab = 'orders'"
                :class="activeTab === 'orders' ? 'bg-indigo-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                Pesanan Siswa
            </button>
            <button @click="activeTab = 'stocks'"
                :class="activeTab === 'stocks' ? 'bg-indigo-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                Manajemen Stok & Katalog
            </button>
        </div>

        <!-- TAB 1: KELOLA PESANAN -->
        <div x-show="activeTab === 'orders'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <thead class="bg-slate-50 border-b border-slate-100 text-slate-400 uppercase tracking-wider text-[11px] font-bold">
                            <tr>
                                <th class="p-4 sm:px-6">No. Transaksi</th>
                                <th class="p-4">Pemesan</th>
                                <th class="p-4">Detail Barang</th>
                                <th class="p-4">Total</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi Status</th>
                                <th class="p-4 sm:px-6 text-center">Struk</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-4 sm:px-6 font-mono font-bold text-slate-900">{{ $order->order_number }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-800">{{ $order->user->name }}</div>
                                    <div class="text-[11px] text-slate-400 font-medium">{{ $order->user->class }} • NIS: {{ $order->user->nis }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="space-y-1">
                                        @foreach($order->details as $detail)
                                        <div class="text-slate-700 font-medium">• {{ $detail->product->name }} <span class="text-xs text-slate-400">({{ $detail->size->name }})</span> <span class="font-bold text-slate-900">x{{ $detail->quantity }}</span></div>
                                        @endforeach
                                    </div>
                                    @if($order->notes)
                                    <div class="text-[11px] text-slate-400 italic mt-1.5 bg-slate-50 p-2 rounded-lg border border-slate-100">Catatan: {{ $order->notes }}</div>
                                    @endif
                                </td>
                                <td class="p-4 font-extrabold text-slate-900">Rp {{ number_format($order->total_price ?? $order->total_amount, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider inline-block
                                            @if($order->status === 'pending') bg-amber-50 text-amber-700 border border-amber-200
                                            @elseif($order->status === 'processing') bg-blue-50 text-blue-700 border border-blue-200
                                            @elseif($order->status === 'ready') bg-purple-50 text-purple-700 border border-purple-200
                                            @elseif($order->status === 'completed') bg-emerald-50 text-emerald-700 border border-emerald-200
                                            @else bg-red-50 text-red-700 border border-red-200 @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 text-xs border border-slate-200 rounded-xl bg-slate-50 hover:bg-white focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer font-bold text-slate-700 transition shadow-xs">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                                            <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Siap Diambil</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="p-4 sm:px-6 text-center">
                                    <a href="{{ route('order.receipt', $order->id) }}" target="_blank" class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-xl text-xs font-bold transition">
                                        Cetak Struk
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-12 text-center text-slate-400 font-semibold">Belum ada transaksi siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB 2: KELOLA STOK & KATALOG -->
        <div x-show="activeTab === 'stocks'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-lg font-black text-slate-800">Manajemen Produk & Stok</h2>
                    <p class="text-xs text-slate-400">Atur ketersediaan barang dan pembaruan katalog koperasi.</p>
                </div>
                <button @click="createModal = true" class="bg-indigo-900 hover:bg-black text-white font-bold text-xs sm:text-sm px-5 py-3 rounded-2xl shadow-md transition flex items-center gap-2">
                    + Tambah Produk Baru
                </button>
            </div>

            <!-- GRID KATALOG BARANG -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                    <div>
                        <!-- Container Gambar Produk (Object Contain agar Full Aspect Ratio) -->
                        <div class="h-64 bg-slate-50 relative overflow-hidden flex items-center justify-center p-4 border-b border-slate-100/60">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                @click="zoomImage = '{{ asset('storage/' . $product->image) }}'"
                                alt="{{ $product->name }}"
                                class="max-h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105 cursor-zoom-in">
                            @else
                            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">No Image Available</div>
                            @endif

                            <span class="absolute top-3 left-3 text-[10px] font-black text-sky-900 uppercase tracking-wider bg-white/90 backdrop-blur-md px-3 py-1 rounded-full shadow-xs border border-slate-100">
                                {{ $product->category->name }}
                            </span>

                            <!-- Form Hapus Quick Action -->
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="absolute top-3 right-3 z-10">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-white/90 hover:bg-rose-500 hover:text-white text-rose-500 p-2 rounded-full shadow-md backdrop-blur-md transition" title="Hapus Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Info Produk -->
                        <div class="p-5">
                            <h3 class="font-extrabold text-slate-800 text-base mb-2 line-clamp-1" title="{{ $product->name }}">{{ $product->name }}</h3>

                            <!-- Form Update Foto -->
                            <form action="{{ route('admin.product.image.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="mb-4 pb-4 border-b border-slate-100">
                                @csrf
                                @method('PATCH')
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ganti Foto Produk</label>
                                <div class="flex items-center gap-2">
                                    <input type="file" name="image" accept="image/*" required class="w-full text-[10px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                                    <button type="submit" class="bg-slate-800 hover:bg-black text-white text-[10px] px-3 py-1.5 rounded-xl font-bold transition shrink-0">
                                        Upload
                                    </button>
                                </div>
                            </form>

                            <!-- Form Update Harga -->
                            <form action="{{ route('admin.product.price.update', $product->id) }}" method="POST" class="mb-4">
                                @csrf
                                @method('PATCH')
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Harga Satuan</label>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-slate-500">Rp</span>
                                    <input type="number" name="price" value="{{ (int)$product->price }}" min="0" required class="w-full px-3 py-1.5 border border-slate-200 rounded-xl text-xs font-black text-emerald-600 outline-none focus:ring-2 focus:ring-emerald-500/30 bg-slate-50">
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs px-3 py-1.5 rounded-xl font-bold transition shrink-0">
                                        Simpan
                                    </button>
                                </div>
                            </form>

                            <!-- Update Stok Ukuran -->
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Manajemen Stok Ukuran</label>
                                <div class="space-y-2">
                                    @foreach($product->stocks as $stockItem)
                                    <form action="{{ route('admin.stock.update', $stockItem->id) }}" method="POST" class="flex items-center justify-between text-xs bg-slate-50 p-2 rounded-xl border border-slate-100">
                                        @csrf
                                        @method('PATCH')
                                        <span class="font-bold text-slate-700 ml-1">{{ $stockItem->size->name }}</span>
                                        <div class="flex items-center space-x-1.5">
                                            <input type="number" name="stock" value="{{ $stockItem->stock }}" min="0" class="w-14 px-2 py-1 border border-slate-200 rounded-lg text-center outline-none font-extrabold bg-white text-slate-800">
                                            <button type="submit" class="bg-indigo-900 text-white px-2.5 py-1 rounded-lg font-bold hover:bg-black transition text-[11px]">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- MODAL ZOOM GAMBAR (LIGHTBOX) -->
            <div x-show="zoomImage" x-transition class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4" style="display: none;">
                <div @click.away="zoomImage = null" class="relative max-w-4xl max-h-[90vh] bg-white rounded-3xl p-3 shadow-2xl overflow-hidden flex items-center justify-center">
                    <button @click="zoomImage = null" class="absolute top-4 right-4 text-slate-800 hover:text-rose-500 bg-white/80 backdrop-blur-md rounded-full p-2 font-black transition z-10">✕</button>
                    <img :src="zoomImage" class="max-h-[85vh] w-auto object-contain rounded-2xl">
                </div>
            </div>

            <!-- MODAL TAMBAH PRODUK -->
            <div x-show="createModal" x-transition class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4" style="display: none;">
                <div @click.away="createModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto border border-slate-100">

                    <button @click="createModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 font-bold text-base bg-slate-100 w-8 h-8 rounded-full flex items-center justify-center transition">✕</button>

                    <h3 class="text-xl font-black text-slate-900 mb-6">+ Tambah Produk Baru</h3>

                    <form x-data="{ selectedCatName: '' }" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Barang</label>
                            <select name="category_id" @change="selectedCatName = $event.target.options[$event.target.selectedIndex].text" required class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-xs font-medium focus:ring-2 focus:ring-blue-500 outline-none bg-slate-50/50">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Barang</label>
                            <input type="text" name="name" required placeholder="Contoh: Seragam Batik SMK 8" class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-blue-500 outline-none bg-slate-50/50">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Harga Satuan (Rp)</label>
                            <input type="number" name="price" required min="0" placeholder="115000" class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-blue-500 outline-none bg-slate-50/50">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi (Opsional)</label>
                            <textarea name="description" rows="2" placeholder="Bahan katun halus, nyaman..." class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-blue-500 outline-none bg-slate-50/50"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Foto Produk</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                        </div>

                        <hr class="my-4 border-slate-100">

                        <!-- Logika Ukuran Berdasarkan Kategori -->
                        <div x-show="selectedCatName !== ''">
                            <label class="block text-xs font-bold text-slate-800 mb-2">Stok Awal Berdasarkan Ukuran:</label>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($sizes as $size)
                                @php
                                $isStandard = (strtolower($size->name) === 'standard' || strtolower($size->name) === 'standar') ? 'true' : 'false';
                                @endphp

                                <div x-data="{ isStandard: {{ $isStandard }} }"
                                    x-show="selectedCatName.toLowerCase().includes('seragam') ? !isStandard : isStandard"
                                    class="flex items-center justify-between bg-slate-50 p-2.5 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-700">{{ $size->name }}</span>
                                    <input type="number" name="stocks[{{ $size->id }}]" min="0" value="0"
                                        x-bind:disabled="!(selectedCatName.toLowerCase().includes('seragam') ? !isStandard : isStandard)"
                                        class="w-16 px-2 py-1 border border-slate-200 rounded-xl text-xs text-center font-bold bg-white text-slate-800">
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-4 bg-indigo-900 hover:bg-black text-white py-3.5 rounded-2xl font-bold text-xs shadow-md transition">
                            Simpan Produk Baru
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>
</x-layouts.app>