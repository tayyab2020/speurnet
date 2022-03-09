
<div style="margin: 0;padding-top: 10px;" class="row top-bar">

    <div style="display: flex;justify-content: flex-start;align-items: center;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <a class="top-left-link" style="padding: 10px 20px;border-radius: 50px;border: 3px solid #E8D9D0;color: #b38e78;" href="#"><i style="margin-right: 5px;" class="fa fa-angle-left"></i> All Blogs</a>
    </div>

    <div style="display: flex;justify-content: center;align-items: center;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <h1 class="grad">Speurnet.nl</h1>
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
        width: 100%;
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
                <li class="{{classActivePathPublic('woningaanbod')}}"><a href="{{route('properties-front')}}">{{__('text.All Properties')}}</a></li>
                {{--<li class="{{classActivePathPublic('featured')}}"><a href="{{ URL::to('featured/') }}">Featured</a></li>--}}
                {{--<li class="{{classActivePathPublic('sale')}}"><a href="{{ URL::to('sale/') }}">Sale</a></li>
                <li class="{{classActivePathPublic('rent')}}"><a href="{{ URL::to('rent/') }}">Rent</a></li>--}}
                <li class="{{classActivePathPublic('makelaars')}}"><a href="{{route('agents-front')}}">{{__('text.Agents')}}</a></li>
                <li class="{{classActivePathPublic('nieuwbouwprojecten')}}"><a href="{{ route('newconstructions-front') }}">{{__('text.New Constructions')}}</a></li>
                <li class="{{classActivePathPublic('woningruil')}}"><a href="{{ route('homeexchange-front') }}">{{__('text.Home Exchange')}}</a></li>
                <li class="{{classActivePathPublic('verhuistips')}}"><a href="{{ route('front-moving-tips') }}">{{__('text.Moving Tips')}}</a></li>
                <li class="{{classActivePathPublic('expats')}}"><a href="{{ URL::to('expats/') }}">{{__('text.Expats')}}</a></li>

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

@if(count($content))

    <div class="row" style="margin: 40px 0 0 0;">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex;">

            <div style="margin: 0;" data-testid="key-services" class="css-htlmaj col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <div>
                    <div class="domain-home_ down is-visible">

                        <h2 class="css-ce6ko1">{{$heading->wyh_heading}}</h2>

                        <ul class="css-48sroz" style="list-style: none;padding: 0;">

                            @foreach($content as $temp)

                                <li>

                                    @if($temp->image)

                                        <a target="_blank" href="@if($temp->url){{$temp->url}} @else {{URL::to('/')}} @endif">

                                            <img src="{{ URL::asset('upload/homepage_icons/'.$temp->image) }}">{{$temp->title}}

                                        </a>

                                    @else

                                        <a target="_blank" style="display: flex;justify-content: center;" href="@if($temp->url){{$temp->url}} @else {{URL::to('/')}} @endif">

                                            {{$temp->title}}

                                        </a>

                                    @endif

                                </li>

                            @endforeach


                        </ul></div></div></div>

        </div>

    </div>

@endif

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

                <li style="margin-left: 50px;" class="{{classActivePathPublic('')}}"><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>
                <li class="{{classActivePathPublic('woningaanbod')}}"><a href="{{route('properties-front')}}">{{__('text.All Properties')}}</a></li>
                {{--<li class="{{classActivePathPublic('featured')}}"><a href="{{ URL::to('featured/') }}">Featured</a></li>--}}
                {{--<li class="{{classActivePathPublic('sale')}}"><a href="{{ URL::to('sale/') }}">Sale</a></li>
                <li class="{{classActivePathPublic('rent')}}"><a href="{{ URL::to('rent/') }}">Rent</a></li>--}}
                <li class="{{classActivePathPublic('makelaars')}}"><a href="{{route('agents-front')}}">{{__('text.Agents')}}</a></li>
                <li class="{{classActivePathPublic('nieuwbouwprojecten')}}"><a href="{{ route('newconstructions-front') }}">{{__('text.New Constructions')}}</a></li>
                <li class="{{classActivePathPublic('woningruil')}}"><a href="{{ route('homeexchange-front') }}">{{__('text.Home Exchange')}}</a></li>
                <li class="{{classActivePathPublic('verhuistips')}}"><a href="{{ route('front-moving-tips') }}">{{__('text.Moving Tips')}}</a></li>
                <li class="{{classActivePathPublic('expats')}}"><a href="{{ URL::to('expats/') }}">{{__('text.Expats')}}</a></li>

                <li style="float: right;" id="wrap">
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
