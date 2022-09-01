
<div style="margin: 0 0 30px 0;padding-top: 10px;" class="row top-bar">

    <div style="display: flex;justify-content: flex-start;align-items: center;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <a class="top-left-link" style="padding: 10px 20px;border-radius: 50px;border: 3px solid #E8D9D0;color: #b38e78;" href="#"><i style="margin-right: 5px;" class="fa fa-angle-left"></i> All Blogs</a>
    </div>

    <div style="display: flex;justify-content: center;align-items: center;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <a href="{{url('/')}}"><h1 class="grad">Speurnet.nl</h1></a>
    </div>

    <div style="display: flex;justify-content: flex-end;align-items: center;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <a class="top-right-link" style="display: flex;align-items: center;" href="#">
            <img src="{{ URL::asset('assets/img/FrontSpeur_Page1_4211_-removebg-preview.png') }}" style="width: 50px;height: 47px;">
            <span style="font-weight: 700;color: black;margin-left: 5px;margin-top: 5px;">Bedrijf vermelden?</span>
        </a>
    </div>

</div>

<style>

    .grad {
        background: rgb(255,255,255);
        background: linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0) 70%, #fae053 50%, #fae053 100%);
        display: inline;
        color: black;
        font-family: system-ui;
        margin: 0;
        font-size: 45px;
        font-weight: 900;
    }

    #wrap {
        display: inline-block;
        padding: 0;
        position: relative;
    }

    .search-bar {
        font-size: 20px;
        display: inline-block;
        font-family: "Lato";
        font-weight: 100;
        border: none;
        outline: none;
        color: #555;
        padding: 3px;
        background: none;
        transition: width .4s cubic-bezier(0.000, 0.795, 0.000, 1.000);
        /*width: 100%;*/
        z-index: 1;
        cursor: text;
        margin-left: 5px;
    }

    .search-bar:focus {
        border-bottom: 1px solid #BBB;
    }

    .search-btn {
        height: 40px;
        width: 45px;
        display: inline-block;
        color:red;
        background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAADNQTFRFU1NT9fX1lJSUXl5e1dXVfn5+c3Nz6urqv7+/tLS0iYmJqampn5+fysrK39/faWlp////Vi4ZywAAABF0Uk5T/////////////////////wAlrZliAAABLklEQVR42rSWWRbDIAhFHeOUtN3/ags1zaA4cHrKZ8JFRHwoXkwTvwGP1Qo0bYObAPwiLmbNAHBWFBZlD9j0JxflDViIObNHG/Do8PRHTJk0TezAhv7qloK0JJEBh+F8+U/hopIELOWfiZUCDOZD1RADOQKA75oq4cvVkcT+OdHnqqpQCITWAjnWVgGQUWz12lJuGwGoaWgBKzRVBcCypgUkOAoWgBX/L0CmxN40u6xwcIJ1cOzWYDffp3axsQOyvdkXiH9FKRFwPRHYZUaXMgPLeiW7QhbDRciyLXJaKheCuLbiVoqx1DVRyH26yb0hsuoOFEPsoz+BVE0MRlZNjGZcRQyHYkmMp2hBTIzdkzCTc/pLqOnBrk7/yZdAOq/q5NPBH1f7x7fGP4C3AAMAQrhzX9zhcGsAAAAASUVORK5CYII=) center center no-repeat;
        background-size: 45%;
        text-indent: -10000px;
        z-index: 2;
        opacity: 0.4;
        cursor: pointer;
        transition: opacity .4s ease;
        border: 1px solid gray;
        border-radius: 15px;
    }

    .search-btn:hover {
        opacity: 0.8;
    }

</style>

<nav class="navbar navbar-default navbar-fixed-top mobile-nav" role="navigation">
    <div class="container container-header">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">

        <h1 style="margin-top: 20px;margin-left: 10px;" class="grad">Speurnet.nl</h1>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-top" style="margin: 0;padding: 0;">

        <button style="border: 0;position: absolute;right: 15px;z-index: 10000;margin-top: 0;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top" aria-expanded="true">
            <i class="fa fa-close"></i>
        </button>

        <ul style="margin-right: 0;" class="nav navbar-nav navbar-right">

            <li class="{{classActivePathPublic('')}}"><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>
            <li><a href="{{route('blogs')}}">Blogs</a></li>
            <li><a href="{{route('page1')}}">Companies</a></li>
            <li><a href="{{route('zoekhet')}}">Zoekhet</a></li>
            <!-- <li><a href="{{route('education')}}">Education</a></li> -->
            <li><a href="{{route('study')}}">Study</a></li>
            <li><a href="{{route('vactury')}}">Vactury</a></li>
            <li><a href="{{route('offer')}}">Offer</a></li>
            <li><a href="{{route('place-to-do')}}">Place to do</a></li>

            <li id="wrap">
                <form style="display: flex;align-items: center;padding: 20px;" action="" autocomplete="on">
                    <input class="search-btn" id="search_submit" value="Rechercher" type="submit">
                    <input class="search-bar" id="search" name="search" type="text" placeholder="What're we looking for ?">
                </form>
            </li>

        </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
