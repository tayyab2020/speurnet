<!-- begin:footer -->
    <div id="footer">
      <div class="container">
       <div class="row">

           <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="widget">
                <h3>{{getcong('site_name')}}</h3>
                <ul class="list-unstyled">
                    <li><a href="{{ URL::to('over-ons') }}">{{__('text.About Us')}}</a></li>
                    <li><a href="{{ URL::to('contact') }}">{{__('text.Contact Us')}}</a></li>
                    <li><a href="{{ URL::to('cookieverklaring')}}">{{__('text.Careers with Us')}}</a></li>
                    <li><a href="{{ URL::to('algemene-voorwaarden')}}">{{__('text.Terms & Conditions')}}</a></li>
                    <li><a href="{{ URL::to('privacy-beleid')}}">{{__('text.Privacy Policy')}}</a></li>
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

                  <h4 style="margin-bottom: 30px;font-size: 18px;color: inherit">{{__('text.Stay informed and quickly find, sell or rent your home')}}</h4>

                  @if(getcong('social_facebook'))
                      <li><a href="{{getcong('social_facebook')}}" class="icon-facebook" rel="tooltip" title="" data-placement="bottom" data-original-title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  @endif


                  @if(getcong('social_twitter'))
                      <li><a href="{{getcong('social_twitter')}}" class="icon-twitter" rel="tooltip" title="" data-placement="bottom" data-original-title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  @endif

                    @if(getcong('social_linkedin'))
                        <li><a href="{{getcong('social_linkedin')}}" class="icon-linkedin" rel="tooltip" title="" data-placement="bottom" data-original-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    @endif

                    @if(getcong('social_gplus'))
                        <li><a href="{{getcong('social_gplus')}}" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Gplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    @endif

                  @if(getcong('social_insta'))
                      <li><a href="{{getcong('social_insta')}}" class="icon-insta" rel="tooltip" title="" data-placement="bottom" data-original-title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>
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

<style>

    .copyright .social-links > li > .icon-linkedin:hover{ background: #4e4e99; }

    .copyright .social-links > li > .icon-insta:hover{ background: #d54b4b; }

    .widget ul li a{color: #3bafda !important;}

    .widget ul li a:hover{color: #fff !important;}

</style>
