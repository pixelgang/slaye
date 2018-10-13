<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot(){

        \Validator::extend('alpha_spaces_dashes', function($attribute, $value){
            return preg_match('/^[a-z0-9 .\-]+$/i', $value);
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	
        //
    }
}
