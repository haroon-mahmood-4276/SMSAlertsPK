<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthRoute
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
        if (!session()->has('user_id') && !session()->has('company_nature') && $request->path() != 'login') {
            return redirect()->route('r.login')->with('AlertType', 'danger')->with('AlertMsg', 'Please login first');
        }
        if (session()->has('user_id') && session()->has('company_nature') && $request->path() == 'login') {
            return back();
        }
        return $next($request);
    }
}
