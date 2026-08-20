<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date',
        ]);

        $dateFrom = Carbon::parse($request->input('date_from', now()->subDays(29)->toDateString()))->startOfDay();
        $dateTo = Carbon::parse($request->input('date_to', now()->toDateString()))->endOfDay();

        if ($dateFrom->gt($dateTo)) {
            [$dateFrom, $dateTo] = [$dateTo->copy()->startOfDay(), $dateFrom->copy()->endOfDay()];
        }

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        $totalProducts = Product::count();

        // Mengambil relasi 'user' beserta atribut terbarunya (seperti gender)
        $orders = Order::with(['user', 'details.product', 'details.size'])
            ->latest()
            ->get();

        $products = Product::with(['category', 'stocks.size'])->get();
        $categories = Category::all();
        $sizes = Size::all();

        $salesDetails = OrderDetail::with(['product:id,name', 'size:id,name,gender', 'order:id,order_date'])
            ->whereHas('order', function ($query) use ($dateFrom, $dateTo) {
                $query->where('status', 'completed')
                    ->whereBetween('order_date', [$dateFrom, $dateTo]);
            })
            ->get();

        $saleDates = $salesDetails
            ->map(fn ($detail) => $detail->order->order_date->toDateString())
            ->unique();
        $useHourlyTimeline = $saleDates->count() === 1 && $salesDetails->isNotEmpty();
        $timelineStart = $useHourlyTimeline
            ? $salesDetails->min(fn ($detail) => $detail->order->order_date)->copy()->startOfHour()
            : $dateFrom->copy()->startOfDay();
        $timelineEnd = $useHourlyTimeline
            ? $salesDetails->max(fn ($detail) => $detail->order->order_date)->copy()->startOfHour()
            : $dateTo->copy()->endOfDay();

        $dailySales = collect();
        for ($date = $timelineStart->copy(); $date->lte($timelineEnd); $date->add($useHourlyTimeline ? 1 : 1, $useHourlyTimeline ? 'hour' : 'day')) {
            $dailySales->push([
                'date' => $useHourlyTimeline ? $date->format('Y-m-d H:00') : $date->toDateString(),
                'label' => $useHourlyTimeline ? $date->format('H:i') : $date->format('d M'),
                'revenue' => 0,
                'units' => 0,
            ]);
        }

        $salesByDate = $useHourlyTimeline
            ? $salesDetails->groupBy(fn ($detail) => $detail->order->order_date->format('Y-m-d H:00'))
            : $salesDetails->groupBy(fn ($detail) => $detail->order->order_date->toDateString());
        $dailySales = $dailySales->map(function ($day) use ($salesByDate) {
            $details = $salesByDate->get($day['date'], collect());
            $day['revenue'] = (float) $details->sum('subtotal');
            $day['units'] = (int) $details->sum('quantity');

            return $day;
        });

        $topProducts = $salesDetails->groupBy('product_id')
            ->map(fn ($details) => [
                'name' => $details->first()->product->name,
                'units' => (int) $details->sum('quantity'),
                'revenue' => (float) $details->sum('subtotal'),
            ])
            ->sortByDesc('units')
            ->values()
            ->take(5);

        $genderSales = $salesDetails->groupBy(fn ($detail) => $detail->size->gender_label)
            ->map(fn ($details) => (int) $details->sum('quantity'));

        $salesSummary = [
            'revenue' => (float) $salesDetails->sum('subtotal'),
            'units' => (int) $salesDetails->sum('quantity'),
            'orders' => (int) $salesDetails->pluck('order_id')->unique()->count(),
            'average_order' => 0,
        ];
        $salesSummary['average_order'] = $salesSummary['orders'] > 0
            ? $salesSummary['revenue'] / $salesSummary['orders']
            : 0;

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'totalRevenue',
            'totalProducts',
            'orders',
            'products',
            'categories',
            'sizes',
            'dateFrom',
            'dateTo',
            'dailySales',
            'topProducts',
            'genderSales',
            'salesSummary'
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
            'stocks'      => 'nullable|array',
            'stocks.*'    => 'nullable|integer|min:0',
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

            // Simpan stok untuk seluruh size yang dikirim dari form
            if ($request->has('stocks')) {
                foreach ($request->stocks as $sizeId => $stockQty) {
                    if ($stockQty !== null && Size::whereKey($sizeId)->exists()) {
                        ProductStock::create([
                            'product_id' => $product->id,
                            'size_id'    => $sizeId,
                            'stock'      => (int)$stockQty,
                        ]);
                    }
                }
            }
        });

        return back()->with('success', "Produk baru berhasil ditambahkan!");
    }

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

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

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