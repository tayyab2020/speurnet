<?php

namespace App\Providers;

use App\footer_pages;
use App\manage_pages;
use App\Observers\PropertiesObserver;
use App\Properties;
use App\user_languages;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\footer_headings;
use App\HomepageBoxes;
use App\categories_headings;
use App\categories;
use App\companies;

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

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }

        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        //whether ip is from remote address
        else
        {
            $ip_address = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
        }

        if($ip_address == '127.0.0.1')
        {
            \App::setLocale('du');
        }
        else
        {
            \App::setLocale('du');
        }

        /*$language = user_languages::where('ip','=',$ip_address)->first();

        if($language == '')
        {
            $language = new user_languages;
            $language->ip = $ip_address;
            $language->lang = 'du';
            $language->save();

            \App::setLocale('du');
        }
        else
        {
            \App::setLocale($language->lang);
        }*/

        $homepage_boxes = HomepageBoxes::get();

        $page_content = manage_pages::where('page',\Request::segment(1))->first();

        $footer_content = footer_pages::all();

        $footer_headings = footer_headings::all();

        // $categories_headings = categories_headings::all();
        // $categories = array();

        // foreach($categories_headings as $x => $key)
        // {
        //     $categories[$x] = companies::leftjoin("categories",\DB::raw("FIND_IN_SET(categories.id,companies.category_ids)"),">",\DB::raw("'0'"))->whereRaw("find_in_set('$key->id',categories.heading_ids)")->select('categories.*')->get();
        //     $categories[$x] = $categories[$x]->unique();
        // }

        // $without_heading_categories = companies::leftjoin("categories",\DB::raw("FIND_IN_SET(categories.id,companies.category_ids)"),">",\DB::raw("'0'"))->where('categories.heading_ids',NULL)->select('categories.*')->get();

        // View::share('categories_headings', $categories_headings);

        // View::share('categories', $categories);

        // View::share('without_heading_categories', $without_heading_categories);

        $categories = categories_headings::all();
        
        View::share('categories', $categories);
        
        View::share('homepage_boxes', $homepage_boxes);

        View::share('page_content', $page_content);

        View::share('footer_headings', $footer_headings);

        View::share('footer_content', $footer_content);
    }
}
