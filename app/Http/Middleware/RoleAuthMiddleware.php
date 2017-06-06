<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class RoleAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currRouteName = Route::currentRouteName(); // 当前路由别名
        $previousUrl = URL::previous(); // 用户访问的上一页
        if(!auth()->user()->hasPermission($currRouteName)){ // 如果是游客或者没有权限跳转到首页
            if($request->ajax()) {
                return response()->json([
                    'status' => -1,
                    'code' => 400,
                    'message' => '您没有权限执行此操作'
                ]);
            } else {
                // dd($request->ajax());
                return response()->view('errors.404', compact('previousUrl'));
            }
        }
        return $next($request);
    }
}
