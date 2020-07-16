<?php

namespace App\Http\Controllers;

use App\City;
use App\Home_Exchange;
use App\New_Constructions;
use App\User;
use App\Properties;
use App\Enquire;
use App\Types;
use App\property_documents;
use App\request_viewings;
use App\property_features;
use App\saved_properties;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;
use Mail;
use Auth;
use App\travel_data_results;
use App\driving_data;
use App\transit_data;
use App\walking_data;
use App\cycling_data;
use Carbon\Carbon;

class PropertiesController extends Controller
{

    public function removeTravelData(Request $request)
    {

        $post = travel_data_results::where('id',$request->id)->delete();

        $driving = driving_data::where('data_id',$request->id)->delete();

        $transit = transit_data::where('data_id',$request->id)->delete();

        $walking = walking_data::where('data_id',$request->id)->delete();

        $cycling = cycling_data::where('data_id',$request->id)->delete();

        return response()->json(['data'=>'Success!']);

    }

    public function storeTravelData(Request $request)

    {

        $post = new travel_data_results();
        $post->property_id = $request->property_id;
        $post->user_id = $request->user_id;
        $post->destination_address = $request->address;
        $post->destination_name = $request->name;
        $post->save();

        $driving = new driving_data();
        $driving->data_id = $post->id;
        $driving->duration = $request->travel_data[0][0]['duration'];
        $driving->distance = $request->travel_data[0][0]['distance'];
        $driving->save();

        $transit = new transit_data();
        $transit->data_id = $post->id;
        $transit->duration = $request->travel_data[1][0]['duration'];
        $transit->distance = $request->travel_data[1][0]['distance'];
        $transit->save();

        $walking = new walking_data();
        $walking->data_id = $post->id;
        $walking->duration = $request->travel_data[2][0]['duration'];
        $walking->distance = $request->travel_data[2][0]['distance'];
        $walking->save();

        $cycling = new cycling_data();
        $cycling->data_id = $post->id;
        $cycling->duration = $request->travel_data[3][0]['duration'];
        $cycling->distance = $request->travel_data[3][0]['distance'];
        $cycling->save();



        return response()->json(['id'=>$post->id]);

    }

    public function index(Request $request)
    {

        $filter = $request->filter_orderby;

        /*$prev_month = date("t", mktime(0,0,0, date("n") - 1));*/

        $properties = Properties::leftjoin('users','users.id','=','properties.user_id')->where('properties.status','1')/*->whereDate('properties.created_at', '>', Carbon::now()->subDays($prev_month))*/->select('properties.id','properties.property_name','properties.description','properties.property_slug','properties.available_immediately','properties.is_sold','properties.is_rented','is_negotiation','is_under_offer','properties.video','properties.property_type','properties.property_purpose','properties.sale_price','properties.rent_price','properties.address','properties.bathrooms','properties.bedrooms','properties.area','properties.featured_image','properties.property_images1','properties.property_images2','properties.property_images3','properties.property_images4','properties.property_images5','properties.first_floor','properties.second_floor','properties.ground_floor','properties.basement','properties.open_date','properties.open_timeFrom','properties.open_timeTo','properties.created_at','users.image_icon');

        if($filter)
        {
            if($filter == 'newest')
            {
                $properties = $properties->orderBy('properties.id', 'desc')->paginate(8);
            }
            if($filter == 'oldest')
            {
                $properties = $properties->orderBy('properties.id', 'asc')->paginate(8);
            }
            if($filter == 'bedrooms')
            {
                $properties = $properties->orderBy('properties.bedrooms', 'asc')->paginate(8);
            }
            if($filter == 'bathrooms')
            {
                $properties = $properties->orderBy('properties.bathrooms', 'asc')->paginate(8);
            }
            if($filter == 'popularity')
            {
                $properties = $properties->orderBy('properties.views', 'desc')->paginate(8);
            }
            if($filter == 'lowest_sale_price')
            {
                $properties = $properties->orderBy('properties.sale_price', 'asc')->where('properties.property_purpose','Sale')->paginate(8);
            }
            if($filter == 'highest_sale_price')
            {
                $properties = $properties->orderBy('properties.sale_price', 'desc')->where('properties.property_purpose','Sale')->paginate(8);
            }
            if($filter == 'lowest_rent_price')
            {
                $properties = $properties->orderBy('properties.rent_price', 'asc')->where('properties.property_purpose','Rent')->paginate(8);
            }
            if($filter == 'highest_rent_price')
            {
                $properties = $properties->orderBy('properties.rent_price', 'desc')->where('properties.property_purpose','Rent')->paginate(8);
            }
            if($filter == 'lowest_area')
            {
                $properties = $properties->orderBy('properties.area', 'asc')->paginate(8);
            }
            if($filter == 'highest_area')
            {
                $properties = $properties->orderBy('properties.area', 'desc')->paginate(8);
            }
        }
        else
        {
            $properties = $properties->orderBy('properties.id', 'desc')->paginate(8);
        }



        date_default_timezone_set("Europe/Amsterdam");

        $i = 0;

        foreach($properties as $key)
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

                $listed = "Just Now";

            } else if ($minutes <= 60){

                if ($minutes == 1){

                    $listed = "one minute ago";

                } else {

                    $listed = "$minutes minutes ago";

                }

            } else if ($hours <= 24){

                if ($hours == 1){

                    $listed = "an hour ago";

                } else {

                    $listed = "$hours hrs ago";

                }

            } else if ($days <= 7){

                if ($days == 1){

                    $listed = "yesterday";

                } else {

                    $listed = "$days days ago";

                }

            } else if ($weeks <= 4.3){

                if ($weeks == 1){

                    $listed = "this week";

                } else {

                    $listed = "this month";

                }

            }
            else
            {
                $listed = '';
            }



