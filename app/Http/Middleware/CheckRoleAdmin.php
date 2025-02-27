<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleAdmin
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
        if ($request->session()->get('user', '[]')['role'] == 'admin' || $request->session()->get('user', '[]')['role'] == 'super admin') {
            return $next($request);
        }else {
            return redirect(url('/rekap-mancing'));
        }
    }
}
