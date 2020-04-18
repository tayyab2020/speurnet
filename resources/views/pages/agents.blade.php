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
              <p>Members</p>
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
        <div class="row">
          <div class="col-md-12">
            <div class="blog-container">
              <div class="blog-content">
                <!--<div class="the-team">-->
                  <div class="row">
                      <div class="col-sm-9" style="background-color: whitesmoke;">
                          @if(count($agents)>0)
                              <div class="row" style="border-bottom: 1px grey;">
                                  <p>(@php echo count($agents); @endphp)Members Found</p>
                              </div>
                          @endif
                          <div class="row" style="border-bottom: 1px grey;">
                              <p>FIND REAL ESTATE MEMBERS</p>
                          </div>
                          <hr>
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
                      </div>
                  </div>
                   @foreach($agents as $i => $agent)
                      <div class="row">
                          <div class="col-md-9">
                            <div class="row" style="background-color: white; border-bottom: 1px grey;">
                            <div class="col-sm-3">
                                <div class="team-image">
                                    @if($agent->image_icon)
                                        <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" style="padding-top: 5px" alt="{{ $agent->name }}">
                                    @else
                                        <img src="{{ URL::asset('assets/img/team03.jpg') }}"  style="padding-top: 5px" alt="{{ $agent->name }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="team-description">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h3>{{$agent->name}}</h3>
                                        </div>
                                        <div class="col-sm-2">
                                            <p>TRUSTED</p>
                                        </div>
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-3">
                                            <p style="color: red">1 Property(s)</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Address will be listed Here</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>User/Company Description Line 1</p>
                                            <p>User/Company Description Line 2</p>
                                            <p>User/Company Description Line 3</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp&nbsp 020 1234 5678</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <p><i class="fa fa-id-card" aria-hidden="true"></i>Contact</p>
                                        </div>
                                    </div>
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
                  @include('_particles.pagination', ['paginator' => $agents])
                <!--</div>-->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:content -->
@endsection
