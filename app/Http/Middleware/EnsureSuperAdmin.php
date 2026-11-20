<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('customer.login');
        }

        // Project ini memakai role "admin" pada modul sebelumnya.
        // "super_admin" tetap didukung agar akun superadmin lama tidak terputus.
        if (!in_array($user->role, ['admin', 'super_admin'], true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman Admin.');
        }

        return $next($request);
    }
}
