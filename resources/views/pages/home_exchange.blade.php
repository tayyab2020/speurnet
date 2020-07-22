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

                            <h2>Home Exchange</h2>

                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="active">Home Exchange</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end:header -->

    <!-- begin:content -->
    <div id="content">

        <div class="row" style="margin: 0;margin-bottom: 20px;">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px 40px;">

                <a href="{{ URL::to('addhomeexchange') }}" class="btn btn-success" style="float: right;font-size: 20px;">Add Property</a>

            </div>

        </div>


        <div class="container">

            <div class="row mobile-row" style="background-color: white;padding: 0px 20px;border-radius: 10px;box-shadow: 1px 1px 14px 2px #e7e7e7;">

                <form action="{{ URL::to('homeexchange/home-exchange-search') }}" method="GET">

                    @csrf

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-10" style="display: table;margin: auto;float: none;margin-bottom: 60px;">

                    <h1 style="margin-bottom: 30px;color: #303030;text-align: center;">Find Your Match</h1>

                    <div id="wrapper_1" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">

                        <h3 class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="margin-bottom: 30px;float: left;text-align: center;color: white;display: inline-block;background: linear-gradient(to right, #494949 0, #434343 100%);padding: 10px;border: 1px solid #d5d5d5;font-weight: 600;font-size: 20px;">Your House</h3>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                            <label style="float: left;">Where do you live?</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></div>

                                <input type="text" id="address-input" autocomplete="off" required placeholder="Enter Address" name="address" @if(isset($address)) value="{{$address}}" @endif style="border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control map-input">
                                <input type="hidden" name="address_latitude" id="address-latitude" @if(isset($address_latitude)) value="{{$address_latitude}}" @endif />
                                <input type="hidden" name="address_longitude" id="address-longitude" @if(isset($address_longitude)) value="{{$address_longitude}}" @endif  />

                            </div>

                        </div>


                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                            <label style="float: left;">What kind of home do you have?</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-home" aria-hidden="true"></i></div>

                                <select name="house_kind" id="house_kind" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 75%;border: 0;">

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

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                            <label style="float: left;">Type of Property</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-home" aria-hidden="true"></i></div>

                                <select name="property_type" id="property_type" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 75%;border: 0;">

                                        <option value="Rent">Rental</option>

                                </select>

                            </div>

                        </div>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                            <label style="float: left;">BEDROOMS</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-bed" aria-hidden="true"></i></div>

                                <input type="number" step="1" max="" placeholder="No. of Bedroom(s)" name="bedrooms" required  @if(isset($bedrooms)) value="{{$bedrooms}}" @else value="1" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                            </div>

                        </div>


                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                            <label style="float: left;">BATHROOMS</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-restroom" aria-hidden="true"></i></div>

                                <input type="number" step="1" max="" placeholder="No. of Bathroom(s)" name="bathrooms" required @if(isset($bathrooms)) value="{{$bathrooms}}" @else value="1" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                            </div>

                        </div>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                            <label style="float: left;">Area <small>(m2)</small></label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-crop-alt" aria-hidden="true"></i></div>

                                <input type="number" @if(isset($area)) value="{{$area}}" @else value="" @endif name="area" placeholder="Area" required class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                            </div>

                        </div>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: left;">

                            <label style="float: left;">Rent Per Month <small>(€)</small></label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-tag" aria-hidden="true"></i></div>

                                <input type="number" @if(isset($rent)) value="{{$rent}}" @else value="" @endif name="rent" placeholder="Rent Per Month" required class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                            </div>

                        </div>

                    </div>

                    <div id="wrapper_2" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">

                        <h3 class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="margin-bottom: 30px;float: right;text-align: center;color: white;display: inline-block;background: linear-gradient(to right, #494949 0, #434343 100%);padding: 10px;border: 1px solid #d5d5d5;font-weight: 600;font-size: 20px;">You are looking for?</h3>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                            <label style="float: left;">Where do you want to live?</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></div>

                                <input type="text" id="preferred-address-input" autocomplete="off" required placeholder="Enter Address" name="preferred_address" @if(isset($preferred_address)) value="{{$preferred_address}}" @endif style="border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control map-input">
                                <input type="hidden" name="preferred_address_latitude" id="preferred-address-latitude" @if(isset($preferred_address_latitude)) value="{{$preferred_address_latitude}}" @endif />
                                <input type="hidden" name="preferred_address_longitude" id="preferred-address-longitude" @if(isset($preferred_address_longitude)) value="{{$preferred_address_longitude}}" @endif  />

                            </div>

                        </div>


                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                            <label style="float: left;">Within Radius of?</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-arrows-alt-h" aria-hidden="true"></i></div>

                                <select name="preferred_radius" id="preferred_radius" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 75%;border: 0;">

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

                            <label style="float: left;">What type of home are you looking for?</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-home" aria-hidden="true"></i></div>

                                <select name="preferred_house_kind" id="preferred_house_kind" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 75%;border: 0;">

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

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                            <label style="float: left;">Type of Property</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-home" aria-hidden="true"></i></div>

                                <select name="preferred_property_type" id="preferred_property_type" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 75%;border: 0;">

                                    <option value="Rent">Rental</option>

                                </select>

                            </div>

                        </div>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                            <label style="float: left;">Minimum Bedrooms</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-bed" aria-hidden="true"></i></div>

                                <input type="number" step="1" max="" placeholder="No. of Bedroom(s)" name="preferred_bedrooms" required @if(isset($preferred_bedrooms)) value="{{$preferred_bedrooms}}" @else value="1" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                            </div>

                        </div>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                            <label style="float: left;">Minimum Bathrooms</label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-restroom" aria-hidden="true"></i></div>

                                <input type="number" step="1" max="" placeholder="No. of Bathroom(s)" name="preferred_bathrooms" required @if(isset($preferred_bathrooms)) value="{{$preferred_bathrooms}}" @else value="1" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                            </div>

                        </div>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                            <label style="float: left;">Minimum Area <small>(m2)</small></label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-crop-alt" aria-hidden="true"></i></div>

                                <input type="number" name="preferred_area" @if(isset($preferred_area)) value="{{$preferred_area}}" @else value="" @endif placeholder="Area" required class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                            </div>

                        </div>

                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: inline-block;float: right;">

                            <label style="float: left;">Maximum Rent Per Month <small>(€)</small></label>

                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;background: white;">

                                <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-tag" aria-hidden="true"></i></div>

                                <input type="number" name="preferred_rent" @if(isset($preferred_rent)) value="{{$preferred_rent}}" @else value="" @endif placeholder="Maximum Rent" required class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;margin-top: 20px;">
                        <button type="submit" class="btn btn-success" style="font-size: 20px;"><i class="fas fa-search" style="margin-right: 5px;font-size: 17px;" aria-hidden="true"></i> Search</button>
                    </div>


                </div>

            </form>

                <style>

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

                @if(isset($properties))

                    @if(count($properties) >= 1)

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <!-- begin:article -->
                    <div class="properties-ordering-wrapper" style="box-shadow: 5px 7px 8px -7px #868686;background: linear-gradient(to right, #494949 0, #434343 100%);color: white;border: 0;">
                        <div class="results-count">
                            Showing <?php $count = count($properties); echo $count; if($count > 1) { echo " results"; } else{ echo " result"; } ?></div>

                        <div class="properties-ordering">

                                <form class="properties-ordering" method="get" action="{{URL::to('properties/')}}">

                                            <div class="label" style="color: white;">Sort by:</div>

                                            <select onchange="this.form.submit()" name="filter_orderby" class="orderby" data-placeholder="Sort by" tabindex="-1" aria-hidden="true">

                                                <option value="newest">Newest</option>
                                                <option value="oldest">Oldest</option>
                                                <option value="bedrooms">Bedrooms</option>
                                                <option value="bathrooms">Bathrooms</option>
                                                <option value="popularity">Popularity</option>
                                                <option value="lowest_sale_price">Lowest Sale Price</option>
                                                <option value="highest_sale_price">Highest Sale Price</option>
                                                <option value="lowest_rent_price">Lowest Rent Price</option>
                                                <option value="highest_rent_price">Highest Rent Price</option>
                                                <option value="lowest_area">Lowest Area</option>
                                                <option value="highest_area">Highest Area</option>

                                            </select>

                                        </form>
                        </div></div>


                    <!-- begin:product -->

                    <style>

                        @media (min-width: 992px)
                        {
                            .mobile-res
                            {
                                display: none;
                            }
                        }

                        @media (max-width: 992px)
                        {
                            .mobile-res1
                            {
                                display: none;
                            }
                        }

                        @media (max-width: 600px)
                        {
                            .res-img
                            {
                                width: 100% !important;
                            }

                            .res-foot
                            {
                                margin-bottom: 10px;
                            }

                        }

                    </style>

                        <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mobile-res" style="padding: 0;float: right;">

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                                <h3 style="float: left;color: white;display: inline-block;background: linear-gradient(to right, #5b5b5b 0, #898989 100%);padding: 10px;border: 0;font-weight: 600;font-size: 13px;border-radius: 5px;box-shadow: 5px 7px 8px -7px #868686;">Requested Home Exchange House</h3>

                                            </div>

                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;margin: 0;min-height: 203px;border-radius: 7px;background: linear-gradient(to right, #f6f6f6 0, #e9e9e9 100%);box-shadow: 5px 7px 8px -4px #ededed;border: 1px solid #e5e5e5;">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                    <h3 style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;width: 100%;float: left;">{{ Str::limit($preferred_address,40) }}</h3>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 2px;margin-bottom: 15px;margin-top: 10px;">

                                                        <small style="width: 100%;float: left;font-weight: 600;text-align: left;">€ {{$preferred_rent}} Rent</small>

                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px;min-height: 40px;display: flex;flex-direction: row;">

                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;border-right: 1px solid #cccccc;min-height: 40px;">
                                                            @if($preferred_bedrooms > 1) {{$preferred_bedrooms}} Bedrooms @else {{$preferred_bedrooms}} Bedroom @endif
                                                        </div>

                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;border-right: 1px solid #cccccc;min-height: 40px;">
                                                            {{$preferred_area}} m2
                                                        </div>

                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;min-height: 40px;">
                                                            @if($preferred_bathrooms > 1) {{$preferred_bathrooms}} Bathrooms @else {{$preferred_bathrooms}} Bathroom @endif
                                                        </div>

                                                    </div>


                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;padding: 0;">

                                                        <small style="float: left;font-weight: bold;"><?php foreach($types as $type) { if($preferred_house_kind == $type->id){ echo $type->types; }} ?></small>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding: 0;">

                                            <h3 style="float: left;color: white;display: inline-block;background: linear-gradient(to right, #5b5b5b 0, #898989 100%);padding: 10px;border: 0;font-weight: 600;font-size: 13px;border-radius: 5px;box-shadow: 5px 7px 8px -7px #868686;">Offered Home Exchange House</h3>

                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mobile-res1" style="padding: 0;">

                                            <h3 style="float: left;color: white;display: inline-block;background: linear-gradient(to right, #5b5b5b 0, #898989 100%);padding: 10px;border: 0;font-weight: 600;font-size: 13px;margin-left: 10px;border-radius: 5px;box-shadow: 5px 7px 8px -7px #868686;">Requested Home Exchange House</h3>

                                        </div>


                                        @foreach($properties as $key)

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-bottom: 20px;">

                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding: 0;float: left;margin-bottom: 20px;">

                                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;margin: 0;border-radius: 7px;background: linear-gradient(to right, #ffffff 0, #efefef 100%);box-shadow: 5px 7px 8px -4px #ededed;border: 1px solid #e5e5e5;">

                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 res-img" style="padding: 0;">

                                                                    @if($key->featured_image)

                                                                        <img src="{{ URL::asset('upload/properties/'.$key->featured_image.'-b.jpg') }}" style="width: 100%;height: 200px;border-top-left-radius: 7px;border-bottom-left-radius: 7px;">

                                                                    @else

                                                                        <img src="{{ URL::asset('upload/noImage.png') }}" style="width: 100%;height: 200px;border-top-left-radius: 7px;border-bottom-left-radius: 7px;">

                                                                    @endif

                                                                </div>

                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 res-img">

                                                                    <h3 style="float: left;">{{ Str::limit($key->property_name,15) }}</h3>

                                                                    <?php $url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>

                                                                    <ul class="nav nav-tabs nav-table" style="float: right;border-bottom: 0;margin: 10px 0px;margin-bottom: 0px;">

                                                                        <li class="image-tab" style="float: right;">
                                                                            <a class="new-icons" target="_blank" title="Share by Email" href="mailto:?subject=I wanted you to see this Property AD I just Found on zoekjehuisje.nl&amp;body=Check out this link {{$url}}" style="border-radius: 100px;position: relative;">
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


                                                                                    <h4 style="margin-top: 5px;" class="modal-title" id="exampleModalLabel">SHARE THIS AD</h4>

                                                                                </div>


                                                                                <div class="modal-body" style="padding: 10px 25px;padding-top: 0px;">

                                                                                    <input type="hidden" name="id" value="1">

                                                                                    <div class="form-group" style="margin-top: 15px;">

                                                                                        <div style="position: relative;width: 100%;">

                                                                                            <a class="share-link" style="border-bottom: 1px solid rgb(208, 211, 217);" target="_blank" title="Share by Whatsapp" href="https://api.whatsapp.com/send?text={{$url}}">
                                                                                                <div style="line-height: 5;padding: 0px 20px;">
                                                                                                    <i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 20px;color: #474646;"></i>

                                                                                                    <span style="margin-left: 6px;font-size: 20px;color: #474646;">Share By Whatsapp</span>

                                                                                                </div>
                                                                                            </a>

                                                                                            <a class="share-link" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url}}">

                                                                                                <div style="line-height: 5;padding: 0px 20px;">

                                                                                                    <i class="fa fa-facebook" aria-hidden="true" style="font-size: 20px;color: #474646;"></i>

                                                                                                    <span style="margin-left: 6px;font-size: 20px;color: #474646;">Share By Facebook</span>

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

                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 2px;margin-bottom: 15px;margin-top: 10px;">

                                                                        <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;width: 55%;float: left;font-weight: 600;"><i style="color: #9b9b9b;margin-right: 5px;" class="fas fa-map-marker-alt" aria-hidden="true"></i> {{ Str::limit($key->address,40) }}</small>

                                                                        <small style="width: 45%;float: right;font-weight: 600;text-align: right;">€ {{$key->rent_per_month}} Rent</small>

                                                                    </div>

                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px;min-height: 40px;display: flex;flex-direction: row;">

                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;border-right: 1px solid #cccccc;min-height: 40px;">
                                                                            @if($key->bedrooms > 1) {{$key->bedrooms}} Bedrooms @else {{$key->bedrooms}} Bedroom @endif
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;border-right: 1px solid #cccccc;min-height: 40px;">
                                                                            {{$key->area}} m2
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;min-height: 40px;">
                                                                            @if($key->bathrooms > 1) {{$key->bathrooms}} Bathrooms @else {{$key->bathrooms}} Bathroom @endif
                                                                        </div>

                                                                    </div>


                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-foot" style="margin-top: 20px;">

                                                                        <small style="float: left;font-weight: bold;"><?php foreach($types as $type) { if($key->property_type == $type->id){ echo $type->types; }} ?></small>
                                                                        {{--<small style="float: right;font-weight: 600;color: #1db3e1;"><i class="fa fa-calendar-o" aria-hidden="true" style="margin-right: 5px;"></i> 0 Weeks Ago</small>--}}

                                                                    </div>

                                                                </div>

                                                            </div>

                                                </div>


                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mobile-res1" style="padding: 0;float: right;">

                                            <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;margin: 0;min-height: 203px;margin-left: 10px;border-radius: 7px;background: linear-gradient(to right, #f6f6f6 0, #e9e9e9 100%);box-shadow: 5px 7px 8px -4px #ededed;border: 1px solid #e5e5e5;">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                    <h3 style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;width: 100%;float: left;">{{ Str::limit($preferred_address,40) }}</h3>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 2px;margin-bottom: 15px;margin-top: 10px;">

                                                        <small style="width: 100%;float: left;font-weight: 600;text-align: left;">€ {{$preferred_rent}} Rent</small>

                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px;min-height: 40px;display: flex;flex-direction: row;">

                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;border-right: 1px solid #cccccc;min-height: 40px;">
                                                            @if($preferred_bedrooms > 1) {{$preferred_bedrooms}} Bedrooms @else {{$preferred_bedrooms}} Bedroom @endif
                                                        </div>

                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;border-right: 1px solid #cccccc;min-height: 40px;">
                                                            {{$preferred_area}} m2
                                                        </div>

                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center;display: flex;justify-content: center;flex-direction: column;min-height: 40px;">
                                                            @if($preferred_bathrooms > 1) {{$preferred_bathrooms}} Bathrooms @else {{$preferred_bathrooms}} Bathroom @endif
                                                        </div>

                                                    </div>


                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;padding: 0;">

                                                        <small style="float: left;font-weight: bold;"><?php foreach($types as $type) { if($preferred_house_kind == $type->id){ echo $type->types; }} ?></small>

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

                    @endif
                    @endif

                </div>

            </div>
        </div>
        <!-- end:content -->

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

        <style>

            .video-wrapper-inner .popup-video{position:relative;z-index:1;display:inline-block;width:50px;height:50px;line-height:50px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;font-size:18px;color:#fff;background:#dfc615;text-align:center}

            @media (min-width: 1200px){.video-wrapper-inner .popup-video{width:70px;height:70px;line-height:70px;font-size:22px}}

            .video-wrapper-inner .popup-video:before{-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;content:'';position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;background:#dfc615;opacity:0.3;filter:alpha(opacity=30);border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-animation:scaleicon 3s ease-in-out 0s infinite alternate;animation:scaleicon 3s ease-in-out 0s infinite alternate}.widget-video.style2 .popup-video{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}

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
                width: 200px !important;
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

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

        <script>

            $(document).ready(function() {


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
