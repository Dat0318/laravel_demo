<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Model\Category;
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
        
        view()->composer(['layouts.header','pages.checkout'], function ($view) {
            $categories = Category::all();
            $view->with('categories', $categories);
        });
        
        Schema::defaultStringLength(191);
    }
}
