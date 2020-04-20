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
              <h2>All Properties</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">All Properties</li>
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
           	  @foreach($properties as $i => $property)
             	 <div class="col-md-6 col-sm-6 col-xs-12">

                     <div class="property-price" style="position:relative;max-width: 100%;font-size: 15px;padding: 10px 0px;margin-bottom: 12px;border-radius: 5px;">Open House <span>{{$property->open_date}} {{$property->open_timeFrom}} to {{$property->open_timeTo}}</span></div>

            <div class="property-container" style="border: 1px solid #48cfad;">
              <div class="property-image">

                <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt="{{ $property->property_name }}">


                  <div class="property-price" style="top: 12px;left: 12px;border-radius: 5px;">
                      <span>For {{$property->property_purpose}}</span>
                  {{--<h4>{{ getPropertyTypeName($property->property_type)->types }}</h4>
                  <span>{{getcong('currency_sign')}}@if($property->sale_price) {{$property->sale_price}} @else {{$property->rent_price}} @endif</span>--}}
                </div>


                  <?php $x = 0; if($property->featured_image){ $x = $x + 1;} if($property->property_imags1){ $x = $x + 1;} if($property->property_imags2){ $x = $x + 1;} if($property->property_imags3){ $x = $x + 1;} if($property->property_imags4){ $x = $x + 1;} if($property->property_imags5){ $x = $x + 1;} ?>

                <div class="property-status" style="background:#48cfad;width:40%;bottom: 12px;left: 12px;border-radius: 5px;padding: 5px 6px 5px 10px;">
                 <span>Available Immediately</span>
                </div>

                  <div class="property-status" style="bottom: 12px;right: 12px;background: rgba(0,0,0,.5);border-radius: 7%;padding: 5px 6px 5px 10px;">
                      <a style="color: white;"> <i class="fas fa-film" style="font-size: 18px;margin-right: 12px;"></i> </a>
                      <a href="{{URL::to('properties/'.$property->property_slug)}}" style="color: white;"> <i class="fas fa-camera" style="font-size: 18px;"></i><span style="padding: 0px 6px;font-weight: 700;font-size: 18px;position: relative;bottom: 1px;margin-left: 5px;">{{$x}}</span></a>
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

@endsection
