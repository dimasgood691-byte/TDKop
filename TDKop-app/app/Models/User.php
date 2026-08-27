<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass Assignment Protection
     * (Kolom 'role' sengaja tidak dimasukkan agar aman dari manipulasi form)
     */
    protected $fillable = [
        'name',
        'nis',
        'class',
        'major',
        'username',
        'email',
        'gender',
        'password',
        'points',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * RELASI HASMANY: Seorang User (Siswa) memiliki BANYAK Order (Pesanan)
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    /**
     * RELASI HASMANY: Seorang User (Siswa) memiliki BANYAK item di Keranjang (Cart)
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
}