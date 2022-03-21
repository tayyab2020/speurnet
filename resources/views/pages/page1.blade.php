@extends("app")

<div style="margin: 0 0 30px 0;padding-top: 10px;" class="row top-bar">

    <div style="display: flex;justify-content: flex-start;align-items: center;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <h1 class="grad">Speurnet.nl</h1>
    </div>

</div>

<style>

    @media (min-width: 768px)
    {
        .container-header
        {
            padding: 0 !important;
            width: 100% !important;
        }
    }

    @media (min-width: 1200px)
    {
        .container-header
        {
            padding: 0 !important;
            width: 100% !important;
        }
    }

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

            <ul style="margin: 0;border-bottom: 1px solid #eaeaea;padding-bottom: 30px;" class="nav navbar-nav navbar-right">

                <li id="wrap">
                    <form style="display: flex;align-items: center;margin-top: 20px;" action="" autocomplete="on">
                        <input class="search-btn" id="search_submit" value="Rechercher" type="submit">
                        <input class="search-bar" id="search" name="search" type="text" placeholder="What're we looking for ?">
                    </form>

                    <div>
                        <div>
                            <label>Jouw stad, provincie of gemeente</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->

    </div><!-- /.container -->
</nav>
<!-- end:navbar -->

<div style="margin: 40px 0 0 0;display: flex;justify-content: flex-start;align-items: center;" class="row top-con">

    <div id="sidebar">
        <ul data-accordion class="bx--accordion">
            <li data-accordion-item class="bx--accordion__item">
                <button style="background-color: transparent;border: 0;border-right: 1px solid #dedede;display: flex;align-items: center;justify-content: space-between;padding: 0 30px;width: 100%;" class="bx--accordion__heading collapsed" data-toggle="collapse" data-target="#pane1">
                    <i style="margin-right: 10px;" class="fa fa-bars"></i> Category
                </button>
                <div style="position: absolute;z-index: 10000;" id="pane1" class="bx--accordion__content collapse">
                    <ul data-accordion class="categories">
                        <li><span>Footwear</span>
                            <ul>
                                <li class="subcat"><input type="checkbox" id="all"><label for="all">All Footwear</label></li>
                                <li class="subcat"><input type="checkbox" id="low"><label for="low">Low-Top Sneakers</label></li>
                                <li class="subcat"><input type="checkbox" id="high"><label for="high">High-Top Sneakers</label></li>
                                <li class="subcat"><input type="checkbox" id="boots"><label for="boots">Boots</label></li>
                                <li class="subcat"><input type="checkbox" id="casual"><label for="casual">Casual Leather Shoes</label></li>
                                <li class="subcat"><input type="checkbox" id="formal"><label for="formal">Formal Shoes</label></li>
                                <li class="subcat"><input type="checkbox" id="sand"><label for="sand">Sandals</label></li>
                                <li class="subcat"><input type="checkbox" id="slip"><label for="slip">Slip Ons</label></li>
                            </ul>
                        </li>
                        <li><span>Tops</span></li>
                        <li><span>Bottoms</span></li>
                        <li><span>Outerwear</span></li>
                        <li><span>Tailoring</span></li>
                        <li><span>Accessories</span></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <form class="desktop-search" style="display: flex;align-items: center;margin-left: 10px;border-right: 1px solid #dedede;" action="" autocomplete="on">
        <input class="search-btn" id="search_submit" value="Rechercher" type="submit">
        <input class="search-bar" id="search" name="search" type="text" placeholder="What're we looking for ?">
    </form>

    <div class="city-con" style="margin-left: 10px;margin-bottom: 40px;">
        <div class="city-box">
            <label>Jouw stad, provincie of gemeente</label>
            <input type="text" class="form-control">
        </div>
    </div>

</div>

