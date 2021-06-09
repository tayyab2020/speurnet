<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title> {{getcong('site_name')}} Admin</title>

	<link href="{{ URL::asset('upload/'.getcong('site_favicon')) }}" type="image/x-icon" rel="icon" />
	<link rel="stylesheet" href="{{ URL::asset('admin_assets/css/style.css') }}">
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <link href="{{asset('admin_assets/css/bootstrap-colorpicker.css')}}" rel="stylesheet">

	<script src="{{ URL::asset('admin_assets/js/jquery.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script src="{{asset('admin_assets/js/bootstrap-colorpicker.js')}}"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-HECLKHGS51"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-HECLKHGS51');
        </script>

</head>

<body class="sidebar-push  sticky-footer">

     	<!-- BEGIN TOPBAR -->

         @include("admin.topbar")

        <!-- END TOPBAR -->

	      <!-- BEGIN SIDEBAR -->

	       @include("admin.sidebar")

	      <!-- END SIDEBAR -->
  		<div class="container-fluid">

 		   @yield("content")

	 		<div class="footer">
				<a href="{{ URL::to('admin/dashboard') }}" class="brand">
					{{getcong('site_name')}}
				</a>
				<ul>

				</ul>
			</div>
  		</div>


  <div class="overlay-disabled"></div>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA65DZUJgWuYMvWwfgDQ59mPlxiRQJ6TdA&libraries=places&region=nl" defer></script>

  <!-- Plugins -->
  <script src="{{ URL::asset('admin_assets/js/plugins.min.js') }}"></script>

  <script src="{{ URL::asset('admin_assets/js/summernote.js') }}"></script>

  <!-- Loaded only in index.html for demographic vector map-->
  <script src="{{ URL::asset('admin_assets/js/jvectormap.js') }}"></script>

  <!-- App Scripts -->
  <script src="{{ URL::asset('admin_assets/js/scripts.js') }}"></script>


</body>

</html>

