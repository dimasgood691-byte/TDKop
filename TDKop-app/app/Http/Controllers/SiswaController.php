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

        $cartItems = Cart::with(['product', 'size'])
            ->where('user_id', $user?->id)
            ->get();

        $orders = Order::with(['details.product', 'details.size'])
            ->where('user_id', $user?->id)
            ->latest()
            ->get();

        return view('siswa.dashboard', compact('products', 'cartItems', 'orders', 'user'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_stock_id' => 'required|exists:product_stocks,id',
            'quantity'         => 'required|integer|min:1|max:100',
        ]);

        $stockItem = ProductStock::findOrFail($request->product_stock_id);

        if ($stockItem->stock < $request->quantity) {
            return back()->with('error', 'Stok barang tidak mencukupi untuk jumlah yang diminta.');
        }

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $stockItem->product_id)
            ->where('size_id', $stockItem->size_id)
            ->first();

        if ($existingCart) {
            $existingCart->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $stockItem->product_id,
                'size_id'    => $stockItem->size_id,
                'quantity'   => $request->quantity,
            ]);
        }

        return back()->with('success', 'Barang berhasil dimasukkan ke keranjang!');
    }

    public function removeFromCart($id)
    {
        // Dipastikan hanya bisa menghapus item keranjang milik sendiri
        Cart::where('user_id', Auth::id())->where('id', $id)->delete();
        return back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $cartItems = Cart::with(['product', 'size'])
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kamu masih kosong!');
        }

        DB::transaction(function () use ($user, $cartItems, $request) {
            $totalPrice = 0;
            $totalItemsCount = 0;

            foreach ($cartItems as $item) {
                // Harga selalu diambil dari database backend, bukan input form
                $subtotal = $item->product->price * $item->quantity;
                $totalPrice += $subtotal;
                $totalItemsCount += $item->quantity;

                $stockItem = ProductStock::where('product_id', $item->product_id)
                    ->where('size_id', $item->size_id)
                    ->first();

                if ($stockItem && $stockItem->stock >= $item->quantity) {
                    $stockItem->decrement('stock', $item->quantity);
                }
            }

            $order = Order::create([
                'user_id'      => $user->id,
                'order_number' => 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'order_date'   => now(),
                'total_price'  => $totalPrice,
                'status'       => 'pending',
                'notes'        => $request->notes,
            ]);

            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'size_id'    => $item->size_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                    'subtotal'   => $item->product->price * $item->quantity,
                ]);
            }

            User::where('id', $user->id)->increment('points', $totalItemsCount);
            Cart::where('user_id', $user->id)->delete();
        });

        return back()->with('success', 'Pesanan berhasil dibuat! Harap ditunggu ya, pesanan kamu akan segera diproses.')->with('print_receipt', true);
    }

    public function printReceipt($id)
    {
        $order = Order::with(['user', 'details.product', 'details.size'])->findOrFail($id);

        // PROTEKSI IDOR: Siswa tidak bisa mengintip nota milik siswa lain!
        if (!in_array(Auth::user()->role, ['admin', 'guru']) && $order->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak! Kamu tidak berhak melihat struk belanja ini.');
        }

        return view('order.receipt', compact('order'));
    }
}