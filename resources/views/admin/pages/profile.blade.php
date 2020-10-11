@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> {{ Auth::user()->name }}</h2>
            <a href="{{ URL::to('admin/dashboard') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> @if(Auth::User()->usertype != "Admin") {{__('text.Back')}} @else Back @endif</a>

        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account</a>
                </li>
                <li role="presentation">
                    <a href="#ac_password" aria-controls="ac_password" role="tab" data-toggle="tab">@if(Auth::User()->usertype != "Admin") {{__('text.Password')}} @else Password @endif</a>
                </li>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content tab-content-default">
                <div role="tabpanel" class="tab-pane active" id="account">
                    {!! Form::open(array('url' => 'admin/profile','class'=>'form-horizontal padding-15','name'=>'account_form','id'=>'account_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                    <div class="form-group">
                        <label for="avatar" class="col-sm-3 control-label">Logo</label>
                        <div class="col-sm-9">
                            <div class="media">
                                <div class="media-left">
                                    @if(Auth::user()->image_icon)

                                        <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="80" alt="person">
                                    @endif

                                </div>
                                <div class="media-body media-middle">
                                    <input type="file" name="user_icon" class="filestyle">
                                    {{--<small class="text-muted bold">Size 80x80px</small>--}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.Name')}} @else Name @endif</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.Mobile No')}} @else Phone @endif</label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Fax</label>
                        <div class="col-sm-9">
                            <input type="text" name="fax" value="{{ Auth::user()->fax }}" class="form-control" value="">
                        </div>
                    </div>

                    @if(Auth::user()->usertype != 'Admin' && Auth::user()->usertype != 'Users')

                        <div class="form-group herefor" style="display: flex;margin: 25px 0px;">
                            <label class="col-sm-3 col-xs-12 control-label" style="padding: 0;padding-top: 30px;">@if(Auth::User()->usertype != "Admin") {{__('text.People can come to us for')}} @else People can come to us for @endif</label>
                            <div class="col-sm-9 col-xs-12">
                                <ul class="property-radios" style="padding: 0;margin-top: 30px;">

                                    <li class="pt @if(in_array(1, $services_ids)) active1 @endif" style="width: 145px;">

                                                <div class="type-holder-main">

                                                    <label style="padding: 13px;">

                                                        <input class="services" @if(in_array(1, $services_ids)) checked @endif type="checkbox" name="services[]" value="1">

                                                        <span style="padding-top: 0;"><img style="display: block;width: 50px;margin: auto;margin-bottom: 10px;" src="{{ URL::asset('assets/img/broker.png') }}" />@if(Auth::User()->usertype != "Admin") {{__('text.I am looking for a sales broker')}} @else I am looking for a sales broker @endif</span>

                                                    </label>

                                                </div>
                                            </li>

                                    <li class="pt @if(in_array(2, $services_ids)) active1 @endif" style="width: 145px;">

                                        <div class="type-holder-main">

                                            <label style="padding: 13px;">

                                                <input class="services" @if(in_array(2, $services_ids)) checked @endif type="checkbox" name="services[]" value="2">

                                                <span style="padding-top: 0;"><img style="display: block;width: 50px;margin: auto;margin-bottom: 10px;" src="{{ URL::asset('assets/img/agent.png') }}" />@if(Auth::User()->usertype != "Admin") {{__('text.I am looking for a rental agent')}} @else I am looking for a rental agent @endif</span>

                                            </label>

                                        </div>
                                    </li>

                                    <li class="pt @if(in_array(3, $services_ids)) active1 @endif" style="width: 145px;">

                                        <div class="type-holder-main">

                                            <label style="padding: 13px;">

                                                <input class="services" @if(in_array(3, $services_ids)) checked @endif type="checkbox" name="services[]" value="3">

                                                <span style="padding-top: 0;"><img style="display: block;width: 50px;margin: auto;margin-bottom: 10px;" src="{{ URL::asset('assets/img/hire_broker.png') }}" />@if(Auth::User()->usertype != "Admin") {{__('text.I am looking for a hiring broker')}} @else I am looking for a hiring broker @endif</span>

                                            </label>

                                        </div>
                                    </li>

                                    <li class="pt @if(in_array(4, $services_ids)) active1 @endif" style="width: 145px;">

                                        <div class="type-holder-main">

                                            <label style="padding: 13px;">

                                                <input class="services" @if(in_array(4, $services_ids)) checked @endif type="checkbox" name="services[]" value="4">

                                                <span style="padding-top: 0;"><img style="display: block;width: 50px;margin: auto;margin-bottom: 10px;" src="{{ URL::asset('assets/img/purchase_broker.png') }}" />@if(Auth::User()->usertype != "Admin") {{__('text.I am looking for a purchase broker')}} @else I am looking for a purchase broker @endif</span>

                                            </label>

                                        </div>
                                    </li>

                                    <li class="pt @if(in_array(5, $services_ids)) active1 @endif" style="width: 145px;">

                                        <div class="type-holder-main">

                                            <label style="padding: 13px;">

                                                <input class="services" @if(in_array(5, $services_ids)) checked @endif type="checkbox" name="services[]" value="5">

                                                <span style="padding-top: 0;"><img style="display: block;width: 50px;margin: auto;margin-bottom: 10px;" src="{{ URL::asset('assets/img/calculator1.png') }}" />@if(Auth::User()->usertype != "Admin") {{__('text.Appraise House')}} @else Appraise House @endif</span>

                                            </label>

                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    <div class="form-group herefor" style="display: flex;margin: 10px 0px;text-align: center;padding-top: 40px;border-top: 1px solid #dddddd;">
                            <label class="col-sm-3 col-xs-12 control-label" style="align-self: center;padding: 0;">@if(Auth::User()->usertype != "Admin") {{__('text.I am here for')}} @else I am here for (Optional) @endif <br> <small style="color: gray;display: block;margin-top: 5px;font-size: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Double click to unselect')}} @else Double click to unselect @endif</small></label>
                        <div class="col-sm-9 col-xs-12" style="margin: 20px 0px;">
                                <label class="col-lg-4 col-md-6 col-sm-6 col-xs-12 herefor-radio" style="margin: 20px 0px;padding: 0;">
                                    <input type="radio" name="herefor" value="1" <?=Auth::user()->herefor==1?'checked':'' ?>>
                                    <img class="herefor-img" style="width: 90%;height: 70px;" height="100px"  src="{{ URL::asset('upload/herefor1.png')}}" >
                                </label>

                                <label class="col-lg-4 col-md-6 col-sm-6 col-xs-12 herefor-radio" style="margin: 20px 0px;padding: 0;">
                                    <input type="radio" name="herefor" value="2" <?=Auth::user()->herefor==2?'checked':'' ?>>
                                    <img class="herefor-img" style="width: 20%;height: 70px;" height="100px" src="{{ URL::asset('upload/herefor2.png') }}">
                                </label>
                            </div>
                        </div>

                        <div class="form-group" style="margin: 30px 0px;padding-top: 40px;border-top: 1px solid #dddddd;">
                            <label class="col-sm-3 col-xs-12 control-label open-label" style="padding: 0;margin-bottom: 30px;">@if(Auth::User()->usertype != "Admin") {{__('text.Opening Hours')}} @else Opening Hours @endif</label>

                            <div class="col-sm-9 col-xs-12">


                                <div style="display: inline-block;width: 100%;margin-bottom: 30px;position: relative;">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Monday')}} @else Monday @endif</label>
                                        <input type="text" name="monday_timeFrom" id="monday_timeFrom" value="{{Auth::user()->monday_timeFrom}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.of')}}" @else placeholder="Time From" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 monday_time" style="text-transform: capitalize;">
                                        <input type="text" name="monday_timeTo" id="monday_timeTo" value="{{Auth::user()->monday_timeTo}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.to')}}" @else placeholder="Time To" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 r-fl monday_time1" style="text-transform: capitalize;float: right;">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ad-info">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Additional Info Heading')}} @else Additional Info @endif</label>
                                        <input type="text" name="monday_description" value="{{Auth::user()->monday_description}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Additional Info')}}" @else placeholder="Additional Info" @endif class="form-control1 col-lg-12 col-md-12 col-sm-12 col-xs-12 r-t">
                                    </div>

                                </div>

                                <div style="display: inline-block;width: 100%;margin-bottom: 30px;position: relative;">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Tuesday')}} @else Tuesday @endif</label>
                                        <input type="text" name="tuesday_timeFrom" id="tuesday_timeFrom" value="{{Auth::user()->tuesday_timeFrom}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.of')}}" @else placeholder="Time From" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 tuesday_time" style="text-transform: capitalize;">
                                        <input type="text" name="tuesday_timeTo" id="tuesday_timeTo" value="{{Auth::user()->tuesday_timeTo}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.to')}}" @else placeholder="Time To" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 r-fl tuesday_time1" style="text-transform: capitalize;float: right;">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ad-info">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Additional Info Heading')}} @else Additional Info @endif</label>
                                        <input type="text" name="tuesday_description" value="{{Auth::user()->tuesday_description}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Additional Info')}}" @else placeholder="Additional Info" @endif class="form-control1 col-lg-12 col-md-12 col-sm-12 col-xs-12 r-t">
                                    </div>

                                </div>

                                <div style="display: inline-block;width: 100%;margin-bottom: 30px;position: relative;">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Wednesday')}} @else Wednesday @endif</label>
                                        <input type="text" name="wednesday_timeFrom" id="wednesday_timeFrom" value="{{Auth::user()->wednesday_timeFrom}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.of')}}" @else placeholder="Time From" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 wednesday_time" style="text-transform: capitalize;">
                                        <input type="text" name="wednesday_timeTo" id="wednesday_timeTo" value="{{Auth::user()->wednesday_timeTo}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.to')}}" @else placeholder="Time To" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 r-fl wednesday_time1" style="text-transform: capitalize;float: right;">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ad-info">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Additional Info Heading')}} @else Additional Info @endif</label>
                                        <input type="text" name="wednesday_description" value="{{Auth::user()->wednesday_description}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Additional Info')}}" @else placeholder="Additional Info" @endif class="form-control1 col-lg-12 col-md-12 col-sm-12 col-xs-12 r-t">
                                    </div>

                                </div>

                                <div style="display: inline-block;width: 100%;margin-bottom: 30px;position: relative;">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Thursday')}} @else Thursday @endif</label>
                                        <input type="text" name="thursday_timeFrom" id="thursday_timeFrom" value="{{Auth::user()->thursday_timeFrom}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.of')}}" @else placeholder="Time From" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 thursday_time" style="text-transform: capitalize;">
                                        <input type="text" name="thursday_timeTo" id="thursday_timeTo" value="{{Auth::user()->thursday_timeTo}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.to')}}" @else placeholder="Time To" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 r-fl thursday_time1" style="text-transform: capitalize;float: right;">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ad-info">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Additional Info Heading')}} @else Additional Info @endif</label>
                                        <input type="text" name="thursday_description" value="{{Auth::user()->thursday_description}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Additional Info')}}" @else placeholder="Additional Info" @endif class="form-control1 col-lg-12 col-md-12 col-sm-12 col-xs-12 r-t">
                                    </div>

                                </div>

                                <div style="display: inline-block;width: 100%;margin-bottom: 30px;position: relative;">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Friday')}} @else Friday @endif</label>
                                        <input type="text" name="friday_timeFrom" id="friday_timeFrom" value="{{Auth::user()->friday_timeFrom}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.of')}}" @else placeholder="Time From" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 friday_time" style="text-transform: capitalize;">
                                        <input type="text" name="friday_timeTo" id="friday_timeTo" value="{{Auth::user()->friday_timeTo}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.to')}}" @else placeholder="Time To" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 r-fl friday_time1" style="text-transform: capitalize;float: right;">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ad-info">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Additional Info Heading')}} @else Additional Info @endif</label>
                                        <input type="text" name="friday_description" value="{{Auth::user()->friday_description}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Additional Info')}}" @else placeholder="Additional Info" @endif class="form-control1 col-lg-12 col-md-12 col-sm-12 col-xs-12 r-t">
                                    </div>

                                </div>

                                <div style="display: inline-block;width: 100%;margin-bottom: 30px;position: relative;">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Saturday')}} @else Saturday @endif</label>
                                        <input type="text" name="saturday_timeFrom" id="saturday_timeFrom" value="{{Auth::user()->saturday_timeFrom}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.of')}}" @else placeholder="Time From" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 saturday_time" style="text-transform: capitalize;">
                                        <input type="text" name="saturday_timeTo" id="saturday_timeTo" value="{{Auth::user()->saturday_timeTo}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.to')}}" @else placeholder="Time To" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 r-fl saturday_time1" style="text-transform: capitalize;float: right;">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ad-info">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Additional Info Heading')}} @else Additional Info @endif</label>
                                        <input type="text" name="saturday_description" value="{{Auth::user()->saturday_description}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Additional Info')}}" @else placeholder="Additional Info" @endif class="form-control1 col-lg-12 col-md-12 col-sm-12 col-xs-12 r-t">
                                    </div>

                                </div>

                                <div style="display: inline-block;width: 100%;margin-bottom: 30px;position: relative;">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Sunday')}} @else Sunday @endif</label>
                                        <input type="text" name="sunday_timeFrom" id="sunday_timeFrom" value="{{Auth::user()->sunday_timeFrom}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.of')}}" @else placeholder="Time From" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 sunday_time" style="text-transform: capitalize;">
                                        <input type="text" name="sunday_timeTo" id="sunday_timeTo" value="{{Auth::user()->sunday_timeTo}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.to')}}" @else placeholder="Time To" @endif class="form-control1 col-lg-5 col-md-5 col-sm-5 col-xs-5 r-fl sunday_time1" style="text-transform: capitalize;float: right;">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ad-info">
                                        <label style="width: 100%;margin-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Additional Info Heading')}} @else Additional Info @endif</label>
                                        <input type="text" name="sunday_description" value="{{Auth::user()->sunday_description}}" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Additional Info')}}" @else placeholder="Additional Info" @endif class="form-control1 col-lg-12 col-md-12 col-sm-12 col-xs-12 r-t">
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="form-group" style="padding-top: 40px;border-top: 1px solid #dddddd;">

                            <label class="col-sm-3 col-xs-12 control-label open-label" style="padding: 0;"></label>

                            <input type="hidden" value="{{date("Y",strtotime("-1 year"))}}" name="prev_year">
                            <input type="hidden" value="{{date("Y",strtotime("-2 year"))}}" name="prev_prev_year">

                            <div class="col-sm-9 col-xs-12" style="padding: 0px;">

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" style="padding: 0;margin-bottom: 30px;">

                                    <label style="width: 100%;margin-bottom: 25px;font-size: 23px;">@if(Auth::User()->usertype != "Admin") {{__('text.Sales Results')}} @else Sales Results @endif</label>

                                    <div style="display:inline-block;width: 100%;margin-bottom: 20px;min-height: 70px;">
                                    <span class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="float: left;padding: 0;padding-top: 5px;padding-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Total Sold')}} @else Total Sold @endif {{date("Y",strtotime("-1 year"))}}: </span>
                                    <input style="float: right;" type="number" name="sold_prev" placeholder="Enter Number" class="col-lg-7 col-md-12 col-sm-12 col-xs-12 form-control1" @if(Auth::user()->prev_year != date("Y",strtotime("-1 year"))) value="" @else value="{{Auth::user()->sold_prev}}" @endif>
                                    </div>

                                    <div style="display:inline-block;width: 100%;margin-bottom: 20px;min-height: 70px;">
                                        <span class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="float: left;padding: 0;padding-top: 5px;padding-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Total Sold')}} @else Total Sold @endif {{date("Y",strtotime("-2 year"))}}: </span>
                                        <input style="float: right;" type="number" name="sold_prev_prev" placeholder="Enter Number" class="col-lg-7 col-md-12 col-sm-12 col-xs-12 form-control1" @if(Auth::user()->prev_prev_year != date("Y",strtotime("-2 year"))) value="" @else value="{{Auth::user()->sold_prev_prev}}" @endif>
                                    </div>

                                </div>


                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" style="padding: 0;float: right;">

                                    <label style="width: 100%;margin-bottom: 25px;font-size: 23px;">Rental Results</label>

                                    <div style="display:inline-block;width: 100%;margin-bottom: 20px;min-height: 70px;">
                                        <span class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="float: left;padding: 0;padding-top: 5px;padding-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Total Rentout')}} @else Total Rentout @endif {{date("Y",strtotime("-1 year"))}}: </span>
                                        <input style="float: right;" type="number" name="rentout_prev" placeholder="Enter Number" class="col-lg-7 col-md-12 col-sm-12 col-xs-12 form-control1" @if(Auth::user()->prev_year != date("Y",strtotime("-1 year"))) value="" @else value="{{Auth::user()->rentout_prev}}" @endif>
                                    </div>

                                    <div style="display:inline-block;width: 100%;margin-bottom: 20px;min-height: 70px;">
                                        <span class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="float: left;padding: 0;padding-top: 5px;padding-bottom: 10px;">@if(Auth::User()->usertype != "Admin") {{__('text.Total Rentout')}} @else Total Rentout @endif {{date("Y",strtotime("-2 year"))}}: </span>
                                        <input style="float: right;" type="number" name="rentout_prev_prev" placeholder="Enter Number" class="col-lg-7 col-md-12 col-sm-12 col-xs-12 form-control1" @if(Auth::user()->prev_prev_year != date("Y",strtotime("-2 year"))) value="" @else value="{{Auth::user()->rentout_prev_prev}}" @endif>
                                    </div>

                                </div>


                            </div>

                        </div>


                    <style>

                        .form-control1 {
                            display: block;
                            height: 36px;
                            padding: 6px 12px;
                            font-size: 16px;
                            line-height: 1.42857143;
                            color: #555555;
                            background-color: #ffffff;
                            background-image: none;
                            border: 1px solid #dddddd;
                            border-radius: 4px;
                            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                            -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                            -webkit-transition: all border-color ease-in-out .15s, box-shadow ease-in-out .15s ease-out;
                            -moz-transition: all border-color ease-in-out .15s, box-shadow ease-in-out .15s ease-out;
                            -o-transition: all border-color ease-in-out .15s, box-shadow ease-in-out .15s ease-out;
                            transition: all border-color ease-in-out .15s, box-shadow ease-in-out .15s ease-out;
                        }
                        .form-control1:focus {
                            border-color: #448aff;
                            outline: 0;
                            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(68, 138, 255, 0.6);
                            -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(68, 138, 255, 0.6);
                            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(68, 138, 255, 0.6);
                        }
                        .form-control1::-moz-placeholder {
                            color: #999999;
                            opacity: 1;
                        }
                        .form-control1:-ms-input-placeholder {
                            color: #999999;
                        }
                        .form-control1::-webkit-input-placeholder {
                            color: #999999;
                        }
                        .form-control1[disabled],
                        .form-control1[readonly],
                        fieldset[disabled] .form-control1 {
                            background-color: #eeeeee;
                            opacity: 1;
                        }
                        .form-control1[disabled],
                        fieldset[disabled] .form-control1 {
                            cursor: not-allowed;
                        }
                        textarea.form-control1 {
                            height: auto;
                        }


                        ul.property-radios li{
                            display: inline-block; margin: 5px 20px 5px 0px; padding: 0; vertical-align: top;
                        }

                        li{ list-style: none; }

                        .type-holder-main{ position: relative; }

                        ul.property-radios li input{ display: none; }

                        ul.property-radios li label {  width: 100%;min-height: 125px;-webkit-transition: all .5s ease-in-out; transition: all .5s ease-in-out ;overflow: hidden; padding: 20px; cursor: pointer; border: solid 1px #dddddd; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; background-color: #fff;text-align: center; }

                        .user-holder.create-property-holder ul.property-radios li label { display: block; min-height: 55px; }


                        ul.property-radios li label span { padding-top: 15px;font-size: 13px; font-weight: 700; line-height: 19px; display: block; width: 100%; text-align: center; color: #5a2e8a !important; }


                        li.active1 > div > label, label:hover{

                            border-color: #5a2e8a !important;

                        }

                        @media (max-width: 991px)
                        {
                            .herefor
                            {
                                text-align: center;
                            }

                            ul.property-radios li
                            {
                                margin: 10px;
                            }
                        }

                        @media (max-width: 768px)
                        {

                            .herefor label, .open-label{
                                font-size: 22px;
                                text-align: center;
                            }

                            .r-fl
                            {
                                float: right;
                            }

                            .ad-info
                            {
                                padding: 0;
                                margin-top: 20px;
                            }

                            .r-t
                            {
                                height: 65px;
                            }

                            .herefor
                            {
                                display: block !important;
                            }

                            .herefor-img
                            {
                                width: 40% !important;
                            }
                        }


                        @media (max-width: 460px)
                        {
                            .herefor-img
                            {
                                width: 60% !important;
                            }
                        }

                        .validate-error
                        {
                            border-color: red;
                        }

                    </style>

                    <script>

                        $(document).on('dblclick','.herefor-radio',function(){

                            if($(this).children('input').is(':checked')){

                                $(this).children('input').prop('checked', false);
                            }
                        });

                        $('#monday_timeFrom').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#monday_timeTo').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#tuesday_timeFrom').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#tuesday_timeTo').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#wednesday_timeFrom').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#wednesday_timeTo').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#thursday_timeFrom').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#thursday_timeTo').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#friday_timeFrom').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#friday_timeTo').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#saturday_timeFrom').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#saturday_timeTo').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#sunday_timeFrom').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#sunday_timeTo').datetimepicker({
                            format: 'HH:mm',
                        });

                        $('#monday_timeFrom').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#monday_timeTo').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#tuesday_timeFrom').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#tuesday_timeTo').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#wednesday_timeFrom').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#wednesday_timeTo').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#thursday_timeFrom').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#thursday_timeTo').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#friday_timeFrom').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#friday_timeTo').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#saturday_timeFrom').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#saturday_timeTo').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#sunday_timeFrom').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });

                        $('#sunday_timeTo').on('dp.change', function(e){
                            $(this).removeClass('validate-error');
                        });



                        $('input[class=services]').change(function(){

                            if($(this).is(":checked"))
                            {
                                $(this).parent().closest('li').addClass('active1');

                            }
                            else
                            {
                                $(this).parent().closest('li').removeClass('active1');
                            }

                        });


                    </script>

                    <div class="form-group" style="border-top: 1px solid #dddddd;padding-top: 50px;">
                        <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.Address')}} @else Address @endif</label>
                        <div class="col-sm-9">

                            <input type="text" id="address-input" placeholder="Enter Address" name="address" @if(Auth::user()->address) value="{{Auth::user()->address}}" @endif   class="form-control map-input">
                            <input type="hidden" name="address_latitude" id="address-latitude" @if(Auth::user()->address_latitude) value="{{Auth::user()->address_latitude}}" @else value="52.3666969" @endif />
                            <input type="hidden" name="address_longitude" id="address-longitude" @if(Auth::user()->address_longitude) value="{{Auth::user()->address_longitude}}" @else value="4.8945398"  @endif  />

                        </div>

                    </div>


                    <div class="form-group">

                        <div class="col-sm-9 col-xs-12" style="float: right">

                            <div id="address-map-container" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>

                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.City')}} @else City @endif</label>
                        <div class="col-sm-9">

                            <input type="text" value="{{Auth::user()->city}}" readonly id="city_name" name="city" class="form-control" >

                        </div>
                    </div>

                    @endif

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.About')}} @else About @endif</label>
                        <div class="col-sm-9">

                            <textarea name="about" cols="50" rows="5" class="form-control">{{ Auth::user()->about }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Facebook</label>
                        <div class="col-sm-9">
                            <input type="text" name="facebook" value="{{ Auth::user()->facebook }}" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Twitter</label>
                        <div class="col-sm-9">
                            <input type="text" name="twitter" value="{{ Auth::user()->twitter }}" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Google Plus</label>
                        <div class="col-sm-9">
                            <input type="text" name="gplus" value="{{ Auth::user()->gplus }}" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Linkedin</label>
                        <div class="col-sm-9">
                            <input type="text" name="linkedin" value="{{ Auth::user()->linkedin }}" class="form-control" value="">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            @if(Auth::user()->usertype != 'Admin' && Auth::user()->usertype != 'Users')

                                <button type="button" class="btn btn-primary custom-save">{{__('text.Save')}} <i class="md md-lock-open"></i></button>
                            @else

                                <button type="submit" class="btn btn-primary">@if(Auth::User()->usertype != "Admin") {{__('text.Save')}} @else Save Changes @endif <i class="md md-lock-open"></i></button>

                            @endif
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
                <div role="tabpanel" class="tab-pane" id="ac_password">

                    {!! Form::open(array('url' => 'admin/profile_pass','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.New Password')}} @else New Password @endif</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" value="" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.Confirm Password1')}} @else Confirm Password @endif</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_confirmation" value="" class="form-control" value="">
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                                <button type="submit" class="btn btn-primary">@if(Auth::User()->usertype != "Admin") {{__('text.Save')}} @else Save Changes @endif <i class="md md-lock-open"></i></button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <script>

        $(document).ready(function() {


            $('.custom-save').click(function(){

                var validate = 0;

                if( $('.monday_time').val() || $('.monday_time1').val() )
                {
                    if($('.monday_time').val() == '')
                    {
                        $('.monday_time').addClass('validate-error');
                        validate = 1;
                    }
                    if($('.monday_time1').val() == '')
                    {
                        $('.monday_time1').addClass('validate-error');
                        validate = 1;
                    }

                }

                if( $('.tuesday_time').val() || $('.tuesday_time1').val() )
                {
                    if($('.tuesday_time').val() == '')
                    {
                        $('.tuesday_time').addClass('validate-error');
                        validate = 1;
                    }
                    if($('.tuesday_time1').val() == '')
                    {
                        $('.tuesday_time1').addClass('validate-error');
                        validate = 1;
                    }

                }

                if( $('.wednesday_time').val() || $('.wednesday_time1').val() )
                {
                    if($('.wednesday_time').val() == '')
                    {
                        $('.wednesday_time').addClass('validate-error');
                        validate = 1;
                    }
                    if($('.wednesday_time1').val() == '')
                    {
                        $('.wednesday_time1').addClass('validate-error');
                        validate = 1;
                    }

                }

                if( $('.thursday_time').val() || $('.thursday_time1').val() )
                {
                    if($('.thursday_time').val() == '')
                    {
                        $('.thursday_time').addClass('validate-error');
                        validate = 1;
                    }
                    if($('.thursday_time1').val() == '')
                    {
                        $('.monday_time1').addClass('validate-error');
                        validate = 1;
                    }

                }

                if( $('.friday_time').val() || $('.friday_time1').val() )
                {
                    if($('.friday_time').val() == '')
                    {
                        $('.friday_time').addClass('validate-error');
                        validate = 1;
                    }
                    if($('.friday_time1').val() == '')
                    {
                        $('.friday_time1').addClass('validate-error');
                        validate = 1;
                    }

                }

                if( $('.saturday_time').val() || $('.saturday_time1').val() )
                {
                    if($('.saturday_time').val() == '')
                    {
                        $('.saturday_time').addClass('validate-error');
                        validate = 1;
                    }
                    if($('.saturday_time1').val() == '')
                    {
                        $('.saturday_time1').addClass('validate-error');
                        validate = 1;
                    }

                }

                if( $('.sunday_time').val() || $('.sunday_time1').val() )
                {
                    if($('.sunday_time').val() == '')
                    {
                        $('.sunday_time').addClass('validate-error');
                        validate = 1;
                    }
                    if($('.sunday_time1').val() == '')
                    {
                        $('.sunday_time1').addClass('validate-error');
                        validate = 1;
                    }

                }

                if(!validate)
                {
                    $('#account_form').submit();
                }


            });

            $(window).load(function(){
                initialize();
            });


            function initialize() {

                $('form').on('keyup keypress', function(e) {
                    var keyCode = e.keyCode || e.which;
                    if (keyCode === 13) {
                        e.preventDefault();
                        return false;
                    }
                });
                const locationInputs = document.getElementsByClassName("map-input");

                var options = {

                    componentRestrictions: {country: "nl"}

                };

                const autocompletes = [];
                const geocoder = new google.maps.Geocoder;
                for (let i = 0; i < locationInputs.length; i++) {

                    const input = locationInputs[i];
                    const fieldKey = input.id.replace("-input", "");
                    const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                    const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || 52.3666969;
                    const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 4.8945398;

                    const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                        center: {lat: latitude, lng: longitude},
                        zoom: 13
                    });

                    var base_url = window.location.origin;

                    var home_icon = base_url + '/assets/img/home_pin.png';


                    const marker = new google.maps.Marker({
                        map: map,
                        position: {lat: latitude, lng: longitude},
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        icon: {url:home_icon, scaledSize: new google.maps.Size(45, 50)}
                    });

                    google.maps.event.addListener(marker, 'dragend', function(marker) {
                        var latLng = marker.latLng;
                        document.getElementById('address-latitude').value = latLng.lat();
                        document.getElementById('address-longitude').value = latLng.lng();

                        geocoder.geocode({'latLng': this.getPosition()}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {

                                    var city_check = 0;

                                    $('#address-input').val(results[0].formatted_address);

                                    for(var a=0; a < results[0]['address_components'].length; a++)
                                    {

                                        if(results[0]['address_components'][a]['types'][0] == 'locality')
                                        {

                                            $('#city_name').val(results[0]['address_components'][a]['long_name']);

                                            city_check = 1;

                                        }

                                    }

                                    if(city_check == 0)
                                    {

                                        for(var b=0; b < results[0]['address_components'].length; b++)
                                        {

                                            if(results[0]['address_components'][b]['types'][0] == 'administrative_area_level_2')
                                            {


                                                $('#city_name').val(results[0]['address_components'][b]['long_name']);

                                                city_check = 1;

                                            }

                                        }

                                    }

                                    if(city_check == 0)
                                    {

                                        for(var c=0; c < results[0]['address_components'].length; c++)
                                        {

                                            if(results[0]['address_components'][c]['types'][0] == 'postal_town')
                                            {


                                                $('#city_name').val(results[0]['address_components'][c]['long_name']);

                                                city_check = 1;

                                            }

                                        }

                                    }

                                    if(city_check == 0)
                                    {
                                        $('#city_name').val();
                                    }

                                }

                                else
                                {
                                    $('#address-input').val();
                                    $('#city_name').val();

                                }
                            }
                        });

                    });

                    marker.setVisible(isEdit);

                    const autocomplete = new google.maps.places.Autocomplete(input,options);
                    autocomplete.key = fieldKey;
                    autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
                }

                for (let i = 0; i < autocompletes.length; i++) {
                    const input = autocompletes[i].input;
                    const autocomplete = autocompletes[i].autocomplete;
                    const map = autocompletes[i].map;
                    const marker = autocompletes[i].marker;

                    google.maps.event.addListener(autocomplete, 'place_changed', function () {
                        marker.setVisible(false);
                        const place = autocomplete.getPlace();

                        geocoder.geocode({'placeId': place.place_id}, function (results, status) {



                            if (status === google.maps.GeocoderStatus.OK) {

                                if (results[0]) {


                                    const lat = results[0].geometry.location.lat();
                                    const lng = results[0].geometry.location.lng();
                                    setLocationCoordinates(autocomplete.key, lat, lng);

                                    var city_check1 = 0;

                                    for(var e=0; e < results[0]['address_components'].length; e++)
                                    {

                                        if(results[0]['address_components'][e]['types'][0] == 'locality')
                                        {

                                            $('#city_name').val(results[0]['address_components'][e]['long_name']);

                                            city_check1 = 1;

                                        }

                                    }

                                    if(city_check1 == 0)
                                    {
                                        for(var x=0; x < results[0]['address_components'].length; x++)
                                        {

                                            if(results[0]['address_components'][x]['types'][0] == 'administrative_area_level_2')
                                            {

                                                $('#city_name').val(results[0]['address_components'][x]['long_name']);

                                                city_check1 = 1;

                                            }

                                        }
                                    }



                                    if(city_check1 == 0)
                                    {

                                        for(var y=0; y < results[0]['address_components'].length; y++)
                                        {

                                            if(results[0]['address_components'][y]['types'][0] == 'postal_town')
                                            {


                                                $('#city_name').val(results[0]['address_components'][y]['long_name']);

                                                city_check1 = 1;

                                            }

                                        }

                                    }

                                    if(city_check1 == 0)
                                    {
                                        $('#city_name').val();
                                    }
                                }
                                else
                                {

                                    $('#city_name').val();

                                }

                            }
                        });

                        if (!place.geometry) {
                            window.alert("No details available for input: '" + place.name + "'");
                            input.value = "";
                            return;
                        }

                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);

                    });
                }
            }

            function setLocationCoordinates(key, lat, lng) {
                const latitudeField = document.getElementById(key + "-" + "latitude");
                const longitudeField = document.getElementById(key + "-" + "longitude");
                latitudeField.value = lat;
                longitudeField.value = lng;
            }

        });

    </script>

@endsection
