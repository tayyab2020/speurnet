<?php

namespace App\Http\Controllers;

use App\agent_enquiry;
use App\User;
use app\Properties;


use App\user_services;
use Illuminate\Http\Request;
use Session;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AgentsController extends Controller
{


    public function index(Request $request)
    {
        ini_set('max_execution_time', '0');

        if($request->all())
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
                $agents = user::leftjoin('user_services','user_services.user_id','=','users.id')->where('users.usertype','Agents')->where('users.landlord',0)->where('users.status',1)->where('user_services.service_id',$service)->where('users.name', 'like', '%' . $agent_name . '%')->select('users.*')->withCount('properties')->orderBy('id', 'desc');
            }
            else
            {
                $agents = user::where('users.usertype','Agents')->where('users.landlord',0)->where('users.status',1)->where('users.name', 'like', '%' . $agent_name . '%')->withCount('properties')->orderBy('id', 'desc');
            }

            if($address)
            {
                if($radius != 0)
                {
                    foreach ($agents->get() as $index => $key)
                    {
                        $from = $address;
                        $to = $key->address;

                        $from = urlencode($from);
                        $to = urlencode($to);

                        if($key->address_latitude && $key->address_longitude)
                        {
                            $agent_latitude = $key->address_latitude;
                            $agent_longitude = $key->address_longitude;
                        }
                        else
                        {
                            $agent_coordinates = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$to&key=AIzaSyChgcpFYG5aLIvd_U0Xmx6ry7jlL9NI_BU");
                            $agent_coordinates = json_decode($agent_coordinates, true);

                            if($agent_coordinates['status'] == 'OK')
                            {
                                $agent_latitude = $agent_coordinates['results'][0]['geometry']['location']['lat'];
                                $agent_longitude = $agent_coordinates['results'][0]['geometry']['location']['lng'];
                            }
                            else
                            {
                                $agent_latitude = 0;
                                $agent_longitude = 0;
                            }
                        }

                        if($agent_latitude != 0 && $agent_longitude != 0)
                        {
                            $theta = $address_longitude - $agent_longitude;
                            $dist = sin(deg2rad($address_latitude)) * sin(deg2rad($agent_latitude)) +  cos(deg2rad($address_latitude)) * cos(deg2rad($agent_latitude)) * cos(deg2rad($theta));
                            $dist = acos($dist);
                            $dist = rad2deg($dist);
                            $miles = $dist * 60 * 1.1515;
                            $distance = $miles * 1.609344;
                            $distance = round($distance);

                            if($distance >= 100)
                            {
                                $distance = $distance + 30;
                            }
                            elseif($distance >= 30)
                            {
                                $distance = $distance + 15;
                            }

                            if ($distance > $radius) {
                                $agents->where('users.id','!=',$key->id);
                            }
                        }

                        /*if($agent_latitude && $agent_longitude)
                        {
                            $data = file_get_contents("https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=".urlencode($address_latitude).",".urlencode($address_longitude)."&destinations=".urlencode($agent_latitude).",".urlencode($agent_longitude)."&travelMode=driving&key=ApGfIF6Y_pCEfKLHWz7J4f60CkCs4XhRQW4DA95a_lI2ATGKnoZmF-aqCwANOQND");
                            $data = json_decode($data, true);

                            if($data['statusCode'] == 200)
                            {
                                $distance = $data['resourceSets'][0]['resources'][0]['results'][0]['travelDistance'];

                                if ($distance > $radius) {
                                    $agents->where('users.id','!=',$key->id);
                                }
                            }
                            else
                            {
                                $agents->where('users.id','!=',$key->id);
                            }
                        }
                        else
                        {
                            $agents->where('users.id','!=',$key->id);
                        }*/

                        /*$data = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyA65DZUJgWuYMvWwfgDQ59mPlxiRQJ6TdA&origins=$from&destinations=$to&language=en-EN&sensor=false");
                        $data = json_decode($data);


                        if($data->status == 'OK' && $data->rows[0]->elements[0]->status == 'OK')
                        {
                            $distance = 0;

                            foreach($data->rows[0]->elements as $road) {
                                $distance += $road->distance->value;
                            }
                            $distance = $distance/1000;


                            if ($distance > $radius) {
                                $agents->where('users.id','!=',$key->id);
                            }
                        }
                        else
                        {
                            $agents->where('users.id','!=',$key->id);
                        }*/

                    }

                    $agents = $agents->paginate(9);

                }
                else
                {
                    $agents = $agents->where('users.city', 'like', '%' . $address . '%')->paginate(9);
                }

            }
            else if($address)
            {
                $agents = $agents->where('users.city', 'like', '%' . $address . '%')->paginate(9);
            }
            else
            {
                $agents = $agents->paginate(9);
            }
        }
        else
        {
            $agents = User::where('usertype','Agents')->where('landlord',0)->where('status',1)->withCount('properties')->orderBy('id', 'desc')->paginate(9);


            $usertype='Agent';
            $service = '';
            $agent_name = '';
            $address = '';
            $address_latitude = '';
            $address_longitude = '';
            $radius = '';
        }


        return view('pages.agents',compact('agents','service','agent_name','address','address_longitude','address_latitude','radius'));

    }

    public function SendEnquiry(Request $request)
    {
        $post = new agent_enquiry();
        $post->agent_id = $request->agent_id;
        $post->message = $request->message;
        if($request->selling)
        {
            $post->selling = 1;
        }
        if($request->leasing)
        {
            $post->leasing = 1;
        }
        if($request->rent_property)
        {
            $post->rent_property = 1;
        }
        if($request->property_appraisal)
        {
            $post->property_appraisal = 1;
        }
        if($request->buy_property)
        {
            $post->buy_property = 1;
        }
        if($request->another_topic)
        {
            $post->another_topic = 1;
        }
        $post->first_name= $request->first_name;
        $post->last_name = $request->last_name;
        $post->email = $request->email;
        $post->phone = $request->phone;
        $post->postcode = $request->postcode;

        $post->save();

        $parameters = $request;

        Mail::send('emails.profileEnquiry',
            array(
                'parameters' => $parameters,
            ),  function ($message) use($parameters) {
                $message->from(getcong('site_email'),getcong('site_name'));
                $message->to($parameters->agent_email)
                    ->subject(__('text.Enquiry request posted by ') . $parameters->first_name . " " . $parameters->last_name);
            });

        Mail::send('emails.profileEnquiryCopy',
            array(
                'parameters' => $parameters,
            ),  function ($message) use($parameters) {
                $message->from(getcong('site_email'),getcong('site_name'));
                $message->to($parameters->email)
                    ->subject(__('text.Enquiry request posted to Agent Mr/Mrs, ') . $parameters->agent_name);
            });


        Session::flash('flash_message', __('text.Your Enquiry has been submitted successfully!'));

        return redirect()->back();

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
