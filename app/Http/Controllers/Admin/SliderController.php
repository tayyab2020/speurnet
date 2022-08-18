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
use App\study_categories;
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

        return view('admin.pages.addeditStudies',compact('categories','types'));
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

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $slide = studies::findOrFail($inputs['id']);

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

        return view('admin.pages.addeditStudies',compact('slide','categories','types'));

    }

    public function deleteStudy($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        studies::findOrFail($id)->delete();

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
