<!-- begin:footer -->
    <div id="footer">
      <div class="container">
       <div class="row">

           <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
                <h3>Company</h3>
                <ul class="list-unstyled">
                    <li><a href="{{ URL::to('about-us') }}">About Us</a></li>
                    <li><a href="{{ URL::to('contact-us') }}">Contact Us</a></li>
                    <li><a href="{{ URL::to('careers-with-us')}}">Careers with Us</a></li>
                    <li><a href="{{ URL::to('terms-conditions')}}">Terms & Conditions</a></li>
                    <li><a href="{{ URL::to('privacy-policy')}}">Privacy Policy</a></li>
                    @foreach($footer_content as $i => $key)

                        @if($key->heading_id == 0)

                            <li><a href="{{ url('footer-pages/'.$key->id) }}">{{$key->title}}</a></li>

                        @endif

                    @endforeach
                </ul>
            </div>
          </div>
          <!-- break -->

           @foreach($footer_headings as $x => $temp)

               @if($footer_content->contains('heading_id', $temp->id))

                   <div class="col-md-3 col-sm-6 col-xs-12">
                       <div class="widget">
                           <h3>{{$temp->heading}}</h3>

                           <ul class="list-unstyled">

                               @foreach($footer_content as $i => $key)

                                   @if($temp->id == $key->heading_id)

                                       <li><a href="{{ url('footer-pages/'.$key->id) }}">{{$key->title}}</a></li>

                                   @endif

                               @endforeach

                           </ul>
                       </div>
                   </div>

           @endif

       @endforeach

          <!-- break -->

          {{--<div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              {!!getcong('footer_widget2')!!}
            </div>
          </div>--}}
          <!-- break -->

          {{--<div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
              {!!getcong('footer_widget3')!!}

            </div>
          </div>--}}
          <!-- break -->

        </div>
        <!-- break -->


          <!-- begin:copyright -->
          <div class="row">

            <div class="col-md-12 copyright">
              <ul class="list-inline social-links">

                  <a href="#top" class="btn btn-primary scroltop"><i class="fa fa-angle-up"></i></a>

                  @if(getcong('social_facebook'))
                      <li><a href="{{getcong('social_facebook')}}" class="icon-facebook" rel="tooltip" title="" data-placement="bottom" data-original-title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  @endif


                  @if(getcong('social_twitter'))
                      <li><a href="{{getcong('social_twitter')}}" class="icon-twitter" rel="tooltip" title="" data-placement="bottom" data-original-title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  @endif

                    @if(getcong('social_linkedin'))
                        <li><a href="{{getcong('social_linkedin')}}" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    @endif

                    @if(getcong('social_gplus'))
                        <li><a href="{{getcong('social_gplus')}}" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Gplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    @endif

              </ul>

            <p>{{getcong('site_copyright')}}</p>


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
