@extends("app")

@section('head_title', 'Plaats gratis jouw woning of kamer op Zoekjehuisje.nl')
@section('head_keywords', 'gratis kamer plaatsen, gratis woning plaatsen, nieuwbouwprojecten, woninrguil, gratis woningruil plaatsen, gratis reageren op kamers, gratis reageren op woningen, op zoek naar woningruil, op zoek naar kamer, op zoek naar een woning')
@section('head_description', 'Wil jij jouw woning of kamer gratis plaatsen? Of ben je op zoek naar een huurwoning, koopwonig, nieuwbouwproject of woningruil? Bekijk snel ons platform en begin vandaag nog met het plaatsen of zoeken van een woning.')

@section("content")

<!-- begin:content -->
    <div id="content" style="padding: 10px 0px 0px 0px;">

        @if(Session::has('flash_message'))
            <div class="alert alert-success alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">
                            <span aria-hidden="true">&times;</span></button>
                        {{$error}}
                    </div>
                @endforeach
            @endif

      <div class="container" style="width: 100%;">

        <!-- begin:latest -->

        <div class="row" style="margin: 0;">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;">

                <div class="col-md-12 col-sm-12">
                    <div class="heading-title" style="margin-bottom: 45px;">
                        <h2>{{__('text.Latest Properties')}}</h2>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 show-more-container" style="margin-bottom: 10px;text-align: right;">
                        <a href="{{URL::to('woningaanbod')}}" style="background-color: transparent;color: black;border-width: 2px;" class="btn btn-success">{{__('text.Show More Properties')}}</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 latest-container">

                        <div class="latestProperties">

                            <?php $i = 0; ?>

                            @foreach($propertieslist as $i => $property)

                                    <?php preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $property->description, $matches);


                                    if(!empty($matches[1]))
                                    {
                                        $url = $matches[1];
                                    }
                                    else
                                        {
                                            $url = '';
                                        }


                                    if($property->video)
                                        {
                                            $parsed = parse_url($property->video);

                                            if(isset($parsed['host']))
                                                {
                                                    if($parsed['host'] == 'www.youtube.com' || $parsed['host'] == 'youtube.com' || $parsed['host'] == 'youtu.be')
                                                    {
                                                        $youtube_video = 1;
                                                    }
                                                    else
                                                    {
                                                        $youtube_video = 0;
                                                    }
                                                }
                                            else
                                                {
                                                    $youtube_video = 0;
                                                }
                                        }

                                    ?>

                                <div class="col-md-4 col-sm-12 col-xs-12">

                                    <div style="min-height: 55px;display: flex;">
                                        @if($property->open_date)
                                            <div class="property-price" style="min-height: 28px;position:relative;max-width: 100%;font-size: 11px;padding: 3px 5px;margin: auto 0;width: 100%;border-radius: 5px;"><span>{{__('text.Open House')}} {{$property->open_date}} {{$property->open_timeFrom}} to {{$property->open_timeTo}}</span></div>
                                        @else
                                            <div class="property-price" style="background: transparent;min-height: 28px;position:relative;max-width: 100%;font-size: 11px;padding: 3px 5px;margin: auto 0;width: 100%;border-radius: 5px;"></div>
                                        @endif

                                    </div>

                                    <div class="property-container" style="margin-bottom: 10px;border-left-width: 0.9px;">
                                        <div class="property-image latest">

                                            <a style="outline: none;" href="{{URL::to('woningaanbod/'.$property->property_slug)}}">

                                            <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}" alt="{{ $property->property_name }}">

                                            </a>

                                            @if($url)

                                                <div class="video-wrapper-inner" style="position: absolute;margin-right: 5%;margin-top: 5%;top: 0;right: 0;">
                                                    <a data-width="1280" href="{{$url}}" data-gallery="videos{{$i}}" data-toggle="lightbox" class="popup-video" style="cursor: pointer;outline: none;">
                                                    <span class="popup-video-inner">
                                                    <i class="flaticon-play"></i>
                                                    </span>
                                                    </a>
                                                </div>

                                                @if($property->video)

                                                    <div style="display: none;" data-toggle="lightbox" @if($youtube_video) data-type="youtube" data-remote="{{ $property->video }}" @else data-type="video" data-remote="{{ URL::asset('upload/properties/'.$property->video)  }}" @endif data-gallery="videos{{$i}}" data-width="1280"></div>

                                                @endif

                                            @else

                                                @if($property->video)

                                                    <div class="video-wrapper-inner" style="position: absolute;margin-right: 5%;margin-top: 5%;top: 0;right: 0;">
                                                        <a data-width="1280" @if($youtube_video) href="{{ $property->video }}" data-type="youtube" @else href="{{ URL::asset('upload/properties/'.$property->video) }}" data-type="video" @endif data-gallery="videos{{$i}}" data-toggle="lightbox" class="popup-video" style="cursor: pointer;outline: none;">
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

                                                <div class="property-price" style="top: 12px;left: 12px;border-radius: 5px;padding: 5px 10px;">
                                                    <span>{{__('text.For '.$property->property_purpose)}}</span>
                                                    {{--<h4>{{ getPropertyTypeName($property->property_type)->types }}</h4>
                                                    <span>{{getcong('currency_sign')}}@if($property->sale_price) {{$property->sale_price}} @else {{$property->rent_price}} @endif</span>--}}
                                                </div>

                                            @endif


                                            @if($property->available_immediately)

                                                <div class="property-status status-responsive" style="background:#48cfad;width:170px;bottom: 12px;left: 12px;border-radius: 5px;padding: 0px;text-align: center;">
                                                    <span>{{__('text.Available Immediately')}}</span>
                                                </div>

                                            @endif

                                            <?php

                                            $x = 0;

                                            if($property->featured_image){ $x = $x + 1;}

                                            for($l=0; $l<24; $l++){

                                                $var = 'property_images'.$l;

                                                if($property->$var){

                                                    $x = $x + 1;

                                                }

                                            }

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


                                                <a data-toggle="lightbox" data-gallery="hidden-images{{$i}}" href="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}" style="color: white;"> <i class="fas fa-camera" style="font-size: 18px;"></i><span style="padding: 0px 6px;font-weight: 700;font-size: 18px;position: relative;bottom: 1px;margin-left: 5px;">{{$x}}</span></a>

                                                    <?php for($p=1; $p<25; $p++){ $property_image = 'property_images'.$p; ?>

                                                        @if($property->$property_image)

                                                            <div style="display: none;" data-toggle="lightbox" data-gallery="hidden-images{{$i}}" data-remote="{{ URL::asset('upload/properties/'.$property->$property_image.'-b.jpg') }}"></div>

                                                        @endif

                                                    <?php } ?>


                                                <?php $i = $i + 1; ?>


                                            </div>
                                        </div>

                                        {{--<div class="property-features">
                                          <span><i class="fa fa-home"></i> {{$property->area}}</span>
                                          <span><i class="fa fa-hdd-o"></i> {{$property->bedrooms}}</span>
                                          <span><i class="fa fa-male"></i> {{$property->bathrooms}}</span>
                                        </div>--}}

                                        <div style="display: inline-block;width: 100%;padding-bottom: 0;" class="property-content">
                                            <h3 style="margin-bottom: 0;margin-top: 0px;display: inline-block;width: 100%;">

                                                <div style="display: inline-block;width: 100%;">
                                                    <a style="font-size: 12px;text-overflow: ellipsis;display: block;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;white-space: nowrap;" href="{{URL::to('woningaanbod/'.$property->property_slug)}}">{{ Str::limit(str_replace(', Nederland', '', $property->property_name),45) }}</a>
                                                </div>

                                                <div style="display: inline-block;width: 100%;">

                                                    <div class="extra-text" style="display: flex;flex-direction: row;float: left;">

                                                        <img style="width: 14px;height: 12px;float: left;margin-right: 10px;align-self: center;" src="{{ URL::asset('assets/img/browser.png') }}">

                                                        <span class="res-span" style="font-weight: 600;font-size: 12px;display: flex;">{{$property->area}} <small class="res-small" style="margin-top: 0;display: flex;align-items: center;margin-left: 3px;">m2</small></span>

                                                    </div>

                                                    @if($property->bedrooms >= 1)

                                                        <div class="extra-text" style="display: flex;flex-direction: row;float: left;margin-left: 10px;">

                                                            <img style="width: 14px;height: 14px;float: left;margin-right: 10px;align-self: center;" src="{{ URL::asset('assets/img/bed.png') }}">

                                                            <span class="res-span" style="font-weight: 600;font-size: 12px;display: flex;">{{$property->bedrooms}} @if($property->bedrooms == 1) {{__('text.room')}}  @else {{__('text.rooms')}} @endif</span>

                                                        </div>

                                                    @endif

                                                </div>

                                                <div style="display: flex;flex-direction: row;align-items: center;height: 40px;margin-bottom: 5px;">

                                                    <div style="min-width: 33%;margin-right: 3px;">

                                                        <small style="margin-top: 0;font-weight: 600;font-size: 10px;">@if($property->sale_price) € {{number_format($property->sale_price, 0, ',', '.')}} {{$property->cost_for}} @elseif($property->rent_price) € {{number_format($property->rent_price, 0, ',', '.')}} per maand @endif</small>

                                                    </div>

                                                    @if(!$property->landlord)

                                                        <div style="width: 100%;height: 100%;">

                                                            <a style="outline: none;" href="{{URL::to('makelaars/details/'.$property->user_id)}}" tabindex="0">

                                                                @if($property->image_icon)

                                                                    <img style="width: 100%;height: 100%;float: right;" src="{{ URL::asset('upload/members/'.$property->image_icon.'-b.jpg') }}">

                                                                @elseif($property->company_name)

                                                                    <h3 class="company-res" style="word-break: break-all;margin: 0;display: flex;align-items: center;justify-content: center;height: 100%;font-size: 12px;line-height: 20px;">{{$property->company_name}}</h3>

                                                                @endif

                                                            </a>

                                                        </div>

                                                    @endif


                                                </div>


                                                {{--<small style="text-overflow: ellipsis;display: block;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;width: 100%;float: left;white-space: nowrap;margin-top: 0;">{{ Str::limit($property->address,40) }}</small>--}}

                                            </h3>

                                        </div>

                                    </div>

                                    @foreach($properties_headings as $h)

                                        @if($h->heading_order == $i)

                                            <div class="property-price" style="background: {{$h->color}};position:relative;max-width: 100%;margin-bottom: 12px;font-size: 15px;padding: 2px 0px;border-radius: 5px;">{{$h->title}}</div>

                                        @endif

                                    @endforeach

                                    {{--@if($property->listed)

                                        <div class="property-price" style="background: #d6d63e;position:relative;max-width: 100%;margin-bottom: 12px;font-size: 15px;padding: 2px 0px;border-radius: 5px;">{{$property->listed}}</div>

                                    @endif--}}

                                </div>

                            @endforeach


                        </div>
                    </div></div>

            </div>

            @if(count($tips))

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-container" style="display: inline-block;margin-top: 50px;">

                    <div class="col-md-12 col-sm-12">
                        <div class="heading-title">
                            <h2>{{__('text.Our Tips')}}</h2>
                        </div>
                    </div>

                    <div class="row" style="display: flex;width: 100%;margin: 0;">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex;">

                            <div style="margin-top: 20px;margin-bottom: 20px;" data-testid="key-services" class="css-htlmaj col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                <div>
                                    <div class="domain-home_ down is-visible">

                                        <ul class="css-48sroz" style="list-style: none;padding: 0;">

                                            @foreach($tips as $tip)

                                                <li>

                                                    @if($tip->image)

                                                        <a target="_blank" href="@if($tip->url){{$tip->url}} @else {{URL::to('/')}} @endif">

                                                            <img src="{{ URL::asset('upload/tips/'.$tip->image) }}">{{$tip->title}}

                                                        </a>

                                                    @else

                                                        <a target="_blank" style="display: flex;justify-content: center;" href="@if($tip->url){{$tip->url}} @else {{URL::to('/')}} @endif">

                                                            {{$tip->title}}

                                                        </a>

                                                    @endif

                                                </li>

                                            @endforeach


                                        </ul></div></div></div>

                        </div>

                        {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-container1" style="margin: auto;">

                            <div class="topProperties">

                                @foreach($top_properties as $temp)

                                    <div class="col-md-3 col-sm-12 col-xs-12">

                                        <div class="property-container" style="margin: 10px auto;">

                                            <div class="property-image">

                                                <a style="outline: none;" href="{{URL::to('woningaanbod/'.$temp->property_slug)}}">

                                                    <img class="res-content" src="{{ URL::asset('upload/properties/'.$temp->featured_image.'-b.jpg') }}" alt="{{ $temp->property_name }}" style="width: 100%;height: 200px;">

                                                </a>

                                                <div class="property-status">
                                                    <span>{{__('text.For '.$temp->property_purpose)}}</span>
                                                </div>

                                            </div>


                                            <div class="property-features">

                                                <span><i class="fa fa-home"></i> {{$temp->area}}</span>

                                                @if($temp->bedrooms > 0)

                                                    <span><i class="fa fa-bed"></i> {{$temp->bedrooms}}</span>

                                                @endif


                                                @if($temp->bathrooms > 0)

                                                    <span><i class="fa fa-male"></i> {{$temp->bathrooms}}</span>

                                                @endif

                                            </div>


                                            <div class="property-content" style="padding: 0px 15px 10px 15px;">

                                                <h3 style="margin: 10px 0px 0px 0px;"><a style="text-overflow: ellipsis;display: block;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;white-space: nowrap;" href="{{URL::to('woningaanbod/'.$temp->property_slug)}}">{{ Str::limit($temp->property_name,35) }}</a> <small style="text-overflow: ellipsis;display: block;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;white-space: nowrap;">{{ Str::limit($temp->address,40) }}</small></h3>

                                                <div class="bottom-text" style="min-height: 45px;display: flex;flex-direction: row;justify-content: space-between;align-items: flex-end;font-size: 90%;">

                                                    <small style="font-weight: 600;">{{ getPropertyTypeName($temp->property_type)->types }}</small>
                                                    <small>€@if($temp->sale_price) {{number_format($temp->sale_price, 0, ',', '.')}} {{$temp->cost_for}} @else {{number_format($temp->rent_price, 0, ',', '.')}} @endif</small>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>--}}

                    </div>

                </div>

            @endif

            @if(count($top_members) > 0)

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-container" style="display: inline-block;">

                <div class="col-md-12 col-sm-12">
                    <div class="heading-title">
                        <h2>{{__('text.Top Members')}}</h2>
                    </div>
                </div>

                <div class="row" style="display: flex;width: 100%;margin: 0;">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 members-container" style="margin: auto;">

                        <div class="topMembers">

                    @foreach($top_members as $temp)

                        <div class="col-md-3 col-sm-12 col-xs-12 flex-box-div">
                            <div class="property-container" style="margin: 10px auto;">
                                <div class="property-image">

                                    <a style="outline: none;" href="{{URL::to('makelaars/details/'.$temp->id)}}">

                                    @if($temp->image_icon)

                                        <img class="res-content" src="{{ URL::asset('upload/members/'.$temp->image_icon.'-b.jpg') }}" style="width: 100%;height: 200px;" >

                                    @elseif($temp->company_name)

                                        <h2 class="res-content" style="margin: 0;height: 200px;display: flex;justify-content: center;align-items: center;text-align: center;">{{$temp->company_name}}</h2>

                                    @endif

                                    </a>

                                </div>

                                <div class="property-features">
                                    <span><i class="fa fa-home"></i> {{$temp->properties_count}}</span>
                                </div>

                                <div class="property-content">
                                    <h3><a style="text-overflow: ellipsis;display: block;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;white-space: nowrap;" href="{{URL::to('makelaars/details/'.$temp->id)}}">{{$temp->name}}</a> @if($temp->show_email == 1) <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">{{$temp->email}}</small> @endif</h3>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                    </div></div>

            </div>

                @endif


        </div>
        <!-- end:latest -->


      </div>
    </div>
    <!-- end:content -->

