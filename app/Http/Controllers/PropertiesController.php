<?php

namespace App\Http\Controllers;

use App\User;
use App\Properties;
use App\Enquire;
use App\Types;

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
    	$properties = Properties::leftjoin('users','users.id','=','properties.user_id')->where('properties.status','1')->orderBy('properties.id', 'desc')->select('properties.id','properties.property_name','properties.description','properties.property_slug','properties.available_immediately','properties.property_type','properties.property_purpose','properties.sale_price','properties.rent_price','properties.address','properties.bathrooms','properties.bedrooms','properties.area','properties.featured_image','properties.property_images1','properties.property_images2','properties.property_images3','properties.property_images4','properties.property_images5','properties.open_date','properties.open_timeFrom','properties.open_timeTo','properties.created_at','users.image_icon')->paginate(9);

        return view('pages.properties',compact('properties'));
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

    	if(!$property){
            abort('404');
        }

    	$agent = User::findOrFail($property->user_id);

        return view('pages.propertysingle',compact('property','agent'));
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
