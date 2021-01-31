<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Settings;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SettingsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

    }
    public function settings()
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $settings = Settings::findOrFail('1');

        return view('admin.pages.settings',compact('settings'));
    }

    public function settingsUpdates(Request $request)
    {

    	$settings = Settings::findOrFail('1');


	    $data =  \Request::except(array('_token')) ;

	    $rule=array(
		        'site_name' => 'required',
		        'site_email' => 'required'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }


	    $inputs = $request->all();

		$icon = $request->file('site_logo');

		$icon_favicon = $request->file('site_favicon');

		//Logo

        if($icon){

            unlink(public_path().'/upload/' . $settings->site_logo);

            $icon_name = "logo" . time() . ".png";

            $icon->move(public_path().'/upload/', $icon_name);

            $settings->site_logo = $icon_name;

        }

        //Favicon
        if($icon_favicon){

            unlink(public_path().'/upload/' . $settings->site_favicon);

            $favicon_name = "favicon" . time() . ".png";

        	$icon_favicon->move(public_path().'/upload/', $favicon_name);

            $settings->site_favicon = $favicon_name;

        }

		$settings->site_style = $inputs['site_style'];
		$settings->site_name = $inputs['site_name'];
		$settings->currency_sign = $inputs['currency_sign'];
		$settings->site_email = $inputs['site_email'];
		$settings->site_description = $inputs['site_description'];
		$settings->site_keywords = $inputs['site_keywords'];
		$settings->site_copyright = $inputs['site_copyright'];
		$settings->footer_widget1 = $inputs['footer_widget1'];
		$settings->footer_widget2 = $inputs['footer_widget2'];
		$settings->footer_widget3 = $inputs['footer_widget3'];



	    $settings->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function social_links_update(Request $request)
    {

    	$settings = Settings::findOrFail('1');


	    $data =  \Request::except(array('_token')) ;


	    $inputs = $request->all();


		$settings->social_facebook = $inputs['social_facebook'];
		$settings->social_twitter = $inputs['social_twitter'];
		$settings->social_linkedin = $inputs['social_linkedin'];
		$settings->social_gplus = $inputs['social_gplus'];
        $settings->social_insta = $inputs['social_insta'];


	    $settings->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function addthisdisqus(Request $request)
    {

    	$settings = Settings::findOrFail('1');


	    $data =  \Request::except(array('_token')) ;


	    $inputs = $request->all();


		$settings->disqus_comment_code = $inputs['disqus_comment_code'];


	    $settings->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function about_us_page(Request $request)
    {

    	$settings = Settings::findOrFail('1');


	    $data =  \Request::except(array('_token')) ;


	    $inputs = $request->all();


		$settings->about_us_title = $inputs['about_us_title'];
		$settings->about_us_description = $inputs['about_us_description'];


	    $settings->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function careers_with_us_page(Request $request)
    {

    	$settings = Settings::findOrFail('1');


	    $data =  \Request::except(array('_token')) ;


	    $inputs = $request->all();


		$settings->careers_with_us_title = $inputs['careers_with_us_title'];
		$settings->careers_with_us_description = $inputs['careers_with_us_description'];


	    $settings->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function terms_conditions_page(Request $request)
    {

    	$settings = Settings::findOrFail('1');


	    $data =  \Request::except(array('_token')) ;


	    $inputs = $request->all();


		$settings->terms_conditions_title = $inputs['terms_conditions_title'];
		$settings->terms_conditions_description = $inputs['terms_conditions_description'];


	    $settings->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function privacy_policy_page(Request $request)
    {

    	$settings = Settings::findOrFail('1');


	    $data =  \Request::except(array('_token')) ;


	    $inputs = $request->all();


		$settings->privacy_policy_title = $inputs['privacy_policy_title'];
		$settings->privacy_policy_description = $inputs['privacy_policy_description'];


	    $settings->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function headfootupdate(Request $request)
    {

    	$settings = Settings::findOrFail('1');


	    $data =  \Request::except(array('_token')) ;


	    $inputs = $request->all();


		$settings->site_header_code = $inputs['site_header_code'];
		$settings->site_footer_code = $inputs['site_footer_code'];



	    $settings->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

}
