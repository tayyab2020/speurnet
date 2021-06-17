@extends("app")

@section('head_title', isset($page_content->meta_title) ? $page_content->meta_title : $agent->name .' | '.getcong('site_name'))
@section('head_keywords', isset($page_content->meta_keywords) ? $page_content->meta_keywords : '')
@section('head_description', isset($page_content->meta_description) ? $page_content->meta_description : substr(strip_tags($agent->description),0,200))
@section('head_sub_keywords', isset($page_content->meta_sub_keywords) ? $page_content->meta_sub_keywords : '')
@section('head_image', asset('/upload/members/'.$agent->image_icon.'-b.jpg'))
@section('head_url', Request::url())

@section("content")


    <!-- begin:header -->
    {{--<div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        <h2>{{$agent->name}}</h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>
                        <li><a href="{{ URL::to('makelaars/') }}">{{__('text.Agents')}}</a></li>
                        <li class="active">{{$agent->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>--}}
    <!-- end:header -->

    @if(Session::has('flash_message'))
        <div class="alert alert-success" style="text-align: center;font-size: 16px;color: black;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span style="font-size: 36px;font-weight: 600;line-height: 0.6;" aria-hidden="true">&times;</span></button>
            {{ Session::get('flash_message') }}
        </div>
    @endif

    <div class="row" style="margin: 0;margin-top: 11px;border-bottom: 1px solid #ebebeb;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-container" style="padding: 25px 80px;">
            <div class="team-container team-dark" style="border-color: transparent;background-color: white;color: #7a7878;">
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 team-image">
                    @if($agent->image_icon)
                        <img style="height: 200px;" src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" alt="{{$agent->name}}">
                    @elseif($agent->company_name)
                        <h3 style="margin: 0;display: flex;align-items: center;justify-content: center;height: 200px;border: 1px solid;text-align: center;word-break: break-word;">{{$agent->company_name}}</h3>
                    @endif

                        <div class="team-social" style="display:flex;justify-content: center;">

                            @if($agent->twitter)
                                <span><a href="{{$agent->twitter}}" title="Twitter" rel="tooltip" data-placement="top"><i style="color: #448fed;" class="fa fa-twitter"></i></a></span>
                            @endif

                            @if($agent->facebook)
                                <span><a href="{{$agent->facebook}}" title="Facebook" rel="tooltip" data-placement="top"><i style="color: #4545b2;" class="fa fa-facebook"></i></a></span>
                            @endif

                            @if($agent->gplus)
                                <span><a href="{{$agent->gplus}}" title="Google Plus" rel="tooltip" data-placement="top"><i style="color: #cc3636;" class="fa fa-google-plus"></i></a></span>
                            @endif

                            @if($agent->linkedin)
                                <span><a href="{{$agent->linkedin}}" title="LinkedIn" rel="tooltip" data-placement="top"><i style="color: #4e4e99;" class="fa fa-linkedin"></i></a></span>
                            @endif

                                @if($agent->instagram)
                                    <span><a href="{{$agent->instagram}}" title="Instagram" rel="tooltip" data-placement="top"><i style="color: #cc3636;" class="fa fa-instagram"></i></a></span>
                                @endif

                                @if($agent->website)
                                    <span><a href="{{$agent->website}}" title="Website" rel="tooltip" data-placement="top"><i style="color: #5a83c2;" class="fa fa-globe"></i></a></span>
                                @endif

                        </div>

                </div>
                <div class="team-description" style="display: inline-block;padding-top: 0;">
                    <h3 style="margin-top: 0px;"><a style="color: black;" href="{{URL::to('makelaars/details/'.$agent->id)}}">{{$agent->name}}</a></h3>
                    @if($agent->phone)
                    <p><i class="fa fa-phone"></i>&nbsp {{$agent->phone}}<br></p>
                    @endif

                    @if($agent->show_email)
                    <p><i class="fa fa-envelope"></i>&nbsp {{$agent->email}}</p>
                    @endif

                    @if($agent->address)
                    <p><i class="fa fa-map-marker-alt"></i>&nbsp {{$agent->address}}</p>
                    @endif

                    @if($agent->herefor == 1)

                        <p style="margin-top: 25px;">

                            <img style="width: 180px;" src="{{ URL::asset('upload/herefor1.png') }}">

                        </p>

                    @elseif($agent->herefor == 2)

                        <p style="margin-top: 25px;">

                            <img style="width: 50px;" src="{{ URL::asset('upload/herefor2.png') }}">

                        </p>

                    @endif


                </div>
            </div>
        </div>
    </div>

    <style>

        @media (max-width: 500px) {
            #content
            {
                padding: 30px 0;
            }

            #header.heading
            {
                min-height: 155px;
                padding-top: 10px;
                padding-bottom: 0;
            }
        }

        @media (min-width: 600px)
        {
            .team-image
            {
                width: 250px;
            }
        }

        @media (max-width: 600px)
        {
            .team-description
            {
                padding-top: 20px !important;
            }
        }

        @media (max-width: 1024px)
        {
            .top-container
            {
                padding: 10px 40px !important;
            }


        }

    </style>

    <!-- begin:content -->
    <div id="content">
        <div class="container" style="width: 100%;">
            <div class="row mobile-row">

                <!-- begin:article -->
                <div class="col-md-9 main-content">
                    <div class="row">
                        <div class="col-md-12 single-post">
                            <ul style="box-shadow: 0 0 15px 0 #b4b4b445;" id="myTab" class="nav nav-tabs nav-justified">
                                <li class="property-tab active"><a href="#detail" id="left-tab" data-toggle="tab">{{__('text.Overview')}}</a></li>

                                <li class="contact-tab"><a href="#location" id="right-tab" data-toggle="tab">{{__('text.Find On Map')}}</a></li>

                            </ul>

                            <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

                            <style>

                                .tab-content > .active
                                {
                                    display: inline-block;
                                    width: 100%;
                                }

                                [type="checkbox"]:not(:checked),
                                [type="checkbox"]:checked {
                                    position: absolute;
                                    left: -9999px;
                                }
                                [type="checkbox"]:not(:checked) + label,
                                [type="checkbox"]:checked + label {
                                    position: relative;
                                    padding-left: 1.3em;
                                    cursor: pointer;
                                    font-weight: 600;
                                }

                                /* checkbox aspect */
                                [type="checkbox"]:not(:checked) + label:before,
                                [type="checkbox"]:checked + label:before {
                                    content: '';
                                    position: absolute;
                                    left: 0; top: 8px;
                                    width: 13px; height: 13px;
                                    border: 1px solid #7e7e7e;
                                    background: #fff;
                                    border-radius: 4px;
                                    box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
                                }
                                /* checked mark aspect */
                                [type="checkbox"]:not(:checked) + label:after,
                                [type="checkbox"]:checked + label:after {
                                    content: '\2713\0020';
                                    position: absolute;
                                    top: 8.5px; left: 0px;
                                    font-size: 1.2em;
                                    line-height: 0.8;
                                    color: #00b8ef;
                                    transition: all .2s;
                                    font-family: 'Lucida Sans Unicode', 'Arial Unicode MS', Arial;
                                }
                                /* checked mark aspect changes */
                                [type="checkbox"]:not(:checked) + label:after {
                                    opacity: 0;
                                    transform: scale(0);
                                }
                                [type="checkbox"]:checked + label:after {
                                    opacity: 1;
                                    transform: scale(0.7);
                                }
                                /* disabled checkbox */
                                [type="checkbox"]:disabled:not(:checked) + label:before,
                                [type="checkbox"]:disabled:checked + label:before {
                                    box-shadow: none;
                                    border-color: #bbb;
                                    background-color: #ddd;
                                }
                                [type="checkbox"]:disabled:checked + label:after {
                                    color: #999;
                                }
                                [type="checkbox"]:disabled + label {
                                    color: #aaa;
                                }
                                /* accessibility */
                                /*[type="checkbox"]:checked:focus + label:before,
                                [type="checkbox"]:not(:checked):focus + label:before {
                                    border: 2px dotted blue;
                                }*/

                                /* hover style just for information */
                                label.bg:hover:before {
                                    border: 1px solid #4778d9!important;
                                }

                            </style>

                            <div style="box-shadow: 0 0 15px 0 #b4b4b445;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;" id="myTabContent" class="tab-content">
                                <div class="tab-pane fade in active" id="detail">

                                    @if($agent->about)

                                        <h5 style="font-weight: 100;color: gray;margin-bottom: 50px;text-align: center;">{{$agent->about}}</h5>

                                        @endif

                                    @if($agent->sold_prev || $agent->rentout_prev)

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 60px;">

                                        <h3 style="text-align: center;">{{__('text.Total Sold & Rentout')}} {{$agent->prev_year}}</h3>

                                        <div style="width: 100%;display: inline-block;margin-bottom: 40px;margin-top: 20px;">

                                            <div style="display: flex;flex-direction: row;width: 50%;float: left;justify-content: center;">
                                                <span style="background: rgb(255,86,68);height: 13px;width: 13px;display: block;float: left;margin-right: 9px;align-self: center;"></span>
                                                <p style="float: left;margin: 0;">{{$agent->sold_prev}} @if($agent->sold_prev > 1) {{__('text.Properties Sold')}} @else {{__('text.Property Sold')}} @endif</p>
                                            </div>

                                            <div style="display: flex;flex-direction: row;width: 50%;float: left;justify-content: center;">
                                                <span style="background: rgb(30,181,204);height: 13px;width: 13px;display: block;float: left;margin-right: 9px;align-self: center;"></span>
                                                <p style="float: left;margin: 0;">{{$agent->rentout_prev}} @if($agent->rentout_prev > 1) {{__('text.Properties Rentout')}} @else {{__('text.Property Rentout')}} @endif</p>
                                            </div>

                                        </div>

                                    <canvas id="myChart" width="400" height="400"></canvas>

                                    </div>

                                        @endif

                                        @if($agent->sold_prev_prev || $agent->rentout_prev_prev)

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="float: right;">

                                        <h3 style="text-align: center;">{{__('text.Total Sold & Rentout')}} {{$agent->prev_prev_year}}</h3>

                                        <div style="width: 100%;display: inline-block;margin-bottom: 40px;margin-top: 20px;">

                                            <div style="display: flex;flex-direction: row;width: 50%;float: left;justify-content: center;">
                                                <span style="background: rgb(255,86,68);height: 13px;width: 13px;display: block;float: left;margin-right: 9px;align-self: center;"></span>
                                                <p style="float: left;margin: 0;">{{$agent->sold_prev_prev}} @if($agent->sold_prev_prev > 1) {{__('text.Properties Sold')}} @else {{__('text.Property Sold')}} @endif</p>
                                            </div>

                                            <div style="display: flex;flex-direction: row;width: 50%;float: left;justify-content: center;">
                                                <span style="background: rgb(30,181,204);height: 13px;width: 13px;display: block;float: left;margin-right: 9px;align-self: center;"></span>
                                                <p style="float: left;margin: 0;">{{$agent->rentout_prev_prev}} @if($agent->rentout_prev_prev > 1) {{__('text.Properties Rentout')}} @else {{__('text.Property Rentout')}} @endif</p>
                                            </div>

                                        </div>

                                        <canvas id="myChart1" width="400" height="400"></canvas>
                                    </div>

                                        @endif

                                    <form action="{{ URL::to('/makelaars/send-enquiry') }}" method="POST">

                                        @csrf

                                        <input type="hidden" name="agent_id" value="{{$agent->id}}">
                                        <input type="hidden" name="agent_email" value="{{$agent->email}}">
                                        <input type="hidden" name="agent_name" value="{{$agent->name}}">

                                        <div class="form-group" style="display: inline-block;width: 100%;margin-top: 20px;">

                                            <h3 style="margin: 0px 10px;border-bottom: 1px solid #dddddd;padding-bottom: 10px;color: #3a3a3a;font-weight: 600;">{{__('text.Contact Details')}}</h3>

                                            <div class="row" style="margin: 0;margin-top: 30px;">

                                                <div class="col-md-6 col-sm-12 col-xs-12">

                                                    <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                                        <input name="selling" value="1" type="checkbox" id="selling" style="position: relative;top: 2px;display: block;height: 0px;">

                                                        <label class="bg" for="selling" style="margin: 0;margin-bottom: 5px;">

                                                            <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #4b4848;">{{__('text.Selling my property')}}</span>

                                                        </label>

                                                    </a>

                                                    <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                                        <input name="leasing" value="1" type="checkbox" id="leasing" style="position: relative;top: 2px;display: block;height: 0px;">

                                                        <label class="bg" for="leasing" style="margin: 0;margin-bottom: 5px;">

                                                            <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #4b4848;">{{__('text.Leasing my property')}}</span>

                                                        </label>

                                                    </a>

                                                    <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                                        <input name="rent_property" value="1" type="checkbox" id="rent_property" style="position: relative;top: 2px;display: block;height: 0px;">

                                                        <label class="bg" for="rent_property" style="margin: 0;margin-bottom: 5px;">

                                                            <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #4b4848;">{{__('text.Looking to rent a property')}}</span>

                                                        </label>

                                                    </a>


                                                </div>

                                                <div class="col-md-6 col-sm-12 col-xs-12">

                                                    <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                                        <input name="property_appraisal" value="1" type="checkbox" id="property_appraisal" style="position: relative;top: 2px;display: block;height: 0px;">

                                                        <label class="bg" for="property_appraisal" style="margin: 0;margin-bottom: 5px;">

                                                            <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #4b4848;">{{__('text.Property Appraisal')}}</span>

                                                        </label>

                                                    </a>

                                                    <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                                        <input name="buy_property" value="1" type="checkbox" id="buy_property" style="position: relative;top: 2px;display: block;height: 0px;">

                                                        <label class="bg" for="buy_property" style="margin: 0;margin-bottom: 5px;">

                                                            <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #4b4848;">{{__('text.Looking to buy a property')}}</span>

                                                        </label>

                                                    </a>

                                                    <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                                        <input name="another_topic" value="1" type="checkbox" id="another_topic" style="position: relative;top: 2px;display: block;height: 0px;">

                                                        <label class="bg" for="another_topic" style="margin: 0;margin-bottom: 5px;">

                                                            <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #4b4848;">{{__('text.I have a question about another topic')}}</span>

                                                        </label>

                                                    </a>

                                                </div>

                                            </div>

                                            <div style="width: 100%;position: relative;margin-top: 30px;">

                                                <i class="far fa-comment-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;margin:10px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                                <textarea style="resize: vertical;height:150px;padding-left:40px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" class="form-control" id="message-text" placeholder="{{__('text.Message')}}" name="message"></textarea>


                                            </div>

                                            <div class="row" style="margin: 0;margin-top: 30px;">

                                                <div class="row" style="margin: 0;margin-top: 25px;">

                                                    <div class="col-md-6 col-sm-12 col-xs-12" style="padding: 0px 10px;">

                                                        <div class="form-group">

                                                            <div style="width: 100%;position: relative;">

                                                                <i class="fas fa-user" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                                                <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type="text" placeholder="{{__('text.First Name')}} *" name="first_name" required="" class="form-control" id="first_name">

                                                            </div>

                                                        </div>

                                                        <div class="form-group">

                                                            <div style="width: 100%;position: relative;">

                                                                <i class="fas fa-user" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                                                <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type="text" placeholder="{{__('text.Last Name')}} *" name="last_name" required="" class="form-control" id="last_name">

                                                            </div>

                                                        </div>


                                                        <div class="form-group">

                                                            <div style="width: 100%;position: relative;">

                                                                <i class="fas fa-phone-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                                                <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type="text" placeholder="{{__('text.Mobile No')}}" name="phone" class="form-control" id="phone">

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-6 col-sm-12 col-xs-12" style="padding: 0px 10px;">

                                                        <div class="form-group">

                                                            <div style="width: 100%;position: relative;">

                                                                <i class="fas fa-at" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                                                <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type="email" placeholder="{{__('text.Email Address')}} *" name="email" required="" class="form-control" id="email">

                                                            </div>

                                                        </div>

                                                        <div class="form-group">

                                                            <div style="width: 100%;position: relative;">

                                                                <i class="fas fa-map-marker-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                                                <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type="text" placeholder="{{__('text.Postcode')}}" name="postcode" class="form-control" id="postcode">

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>


                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 25px;padding: 0px 10px;">

                                                <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                                    <input name="agree" value="1" required type="checkbox" id="agree" style="position: relative;top: 2px;display: block;height: 0px;">

                                                    <label class="bg" for="agree" style="margin: 0;margin-bottom: 5px;">

                                                        <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #807f7f;">{{__('text.I agree data')}}</span>

                                                    </label>

                                                </a>

                                                <button style="margin-top: 25px;border:0;font-size: 14px;padding: 12px 20px;" type="submit" class="btn btn-success"><i class="fas fa-envelope" style="margin-right: 5px;" aria-hidden="true"></i> {{__('text.Send Enquiry')}}</button>

                                            </div>

                                        </div>

                                    </form>


                                </div>
                                <!-- break -->
                                <div class="tab-pane fade" id="location">

                                    <div class="row" style="display:inline-block;width: 100%;margin: 0;">
                                        @if($agent->address_latitude != '' && $agent->address_longitude != '' && $agent->address != '')

                                            <input type="hidden" id="agent_map_check" value="1" >

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                                <h3>{{__('text.Location')}}</h3>

                                                <input type="hidden" name="agent_latitude" id="agent_latitude" value="{{$agent->address_latitude}}" />
                                                <input type="hidden" name="agent_longitude" id="agent_longitude" value="{{$agent->address_longitude}}" />
                                                <input type="hidden" name="agent_address" id="agent_address" value="{{$agent->address}}" />

                                                <div id="agent-map-container" style="width:100%;height:400px; ">
                                                    <div style="width: 100%; height: 100%" id="agent-map"></div>
                                                </div>

                                            </div>

                                        @else

                                            <input type="hidden" id="agent_map_check" value="0" >

                                        @endif


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:article -->

                <div class="col-md-3">

                    <div class="sidebar sidebar-right">

                        <aside class="widget widget_apus_property_contact_form" style="border:1px solid #e3e3e3;"><h2 class="widget-title" style="margin-bottom: 40px;"><span style="font-weight: 600;">{{__('text.Opening Time')}}</span></h2>

                            <table>

                                <tbody></tbody>
                                <tr>
                                    <td width="100">{{__('text.Monday')}}</td>
                                    <td>{{$agent->monday_timeFrom}} - {{$agent->monday_timeTo}} {{$agent->monday_description}}</td>
                                </tr>
                                <tr>
                                    <td width="100">{{__('text.Tuesday')}}</td>
                                    <td>{{$agent->tuesday_timeFrom}} - {{$agent->tuesday_timeTo}} {{$agent->tuesday_description}}</td>
                                </tr>
                                <tr>
                                    <td width="100">{{__('text.Wednesday')}}</td>
                                    <td>{{$agent->wednesday_timeFrom}} - {{$agent->wednesday_timeTo}} {{$agent->wednesday_description}}</td>
                                </tr>
                                <tr>
                                    <td width="100">{{__('text.Thursday')}}</td>
                                    <td>{{$agent->thursday_timeFrom}} - {{$agent->thursday_timeTo}} {{$agent->thursday_description}}</td>
                                </tr>
                                <tr>
                                    <td width="100">{{__('text.Friday')}}</td>
                                    <td>{{$agent->friday_timeFrom}} - {{$agent->friday_timeTo}} {{$agent->friday_description}}</td>
                                </tr>
                                <tr>
                                    <td width="100">{{__('text.Saturday')}}</td>
                                    <td>{{$agent->saturday_timeFrom}} - {{$agent->saturday_timeTo}} {{$agent->saturday_description}}</td>
                                </tr>
                                <tr>
                                    <td width="100">{{__('text.Sunday')}}</td>
                                    <td>{{$agent->sunday_timeFrom}} - {{$agent->sunday_timeTo}} {{$agent->sunday_description}}</td>
                                </tr>

                            </table>

                        </aside>

                    </div>

                </div>

            </div>

        </div>


    </div>
    <!-- end:content -->

    @if (Session::has('flash_message'))
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>


        <script type="text/javascript">
            $(window).load(function(){
                $('.alert-success').delay(4000).fadeOut(400)
            });


        </script>
    @endif

    <style>

        .sidebar .widget, .apus-sidebar .widget{margin:0 0 30px;padding:15px;background:#fff;border:1px solid #ebebeb;border-radius:6px;-webkit-border-radius:6px;-moz-border-radius:6px;-ms-border-radius:6px;-o-border-radius:6px}

        .widget .widget-title, .widget .widgettitle, .widget .widget-heading{font-size:22px;margin:0 0 15px}

        .agent-content-wrapper .agent-thumbnail{border: 1px solid lightgrey;width:70px;height:70px;overflow:hidden;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;display:-webkit-box;display:-webkit-flex;display:-moz-flex;display:-ms-flexbox;display:flex;align-items:center;-webkit-align-items:center}

        .agent-content-wrapper .agent-content{padding-left: 20px;width: calc(100% - 70px);}

        .agent-content-wrapper{margin-bottom: 30px;}

        .button{position: relative;color: #fff;background-color: #ff5a5f;border-color: #ff5a5f;outline: none;display: block;width: 100%;margin-bottom:0;text-align:center;vertical-align:middle;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap;letter-spacing:0;padding:12px 30px;font-size:14px;line-height:1.75;border-radius:6px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s}

        .button:hover, .button:focus{background-color: #ff272e;border-color: #ff272e;color: white;}

        #myTab li a{background-color: white;color: black;border: 1px solid lightgrey;}

        #myTab > .active > a{background-color: black;color: white;}

        @media (max-width: 480px){

            .request{text-align: center !important;}

            .request button{width: 100%;}


        }

        @media (max-width: 1200px){

            #heart{font-size: 13px !important;}

        }

        @media (min-width: 1200px){

            .sidebar-property{margin-top: 858px;}

            .sidebar .widget, .apus-sidebar .widget{padding:30px}

            .widget .widget-title, .widget .widgettitle, .widget .widget-heading
            {
                margin: 0 0 25px;
            }

            .agent-content-wrapper .agent-thumbnail{width: 90px;height: 90px;}

            .agent-content-wrapper .agent-content{width: calc(100% - 90px);}

            .contact-form-agent .btn{font-size: 16px;padding: 10px 30px;}
        }

        @media (max-width: 1200px) {

            .sidebar-property {
                margin-top: 830px;
            }
        }

        @media (max-width: 991px) {

            .sidebar-property {
                margin-top: 0px;
            }
        }

        aside{display: block;}

        .widget{margin-bottom:30px;position:relative;padding:0px;background:transparent}

        .flex-middle{display:-webkit-flex;-webkit-align-items:center;display:flex;align-items:center}

        .image-wrapper{max-height: 100%;}

        .agent-content-wrapper
        h3{margin:0;font-size:16px;font-weight:700}

        .agent-content-wrapper
        h3 a{outline: none !important;color:#484848;}

        .agent-content-wrapper
        h3 a:hover{color:#48cfad;}

        .agent-content-wrapper .phone-wrapper{margin: 2px 0;}

        .contact-form-agent textarea.contact-control{height: 170px;resize: none;}

        .slick-prev:before, .slick-next:before
        {
            font-size: 35px;
        }

        .contact-control{outline: none;display:block;width:100%;height:50px;padding:12px
        30px;font-size:14px;line-height:1.75;color:#484848;background-color:#fff;background-image:none;border:1px
        solid #d8d8d8;border-radius:6px;-webkit-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out}

        .slick-prev
        {
            left: -50px;
        }

        .slick-next
        {
            right: -35px;
        }



        .bulgy-radios {
            width: 38rem;
            background: #fff;
            padding: 0rem 0 0rem 0rem;
            border-radius: 1rem;
            text-align: center;
        }
        .bulgy-radios label {
            display: inline-block;
            position: relative;
            height: 35px;
            padding-left: 20px;
            margin-bottom: 0;
            cursor: pointer;
            font-size: 25px;
            user-select: none;
            color: #555;
            letter-spacing: 1px;
        }
        .bulgy-radios label:hover input:not(:checked) ~ .radio {
            opacity: 0.8;
        }
        .bulgy-radios .label {
            display: flex;
            align-items: center;
            padding: 10px 30px 0px 0px;
            color: #0bae72;
        }
        .bulgy-radios .label span {
            line-height: 1em;
        }
        .bulgy-radios input {
            position: absolute;
            cursor: pointer;
            height: 0;
            width: 0;
            left: -2000px;
        }
        .bulgy-radios input:checked ~ .radio {
            background-color: #0ac07d;
            transition: background 0.3s;
        }
        .bulgy-radios input:checked ~ .radio::after {
            opacity: 1;
        }
        .bulgy-radios input:checked ~ .label {
            color: #0bae72;
        }
        .bulgy-radios input:checked ~ .label span {
            animation: bulge 0.75s forwards;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(1) {
            animation-delay: 0.025s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(2) {
            animation-delay: 0.05s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(3) {
            animation-delay: 0.075s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(4) {
            animation-delay: 0.1s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(5) {
            animation-delay: 0.125s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(6) {
            animation-delay: 0.15s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(7) {
            animation-delay: 0.175s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(8) {
            animation-delay: 0.2s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(9) {
            animation-delay: 0.225s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(10) {
            animation-delay: 0.25s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(11) {
            animation-delay: 0.275s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(12) {
            animation-delay: 0.3s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(13) {
            animation-delay: 0.325s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(14) {
            animation-delay: 0.35s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(15) {
            animation-delay: 0.375s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(16) {
            animation-delay: 0.4s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(17) {
            animation-delay: 0.425s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(18) {
            animation-delay: 0.45s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(19) {
            animation-delay: 0.475s;
        }
        .radio {
            position: absolute;
            top: 0.2rem;
            left: 0;
            height: 15px;
            width: 15px;
            min-height: 0px;
            background: #c9ded6;
            border-radius: 50%;
        }
        .radio::after {
            content: '';
            position: absolute;
            opacity: 0;
            top: 4px;
            left: 4px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #fff;
        }
        @keyframes bulge {
            50% {
                transform: rotate(4deg);
                font-size: 1.5em;
                font-weight: bold;
            }
            100% {
                transform: rotate(0);
                font-size: 1em;
                font-weight: bold;
            }
        }


        .modal-dialog-centered
        {
            display: flex;
            display: -webkit-box;
            display: -ms-flexbox;
            -webkit-box-align:center;
            -ms-flex-align: center;
            align-items: center;
            min-height: calc(100% - (.5rem * 2));
        }

        @media (min-width: 768px)
        {
            .modal-dialog
            {
                width: 500px;
            }
        }

        @media (min-width: 576px)
        {
            .modal-dialog-centered{
                min-height: calc(100% - (1.75rem * 2));
            }
        }

        .dropdown-menu{ position:absolute;top:100%;left:0;z-index:1000;display:none;
            float:left;min-width:160px;padding:5px 0;margin:2px 0 0;font-size:14px;
            text-align:left;list-style:none;background-color:#48cfad;-webkit-background-clip:padding-box;
            background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,.15);
            border-radius:4px;-webkit-box-shadow:0 6px 12px rgba(0,0,0,.175);
            box-shadow:0 6px 12px rgba(0,0,0,.175) }


        .carousel-inner, #player-window{
            height: 180px;
        }

        @media (min-width: 700px)
        {

            .carousel-inner, #player-window
            {
                height: 500px;
            }

        }

        #map-second-row
        {
            height: 385px;
        }

        @media (min-width: 700px)
        {

            #map-box
            {
                height: 500px;
            }

            #map-first-row
            {
                height: 20%;
            }

            #map-second-row
            {
                height: 80%;
            }

        }

        .carousel-inner > .item
        {
            height: 100%;
        }

        #slider-property .carousel-inner .item img
        {
            height: 100%;
        }


        #map {
            height: 100%;
            background-color: grey;
        }

        .box {
            width: 150px;
            height: 75px;
            background-color: transparent;
            border-right: 1px solid #e3e3e3;
        }
        .box a {
            color: #461e52;
            display: block;
            width: 100%;
            height: 100%;
            font-size: 16px;
            font-weight: 700;
            padding: 10% 0px 0 0px;
            text-align: center;
            transition: none;
            line-height: 1;
            font-family: 'Open Sans Condensed', Arial, Verdana, sans-serif;
            outline: none;
        }
        .box:hover{
            background-color: #461e52;
            cursor: pointer;
        }

        .background-active{
            background-color: #461e52;
        }

        .background-active a{
            color:#fff;
            text-decoration:none;
        }


        .box:hover a{
            color:#fff;
            text-decoration:none;
        }
        .mission-next-arrow {
            position: absolute;
            background: url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/nextarrow2.png) no-repeat center;
            background-size: contain;
            top: 50%;
            transform: translateY(-50%);
            right: 10%;
            height: 17px;
            width: 10px;
            border:none;
            outline: none;
        }
        .mission-next-arrow:hover {
            cursor: pointer;
        }
        .mission-prev-arrow {
            background: url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/prevarrow2.png) no-repeat center;
            background-size: contain;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10%;
            height: 17px;
            width: 10px;
            border:none;
            outline: none;
        }
        .mission-prev-arrow:hover {
            cursor: pointer;
        }
        .box a.more-links {
            color: #fff;
            padding: 70px 110px 0 20px;
            background: #a89269 url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/rightarrow.png) no-repeat 155px 170px;
        }

        .slick-list
        {
            width: 75%;
            margin: auto;
        }

        .similarProperties .slick-list
        {
            padding-top: 25px !important;
        }

        @media (max-width: 995px)
        {
            .similarProperties .slick-list
            {
                width: 100%;
            }

        }

        .slick-slide
        {
            outline: none;
        }

        #myTab li{display: block;}

        @media (min-width: 768px)
        {
            #myTab li{display: table-cell;}
        }

        @media (max-width: 479px){
            .box{
                height: 65px;
            }

            .box a{
                font-size: 12px;
                padding: 23% 0px 0 0px;
            }

            .box a i{
                font-size: 13px !important;
            }

            #panel{
                top: 20% !important;
            }
        }

        @media (min-width: 768px){
            canvas{

                width:250px !important;
                height:250px !important;
                margin: auto;

            }
        }


    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>


    <script>

        $( document ).ready(function() {

            Chart.Legend.prototype.afterFit = function() {
                this.height = this.height + 40;
            };

            if(document.getElementById('myChart'))
            {
                var ctx = document.getElementById('myChart').getContext('2d');

                var myDoughnutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["<?php echo $agent->sold_prev ?> Properties Sold","<?php echo $agent->rentout_prev ?> Properties Rentout"],
                        datasets: [{
                            data: [<?php echo $agent->sold_prev ?>,<?php echo $agent->rentout_prev ?>],
                            backgroundColor: [
                                'rgb(255,86,68)',
                                'rgb(30,181,204)',

                            ],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    },

                });
            }

            if(document.getElementById('myChart1'))
            {
                var ctx = document.getElementById('myChart1').getContext('2d');

                var myDoughnutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["<?php echo $agent->sold_prev_prev ?> Properties Sold","<?php echo $agent->rentout_prev_prev ?> Properties Rentout"],
                        datasets: [{
                            data: [<?php echo $agent->sold_prev_prev ?>,<?php echo $agent->rentout_prev_prev ?>],
                            backgroundColor: [
                                'rgb(255,86,68)',
                                'rgb(30,181,204)',

                            ],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    },

                });
            }


            let pos;
            let map;
            let bounds;
            let infoWindow;
            let currentInfoWindow;
            let service;
            let infoPane;
            var markers = new Array();
            var type = $('#type').val();




            let pos1;
            let map1;
            let bounds1;
            let infoWindow1;
            let currentInfoWindow1;
            let service1;
            let infoPane1;


            let pos2;
            let bounds2;
            let infoWindow2;
            let currentInfoWindow2;
            let service2;
            let infoPane2;


            function agent_initMap() {
                // Initialize variables
                bounds1 = new google.maps.LatLngBounds();
                infoWindow1 = new google.maps.InfoWindow;
                currentInfoWindow1 = infoWindow1;
                /* TODO: Step 4A3: Add a generic sidebar */
                agent_handleLocationError(false, infoWindow1,type);
            }



            var agent_map_check = $('#agent_map_check').val();

                    if(agent_map_check == 1) {
                        agent_initMap();
                    }


            function agent_handleLocationError(browserHasGeolocation1, infoWindow1, type1) {


                var lat1 = parseFloat(document.getElementById('agent_latitude').value);
                var lng1 = parseFloat(document.getElementById('agent_longitude').value);

                pos1 = { lat: lat1, lng: lng1 };

                map1 = new google.maps.Map(document.getElementById('agent-map'), {
                    center: pos1,
                    zoom: 15
                });

                var base_url1 = window.location.origin;

                var home_icon1 = base_url1 + '/assets/img/home_pin.png';

                const marker1 = new google.maps.Marker({
                    map: map1,
                    position: {lat: lat1, lng: lng1},
                    draggable: false,
                    icon: {url:home_icon1, scaledSize: new google.maps.Size(40, 45)}
                });


                marker1.addListener('click', function() {

                    var location1 = $('#agent_address').val();

                    infoWindow1.setContent(location1);
                    infoWindow1.open(map1, marker1);
                    map1.setZoom(15);
                    map1.setCenter(marker1.getPosition());

                });

                // Display an InfoWindow at the map center
                infoWindow1.setPosition(pos1);
                /*infoWindow.setContent(browserHasGeolocation ?
                    'Geolocation permissions denied. Using default location.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);*/
                currentInfoWindow1 = infoWindow1;

                // Call Places Nearby Search on the default location
                // getNearbyPlaces(pos,type);
            }



        });

    </script>

@endsection
