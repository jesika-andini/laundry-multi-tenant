<?php

use App\Http\Middleware\EnsureSuperAdmin;
use App\Http\Middleware\ResolveTenantContext;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\SubstituteBindings;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'tenant.context' => ResolveTenantContext::class,
            'superadmin' => EnsureSuperAdmin::class,
            'role' => RoleMiddleware::class,
        ]);

        // Semua pengunjung yang membuka halaman terlindungi diarahkan ke login LaundryMap.
        $middleware->redirectGuestsTo(
            fn (Request $request): string => route('customer.login')
        );

        // Tenant context harus tersedia sebelum route model binding dijalankan.
        $middleware->prependToPriorityList(
            SubstituteBindings::class,
            ResolveTenantContext::class,
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request): bool => $request->is('api/*') || $request->expectsJson(),
        );
    })
    ->create();
