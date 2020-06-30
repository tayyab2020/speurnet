<?php

namespace App\Http\Controllers;

use App\User;
use app\Properties;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AgentsController extends Controller
{


    public function index()
    {
        $agents = User::where('usertype','Agents')->orderBy('id', 'desc')->paginate(9);;
        $usertype='Agent';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function filter($alphabet)
    {
        if(strtolower($alphabet)=='all'){
            $agents = User::where('usertype','Agents')->orderBy('id', 'desc')->paginate(9);
        }else if(strtolower($alphabet)=='vbo'){
            $agents = User::where('usertype','Agents')->where('herefor','1')->orderBy('id', 'desc')->paginate(9);
        }else if(strtolower($alphabet)=='nvm'){
            $agents = User::where('usertype','Agents')->where('herefor','2')->orderBy('id', 'desc')->paginate(9);
        }else{
            $agents = User::where('usertype','Agents')->where('name', 'LIKE', "$alphabet%")->orderBy('id', 'desc')->paginate(9);
        }
        $usertype='Agent';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function employerDetail($id)
    {
        $agent = User::where('id',$id)->first();
        return view('pages.agentsingle',compact('agent'));
    }
    public function searchByName(Request $request)
    {
        $agents = User::where('usertype','Agents')->where('name','LIKE',"%$request->employee_name%")->orderBy('id', 'desc')->paginate(9);
        $usertype='Agent';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function searchByCity(Request $request)
    {
        $agents = User::where('usertype','Agents')->where('city','LIKE',"%$request->employee_city%")->orWhere('address','LIKE',"%$request->employee_city%")->orderBy('id', 'desc')->paginate(9);
        $usertype='Agent';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function employerproperties($id)
    {
        $properties = Properties::where('user_id',$id)->orderBy('created_at', 'desc')->paginate(9);
        return view('pages.properties',compact('properties'));
    }

    public function builder_list()
    {
        $agents = User::where('usertype','Builder')->orderBy('id', 'desc')->paginate(9);;

        return view('pages.builders',compact('agents'));
    }


}
