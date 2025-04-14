<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class karyawan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // app/Http/Middleware/Karyawan.php

public function handle(Request $request, Closure $next): Response
{
    if (Auth::check() && Auth::user()->usertype !== 'karyawan') {
        return redirect('/'); // Arahkan pengguna yang bukan karyawan
    }
    return $next($request);
}
    
}
