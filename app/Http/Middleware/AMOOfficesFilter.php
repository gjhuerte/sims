<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AMOOfficesFilter
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

        if(Auth::user()->access == 1 || Auth::user()->access == 4 || Auth::user()->access == 5 )
        {
            return $next($request);
        }

        return redirect('/');
    }
}
