<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="description" content="@yield('head_description', getcong('site_description'))">
    <meta property="keywords" content="@yield('head_keywords', getcong('site_keywords'))" />

    <meta property="og:type" content="article"/>
    <meta property="og:title" content="@yield('head_title',  getcong('site_name'))"/>
    <meta property="og:description" content="@yield('head_description', getcong('site_description'))"/>

    <meta property="og:image" content="@yield('head_image', url('/upload/logo.png'))" />
    <meta property="og:url" content="@yield('head_url', url('/'))" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="{{ URL::asset('upload/'.getcong('site_favicon')) }}" rel="icon" type="image/x-icon" />

    <title>@yield('head_title', getcong('site_name'))</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,600,800' rel='stylesheet' type='text/css'>
    <link href="{{ URL::asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">


    <link href="{{ URL::asset('assets/css/'.getcong('site_style').'.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet">

    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.10/plyr.css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/slick-theme.css') }}"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="{{ URL::asset('assets/js/html5shiv.js') }}"></script>
      <script src="{{ URL::asset('assets/js/respond.min.js') }}"></script>

    <![endif]-->
 	{!!getcong('site_header_code')!!}

	{!! getcong('addthis_share_code')!!}

  <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-HECLKHGS51"></script>
      <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-HECLKHGS51');
      </script>


  </head>

  <body id="top" class="body-padding-top">

  <style>
      @media screen and (min-width: 1201px)
      {
          .body-padding-top
          {
              padding-top: 85px !important;
          }
      }
  </style>

	  @include("_particles.header")


	  @yield("content")


	  @include("_particles.footer")


<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ URL::asset('assets/js/jquery.js') }}"></script>
    <script src="https://kit.fontawesome.com/29532268c4.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFPa3LVeBRpaGafuUtk4znrty6IIqtMUw&libraries=places&region=nl" defer></script>
    <script src="https://cdn.plyr.io/3.5.10/plyr.js"></script>
    <script src="{{ URL::asset('assets/js/gmap3.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.easing.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.jcarousel.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.backstretch.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/script.js') }}"></script>
    <script src="{{ URL::asset('assets/js/summernote.js') }}"></script>
    <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/slick.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/slick.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    <script type="text/javascript">

    /* backstretch slider */
    $('.header-slide').backstretch([
      @foreach(\App\Slider::orderBy('name')->get() as $slide)
      "{{ URL::asset('upload/slides/'.$slide->image_name.'.jpg') }}",

      @endforeach
      ], {
        fade: 850,
        duration: 4000
    });


	  </script>

      <style>

          @media screen and (min-width: 1201px)
          {
              .navbar-default .navbar-brand::after
              {
                  height: 102px;
              }
          }

          @media screen and (max-width: 767px)
          {
              .navbar-nav {
                  height: 100vh !important;
                  overflow-y: auto;
              }

              .collapse.in
              {
                  max-height: 100% !important;
              }

              .collapsing
              {
                  max-height: 100% !important;
              }
          }

          .dropdown button::after
          {
              display: inline-block;
              margin-left: .255em;
              vertical-align: .255em;
              content: "";
              border-top: .3em solid;
              border-right: .3em solid transparent;
              border-bottom: 0;
              border-left: .3em solid transparent;

          }


          .dropdown-menu a{
              display: block;
              padding: 5px 10px;
              width: 100%;
              white-space: nowrap;
              text-decoration: none;
              color: #212529;
          }

          .dropdown-menu a i{ margin-right: 5px; }

          .backstretch
          {
              width: 100% !important;
              height: 100% !important;
          }

          .backstretch img{
              width: 100% !important;
              height: 100% !important;
              left: 0 !important;
              top: 0px !important;
          }

      </style>

  <script>

      $(document).ready(function() { //Make script DOM ready

          $('.dropdown-lng').click(function () {

              var value = $(this).data('value');

              $('#language').val(value);

              $('#lng_form').submit();
          });

          $('.navbar-collapse').on('shown.bs.collapse', function () {
              $('body').addClass('modal-open');
          });

          $('.navbar-collapse').on('hidden.bs.collapse', function () {
              $('body').removeClass('modal-open');
          });

      });

  </script>

    {!!getcong('site_footer_code')!!}

  </body>
</html>