            $properties[$i]->listed = $listed;

            $i = $i + 1;

        }


        return view('pages.properties',compact('properties','filter'));
    }


    public function newconstructions(Request $request)
    {

        $filter = $request->filter_orderby;

        /*$prev_month = date("t", mktime(0,0,0, date("n") - 1));*/

        $properties = New_Constructions::leftjoin('users','users.id','=','properties.user_id')->where('properties.status','1')->where('properties.new_construction',1)/*->whereDate('properties.created_at', '>', Carbon::now()->subDays($prev_month))*/->select('properties.id','properties.property_name','properties.description','properties.property_slug','properties.available_immediately','properties.is_sold','properties.is_rented','is_negotiation','is_under_offer','properties.video','properties.property_type','properties.property_purpose','properties.sale_price','properties.rent_price','properties.address','properties.bathrooms','properties.bedrooms','properties.area','properties.featured_image','properties.property_images1','properties.property_images2','properties.property_images3','properties.property_images4','properties.property_images5','properties.first_floor','properties.second_floor','properties.ground_floor','properties.basement','properties.open_date','properties.open_timeFrom','properties.open_timeTo','properties.created_at','users.image_icon');

        if($filter)
        {
            if($filter == 'newest')
            {
                $properties = $properties->orderBy('properties.id', 'desc')->paginate(8);
            }
            if($filter == 'oldest')
            {
                $properties = $properties->orderBy('properties.id', 'asc')->paginate(8);
            }
            if($filter == 'bedrooms')
            {
                $properties = $properties->orderBy('properties.bedrooms', 'asc')->paginate(8);
            }
            if($filter == 'bathrooms')
            {
                $properties = $properties->orderBy('properties.bathrooms', 'asc')->paginate(8);
            }
            if($filter == 'popularity')
            {
                $properties = $properties->orderBy('properties.views', 'desc')->paginate(8);
            }
            if($filter == 'lowest_sale_price')
            {
                $properties = $properties->orderBy('properties.sale_price', 'asc')->where('properties.property_purpose','Sale')->paginate(8);
            }
            if($filter == 'highest_sale_price')
            {
                $properties = $properties->orderBy('properties.sale_price', 'desc')->where('properties.property_purpose','Sale')->paginate(8);
            }
            if($filter == 'lowest_rent_price')
            {
                $properties = $properties->orderBy('properties.rent_price', 'asc')->where('properties.property_purpose','Rent')->paginate(8);
            }
            if($filter == 'highest_rent_price')
            {
                $properties = $properties->orderBy('properties.rent_price', 'desc')->where('properties.property_purpose','Rent')->paginate(8);
            }
            if($filter == 'lowest_area')
            {
                $properties = $properties->orderBy('properties.area', 'asc')->paginate(8);
            }
            if($filter == 'highest_area')
            {
                $properties = $properties->orderBy('properties.area', 'desc')->paginate(8);
            }
        }
        else
        {
            $properties = $properties->orderBy('properties.id', 'desc')->paginate(8);
        }



        return view('pages.properties',compact('properties','filter'));
    }

    public function PostRequestViewing(Request $request)
    {


        $post = new request_viewings;

        $post->property_id = $request->id;
        $post->agent_id = $request->agent_id;
        $post->gender = $request->gender;
        $post->status = 0;
        $post->day = $request->day;
        $post->moment = $request->moment;
        $post->name = $request->username;
        $post->email = $request->email;
        $post->phone = $request->phone;
        $post->message = $request->message;
        $post->save();

        $broker = User::where('id',$request->agent_id)->first();

        $broker_email = $broker->email;

        $broker_name = $broker->name;

        $broker_phone = $broker->phone;

        $customer_email = $request->email;

        $admin_email = getcong('site_email');

        Mail::send('emails.request_viewing',
            array(
                'gender' => $request->gender,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'property_name' => $request->property_name,
            ),  function ($message) use($request,$customer_email) {
                $message->from(getcong('site_email'),getcong('site_name'));
                $message->to($customer_email)
                    ->subject('Request for viewing');
            });

        Mail::send('emails.agent_request_viewing',
            array(
                'gender' => $request->gender,
                'broker_name' => $broker_name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'property_name' => $request->property_name,
            ),  function ($message) use($request,$broker_email) {
                $message->from(getcong('site_email'),getcong('site_name'));
                $message->to($broker_email)
                    ->subject('Request for viewing');
            });

        Mail::send('emails.admin_request_viewing',
            array(
                'gender' => $request->gender,
                'broker_name' => $broker_name,
                'broker_email' => $broker_email,
                'broker_phone' => $broker_phone,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'property_name' => $request->property_name,
            ),  function ($message) use($request,$admin_email) {
                $message->from(getcong('site_email'),getcong('site_name'));
                $message->to($admin_email)
                    ->subject('Request for viewing');
            });

        \Session::flash('flash_message', 'Dear ' . $request->gender . ' ' . $request->username . ', <br>You requested a viewing of  "'. $request->property_name . '". We expect the real estate agent to contact you in near future. <br>The real estate agent will contact you using the following information:<br><i class="fas fa-at" style="color: black;font-size: 13px;margin-right: 7px;"></i><b>Email Address: </b><span style="color: #7474d3;font-weight: 700;">'.$request->email .'</span><br><i class="fas fa-phone-alt" style="color: black;font-size: 13px;margin-right: 7px;"></i><b>Telephone Number: </b><span style="color: #7474d3;font-weight: 700;">'.$request->phone . '</span>');

        return \Redirect::back();


    }

    public function featuredproperties()
    {
    	$properties = Properties::where('featured_property','1')->where('status','1')->orderBy('id', 'desc')->paginate(9);;

        return view('pages.featuredproperties',compact('properties'));
    }

    public function saleproperties()
    {
    	$properties = Properties::where('property_purpose','Sale')->where('status','1')->orderBy('id', 'desc')->paginate(9);;

        return view('pages.saleproperties',compact('properties'));
    }

    public function rentproperties()
    {
    	$properties = Properties::where('property_purpose','Rent')->where('status','1')->orderBy('id', 'desc')->paginate(9);;

        return view('pages.rentproperties',compact('properties'));
    }


    public function propertiesbytype($slug)
    {

    	$type_data=Types::where('slug',$slug)->first();

    	$properties = Properties::where('property_type',$type_data->id)->where('status','1')->orderBy('id', 'desc')->paginate(9);

    	if(!$properties){
            abort('404');
        }

    	$type=$slug;

        return view('pages.propertiesbytype',compact('properties','type'));
    }

    public function addeditproperty()
    {
        if(Auth::user())
        {
            if(Auth::user()->usertype=='Agents')
            {
                $types = Types::orderBy('types')->get();

                $city_list = City::where('status','1')->orderBy('city_name')->get();

                $property_features = property_features::all();

                return view('admin.pages.addeditproperty',compact('city_list','types','property_features'));
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('login');
        }


    }

    public function addedithomeexchange()
    {

        if(Auth::user())
        {
            if(Auth::user()->usertype=='Users')
            {
                $types = Types::orderBy('types')->get();

                $city_list = City::where('status','1')->orderBy('city_name')->get();

                $property_features = property_features::all();

                return view('admin.pages.addeditproperty',compact('city_list','types','property_features'));
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('login');
        }


    }

    public function propertysingle($slug)
    {
    	$property = Properties::where("property_slug", $slug)->first();
        $similar_properties = [];


        $property->views =$property->views + 1;
        $property->save();

        $property = Properties::where("property_slug", $slug)->first();

    	$property_documents = property_documents::where('property_id',$property->id)->get();

    	if(!$property){
            abort('404');
        }

    	$agent = User::findOrFail($property->user_id);

    	$properties_count = Properties::where('user_id',$property->user_id)->get();
    	$properties_count = $properties_count->count();


    	if($property->property_features)
        {

            $features = explode(',', $property->property_features);


            foreach($features as $key){

                $get = property_features::where('id',$key)->first();
                $feature_texts[] = $get->text;
                $feature_icons[] = $get->icon;

                $property_features = array_combine($feature_texts, $feature_icons);

            }

        }
    	else
        {
            $property_features = "";
        }

    	if(Auth::user())
        {

            $saved = saved_properties::where('property_id',$property->id)->where('user_id',Auth::user()->id)->first();
            /*$driving_data = travel_data_results::leftjoin('driving_data','driving_data.data_id','=','travel_data_results.id')->where('travel_data_results.property_id',$property->id)->where('travel_data_results.user_id',Auth::user()->id)->select('travel_data_results.id','travel_data_results.destination_address','travel_data_results.destination_name','driving_data.duration as driving_duration','driving_data.distance as driving_distance')->get();
            $transit_data = travel_data_results::leftjoin('transit_data','transit_data.data_id','=','travel_data_results.id')->where('travel_data_results.property_id',$property->id)->where('travel_data_results.user_id',Auth::user()->id)->select('travel_data_results.id','travel_data_results.destination_address','travel_data_results.destination_name','transit_data.duration as transit_duration','transit_data.distance as transit_distance')->get();
            $walking_data = travel_data_results::leftjoin('walking_data','walking_data.data_id','=','travel_data_results.id')->where('travel_data_results.property_id',$property->id)->where('travel_data_results.user_id',Auth::user()->id)->select('travel_data_results.id','travel_data_results.destination_address','travel_data_results.destination_name','walking_data.duration as walking_duration','walking_data.distance as walking_distance')->get();
            $cycling_data = travel_data_results::leftjoin('cycling_data','cycling_data.data_id','=','travel_data_results.id')->where('travel_data_results.property_id',$property->id)->where('travel_data_results.user_id',Auth::user()->id)->select('travel_data_results.id','travel_data_results.destination_address','travel_data_results.destination_name','cycling_data.duration as cycling_duration','cycling_data.distance as cycling_distance')->get();*/

        }
    	else
        {
            $saved = "";
            /*$driving_data = "";
            $transit_data = "";
            $walking_data = "";
            $cycling_data = "";*/
        }

        $previous = Properties::leftjoin('cities','cities.id','=','properties.city_id')->where('properties.id', '<', $property->id)->orderBy('properties.id','desc')->select('properties.id','properties.property_slug','properties.property_name','properties.featured_image','properties.sale_price','properties.rent_price','properties.address','properties.bedrooms','cities.city_name')->first();

        $next = Properties::leftjoin('cities','cities.id','=','properties.city_id')->where('properties.id', '>', $property->id)->orderBy('properties.id')->select('properties.id','properties.property_slug','properties.property_name','properties.featured_image','properties.sale_price','properties.rent_price','properties.address','properties.bedrooms','cities.city_name')->first();


        $similar_property=Properties::where('id','!=', $property->id)->where("property_type", "$property->property_type")->where("city_id", "$property->city_id")->get();

        $similar_properties=array_merge($similar_properties,json_decode($similar_property));


        return view('pages.propertysingle',compact('property','previous','next','property_documents','agent','property_features','saved','properties_count','similar_properties'));
    }


    public function newconstructionsingle($slug)
    {
        $property = New_Constructions::where("property_slug", $slug)->first();
        $similar_properties = [];


        $property->views =$property->views + 1;
        $property->save();

        $property = New_Constructions::where("property_slug", $slug)->first();

        $property_documents = property_documents::where('property_id',$property->id)->get();

        if(!$property){
            abort('404');
        }

        $agent = User::findOrFail($property->user_id);

        $properties_count = New_Constructions::where('user_id',$property->user_id)->get();
        $properties_count = $properties_count->count();


        if($property->property_features)
        {

            $features = explode(',', $property->property_features);


            foreach($features as $key){

                $get = property_features::where('id',$key)->first();
                $feature_texts[] = $get->text;
                $feature_icons[] = $get->icon;

                $property_features = array_combine($feature_texts, $feature_icons);

            }

        }
        else
        {
            $property_features = "";
        }

        if(Auth::user())
        {

            $saved = saved_properties::where('property_id',$property->id)->where('user_id',Auth::user()->id)->first();
            /*$driving_data = travel_data_results::leftjoin('driving_data','driving_data.data_id','=','travel_data_results.id')->where('travel_data_results.property_id',$property->id)->where('travel_data_results.user_id',Auth::user()->id)->select('travel_data_results.id','travel_data_results.destination_address','travel_data_results.destination_name','driving_data.duration as driving_duration','driving_data.distance as driving_distance')->get();
            $transit_data = travel_data_results::leftjoin('transit_data','transit_data.data_id','=','travel_data_results.id')->where('travel_data_results.property_id',$property->id)->where('travel_data_results.user_id',Auth::user()->id)->select('travel_data_results.id','travel_data_results.destination_address','travel_data_results.destination_name','transit_data.duration as transit_duration','transit_data.distance as transit_distance')->get();
            $walking_data = travel_data_results::leftjoin('walking_data','walking_data.data_id','=','travel_data_results.id')->where('travel_data_results.property_id',$property->id)->where('travel_data_results.user_id',Auth::user()->id)->select('travel_data_results.id','travel_data_results.destination_address','travel_data_results.destination_name','walking_data.duration as walking_duration','walking_data.distance as walking_distance')->get();
            $cycling_data = travel_data_results::leftjoin('cycling_data','cycling_data.data_id','=','travel_data_results.id')->where('travel_data_results.property_id',$property->id)->where('travel_data_results.user_id',Auth::user()->id)->select('travel_data_results.id','travel_data_results.destination_address','travel_data_results.destination_name','cycling_data.duration as cycling_duration','cycling_data.distance as cycling_distance')->get();*/

        }
        else
        {
            $saved = "";
            /*$driving_data = "";
            $transit_data = "";
            $walking_data = "";
            $cycling_data = "";*/
        }

        $previous = New_Constructions::leftjoin('cities','cities.id','=','properties.city_id')->where('properties.id', '<', $property->id)->orderBy('properties.id','desc')->select('properties.id','properties.property_slug','properties.property_name','properties.featured_image','properties.sale_price','properties.rent_price','properties.address','properties.bedrooms','cities.city_name')->first();

        $next = New_Constructions::leftjoin('cities','cities.id','=','properties.city_id')->where('properties.id', '>', $property->id)->orderBy('properties.id')->select('properties.id','properties.property_slug','properties.property_name','properties.featured_image','properties.sale_price','properties.rent_price','properties.address','properties.bedrooms','cities.city_name')->first();


        $similar_property=New_Constructions::where('id','!=', $property->id)->where("property_type", "$property->property_type")->where("city_id", "$property->city_id")->get();

        $similar_properties=array_merge($similar_properties,json_decode($similar_property));


        return view('pages.propertysingle',compact('property','previous','next','property_documents','agent','property_features','saved','properties_count','similar_properties'));
    }

    public function propertiesUser($id,$id2,Request $request)
    {

        $filter = $request->filter_orderby;

        if($id != 0)
        {
            $properties = Properties::leftjoin('users','users.id','=','properties.user_id')->where('properties.status','1')->where('properties.id','!=',$id2)->where('properties.user_id',$id)->select('properties.id','properties.property_name','properties.description','properties.property_slug','properties.available_immediately','properties.is_sold','properties.is_rented','is_negotiation','is_under_offer','properties.video','properties.property_type','properties.property_purpose','properties.sale_price','properties.rent_price','properties.address','properties.bathrooms','properties.bedrooms','properties.area','properties.featured_image','properties.property_images1','properties.property_images2','properties.property_images3','properties.property_images4','properties.property_images5','properties.first_floor','properties.second_floor','properties.ground_floor','properties.basement','properties.open_date','properties.open_timeFrom','properties.open_timeTo','properties.created_at','users.image_icon');
        }
        else
        {
            $properties = Properties::leftjoin('users','users.id','=','properties.user_id')->where('properties.status','1')->where('properties.user_id',$id)->select('properties.id','properties.property_name','properties.description','properties.property_slug','properties.available_immediately','properties.is_sold','properties.is_rented','is_negotiation','is_under_offer','properties.video','properties.property_type','properties.property_purpose','properties.sale_price','properties.rent_price','properties.address','properties.bathrooms','properties.bedrooms','properties.area','properties.featured_image','properties.property_images1','properties.property_images2','properties.property_images3','properties.property_images4','properties.property_images5','properties.first_floor','properties.second_floor','properties.ground_floor','properties.basement','properties.open_date','properties.open_timeFrom','properties.open_timeTo','properties.created_at','users.image_icon');
        }


        if($filter)
        {
            if($filter == 'newest')
            {
                $properties = $properties->orderBy('properties.id', 'desc')->paginate(8);
            }
            if($filter == 'oldest')
            {
                $properties = $properties->orderBy('properties.id', 'asc')->paginate(8);
            }
            if($filter == 'area')
            {
                $properties = $properties->orderBy('properties.area', 'asc')->paginate(8);
            }
            if($filter == 'bedrooms')
            {
                $properties = $properties->orderBy('properties.bedrooms', 'asc')->paginate(8);
            }
            if($filter == 'bathrooms')
            {
                $properties = $properties->orderBy('properties.bathrooms', 'asc')->paginate(8);
            }
            if($filter == 'popularity')
            {
                $properties = $properties->orderBy('properties.views', 'desc')->paginate(8);
            }
            if($filter == 'lowest_sale_price')
            {
                $properties = $properties->orderBy('properties.sale_price', 'asc')->where('properties.property_purpose','Sale')->paginate(8);
            }
            if($filter == 'highest_sale_price')
            {
                $properties = $properties->orderBy('properties.sale_price', 'desc')->where('properties.property_purpose','Sale')->paginate(8);
            }
            if($filter == 'lowest_rent_price')
            {
                $properties = $properties->orderBy('properties.rent_price', 'asc')->where('properties.property_purpose','Rent')->paginate(8);
            }
            if($filter == 'highest_rent_price')
            {
                $properties = $properties->orderBy('properties.rent_price', 'desc')->where('properties.property_purpose','Rent')->paginate(8);
            }
        }
        else
        {
            $properties = $properties->orderBy('properties.id', 'desc')->paginate(8);
        }



        date_default_timezone_set("Europe/Amsterdam");

        $i = 0;

        foreach($properties as $key)
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

                $listed = "Just Now";

            } else if ($minutes <= 60){

                if ($minutes == 1){

                    $listed = "one minute ago";

                } else {

                    $listed = "$minutes minutes ago";

                }

            } else if ($hours <= 24){

                if ($hours == 1){

                    $listed = "an hour ago";

                } else {

                    $listed = "$hours hrs ago";

                }

            } else if ($days <= 7){

                if ($days == 1){

                    $listed = "yesterday";

                } else {

                    $listed = "$days days ago";

                }

            } else if ($weeks <= 4.3){

                if ($weeks == 1){

                    $listed = "this week";

                } else {

                    $listed = "few weeks ago";

                }

            }
            else
            {
                $listed = '';

            }

            $properties[$i]->listed = $listed;

            $i = $i + 1;

        }


        return view('pages.agent_properties',compact('properties','filter'));

    }

	public function agentscontact(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();


	    $rule=array(
		        'name' => 'required',
				'email' => 'required',
		        'message' => 'required'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }

    	$enquire = new Enquire;

    	$enquire->property_id = $inputs['property_id'];
    	$enquire->agent_id = $inputs['agent_id'];
    	$enquire->name = $inputs['name'];
    	$enquire->email = $inputs['email'];
    	$enquire->phone = $inputs['phone'];
    	$enquire->message = $inputs['message'];

	    $enquire->save();



        $broker = User::where('id',$request->agent_id)->first();

        $broker_email = $broker->email;

        $broker_name = $broker->name;

        $broker_phone = $broker->phone;

        $customer_email = $request->email;

        $admin_email = getcong('site_email');

        Mail::send('emails.inquiry',
            array(
                'gender' => $request->gender,
                'username' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'property_name' => $request->property_name,
            ),  function ($message) use($request,$customer_email) {
                $message->from(getcong('site_email'),getcong('site_name'));
                $message->to($customer_email)
                    ->subject('Property Inquiry');
            });

        Mail::send('emails.agent_inquiry',
            array(
                'gender' => $request->gender,
                'broker_name' => $broker_name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'inquiry' => $request->message,
                'property_name' => $request->property_name,
            ),  function ($message) use($request,$broker_email) {
                $message->from(getcong('site_email'),getcong('site_name'));
                $message->to($broker_email)
                    ->subject('Property Inquiry');
            });

        Mail::send('emails.admin_inquiry',
            array(
                'gender' => $request->gender,
                'broker_name' => $broker_name,
                'broker_email' => $broker_email,
                'broker_phone' => $broker_phone,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'inquiry' => $request->message,
                'property_name' => $request->property_name,
            ),  function ($message) use($request,$admin_email) {
                $message->from(getcong('site_email'),getcong('site_name'));
                $message->to($admin_email)
                    ->subject('Property Inquiry');
            });

	    \Session::flash('flash_message', 'Message send successfully');

         return \Redirect::back();

    }

    public function searchproperties(Request $request)
    {
    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    if($request->wheelchair)
        {
            $wheelchair = 1;
        }
	    else
        {
            $wheelchair = 0;
        }

    	/*$properties = Properties::where(array('property_type'=>$inputs['type'],'property_purpose'=>$inputs['purpose']))

    							->orderBy('id', 'desc')->paginate(9);*/
    	if($request->purpose=='Rent')
    	{
			$price='rent_price';

		}
		else
		{
			$price='sale_price';
		}

	 	$type=$request->type;
	 	$purpose=$request->purpose;
	 	$min_price=$request->min_price;
	 	$max_price=$request->max_price;
        $min_area=$request->min_area;
        $max_area=$request->max_area;
	 	$address = $request->city_name;
	 	$address_latitude = $request->city_latitude;
	 	$address_longitude = $request->city_longitude;
	 	$radius = $request->radius;
	 	$bedrooms = $request->bedrooms;
	 	$bathrooms = $request->bathrooms;
	 	$type_of_construction = $request->type_of_construction;
	 	$keywords = $request->keywords;
        $properties_search = [];


    	 $properties = Properties::SearchByKeyword($type,$purpose,$price,$min_price,$max_price,$min_area,$max_area,$bathrooms,$bedrooms,$type_of_construction,$keywords)->where('is_sold',0)->where('is_rented',0)->where('wheelchair',$wheelchair)->select('properties.*');


    	 if($address && $address_latitude && $address_longitude)
         {
             if($radius != 0)
             {
                 foreach ($properties->get() as $key)
                 {
                     $property_latitude = $key->map_latitude;
                     $property_longitude = $key->map_longitude;


                     $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($address_latitude).",".urlencode($address_longitude)."&destinations=".urlencode($property_latitude).",".urlencode($property_longitude)."&key=AIzaSyDFPa3LVeBRpaGafuUtk4znrty6IIqtMUw";

                     $result_string = file_get_contents($url);
                     $result = json_decode($result_string, true);

                     if($result['rows'][0]['elements'][0]['status'] == 'OK')
                     {
                         $property_radius = $result['rows'][0]['elements'][0]['distance']['value'];
                         $property_radius = $property_radius / 1000;

                         $property_radius = round($property_radius);


                         if($property_radius <= $radius)
                         {
                             array_push($properties_search,$key);
                         }
                     }


                 }

                 $properties = $properties_search;
             }
             else
             {
                 $properties = $properties->leftjoin('cities','cities.id','=','properties.city_id')->where('cities.city_name', 'like', '%' . $address . '%')->get();
             }


         }
    	 else if($address)
         {
             $properties = $properties->leftjoin('cities','cities.id','=','properties.city_id')->where('cities.city_name', 'like', '%' . $address . '%')->get();
         }
    	 else
         {
             $properties = $properties->get();
         }

        $property_type = $type;

        return view('pages.searchproperties',compact('properties','property_type','purpose','min_price','max_price','address','address_latitude','address_longitude','radius','min_area','max_area','bedrooms','bathrooms','type_of_construction','keywords','wheelchair'));
    }


    public function searchnewconstructions(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        if($request->wheelchair)
        {
            $wheelchair = 1;
        }
        else
        {
            $wheelchair = 0;
        }


        /*$properties = Properties::where(array('property_type'=>$inputs['type'],'property_purpose'=>$inputs['purpose']))

                                ->orderBy('id', 'desc')->paginate(9);*/
        if($request->kind_of_type=='For Sale')
        {
            $price='sale_price';

        }
        else if($request->kind_of_type=='To Rent Social' || $request->kind_of_type=='To Rent Free')
        {
            $price='rent_price';
        }


        $type=$request->type;
        $purpose='Sale';
        $min_price=$request->min_price;
        $max_price=$request->max_price;
        $min_area=$request->min_area;
        $max_area=$request->max_area;
        $address = $request->city_name;
        $address_latitude = $request->city_latitude;
        $address_longitude = $request->city_longitude;
        $radius = $request->radius;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;
        $kind_of_type = $request->kind_of_type;
        $keywords = $request->keywords;
        $properties_search = [];


        $properties = New_Constructions::SearchByKeyword($type,$purpose,$price,$min_price,$max_price,$min_area,$max_area,$bathrooms,$bedrooms,$kind_of_type,$keywords)->where('is_sold',0)->where('is_rented',0)->where('wheelchair',$wheelchair)->select('properties.*');


        if($address && $address_latitude && $address_longitude)
        {
            if($radius != 0)
            {
                foreach ($properties->get() as $key)
                {
                    $property_latitude = $key->map_latitude;
                    $property_longitude = $key->map_longitude;


                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($address_latitude).",".urlencode($address_longitude)."&destinations=".urlencode($property_latitude).",".urlencode($property_longitude)."&key=AIzaSyDFPa3LVeBRpaGafuUtk4znrty6IIqtMUw";

                    $result_string = file_get_contents($url);
                    $result = json_decode($result_string, true);

                    if($result['rows'][0]['elements'][0]['status'] == 'OK')
                    {
                        $property_radius = $result['rows'][0]['elements'][0]['distance']['value'];
                        $property_radius = $property_radius / 1000;

                        $property_radius = round($property_radius);


                        if($property_radius <= $radius)
                        {
                            array_push($properties_search,$key);
                        }
                    }


                }

                $properties = $properties_search;
            }
            else
            {
                $properties = $properties->leftjoin('cities','cities.id','=','properties.city_id')->where('cities.city_name', 'like', '%' . $address . '%')->get();
            }


        }
        else if($address)
        {
            $properties = $properties->leftjoin('cities','cities.id','=','properties.city_id')->where('cities.city_name', 'like', '%' . $address . '%')->get();
        }
        else
        {
            $properties = $properties->get();
        }

        $property_type = $type;

        return view('pages.searchproperties',compact('properties','property_type','purpose','min_price','max_price','address','address_latitude','address_longitude','radius','min_area','max_area','bedrooms','bathrooms','kind_of_type','keywords','wheelchair'));
    }

    public function searchkeywordproperties(Request $request)
    {
    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();


    	$properties = DB::table('properties')
                       ->where('status','1')
    				   ->where('property_type', '=', $inputs['type'])
    				   ->where('property_purpose', '=', $inputs['purpose'])
    				   ->where('property_name', 'like', '%'.$inputs['keyword'].'%')
    				   ->orderBy('id', 'desc')
    				   ->get();

        return view('pages.searchproperties',compact('properties'));
    }

}
