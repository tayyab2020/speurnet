<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\cookies;
use App\Expats;
use App\footer_pages;
use App\HomepageIcons;
use App\moving_tips;
use App\moving_tips_contents;
use App\savedPropertyAlert;
use App\Settings;
use App\user_languages;
use Auth;
use App\User;
use App\City;
use App\Properties;
use App\Testimonials;
use App\Subscriber;
use App\Partners;

use Mail;
use Crypt;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class IndexController extends Controller
{

    public function redirect($service) {
        return Socialite::driver ( $service )->stateless()->redirect();
    }

    public function callback($service) {

        $user = Socialite::with ( $service )->stateless()->user();

        if(!$user->email)
        {

            return redirect('/')->withErrors(__('text.Please link your facebook account with an email address.'));

        }

        $user = $this->createUser($user,$service);

        auth()->login($user);

        return redirect('admin/confirm-user-type');

    }

    public function changeLanguage(Request $request)
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }

        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        //whether ip is from remote address
        else
        {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        $lang = user_languages::where('ip','=',$ip_address)->update(['lang' => $request->language]);

        \App::setLocale($request->language);

        return redirect()->back();
    }

    public  function createUser($getInfo,$provider){


        $user = User::where('provider_id', $getInfo->id)->orWhere('email',$getInfo->email)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'usertype' => '',
                'password' => bcrypt(Str::random(10)),
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'status' => 1
            ]);

            $user_name = $getInfo->name;
            $user_email = $getInfo->email;

            Mail::send('emails.social_register_confirm',
                array(
                    'name' => $user_name,
                ), function($message) use ($user_name,$user_email)
                {
                    $message->from(getcong('site_email'),getcong('site_name'));
                    $message->to($user_email,$user_name)->subject(__('text.Registration Confirmation'));
                });
        }
        return $user;

    }

    public function unsubscribeAlert($id)
    {
        $id = Crypt::decrypt($id);

        $post = savedPropertyAlert::where('id',$id)->delete();

        return redirect('/')->with('flash_message', 'Property Alert Unsubscribed Successfully.');;

    }

    public function savepropertyalert(Request $request)
    {

        if($request->search_type == "standard")
        {
            $existingProperties=savedPropertyAlert::where('user_email',$request->email)
                ->where('radius',$request->radius)
                ->where('address',$request->address)->where('longitude',$request->longitude)->where('latitude',$request->latitude)
                ->where('property_type',$request->property_type)
                ->where('type',$request->type)
                ->where('property_purpose',$request->property_purpose)
                ->where('bedrooms',$request->bedrooms)
                ->where('bathrooms',$request->bathrooms)
                ->where('max_price',$request->max_price)->where('min_price',$request->min_price)
                ->where('max_area',$request->max_area)->where('min_area',$request->min_area)
                ->where('type_of_construction',$request->type_of_construction)
                ->where('keywords',$request->keywords)
                ->where('wheelchair',$request->wheelchair)
                ->where('search_type',1)
                ->first();
            if($existingProperties){
                return redirect('/')->with('flash_message', 'Your have already created Property Alert for this Search');
            }
            else{
                $property = new savedPropertyAlert;
                $property->user_email = $request->email;
                $property->radius = $request->radius;
                $property->property_type = $request->property_type;
                $property->type = $request->type;
                $property->bedrooms = $request->bedrooms;
                $property->bathrooms = $request->bathrooms;
                $property->address = $request->address;
                $property->longitude = $request->longitude;
                $property->latitude = $request->latitude;
                $property->property_purpose = $request->property_purpose;
                $property->max_price = $request->max_price;
                $property->min_price = $request->min_price;
                $property->max_area = $request->max_area;
                $property->min_area = $request->min_area;
                $property->type_of_construction = $request->type_of_construction;
                $property->keywords = $request->keywords;
                $property->wheelchair = $request->wheelchair;
                $property->search_type = 1;
                $property->save();
                return redirect('/')->with('flash_message', __('text.Property Alert Created Successfully, You will now receive Emails for Similar Properties'));
            }
        }
        else
        {
            $existingProperties=savedPropertyAlert::where('user_email',$request->email)
                ->where('radius',$request->radius)
                ->where('address',$request->address)->where('longitude',$request->longitude)->where('latitude',$request->latitude)
                ->where('property_type',$request->property_type)
                ->where('type',$request->type)
                ->where('bedrooms',$request->bedrooms)
                ->where('bathrooms',$request->bathrooms)
                ->where('max_price',$request->max_price)->where('min_price',$request->min_price)
                ->where('max_area',$request->max_area)->where('min_area',$request->min_area)
                ->where('kind_of_type',$request->kind_of_type)
                ->where('keywords',$request->keywords)
                ->where('wheelchair',$request->wheelchair)
                ->where('search_type',2)
                ->first();
            if($existingProperties){
                return redirect('/')->with('flash_message', 'Your have already created Property Alert for this Search');
            }
            else{
                $property = new savedPropertyAlert;
                $property->user_email = $request->email;
                $property->radius = $request->radius;
                $property->property_type = $request->property_type;
                $property->type = $request->type;
                $property->bedrooms = $request->bedrooms;
                $property->bathrooms = $request->bathrooms;
                $property->address = $request->address;
                $property->longitude = $request->longitude;
                $property->latitude = $request->latitude;
                $property->max_price = $request->max_price;
                $property->min_price = $request->min_price;
                $property->max_area = $request->max_area;
                $property->min_area = $request->min_area;
                $property->kind_of_type = $request->kind_of_type;
                $property->keywords = $request->keywords;
                $property->wheelchair = $request->wheelchair;
                $property->search_type = 2;
                $property->save();
                return redirect('/')->with('flash_message', __('text.Property Alert Created Successfully, You will now receive Emails for Similar Properties'));
            }
        }

    }

    public function index()
    {

    	if(!$this->alreadyInstalled()) {
            return redirect('install');
        }

    	$city_list = City::where('status','1')->orderBy('city_name')->get();

		$propertieslist = Properties::leftjoin('users','users.id','=','properties.user_id')->where('properties.status','1')->orderBy('properties.id', 'desc')->select('properties.id','users.company_name','properties.property_name','properties.description','properties.property_slug','properties.available_immediately','properties.is_sold','properties.is_rented','properties.is_negotiation','properties.is_under_offer','properties.video','properties.property_type','properties.property_purpose','properties.sale_price','properties.cost_for','properties.rent_price','properties.address','properties.bathrooms','properties.bedrooms','properties.area','properties.featured_image','properties.property_images1','properties.property_images2','properties.property_images3','properties.property_images4','properties.property_images5','properties.first_floor','properties.second_floor','properties.ground_floor','properties.basement','properties.open_date','properties.open_timeFrom','properties.open_timeTo','properties.created_at','users.image_icon','users.id as user_id','users.landlord')->get();

		/*$testimonials = Testimonials::orderBy('id', 'desc')->get();*/

		$partners = Partners::orderBy('id', 'desc')->get();

        $blogs = Blogs::orderBy('id', 'desc')->get();

		$top_members = User::withCount('properties')->where('users.usertype','=','Agents')->where('users.status',1)->where('users.landlord','!=',1)->having('properties_count', '>', 0)->orderBy('properties_count', 'desc')->get();

		$top_properties = Properties::orderBy('views', 'desc')->get();

		$content = HomepageIcons::orderBy('id','asc')->get();

		$most_viewed = Properties::orderBy('views','desc')->first();

		$heading = Settings::where('id',1)->first();

        date_default_timezone_set("Europe/Amsterdam");

        $i = 0;

        foreach($propertieslist as $key)
        {

            $time_ago        = strtotime($key->created_at);
            $current_time    = time();
            $time_difference = $current_time - $time_ago;
            $seconds         = $time_difference;

            $minutes = round($seconds / 60); // value 60 is seconds
            $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
            $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
            $weeks   = round($seconds / 604800); // 7*24*60*60;
            $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
            $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60


            if ($seconds <= 60){

                $listed = __('text.Listed just now');

            } else if ($minutes <= 60){

                if ($minutes == 1){

                    $listed = __('text.Listed one minute ago');

                } else {

                    $listed = __('text.Listed minutes ago',['minutes' => $minutes]);

                }

            } else if ($hours <= 24){

                if ($hours == 1){

                    $listed = __('text.Listed an hour ago');

                } else {

                    $listed = __('text.Listed hrs ago',['hours' => $hours]);

                }

            } else if ($days <= 7){

                if ($days == 1){

                    $listed = __('text.Listed yesterday');

                } else {

                    $listed = __('text.Listed days ago',['days' => $days]);

                }

            } else if ($weeks <= 4.3){

                if ($weeks == 1){

                    $listed = __('text.Listed this week');

                } else {

                    $listed = __('text.Listed this month');

                }

            }
            else
            {
                $listed = '';
            }



            $propertieslist[$i]->listed = $listed;

            $i = $i + 1;

        }

        $cookie = cookies::where('ip',\Request::ip())->first();

        return view('pages.index',compact('cookie','propertieslist','blogs', 'heading', 'most_viewed', 'partners','city_list','top_members','top_properties','content'));
    }

    public function Blogs()
    {
        $blogs = Blogs::orderBy('id', 'desc')->paginate(9);

        return view('pages.blogs',compact('blogs'));
    }

    public function Blog($id)
    {
        $blog = Blogs::where('id',$id)->first();

        return view('pages.blog',compact('blog'));
    }

    public function FooterPage($id)
    {
        $blog = footer_pages::where('id',$id)->first();

        return view('pages.blog',compact('blog'));
    }

    public function MovingTips()
    {
        $m_e = moving_tips::orderBy('id', 'desc')->get();

        $content = moving_tips_contents::orderBy('id','asc')->get();

        $heading = Settings::where('id',1)->first();

        return view('pages.m_e_page',compact('m_e','content','heading'));
    }

    public function MovingTip($id)
    {
        $blog = moving_tips::where('id',$id)->first();

        return view('pages.blog',compact('blog'));
    }

    public function Expats()
    {
        $m_e = Expats::orderBy('id', 'desc')->paginate(9);

        return view('pages.m_e_page',compact('m_e'));
    }

    public function Expat($id)
    {
        $blog = Expats::where('id',$id)->first();

        return view('pages.blog',compact('blog'));
    }

    public function subscribe(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'email' => 'required|email|max:75'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                echo '<p style="color: #db2424;font-size: 20px;">' . __('text.The email field is required.') . '</p>';
                exit;
        }

    	$subscriber = new Subscriber;

    	$subscriber->email = $inputs['email'];
    	$subscriber->ip = $_SERVER['REMOTE_ADDR'];


	    $subscriber->save();

	    echo '<p style="color: #189e26;font-size: 20px;">' . __("text.Successfully subscribe") . '</p>';
        exit;

    }

    public function cookieSave(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $cookie = new cookies;

        $cookie->ip = $inputs['ip'];
        $cookie->choice = $inputs['choice'];

        $cookie->save();

        return "Done";

    }

	/**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }


	public function aboutus_page()
    {
        return view('pages.about');
    }

    public function careers_with_page()
    {
        return view('pages.careers');
    }

    public function terms_conditions_page()
    {
        return view('pages.terms_conditions');
    }

    public function privacy_policy_page()
    {
        return view('pages.privacy');
    }

    public function contact_us_page()
    {
        return view('pages.contact');
    }

    public function contact_us_sendemail(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'name' => 'required',
				'email' => 'required|email',
		        'user_message' => 'required'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }



        Mail::send('emails.contact',
        array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'user_message' => $inputs['user_message']
        ), function($message)
	    {
	        $message->from(getcong('site_email'));
	        $message->to(getcong('site_email'), getcong('site_name'))->subject(getcong('site_name').' Contact');
	    });



 		 return redirect()->back()->with('flash_message', 'Thanks for contacting us!');
    }


    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
    	if (Auth::check()) {

            return redirect('admin/dashboard');
        }

        return view('pages.login');
    }


    public function postLogin(Request $request)
    {


    //echo bcrypt('123456');
    //exit;

      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');


        $user = User::where('email', $request->email)->first();


        if($user)
        {
            if($user->provider_id != NULL)
            {

                return redirect('/login')->withErrors(__('text.This Email ID is linked with Social Login. Use Social Login buttons to login.'));

            }

            if (Auth::attempt($credentials, $request->has('remember'))) {

                if(Auth::user()->status=='0'){
                    \Auth::logout();
                    return redirect('/login')->withErrors(__('text.Your account is not activated yet, please check your email.'));
                }


                return $this->handleUserWasAuthenticated($request);
            }
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
       return redirect('/login')->withErrors(__('text.The email or the password is invalid. Please try again.'));

    }

     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/');
    }

    public function register()
    {
    	if (Auth::check()) {

            return redirect('admin/dashboard');
        }

        return view('pages.register');
    }

    public function postRegister(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:75|unique:users',
		        'password' => 'required|min:3|confirmed'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }


        $user = new User;

		$string = Str::random(15);
		$user_name= $request->name;
		$user_email= $request->email;

		if($request->usertype == "landlord")
        {
           $user->usertype = "Agents";
            $user->landlord = 1;
        }
		else
        {
            $user->usertype = $request->usertype;
        }

		$user->name = $user_name;
		$user->company_name = $request->company_name;
		$user->email = $user_email;
		$user->password= bcrypt($request->password);
		$user->phone= $request->phone;
		$user->city= $request->city;

		$user->confirmation_code= $string;

	    $user->save();

		Mail::send('emails.register_confirm',
        array(
            'name' => $user_name,
            'email' => $user_email,
            'password' => $request->password,
            'confirmation_code' => $string,
            'user_message' => 'test',
            'user_type' => $request->usertype,
        ), function($message) use ($user_name,$user_email)
	    {
	        $message->from(getcong('site_email'),getcong('site_name'));
            $message->to($user_email,$user_name)->subject(__('text.Registration Confirmation'));
	    });



            \Session::flash('flash_message', __('text.Please verify your account. We\'ll send a verification link to the email address.'));

            return \Redirect::back();


    }


    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        //return redirect('admin/');
        return redirect('/');
    }

    public function confirm($code)
    {

        $user = User::where('confirmation_code',$code)->first();

 		$user->status = '1';

 		$user->save();

 		\Session::flash('flash_message', __('text.Confirmation successful...'));

        return view('pages.login');
    }

}
