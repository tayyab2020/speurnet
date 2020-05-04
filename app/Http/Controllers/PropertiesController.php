<?php

namespace App\Http\Controllers;

use App\User;
use App\Properties;
use App\Enquire;
use App\Types;
use App\property_documents;
use App\request_viewings;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class PropertiesController extends Controller
{

    public function index()
    {

        $properties = Properties::leftjoin('users','users.id','=','properties.user_id')->where('properties.status','1')->orderBy('properties.id', 'desc')->select('properties.id','properties.property_name','properties.description','properties.property_slug','properties.available_immediately','properties.video','properties.property_type','properties.property_purpose','properties.sale_price','properties.rent_price','properties.address','properties.bathrooms','properties.bedrooms','properties.area','properties.featured_image','properties.property_images1','properties.property_images2','properties.property_images3','properties.property_images4','properties.property_images5','properties.first_floor','properties.second_floor','properties.ground_floor','properties.basement','properties.open_date','properties.open_timeFrom','properties.open_timeTo','properties.created_at','users.image_icon')->paginate(9);

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

            $properties[$i]->listed = $listed;

            $i = $i + 1;

        }



        return view('pages.properties',compact('properties'));
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

    public function propertysingle($slug)
    {
    	$property = Properties::where("property_slug", $slug)->first();

        $property->views =$property->views + 1;
        $property->save();

        $property = Properties::where("property_slug", $slug)->first();

    	$property_documents = property_documents::where('property_id',$property->id)->get();

    	if(!$property){
            abort('404');
        }

    	$agent = User::findOrFail($property->user_id);

        return view('pages.propertysingle',compact('property','property_documents','agent'));
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

	    \Session::flash('flash_message', 'Message send successfully');

         return \Redirect::back();

    }

    public function searchproperties(Request $request)
    {
    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

    	/*$properties = Properties::where(array('property_type'=>$inputs['type'],'property_purpose'=>$inputs['purpose']))

    							->orderBy('id', 'desc')->paginate(9);*/
    	if($inputs['purpose']=='Rent')
    	{
			$price='rent_price';

		}
		else
		{
			$price='sale_price';
		}

    	$city_id=$inputs['city_id'];
	 	$type=$inputs['type'];
	 	$purpose=$inputs['purpose'];
	 	$min_price=$inputs['min_price'];
	 	$max_price=$inputs['max_price'];


    	 $properties = Properties::SearchByKeyword($city_id,$type,$purpose,$price,$min_price,$max_price)->get();



        return view('pages.searchproperties',compact('properties'));
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
