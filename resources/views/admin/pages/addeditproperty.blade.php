@extends("app")

@section('head_title', 'Add New Property | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        <h2>Add New Property</h2>
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

<div id="main" style="width: 70%;margin: auto;margin-top: 25px;">


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

                </ul>

                {!! Form::open(array('url' => array('admin/properties/addproperty'),'class'=>'form-horizontal padding-15','name'=>'property_form','id'=>'property_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($property->id) ? $property->id : null }}">

                    <div class="tab-content">

                        <div class="tab-pane fade in active" role="tabpanel" id="stepper-step-1">

                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Property Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="property_name" value="{{ isset($property->property_name) ? $property->property_name : null }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Property Slug</label>
                                <div class="col-sm-9">
                                    <input type="text" name="property_slug" value="{{ isset($property->property_slug) ? $property->property_slug : null }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
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
                            </div>

                            <ul class="list-inline pull-right">
                                <li>
                                    <a class="btn btn-default prev-step">Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-primary next-step">Next</a>
                                </li>
                            </ul>

                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="stepper-step-2">


                            <div class="form-group">
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
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Bedrooms</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bedrooms" value="{{ isset($property->bedrooms) ? $property->bedrooms : null }}" class="form-control" placeholder="4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Bathrooms</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bathrooms" value="{{ isset($property->bathrooms) ? $property->bathrooms : null }}" class="form-control" placeholder="3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Area</label>
                                <div class="col-sm-9">
                                    <input type="text" name="area" value="{{ isset($property->area) ? $property->area : null }}" class="form-control" placeholder="800m2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Sale Price</label>
                                <div class="col-sm-9">
                                    <input type="text" name="sale_price" value="{{ isset($property->sale_price) ? $property->sale_price : null }}" class="form-control" placeholder="800000">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Rent Price</label>
                                <div class="col-sm-9">
                                    <input type="text" name="rent_price" value="{{ isset($property->rent_price) ? $property->rent_price : null }}" class="form-control" placeholder="10000">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Property Features</label>
                                <div class="col-sm-9">
                                    <input type="text" name="property_features" value="{{ isset($property->property_features) ? $property->property_features : null }}" data-role="tagsinput tag-primary" class="form-control" placeholder="{{ isset($property->property_features) ? null : 'Balcony,Internet' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">

                                    <textarea name="description" rows="10" class="form-control summernote">{{ isset($property->description) ? $property->description : null }}</textarea>
                                </div>
                            </div>


                            <ul class="list-inline pull-right">
                                <li>
                                    <a class="btn btn-default prev-step">Back</a>
                                </li>
                                <li>
                                    <a class="btn btn-primary next-step">Next</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="stepper-step-3">

                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">

                                    <textarea name="address" rows="3" class="form-control">{{ isset($property->address) ? $property->address : null }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="usertype" class="col-sm-3 control-label">City</label>
                                <div class="col-sm-4">
                                    <select name="city_id" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                        @if(isset($property->city_id))

                                            @foreach($city_list as $city)
                                                <option value="{{$city->id}}" @if($property->city_id==$city->id) selected @endif>{{$city->city_name}}</option>

                                            @endforeach

                                        @else

                                            @foreach($city_list as $city)
                                                <option value="{{$city->id}}">{{$city->city_name}}</option>

                                            @endforeach

                                        @endif
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-3 control-label">Featured Image</label>
                                <div class="col-sm-9">
                                    <div class="media">
                                        <div class="media-left">
                                            @if(isset($property->featured_image))

                                                <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" width="150" alt="person">

                                            @endif

                                        </div>
                                        <div class="media-body media-middle">
                                            <input type="file" name="featured_image" class="filestyle">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-3 control-label">Property Image 1</label>
                                <div class="col-sm-9">
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

                                            <input type="file" name="property_images1" class="filestyle">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-3 control-label">Property Image 2</label>
                                <div class="col-sm-9">
                                    <div class="media">
                                        <div class="media-left">
                                            @if(isset($property->property_images2) and $property->property_images2!='')

                                                <img src="{{ URL::asset('upload/properties/'.$property->property_images2.'-b.jpg') }}" width="150" alt="person">

                                            @endif

                                        </div>
                                        <div class="media-body media-middle">
                                            <input type="file" name="property_images2" class="filestyle">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-3 control-label">Property Image 3</label>
                                <div class="col-sm-9">
                                    <div class="media">
                                        <div class="media-left">
                                            @if(isset($property->property_images3) and $property->property_images3!='')

                                                <img src="{{ URL::asset('upload/properties/'.$property->property_images3.'-b.jpg') }}" width="150" alt="person">

                                            @endif

                                        </div>
                                        <div class="media-body media-middle">
                                            <input type="file" name="property_images3" class="filestyle">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-3 control-label">Property Image 4</label>
                                <div class="col-sm-9">
                                    <div class="media">
                                        <div class="media-left">
                                            @if(isset($property->property_images4) and $property->property_images4!='')

                                                <img src="{{ URL::asset('upload/properties/'.$property->property_images4.'-b.jpg') }}" width="150" alt="person">

                                            @endif

                                        </div>
                                        <div class="media-body media-middle">
                                            <input type="file" name="property_images4" class="filestyle">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-sm-3 control-label">Property Image 5</label>
                                <div class="col-sm-9">
                                    <div class="media">
                                        <div class="media-left">
                                            @if(isset($property->property_images5) and $property->property_images5!='')

                                                <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" width="150" alt="person">

                                            @endif

                                        </div>
                                        <div class="media-body media-middle">
                                            <input type="file" name="property_images5" class="filestyle">
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
                                    <button type="submit" class="btn btn-primary">{{ isset($property->property_name) ? 'Edit Property' : 'Add Property' }}</button>
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

    </style>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script>


        $(document).ready(function() {

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


                if (!$target.parent().hasClass('active, disabled')) {
                    $target.parent().prev().removeClass('active');
                    $target.parent().prev().addClass('disabled');
                }
                if ($target.parent().hasClass('disabled')) {
                    return false;
                }


            });
        });



    </script>

@endsection
