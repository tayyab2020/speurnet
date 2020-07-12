@extends("app")

@if(Route::currentRouteName() == 'addproperty')

@section('head_title', 'Add New Property | '.getcong('site_name') )

@else

@section('head_title', 'Add New Construction | '.getcong('site_name') )

@endif


@section('head_url', Request::url())


@section("content")


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">


    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        @if(Route::currentRouteName() == 'addproperty')
                        <h2>Add New Property</h2>
                            @else
                            <h2>Add New Construction</h2>
                        @endif
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="active">Add New Property</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end:header -->

<div id="main" style="width: 60%;margin: auto;margin-top: 25px;">


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


    <div class="panel panel-default">

        <div class="panel-body">


            <div class="stepper">
                <ul class="nav nav-tabs" role="tablist">
                    @if(Route::currentRouteName() == 'addnewconstruction')

                        <li role="presentation" class="active">
                            <a class="persistant-disabled" data-content="stepper-step-2"  data-toggle="tab" aria-controls="stepper-step-2" role="tab" title="Step 1">
                                <span class="round-tab">1</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a class="persistant-disabled" data-content="stepper-step-3"  data-toggle="tab" aria-controls="stepper-step-3" role="tab" title="Step 2">
                                <span class="round-tab">2</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a class="persistant-disabled" data-content="stepper-step-4"  data-toggle="tab" aria-controls="stepper-step-4" role="tab" title="Step 3">
                                <span class="round-tab">3</span>
                            </a>
                        </li>

                        <style>

                            .stepper .nav-tabs > li
                            {
                                width: 33% !important;
                            }

                            .stepper .nav-tabs > li:nth-child(3)::after
                            {
                                background: transparent;
                            }

                        </style>

                        @else

                        <li role="presentation" class="active">
                            <a class="persistant-disabled" data-content="stepper-step-1"  data-toggle="tab" aria-controls="stepper-step-1" role="tab" title="Step 1">
                                <span class="round-tab">1</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a class="persistant-disabled" data-content="stepper-step-2"  data-toggle="tab" aria-controls="stepper-step-2" role="tab" title="Step 2">
                                <span class="round-tab">2</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a class="persistant-disabled" data-content="stepper-step-3"  data-toggle="tab" aria-controls="stepper-step-3" role="tab" title="Step 3">
                                <span class="round-tab">3</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a class="persistant-disabled" data-content="stepper-step-4"  data-toggle="tab" aria-controls="stepper-step-4" role="tab" title="Step 4">
                                <span class="round-tab">4</span>
                            </a>
                        </li>

                    @endif


                </ul>

                {!! Form::open(array('url' => array('admin/properties/addproperty'),'class'=>'form-horizontal padding-15','name'=>'property_form','id'=>'property_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                @if(Route::currentRouteName() == 'addproperty')

                    <input type="hidden" name="route" value="property">

                @else

                    <input type="hidden" name="route" value="construction">

                @endif

                <input type="hidden" name="id" value="{{ isset($property->id) ? $property->id : null }}">

                    <div class="tab-content">

                        <div @if(Route::currentRouteName() == 'addnewconstruction') class="tab-pane fade" @else class="tab-pane fade in active" @endif role="tabpanel" id="stepper-step-1">

                            <div class="form-group" style="width: 90%;margin: auto;text-align: left;">

                                <h2>Step 1: What do you want to do with your property?</h2>


                                <ul class="property-radios" style="padding: 0;margin-top: 40px;display: inline-block;width: 100%;">

                                @if(isset($property->property_purpose))



                                        <li @if($property->property_purpose=='Sale') class="active1 pp col-md-3 col-sm-4 col-xs-12" @else class="pp col-md-3 col-sm-4 col-xs-12" @endif >

                                            <div class="type-holder-main">

                                                <label style="min-width: 100%;min-height: 147px;">

                                                    <input type="radio" name="property_purpose"  @if($property->property_purpose=='Sale') checked="checked" @endif  value="Sale">

                                                    <img src="{{ URL::asset('assets/img/sale.png') }}" style="width: 65%;">

                                                    <span>For Sale</span>

                                                </label>

                                            </div>
                                        </li>

                                        <li @if($property->property_purpose=='Rent') class="active1 pp col-md-3 col-sm-4 col-xs-12" @else class="pp col-md-3 col-sm-4 col-xs-12" @endif style="margin-left: 10px;">

                                            <div class="type-holder-main">

                                                <label style="min-width: 100%;min-height: 147px;">

                                                    <img src="{{ URL::asset('assets/img/rent.png') }}"  style="width: 65%;">

                                                    <input type="radio" name="property_purpose" @if($property->property_purpose=='Rent') checked="checked" @endif value="Rent">

                                                    <span>For Rent</span>

                                                </label>

                                            </div>
                                        </li>



                                @else


                                        <li @if(old('property_purpose') == 'Sale') class="active1 pp col-md-3 col-sm-4 col-xs-12" @elseif(old('property_purpose') == '') class="active1 pp col-md-3 col-sm-4 col-xs-12" @else class="pp col-md-3 col-sm-4 col-xs-12"  @endif >

                                            <div class="type-holder-main">

                                                <label style="min-width: 100%;min-height: 147px;">

                                                    <input type="radio" name="property_purpose" @if(old('property_purpose') == 'Sale') checked="checked" @elseif(old('property_purpose') == '') checked="checked"  @endif  value="Sale">

                                                    <img src="{{ URL::asset('assets/img/sale.png') }}" style="width: 65%;">

                                                    <span>For Sale</span>

                                                </label>

                                            </div>
                                        </li>

                                        <li @if(old('property_purpose') == 'Rent') class="active1 pp col-md-3 col-sm-4 col-xs-12" @elseif(old('property_purpose') == '') class="pp col-md-3 col-sm-4 col-xs-12" @else class="pp col-md-3 col-sm-4 col-xs-12"  @endif style="margin-left: 10px;">

                                            <div class="type-holder-main">

                                                <label style="min-width: 100%;min-height: 147px;">

                                                    <img src="{{ URL::asset('assets/img/rent.png') }}"  style="width: 65%;">

                                                    <input type="radio" name="property_purpose" @if(old('property_purpose') == 'Rent') checked="checked"  @endif value="Rent">

                                                    <span>For Rent</span>

                                                </label>

                                            </div>
                                        </li>


                                @endif

                                </ul>



                            </div>



                            <ul class="list-inline pull-right">

                                <li>
                                    <a class="btn btn-primary next-step" data-id="stepper-step-1">Next</a>
                                </li>
                            </ul>

                        </div>


                        <div @if(Route::currentRouteName() == 'addnewconstruction') class="tab-pane fade in active" @else class="tab-pane fade" @endif role="tabpanel" id="stepper-step-2">


                            <div class="form-group main-div" style="width: 90%;margin: auto;">

                                @if(Route::currentRouteName() == 'addnewconstruction')

                                    <h2>Step 1: What type of property are you marketing?</h2>

                                    @else

                                    <h2>Step 2: What type of property are you marketing?</h2>

                                    @endif


                                <ul class="property-radios" style="padding: 0;margin-top: 40px;">

                                @if(isset($property->property_type))

                                    @foreach($types as $type)


                                            <li @if($property->property_type==$type->id) class="active1 pt" @else class="pt" @endif style="width: auto;">

                                                <div class="type-holder-main">

                                                    <label style="padding: 13px;">

                                                        <input type="radio" name="property_type" @if($property->property_type==$type->id) checked="checked" @endif  value="{{$type->id}}">

                                                        <span style="padding-top: 0;">{{$type->types}}</span>

                                                    </label>

                                                </div>
                                            </li>

                                    @endforeach

                                @else

                                    <?php $x = 0; ?>

                                    @foreach($types as $type)

                                        @if($x == 0)


                                            <li @if(old('property_type') == $type->id) class="active1 pt" @elseif(old('property_type') == '') class="active1 pt" @else class="pt" @endif style="width: auto;">

                                                <div class="type-holder-main">

                                                    <label style="padding: 13px;">

                                                        <input type="radio" name="property_type" @if(old('property_type') == $type->id) checked="checked" @elseif(old('property_type') == '') checked="checked" @endif  value="{{$type->id}}">

                                                        <span style="padding-top: 0;">{{$type->types}}</span>

                                                    </label>

                                                </div>
                                            </li>

                                            <?php $x = $x + 1; ?>

                                            @else

                                                <li @if(old('property_type') == $type->id) class="active1 pt" @elseif(old('property_type') == '') class="pt" @else class="pt" @endif style="width: auto;">

                                                    <div class="type-holder-main">

                                                        <label style="padding: 13px;">

                                                            <input type="radio" name="property_type" @if(old('property_type') == $type->id) checked="checked" @endif  value="{{$type->id}}">

                                                            <span style="padding-top: 0;">{{$type->types}}</span>

                                                        </label>

                                                    </div>
                                                </li>

                                            @endif

                                    @endforeach

                                @endif



                                </ul>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:1px solid #e6e6e6;padding: 20px;margin: 25px 0px;">

                                    <h3>House Features</h3>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">TYPE OF HOUSE</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="house_type" id="house_type" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="Apartment" @if(old('house_type') == 'Apartment') selected @endif>Apartment</option>
                                                <option value="Penthouse" @if(old('house_type') == 'Penthouse') selected @endif>Penthouse</option>
                                                <option value="Room" @if(old('house_type') == 'Room') selected @endif>Room</option>
                                                <option value="Senior Residence" @if(old('house_type') == 'Senior Residence') selected @endif>Senior Residence</option>
                                                <option value="Villa" @if(old('house_type') == 'Villa') selected @endif>Villa</option>
                                                <option value="Semi-Detached" @if(old('house_type') == 'Semi-Detached') selected @endif>Semi-Detached</option>
                                                <option value="Single Family House (Middle House)" @if(old('house_type') == 'Single Family House (Middle House)') selected @endif>Single Family House (Middle House)</option>
                                                <option value="Single Family House (Corner House)" @if(old('house_type') == 'Single Family House (Corner House)') selected @endif>Single Family House (Corner House)</option>
                                            </select>



                                        </div>

                                    </div>

                                    @if(Route::currentRouteName() == 'addproperty')

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 25px 0px;">

                                        <label class="right-label" style="float: left;">TYPE OF CONSTRUCTION</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="construction_type" id="construction_type" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="New" @if(old('construction_type') == 'New') selected @endif>New</option>
                                                <option value="Old" @if(old('construction_type') == 'Old') selected @endif>Old</option>
                                            </select>



                                        </div>

                                    </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 20px 0px;">

                                        <label class="left-label" style="float: left;">YEAR OF CONSTRUCTION</label>

                                        <div  style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto">

                                            <input type="number" step="1" max="" name="year_construction" @if(old('year_construction') != '') value="{{old('year_construction')}}" @else value="{{ isset($property->year_construction) ? $property->year_construction : 1980 }}" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 25px 0px;">

                                        <label class="right-label" style="float: left;">CONDITION OF THE BUILDING</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="building_condition" id="building_condition" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="Very Good Condition" @if(old('building_condition') == 'Very Good Condition') selected @endif>Very Good Condition</option>
                                                <option value="Good Condition" @if(old('building_condition') == 'Good Condition') selected @endif>Good Condition</option>
                                                <option value="Needs Some Maintenance" @if(old('building_condition') == 'Needs Some Maintenance') selected @endif>Needs Some Maintenance</option>
                                            </select>

                                        </div>

                                    </div>

                                        @else

                                        <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 25px 0px;">

                                            <label class="right-label" style="float: left;">KIND OF TYPE</label>

                                            <div style="width: 100%;display: inline-block;margin: auto">

                                                <select name="kind_of_type" id="kind_of_type" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                    <option value="For Sale" @if(old('kind_of_type') == 'For Sale') selected @endif>For Sale</option>
                                                    <option value="To Rent Social" @if(old('kind_of_type') == 'To Rent Social') selected @endif>To Rent Social</option>
                                                    <option value="To Rent Free" @if(old('kind_of_type') == 'To Rent Free') selected @endif>To Rent Free</option>
                                                </select>



                                            </div>

                                        </div>

                                        <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 20px 0px;">

                                            <label class="left-label" style="float: left;">REALIZATION (Year)</label>

                                            <div  style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto">

                                                <input type="number" step="1" max="" name="realization" @if(old('realization') != '') value="{{old('realization')}}" @else value="{{ isset($property->realization) ? $property->realization : 1980 }}" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                            </div>

                                        </div>

                                        <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 20px 0px;">

                                            <label class="left-label" style="float: left;">HOW MANY BUY HOMES?</label>

                                            <div  style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto">

                                                <input type="number" step="1" max="" name="homes" @if(old('homes') != '') value="{{old('homes')}}" @else value="{{ isset($property->homes) ? $property->homes : 0 }}" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                            </div>

                                        </div>

                                        <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 20px 0px;">

                                            <label class="left-label" style="float: left;">HOW MANY RENTAL PROPERTIES?</label>

                                            <div  style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto">

                                                <input type="number" step="1" max="" name="rental_properties" @if(old('rental_properties') != '') value="{{old('rental_properties')}}" @else value="{{ isset($property->rental_properties) ? $property->rental_properties : 0 }}" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                                <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                                <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                            </div>

                                        </div>

                                        <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 25px 0px;">

                                            <label class="left-label" style="float: left;">SOURCE PROJECT</label>

                                            <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">


                                                <input type="text"  @if(old('source') != '') value="{{old('source')}}" @else value="{{ isset($property->source) ? $property->source : null }}" @endif name="source" placeholder="Source of project" class="quantity-field" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">

                                            </div>

                                        </div>

                                        <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                            <label class="left-label" style="float: left;">CITATION</label>

                                            <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">


                                                <input type="text" @if(old('citation') != '') value="{{old('citation')}}" @else value="{{ isset($property->citation) ? $property->citation : null }}" @endif name="citation" placeholder="Citation" class="quantity-field" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">

                                            </div>

                                        </div>


                                    @endif


                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">

                                    <label class="left-label" style="float: left;">BEDROOMS</label>

                                    <div  style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto">

                                        <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-bed"></i></div>

                                        <input type="number" step="1" max="" name="bedrooms" @if(old('bedrooms') != '') value="{{old('bedrooms')}}" @else value="{{ isset($property->bedrooms) ? $property->bathrooms : 1 }}" @endif class="quantity-field stepper-step-2-validate" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                        <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                        <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                    </div>

                                </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right">

                                        <label class="right-label" style="float: left;">BATHROOMS</label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-restroom"></i></div>

                                            <input type="number" step="1" max="" name="bathrooms" @if(old('bathrooms') != '') value="{{old('bathrooms')}}"  @else value="{{ isset($property->bathrooms) ? $property->bathrooms : 1 }}" @endif class="quantity-field stepper-step-2-validate" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>


                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block">

                                        <label class="right-label" style="float: left;">SQFT <small>(m2)</small></label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-crop-alt"></i></div>

                                            <input type="number" step="1" max="" name="area" @if(old('area') != '') value="{{old('area')}}" @else value="{{ isset($property->area) ? $property->area : null }}" @endif placeholder="800m2" class="quantity-field stepper-step-2-validate" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;float: right;">

                                        <label class="left-label" style="float: left;">VOLUME <small>(m3)</small></label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-arrows-alt-h"></i></div>

                                            <input type="number" step="1" max="" name="volume" @if(old('volume') != '') value="{{old('volume')}}" @else value="{{ isset($property->volume) ? $property->volume : null }}" @endif placeholder="800m3" class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>


                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">

                                        <label class="left-label" style="float: left;">NUMBER OF FLOORS</label>

                                        <div  style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-sort-numeric-up"></i></div>

                                            <input type="number" step="1" max="" name="floors" @if(old('floors') != '') value="{{old('floors')}}" @else value="{{ isset($property->floors) ? $property->floors : 1 }}" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:1px solid #e6e6e6;padding: 20px;margin: 25px 0px;">

                                    <h3>Outdoor Space Features</h3>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">BACKYARD <small>(m2)</small></label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">

                                            <input type="number" step="1" max="" @if(old('backyard') != '') value="{{old('backyard')}}" @else value="{{ isset($property->backyard) ? $property->backyard : null }}" @endif name="backyard" placeholder="800m2" class="quantity-field" style="border: 0;margin: 0;float: left;width: 70%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 25px 0px;">

                                        <label class="right-label" style="float: left;">FRONT YARD <small>(m2)</small></label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">

                                            <input type="number" step="1" max="" @if(old('frontyard') != '') value="{{old('frontyard')}}" @else value="{{ isset($property->frontyard) ? $property->frontyard : null }}" @endif name="frontyard" placeholder="800m2" class="quantity-field" style="border: 0;margin: 0;float: left;width: 70%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">GARAGE <small>(m2)</small></label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-warehouse"></i></div>

                                            <input type="number" step="1" max="" @if(old('garage') != '') value="{{old('garage')}}" @else value="{{ isset($property->garage) ? $property->garage : null }}" @endif name="garage" placeholder="800m2" class="quantity-field stepper-step-2-validate" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 25px 0px;">

                                        <label class="right-label" style="float: left;">TERRACE <small>(m2)</small></label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">

                                            <input type="number" step="1" max="" @if(old('terrace') != '') value="{{old('terrace')}}" @else value="{{ isset($property->terrace) ? $property->terrace : null }}" @endif name="terrace" placeholder="800m2" class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">TYPE OF GARAGE</label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">


                                            <input type="text"  @if(old('garage_type') != '') value="{{old('garage_type')}}" @else value="{{ isset($property->garage_type) ? $property->garage_type : null }}" @endif name="garage_type" placeholder="Type of garage" class="quantity-field" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">

                                        </div>

                                    </div>


                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:1px solid #e6e6e6;padding: 20px;margin: 25px 0px;">

                                    <h3>Energie</h3>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">ENERGY RATING</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="energy_rating" id="energy_rating" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="A+" @if(old('energy_rating') == 'A+') selected @endif>A+</option>
                                                <option value="A" @if(old('energy_rating') == 'A') selected @endif>A</option>
                                                <option value="B" @if(old('energy_rating') == 'B') selected @endif>B</option>
                                                <option value="C" @if(old('energy_rating') == 'C') selected @endif>C</option>
                                                <option value="D" @if(old('energy_rating') == 'D') selected @endif>D</option>
                                                <option value="E" @if(old('energy_rating') == 'E') selected @endif>E</option>
                                                <option value="F" @if(old('energy_rating') == 'F') selected @endif>F</option>
                                                <option value="G" @if(old('energy_rating') == 'G') selected @endif>G</option>
                                            </select>

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 20px 0px;">

                                        <label class="right-label" style="float: left;">SOLAR PANEL</label>

                                        <div  style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-sort-numeric-up"></i></div>

                                            <input type="number" step="1" max="" name="solar_panel" @if(old('solar_panel') != '') value="{{old('solar_panel')}}" @else value="{{ isset($property->solar_panel) ? $property->solar_panel : 1 }}" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">FLOORS</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="floor_option" id="floor_option" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="Yes" @if(old('floor') == 'Yes') selected @endif>Yes</option>
                                                <option value="No" @if(old('floor') == 'No') selected @endif>No</option>
                                                <option value="Partly" @if(old('floor') == 'Partly') selected @endif>Partly</option>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;float: right;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">WALLS</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="walls" id="walls" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="Yes" @if(old('walls') == 'Yes') selected @endif>Yes</option>
                                                <option value="No" @if(old('walls') == 'No') selected @endif>No</option>
                                                <option value="Partly" @if(old('walls') == 'Partly') selected @endif>Partly</option>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">ROOF INSULATION</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="roof_insulation" id="roof_insulation" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="Yes" @if(old('roof_insulation') == 'Yes') selected @endif>Yes</option>
                                                <option value="No" @if(old('roof_insulation') == 'No') selected @endif>No</option>
                                                <option value="Partly" @if(old('roof_insulation') == 'Partly') selected @endif>Partly</option>
                                            </select>

                                        </div>

                                    </div>


                                    <h3>Other Characteristics</h3>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">COOK</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="cook" id="cook" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="Gas" @if(old('cook') == 'Gas') selected @endif>Gas</option>
                                                <option value="Electricity" @if(old('cook') == 'Electricity') selected @endif>Electricity</option>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 20px 0px;">

                                        <label class="right-label" style="float: left;">TYPE OF BOILER</label>

                                        <div class="right-content" style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto;">

                                            <input type="text" @if(old('type_of_boiler') != '') value="{{old('type_of_boiler')}}" @else value="{{ isset($property->type_of_boiler) ? $property->type_of_boiler : null }}" @endif name="type_of_boiler" placeholder="Type of boiler" class="quantity-field" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="left-label" style="float: left;">TYPE OF AGREEMENT</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="agreement_type" id="agreement_type" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="Temporarily" @if(old('agreement_type') == 'Temporarily') selected @endif>Temporarily</option>
                                                <option value="Indefinitely" @if(old('agreement_type') == 'Indefinitely') selected @endif>Indefinitely</option>
                                            </select>

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;float: right;margin: 20px 0px;">

                                        <label class="right-label" style="float: left;">YEAR OF THE BOILER</label>

                                        <div  style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;border-right: 0;margin: auto">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-sort-numeric-up"></i></div>

                                            <input type="number" step="1" max="" name="year_boiler" @if(old('year_boiler') != '') value="{{old('year_boiler')}}" @else value="{{ isset($property->year_boiler) ? $property->year_boiler : 1980 }}" @endif class="quantity-field" style="border: 0;margin: 0;float: left;width: 50%;left: 0;height: 37.5px;text-align: left;font-weight: bold;padding-left: 20px;">
                                            <input type="button" value="+" class="button-plus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d7d7d7;margin-top: -0.1px;">
                                            <input type="button" value="-" class="button-minus" data-field="quantity-field" style="float: right;min-width: 15%;width: 15%;font-size: 15px;font-family: monospace;border-right: 1px solid #d1d1d1;margin-top: -0.1px;">

                                        </div>

                                    </div>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 right-div" style="display: inline-block;margin: 25px 0px;">

                                        <label class="right-label" style="float: left;">PROPERTY FURNISHED</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="property_furnished" id="property_furnished" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                                <option value="Unfurnished" @if(old('property_furnished') == 'Unfurnished') selected @endif>Unfurnished</option>
                                                <option value="Bare" @if(old('property_furnished') == 'Bare') selected @endif>Bare</option>
                                                <option value="Furnished" @if(old('property_furnished') == 'Furnished') selected @endif>Furnished</option>
                                            </select>

                                        </div>

                                    </div>


                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div style="width: 100%;display: inline-block;margin: auto">

                                        <ul style="list-style: none;display: inline-block;width: 100%;padding: 0;">


                                                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin: 20px 0px;text-align: left;">

                                                    <input name="wheelchair" @if(old('wheelchair') == 1) checked @endif value="1" type="checkbox" id="wheelchair" style="position: relative;top: 2px;">


                                                    <label class="bg" for="wheelchair">

                                                        <img src="{{ URL::asset('assets/img/signaling.png') }}" class="icon-feature" />

                                                        <span style="position: relative;top: 3px;font-size: 17px;">Wheelchair friendly home for people with walking difficulties</span>

                                                    </label>


                                                </li>


                                        </ul>

                                    </div>


                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 25px;">

                                    <label class="left-label" style="width: 100%;float: left;">OPEN HOUSE</label>

                                    <small style="display: block;">Scheduled period of time in which Property is designated to be open for viewing by potential buyers.</small>

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;text-align: left;margin-top: 0;margin-bottom: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-calendar-alt"></i></div>


                                        <input type='text' placeholder="Select Date" name="date" style="box-shadow: none;border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 0px;" class="form-control" value="{{old('date')}}" id='datetimepicker4' />


                                        </div>

                                    </div>

                                </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;float: right;text-align: right;margin-top: 0;">


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;float: left;text-align: center;">

                                        {{--<label class="left-label" style="width: 70%;float: left;">OPEN HOUSE</label>--}}

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-calendar-alt"></i></div>


                                            <input type='text' placeholder="Time From" name="time_from" style="box-shadow: none;border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 8px;padding-bottom: 5px;" value="{{old('time_from')}}" class="form-control" id='datetimepicker3' />


                                        </div>

                                    </div>


                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">

                                        {{--<label class="left-label" style="width: 70%;float: left;">OPEN HOUSE</label>--}}

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-calendar-alt"></i></div>


                                            <input type='text' placeholder="Time To" name="time_to" style="box-shadow: none;border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 8px;padding-bottom: 5px;" value="{{old('time_to')}}" class="form-control" id='datetimepicker2' />


                                        </div>

                                    </div>

                                </div>

                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">AVAILABLE IMMEDIATELY</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <select name="available_immediately" id="basic" class="selectpicker show-tick form-control" data-live-search="true" style="box-shadow: none;width: 100%;">
                                               <option value="1" @if(old('available_immediately') == 1) selected @endif>Yes</option>
                                                <option value="0" @if(old('available_immediately') == 0) selected @endif>No</option>
                                            </select>



                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-5 col-md-5 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">AVAILABLE FROM</label>


                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div style="width:20%;float: left;margin-top: 7px;text-align: center;"><i class="fas fa-calendar-alt"></i></div>


                                            <input type='text' placeholder="Select Date" name="available_from" style="box-shadow: none;border: 0;margin: 0;float: left;width: 80%;left: 0;height: 37.5px;text-align: left;padding-left: 0px;" class="form-control" value="{{old('available_from')}}" id='datetimepicker5' />


                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 20px;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;width: 100%;">PROPERTY FEATURES</label>

                                        <small style="display: block;">Please list the key features of your property this is a good oppurtunity to sell your property!</small>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                        <ul style="list-style: none;display: inline-block;width: 100%;padding: 0;padding-top: 30px;">

                                            <?php $i = 0; ?>

                                            @foreach($property_features as $key)

                                                <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding: 0;margin: 20px 0px;text-align: left;">

                                                    <input name="property_features[]" value="{{$key->id}}" type="checkbox" id="property_features{{$i}}" style="position: relative;top: 2px;">


                                                    <label class="bg" for="property_features{{$i}}">

                                                        <img src="{{ URL::asset('assets/img/'.$key->icon) }}" class="icon-feature" />

                                                        <span style="position: relative;top: 3px;font-size: 17px;">{{$key->text}}</span>

                                                    </label>


                                                </li>

                                                <?php $i = $i + 1; ?>

                                            @endforeach



                                        </ul>

                                        </div>

                                    </div>

                                </div>


                            </div>





                            {{--<div class="form-group">
                                <label for="" class="col-sm-3 control-label">Property Type</label>
                                <div class="col-sm-4">
                                    <select name="property_type" id="basic" class="selectpicker show-tick form-control" data-live-search="true">

                                        @if(isset($property->property_type))

                                            @foreach($types as $type)
                                                <option value="{{$type->id}}" @if($property->property_type==$type->id) selected @endif>{{$type->types}}</option>

                                            @endforeach

                                        @else

                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->types}}</option>

                                            @endforeach

                                        @endif

                                    </select>
                                </div>
                            </div>--}}


                            {{--<div class="form-group">
                                <label for="" class="col-sm-3 control-label">Purpose</label>
                                <div class="col-sm-4">
                                    <select name="property_purpose" id="basic" class="selectpicker show-tick form-control" data-live-search="true" >
                                        @if(isset($property->property_purpose))

                                            <option value="Sale" @if($property->property_purpose=='Sale') selected @endif>Sale</option>
                                            <option value="Rent" @if($property->property_purpose=='Rent') selected @endif>Rent</option>

                                        @else

                                            <option value="Sale">Sale</option>
                                            <option value="Rent">Rent</option>

                                        @endif

                                    </select>
                                </div>
                            </div>--}}



                            <ul class="list-inline pull-right">

                                @if(Route::currentRouteName() != 'addnewconstruction')
                                <li>
                                    <a class="btn btn-default prev-step">Back</a>
                                </li>
                                @endif

                                <li>
                                    <a class="btn btn-primary next-step" data-id="stepper-step-2">Next</a>
                                </li>
                            </ul>
                        </div>


                        <div class="tab-pane fade" role="tabpanel" id="stepper-step-3">

                            <div class="form-group main-div" style="width: 90%;margin: auto;">

                                @if(Route::currentRouteName() == 'addnewconstruction')

                                    <h2>Step 2: Property Description & Price</h2>

                                    @else

                                    <h2>Step 3: Property Description & Price</h2>

                                    @endif


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 40px;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Property Name</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                            <input type="text" placeholder="Property Title" name="property_name" @if(old('property_name')) value="{{old('property_name')}}" @else value="{{ isset($property->property_name) ? $property->property_name : null }}" @endif style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control stepper-step-3-validate"  >


                                        </div>

                                    </div>

                                </div>




                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Property Slug</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                            <input type="text" placeholder="Property Slug" name="property_slug" @if(old('property_slug')) value="{{old('property_slug')}}" @else value="{{ isset($property->property_slug) ? $property->property_slug : null }}" @endif style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control"  >


                                        </div>

                                    </div>

                                </div>

                                @if(old('property_purpose') == 'Sale')

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;" id="sale_price_box">

                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                            <label class="left-label" style="float: left;">Sale Price</label>

                                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                                <input type="number" id="sale_price_field" name="sale_price" @if(old('sale_price')) value="{{old('sale_price')}}" @else value="{{ isset($property->sale_price) ? $property->sale_price : null }}" @endif placeholder="800000" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control stepper-step-3-validate"  >


                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;display: none;" id="rent_price_box">

                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                            <label class="left-label" style="float: left;">Rent Price</label>

                                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                                <input type="number" id="rent_price_field" name="rent_price" @if(old('rent_price')) value="{{old('rent_price')}}" @else value="{{ isset($property->rent_price) ? $property->rent_price : null }}" @endif placeholder="10000" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control"  >


                                            </div>

                                        </div>

                                    </div>

                                    @elseif(old('property_purpose') == 'Rent')

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;display: none;" id="sale_price_box">

                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                            <label class="left-label" style="float: left;">Sale Price</label>

                                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                                <input type="number" id="sale_price_field" name="sale_price" @if(old('sale_price')) value="{{old('sale_price')}}" @else value="{{ isset($property->sale_price) ? $property->sale_price : null }}" @endif placeholder="800000" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control"  >


                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;" id="rent_price_box">

                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                            <label class="left-label" style="float: left;">Rent Price</label>

                                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                                <input type="number" id="rent_price_field" name="rent_price" @if(old('rent_price')) value="{{old('rent_price')}}" @else value="{{ isset($property->rent_price) ? $property->rent_price : null }}" @endif placeholder="10000" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control stepper-step-3-validate"  >


                                            </div>

                                        </div>

                                    </div>

                                    @else

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;" id="sale_price_box">

                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                            <label class="left-label" style="float: left;">Sale Price</label>

                                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                                <input type="number" id="sale_price_field" name="sale_price" @if(old('sale_price')) value="{{old('sale_price')}}" @else value="{{ isset($property->sale_price) ? $property->sale_price : null }}" @endif placeholder="800000" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control stepper-step-3-validate"  >


                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;display: none;" id="rent_price_box">

                                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                            <label class="left-label" style="float: left;">Rent Price</label>

                                            <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                                <input type="number" id="rent_price_field" name="rent_price" @if(old('rent_price')) value="{{old('rent_price')}}" @else value="{{ isset($property->rent_price) ? $property->rent_price : null }}" @endif placeholder="10000" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control"  >


                                            </div>

                                        </div>

                                    </div>

                                    @endif



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Description</label>

                                        <div style="width: 100%;display: inline-block;margin: auto">

                                            <textarea name="description" rows="10" class="form-control stepper-step-3-validate summernote">@if(old('description')) {{old('description')}} @else {{ isset($property->description) ? $property->description : null }} @endif</textarea>


                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">KEYWORDS/TAGS</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                            <input type="text" name="property_keywords" @if(old('property_keywords')) value="{{old('property_keywords')}}" @endif placeholder="Keywords" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;" data-role="tagsinput tag-primary" class="form-control">


                                        </div>

                                    </div>

                                </div>


                            </div>



                            <ul class="list-inline pull-right">
                                <li>
                                    <a class="btn btn-default prev-step">Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-primary next-step" data-id="stepper-step-3">Next</a>
                                </li>
                            </ul>

                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="stepper-step-4">

                            <div class="form-group main-div" style="width: 90%;margin: auto;">

                                @if(Route::currentRouteName() == 'addnewconstruction')

                                    <h2>Step 3: Address/Location & Photos</h2>

                                    @else

                                    <h2>Step 4: Address/Location & Photos</h2>

                                    @endif


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 40px;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Address</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <input type="text" id="address-input" placeholder="Enter Address" name="address" @if(old('address')) value="{{old('address')}}" @else value="{{ isset($property->address) ? $property->address : null }}" @endif style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;"  class="form-control map-input stepper-step-4-validate">
                                            <input type="hidden" name="address_latitude" id="address-latitude" @if(old('address_latitude')) value="{{old('address_latitude')}}" @else value="52.3666969" @endif />
                                            <input type="hidden" name="address_longitude" id="address-longitude" @if(old('address_longitude')) value="{{old('address_longitude')}}" @else value="4.8945398" @endif  />

                                        </div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <div id="address-map-container" style="width:100%;height:400px; ">
                                            <div style="width: 100%; height: 100%" id="address-map"></div>
                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">City</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">


                                            @if(isset($property->city_id))


                                                @foreach($city_list as $city)

                                                    @if($property->city_id==$city->id)

                                                        <input type="text" value="{{$city->city_name}}" readonly id="city_name" name="city_name" class="form-control stepper-step-4-validate" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;">

                                                        @endif


                                                @endforeach

                                            @else

                                                <input type="text" id="city_name" name="city_name" @if(old('city_name')) value="{{old('city_name')}}" @endif readonly class="form-control stepper-step-4-validate" style="border: 0;margin: 0;float: left;width: 100%;left: 0;height: 37.5px;text-align: left;padding-left: 20px;box-shadow: none;">


                                            @endif

                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Featured Image</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                <div class="media-left">
                                                    @if(isset($property->featured_image))

                                                        <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>
                                                <div class="media-body media-middle">
                                                    <input type="file" name="featured_image"  class="filestyle stepper-step-4-validate" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Property Image 1</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                <div class="media-left">
                                                    @if(isset($property->property_images1) and $property->property_images1!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images1.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>
                                                <div class="media-body media-middle">
                                                    @if(isset($property->property_images1) and $property->property_images1!='')
                                                        <div class="media-left"><a href="#" class="btn btn-default btn-rounded"><i class="md md-delete"></i></a></div><br />
                                                    @endif

                                                    <input type="file" name="property_images1" class="filestyle" style="width: 50%;border: none;float: left;">

                                                        <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                            <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                        </button>


                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Property Image 2</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                <div class="media-left">
                                                    @if(isset($property->property_images2) and $property->property_images2!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images2.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>
                                                <div class="media-body media-middle">
                                                    <input type="file" name="property_images2" class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>


                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Property Image 3</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                <div class="media-left">
                                                    @if(isset($property->property_images3) and $property->property_images3!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images3.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>
                                                <div class="media-body media-middle">
                                                    <input type="file" name="property_images3" class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Property Image 4</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                <div class="media-left">
                                                    @if(isset($property->property_images4) and $property->property_images4!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images4.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>
                                                <div class="media-body media-middle">
                                                    <input type="file" name="property_images4" class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>


                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Property Image 5</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                <div class="media-left">
                                                    @if(isset($property->property_images5) and $property->property_images5!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>
                                                <div class="media-body media-middle">
                                                    <input type="file" name="property_images5" class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">Video Upload</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                {{--<div class="media-left">
                                                    @if(isset($property->property_images5) and $property->property_images5!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>--}}
                                                <div class="media-body media-middle">
                                                    <input type="file" name="video" class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;">


                                        <label class="left-label" style="float: left;">File Documents</label>

                                        <div style="display:inline-block;width: 100%;"><small>Press &amp; hold CTRL key to select multiple files.</small></div>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                {{--<div class="media-left">
                                                    @if(isset($property->property_images5) and $property->property_images5!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>--}}
                                                <div class="media-body media-middle">
                                                    <input type="file" name="documents[]" multiple class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>


                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #d9d9d9;padding: 15px 30px;margin-top: 35px;">

                                    <h4 style="text-align: center;">Floor Plans</h4>

                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin-top: 0px;">


                                        <label class="left-label" style="float: left;">First Floor</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                {{--<div class="media-left">
                                                    @if(isset($property->property_images5) and $property->property_images5!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>--}}
                                                <div class="media-body media-middle">

                                                    <input type="file" name="first_floor" multiple class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin-top: 0px;">


                                        <label class="left-label" style="float: left;">Second Floor</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                {{--<div class="media-left">
                                                    @if(isset($property->property_images5) and $property->property_images5!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>--}}
                                                <div class="media-body media-middle">
                                                    <input type="file" name="second_floor" multiple class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin-top: 0px;">


                                        <label class="left-label" style="float: left;">Ground Floor</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                {{--<div class="media-left">
                                                    @if(isset($property->property_images5) and $property->property_images5!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>--}}
                                                <div class="media-body media-middle">
                                                    <input type="file" name="ground_floor" multiple class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left-div" style="display: inline-block;margin-top: 0px;">


                                        <label class="left-label" style="float: left;">Basement</label>

                                        <div style="width: 100%;display: inline-block;border: 1px solid #d7d7d7;margin: auto">

                                            <div class="media">
                                                {{--<div class="media-left">
                                                    @if(isset($property->property_images5) and $property->property_images5!='')

                                                        <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" width="150" alt="person">

                                                    @endif

                                                </div>--}}
                                                <div class="media-body media-middle">
                                                    <input type="file" name="basement" multiple class="filestyle" style="width: 50%;border: none;float: left;">

                                                    <button type="button" class="remove-btn" style="outline: none;border: 0;color: red;float: right;font-size: 21px;background: transparent;padding: 10px 5px;margin-right: 5px;">

                                                        <i aria-hidden="true" class="fas fa-times-circle" style="position:relative;top: 1px;"></i>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <hr>


                            <ul class="list-inline pull-right">
                                <li>
                                    <a class="btn btn-default prev-step">Back</a>
                                </li>
                                <li>
                                    <button type="button" data-id="stepper-step-4" class="btn btn-primary submit-form">{{ isset($property->property_name) ? 'Edit Property' : 'Add Property' }}</button>
                                </li>
                            </ul>

                        </div>



                    </div>
                {!! Form::close() !!}
            </div>



        </div>
    </div>



	{{--<div class="page-header">
		<h2> {{ isset($property->property_name) ? 'Edit: '. $property->property_name : 'Add Property' }}</h2>

		<a href="{{ URL::to('admin/properties') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

	</div>--}}





</div>


    <style>

        .icon-feature
        {
            width: 30px;
            position: relative;
            top:-1px;
            margin-right: 6px;
        }

        tr.bg_color  {
            background-color: #edf671 !important;
        }

        [type="checkbox"]:not(:checked),
        [type="checkbox"]:checked {
            position: absolute;
            left: -9999px;
        }
        [type="checkbox"]:not(:checked) + label,
        [type="checkbox"]:checked + label {
            position: relative;
            padding-left: 1.95em;
            cursor: pointer;
            font-weight: 600;
        }

        /* checkbox aspect */
        [type="checkbox"]:not(:checked) + label:before,
        [type="checkbox"]:checked + label:before {
            content: '';
            position: absolute;
            left: 0; top: 9.5px;
            width: 15px; height: 15px;
            border: 2px solid #ccc;
            background: #fff;
            border-radius: 4px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
        }
        /* checked mark aspect */
        [type="checkbox"]:not(:checked) + label:after,
        [type="checkbox"]:checked + label:after {
            content: '\2713\0020';
            position: absolute;
            top: 12.5px; left: 2px;
            font-size: 1.0em;
            line-height: 0.8;
            color: #09ad7e;
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
            border: 2px solid #4778d9!important;
        }

        .bootstrap-tagsinput
        {
            width: 100%;
        }

        .note-video-btn
        {
            background: green !important;
        }

        .validate-error
        {
            border: 1px solid #e02727 !important;
            border-right: 1px solid #e02727 !important;
        }

        .form-group{ width: 90%;margin: auto;}

        @media (max-width: 735px) {

            #main {
                width: 75% !important;
            }
        }


        @media (max-width: 767px) {

            .pp {

                margin-left: 0 !important;
            }
        }

        @media (max-width: 991px)
        {



            .right-label, .left-label, .right-content{
                float: none !important;
            }

            .left-div, .right-div, .main-div{

                text-align: center;

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

        .stepper .nav-tabs {
            position: relative;
        }
        .stepper .nav-tabs > li {
            width: 25%;
            position: relative;
        }
        .stepper .nav-tabs > li:after {
            content: '';
            position: absolute;
            background: #f1f1f1;
            display: block;
            width: 100%;
            height: 5px;
            top: 30px;
            left: 50%;
            z-index: 1;
        }
        .stepper .nav-tabs > li.completed::after {
            background: #34bc9b;
        }
        .stepper .nav-tabs > li:last-child::after {
            background: transparent;
        }
        .stepper .nav-tabs > li.active:last-child .round-tab {
            background: #34bc9b;
        }
        .stepper .nav-tabs > li.active:last-child .round-tab::after {
            content: '✔';
            color: #fff;
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            top: 0;
            display: block;
        }
        .stepper .nav-tabs [data-toggle='tab'] {
            width: 25px;
            height: 25px;
            margin: 20px auto;
            border-radius: 100%;
            border: none;
            padding: 0;
            color: #f1f1f1;
        }
        .stepper .nav-tabs [data-toggle='tab']:hover {
            background: transparent;
            border: none;
        }
        .stepper .nav-tabs > .active > [data-toggle='tab'], .stepper .nav-tabs > .active > [data-toggle='tab']:hover, .stepper .nav-tabs > .active > [data-toggle='tab']:focus {
            color: #34bc9b;
            cursor: default;
            border: none;
        }
        .stepper .tab-pane {
            position: relative;
            padding-top: 50px;
        }
        .stepper .round-tab {
            width: 25px;
            height: 25px;
            line-height: 22px;
            display: inline-block;
            border-radius: 25px;
            background: #fff;
            border: 2px solid #34bc9b;
            color: #34bc9b;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 14px;
        }
        .stepper .completed .round-tab {
            background: #34bc9b;
        }
        .stepper .completed .round-tab::after {
            content: '✔';
            color: #fff;
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            top: 0;
            display: block;
        }
        .stepper .active .round-tab {
            background: #fff;
            border: 2px solid #34bc9b;
        }
        .stepper .active .round-tab:hover {
            background: #fff;
            border: 2px solid #34bc9b;
        }
        .stepper .active .round-tab::after {
            display: none;
        }
        .stepper .disabled .round-tab {
            background: #fff;
            color: #f1f1f1;
            border-color: #f1f1f1;
        }
        .stepper .disabled .round-tab:hover {
            color: #4dd3b6;
            border: 2px solid #a6dfd3;
        }
        .stepper .disabled .round-tab::after {
            display: none;
        }

        ul.property-radios li{
            display: inline-block; margin: 0; padding: 0; vertical-align: top;
        }

        li{ list-style: none; }

        .type-holder-main{ position: relative; }

        ul.property-radios li input{ display: none; }

        ul.property-radios li label {  -webkit-transition: all .5s ease-in-out; transition: all .5s ease-in-out ;overflow: hidden; padding: 20px; cursor: pointer; border: solid 1px #dddddd; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; background-color: #fff;text-align: center; }

        .user-holder.create-property-holder ul.property-radios li label { display: block; min-height: 55px; }


        ul.property-radios li label span { padding-top: 15px;font-size: 13px; font-weight: 700; line-height: 19px; display: block; width: 100%; text-align: center; color: #5a2e8a !important; }


        li.active1 > div > label, label:hover{

            border-color: #5a2e8a !important;

        }

        .dropdown-menu{ position:absolute;top:100%;left:0;z-index:1000;display:none;
            float:left;min-width:160px;padding:5px 0;margin:2px 0 0;font-size:14px;
            text-align:left;list-style:none;-webkit-background-clip:padding-box;
            background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,.15);
            border-radius:4px;-webkit-box-shadow:0 6px 12px rgba(0,0,0,.175);
            box-shadow:0 6px 12px rgba(0,0,0,.175) }

        .bootstrap-tagsinput {
            display: inline-block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;
            max-width: 100%;
            line-height: 22px;
            cursor: text;
        }
        .bootstrap-tagsinput input {
            border: none;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            padding: 0;
            margin: 0;
            width: auto !important;
            max-width: inherit;
            vertical-align: middle;
        }
        .bootstrap-tagsinput input:focus {
            border: none;
            box-shadow: none;
        }
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #fff;
        }
        .bootstrap-tagsinput .tag [data-role="remove"] {
            margin-left: 8px;
            cursor: pointer;
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "x";
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:hover {
            box-shadow: none;
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
            box-shadow: none;
        }

    </style>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>


    <script>


        $(document).ready(function() {



            $(".remove-btn").on('click', function() {

                $(this).prev().val('');

            });

            $(".submit-form").on('click', function() {


                var step = $(this).data('id');

                var check = 0;


                $('#' + step + ' .' + step + '-validate').map(function() {

                    if(!$(this).val())
                    {
                        $(this).parent().addClass('validate-error');
                        check = 1;
                    }
                    else
                    {
                        $(this).parent().removeClass('validate-error');
                    }

                });

                if(!check)
                {
                    $("#property_form").submit();
                }
                else{

                    document.body.scrollTop = document.documentElement.scrollTop = 100;
                }

            });

            var eltPrimary = $('[data-role="tagsinput tag-primary"]');
            eltPrimary.tagsinput({
                tagClass: 'label label-primary'
            });

            var eltDefault = $('[data-role="tagsinput tag-default"]');
            eltDefault.tagsinput({
                tagClass: 'label label-default'
            });

            var eltDanger = $('[data-role="tagsinput tag-danger"]');
            eltDanger.tagsinput({
                tagClass: 'label label-danger'
            });

                initialize();


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

            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                }
            });


            $('#datetimepicker4').datetimepicker({format: 'DD/MM/YYYY'});

            $('#datetimepicker4').on('dp.change', function(e){

                if($(this).val()){

                    $('#datetimepicker2').addClass('stepper-step-2-validate');
                    $('#datetimepicker3').addClass('stepper-step-2-validate');

            }
                else
                {

                    $('#datetimepicker2').parent().removeClass('validate-error');
                    $('#datetimepicker3').parent().removeClass('validate-error');

                    $('#datetimepicker2').removeClass('stepper-step-2-validate');
                    $('#datetimepicker3').removeClass('stepper-step-2-validate');
                }

            });

            $('#datetimepicker5').datetimepicker({format: 'DD/MM/YYYY'});

            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });

            $('#datetimepicker2').datetimepicker({
                format: 'LT'
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

            $('.input-group').on('click', '.button-plus', function(e) {
                incrementValue(e);
            });

            $('.input-group').on('click', '.button-minus', function(e) {
                decrementValue(e);
            });


            $('input[name=property_purpose]').change(function(){


                $('.pp').removeClass('active1');

                $(this).parent().closest('li').addClass('active1');

                if( $(this).val() == "Sale" )
                {
                    $('#rent_price_box').hide();
                    $('#rent_price_field').removeClass('stepper-step-3-validate');
                    $('#sale_price_box').show();
                    $('#sale_price_field').addClass('stepper-step-3-validate');
                }
                else
                {
                    $('#sale_price_box').hide();
                    $('#sale_price_field').removeClass('stepper-step-3-validate');
                    $('#rent_price_box').show();
                    $('#rent_price_field').addClass('stepper-step-3-validate');

                }

            });

            $('#kind_of_type').change(function(){

                if( $(this).val() == "For Sale" )
                {
                    $('#rent_price_box').hide();
                    $('#rent_price_field').removeClass('stepper-step-3-validate');
                    $('#sale_price_box').show();
                    $('#sale_price_field').addClass('stepper-step-3-validate');
                }
                else if( $(this).val() == "To Rent Social" || $(this).val() == "To Rent Free" )
                {
                    $('#sale_price_box').hide();
                    $('#sale_price_field').removeClass('stepper-step-3-validate');
                    $('#rent_price_box').show();
                    $('#rent_price_field').addClass('stepper-step-3-validate');

                }

            });


            $('input[name=property_type]').change(function(){

                $('.pt').removeClass('active1');

                $(this).parent().closest('li').addClass('active1');

            });

            var $global = 0;

            function triggerClick(elem) {

                $(elem).click();
            }
            var $progressWizard = $('.stepper'),
                $tab_active,
                $tab_prev,
                $tab_next,
                $btn_prev = $progressWizard.find('.prev-step'),
                $btn_next = $progressWizard.find('.next-step'),
                $tab_toggle = $progressWizard.find('[data-toggle="tab"]'),
                $tooltips = $progressWizard.find('[data-toggle="tab"][title]');

            // To do:
            // Disable User select drop-down after first step.
            // Add support for payment type switching.

            //Initialize tooltips
            $tooltips.tooltip();

            //Wizard
            /*  $tab_toggle.on('show.bs.tab', function(e) {

                  return false;


              });*/

            $tab_toggle.on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            });

            $btn_next.on('click', function() {

                document.body.scrollTop = document.documentElement.scrollTop = 100;

                var step = $(this).data('id');

                var check = 0;


                $('#' + step + ' .' + step + '-validate').map(function() {

                    if(!$(this).val())
                    {
                        $(this).parent().addClass('validate-error');
                        check = 1;
                    }
                    else
                    {
                        $(this).parent().removeClass('validate-error');
                    }

                });

                if(!check)
                {


                    $tab_active = $progressWizard.find('.active');

                    $tab = $tab_active.next().find('[data-content]').attr("data-content");

                    $section = $('.tab-content').find('#'+$tab);

                    $('.tab-content').find('.active').removeClass('in').removeClass('active');

                    $section.addClass('active');

                    window.setTimeout(function(){$section.addClass('in');}, 80);

                    $tab_active.next().removeClass('disabled');
                    $tab_active.next().addClass('active');

                    $tab_next = $tab_active.next().find('a[data-toggle="tab"]');

                    var $target = $tab_next;


                    if (!$target.parent().hasClass('active, disabled')) {
                        $target.parent().prev().removeClass('active');
                        $target.parent().prev().addClass('completed');
                    }
                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }



                }


            });
            $btn_prev.click(function() {

                $tab_active = $progressWizard.find('.active');

                $tab = $tab_active.prev().find('[data-content]').attr("data-content");

                $section = $('.tab-content').find('#'+$tab);

                $('.tab-content').find('.active').removeClass('in').removeClass('active');

                $section.addClass('active');

                window.setTimeout(function(){$section.addClass('in');}, 80);

                $tab_active.prev().removeClass('completed');
                $tab_active.prev().addClass('active');

                $tab_next = $tab_active.next().find('a[data-toggle="tab"]');

                var $target = $tab_next;

                if($target.length)
                {
                    if (!$target.parent().hasClass('active, disabled')) {
                        $target.parent().prev().removeClass('active');
                        $target.parent().prev().addClass('disabled');
                    }

                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }
                }
                else
                {
                    $tab_active.removeClass('active');
                    $tab_active.addClass('disabled');
                }

            });
        });



    </script>

@endsection
