<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ユーザーがログインしているがメールアドレスが未確認の場合
        if ($request->user() && !$request->user()->hasVerifiedEmail() && $request->user()->line_id === null) {
            // カスタムリダイレクトパスにリダイレクトする
            return Redirect::to('/user/email/verify');
        }
        return $next($request);
    }
}
