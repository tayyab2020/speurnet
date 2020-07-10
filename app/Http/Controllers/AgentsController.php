<?php

namespace App\Http\Controllers;

use App\User;
use app\Properties;


use App\user_services;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AgentsController extends Controller
{


    public function index()
    {
        $agents = User::where('usertype','Agents')->where('status',1)->orderBy('id', 'desc')->paginate(9);
        $usertype='Agent';
        return view('pages.agents',compact('agents','usertype'));
    }

    public function SearchAgents(Request $request)
    {
        $agent_name = $request->agent_name;
        $address = $request->address;
        $address_latitude = $request->city_latitude;
        $address_longitude = $request->city_longitude;
        $radius = $request->radius;
        $service = $request->services;
        $to_remove = [];


        if($service)
        {
            $agents = user::leftjoin('user_services','user_services.user_id','=','users.id')->where('users.usertype','Agents')->where('users.status',1)->where('user_services.service_id',$service)->where('users.name', 'like', '%' . $agent_name . '%')->select('users.*');
        }
        else
        {
            $agents = user::where('users.usertype','Agents')->where('users.status',1)->where('users.name', 'like', '%' . $agent_name . '%');
        }

        if($address && $address_latitude && $address_longitude)
        {
            if($radius != 0)
            {
                foreach ($agents->get() as $index => $key)
                {
                    $agent_latitude = $key->address_latitude;
                    $agent_longitude = $key->address_longitude;

                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($address_latitude).",".urlencode($address_longitude)."&destinations=".urlencode($agent_latitude).",".urlencode($agent_longitude)."&key=AIzaSyDFPa3LVeBRpaGafuUtk4znrty6IIqtMUw";

                    $result_string = file_get_contents($url);
                    $result = json_decode($result_string, true);


                    if($result['rows'][0]['elements'][0]['status'] == 'OK')
                    {
                        $agent_radius = $result['rows'][0]['elements'][0]['distance']['value'];
                        $agent_radius = $agent_radius / 1000;

                        $agent_radius = round($agent_radius);


                        if($agent_radius >= $radius)
                        {
                            $agents->where('users.id','!=',$key->id);
                        }
                    }
                    else
                    {
                        $agents->where('users.id','!=',$key->id);
                    }

                }

                $agents = $agents->paginate(9);

            }
            else
            {
                $agents = $agents->where('users.city', 'like', '%' . $address . '%')->paginate(9);
            }

        }


        return view('pages.agents',compact('agents','service','agent_name','address','address_longitude','address_latitude','radius'));
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
