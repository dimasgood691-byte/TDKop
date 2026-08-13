<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;

// Landing Page (Sekarang menggunakan HomeController)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth Routes (Login & Logout)
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
});

// Area Siswa (Hanya bisa diakses oleh role 'siswa')
Route::middleware(['auth', 'role:siswa'])->prefix('dashboard/siswa')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/order', [SiswaController::class, 'storeOrder'])->name('siswa.order.store');
});

// Area Admin/Guru (Hanya bisa diakses oleh role 'admin' atau 'guru')
Route::middleware(['auth', 'role:admin,guru'])->prefix('dashboard/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::patch('/order/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
    Route::patch('/stock/{id}', [AdminController::class, 'updateStock'])->name('admin.stock.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/order/{id}/receipt', [SiswaController::class, 'printReceipt'])->name('order.receipt');
});
