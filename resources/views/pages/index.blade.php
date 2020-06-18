@extends("app")
@section("content")

@include("_particles.slidersearch")

<!-- begin:content -->
    <div id="content">

        @if(Session::has('flash_message'))
            <div class="alert alert-success" style="text-align: center;font-size: 16px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

      <div class="container" style="width: 100%;">

          @if(count($content))



          <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex;">

                  <div data-testid="key-services" class="css-htlmaj col-lg-9 col-md-12 col-sm-12 col-xs-12">
                      <div>
                      <div class="domain-home_ down is-visible">

                          <h2 class="css-ce6ko1">While you're here</h2>

                          <ul class="css-48sroz" style="list-style: none;padding: 0;">

                              @foreach($content as $temp)

                              <li><a href="@if($temp->url){{$temp->url}} @else {{URL::to('/')}} @endif">

                                      <img src="{{ URL::asset('upload/homepage_icons/'.$temp->image) }}">{{$temp->title}}</a>

                              </li>

                              @endforeach


                          </ul></div></div></div>

              </div></div>

          @endif

        <!-- begin:latest -->

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;">

                <div class="col-md-12 col-sm-12">
                    <div class="heading-title" style="margin-bottom: 45px;">
                        <h2>Latest Properties</h2>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;text-align: center">
                        <a href="{{URL::to('properties')}}" style="background-color: transparent;color: black;border-width: 2px;" class="btn btn-success">Show More Properties</a>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="latestProperties">

                            <?php $i = 0; ?>

                            @foreach($propertieslist as $i => $property)

                                <div class="col-md-4 col-sm-12 col-xs-12">

                                    <div style="min-height: 55px;display: flex;">
                                    <div class="property-price" style="position:relative;max-width: 100%;font-size: 15px;padding: 3px 5px;border-radius: 5px;margin: auto 0;width: 100%;">Open House <span>@if($property->open_date) {{$property->open_date}} @endif @if($property->open_timeFrom) {{$property->open_timeFrom}} @else Anytime @endif @if($property->open_timeTo) to {{$property->open_timeTo}} @else to Anytime @endif</span></div>
                                    </div>

                                    <div class="property-container" style="border: 1px solid #48cfad;margin-bottom: 10px">
                                        <div class="property-image latest">

                                            <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}" alt="{{ $property->property_name }}">

                                            @if($property->is_sold)

                                                <div class="property-price" style="top: 37px;left: -58px;border-radius: 5px;padding: 5px 10px;transform: rotate(-40deg);width: 240px;">

                                                    <span>Sold</span>

                                                </div>

                                            @elseif($property->is_rented)

                                                <div class="property-price" style="top: 37px;left: -58px;border-radius: 5px;padding: 5px 10px;transform: rotate(-40deg);width: 240px;">

                                                    <span>Rented</span>

                                                </div>

                                            @elseif($property->is_negotiation)

                                                <div class="property-price" style="top: 37px;left: -58px;border-radius: 5px;padding: 5px 10px;transform: rotate(-40deg);width: 240px;">

                                                    <span style="font-size: 14px;">Under Negotiation</span>

                                                </div>

                                            @elseif($property->is_under_offer)

                                                <div class="property-price" style="top: 37px;left: -58px;border-radius: 5px;padding: 5px 10px;transform: rotate(-40deg);width: 240px;">

                                                    <span style="font-size: 16px;">Under Offer</span>

                                                </div>

                                            @else

                                                <div class="property-price" style="top: 12px;left: 12px;border-radius: 5px;padding: 5px 10px;">
                                                    <span>For {{$property->property_purpose}}</span>
                                                    {{--<h4>{{ getPropertyTypeName($property->property_type)->types }}</h4>
                                                    <span>{{getcong('currency_sign')}}@if($property->sale_price) {{$property->sale_price}} @else {{$property->rent_price}} @endif</span>--}}
                                                </div>

                                            @endif



                                            @if($property->available_immediately)

                                                <div class="property-status" style="background:#48cfad;width:170px;bottom: 12px;left: 12px;border-radius: 5px;padding: 0px;text-align: center;">
                                                    <span>Available Immediately</span>
                                                </div>

                                            @endif

                                            <?php

                                            $x = 0;

                                            if($property->featured_image){ $x = $x + 1;} if($property->property_images1){ $x = $x + 1;} if($property->property_images2){ $x = $x + 1;} if($property->property_images3){ $x = $x + 1;} if($property->property_images4){ $x = $x + 1;} if($property->property_images5){ $x = $x + 1;}

                                            preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $property->description, $matches);
                                            if(!empty($matches[1])){ $url = $matches[1];}else{ $url = '';}


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

                                                                <a data-gallery="floor-images{{$i}}" href=" {{ URL::asset('upload/properties/'.$property->basement) }} " style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}" > </a>

                                                            @else

                                                                <a data-gallery="floor-images{{$i}}" href="{{ URL::asset('upload/properties/'.$property->basement) }}" style="color: white;" data-toggle="lightbox"> <img style="width: 20px;margin-right: 10px;position: relative;bottom: 2px;" src="{{ URL::asset('assets/img/blueprint.png') }}" > </a>

                                                            @endif


                                                            <?php $check = 1; ?>

                                                        @endif


                                                    @endif

                                                @endif


                                                @if($url)

                                                    <a data-width="1280" href="{{$url}}" data-gallery="videos{{$i}}" style="color: white;" data-toggle="lightbox"> <i class="fas fa-film" style="font-size: 18px;margin-right: 12px;"></i> </a>

                                                    @if($property->video)

                                                        <div style="display: none;" data-toggle="lightbox" data-type="video" data-gallery="videos{{$i}}" data-width="1280" data-remote="{{ URL::asset('upload/properties/'.$property->video) }}"></div>

                                                    @endif

                                                @else

                                                    @if($property->video)

                                                        <a data-width="1280" href="{{ URL::asset('upload/properties/'.$property->video) }}" data-type="video" data-gallery="videos{{$i}}" style="color: white;" data-toggle="lightbox"> <i class="fas fa-film" style="font-size: 18px;margin-right: 12px;"></i> </a>

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

                                        <div class="property-content" style="height: 133px;">
                                            <h3 style="margin-bottom: 5px;margin-top: 3px;"><a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{URL::to('properties/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a> <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">{{ Str::limit($property->address,40) }}</small></h3>
                                            <p>{{$property->bedrooms}} @if($property->bedrooms == 1) room  @else rooms @endif - {{$property->area}}</p>
                                            <b>@if($property->sale_price) € {{$property->sale_price}} @elseif($property->rent_price) € {{$property->rent_price}} @endif</b>
                                        </div>

                                        <div class="property-content" style="border-top:1px solid #cacaca;display: flex;padding: 0;height: 125px;align-items: center;">

                                            <div style="width: 40%;padding-left: 3px;">
                                                <span style="font-weight: 700;color: #aca6a6;">Brought to you by</span>
                                            </div>

                                            <div style="width: 60%;height: 100%;padding: 8px;padding-bottom: 2px;">

                                                @if($property->image_icon)
                                                    <img style="width: 100%;height: 100%;" src="{{ URL::asset('upload/members/'.$property->image_icon.'-b.jpg') }}">
                                                @else
                                                    <img style="width: 100%;height: 100%;" src="{{ URL::asset('assets/img/team03.jpg') }}" >
                                                @endif

                                            </div>

                                        </div>

                                    </div>


                                </div>

                            @endforeach


                        </div>
                    </div></div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;margin-top: 50px;">

                <div class="col-md-12 col-sm-12">
                    <div class="heading-title">
                        <h2>Top Properties</h2>
                    </div>
                </div>

                <div class="row" style="display: flex;width: 100%;margin: 0;text-align: center;">

                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">

                <div class="topProperties">

                @foreach($top_properties as $temp)

                        <div class="col-md-3 col-sm-12 col-xs-12">

                        <div class="property-container" style="margin: 10px auto;">
                            <div class="property-image">

                                <img src="{{ URL::asset('upload/properties/'.$temp->featured_image.'-s.jpg') }}" alt="{{ $temp->property_name }}" style="width: 100%;height: 200px;">
                                <div class="property-price">
                                    <h4>{{ getPropertyTypeName($temp->property_type)->types }}</h4>
                                    <span>{{getcong('currency_sign')}}@if($temp->sale_price) {{$temp->sale_price}} @else {{$temp->rent_price}} @endif</span>
                                </div>
                                <div class="property-status">
                                    <span>For {{$temp->property_purpose}}</span>
                                </div>
                            </div>
                            <div class="property-features">
                                <span><i class="fa fa-home"></i> {{$temp->area}}</span>
                                <span><i class="fa fa-hdd-o"></i> {{$temp->bedrooms}}</span>
                                <span><i class="fa fa-male"></i> {{$temp->bathrooms}}</span>
                            </div>
                            <div class="property-content">
                                <h3><a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{URL::to('properties/'.$temp->property_slug)}}">{{ Str::limit($temp->property_name,35) }}</a> <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">{{ Str::limit($temp->address,40) }}</small></h3>
                            </div>
                        </div>
                    </div>

                @endforeach

                </div>
                    </div></div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;margin-top: 50px;">

                <div class="col-md-12 col-sm-12">
                    <div class="heading-title">
                        <h2>Top Members</h2>
                    </div>
                </div>

                <div class="row" style="display: flex;width: 100%;margin: 0;">

                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">

                        <div class="topMembers">

                    @foreach($top_members as $temp)

                        <div class="col-md-3 col-sm-12 col-xs-12 flex-box-div">
                            <div class="property-container" style="margin: 10px auto;">
                                <div class="property-image">

                                    @if($temp->image_icon)

                                        <img src="{{ URL::asset('upload/members/'.$temp->image_icon.'-b.jpg') }}" style="width: 100%;height: 200px;" >

                                    @else

                                        <img src="{{ URL::asset('assets/img/user.png') }}" style="width: 100%;height: 200px;" >

                                    @endif

                                </div>

                                <div class="property-features">
                                    <span><i class="fa fa-home"></i> {{$temp->properties_count}}</span>
                                </div>

                                <div class="property-content">
                                    <h3><a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{URL::to('agents')}}">{{$temp->name}}</a> <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">{{$temp->email}}</small></h3>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                    </div></div>

            </div>


        </div>
        <!-- end:latest -->


      </div>
    </div>
    <!-- end:content -->

