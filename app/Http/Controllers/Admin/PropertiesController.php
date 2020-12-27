<?php

namespace App\Http\Controllers\Admin;

use App\Home_Exchange;
use App\New_Constructions;
use Auth;
use App\User;
use App\City;
use App\Types;
use App\Properties;
use App\Enquire;
use App\property_documents;
use App\property_features;
use App\saved_properties;
use Mail;

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

    public function saveProperty(Request $request)
    {
        $existingProperties = saved_properties::where('property_id',$request->property_id)->where('user_id',$request->user_id)->first();

        if($existingProperties){

            $existingProperties->delete();

            if($request->type == 'standard')
            {
                $property = Properties::where('id',$request->property_id)->first();
                $property->saved_properties = $property->saved_properties-1;
                $property->save();

            }
            elseif($request->type == 'construction')
            {
                $property = New_Constructions::where('id',$request->property_id)->first();
                $property->saved_properties = $property->saved_properties-1;
                $property->save();

            }
            else
            {
                $property = Home_Exchange::where('id',$request->property_id)->first();
                $property->saved_properties = $property->saved_properties-1;
                $property->save();

            }


            Session::flash('flash_message', __('text.Property Removed from Your Saved Properties List!'));

        }

        else{


            $property = new saved_properties();
            $property->property_id = $request->property_id;
            $property->user_id = $request->user_id;
            $property->save();

            if($request->type == 'standard')
            {
                $property = Properties::where('id',$request->property_id)->first();
                $property->saved_properties = $property->saved_properties+1;
                $property->save();
            }
            elseif($request->type == 'construction')
            {
                $property = New_Constructions::where('id',$request->property_id)->first();
                $property->saved_properties = $property->saved_properties+1;
                $property->save();

            }
            else
            {
                $property = Home_Exchange::where('id',$request->property_id)->first();
                $property->saved_properties = $property->saved_properties+1;
                $property->save();

            }

            /*$user=User::where('id',$request->user_id)->first();
            $user->views=$user->views+1;
            $user->save();*/
            Session::flash('flash_message', __('text.Property Successfully Saved to Your Dashboard!'));

        }
        return redirect()->back();
    }

    public function Checkboxes(Request $request)
    {
        if($request->sold)
        {
            $sold = 1;
        }
        else
        {
            $sold = 0;
        }

        if($request->rented)
        {
            $rented = 1;
        }
        else
        {
            $rented = 0;
        }

        if($request->available)
        {
            $available = 1;
        }
        else
        {
            $available = 0;
        }

        if($request->negotiation)
        {
            $negotiation = 1;
        }
        else
        {
            $negotiation = 0;
        }

        if($request->under_offer)
        {
            $under_offer = 1;
        }
        else
        {
            $under_offer = 0;
        }

        if($request->route == 'properties')
        {
            $property = Properties::where('id',$request->id)->update(["is_sold"=>$sold,"is_rented"=>$rented,"available_immediately"=>$available,"is_negotiation"=>$negotiation,"is_under_offer"=>$under_offer]);
        }
        elseif($request->route == 'new_constructions')
        {
            $property = New_Constructions::where('id',$request->id)->update(["is_sold"=>$sold,"is_rented"=>$rented,"available_immediately"=>$available,"is_negotiation"=>$negotiation,"is_under_offer"=>$under_offer]);
        }
        else
        {
            $property = Home_Exchange::where('id',$request->id)->update(["is_sold"=>$sold,"is_rented"=>$rented,"available_immediately"=>$available,"is_negotiation"=>$negotiation,"is_under_offer"=>$under_offer]);
        }


        \Session::flash('flash_message', 'Status updated successfully!');

        return \Redirect::back();

    }

    public function propertieslist()
    {


    	if(Auth::user()->usertype=='Admin')
        {
        	$propertieslist = Properties::orderBy('id','desc')->withCount(['enquiries'])->withCount(['viewings'])->get();
        }
        else
        {
        	$user_id=Auth::user()->id;

			$propertieslist = Properties::where('user_id',$user_id)->orderBy('id','desc')->withCount(['enquiries'])->withCount(['viewings'])->get();

		}



        return view('admin.pages.properties',compact('propertieslist'));
    }

    public function newConstructionslist()
    {

        if(Auth::user()->usertype=='Admin')
        {
            $propertieslist = New_Constructions::orderBy('id','desc')->withCount(['enquiries'])->withCount(['viewings'])->get();
        }
        else
        {
            return redirect('/');
        }

        return view('admin.pages.properties',compact('propertieslist'));
    }

    public function homeexchangelist()
    {

        if(Auth::user()->usertype=='Admin')
        {
            $propertieslist = Home_Exchange::orderBy('id','desc')->withCount(['enquiries'])->withCount(['viewings'])->get();

            return view('admin.pages.properties',compact('propertieslist'));
        }
        elseif(Auth::user()->usertype=='Users')
        {
            $propertieslist = Home_Exchange::where('user_id',Auth::user()->id)->orderBy('id','desc')->withCount(['enquiries'])->withCount(['viewings'])->get();

            return view('admin.pages.properties',compact('propertieslist'));
        }
        else
        {
            return redirect('/');
        }

    }

    public function favouriteProperties()
    {

        if(Auth::user()->usertype=='Admin')
        {
            $propertieslist = saved_properties::leftjoin('properties','properties.id','=','saved_properties.property_id')->leftjoin('users','users.id','=','saved_properties.user_id')->orderBy('properties.id','desc')->select('properties.*','users.name as client_name','saved_properties.created_at','saved_properties.id as saved_id')->get();
        }
        else
        {
            $user_id=Auth::user()->id;

            if(Auth::user()->usertype == 'Agents')
            {

                $propertieslist = saved_properties::leftjoin('properties','properties.id','=','saved_properties.property_id')->leftjoin('users','users.id','=','saved_properties.user_id')->where('saved_properties.user_id',$user_id)->orderBy('properties.id','desc')->select('properties.*','users.name as client_name','saved_properties.created_at','saved_properties.id as saved_id')->get();

            }
            elseif(Auth::user()->usertype == 'Users')
            {

                $propertieslist = saved_properties::leftjoin('properties','properties.id','=','saved_properties.property_id')->leftjoin('users','users.id','=','saved_properties.user_id')->where('saved_properties.user_id',$user_id)->orderBy('properties.id','desc')->select('properties.*','users.name as client_name','saved_properties.created_at','saved_properties.id as saved_id')->get();

            }


        }

        return view('admin.pages.favourite_properties',compact('propertieslist'));
    }

    public function savedPropertyDelete($id)
    {

        $user_id=Auth::user()->id;

        $property = saved_properties::where('id',$id)->where('user_id',$user_id)->first();


        if($property)
        {
            $property_id = $property->property_id;
            $property->delete();

            $property = Properties::where('id',$property_id)->first();
            $property->saved_properties = $property->saved_properties-1;
            $property->save();

            \Session::flash('flash_message', 'Property Removed from your list!');
        }


        return redirect()->back();

    }

	 public function addeditproperty()
	 {

         if(Auth::user()->usertype=='Admin')
         {
             $types = Types::where('show_type','!=',1)->orderBy('types')->get();

             $city_list = City::where('status','1')->orderBy('city_name')->get();

             $property_features = property_features::all();

             return view('admin.pages.addeditproperty',compact('city_list','types','property_features'));
         }
         else
         {
             return redirect('/');
         }


    }

    public function addeditnewconstruction()
    {

        if(Auth::user()->usertype=='Admin')
        {
            $types = Types::where('show_type','!=',1)->orderBy('types')->get();

            $city_list = City::where('status','1')->orderBy('city_name')->get();

            $property_features = property_features::all();

            return view('admin.pages.addeditproperty',compact('city_list','types','property_features'));
        }
        else
        {
            return redirect('/');
        }


    }

    public function addedithomeexchange()
    {

        if(Auth::user()->usertype=='Users')
        {
            $types = Types::where('show_type','!=',3)->orderBy('types')->get();

            $city_list = City::where('status','1')->orderBy('city_name')->get();

            $property_features = property_features::all();

            $properties = Home_Exchange::where('user_id',Auth::user()->id)->get();

            if(count($properties) >= 1)
            {
                return redirect()->back();
            }
            else
            {
                return view('admin.pages.addeditproperty',compact('city_list','types','property_features'));
            }
        }
        else
        {
            return redirect('/');
        }


    }

    // Compress image
    public function compressImage($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
        {
            $image = imagecreatefromjpeg($source);

            $exif = exif_read_data($source);

            if (!empty($exif['Orientation'])) {

                switch ($exif['Orientation']) {
                    case 3:
                        $image = imagerotate($image, 180, 0);
                        break;
                    case 6:
                        $image = imagerotate($image, -90, 0);
                        break;
                    case 8:
                        $image = imagerotate($image, 90, 0);
                        break;
                    default:
                        $image = $image;
                }
            }

            $img = Image::make($image);

            if($quality == 30)
            {
                if($info[0] > 1920 && $info[1] > 1080)
                {
                    $img->resize(1920, 1080, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }
            elseif($quality == 25)
            {
                if($info[0] > 1280 && $info[1] > 800)
                {
                    $img->resize(1280, 800, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }
            else
            {
                if($info[0] > 640 && $info[1] > 425)
                {
                    $img->resize(640, 425, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }


            /*imagejpeg($image, $destination, $quality);*/
        }

        else
        {
            $img = Image::make($source);

            if($quality == 30)
            {
                if($info[0] > 1920 && $info[1] > 1080)
                {
                    $img->resize(1920, 1080, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }

            }
            elseif($quality == 25)
            {
                if($info[0] > 1280 && $info[1] > 800)
                {
                    $img->resize(1280, 800, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }
            else
            {
                if($info[0] > 640 && $info[1] > 425)
                {
                    $img->resize(640, 425, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destination);
                }
                else
                {
                    $img->save($destination);
                }
            }

            /*$srcImage = imagecreatefrompng($source);

            $targetImage = imagecreatetruecolor( $info[0], $info[1] );
            imagealphablending( $targetImage, false );
            imagesavealpha( $targetImage, true );

            imagecopyresampled( $targetImage, $srcImage,
                0, 0,
                0, 0,
                $info[0], $info[1],
                $info[0], $info[1] );

            $quality = 9 - ($quality/10);

            imagepng(  $targetImage, $destination, $quality );*/

        }

        return;

    }

    public function incrementSlug($slug,$type) {

        $original = $slug;

        $count = 2;

        if($type == 1)
        {
            while (Properties::where('property_slug',$slug)->exists()) {

                $slug = "{$original}-" . $count++;
            }

            return $slug;
        }
        elseif($type == 2)
        {
            while (New_Constructions::where('property_slug',$slug)->exists()) {

                $slug = "{$original}-" . $count++;
            }

            return $slug;
        }
        else
        {
            while (Home_Exchange::where('property_slug',$slug)->exists()) {

                $slug = "{$original}-" . $count++;
            }

            return $slug;
        }

    }

    public function addnew(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

            $rule=array(
                /*'property_name' => 'required',*/
                /*'property_slug' => 'unique:properties,property_slug,'.$inputs['id'],*/
                'description' => 'required',
                'featured_image' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images1' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images2' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images3' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images4' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images5' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images6' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images7' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images8' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images9' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images10' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images11' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images12' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images13' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images14' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images15' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images16' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images17' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images18' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images19' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images20' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images21' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images22' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images23' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'property_images24' => 'mimes:jpg,jpeg,gif,png|max:7000',
                'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:20000',
                'documents.*' => 'mimes:pdf,doc,docx,txt,rtf,wpd,ppt,pptx',
                'first_floor' => 'mimes:jpg,jpeg,gif,png,pdf|max:5000',
                'second_floor' => 'mimes:jpg,jpeg,gif,png,pdf|max:5000',
                'ground_floor' => 'mimes:jpg,jpeg,gif,png,pdf|max:5000',
                'basement' => 'mimes:jpg,jpeg,gif,png,pdf|max:5000',
            );


        $messages = [
            /*'property_name.required' => 'Property Name is required.',*/
            /*'property_slug.unique' => 'This Property Slug is already been taken.',*/
            'description.required' => __('Description is required.'),
            'featured_image.mimes' => 'Featured Image must be a file of type: jpg, jpeg, gif, png.',
            'featured_image.max' => 'Featured Image may not be greater than 7mb.',
            'property_images1.mimes' => 'Property Image 1 must be a file of type: jpg, jpeg, gif, png.',
            'property_images1.max' => 'Property Image 1 may not be greater than 7mb.',
            'property_images2.mimes' => 'Property Image 2 must be a file of type: jpg, jpeg, gif, png.',
            'property_images2.max' => 'Property Image 2 may not be greater than 7mb.',
            'property_images3.mimes' => 'Property Image 3 must be a file of type: jpg, jpeg, gif, png.',
            'property_images3.max' => 'Property Image 3 may not be greater than 7mb.',
            'property_images4.mimes' => 'Property Image 4 must be a file of type: jpg, jpeg, gif, png.',
            'property_images4.max' => 'Property Image 4 may not be greater than 7mb.',
            'property_images5.mimes' => 'Property Image 5 must be a file of type: jpg, jpeg, gif, png.',
            'property_images5.max' => 'Property Image 5 may not be greater than 7mb.',
            'property_images6.mimes' => 'Property Image 6 must be a file of type: jpg, jpeg, gif, png.',
            'property_images6.max' => 'Property Image 6 may not be greater than 7mb.',
            'property_images7.mimes' => 'Property Image 7 must be a file of type: jpg, jpeg, gif, png.',
            'property_images7.max' => 'Property Image 7 may not be greater than 7mb.',
            'property_images8.mimes' => 'Property Image 8 must be a file of type: jpg, jpeg, gif, png.',
            'property_images8.max' => 'Property Image 8 may not be greater than 7mb.',
            'property_images9.mimes' => 'Property Image 9 must be a file of type: jpg, jpeg, gif, png.',
            'property_images9.max' => 'Property Image 9 may not be greater than 7mb.',
            'property_images10.mimes' => 'Property Image 10 must be a file of type: jpg, jpeg, gif, png.',
            'property_images10.max' => 'Property Image 10 may not be greater than 7mb.',
            'property_images11.mimes' => 'Property Image 11 must be a file of type: jpg, jpeg, gif, png.',
            'property_images11.max' => 'Property Image 11 may not be greater than 7mb.',
            'property_images12.mimes' => 'Property Image 12 must be a file of type: jpg, jpeg, gif, png.',
            'property_images12.max' => 'Property Image 12 may not be greater than 7mb.',
            'property_images13.mimes' => 'Property Image 13 must be a file of type: jpg, jpeg, gif, png.',
            'property_images13.max' => 'Property Image 13 may not be greater than 7mb.',
            'property_images14.mimes' => 'Property Image 14 must be a file of type: jpg, jpeg, gif, png.',
            'property_images14.max' => 'Property Image 14 may not be greater than 7mb.',
            'property_images15.mimes' => 'Property Image 15 must be a file of type: jpg, jpeg, gif, png.',
            'property_images15.max' => 'Property Image 15 may not be greater than 7mb.',
            'property_images16.mimes' => 'Property Image 16 must be a file of type: jpg, jpeg, gif, png.',
            'property_images16.max' => 'Property Image 16 may not be greater than 7mb.',
            'property_images17.mimes' => 'Property Image 17 must be a file of type: jpg, jpeg, gif, png.',
            'property_images17.max' => 'Property Image 17 may not be greater than 7mb.',
            'property_images18.mimes' => 'Property Image 18 must be a file of type: jpg, jpeg, gif, png.',
            'property_images18.max' => 'Property Image 18 may not be greater than 7mb.',
            'property_images19.mimes' => 'Property Image 19 must be a file of type: jpg, jpeg, gif, png.',
            'property_images19.max' => 'Property Image 19 may not be greater than 7mb.',
            'property_images20.mimes' => 'Property Image 20 must be a file of type: jpg, jpeg, gif, png.',
            'property_images20.max' => 'Property Image 20 may not be greater than 7mb.',
            'property_images21.mimes' => 'Property Image 21 must be a file of type: jpg, jpeg, gif, png.',
            'property_images21.max' => 'Property Image 21 may not be greater than 7mb.',
            'property_images22.mimes' => 'Property Image 22 must be a file of type: jpg, jpeg, gif, png.',
            'property_images22.max' => 'Property Image 22 may not be greater than 7mb.',
            'property_images23.mimes' => 'Property Image 23 must be a file of type: jpg, jpeg, gif, png.',
            'property_images23.max' => 'Property Image 23 may not be greater than 7mb.',
            'property_images24.mimes' => 'Property Image 24 must be a file of type: jpg, jpeg, gif, png.',
            'property_images24.max' => 'Property Image 24 may not be greater than 7mb.',
            'video.mimetypes' => 'Video must be a file of type: wmv, flv, mp4, m3u8, ts, 3gp, mov, avi.',
            'video.max' => 'Video may not be greater than 20mb.',
            'documents.*.mimes' => 'Documents must be a file of type: pdf, doc, txt, rtf, wpd, ppt, pptx.',
            'first_floor.mimes' => 'First Floor must be a file of type: jpg, jpeg, gif, png, pdf.',
            'first_floor.max' => 'First Floor may not be greater than 5mb.',
            'second_floor.mimes' => 'Second Floor must be a file of type: jpg, jpeg, gif, png, pdf.',
            'second_floor.max' => 'Second Floor may not be greater than 5mb.',
            'ground_floor.mimes' => 'Ground Floor must be a file of type: jpg, jpeg, gif, png, pdf.',
            'ground_floor.max' => 'Ground Floor may not be greater than 5mb.',
            'basement.mimes' => 'Basement must be a file of type: jpg, jpeg, gif, png, pdf.',
            'basement.max' => 'Basement may not be greater than 5mb.',
        ];

	   	 $validator = \Validator::make($data,$rule,$messages);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        if($request->property_name)
        {
            $property_name = $request->property_name;
        }
        else
        {
            $property_name = $request->address;
        }


		if(!empty($inputs['id'])){

            if($request->route == 'property')
            {
                $property = Properties::findOrFail($inputs['id']);

                $property_slug = Str::slug($property_name, "-");

                if (Properties::where('property_slug',$property_slug)->where('id','!=',$inputs['id'])->exists()) {
                    $property_slug = $this->incrementSlug($property_slug,1);
                }
            }
            elseif($request->route == 'construction')
            {
                $property = New_Constructions::findOrFail($inputs['id']);

                $property_slug = Str::slug($property_name, "-");

                if (Properties::where('property_slug',$property_slug)->where('id','!=',$inputs['id'])->exists()) {
                    $property_slug = $this->incrementSlug($property_slug,2);
                }
            }
            else
            {
                $property = Home_Exchange::findOrFail($inputs['id']);

                $property_slug = Str::slug($property_name, "-");

                if (Properties::where('property_slug',$property_slug)->where('id','!=',$inputs['id'])->exists()) {
                    $property_slug = $this->incrementSlug($property_slug,3);
                }
            }

            /*$slug = $property->where('id','!=',$inputs['id'])->where('property_slug',$property_slug)->first();

            if($slug)
            {
                return redirect()->back()->withErrors('Property Name already taken!')->withInput();
            }*/


        }else{

            $user_id=Auth::user()->id;

            if($request->route == 'property')
            {
                $property = new Properties;
                $property_type = "Simple Property";

                $property_slug = Str::slug($property_name, "-");

                if (Properties::where('property_slug',$property_slug)->exists()) {
                    $property_slug = $this->incrementSlug($property_slug,1);
                }
            }
            elseif($request->route == 'construction')
            {
                $property = new New_Constructions;
                $property_type = "New Construction Property";

                $property_slug = Str::slug($property_name, "-");

                if (Properties::where('property_slug',$property_slug)->exists()) {
                    $property_slug = $this->incrementSlug($property_slug,2);
                }
            }
            else
            {
                $property = new Home_Exchange;
                $property_type = "Home Exchange Property";

                $property_slug = Str::slug($property_name, "-");

                if (Properties::where('property_slug',$property_slug)->exists()) {
                    $property_slug = $this->incrementSlug($property_slug,3);
                }
            }

            $property->user_id = $user_id;

            /*$slug = $property->where('property_slug',$property_slug)->first();

            if($slug)
            {
                return redirect()->back()->withErrors('Property Name already taken!')->withInput();
            }*/

        }


		//property featured image
		$featured_image = $request->file('featured_image');


        if($request->f_image)
        {
            if($request->f_image != $property->featured_image.'-s.jpg')
            {
                \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-b.jpg');
                \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-s.jpg');


                $tmpFilePath = 'upload/properties/';

                $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

                $this->compressImage($featured_image,$tmpFilePath.$hardPath.'-b.jpg',30);
                $this->compressImage($featured_image,$tmpFilePath.$hardPath.'-s.jpg',20);

                $property->featured_image = $hardPath;
            }

        }
        else
        {
            \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-b.jpg');
            \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-s.jpg');

            $property->featured_image = NULL;
        }

        $p_count = 1;

        if(Auth::user()->usertype == 'Users')
        {
            $limit = 5;
        }
        else
        {
            $limit = 24;
        }

        for($i=1; $i<=$limit; $i++)
        {
            $p = 'p_image'.$i;
            $d = 'p_remove'.$i;
            $p1 = 'property_images'.$i;

            $p_image = $request->$p;
            $d_remove = $request->$d;
            $ac_image = $request->file($p1);

            if($p_image)
            {
                $p_count = $p_count + 1;

                if($request->$p != $property->$p1.'-b.jpg')
                {
                    \File::delete(public_path() .'/upload/properties/'.$property->$p1.'-b.jpg');

                    $tmpFilePath = 'upload/properties/';

                    $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

                    $this->compressImage($ac_image,$tmpFilePath.$hardPath.'-b.jpg',25);

                    $property->$p1 = $hardPath;
                }
            }
            elseif($d_remove)
            {
                $p_count = $p_count + 1;
                \File::delete(public_path() .'/upload/properties/'.$property->$p1.'-b.jpg');
                $property->$p1 = NULL;
            }
        }

        $property_images = $request->file('property_images');


        if($property_images){

            $countfiles = count($_FILES['property_images']['name']);

            $tmpFilePath = 'upload/properties/';

            for($i=0;$i<$countfiles;$i++) {

                $filename = $_FILES['property_images']['name'][$i];

                if($filename)
                {

                    $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

                    $target_file = $tmpFilePath . $hardPath . '-b.jpg';

                    $image = $_FILES['property_images']['tmp_name'][$i];

                    $this->compressImage($image,$target_file,25);

                    $check = 0;

                    for($x=1;$x<=$limit;$x++) {

                        if(!$check)
                        {
                            $w = 'property_images'.$x;

                            if(is_null($property->$w))
                            {
                                $property->$w = $hardPath;
                                $check = 1;
                            }
                        }
                    }
                }

            }

        }


        $video = $request->file('video');

        if($request->remove_video)
        {
            \File::delete(public_path() .'/upload/properties/'.$property->video);
            $property->video = NULL;
        }

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

        $docs = [];

        if($documents){

            $countfiles = count($_FILES['documents']['name']);

            $find = property_documents::where('property_id',$property->id)->get();

            foreach ($find as $temp)
            {
                \File::delete(public_path() .'/upload/properties/documents/'.$temp->document);
            }

            property_documents::where('property_id',$property->id)->delete();


            $tmpFilePath = 'upload/properties/documents/';

            for($i=0;$i<$countfiles;$i++) {

                $filename = $_FILES['documents']['name'][$i];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));


                $target_file = $tmpFilePath . $hardPath . '.' . $ext;

                move_uploaded_file($_FILES["documents"]["tmp_name"][$i],$target_file);

                $docs[$i] = $hardPath . "." . $ext;

            }

        }


        $first_floor = $request->file('first_floor');

        if($first_floor){

            \File::delete(public_path() .'/upload/properties/'.$property->first_floor);

            $filename = $_FILES['first_floor']['name'];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            if($ext == 'pdf' || $ext == 'PDF')
            {
                $target_file = $tmpFilePath . $hardPath . '.' . $ext;

                move_uploaded_file($_FILES["first_floor"]["tmp_name"],$target_file);
            }
            else
            {

                $img = Image::make($first_floor);

                $img->save($tmpFilePath.$hardPath.'.'.$ext);
            }



            $property->first_floor = $hardPath . '.' . $ext;

        }

        $second_floor = $request->file('second_floor');


        if($second_floor){

            \File::delete(public_path() .'/upload/properties/'.$property->second_floor);

            $filename = $_FILES['second_floor']['name'];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            if($ext == 'pdf' || $ext == 'PDF')
            {
                $target_file = $tmpFilePath . $hardPath . '.' . $ext;

                move_uploaded_file($_FILES["second_floor"]["tmp_name"],$target_file);
            }
            else
            {

                $img = Image::make($second_floor);


                $img->save($tmpFilePath.$hardPath.'.'.$ext);
            }


            $property->second_floor = $hardPath . '.' . $ext;

        }



        $ground_floor = $request->file('ground_floor');

        if($ground_floor){

            \File::delete(public_path() .'/upload/properties/'.$property->ground_floor);

            $filename = $_FILES['ground_floor']['name'];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            if($ext == 'pdf' || $ext == 'PDF')
            {
                $target_file = $tmpFilePath . $hardPath . '.' . $ext;

                move_uploaded_file($_FILES["ground_floor"]["tmp_name"],$target_file);
            }
            else
            {

                $img = Image::make($ground_floor);

                $img->save($tmpFilePath.$hardPath.'.'.$ext);
            }


            $property->ground_floor = $hardPath . '.' . $ext;

        }

        $basement = $request->file('basement');

        if($basement){

            \File::delete(public_path() .'/upload/properties/'.$property->basement);

            $filename = $_FILES['basement']['name'];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);


            $tmpFilePath = 'upload/properties/';

            $hardPath =  Str::slug($inputs['property_name'], '-').'-'.md5(rand(0,99999));

            if($ext == 'pdf' || $ext == 'PDF')
            {
                $target_file = $tmpFilePath . $hardPath . '.' . $ext;

                move_uploaded_file($_FILES["basement"]["tmp_name"],$target_file);
            }
            else
            {

                $img = Image::make($basement);

                $img->save($tmpFilePath.$hardPath.'.'.$ext);

            }


            $property->basement = $hardPath . '.' . $ext;

        }


		/*if($inputs['property_slug']=="")
		{
			$property_slug  = Str::slug($inputs['property_name'], "-");
		}
		else
		{
			$property_slug = Str::slug($inputs['property_slug'], "-");
		}*/

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

		if($request->property_features)
        {
            $features = implode(',', $request->property_features);
        }
		else
        {
            $features = '';
        }

        if($request->route != 'home_exchange')
        {
            if($request->route == 'property')
            {
                if($request->property_purpose == "Sale")
                {
                    $rent_price = 0;
                    $sale_price = $request->sale_price;
                }
                else
                {
                    $sale_price = 0;
                    $rent_price = $request->rent_price;
                }
            }
            elseif($request->route == 'construction')
            {
                if($request->kind_of_type == "For Sale")
                {
                    $rent_price = 0;
                    $sale_price = $request->sale_price;
                }
                else
                {
                    $sale_price = 0;
                    $rent_price = $request->rent_price;
                }
            }

        }
        else
        {
            $sale_price = 0;
            $rent_price = 0;
            $request->available_immediately = 0;
            $request->garage = 0;
        }



		if($request->wheelchair)
        {
            $wheelchair = 1;
        }
		else
        {
            $wheelchair = 0;
        }


		if(!$request->property_purpose)
        {
            $request->property_purpose = 'Sale';
        }

		if(!$request->cost_for)
        {
            $request->cost_for = 'k.k.';
        }

		if(!$request->bedrooms)
        {
            $request->bedrooms = 0;
        }

        if(!$request->bathrooms)
        {
            $request->bathrooms = 0;
        }

		$property->available_immediately = $request->available_immediately;
		$property->property_name = $property_name;
		$property->property_slug = $property_slug;
		$property->city_id = $city_id;
		$property->property_type = $request->property_type;
		$property->property_purpose = $request->property_purpose;
		$property->sale_price = $sale_price;
		$property->rent_price = $rent_price;
		$property->cost_for = $request->cost_for;
		$property->address = $request->address;
        $property->map_latitude = $request->address_latitude;
        $property->map_longitude = $request->address_longitude;
		$property->bathrooms = $request->bathrooms;
		$property->bedrooms = $request->bedrooms;
        $property->garage = $request->garage;
		$property->area = $request->area;
		$property->property_features = $features;
        $property->keywords = $request->property_keywords;
		$property->description = $request->description;
        $property->open_date = $request->date;
        $property->open_timeFrom = $request->time_from;
        $property->open_timeTo = $request->time_to;
        $property->volume = $request->volume;
        $property->floors = $request->floors;
        $property->backyard = $request->backyard;
        $property->frontyard = $request->frontyard;
        $property->terrace = $request->terrace;
        $property->garage_type = $request->garage_type;
        $property->energy_rating = $request->energy_rating;
        $property->solar_panel = $request->solar_panel;
        $property->walls = $request->walls;
        $property->roof_insulation = $request->roof_insulation;
        $property->cook = $request->cook;
        $property->type_of_boiler = $request->type_of_boiler;
        $property->agreement_type = $request->agreement_type;
        $property->year_boiler = $request->year_boiler;
        $property->property_furnished = $request->property_furnished;
        $property->wheelchair = $wheelchair;
        $property->available_from = $request->available_from;

        if($request->route == 'property')
        {
            $property->construction_type = $request->construction_type;
            $property->year_construction = $request->year_construction;
            $property->building_condition = $request->building_condition;
            $property->service_costs = $request->service_costs;

        }
        elseif($request->route == 'construction')
        {
            $property->new_construction = 1;
            $property->kind_of_type = $request->kind_of_type;
            $property->realization = $request->realization;
            $property->homes = $request->homes;
            $property->rental_properties = $request->rental_properties;
            $property->source = $request->source;
            $property->price_description = $request->price_description;

            if (strpos($request->citation,'https://') === false && strpos($request->citation,'http://') === false){
                $request->citation = 'https://'.$request->citation;
            }

            $property->citation = $request->citation;
            $property->owner = $request->owner;

        }
        else
        {
            $property->home_exchange = 1;
            $property->owner = $request->owner;
            $property->rent_per_month = $request->rent_per_month;
            $property->service_costs = $request->service_costs;
            $property->preferred_kind = $request->preferred_kind;
            $property->preferred_area = $request->preferred_area;
            $property->preferred_bedrooms = $request->preferred_bedrooms;
            $property->preferred_bathrooms = $request->preferred_bathrooms;
            $property->preferred_place = $request->preferred_place;
            $property->preferred_latitude = $request->preferred_latitude;
            $property->preferred_longitude = $request->preferred_longitude;
            $property->preferred_radius = $request->preferred_radius;
            $property->neighbourhood = $request->neighbourhood;
            $property->preferred_rent_max = $request->preferred_rent_max;
            $property->preferred_description = $request->preferred_description;

        }


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

            \Session::flash('flash_message', __('text.Changes Saved'));

            if($request->route == 'home_exchange')
            {
                return redirect('admin/home_exchange');
            }
            else
            {
                return \Redirect::back();
            }

        }else{

            $email = "info@zoekjehuisje.nl";
            $user_name= Auth::user()->name;

            Mail::send(array(), array(), function ($message) use($email,$user_name,$property_type) {
                $message->to($email)
                    ->from(getcong('site_email'),getcong('site_name'))
                    ->subject('New Property Created!')
                    ->setBody("Hi, A ".$property_type." is created by '".$user_name."',<br><br>Thanks!<br />- ".getcong('site_name'), 'text/html');
            });

            \Session::flash('flash_message', __('text.Property Added'));

            if($request->route == 'home_exchange')
            {
                return redirect('admin/home_exchange');
            }
            else
            {
                return \Redirect::back();
            }
        }


    }

    public function editproperty($id)
    {

          $property = Properties::findOrFail($id);

          $types = Types::where('show_type','!=',1)->orderBy('types')->get();

          $city_list = City::where('status','1')->orderBy('city_name')->get();

        $property_features = property_features::all();

          return view('admin.pages.addeditproperty',compact('property','city_list','types','property_features'));

    }

    public function editnewconstruction($id)
    {
        $property = New_Constructions::findOrFail($id);

        $types = Types::where('show_type','!=',1)->orderBy('types')->get();

        $city_list = City::where('status','1')->orderBy('city_name')->get();

        $property_features = property_features::all();

        return view('admin.pages.addeditproperty',compact('property','city_list','types','property_features'));

    }

    public function edithomeexchange($id)
    {
        $property = Home_Exchange::findOrFail($id);

        $types = Types::where('show_type','!=',3)->orderBy('types')->get();

        $city_list = City::where('status','1')->orderBy('city_name')->get();

        $property_features = property_features::all();

        return view('admin.pages.addeditproperty',compact('property','city_list','types','property_features'));

    }


	public function delete($id)
    {
        $property = Properties::findOrFail($id);

		\File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-b.jpg');
		\File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-s.jpg');

		for($i=1; $i<30; $i++)
        {
            $p = 'property_images'.$i;

            \File::delete(public_path() .'/upload/properties/'.$property->$p.'-b.jpg');
        }

        \File::delete(public_path() .'/upload/properties/'.$property->first_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->second_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->ground_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->basement);
        \File::delete(public_path() .'/upload/properties/'.$property->video);

        $find = property_documents::where('property_id',$id)->get();

        foreach ($find as $temp)
        {
            \File::delete(public_path() .'/upload/properties/documents/'.$temp->document);
        }

        property_documents::where('property_id',$id)->delete();

		$property->delete();

        \Session::flash('flash_message', __('text.Property Deleted!'));

        return redirect()->back();

    }

    public function deleteNewConstruction($id)
    {

        $property = New_Constructions::findOrFail($id);

        \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-b.jpg');
        \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-s.jpg');

        for($i=1; $i<30; $i++)
        {
            $p = 'property_images'.$i;

            \File::delete(public_path() .'/upload/properties/'.$property->$p.'-b.jpg');
        }

        \File::delete(public_path() .'/upload/properties/'.$property->first_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->second_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->ground_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->basement);
        \File::delete(public_path() .'/upload/properties/'.$property->video);

        $find = property_documents::where('property_id',$id)->get();

        foreach ($find as $temp)
        {
            \File::delete(public_path() .'/upload/properties/documents/'.$temp->document);
        }

        property_documents::where('property_id',$id)->delete();

        $property->delete();

        \Session::flash('flash_message', __('text.Property Deleted!'));

        return redirect()->back();

    }

    public function deleteHomeExchange($id)
    {

        $property = Home_Exchange::findOrFail($id);

        \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-b.jpg');
        \File::delete(public_path() .'/upload/properties/'.$property->featured_image.'-s.jpg');

        for($i=1; $i<30; $i++)
        {
            $p = 'property_images'.$i;

            \File::delete(public_path() .'/upload/properties/'.$property->$p.'-b.jpg');
        }

        \File::delete(public_path() .'/upload/properties/'.$property->first_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->second_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->ground_floor);
        \File::delete(public_path() .'/upload/properties/'.$property->basement);
        \File::delete(public_path() .'/upload/properties/'.$property->video);

        $find = property_documents::where('property_id',$id)->get();

        foreach ($find as $temp)
        {
            \File::delete(public_path() .'/upload/properties/documents/'.$temp->document);
        }

        property_documents::where('property_id',$id)->delete();

        $property->delete();

        \Session::flash('flash_message', __('text.Property Deleted!'));

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

    public function statusNewConstruction($id)
    {
        $property = New_Constructions::findOrFail($id);

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

    public function statusHomeExchange($id)
    {
        $property = Home_Exchange::findOrFail($id);

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

    public function featuredNewConstruction($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $property = New_Constructions::findOrFail($id);

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

    public function featuredHomeExchange($id)
    {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $property = Home_Exchange::findOrFail($id);

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
