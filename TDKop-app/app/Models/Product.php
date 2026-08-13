<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_active',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(ProductStock::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Accessor: Total stok gabungan semua ukuran
    public function getTotalStockAttribute(): int
    {
        return $this->stocks->sum('stock');
    }

    // Accessor: Status Ketersediaan Dinamis (Tersedia / Menipis / Habis)
    public function getStockStatusAttribute(): array
    {
        $total = $this->total_stock;

        if ($total <= 0) {
            return ['label' => 'Habis', 'color' => 'red', 'badge' => 'bg-red-100 text-red-700 border-red-200'];
        } elseif ($total <= 5) {
            return ['label' => 'Stok Menipis', 'color' => 'amber', 'badge' => 'bg-amber-100 text-amber-800 border-amber-200'];
        }

        return ['label' => 'Tersedia', 'color' => 'emerald', 'badge' => 'bg-emerald-100 text-emerald-800 border-emerald-200'];
    }
}
