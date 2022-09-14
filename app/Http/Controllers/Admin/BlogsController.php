<?php

namespace App\Http\Controllers\Admin;

use App\moving_tips_contents;
use App\Expats;
use App\moving_tips;
use App\Settings;
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
use App\blog_description;
use App\blog_categories;

class BlogsController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();

    }

    public function movingtipscontentlist()
    {
        $all = moving_tips_contents::orderBy('id')->get();

        return view('admin.pages.moving_tips_content',compact('all'));

    }

    public function movingtipscontentheading()
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $heading = Settings::first();
        $heading = $heading->m_t_heading;

        return view('admin.pages.m_t_change_heading',compact('heading'));
    }

    public function SaveMovingTipsContentHeading(Request $request)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }


        $heading = Settings::where('id',1)->update(['m_t_heading' => $request->title]);

        \Session::flash('flash_message', __('text.Changes Saved'));

        return \Redirect::back();
    }

    public function addeditmovingtipscontent()
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditmovingtipscontent');
    }

    public function addnewmovingtipscontent(Request $request)
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

            $slide = moving_tips_contents::findOrFail($inputs['id']);

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/moving-tips/'.$slide->image);

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $tmpFilePath = 'upload/moving-tips/';

                $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time()) .'.'.$ext;

                $img = Image::make($slide_image);

                $img->save($tmpFilePath.$hardPath);

                $slide->image = $hardPath;

            }

        }else{

            $slide = new moving_tips_contents;

            //Slide image
            $slide_image = $request->file('image');

            if($slide_image){

                \File::delete(public_path() .'/upload/moving-tips/'.$slide->image);

                $filename = $_FILES['image']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $tmpFilePath = 'upload/moving-tips/';

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


    public function editmovingtipsContent($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = moving_tips_contents::findOrFail($id);

        return view('admin.pages.addeditmovingtipscontent',compact('slide'));

    }


    public function deletemovingtipscontent($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = moving_tips_contents::findOrFail($id);

        \File::delete(public_path() .'/upload/moving-tips/'.$slide->image);

        $slide->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function blogCategories()
    {
        $all = blog_categories::orderBy('id')->get();

        return view('admin.pages.blog_categories',compact('all'));

    }

    public function addBlogCategory(){

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditBlogCategory');
    }

    public function addBlogCategoryPost(Request $request)
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

            $slide = blog_categories::findOrFail($inputs['id']);

        }else{

            $slide = new blog_categories;

        }

        $slide->title = $request->title;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/blog-categories');

        }

    }

    public function editBlogCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $slide = blog_categories::findOrFail($id);

        return view('admin.pages.addeditBlogCategory',compact('slide'));

    }

    public function deleteBlogCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        blog_categories::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function blogsDescription()
    {
        $slide = blog_description::first();

        return view('admin.pages.blog_description',compact('slide'));
    }

    public function blogsDescriptionPost(Request $request)
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

            $slide = blog_description::where('id',$inputs['id'])->first();

        }else{

            $slide = new blog_description;

        }

        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return redirect('admin/blogs/description');

        }

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

        $categories = blog_categories::all();

        return view('admin.pages.addeditblog',compact('categories'));
    }

    public function addnew(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'title' => 'required|unique:blogs,id',
            'description' => 'required',
            'category' => 'required',
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

                //Slide image
                $t_user_image = $request->file('image');

                if($t_user_image){

                    \File::delete(public_path() .'/upload/blogs/'.$blog->image);

                    $tmpFilePath = 'upload/blogs/';

                    $filename = $_FILES['image']['name'];

                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time());

                    $image_file = $hardPath . '.' . $ext;

                    $target_file = $tmpFilePath . $image_file;

                    $img = Image::make($t_user_image);

                    $img->save($target_file);

                    $blog->image = $image_file;

                }


            }else{

                $blog = new Blogs;

                //Slide image
                $t_user_image = $request->file('image');

                if($t_user_image){

                    \File::delete(public_path() .'/upload/blogs/'.$blog->image);

                    $tmpFilePath = 'upload/blogs/';

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

            }

        }
        elseif(Route::currentRouteName() == 'post-moving-tip')
        {

            if(!empty($inputs['id'])){

                $blog = moving_tips::findOrFail($inputs['id']);

                //Slide image
                $t_user_image = $request->file('image');

                if($t_user_image){

                    \File::delete(public_path() .'/upload/moving-tips/'.$blog->image);

                    $tmpFilePath = 'upload/moving-tips/';

                    $filename = $_FILES['image']['name'];

                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time());

                    $image_file = $hardPath . '.' . $ext;

                    $target_file = $tmpFilePath . $image_file;

                    $img = Image::make($t_user_image);

                    $img->save($target_file);

                    $blog->image = $image_file;

                }


            }else{

                $blog = new moving_tips;

                //Slide image
                $t_user_image = $request->file('image');

                if($t_user_image){

                    \File::delete(public_path() .'/upload/moving-tips/'.$blog->image);

                    $tmpFilePath = 'upload/moving-tips/';

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

            }

        }
        else
        {
            if(!empty($inputs['id'])){

                $blog = Expats::findOrFail($inputs['id']);

                //Slide image
                $t_user_image = $request->file('image');

                if($t_user_image){

                    \File::delete(public_path() .'/upload/expats/'.$blog->image);

                    $tmpFilePath = 'upload/expats/';

                    $filename = $_FILES['image']['name'];

                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(time());

                    $image_file = $hardPath . '.' . $ext;

                    $target_file = $tmpFilePath . $image_file;

                    $img = Image::make($t_user_image);

                    $img->save($target_file);

                    $blog->image = $image_file;

                }

            }else{

                $blog = new Expats;

                //Slide image
                $t_user_image = $request->file('image');

                if($t_user_image){

                    \File::delete(public_path() .'/upload/expats/'.$blog->image);

                    $tmpFilePath = 'upload/expats/';

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

            }

        }



        $blog->title = $inputs['title'];
        $blog->description = $inputs['description'];
        $blog->category_id = $inputs['category'];

        $blog->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

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
            $categories = blog_categories::all();
        }
        elseif(Route::currentRouteName() == 'edit-moving-tip')
        {
            $blog = moving_tips::findOrFail($id);
            $categories = "";
        }
        else
        {
            $blog = Expats::findOrFail($id);
            $categories = "";
        }

        return view('admin.pages.addeditblog',compact('blog','categories'));

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
