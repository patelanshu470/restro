<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Restaurant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        if(auth()->user()->role == 2){
            return $next($request);
        }
        return abort(403);
    }
}