<style>

    ul li{ list-style: none; }

    .bx--accordion {
        width: 100%;
        padding: 0;
    }
    .bx--accordion__content {
        padding-right: 1rem;
        padding-left: 0.5rem;
        background-color: white;
        border: 1px solid #dadada;
        width: 100%;
        padding: 20px 0;
    }
    .bx--accordion__heading {
        padding: 0px;
        height: 44px;
    }

    .bx--accordion__heading::after {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
        margin-left: auto;
        content: "";
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-size: 1.25rem;
        transition: transform .2s ease-in-out;
    }
    .bx--accordion__heading:not(.collapsed)::after{
        transform: rotate(-180deg);
    }
    .categories li, .designers li {
        padding: 4px 0px;
        font-family: SF Pro Text, Helvetica;
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        font-weight: 400;
        line-height: 21px;
    }
    .categories ul {
        margin-top: 10px;
    }
    .designers ul {
        padding-left: 0;
    }
    .subcat {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .subcat input[type="checkbox"] {
        margin: 0 !important;
        font-weight: 100;
    }
    .subcat label{
        margin: 0 0 0 10px;
        color: #999999;
        font-weight: 500;
    }
    .categories li span{
        font-weight: 600;
        font-size: 15px;
        color: black;
    }
    .bx--accordion__heading:focus:before {
        border: 0px solid #e1e1e1;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    .bx--accordion__heading:hover:before {
        background-color: #f8f8f8;
    }
    .subcat input[type="checkbox"] {
        position: relative;
        cursor: pointer;
    }
    .subcat input[type="checkbox"]:checked + label {
        color: blue;
    }

    #sidebar{
        width: 285px;
        position: relative;
    }

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
        .desktop-search
        {
            display: none !important;
        }

        .city-con{
            display: none;
        }
    }

    @media screen and (max-width: 867px)
    {
        .top-con{
            flex-direction: column;
            margin: 20px 0 0 0 !important;
        }

        #sidebar
        {
            width: 100%;
        }
    }

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

