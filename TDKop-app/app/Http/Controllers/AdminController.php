<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Metric Summary
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $totalProducts = Product::count();

        // Daftar Pesanan Terbaru
        $orders = Order::with(['user', 'details.product', 'details.size'])
            ->latest()
            ->get();

        // Daftar Stok Produk
        $products = Product::with(['category', 'stocks.size'])->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'totalRevenue',
            'totalProducts',
            'orders',
            'products'
        ));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', "Status pesanan {$order->order_number} berhasil diperbarui.");
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $stock = ProductStock::findOrFail($id);
        $stock->update(['stock' => $request->stock]);

        return back()->with('success', "Stok berhasil diperbarui.");
    }
}
