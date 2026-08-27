<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan - {{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen flex flex-col items-center justify-center p-4">

    
    <div class="no-print mb-4 flex gap-3">
        <button onclick="updateReceiptTimeBeforePrint(); window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold text-sm shadow hover:bg-blue-700 transition">
            🖨️ Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-bold text-sm hover:bg-slate-300 transition">
            Tutup
        </button>
    </div>

    
    <div class="bg-white p-6 rounded-2xl shadow-md border border-slate-200 w-full max-w-md text-slate-800">
        
        <div class="text-center border-b border-dashed border-slate-300 pb-4 mb-4">
            <h2 class="text-xl font-extrabold text-blue-900 tracking-wider">TDKop - SMKN 8 JAKARTA</h2>
            <p class="text-xs text-slate-500">Koperasi Siswa & Perlengkapan Sekolah</p>
            <p class="text-[10px] text-slate-400 mt-1">Jl. Pejaten Raya No.20, Pasar Minggu</p>
        </div>

        
        <div class="text-xs space-y-1 mb-4 border-b border-slate-100 pb-3">
            <div class="flex justify-between">
                <span class="text-slate-500">No. Transaksi:</span>
                <span class="font-bold font-mono">{{ $order->order_number }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Tanggal Cetak:</span>
                <span id="receipt-time">{{ now()->format('d/m/Y H:i') }} WIB</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Pemesan:</span>
                <span class="font-semibold">{{ $order->user->name }} ({{ $order->user->class }})</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Status:</span>
                <span class="font-bold uppercase text-blue-600">{{ $order->status }}</span>
            </div>
        </div>

        
        <table class="w-full text-xs mb-4">
            <thead>
                <tr class="border-b border-slate-200 text-slate-400 text-left">
                    <th class="pb-2">Barang</th>
                    <th class="pb-2 text-center">Qty</th>
                    <th class="pb-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($order->details as $detail)
                <tr>
                    <td class="py-2">
                        <div class="font-semibold">{{ $detail->product->name }}</div>
                        <div class="text-[10px] text-slate-400">Ukuran: {{ $detail->size->display_name }}</div>
                    </td>
                    <td class="py-2 text-center font-mono">{{ $detail->quantity }}</td>
                    <td class="py-2 text-right font-medium">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        
        <div class="border-t border-dashed border-slate-300 pt-3 flex justify-between items-center mb-6">
            <span class="font-bold text-sm">TOTAL BAYAR</span>
            <span class="font-extrabold text-lg text-blue-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
        </div>

        @if($order->notes)
        <div class="bg-slate-50 p-2 rounded text-[11px] text-slate-500 italic mb-4">
            Catatan: {{ $order->notes }}
        </div>
        @endif

        
        <div class="text-center text-[11px] text-slate-400 border-t border-slate-100 pt-3">
            <p>Tunjukkan struk ini ke pengurus Koperasi SMKN 8 untuk mengambil barang.</p>
            <p class="font-bold mt-1 text-slate-600">-- Terima Kasih --</p>
        </div>
    </div>

    <script>
        function updateReceiptTimeBeforePrint() {
            const timeEl = document.getElementById('receipt-time');
            if (!timeEl) return;

            const now = new Date();
            const formatted = new Intl.DateTimeFormat('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false,
                timeZone: 'Asia/Jakarta'
            }).format(now);

            timeEl.textContent = formatted + ' WIB';
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateReceiptTimeBeforePrint();
        });
    </script>

</body>

</html>