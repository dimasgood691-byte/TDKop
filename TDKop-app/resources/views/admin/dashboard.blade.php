<x-layouts.app title="Dashboard Admin - TDKop">
    <!-- Navbar Admin -->
    <nav class="bg-tdkop-navy border-b border-slate-800 text-white sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="bg-tdkop-primary text-white p-2 rounded-xl font-bold text-xl tracking-wider">TDK</a>
                <div>
                    <h1 class="font-bold text-sm sm:text-base">Panel Pengurus Koperasi</h1>
                    <p class="text-[11px] text-slate-400">{{ auth()->user()->name }} ({{ strtoupper(auth()->user()->role) }})</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs text-red-400 font-semibold bg-red-950/50 px-3 py-1.5 rounded-lg hover:bg-red-900/50 transition">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ activeTab: 'orders' }">

        <!-- Alerts -->
        @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-200 mb-6 text-sm font-medium">
            ✓ {{ session('success') }}
        </div>
        @endif

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                <span class="text-xs text-slate-400 font-medium block">Total Pesanan</span>
                <span class="text-2xl font-extrabold text-tdkop-navy">{{ $totalOrders }}</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                <span class="text-xs text-slate-400 font-medium block">Perlu Diproses (Pending)</span>
                <span class="text-2xl font-extrabold text-amber-600">{{ $pendingOrders }}</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                <span class="text-xs text-slate-400 font-medium block">Pendapatan (Selesai)</span>
                <span class="text-2xl font-extrabold text-emerald-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                <span class="text-xs text-slate-400 font-medium block">Total Jenis Produk</span>
                <span class="text-2xl font-extrabold text-tdkop-accent">{{ $totalProducts }}</span>
            </div>
        </div>

        <!-- Tab Controls -->
        <div class="flex border-b border-slate-200 mb-6 space-x-8">
            <button @click="activeTab = 'orders'" :class="activeTab === 'orders' ? 'border-tdkop-primary text-tdkop-primary font-bold' : 'border-transparent text-slate-400'" class="pb-3 border-b-2 transition text-sm">
                📦 Kelola Pesanan Siswa
            </button>
            <button @click="activeTab = 'stocks'" :class="activeTab === 'stocks' ? 'border-tdkop-primary text-tdkop-primary font-bold' : 'border-transparent text-slate-400'" class="pb-3 border-b-2 transition text-sm">
                🏷️ Management Stok Barang
            </button>
        </div>

        <!-- TAB 1: KELOLA PESANAN -->
        <div x-show="activeTab === 'orders'">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs md:text-sm">
                        <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase tracking-wider font-semibold">
                            <tr>
                                <th class="p-4">No. Transaksi</th>
                                <th class="p-4">Pemesan</th>
                                <th class="p-4">Detail Barang</th>
                                <th class="p-4">Total</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi Status</th>
                                <th class="p-4 text-center">Cetak Struk</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 font-mono font-bold text-tdkop-navy">{{ $order->order_number }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-800">{{ $order->user->name }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $order->user->class }} | NIS: {{ $order->user->nis }}</div>
                                </td>
                                <td class="p-4">
                                    @foreach($order->details as $detail)
                                    <div>• {{ $detail->product->name }} ({{ $detail->size->name }}) x{{ $detail->quantity }}</div>
                                    @endforeach
                                    @if($order->notes)
                                    <div class="text-[11px] text-slate-400 italic mt-0.5">Catatan: {{ $order->notes }}</div>
                                    @endif
                                </td>
                                <td class="p-4 font-bold text-tdkop-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase
                                            @if($order->status === 'pending') bg-amber-100 text-amber-700
                                            @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                                            @elseif($order->status === 'completed') bg-emerald-100 text-emerald-700
                                            @else bg-red-100 text-red-700 @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="flex items-center justify-center gap-1">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="px-2 py-1 text-xs border border-slate-200 rounded-lg bg-white outline-none cursor-pointer">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="{{ route('order.receipt', $order->id) }}" target="_blank" class="inline-flex items-center gap-1 bg-slate-100 hover:bg-slate-200 text-slate-700 px-2.5 py-1 rounded-lg text-xs font-semibold transition">
                                        📄 Struk
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">Belum ada transaksi siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB 2: KELOLA STOK BARANG -->
        <div x-show="activeTab === 'stocks'" style="display: none;">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
                    <span class="text-[10px] font-bold text-tdkop-accent uppercase bg-sky-50 px-2 py-1 rounded">
                        {{ $product->category->name }}
                    </span>
                    <h3 class="font-bold text-tdkop-navy text-base mt-2">{{ $product->name }}</h3>
                    <p class="text-xs text-tdkop-primary font-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <div class="space-y-2 border-t border-slate-100 pt-3">
                        @foreach($product->stocks as $stockItem)
                        <form action="{{ route('admin.stock.update', $stockItem->id) }}" method="POST" class="flex items-center justify-between text-xs bg-slate-50 p-2 rounded-lg">
                            @csrf
                            @method('PATCH')
                            <span class="font-semibold text-slate-700">Ukuran {{ $stockItem->size->name }}</span>
                            <div class="flex items-center space-x-2">
                                <input type="number" name="stock" value="{{ $stockItem->stock }}" min="0" class="w-16 px-2 py-1 border border-slate-300 rounded text-center outline-none">
                                <button type="submit" class="bg-tdkop-navy text-white px-2.5 py-1 rounded hover:bg-slate-800 transition">
                                    Update
                                </button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </main>
</x-layouts.app>