<style>

    .css-htlmaj
    {
        padding:0 18px;
        margin:0px auto 0px;
    }

    @media(min-width:1021px)
    {
        .css-htlmaj
        {
            padding:0 10px;
            margin-bottom:50px;
        }
    }

    .css-ce6ko1{font-size:25px;font-weight:bold;margin-bottom:18px;}

    @media(min-width:624px){.css-48sroz{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;}}

    @media(min-width:1021px){.css-48sroz{border-radius:3px;border:1px solid #fff;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);}}

    .css-48sroz li{font-weight:bold;margin-bottom:12px;background-color:#fff;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);}

    .css-48sroz li:hover,.css-48sroz li:focus{box-shadow:0 3px 6px 0 rgba(30,41,61,0.15),0 5px 10px 0 rgba(30,41,61,0.15);-webkit-transition:box-shadow ease-in 100ms;transition:box-shadow ease-in 100ms;z-index:1;}

    @media(min-width:624px){.css-48sroz li{-webkit-flex-basis:calc(50% - 6px);-ms-flex-preferred-size:calc(50% - 6px);flex-basis:calc(50% - 6px);}}

    @media(min-width:1021px){.css-48sroz li{-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;-webkit-flex-basis:20%;-ms-flex-preferred-size:20%;flex-basis:20%;font-size:18px;text-align:center;box-shadow:none;border-right:1px solid #e6e9ed;margin-top:-1px;margin-bottom:-1px;}

    .css-48sroz li:last-child{border-right-width:0;}}

    .css-48sroz a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;padding:12px;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;font-size: 90%;}

    @media(min-width:1021px){.css-48sroz a{display:block;padding:30px 18px;height:100%;}}

    .css-48sroz img{color:#0ea800;width:30px !important;height:30px !important;margin-right:12px;}

    @media(min-width:1021px){.css-48sroz img{display:block;margin:0 auto 12px auto;width:48px !important;height:48px !important;}}

    .css-jeyium{stroke-linejoin:round;stroke-linecap:round;fill:none;vertical-align:middle;width:24px;height:24px;}


    .latest
    {
        height: 265px;
    }

    .latest img
    {
        height: 100%;
    }

    .property-status img
    {
        display: inline-block;
    }

    .property-status a:focus
    {
        outline: none;
    }

    .modal-backdrop.fade
    {
        opacity: 0.5;
    }

   .ekko-lightbox .modal-header
    {
        min-height: 0;
        padding: 0;
        border: 0;
       display: none;

    }

    .ekko-lightbox .modal-title
    {
        display: none;
    }

    .ekko-lightbox .modal-header .close
    {
        font-size: 60px;
        position: absolute;
        right: -115px;
        top: -62px;
        opacity: 0.8;
        text-shadow: none;

    }

    .ekko-lightbox .modal-body
    {
        padding: 0;
    }

    .ekko-lightbox .modal-content
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

    .slick-slide
    {
        outline: none;
    }

    .property-container
    {
        box-shadow: 0 0rem 1.2rem -3px #c2c2c2;margin-bottom: 30px;padding: 0;
    }

    .slick-arrow{position:absolute;top:50%;width:60px;height:60px;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);background:rgba(#fff,0.8);color:#0b2047;text-align:center;cursor:pointer;z-index:1;width:48px;height:48px;background:#fff;color:#3c475b;border:0;border-radius:50%;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);opacity:0.9;}

    .slick-arrow:before
    {
        display: none;
    }

    .slick-arrow:hover , .slick-arrow:focus
    {
        outline: none;
        background: #fff;
    }

    .css-oee40j{stroke-linejoin:round;stroke-linecap:round;fill:none;vertical-align:middle;width:24px;height:24px;vertical-align:middle;}

    .css-oee40j:hover
    {
        color: #0ea800;
    }

    .slick-prev:hover, .slick-prev:focus, .slick-next:hover, .slick-next:focus
    {
        color: #0ea800;
    }

</style>

<script>

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true,
            showArrows:true
        });


        $('.modal-header .close').appendTo(".ekko-lightbox");

    });

    $(document).ready(function() {

    $('.latestProperties').slick({
        dots: false,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: true,
                    centerMode: false,
                    centerPadding: '0px',
                    slidesToShow: 2.1,
                    infinite: false,
                }
            },
            {
                breakpoint: 720,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1.1,
                    infinite: false,
                }
            }
        ],
        prevArrow: "<button class='slick-arrow slick-prev' data-role='none' type='button' style='display: block;'><svg class='domain-icon css-oee40j' viewBox='0 0 24 24' aria-hidden='true'><path fill='none' stroke='currentColor' stroke-width='2' d='M15 5l-7 7 7 7'></path></svg><span class='css-16q9xmc'>Prev</span></button>",
        nextArrow: "<button class='slick-arrow slick-next' data-role='none' type='button' style='display: block;'><svg class='domain-icon css-oee40j' viewBox='0 0 24 24' aria-hidden='true'><path fill='none' stroke='currentColor' stroke-width='2' d='M9 5l7 7-7 7'></path></svg><span class='css-16q9xmc'>Next</span></button>"
    });

        $('.topProperties').slick({
            dots: false,
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        centerMode: false,
                        centerPadding: '0px',
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ],
            prevArrow: "<button class='slick-arrow slick-prev' data-role='none' type='button' style='display: block;'><svg class='domain-icon css-oee40j' viewBox='0 0 24 24' aria-hidden='true'><path fill='none' stroke='currentColor' stroke-width='2' d='M15 5l-7 7 7 7'></path></svg><span class='css-16q9xmc'>Prev</span></button>",
            nextArrow: "<button class='slick-arrow slick-next' data-role='none' type='button' style='display: block;'><svg class='domain-icon css-oee40j' viewBox='0 0 24 24' aria-hidden='true'><path fill='none' stroke='currentColor' stroke-width='2' d='M9 5l7 7-7 7'></path></svg><span class='css-16q9xmc'>Next</span></button>"
        });

        $('.topMembers').slick({
            dots: false,
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        centerMode: false,
                        centerPadding: '0px',
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ],
            prevArrow: "<button class='slick-arrow slick-prev' data-role='none' type='button' style='display: block;'><svg class='domain-icon css-oee40j' viewBox='0 0 24 24' aria-hidden='true'><path fill='none' stroke='currentColor' stroke-width='2' d='M15 5l-7 7 7 7'></path></svg><span class='css-16q9xmc'>Prev</span></button>",
            nextArrow: "<button class='slick-arrow slick-next' data-role='none' type='button' style='display: block;'><svg class='domain-icon css-oee40j' viewBox='0 0 24 24' aria-hidden='true'><path fill='none' stroke='currentColor' stroke-width='2' d='M9 5l7 7-7 7'></path></svg><span class='css-16q9xmc'>Next</span></button>"
        });

    });

</script>

    @include("_particles.testimonials")

    @include("_particles.partners")

	@include("_particles.subscribe")



@endsection
