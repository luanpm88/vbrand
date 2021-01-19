<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
class is_distinct
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
        if (Auth::check()) {
            $user = User::where('email',auth()->user()->email )->first();
            if(auth()->user()->is_admin){
                if(auth()->user()->token != $user->token ){
                    auth()->logout();
                    return redirect()->route('login')->with(['messenge'=>'Bạn đã đăng nhập trên thiết bị khác']);
                }
            }            
        }
        return $next($request);
    }
}
