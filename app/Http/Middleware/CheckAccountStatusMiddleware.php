<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccountStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $status = auth()->user()['status'];
        if ($status == 'approved')
            return $next($request);
        elseif ($status == 'pending')
            return back()->with('warning', 'Your account is pending approval, make sure you have verified your identity');
        elseif ($status == 'declined')
            return back()->with('error', 'Your account approval is declined, contact admin for help');
        else
            return back()->with('error', 'Your account is currently suspended, contact admin for help');
    }
}