<!-- end:navbar -->

@include("_particles.slidersearch")

<div class="row" style="margin: 40px 0 0 0;">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex;justify-content: center;flex-wrap: wrap;padding: 0;">

        @foreach($homepage_boxes as $x => $key)

            <div style="display: flex;align-items: center;justify-content: center;" class="col-lg-4 col-md-4 col-sm-4 col-xs-9 con">

                <div class="left-tab{{$x != 0 ? $x : null}} tab">
                    <h2>{{$key->title}}</h2>
                    <a href="{{$key->url}}">View All</a>
                </div>
                <div class="right-tab{{$x != 0 ? $x : null}} tab1">
                    <img src="{{ URL::asset('upload/'.$key->image) }}">
                </div>

            </div>

        @endforeach

    </div>

</div>

<style>

    .tab, .tab1
    {
        padding: 10px 15px;
        height: 150px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .tab
    {
        -webkit-border-top-left-radius: 75px;
        -webkit-border-top-right-radius: 45px;
        -webkit-border-bottom-left-radius: 75px;
        -webkit-border-bottom-right-radius: 0;
        -moz-border-radius-topleft: 75px;
        -moz-border-radius-topright: 45px;
        -moz-border-radius-bottomleft: 75px;
        -moz-border-radius-bottomright: 0;
        border-top-left-radius: 75px;
        border-top-right-radius: 45px;
        border-bottom-left-radius: 75px;
        border-bottom-right-radius: 0;
        margin-right: 10px;
        width: 30%;
    }

    .tab h2
    {
        color: #765bbe;
        margin: 5px 0;
    }

    .tab a
    {
        color: #000000;
        font-weight: 600;
        font-size: 15px;
    }

    .tab1
    {
        padding: 0;
        -webkit-border-top-left-radius: 0;
        -webkit-border-top-right-radius: 70px;
        -webkit-border-bottom-left-radius: 30px;
        -webkit-border-bottom-right-radius: 70px;
        -moz-border-radius-topleft: 0;
        -moz-border-radius-topright: 70px;
        -moz-border-radius-bottomleft: 30px;
        -moz-border-radius-bottomright: 70px;
        border-top-left-radius: 0;
        border-top-right-radius: 70px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 70px;
        width: 55%;
    }

    .left-tab
    {
        background: #AFE1FF;
    }

    .left-tab1 {

        background: #DCBEFA;
    }

    .left-tab2 {

        background: #BFFFAE;
    }

    .right-tab, .right-tab1, .right-tab2
    {
        background: transparent;
    }

    .tab1 img
    {
        width: 65%;
        height: 100%;
        z-index: -1;
    }

    .tab:before
    {
        content: "";
        position: absolute;
        height: 30px;
        width: 55px;
        bottom: 0;
        right: -47px;
        border-radius: 150px 0 145px 0;
        -moz-border-radius: 150px 0 145px 0;
        -webkit-border-radius: 150px 0 145px 0;
        transform: rotateY(135deg);
    }

    .left-tab:before {
        -webkit-box-shadow: 30px 0 0 0 #AFE1FF;
        box-shadow: 30px 0 0 0 #AFE1FF;
    }

    .left-tab1:before {
        -webkit-box-shadow: 30px 0 0 0 #dcbefa;
        box-shadow: 30px 0 0 0 #dcbefa;
    }

    .left-tab2:before {
        -webkit-box-shadow: 30px 0 0 0 #BFFFAE;
        box-shadow: 30px 0 0 0 #BFFFAE;
    }

    .tab1:before
    {
        content: "";
        position: absolute;
        height: 35px;
        width: 80px;
        top: 0;
        left: -80px;
        border-radius: 0 100px 0 0;
        -moz-border-radius: 0 100px 0 0;
        -webkit-border-radius: 0 100px 0 0;
    }

    .right-tab:before, .right-tab1:before, .right-tab2:before {
        -webkit-box-shadow: 40px 0 0 0 transparent;
        box-shadow: 40px 0 0 0 transparent;
    }

    @media screen and (max-width: 1500px)
    {
        .tab
        {
            width: 35%;
        }

        .tab1
        {
            width: 60%;
        }

        .tab, .tab1
        {
            height: 120px;
        }
    }

    @media screen and (max-width: 992px)
    {
        .tab, .tab1
        {
            height: 90px;
        }

        .tab h2
        {
            font-size: 16px;
            margin: 10px 0 0 0;
        }

        .tab a
        {
            font-size: 10px;
        }

        .tab1
        {
            border-bottom-left-radius: 45px;
        }

        .tab1:before
        {
            border-radius: 0 25px 0 0;
            -moz-border-radius: 0 25px 0 0;
            -webkit-border-radius: 0 25px 0 0;
        }
    }

    @media screen and (max-width: 768px)
    {
        .con
        {
            margin-top: 20px;
        }
    }

</style>

<div style="margin: 40px 0 0 0;display: flex;justify-content: space-between;align-items: center;" class="row">

    <form class="desktop-search" style="display: flex;align-items: center;justify-content: flex-end;padding: 20px 0;width: 100%;" action="" autocomplete="on">
        <input class="search-btn" id="search_submit" value="Rechercher" type="submit">
        <input class="search-bar" id="search" name="search" type="text" placeholder="What're we looking for ?">
    </form>

</div>

<!-- begin:navbar -->
    <nav class="navbar navbar-default navbar-fixed-top desktop-nav" role="navigation">
      <div class="container container-header">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-top" style="margin: 0;padding: 0;">

            <button style="border: 0;position: absolute;right: 15px;z-index: 10000;margin-top: 0;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top" aria-expanded="true">
                <i class="fa fa-close"></i>
            </button>

            <ul style="margin-right: 0;width: 100%;" class="nav navbar-nav navbar-right">

                <li style="margin-left: 100px;" class="{{classActivePathPublic('')}}"><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>
                <li><a href="{{route('blogs')}}">Blogs</a></li>
                <li><a href="{{route('page1')}}">Companies</a></li>
                <li><a href="{{route('zoekhet')}}">Zoekhet</a></li>
                <!-- <li><a href="{{route('education')}}">Education</a></li> -->
                <li><a href="{{route('study')}}">Study</a></li>
                <li><a href="{{route('vactury')}}">Vactury</a></li>
                <li><a href="{{route('offer')}}">Offer</a></li>
                <li><a href="{{route('place-to-do')}}">Place to do</a></li>

                <li style="float: right;">
                    <a style="display: flex;align-items: center;" href="#">
                        <img style="width: 30px;height: 30px;" src="{{ URL::asset('assets/img/calendar1.png') }}">
                        <span style="margin-left: 5px;font-size: 15px;font-weight: 600;">{{date('M d, Y')}}</span>
                    </a>
                </li>

                <li style="float: right;">
                    <a style="display: flex;align-items: center;" href="#">
                        <img style="width: 30px;height: 30px;" src="{{ URL::asset('assets/img/cloudy.png') }}">
                        <span style="margin-left: 5px;font-size: 15px;font-weight: 600;">Right Now</span>
                    </a>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
   <!-- end:navbar -->

<style>

    .navbar.navbar-default .navbar-nav li.dropdown.open > .my-account-btn, .navbar.navbar-default .navbar-nav li.dropdown.open > .my-account-btn:hover
    {
        color: #656d78;
        background-color: white;
    }

    .mobile-nav
    {
        display: none;
    }

    .navbar-header .grad{ display: none; }

    @media screen and (max-width: 767px)
    {
        .below-btn{ margin-top: 10px;text-align: left !important; margin-left: 15px !important; }

        /*.top-left-link{ padding: 5px 10px !important;font-size: 12px; }*/

        .grad{ font-size: 30px; }

        .top-bar{ display: none; }

        .navbar-header .grad{ display: inline-block; }

        #wrap{ width: 100%; }

        /*.top-right-link{ font-size: 12px;line-height: 1.5; }*/

        /*.top-right-link img{ width: 40px !important;height: 30px !important; }*/

        /*.top-right-link span{ margin-top: 0 !important; }*/
    }

    a{outline: none !important;}

    .signup
    {
        text-align: center;
    }

    @media (max-width: 1200px)
    {
        .desktop-search
        {
            display: none !important;
        }

        .desktop-nav
        {
            display: none;
        }

        .mobile-nav
        {
            display: block;
        }

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

    @media screen and (max-width: 767px)
    {
        .backstretch img{
            width: auto !important;
            height: 100% !important;
            /* left: -555px !important;
            top: -90px !important; */
        }

        .navbar-nav {
            height: 80vh !important;
            overflow-y: auto;
        }

        .collapse.in
        {
            max-height: 100% !important;
            height: 100vh;
            overflow: hidden !important;
        }

        .collapsing
        {
            max-height: 100% !important;
        }
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
            width: 100%;
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
            margin: 7.5px 0;
            width: 100%;
        }

        .signup
        {
            margin-left: 15px !important;
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
