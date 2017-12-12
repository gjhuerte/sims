<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdministratorFilter
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
        if(Auth::user()->access != 0 )
        {
            return redirect('/');
        }

        return $next($request);
    }
}
