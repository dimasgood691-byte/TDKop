<x-layouts.app title="Dashboard Siswa - TDKop">
    <!-- Navbar Siswa -->
    <nav class="bg-white border-b border-slate-100 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="bg-tdkop-primary text-white p-2 rounded-xl font-bold text-xl tracking-wider">TDK</a>
                <div>
                    <h1 class="font-bold text-tdkop-navy text-sm sm:text-base">Dashboard Siswa</h1>
                    <p class="text-[11px] text-slate-400">{{ auth()->user()->name }} ({{ auth()->user()->class }})</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs text-red-500 font-semibold bg-red-50 px-3 py-1.5 rounded-lg hover:bg-red-100 transition">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ activeTab: 'katalog', orderModal: false, selectedProduct: null }">

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-200 mb-6 text-sm font-medium">
            ✓ {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-50 text-red-700 p-4 rounded-xl border border-red-200 mb-6 text-sm font-medium">
            ✕ {{ session('error') }}
        </div>
        @endif

        <!-- Tab Switcher -->
        <div class="flex border-b border-slate-200 mb-8 space-x-8">
            <button @click="activeTab = 'katalog'" :class="activeTab === 'katalog' ? 'border-tdkop-primary text-tdkop-primary font-bold' : 'border-transparent text-slate-400'" class="pb-3 border-b-2 transition text-sm">
                🛍️ Buat Pesanan
            </button>
            <button @click="activeTab = 'riwayat'" :class="activeTab === 'riwayat' ? 'border-tdkop-primary text-tdkop-primary font-bold' : 'border-transparent text-slate-400'" class="pb-3 border-b-2 transition text-sm">
                📋 Riwayat Pesanan Saya ({{ $orders->count() }})
            </button>
        </div>

        <!-- TAB 1: KATALOG & FORM PEMESANAN -->
        <div x-show="activeTab === 'katalog'">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-tdkop-accent uppercase bg-sky-50 px-2 py-1 rounded">
                            {{ $product->category->name }}
                        </span>
                        <h3 class="font-bold text-tdkop-navy text-lg mt-2">{{ $product->name }}</h3>
                        <p class="text-slate-500 text-xs mt-1">{{ $product->description }}</p>
                        <div class="text-tdkop-primary font-extrabold text-xl mt-3">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <button @click="selectedProduct = {{ json_encode($product) }}; orderModal = true"
                        class="mt-4 w-full bg-tdkop-primary text-white py-2.5 rounded-xl font-semibold text-sm hover:bg-blue-800 transition">
                        + Pesan Barang
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- TAB 2: RIWAYAT PESANAN -->
        <div x-show="activeTab === 'riwayat'" style="display: none;">
            <div class="space-y-4">
                @forelse($orders as $order)
                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="flex items-center space-x-3">
                            <span class="font-mono font-bold text-tdkop-navy text-sm">{{ $order->order_number }}</span>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                    @if($order->status === 'pending') bg-amber-100 text-amber-700
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                                    @elseif($order->status === 'completed') bg-emerald-100 text-emerald-700
                                    @else bg-red-100 text-red-700 @endif">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="text-xs text-slate-500 mt-2">
                            @foreach($order->details as $detail)
                            <div>• {{ $detail->product->name }} (Ukuran: <strong>{{ $detail->size->name }}</strong>) x {{ $detail->quantity }} pcs</div>
                            @endforeach
                        </div>
                        @if($order->notes)
                        <p class="text-[11px] text-slate-400 italic mt-1">Catatan: {{ $order->notes }}</p>
                        @endif
                    </div>

                    <div class="text-right w-full md:w-auto border-t md:border-t-0 pt-3 md:pt-0 border-slate-100 flex flex-col items-end">
                        <span class="text-[10px] text-slate-400 block">Total Tagihan</span>
                        <span class="text-lg font-extrabold text-tdkop-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        <span class="text-[10px] text-slate-400 block mt-0.5 mb-2">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>

                        <a href="{{ route('order.receipt', $order->id) }}" target="_blank" class="inline-flex items-center gap-1 text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg font-semibold transition">
                            📄 Cetak Struk
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-slate-100">
                    <p class="text-slate-400 font-medium text-sm">Belum ada riwayat pesanan.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- MODAL FORM PESAN -->
        <div x-show="orderModal" x-transition class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4" style="display: none;">
            <div @click.away="orderModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
                <button @click="orderModal = false" class="absolute top-4 right-4 text-slate-400 font-bold hover:text-slate-600 transition">✕</button>

                <template x-if="selectedProduct">
                    <form action="{{ route('siswa.order.store') }}" method="POST">
                        @csrf
                        <h3 class="text-lg font-bold text-tdkop-navy" x-text="'Pesan ' + selectedProduct.name"></h3>
                        <p class="text-xs text-slate-500 mb-4" x-text="'Harga: Rp ' + new Intl.NumberFormat('id-ID').format(selectedProduct.price)"></p>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Pilih Ukuran & Cek Stok</label>
                                <select name="product_stock_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-tdkop-primary outline-none">
                                    <option value="">-- Pilih Ukuran --</option>
                                    <template x-for="stockItem in selectedProduct.stocks" :key="stockItem.id">
                                        <option :value="stockItem.id" :disabled="stockItem.stock <= 0" x-text="stockItem.size.name + ' (Sisa Stok: ' + stockItem.stock + ')'"></option>
                                    </template>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Jumlah (Pcs)</label>
                                <input type="number" name="quantity" min="1" value="1" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-tdkop-primary outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea name="notes" rows="2" placeholder="Contoh: Titip di Pak Koperasi" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-tdkop-primary outline-none"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="mt-6 w-full bg-tdkop-primary text-white py-3 rounded-xl font-bold text-sm hover:bg-blue-800 transition">
                            Konfirmasi Pesanan
                        </button>
                    </form>
                </template>
            </div>
        </div>
    </main>
</x-layouts.app>