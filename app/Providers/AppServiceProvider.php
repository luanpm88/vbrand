<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $category  = DB::table('category')->where('home', 1)->where('parent', '<', 1)->get();
        view()->share('maincate', $category);


        
    }
}