<!-- begin:content -->
<div id="content" style="padding: 30px 0 20px 0;">

    @if(Session::has('flash_message'))
        <div class="alert alert-success alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">
                <span aria-hidden="true">&times;</span></button>
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">
                    <span aria-hidden="true">&times;</span></button>
                {{$error}}
            </div>
        @endforeach
    @endif

    <div class="container" style="width: 100%;">

        <!-- begin:latest -->

        <div class="row" style="margin: 0;">

            <div class="col-lg-9 col-md-6 col-sm-12 col-xs-12">

                <div class="row company-boxes">

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-9 sub">
{{--                        <h1 style="font-size: 20px;" class="grad">Speurnet.nl</h1>--}}
                        <div style="background-image: url({{url('assets/img/img171.jpg')}});background-size: 100% 100%;" class="row"></div>
                        <span style="margin-top: 10px;display: block;"><i class="fa fa-map-marker-alt" style="margin-right: 5px;"></i> Kamerlingh Onnesweg 72/6, 122JL</span>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-9 sub">
                        <div style="background-color: #C2EEEB;" class="row">
                            <a href="#">Company Title</a>
                            <span style="margin-top: 5px;"><i class="fa fa-map-marker-alt" style="margin-right: 5px;"></i> Kamerlingh Onnesweg 72/6, 122JL</span>
                            <h5 style="margin-left: 15px;">Hilversum</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-9 sub">
                        <div style="background-color: #C2EEEB;" class="row">
                            <a href="#">Company Title</a>
                            <span style="margin-top: 5px;"><i class="fa fa-map-marker-alt" style="margin-right: 5px;"></i> Kamerlingh Onnesweg 72/6, 122JL</span>
                            <h5 style="margin-left: 15px;">Hilversum</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-9 sub">
                        <div style="background-color: #DAF4D9;" class="row">
                            <a href="#">Company Title</a>
                            <span style="margin-top: 5px;"><i class="fa fa-map-marker-alt" style="margin-right: 5px;"></i> Kamerlingh Onnesweg 72/6, 122JL</span>
                            <h5 style="margin-left: 15px;">Hilversum</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-9 sub">
                        <div style="background-color: #F4E4BD;" class="row">
                            <a href="#">Company Title</a>
                            <span style="margin-top: 5px;"><i class="fa fa-map-marker-alt" style="margin-right: 5px;"></i> Kamerlingh Onnesweg 72/6, 122JL</span>
                            <h5 style="margin-left: 15px;">Hilversum</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-9 sub">
                        <div style="background-color: #F7D5D9;" class="row">
                            <a href="#">Company Title</a>
                            <span style="margin-top: 5px;"><i class="fa fa-map-marker-alt" style="margin-right: 5px;"></i> Kamerlingh Onnesweg 72/6, 122JL</span>
                            <h5 style="margin-left: 15px;">Hilversum</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-9 sub">
                        <div style="background-color: #F5DEF3;" class="row">
                            <a href="#">Company Title</a>
                            <span style="margin-top: 5px;"><i class="fa fa-map-marker-alt" style="margin-right: 5px;"></i> Kamerlingh Onnesweg 72/6, 122JL</span>
                            <h5 style="margin-left: 15px;">Hilversum</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-9 sub">
                        <div style="background-color: #C2EEEB;" class="row">
                            <a href="#">Company Title</a>
                            <span style="margin-top: 5px;"><i class="fa fa-map-marker-alt" style="margin-right: 5px;"></i> Kamerlingh Onnesweg 72/6, 122JL</span>
                            <h5 style="margin-left: 15px;">Hilversum</h5>
                        </div>
                    </div>

                </div>

            </div>

            <div style="padding: 0 20px;" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 trending">

                <h4 style="font-weight: 600;text-align: left;color: black;">Looking for a job that has it all?</h4>

                <div style="display: flex;flex-direction: column;">

                    <span style="color: black;">We'll match you with jobs that have to pick work that fits your schedule</span>

                    <div style="display: flex;align-items: center;width: 100%;">
                        <button style="padding: 15px;border-radius: 45px;width: 45%;background: white;border: 1px solid black;color: black;font-weight: 600;margin-top: 10px;">Start Working</button>
                        <img src="{{ URL::asset('assets/img/rocket.png') }}" style="width: 50px;height: 50px;margin-left: 10px;">
                    </div>

                </div>

            </div>

            <div style="display: flex;align-items: flex-end;flex-wrap: wrap;margin: 20px 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div style="display: flex;justify-content: flex-start;align-items: center;padding: 0;" class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                    <a class="top-left-link" style="padding: 10px;color: black;font-weight: 600;" href="#">Explore our Services <i style="margin-left: 5px;" class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>

                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 bottom-list" style="padding: 0;display: flex;justify-content: center;align-items: center;">

                    <ul style="list-style: none;display: inline-block;padding: 0;margin: 0;">

                        <li><a href="{{url('/')}}">Thuis</a></li>
                        <li><a style="display: flex;align-items: center;" href="#"><i style="font-size: 10px;" class="fa fa-heart" aria-hidden="true"></i><span style="margin-left: 5px;">Saved</span></a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Motors</a></li>
                        <li><a href="#">Home & Garden</a></li>
                        <li><a href="#">Clothing & Accessories</a></li>
                        <li><a href="#">Sports</a></li>

                    </ul>

                </div>

                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 wrapper2-container" style="padding: 0;display: flex;justify-content: center;align-items: center;margin-top: 20px;">
                    <section class="wrapper2">
                        <div class="content">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <section>
                                <p><span>Join over 120K</span> Ecommerce business who get fresh content and tips from us</p>
                            </section>
                            <footer>
                                <input type="email" id="email_id" name="email" placeholder="{{__('text.Enter your mail')}}">
                                <button type="button" onClick="subscribe_user()">Subscribe</button>
                            </footer>
                        </div>
                    </section>
                </div>

            </div>

        </div>
        <!-- end:latest -->

    </div>
</div>
<!-- end:content -->

<!-- begin:modal-message -->
<div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="modal-signin" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">
                <div id="ajax" style="color: #db2424"></div>
            </div>

        </div>
    </div>
</div>
<!-- end:modal-message -->

<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

