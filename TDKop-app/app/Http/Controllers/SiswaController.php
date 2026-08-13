<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = Product::with(['category', 'stocks.size'])->get();

        // Ambil riwayat pesanan siswa yang sedang login
        $orders = Order::with(['details.product', 'details.size'])
            ->where('user_id', $user?->id)
            ->latest()
            ->get();

        return view('siswa.dashboard', compact('products', 'orders'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'product_stock_id' => 'required|exists:product_stocks,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:255',
        ]);

        $stockItem = ProductStock::with('product')->findOrFail($request->product_stock_id);

        if ($stockItem->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi untuk ukuran yang dipilih.');
        }

        DB::transaction(function () use ($request, $stockItem) {
            $subtotal = $stockItem->product->price * $request->quantity;

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'order_date' => now(),
                'total_price' => $subtotal, // <-- Diubah dari 'total_amount' menjadi 'total_price'
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $stockItem->product_id,
                'size_id' => $stockItem->size_id,
                'quantity' => $request->quantity,
                'price' => $stockItem->product->price,
                'subtotal' => $subtotal,
            ]);

            $stockItem->decrement('stock', $request->quantity);
        });

        return back()->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran/konfirmasi di koperasi.');
    }

    public function printReceipt($id)
    {
        $order = Order::with(['user', 'details.product', 'details.size'])->findOrFail($id);

        if (Auth::check() && Auth::user()->role === 'siswa' && $order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order.receipt', compact('order'));
    }
}