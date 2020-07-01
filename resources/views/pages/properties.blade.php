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

              <div class="properties-ordering-wrapper">
                  <div class="results-count">
                      Showing <span class="first">@if($properties->firstItem() != $properties->lastItem()) {{$properties->firstItem()}}</span> – <span class="last">{{$properties->lastItem()}}</span> of {{$properties->total()}} results @else {{$properties->firstItem()}}</span> of {{$properties->total()}} results @endif</div>

                  <div class="properties-ordering">
                      <form class="properties-ordering" method="get" action="{{URL::to('properties/')}}">
                          <div class="label">Sort by:</div>

                          <select onchange="this.form.submit()" name="filter_orderby" class="orderby" data-placeholder="Sort by" tabindex="-1" aria-hidden="true">
                              <option value="newest" @if(isset($filter) && $filter == 'newest' || $filter == '') selected @endif>Newest</option>
                              <option value="oldest" @if(isset($filter) && $filter == 'oldest') selected @endif>Oldest</option>
                              <option value="bedrooms" @if(isset($filter) && $filter == 'bedrooms') selected @endif>Bedrooms</option>
                              <option value="bathrooms" @if(isset($filter) && $filter == 'bathrooms') selected @endif>Bathrooms</option>
                              <option value="popularity" @if(isset($filter) && $filter == 'popularity') selected @endif>Popularity</option>
                              <option value="lowest_sale_price" @if(isset($filter) && $filter == 'lowest_sale_price') selected @endif>Lowest Sale Price</option>
                              <option value="highest_sale_price" @if(isset($filter) && $filter == 'highest_sale_price') selected @endif>Highest Sale Price</option>
                              <option value="lowest_rent_price" @if(isset($filter) && $filter == 'lowest_rent_price') selected @endif>Lowest Rent Price</option>
                              <option value="highest_rent_price" @if(isset($filter) && $filter == 'highest_rent_price') selected @endif>Highest Rent Price</option>
                              <option value="lowest_area" @if(isset($filter) && $filter == 'lowest_area') selected @endif>Lowest Area</option>
                              <option value="highest_area" @if(isset($filter) && $filter == 'highest_area') selected @endif>Highest Area</option>
                          </select>

                      </form>
                  </div></div>

              @if(count($properties))

            <!-- begin:product -->
            <div class="row {{--container-realestate--}}">

                <?php $i = 0; ?>

           	  @foreach($properties as $i => $property)

             	 <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 40px;min-height: 607px;">

                     <div class="property-price" style="position:relative;max-width: 100%;font-size: 15px;padding: 3px 0px;margin-bottom: 6px;border-radius: 5px;">Open House <span>@if($property->open_date) {{$property->open_date}} @endif @if($property->open_timeFrom) {{$property->open_timeFrom}} @else Anytime @endif @if($property->open_timeTo) to {{$property->open_timeTo}} @else to Anytime @endif</span></div>

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

                     @if($property->listed)

        <div class="property-price" style="background: #d6d63e;position:relative;max-width: 50%;margin-bottom: 12px;font-size: 15px;padding: 2px 0px;border-radius: 5px;">Listed {{$property->listed}}</div>

                         @endif

          </div>
              <!-- break -->
           	  @endforeach


            </div>
            <!-- end:product -->

            @else
                  <h2 style="text-align: center;margin-top: 30px;margin-bottom: 30px;">No Properties found...</h2>

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
         top: 1px;
     }

     .select2-container--open .select2-dropdown--below
     {
         width: 200px !important;
         text-align: left;
     }

     .select2-container--default .select2-results>.select2-results__options
     {
         min-height: 240px;
         max-height: fit-content;
     }

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
