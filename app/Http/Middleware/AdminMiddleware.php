<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 695ff00fc8d74ed3d45b4c2880871e041b8e6c8a
