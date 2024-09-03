<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\models\User;
class AdminMiddleware
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
        $role = $request->session()->get('Role');
        $user = $request->user();
        // Kiểm tra nếu người dùng không đăng nhập hoặc không có vai trò là admin
        if ($user && $role !== 'Admin') {

            abort(403, $role);
        }

        return $next($request);
    }


}