<style>

    .bottom-list li
    {
        float: left;
        margin: 10px;
    }

    .bottom-list li a
    {
        color: black;
    }

    .bottom-list li a:hover
    {
        color: #3bafda;
    }

    #footer
    {
        background-color: white;
        border-top: 1px solid #686868;
        padding: 20px 0 0;
    }

    #footer .widget h3
    {
        color: black;
    }

    .copyright .social-links > li > a > .fa
    {
        color: white;
    }

    .wrapper2 {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .wrapper2 .content {
        background: #FFE870;
        padding: 30px;
        width: 100%;
        max-width: 500px;
        min-width: 200px;
        border-radius: 10px;
        text-align: center;
    }
    .wrapper2 .content p
    {
        color: black;
        text-align: left;
    }
    .wrapper2 .content p span {
        color: #685905;
        font-size: 20px;
        font-weight: 900;
    }
    .wrapper2 .content section {
        color: #929da6;
        font-size: 15px;
    }
    .wrapper2 .content footer input {
        border: unset;
        background-color: #FFF5BF;
        padding: 15px;
        font-size: 13px;
        border-radius: 10px;
        width: 100%;
    }
    .wrapper2 .content footer button {
        background-color: #685905;
        color: #fff;
        border: unset;
        width: 100%;
        border-radius: 10px;
        padding: 15px;
        margin-top: 10px;
        cursor: pointer;
    }

    .wrapper2 .content footer input:focus, .wrapper2 .content footer button:focus {
        outline: none;
    }

    .fav-articles
    {
        margin: 20px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .fav-articles img
    {
        width: 100px;
        height: 100px;
        border-radius: 100%;
    }

    .fav-articles span
    {
        margin-top: 20px;
        text-align: center;
    }

    .fav-articles h4
    {
        font-weight: 600;
        text-align: center;
    }

    .company-boxes
    {
        margin: 0;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .company-boxes .sub
    {
        padding: 10px;
        /*margin-top: 10px;*/
    }

    .company-boxes .row
    {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        flex-direction: column;
        margin: 0;
        border-radius: 10px;
        width: 100%;
        min-height: 160px;
        /*border: 2px solid black;*/
        padding: 10px;
        margin-top: 10px;
    }

    .company-boxes a
    {
        color: #6C6CA4;
        font-weight: 600;
        font-size: 18px;
    }

    .ekko-lightbox .modal-dialog
    {
        margin: 10px;
    }

    @media (max-width: 478px)
    {
        .res-container
        {
            padding: 0 !important;
        }


        .res-content
        {
            height: 150px !important;
            font-size: 20px;
        }


        .res-size
        {
            min-height: 280px !important;
        }

        .bottom-text
        {
            min-height: 55px !important;
            flex-direction: column !important;
            justify-content: flex-end !important;
            align-items: flex-start !important;
        }

        .bottom-text small
        {
            margin: 2px 0px;
        }
    }

    @media (max-width: 768px)
    {
        .latest
        {
            height: 185px !important;
        }

        .property-content h3, .property-text h3
        {
            font-size: 15px !important;
            line-height: 18px !important;
        }


        .property-content h3 .res-small
        {
            font-size: 10px !important;
        }

        .property-content h3 .res-span
        {
            font-size: 10px !important;
        }

        .property-content h3 small, .property-text h3 small
        {
            font-size: 11px;
            margin-top: 5px;
        }

        /*.extra-text span
        {
            font-size: 9px !important;
        }*/

        .extra-text img
        {
            width: 10px !important;
            height: 10px !important;
            margin-right: 5px !important;
        }

        .property-content .company-res
        {
            font-size: 12px !important;
        }

    }

    small
    {
        line-height: 15px !important;
    }

    @media (max-width: 400px) {
        .status-responsive {
            width: 120px !important;
            font-size: 10px !important;
        }
    }

    @media (max-width: 1299px){
        .latest-container{padding: 0px 95px;}
        .top-container1{padding: 0px 95px;}
        .members-container{padding: 0px 95px;}
        .show-more-container{padding: 0px 120px;}
    }

    @media (min-width: 1300px){
        .latest-container{padding: 0px 200px;}
        .top-container1{padding: 0px 200px;}
        .members-container{padding: 0px 200px;}
        .show-more-container{padding: 0px 215px;}
    }

    @media (max-width: 1200px){
        .latest-container{padding: 0px 15px;}
        .top-container1{padding: 0px 15px;}
        .members-container{padding: 0px 15px;}
        .show-more-container{padding: 0px 15px;}
    }

    .video-wrapper-inner .popup-video{position:relative;z-index:1;display:inline-block;width:50px;height:50px;line-height:50px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;font-size:18px;color:#fff;background:#f9424b;text-align:center}

    @media (min-width: 1200px){.video-wrapper-inner .popup-video{width:70px;height:70px;line-height:70px;font-size:22px}}

    .video-wrapper-inner .popup-video:before{-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s;content:'';position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;background:#f9424b;opacity:0.3;filter:alpha(opacity=30);border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;-webkit-animation:scaleicon 3s ease-in-out 0s infinite alternate;animation:scaleicon 3s ease-in-out 0s infinite alternate}.widget-video.style2 .popup-video{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}

    @-webkit-keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

    @keyframes scaleicon{from{-ms-transform:scale(1,1);transform:scale(1,1)}50%{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}}

    .css-htlmaj
    {
        padding:0 18px;
        margin:0px auto 0px;
    }

    @media(min-width:1021px)
    {
        .css-htlmaj
        {
            padding:0 10px;
            margin-bottom:50px;
        }
    }

    .css-ce6ko1{font-size:25px;font-weight:bold;margin-bottom:30px;}

    .css-48sroz{ align-items: center;justify-content: center;flex-direction: column; }

    @media(min-width:624px){.css-48sroz{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-webkit-justify-content:flex-start;-ms-flex-pack:justify;justify-content:flex-start;}}

    @media(min-width:1021px){.css-48sroz{border-radius:3px;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;}}

    .css-48sroz li{font-weight:bold;margin-bottom:12px;background-color:#fff;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);}

    .css-48sroz li:hover,.css-48sroz li:focus{box-shadow:0 3px 6px 0 rgba(30,41,61,0.15),0 5px 10px 0 rgba(30,41,61,0.15);-webkit-transition:box-shadow ease-in 100ms;transition:box-shadow ease-in 100ms;z-index:1;}

    @media(min-width:624px){.css-48sroz li{-webkit-flex-basis:calc(50% - 6px);-ms-flex-preferred-size:calc(50% - 6px);flex-basis:calc(50% - 6px);}}

    @media(min-width:1021px){

        .css-48sroz li{width: 70%;-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;-webkit-flex-basis:24%;-ms-flex-preferred-size:24%;flex-basis:24%;font-size:18px;text-align:center;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);border-right:1px solid #e6e9ed;margin-top:-1px;margin-bottom:-1px;}

        .css-48sroz li:last-child{border-right-width:0;}

    }

    @media(min-width:1600px){.css-48sroz li{-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;-webkit-flex-basis:16%;-ms-flex-preferred-size:16%;flex-basis:16%;font-size:18px;text-align:center;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);border-right:1px solid #e6e9ed;margin-top:-1px;margin-bottom:-1px;}}

    .css-48sroz a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;padding:12px;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;font-size: 90%;}

    @media(min-width:1021px){.css-48sroz a{display:block;padding:20px 18px;height:100%;}}

    .css-48sroz img{color:#0ea800;width:110px !important;height:80px !important;margin-right:12px;}

    @media(min-width:1021px){.css-48sroz img{display:block;margin:0 auto 20px auto;width:100% !important;height:125px !important;}}

    .css-jeyium{stroke-linejoin:round;stroke-linecap:round;fill:none;vertical-align:middle;width:24px;height:24px;}


    .latest
    {
        height: 210px;
    }

    .latest img
    {
        height: 100%;
    }

    .property-status img
    {
        display: inline-block;
    }

    .property-status a:focus
    {
        outline: none;
    }

    .modal-backdrop.fade
    {
        opacity: 0.5;
    }

    .ekko-lightbox .modal-header
    {
        min-height: 0;
        padding: 0;
        border: 0;
        display: none;

    }

    .ekko-lightbox .modal-title
    {
        display: none;
    }

    .ekko-lightbox .modal-header .close
    {
        font-size: 60px;
        position: absolute;
        right: -115px;
        top: -62px;
        opacity: 0.8;
        text-shadow: none;

    }

    .ekko-lightbox .modal-body
    {
        padding: 0;
    }

    .ekko-lightbox .modal-content
    {
        border:0;
    }

    .ekko-lightbox .close{
        position: absolute;
        right: 43px;
        top: -3px;
        opacity: 0.6;
        text-shadow: none;
        outline: 0;
    }

    .ekko-lightbox .close span{
        font-size: 88px;
    }

    a
    {
        text-decoration: none;
    }

    a:hover, a:focus
    {
        text-decoration: none;
    }

    .fade {
        opacity: 0;
        transition: all .2s linear;
    }

    .modal1.fade.in
    {
        display: flex !important;
    }

    .modal2.fade.in
    {
        display: flex !important;
    }

    .navbar-fixed-top, .navbar-fixed-bottom
    {
        -webkit-transform: none;
        transform: none;
    }


    .slick-slide
    {
        outline: none;
    }

    @media (min-width: 1200px){

        .slick-slide
        {
            padding: 0px 20px;
        }

    }

    @media (min-width: 1250px){

        .slick-slide
        {
            padding: 0px 30px;
        }

    }

    .property-container
    {
        box-shadow: 0 0rem 1.2rem -3px #c2c2c2;margin-bottom: 30px;padding: 0;
    }

    .slick-arrow{position:absolute;top:50%;width:60px;height:60px;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);background:rgba(#fff,0.8);color:#0b2047;text-align:center;cursor:pointer;z-index:1;width:48px;height:48px;background:#fff;color:#3c475b;border:0;border-radius:50%;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);opacity:0.9;}

    .slick-arrow:before
    {
        display: none;
    }

    .slick-arrow:hover , .slick-arrow:focus
    {
        outline: none;
        background: #fff;
    }

    .css-oee40j{stroke-linejoin:round;stroke-linecap:round;fill:none;vertical-align:middle;width:24px;height:24px;vertical-align:middle;}

    .css-oee40j:hover
    {
        color: #0ea800;
    }

    .slick-prev:hover, .slick-prev:focus, .slick-next:hover, .slick-next:focus
    {
        color: #0ea800;
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<style>

    .ck-cont
    {
        flex: 1;
    }

    #myModal2 .modal-dialog .modal-content .modal-body{display: inline-block;}

    #myModal2 .modal-dialog
    {
        margin: auto;
        width: 60%;
    }

    #myModal1 .modal-dialog .modal-content .modal-body{display: inline-block;}

    #myModal1 .modal-dialog
    {
        margin: auto;
        width: 60%;
    }

    .cookie-box{height: 100%;padding: 15px;border: 1px solid #e5e5e5;}

    .cookie-box:hover{border: 1px solid #f3de47 !important;cursor: pointer;}

    .cookie-selected{border: 1px solid #f3de47;}

    @media (max-width: 992px)
    {
        .trending
        {
            margin-top: 30px;
        }

        .bottom-list
        {
            justify-content: flex-start !important;
        }

        .bottom-list li
        {
            float: none;
        }

        .wrapper2-container
        {
            justify-content: flex-start !important;
        }

        .wrapper2
        {
            width: auto !important;
        }
    }

    @media (max-width: 1200px)
    {
        #myModal1 .modal-dialog
        {
            width: 80%;
        }

        #myModal2 .modal-dialog
        {
            width: 80%;
        }
    }

    @media (max-width: 991px)
    {

        #myModal1 .modal-dialog
        {
            width: 90%;
        }

        #myModal2 .modal-dialog
        {
            width: 90%;
        }

        .ck-cont
        {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 767px)
    {
        .ck-ls
        {
            margin-top: 20px !important;
        }

        .ck-ls span{margin-left: 10px;}

        .res-ck{flex-direction: column;}

    }

    .modal-open1{
        overflow: hidden;
        padding-right: 9px;
    }

    body
    {
        padding-right: 0 !important;
    }

</style>
