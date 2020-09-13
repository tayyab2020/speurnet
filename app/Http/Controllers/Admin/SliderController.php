<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use Auth;
use App\User;
use App\Slider;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\HomepageIcons;

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

        \Session::flash('flash_message', 'Changes Saved.');

        return \Redirect::back();
    }

    public function homepageIcons()
    {
        $all = HomepageIcons::orderBy('id')->get();

        return view('admin.pages.homepage_icons',compact('all'));

    }

	 public function addeditSlide()    {

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

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

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

            $slide = HomepageIcons::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/homepage_icons/'.$slide->image);

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $tmpFilePath = 'upload/homepage_icons/';

                $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new HomepageIcons();

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/homepage_icons/'.$slide->image);

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $tmpFilePath = 'upload/homepage_icons/';

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

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

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

        $slide = HomepageIcons::findOrFail($id);

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

        $slide = HomepageIcons::findOrFail($id);

        \File::delete(public_path() .'/upload/homepage_icons/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


}
