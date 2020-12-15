<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role_1,$role_2)
    {
        if (auth()->user()->role == $role_1 or auth()->user()->role == $role_2)
            return $next($request);
        else
            return redirect(RouteServiceProvider::WEBSITE);
    }
}
