<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role !== 'admin') {
            return redirect()
                ->route('home')
                ->withErrors(['akses' => 'Halaman Dasbor hanya dapat diakses menggunakan akun Admin.']);
        }

        return $next($request);
    }
}