<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

<style>

    .ekko-lightbox .modal-dialog
    {
        margin: 10px;
    }

    @media (max-width: 478px)
    {
        .res-container
        {
            padding: 0 !important;
        }


        .res-content
        {
            height: 150px !important;
            font-size: 20px;
        }


        .res-size
        {
            min-height: 280px !important;
        }

        .bottom-text
        {
            min-height: 55px !important;
            flex-direction: column !important;
            justify-content: flex-end !important;
            align-items: flex-start !important;
        }

        .bottom-text small
        {
            margin: 2px 0px;
        }
    }

    @media (max-width: 768px)
    {
        .latest
        {
            height: 185px !important;
        }

        .property-content h3, .property-text h3
        {
            font-size: 15px !important;
            line-height: 18px !important;
        }


        .property-content h3 .res-small
        {
            font-size: 10px !important;
        }

        .property-content h3 .res-span
        {
            font-size: 10px !important;
        }

        .property-content h3 small, .property-text h3 small
        {
            font-size: 11px;
            margin-top: 5px;
        }

        /*.extra-text span
        {
            font-size: 9px !important;
        }*/

        .extra-text img
        {
            width: 10px !important;
            height: 10px !important;
            margin-right: 5px !important;
        }

        .property-content .company-res
        {
            font-size: 12px !important;
        }

    }

    small
    {
        line-height: 15px !important;
    }

    @media (max-width: 400px) {
        .status-responsive {
            width: 120px !important;
            font-size: 10px !important;
        }
    }

    @media (max-width: 1299px){
        .latest-container{padding: 0px 95px;}
        .top-container1{padding: 0px 95px;}
        .members-container{padding: 0px 95px;}
        .show-more-container{padding: 0px 120px;}
    }

    @media (min-width: 1300px){
        .latest-container{padding: 0px 200px;}
        .top-container1{padding: 0px 200px;}
        .members-container{padding: 0px 200px;}
        .show-more-container{padding: 0px 215px;}
    }

    @media (max-width: 1200px){
        .latest-container{padding: 0px 15px;}
        .top-container1{padding: 0px 15px;}
        .members-container{padding: 0px 15px;}
        .show-more-container{padding: 0px 15px;}
    }

    .video-wrapper-inner .popup-video{position:relative;z-index:1;display:inline-block;width:50px;height:50px;line-height:50px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;font-size:18px;color:#fff;background:#f9424b;text-align:center}

    @media (min-width: 1200px){.video-wrapper-inner .popup-video{width:70px;height:70px;line-height:70px;font-size:22px}}

    .video-wrapper-inner .popup-video:before{-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;content:'';position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;background:#f9424b;opacity:0.3;filter:alpha(opacity=30);border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-animation:scaleicon 3s ease-in-out 0s infinite alternate;animation:scaleicon 3s ease-in-out 0s infinite alternate}.widget-video.style2 .popup-video{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}

    @-webkit-keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

    @keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

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

    .css-ce6ko1{font-size:25px;font-weight:bold;margin-bottom:30px;}

    @media(min-width:624px){.css-48sroz{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-webkit-justify-content:flex-start;-ms-flex-pack:justify;justify-content:flex-start;}}

    @media(min-width:1021px){.css-48sroz{border-radius:3px;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;}}

    .css-48sroz li{font-weight:bold;margin-bottom:12px;background-color:#fff;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);}

    .css-48sroz li:hover,.css-48sroz li:focus{box-shadow:0 3px 6px 0 rgba(30,41,61,0.15),0 5px 10px 0 rgba(30,41,61,0.15);-webkit-transition:box-shadow ease-in 100ms;transition:box-shadow ease-in 100ms;z-index:1;}

    @media(min-width:624px){.css-48sroz li{-webkit-flex-basis:calc(50% - 6px);-ms-flex-preferred-size:calc(50% - 6px);flex-basis:calc(50% - 6px);}}

    @media(min-width:1021px){

    .css-48sroz li{-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;-webkit-flex-basis:24%;-ms-flex-preferred-size:24%;flex-basis:24%;font-size:18px;text-align:center;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);border-right:1px solid #e6e9ed;margin-top:-1px;margin-bottom:-1px;}

    .css-48sroz li:last-child{border-right-width:0;}

    }

    @media(min-width:1600px){.css-48sroz li{-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;-webkit-flex-basis:18%;-ms-flex-preferred-size:18%;flex-basis:18%;font-size:18px;text-align:center;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);border-right:1px solid #e6e9ed;margin-top:-1px;margin-bottom:-1px;}}

    .css-48sroz a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;padding:12px;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;font-size: 90%;}

    @media(min-width:1021px){.css-48sroz a{display:block;padding:20px 18px;height:100%;}}

    .css-48sroz img{color:#0ea800;width:110px !important;height:80px !important;margin-right:12px;}

    @media(min-width:1021px){.css-48sroz img{display:block;margin:0 auto 20px auto;width:100% !important;height:125px !important;}}

    .css-jeyium{stroke-linejoin:round;stroke-linecap:round;fill:none;vertical-align:middle;width:24px;height:24px;}


    .latest
    {
        height: 210px;
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
        opacity: 0;
        transition: all .2s linear;
    }

    .modal1.fade.in
    {
        display: flex !important;
    }

    .modal2.fade.in
    {
        display: flex !important;
    }

    .navbar-fixed-top, .navbar-fixed-bottom
    {
        -webkit-transform: none;
        transform: none;
    }


    .slick-slide
    {
        outline: none;
    }

    @media (min-width: 1200px){

        .slick-slide
        {
            padding: 0px 20px;
        }

    }

    @media (min-width: 1250px){

        .slick-slide
        {
            padding: 0px 30px;
        }

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


        $('.ekko-lightbox .modal-header .close').appendTo(".ekko-lightbox");

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

    $(document).ready(function() {

        $('.alert-box').delay(5000).fadeOut('slow');

    $('.latestProperties').slick({
        dots: false,
        arrows: true,
        centerMode: true,
        centerPadding: '300px',
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 2000,
                settings: {
                    centerMode: true,
                    centerPadding: '200px',
                }
            },
            {
                breakpoint: 1650,
                settings: {
                    centerMode: true,
                    centerPadding: '40px',
                }
            },
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
                    centerPadding: '40px',
                    slidesToShow: 1,
                    initialSlide: 1,
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
            centerMode: true,
            centerPadding: '300px',
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 2000,
                    settings: {
                        centerMode: true,
                        centerPadding: '200px',
                    }
                },
                {
                    breakpoint: 1650,
                    settings: {
                        centerMode: false,
                        centerPadding: 0,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        centerMode: false,
                        centerPadding: 0,
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
            centerMode: true,
            centerPadding: '300px',
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 2000,
                    settings: {
                        centerMode: true,
                        centerPadding: '200px',
                    }
                },
                {
                    breakpoint: 1650,
                    settings: {
                        centerMode: false,
                        centerPadding: 0,
                    }
                },
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


@if(count($blogs) >= 1)

    <style>

        .description-content blockquote:before
        {
            content: '\f10d';
            font-family: 'FontAwesome';
            position: relative;
            left: -1em;
            top: 0;
            display: block;
            width: 20px;
            height: 20px;
            color: black;
            font-size: 10px;
        }

    </style>

<!-- begin:blog -->
<div id="partner">
    <div class="container" style="width: 100%;">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-title" style="margin-top: 20px;">
                    <h2>{{__('text.Our Blogs')}}</h2>
                </div>
            </div>
        </div>
        <!-- break -->

        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 show-more-container" style="margin-bottom: 10px;text-align: right;">
                <a href="{{route('front-blogs')}}" style="background-color: transparent;color: black;border-width: 2px;" class="btn btn-success">{{__('text.Show More')}}</a>
            </div>
        </div>

        <div class="row" style="display: flex;width: 100%;margin: 0;">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 members-container" style="margin: auto;">

                <div class="topMembers">

                    @foreach($blogs as $blog)

                        <?php $description = $blog->description;

                        $description = preg_replace(array('#<[^>]+>#','#&nbsp;#'), ' ', $description);

                        $date = $blog->created_at;
                        $date = date("M d, Y", strtotime($date));
                        ?>

                        <div class="col-md-3 col-sm-12 col-xs-12 flex-box-div">
                            <div class="property-container res-size" style="margin: 10px auto;min-height: 380px;">
                                <div class="property-image">

                                    <a style="outline: none;" href="{{ url('blogs/'.$blog->title) }}">

                                    @if($blog->image)
                                        <img class="res-content" src="{{ URL::asset('upload/blogs/'.$blog->image) }}" style="width: 100%;height: 200px;">
                                        @else
                                        <img class="res-content" src="{{ URL::asset('upload/noImage.png') }}" style="width: 100%;height: 200px;">
                                    @endif

                                    </a>

                                </div>

                                <div class="property-content description-content">

                                    <h3><a style="text-overflow: ellipsis;display: block;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;white-space: nowrap;" href="{{ url('blogs/'.$blog->title) }}">{{$blog->title}}</a>
                                    <small style="display: none;color: #acacac;font-style: normal;">{{$date}}</small>
                                    </h3>

                                    <p style="text-overflow: ellipsis;display: -webkit-box;width: 100%;visibility: visible;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;line-height: 2;font-size: 15px;margin-top: 15px;">{{$description}}</p>

                                </div>
                            </div>
                        </div>

                    @endforeach


                </div>
            </div></div>


    </div>
</div>
<!-- end:blog -->

@endif

<input type="hidden" id="cookie-consent" value="{{$cookie}}">

<!-- Modal -->
<div id="myModal2" class="modal modal2 fade" role="dialog" style="overflow: hidden auto;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: auto;padding: 10px 0px;">
                    <button style="outline: none;float: right;" class="col-lg-3 col-md-3 col-sm-3 btn btn-danger hide-cookies">Verberg deze melding</button>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: auto;border: 1px solid #4ab8ca;padding: 20px 20px;">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        Om u zo goed mogelijk te kunnen helpen en deze site goed te laten werken, maakt Zoekjehuisje.nl gebruik van cookies. Als u hiermee akkoord gaat, geeft u ons toestemming voor alle cookies die wij gebruiken. Wilt u geen gebruik maken van alle cookies? Dan kunt u zelf uw voorkeur aanpassen door op instellingen te klikken. Lees gerust onze cookieverklaring en privacybeleid.
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 ck-icn" style="margin-top: 20px;">
                        <img src="{{ URL::asset('assets/img/dessert.png') }}" style="width: 70%;height: 60px;display: block;margin: auto;">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-7 ck-ls" style="float: right;margin-top: 10px;">
                        <button data-dismiss="modal" style="background: #4ab8ca;color: white;outline: none;" type="button" class="btn col-lg-12 col-md-12 col-sm-12 col-xs-12 save-cookie">Ik ga akkoord</button>
                        <span><a class="cookie-btn" style="cursor: pointer;" data-toggle="modal" data-target="#myModal1">Instellingen</a></span>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="myModal1" class="modal modal1 fade" role="dialog" style="overflow-x: hidden;overflow-y: auto;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

                <button style="outline: none;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 30px;" aria-hidden="true">×</span>
                </button>

                <h2 style="text-align: center;color: #d00447;font-weight: 600;display: inline-block;width: 100%;margin-top: 0;">Cookie Settings <img src="{{ URL::asset('assets/img/cookies1.png') }}" style="width: 50px;"></h2>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    Wij maken gebruik van verschillende soorten cookies. Uiteraard beslist u zelf welke cookies Zoekjehuisje.nl mag gebruiken. De website werkt het best wanneer u gebruik maakt van alle cookies. Wij slaan alleen gegevens op die noodzakelijk zijn voor een goede werking van de website. U kunt hierbij denken aan: welke sitepagina's u bezocht heeft, de duur van uw bezoek en het tijdstip en van welke webbrowser u gebruik maakt (zoals Google Chrome, internet Explorer of Firefox).
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 res-ck" style="margin-top: 30px;display: flex;">

                    <input type="hidden" name="cookie_choice" id="cookie-choice" value="3">
                    <input type="hidden" name="ip" id="ip" value="<?php echo Request::ip() ?>">
                    <input type="hidden" id="cookie-token" value="{{csrf_token()}}">

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ck-cont">

                        <div class="cookie-selected cookie-box" data-id="3">
                            <div style="width: 100%;text-align: center;">
                                <img src="{{ URL::asset('assets/img/biscuit.png') }}" style="width: 35px;">
                                <img src="{{ URL::asset('assets/img/biscuit.png') }}" style="width: 35px;">
                                <img src="{{ URL::asset('assets/img/biscuit.png') }}" style="width: 35px;">
                            </div>
                            <div style="width: 100%;text-align: center;margin-top: 20px;">
                                Onze website werkt met deze cookies het best. De site onderzoekt uw bezoekersgedrag, slaat uw keuzes op en laat u informatie zien die handig voor u kunnen zijn en zo goed mogelijk bij u passen.
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ck-cont">

                        <div class="cookie-box" data-id="2">
                            <div style="width: 100%;text-align: center;">
                                <img src="{{ URL::asset('assets/img/biscuit.png') }}" style="width: 35px;">
                                <img src="{{ URL::asset('assets/img/biscuit.png') }}" style="width: 35px;">
                            </div>
                            <div style="width: 100%;text-align: center;margin-top: 20px;">
                                Deze site kan - ter verbetering van onze site en uw gebruikersbeleving- voorkeuren opslaan en uw bezoekersgedrag onderzoeken.
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ck-cont">

                        <div class="cookie-box" data-id="1">
                            <div style="width: 100%;text-align: center;">
                                <img src="{{ URL::asset('assets/img/biscuit.png') }}" style="width: 35px;">
                            </div>
                            <div style="width: 100%;text-align: center;margin-top: 20px;">
                                De site kan voorkeuren opslaan voor een beter resultaat van de werking van de website (zoals uw woonplaats of taalvoorkeur). Deze cookies zijn onmisbaar voor een goed werkende site.
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row" style="margin: 30px 0px 10px 0px;display: inline-block;width: 100%;text-align: center;">
                    <button data-dismiss="modal" style="text-align: center;float: none;outline: none;" class="btn btn-danger save-cookie col-lg-2 col-md-3 col-sm-3 col-xs-4">Opgeslagen</button>
                </div>

            </div>
        </div>

    </div>
</div>

<style>

    .ck-cont
    {
        flex: 1;
    }

    #myModal2 .modal-dialog .modal-content .modal-body{display: inline-block;}

    #myModal2 .modal-dialog
    {
        margin: auto;
        width: 60%;
    }

    #myModal1 .modal-dialog .modal-content .modal-body{display: inline-block;}

    #myModal1 .modal-dialog
    {
        margin: auto;
        width: 60%;
    }

    .cookie-box{height: 100%;padding: 15px;border: 1px solid #e5e5e5;}

    .cookie-box:hover{border: 1px solid #f3de47 !important;cursor: pointer;}

    .cookie-selected{border: 1px solid #f3de47;}

    @media (max-width: 1200px)
    {
        #myModal1 .modal-dialog
        {
            width: 80%;
        }

        #myModal2 .modal-dialog
        {
            width: 80%;
        }
    }

    @media (max-width: 991px)
    {

        #myModal1 .modal-dialog
        {
            width: 90%;
        }

        #myModal2 .modal-dialog
        {
            width: 90%;
        }

        .ck-cont
        {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 767px)
    {
        .ck-ls
        {
            margin-top: 20px !important;
        }

        .ck-ls span{margin-left: 10px;}

        .res-ck{flex-direction: column;}

    }

    .modal-open1{
        overflow: hidden;
        padding-right: 9px;
    }

    body
    {
        padding-right: 0 !important;
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>


    $( document ).ready(function() {

        let previousScrollY = 0;

        var consent = $('#cookie-consent').val();

        $(window).on('load',function(){

            if(consent == '')
            {
                $('#myModal2').modal('show');
            }
        });


        $('#myModal1').on('shown.bs.modal', function () {
            $("body").addClass("modal-open1");
        });

        $('#myModal1').on('hidden.bs.modal', function () {
            $("body").removeClass("modal-open1");
        });


        $(".hide-cookies").click(function () {
            $("#myModal2").modal('toggle');
        });

        $(".cookie-box").click(function () {

            var id =$(this).data('id');

            $("#cookie-choice").val(id);

            $(".cookie-box").removeClass('cookie-selected');
            $(this).addClass('cookie-selected');
        });

        $(".save-cookie").click(function () {

            $.ajax({

                type: "POST",
                url:"{{URL::to('cookie-save/')}}",
                data: {'ip':$('#ip').val(), 'choice':$('#cookie-choice').val(), '_token': $('#cookie-token').val()},
                success: function(msg)
                {
                    /*$("#content").prepend('<div class="alert alert-success alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">\n' +
                        '                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">\n' +
                        '                    <span aria-hidden="true">&times;</span></button>\n' +
                        '                Cookie Consent Saved Successfully' +
                        '            </div>');

                    $('.alert-box').delay(5000).fadeOut('slow');*/
                },
                error: function()
                {
                    $("#content").prepend('<div class="alert alert-success alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">\n' +
                        '                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">\n' +
                        '                    <span aria-hidden="true">&times;</span></button>\n' +
                        '                Something went wrong!' +
                        '            </div>');

                    $('.alert-box').delay(5000).fadeOut('slow');

                }

            });

        });

    });

</script>

@if(count($partners) != 0)

@include("_particles.partners")

@endif

@include("_particles.subscribe")



@endsection
