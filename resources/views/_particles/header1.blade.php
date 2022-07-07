<div style="margin: 0 0 30px 0;padding-top: 10px;" class="row top-bar">

    <div style="display: flex;justify-content: flex-start;align-items: center;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <a href="{{url('/')}}"><h1 class="grad">Speurnet.nl</h1></a>
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

@if(Route::currentRouteName() != 'zoekhet' && Route::currentRouteName() != 'vactury')

    <nav style="border: 0;min-height: auto;" class="navbar navbar-default navbar-fixed-top mobile-nav" role="navigation">
        <div class="container container-header">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div style="min-height: auto;" class="navbar-header">

                <button style="border-color: #ddd;float: left;margin-left: 20px;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
                    <span class="sr-only">Toggle navigation</span>
                    <span style="background-color: #888;" class="icon-bar"></span>
                    <span style="background-color: #888;" class="icon-bar"></span>
                    <span style="background-color: #888;" class="icon-bar"></span>
                </button>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-top" style="margin: 0;padding: 0;">

                <button style="border: 0;position: absolute;right: 15px;z-index: 10000;margin-top: 0;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top" aria-expanded="true">
                    <i class="fa fa-close"></i>
                </button>

                <ul style="margin: 0;border-bottom: 1px solid #eaeaea;padding-bottom: 30px;" class="nav navbar-nav navbar-right">

                    <li id="wrap">
                        <form style="display: flex;align-items: center;margin: 20px 0;" action="" autocomplete="on">
                            <input class="search-btn" id="search_submit" value="Rechercher" type="submit">
                            <input class="search-bar" id="search" name="search" type="text" placeholder="What're we looking for ?">
                        </form>

                        @if(Route::currentRouteName() != 'blogs')

                            <div>
                                <div>
                                    <label>Jouw stad, provincie of gemeente</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                        @endif

                    </li>

                </ul>

            </div><!-- /.navbar-collapse -->

        </div><!-- /.container -->
    </nav>
    <!-- end:navbar -->

    <div style="margin: 40px 0 0 0;display: flex;justify-content: flex-start;align-items: center;" class="row top-con">

        <div id="sidebar">

            <ul style="margin: 0;" data-accordion class="bx--accordion">
                <li data-accordion-item class="bx--accordion__item">

                    <button style="background-color: transparent;border: 0;border-right: 1px solid #dedede;display: flex;align-items: center;justify-content: space-between;padding: 0 30px;width: 100%;" class="bx--accordion__heading collapsed" data-toggle="collapse" data-target="#pane1">
                        <i style="margin-right: 10px;" class="fa fa-bars"></i> Category
                    </button>

                    <div style="position: absolute;z-index: 10000;" id="pane1" class="bx--accordion__content collapse">
                        <ul data-accordion class="categories">

                            @foreach($categories as $x => $key)

                                <li class="subcat"><input type="checkbox" name="category" value="{{$key->id}}" id="{{$key->heading . $x}}"><label for="{{$key->heading . $x}}">{{$key->heading}}</label></li>

                            @endforeach

                            {{-- @foreach($categories_headings as $x => $key)

                                @if(count($categories[$x]) > 0)

                                    <li><span>{{$key->heading}}</span>
                                    
                                        <ul>
                                            @foreach($categories[$x] as $temp)

                                                <li class="subcat"><input type="checkbox" name="category" value="{{$temp->id}}" id="{{$temp->title . $x}}"><label for="{{$temp->title . $x}}">{{$temp->title}}</label></li>

                                            @endforeach
                                        </ul>

                                    </li>

                                @endif

                            @endforeach

                            @foreach($without_heading_categories as $x => $key)

                                <li class="subcat"><input type="checkbox" name="category" value="{{$key->id}}" id="{{$key->title . $x}}"><label for="{{$key->title . $x}}">{{$key->title}}</label></li>

                            @endforeach --}}

                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <form class="desktop-search" style="display: flex;align-items: center;margin-left: 10px;border-right: 1px solid #dedede;" action="" autocomplete="on">
            <input class="search-btn" id="search_submit" value="Rechercher" type="submit">
            <input class="search-bar" id="search" name="search" type="text" placeholder="What're we looking for ?">
        </form>

        @if(Route::currentRouteName() != 'blogs')

            <div class="city-con" style="margin-left: 10px;margin-bottom: 40px;">
                <div class="city-box">
                    <label>Jouw stad, provincie of gemeente</label>
                    <input type="text" class="form-control">
                </div>
            </div>

        @endif

    </div>

@endif

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
            margin: 10px 0 0 0 !important;
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

        .top-bar{ /*display: none;*/ border-bottom: 1px solid #f3f3f3;padding-bottom: 30px;margin: 0 !important; }

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
