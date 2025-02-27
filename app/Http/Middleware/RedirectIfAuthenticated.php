<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @param string|null ...$guards
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && $guard === 'user') {
                // メール認証が完了していない場合は、メール認証画面にリダイレクトする
                if (! Auth::user()->hasVerifiedEmail()) {
                    return redirect(RouteServiceProvider::USER_EMAIL_VERIFY);
                }
                return redirect(RouteServiceProvider::HOME);
            } elseif (Auth::guard($guard)->check() && $guard === 'admin') {
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }
        }

        return $next($request);
    }
}
