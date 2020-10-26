@extends("app")

@section('head_title', 'All Properties | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

 <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
                @if(Route::currentRouteName() == 'properties-front')

                    <h2 style="font-size: 29px;">{{__('text.All Properties')}}</h2>

                @elseif(Route::currentRouteName() == 'agent-properties')

                    <h2 style="font-size: 29px;">{{__('text.Agent Properties')}}</h2>

                @else

                    <h2 style="font-size: 29px;">{{__('text.New Constructions')}}</h2>

                @endif
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>
              <li class="active">@if(Route::currentRouteName() == 'properties-front') {{__('text.All Properties')}} @elseif(Route::currentRouteName() == 'agent-properties') {{__('text.Agent Properties')}} @else {{__('text.New Constructions')}} @endif</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end:header -->

    <!-- begin:content -->
    <div id="content">
      <div class="container container1">

        <div class="row mobile-row">
            <div class="col-md-9 col-md-push-3 main-content">

                <style>

                    .widget-sidebar
                    {
                        display: none;
                    }

                    @media (max-width: 991px){
                        .mobile-row
                        {
                            display: flex;
                            flex-flow: column;
                        }

                        .mobile-row .main-content
                        {
                            order: 1;
                        }

                    }
                </style>

          <!-- begin:article -->
              <div class="properties-ordering-wrapper" style="margin-bottom: 40px;">

                  <div class="results-count">{{trans_choice('text.properties found',$properties->total())}}</div>

                  <div class="properties-ordering">

                      @if(Route::currentRouteName() == 'properties-front')

                          <form method="get" action="{{URL::to('properties/')}}">

                              @elseif(Route::currentRouteName() == 'agent-properties')

                                  <form method="get" action="{{\Request::getRequestUri()}}">

                                      @else

                                          <form method="get" action="{{URL::to('new-constructions/')}}">

                                              @endif

                          <div class="label">{{__('text.Sort by:')}}</div>

                          <select onchange="this.form.submit()" name="filter_orderby" class="orderby" data-placeholder="Sort by" tabindex="-1" aria-hidden="true">
                              <option value="newest" @if(isset($filter) && $filter == 'newest' || $filter == '') selected @endif>{{__('text.Newest')}}</option>
                              <option value="oldest" @if(isset($filter) && $filter == 'oldest') selected @endif>{{__('text.Oldest')}}</option>
                              @if(Route::currentRouteName() != 'newconstructions-front')
                              <option value="bedrooms" @if(isset($filter) && $filter == 'bedrooms') selected @endif>{{__('text.Most Bedrooms')}}</option>
                              <option value="bathrooms" @if(isset($filter) && $filter == 'bathrooms') selected @endif>{{__('text.Most Bathrooms')}}</option>
                              @endif
                              <option value="popularity" @if(isset($filter) && $filter == 'popularity') selected @endif>{{__('text.Popularity')}}</option>
                              @if(Route::currentRouteName() != 'newconstructions-front')
                              <option value="lowest_sale_price" @if(isset($filter) && $filter == 'lowest_sale_price') selected @endif>{{__('text.Lowest Sale Price')}}</option>
                              <option value="highest_sale_price" @if(isset($filter) && $filter == 'highest_sale_price') selected @endif>{{__('text.Highest Sale Price')}}</option>
                              <option value="lowest_rent_price" @if(isset($filter) && $filter == 'lowest_rent_price') selected @endif>{{__('text.Lowest Rent Price')}}</option>
                              <option value="highest_rent_price" @if(isset($filter) && $filter == 'highest_rent_price') selected @endif>{{__('text.Highest Rent Price')}}</option>
                              <option value="lowest_area" @if(isset($filter) && $filter == 'lowest_area') selected @endif>{{__('text.Lowest Area')}}</option>
                              <option value="highest_area" @if(isset($filter) && $filter == 'highest_area') selected @endif>{{__('text.Highest Area')}}</option>
                              @endif
                          </select>

                      </form>

                  </div>

                  <button type="button" value="Filters" href="#myModal1" data-toggle="modal" class="btn btn-primary filter-button" style="float: right;color: black;background: white;border-color: #9f9c9c;outline: none;margin-top: 20px;display: none;">
                      <span>
                          <img src="{{ URL::asset('assets/img/Filter-512.png') }}" aria-hidden="true" style="margin-right: 5px;width: 15px;margin-top: -1px;">
                          <span style="font-size: 13px;">Filters</span>
                      </span>
                  </button>

              </div>

              @if(count($properties))

            <!-- begin:product -->

            <div class="row {{--container-realestate--}}">

                <?php $i = 0; ?>

           	  @foreach($properties as $i => $property)

                        @if(Route::currentRouteName() == 'newconstructions-front')

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-11 res-box" style="margin-bottom: 20px;">

                            @else

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-11 res-box" style="min-height: 510px;">

                            @endif

                     @if(Route::currentRouteName() == 'properties-front' || Route::currentRouteName() == 'agent-properties')

                                    @if($property->open_date)

                                        <div class="property-price" style="min-height: 28px;position:relative;max-width: 100%;font-size: 11px;padding: 3px 0px;margin-bottom: 6px;border-radius: 5px;"><span>{{__('text.Open House')}} {{$property->open_date}} {{$property->open_timeFrom}} to {{$property->open_timeTo}}</span></div>

                                    @else

                                        <div class="property-price res-open" style="background: transparent;min-height: 28px;position:relative;max-width: 100%;font-size: 11px;padding: 3px 0px;margin-bottom: 6px;border-radius: 5px;"></div>

                                    @endif
                     @endif

                                <div class="property-container" style="border: 1px solid #48cfad;margin-bottom: 10px">

                <div class="property-image">

                    @if(Route::currentRouteName() != 'newconstructions-front')

                        <a href="{{URL::to('properties/'.$property->property_slug)}}">

                    @else

                        <a href="{{URL::to('new-constructions/'.$property->property_slug)}}">

                    @endif

                            <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}" alt="{{ $property->property_name }}">

                        </a>

                  <?php

                  preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $property->description, $matches);
                  if(!empty($matches[1])){ $url = $matches[1];}else{ $url = '';}

                  ?>

                  @if($url)

                      <div class="video-wrapper-inner" style="position: absolute;margin-right: 5%;margin-top: 5%;top: 0;right: 0;">
                          <a data-width="1280" href="{{$url}}" data-gallery="videos{{$i}}" data-toggle="lightbox" class="popup-video" style="cursor: pointer;outline: none;">
                              <span class="popup-video-inner">
                                  <i class="flaticon-play"></i>
                              </span>
                          </a>
                      </div>

                      @if($property->video)

                          <div style="display: none;" data-toggle="lightbox" data-type="video" data-gallery="videos{{$i}}" data-width="1280" data-remote="{{ URL::asset('upload/properties/'.$property->video) }}"></div>

                      @endif

                  @else

                      @if($property->video)


                          <div class="video-wrapper-inner" style="position: absolute;margin-right: 5%;margin-top: 5%;top: 0;right: 0;">
                              <a data-width="1280" href="{{ URL::asset('upload/properties/'.$property->video) }}" data-type="video" data-gallery="videos{{$i}}" data-toggle="lightbox" class="popup-video" style="cursor: pointer;outline: none;">
                                  <span class="popup-video-inner">
                                      <i class="flaticon-play"></i>
                                  </span>
                              </a>
                          </div>

                      @endif

                  @endif

                  @if($property->is_sold)

                      <div class="property-price" style="top: 37px;left: -58px;border-radius: 5px;padding: 5px 10px;transform: rotate(-40deg);width: 240px;">

                          <span>{{__('text.Sold')}}</span>

                      </div>

                  @elseif($property->is_rented)

                      <div class="property-price" style="top: 37px;left: -58px;border-radius: 5px;padding: 5px 10px;transform: rotate(-40deg);width: 240px;">

                          <span>{{__('text.Rented')}}</span>

                      </div>

                  @elseif($property->is_negotiation)

                      <div class="property-price" style="top: 37px;left: -58px;border-radius: 5px;padding: 5px 10px;transform: rotate(-40deg);width: 240px;">

                          <span style="font-size: 14px;">{{__('text.Under Negotiation')}}</span>

                      </div>

                  @elseif($property->is_under_offer)

                      <div class="property-price" style="top: 37px;left: -58px;border-radius: 5px;padding: 5px 10px;transform: rotate(-40deg);width: 240px;">

                          <span style="font-size: 16px;">{{__('text.Under Offer')}}</span>

                      </div>

                  @else

                      @if(Route::currentRouteName() != 'newconstructions-front')


                          <div class="property-price" style="top: 12px;left: 12px;border-radius: 5px;padding: 5px 10px;">
                              <span>{{__('text.For '.$property->property_purpose)}}</span>
                              {{--<h4>{{ getPropertyTypeName($property->property_type)->types }}</h4>
                              <span>{{getcong('currency_sign')}}@if($property->sale_price) {{$property->sale_price}} @else {{$property->rent_price}} @endif</span>--}}
                          </div>

                      @else

                          <div class="property-price" style="top: 12px;left: 12px;border-radius: 5px;padding: 5px 10px;">
                              <span>{{__('text.'.$property->kind_of_type)}}</span>
                              {{--<h4>{{ getPropertyTypeName($property->property_type)->types }}</h4>
                              <span>{{getcong('currency_sign')}}@if($property->sale_price) {{$property->sale_price}} @else {{$property->rent_price}} @endif</span>--}}
                          </div>

                      @endif

                  @endif



                  @if($property->available_immediately)

                <div class="property-status" style="background:#48cfad;width:170px;bottom: 12px;left: 12px;border-radius: 5px;padding: 0px;text-align: center;">
                 <span>{{__('text.Available Immediately')}}</span>
                </div>

                  @endif

                  <?php

                  $x = 0;

                  if($property->featured_image){ $x = $x + 1;} if($property->property_images1){ $x = $x + 1;} if($property->property_images2){ $x = $x + 1;} if($property->property_images3){ $x = $x + 1;} if($property->property_images4){ $x = $x + 1;} if($property->property_images5){ $x = $x + 1;}

                  ?>

                  <div class="property-status" style="bottom: 12px;right: 12px;background: rgba(0,0,0,.5);border-radius: 7%;padding: 5px 6px 5px 10px;">

                      @if($property->first_floor || $property->second_floor || $property->ground_floor || $property->basement)

                          <?php $check = 0; ?>


                          @if($property->first_floor)

                                  <?php $ext = pathinfo($property->first_floor, PATHINFO_EXTENSION);

                                  $ext = strtolower($ext);

                                  ?>

                              @if($ext == 'pdf')

                                          <a data-gallery="floor-images{{$i}}" href=" {{ URL::asset('upload/properties/'.$property->first_floor) }} " style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}" > </a>

                              @else

                                          <a data-gallery="floor-images{{$i}}" href="{{ URL::asset('upload/properties/'.$property->first_floor) }}" style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}" > </a>

                              @endif

                              <?php $check = 1; ?>

                          @endif

                              @if($property->second_floor)

                                  <?php $ext = pathinfo($property->second_floor, PATHINFO_EXTENSION);

                                  $ext = strtolower($ext);

                                  ?>


                                  @if($check)

                                          @if($ext == 'pdf')

                                              <div style="display: none;" data-toggle="lightbox" data-gallery="floor-images{{$i}}" data-remote=" {{ URL::asset('upload/properties/'.$property->second_floor) }} "></div>

                                          @else

                                              <div style="display: none;" data-toggle="lightbox" data-gallery="floor-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->second_floor) }}"></div>

                                          @endif



                                      @else

                                          @if($ext == 'pdf')

                                              <a data-gallery="floor-images{{$i}}" href="{{ URL::asset('upload/properties/'.$property->second_floor) }}" style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src=" {{ URL::asset('assets/img/blueprint.png') }} " > </a>

                                              @else

                                              <a data-gallery="floor-images{{$i}}" href="{{ URL::asset('upload/properties/'.$property->second_floor) }}" style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}" > </a>

                                              @endif


                                      <?php $check = 1; ?>

                                      @endif


                              @endif


                              @if($property->ground_floor)

                                  <?php $ext = pathinfo($property->ground_floor, PATHINFO_EXTENSION);

                                  $ext = strtolower($ext);

                                  ?>

                                  @if($check)

                                          @if($ext == 'pdf')

                                              <div style="display: none;" data-toggle="lightbox" data-gallery="floor-images{{$i}}" data-remote=" {{ URL::asset('upload/properties/'.$property->ground_floor) }} "></div>

                                              @else

                                              <div style="display: none;" data-toggle="lightbox" data-gallery="floor-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->ground_floor) }}"></div>

                                              @endif



                                  @else

                                          @if($ext == 'pdf')

                                              <a data-gallery="floor-images{{$i}}" href=" {{ URL::asset('upload/properties/'.$property->ground_floor) }} " style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}" > </a>

                                              @else

                                              <a data-gallery="floor-images{{$i}}" href="{{ URL::asset('upload/properties/'.$property->ground_floor) }}" style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}" > </a>

                                              @endif



                                      <?php $check = 1; ?>

                                  @endif


                              @endif


                              @if($property->basement)

                                  <?php $ext = pathinfo($property->basement, PATHINFO_EXTENSION);

                                  $ext = strtolower($ext);

                                  ?>

                                  @if($check)

                                          @if($ext == 'pdf')

                                              <div style="display: none;" data-toggle="lightbox" data-gallery="floor-images{{$i}}" data-remote=" {{ URL::asset('upload/properties/'.$property->basement) }} "></div>

                                              @else

                                              <div style="display: none;" data-toggle="lightbox" data-gallery="floor-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->basement) }}"></div>

                                              @endif

                                  @else

                                          @if($ext == 'pdf')

                                              <a data-gallery="floor-images{{$i}}" href=" {{ URL::asset('upload/properties/'.$property->basement) }} " style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}"> </a>

                                              @else

                                              <a data-gallery="floor-images{{$i}}" href="{{ URL::asset('upload/properties/'.$property->basement) }}" style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}"> </a>

                                              @endif


                                      <?php $check = 1; ?>

                                  @endif


                              @endif

                      @endif



                      <a data-toggle="lightbox" data-gallery="hidden-images{{$i}}" href="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}" style="color: white;"> <i class="fas fa-camera" style="font-size: 18px;"></i><span style="padding: 0px 6px;font-weight: 700;font-size: 18px;position: relative;bottom: 1px;margin-left: 5px;">{{$x}}</span></a>

                          @if($property->property_images1)

                              <div style="display: none;" data-toggle="lightbox" data-gallery="hidden-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->property_images1.'-b.jpg') }}"></div>

                          @endif

                          @if($property->property_images2)

                              <div style="display: none;" data-toggle="lightbox" data-gallery="hidden-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->property_images2.'-b.jpg') }}"></div>

                          @endif

                          @if($property->property_images3)

                              <div style="display: none;" data-toggle="lightbox" data-gallery="hidden-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->property_images3.'-b.jpg') }}"></div>

                          @endif

                          @if($property->property_images4)

                              <div style="display: none;" data-toggle="lightbox" data-gallery="hidden-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->property_images4.'-b.jpg') }}"></div>

                          @endif

                          @if($property->property_images5)

                              <div style="display: none;" data-toggle="lightbox" data-gallery="hidden-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}"></div>

                          @endif

                      <?php $i = $i + 1; ?>


                  </div>
              </div>

              {{--<div class="property-features">
                <span><i class="fa fa-home"></i> {{$property->area}}</span>
                <span><i class="fa fa-hdd-o"></i> {{$property->bedrooms}}</span>
                <span><i class="fa fa-male"></i> {{$property->bathrooms}}</span>
              </div>--}}


                                    <div class="property-content">

                                        @if(Route::currentRouteName() != 'newconstructions-front')

                                            <h3 style="margin-bottom: 15px;margin-top: 0px;display: inline-block;width: 100%;">

                                                <div style="display: inline-block;width: 100%;">
                                                    <a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{URL::to('properties/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a>
                                                </div>

                                                <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;width: 50%;float: left;line-height: 15px;">{{ Str::limit($property->address,40) }}</small>
                                                <small style="/* margin-top: 5px; */float: right;font-weight: 600;width: 50%;text-align: right;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;line-height: 15px;padding-right: 7px;">@if($property->sale_price) € {{number_format($property->sale_price, 0, ',', '.')}} {{$property->cost_for}} @elseif($property->rent_price) € {{$property->rent_price}} @endif</small>

                                            </h3>

                                        @else

                                            <h3 style="margin-bottom: 15px;margin-top: 0px;display: inline-block;width: 100%;">

                                                <div style="display: inline-block;width: 100%;">
                                                    <a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{URL::to('new-constructions/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a>
                                                </div>

                                                <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;width: 50%;float: left;line-height: 15px;">{{ Str::limit($property->address,40) }}</small>
                                                <small style="/* margin-top: 5px; */float: right;font-weight: 600;width: 50%;text-align: right;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;line-height: 15px;padding-right: 7px;">{{$property->price_description}}</small>

                                            </h3>

                                        @endif

                                            @if(Route::currentRouteName() != 'newconstructions-front')

                                        <div style="display: flex;flex-direction: row;">

                                            <img style="width: 15px;height: 15px;float: left;margin-right: 10px;align-self: center;" src="{{ URL::asset('assets/img/browser.png') }}"><span style="font-weight: 600;">{{$property->area}} <small>m2</small></span>

                                            @if($property->bedrooms >= 1)

                                                <img style="width: 17px;height: 17px;float: left;margin-right: 10px;margin-left: 20px;align-self: center;" src="{{ URL::asset('assets/img/bed.png') }}"><span style="font-weight: 600;">{{$property->bedrooms}} @if($property->bedrooms == 1) {{__('text.room')}}  @else {{__('text.rooms')}} @endif</span>

                                            @endif

                                        </div>

                                                @endif

                                    </div>

                @if(Route::currentRouteName() != 'newconstructions-front')

                <div class="property-content" style="border-top:1px solid #cacaca;display: flex;padding: 0;height: 85px;align-items: center;">

                    @if(!$property->landlord)

                        <div style="width: 50%;padding-left: 3px;">
                            <span style="font-weight: 600;color: #808080;">{{__('text.Brought to you by')}}</span>
                        </div>

                        <div style="width: 50%;height: 100%;padding: 5px;">

                        <a style="outline: none;" href="{{URL::to('agents/details/'.$property->user_id)}}">

                            @if($property->image_icon)
                                <img style="width: 95%;height: 100%;float: right;" src="{{ URL::asset('upload/members/'.$property->image_icon.'-b.jpg') }}">
                            @elseif($property->company_name)
                                <h3 style="margin: 0;display: flex;align-items: center;justify-content: center;height: 100%;">{{$property->company_name}}</h3>
                            @endif

                        </a>

                        </div>

                        @else

                        <div style="width: 100%;text-align: center;">
                            <span style="font-weight: 600;color: #808080;">{{__('text.Brought to you by')}} {{__('text.a private landlord')}}</span>
                        </div>

                    @endif

                </div>

                    @endif

            </div>

                                @if(Route::currentRouteName() != 'newconstructions-front')

                                    @if($property->listed)

                                        <div class="property-price" style="background: #d6d63e;position:relative;max-width: 100%;margin-bottom: 12px;font-size: 15px;padding: 2px 0px;border-radius: 5px;">{{$property->listed}}</div>

                                    @endif

                                @endif

          </div>
              <!-- break -->
           	  @endforeach


            </div>
            <!-- end:product -->

            @else

                  <h4 style="text-align: center;margin-top: 30px;margin-bottom: 30px;">{{__('text.Is there no home that makes you happy?')}}</h4>

                  @endif
            <!-- begin:pagination -->
          {{ $properties->appends(request()->query())->links() }}
            <!-- end:pagination -->
          </div>
          <!-- end:article -->

          <!-- begin:sidebar -->
          @include('_particles.sidebar')
          <!-- end:sidebar -->

        </div>
      </div>
    </div>
    <!-- end:content -->

 <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

 <style>

     @media (min-width: 1200px)
     {
         .container1
         {
             width: 90%;
         }
     }

     @media (max-width: 767px){

         .res-box
         {
             margin: auto;
             display: table;
             float: none !important;
             margin-bottom: 20px;
             min-height: auto !important;
         }

         .res-open
         {
             display: none;
         }

     }

     @media (max-width: 991px){

         .filter-button{display: block !important;}
         .properties-ordering-wrapper{float: left !important;display: block !important;width: 100% !important;}
         .properties-ordering{margin-top: 20px !important;float: left !important;}
         .sidebar{display: none;}
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
         top: 3px;
     }

     .select2-container--default .select2-selection--single .select2-selection__arrow
     {
         top: 5px;
     }

     .select2-container .select2-selection--single
     {
         height: 34px;
     }

     .select2-container--open .select2-dropdown--below
     {
         width: 240px !important;
         text-align: left;
     }

     .select2-container--default .select2-results>.select2-results__options
     {
         min-height: auto;
         max-height: fit-content;
     }

     .property-image
     {
         height: 200px;
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
