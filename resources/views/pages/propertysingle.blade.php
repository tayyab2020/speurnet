@extends("app")

@section('head_title', $property->property_name .' | '.getcong('site_name') )
@section('head_description', substr(strip_tags($property->description),0,200))
@section('head_image', asset('/upload/properties/'.$property->featured_image.'-b.jpg'))
@section('head_url', Request::url())

@section("content")


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">

<!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <h2>{{$property->property_name}}</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li><a href="{{ URL::to('properties/') }}">Properties</a></li>
              <li class="active">{{$property->property_name}}</li>
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
            <div class="row">
              <div class="col-md-12 single-post">
                <ul id="myTab" class="nav nav-tabs nav-justified">
                  <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-university"></i> Property Detail</a></li>
                  <li><a href="#location" data-toggle="tab"><i class="fa fa-paper-plane-o"></i> Contact</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade in active" id="detail">
                    <div class="row">
                      <div class="col-md-12">
                        <h2>{{$property->property_name}}</h2>
                        <div id="slider-property" class="carousel slide" data-ride="carousel">

                          <div class="carousel-inner">
                            @if($property->featured_image)
                            <div class="item active">
                              <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-b.jpg') }}" alt="">
                            </div>
                            @endif

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
                          <a class="left carousel-control" href="#slider-property" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                          </a>
                          <a class="right carousel-control" href="#slider-property" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                          </a>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 10px 0px;padding-bottom: 0px;">

                                <h4 style="margin: 0;float: left;font-weight: 600;">{{$property->views}}</h4>

                                <span style="margin-left: 5px;margin-right: 10px;"><i class="fa fa-eye" aria-hidden="true" style="font-size: 16px;padding-left: 3px;"></i></span>

                                <?php $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>

                                <span style="margin-left: 10px;"><a target="_blank" title="Share by Whatsapp" href="https://api.whatsapp.com/send?text={{$url}}"><i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 16px;"></i></a></span>

                                <span style="margin-left: 10px;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url}}"><i class="fa fa-facebook" aria-hidden="true" style="font-size: 16px;color: #7191d3;"></i></a></span>

                                <span style="margin-left: 10px;"><a target="_blank" title="Share by Email" href="mailto:?subject=I wanted you to see this Property AD I just Found on zoekjehuisje.nl&amp;body=Check out this link {{$url}}"><i class="far fa-envelope" aria-hidden="true" style="font-size: 16px;color:goldenrod;"></i></a></span>

                                <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="far fa-calendar-check" style="margin-right: 7px;"></i> Request Viewing
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <form role="form" action="{{route('request-viewing')}}" method="POST">

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="modal-content">

                                            <div class="modal-header" style="border-bottom: 0;display: inline-block;width: 100%;padding: 15px 25px;">

                                                <button style="opacity: 0.5;font-size: 30px;font-weight: 600;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                <h4 style="margin-top: 5px;" class="modal-title" id="exampleModalLabel">REQUEST VIEWING</h4>
                                                <p style="margin-top: 15px;width: 90%;">Physical Arrange viewings is always been attractive to property clients. Just fill out the form to arrange visualizations around our properties.</p>

                                            </div>


                                            <div class="modal-body" style="padding: 10px 25px;">

                                                    <input type="hidden" name="id" value="{{$property->id}}">

                                                    <div class="form-group">

                                                        <div style="width: 100%;position: relative;">

                                                            <i class="fas fa-calendar-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;"></i>
                                                            <i class="fas fa-chevron-down" style="position: absolute;font-size: 14px;top: 55%;right:10px;left: auto;margin: -7px 0 0;pointer-events: none;color: #767676;"></i>

                                                            <input style="padding: 0 0 0 40px;cursor: pointer;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type='text' placeholder="Select Schedule *" name="date" required  class="form-control" id='datetimepicker4' />

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <div style="width: 100%;position: relative;">

                                                            <i class="far fa-clock" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;"></i>
                                                            <i class="fas fa-chevron-down" style="position: absolute;font-size: 14px;top: 55%;right:10px;left: auto;margin: -7px 0 0;pointer-events: none;color: #767676;"></i>

                                                            <input style="padding: 0 0 0 40px;cursor: pointer;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type='text' placeholder="Select Time *" name="time" required  class="form-control" id='datetimepicker3' />

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <div style="width: 100%;position: relative;">

                                                            <i class="fas fa-user" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;top: 55%;margin:-9px 0 0;pointer-events:none;"></i>

                                                            <input style="padding: 0 0 0 40px;height: 42px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" type='text' placeholder="Your Name *" name="username" required  class="form-control" id='username' />

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <div style="width: 100%;position: relative;">

                                                            <i class="far fa-comment-alt" style="position: absolute;left: 15px;right: auto;color: #d5d5d5;font-size: 14px;margin:10px 0 0;pointer-events:none;"></i>

                                                            <textarea style="height:100px;padding-left:40px;color:#bcbcbc;border-color:#e6e6e6;border-radius: 3px;box-shadow: none;" class="form-control" id="message-text" placeholder="Message" name="message"></textarea>


                                                        </div>

                                                    </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Send message</button>
                                            </div>
                                        </div>

                                    </form>


                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 40px 0px;padding-top: 0;">

                                <?php $date = date_format($property->created_at,"F d, Y");?>

                             <span style="font-size: 12px;">Posted On {{$date}}</span>

                            </div>

                            </div>
                        <h3>Property Overview</h3>
                        <table class="table table-bordered">
                          <tr>
                            <td width="20%"><strong>ID</strong></td>
                            <td>#{{$property->id}}</td>
                          </tr>
                          <tr>
                            <td><strong>Price</strong></td>
                            <td>{{getcong('currency_sign')}}@if($property->sale_price) {{$property->sale_price}} @else {{$property->rent_price}} @endif</td>
                          </tr>
                          <tr>
                            <td><strong>Type</strong></td>
                            <td>{{ getPropertyTypeName($property->property_type)->types }}</td>
                          </tr>
                          <tr>
                            <td><strong>Contract</strong></td>
                            <td>{{$property->property_purpose}}</td>
                          </tr>
                          <tr>
                            <td><strong>Location</strong></td>
                            <td>{{$property->address}}</td>
                          </tr>
                          <tr>
                            <td><strong>Bathrooms</strong></td>
                            <td>{{$property->bathrooms}}</td>
                          </tr>
                          <tr>
                            <td><strong>Bedrooms</strong></td>
                            <td>{{$property->bedrooms}}</td>
                          </tr>
                          <tr>
                            <td><strong>Area</strong></td>
                            <td>{{$property->area}}</sup> </td>
                          </tr>
                        </table>

                          @if($property->property_features)

                        <h3>Property Features</h3>
                        <div class="row">


							<ul style="list-style: none;">
                              @foreach(explode(',',$property->property_features) as $features)
                              <li class="col-md-3 col-sm-3"><i class="fa fa-check"></i> {{$features}}</li>
                              @endforeach

                            </ul>

						</div>

                          @endif

                        <h3>Property Description</h3>
                        {!!$property->description!!}

                          <input type="hidden" name="map_latitude" id="map_latitude" value="{{$property->map_latitude}}">
                          <input type="hidden" name="map_longitude" id="map_longitude" value="{{$property->map_longitude}}">
                          <input type="hidden" name="city" id="city" value="{{$property->address}}">
                          <input type="hidden" name="type" id="type" value="shopping_mall">


                          <div class="row" style="border-top:1px solid rgba(190, 190, 190, 0.6); margin-top: 40px;">

                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                  <div style="padding: 20px;">


                                          <div class="row">
                                              <div class="col-sm-12">
                                                  <div class="carousel box-carousel d-none d-sm-block" style="display: flex;">
                                                      <div class="box background-active" data-type="shopping_mall">
                                                          <a><i class="fas fa-shopping-cart" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Malls</a>
                                                      </div>
                                                      <div class="box" data-type="school">
                                                          <a><i class="fas fa-graduation-cap" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Schools</a>
                                                      </div>
                                                      <div class="box" data-type="bank">
                                                          <a><i class="fas fa-university" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Banks</a>
                                                      </div>
                                                      <div class="box" data-type="hospital">
                                                          <a><i class="fas fa-hospital" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Hospitals</a>
                                                      </div>
                                                      <div class="box" data-type="bakery">
                                                          <a><i class="fas fa-birthday-cake" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Bakery</a>
                                                      </div>
                                                      <div class="box" data-type="pharmacy">
                                                          <a><i class="fas fa-birthday-cake" aria-hidden="true" style="font-size: 22px;margin-bottom: 10px;"></i><br>Pharmacy</a>
                                                      </div>


                                                  </div><!-- carousel-->
                                              </div><!--col-->
                                          </div><!--row-->




                                      <div style="height: 350px;">

                                          <div id="panel" style="width: 30%;height: 100%;float: left;border: 1px solid rgba(190, 190, 190, 0.6);overflow-y: scroll;">

                                              <div style="padding: 10px;border-bottom: 1px solid rgba(190, 190, 190, 0.6);">
                                                  <span style="display: block;">Malls</span>
                                                  <span style="display: block;"></span>
                                              </div>



                                          </div>


                                          <div style="width: 70%;height: 100%;float: left;">

                                              <div id="map"></div>

                                          </div>

                                      </div>


                                  </div>

                              </div>

                          </div>

                          @if($property->video)


                          <div class="row" style="margin-top: 40px;">

                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                  <h2>Property Video</h2>

                                  <?php $ext = pathinfo($property->video, PATHINFO_EXTENSION);

                                  $ext = strtolower($ext);


                                  ?>


                                  <video id="player" playsinline controls>
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

                                  <h2>Files Attachments</h2>

                                  @foreach($property_documents as $key)

                                      <?php $ext = pathinfo($key->document, PATHINFO_EXTENSION);

                                      $ext = strtolower($ext);

                                      ?>

                                  @if($ext == 'pdf')

                                      <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                              <div style="display:inline-block;margin: 10px;">
                                                  <img src="{{ URL::asset('assets/img/pdf.png') }}" style="width: 45px;">
                                                  <label style="cursor: pointer">Download</label>
                                              </div>

                                      </a>

                                      @elseif($ext == 'docx')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                              <div style="display:inline-block;margin: 10px;">
                                                  <img src="{{ URL::asset('assets/img/docx.png') }}" style="width: 45px;">
                                                  <label style="cursor:pointer;">Download</label>
                                              </div>

                                              </a>

                                          @elseif($ext == 'doc')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/doc.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">Download</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'txt')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/txt.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">Download</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'pptx')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/pptx.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">Download</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'ppt')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/ppt.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">Download</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'wpd')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/wpd.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">Download</label>
                                                  </div>

                                              </a>

                                          @elseif($ext == 'rtf')

                                              <a href="{{ URL::asset('upload/properties/documents/'.$key->document) }}" style="display: inline-block">

                                                  <div style="display:inline-block;margin: 10px;">
                                                      <img src="{{ URL::asset('assets/img/rtf.png') }}" style="width: 45px;">
                                                      <label style="cursor:pointer;">Download</label>
                                                  </div>

                                              </a>

                                      @endif

                                      @endforeach


                              </div></div>

                              @endif

                          @if($property->first_floor || $property->second_floor || $property->ground_floor || $property->basement)

                              <div class="row" style="margin-top: 40px;">

                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                      <h2>Floor Plans</h2>

                                      <ul style="list-style: none;display: inline-block;padding: 0;">

                                          @if($property->first_floor)
                                          <li style="float: left;margin: 10px;">
                                              <a style="text-decoration: underline;cursor: pointer;" data-id="first" class="floors_links">First Floor</a>
                                          </li>
                                           @endif

                                              @if($property->second_floor)
                                                  <li style="float: left;margin: 10px;">
                                                      <a style="text-decoration: underline;cursor: pointer;" data-id="second" class="floors_links">Second Floor</a>
                                                  </li>
                                              @endif

                                              @if($property->ground_floor)
                                                  <li style="float: left;margin: 10px;">
                                                      <a style="text-decoration: underline;cursor: pointer;" data-id="ground" class="floors_links">Ground Floor</a>
                                                  </li>
                                              @endif

                                              @if($property->basement)
                                                  <li style="float: left;margin: 10px;">
                                                      <a style="text-decoration: underline;cursor: pointer;" data-id="basement" class="floors_links">Basement</a>
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

                                          <h4 style="text-align: center;">First Floor</h4>

                                          @if($ext == 'pdf')

                                              <embed src="{{ URL::asset('upload/properties/'.$property->first_floor) }}" width="800px" height="2100px" />

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

                                              <h4 style="text-align: center;">Second Floor</h4>

                                              @if($ext == 'pdf')

                                                  <embed src="{{ URL::asset('upload/properties/'.$property->second_floor) }}" width="100%" height="800px" />

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

                                              <h4 style="text-align: center;">Ground Floor</h4>

                                              @if($ext == 'pdf')

                                                  <embed src="{{ URL::asset('upload/properties/'.$property->ground_floor) }}" width="100%" height="800px" />

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

                                              <h4 style="text-align: center;">Basement</h4>

                                              @if($ext == 'pdf')

                                                  <embed src="{{ URL::asset('upload/properties/'.$property->basement) }}" width="100%" height="800px" />

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
                    <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <div class="team-container team-dark">
                          <div class="team-image">
                            @if($agent->image_icon)
                            <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" alt="{{$agent->name}}">
                            @else
                            <img src="{{ URL::asset('upload/members/user-icon.jpg') }}" alt="{{$agent->name}}">
                            @endif
                          </div>
                          <div class="team-description">
                            <h3>{{$agent->name}}</h3>
                            <p><i class="fa fa-phone"></i> Office : {{$agent->phone}}<br>
                            <i class="fa fa-print"></i> Fax : {{$agent->fax}}</p>
                            <p>{{$agent->about}}</p>
                            <div class="team-social">
                              <span><a href="{{$agent->twitter}}" title="Twitter" rel="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a></span>
                              <span><a href="{{$agent->facebook}}" title="Facebook" rel="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a></span>
                              <span><a href="{{$agent->gplus}}" title="Google Plus" rel="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a></span>
                              <span><a href="{{$agent->linkedin}}" title="LinkedIn" rel="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">

                        {!! Form::open(array('url'=>'agentscontact','method'=>'POST', 'id'=>'agent_contact_form')) !!}
              			<meta name="_token" content="{!! csrf_token() !!}"/>

                         <input type="hidden" name="property_id" value="{{$property->id}}">

                         <input type="hidden" name="agent_id" value="{{$agent->id}}">

                          <div id="ajax" style="color: #db2424"></div>

                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control input-lg" placeholder="Enter name : ">
                          </div>
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control input-lg" placeholder="Enter email : ">
                          </div>
                          <div class="form-group">
                            <label for="telp">Telp.</label>
                            <input type="text" name="phone" class="form-control input-lg" placeholder="Enter phone number : ">
                          </div>
                          <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control input-lg" rows="7" placeholder="Type a message : "></textarea>
                          </div>
                          <div class="form-group">
                            <input type="submit" name="submit" value="Send Message" class="btn btn-primary btn-lg">
                          </div>
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end:article -->

          <!-- begin:sidebar -->
          @include('_particles.sidebar')
          <!-- end:sidebar -->

        </div>
      </div>
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

				        {{ Session::get('flash_message') }}
				    </div>
				@endif
          </div>

        </div>
      </div>
    </div>
    <!-- end:modal-message -->

    <style>

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
            text-align:left;list-style:none;background-color:#fff;-webkit-background-clip:padding-box;
            background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,.15);
            border-radius:4px;-webkit-box-shadow:0 6px 12px rgba(0,0,0,.175);
            box-shadow:0 6px 12px rgba(0,0,0,.175) }

        @media (min-width: 700px)
        {

            .carousel-inner
            {
                height: 500px;
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
            height: 90px;
            background-color: transparent;
        }
        .box a {
            color: #461e52;
            display: block;
            width: 100%;
            height: 100%;
            font-size: 16px;
            font-weight: 700;
            padding: 10% 30px 0 30px;
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
            right: -36px;
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
            left: -36px;
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



    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>


    <script>

        $( document ).ready(function() {

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

            initMap();

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

                    new_type = 'Shopping Malls';

                }

                $("#panel div:eq(0)").children().first().text(new_type);


                service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, nearbyCallback);
            }

            // Handle the results (up to 20) of the Nearby Search
            function nearbyCallback(results, status) {

                if (status == google.maps.places.PlacesServiceStatus.OK) {

                    $("#panel div:eq(0)").children().eq(1).text(results.length + ' results found');

                    /*createMarkers(results);*/

                    createMarkersDetails(results,pos);
                }
                else
                {

                    $("#panel div:eq(0)").children().eq(1).text('0 results found');

                    $("#panel div").not(':first').remove();

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


                $("#panel div").not(':first').remove();

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



                        $("#panel div:eq(0)").after('<a data-id="'+i+'" href="javascript:void(0);" class="trigger"><div style="padding: 10px 0px 0px 10px;border-bottom: 1px solid rgba(190, 190, 190, 0.6);">\n' +
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



            $('.box-carousel').slick({
                dots: false,
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                prevArrow: "<button type='button' class='mission-prev-arrow'></button>",
                nextArrow: "<button type='button' class='mission-next-arrow'></button>"
            });

        });

    </script>

@endsection
