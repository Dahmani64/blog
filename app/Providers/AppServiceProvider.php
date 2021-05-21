<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\ViewComposers\HomeComposer;
use Illuminate\Support\Facades\{ Blade, View, Route };

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
        View::composer(['front.layout', 'front.index'], HomeComposer::class);
       
        Blade::if('request', function ($url) {
            return request()->is($url);
        });

        View::composer('back.layout', function ($view) {
            $title = config('titles.' . Route::currentRouteName());
            $view->with(compact('title'));
        });

        setlocale(LC_TIME, config('app.locale'));
    }

}
