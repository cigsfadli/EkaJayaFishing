<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuth
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
        if($request->url() != url('auth/signin')){
            
            if ($request->session()->get('user', []) == null) {
                return redirect(url('auth/signin'));
            }

            return $next($request);

        }else{

            if ($request->session()->get('user', []) != null) {
                return redirect()->back();
            }

            return $next($request);
        }
    }
}
