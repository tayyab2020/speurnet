@extends("app")

@section('head_title', 'Agents | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <h2>Members</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">Members</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end:header -->
<!-- begin:content -->
    <div id="content">
      <div class="container">
        <div class="row" style="margin: 0;">
          <div class="col-md-12">
            <div class="blog-container">
              <div class="blog-content" style="padding-top: 0;">
                <!--<div class="the-team">-->

                  <form id="search_form" method="GET" action="{{ URL::to('/agents') }}">

                      @csrf

                  <div class="row" style="margin: 0;margin-bottom: 40px;">

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 20px;border: 1px solid #e3e3e3;background: white;">

                      <h4 style="line-height: 1.5;margin-bottom: 20px;border-bottom: 1px solid #ededed;padding-bottom: 10px;">{{__('text.Find real estate members')}}</h4>

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12" style="padding: 0;">

                              <div style="width: 100%;position: relative;">

                                  <i class="fas fa-search" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                  <input @if(isset($agent_name)) value="{{$agent_name}}" @endif style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type="text" placeholder="{{__('text.Agent Name')}}" name="agent_name" class="form-control search-fields" id="agent_name">

                              </div>

                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12 address-box">

                              <div style="width: 100%;position: relative;">

                                  <i class="fas fa-map-marker-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                  <input @if(isset($address)) value="{{$address}}" @endif autocomplete="off" style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type="text" placeholder="{{__('text.Search Address, City etc')}}" name="address" class="form-control search-fields" id="address">
                                  <input @if(isset($address_latitude)) value="{{$address_latitude}}" @endif type="hidden" name="city_latitude" id="city-latitude">
                                  <input @if(isset($address_longitude)) value="{{$address_longitude}}" @endif type="hidden" name="city_longitude" id="city-longitude">
                              </div>

                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12 address-box" style="padding: 0;padding-right: 10px;">

                              <div style="width: 100%;position: relative;">

                                  <i class="fas fa-arrows-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;" aria-hidden="true"></i>

                                  <select class="form-control" style="text-indent: 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" name="radius">
                                      <option @if(isset($radius)) @if($radius == 0) selected @endif @endif value="0">0 KM</option>
                                      <option @if(isset($radius)) @if($radius == 1) selected @endif @endif value="1">1 KM</option>
                                      <option @if(isset($radius)) @if($radius == 2) selected @endif @endif value="2">2 KM</option>
                                      <option @if(isset($radius)) @if($radius == 5) selected @endif @endif value="5">5 KM</option>
                                      <option @if(isset($radius)) @if($radius == 10) selected @endif @endif value="10">10 KM</option>
                                      <option @if(isset($radius)) @if($radius == 15) selected @endif @endif value="15">15 KM</option>
                                      <option @if(isset($radius)) @if($radius == 30) selected @endif @endif value="30">30 KM</option>
                                      <option @if(isset($radius)) @if($radius == 50) selected @endif @endif value="50">50 KM</option>
                                      <option @if(isset($radius)) @if($radius == 100) selected @endif @endif value="100">100 KM</option>
                                  </select>

                              </div>

                          </div>

                          <button style="border:0;font-size: 14px;padding: 7px 0px;margin-top: 3px;" type="submit" class="btn btn-success col-lg-2 col-md-2 col-sm-2 col-xs-4 search-btn">{{__('text.Search')}}</button>

                      </div>
                      </div>
                  </div>


                  <div class="row" style="margin: 0;margin-bottom: 20px;">

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                          <ul class="property-radios" style="padding: 0;margin-top: 30px;display: flex;flex-direction: row;flex-flow: wrap">

                              <li class="pt @if(isset($service)) @if($service == 1) active1 @endif @endif">

                                  <div class="type-holder-main">

                                      <label style="padding: 13px;">

                                          <input class="services" @if(isset($service)) @if($service == 1) checked @endif @endif  type="radio" name="services" value="1">

                                          <span style="padding-top: 0;"><img src="{{ URL::asset('assets/img/broker.png') }}" style="display: block;width: 50px;margin: auto;margin-bottom: 10px;">{{__('text.I am looking for a sales broker')}}</span>

                                      </label>

                                  </div>
                              </li>

                              <li class="pt @if(isset($service)) @if($service == 2) active1 @endif @endif">

                                  <div class="type-holder-main">

                                      <label style="padding: 13px;">

                                          <input class="services"  @if(isset($service)) @if($service == 2) checked @endif @endif type="radio" name="services" value="2">

                                          <span style="padding-top: 0;"><img src="{{ URL::asset('assets/img/agent.png') }}" style="display: block;width: 50px;margin: auto;margin-bottom: 10px;">{{__('text.I am looking for a rental agent')}}</span>

                                      </label>

                                  </div>
                              </li>

                              <li class="pt @if(isset($service)) @if($service == 3) active1 @endif @endif">

                                  <div class="type-holder-main">

                                      <label style="padding: 13px;">

                                          <input class="services" @if(isset($service)) @if($service == 3) checked @endif @endif type="radio" name="services" value="3">

                                          <span style="padding-top: 0;"><img src="{{ URL::asset('assets/img/hire_broker.png') }}" style="display: block;width: 50px;margin: auto;margin-bottom: 10px;">{{__('text.I am looking for a hiring broker')}}</span>

                                      </label>

                                  </div>
                              </li>

                              <li class="pt @if(isset($service)) @if($service == 4) active1 @endif @endif">

                                  <div class="type-holder-main">

                                      <label style="padding: 13px;">

                                          <input class="services" @if(isset($service)) @if($service == 4) checked @endif @endif type="radio" name="services" value="4">

                                          <span style="padding-top: 0;"><img src="{{ URL::asset('assets/img/purchase_broker.png') }}" style="display: block;width: 50px;margin: auto;margin-bottom: 10px;">{{__('text.I am looking for a purchase broker')}}</span>

                                      </label>

                                  </div>
                              </li>

                              <li class="pt @if(isset($service)) @if($service == 5) active1 @endif @endif">

                                  <div class="type-holder-main">

                                      <label style="padding: 13px;">

                                          <input class="services" @if(isset($service)) @if($service == 5) checked @endif @endif type="radio" name="services" value="5">

                                          <span style="padding-top: 0;"><img src="{{ URL::asset('assets/img/calculator1.png') }}" style="display: block;width: 50px;margin: auto;margin-bottom: 10px;">{{__('text.Appraise House')}}</span>

                                      </label>

                                  </div>
                              </li>

                          </ul>
                      </div>

                  </div>

                  </form>

                  <style>

                      .team-image img
                      {
                          height: 200px;
                      }

                      @import url('https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic');

                      ul.property-radios li{
                          display: inline-block; margin: auto; padding: 0; vertical-align: top;width: 160px;
                      }

                      li{ list-style: none; }

                      .type-holder-main{ position: relative; }

                      ul.property-radios li input{ display: none; }

                      ul.property-radios li label {  width: 100%;min-height: 125px;-webkit-transition: all .5s ease-in-out; transition: all .5s ease-in-out ;overflow: hidden; padding: 20px; cursor: pointer; border: solid 1px #dddddd; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; background-color: #fff;text-align: center; }

                      .user-holder.create-property-holder ul.property-radios li label { display: block; min-height: 55px; }


                      ul.property-radios li label span { font-family: 'Lato', sans-serif;padding-top: 15px;font-size: 13px; font-weight: 700; line-height: 19px; display: block; width: 100%; text-align: center; color: #5a2e8a !important; }


                      li.active1 > div > label, label:hover{

                          border-color: #5a2e8a !important;

                      }

                      .red-border
                      {
                          border: 2px solid red !important;
                      }

                      @media (max-width: 768px){

                          .address-box{ padding: 0 !important; }

                      }

                      @media (min-width: 768px){

                          .team-description{ padding-top: 0px; }

                      }

                  </style>

                  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

                  <script>

                      $( document ).ready(function() {

                          $('.services').click(function(e) {

                              var empty = true;

                              $('.search-fields').each(function(){
                                  if($(this).val()!=""){
                                      empty = false;
                                  }
                              });

                              if(empty)
                              {
                                  $('.search-btn').removeClass('red-border');
                                  $('#search_form').submit();

                              }
                              else
                              {
                                  $('.search-btn').addClass('red-border');
                              }


                          });

                          $('#address').on('keyup keypress', function(e) {

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


                                                  $(input).parent().children('#city-latitude').val(lat);
                                                  $(input).parent().children('#city-longitude').val(lng);

                                                  var value = $(input).val();

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

                          $('input[class=services]').change(function(){

                              $('input[class=services]').parent().closest('li').removeClass('active1');

                              $(this).parent().closest('li').addClass('active1');

                          });

                      });



                  </script>

                          @if($agents->total() > 0)
                              <div class="row" style="margin: 0;">
                                  <p style="font-weight: 600;color: black;">@php echo $agents->total(); @endphp {{__('text.Member(s) Found')}}</p>
                              </div>
                              @else
                      <div class="row" style="margin: 0;">
                          <h2 style="font-weight: 600;text-align: center">{{__('text.No Results Found')}}</h2>
                      </div>

                          @endif
{{--                          <form>--}}
{{--                              <div class="row" style="border-bottom: 1px grey;">--}}
{{--                                  <div class="col-sm-4">--}}
{{--                                      <input name="member_name" type="text">--}}
{{--                                  </div>--}}
{{--                                  <div class="col-sm-4">--}}
{{--                                      <input name="location" type="text">--}}
{{--                                  </div>--}}
{{--                                  <div class="col-sm-4">--}}
{{--                                      <input value="Search" style="background-color: red; color: white" type="button">--}}
{{--                                  </div>--}}
{{--                              </div>--}}
{{--                          </form>--}}

                   @foreach($agents as $i => $agent)
                      <div class="row" style="margin: 20px 0px;">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row" style="background-color: white;padding: 20px;">
                            <div class="col-sm-3">
                                <div class="team-image">
                                    <a style="outline: none;" href="{{ URL::to('/agents/details/'.$agent->id) }}">
                                    @if($agent->image_icon)
                                        <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" style="padding-top: 5px" alt="{{ $agent->name }}">
                                    @else
                                        <img src="{{ URL::asset('upload/members/user-icon.jpg') }}"  style="padding-top: 5px" alt="{{ $agent->name }}">
                                    @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="team-description">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="{{ URL::to('/agents/details/'.$agent->id) }}">
                                            <h3>{{$agent->name}}</h3>
                                            </a>
                                        </div>

                                        @if($agent->properties_count >= 1)

                                            <div class="col-sm-3" style="float: right;">
                                                <p style="color: red"><a style="text-decoration: none;color: red;" href="{{ URL::to('/agent-properties/user/'.$agent->id.'/0') }}" target="_blank">{{$agent->properties_count}} @if($agent->properties_count <= 1) {{__('text.Property')}} @else {{__('text.Properties')}} @endif</a></p>
                                            </div>

                                        @endif

                                    </div>
                                    @if($agent->address)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp&nbsp {{$agent->address}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p> {{$agent->about}}</p>
                                        </div>
                                    </div>

                                    @if($agent->phone)

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp&nbsp {{$agent->phone}}</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <p><i class="fa fa-id-card" aria-hidden="true"></i>&nbsp&nbsp Contact</p>
                                        </div>
                                    </div>

                                    @endif
{{--                                    <div class="team-social">--}}
{{--                                        <span><a href="{{$agent->twitter}}" title="Twitter" rel="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a></span>--}}
{{--                                        <span><a href="{{$agent->facebook}}" title="Facebook" rel="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a></span>--}}
{{--                                        <span><a href="{{$agent->gplus}}" title="Google Plus" rel="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a></span>--}}
{{--                                        <span><a href="{{$agent->linkedin}}" title="LinkedIn" rel="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a></span>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                          </div>
                          <hr>
                      </div>
                      <!-- break -->
                   @endforeach
                  {{$agents->appends(request()->input())->links()}}
                <!--</div>-->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:content -->
@endsection
