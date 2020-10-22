@extends("app")

@section('head_title', $property->property_name .' | '.getcong('site_name') )
@section('head_description', substr(strip_tags($property->description),0,200))

@if($property->featured_image)
@section('head_image', asset('/upload/properties/'.$property->featured_image.'-b.jpg'))
@endif

@section('head_url', Request::url())

@section("content")




<!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <h2>{{$property->property_name}}</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>

                @if($property->new_construction == 1)

                    <li><a href="{{ URL::to('new-constructions/') }}">{{__('text.New Constructions')}}</a></li>

                    @elseif($property->home_exchange == 1)

                    <li><a href="{{ URL::to('homeexchange/') }}">{{__('text.Home Exchange')}}</a></li>

                             @else

                    <li><a href="{{ URL::to('properties/') }}">{{__('text.Properties')}}</a></li>

                             @endif

              <li class="active">{{$property->property_name}}</li>
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

        @if($property->home_exchange != 1)

            <!-- begin:sidebar -->
        @include('_particles.sidebar',['class'=>'col-md-2'])
        <!-- end:sidebar -->

                <div class="properties-ordering-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <button type="button" value="Filters" href="#myModal1" data-toggle="modal" class="btn btn-primary filter-button" style="float: left;color: black;background: white;border-color: #9f9c9c;outline: none;display: none;">
                      <span>
                          <img src="{{ URL::asset('assets/img/Filter-512.png') }}" aria-hidden="true" style="margin-right: 5px;width: 15px;margin-top: -1px;">
                          <span style="font-size: 13px;">Filters</span>
                      </span>
                    </button>

                </div>


            @endif

          <!-- begin:article -->
            <div class="col-md-7 main-content">

            <div class="row">
              <div class="col-md-12 single-post">
                <ul id="myTab" class="nav nav-tabs nav-justified">
                  <li class="property-tab active"><a href="#detail" style="outline: none;" id="left-tab" data-toggle="tab"><i style="margin-right: 5px;" class="fas fa-house-user"></i> {{__('text.Property Detail')}}</a></li>

                    @if($property->new_construction != 1)
                    <li class="contact-tab"><a href="#location" style="outline: none;" id="right-tab" data-toggle="tab"><i style="margin-right: 5px;" class="far fa-comment-dots"></i> Contact</a></li>
                        @endif
                </ul>

                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade in active" id="detail">
                    <div class="row">
                      <div class="col-md-12">
                        <h2>{{$property->property_name}}</h2>

                          @if($property->video)


                              <div class="row" id="player-window" style="display: none;">

                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 100%;">

                                      <?php $ext = pathinfo($property->video, PATHINFO_EXTENSION);

                                      $ext = strtolower($ext);

                                      ?>

                                      <video id="player" playsinline controls style="object-fit: fill;">
                                          <source src="{{ URL::asset('upload/properties/'.$property->video) }}" type="video/{{$ext}}" />
                                          <source src="{{ URL::asset('upload/properties/'.$property->video) }}" type="video/mp4" />
                                          <source src="{{ URL::asset('upload/properties/'.$property->video) }}" type="video/ogv" />
                                          <source src="{{ URL::asset('upload/properties/'.$property->video) }}" type="video/webm" />

                                      </video>

                                  </div></div>

                          @endif

                        <div id="slider-property" class="carousel slide" data-ride="carousel" style="margin-bottom: 0px;">

                          <div class="carousel-inner">

                              @if($property->video)

                              <div class="video-wrapper-inner" style="position: absolute;margin-left: 15%;margin-top: 5%;">
                                  <a class="popup-video" style="cursor: pointer;">
                    <span class="popup-video-inner">
                        <i class="flaticon-play"></i>
                    </span>
                                  </a>
                              </div>

                              @endif

                            <div class="item active">
                                @if($property->featured_image)
                              <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}" alt="">
                                @else
                                    <img src="{{ URL::asset('upload/noFeatured.jpg') }}" alt="">
                                @endif
                            </div>


                            @if($property->property_images1)
                            <div class="item">
                              <img src="{{ URL::asset('upload/properties/'.$property->property_images1.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                             @if($property->property_images2)
                            <div class="item">
                              <img src="{{ URL::asset('upload/properties/'.$property->property_images2.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                             @if($property->property_images3)
                            <div class="item">
                              <img src="{{ URL::asset('upload/properties/'.$property->property_images3.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                             @if($property->property_images4)
                            <div class="item">
                              <img src="{{ URL::asset('upload/properties/'.$property->property_images4.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                             @if($property->property_images5)
                            <div class="item">
                              <img src="{{ URL::asset('upload/properties/'.$property->property_images5.'-b.jpg') }}" alt="">
                            </div>
                            @endif

                          </div>

                            <button type="button" href="#slider-property" data-slide="prev" class="carousel-prev arrow" aria-disabled="false" style="display: block;"><i class="flaticon-left-arrow-1" aria-hidden="true"></i></button>

                            <button type="button" href="#slider-property" data-slide="next" class="carousel-next arrow" style="display: block;" aria-disabled="true"><i class="flaticon-right-arrow" aria-hidden="true"></i></button>

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

                                .properties-ordering-wrapper{display: none;}

                                .carousel-prev{left:15px}

                                .carousel-next{right:15px}

                                button{outline: none;}

                                .arrow{background:#fff;padding:0;display:inline-block;font-size:18px;width:40px;height:40px;line-height:40px;color:#006c70;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;position:absolute;top:50%;-webkit-transform:translate(0, -50%);-ms-transform:translate(0, -50%);-o-transform:translate(0, -50%);transform:translate(0, -50%);z-index:2;border:none;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-box-shadow:0 0 50px 0 rgba(0, 0, 0, 0.15);box-shadow:0 0 50px 0 rgba(0, 0, 0, 0.15)}

                                .arrow{width:30px;height:40px;line-height:38px;border:1px
                                solid #fff;border-radius:6px;-webkit-border-radius:6px;-moz-border-radius:6px;-ms-border-radius:6px;-o-border-radius:6px;background:transparent;color:#ffff}

                                .arrow:hover, .arrow:active{color:#006a70;background-color:#fff;border-color:#fff}

                                @media (min-width: 1200px){

                                    .carousel-prev{left:30px}

                                    .carousel-next{right:30px}

                                    .arrow{width:40px;height:80px;line-height:78px}

                                }

                            </style>

                            </div>


                          <input type="hidden" name="map_latitude" id="map_latitude" value="{{$property->map_latitude}}">
                          <input type="hidden" name="map_longitude" id="map_longitude" value="{{$property->map_longitude}}">
                          <input type="hidden" name="city" id="city" value="{{$property->address}}">
                          <input type="hidden" name="type" id="type" value="shopping_mall">


                          <div class="row" id="map-box" style="display: none;">

                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 100%;">

                                  <div style="border: 1px solid #e5e5e5;box-shadow: rgba(0, 0, 0, 0.3) 0px 2px 6px;height: 100%;">


                                      <div class="row" id="map-first-row">
                                          <div class="col-sm-12">
                                              <div class="carousel box-carousel d-none d-sm-block" style="display: flex;padding: 10px;">
                                                  <div class="box background-active" data-type="shopping_mall">
                                                      <a><i class="fas fa-shopping-cart" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>{{__('text.Malls')}}</a>
                                                  </div>
                                                  <div class="box" data-type="school">
                                                      <a><i class="fas fa-graduation-cap" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>{{__('text.Schools')}}</a>
                                                  </div>
                                                  <div class="box" data-type="bank">
                                                      <a><i class="fas fa-university" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>{{__('text.Banks')}}</a>
                                                  </div>
                                                  <div class="box" data-type="hospital">
                                                      <a><i class="fas fa-hospital" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>{{__('text.Hospitals')}}</a>
                                                  </div>
                                                  <div class="box" data-type="bakery">
                                                      <a><i class="fas fa-birthday-cake" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>{{__('text.Bakery')}}</a>
                                                  </div>
                                                  <div class="box" data-type="pharmacy">
                                                      <a><i class="fas fa-first-aid" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>{{__('text.Pharmacy')}}</a>
                                                  </div>


                                              </div><!-- carousel-->
                                          </div><!--col-->
                                      </div><!--row-->


                                      <div id="map-second-row">

                                          <div id="panel" style="width: 204px;height: auto;max-height: 340px;float: left;border: 1px solid rgba(190, 190, 190, 0.6);border-left: 0;overflow: auto;position: absolute;top: 22%;z-index: 1;background-color: white;">

                                              <div class="accordion">
                                                  <span style="display: block;">{{__('text.Malls')}}</span>
                                                  <span style="display: inline-block;"></span>
                                              </div>

                                              <div class="panel" style="border: 0;margin-bottom: 0px;box-shadow: none;"></div>

                                          </div>


                                          <div style="width: 100%;height: 100%;float: left;">

                                              <div id="map"></div>

                                          </div>

                                      </div>


                                  </div>

                              </div>

                          </div>

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 10px 0px;padding-bottom: 0px;">

                                  <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8" style="padding: 0;">
                              <span style="margin-right: 10px;float: left;margin-bottom: 7px;"><img src="{{ URL::asset('assets/img/pin.png') }}" style="width: 15px;height: 15px;display: block;" /></span>

                              <h5 style="margin: 0;float: left;margin-right: 20px;margin-bottom: 15px;">{{$property->address}}</h5>

                                      <div>
                                          <span style="margin-right: 10px;float: left;display: flex;"><i class="fa fa-eye" aria-hidden="true" style="font-size: 14px;"></i></span>

                                          <h5 style="margin: 0;float: left;">{{$property->views}}</h5>
                                      </div>

                                  </div>


                                  <?php setlocale(LC_TIME, 'Dutch');
                                  $date = $property->created_at->formatLocalized('%d %B %Y');
                                  ?>

                                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4" style="padding: 0;">

                                      <span style="font-size: 12px;line-height: 1;vertical-align: top;float: right;">{{__('text.Posted on')}} {{$date}}</span>

                                  </div>

                          </div>

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 media-icons" style="padding: 20px 0px;padding-bottom: 0px;">

                              <ul class="nav nav-tabs nav-table">
                                  <li class="image-tab active">
                                      <a class="popup-image" data-toggle="tab">
                                          <i class="flaticon-photo-camera"></i>
                                      </a>
                                  </li>

                                  @if($property->video)

                                  <li class="video-tab">
                                      <a class="popup-video" data-toggle="tab">
                                          <i class="flaticon-play"></i>
                                      </a>
                                  </li>

                                  @endif

                                  <li class="map-tab">
                                      <a class="tab-google-map"  data-toggle="tab">
                                          <i class="flaticon-pin"></i>
                                      </a>
                                  </li>
                                  <li class="street-view-tab">
                                      <a class="tab-google-street-view-map" data-toggle="tab">
                                          <i class="flaticon-street-view"></i>
                                      </a>
                                  </li>

                                  <li class="satellite-view-tab">
                                      <a class="tab-google-satellite-view-map" data-toggle="tab">
                                          <i class="fas fa-satellite"></i>
                                      </a>
                                  </li>


                              </ul>


                          </div>

                          <?php $url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 media-icons" style="padding: 30px 0px;padding-bottom: 0px;">

                              <ul class="nav nav-tabs nav-table">

                                  @if($property->home_exchange != 1)

                                      @if(count($similar_properties)>0)

                                  <li class="image-tab">
                                      <a class="add-compare new-icons" title="Add Compare" style="border-radius: 100px;position: relative;">
                                          <i class="fas fa-exchange-alt" style="vertical-align: middle;"></i>
                                      </a>
                                  </li>

                                          @endif

                                  @endif

                                  <li class="image-tab">
                                      <a class="new-icons" target="_blank" title="Share by Email" href="mailto:?subject=I wanted you to see this Property AD I just Found on zoekjehuisje.nl&amp;body=Check out this link {{$url}}" style="border-radius: 100px;position: relative;">
                                          <i class="far fa-envelope" style="vertical-align: middle;"></i>
                                      </a>
                                  </li>


                                  <li class="image-tab">

                                      @if( isset(Auth::user()->usertype) && Auth::user()->usertype == 'Users')

                                          <form action="{{ URL::to('admin/save-property') }}" method="POST" id="save_property_form" style="display: inline-block;">

                                              <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                              <input type="hidden" name="property_id" value="{{$property->id}}">

                                              @if($property->new_construction != 1 && $property->home_exchange != 1)

                                                  <input type="hidden" name="type" value="standard">

                                                  @elseif($property->new_construction == 1)

                                                  <input type="hidden" name="type" value="construction">

                                                  @else

                                                  <input type="hidden" name="type" value="exchange">

                                                  @endif

                                      <button type="submit" class="new-icons new-button" title="Add Favorite" style="border-radius: 100px;position: relative;outline: none;">

                                          @if($saved)

                                          <i class="fa fa-heart" id="heart" style="vertical-align: middle;font-size: 16px;">
                                              <span style="display: block;">{{ $property->saved_properties }}</span>
                                          </i>

                                          @else

                                              <i class="far fa-heart" id="heart" style="vertical-align: middle;font-size: 16px;">
                                                  <span style="display: block;">{{ $property->saved_properties }}</span>
                                              </i>

                                          @endif


                                      </button>

                                          </form>

                                  @else

                                      @if(!isset(Auth::user()->usertype))

                                              <a class="new-icons" href="{{ URL::to('/login') }}" title="Be First to Save this property" style="border-radius: 100px;position: relative;">

                                                  <i class="far fa-heart" id="heart" style="vertical-align: middle;font-size: 16px;">
                                                      <span style="display: block;">{{ $property->saved_properties }}</span>
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

                                                  <input type="hidden" name="id" value="{{$property->id}}">

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
                                                  <button type="button" class="btn btn-success" data-dismiss="modal">{{__('text.Cancel')}}</button>
                                              </div>
                                          </div>



                                  </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 request" style="padding: 0;text-align: right;margin: 25px 0px;display: flex;justify-content: space-between;">

                                  <div class="sh-ad" style="align-self: center;text-align: left;padding-right: 30px;">
                                      <span style="font-size: 15px;">{{__('text.Share ad text')}}</span>

                                      <ul class="nav nav-tabs nav-table" style="display: inline-block;margin: 0px 0px 20px 0px;">

                                      <li class="image-tab" style="margin-left: 8px;margin-right: 0;">
                                          <a class="new-icons" title="Share" style="border-radius: 100px;position: relative;width: 35px !important;height: 35px !important;line-height: 0 !important;display: flex;flex-direction: column;justify-content: center;" data-toggle="modal" data-target="#ShareModal">
                                              <i class="fas fa-share-alt" style="vertical-align: middle;margin-right: 2px;font-size: 15px;"></i>
                                          </a>
                                      </li>

                                      </ul>

                                  </div>

                                  @if($property->new_construction != 1 && $property->home_exchange != 1)

                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="outline: none;align-self: flex-start;">
                                  <i class="far fa-calendar-check" style="margin-right: 7px;"></i> {{__('text.Request Viewing')}}
                              </button>

                                      @elseif($property->new_construction == 1)

                                      <a class="btn btn-primary" href="{{$property->citation}}" style="outline: none;align-self: flex-start">
                                          <i class="fas fa-globe" style="margin-right: 7px;"></i> {{__('text.Contact Page Source')}}
                                      </a>

                                  @endif

                              </div>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">

                                      <form role="form" action="{{route('request-viewing')}}" method="POST">

                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                          <input type="hidden" name="agent_id" value="{{$agent->id}}">

                                          <input type="hidden" name="property_name" value="{{$property->property_name}}">

                                          <input type="hidden" name="property_address" value="{{$property->address}}">

                                          <div class="modal-content">

                                              <div class="modal-header" style="border-bottom: 0;display: inline-block;width: 100%;padding: 15px 25px 0px 25px;">

                                                  <button style="opacity: 0.5;font-size: 30px;font-weight: 600;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>

                                                  <h4 style="margin-top: 5px;" class="modal-title" id="exampleModalLabel">{{__('text.Request Viewing')}}</h4>
                                                  <p style="margin-top: 15px;width: 90%;">{{__('text.Request Viewing Heading')}}</p>

                                              </div>


                                              <div class="modal-body" style="padding: 10px 25px;padding-top: 0px;">

                                                  <input type="hidden" name="id" value="{{$property->id}}">

                                                  <div class="form-group">

                                                      <div style="position: relative;width: 100%;">

                                                          <div class="bulgy-radios" role="radiogroup" aria-labelledby="bulgy-radios-label" style="width: 100%;min-height: 50px;text-align: left;">

                                                              <label style="margin-left: 5px;float: left;max-width: 80px;">
                                                                  <input type="radio" name="gender" value="Mr." checked />
                                                                  <span class="radio"></span>
                                                                  <span class="label">{{__('text.Mr.')}}</span>
                                                              </label>

                                                              <label>
                                                                  <input type="radio" name="gender" value="Ms." />
                                                                  <span class="radio"></span>
                                                                  <span class="label">{{__('text.Ms.')}}</span>
                                                              </label>

                                                          </div>

                                                      </div>

                                                  </div>

                                                  <div class="form-group">

                                                      <div style="width: 100%;position: relative;">

                                                          <label style="font-weight: 600;">{{__('text.Preferred Day')}}*</label>

                                                          <i class="fas fa-calendar-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 72%;margin:-9px 0 0;pointer-events:none;"></i>
                                                          <i class="fas fa-chevron-down" style="position: absolute;font-size: 14px;top: 72%;right:10px;left: auto;margin: -7px 0 0;pointer-events: none;color: #767676;"></i>

                                                          <select style="-webkit-appearance:none;-moz-appearance:none;appearance:none;padding: 0 0 0 40px;cursor: pointer;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;"  placeholder="Preferred Day *" name="day" required  class="form-control" >

                                                              <option value="">{{__('text.No preference')}}</option>
                                                              <option value="Only on workdays">{{__('text.Only on workdays')}}</option>
                                                              <option value="Weekend">{{__('text.Weekend')}}</option>
                                                              <option value="Monday">{{__('text.Monday')}}</option>
                                                              <option value="Tuesday">{{__('text.Tuesday')}}</option>
                                                              <option value="Wednesday">{{__('text.Wednesday')}}</option>
                                                              <option value="Thursday">{{__('text.Thursday')}}</option>
                                                              <option value="Friday">{{__('text.Friday')}}</option>
                                                              <option value="Saturday">{{__('text.Saturday')}}</option>

                                                          </select>

                                                      </div>

                                                  </div>

                                                  <div class="form-group">

                                                      <div style="width: 100%;position: relative;">

                                                          <label style="font-weight: 600;">{{__('text.Preferred Moment')}}*</label>

                                                          <i class="far fa-clock" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 72%;margin:-9px 0 0;pointer-events:none;"></i>
                                                          <i class="fas fa-chevron-down" style="position: absolute;font-size: 14px;top: 72%;right:10px;left: auto;margin: -7px 0 0;pointer-events: none;color: #767676;"></i>

                                                          <select style="-webkit-appearance:none;-moz-appearance:none;appearance:none;padding: 0 0 0 40px;cursor: pointer;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;"  placeholder="Preferred Moment *" name="moment" required  class="form-control" >

                                                              <option value="">{{__('text.No preference')}}</option>
                                                              <option value="in the morning">{{__('text.in the morning')}}</option>
                                                              <option value="in the afternoon">{{__('text.in the afternoon')}}</option>

                                                          </select>

                                                      </div>

                                                  </div>

                                                  <div class="form-group">

                                                      <div style="width: 100%;position: relative;">

                                                          <i class="fas fa-user" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;"></i>

                                                          <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type='text' placeholder="{{__('text.Name')}}" name="username" required  class="form-control" id='username' />

                                                      </div>

                                                  </div>

                                                  <div class="form-group">

                                                      <div style="width: 100%;position: relative;">

                                                          <i class="fas fa-at" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;"></i>

                                                          <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type='email' placeholder="{{__('text.Email Address')}}" name="email" required  class="form-control" id='email' />

                                                      </div>

                                                  </div>

                                                  <div class="form-group">

                                                      <div style="width: 100%;position: relative;">

                                                          <i class="fas fa-phone-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;"></i>

                                                          <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type='text' placeholder="{{__('text.Mobile No')}}" name="phone" class="form-control" id='phone' />

                                                      </div>

                                                  </div>

                                                  <div class="form-group">

                                                      <div style="width: 100%;position: relative;">

                                                          <i class="far fa-comment-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;margin:10px 0 0;pointer-events:none;"></i>

                                                          <textarea style="height:100px;padding-left:40px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" class="form-control" id="message-text" placeholder="{{__('text.Message')}}" name="message"></textarea>


                                                      </div>

                                                  </div>


                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.Close')}}</button>
                                                  <button type="submit" class="btn btn-primary" style="outline: none;">{{__('text.Send message')}}</button>
                                              </div>
                                          </div>

                                      </form>


                                  </div>
                              </div>

                          </div>


                        <h3>{{__('text.Property Overview')}}</h3>

                          @if($property->new_construction != 1)

                          <div class="row" style="margin: 30px 0px;">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12" style="padding: 0;">
                                  <label class="head-label" style="color: #434343;font-weight: 600;">{{__('text.Bedrooms')}}<img src="{{ URL::asset('assets/img/bed.png') }}" style="width: 25px;margin: 0px 13px;" /><span style="font-size: 20px;color: #4d4b4b;">{{$property->bedrooms}}</span></label>
                                  <label class="mid-label" style="color: #434343;font-weight: 600;margin: 0px 65px;">{{__('text.Bathrooms')}}<img src="{{ URL::asset('assets/img/bathroom.png') }}" style="width: 25px;margin: 0px 13px;margin-bottom: 3px;" /><span style="font-size: 20px;color: #4d4b4b;">{{$property->bathrooms}}</span></label>
                                  @if($property->area)
                                  <label class="head-label" style="color: #434343;font-weight: 600;">{{__('text.Area')}} <small>(m2)</small><img src="{{ URL::asset('assets/img/browser.png') }}" style="width: 20px;margin: 0px 13px;margin-bottom: 3px;" /><span style="font-size: 17px;color: #4d4b4b;">{{$property->area}} <small>m2</small></span></label>
                                  @endif
                              </div>
                          </div>

                          @endif

                          <table class="table table-bordered">
                              <tr>
                                  <td><strong>{{__('text.Type')}}</strong> <img src="{{ URL::asset('assets/img/house.png') }}" style="width: 18px;float: right;" /></td>
                                  <td>{{ getPropertyTypeName($property->property_type)->types }}</td>
                              </tr>
                          </table>

                        <table class="table table-bordered">
                          {{--<tr>
                            <td width="20%"><strong>ID</strong></td>
                            <td>#{{$property->id}}</td>
                          </tr>--}}

                            @if($property->home_exchange == 1)

                                <tr>
                                    <td><strong>{{__('text.Owner')}}</strong></td>
                                    <td>{{$property->owner}}</td>
                                </tr>

                                    <tr>
                                        <td><strong>{{__('text.Rent')}}</strong></td>
                                        <td>€ {{number_format($property->rent_per_month, 0, ',', '.')}}</td>
                                    </tr>


                                @endif

                            @if($property->home_exchange != 1)

                                <tr>
                                    <td><strong>{{__('text.Price')}}</strong> <img src="{{ URL::asset('assets/img/tag.png') }}" style="width: 18px;float: right;" /></td>
                                    <td>€@if($property->sale_price) {{number_format($property->sale_price, 0, ',', '.')}} {{$property->cost_for}} @else {{number_format($property->rent_price, 0, ',', '.')}} @endif</td>
                                </tr>

                                @if($property->new_construction != 1)

                                    <tr>
                                        <td><strong>{{__('text.Contract')}}</strong> <img src="{{ URL::asset('assets/img/communications.png') }}" style="width: 18px;float: right;" /></td>
                                        <td>{{__('text.'.$property->property_purpose)}}</td>
                                    </tr>

                                  @endif

                            @endif

                          <tr>
                            <td><strong>{{__('text.Location')}}</strong> <img src="{{ URL::asset('assets/img/pin.png') }}" style="width: 18px;float: right;" /></td>
                            <td>{{$property->address}}</td>
                          </tr>

                            @if($property->new_construction != 1)

                          <tr>
                            <td><strong>{{__('text.Bathrooms')}}</strong> <img src="{{ URL::asset('assets/img/bathroom.png') }}" style="width: 18px;float: right;" /></td>
                            <td>{{$property->bathrooms}}</td>
                          </tr>

                          <tr>
                            <td><strong>{{__('text.Bedrooms')}}</strong> <img src="{{ URL::asset('assets/img/bed.png') }}" style="width: 18px;float: right;" /></td>
                            <td>{{$property->bedrooms}}</td>
                          </tr>

                                @if($property->area)

                          <tr>
                            <td><strong>{{__('text.Area')}} <small>(m2)</small></strong></td>
                            <td>{{$property->area}} m2</td>
                          </tr>

                                    @endif

                            @endif

                        </table>

                          <table class="table table-bordered" style="table-layout: fixed;">

                              @if($property->kind_of_type)
                                  <tr>
                                      <td><strong>{{__('text.Kind of Type')}}</strong></td>
                                      <td>{{__('text.'.$property->kind_of_type)}}</td>
                                  </tr>
                              @endif

                                  @if($property->realization)

                                      <tr>
                                          <td><strong>{{__('text.Realization')}}</strong></td>
                                          <td>{{$property->realization}}</td>
                                      </tr>

                                  @endif

                                  @if($property->homes)

                                      <tr>
                                          <td><strong>{{__('text.Homes')}}</strong></td>
                                          <td>{{$property->homes}}</td>
                                      </tr>

                                  @endif

                                  @if($property->rental_properties)

                                      <tr>
                                          <td><strong>{{__('text.Rental Properties')}}</strong></td>
                                          <td>{{$property->rental_properties}}</td>
                                      </tr>

                                  @endif


                                  @if($property->citation)

                                      <tr>
                                          <td><strong>{{__('text.Source Project')}}</strong></td>
                                          <td>{{$property->Citation}}</td>
                                      </tr>

                                  @endif

                                  @if($property->owner)

                                      <tr>
                                          <td><strong>{{__('text.Owner')}}</strong></td>
                                          <td>{{$property->owner}}</td>
                                      </tr>

                                  @endif


                                  @if($property->new_construction != 1)


                            @if($property->garage)
                                <tr>
                                    <td><strong>{{__('text.Garage')}} <small>(m2)</small></strong></td>
                                    <td>{{$property->garage}} m2</td>
                                </tr>
                            @endif


                            @if($property->construction_type)

                                <tr>
                                    <td><strong>{{__('text.Type of Construction')}}</strong></td>
                                    <td>{{__('text.'.$property->construction_type)}}</td>
                                </tr>

                            @endif


                            @if($property->year_construction)

                                <tr>
                                    <td><strong>{{__('text.Year of construction')}}</strong></td>
                                    <td>{{$property->year_construction}}</td>
                                </tr>

                            @endif

                            @if($property->building_condition)

                                <tr>
                                    <td><strong>{{__('text.Condition of the building')}}</strong></td>
                                    <td>{{__('text.'.$property->building_condition)}}</td>
                                </tr>

                            @endif

                            @if($property->volume)

                                <tr>
                                    <td><strong>{{__('text.Volume')}} <small>(m3)</small></strong></td>
                                    <td>{{$property->volume}} m3</td>
                                </tr>

                            @endif

                                @if($property->home_exchange !=1)

                                    @if($property->floors)

                                        <tr>
                                            <td><strong>{{__('text.Floors')}}</strong></td>
                                            <td>{{$property->floors}}</td>
                                        </tr>

                                    @endif

                                @endif

                            @if($property->backyard)

                                <tr>
                                    <td><strong>{{__('text.Backyard')}} <small>(m2)</small></strong></td>
                                    <td>{{$property->backyard}} m2</td>
                                </tr>

                            @endif

                            @if($property->frontyard)

                                <tr>
                                    <td><strong>{{__('text.Frontyard')}} <small>(m2)</small></strong></td>
                                    <td>{{$property->frontyard}} m2</td>
                                </tr>

                            @endif

                            @if($property->terrace)

                                <tr>
                                    <td><strong>{{__('text.Terrace')}} <small>(m2)</small></strong></td>
                                    <td>{{$property->terrace}} m2</td>
                                </tr>

                            @endif

                            @if($property->garage_type)

                                <tr>
                                    <td><strong>Type Garage</strong></td>
                                    <td>{{$property->garage_type}}</td>
                                </tr>

                            @endif

                            @if($property->energy_rating)

                                <tr>
                                    <td><strong>{{__('text.Energy Rating')}}</strong> <img src="{{ URL::asset('assets/img/green-house.png') }}" style="width: 18px;float: right;" /></td>
                                    <td>{{$property->energy_rating}}</td>
                                </tr>

                            @endif

                            @if($property->solar_panel)

                                <tr>
                                    <td><strong>{{__('text.Solar Panel')}}</strong></td>
                                    <td>{{$property->solar_panel}}</td>
                                </tr>

                            @endif

                            @if($property->floor_option)

                                <tr>
                                    <td><strong>{{__('text.Floors')}}</strong></td>
                                    <td>{{__('text.'.$property->floor_option)}}</td>
                                </tr>

                            @endif

                            @if($property->walls)

                                <tr>
                                    <td><strong>{{__('text.Walls')}}</strong></td>
                                    <td>{{__('text.'.$property->walls)}}</td>
                                </tr>

                            @endif

                            @if($property->roof_insulation)

                                <tr>
                                    <td><strong>{{__('text.Roof Insulation')}}</strong></td>
                                    <td>{{__('text.'.$property->roof_insulation)}}</td>
                                </tr>

                            @endif

                            @if($property->cook)

                                <tr>
                                    <td><strong>{{__('text.Cook')}}</strong> <img src="{{ URL::asset('assets/img/cook.png') }}" style="width: 18px;float: right;" /></td>
                                    <td>{{__('text.'.$property->cook)}}</td>
                                </tr>

                            @endif

                            @if($property->type_of_boiler)

                                <tr>
                                    <td><strong>Type Boiler</strong></td>
                                    <td>{{$property->type_of_boiler}}</td>
                                </tr>

                            @endif

                            @endif

                                  @if($property->home_exchange != 1 && $property->new_construction != 1)

                                    @if($property->rent_price)

                                          <tr>
                                              <td><strong>{{__('text.Type of agreement')}}</strong></td>
                                              <td>{{__('text.'.$property->agreement_type)}}</td>
                                          </tr>

                                          <tr>
                                              <td><strong>{{__('text.Property furnished')}}</strong></td>
                                              <td>{{__('text.'.$property->property_furnished)}}</td>
                                          </tr>

                                        @endif

                                  @endif



                                  @if($property->new_construction != 1)

                            @if($property->year_boiler)

                                <tr>
                                    <td><strong>{{__('text.Year of the boiler')}}</strong></td>
                                    <td>{{$property->year_boiler}}</td>
                                </tr>

                            @endif



                            @if($property->available_from)

                                      <?php
                                      $originalDate = str_replace("/","-",$property->available_from);

                                      $source = $originalDate;
                                      $date = new Carbon\Carbon($source);

                                      setlocale(LC_TIME, 'Dutch');

                                      $available_from = $date->formatLocalized('%d %B %Y');


                                      ?>

                                <tr>
                                    <td><strong>{{__('text.Available From')}}</strong> <img src="{{ URL::asset('assets/img/calendar.png') }}" style="width: 18px;float: right;" /></td>
                                    <td>{{$available_from}}</td>
                                </tr>

                            @endif


                                  @if($property->service_costs)

                                      <tr>
                                          <td><strong>{{__('text.Service Costs')}}</strong></td>
                                          <td>{{$property->service_costs}}</sup> </td>
                                      </tr>

                                  @endif

                                      @endif


                        </table>


                          @if($property->wheelchair)


                              <div class="row" style="margin: 40px 0px;">


                                  <ul style="list-style: none;padding: 0;">


                                          <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 20px 0px;padding: 0;">

                                              <img src="{{ URL::asset('assets/img/signaling.png') }}" style="width: 30px;position: relative;top:-1px;margin-right: 9px;" />

                                              <span style="font-size: 19px;font-weight: 600;position: relative;top: 4px;">{{__('text.Wheelchair friendly home for people with walking difficulties')}}</span>

                                          </li>


                                  </ul>

                              </div>

                          @endif

                          <h3 style="margin-top: 55px;">{{__('text.Travel Time')}}</h3>

                          <div class="row" style="margin: 40px 0px;">

                              <img src="{{ URL::asset('assets/img/travel-time-logo.png') }}" style="width: 110px;display: block;margin-bottom: 20px;" />

                              <a  id="cal_dist" style="cursor: pointer;"><i class="fas fa-plus" style="margin-right: 12px;"></i>{{__('text.Add Location')}}</a>

                              <div class="travel-time" style="display: none;">

                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 30px;">

                                      <input type="hidden" name="travel_latitude" id="travel_latitude" value="{{$property->map_latitude}}">
                                      <input type="hidden" name="travel_longitude" id="travel_longitude" value="{{$property->map_longitude}}">
                                      <input type="hidden" name="travel_address" id="travel_address" value="{{$property->address}}" >

                                      <div id="travel-map-container" style="width:100%;height:400px; ">
                                          <div style="width: 100%; height: 100%; position: relative; overflow: hidden;" id="travel-map"></div>
                                      </div>

                                  </div>

                                  <h2 class="travel-time__heading">{{__('text.Your travel time')}}</h2>

                                  <p class="travel-time__txt">{{__('text.From')}} {{$property->address}}</p>

                                  <div id="travel_data">

                                  <div class="travel-time-transport-modes" style="overflow-x: auto;overflow-y: hidden;white-space: nowrap;">

                                      <a href="#DRIVING" data-toggle="tab"  style="text-decoration: none;" class="travel-time-transport-modes__button travel-time-transport-modes--active" disabled="">{{__('text.Driving')}}</a>

                                      <a href="#TRANSIT" data-toggle="tab"  style="text-decoration: none;" class="travel-time-transport-modes__button ">{{__('text.Transit')}}</a>

                                      <a href="#WALKING" data-toggle="tab"  style="text-decoration: none;" class="travel-time-transport-modes__button ">{{__('text.Walking')}}</a>

                                      <a href="#BICYCLING" data-toggle="tab"  style="text-decoration: none;" class="travel-time-transport-modes__button ">{{__('text.Cycling')}}</a>

                                  </div>

                                          <div class="travel-time-table active" id="DRIVING">

                                          </div>


                                          <div class="travel-time-table" id="TRANSIT">

                                          </div>


                                          <div class="travel-time-table" id="WALKING">

                                          </div>


                                          <div class="travel-time-table" id="BICYCLING">


                                          </div>


                                      <form id="loc-form">

                                      <input type="hidden" name="_token" value="{{csrf_token()}}">

                                          <div class="travel-time-add__inputs" style="margin-top: 25px;">

                                              <label class="travel-time-add__address col-xs-12" style="font-size: 17px;font-weight: 600;margin-bottom: 25px;">{{__('text.To')}}

                                                  <div class="input-container">

                                                      <span style="display: flex;flex-direction: row;border:1px solid #e5e5e5;">

                                                      <img src="{{ URL::asset('assets/img/tools-and-utensils.png') }}" style="width: 15px;margin-left: 18px;align-self: center;" />

                                                      <input  class="input-field add-location loc-input" type="text" placeholder="{{__('text.Location')}}" name="loc" id="loc-input" style="border: 0;outline: 0;width: 100%;">

                                                          <input  type="hidden" name="loc" id="loc-real">

                                                      <img class="loc-remove" src="{{ URL::asset('assets/img/close.png') }}" style="width: 15px;float: right;position: relative;right: 15px;display: none;cursor: pointer;align-self: center;" />

                                                      <input type="hidden" name="loc_latitude" id="loc-latitude"  />
                                                      <input type="hidden" name="loc_longitude" id="loc-longitude"  />

                                                      </span>

                                                  </div>

                                              </label>

                                              <label class="travel-time-add__address col-xs-12" style="font-size: 17px;font-weight: 600;margin-bottom: 25px;">{{__('text.Name')}}

                                                  <div class="input-container">

                                                      <input class="input-field name-destination" type="text" placeholder="{{__('text.Name your destination (Optional)')}}" name="destination_name" id="destination_name">

                                                  </div>

                                              </label>

                                          </div>



                                          <div class="travel-time-add__cta-wrapper">

                                              <input type="button" class="rui-button-brand rui-button-disabled" value="{{__('text.Add location')}}" disabled="">

                                          </div>

                                          <input type="hidden" name="p_id" id="p_id" value="{{$property->id}}">

                                          <input type="hidden" name="u_id" id="u_id"  @if( isset(Auth::user()->usertype) ) value="{{Auth::user()->id}}" @else value="" @endif>

                                      </form>

                                  </div></div>

                              <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

                              <style>

                                  td:nth-child(1)
                                  {
                                      width: 25%;
                                  }

                                  @media (max-width: 680px){

                                      td:nth-child(1)
                                      {
                                          width: 60%;
                                      }

                                      .head-label{width: 100%;}

                                      .mid-label{margin: 20px 0px !important;width: 100%;}

                                  }

                                  .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td
                                  {
                                      border: 1px solid #3fd4eb;
                                  }

                                  @media (max-width: 991px){

                                      .mobile-row{display: flex;flex-flow: column;}

                                      .mobile-row .main-content{order:0}

                                      .mobile-row .sidebar{order:2}

                                  }

                                  .accordion {
                                      background-color: #fff;
                                      color: #595959;
                                      cursor: pointer;
                                      padding: 18px;
                                      width: 100%;
                                      border: none;
                                      text-align: left;
                                      outline: none;
                                      font-size: 18px;
                                      transition: 0.4s;
                                  }

                                  @media (max-width: 645px){

                                      #street_view{display: none;}

                                      .accordion{padding: 5px;}
                                  }

                                  .accordion span:first-child{
                                      font-weight: bold;
                                  }

                                  .accordion span:nth-child(2){
                                      font-size: 13px;
                                  }

                                  #panel .active {
                                      background-color: #f9f9f9;
                                      /*border-bottom: 1px solid rgba(190, 190, 190, 0.6);*/
                                  }

                                  .accordion:hover
                                  {
                                      background-color: #f9f9f9;
                                  }

                                  .accordion:after {
                                      font-family: "Font Awesome 5 Free";
                                      content: "\f0dd";
                                      color: #0071b3;
                                      font-weight: bold;
                                      float: right;
                                      margin-left: 5px;
                                  }

                                  #panel .active:after {
                                      content: "\f0de";
                                  }

                                  .panel {
                                      padding: 0;
                                      background-color: white;
                                      max-height: 0;
                                      overflow-y: auto;
                                      transition: max-height 0.2s ease-out;
                                  }

                                  .video-wrapper-inner .popup-video{position:relative;z-index:1;display:inline-block;width:50px;height:50px;line-height:50px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;font-size:18px;color:#fff;background:#f9424b;text-align:center}

                                  @media (min-width: 1200px){.video-wrapper-inner .popup-video{width:70px;height:70px;line-height:70px;font-size:22px}}

                                  .video-wrapper-inner .popup-video:before{-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;content:'';position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;background:#f9424b;opacity:0.3;filter:alpha(opacity=30);border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-animation:scaleicon 3s ease-in-out 0s infinite alternate;animation:scaleicon 3s ease-in-out 0s infinite alternate}.widget-video.style2 .popup-video{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}

                                  @-webkit-keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

                                  @keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

                                  .tabs-gallery-map .nav-table{position:absolute;top:10px;z-index:4;left:15px}

                                  .media-icons .nav-table{border:0;padding:0;margin:0;list-style: none;text-align: center;}

                                  @media (min-width: 1200px){.tabs-gallery-map .nav-table{top:45px}}

                                  .media-icons .nav:before,.nav:after{content:" ";display:table}

                                  .media-icons .nav>li{position:relative;display:inline-block}

                                  .media-icons .nav-tabs>li{float:none;margin-bottom:-1px}

                                  .media-icons .nav-table>li{margin-bottom:0 !important;margin-right:8px}


                                  .media-icons .nav-table>li.active>a:hover,.media-icons .nav-table>li.active>a:focus,.media-icons .nav-table>li.active>a{background-color:#28aedd;color:#fff}

                                  .media-icons .nav-table>li>a:hover,.media-icons .nav-table>li>a:focus{background-color:#28aedd;color:#fff}

                                  .media-icons .nav>li>a{position:relative;display:block;padding:10px
                                  15px}


                                  .media-icons .nav-table>li>a{border:0
                                  !important;display:inline-block;cursor: pointer !important;font-size: 14px !important;font-weight: 500 !important;padding:0;padding-top: 0 !important;padding-bottom: 0 !important;margin:0;text-align:center;width:35px;height:35px;line-height:35px;background-color:#515d68;color:#fff;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;border-radius:6px;-webkit-border-radius:6px;-moz-border-radius:6px;-ms-border-radius:6px;-o-border-radius:6px}

                                  @media (min-width: 1200px){.media-icons .nav-table>li>a{width:55px;height:50px;line-height:50px;font-size:21px !important;font-weight: 500 !important;}}


                                  @media (min-width: 1200px){
                                      .new-icons{width: 50px !important;height: 48px !important;line-height: 47px !important;}
                                  }

                                  .new-button:hover{background-color:#28aedd;color:#fff}

                                  .new-button:hover, .new-button:focus{background-color:#28aedd;color:#fff}

                                  .new-button{position:relative;display:block;padding:10px 15px}


                                  .new-button{border:0
                                  !important;display:inline-block;cursor: pointer !important;font-size: 14px !important;font-weight: 500 !important;padding:0;padding-top: 0 !important;padding-bottom: 0 !important;margin:0;text-align:center;width:35px;height:35px;line-height:35px;background-color:#515d68;color:#fff;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;border-radius:6px;-webkit-border-radius:6px;-moz-border-radius:6px;-ms-border-radius:6px;-o-border-radius:6px}

                                  @media (min-width: 1200px){.new-button{width:55px;height:50px;line-height:50px;font-size:21px !important;font-weight: 500 !important;}}

                                  .flaticon-photo-camera:before{content:"\f107"}

                                  [class^="flaticon-"]:before,[class*=" flaticon-"]:before,[class^="flaticon-"]:after,[class*=" flaticon-"]:after{font-family:Flaticon;font-style:normal}

                                  .travel-time-add__cta-wrapper{margin:.5rem 0 0;width:100%;text-align:right}

                                  .travel-time-transport-modes::-webkit-scrollbar-track
                                  {
                                      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                                      background-color: #F5F5F5;
                                      height: 5px;
                                  }

                                  .travel-time-transport-modes::-webkit-scrollbar
                                  {
                                      width: 6px;
                                      background-color: #F5F5F5;
                                      height: 5px;
                                  }

                                  .travel-time-transport-modes::-webkit-scrollbar-thumb
                                  {
                                      background-color: #919191;
                                      height: 5px;
                                  }

                                  .rui-button-brand.rui-button-disabled,.rui-button-brand.rui-button-disabled:hover{color:#8e9397;border-color:#eaebec;background:#eaebec}

                                  .rui-button-basic, .rui-button-basic-light, .rui-button-brand, .rui-button-brand-dark{display:inline-block;font-family:Museo-Sans-500,Helvetica Neue,Helvetica,Arial,sans-serif;text-decoration:none;padding:.875em 1em;font-weight:400;font-size:1em;cursor:pointer;border-radius:4px;line-height:1;border-width:2px;border-style:solid;color:#fff;text-align:center;transition-duration:.2s,.2s;transition-timing-function:ease-in,ease-out}

                                  .rui-button-brand{border-color:#e4002b;background:#e4002b;}

                                  ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
                                      color: #bebebe;
                                      opacity: 1; /* Firefox */
                                  }

                                  :-ms-input-placeholder { /* Internet Explorer 10-11 */
                                      color: #bebebe;
                                  }

                                  ::-ms-input-placeholder { /* Microsoft Edge */
                                      color: #bebebe;
                                  }

                                  .add-location
                                  {
                                      padding:15px;
                                      padding-left: 30px;
                                      font-weight: 100;
                                      font-size: 18px;
                                      background: white;
                                  }

                                  .name-destination
                                  {

                                      padding:15px;
                                      padding-left: 35px;
                                      border:1px solid #e5e5e5;
                                      width: 100%;
                                      font-weight: 100;
                                      font-size: 18px;
                                  }

                                  @media only screen and (min-width:501px){.travel-time-add__inputs{width:100%;display:flex;flex-direction:row}.travel-time-add__address{width:50%;margin-right:.75rem;}}


                                  .travel-time{margin-top:2.5rem;padding-top:2.5rem;border-top:1px solid #d2d5da;border-bottom: 1px solid #d2d5da;padding-bottom: 30px;}

                                  .travel-show{
                                      -webkit-animation: slide-down 1.3s ease-out;
                                      -moz-animation: slide-down 1.3s ease-out;
                                      animation: slide-down 1.3s ease-out;
                                  }

                                  .travel-hide{
                                      -webkit-animation: slide-up 1.3s ease-out;
                                      -moz-animation: slide-up 1.3s ease-out;
                                      animation: slide-up 1.3s ease-out;
                                  }

                                  @media only screen and (min-width:501px){.travel-time__heading{font-size:2.125rem !important;line-height:2.5rem !important;margin-bottom: 10px !important;}}

                                  .travel-time-transport-modes{border-bottom: 1px solid #e9ebed;margin-top: 20px;}

                                  .travel-time-transport-modes--active{color:#2b6ed2;border-bottom:2px solid #2b6ed2 !important;}

                                  .travel-time-transport-modes__button{font-size: 122%;cursor:pointer !important;border:none;border-bottom:2px solid transparent;font-family:Museo-Sans-500,Helvetica Neue,Helvetica,Arial,sans-serif;background:transparent;padding:6px 15px;line-height:2;-webkit-appearance:none;-moz-appearance:none}

                                  @media only screen and (max-width:700px){.travel-time-transport-modes__button{border-bottom: 0 !important;}}

                                  .travel-time-table{width: 100%;display: none;}

                                  .active{display: block;}

                                  .travel-time-table, .travel-time__txt{ margin-bottom: .75rem; }

                                  .travel-time-row{width:100%;display:flex;flex-direction:row;align-items:center;justify-content:space-between;padding:10px 10px;border-bottom:1px solid #e9ebed;transition: background-color 0.2s ease-in-out;cursor: pointer;}

                                  .travel-time-row:hover{background-color: #f9f9f9;color: black;}

                                  .active-row{border-left:6px solid #0ea800;}

                                  .travel-time-row__input{width:50%;padding-right:.75rem}

                                  @media only screen and (min-width:501px){.travel-time-row__name,.travel-time-row__duration{font-size:16px;line-height:3.5rem;font-weight: 600;}}

                                  .travel-time-row__name{text-overflow:ellipsis;white-space:nowrap;overflow:hidden}

                                  .travel-time-row__result{width:30%;padding-right:.75rem;overflow:hidden}

                                  .travel-time-row__btn{font-family:Museo-Sans-300,Helvetica Neue,Helvetica,Arial,sans-serif;font-size:12px;background-color: white;line-height:1rem;border-width:1px;font-family:Museo-Sans-500,Helvetica Neue,Helvetica,Arial,sans-serif}

                                  .rui-button-basic{color:#333f48 !important;border-color:#c3c8ce}

                                  @-webkit-keyframes slide-down {
                                      0% { opacity: 0; -webkit-transform: translateY(-10%); }
                                      100% { opacity: 1; -webkit-transform: translateY(0); }
                                  }
                                  @-moz-keyframes slide-down {
                                      0% { opacity: 0; -moz-transform: translateY(-10%); }
                                      100% { opacity: 1; -moz-transform: translateY(0); }
                                  }
                                  @keyframes slide-down {
                                      0% { opacity: 0; transform: translateY(-10%); }
                                      100% { opacity: 1; transform: translateY(0); }
                                  }

                                  @-webkit-keyframes slide-up {
                                      0% { opacity: 1; -webkit-transform: translateY(0); }
                                      100% { opacity: 0; -webkit-transform: translateY(-10%); }
                                  }
                                  @-moz-keyframes slide-up {
                                      0% { opacity: 1; -moz-transform: translateY(0); }
                                      100% { opacity: 0; -moz-transform: translateY(-10%); }
                                  }
                                  @keyframes slide-up {
                                      0% { opacity: 1; transform: translateY(0); }
                                      100% { opacity: 0; transform: translateY(-10%); }
                                  }



                              </style>

                          </div>

                          @if($property_features)

                        <h3 style="margin-top: 55px;">{{__('text.Property Features')}}</h3>

                        <div class="row" style="margin: 40px 0px;">


							<ul style="list-style: none;display: flex;flex-wrap: wrap;">
                              @foreach($property_features as $key => $value)

                                    <li class="col-md-6 col-sm-6 col-xs-12" style="margin: 30px 0px;display: flex;">

                                    <img src="{{ URL::asset('assets/img/'.$value) }}" style="width: 30px;height: 30px;position: relative;top:-1px;margin-right: 9px;" />

                                        <span style="font-size: 17px;font-weight: 600;">{{$key}}</span>

                                    </li>

                                @endforeach

                            </ul>

						</div>

                          @endif

                        <h3 style="margin-top: 55px;">{{__('text.Property Description')}}</h3>

                        {!!$property->description!!}



                          @if($property->video)


                          <div class="row" style="margin-top: 40px;">

                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                  <h2>{{__('text.Property Video')}}</h2>

                                  <?php $ext = pathinfo($property->video, PATHINFO_EXTENSION);

                                  $ext = strtolower($ext);


                                  ?>


                                  <video id="player1" playsinline controls>
                                      <source src="{{ URL::asset('upload/properties/'.$property->video) }}" type="video/{{$ext}}" />
                                      <source src="{{ URL::asset('upload/properties/'.$property->video) }}" type="video/mp4" />
                                      <source src="{{ URL::asset('upload/properties/'.$property->video) }}" type="video/ogv" />
                                      <source src="{{ URL::asset('upload/properties/'.$property->video) }}" type="video/webm" />

                                  </video>

                              </div></div>

                          @endif



                          @if(count($property_documents) > 0)

                          <div class="row" style="margin-top: 40px;">

                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                  <h2>{{__('text.Files Attachments')}}</h2>

                                  @foreach($property_documents as $key)

                                      <?php $ext = pathinfo($key->document, PATHINFO_EXTENSION);

                                      $ext = strtolower($ext);

                                      ?>

                                  @if($ext == 'pdf')

                                      <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                              <div style="display:inline-block;margin: 10px;">
                                                  <img src="{{ URL::asset('assets/img/pdf.png') }}" style="width: 45px;">
                                                  <label style="cursor: pointer">{{__('text.Download')}}</label>
                                              </div>

                                      </a>

                                      @elseif($ext == 'docx')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                              <div style="display:inline-block;margin: 10px;">
                                                  <img src="{{ URL::asset('assets/img/docx.png') }}" style="width: 45px;">
                                                  <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                              </div>

                                              </a>

                                          @elseif($ext == 'doc')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/doc.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'txt')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/txt.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'pptx')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/pptx.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'ppt')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/ppt.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'wpd')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/wpd.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'rtf')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/rtf.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                  </div>

                                              </a>

                                      @endif

                                      @endforeach


                              </div></div>

                              @endif

                          @if($property->first_floor || $property->second_floor || $property->ground_floor || $property->basement)

                              <div class="row" style="margin-top: 40px;">

                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                      <h2>{{__('text.Floor Plans')}}</h2>

                                      <ul style="list-style: none;display: inline-block;padding: 0;">

                                          @if($property->first_floor)
                                          <li style="float: left;margin: 10px;">
                                              <a style="text-decoration: underline;cursor: pointer;" data-id="first" class="floors_links">{{__('text.First Floor')}}</a>
                                          </li>
                                           @endif

                                              @if($property->second_floor)
                                                  <li style="float: left;margin: 10px;">
                                                      <a style="text-decoration: underline;cursor: pointer;" data-id="second" class="floors_links">{{__('text.Second Floor')}}</a>
                                                  </li>
                                              @endif

                                              @if($property->ground_floor)
                                                  <li style="float: left;margin: 10px;">
                                                      <a style="text-decoration: underline;cursor: pointer;" data-id="ground" class="floors_links">{{__('text.Ground Floor')}}</a>
                                                  </li>
                                              @endif

                                              @if($property->basement)
                                                  <li style="float: left;margin: 10px;">
                                                      <a style="text-decoration: underline;cursor: pointer;" data-id="basement" class="floors_links">{{__('text.Basement')}}</a>
                                                  </li>
                                              @endif
                                      </ul>

                                      <?php $check = 0; ?>

                                      <div id="floors_box" class="tab-content" style="border: 0;padding: 20px;">

                                      @if($property->first_floor)

                                              <?php $ext = pathinfo($property->first_floor, PATHINFO_EXTENSION);

                                              $ext = strtolower($ext);

                                              ?>

                                      <div class="tab-pane fade active in" id="first">

                                          <h4 style="text-align: center;">{{__('text.First Floor')}}</h4>

                                          @if($ext == 'pdf')

                                              <a href="{{ URL::asset('upload/properties/'.$property->first_floor) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;margin-top: 50px;">
                                                      <img src="{{ URL::asset('assets/img/pdf.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                  </div>

                                              </a>


                                              @else

                                              <img style="display: block;width: 80%;margin: auto;" src="{{ URL::asset('upload/properties/'.$property->first_floor) }}">

                                              @endif


                                      </div>

                                          <?php $check = 1; ?>

                                      @endif

                                      @if($property->second_floor)

                                              <?php $ext = pathinfo($property->second_floor, PATHINFO_EXTENSION);

                                              $ext = strtolower($ext);

                                              ?>

                                          <div  @if(!$check) class="tab-pane fade active in" <?php $check = 1; ?> @else class="tab-pane fade"  @endif id="second">

                                              <h4 style="text-align: center;">{{__('text.Second Floor')}}</h4>

                                              @if($ext == 'pdf')

                                                  <a href="{{ URL::asset('upload/properties/'.$property->second_floor) }}" style="display: inline-block">

                                                      <div style="display:inline-block;margin: 10px;margin-top: 50px;">
                                                          <img src="{{ URL::asset('assets/img/pdf.png') }}" style="width: 45px;">
                                                          <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                      </div>

                                                  </a>


                                              @else

                                              <img style="display: block;width: 80%;margin: auto;" src="{{ URL::asset('upload/properties/'.$property->second_floor) }}">

                                                  @endif

                                          </div>


                                      @endif

                                      @if($property->ground_floor)

                                              <?php $ext = pathinfo($property->ground_floor, PATHINFO_EXTENSION);

                                              $ext = strtolower($ext);

                                              ?>

                                          <div @if(!$check) class="tab-pane fade active in" <?php $check = 1; ?> @else class="tab-pane fade"  @endif id="ground" >

                                              <h4 style="text-align: center;">{{__('text.Ground Floor')}}</h4>

                                              @if($ext == 'pdf')

                                                  <a href="{{ URL::asset('upload/properties/'.$property->ground_floor) }}" style="display: inline-block">

                                                      <div style="display:inline-block;margin: 10px;margin-top: 50px;">
                                                          <img src="{{ URL::asset('assets/img/pdf.png') }}" style="width: 45px;">
                                                          <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                      </div>

                                                  </a>


                                              @else

                                              <img style="display: block;width: 80%;margin: auto;" src="{{ URL::asset('upload/properties/'.$property->ground_floor) }}">

                                                  @endif
                                          </div>



                                      @endif

                                      @if($property->basement)

                                              <?php $ext = pathinfo($property->basement, PATHINFO_EXTENSION);

                                              $ext = strtolower($ext);

                                              ?>

                                          <div @if(!$check) class="tab-pane fade active in" <?php $check = 1; ?> @else class="tab-pane fade"  @endif id="basement" >

                                              <h4 style="text-align: center;">{{__('text.Basement')}}</h4>

                                              @if($ext == 'pdf')

                                                  <a href="{{ URL::asset('upload/properties/'.$property->basement) }}" style="display: inline-block">

                                                      <div style="display:inline-block;margin: 10px;margin-top: 50px;">
                                                          <img src="{{ URL::asset('assets/img/pdf.png') }}" style="width: 45px;">
                                                          <label style="cursor:pointer;">{{__('text.Download')}}</label>
                                                      </div>

                                                  </a>


                                              @else

                                              <img style="display: block;width: 80%;margin: auto;" src="{{ URL::asset('upload/properties/'.$property->basement) }}">

                                                  @endif

                                          </div>



                                      @endif

                                      </div>

                                  </div></div>

                              @endif


                      </div>

                    </div>
					<br/>
                    {!! getcong('disqus_comment_code') !!}

                  </div>
                  <!-- break -->
                  <div class="tab-pane fade" id="location">

                    <div class="row">
                      <div class="col-md-12">
                        <h3>Contact </h3>
                      </div>
                    </div>
                    <div class="row" style="display:inline-block;width: 100%;margin: 0;">
                      <div class="col-md-6 col-sm-6">
                        <div class="team-container team-dark">
                          <div class="team-image" style="margin-left: -1px;">
                              <a style="outline: none;" href="{{URL::to('agents/details/'.$agent->id)}}">
                            @if($agent->image_icon)
                            <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" alt="{{$agent->name}}">
                            @else
                            <img src="{{ URL::asset('upload/members/user-icon.jpg') }}" alt="{{$agent->name}}">
                            @endif
                              </a>
                          </div>
                          <div class="team-description">
                            <h3><a style="color: white;" href="{{URL::to('agents/details/'.$agent->id)}}">{{$agent->name}}</a></h3>
                            <p><i class="fa fa-phone"></i> {{__('text.Mobile No')}} : {{$agent->phone}}<br></p>
                            <p><i class="fa fa-envelope"></i>&nbsp Email : {{$agent->email}}</p>
                            <p>{{$agent->about}}</p>

                              @if($properties_count>1)
                                  <p><a style="color: white;font-weight: 600;text-shadow: 0px 0px 4px #5d5d5d;" href="{{ URL::to('/agent-properties/user/'.$agent->id.'/'.$property->id) }}" target="_blank">@if($properties_count == 2) {{__('text.See Other property posted by this Broker',['property' => $properties_count-1])}} @else {{__('text.See Other properties posted by this Broker',['properties' => $properties_count-1])}} @endif</a></p>
                              @endif

                            <div class="team-social">

                                @if($agent->twitter)
                                    <span><a href="{{$agent->twitter}}" title="Twitter" rel="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a></span>
                                @endif

                                @if($agent->facebook)
                                    <span><a href="{{$agent->facebook}}" title="Facebook" rel="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a></span>
                                @endif

                                @if($agent->gplus)
                                    <span><a href="{{$agent->gplus}}" title="Google Plus" rel="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a></span>
                                @endif

                                @if($agent->linkedin)
                                    <span><a href="{{$agent->linkedin}}" title="LinkedIn" rel="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a></span>
                                @endif

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">

                        {!! Form::open(array('url'=>'agentscontact','method'=>'POST', 'id'=>'agent_contact_form')) !!}
              			<meta name="_token" content="{!! csrf_token() !!}"/>

                         <input type="hidden" name="property_id" value="{{$property->id}}">

                         <input type="hidden" name="home_exchange" value="{{$property->home_exchange}}">

                         <input type="hidden" name="agent_id" value="{{$agent->id}}">

                         <input type="hidden" name="property_name" value="{{$property->property_name}}">

                          <div id="ajax" style="color: #db2424"></div>

                          <div class="form-group">

                              <div style="position: relative;width: 100%;">

                                  <div class="bulgy-radios" role="radiogroup" aria-labelledby="bulgy-radios-label" style="width: 100%;min-height: 50px;text-align: left;">

                                      <label style="margin-left: 5px;float: left;max-width: 80px;">
                                          <input type="radio" name="gender" value="Mr." checked />
                                          <span class="radio"></span>
                                          <span class="label">{{__('text.Mr.')}}</span>
                                      </label>

                                      <label>
                                          <input type="radio" name="gender" value="Ms." />
                                          <span class="radio"></span>
                                          <span class="label">{{__('text.Ms.')}}</span>
                                      </label>

                                  </div>

                              </div>

                          </div>

                          <div class="form-group">
                            <label for="name">{{__('text.Name')}}</label>
                            <input type="text" name="name" class="form-control input-lg" placeholder="{{__('text.Name')}}">
                          </div>
                          <div class="form-group">
                            <label for="email">{{__('text.Email Address')}}</label>
                            <input type="email" name="email" class="form-control input-lg" placeholder="E-mail">
                          </div>
                          <div class="form-group">
                            <label for="telp">{{__('text.Mobile No')}}</label>
                            <input type="text" name="phone" class="form-control input-lg" placeholder="{{__('text.Mobile No')}}">
                          </div>
                          <div class="form-group">
                            <label for="message">{{__('text.Message')}}</label>
                            <textarea name="message" class="form-control input-lg" rows="7" placeholder="{{__('text.Message')}}"></textarea>
                          </div>
                          <div class="form-group">
                            <input style="outline: none;" type="submit" name="submit" value="{{__('text.Send Message')}}" class="btn btn-primary btn-lg">
                          </div>
                        {!! Form::close() !!}


                      </div>

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
                @if($property->home_exchange == 1)

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div style="background-color: #fff;border: 1px solid #ddd;padding: 30px;">

                            <h4 style="text-align: center;">{{__('text.Requested Home Exchange House Heading')}}</h4>

                            <div class="row" style="margin: 0;margin-top: 50px;">

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="float: left;text-align: left;">
                                    <label>{{__('text.Preferred Place')}}</label>
                                    <p>{{$property->preferred_place}}</p>
                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="float: right;text-align: right;">
                                    <label>{{__('text.Preferred Radius')}}</label>
                                    <p>{{$property->preferred_radius}} KM</p>
                                </div>

                            </div>

                            <div class="row" style="margin: 0;margin-top: 50px;">

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="float: left;text-align: left;">
                                    <label>{{__('text.Minimum Rooms')}}</label>
                                    <p>{{$property->preferred_bedrooms}}</p>
                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="float: right;text-align: right;">
                                    <label>{{__('text.Preferred House Type')}}</label>
                                    <p>{{getPropertyTypeName($property->preferred_kind)->types}}</p>
                                </div>

                            </div>

                            <div class="row" style="margin: 0;margin-top: 50px;">

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="float: left;text-align: left;">
                                    <label>{{__('text.Preferred Maximum Rent')}}</label>
                                    <p>{{getcong('currency_sign')}} {{$property->preferred_rent_max}}</p>
                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="float: right;text-align: right;">
                                    <label>{{__('text.Preferred Area')}}</label>
                                    <p>{{$property->preferred_area}}</p>
                                </div>

                            </div>

                            @if($property->preferred_description)

                            <div class="row" style="margin: 0;margin-top: 50px;">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="float: left;text-align: left;">
                                    <label>{{__('text.Home exchange Description')}}</label>
                                    <p>{{$property->preferred_description}}</p>
                                </div>

                            </div>

                                @endif

                        </div>

                    </div>

                @endif
            </div>
          </div>
          <!-- end:article -->

            @if($property->new_construction != 1)

            <div class="col-xs-12 col-md-3 sidebar-property sidebar-wrapper">
                <div class="sidebar sidebar-right">

                    <aside class="widget widget_apus_property_contact_form" style="border:1px solid #e3e3e3;"><h2 class="widget-title" style="margin-bottom: 40px;"><span style="font-weight: 600;">Contact</span></h2>

                        <div class="contact-form-agent">
                            <div class="agent-content-wrapper flex-middle">
                                <div class="agent-thumbnail" style="border-radius: 0;">
                                    <div class="agent-logo-wrapper" style="width: 100%;height: 100%;">
                                        <a class="agent-logo" href="{{URL::to('agents/')}}">
                                            <div class="image-wrapper image-loaded" style="height: 100%;">
                                                @if($agent->image_icon)
                                                <img style="width: 100%;height: 100%;" src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" class="attachment-thumbnail size-thumbnail unveil-image" alt="{{$agent->name}}" >
                                                @else
                                                    <img style="width: 100%;height: 100%;" src="{{ URL::asset('upload/members/user-icon.jpg') }}" class="attachment-thumbnail size-thumbnail unveil-image" alt="{{$agent->name}}" >
                                                @endif
                                            </div></a>
                                    </div>				</div>
                                <div class="agent-content">
                                    <h3><a href="{{URL::to('agents/')}}">{{$agent->name}}</a></h3>
                                    <div class="phone"><div class="phone-wrapper agent-phone phone-hide">
                                            <a style="color:#484848;" class="phone" href="tel:{{$agent->phone}}">{{$agent->phone}}</a>
                                        </div></div>
                                    <div class="email"><div class="agent-email">
                                            <a style="color:#484848;word-break: break-all;" href="mailto:{{$agent->email}}">{{$agent->email}}</a>
                                        </div></div>
                                </div>
                            </div>
                            {!! Form::open(array('url'=>'agentscontact','method'=>'POST', 'id'=>'agent_contact_form')) !!}
                            <meta name="_token" content="{!! csrf_token() !!}"/>

                            <input type="hidden" name="property_id" value="{{$property->id}}">

                            <input type="hidden" name="home_exchange" value="{{$property->home_exchange}}">

                            <input type="hidden" name="agent_id" value="{{$agent->id}}">

                            <input type="hidden" name="property_name" value="{{$property->property_name}}">

                            <div id="ajax" style="color: #db2424"></div>


                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group" style="margin: 0;">

                                        <div style="position: relative;width: 100%;">

                                            <div class="bulgy-radios" role="radiogroup" aria-labelledby="bulgy-radios-label" style="width: 100%;min-height: 50px;text-align: left;">

                                                <label style="margin-left: 5px;float: left;max-width: 80px;">
                                                    <input type="radio" name="gender" value="Mr." checked />
                                                    <span class="radio"></span>
                                                    <span class="label">{{__('text.Mr.')}}</span>
                                                </label>

                                                <label>
                                                    <input type="radio" name="gender" value="Ms." />
                                                    <span class="radio"></span>
                                                    <span class="label">{{__('text.Ms.')}}</span>
                                                </label>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="contact-control" name="name" placeholder="{{__('text.Name')}}" required="required">
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="email" class="contact-control" name="email" placeholder="E-mail" required="required" value="">
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="contact-control style2" name="phone" placeholder="{{__('text.Mobile No')}}" value="">
                                        </div><!-- /.form-group -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="contact-control" name="message" placeholder="{{__('text.Message')}}" required="required"></textarea>
                                </div><!-- /.form-group -->


                                <button type="submit" class="button btn btn-theme btn-block" name="contact-form" style="outline: none;">{{__('text.Send Message')}}</button>
                            {!! Form::close() !!}
                        </div>
                    </aside>			   		</div>
            </div>

                @endif

        </div>

                @if($property->home_exchange != 1)

                @if(count($similar_properties)>0)

                    <div class="row related-properties" style="display: flex;margin-top: 30px;">
                        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">
                            <div id="partner" style="padding: 10px 0px;background: transparent;">
                                <div class="container" style="width: 100%;">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="heading-title bg-white">
                                                <h2>{{__('text.Related Properties')}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- break -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="similarProperties" style="display: inline-block;width: 100%;">

                                                @foreach($similar_properties as $i => $property)
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <div class="property-container">
                                                            <div class="property-image">
                                                                <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt="{{ $property->property_name }}">
                                                                <div class="property-status">
                                                                    @if($property->new_construction != 1)

                                                                        <span>For {{$property->property_purpose}}</span>

                                                                    @else

                                                                        <span>{{$property->kind_of_type}}</span>

                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="property-features">
                                                                <span><i class="fa fa-home"></i> {{$property->area}} <small>m2</small></span>
                                                                <span><i class="fa fa-bed"></i> {{$property->bedrooms}}</span>
                                                                <span><i class="fa fa-male"></i> {{$property->bathrooms}}</span>
                                                            </div>
                                                            <div class="property-content">
                                                                <h3 style="margin: 10px 0px;"><a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;" href="{{URL::to('properties/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a> <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">{{ Str::limit($property->address,40) }}</small></h3>
                                                                <small style="margin-top: 20px;font-weight: 600;">{{ getPropertyTypeName($property->property_type)->types }}</small>
                                                                <small style="float: right;">€@if($property->sale_price) {{number_format($property->sale_price, 0, ',', '.')}} k.k. @else {{number_format($property->rent_price, 0, ',', '.')}} @endif</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div></div></div></div>
                        </div>
                    </div>


                @endif

                @endif

      </div>

        <div class="row" style="margin: 0;display: flex;flex-direction: row;justify-content: center;">

            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 copyright" style="padding: 0;border-top: 1px solid #d7d7d7;">

            @if($previous)

                <div class="unitPopupContainer prv" style="position: absolute;left: 0;top: -18px;">
                    <div class="unitPopup triLeft">
                        <!-- First unit Next -->
                        <div class="nextUnitpopup" style="display: block;">
                            <div class="row1">
                                <div class="large-4 columns popupImage">

                                    @if($previous->featured_image)

                                        <img src="{{ URL::asset('upload/properties/'.$previous->featured_image.'-b.jpg') }}" alt="{{$previous->property_name}}">

                                    @else

                                        <img src="{{ URL::asset('upload/noFeatured.jpg') }}" alt="{{$previous->property_name}}">

                                    @endif


                                    <div class="large-10 columns nopad ftTop">
                                        <h6 class="unitPrice" style="text-align: left;margin-top: 0;">€ @if($previous->sale_price){{$previous->sale_price}} @else{{$previous->rent_price}} @endif</h6>
                                        <!--<p class="unitRooms">2 kamers</p>-->
                                    </div>

                                </div>
                                <div class="large-8 columns" style="font-family: monospace;">
                                    <h6 class="unitStreet" style="margin-top: 0px;text-align: left;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;">{{$previous->property_name}}</h6>
                                    <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>{{__('text.Address')}}:</b> {{$previous->address}}</p>
                                    <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>{{__('text.City')}}:</b> {{$previous->city_name}}</p>
                                    <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>{{__('text.Bedrooms')}}:</b>{{$previous->bedrooms}}</p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                @if($property->new_construction == 0 && $property->home_exchange == 0)

                    <a href="{{URL::to('properties/'.$previous->property_slug)}}" class="btn btn-primary footer-button prev-property" style="left: 0px;margin-left: 0px;">
                        <i class="fa fa-angle-left" aria-hidden="true" style="margin-right: 10px;"></i>
                        <span>{{__('text.Previous House')}}</span>
                    </a>

                @elseif($property->new_construction == 1)

                    <a href="{{URL::to('new-constructions/'.$previous->property_slug)}}" class="btn btn-primary footer-button prev-property" style="left: 0px;margin-left: 0px;">
                        <i class="fa fa-angle-left" aria-hidden="true" style="margin-right: 10px;"></i>
                        <span>{{__('text.Previous House')}}</span>
                    </a>

                @else

                    <a href="{{URL::to('home-exchange/'.$previous->property_slug)}}" class="btn btn-primary footer-button prev-property" style="left: 0px;margin-left: 0px;">
                        <i class="fa fa-angle-left" aria-hidden="true" style="margin-right: 10px;"></i>
                        <span>{{__('text.Previous House')}}</span>
                    </a>

                @endif

            @endif

            <a href="{{ url()->previous() }}" class="btn btn-primary footer-button" style="left: 20%;margin-left: 0px;">
                <i class="fas fa-backward" aria-hidden="true" style="margin-right: 10px;"></i>
                <span>{{__('text.Back to overview')}}</span>
            </a>

            <a href="#top" class="btn btn-primary scroltop"><i class="fa fa-angle-up"></i></a>

            @if($next)

                <div class="unitPopupContainer nxt" style="position: absolute;right: 0;top: -18px;">
                    <div class="unitPopup triRight">
                        <!-- First unit Next -->
                        <div class="nextUnitpopup" style="display: block;">
                            <div class="row1">
                                <div class="large-4 columns popupImage">

                                    @if($next->featured_image)

                                        <img src="{{ URL::asset('upload/properties/'.$next->featured_image.'-b.jpg') }}" alt="{{$next->property_name}}">

                                    @else

                                        <img src="{{ URL::asset('upload/noFeatured.jpg') }}" alt="{{$next->property_name}}">

                                    @endif

                                    <div class="large-10 columns nopad ftTop">
                                        <h6 class="unitPrice" style="text-align: left;margin-top: 0;">€ @if($next->sale_price){{$next->sale_price}} @else{{$next->rent_price}} @endif</h6>
                                        <!--<p class="unitRooms">2 kamers</p>-->
                                    </div>

                                </div>
                                <div class="large-8 columns" style="font-family: monospace;">
                                    <h6 class="unitStreet" style="margin-top: 0px;text-align: left;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;">{{$next->property_name}}</h6>
                                    <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>{{__('text.Address')}}:</b> {{$next->address}}</p>
                                    <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>{{__('text.City')}}:</b> {{$next->city_name}}</p>
                                    <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>{{__('text.Bedrooms')}}:</b>{{$next->bedrooms}}</p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                @if($property->new_construction == 0 && $property->home_exchange == 0)

                    <a href="{{URL::to('properties/'.$next->property_slug)}}" class="btn btn-primary footer-button next-property" style="left: auto;right: 0px;margin-left: 0px;">
                        <i class="fa fa-angle-right" aria-hidden="true" style="margin-right: 10px;"></i>
                        <span>{{__('text.Next House')}}</span>
                    </a>

                @elseif($property->new_construction == 1)

                    <a href="{{URL::to('new-constructions/'.$next->property_slug)}}" class="btn btn-primary footer-button next-property" style="left: auto;right: 0px;margin-left: 0px;">
                        <i class="fa fa-angle-right" aria-hidden="true" style="margin-right: 10px;"></i>
                        <span>{{__('text.Next House')}}</span>
                    </a>

                @else

                    <a href="{{URL::to('home-exchange/'.$next->property_slug)}}" class="btn btn-primary footer-button next-property" style="left: auto;right: 0px;margin-left: 0px;">
                        <i class="fa fa-angle-right" aria-hidden="true" style="margin-right: 10px;"></i>
                        <span>{{__('text.Next House')}}</span>
                    </a>

                @endif

            @endif

            </div>
        </div>

            <style>

                .prv{display: none;}

                .nxt{display: none;}

                .row1
                {
                    width: auto;
                    margin-left: -0.9375em;
                    margin-right: -0.9375em;
                    margin-top: 0;
                    margin-bottom: 0;
                    max-width: none;
                    *zoom: 1; }

                .ftTop{margin-top: 15px !important;}

                .nopad{padding-left: 0 !important;padding-right: 0 !important;}

                .columns img{display: inline-block;vertical-align: middle;width: 100%;height: 100%;}

                .unitPopup{ background: white !important;box-shadow: 1px 2px 9px 0px #6d6a6a; }

                .unitPopup .popupImage{padding: 0;}

                .large-4{width: 33.33333%;}

                .large-8{width: 66.66667%;}

                .large-10{width: 83.33333%;}

                .unitPopup.triRight:after{right: 20px;}

                .unitPopup.triLeft:after{left: 20px;}

                .unitPopup:after {-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;border-color: #f3f3f3 transparent transparent;border-image: none;border-style: solid;border-width: 10px;content: " ";height: 0;position: absolute;bottom: -20px;width: 0;}

                .unitPopup .unitStreet, .unitPopup .unitPrice{font-size: 16px;color: #3c3b3b;}

                .columns {
                    position: relative;
                    padding-left: 0.9375em;
                    padding-right: 0.9375em;
                    float: left; }


                .triRight {border-radius: 5px;position: absolute; right: 0; bottom: 30px; width: 344px; height: 200px; background: #f3f3f3; padding: 20px 20px 20px 35px;}

                .triLeft {border-radius: 5px;position: absolute; left: 0; bottom: 30px; width: 344px; height: 200px; background: #f3f3f3; padding: 20px 20px 20px 35px;}


                .copyright .footer-button{
                    position: absolute;
                    left: 50%;
                    top: -18px;
                    margin-left: -18px;
                }

                @media (max-width: 991px)
                {
                    .footer-button span{display: none;}
                }

            </style>

            <script>

                $('.next-property').hover(function (e) {

                    if($('.nxt').hasClass('show'))
                    {
                        $('.nxt').removeClass('show');
                    }
                    else
                    {
                        $('.nxt').addClass('show');
                    }

                });

                $('.prev-property').hover(function (e) {

                    if($('.prv').hasClass('show'))
                    {
                        $('.prv').removeClass('show');
                    }
                    else
                    {
                        $('.prv').addClass('show');
                    }

                });


            </script>



    </div>
    <!-- end:content -->

     @if (count($errors) > 0 or Session::has('flash_message'))
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>


     <script type="text/javascript">
	    $(window).load(function(){
	        $('#modal-error').modal('show');
	    });


	</script>
 	@endif
    <!-- begin:modal-message -->
    <div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="modal-signin" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom:none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

          </div>
          <div class="modal-body">
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

				        {!! Session::get('flash_message') !!}
				    </div>
				@endif
          </div>

        </div>
      </div>
    </div>
    <!-- end:modal-message -->

<?php $footer = 1; ?>

    <style>

        .heading-title.bg-white h2::before
        {
            background: #f4f4f4;
        }

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

            .request{text-align: center !important;justify-content: center !important;flex-direction: column;}

            .sh-ad{padding-right: 0 !important;text-align: center !important;}

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

    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>


    <script>

        $( document ).ready(function() {

            $('#myTab li').on('shown.bs.tab', function(event){

                var x = $(event.target).parent();         // active tab

           if(x.hasClass('contact-tab'))
           {
            $('.sidebar-property').hide();
           }
           else
           {
               $('.sidebar-property').show();
           }

            });

            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                    } else {
                        panel.style.maxHeight = "100%";
                    }
                });
            }

            $(".add-compare").click(function(){

                $('html, body').animate({
                    scrollTop: $(".related-properties").offset().top - 100
                }, 2000);

            });

            $(".popup-image").click(function(){

                $("#player-window").hide();
                $("#map-box").hide();
                $("#slider-property").show();

            });

            $(".popup-video").click(function(){

                $('.nav-table').children('li').not('.video-tab').removeClass('active');
                $('.video-tab').addClass('active');

                $("#slider-property").hide();
                $("#map-box").hide();
                $("#player-window").show();

            });

            $(".tab-google-map").click(function(){

                $("#slider-property").hide();
                $("#player-window").hide();
                $("#map-box").show();

                if(!$('.box-carousel').hasClass('slick-initialized'))
                {
                    $('.box-carousel').slick({
                        dots: false,
                        arrows: true,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        responsive: [
                            {
                                breakpoint: 768,
                                arrows: true,
                                settings: {
                                    slidesToShow: 3
                                }
                            },
                            {
                                breakpoint: 480,
                                arrows: true,
                                settings: {
                                    slidesToShow: 3
                                }
                            }
                        ],
                        prevArrow: "<button type='button' class='mission-prev-arrow'></button>",
                        nextArrow: "<button type='button' class='mission-next-arrow'></button>"
                    });
                }


                panorama.setVisible(false);
                map.setMapTypeId(google.maps.MapTypeId.ROADMAP);


            });

            $(".tab-google-street-view-map").click(function(){

                $("#slider-property").hide();
                $("#player-window").hide();
                $("#map-box").show();

                if(!$('.box-carousel').hasClass('slick-initialized'))
                {
                    $('.box-carousel').slick({
                        dots: false,
                        arrows: true,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        responsive: [
                            {
                                breakpoint: 768,
                                arrows: true,
                                settings: {
                                    slidesToShow: 3
                                }
                            },
                            {
                                breakpoint: 480,
                                arrows: true,
                                settings: {
                                    slidesToShow: 3
                                }
                            }
                        ],
                        prevArrow: "<button type='button' class='mission-prev-arrow'></button>",
                        nextArrow: "<button type='button' class='mission-next-arrow'></button>"
                    });
                }


                    panorama.setVisible(true);

            });


            $(".tab-google-satellite-view-map").click(function(){

                $("#slider-property").hide();
                $("#player-window").hide();
                $("#map-box").show();

                if(!$('.box-carousel').hasClass('slick-initialized'))
                {
                    $('.box-carousel').slick({
                        dots: false,
                        arrows: true,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        responsive: [
                            {
                                breakpoint: 768,
                                arrows: true,
                                settings: {
                                    slidesToShow: 3
                                }
                            },
                            {
                                breakpoint: 480,
                                arrows: true,
                                settings: {
                                    slidesToShow: 3
                                }
                            }
                        ],
                        prevArrow: "<button type='button' class='mission-prev-arrow'></button>",
                        nextArrow: "<button type='button' class='mission-next-arrow'></button>"
                    });
                }


                panorama.setVisible(false);
                map.setMapTypeId(google.maps.MapTypeId.SATELLITE);

            });


            $('#cal_dist').click(function(e) {

                if($('.travel-time').hasClass('travel-show'))
                {
                    $('.travel-time').removeClass('travel-show');
                    $('.travel-time').addClass('travel-hide');

                    setTimeout(function(){
                        $('.travel-time').hide()
                    }, 1100); //Same time as animation

                }
                else
                {
                    $('.travel-time').removeClass('travel-hide');
                    $('.travel-time').addClass('travel-show');
                    $('.travel-time').show()


                }


            });

            var directionsDisplay = new google.maps.DirectionsRenderer();
            var directionsService = new google.maps.DirectionsService();
            var map2;
            var marker2;
            var markerA = new google.maps.Marker();
            var markerB = new google.maps.Marker();

            var row_id = 0;
            var sec_id = 0;

            $('.travel-time-transport-modes__button').click(function(e) {

                $('.travel-time-transport-modes').find('.travel-time-transport-modes--active').removeClass('travel-time-transport-modes--active');

                $(this).addClass('travel-time-transport-modes--active');

            });



            $('.rui-button-brand').click(function(e) {

                var map_latitude = parseFloat($('#map_latitude').val());
                var map_longitude = parseFloat($('#map_longitude').val());

                var lat = parseFloat($('#loc-latitude').val());
                var lng = parseFloat($('#loc-longitude').val());

                var markerBlocation = $('#loc-real').val();

                createRoute(map_latitude,map_longitude,lat,lng,markerBlocation);

                function createRoute(map_latitude,map_longitude,lat,lng,markerBlocation)
                {

                    var start = new google.maps.LatLng(map_latitude, map_longitude);
                    //var end = new google.maps.LatLng(38.334818, -181.884886);
                    var end = new google.maps.LatLng(lat, lng);


                    var request = {
                        origin: start,
                        destination: end,
                        travelMode: google.maps.TravelMode.DRIVING
                    };

                    directionsService.route(request, function(response, status) {


                        if (status == google.maps.DirectionsStatus.OK) {
                            marker2.setMap(null);
                            markerA.setMap(null);
                            markerB.setMap(null);
                            directionsDisplay.setMap(null);

                            directionsDisplay = new google.maps.DirectionsRenderer({
                                map: map2,
                                directions: response,
                                suppressMarkers: true
                            });
                            var leg = response.routes[0].legs[0];
                            var base_url = window.location.origin;

                            var markerA_icon = base_url + '/assets/img/markerA.png';
                            var markerB_icon = base_url + '/assets/img/markerB.png';
                            var infoWindowA = new google.maps.InfoWindow;
                            var infoWindowB = new google.maps.InfoWindow;

                            markerA =  new google.maps.Marker({
                                position: leg.start_location,
                                map: map2,
                                icon: {url:markerA_icon, scaledSize: new google.maps.Size(40, 45)},
                                title: 'title'
                            });

                            markerA.addListener('click', function() {

                                var markerAlocation = $('#travel_address').val();

                                infoWindowA.setContent(markerAlocation);
                                infoWindowA.open(map2, markerA);

                            });


                            markerB =  new google.maps.Marker({
                                position: leg.end_location,
                                map: map2,
                                icon: {url:markerB_icon, scaledSize: new google.maps.Size(40, 40)},
                                title: 'title'
                            });

                            markerB.addListener('click', function() {


                                infoWindowB.setContent(markerBlocation);
                                infoWindowB.open(map2, markerB);

                            });


                        } else {
                            alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                        }
                    });

                }

                var travel_origin = new google.maps.LatLng(map_latitude, map_longitude);

                var travel_destination = new google.maps.LatLng(lat, lng);

                var address = $('.loc-input').val();
                var name = $('#destination_name').val();
                var property_id = $('#p_id').val();
                var user_id = $('#u_id').val();

                var base_url = window.location.origin;

                var login_url = base_url + '/login';

                $('.loc-input').val('');
                $('.loc-input').attr('disabled', false);
                $('.loc-remove').hide();
                $('#destination_name').val('');


                $(".rui-button-brand").addClass('rui-button-disabled');

                $(".rui-button-brand").attr('disabled', true);



                    var travel_modes = ['DRIVING','TRANSIT','WALKING','BICYCLING'];

                    var travel_data = [];



                    $.each(travel_modes, function(key, value) {


                        var service = new google.maps.DistanceMatrixService();

                        service.getDistanceMatrix(
                            {
                                origins: [travel_origin],
                                destinations: [travel_destination],
                                travelMode: value,
                                avoidHighways: false,
                                avoidTolls: false,
                            }, callback);


                        function callback(response, status) {


                            if(response.rows[0].elements[0].status != 'ZERO_RESULTS')
                            {
                                var duration = response.rows[0].elements[0].duration.text;
                            }
                            else
                            {
                                var duration = "No Results Found...";
                            }

                            if(response.rows[0].elements[0].status != 'ZERO_RESULTS')
                            {
                                var distance = response.rows[0].elements[0].distance.text;
                            }
                            else
                            {
                                var distance = "";
                            }

                           $('#' + value).find('.active-row').removeClass('active-row');


                            $('#' + value).append('<div id="travel-time-row-'+sec_id+'" class="travel-time-row active-row row-'+row_id+'" data-id="'+row_id+'">\n' +
                                '\n' +
                                '<input type="hidden" id="cur-latitude" value="'+lat+'" />' +
                                '<input type="hidden" id="cur-longitude" value="'+lng+'" />' +
                                '<input type="hidden" id="cur-address" value="'+address+'" />' +
                                '\n' +
                                '                                              <div class="travel-time-row__input">\n' +
                                '\n' +
                                '                                                  <div class="travel-time-row__name">' + name + '</div>\n' +
                                '\n' +
                                '                                                  <div class="travel-time-row__address">' + address + '</div>\n' +
                                '\n' +
                                '                                              </div>\n' +
                                '\n' +
                                '                                              <div class="travel-time-row__result"><div class="travel-time-row__duration">' + duration + '</div>\n' +
                                '\n' +
                                '                                                  <div class="travel-time-row__distance">' + distance + '</div>\n' +
                                '\n' +
                                '                                              </div>\n' +
                                '\n' +
                                '                                              <div class="travel-time-row__remove"><button class="rui-button-basic travel-time-row__btn remove_travel" id="remove_travel_'+sec_id+'" data-id="'+row_id+'" >{{__('text.Remove')}}</button>\n' +
                                '\n' +
                                '                                              </div>\n' +
                                '\n' +
                                '                                          </div>');


                            $('#travel-time-row-'+sec_id).click(function(e) {

                                var id = $(this).data('id');

                                if(!$(this).hasClass('active-row'))
                                {
                                    $('#DRIVING').find('.active-row').removeClass('active-row');
                                    $('#TRANSIT').find('.active-row').removeClass('active-row');
                                    $('#WALKING').find('.active-row').removeClass('active-row');
                                    $('#BICYCLING').find('.active-row').removeClass('active-row');


                                    $('#DRIVING').find('.row-'+id).addClass('active-row');
                                    $('#TRANSIT').find('.row-'+id).addClass('active-row');
                                    $('#WALKING').find('.row-'+id).addClass('active-row');
                                    $('#BICYCLING').find('.row-'+id).addClass('active-row');

                                    var map_latitude = parseFloat($('#map_latitude').val());
                                    var map_longitude = parseFloat($('#map_longitude').val());

                                    var cur_latitude = $(this).children('#cur-latitude').val();
                                    var cur_longitude = $(this).children('#cur-longitude').val();
                                    var cur_address = $(this).children('#cur-address').val();

                                    createRoute(map_latitude,map_longitude,cur_latitude,cur_longitude,cur_address);
                                }



                            });



                            $('#remove_travel_'+sec_id).click(function(e) {


                                var id = $(this).data('id');

                                $('#DRIVING').find('.row-'+id).remove();
                                $('#TRANSIT').find('.row-'+id).remove();
                                $('#WALKING').find('.row-'+id).remove();
                                $('#BICYCLING').find('.row-'+id).remove();

                                if( $('#DRIVING').children().length >= 1 )
                                {
                                    $('#DRIVING').children().first().trigger('click');
                                }
                                else
                                {
                                    travel_initMap();
                                }

                                /*$.ajax({

                                    type: 'POST',

                                    url: "<?php echo url('properties/remove-travel-data') ?>",

                    headers: {
                        'X-CSRF-TOKEN': "<?php echo csrf_token() ?>",
                    },

                    data: {
                        id: id,
                    },

                    success: function (data) {



                    }

                });*/

                            });

                            sec_id = sec_id + 1;


                            //Store to database code...

                           /* travel_data[key] = [

                                {
                                    mode: value,
                                    duration: response.rows[0].elements[0].duration.text,
                                    distance: response.rows[0].elements[0].distance.text
                                }

                            ];

                            if (call < 4){

                                call = call + 1;

                                if (call == 4) {

                                    call = 0;

                                    $.ajax({

                                        type: 'POST',

                                        url: "<?php echo url('properties/store-travel-data') ?>",

                                        headers: {
                                            'X-CSRF-TOKEN': "<?php echo csrf_token() ?>",
                                        },

                                        data: {
                                            name: name,
                                            address: address,
                                            property_id: property_id,
                                            user_id: user_id,
                                            travel_data: travel_data
                                        },

                                        success: function (data) {


                                            $.each(travel_data, function (key, value) {


                                                $('#' + value[0]['mode']).append('<div class="travel-time-row row-'+data.id+'">\n' +
                                                    '\n' +
                                                    '                                              <div class="travel-time-row__input">\n' +
                                                    '\n' +
                                                    '                                                  <div class="travel-time-row__name">' + name + '</div>\n' +
                                                    '\n' +
                                                    '                                                  <div class="travel-time-row__address">' + address + '</div>\n' +
                                                    '\n' +
                                                    '                                              </div>\n' +
                                                    '\n' +
                                                    '                                              <div class="travel-time-row__result"><div class="travel-time-row__duration">' + value[0]['duration'] + '</div>\n' +
                                                    '\n' +
                                                    '                                                  <div class="travel-time-row__distance">' + value[0]['distance'] + '</div>\n' +
                                                    '\n' +
                                                    '                                              </div>\n' +
                                                    '\n' +
                                                    '                                              <div class="travel-time-row__remove"><button class="rui-button-basic travel-time-row__btn remove_travel" data-id="'+data.id+'">Remove</button>\n' +
                                                    '\n' +
                                                    '                                              </div>\n' +
                                                    '\n' +
                                                    '                                          </div>');

                                                $('.remove_travel').click(function(e) {

                                                    var id = $(this).data('id');

                                                    $.ajax({

                                                        type: 'POST',

                                                        url: "<?php echo url('properties/remove-travel-data') ?>",

                                                        headers: {
                                                            'X-CSRF-TOKEN': "<?php echo csrf_token() ?>",
                                                        },

                                                        data: {
                                                            id: id,
                                                        },

                                                        success: function (data) {

                                                            $('.row-'+id).remove();

                                                        }
                                                    });
                                                });
                                            });
                                        }
                                    });
                                }
                        }*/
                        }

                    });

                row_id = row_id + 1;

                });

            $('.loc-remove').click(function(e) {

                $(this).parent().children('.loc-input').val("");

                $(this).parent().children('.loc-input').attr('disabled',false);

                $(this).hide();

                $(".rui-button-brand").addClass('rui-button-disabled');

                $(".rui-button-brand").attr('disabled',true);

            });

            $('.loc-input').on('keyup keypress', function(e) {

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



                    const autocomplete = new google.maps.places.Autocomplete(input,options);
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


                                    $(input).parent().children('#loc-latitude').val(lat);
                                    $(input).parent().children('#loc-longitude').val(lng);

                                    var value = $(input).val();
                                    var name = $('#destination_name').val();

                                    $(input).parent().children('#loc-real').val(value);

                                    $(input).attr('disabled',true);

                                    $(input).parent().children('.loc-remove').show();

                                    $(".rui-button-brand").removeClass('rui-button-disabled');

                                    $(".rui-button-brand").attr('disabled',false);


                                }
                                else
                                {

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




                $('#heart').hover(function () {

                    if($(this).hasClass('far fa-heart'))
                    {
                        $(this).removeClass('far fa-heart');
                        $(this).addClass('fa fa-heart');
                    }
                    else
                    {
                        $(this).removeClass('fa fa-heart');
                        $(this).addClass('far fa-heart');
                    }

                });

            const labels = document.querySelectorAll('.label');
            labels.forEach(label => {
                const chars = label.textContent.split('');
                label.innerHTML = '';
                chars.forEach(char => {
                    label.innerHTML += `<span>${char === ' ' ? '&nbsp' : char}</span>`;
                });
            })

            $('#datetimepicker4').datetimepicker({format: 'DD/MM/YYYY'});

            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });

            $(".floors_links").click(function(){

               var id =  $(this).data('id');

               id = '#' + id;

                $('#floors_box').children().not(id).removeClass('active in');

               $(id).addClass('active');

                $(id).addClass('in');


            });

            const player = new Plyr('#player');
            const player1 = new Plyr('#player1');

            $(".box").on('click', function() {

                $(this).parent().find('.box').removeClass('background-active');

                $(this).addClass('background-active');

                type = $(this).data('type');

                infoWindow = new google.maps.InfoWindow;

                handleLocationError(false, infoWindow,type);

            });



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


            function initMap() {
                // Initialize variables
                bounds = new google.maps.LatLngBounds();
                infoWindow = new google.maps.InfoWindow;
                currentInfoWindow = infoWindow;
                /* TODO: Step 4A3: Add a generic sidebar */
                infoPane = document.getElementById('panel');

                handleLocationError(false, infoWindow,type);

                // Try HTML5 geolocation
                /*if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map = new google.maps.Map(document.getElementById('map'), {
                            center: pos,
                            zoom: 15
                        });
                        bounds.extend(pos);

                        infoWindow.setPosition(pos);
                        infoWindow.setContent('Location found.');
                        infoWindow.open(map);
                        map.setCenter(pos);

                        // Call Places Nearby Search on user's location
                        getNearbyPlaces(pos);
                    }, () => {
                        // Browser supports geolocation, but user has denied permission
                        handleLocationError(true, infoWindow);
                    });
                } else {
                    // Browser doesn't support geolocation
                    handleLocationError(false, infoWindow);
                }*/
            }

            function agent_initMap() {
                // Initialize variables
                bounds1 = new google.maps.LatLngBounds();
                infoWindow1 = new google.maps.InfoWindow;
                currentInfoWindow1 = infoWindow1;
                /* TODO: Step 4A3: Add a generic sidebar */
                agent_handleLocationError(false, infoWindow1,type);
            }

            function travel_initMap() {
                // Initialize variables
                bounds2 = new google.maps.LatLngBounds();
                infoWindow2 = new google.maps.InfoWindow;
                currentInfoWindow2 = infoWindow1;
                /* TODO: Step 4A3: Add a generic sidebar */
                travel_handleLocationError(false, infoWindow2,type);
            }

                initMap();

            var agent_map_check = $('#agent_map_check').val();

            if(agent_map_check == 1)
            {
                    agent_initMap();
            }

                travel_initMap();


            function CenterControl(controlDiv, map) {

                // Set CSS for the control border.
                var controlUI = document.createElement('div');
                controlUI.style.backgroundColor = '#fff';
                controlUI.style.border = '2px solid #fff';
                controlUI.style.borderRadius = '3px';
                controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
                controlUI.style.cursor = 'pointer';
                controlUI.style.marginTop = '10px';
                controlUI.style.textAlign = 'center';
                controlUI.title = 'Street View';
                controlUI.id = 'street_view';
                controlDiv.appendChild(controlUI);

                // Set CSS for the control interior.
                var controlText = document.createElement('div');
                controlText.style.color = 'rgb(25,25,25)';
                controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
                controlText.style.fontSize = '16px';
                controlText.style.lineHeight = '38px';
                controlText.style.paddingLeft = '5px';
                controlText.style.paddingRight = '5px';
                controlText.innerHTML = 'Street View';
                controlUI.appendChild(controlText);

                // Setup the click event listeners: simply set the map to Chicago.
                controlUI.addEventListener('click', function() {
                    toggleStreetView();
                });

            }



            // Handle a geolocation error
            function handleLocationError(browserHasGeolocation, infoWindow, type) {


                var lat = parseFloat(document.getElementById('map_latitude').value);
                var lng = parseFloat(document.getElementById('map_longitude').value);

                pos = { lat: lat, lng: lng };

                map = new google.maps.Map(document.getElementById('map'), {
                    center: pos,
                    zoom: 15
                });

                var centerControlDiv = document.createElement('div');
                var centerControl = new CenterControl(centerControlDiv, map);

                centerControlDiv.index = 1;
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);


                panorama = map.getStreetView();
                panorama.setPosition(pos);
                panorama.setPov(/** @type {google.maps.StreetViewPov} */({
                    heading: 265,
                    pitch: 0
                }));



                var base_url = window.location.origin;

                var home_icon = base_url + '/assets/img/home_pin.png';

                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: lat, lng: lng},
                    draggable: false,
                    animation: google.maps.Animation.DROP,
                    icon: {url:home_icon, scaledSize: new google.maps.Size(40, 45)}
                });


                marker.addListener('click', function() {

                    var location = $('#city').val();

                    infoWindow.setContent(location);
                    infoWindow.open(map, marker);
                    map.setZoom(15);
                    map.setCenter(marker.getPosition());

                });

                // Display an InfoWindow at the map center
                infoWindow.setPosition(pos);
                /*infoWindow.setContent(browserHasGeolocation ?
                    'Geolocation permissions denied. Using default location.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);*/
                currentInfoWindow = infoWindow;

                // Call Places Nearby Search on the default location
                getNearbyPlaces(pos,type);
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


            function travel_handleLocationError(browserHasGeolocation2, infoWindow2, type2) {


                var lat2 = parseFloat(document.getElementById('travel_latitude').value);
                var lng2 = parseFloat(document.getElementById('travel_longitude').value);

                pos2 = { lat: lat2, lng: lng2 };

                map2 = new google.maps.Map(document.getElementById('travel-map'), {
                    center: pos2,
                    zoom: 15
                });

                var base_url2 = window.location.origin;

                var home_icon2 = base_url2 + '/assets/img/home_pin.png';

                 marker2 = new google.maps.Marker({
                    map: map2,
                    position: {lat: lat2, lng: lng2},
                    draggable: false,
                    icon: {url:home_icon2, scaledSize: new google.maps.Size(40, 45)}
                });


                marker2.addListener('click', function() {

                    var location2 = $('#travel_address').val();

                    infoWindow2.setContent(location2);
                    infoWindow2.open(map2, marker2);
                    map2.setZoom(15);
                    map2.setCenter(marker2.getPosition());

                });

                // Display an InfoWindow at the map center
                infoWindow2.setPosition(pos2);
                /*infoWindow.setContent(browserHasGeolocation ?
                    'Geolocation permissions denied. Using default location.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);*/
                currentInfoWindow2 = infoWindow2;

                // Call Places Nearby Search on the default location
                // getNearbyPlaces(pos,type);
            }

            function toggleStreetView() {
                var toggle = panorama.getVisible();
                if (toggle == false) {
                    panorama.setVisible(true);
                } else {
                    panorama.setVisible(false);
                }
            }

            // Perform a Places Nearby Search Request
            function getNearbyPlaces(position,type) {


                let request = {
                    location: position,
                    radius: '1000',
                    type: [type]
                };

                var new_type = capitalizeFirstLetter(type);

                function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                }


                if(new_type == 'Shopping_mall')
                {
                    new_type = '<?php echo __('text.Malls'); ?>';
                }
                else if(new_type == 'School')
                {
                    new_type = '<?php echo __('text.Schools'); ?>';
                }
                else if(new_type == 'Bank')
                {
                    new_type = '<?php echo __('text.Banks'); ?>';
                }
                else if(new_type == 'Hospital')
                {
                    new_type = '<?php echo __('text.Hospitals'); ?>';
                }
                else if(new_type == 'Bakery')
                {
                    new_type = '<?php echo __('text.Bakery'); ?>';
                }
                else if(new_type == 'Pharmacy')
                {
                    new_type = '<?php echo __('text.Pharmacy'); ?>';
                }


                $("#panel div:eq(0)").children().first().text(new_type);


                service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, nearbyCallback);
            }

            // Handle the results (up to 20) of the Nearby Search
            function nearbyCallback(results, status) {

                if($(".accordion").hasClass('active'))
                {
                    $(".accordion").trigger("click");
                }


                if (status == google.maps.places.PlacesServiceStatus.OK) {

                    $("#panel div:eq(0)").children().eq(1).text(results.length + ' results found');

                    /*createMarkers(results);*/


                    createMarkersDetails(results,pos);
                }
                else
                {

                    $("#panel div:eq(0)").children().eq(1).text('0 results found');

                    $(".panel").children().remove();

                }
            }

            // Set markers at the location of each place result

            /*function createMarkers(places) {



                markers = new Array();

                var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';



                places.forEach(place => {


                    let marker = new google.maps.Marker({
                        position: place.geometry.location,
                        map: map,
                        icon: image,
                        title: place.name
                    });



                    markers.push(marker);

                    /!* TODO: Step 4B: Add click listeners to the markers *!/
                    // Add click listener to each marker
                    google.maps.event.addListener(marker, 'click', () => {
                        let request = {
                            placeId: place.place_id,
                            fields: ['name', 'formatted_address', 'geometry', 'rating',
                                'website', 'photos']
                        };

                        /!* Only fetch the details of a place when the user clicks on a marker.
                         * If we fetch the details for all place results as soon as we get
                         * the search response, we will hit API rate limits. *!/


                        /!*service.getDetails(request, (placeResult, status) => {
                            showDetails(placeResult, marker, status)
                        });*!/

                        showDetails(place.name, marker);

                    });

                    // Adjust the map bounds to include the location of this marker
                    bounds.extend(place.geometry.location);
                });
                /!* Once all the markers have been placed, adjust the bounds of the map to
                 * show all the markers within the visible area. *!/
                map.fitBounds(bounds);
            }*/


            function createMarkersDetails(places,position) {


                var i = 0;

                var length = places.length;

                markers = new Array();

                var base_url = window.location.origin;



                if(type == 'shopping_mall')
                {
                    var icon = base_url + '/assets/img/shopping_mall-nearby-marker.png';
                }
                else if(type == 'school')
                {
                    var icon = base_url + '/assets/img/school-nearby-marker.png';
                }
                else if(type == 'bank')
                {
                    var icon = base_url + '/assets/img/bank-nearby-marker.png';
                }
                else if(type == 'hospital')
                {
                    var icon = base_url + '/assets/img/hospital-nearby-marker.png';
                }
                else if(type == 'bakery')
                {
                    var icon = base_url + '/assets/img/bakery-nearby-marker.png';
                }
                else if(type == 'pharmacy')
                {
                    var icon = base_url + '/assets/img/pharmacy-nearby-marker.png';
                }


                $(".panel").children().remove();

                places.forEach(place => {


                    var origin1 = new google.maps.LatLng(position.lat, position.lng);

                    var destinationA = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());


                    var service = new google.maps.DistanceMatrixService();

                    service.getDistanceMatrix(
                        {
                            origins: [origin1],
                            destinations: [destinationA],
                            travelMode: 'DRIVING',
                            avoidHighways: false,
                            avoidTolls: false,
                        }, callback);


                    function callback(response, status) {


                        let marker = new google.maps.Marker({
                            position: place.geometry.location,
                            map: map,
                            animation: google.maps.Animation.DROP,
                            icon: {url:icon, scaledSize: new google.maps.Size(35, 40)},
                            title: place.name
                        });



                        markers.push(marker);

                        /* TODO: Step 4B: Add click listeners to the markers */
                        // Add click listener to each marker
                        google.maps.event.addListener(marker, 'click', () => {
                            let request = {
                                placeId: place.place_id,
                                fields: ['name', 'formatted_address', 'geometry', 'rating',
                                    'website', 'photos']
                            };

                            /* Only fetch the details of a place when the user clicks on a marker.
                             * If we fetch the details for all place results as soon as we get
                             * the search response, we will hit API rate limits. */


                            /*service.getDetails(request, (placeResult, status) => {
                                showDetails(placeResult, marker, status)
                            });*/

                            showDetails(place.name, marker);

                        });

                        // Adjust the map bounds to include the location of this marker
                        bounds.extend(place.geometry.location);



                        $(".panel").append('<a data-id="'+i+'" href="javascript:void(0);" class="trigger"><div style="padding: 10px 0px 0px 10px;border-top: 1px solid rgba(190, 190, 190, 0.6);">\n' +
                            '                                                  <span style="display: block;">'+place.name+'</span>\n' +
                            '                                                  <span style="display: inline-block;"><i class="fas fa-tachometer-alt" aria-hidden="true" style="font-size: 15px;margin: 10px;float: left;"></i><p style="float: left;margin-top: 6px;margin-bottom: 0;">'+response.rows[0].elements[0].distance.text+'</p></span>\n' +
                            '                                              </div></a>');


                        i = i + 1;

                    }


                    $(document).on("click", "a.trigger" , function() {

                        google.maps.event.trigger(markers[$(this).data('id')], 'click');

                    });

                });

            }





            /* TODO: Step 4C: Show place details in an info window */
            // Builds an InfoWindow to display details above the marker


            /*function showDetails(placeResult, marker, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    let placeInfowindow = new google.maps.InfoWindow();
                    let rating = "None";
                    if (placeResult.rating) rating = placeResult.rating;
                    placeInfowindow.setContent('<div><strong>' + placeResult.name +
                        '</strong><br>' + 'Rating: ' + rating + '</div>');
                    placeInfowindow.open(marker.map, marker);
                    currentInfoWindow.close();
                    currentInfoWindow = placeInfowindow;
                   /!* showPanel(placeResult);*!/
                } else {
                    console.log('showDetails failed: ' + status);
                }
            }*/

            function showDetails(placeName,marker) {

                let placeInfowindow = new google.maps.InfoWindow();

                placeInfowindow.setContent('<div><strong>' + placeName + '</strong></div>');
                placeInfowindow.open(marker.map, marker);
                currentInfoWindow.close();
                currentInfoWindow = placeInfowindow;


            }

            /* TODO: Step 4D: Load place details in a sidebar */
            // Displays place details in a sidebar
            function showPanel(placeResult) {
                // If infoPane is already open, close it
                if (infoPane.classList.contains("open")) {
                    infoPane.classList.remove("open");
                }

                // Clear the previous details
                while (infoPane.lastChild) {
                    infoPane.removeChild(infoPane.lastChild);
                }

                /* TODO: Step 4E: Display a Place Photo with the Place Details */
                // Add the primary photo, if there is one
                if (placeResult.photos) {
                    let firstPhoto = placeResult.photos[0];
                    let photo = document.createElement('img');
                    photo.classList.add('hero');
                    photo.src = firstPhoto.getUrl();
                    infoPane.appendChild(photo);
                }

                // Add place details with text formatting
                let name = document.createElement('h1');
                name.classList.add('place');
                name.textContent = placeResult.name;
                infoPane.appendChild(name);
                if (placeResult.rating) {
                    let rating = document.createElement('p');
                    rating.classList.add('details');
                    rating.textContent = `Rating: ${placeResult.rating} \u272e`;
                    infoPane.appendChild(rating);
                }
                let address = document.createElement('p');
                address.classList.add('details');
                address.textContent = placeResult.formatted_address;
                infoPane.appendChild(address);
                if (placeResult.website) {
                    let websitePara = document.createElement('p');
                    let websiteLink = document.createElement('a');
                    let websiteUrl = document.createTextNode(placeResult.website);
                    websiteLink.appendChild(websiteUrl);
                    websiteLink.title = placeResult.website;
                    websiteLink.href = placeResult.website;
                    websitePara.appendChild(websiteLink);
                    infoPane.appendChild(websitePara);
                }

                // Open the infoPane
                infoPane.classList.add("open");
            }



            $('.similarProperties').slick({
                dots: false,
                arrows: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 995,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 580,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    }
                ],
                prevArrow: "<button type='button' class='mission-prev-arrow'></button>",
                nextArrow: "<button type='button' class='mission-next-arrow'></button>"
            });

        });

    </script>

@endsection
