<?php

namespace App\Http\Controllers\Admin;

use App\property_features;
use App\user_services;
use Auth;
use App\User;
use App\City;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;

class AdminController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function profile()
    {
        $city_list = City::orderBy('city_name')->get();

        $services_ids = user_services::where('user_id',Auth::user()->id)->pluck('service_id')->toArray();;

        return view('admin.pages.profile',compact('city_list','services_ids'));
    }

    public function updateProfile(Request $request)
    {

        $user = User::findOrFail(Auth::user()->id);


        $data =  \Request::except(array('_token'));


        if($request->services)
        {
            $services = $request->services;
        }
        else
        {
            $services = '';
        }

            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users,id',
                'image_icon' => 'mimes:jpg,jpeg,gif,png',
            );


        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }


        $inputs = $request->all();

        $icon = $request->file('user_icon');

        if($icon){

            \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-b.jpg');
            \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-s.jpg');

            $tmpFilePath = 'upload/members/';

            $hardPath =  str_slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');
            $img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user->image_icon = $hardPath;
        }

if($request->herefor)
{
    $herefor = $request->herefor;
}
else
{
    $herefor = null;
}

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->fax = $request->fax;
        $user->herefor = $herefor;
        $user->show_email = $request->show_email;
        $user->company_name = $request->company_name;
        $user->address = $request->address;
        $user->address_latitude = $request->address_latitude;
        $user->address_longitude = $request->address_longitude;
        $user->city= $request->city;
        $user->about = $request->about;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->gplus = $request->gplus;
        $user->linkedin = $request->linkedin;

        if(Auth::user()->usertype != 'Admin' && Auth::user()->usertype != 'Users')
        {
            if($services)
            {
                $post = user_services::where('user_id',Auth::user()->id)->delete();

                foreach($services as $temp)
                {
                    $new_service = new user_services();
                    $new_service->user_id =  Auth::user()->id;
                    $new_service->service_id = $temp;
                    $new_service->save();
                }

            }

            $user->monday_timeFrom = $request->monday_timeFrom;
            $user->monday_timeTo = $request->monday_timeTo;
            $user->monday_description = $request->monday_description;
            $user->tuesday_timeFrom = $request->tuesday_timeFrom;
            $user->tuesday_timeTo = $request->tuesday_timeTo;
            $user->tuesday_description = $request->tuesday_description;
            $user->wednesday_timeFrom = $request->wednesday_timeFrom;
            $user->wednesday_timeTo = $request->wednesday_timeTo;
            $user->wednesday_description = $request->wednesday_description;
            $user->thursday_timeFrom = $request->thursday_timeFrom;
            $user->thursday_timeTo = $request->thursday_timeTo;
            $user->thursday_description = $request->thursday_description;
            $user->friday_timeFrom = $request->friday_timeFrom;
            $user->friday_timeTo = $request->friday_timeTo;
            $user->friday_description = $request->friday_description;
            $user->saturday_timeFrom = $request->saturday_timeFrom;
            $user->saturday_timeTo = $request->saturday_timeTo;
            $user->saturday_description = $request->saturday_description;
            $user->sunday_timeFrom = $request->sunday_timeFrom;
            $user->sunday_timeTo = $request->sunday_timeTo;
            $user->sunday_description = $request->sunday_description;
            $user->sold_prev = $request->sold_prev;
            $user->rentout_prev = $request->rentout_prev;
            $user->sold_prev_prev = $request->sold_prev_prev;
            $user->rentout_prev_prev = $request->rentout_prev_prev;
            $user->prev_year = $request->prev_year;
            $user->prev_prev_year = $request->prev_prev_year;
        }


        $user->save();

        Session::flash('flash_message', __('text.Successfully updated!'));

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {

        //$user = User::findOrFail(Auth::user()->id);


        $data =  \Request::except(array('_token')) ;
        $rule  =  array(
            'password'       => 'required|confirmed',
            'password_confirmation'       => 'required'
        ) ;

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        /* $val=$this->validate($request, [
             'password' => 'required|confirmed',
     ]);  */

        $credentials = $request->only('password', 'password_confirmation'
        );

        $user = \Auth::user();
        $user->password = bcrypt($credentials['password']);
        $user->save();

        Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }


}
