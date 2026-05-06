<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // jika belum login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // kalau bukan admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // forbiden
        }

        return $next($request);
    }
}
