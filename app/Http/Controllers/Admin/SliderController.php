<?php

namespace App\Http\Controllers\Admin;

use App\CompanyTiles;
use App\CompanyTilesDetails;
use App\OurFavourites;
use App\Settings;
use App\tips;
use App\Trendings;
use Auth;
use App\User;
use App\Slider;
use App\categories_headings;
use App\studies;
use App\study_filters;
use App\studies_features;
use App\studies_links;
use App\study_categories;
use App\place_to_do_filters;
use App\places;
use App\place_to_do_content;
use App\place_to_do_description;
use App\categories;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\HomepageIcons;
use App\HomepageBoxes;
use App\companies;
use App\zoekhet_categories;
use App\zoekhet_description;
use App\zoekhet;
use App\vactury_categories;
use App\vactury_provinces;
use App\vacturies;
use App\vactury_contents;

class SliderController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }
    public function sliderlist()
    {
        $allslider = Slider::orderBy('id')->get();

        return view('admin.pages.slider',compact('allslider'));
    }

    public function changeHeading()
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $heading = Settings::first();
        $heading = $heading->wyh_heading;

        return view('admin.pages.change_heading',compact('heading'));
    }

    public function SaveChangeHeading(Request $request)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }


        $heading = Settings::where('id',1)->update(['wyh_heading' => $request->title]);

        \Session::flash('flash_message', __('text.Changes Saved'));

        return \Redirect::back();
    }

    public function companyTiles()
    {
        $all = CompanyTiles::with('details')->orderBy('id')->get();

        return view('admin.pages.company_tiles',compact('all'));

    }

    public function addCompanyTile(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditcompanytiles');
    }

    public function addCompanyTilePost(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = CompanyTiles::findOrFail($inputs['id']);

        }else{

            $slide = new CompanyTiles();

        }

        $slide->title = $inputs['title'];
        $slide->save();

        $array = [];

        foreach ($request->tile_titles as $x => $key)
        {
            $check = CompanyTilesDetails::where('tile_id',$slide->id)->skip($x)->first();

            if($check)
            {
                if($key && $request->tile_urls[$x])
                {
                    $check->title = $key;
                    $check->url = $request->tile_urls[$x];
                    $check->save();
                }

                $array[] = $check->id;
            }
            else
            {
                if($key && $request->tile_urls[$x])
                {
                    $details = new CompanyTilesDetails;
                    $details->tile_id = $slide->id;
                    $details->title = $key;
                    $details->url = $request->tile_urls[$x];
                    $details->save();

                    $array[] = $details->id;
                }
            }
        }

        CompanyTilesDetails::whereNotIn('id',$array)->where('tile_id',$slide->id)->delete();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/company-tiles');

        }

    }

    public function editCompanyTile($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }


        $slide = CompanyTiles::with('details')->findOrFail($id);

        return view('admin.pages.addeditcompanytiles',compact('slide'));

    }

    public function deleteCompanyTile($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        CompanyTiles::findOrFail($id)->delete();
        CompanyTilesDetails::where('tile_id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function ourFavourites()
    {
        $all = OurFavourites::orderBy('id')->get();

        return view('admin.pages.our_favourites',compact('all'));

    }

    public function addourFavourite(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditourfavourite');
    }

    public function addOurFavouritePost(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'label' => 'required',
            'heading' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = OurFavourites::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath =  Str::slug($inputs['heading'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new OurFavourites;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath =  Str::slug($inputs['heading'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = '';
            }

        }


        $slide->title = $inputs['label'];
        $slide->title1 = $inputs['heading'];
        $slide->url = $inputs['url'];

        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/our-favourites');

        }

    }

    public function editOurFavourite($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = OurFavourites::findOrFail($id);

        return view('admin.pages.addeditourfavourite',compact('slide'));

    }

    public function deleteOurFavourite($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = OurFavourites::findOrFail($id);

        \File::delete(public_path() .'/upload/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function Companies()
    {
        $all = companies::orderBy('id','desc')->get();

        return view('admin.pages.companies',compact('all'));

    }

    public function addCompany(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $categories = categories_headings::all();

        return view('admin.pages.addeditcompany',compact('categories'));
    }

    public function addCompanyPost(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'address' => 'required',
            'city' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = companies::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new companies;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = '';
            }

        }

        $slide->title = $request->title;
        $slide->address = $request->address;
        $slide->city = $request->city;
        $slide->phone = $request->phone;
        $slide->website = $request->website;
        $slide->description = $request->description;
        $slide->category_ids = implode(',', $request->categories);
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/companies');

        }

    }

    public function editCompany($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = companies::findOrFail($id);

        $categories = categories_headings::all();

        return view('admin.pages.addeditcompany',compact('slide','categories'));

    }

    public function deleteCompany($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = companies::findOrFail($id);

        \File::delete(public_path() .'/upload/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function Categories()
    {
        $all = categories::orderBy('id','desc')->get();

        return view('admin.pages.categories',compact('all'));

    }

    public function addCategory(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $headings = categories_headings::all();

        return view('admin.pages.addeditCategory',compact('headings'));
    }

    public function addCategoryPost(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = categories::findOrFail($inputs['id']);

        }else{

            $slide = new categories;

        }

        $slide->title = $inputs['title'];
        $slide->heading_ids = implode(',', $request->headings) ? implode(',', $request->headings) : NULL;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/categories');

        }

    }

    public function editCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = categories::findOrFail($id);

        $headings = categories_headings::all();

        return view('admin.pages.addeditCategory',compact('slide','headings'));

    }

    public function deleteCategory($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        categories::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function ZoekhetCategories()
    {
        $all = zoekhet_categories::orderBy('id')->get();

        return view('admin.pages.zoekhet_categories',compact('all'));
    }

    public function addZoekhetCategory()
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditCategoryZoekhet');
    }

    public function addZoekhetCategoryPost(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'heading' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = zoekhet_categories::findOrFail($inputs['id']);

        }else{

            $slide = new zoekhet_categories;
        }


        $slide->heading = $inputs['heading'];
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/zoekhet-categories');

        }
    }

    public function editZoekhetCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = zoekhet_categories::findOrFail($id);

        return view('admin.pages.addeditCategoryZoekhet',compact('slide'));
    }

    public function deleteZoekhetCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        zoekhet_categories::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();
    }

    public function PlaceToDoContents()
    {
        $all = place_to_do_content::orderBy('id')->get();

        return view('admin.pages.place_to_do_contents',compact('all'));
    }

    public function PlaceToDoDescription()
    {
        $description = place_to_do_description::first();

        return view('admin.pages.place_to_do_description',compact('description'));
    }

    public function PlaceToDoDescriptionPost(Request $request)
    {
        $inputs = $request->all();

        if(!empty($inputs['id'])){

            $slide = place_to_do_description::findOrFail($inputs['id']);

        }else{

            $slide = new place_to_do_description;
        }

        $slide->title = $inputs['title'];
        $slide->description = $inputs['description'];
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/place-to-do-content/description');

        }
    }

    public function addPlaceToDoContent()
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $filters = place_to_do_filters::all();
        $places = places::all();

        return view('admin.pages.add_place_to_do_content',compact('filters','places'));
    }

    public function addPlaceToDoContentPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = place_to_do_content::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new place_to_do_content;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = NULL;
            }

        }

        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->filter_ids = implode(',', $request->filters);
        $slide->place_ids = implode(',', $request->places);
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/place-to-do-contents');

        }
    }

    public function editPlaceToDoContent($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = place_to_do_content::findOrFail($id);
        $filters = place_to_do_filters::all();
        $places = places::all();

        return view('admin.pages.add_place_to_do_content',compact('slide','filters','places'));

    }

    public function deletePlaceToDoContent($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = place_to_do_content::findOrFail($id);

        \File::delete(public_path() .'/upload/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function Zoekhet()
    {
        $all = zoekhet::orderBy('id')->get();

        return view('admin.pages.zoekhet',compact('all'));
    }

    public function ZoekhetDescription()
    {
        $description = zoekhet_description::first();

        return view('admin.pages.zoekhet_description',compact('description'));
    }

    public function ZoekhetDescriptionPost(Request $request)
    {
        $inputs = $request->all();

        if(!empty($inputs['id'])){

            $slide = zoekhet_description::findOrFail($inputs['id']);

        }else{

            $slide = new zoekhet_description;
        }

        $slide->title = $inputs['title'];
        $slide->description = $inputs['description'];
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/zoekhet/description');

        }
    }

    public function addZoekhet()
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $categories = zoekhet_categories::all();

        return view('admin.pages.addeditZoekhet',compact('categories'));
    }

    public function addZoekhetPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = zoekhet::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new zoekhet;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = NULL;
            }

        }

        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->category_ids = implode(',', $request->categories);
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/zoekhet');

        }
    }

    public function editZoekhet($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = zoekhet::findOrFail($id);

        $categories = zoekhet_categories::all();

        return view('admin.pages.addeditZoekhet',compact('slide','categories'));

    }

    public function deleteZoekhet($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = zoekhet::findOrFail($id);

        \File::delete(public_path() .'/upload/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function Studies()
    {
        $all = studies::leftjoin('study_categories','study_categories.id','=','studies.category')->orderBy('studies.id')->select('studies.*','study_categories.title as category')->get();

        return view('admin.pages.studies',compact('all'));

    }

    public function addStudy(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $categories = study_categories::get();
        $types = study_filters::get();

        return view('admin.pages.addeditstudies',compact('categories','types'));
    }

    public function addStudyPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'address' => 'required',
            'date_time' => 'required',
            'category' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = studies::findOrFail($inputs['id']);

            $features = studies_features::where('study_id',$inputs['id'])->get();
            $links = studies_links::where('study_id',$inputs['id'])->get();

        }else{

            $slide = new studies;

        }

        $slide->title = $request->title;
        $slide->venue = $request->venue;
        $slide->description = $request->description;
        $slide->address = $request->address;
        $slide->date_time = $request->date_time;
        $slide->category = $request->category;
        $slide->types = implode(',', $request->types) ? implode(',', array_filter($request->types)) : NULL;
        $slide->save();

        $feature_ids = array();
        $link_ids = array();

        if($request->feature_headings1)
        {
            foreach($request->feature_headings1 as $x => $key)
            {
                $feature = studies_features::where('study_id',$slide->id)->skip($x)->first();
    
                $slide_image = isset($request->file('feature_images')[$x]) ? $request->file('feature_images')[$x] : NULL;
        
                if($slide_image){
                    
                    if($feature)
                    {
                        \File::delete(public_path() .'/upload/'.$feature->image);
                    }
                    
                    $tmpFilePath = 'upload/';
                    $filename = $_FILES['feature_images']['name'][$x];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $hardPath = Str::slug($key, '-').'-'.md5(time()) .'.'.$ext;
                    $img = Image::make($slide_image);
                    $img->save($tmpFilePath.$hardPath);
                    $image = $hardPath;
        
                }
                else
                {
                    if($feature)
                    {
                        $image = $feature->image;
                    }
                    else
                    {
                        $image = NULL;
                    }
                }
    
                if(!$feature)
                {
                    $feature = new studies_features;
                    $feature->study_id = $slide->id;
                }
    
                $feature->image = $image;
                $feature->heading1 = $key;
                $feature->heading2 = $request->feature_headings2[$x];
                $feature->save();
    
                $feature_ids[] = $feature->id;
            }
    
        }

        studies_features::where('study_id',$slide->id)->whereNotIn('id',$feature_ids)->delete();

        if($request->link_titles)
        {
            foreach($request->link_titles as $x => $key)
            {
                $link = studies_links::where('study_id',$slide->id)->skip($x)->first();
    
                $slide_image = isset($request->file('link_images')[$x]) ? $request->file('link_images')[$x] : NULL;
        
                if($slide_image){
                    
                    if($link)
                    {
                        \File::delete(public_path() .'/upload/'.$link->image);
                    }
                    
                    $tmpFilePath = 'upload/';
                    $filename = $_FILES['link_images']['name'][$x];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $hardPath = Str::slug($key, '-').'-'.md5(time()) .'.'.$ext;
                    $img = Image::make($slide_image);
                    $img->save($tmpFilePath.$hardPath);
                    $image = $hardPath;
        
                }
                else
                {
                    if($link)
                    {
                        $image = $link->image;
                    }
                    else
                    {
                        $image = NULL;
                    }
                }
    
                if(!$link)
                {
                    $link = new studies_links;
                    $link->study_id = $slide->id;
                }
    
                $link->image = $image;
                $link->title = $key;
                $link->link = $request->link_urls[$x];
                $link->save();
    
                $link_ids[] = $link->id;
            }
        }

        studies_links::where('study_id',$slide->id)->whereNotIn('id',$link_ids)->delete();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/studies');

        }

    }

    public function editStudy($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = studies::findOrFail($id);
        $categories = study_categories::get();
        $types = study_filters::get();
        $features = studies_features::where('study_id',$id)->get();
        $links = studies_links::where('study_id',$id)->get();

        return view('admin.pages.addeditstudies',compact('slide','categories','types','features','links'));

    }

    public function deleteStudy($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        studies::findOrFail($id)->delete();
        studies_features::where('study_id',$id)->delete();
        studies_links::where('study_id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function VacturyDescription(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = vacturies::first();

        return view('admin.pages.addeditvacturiesdescription',compact('slide'));
    }

    public function VacturyDescriptionPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'description' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = vacturies::findOrFail($inputs['id']);

        }else{

            $slide = new vacturies;

        }

        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();

        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/vactury-description');

        }

    }

    public function Vactury()
    {
        $all = vactury_contents::leftjoin("vactury_categories","vactury_categories.id","=","vactury_contents.category")->orderBy('vactury_contents.id')->select("vactury_contents.*","vactury_categories.title as category")->get();

        return view('admin.pages.vacturies',compact('all'));

    }

    public function addVactury(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $categories = vactury_categories::get();
        $provinces = vactury_provinces::get();

        return view('admin.pages.addeditvacturies',compact('categories','provinces'));
    }

    public function addVacturyPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'category' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = vactury_contents::where('id',$inputs['id'])->first();

        }else{

            $slide = new vactury_contents;

        }

        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->url_title = $request->url_title;
        $slide->url = $request->url;
        $slide->category = $request->category;
        $slide->provinces = implode(',', $request->provinces) ? implode(',', array_filter($request->provinces)) : NULL;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/vactury');

        }

    }

    public function editVactury($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = vactury_contents::select("vactury_contents.*","vactury_contents.provinces as provinces1")->findOrFail($id);
        $categories = vactury_categories::get();
        $provinces = vactury_provinces::get();

        return view('admin.pages.addeditvacturies',compact('slide','categories','provinces'));

    }

    public function deleteVactury($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        vactury_contents::where('id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function VacturyProvinces()
    {
        $all = vactury_provinces::orderBy('id')->get();

        return view('admin.pages.vactury_provinces',compact('all'));

    }

    public function addVacturyProvince(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditVacturyProvince');
    }

    public function addVacturyProvincePost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = vactury_provinces::findOrFail($inputs['id']);

        }else{

            $slide = new vactury_provinces;

        }

        $slide->title = $request->title;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/vactury-provinces');

        }

    }

    public function editVacturyProvince($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = vactury_provinces::findOrFail($id);

        return view('admin.pages.addeditVacturyProvince',compact('slide'));

    }

    public function deleteVacturyProvince($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        vactury_provinces::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function VacturyCategories()
    {
        $all = vactury_categories::orderBy('id')->get();

        return view('admin.pages.vactury_categories',compact('all'));

    }

    public function addVacturyCategory(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditVacturyCategory');
    }

    public function addVacturyCategoryPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = vactury_categories::findOrFail($inputs['id']);

        }else{

            $slide = new vactury_categories;

        }

        $slide->title = $request->title;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/vactury-categories');

        }

    }

    public function editVacturyCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = vactury_categories::findOrFail($id);

        return view('admin.pages.addeditVacturyCategory',compact('slide'));

    }

    public function deleteVacturyCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        vactury_categories::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function StudyCategories()
    {
        $all = study_categories::orderBy('id')->get();

        return view('admin.pages.study_categories',compact('all'));

    }

    public function addStudyCategory(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditStudyCategory');
    }

    public function addStudyCategoryPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = study_categories::findOrFail($inputs['id']);

        }else{

            $slide = new study_categories;

        }

        $slide->title = $request->title;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/study-categories');

        }

    }

    public function editStudyCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = study_categories::findOrFail($id);

        return view('admin.pages.addeditStudyCategory',compact('slide'));

    }

    public function deleteStudyCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        study_categories::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function Places()
    {
        $all = places::orderBy('id')->get();

        return view('admin.pages.places',compact('all'));
    }

    public function addPlace(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.add_place');
    }

    public function addPlacePost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = places::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new places;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = NULL;
            }

        }

        $slide->title = $request->title;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/places');

        }

    }

    public function editPlace($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = places::findOrFail($id);

        return view('admin.pages.add_place',compact('slide'));

    }

    public function deletePlace($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = places::findOrFail($id);

        \File::delete(public_path() .'/upload/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function PlaceToDoFilters()
    {
        $all = place_to_do_filters::orderBy('id')->get();

        return view('admin.pages.place_to_do_filters',compact('all'));
    }

    public function addPlaceToDoFilter(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.add_place_to_do_filter');
    }

    public function addPlaceToDoFilterPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = place_to_do_filters::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new place_to_do_filters;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = NULL;
            }

        }

        $slide->title = $request->title;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/place-to-do-filters');

        }

    }

    public function editPlaceToDoFilter($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = place_to_do_filters::findOrFail($id);

        return view('admin.pages.add_place_to_do_filter',compact('slide'));

    }

    public function deletePlaceToDoFilter($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = place_to_do_filters::findOrFail($id);

        \File::delete(public_path() .'/upload/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function StudyFilters()
    {
        $all = study_filters::orderBy('id')->get();

        return view('admin.pages.study_filters',compact('all'));

    }

    public function addStudyFilter(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditStudyFilter');
    }

    public function addStudyFilterPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = study_filters::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new study_filters;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath = Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = NULL;
            }

        }

        $slide->title = $request->title;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/study-filters');

        }

    }

    public function editStudyFilter($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = study_filters::findOrFail($id);

        return view('admin.pages.addeditStudyFilter',compact('slide'));

    }

    public function deleteStudyFilter($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = study_filters::findOrFail($id);

        \File::delete(public_path() .'/upload/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function CategoriesHeadings()
    {
        $all = categories_headings::orderBy('id')->get();

        return view('admin.pages.categories_headings',compact('all'));

    }

    public function addCategoryHeading(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditCategoryHeading');
    }

    public function addCategoryHeadingPost(Request $request)
    {
        $data = \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'heading' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = categories_headings::findOrFail($inputs['id']);

        }else{

            $slide = new categories_headings;
        }


        $slide->heading = $inputs['heading'];
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/categories-headings');

        }

    }

    public function editCategoryHeading($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = categories_headings::findOrFail($id);

        return view('admin.pages.addeditCategoryHeading',compact('slide'));

    }

    public function deleteCategoryHeading($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        categories_headings::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function Trendings()
    {
        $all = Trendings::orderBy('id')->get();

        return view('admin.pages.trendings',compact('all'));

    }

    public function addTrending(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addedittrending');
    }

    public function addTrendingPost(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'description' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = Trendings::findOrFail($inputs['id']);

        }else{

            $slide = new Trendings;

        }


        $slide->description = $inputs['description'];
        $slide->url = $inputs['url'];

        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/trendings');

        }

    }

    public function editTrending($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }


        $slide = Trendings::findOrFail($id);

        return view('admin.pages.addedittrending',compact('slide'));

    }

    public function deleteTrending($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        Trendings::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function homepageBoxes()
    {
        $all = HomepageBoxes::orderBy('id')->get();

        return view('admin.pages.homepage_boxes',compact('all'));

    }

    public function addHomepageBox(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }
        
        $check = HomepageBoxes::get();

        if(count($check) == 3)
        {
            \Session::flash('flash_message', 'Cant create more than 3 boxes!');

            return \Redirect::back();
        }

        return view('admin.pages.addedithomepagebox');
    }

    public function addHomepageBoxPost(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = HomepageBoxes::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new HomepageBoxes;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/'.$slide->image);

                $tmpFilePath = 'upload/';

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = '';
            }

        }


        $slide->title = $inputs['title'];
        $slide->url = $inputs['url'];

        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/homepage-boxes');

        }

    }

    public function editHomepageBox($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }


        $slide = HomepageBoxes::findOrFail($id);

        return view('admin.pages.addedithomepagebox',compact('slide'));

    }

    public function deleteHomepageBox($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = HomepageBoxes::findOrFail($id);

        \File::delete(public_path() .'/upload/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function ourTips()
    {
        $all = tips::orderBy('id')->get();

        return view('admin.pages.homepage_icons',compact('all'));

    }


    public function homepageIcons()
    {
        $all = HomepageIcons::orderBy('id')->get();

        return view('admin.pages.homepage_icons',compact('all'));

    }

	public function addeditSlide(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditslider');
    }

    public function addeditContent()    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditcontent');
    }

    public function addnew(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'name' => 'required',
		        'image_name' => 'mimes:jpg,jpeg,gif,png'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }

		if(!empty($inputs['id'])){

            $slide = Slider::findOrFail($inputs['id']);

        }else{

            $slide = new Slider;

        }


		//Slide image
		$slide_image = $request->file('image_name');

        if($slide_image){

            \File::delete(public_path() .'/upload/slides/'.$slide->image_name.'.jpg');


            $tmpFilePath = 'upload/slides/';

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($slide_image);

            $img->save($tmpFilePath.$hardPath.'.jpg');

            $slide->image_name = $hardPath;

        }


		$slide->name = $inputs['name'];


	    $slide->save();

		if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return \Redirect::back();

        }


    }

    public function addnewContent(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            if(\Route::currentRouteName() == 'post-homepage')
            {
                $slide = HomepageIcons::findOrFail($inputs['id']);
            }
            else
            {
                $slide = tips::findOrFail($inputs['id']);
            }

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                if(\Route::currentRouteName() == 'post-homepage')
                {
                    \File::delete(public_path() .'/upload/homepage_icons/'.$slide->image);

                    $tmpFilePath = 'upload/homepage_icons/';
                }
                else
                {
                    \File::delete(public_path() .'/upload/tips/'.$slide->image);

                    $tmpFilePath = 'upload/tips/';
                }

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            if(\Route::currentRouteName() == 'post-homepage')
            {
                $slide = new HomepageIcons;
            }
            else
            {
                $slide = new tips;
            }

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                if(\Route::currentRouteName() == 'post-homepage')
                {
                    \File::delete(public_path() .'/upload/homepage_icons/'.$slide->image);

                    $tmpFilePath = 'upload/homepage_icons/';
                }
                else
                {
                    \File::delete(public_path() .'/upload/tips/'.$slide->image);

                    $tmpFilePath = 'upload/tips/';
                }

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }
            else
            {
                $slide->image = '';
            }

        }



        $slide->title = $inputs['title'];
        $slide->url = $inputs['url'];


        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return \Redirect::back();

        }


    }

    public function editSlide($id)
    {
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

          $slide = Slider::findOrFail($id);

          return view('admin.pages.addeditslider',compact('slide'));

    }

    public function editContent($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }


        if(\Route::currentRouteName() == 'edit-homepage')
        {
            $slide = HomepageIcons::findOrFail($id);
        }
        else
        {
            $slide = tips::findOrFail($id);
        }

        return view('admin.pages.addeditcontent',compact('slide'));

    }

    public function delete($id)
    {

    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = Slider::findOrFail($id);

		\File::delete(public_path() .'/upload/slides/'.$slide->image_name.'.jpg');

		$slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function deleteContent($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        if(\Route::currentRouteName() == 'delete-homepage')
        {
            $slide = HomepageIcons::findOrFail($id);

            \File::delete(public_path() .'/upload/homepage_icons/'.$slide->image);
        }
        else
        {
            $slide = tips::findOrFail($id);

            \File::delete(public_path() .'/upload/tips/'.$slide->image);
        }

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


}
