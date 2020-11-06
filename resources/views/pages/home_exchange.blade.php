@extends("app")

@section('head_title', 'Home Exchange | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">

                            <h2>{{__('text.Home Exchange')}}</h2>

                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end:header -->

    <!-- begin:content -->
    <div id="content">

        <div class="container" style="width: 100%;">

            <div class="row mobile-row">

                @if(!isset($properties))

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 faq" style="margin-top: 60px;">

                        <div style="background: white;padding: 20px 10px 0px 10px;border-radius: 10px;box-shadow: 1px 1px 14px 2px #e7e7e7;">

                            <h2 style="margin-bottom: 30px;color: #868686;font-weight: 600;text-align: center;margin-top: 0px;">{{__('text.Recent Ads')}}</h2>

                            @foreach($recent as $temp)

                                <div class="row" style="margin: 0;border-bottom:1px solid #e5e5e5;margin-bottom: 20px;">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding: 0;display: flex;flex-direction: row;">

                                        <div style="background: url(<?php echo URL::asset('assets/img/photograph.png') ?>);background-color: #48cfad;min-width: 45px;height: 40px;background-size: 50% 50%;background-repeat: no-repeat;background-position: center;border-radius: 8px;float: left;"></div>
                                        <small style="text-overflow: ellipsis;display: block;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;float: left;font-weight: 600;padding-left: 10px;white-space: nowrap;"><i style="color: #9b9b9b;margin-right: 5px;" class="fas fa-map-marker-alt" aria-hidden="true"></i> <a style="color: black;" href="{{URL::to('home-exchange/'.$temp->property_slug)}}">{{$temp->address}}</a> <br> <span style="font-weight: 500;">€ {{$temp->rent_per_month}}</span> <br> <?php if($temp->property_type == 0) { echo "Geen voorkeur"; } else { echo getPropertyTypeName($temp->property_type)->types; } ?></small>

                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding: 0;padding-left: 10px;display: flex;flex-direction: row;">

                                        <div style="background: url(<?php echo URL::asset('assets/img/exchange.png') ?>);background-color: #48514f;min-width: 41px;height: 40px;background-size: 50% 50%;background-repeat: no-repeat;background-position: center;border-radius: 100%;float: left;"></div>
                                        <small style="text-overflow: ellipsis;display: block;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;float: left;font-weight: 600;padding-left: 10px;white-space: nowrap;"><i style="color: #9b9b9b;margin-right: 5px;" class="fas fa-map-marker-alt" aria-hidden="true"></i> <a style="color: black;" href="{{URL::to('home-exchange/'.$temp->property_slug)}}">{{$temp->preferred_place}}</a> <br> <span style="font-weight: 500;">€ {{$temp->preferred_rent_max}}</span> <br> <?php if($temp->preferred_kind == 0) { echo "Geen voorkeur"; } else { echo getPropertyTypeName($temp->preferred_kind)->types; } ?></small>

                                    </div>

                                    <?php setlocale(LC_TIME, 'Dutch'); $date = $temp->created_at->formatLocalized('%d %B %Y'); ?>

                                    <div class="row" style="margin: 0;display: inline-block;width: 100%;">
                                        <small style="float: left;font-weight: 600;padding-left: 10px;padding-top: 20px;"> {{__('text.Posted on')}} {{$date}}</small>
                                    </div>

                                </div>

                            @endforeach

                            {{ $recent->appends(request()->query())->links() }}


                        </div>

                    </div>

                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">

                    <a href="{{ URL::to('addhomeexchange') }}" class="btn btn-success" style="float: right;font-size: 18px;margin-bottom: 20px;">{{__('text.Add Property')}}</a>

                    <div style="background-color: white;border-radius: 10px;box-shadow: 1px 1px 14px 2px #e7e7e7;display: inline-block;">

                        <form id="form" action="{{ URL::to('homeexchange/home-exchange-search') }}" method="GET">

                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-10" style="display: table;margin: auto;float: none;margin-bottom: 60px;">

                                <h2 style="margin-bottom: 30px;color: #868686;font-weight: 600;text-align: center;">{{__('text.Find Your Match')}}</h2>

                                <div id="wrapper_1" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">

                                    <h5 class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="margin-bottom: 30px;float: left;text-align: center;color: white;display: inline-block;background: linear-gradient(to right, #494949 0, #434343 100%);padding: 10px;border: 1px solid #d5d5d5;font-weight: 600;">{{__('text.Your House')}}</h5>

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                                        <label style="float: left;">{{__('text.Where do you live?')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></div>

                                            <input type="text" id="address-input" autocomplete="off" required placeholder="" name="address" @if(isset($address)) value="{{$address}}" @endif style="border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control map-input">
                                            <input type="hidden" name="address_latitude" id="address-latitude" @if(isset($address_latitude)) value="{{$address_latitude}}" @endif />
                                            <input type="hidden" name="address_longitude" id="address-longitude" @if(isset($address_longitude)) value="{{$address_longitude}}" @endif  />

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                                        <label style="float: left;">{{__('text.What kind of home do you have?')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-home" aria-hidden="true"></i></div>

                                            <select name="house_kind" id="house_kind" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 80%;border: 0;">

                                                @foreach($types as $type)

                                                    @if(isset($house_kind))

                                                        <option @if($house_kind == $type->id) selected @endif value="{{$type->id}}">{{$type->types}}</option>

                                                    @else

                                                        <option value="{{$type->id}}">{{$type->types}}</option>

                                                    @endif


                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: none;float: left;">

                                        <label style="float: left;">Type of Property</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-home" aria-hidden="true"></i></div>

                                            <select name="property_type" id="property_type" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 80%;border: 0;">

                                                <option value="Rent">Rental</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                                        <label style="float: left;">{{__('text.BEDROOMS')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-bed" aria-hidden="true"></i></div>

                                            <input type="number" step="1" max="" placeholder="" name="bedrooms" required  @if(isset($bedrooms)) value="{{$bedrooms}}" @else value="1" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>


                                    {{--<div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                                        <label style="float: left;">{{__('text.Area')}} <small>(m2)</small></label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-crop-alt" aria-hidden="true"></i></div>

                                            <input type="number" @if(isset($area)) value="{{$area}}" @else value="" @endif name="area" placeholder="" required class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>--}}

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                                        <label style="float: left;">{{__('text.Rent Per Month')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-tag" aria-hidden="true"></i></div>

                                            <input type="number" @if(isset($rent)) value="{{$rent}}" @else value="" @endif name="rent" placeholder="" required class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                </div>

                                <div id="wrapper_2" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">

                                    <h5 class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="margin-bottom: 30px;float: right;text-align: center;color: white;display: inline-block;background: linear-gradient(to right, #494949 0, #434343 100%);padding: 10px;border: 1px solid #d5d5d5;font-weight: 600;">{{__('text.You are looking for?')}}</h5>

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                                        <label style="float: left;">{{__('text.Where do you want to live?')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></div>

                                            <input type="text" id="preferred-address-input" autocomplete="off" required placeholder="" name="preferred_address" @if(isset($preferred_address)) value="{{$preferred_address}}" @endif style="border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control map-input">
                                            <input type="hidden" name="preferred_address_latitude" id="preferred-address-latitude" @if(isset($preferred_address_latitude)) value="{{$preferred_address_latitude}}" @endif />
                                            <input type="hidden" name="preferred_address_longitude" id="preferred-address-longitude" @if(isset($preferred_address_longitude)) value="{{$preferred_address_longitude}}" @endif  />

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                                        <label style="float: left;">{{__('text.Within Radius of?')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-arrows-alt-h" aria-hidden="true"></i></div>

                                            <select name="preferred_radius" id="preferred_radius" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 80%;border: 0;">

                                                @if(isset($preferred_radius))

                                                    <option @if($preferred_radius == 0) selected @endif value="0">0 KM</option>
                                                    <option @if($preferred_radius == 1) selected @endif value="1">1 KM</option>
                                                    <option @if($preferred_radius == 2) selected @endif value="2">2 KM</option>
                                                    <option @if($preferred_radius == 5) selected @endif value="5">5 KM</option>
                                                    <option @if($preferred_radius == 10) selected @endif value="10">10 KM</option>
                                                    <option @if($preferred_radius == 15) selected @endif value="15">15 KM</option>
                                                    <option @if($preferred_radius == 30) selected @endif value="30">30 KM</option>
                                                    <option @if($preferred_radius == 50) selected @endif value="50">50 KM</option>
                                                    <option @if($preferred_radius == 100) selected @endif value="100">100 KM</option>

                                                @else

                                                    <option value="0">0 KM</option>
                                                    <option value="1">1 KM</option>
                                                    <option value="2">2 KM</option>
                                                    <option value="5">5 KM</option>
                                                    <option value="10">10 KM</option>
                                                    <option value="15">15 KM</option>
                                                    <option value="30">30 KM</option>
                                                    <option value="50">50 KM</option>
                                                    <option value="100">100 KM</option>

                                                @endif

                                            </select>

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                                        <label style="float: left;">{{__('text.What type of home are you looking for?')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-home" aria-hidden="true"></i></div>

                                            <select name="preferred_house_kind" id="preferred_house_kind" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 80%;border: 0;">

                                                <option @if(isset($preferred_house_kind)) @if($preferred_house_kind == 0) selected @endif @endif value="0">Geen voorkeur</option>

                                                @foreach($types as $type)

                                                    @if(isset($preferred_house_kind))

                                                        <option @if($preferred_house_kind == $type->id) selected @endif value="{{$type->id}}">{{$type->types}}</option>

                                                    @else

                                                        <option value="{{$type->id}}">{{$type->types}}</option>

                                                    @endif


                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: none;float: right;">

                                        <label style="float: left;">Type of Property</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-home" aria-hidden="true"></i></div>

                                            <select name="preferred_property_type" id="preferred_property_type" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 80%;border: 0;">

                                                <option value="Rent">Rental</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;margin-top: 20px;">

                                        <label style="float: left;">{{__('text.Minimum Bedrooms')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-bed" aria-hidden="true"></i></div>

                                            <input type="number" step="1" max="" placeholder="" name="preferred_bedrooms" required @if(isset($preferred_bedrooms)) value="{{$preferred_bedrooms}}" @else value="1" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                    {{--<div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                                        <label style="float: left;">{{__('text.Minimum Area')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-crop-alt" aria-hidden="true"></i></div>

                                            <input type="number" name="preferred_area" @if(isset($preferred_area)) value="{{$preferred_area}}" @else value="" @endif placeholder="" required class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>--}}

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                                        <label style="float: left;">{{__('text.Maximum Rent Per Month')}}</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-tag" aria-hidden="true"></i></div>

                                            <input type="number" name="preferred_rent" @if(isset($preferred_rent)) value="{{$preferred_rent}}" @else value="" @endif placeholder="" required class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                                        <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                            <input name="media" @if(isset($media)) @if($media == 1) checked @endif @endif value="1" type="checkbox" id="media" style="position: relative;top: 2px;display: block;height: 0px;">

                                            <label class="bg" for="media" style="margin: 0;padding-left: 22px;">

                                                <span class="search-span" style="position: relative;top: 3px;font-size: 10px;color: #4b4848;">{{__('text.Only show me homes with photos or videos')}}</span>

                                            </label>


                                        </a>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;margin-top: 20px;">
                                    <button type="submit" class="btn btn-success" style="font-size: 17px;outline: none;"><i class="fas fa-search" style="margin-right: 5px;font-size: 17px;" aria-hidden="true"></i> {{__('text.Search')}}</button>
                                </div>

                                <input type="hidden" value="newest" name="filter" id="filter_orderby">


                            </div>

                        </form>

                    </div>

                </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-top: 60px;">

                        <div style="background: white;padding: 20px;border-radius: 10px;box-shadow: 1px 1px 14px 2px #e7e7e7;">

                            <h2 style="margin-bottom: 30px;color: #868686;font-weight: 600;text-align: center;margin-top: 0px;">{{__('text.FAQs')}}</h2>

                            <section class="cd-faq js-cd-faq container max-width-md margin-top-lg margin-bottom-lg" style="padding: 0;margin: 0;width: 100%;">
                                <div class="cd-faq__items" style="padding: 0;">

                                    <ul id="basics" class="cd-faq__group" style="padding: 0;">

                                        @foreach($faqs as $key)

                                            <li class="cd-faq__item">
                                                <a class="cd-faq__trigger" href="#0"><span>{{$key->question}}</span></a>
                                                <div class="cd-faq__content">
                                                    <div class="text-component">
                                                        <p>{!! $key->answer !!}</p>
                                                    </div>
                                                </div> <!-- cd-faq__content -->
                                            </li>

                                        @endforeach


                                    </ul> <!-- cd-faq__group -->

                                </div> <!-- cd-faq__items -->

                                <a href="#0" class="cd-faq__close-panel text-replace">Close</a>

                                <div class="cd-faq__overlay" aria-hidden="true"></div>
                            </section> <!-- cd-faq -->

                        </div>

                    </div>

                @endif

                <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">

                <style>

                    a:hover, a:focus
                    {
                        color: hsl(73, 46%, 55%);
                    }

                    label
                    {
                        font-size: 11px;
                    }

                    .cd-faq__item
                    {
                        background: #fafafa;
                        /*box-shadow: 0px 0px 18px -8px rgb(196 196 196);*/
                        border: 1px solid #efefef;
                        margin-bottom: 10px;
                    }

                    .cd-faq__trigger
                    {
                        font-size: 12px;
                        font-weight: 300;
                        margin: 0;
                        padding: var(--space-sm) var(--space-lg) var(--space-sm) var(--space-sm);
                    }

                    .cd-faq__items{position:static;height:auto;width:auto;-ms-flex-positive:1;flex-grow:1;overflow:visible;-webkit-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0);padding:0 0 0 0.75em;padding:0 0 0 var(--space-sm);background:transparent}

                    .cd-faq{position:relative;box-shadow:none;display:-ms-flexbox;display:flex}.cd-faq::before{content:'desktop'}

                    .cd-faq__content .text-component
                    {
                        font-size: 1.0rem;
                    }

                    .cd-faq__content p
                    {
                        color: hsl(0deg 0% 35%);
                    }

                    .btn:not(:disabled):not(.disabled)
                    {
                        cursor: pointer;
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

                    @media (min-width: 768px)
                    {
                        #wrapper_2:before {
                            content: "";
                            background-color: #bebebe;
                            position: absolute;
                            width: 2px;
                            height: 95%;
                            top: 22px;
                            right: 100%;
                            display: block;
                        }
                    }

                    input,
                    textarea {
                        border: 1px solid #eeeeee;
                        box-sizing: border-box;
                        margin: 0;
                        outline: none;
                        padding: 10px;
                    }

                    input[type="button"] {
                        -webkit-appearance: button;
                        cursor: pointer;
                    }

                    input::-webkit-outer-spin-button,
                    input::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                    }

                    .input-group {
                        clear: both;
                        margin: 15px 0;
                        position: relative;
                    }

                    .input-group input[type='button'] {
                        background-color: #eeeeee;
                        min-width: 38.5px;
                        width: auto;
                        transition: all 300ms ease;
                    }

                    .input-group .button-minus,
                    .input-group .button-plus {
                        font-weight: bold;
                        height: 38.5px;
                        padding: 0;
                        width: 38px;
                        position: relative;
                    }

                    .input-group .quantity-field {
                        position: relative;
                        height: 38px;
                        left: -6px;
                        text-align: center;
                        width: 62px;
                        display: inline-block;
                        font-size: 13px;
                        margin: 0 0 5px;
                        resize: vertical;
                    }


                    input[type="number"] {
                        -moz-appearance: textfield;
                        -webkit-appearance: none;
                    }

                    .new-icons
                    {
                        line-height: 1.42857143;
                        border: 1px solid transparent;
                        display: table-cell !important;
                        padding: 0px !important;
                        margin: 0px !important;
                        background: transparent;
                        color: black;
                        width: 35px;
                        height: 35px;
                        text-align: center;
                        vertical-align: middle;
                    }

                    .new-icons:hover
                    {
                        background-color: #ffffff !important;
                        border-color: #eee #eee #ddd;
                    }

                    .image-tab
                    {
                        margin: 0px 5px !important;
                    }

                </style>

                <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

                <script src="{{ URL::asset('assets/js/util.js') }}"></script>
                <script src="{{ URL::asset('assets/js/main.js') }}"></script>

                <script>

                    $(document).ready(function() {

                        $('#address-input').on('keyup keypress', function (e) {


                            var keyCode = e.keyCode || e.which;

                            if (keyCode === 13) {
                                e.preventDefault();
                                return false;
                            }

                            const locationInputs = $(this);

                            var options = {

                                componentRestrictions: {country: "nl"}

                            };

                            const autocompletes = [];
                            const geocoder = new google.maps.Geocoder;

                            for (let i = 0; i < locationInputs.length; i++) {

                                const input = locationInputs[i];
                                const fieldKey = input.id.replace("-input", "");

                                const autocomplete = new google.maps.places.Autocomplete(input, options);
                                autocomplete.key = fieldKey;
                                autocompletes.push({input: input, autocomplete: autocomplete});
                            }

                            for (let i = 0; i < autocompletes.length; i++) {

                                const input = autocompletes[i].input;
                                const autocomplete = autocompletes[i].autocomplete;


                                google.maps.event.addListener(autocomplete, 'place_changed', function () {

                                    const place = autocomplete.getPlace();

                                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {


                                        if (status === google.maps.GeocoderStatus.OK) {

                                            if (results[0]) {

                                                const lat = results[0].geometry.location.lat();
                                                const lng = results[0].geometry.location.lng();


                                                $(input).parent().children('#address-latitude').val(lat);
                                                $(input).parent().children('#address-longitude').val(lng);

                                                var value = $(input).val();

                                            } else {

                                                alert("No results found!");

                                            }

                                        }

                                    });

                                    if (!place.geometry) {
                                        window.alert("No details available for input: '" + place.name + "'");
                                        input.value = "";
                                        return;
                                    }


                                });
                            }


                        });


                        $('#preferred-address-input').on('keyup keypress', function (e) {


                            var keyCode = e.keyCode || e.which;

                            if (keyCode === 13) {
                                e.preventDefault();
                                return false;
                            }

                            const locationInputs = $(this);

                            var options = {

                                componentRestrictions: {country: "nl"}

                            };

                            const autocompletes = [];
                            const geocoder = new google.maps.Geocoder;

                            for (let i = 0; i < locationInputs.length; i++) {

                                const input = locationInputs[i];
                                const fieldKey = input.id.replace("-input", "");

                                const autocomplete = new google.maps.places.Autocomplete(input, options);
                                autocomplete.key = fieldKey;
                                autocompletes.push({input: input, autocomplete: autocomplete});
                            }

                            for (let i = 0; i < autocompletes.length; i++) {

                                const input = autocompletes[i].input;
                                const autocomplete = autocompletes[i].autocomplete;


                                google.maps.event.addListener(autocomplete, 'place_changed', function () {

                                    const place = autocomplete.getPlace();

                                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {


                                        if (status === google.maps.GeocoderStatus.OK) {

                                            if (results[0]) {

                                                const lat = results[0].geometry.location.lat();
                                                const lng = results[0].geometry.location.lng();


                                                $(input).parent().children('#preferred-address-latitude').val(lat);
                                                $(input).parent().children('#preferred-address-longitude').val(lng);

                                                var value = $(input).val();

                                            } else {

                                                alert("No results found!");

                                            }

                                        }

                                    });

                                    if (!place.geometry) {
                                        window.alert("No details available for input: '" + place.name + "'");
                                        input.value = "";
                                        return;
                                    }


                                });
                            }


                        });

                        function incrementValue(e) {
                            e.preventDefault();
                            var fieldName = $(e.target).data('field');
                            var parent = $(e.target).closest('div');
                            var currentVal = parseInt(parent.find('input[type=number]').val(), 10);


                            if (!isNaN(currentVal)) {
                                parent.find('input[type=number]').val(currentVal + 1);
                            } else {
                                parent.find('input[type=number]').val(0);
                            }
                        }

                        function decrementValue(e) {
                            e.preventDefault();
                            var fieldName = $(e.target).data('field');
                            var parent = $(e.target).closest('div');
                            var currentVal = parseInt(parent.find('input[type=number]').val(), 10);

                            if (!isNaN(currentVal) && currentVal > 0) {
                                parent.find('input[type=number]').val(currentVal - 1);
                            } else {
                                parent.find('input[type=number]').val(0);
                            }
                        }

                        $('.input-group').on('click', '.button-plus', function (e) {
                            incrementValue(e);
                        });

                        $('.input-group').on('click', '.button-minus', function (e) {
                            decrementValue(e);
                        });

                    });

                </script>

                    <style>

                        @media (max-width: 992px)
                        {

                            .res-img
                            {
                                display: none;
                            }
                        }

                        @media (max-width: 767px)
                        {
                            .faq
                            {
                                margin-top: 0 !important;
                                margin-bottom: 20px;
                            }
                        }

                        @media (max-width: 600px)
                        {
                            .res-nav
                            {
                                display: none;
                            }

                            .res-con
                            {
                                font-size: 13px;
                            }

                            .res-row
                            {
                                display: block !important;
                            }

                            .res-inner
                            {
                                width: 100% !important;
                                text-align: left !important;
                                border-right: 0 !important;
                                padding: 0 !important;
                            }

                            .res-pad
                            {
                                padding: 0 !important;
                            }

                            .res-title
                            {
                                display: none;
                            }

                            .res-heading
                            {
                                width: 100% !important;
                                font-size: 18px;
                            }

                            .res-address
                            {
                                display: none !important;
                            }

                            .res-rent
                            {
                                width: 100% !important;
                                text-align: left !important;
                            }

                        }

                        @media (min-width: 600px)
                        {
                            .res-icons
                            {
                                display: none !important;
                            }

                            .res-title1
                            {
                                display: none;
                            }
                        }

                    </style>

                @if(isset($properties))

                    @if(count($properties) >= 1)

                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="padding: 0;margin: auto;float: none;display: table;">

                    <!-- begin:article -->
                    <div class="properties-ordering-wrapper" style="box-shadow: 5px 7px 8px -7px #868686;background: linear-gradient(to right, #494949 0, #434343 100%);color: white;border: 0;">
                        <div class="results-count">
                            <?php $count = count($properties); ?> {{trans_choice('text.properties found',$count)}}</div>

                        <div class="properties-ordering">

                                            <div class="label" style="color: white;">{{__('text.Sort by:')}}</div>

                                            <select name="filter_orderby" id="filter" class="orderby" data-placeholder="Sort by" tabindex="-1" aria-hidden="true">

                                                <option @if(isset($filter)) @if($filter == "newest") selected @endif @endif value="newest">{{__('text.Newest')}}</option>
                                                <option @if(isset($filter)) @if($filter == "oldest") selected @endif @endif value="oldest">{{__('text.Oldest')}}</option>
                                                <option @if(isset($filter)) @if($filter == "bedrooms") selected @endif @endif value="bedrooms">{{__('text.Most Bedrooms')}}</option>
                                                <option @if(isset($filter)) @if($filter == "popularity") selected @endif @endif value="popularity">{{__('text.Popularity')}}</option>
                                                <option @if(isset($filter)) @if($filter == "lowest_rent_price") selected @endif @endif value="lowest_rent_price">{{__('text.Lowest Rent Price')}}</option>
                                                <option @if(isset($filter)) @if($filter == "highest_rent_price") selected @endif @endif value="highest_rent_price">{{__('text.Highest Rent Price')}}</option>
                                                <option @if(isset($filter)) @if($filter == "lowest_area") selected @endif @endif value="lowest_area">{{__('text.Lowest Area')}}</option>
                                                <option @if(isset($filter)) @if($filter == "highest_area") selected @endif @endif value="highest_area">{{__('text.Highest Area')}}</option>

                                            </select>

                        </div></div>


                    <!-- begin:product -->


                        <div class="row" style="margin: 0;">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">


                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left: 0;">

                                            <h3 style="float: left;color: white;display: inline-block;background: linear-gradient(to right, #5b5b5b 0, #898989 100%);padding: 10px;border: 0;font-weight: 600;font-size: 13px;border-radius: 5px;box-shadow: 5px 7px 8px -7px #868686;">{{__('text.Offered Home Exchange House')}}</h3>

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-res1" style="padding-right: 0;">

                                            <h3 style="float: left;color: white;display: inline-block;background: linear-gradient(to right, #5b5b5b 0, #898989 100%);padding: 10px;border: 0;font-weight: 600;font-size: 13px;border-radius: 5px;box-shadow: 5px 7px 8px -7px #868686;">{{__('text.Requested Home Exchange House')}}</h3>

                                        </div>


                                        @foreach($properties as $key)

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-con" style="padding: 0;margin-bottom: 20px;">

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left: 0;float: left;margin-bottom: 20px;">

                                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;min-height: 203px;margin: 0;border-radius: 7px;background: linear-gradient(to right, #ffffff 0, #efefef 100%);box-shadow: 5px 7px 8px -4px #ededed;border: 1px solid #e5e5e5;">

                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 res-img" style="padding: 0;">

                                                                    @if($key->featured_image)

                                                                        <img src="{{ URL::asset('upload/properties/'.$key->featured_image.'-b.jpg') }}" style="width: 100%;height: 200px;border-top-left-radius: 7px;border-bottom-left-radius: 7px;">

                                                                    @endif

                                                                </div>

                                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                                                                    <h3 class="res-heading" style="float: left;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;float: left;font-weight: 600;color: #48cfad;width: 40%;">

                                                                        <?php $city = strrpos($key->address, ',');
                                                                        $city = $city === false ? $key->address : substr($key->address, $city + 1); ?>

                                                                        <a class="res-title" href="{{URL::to('home-exchange/'.$key->property_slug)}}">{{ Str::limit($key->property_name,15) }}</a>
                                                                        <a class="res-title1" href="{{URL::to('home-exchange/'.$key->property_slug)}}">{{ Str::limit($city,15) }}</a>

                                                                    </h3>

                                                                    <?php $url = "https://" . $_SERVER['HTTP_HOST'] . '/home-exchange/' . $key->property_slug; ?>

                                                                    <ul class="nav nav-tabs nav-table res-nav" style="float: right;border-bottom: 0;margin: 10px 0px;margin-bottom: 0px;width: 60%;">

                                                                        <li class="image-tab" style="float: right;">
                                                                            <a class="new-icons" target="_blank" title="Share by Email" href="mailto:?subject={{__('text.I wanted you to see this Property AD I just Found on zoekjehuisje.nl')}}&amp;body={{$url}}" style="border-radius: 100px;position: relative;">
                                                                                <i class="far fa-envelope" style="vertical-align: middle;" aria-hidden="true"></i>
                                                                            </a>
                                                                        </li>

                                                                        <li class="image-tab" style="float: right;">
                                                                            <a class="new-icons" title="Share" style="border-radius: 100px;position: relative;" data-toggle="modal" data-target="#ShareModal">
                                                                                <i class="fas fa-share-alt" style="vertical-align: middle;margin-right: 2px;" aria-hidden="true"></i>
                                                                            </a>
                                                                        </li>


                                                                        <li class="image-tab" style="float: right;">

                                                                            @if( isset(Auth::user()->usertype) && Auth::user()->usertype == 'Users')

                                                                                <form action="{{ URL::to('admin/save-property') }}" method="POST" id="save_property_form" style="display: inline-block;">

                                                                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                                                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                                                                    <input type="hidden" name="property_id" value="{{$key->id}}">

                                                                                    <input type="hidden" name="type" value="exchange">

                                                                                    <a onclick="$('#save_property_form').submit()" class="new-icons" title="Add Favorite" style="border-radius: 100px;position: relative;">

                                                                                        @if($key->saved_count)

                                                                                            <i class="fa fa-heart" id="heart" style="vertical-align: middle;font-size: 16px;">

                                                                                            </i>

                                                                                        @else

                                                                                            <i class="far fa-heart" id="heart" style="vertical-align: middle;font-size: 16px;">

                                                                                            </i>

                                                                                        @endif

                                                                                    </a>

                                                                                </form>

                                                                            @else

                                                                                @if(!isset(Auth::user()->usertype))

                                                                                    <a class="new-icons" href="{{ URL::to('/login') }}" title="Be First to Save this property" style="border-radius: 100px;position: relative;">

                                                                                        <i class="far fa-heart" id="heart" style="vertical-align: middle;font-size: 16px;">
                                                                                        </i>
                                                                                    </a>

                                                                                @endif

                                                                            @endif

                                                                        </li>

                                                                    </ul>

                                                                    <div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">


                                                                            <div class="modal-content" style="width: 100%;">

                                                                                <div class="modal-header" style="border-bottom: 0;display: inline-block;width: 100%;padding: 15px 25px 20px 25px;border-bottom: 1px solid #e6e9ed;">

                                                                                    <h4 style="margin-top: 5px;" class="modal-title" id="exampleModalLabel">{{__('text.SHARE THIS AD')}}</h4>

                                                                                </div>


                                                                                <div class="modal-body" style="padding: 10px 25px;padding-top: 0px;">

                                                                                    <input type="hidden" name="id" value="1">

                                                                                    <div class="form-group" style="margin-top: 15px;">

                                                                                        <div style="position: relative;width: 100%;">

                                                                                            <a class="share-link" style="border-bottom: 1px solid rgb(208, 211, 217);" target="_blank" title="Share by Whatsapp" href="https://api.whatsapp.com/send?text={{$url}}">
                                                                                                <div style="line-height: 5;padding: 0px 20px;">
                                                                                                    <i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 20px;color: #474646;"></i>

                                                                                                    <span style="margin-left: 6px;font-size: 20px;color: #474646;">{{__('text.Share By Whatsapp')}}</span>

                                                                                                </div>
                                                                                            </a>

                                                                                            <a class="share-link" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url}}">

                                                                                                <div style="line-height: 5;padding: 0px 20px;">

                                                                                                    <i class="fa fa-facebook" aria-hidden="true" style="font-size: 20px;color: #474646;"></i>

                                                                                                    <span style="margin-left: 6px;font-size: 20px;color: #474646;">{{__('text.Share By Facebook')}}</span>

                                                                                                </div>
                                                                                            </a>

                                                                                            <style>

                                                                                                .share-link
                                                                                                {
                                                                                                    text-decoration: none !important;
                                                                                                    display: block;
                                                                                                    min-height: 60px;
                                                                                                }

                                                                                                .share-link:hover
                                                                                                {
                                                                                                    background-color: rgb(242, 245, 247);
                                                                                                }

                                                                                            </style>

                                                                                        </div>

                                                                                    </div>


                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                                                </div>
                                                                            </div>



                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-pad" style="padding-left: 2px;margin-bottom: 15px;margin-top: 10px;">

                                                                        <small class="res-address" style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;width: 55%;float: left;font-weight: 600;"><i style="color: #9b9b9b;margin-right: 5px;" class="fas fa-map-marker-alt" aria-hidden="true"></i> {{ Str::limit($key->address,40) }}</small>

                                                                        <small class="res-rent" style="width: 45%;float: right;font-weight: 600;text-align: right;">€ {{$key->rent_per_month}} {{__('text.Rent')}}</small>

                                                                    </div>

                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-row" style="padding: 0px;min-height: 40px;display: flex;flex-direction: row;">

                                                                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 res-inner" style="text-align: center;display: flex;justify-content: center;flex-direction: column;border-right: 1px solid #cccccc;min-height: 40px;flex:1;">
                                                                            <span><i style="color: #c3c3c3;margin-right: 5px;" class="fas fa-bed res-icons" aria-hidden="true"></i> @if($key->bedrooms > 1) {{$key->bedrooms}} {{__('text.Total Bedrooms')}} @else {{$key->bedrooms}} {{__('text.Total Bedroom')}} @endif </span>
                                                                        </div>

                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 res-inner" style="text-align: center;display: flex;justify-content: center;flex-direction: column;min-height: 40px;flex:1;">
                                                                            <span><i style="color: #c3c3c3;margin-right: 5px;" class="fas fa-crop-alt res-icons" aria-hidden="true"></i> {{$key->area}} m2 </span>
                                                                        </div>

                                                                    </div>


                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-foot" style="margin-top: 20px;padding: 0;">

                                                                        <small style="float: left;font-weight: bold;"><?php if($key->property_type == 0){ echo "Geen voorkeur"; } foreach($types as $type) { if($key->property_type == $type->id){ echo $type->types; }} ?></small>
                                                                        {{--<small style="float: right;font-weight: 600;color: #1db3e1;"><i class="fa fa-calendar-o" aria-hidden="true" style="margin-right: 5px;"></i> 0 Weeks Ago</small>--}}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                </div>


                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-res1" style="padding-right: 0;float: right;">

                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;margin: 0;min-height: 203px;border-radius: 7px;background: linear-gradient(to right, #f6f6f6 0, #e9e9e9 100%);box-shadow: 5px 7px 8px -4px #ededed;border: 1px solid #e5e5e5;">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                    <?php $preferred_city = strrpos($key->preferred_place, ',');
                                                    $preferred_city = $preferred_city === false ? $key->preferred_place : substr($key->preferred_place, $preferred_city + 1); ?>

                                                    <h3 class="res-heading" style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;width: 100%;float: left;font-weight: 600;color: #48cfad;">

                                                        <a href="" class="res-title">{{ Str::limit($key->preferred_place,30) }}</a>
                                                        <a href="" class="res-title1">{{ Str::limit($preferred_city,15) }}</a>

                                                    </h3>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-pad" style="padding-left: 2px;margin-bottom: 15px;margin-top: 10px;">

                                                        <small style="float: left;font-weight: 600;">+ {{$key->preferred_radius}} KM</small>

                                                        <small style="float: right;font-weight: 600;">€ {{$preferred_rent}} {{__('text.Rent')}}</small>

                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-row" style="padding: 0px;min-height: 40px;display: flex;flex-direction: row;">

                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 res-inner" style="text-align: center;display: flex;justify-content: center;flex-direction: column;border-right: 1px solid #cccccc;min-height: 40px;flex:1;">
                                                           <span><i style="color: #c3c3c3;margin-right: 5px;" class="fas fa-bed res-icons" aria-hidden="true"></i> @if($preferred_bedrooms > 1) {{$preferred_bedrooms}} {{__('text.Total Bedrooms')}} @else {{$preferred_bedrooms}} {{__('text.Total Bedroom')}} @endif</span>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 res-inner" style="text-align: center;display: flex;justify-content: center;flex-direction: column;min-height: 40px;flex:1;">
                                                          <span><i style="color: #c3c3c3;margin-right: 5px;" class="fas fa-crop-alt res-icons" aria-hidden="true"></i> {{$preferred_area}} m2</span>
                                                        </div>


                                                    </div>


                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;padding: 0;">

                                                        <small style="float: left;font-weight: bold;"><?php if($preferred_house_kind == 0){ echo "Geen voorkeur"; } foreach($types as $type) { if($preferred_house_kind == $type->id){ echo $type->types; }} ?></small>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                            </div>

                                            @endforeach

                                    </div>


                                    </div>

                                    <!-- end:product -->


                        </div>
                        <!-- end:article -->

                        @else

                            <h1 style="text-align: center;color: #5f5f5f;">{{__('text.No home exchange properties found...')}}</h1>

                    @endif


                    @endif

                </div>

            </div>
        </div>
        <!-- end:content -->

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

        <style>

            input[type=number]::-webkit-outer-spin-button,
            input[type=number]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance:textfield;
            }

            .video-wrapper-inner .popup-video{position:relative;z-index:1;display:inline-block;width:50px;height:50px;line-height:50px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;font-size:18px;color:#fff;background:#f9424b;text-align:center}

            @media (min-width: 1200px){.video-wrapper-inner .popup-video{width:70px;height:70px;line-height:70px;font-size:22px}}

            .video-wrapper-inner .popup-video:before{-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;content:'';position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;background:#f9424b;opacity:0.3;filter:alpha(opacity=30);border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-animation:scaleicon 3s ease-in-out 0s infinite alternate;animation:scaleicon 3s ease-in-out 0s infinite alternate}.widget-video.style2 .popup-video{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}

            @-webkit-keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

            @keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}


            .properties-ordering-wrapper,.agencies-ordering-wrapper,.agents-ordering-wrapper{margin-bottom:20px;display:-webkit-box;display:-webkit-flex;display:-moz-flex;display:-ms-flexbox;display:flex;align-items:center;-webkit-align-items:center;background-color:#fff;border:1px
            solid #ebebeb;padding:10px
            20px;border-radius:6px;-webkit-border-radius:6px;-moz-border-radius:6px;-ms-border-radius:6px;-o-border-radius:6px}

            @media (min-width: 1200px){.properties-ordering-wrapper,.agencies-ordering-wrapper,.agents-ordering-wrapper{padding:15px
            30px;margin-bottom:30px}}


            .properties-ordering-wrapper .properties-ordering, .agencies-ordering-wrapper .properties-ordering, .agents-ordering-wrapper .properties-ordering{margin-left:auto}

            .my-properties-ordering .label, .sort-my-properties-form .label, .sort-properties-favorite-form .label, .properties-ordering .label{font-weight: 600;color:#484848;font-size:14px;padding:0;display:inline-block;vertical-align:middle;margin-right: 5px;}

            .label{display:inline;padding: .2em .6em .3em;font-size:75%;font-weight:bold;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius: .25em}

            .select2-results .select2-results__option{padding:0
            10px;white-space:nowrap}

            .select2-container--default .select2-results__option--selected:before{content:"\f10a";font-family:"Flaticon";color:#fe666b;position:absolute;-webkit-transform:translateY(0%);-ms-transform:translateY(0%);-o-transform:translateY(0%);transform:translateY(0%);right:6px;display:inline-block}

            .select2-results .select2-results__option{padding:5px 10px;background-color:transparent;position:relative;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s}

            .select2-container--default .select2-results__option--selected
            {
                background: #f3f3f3;
            }

            .select2-container.select2-container--default .select2-results__option[aria-selected="true"]
            {
                background-color: #f3f3f3;
                color: #484848;
            }

            .select2-results
            {
                padding: 15px 0px 10px 0px;
            }

            .select2-dropdown
            {
                border: 1px
                solid #ebebeb !important;
                -webkit-box-shadow: none;
                box-shadow: none;
                border-radius: 6px !important;
                -webkit-border-radius: 6px !important;
            }

            .select2-container
            {
                outline: none !important;
                text-align: left;
            }

            .select2-container--default .select2-selection--single
            {
                border:1px solid #d7d7d7;
                outline: none !important;
            }

            .select2-container .select2-selection--single .select2-selection__rendered
            {
                padding-left: 6px;
                padding-right: 25px;
                position: relative;
                top: 1px;
            }

            .select2-container--open .select2-dropdown--below
            {
                width: 240px !important;
                text-align: left;
            }

            .select2-container--default .select2-results>.select2-results__options
            {
                min-height: 240px;
                max-height: fit-content;
            }

            .property-image
            {
                height: 265px;
            }

            .property-image img
            {
                height: 100%;
            }

            .modal-backdrop.fade
            {
                opacity: 0.5;
            }

            .modal-header
            {
                min-height: 0;
                padding: 0;
                border: 0;


            }

            .modal-title
            {
                display: none;
            }

            .modal-header .close
            {
                font-size: 60px;
                position: absolute;
                right: -115px;
                top: -62px;
                opacity: 0.8;
                text-shadow: none;

            }

            .modal-body
            {
                padding: 0;
            }

            .modal-content
            {
                border:0;
            }

            .ekko-lightbox .close{
                position: absolute;
                right: 43px;
                top: -3px;
                opacity: 0.6;
                text-shadow: none;
                outline: 0;
            }

            .ekko-lightbox .close span{
                font-size: 88px;
            }

            a
            {
                text-decoration: none;
            }

            a:hover, a:focus
            {
                text-decoration: none;
            }

            .fade {
                transform: scale(0);
                opacity: 0;
                transition: all .2s linear;

            }

            .fade.in {
                transform: scale(1);
            }


        </style>


        <script>

            $(document).ready(function() {

                $('#filter').change(function(){

                    var value = $(this).val();

                    $('#filter_orderby').val(value);

                    $('#form').submit();

                });

                $('.orderby').select2({
                    minimumResultsForSearch: Infinity,
                });
            });

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true,
                    showArrows:true
                });

                $('.modal-header .close').appendTo(".ekko-lightbox");

                var length = $(".ekko-lightbox > button").length;
                length = length - 1;


                if(length > 0)
                {
                    for(var i = 0; i < length; i++)
                    {
                        $( ".ekko-lightbox" ).find("button").slice(0, 1).remove();
                    }

                }

            });

        </script>

@endsection
