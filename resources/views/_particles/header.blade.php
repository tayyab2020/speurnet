<!-- begin:navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container container-header">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('/') }}" style="padding-right: 0px;">

          @if(getcong('site_logo')) <img src="{{ URL::asset('upload/'.getcong('site_logo')) }}" alt=""> @else {{getcong('site_name')}} @endif

          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-top">
          <ul class="nav navbar-nav navbar-right">
            <li class="{{classActivePathPublic('')}}"><a href="{{ URL::to('/') }}">Home</a></li>
        	<li class="{{classActivePathPublic('properties')}}"><a href="{{ URL::to('properties/') }}">All Properties</a></li>
            {{--<li class="{{classActivePathPublic('featured')}}"><a href="{{ URL::to('featured/') }}">Featured</a></li>--}}
            {{--<li class="{{classActivePathPublic('sale')}}"><a href="{{ URL::to('sale/') }}">Sale</a></li>
            <li class="{{classActivePathPublic('rent')}}"><a href="{{ URL::to('rent/') }}">Rent</a></li>--}}
            <li class="{{classActivePathPublic('agents')}}"><a href="{{ URL::to('agents/') }}">Agents</a></li>
            <li class="{{classActivePathPublic('new-constructions')}}"><a href="{{ URL::to('new-constructions/') }}">New Constructions</a></li>
            <li class="{{classActivePathPublic('admin')}}"><a href="{{ URL::to('admin/properties/addhomeexchange') }}">Home Exchange</a></li>
            <li class="{{classActivePathPublic('moving-tips')}}"><a href="{{ URL::to('moving-tips/') }}">Moving Tips</a></li>
            <li class="{{classActivePathPublic('expats')}}"><a href="{{ URL::to('expats/') }}">Expats</a></li>

             @if(Auth::check())

             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ URL::to('admin/dashboard/') }}">Dashboard</a></li>
                <li><a href="{{ URL::to('admin/profile/') }}">Profile</a></li>
                <li><a href="{{ URL::to('logout') }}">Logout</a></li>

              </ul>
            </li>

             	<li><a href="{{ URL::to('admin/properties/addproperty') }}" class="signup col-lg-12 col-md-3 col-sm-6 col-xs-6">Post your Property</a></li>
             @else
                  <li>
                      <i style="font-size: 18px;border-left: 1px solid #a5a1a1;padding-left: 15px;" class="fas fa-user"></i>
                      <a href="{{ URL::to('login') }}" style="display: inline-block;padding-left: 5px;padding-right: 5px;">Sign in</a><span> / </span>
                      <a href="{{ URL::to('register') }}" style="display: inline-block;padding-left: 5px;padding-right: 5px;">Sign up</a>
                  </li>
            	<li><a href="{{ URL::to('login') }}" class="signup col-lg-12 col-md-3 col-sm-6 col-xs-6">Post your Property</a></li>
             @endif


          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
   <!-- end:navbar -->

<style>

    .signup
    {
        text-align: center;
    }

    @media (max-width: 1200px)
    {
        .navbar-collapse.collapse
        {
            display: none !important;
            overflow-y: auto !important;
            border-top-color: #3bafda !important;
            overflow-x: visible !important;
            border-top: 1px solid;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
            padding-right: 15px;
            padding-left: 15px;

        }
    }

    .collapse.in
    {
        display: block !important;
    }

    @media (max-width: 1200px)
    {
        .navbar-toggle
        {
            display: block;
            margin-top: 22px;
        }

        .navbar-header
        {
            float: none;
            min-height: 80px;
        }
    }

    .navbar-default .navbar-nav > li > a
    {
        font-size: 14px;
    }

    .signin
    {
        padding: 5px 15px !important;
        margin-top: 24px;
    }

    @media (min-width: 768px)
    {
        .container-header
        {
            padding: 0;
            width: 100%;
        }
    }

    @media (min-width: 1200px)
    {
        .container-header
        {
            padding: 0;
            width: 95%;
        }
    }

    @media screen and (max-width: 1200px)
    {
        .navbar-default .navbar-nav > li > a{
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 15px;
        }

        .navbar-nav > li
        {
            float: none;
        }

        .navbar-default .navbar-nav > .active > a::after
        {
            display: none;
        }

        .navbar-right
        {
            float: none !important;
            margin: 7.5px -15px;
        }

        .signup
        {
            margin-left: 10px;
        }
    }

    @media screen and (max-width: 470px)
    {
        .navbar-brand
        {
            width: 70%;
        }

        .navbar-brand img
        {
            width: 100% !important;
        }
    }
</style>
