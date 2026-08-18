<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        // Metric Summary
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Memakai total_price (atau sesuaikan dengan nama kolom di tabel orders kamu)
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        $totalProducts = Product::count();

        // Daftar Pesanan Terbaru
        $orders = Order::with(['user', 'details.product', 'details.size'])
            ->latest()
            ->get();

        // Daftar Stok Produk
        $products = Product::with(['category', 'stocks.size'])->get();

        // Data pendukung untuk Modal Tambah Produk Baru
        $categories = Category::all();
        $sizes = Size::all();

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'totalRevenue',
            'totalProducts',
            'orders',
            'products',
            'categories',
            'sizes'
        ));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,ready,completed,cancelled',
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

    public function storeProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'stocks'      => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
            }

            $product = Product::create([
                'category_id' => $request->category_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'price'       => $request->price,
                'description' => $request->description,
                'image'       => $imagePath,
            ]);

            foreach ($request->stocks as $sizeId => $stockQty) {
                if ($stockQty !== null && $stockQty >= 0) {
                    ProductStock::create([
                        'product_id' => $product->id,
                        'size_id'    => $sizeId,
                        'stock'      => $stockQty,
                    ]);
                }
            }
        });

        return back()->with('success', "Produk baru berhasil ditambahkan!");
    }

    // Update Harga Produk
    public function updateProductPrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'price' => $request->price
        ]);

        return back()->with('success', "Harga produk {$product->name} berhasil diperbarui.");
    }

    // Hapus Produk
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file foto dari storage jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus stok & produk dari database
        $product->stocks()->delete();
        $product->delete();

        return back()->with('success', "Produk berhasil dihapus.");
    }

    public function updateProductImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $imagePath = $request->file('image')->store('products', 'public');

        $product->update([
            'image' => $imagePath
        ]);

        return back()->with('success', "Foto produk {$product->name} berhasil diperbarui.");
    }
}
