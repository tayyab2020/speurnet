<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\City;
use App\Types;
use App\Properties;
use App\property_documents;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PropertiesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }
    public function propertieslist()
    {


    	if(Auth::user()->usertype=='Admin')
        {
        	$propertieslist = Properties::orderBy('id')->get();
        }
        else
        {
        	$user_id=Auth::user()->id;

			$propertieslist = Properties::where('user_id',$user_id)->orderBy('id')->get();
		}



        return view('admin.pages.properties',compact('propertieslist'));
    }

	 public function addeditproperty()
	 {

        $types = Types::orderBy('types')->get();

        $city_list = City::where('status','1')->orderBy('city_name')->get();

        return view('admin.pages.addeditproperty',compact('city_list','types'));
    }

    public function addnew(Request $request)
    {



    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();



        $rule=array(
            'property_name' => 'required',
            'description' => 'required',
            'featured_image' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'property_images1' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'property_images2' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'property_images3' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'property_images4' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'property_images5' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:10000',
            'documents.*' => 'mimes:pdf,doc,docx,txt,rtf,wpd,ppt,pptx',
            'first_floor' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'second_floor' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'ground_floor' => 'mimes:jpg,jpeg,gif,png|max:3000',
            'basement' => 'mimes:jpg,jpeg,gif,png|max:3000',
        );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }



		if(!empty($inputs['id'])){

            $property = Properties::findOrFail($inputs['id']);

        }else{

            $property = new Properties;

        }


		//property featured image
		$featured_image = $request->file('featured_image');

        if($featured_image){

            \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-b.jpg');
			\File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-s.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($featured_image);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');
			$img->fit(640, 425)->save($tmpFilePath.$hardPath.'-s.jpg');

            $property->featured_image = $hardPath;

        }

		//property image 1
		$property_images1 = $request->file('property_images1');

        if($property_images1){

            \File::delete(public_path() .'/upload/properties/'.$property->property_images1.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($property_images1);

            /*$img->fit(640, 425)->save($tmpFilePath.$hardPath.'-b.jpg');*/

            $img->save($tmpFilePath.$hardPath.'-b.jpg');

            $property->property_images1 = $hardPath;

        }

		//property image 2
		$property_images2 = $request->file('property_images2');

        if($property_images2){

            \File::delete(public_path() .'/upload/properties/'.$property->property_images2.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($property_images2);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $property->property_images2 = $hardPath;

        }

		//property image 3
		$property_images3 = $request->file('property_images3');

        if($property_images3){

            \File::delete(public_path() .'/upload/properties/'.$property->property_images3.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($property_images3);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $property->property_images3 = $hardPath;

        }

		//property image 4
		$property_images4 = $request->file('property_images4');

        if($property_images4){

            \File::delete(public_path() .'/upload/properties/'.$property->property_images4.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($property_images4);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $property->property_images4 = $hardPath;

        }

		//property image 5
		$property_images5 = $request->file('property_images5');

        if($property_images5){

            \File::delete(public_path() .'/upload/properties/'.$property->property_images5.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($property_images5);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $property->property_images5 = $hardPath;

        }

        $video = $request->file('video');



        if($video){

            $video_file_name = $_FILES['video']['name'];


            $ext = pathinfo($video_file_name, PATHINFO_EXTENSION);


            \File::delete(public_path() .'/upload/properties/'.$property->video);


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));


            $target_file = $tmpFilePath . $hardPath . '.' . $ext;

            move_uploaded_file($_FILES["video"]["tmp_name"],$target_file);


            $property->video = $hardPath . '.' . $ext;

        }


        $documents = $request->file('documents');

        $countfiles = count($_FILES['documents']['name']);

        $docs = [];


        if($documents){


            $find = property_documents::where('property_id',$property->id)->get();

            foreach ($find as $temp)
            {
                \File::delete(public_path() .'/upload/properties/documents/'.$temp->document);

                property_documents::where('property_id',$property->id)->delete();
            }



            $tmpFilePath = 'upload/properties/documents/';

            for($i=0;$i<$countfiles;$i++) {



                $filename = $_FILES['documents']['name'][$i];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath =  Str::slug('property-name', '-').'-'.md5(rand(0,99999));


                $target_file = $tmpFilePath . $hardPath . '.' . $ext;

                move_uploaded_file($_FILES["documents"]["tmp_name"][$i],$target_file);

                $docs[$i] = $hardPath . "." . $ext;

            }


        }


        $first_floor = $request->file('first_floor');

        if($first_floor){

            \File::delete(public_path() .'/upload/properties/'.$property->first_floor.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($first_floor);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $property->first_floor = $hardPath;

        }

        $second_floor = $request->file('second_floor');

        if($second_floor){

            \File::delete(public_path() .'/upload/properties/'.$property->second_floor.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($second_floor);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $property->second_floor = $hardPath;

        }

        $ground_floor = $request->file('ground_floor');

        if($ground_floor){

            \File::delete(public_path() .'/upload/properties/'.$property->ground_floor.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($ground_floor);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $property->ground_floor = $hardPath;

        }

        $basement = $request->file('basement');

        if($basement){

            \File::delete(public_path() .'/upload/properties/'.$property->basement.'-b.jpg');


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($basement);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $property->basement = $hardPath;

        }


		if($inputs['property_slug']=="")
		{
			$property_slug  = Str::slug($inputs['property_name'], "-");
		}
		else
		{
			$property_slug =Str::slug($inputs['property_slug'], "-");
		}

		$city = City::where('city_name', 'like', '%' . $request->city_name)->first();

		if($city)
        {
            $city_id = $city->id;
        }
		else
        {
            $city = new City;
            $city->city_name = $request->city_name;
            $city->status = 1;
            $city->save();

            $city_id = $city->id;
        }

		$user_id=Auth::user()->id;

		$property->user_id = $user_id;
		$property->available_immediately = $request->available_immediately;
		$property->property_name = $request->property_name;
		$property->property_slug = $property_slug;
		$property->city_id = $city_id;
		$property->property_type = $request->property_type;
		$property->property_purpose = $request->property_purpose;
		$property->sale_price = $request->sale_price;
		$property->rent_price = $request->rent_price;
		$property->address = $request->address;
        $property->map_latitude = $request->address_latitude;
        $property->map_longitude = $request->address_longitude;
		$property->bathrooms = $request->bathrooms;
		$property->bedrooms = $request->bedrooms;
        $property->garage = $request->garage;
		$property->area = $request->area;
		$property->property_features = $request->property_features;
        $property->keywords = $request->property_keywords;
		$property->description = $request->description;
        $property->open_date = $request->date;
        $property->open_timeFrom = $request->time_from;
        $property->open_timeTo = $request->time_to;


	    $property->save();

	    if(count($docs) > 0)
        {
            foreach ($docs as $key)
            {

                $property_documents = new property_documents;
                $property_documents->property_id = $property->id;
                $property_documents->document = $key;
                $property_documents->save();

            }

        }



		if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Property Added');

            return \Redirect::back();

        }


    }

    public function editproperty($id)
    {
          $property = Properties::findOrFail($id);

          $types = Types::orderBy('types')->get();

          $city_list = City::where('status','1')->orderBy('city_name')->get();

          return view('admin.pages.addeditproperty',compact('property','city_list','types'));

    }


	public function delete($id)
    {


        $property = Properties::findOrFail($id);

		\File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-b.jpg');
		\File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-s.jpg');

		\File::delete(public_path() .'/upload/properties/'.$property->property_images1.'-b.jpg');
		\File::delete(public_path() .'/upload/properties/'.$property->property_images2.'-b.jpg');
		\File::delete(public_path() .'/upload/properties/'.$property->property_images3.'-b.jpg');
		\File::delete(public_path() .'/upload/properties/'.$property->property_images4.'-b.jpg');
		\File::delete(public_path() .'/upload/properties/'.$property->property_images5.'-b.jpg');

		$property->delete();

        \Session::flash('flash_message', 'Property Deleted');

        return redirect()->back();

    }


	public function status($id)
    {
        $property = Properties::findOrFail($id);

       	if(Auth::User()->id!=$property->user_id and Auth::User()->usertype!="Admin")
       	{

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

		if($property->status==1)
		{
			$property->status='0';
	   		$property->save();

	   		\Session::flash('flash_message', 'Unpublished');
		}
		else
		{
			$property->status='1';
	   		$property->save();

	   		\Session::flash('flash_message', 'Published');
		}

        return redirect()->back();

    }

	public function featuredproperty($id)
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $property = Properties::findOrFail($id);

		if($property->featured_property==1)
		{
			$property->featured_property='0';
	   		$property->save();

	   		\Session::flash('flash_message', 'Property unset from featured');
		}
		else
		{
			$property->featured_property='1';
	   		$property->save();

	   		\Session::flash('flash_message', 'Property set as featured');
		}

        return redirect()->back();

    }


}
