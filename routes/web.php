<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['middleware' => 'App\Http\Middleware\UserTypeMiddleware'], function()
{
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

        Route::get('/', [ 'as' => 'login', 'uses' => 'IndexController@index']);
        Route::post('login', 'IndexController@postLogin');
        Route::get('logout', 'IndexController@logout');


        Route::get('dashboard', 'DashboardController@index');
        Route::get('profile', 'AdminController@profile');
        Route::post('profile', 'AdminController@updateProfile');
        Route::post('profile_pass', 'AdminController@updatePassword');
        Route::get('settings', 'SettingsController@settings');
        Route::post('settings', 'SettingsController@settingsUpdates');
        Route::post('social_links', 'SettingsController@social_links_update');
        Route::post('addthisdisqus', 'SettingsController@addthisdisqus');
        Route::post('about_us', 'SettingsController@about_us_page');
        Route::post('careers_with_us', 'SettingsController@careers_with_us_page');
        Route::post('terms_conditions', 'SettingsController@terms_conditions_page');
        Route::post('privacy_policy', 'SettingsController@privacy_policy_page');
        Route::post('headfootupdate', 'SettingsController@headfootupdate');

        Route::get('slider', 'SliderController@sliderlist');
        Route::get('slider/addslide', 'SliderController@addeditSlide');
        Route::post('slider/addslide', 'SliderController@addnew');
        Route::get('slider/addslide/{id}', 'SliderController@editSlide');
        Route::get('slider/delete/{id}', 'SliderController@delete');


        Route::get('testimonials', 'TestimonialsController@testimonialslist');
        Route::get('testimonials/addtestimonial', 'TestimonialsController@addeditestimonials');
        Route::post('testimonials/addtestimonial', 'TestimonialsController@addnew');
        Route::get('testimonials/addtestimonial/{id}', 'TestimonialsController@edittestimonial');
        Route::get('testimonials/delete/{id}', 'TestimonialsController@delete');


        Route::get('properties', 'PropertiesController@propertieslist')->name('properties');
        Route::get('new_constructions', 'PropertiesController@newconstructionslist')->name('new_constructions');
        Route::post('checkboxes', 'PropertiesController@Checkboxes');
        Route::get('properties/addproperty', 'PropertiesController@addeditproperty')->name('addproperty');
        Route::post('properties/addproperty', 'PropertiesController@addnew');
        Route::get('properties/addproperty/{id}', 'PropertiesController@editproperty');
        Route::get('properties/addnewconstruction', 'PropertiesController@addeditnewconstruction')->name('addnewconstruction');
        Route::get('properties/status/{id}', 'PropertiesController@status');

        Route::post('save-property', 'PropertiesController@saveProperty');
        Route::get('favourite-properties', 'PropertiesController@favouriteProperties');
        Route::get('saved-properties/delete/{id}', 'PropertiesController@savedPropertyDelete');



        Route::get('properties/featuredproperty/{id}', 'PropertiesController@featuredproperty');
        Route::get('properties/delete/{id}', 'PropertiesController@delete');
        Route::get('featuredproperties', 'FeaturedPropertiesController@propertieslist');


        Route::get('users', 'UsersController@userslist');
        Route::get('users/adduser', 'UsersController@addeditUser');
        Route::post('users/adduser', 'UsersController@addnew');
        Route::get('users/adduser/{id}', 'UsersController@editUser');
        Route::get('users/delete/{id}', 'UsersController@delete');



        Route::get('cities', 'CityController@citylist');
        Route::get('cities/addcity', 'CityController@addeditcity');
        Route::post('cities/addcity', 'CityController@addnew');
        Route::get('cities/addcity/{id}', 'CityController@editcity');
        Route::get('cities/delete/{id}', 'CityController@delete');
        Route::get('cities/status/{id}', 'CityController@status');



        Route::get('subscriber', 'SubscriberController@subscriberlist');
        Route::get('subscriber/delete/{id}', 'SubscriberController@delete');

        Route::get('partners', 'PartnersController@partnerslist');
        Route::get('partners/addpartners', 'PartnersController@addpartners');
        Route::post('partners/addpartners', 'PartnersController@addnew');
        Route::get('partners/addpartners/{id}', 'PartnersController@editpartners');
        Route::get('partners/delete/{id}', 'PartnersController@delete');

        Route::get('inquiries', 'InquiriesController@inquirieslist');
        Route::get('viewings', 'InquiriesController@viewingslist');
        Route::get('inquiries/show/{id}', 'InquiriesController@ShowInquiry');
        Route::get('viewings/show/{id}', 'InquiriesController@ShowView');
        Route::get('inquiries/delete/{id}', 'InquiriesController@delete');
        Route::get('viewings/delete/{id}', 'InquiriesController@Viewingsdelete');


        Route::get('types', 'TypesController@typeslist');
        Route::get('types/addtypes', 'TypesController@addedittypes');
        Route::post('types/addtypes', 'TypesController@addnew');
        Route::get('types/addtypes/{id}', 'TypesController@edittypes');
        Route::get('types/delete/{id}', 'TypesController@delete');

        Route::get('homepage-icons', 'SliderController@homepageIcons');
        Route::get('homepage-icons/addcontent', 'SliderController@addeditContent');
        Route::post('homepage-icons/addcontent', 'SliderController@addnewContent');
        Route::get('homepage-icons/addcontent/{id}', 'SliderController@editContent');
        Route::get('homepage-icons/delete/{id}', 'SliderController@deleteContent');

        Route::get('homepage-icons/changeheading', 'SliderController@changeHeading');
        Route::post('homepage-icons/changeheading', 'SliderController@SaveChangeHeading');

    });

    Route::get('/', 'IndexController@index');

    Route::post('savepropertyalert', 'IndexController@savepropertyalert');

    Route::get('properties/alerts/delete/{id}', 'IndexController@unsubscribeAlert');

    Route::get('about-us', 'IndexController@aboutus_page');

    Route::get('careers-with-us', 'IndexController@careers_with_page');

    Route::get('terms-conditions', 'IndexController@terms_conditions_page');

    Route::get('privacy-policy', 'IndexController@privacy_policy_page');

    Route::get('contact-us', 'IndexController@contact_us_page');

    Route::post('contact-us', 'IndexController@contact_us_sendemail');




    Route::post('subscribe', 'IndexController@subscribe');

    Route::get('agents', 'AgentsController@index');
    Route::post('agents', 'AgentsController@SearchAgents');

    Route::get('agents/details/{id}', 'AgentsController@employerDetail');
    Route::get('agents/{id}/property', 'AgentsController@employerproperties');
    Route::post('agents/searchbyName', 'AgentsController@searchByName');
    Route::post('agents/searchbyCity', 'AgentsController@searchByCity');
    Route::get('agents/filter/{alphabet}', 'AgentsController@filter');

    Route::get('builders', 'AgentsController@builder_list');

    Route::get('properties', 'PropertiesController@index')->name('properties-front');

    Route::get('new-constructions', 'PropertiesController@newconstructions')->name('newconstructions-front');

    Route::get('featured', 'PropertiesController@featuredproperties');

    Route::get('sale', 'PropertiesController@saleproperties');

    Route::get('rent', 'PropertiesController@rentproperties');

    Route::get('properties/{slug}', 'PropertiesController@propertysingle')->name('property-single');

    Route::get('new-constructions/{slug}', 'PropertiesController@newconstructionsingle')->name('newconstruction-single');

    Route::get('similar-properties/user/{id}/{property_id}', 'PropertiesController@propertiesUser');

    Route::post('properties/store-travel-data', 'PropertiesController@storeTravelData');

    Route::post('properties/remove-travel-data', 'PropertiesController@removeTravelData');

    Route::post('properties/request-viewing', 'PropertiesController@PostRequestViewing')->name('request-viewing');

    Route::get('type/{slug}', 'PropertiesController@propertiesbytype');

    Route::post('agentscontact', 'PropertiesController@agentscontact');

    Route::post('searchproperties', 'PropertiesController@searchproperties')->name('searchproperties');

    Route::post('searchnewconstructions', 'PropertiesController@searchnewconstructions')->name('searchnewconstructions');

    Route::post('search', 'PropertiesController@searchkeywordproperties');




// Password reset link request routes...
    Route::get('admin/password/email', 'Auth\PasswordController@getEmail');
    Route::post('admin/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
    Route::get('admin/password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('admin/password/reset', 'Auth\PasswordController@postReset');

    Route::get('auth/confirm/{code}', 'IndexController@confirm');

    Route::get ( '/redirect/{service}', 'IndexController@redirect' );

    Route::get ( '/callback/{service}', 'IndexController@callback' );

});


Route::get('/', 'IndexController@index');
Route::get('login', 'IndexController@login');
Route::post('login', 'IndexController@postLogin');

Route::get('register', 'IndexController@register');
Route::post('register', 'IndexController@postRegister');

Route::get('logout', 'IndexController@logout');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('confirm-user-type', 'IndexController@ConfirmUserType');
    Route::post('confirm-type', 'IndexController@ConfirmType');
});
