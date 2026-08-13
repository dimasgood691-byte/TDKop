<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Cek apakah role user ada dalam daftar yang diizinkan (admin, guru, atau siswa)
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, tendang ke dashboard masing-masing
        return redirect($user->role === 'siswa' ? '/dashboard/siswa' : '/dashboard/admin')
            ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}