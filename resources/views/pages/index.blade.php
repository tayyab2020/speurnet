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
        <!-- begin:latest -->

        <div class="row">

            <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12" style="display: inline-block;">

                <div class="col-md-12 col-sm-12">
                    <div class="heading-title">
                        <h2>Latest Properties</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="similarProperties">

                            @foreach($propertieslist as $i => $property)


                                <div class="col-md-4 col-sm-6 col-xs-12">

                                    <div class="property-container" style="margin-bottom: 0">
                                        <div class="property-image">

                                            <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt="{{ $property->property_name }}">
                                            <div class="property-price">
                                                <h4>{{ getPropertyTypeName($property->property_type)->types }}</h4>
                                                <span>{{getcong('currency_sign')}}@if($property->sale_price) {{$property->sale_price}} @else {{$property->rent_price}} @endif</span>
                                            </div>
                                            <div class="property-status">
                                                <span>For {{$property->property_purpose}}</span>
                                            </div>
                                        </div>
                                        <div class="property-features">
                                            <span><i class="fa fa-home"></i> {{$property->area}}</span>
                                            <span><i class="fa fa-hdd-o"></i> {{$property->bedrooms}}</span>
                                            <span><i class="fa fa-male"></i> {{$property->bathrooms}}</span>
                                        </div>
                                        <div class="property-content">
                                            <h3><a  style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;" href="{{URL::to('properties/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a> <small style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">{{ Str::limit($property->address,40) }}</small></h3>
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

                <div class="flex-box">

                @foreach($top_properties as $temp)

                        <div class="col-md-3 col-sm-12 col-xs-12 flex-box-div" style="box-shadow: 0 0rem 1.2rem -3px #c2c2c2;margin-bottom: 30px;padding: 0;margin: 0px 15px 0px 0px;display: inline-block;margin: auto;">
                        <div class="property-container" style="margin-bottom: 0;">
                            <div class="property-image">

                                <img src="{{ URL::asset('upload/properties/'.$temp->featured_image.'-s.jpg') }}" alt="{{ $property->property_name }}" style="width: 100%;height: 200px;">
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
                                <h3><a href="{{URL::to('properties/'.$temp->property_slug)}}">{{ Str::limit($temp->property_name,35) }}</a> <small>{{ Str::limit($temp->address,40) }}</small></h3>
                            </div>
                        </div>
                    </div>

                @endforeach

                </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block;margin-top: 50px;">

                <div class="col-md-12 col-sm-12">
                    <div class="heading-title">
                        <h2>Top Members</h2>
                    </div>
                </div>

                <div class="flex-box">

                    @foreach($top_members as $temp)

                        <div class="col-md-3 col-sm-12 col-xs-12 flex-box-div" style="box-shadow: 0 0rem 1.2rem -3px #c2c2c2;margin-bottom: 30px;padding: 0;margin: 0px 15px 0px 0px;display: inline-block;margin: auto;">
                            <div class="property-container" style="margin-bottom: 0;">
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
                                    <h3><a href="{{URL::to('agents')}}">{{$temp->name}}</a> <small>{{$temp->email}}</small></h3>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>


        </div>
        <!-- end:latest -->


      </div>
    </div>
    <!-- end:content -->

<style>

    .flex-box
    {
        display: inline-block;
        width: 100%;
    }

    @media (min-width: 992px)
    {
        .flex-box
        {
            display: flex;
            width: 100%;
        }
    }


    .flex-box-div
    {
        margin-bottom: 20px !important;
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

    $(document).ready(function() {

    $('.similarProperties').slick({
        dots: false,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
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
