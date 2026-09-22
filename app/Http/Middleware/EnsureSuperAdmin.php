<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isSuperAdmin()) {
            abort(403, 'Halaman ini khusus Super Admin. Minta akses ke Super Admin bila Anda membutuhkannya.');
        }

        return $next($request);
    }
}
