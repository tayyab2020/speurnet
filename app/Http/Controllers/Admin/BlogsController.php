<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Blogs;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogsController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();

    }
    public function blogslist()
    {
        $allblogs = Blogs::orderBy('id')->get();

        return view('admin.pages.blogs',compact('allblogs'));
    }

    public function addediblogs()    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditblog');
    }

    public function addnew(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        if(!empty($inputs['id'])){

            $blog = Blogs::findOrFail($inputs['id']);

        }else{

            $blog = new Blogs;

        }


        //Slide image
        $t_user_image = $request->file('image');

        if($t_user_image){

            \File::delete(public_path() .'/upload/blogs/'.$blog->image);

            $filename = $_FILES['image']['name'];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time());

            $image_file = $hardPath . '.' . $ext;

            $tmpFilePath = 'upload/blogs/';

            $target_file = $tmpFilePath . $image_file;

            $img = Image::make($t_user_image);

            $img->save($target_file);

            $blog->image = $image_file;

        }


        $blog->title = $inputs['title'];
        $blog->description = $inputs['description'];

        $blog->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }


    }

    public function editblog($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $blog = Blogs::findOrFail($id);

        return view('admin.pages.addeditblog',compact('blog'));

    }

    public function delete($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $blog = Blogs::findOrFail($id);

        \File::delete(public_path() .'/upload/blogs/'.$blog->image.'.jpg');

        $blog->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


}
