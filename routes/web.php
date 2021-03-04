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

        Route::get('faqs', 'DashboardController@faq');
        Route::get('faqs/addfaq', 'DashboardController@addeditfaq');
        Route::post('faqs/addfaq', 'DashboardController@addnew');
        Route::get('faqs/addfaq/{id}', 'DashboardController@editfaq');
        Route::get('faqs/delete/{id}', 'DashboardController@delete');

        Route::get('properties-headings', 'DashboardController@propertiesHeadings');
        Route::get('properties-headings/add-properties-heading', 'DashboardController@addPropertiesHeading');
        Route::post('properties-headings/add-properties-heading', 'DashboardController@postPropertiesHeading');
        Route::get('properties-headings/add-properties-heading/{id}', 'DashboardController@editPropertiesHeading');
        Route::get('properties-headings/delete/{id}', 'DashboardController@deletePropertiesHeading');

        Route::get('footer-headings', 'DashboardController@footerHeadings');
        Route::get('footer-headings/add-footer-heading', 'DashboardController@addFooterHeading');
        Route::post('footer-headings/add-footer-heading', 'DashboardController@postFooterHeading');
        Route::get('footer-headings/add-footer-heading/{id}', 'DashboardController@editFooterHeading');
        Route::get('footer-headings/delete/{id}', 'DashboardController@deleteFooterHeading');

        Route::get('footer-pages', 'DashboardController@footerPages')->name('footer-pages');
        Route::get('footer-pages/add-footer-page', 'DashboardController@addFooterPage')->name('add-footer-page');
        Route::post('footer-pages/add-footer-page', 'DashboardController@postFooterPage')->name('post-footer-page');
        Route::get('footer-pages/add-footer-page/{id}', 'DashboardController@editFooterPage')->name('edit-footer-page');
        Route::get('footer-pages/delete/{id}', 'DashboardController@deleteFooterPage')->name('delete-footer-page');


        Route::get('homes-inspiration', 'DashboardController@HomesInspiration')->name('homes-inspiration');
        Route::get('homes-inspiration/add-homes-inspiration', 'DashboardController@addHomesInspiration')->name('add-homes-inspiration');
        Route::post('homes-inspiration/add-homes-inspiration', 'DashboardController@postHomesInspiration')->name('post-homes-inspiration');
        Route::get('homes-inspiration/add-homes-inspiration/{id}', 'DashboardController@editHomesInspiration')->name('edit-homes-inspiration');
        Route::get('homes-inspiration/delete/{id}', 'DashboardController@deleteHomesInspiration')->name('delete-homes-inspiration');


        Route::get('tickets', 'DashboardController@tickets');
        Route::get('tickets/addticket', 'DashboardController@addeditticket');
        Route::post('tickets/addticket', 'DashboardController@postTicket');
        Route::get('tickets/addticket/{id}', 'DashboardController@editticket');
        Route::get('tickets/delete/{id}', 'DashboardController@deleteTicket');
        Route::post('tickets/update', 'DashboardController@update');
        Route::post('tickets/send-mail', 'DashboardController@SendMail');

        Route::get('blogs', 'BlogsController@blogslist')->name('blogs');
        Route::get('blogs/addblog', 'BlogsController@addeditblogs')->name('add-blog');
        Route::post('blogs/addblog', 'BlogsController@addnew')->name('post-blog');
        Route::get('blogs/addblog/{id}', 'BlogsController@editblog')->name('edit-blog');
        Route::get('blogs/delete/{id}', 'BlogsController@delete')->name('delete-blog');

        Route::get('moving-tips', 'BlogsController@blogslist')->name('moving-tips');
        Route::get('moving-tips/addmovingtip', 'BlogsController@addeditblogs')->name('add-moving-tip');
        Route::post('moving-tips/addmovingtip', 'BlogsController@addnew')->name('post-moving-tip');
        Route::get('moving-tips/addmovingtip/{id}', 'BlogsController@editblog')->name('edit-moving-tip');
        Route::get('moving-tips/delete/{id}', 'BlogsController@delete')->name('delete-moving-tip');

        Route::get('moving-tips/moving-tips-content', 'BlogsController@movingtipscontentlist');
        Route::get('moving-tips/addmovingtipscontent', 'BlogsController@addeditmovingtipscontent');
        Route::post('moving-tips/addmovingtipscontent', 'BlogsController@addnewmovingtipscontent');
        Route::get('moving-tips/addmovingtipscontent/{id}', 'BlogsController@editmovingtipscontent');
        Route::get('moving-tips/delete-moving-tips-content/{id}', 'BlogsController@deletemovingtipscontent');
        Route::get('moving-tips/changeheading', 'BlogsController@movingtipscontentheading');
        Route::post('moving-tips/changeheading', 'BlogsController@SaveMovingTipsContentHeading');

        Route::get('expats', 'BlogsController@blogslist')->name('expats');
        Route::get('expats/addexpat', 'BlogsController@addeditblogs')->name('add-expat');
        Route::post('expats/addexpat', 'BlogsController@addnew')->name('post-expat');
        Route::get('expats/addexpat/{id}', 'BlogsController@editblog')->name('edit-expat');
        Route::get('expats/delete/{id}', 'BlogsController@delete')->name('delete-expat');


        Route::get('properties', 'PropertiesController@propertieslist')->name('properties');
        Route::get('new_constructions', 'PropertiesController@newconstructionslist')->name('new_constructions');
        Route::get('home_exchange', 'PropertiesController@homeexchangelist')->name('home_exchange_list');
        Route::post('checkboxes', 'PropertiesController@Checkboxes');
        Route::get('properties/addproperty', 'PropertiesController@addeditproperty')->name('addproperty');
        Route::post('properties/addproperty', 'PropertiesController@addnew');
        Route::get('properties/addproperty/{id}', 'PropertiesController@editproperty')->name('addproperty');
        Route::get('properties/addnewconstruction', 'PropertiesController@addeditnewconstruction')->name('addnewconstruction');
        Route::get('properties/addnewconstruction/{id}', 'PropertiesController@editnewconstruction')->name('addnewconstruction');
        Route::get('properties/addhomeexchange', 'PropertiesController@addedithomeexchange')->name('addhomeexchange');
        Route::get('properties/addhomeexchange/{id}', 'PropertiesController@edithomeexchange')->name('addhomeexchange');
        Route::get('properties/status/{id}', 'PropertiesController@status');
        Route::get('properties/statusnewconstruction/{id}', 'PropertiesController@statusNewConstruction');
        Route::get('properties/statushomeexchange/{id}', 'PropertiesController@statusHomeExchange');

        Route::post('save-property', 'PropertiesController@saveProperty');
        Route::get('favourite-properties', 'PropertiesController@favouriteProperties');
        Route::get('saved-properties/delete/{id}', 'PropertiesController@savedPropertyDelete');

        Route::post('save-homes-inspiration', 'PropertiesController@saveInspiration');

        Route::get('properties/featuredproperty/{id}', 'PropertiesController@featuredproperty');
        Route::get('properties/featurednewconstruction/{id}', 'PropertiesController@featuredNewConstruction');
        Route::get('properties/featuredhomeexchange/{id}', 'PropertiesController@featuredHomeExchange');
        Route::get('properties/delete/{id}', 'PropertiesController@delete');
        Route::get('properties/deletenewconstruction/{id}', 'PropertiesController@deleteNewConstruction');
        Route::get('properties/deletehomeexchange/{id}', 'PropertiesController@deleteHomeExchange');
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

    Route::get('homes-inspiration/{id?}', 'IndexController@HomesInspiration')->name('front-homes-inspiration');

    Route::post('change-language', 'IndexController@changeLanguage');

    Route::get('blogs', 'IndexController@Blogs')->name('front-blogs');

    Route::get('blogs/{id}', 'IndexController@Blog')->name('front-blog');

    Route::get('verhuistips', 'IndexController@MovingTips')->name('front-moving-tips');

    Route::get('verhuistips/{id}', 'IndexController@MovingTip')->name('front-moving-tip');

    Route::get('expats', 'IndexController@Expats')->name('front-expats');

    Route::get('expats/{id}', 'IndexController@Expat')->name('front-expat');

    Route::get('footer-pages/{id}', 'IndexController@FooterPage')->name('front-footer-pages');

    Route::get('woningruil', 'PropertiesController@homeexchange')->name('homeexchange-front');

    Route::get('woningruil/home-exchange-search', 'PropertiesController@HomeExchangeSearch');

    Route::get('addproperty', 'PropertiesController@addeditproperty')->name('addproperty');

    Route::get('addhomeexchange', 'PropertiesController@addedithomeexchange')->name('addhomeexchange');

    Route::post('savepropertyalert', 'IndexController@savepropertyalert');

    Route::get('properties/alerts/delete/{id}', 'IndexController@unsubscribeAlert');

    Route::get('over-ons', 'IndexController@aboutus_page');

    Route::get('cookieverklaring', 'IndexController@careers_with_page');

    Route::get('algemene-voorwaarden', 'IndexController@terms_conditions_page');

    Route::get('privacy-beleid', 'IndexController@privacy_policy_page');

    Route::get('contact', 'IndexController@contact_us_page');

    Route::post('contact', 'IndexController@contact_us_sendemail');




    Route::post('subscribe', 'IndexController@subscribe');
    Route::post('cookie-save', 'IndexController@cookieSave');

    Route::get('makelaars', 'AgentsController@index')->name('agents-front');
    Route::post('makelaars/send-enquiry', 'AgentsController@SendEnquiry');

    Route::get('makelaars/details/{id}', 'AgentsController@employerDetail');
    Route::get('makelaars/{id}/property', 'AgentsController@employerproperties');
    Route::post('makelaars/searchbyName', 'AgentsController@searchByName');
    Route::post('makelaars/searchbyCity', 'AgentsController@searchByCity');
    Route::get('makelaars/filter/{alphabet}', 'AgentsController@filter');

    Route::get('builders', 'AgentsController@builder_list');

    Route::get('woningaanbod', 'PropertiesController@index')->name('properties-front');

    Route::get('nieuwbouwprojecten', 'PropertiesController@newconstructions')->name('newconstructions-front');

    Route::get('featured', 'PropertiesController@featuredproperties');

    Route::get('sale', 'PropertiesController@saleproperties');

    Route::get('rent', 'PropertiesController@rentproperties');

    Route::get('woningaanbod/{slug}', 'PropertiesController@propertysingle')->name('property-single');

    Route::get('nieuwbouwprojecten/{slug}', 'PropertiesController@newconstructionsingle')->name('newconstruction-single');

    Route::get('woningruil/{slug}', 'PropertiesController@homeexchangesingle')->name('homeexchange-single');

    Route::get('agent-properties/user/{id}/{property_id}', 'PropertiesController@propertiesUser')->name('agent-properties');

    Route::post('properties/store-travel-data', 'PropertiesController@storeTravelData');

    Route::post('properties/remove-travel-data', 'PropertiesController@removeTravelData');

    Route::post('properties/request-viewing', 'PropertiesController@PostRequestViewing')->name('request-viewing');

    Route::get('type/{slug}', 'PropertiesController@propertiesbytype');

    Route::post('agentscontact', 'PropertiesController@agentscontact');

    Route::post('alle-woningen', 'PropertiesController@searchproperties')->name('searchproperties');

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
Route::get('kolibri', 'IndexController@kolibri');
Route::get('images', 'IndexController@images');
Route::get('test-upload', 'IndexController@test');
Route::post('test-upload', 'IndexController@testUpload');
Route::get('login', 'IndexController@login');
Route::post('login', 'IndexController@postLogin');

Route::get('accountaanmaken', 'IndexController@register');
Route::post('accountaanmaken', 'IndexController@postRegister');
Route::post('form-submit', 'IndexController@formSubmit')->name('form-submit');

Route::get('logout', 'IndexController@logout');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('confirm-user-type', 'IndexController@ConfirmUserType');
    Route::post('confirm-type', 'IndexController@ConfirmType');
});
