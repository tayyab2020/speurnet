<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Properties;
use App\Enquire;
use App\Partners;
use App\Subscriber;
use App\Testimonials;
use App\faqs;
use Session;

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

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

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

}
