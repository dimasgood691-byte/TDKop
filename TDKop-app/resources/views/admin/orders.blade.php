<x-layouts.app title="Kelola Pesanan - Admin TDKop">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-tdkop-navy mb-6">📦 Kelola Pesanan Siswa</h2>

        @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-200 mb-6 text-sm font-semibold">
            ✓ {{ session('success') }}
        </div>
        @endif

        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <span class="font-mono font-bold text-tdkop-navy">{{ $order->order_number }}</span>
                        <span class="text-xs text-slate-500">• {{ $order->user->name }} ({{ $order->user->class }})</span>
                    </div>
                    <div class="text-xs text-slate-600 mt-2">
                        @foreach($order->details as $detail)
                        <div>- {{ $detail->product->name }} ({{ $detail->size->name }}) x {{ $detail->quantity }}</div>
                        @endforeach
                    </div>
                </div>

                <!-- Form Ubah Status -->
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 border border-slate-300 rounded-xl text-xs font-bold focus:ring-2 focus:ring-tdkop-primary outline-none bg-slate-50">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>⚙️ Diproses</option>
                        <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>🛍️ Siap Diambil</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Selesai</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Dibatalkan</option>
                    </select>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>