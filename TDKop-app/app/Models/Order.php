<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'order_date',
        'total_price',
        'total_amount',
        'status',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Accessor: Badge Status Pesanan Warna Dinamis
    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'pending'     => ['label' => 'Pending', 'badge' => 'bg-amber-100 text-amber-700 border-amber-300'],
            'processing'  => ['label' => 'Diproses', 'badge' => 'bg-blue-100 text-blue-800 border-blue-300'],
            'ready'       => ['label' => 'Siap Diambil', 'badge' => 'bg-purple-100 text-purple-700 border-purple-300'],
            'completed'   => ['label' => 'Selesai', 'badge' => 'bg-emerald-100 text-emerald-800 border-emerald-300'],
            'cancelled'   => ['label' => 'Dibatalkan', 'badge' => 'bg-red-100 text-red-800 border-red-300'],
            'menunggu'    => ['label' => 'Menunggu Pembayaran/Proses', 'badge' => 'bg-slate-100 text-slate-700 border-slate-300'],
            'diproses'    => ['label' => 'Sedang Diproses Guru', 'badge' => 'bg-blue-100 text-blue-800 border-blue-300'],
            'siap_diambil' => ['label' => 'Siap Diambil di Koperasi', 'badge' => 'bg-amber-100 text-amber-800 border-amber-300'],
            'selesai'     => ['label' => 'Selesai / Sudah Diambil', 'badge' => 'bg-emerald-100 text-emerald-800 border-emerald-300'],
            'dibatalkan'  => ['label' => 'Dibatalkan', 'badge' => 'bg-red-100 text-red-800 border-red-300'],
            default       => ['label' => 'Unknown', 'badge' => 'bg-gray-100 text-gray-700 border-gray-300'],
        };
    }
}
