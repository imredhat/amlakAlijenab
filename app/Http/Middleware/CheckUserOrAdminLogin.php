<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

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
        if ($request->session()->has('user_id')) {
            $userId = $request->session()->get('user_id');

            if (User::where('id', $userId)->exists()) {
                return $next($request);
            }

            $request->session()->forget('user_id');
            $request->session()->save();
        }

        if (! $request->expectsJson()) {
            return redirect()->route('user.login');
        }

        return response()->json(['message' => 'Unauthenticated.'], 401);
    }
}
