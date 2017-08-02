<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    protected $except = [
        'index',
//        'panel/init/password',
        'notify'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('/notify')->with('error','
                        <i class="icon fa fa-warning"></i>登录超时，<a href="#" class="login-time-out-mark" data-url="login"><strong>点击这里</strong></a> 重新登录!');
            }
        } else {
            $permissions = is_null(Session::get('permissions')) ? ['index'] : Session::get('permissions');
            if (!in_array($request -> path(), $permissions) && !in_array($request -> path(), $this -> except)) {
                return redirect('/notify') -> with('error',
                        '<i class="icon fa fa-warning"></i>您暂无该权限，请联系管理员！<a href="/main" class="go-back"><strong>点击这里</strong></a> 返回首页!');
            }
        }
        return $next($request);
    }
}
