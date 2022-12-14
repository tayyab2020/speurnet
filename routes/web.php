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


        Route::get('manage-pages', 'DashboardController@ManagePages')->name('manage-pages');
        Route::get('manage-pages/add-manage-pages', 'DashboardController@addManagePage')->name('add-manage-page');
        Route::post('manage-pages/add-manage-pages', 'DashboardController@postManagePage')->name('post-manage-page');
        Route::get('manage-pages/add-manage-pages/{id}', 'DashboardController@editManagePage')->name('edit-manage-page');
        Route::get('manage-pages/delete/{id}', 'DashboardController@deleteManagePage')->name('delete-manage-page');


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

        Route::get('blog-categories', 'BlogsController@blogCategories')->name('blog-categories');
        Route::get('blog-categories/add', 'BlogsController@addBlogCategory')->name('add-blog-category');
        Route::post('blog-categories/add', 'BlogsController@addBlogCategoryPost')->name('post-blog-category');
        Route::get('blog-categories/add/{id}', 'BlogsController@editBlogCategory')->name('edit-blog-category');
        Route::get('blog-categories/delete/{id}', 'BlogsController@deleteBlogCategory')->name('delete-blog-category');

        Route::get('blogs', 'BlogsController@blogslist')->name('blogs');
        Route::get('blogs/description', 'BlogsController@blogsDescription');
        Route::post('blogs/description', 'BlogsController@blogsDescriptionPost');
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
        Route::post('rows-action', 'PropertiesController@rowsAction');
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


        Route::get('our-tips', 'SliderController@ourTips')->name('our-tips');
        Route::get('our-tips/addcontent', 'SliderController@addeditContent')->name('add-tips');
        Route::post('our-tips/addcontent', 'SliderController@addnewContent')->name('post-tips');
        Route::get('our-tips/addcontent/{id}', 'SliderController@editContent')->name('edit-tips');
        Route::get('our-tips/delete/{id}', 'SliderController@deleteContent')->name('delete-tips');

        Route::get('trendings', 'SliderController@Trendings')->name('trendings');
        Route::get('trendings/addcontent', 'SliderController@addTrending')->name('add-trending');
        Route::post('trendings/addcontent', 'SliderController@addTrendingPost');
        Route::get('trendings/addcontent/{id}', 'SliderController@editTrending')->name('edit-trending');
        Route::get('trendings/delete/{id}', 'SliderController@deleteTrending');

        Route::get('zoekhet', 'SliderController@Zoekhet')->name('zoekhet');
        Route::get('zoekhet/description', 'SliderController@ZoekhetDescription')->name('zoekhet-description');
        Route::post('zoekhet/description', 'SliderController@ZoekhetDescriptionPost');
        Route::get('zoekhet/add', 'SliderController@addZoekhet')->name('add-zoekhet');
        Route::post('zoekhet/add', 'SliderController@addZoekhetPost');
        Route::get('zoekhet/add/{id}', 'SliderController@editZoekhet')->name('edit-zoekhet');
        Route::get('zoekhet/delete/{id}', 'SliderController@deleteZoekhet');

        Route::get('zoekhet-categories', 'SliderController@ZoekhetCategories')->name('zoekhet-categories');
        Route::get('zoekhet-categories/addcategory', 'SliderController@addZoekhetCategory')->name('add-zoekhet-category');
        Route::post('zoekhet-categories/addcategory', 'SliderController@addZoekhetCategoryPost');
        Route::get('zoekhet-categories/addcategory/{id}', 'SliderController@editZoekhetCategory')->name('edit-zoekhet-category');
        Route::get('zoekhet-categories/delete/{id}', 'SliderController@deleteZoekhetCategory');

        Route::get('categories-headings', 'SliderController@CategoriesHeadings')->name('categories-headings');
        Route::get('categories-headings/addcategoryheading', 'SliderController@addCategoryHeading')->name('add-category-heading');
        Route::post('categories-headings/addcategoryheading', 'SliderController@addCategoryHeadingPost');
        Route::get('categories-headings/addcategoryheading/{id}', 'SliderController@editCategoryHeading')->name('edit-category-heading');
        Route::get('categories-headings/delete/{id}', 'SliderController@deleteCategoryHeading');

        Route::get('studies', 'SliderController@Studies')->name('studies');
        Route::get('study/addstudy', 'SliderController@addStudy')->name('add-study');
        Route::post('study/addstudy', 'SliderController@addStudyPost');
        Route::get('study/addstudy/{id}', 'SliderController@editStudy')->name('edit-study');
        Route::get('study/delete/{id}', 'SliderController@deleteStudy');
        
        Route::get('study-filters', 'SliderController@StudyFilters')->name('study-filters');
        Route::get('study-filters/addstudyfilter', 'SliderController@addStudyFilter')->name('add-study-filter');
        Route::post('study-filters/addstudyfilter', 'SliderController@addStudyFilterPost');
        Route::get('study-filters/addstudyfilter/{id}', 'SliderController@editStudyFilter')->name('edit-study-filter');
        Route::get('study-filters/delete/{id}', 'SliderController@deleteStudyFilter');

        Route::get('place-to-do-filters', 'SliderController@PlaceToDoFilters')->name('place-to-do-filters');
        Route::get('place-to-do-filters/addfilter', 'SliderController@addPlaceToDoFilter')->name('add-place-to-do-filter');
        Route::post('place-to-do-filters/addfilter', 'SliderController@addPlaceToDoFilterPost');
        Route::get('place-to-do-filters/addfilter/{id}', 'SliderController@editPlaceToDoFilter')->name('edit-place-to-do-filter');
        Route::get('place-to-do-filters/delete/{id}', 'SliderController@deletePlaceToDoFilter');

        Route::get('place-to-be-filters', 'SliderController@PlaceToBeFilters')->name('place-to-be-filters');
        Route::get('place-to-be-filters/addfilter', 'SliderController@addPlaceToBeFilter')->name('add-place-to-be-filter');
        Route::post('place-to-be-filters/addfilter', 'SliderController@addPlaceToBeFilterPost');
        Route::get('place-to-be-filters/addfilter/{id}', 'SliderController@editPlaceToBeFilter')->name('edit-place-to-be-filter');
        Route::get('place-to-be-filters/delete/{id}', 'SliderController@deletePlaceToBeFilter');

        Route::get('places', 'SliderController@Places')->name('places');
        Route::get('places/addplace', 'SliderController@addPlace')->name('add-place');
        Route::post('places/addplace', 'SliderController@addPlacePost');
        Route::get('places/addplace/{id}', 'SliderController@editPlace')->name('edit-place');
        Route::get('places/delete/{id}', 'SliderController@deletePlace');

        Route::get('place-to-be-places', 'SliderController@PlaceToBePlaces')->name('place-to-be-places');
        Route::get('place-to-be-places/addplace', 'SliderController@addPlaceToBePlace')->name('add-place-to-be-place');
        Route::post('place-to-be-places/addplace', 'SliderController@addPlaceToBePlacePost');
        Route::get('place-to-be-places/addplace/{id}', 'SliderController@editPlaceToBePlace')->name('edit-place-to-be-place');
        Route::get('place-to-be-places/delete/{id}', 'SliderController@deletePlaceToBePlace');

        Route::get('place-to-do-contents', 'SliderController@PlaceToDoContents')->name('place-to-do-contents');
        Route::get('place-to-do-content/add', 'SliderController@addPlaceToDoContent')->name('add-place-to-do-content');
        Route::post('place-to-do-content/add', 'SliderController@addPlaceToDoContentPost');
        Route::get('place-to-do-content/add/{id}', 'SliderController@editPlaceToDoContent')->name('edit-place-to-do-content');
        Route::get('place-to-do-content/delete/{id}', 'SliderController@deletePlaceToDoContent');
        Route::get('place-to-do-content/description', 'SliderController@PlaceToDoDescription')->name('place-to-do-description');
        Route::post('place-to-do-content/description', 'SliderController@PlaceToDoDescriptionPost');

        Route::get('place-to-be-contents', 'SliderController@PlaceToBeContents')->name('place-to-be-contents');
        Route::get('place-to-be-content/add', 'SliderController@addPlaceToBeContent')->name('add-place-to-be-content');
        Route::post('place-to-be-content/add', 'SliderController@addPlaceToBeContentPost');
        Route::get('place-to-be-content/add/{id}', 'SliderController@editPlaceToBeContent')->name('edit-place-to-be-content');
        Route::get('place-to-be-content/delete/{id}', 'SliderController@deletePlaceToBeDoContent');
        Route::get('place-to-be-content/description', 'SliderController@PlaceToBeDescription')->name('place-to-be-description');
        Route::post('place-to-be-content/description', 'SliderController@PlaceToBeDescriptionPost');

        Route::get('study-categories', 'SliderController@StudyCategories')->name('study-categories');
        Route::get('study-categories/addstudycategory', 'SliderController@addStudyCategory')->name('add-study-category');
        Route::post('study-categories/addstudycategory', 'SliderController@addStudyCategoryPost');
        Route::get('study-categories/addstudycategory/{id}', 'SliderController@editStudyCategory')->name('edit-study-category');
        Route::get('study-categories/delete/{id}', 'SliderController@deleteStudyCategory');

        Route::get('vactury-categories', 'SliderController@VacturyCategories')->name('vactury-categories');
        Route::get('vactury-categories/addvacturycategory', 'SliderController@addVacturyCategory')->name('add-vactury-category');
        Route::post('vactury-categories/addvacturycategory', 'SliderController@addVacturyCategoryPost');
        Route::get('vactury-categories/addvacturycategory/{id}', 'SliderController@editVacturyCategory')->name('edit-vactury-category');
        Route::get('vactury-categories/delete/{id}', 'SliderController@deleteVacturyCategory');

        Route::get('vactury-provinces', 'SliderController@VacturyProvinces')->name('vactury-provinces');
        Route::get('vactury-provinces/addvacturyprovince', 'SliderController@addVacturyProvince')->name('add-vactury-province');
        Route::post('vactury-provinces/addvacturyprovince', 'SliderController@addVacturyProvincePost');
        Route::get('vactury-provinces/addvacturyprovince/{id}', 'SliderController@editVacturyProvince')->name('edit-vactury-province');
        Route::get('vactury-provinces/delete/{id}', 'SliderController@deleteVacturyProvince');

        Route::get('vactury-description', 'SliderController@VacturyDescription')->name('vactury-description');
        Route::post('vactury-description', 'SliderController@VacturyDescriptionPost');
        Route::get('vactury', 'SliderController@Vactury')->name('vactury-content');
        Route::get('vactury/add', 'SliderController@addVactury')->name('add-vactury');
        Route::post('vactury/add', 'SliderController@addVacturyPost');
        Route::get('vactury/add/{id}', 'SliderController@editVactury')->name('edit-vactury');
        Route::get('vactury/delete/{id}', 'SliderController@deleteVactury');

        Route::get('offer-description', 'SliderController@OfferDescription')->name('offer-description');
        Route::post('offer-description', 'SliderController@OfferDescriptionPost');
        Route::get('offer-content', 'SliderController@OfferContent')->name('offer-content');
        Route::get('offer-content/add', 'SliderController@addOfferContent')->name('add-offer-content');
        Route::post('offer-content/add', 'SliderController@addOfferContentPost');
        Route::get('offer-content/add/{id}', 'SliderController@editOfferContent')->name('edit-offer-content');
        Route::get('offer-content/delete/{id}', 'SliderController@deleteOfferContent');

        Route::get('categories', 'SliderController@Categories')->name('categories');
        Route::get('categories/addcontent', 'SliderController@addCategory')->name('add-category');
        Route::post('categories/addcontent', 'SliderController@addCategoryPost');
        Route::get('categories/addcontent/{id}', 'SliderController@editCategory')->name('edit-category');
        Route::get('categories/delete/{id}', 'SliderController@deleteCategory');

        Route::get('companies', 'SliderController@Companies')->name('companies');
        Route::get('companies/addcontent', 'SliderController@addCompany')->name('add-company');
        Route::post('companies/addcontent', 'SliderController@addCompanyPost');
        Route::get('companies/addcontent/{id}', 'SliderController@editCompany')->name('edit-company');
        Route::get('companies/delete/{id}', 'SliderController@deleteCompany');

        Route::get('homepage-boxes', 'SliderController@homepageBoxes')->name('homepage-boxes');
        Route::get('homepage-boxes/addcontent', 'SliderController@addHomepageBox')->name('add-homepage-box');
        Route::post('homepage-boxes/addcontent', 'SliderController@addHomepageBoxPost');
        Route::get('homepage-boxes/addcontent/{id}', 'SliderController@editHomepageBox')->name('edit-homepage-box');
        Route::get('homepage-boxes/delete/{id}', 'SliderController@deleteHomepageBox');

        Route::get('company-tiles', 'SliderController@companyTiles')->name('company-tiles');
        Route::get('company-tiles/addcontent', 'SliderController@addCompanyTile')->name('add-company-tile');
        Route::post('company-tiles/addcontent', 'SliderController@addCompanyTilePost');
        Route::get('company-tiles/addcontent/{id}', 'SliderController@editCompanyTile')->name('edit-company-tile');
        Route::get('company-tiles/delete/{id}', 'SliderController@deleteCompanyTile');

        Route::get('our-favourites', 'SliderController@ourFavourites')->name('our-favourites');
        Route::get('our-favourites/addcontent', 'SliderController@addOurFavourite')->name('add-our-favourite');
        Route::post('our-favourites/addcontent', 'SliderController@addOurFavouritePost');
        Route::get('our-favourites/addcontent/{id}', 'SliderController@editOurFavourite')->name('edit-our-favourite');
        Route::get('our-favourites/delete/{id}', 'SliderController@deleteOurFavourite');

        Route::get('homepage-icons', 'SliderController@homepageIcons')->name('homepage-icons');
        Route::get('homepage-icons/addcontent', 'SliderController@addeditContent')->name('add-homepage');
        Route::post('homepage-icons/addcontent', 'SliderController@addnewContent')->name('post-homepage');
        Route::get('homepage-icons/addcontent/{id}', 'SliderController@editContent')->name('edit-homepage');
        Route::get('homepage-icons/delete/{id}', 'SliderController@deleteContent')->name('delete-homepage');

        Route::get('homepage-icons/changeheading', 'SliderController@changeHeading');
        Route::post('homepage-icons/changeheading', 'SliderController@SaveChangeHeading');

    });


    Route::get('/', 'IndexController@index');

    Route::get('place-to-do', 'IndexController@placeToDo')->name('place-to-do');

    Route::get('place-to-be', 'IndexController@placeToBe')->name('place-to-be');
    
    Route::get('offer', 'IndexController@offer')->name('offer');

    Route::post('submit-offer', 'IndexController@SubmitOffer')->name('submit-offer');
    
    Route::get('study', 'IndexController@study')->name('study');

    Route::get('vactury', 'IndexController@vactury')->name('vactury');

    Route::get('vactury-filter', 'IndexController@vacturyFilter');
    
    Route::get('page1', 'IndexController@page1')->name('page1');

    Route::get('education', 'IndexController@education')->name('education');

    Route::get('study/{id}', 'IndexController@studySingle')->name('education-single');

    Route::get('zoekhet', 'IndexController@zoekhet')->name('zoekhet');

    Route::post('filter-zoekhet', 'IndexController@filterZoekhet')->name('filter-zoekhet');

    Route::post('filter-place', 'IndexController@filterPlace')->name('filter-place');

    Route::post('filter-place-to-be', 'IndexController@filterPlaceToBe')->name('filter-place-to-be');
    
    Route::post('save-zoekhet', 'IndexController@saveZoekhet');

    Route::post('save-place', 'IndexController@savePlace');

    Route::get('company/{id}', 'IndexController@company')->name('company');

    Route::get('company-filter/{id?}', 'IndexController@companyFilter');

    Route::get('blogs', 'IndexController@NewBlogs')->name('blogs');

    Route::get('wooninspiratie/{id?}', 'IndexController@HomesInspiration')->name('front-homes-inspiration');

    Route::post('change-language', 'IndexController@changeLanguage');

    // Route::get('blogs', 'IndexController@Blogs')->name('front-blogs');

    Route::get('blogs/{id}', 'IndexController@Blog')->name('front-blog');

    Route::get('verhuistips', 'IndexController@MovingTips')->name('front-moving-tips');

    Route::get('verhuistips/{id}', 'IndexController@MovingTip')->name('front-moving-tip');

    Route::get('expats', 'IndexController@Expats')->name('front-expats');

    Route::get('expats/{id}', 'IndexController@Expat')->name('front-expat');

    Route::get('nl/{id}', 'IndexController@FooterPage')->name('front-footer-pages');

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

    // Route::post('search', 'PropertiesController@searchkeywordproperties');




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

Route::get('{slug}', function($slug) {

    $url = URL::to('/');

    $url = preg_replace('#^(http(s)?://)?w{3}\.#', '$1', $url);

    $blog = \App\footer_pages::where('meta_url','like', '%' . $url .'/'. $slug . '%')->first();

    if ( is_null($blog) )

        App::abort(404);

    return view('pages.blog',compact('blog'));
});

Route::get('{slug}/{slug1}', function($slug,$slug1) {

    $url = URL::to('/');

    $url = preg_replace('#^(http(s)?://)?w{3}\.#', '$1', $url);

    $blog = \App\footer_pages::where('meta_url','like', '%' . $url .'/'. $slug .'/'. $slug1 . '%')->first();

    if ( is_null($blog) )

        App::abort(404);

    return view('pages.blog',compact('blog'));
});
