<?php

namespace App\Http\Middleware;
use App;
use Closure;
class Locale
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
        if (session()->has('locale')) {
            App::setlocale(session()->get('locale'));
        }
        /*
        if (session()->exists('locale') ) {
            $locale = session()->get('locale');
            App::setLocale($locale);
        }
        */
        return $next($request);
    }
}
