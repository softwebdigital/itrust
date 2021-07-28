<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('expire_time') && now()->gt(session('expire_time'))) {
            return redirect()->route('user.lock');
        }
        return $next($request);
    }
}
