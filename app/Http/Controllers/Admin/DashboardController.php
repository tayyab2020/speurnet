<?php

namespace App\Http\Controllers\Admin;

use App\footer_headings;
use App\footer_pages;
use App\homes_inspiration;
use App\manage_pages;
use App\properties_headings;
use App\property_features;
use Auth;
use App\User;
use App\Properties;
use App\Enquire;
use App\Partners;
use App\Subscriber;
use App\Testimonials;
use App\faqs;
use Intervention\Image\Facades\Image;
use Session;
use App\tickets;
use App\tickets_images;
use Illuminate\Support\Str;
use Mail;

use App\Http\Requests;
use Illuminate\Http\Request;


class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

    }
    public function index()
    {
    	if(Auth::user()->usertype=='Admin')
    	{
			$properties_count = Properties::count();

			$publish_properties = Properties::where('status','1')->count();

	    	$unpublish_properties = Properties::where('status','0')->count();

	    	$featured_properties = Properties::where('featured_property', '1')->count();
	    	$inquiries = Enquire::count();

	    	$agents = User::where('usertype', 'Agents')->count();

	    	$testimonials = Testimonials::count();

	    	$subscriber = Subscriber::count();

	    	$partners = Partners::count();

	    	return view('admin.pages.dashboard',compact('properties_count','featured_properties','inquiries','agents','testimonials','subscriber','partners','publish_properties','unpublish_properties'));

		}
		else
		{
			$user_id=Auth::user()->id;

	    	$properties_count = Properties::where(['user_id' => $user_id])->count();

	    	$publish_properties = Properties::where(['user_id' => $user_id,'status' => '1'])->count();

	    	$unpublish_properties = Properties::where(['user_id' => $user_id,'status' => '0'])->count();

	    	$inquiries = Enquire::where(['agent_id' => $user_id])->count();

			return view('admin.pages.dashboard',compact('properties_count','inquiries','publish_properties','unpublish_properties'));
		}


    }

    public function faq()
    {
            $faqs = faqs::orderBy('id', 'desc')->get();

        return view('admin.pages.faqs',compact('faqs'));
    }


    public function addeditfaq(){

        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditfaq');
    }

    public function addnew(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'question' => 'required',
            'answer' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }


            if(!empty($inputs['id'])){

                $faq = faqs::findOrFail($inputs['id']);

            }else{

                $faq = new faqs;

            }


        $faq->question = $inputs['question'];
        $faq->answer = $inputs['answer'];

        $faq->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return \Redirect::back();

        }


    }

    public function editfaq($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

            $faq = faqs::findOrFail($id);

        return view('admin.pages.addeditfaq',compact('faq'));

    }

    public function delete($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $faq = faqs::findOrFail($id);
        $faq->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function tickets()
    {
        if(Auth::User()->usertype == "Admin"){

            $tickets = tickets::leftjoin('users','users.id','=','tickets.user_id')->orderBy('tickets.id', 'desc')->select('tickets.*','users.name','users.email')->get();

        }
        else
        {
            $tickets = tickets::leftjoin('users','users.id','=','tickets.user_id')->where('tickets.user_id',Auth::User()->id)->orderBy('tickets.id', 'desc')->select('tickets.*','users.name','users.email')->get();
        }


        return view('admin.pages.tickets',compact('tickets'));
    }

    public function addeditticket(){

        return view('admin.pages.addeditticket');
    }

    public function editticket($id)
    {
        $ticket = tickets::findOrFail($id);

        $ticket_images = tickets_images::where('ticket_id',$id)->get();

        if(Auth::User()->usertype != "Admin")
        {
            if($ticket->user_id != Auth::User()->id)
            {
                \Session::flash('flash_message', 'Access denied!');

                return redirect('admin/dashboard');
            }
        }

        return view('admin.pages.addeditticket',compact('ticket','ticket_images'));

    }


    public function postTicket(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'images.*' => 'mimes:jpg,jpeg,gif,png|max:2000',
        );

        $messages = [
            'images.*.mimes' => 'Ticket Images must be a file of type: jpg, jpeg, gif, png.',
            'images.*.max' => 'Ticket Images may not be greater than 2mb.',
        ];

        $validator = \Validator::make($data,$rule,$messages);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }



        if(!empty($inputs['id'])){

            $ticket = tickets::findOrFail($inputs['id']);

        }else{

            $ticket = new tickets;

        }


        $user_id = Auth::user()->id;

        $ticket->user_id = $user_id;
        $ticket->subject = $inputs['ticket_subject'];
        $ticket->priority = $inputs['priority'];
        $ticket->status = 'Open';
        $ticket->issue = $inputs['ticket_issue'];

        $ticket->save();

        $id = sprintf("%02d", $ticket->id);

        $ticket_id = '#TK-'. $user_id .'-'.$id;

        $update = tickets::where('id',$id)->update(['ticket_id'=>$ticket_id]);

        $images = $request->file('images');

        $countfiles = count($_FILES['images']['name']);

        $imgs = [];


        if($images){

            $find = tickets_images::where('ticket_id',$ticket->id)->get();

            foreach ($find as $temp)
            {
                \File::delete(public_path() .'/upload/tickets/'.$temp->image);

                tickets_images::where('ticket_id',$ticket->id)->delete();
            }


            $tmpFilePath = 'upload/tickets/';

            for($i=0;$i<$countfiles;$i++) {

                $filename = $_FILES['images']['name'][$i];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $ext = strtolower($ext);

                $hardPath =  Str::slug('ticket-id', '-').'-'.md5(rand(0,99999));

                $img = Image::make($request->file('images')[$i]);

                $img->save($tmpFilePath.$hardPath. '.' . $ext);



                $imgs[$i] = $hardPath . "." . $ext;

            }

        }


        if(count($imgs) > 0)
        {
            foreach ($imgs as $key)
            {

                $ticket_images = new tickets_images;
                $ticket_images->ticket_id = $ticket->id;
                $ticket_images->image = $key;
                $ticket_images->save();

            }

        }

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            $sender_email = "info@zoekjehuisje.nl";
            $user_email = Auth::user()->email;

            Mail::send('emails.ticketAdminMail',
                array(
                    'parameters' => $request,
                    'ticket_id' => $ticket_id,
                    'user_email' => $user_email
                ),  function ($message) use($request,$sender_email) {
                    $message->from(getcong('site_email'),getcong('site_name'));
                    $message->to($sender_email)
                        ->subject($request->ticket_subject);
                });


            Mail::send('emails.ticketUserMail',
                array(
                    'parameters' => $request,
                    'ticket_id' => $ticket_id
                ),  function ($message) use($request,$user_email) {
                    $message->from(getcong('site_email'),getcong('site_name'));
                    $message->to($user_email)
                        ->subject($request->ticket_subject);
                });

            \Session::flash('flash_message', __('text.Added'));

            return \Redirect::back();

        }


    }

    public function deleteTicket($id)
    {

        $ticket = tickets::findOrFail($id);

        $ticket->delete();

        $ticket_images = tickets_images::where('ticket_id',$id)->get();

        foreach ($ticket_images as $key)
        {

            $image = $key->image;

            \File::delete(public_path() .'/upload/tickets/'.$image);

        }

        $ticket_images = tickets_images::where('ticket_id',$id)->delete();


        \Session::flash('flash_message', 'Ticket Deleted');

        return redirect()->back();

    }

    public function update(Request $request)
    {

        $ticket = tickets::where('id',$request->id)->update(['priority'=>$request->priority, 'status'=>$request->status]);

        $sender_email = $request->email_to;

        if($request->type == 1)
        {
            Mail::send('emails.ticketMail',
                array(
                    'parameters' => $request,
                    'ticket_id' => $request->code
                ),  function ($message) use($request,$sender_email) {
                    $message->from(getcong('site_email'),getcong('site_name'));
                    $message->to($sender_email)
                        ->subject($request->ticket_subject);
                });
        }

        \Session::flash('flash_message', 'Ticket Updated');

        return redirect()->back();


    }

    public function SendMail(Request $request)
    {

        $user_type = Auth::user()->usertype;

        if($user_type == 'Admin')
        {
            $sender_email = $request->tk_email_to;
        }
        else
        {
            $sender_email = getcong('site_email');
        }


            Mail::send('emails.ticketMailQuery',
                array(
                    'parameters' => $request,
                    'ticket_id' => $request->tk_code
                ),  function ($message) use($request,$sender_email) {
                    $message->from(getcong('site_email'),getcong('site_name'));
                    $message->to($sender_email)
                        ->subject($request->tk_subject);
                });


        \Session::flash('flash_message', 'Task Successful');

        return redirect()->back();


    }

    public function propertiesHeadings()
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $headings = properties_headings::all();

        return view('admin.pages.properties_headings',compact('headings'));
    }

    public function addPropertiesHeading(){

        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.add_property_heading');
    }

    public function postPropertiesHeading(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'heading' => 'required',
            'color' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }


        if(!empty($inputs['id'])){

            $check = properties_headings::where('heading_order',$request->heading_order)->where('id','!=',$inputs['id'])->first();

            if(!$check)
            {
                $heading = properties_headings::findOrFail($inputs['id']);
            }
            else
            {
                return redirect()->back()->withErrors('Order number already assigned!');
            }

        }else{

            $check = properties_headings::where('heading_order',$request->heading_order)->first();

            if(!$check)
            {
                $heading = new properties_headings;
            }
            else
            {
                return redirect()->back()->withErrors('Order number already assigned!');
            }

        }

        $heading->title = $request->heading;
        $heading->heading_order = $request->heading_order;
        $heading->color = $request->color;
        $heading->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message','Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message','Added');

            return \Redirect::back();

        }

    }

    public function editPropertiesHeading($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $heading = properties_headings::findOrFail($id);

        return view('admin.pages.add_property_heading',compact('heading'));

    }

    public function deletePropertiesHeading($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        properties_headings::where('id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function footerHeadings()
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $footer_headings = footer_headings::all();

        return view('admin.pages.footer_headings',compact('footer_headings'));
    }

    public function addFooterHeading(){

        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.add_footer_heading');
    }

    public function postFooterHeading(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

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

            $footer_heading = footer_headings::findOrFail($inputs['id']);

        }else{

            $footer_heading = new footer_headings;

        }


        $footer_heading->heading = $inputs['heading'];

        $footer_heading->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return \Redirect::back();

        }

    }

    public function editFooterHeading($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $footer_heading = footer_headings::findOrFail($id);

        return view('admin.pages.add_footer_heading',compact('footer_heading'));

    }

    public function deleteFooterHeading($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $footer_pages = footer_pages::where('heading_id',$id)->delete();
        $footer_heading = footer_headings::where('id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function HomesInspiration()
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $allblogs = homes_inspiration::all();

        return view('admin.pages.blogs',compact('allblogs'));
    }

    public function ManagePages(){

        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $allblogs = manage_pages::all();

        return view('admin.pages.blogs',compact('allblogs'));
    }


    public function addManagePage()
    {
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.manage_pages');
    }

    public function editManagePage($id)
    {
        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $blog = manage_pages::where('id',$id)->first();

        return view('admin.pages.manage_pages',compact('blog'));
    }

    public function postManagePage(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $rule=array(
            'page' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $blog = manage_pages::where('id',$request->page_id)->first();

        if(!$blog){

            $blog = new manage_pages;

        }

        $blog->page = $request->page;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->bottom_description = $request->bottom_description;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_sub_keywords = $request->meta_sub_keywords;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;

        $blog->save();

        \Session::flash('flash_message', 'Task Successful!');

        return \Redirect::back();

    }


    public function deleteManagePage($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $blog = manage_pages::findOrFail($id);
        $blog->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


    public function addHomesInspiration(){

        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditblog');
    }

    public function postHomesInspiration(Request $request)
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

            $blog = homes_inspiration::findOrFail($inputs['id']);

            //Slide image
            $t_user_image = $request->file('image');

            if($request->remove_image)
            {
                \File::delete(public_path() .'/upload/homes-inspiration/'.$blog->image);

                $blog->image = '';
            }

            if($t_user_image){

                \File::delete(public_path() .'/upload/homes-inspiration/'.$blog->image);

                $tmpFilePath = 'upload/homes-inspiration/';

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

            $blog = new homes_inspiration;

            //Slide image
            $t_user_image = $request->file('image');

            if($t_user_image){

                \File::delete(public_path() .'/upload/homes-inspiration/'.$blog->image);

                $tmpFilePath = 'upload/homes-inspiration/';

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


        $blog->title = $inputs['title'];
        $blog->type = $inputs['type'];
        $blog->description = $inputs['description'];
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_sub_keywords = $request->meta_sub_keywords;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;

        $blog->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return \Redirect::back();

        }


    }

    public function editHomesInspiration($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $blog = homes_inspiration::findOrFail($id);

        return view('admin.pages.addeditblog',compact('blog'));

    }

    public function deleteHomesInspiration($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $blog = homes_inspiration::findOrFail($id);

        \File::delete(public_path() .'/upload/homes-inspiration/'.$blog->image);


        $blog->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function footerPages()
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $allblogs = footer_pages::leftjoin('footer_headings','footer_headings.id','=','footer_pages.heading_id')->select('footer_pages.*','footer_headings.heading')->get();

        return view('admin.pages.blogs',compact('allblogs'));
    }

    public function addFooterPage(){

        if(Auth::User()->usertype!="Admin"){

            Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $headings = footer_headings::all();

        return view('admin.pages.addeditblog',compact('headings'));
    }


    public function postFooterPage(Request $request)
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

            $blog = footer_pages::findOrFail($inputs['id']);

            //Slide image
            $t_user_image = $request->file('image');

            if($request->remove_image)
            {
                \File::delete(public_path() .'/upload/footer-pages/'.$blog->image);

                $blog->image = '';
            }

            if($t_user_image){


                \File::delete(public_path() .'/upload/footer-pages/'.$blog->image);

                $tmpFilePath = 'upload/footer-pages/';

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

            $blog = new footer_pages;

            //Slide image
            $t_user_image = $request->file('image');

            if($t_user_image){


                \File::delete(public_path() .'/upload/footer-pages/'.$blog->image);

                $tmpFilePath = 'upload/footer-pages/';

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


        $blog->title = $inputs['title'];
        $blog->description = $inputs['description'];
        $blog->heading_id = $inputs['heading'];
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_sub_keywords = $request->meta_sub_keywords;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->meta_url = $request->meta_url;
        $blog->form = $request->show_form;

        $blog->save();

        if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return \Redirect::back();

        }


    }


    public function editFooterPage($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $headings = footer_headings::all();

        $blog = footer_pages::findOrFail($id);

        return view('admin.pages.addeditblog',compact('blog','headings'));

    }

    public function deleteFooterPage($id)
    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $blog = footer_pages::findOrFail($id);

        \File::delete(public_path() .'/upload/footer-pages/'.$blog->image);


        $blog->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

}
