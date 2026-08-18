<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\User;
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

        // Ambil isi keranjang belanja milik siswa yang sedang login
        $cartItems = Cart::with(['product', 'size'])
            ->where('user_id', $user?->id)
            ->get();

        // Ambil riwayat pesanan siswa yang sedang login
        $orders = Order::with(['details.product', 'details.size'])
            ->where('user_id', $user?->id)
            ->latest()
            ->get();

        return view('siswa.dashboard', compact('products', 'cartItems', 'orders', 'user'));
    }

    /**
     * FITUR 2: Menambahkan produk ke Keranjang Siswa
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_stock_id' => 'required|exists:product_stocks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stockItem = ProductStock::findOrFail($request->product_stock_id);

        if ($stockItem->stock < $request->quantity) {
            return back()->with('error', 'Stok barang tidak mencukupi untuk jumlah yang diminta.');
        }

        // Cek jika produk & ukuran yang sama sudah ada di keranjang siswa
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $stockItem->product_id)
            ->where('size_id', $stockItem->size_id)
            ->first();

        if ($existingCart) {
            // Jika sudah ada, tambahkan quantity-nya saja
            $existingCart->increment('quantity', $request->quantity);
        } else {
            // Jika belum ada, buat item keranjang baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $stockItem->product_id,
                'size_id' => $stockItem->size_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Barang berhasil dimasukkan ke keranjang!');
    }

    /**
     * Hapus item tertentu dari Keranjang Belanja
     */
    public function removeFromCart($id)
    {
        Cart::where('user_id', Auth::id())->where('id', $id)->delete();
        return back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }

    /**
     * FITUR 1 & 2: Process Checkout dari Keranjang & Tambah Point (+1 per qty)
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();

        // Ambil barang-barang di keranjang siswa
        $cartItems = Cart::with(['product', 'size'])
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kamu masih kosong!');
        }

        DB::transaction(function () use ($user, $cartItems, $request) {
            $totalPrice = 0;
            $totalItemsCount = 0; // Menghitung total jumlah barang untuk POIN

            foreach ($cartItems as $item) {
                $subtotal = $item->product->price * $item->quantity;
                $totalPrice += $subtotal;
                $totalItemsCount += $item->quantity; // 1 qty barang = +1 poin

                // Kurangi stok produk sesuai varian ukuran
                $stockItem = ProductStock::where('product_id', $item->product_id)
                    ->where('size_id', $item->size_id)
                    ->first();

                if ($stockItem && $stockItem->stock >= $item->quantity) {
                    $stockItem->decrement('stock', $item->quantity);
                }
            }

            // 1. Buat Header Order Utama
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'order_date' => now(),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            // 2. Simpan Rincian Produk (Order Details)
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'size_id' => $item->size_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);
            }

            // 3. FITUR 1: TAMBAH POIN SISWA (+1 poin untuk setiap 1 barang/qty yang dibeli)
            User::where('id', $user->id)->increment('points', $totalItemsCount);

            // 4. Kosongkan keranjang belanja siswa setelah checkout
            Cart::where('user_id', $user->id)->delete();
        });

        return back()->with('success', 'Pesanan berhasil dibuat! Poin kamu otomatis bertambah 🎉');
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
