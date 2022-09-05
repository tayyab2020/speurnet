@extends("app")

@section("content")

    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div style="margin: 0;" class="row">

        <div style="padding: 0;" class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

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

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 30px;">

                            <ul style="display:flex;align-items: flex-end;position: relative;padding-bottom: 10px;" class="nav nav-tabs res-ul">

                            <span class="res-span" style="display: inline-block;width: 60%;margin-right: 30px;">
                                <h4 class="res-head">Benieuwd naar de nieuwste woontrends?</h4>
                                <p style="margin: 0;">Waarom alle interieurwinkels en woontrends websites afgaan als Zoekjehuisje.nl de allerlaatste woontrends voor jou heeft verzameld, zodat je alle trends in wonen en tuin online kunt bekijken. Heb je binnenkort een nieuwe woning of ben je gewoon toe om je interieur of tuin een nieuwe look te geven volgens de nieuwe trends van 2021? Bekijk hier alle interieurtips en trends voor jouw woonkamer, slaapkamer, keuken of tuin. Laat je inspireren en bepaal zelf welke woontrend of stijl in jouw interieur past. Jouw woning is de laatste woontrend waard.</p>
                            </span>

                            <div class="bse">

                                <form id="search_form" method="GET" action="">
                                    <input autocomplete="off" name="search" type="search">
                                    <i id="form-submit" style="display: flex;justify-content: center;align-items: center;" class="fa fa-search search-icon"></i>
                                </form>

                            </div>

                            </ul>

                        </div>

                        <div style="margin: 0;border-bottom: 1px solid #e0e0e0;padding-bottom: 20px;" class="row">

                            <div style="padding: 0;" class="wrap centre col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
                                <div class="radio">
                                    <input id="check" type="radio" name="check" value="check">
                                    <label for="check">Lampen</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check1" type="radio" name="check" value="check">
                                    <label for="check1">Auto's</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check2" type="radio" name="check" value="check">
                                    <label for="check2">Tuinmeubels en meer</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check3" type="radio" name="check" value="check">
                                    <label for="check3">Meubels</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check4" type="radio" name="check" value="check">
                                    <label for="check4">Keukenspullen</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check5" type="radio" name="check" value="check">
                                    <label for="check5">Babyspullen</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check6" type="radio" name="check" value="check">
                                    <label for="check6">Vloeren</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check7" type="radio" name="check" value="check">
                                    <label for="check7">Verf en behang</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check8" type="radio" name="check" value="check">
                                    <label for="check8">Gordijnen & Shutters</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check9" type="radio" name="check" value="check">
                                    <label for="check9">Elekronica (o.a tv/mobiel)</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check10" type="radio" name="check" value="check">
                                    <label for="check10">Badkamers</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check11" type="radio" name="check" value="check">
                                    <label for="check11">Sportkelding</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check12" type="radio" name="check" value="check">
                                    <label for="check12">Keukens</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check13" type="radio" name="check" value="check">
                                    <label for="check13">Kostuumzaken</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check14" type="radio" name="check" value="check">
                                    <label for="check14">Fietsen</label>
                                </div>
            
                                <div class="radio">
                                    <input id="check15" type="radio" name="check" value="check">
                                    <label for="check15">Bedden en matrassen</label>
                                </div>
            
                            </div>
            
                        </div>
            
                        <div style="padding: 30px 0;border-bottom: 1px solid #ddd;margin: 0;">
            
                            <ul style="display:flex;align-items: flex-end;flex-wrap: wrap;" class="nav nav-tabs res-ul">
            
                                <li>
                                    <input checked id="province1" type="checkbox" name="provinces[]" value="1">
                                    <label style="cursor: pointer;" class="res-tab" for="province1">Bedden en matrassen</label>
                                </li>
                                <li>
                                    <input id="province2" type="checkbox" name="provinces[]" value="0">
                                    <label style="cursor: pointer;" class="res-tab" for="province2">Buitenshuis</label>
                                </li>
            
                            </ul>
            
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="row company-boxes">

                                @php

                                    $backgrounds = array("#F5DEF3","#C2EEEB","#DAF4D9","#F4E4BD","#F7D5D9","#F5DEF3");

                                @endphp

                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 sub">
                                    <h1 style="font-size: 20px;" class="grad">Auto</h1>
                                    <div style="background-color: {{$backgrounds[array_rand($backgrounds)]}};" class="row">
                                        <a href="">KwikMlt</a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 sub">
                                    <h1 style="font-size: 20px;" class="grad">Vacatures</h1>
                                    <div style="background-color: {{$backgrounds[array_rand($backgrounds)]}};" class="row">
                                        <a href="">Schoonmaak</a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 sub">
                                    <h1 style="font-size: 20px;" class="grad">Auto</h1>
                                    <div style="background-color: {{$backgrounds[array_rand($backgrounds)]}};" class="row">
                                        <a href="">KwikMlt</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- end:latest -->

                </div>

            </div>
            <!-- end:content -->

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            @if(count($content))

                <div style="margin: 0;" class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex;padding: 0;">

                        <div style="margin: 0;padding: 0;" data-testid="key-services" class="css-htlmaj col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <div class="domain-home_ down is-visible">

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

                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

    <style>

        .nav-tabs > li
        {
            margin: 5px 10px;
        }

        .nav-tabs > li > label
        {
            line-height: 1.42857143;
            margin-right: 2px;
            border-radius: 4px 4px 0 0;
            position: relative;
            display: block;
            padding: 5px 0;
            border-bottom: 3px solid transparent;
            font-weight: 400;;
        }

        .nav-tabs > li > label:hover
        {
            border-color: #eee #eee #ddd;
        }

        .nav > li > label:hover, .nav > li > label:focus
        {
            text-decoration: none;
            background-color: #eee;
        }

        .nav-tabs
        {
            border-bottom: 0;
        }

        ul.ks-cboxtags {
            list-style: none;
            padding: 20px;
        }
        ul.ks-cboxtags li{
            display: inline;
        }
        ul.ks-cboxtags li label{
            display: inline-block;
            background-color: rgba(255, 255, 255, .9);
            border: 2px solid rgba(139, 139, 139, .3);
            color: #adadad;
            border-radius: 25px;
            white-space: nowrap;
            margin: 3px 0px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            transition: all .2s;
        }

        ul.ks-cboxtags li label {
            padding: 8px 12px;
            cursor: pointer;
        }

        ul.ks-cboxtags li label::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 12px;
            width: 20px;
            height: 28px;
            padding: 2px 6px 2px 2px;
            content: "\f067";
            transition: transform .3s ease-in-out;
        }

        ul.ks-cboxtags li input[type="radio"]:checked + label::before {
            content: "\f00c";
            transform: rotate(-360deg);
            transition: transform .3s ease-in-out;
        }

        ul.ks-cboxtags li input[type="radio"]:checked + label {
            border: 2px solid #1bdbf8;
            background-color: #12bbd4;
            color: #fff;
            transition: all .2s;
        }

        ul.ks-cboxtags li input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        ul.ks-cboxtags li input[type="radio"]:focus + label {
            border: 2px solid #e9a1ff;
        }

        @media (min-width: 769px)
        {
            .bse
            {
                width: 40%;
            }
        }

        @media (max-width: 768px)
        {
            .res-ul
            {
                display: block !important;
                position: relative;
            }

            .res-span
            {
                width: 100% !important;
                margin-right: 0 !important;
                margin-bottom: 20px;
            }

            #search_form
            {
                bottom: 3px;
                margin-bottom: 0 !important;
            }

            .res-head
            {
                font-size: 14px;
            }
        }

        #search_form{
            position: relative;
            right: 0;
            float: right;
            transform: translate(0%,0%);
            transition: all 1s;
            width: 50px;
            height: 50px;
            background: white;
            box-sizing: border-box;
            border-radius: 25px;
            border: 4px solid #b8b8b870;
            padding: 5px;
            margin: 0;
        }

        input{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;;
            height: 42.5px;
            line-height: 30px;
            outline: 0;
            border: 0;
            display: none;
            font-size: 1em;
            border-radius: 20px;
            padding: 0 20px;
        }

        .search-icon{
            box-sizing: border-box;
            padding: 10px;
            width: 42.5px;
            height: 42.5px;
            position: absolute;
            top: 0;
            right: 0;
            border-radius: 50%;
            color: #07051a;
            text-align: center;
            font-size: 1.2em;
            transition: all 1s;
        }

        .fas{display:inline-block;font-family:FontAwesome;font-style:normal;font-weight:normal;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}

        #search_form:hover{
            width: 200px;
            cursor: pointer;
        }

        #search_form:hover input{
            display: block;
        }

        #search_form:hover .fa{
            background: #07051a;
            color: white;
        }

        #overlay{
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height:100%;
            display: none;
            background: rgba(0,0,0,0.6);
        }
        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }
        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }
        .is-hide{
            display:none;
        }

        @media (min-width: 1200px)
        {
            .res-float:nth-child(4n+1) {
                padding-left: 0;
            }

            .res-float:nth-child(4n+4) {
                padding-right: 0;
            }
        }

        @media (max-width: 1199px) and (min-width: 993px)
        {
            .res-float:nth-child(3n+1) {
                padding-left: 0;
            }

            .res-float:nth-child(3n+3) {
                padding-right: 0;
            }
        }

        @media (max-width: 992px) and (min-width: 768px)
        {
            .res-float:nth-child(2n) {
                padding-right: 0;
            }

            .res-float:nth-child(2n+1) {
                padding-left: 0;
            }
        }

        .res-ul li input:checked + label
        {
            background-color: transparent;
            border: 0;
            border-bottom: 3px solid #E42F8B !important;
            color: #555;
            font-weight: 600;
        }

        .new-button{border:0 !important;background-color: transparent;padding: 0;}

        .fas{display:inline-block;font-family:FontAwesome;font-style:normal;font-weight:normal;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}

        @media (min-width: 992px)
        {
            .post_img img
            {
                width: 80% !important;
                height: 500px !important;
                margin: auto;
                display: block;
            }
        }

        .post_img img
        {
            height: 300px;
        }

        @media (max-width: 767px)
        {
            .res-float
            {
                float: none;
            }

            .radio
            {
                width: 45% !important;
            }
        }

        .wrap
        {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .radio
        {
            display: inline-block;
            margin: 10px !important;
            min-width: 20%;
            width: 30%;
        }

        .radio label {
            font-size: 24px;
            color: #bfbfbf;
            display: inline-block;
            padding: 0 0 0 1em;
            padding-left: 30px;
            cursor: pointer;
            word-break: break-word;
        }
        .radio label:before {
            content: '';
            display: inline-block;
            background: #55D8C6;
            position: absolute;
            left: 0;
            top: 3px;
            height: 20px;
            width: 20px;
            margin-right: 10px;
            border-radius: 0;
            box-shadow: 0px 0px 2px 0px rgb(0 0 0 / 20%);
            box-sizing: border-box;
            border: 10px solid #fff;
            transition: border .3s ease;
        }

        .radio input:checked + label:before {
            border-color: #fff;
            border-width: 3px;
        }

        .radio input + label {
            transition: color .7s ease;
        }

        .radio input:checked + label {
            color: #5D5D5D;
        }

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
            justify-content: flex-start;
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
            align-items: center;
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

    <script>

        $(".radio input:radio").change( function(){

            var val = $(this).val();

            $('.company-boxes').children().remove();

            $("#overlay").fadeIn(300);

            const backgrounds = ["#F5DEF3","#C2EEEB","#DAF4D9","#F4E4BD","#F7D5D9","#F5DEF3"];

            setTimeout(function(){

                $("#overlay").fadeOut(300);

                $('.company-boxes').append('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 sub">\n' +
                    '                                    <h1 style="font-size: 20px;" class="grad">Auto</h1>\n' +
                    '                                    <div style="background-color: '+backgrounds[Math.floor(Math.random() * backgrounds.length)]+';" class="row">\n' +
                    '                                        <a href="">KwikMlt</a>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '\n' +
                    '                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 sub">\n' +
                    '                                    <h1 style="font-size: 20px;" class="grad">Vacatures</h1>\n' +
                    '                                    <div style="background-color: '+backgrounds[Math.floor(Math.random() * backgrounds.length)]+';" class="row">\n' +
                    '                                        <a href="">Schoonmaak</a>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '\n' +
                    '                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 sub">\n' +
                    '                                    <h1 style="font-size: 20px;" class="grad">Auto</h1>\n' +
                    '                                    <div style="background-color: '+backgrounds[Math.floor(Math.random() * backgrounds.length)]+';" class="row">\n' +
                    '                                        <a href="">KwikMlt</a>\n' +
                    '                                    </div>\n' +
                    '                                </div>');
            },500);

        });

    </script>

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

@endsection
