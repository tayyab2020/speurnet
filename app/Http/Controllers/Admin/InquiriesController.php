<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Enquire;
use App\request_viewings;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class InquiriesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }

    public function viewingslist()
    {
        if(Auth::User()->usertype!="Admin")
        {
            $user_id=Auth::user()->id;

            $viewingslist = request_viewings::where('agent_id',$user_id)->orderBy('id','desc')->with('user')->get();
        }
        else
        {
            $viewingslist = request_viewings::orderBy('id','desc')->get();
        }


        return view('admin.pages.viewings',compact('viewingslist'));
    }

    public function ShowView($id)
    {
        if(Auth::User()->usertype!="Admin")
        {
            $user_id=Auth::user()->id;

            $viewingslist = request_viewings::where('property_id',$id)->where('agent_id',$user_id)->orderBy('id','desc')->with('user')->get();
        }
        else
        {
            $viewingslist = request_viewings::where('property_id',$id)->orderBy('id','desc')->get();
        }



        return view('admin.pages.viewing',compact('viewingslist'));
    }

    public function ShowInquiry($id)
    {
        if(Auth::User()->usertype!="Admin")
        {
            $user_id=Auth::user()->id;

            $inquirieslist = Enquire::where('property_id',$id)->where('agent_id',$user_id)->orderBy('id')->with('user')->get();
        }
        else
        {
            $inquirieslist = Enquire::where('property_id',$id)->get();
        }

        return view('admin.pages.inquiry',compact('inquirieslist'));
    }

    public function inquirieslist()
    {
    	if(Auth::User()->usertype!="Admin")
    	{
    		$user_id=Auth::user()->id;

			$inquirieslist = Enquire::where('agent_id',$user_id)->orderBy('id')->with('user')->get();
		}
		else
		{
			$inquirieslist = Enquire::orderBy('id')->get();
		}


        return view('admin.pages.inquiries',compact('inquirieslist'));
    }


    public function delete($id)
    {

        $inquire = Enquire::findOrFail($id);


		$inquire->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function Viewingsdelete($id)
    {

        $view = request_viewings::findOrFail($id);


        $view->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


}
