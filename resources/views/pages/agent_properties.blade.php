@extends("app")

@section('head_title', 'Similar Properties | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        <h2>Similar Properties</h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="active">Similar Properties</li>
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

                    <!-- begin:product -->
                    <div class="row {{--container-realestate--}}">

                        <?php $i = 0; ?>

                        @foreach($properties as $i => $property)
                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 40px;">

                                <div class="property-price" style="position:relative;max-width: 100%;font-size: 15px;padding: 3px 0px;margin-bottom: 6px;border-radius: 5px;">Open House <span>{{$property->open_date}} {{$property->open_timeFrom}} to {{$property->open_timeTo}}</span></div>

                                <div class="property-container" style="border: 1px solid #48cfad;margin-bottom: 10px">
                                    <div class="property-image">

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
                                        <h3 style="margin-bottom: 5px;margin-top: 3px;"><a href="{{URL::to('properties/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a> <small>{{ Str::limit($property->address,40) }}</small></h3>
                                        <p>{{$property->bedrooms}} rooms - {{$property->area}}</p>
                                        <b>@if($property->sale_price) € {{$property->sale_price}} @elseif($property->rent_price) € {{$property->rent_price}} @endif</span></b>
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


                                <div class="property-price" style="background: #d6d63e;position:relative;max-width: 50%;margin-bottom: 12px;font-size: 15px;padding: 2px 0px;border-radius: 5px;">Listed {{$property->listed}}</div>


                            </div>
                            <!-- break -->
                        @endforeach


                    </div>
                    <!-- end:product -->

                    <!-- begin:pagination -->
                @include('_particles.pagination', ['paginator' => $properties])
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

    <style>

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

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true,
                showArrows:true
            });


            $('.modal-header .close').appendTo(".ekko-lightbox");

        });

    </script>

@endsection