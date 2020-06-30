<!-- begin:footer -->
    <div id="footer">
      <div class="container">
       <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              {!!getcong('footer_widget1')!!}
            </div>
          </div>
          <!-- break -->

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              <h3>Company</h3>
              <ul class="list-unstyled">
                <li><a href="{{ URL::to('about-us') }}">About Us</a></li>
                <li><a href="{{ URL::to('contact-us') }}">Contact Us</a></li>

                <li><a href="{{ URL::to('careers-with-us')}}">Careers with Us</a></li>
                <li><a href="{{ URL::to('terms-conditions')}}">Terms & Conditions</a></li>
                <li><a href="{{ URL::to('privacy-policy')}}">Privacy Policy</a></li>
              </ul>
            </div>
          </div>
          <!-- break -->

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              {!!getcong('footer_widget2')!!}
            </div>
          </div>
          <!-- break -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              {!!getcong('footer_widget3')!!}

            </div>
          </div>
          <!-- break -->
        </div>
        <!-- break -->


        <!-- begin:copyright -->
        <div class="row">

          <div class="col-md-12 copyright">
          	<ul class="list-inline social-links">
              <li><a href="{{getcong('social_facebook')}}" class="icon-facebook" rel="tooltip" title="" data-placement="bottom" data-original-title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>

              <li><a href="{{getcong('social_twitter')}}" class="icon-twitter" rel="tooltip" title="" data-placement="bottom" data-original-title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>

              <li><a href="{{getcong('social_linkedin')}}" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>

              <li><a href="{{getcong('social_gplus')}}" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Gplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            </ul>

            <p>{{getcong('site_copyright')}}</p>

              @if(isset($footer))

                  @if($previous)

                  <div class="unitPopupContainer prv" style="position: absolute;left: 0;top: -18px;">
                      <div class="unitPopup triLeft">
                          <!-- First unit Next -->
                          <div class="nextUnitpopup" style="display: block;">
                              <div class="row1">
                                  <div class="large-4 columns popupImage">

                                      <img src="{{ URL::asset('upload/properties/'.$previous->featured_image.'-b.jpg') }}" alt="{{$previous->property_name}}">

                                      <div class="large-10 columns nopad ftTop">
                                          <h6 class="unitPrice" style="text-align: left;margin-top: 0;">€ @if($previous->sale_price){{$previous->sale_price}} @else{{$previous->rent_price}} @endif</h6>
                                          <!--<p class="unitRooms">2 kamers</p>-->
                                      </div>

                                  </div>
                                  <div class="large-8 columns" style="font-family: monospace;">
                                      <h6 class="unitStreet" style="margin-top: 0px;text-align: left;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;">{{$previous->property_name}}</h6>
                                      <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>Address:</b> {{$previous->address}}</p>
                                      <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>City:</b> {{$previous->city_name}}</p>
                                      <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>Bedrooms:</b>{{$previous->bedrooms}}</p>
                                  </div>


                              </div>
                          </div>
                      </div>
                  </div>

              <a href="{{URL::to('properties/'.$previous->property_slug)}}" class="btn btn-primary footer-button prev-property" style="left: 0px;margin-left: 0px;">
                  <i class="fa fa-angle-left" aria-hidden="true" style="margin-right: 10px;"></i>
                  <span>Previous House</span>
              </a>

                  @endif

                  <a href="{{ url()->previous() }}" class="btn btn-primary footer-button" style="left: 20%;margin-left: 0px;">
                      <i class="fas fa-backward" aria-hidden="true" style="margin-right: 10px;"></i>
                      <span>Back to overview</span>
                  </a>

            <a href="#top" class="btn btn-primary scroltop"><i class="fa fa-angle-up"></i></a>

              @if($next)

                  <div class="unitPopupContainer nxt" style="position: absolute;right: 0;top: -18px;">
                      <div class="unitPopup triRight">
                          <!-- First unit Next -->
                          <div class="nextUnitpopup" style="display: block;">
                              <div class="row1">
                                  <div class="large-4 columns popupImage">

                                      <img src="{{ URL::asset('upload/properties/'.$next->featured_image.'-b.jpg') }}" alt="{{$next->property_name}}">

                                      <div class="large-10 columns nopad ftTop">
                                          <h6 class="unitPrice" style="text-align: left;margin-top: 0;">€ @if($next->sale_price){{$next->sale_price}} @else{{$next->rent_price}} @endif</h6>
                                          <!--<p class="unitRooms">2 kamers</p>-->
                                      </div>

                                  </div>
                                  <div class="large-8 columns" style="font-family: monospace;">
                                      <h6 class="unitStreet" style="margin-top: 0px;text-align: left;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;">{{$next->property_name}}</h6>
                                      <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>Address:</b> {{$next->address}}</p>
                                      <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>City:</b> {{$next->city_name}}</p>
                                      <p class="unitCity" style="color: #3c3b3b;text-align: left;"><b>Bedrooms:</b>{{$next->bedrooms}}</p>
                                  </div>


                              </div>
                          </div>
                      </div>
                  </div>


              <a href="{{URL::to('properties/'.$next->property_slug)}}" class="btn btn-primary footer-button next-property" style="left: auto;right: 0px;margin-left: 0px;">
                  <i class="fa fa-angle-right" aria-hidden="true" style="margin-right: 10px;"></i>
                  <span>Next House</span>

              </a>

                  @endif

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

              @else

                  <a href="#top" class="btn btn-primary scroltop"><i class="fa fa-angle-up"></i></a>

                  @endif

            <!--<ul class="list-inline social-links">
              <li><a href="#" class="icon-twitter" rel="tooltip" title="" data-placement="bottom" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#" class="icon-facebook" rel="tooltip" title="" data-placement="bottom" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Gplus"><i class="fa fa-google-plus"></i></a></li>
            </ul>-->
          </div>
        </div>
        <!-- end:copyright -->

      </div>
    </div>
    <!-- end:footer -->
