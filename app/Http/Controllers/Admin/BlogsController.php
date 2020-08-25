<?php

namespace App\Http\Controllers\Admin;

use App\Expats;
use App\moving_tips;
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
use Route;

class BlogsController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();

    }
    public function blogslist()
    {
        if(Route::currentRouteName() == 'blogs')
        {
            $allblogs = Blogs::orderBy('id', 'desc')->get();
        }
        elseif(Route::currentRouteName() == 'moving-tips')
        {
            $allblogs = moving_tips::orderBy('id', 'desc')->get();
        }
        else
        {
            $allblogs = Expats::orderBy('id', 'desc')->get();
        }

        return view('admin.pages.blogs',compact('allblogs'));
    }

    public function addeditblogs()    {

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

        if(Route::currentRouteName() == 'post-blog')
        {

            if(!empty($inputs['id'])){

                $blog = Blogs::findOrFail($inputs['id']);

            }else{

                $blog = new Blogs;

            }

        }
        elseif(Route::currentRouteName() == 'post-moving-tip')
        {

            if(!empty($inputs['id'])){

                $blog = moving_tips::findOrFail($inputs['id']);

            }else{

                $blog = new moving_tips;

            }

        }
        else
        {
            if(!empty($inputs['id'])){

                $blog = Expats::findOrFail($inputs['id']);

            }else{

                $blog = new Expats;

            }

        }


        //Slide image
        $t_user_image = $request->file('image');

        if($t_user_image){

            if(Route::currentRouteName() == 'post-blog')
            {
                \File::delete(public_path() .'/upload/blogs/'.$blog->image);

                $tmpFilePath = 'upload/blogs/';
            }
            elseif(Route::currentRouteName() == 'post-moving-tip')
            {
                \File::delete(public_path() .'/upload/moving-tips/'.$blog->image);

                $tmpFilePath = 'upload/moving-tips/';
            }
            else
            {
                \File::delete(public_path() .'/upload/expats/'.$blog->image);

                $tmpFilePath = 'upload/expats/';
            }


            $filename = $_FILES['image']['name'];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time());

            $image_file = $hardPath . '.' . $ext;

            $target_file = $tmpFilePath . $image_file;

            $img = Image::make($t_user_image);

            $img->save($target_file);

            $blog->image = $image_file;

        }
        else
        {
            $blog->image = '';
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

        if(Route::currentRouteName() == 'edit-blog')
        {
            $blog = Blogs::findOrFail($id);
        }
        elseif(Route::currentRouteName() == 'edit-moving-tip')
        {
            $blog = moving_tips::findOrFail($id);
        }
        else
        {
            $blog = Expats::findOrFail($id);
        }

        return view('admin.pages.addeditblog',compact('blog'));

    }

    public function delete($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        if(Route::currentRouteName() == 'delete-blog')
        {
            $blog = Blogs::findOrFail($id);

            \File::delete(public_path() .'/upload/blogs/'.$blog->image);
        }
        elseif(Route::currentRouteName() == 'delete-moving-tip')
        {
            $blog = moving_tips::findOrFail($id);

            \File::delete(public_path() .'/upload/moving-tips/'.$blog->image);
        }
        else
        {
            $blog = Expats::findOrFail($id);

            \File::delete(public_path() .'/upload/expats/'.$blog->image);
        }

        $blog->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


}
