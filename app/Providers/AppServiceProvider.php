<?php

namespace App\Providers;

use App\footer_pages;
use App\Observers\PropertiesObserver;
use App\Properties;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\footer_headings;

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
        Schema::defaultStringLength(191);
        /*Properties::observe(PropertiesObserver::class);*/

        $footer_content = footer_pages::all();

        $footer_headings = footer_headings::all();

        View::share('footer_headings', $footer_headings);

        View::share('footer_content', $footer_content);
    }
}
