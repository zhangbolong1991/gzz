<?php

namespace App\Http\Middleware;

use Closure;

class QloginMiddleware
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
        if(session('username')){
            return $next($request);
        }else{
            return redirect('/hlogin')->with('error','亲,请先登录');
        }       
    }
}
