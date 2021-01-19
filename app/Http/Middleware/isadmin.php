<?php

namespace App\Http\Middleware;

use Closure;

class isadmin
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
        if(auth()->user()->is_admin){
            if(auth()->user()->is_admin == 1){
                return $next($request);
            }
        }
        return redirect()->back()->with(['messenge'=>'It seem misstake link !!!']);
    }
}
