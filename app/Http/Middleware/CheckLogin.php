<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Bạn cần đăng nhập để thêm giỏ hàng');
        }

        return $next($request);
    }
}

