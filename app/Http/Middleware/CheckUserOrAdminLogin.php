<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserOrAdminLogin
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
        if (Auth::guard('web')->check()) {
            // اگر لاگین است، اجازه عبور بده
            return $next($request);
        }

        if (! $request->expectsJson()) {
            return redirect()->route('user.login');
        }

        return response()->json(['message' => 'Unauthenticated.'], 401);
    }
}
