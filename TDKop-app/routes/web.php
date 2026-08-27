<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->middleware('throttle:5,1');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->middleware('throttle:3,1');
});


Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->middleware('throttle:3,1')->name('password.email');

    Route::get('/reset-password/{token}', function (Request $request, $token) {
        return view('auth.reset-password', ['request' => $request, 'token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60))->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->middleware('throttle:5,1')->name('password.update');
});


Route::middleware(['auth', 'role:siswa'])->prefix('dashboard/siswa')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/cart/add', [SiswaController::class, 'addToCart'])->name('siswa.cart.add');
    Route::delete('/cart/remove/{id}', [SiswaController::class, 'removeFromCart'])->name('siswa.cart.remove');
    Route::post('/checkout', [SiswaController::class, 'checkout'])->name('siswa.checkout');
});


Route::middleware(['auth', 'role:admin,guru'])->prefix('dashboard/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::patch('/order/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
    Route::patch('/stock/{id}', [AdminController::class, 'updateStock'])->name('admin.stock.update');
    Route::post('/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::patch('/product/{id}/price', [AdminController::class, 'updateProductPrice'])->name('admin.product.price.update');
    Route::delete('/product/{id}', [AdminController::class, 'destroyProduct'])->name('admin.product.destroy');
    Route::patch('/product/{id}/image', [AdminController::class, 'updateProductImage'])->name('admin.product.image.update');
});


Route::middleware('auth')->group(function () {
    Route::get('/order/{id}/receipt', [SiswaController::class, 'printReceipt'])->name('order.receipt');
});