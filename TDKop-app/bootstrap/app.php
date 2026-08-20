<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Alias Middleware Role
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // 2. Proteksi Payload Size (Mencegah DoS Upload File Raksasa)
        $middleware->append(ValidatePostSize::class);

        // 3. Security Headers via Middleware Class (Aman 100% Tanpa Error Closure)
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // 4. Tangani Exception Jika Upload Terlalu Besar
        $exceptions->render(function (PostTooLargeException $e, Request $request) {
            return back()->withErrors([
                'image' => 'Ukuran file atau data yang diunggah terlalu besar! Maksimal total upload adalah 8MB.'
            ]);
        });
    })
    ->create();