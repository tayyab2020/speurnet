<?php

namespace App\Http\Controllers\Admin;

use App\Home_Exchange;
use App\New_Constructions;
use App\Properties;
use Auth;
use App\User;
use App\Types;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }
    public function typeslist()
    {
    	$alltypes = Types::orderBy('id')->get();

        return view('admin.pages.types',compact('alltypes'));
    }

	 public function addedittypes()    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addedittypes');
    }

    public function addnew(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'property_type' => 'required'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }

		if(!empty($inputs['id'])){

            $types = Types::findOrFail($inputs['id']);

        }else{

            $types = new Types;

        }

		if($inputs['slug']=="")
		{
			$slug  = Str::slug($inputs['property_type'], "-");
		}
		else
		{
			$slug = Str::slug($inputs['slug'], "-");
		}

		$types->show_type = $request->show_type;
		$types->types = $inputs['property_type'];
		$types->slug = $slug;


	    $types->save();

		if(!empty($inputs['id'])){

            \Session::flash('flash_message', __('text.Changes Saved'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', __('text.Added'));

            return \Redirect::back();

        }


    }

    public function edittypes($id)
    {
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

          $type = Types::findOrFail($id);

          return view('admin.pages.addedittypes',compact('type'));

    }

    public function delete($id)
    {

    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

    	$check = 0;

    	$properties = Properties::where('property_type',$id)->get();

    	if(count($properties) > 0)
        {
            $check = 1;
        }

        $properties = New_Constructions::where('property_type',$id)->get();

        if(count($properties) > 0)
        {
            $check = 1;
        }

        $properties = Home_Exchange::where('property_type',$id)->orWhere('preferred_kind',$id)->get();

        if(count($properties) > 0)
        {
            $check = 1;
        }


    	if(!$check)
        {
            $type = Types::findOrFail($id);

            $type->delete();

            \Session::flash('flash_message', 'Deleted');
        }
    	else
        {
            \Session::flash('flash_message', 'Cant delete, you have to first unlink this property type from specific properties or remove those properties!');
        }


        return redirect()->back();

    }


}
