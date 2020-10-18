@extends("app")

@section('head_title', 'Properties | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

 <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            {{--<div class="quick-search">
              <div class="row">
                {!! Form::open(array('url' => array('search'),'name'=>'search_form','id'=>'search_form','role'=>'form')) !!}
                  <div class="col-md-3 col-sm-3 col-xs-6">

                      <div class="form-group">
                          <label for="city">City</label>

                          <input class="form-control city-input" type="text" placeholder="City, State, Address" name="city_name" id="city-input" autocomplete="off">

                          <input type="hidden" name="city_latitude" id="city-latitude"  />
                          <input type="hidden" name="city_longitude" id="city-longitude"  />

                      </div>

                  </div>
                  <!-- break -->
                  <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control" name="purpose">
                        <option value="Sale">For Sale</option>
                        <option value="Rent">For Rent</option>
                      </select>
                    </div>

                  </div>
                  <!-- break -->
                  <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                      <label for="type">Type</label>
                      <select class="form-control" name="type">
                        @foreach(\App\Types::orderBy('types')->get() as $type)
                        <option value="{{$type->id}}">{{$type->types}}</option>
						@endforeach

                      </select>
                    </div>

                  </div>
                  <!-- break -->
                  <div class="col-md-3 col-sm-3 col-xs-6">

                    <div class="form-group">
                      <label for="maxprice">&nbsp;</label>
                      <input type="submit" name="submit" value="Search Again" class="btn btn-primary btn-block">
                    </div>
                  </div>

                {!! Form::close() !!}
              </div>
            </div>--}}

              <div class="page-title">
                  <h2>{{__('text.Search Results')}}</h2>
              </div>

            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>
              <li class="active">{{__('text.Search')}}</li>
            </ol>
          </div>
        </div>

      </div>
    </div>
    <!-- end:header -->

    <!-- begin:content -->
    <div id="content">

      <div class="container">
        <div class="row">
          <!-- begin:article -->
          <div class="col-md-9 col-md-push-3">

              @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions')

                  <h5 style="margin-top: 0;padding: 0px 10px;font-weight: 600;">{{__('text.Is there no home that makes you happy?')}}</h5>

              @endif

              <div class="properties-ordering-wrapper">

                  <div class="results-count" style="font-size: 18px;display: inline-block;padding-top: 5px;">{{__('text.Results')}} {{count($properties)}} {{__('text.properties found')}}</div>

                  <button type="button" value="Filters" href="#myModal1" data-toggle="modal" class="btn btn-primary filter-button" style="float: right;color: black;background: white;border-color: #9f9c9c;outline: none;display: none;">
                      <span>
                          <img src="{{ URL::asset('assets/img/Filter-512.png') }}" aria-hidden="true" style="margin-right: 5px;width: 15px;margin-top: -1px;">
                          <span style="font-size: 13px;">Filters</span>
                      </span>
                  </button>

              </div>

            <!-- begin:product -->

                @if(count($properties) == 0)
                    <h1>{{__('text.No Properties found...')}}</h1>
                @else
                  <div class="row">

                      @foreach($properties as $i => $property)
                          <div class="col-md-4 col-sm-6 col-xs-12">
                              <div class="property-container">
                                  <div class="property-image">

                                      @if(Route::currentRouteName() != 'searchnewconstructions')

                                          <a href="{{URL::to('properties/'.$property->property_slug)}}">

                                      @else

                                          <a href="{{URL::to('new-constructions/'.$property->property_slug)}}">

                                      @endif

                                      <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt="{{ $property->property_name }}">

                                  </a>

                                          <div class="property-status">
                                              @if(Route::currentRouteName() != 'searchnewconstructions')
                                                  <span>{{__('text.For '.$property->property_purpose)}}</span>
                                              @else
                                                  <span>{{__('text.'.$property->kind_of_type)}}</span>
                                              @endif
                                          </div>
                              </div>

                                  <div class="property-features">
                                      <span><i class="fa fa-home"></i> {{$property->area}}</span>
                                      <span><i class="fa fa-bed"></i> {{$property->bedrooms}}</span>
                                      <span><i class="fa fa-male"></i> {{$property->bathrooms}}</span>
                                  </div>
                                  <div class="property-content">
                                      @if(Route::currentRouteName() != 'searchnewconstructions')

                                          <h3 style="margin: 10px 0px;"><a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{URL::to('properties/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a> <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;line-height: 15px;">{{ Str::limit($property->address,40) }}</small></h3>

                                          <small style="margin-top: 20px;font-weight: 600;">{{ getPropertyTypeName($property->property_type)->types }}</small>
                                          <small style="float: right;">€@if($property->sale_price) {{number_format($property->sale_price, 0, ',', '.')}} {{$property->cost_for}} @else {{number_format($property->rent_price, 0, ',', '.')}} @endif</small>

                                      @else

                                          <h3 style="margin: 10px 0px;"><a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{URL::to('new-constructions/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a> <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;line-height: 15px;">{{ Str::limit($property->address,40) }}</small></h3>

                                          <small style="margin-top: 20px;font-weight: 600;">{{ getPropertyTypeName($property->property_type)->types }}</small>
                                          <small style="float: right;">€@if($property->sale_price) {{number_format($property->sale_price, 0, ',', '.')}} {{$property->cost_for}} @else {{number_format($property->rent_price, 0, ',', '.')}} @endif</small>

                                      @endif
                                  </div>
                              </div>
                          </div>
                          <!-- break -->
                      @endforeach
                  </div>

                @endif
            <!-- end:product -->

          </div>
          <!-- end:article -->

          <!-- begin:sidebar -->
          @include('_particles.sidebar')
          <!-- end:sidebar -->

        </div>
      </div>
    </div>
    <!-- end:content -->

    <style>

        @media (max-width: 991px){

            .filter-button{display: block !important;}
            .properties-ordering-wrapper{float: left !important;display: block !important;width: 100% !important;}
            .properties-ordering{margin-top: 20px !important;float: left !important;}
            .sidebar{display: none;}
        }

        .properties-ordering-wrapper,.agencies-ordering-wrapper,.agents-ordering-wrapper{margin-bottom:20px;display:-webkit-box;display:-webkit-flex;display:-moz-flex;display:-ms-flexbox;display:flex;align-items:center;-webkit-align-items:center;background-color:#fff;border:1px
        solid #ebebeb;padding:10px
        20px;border-radius:6px;-webkit-border-radius:6px;-moz-border-radius:6px;-ms-border-radius:6px;-o-border-radius:6px}

        @media (min-width: 1200px){.properties-ordering-wrapper,.agencies-ordering-wrapper,.agents-ordering-wrapper{padding:15px
        30px;margin-bottom:30px}}


        .properties-ordering-wrapper .properties-ordering, .agencies-ordering-wrapper .properties-ordering, .agents-ordering-wrapper .properties-ordering{margin-left:auto}

        .my-properties-ordering .label, .sort-my-properties-form .label, .sort-properties-favorite-form .label, .properties-ordering .label{font-weight: 600;color:#484848;font-size:14px;padding:0;display:inline-block;vertical-align:middle;margin-right: 5px;}

    </style>

@endsection

