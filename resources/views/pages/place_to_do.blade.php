@extends("app")

@section("content")

    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="row" style="margin: 0;">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <ul style="display:flex;align-items: flex-end;position: relative;padding-bottom: 10px;border: 0;padding-left: 15px;" class="nav nav-tabs res-ul">

                <span class="res-span" style="display: inline-block;width: 60%;margin-right: 30px;">
                    <h4 class="res-head">{{ $description ? $description->title : null}}</h4>
                    <p style="margin: 0;">{!! $description ? $description->description : null !!}</p>
                </span>

            </ul>

        </div>

    </div>

        <div style="margin: 0;" class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- begin:content -->
                <div id="content" style="padding: 0 0 20px 0;">

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

                    <input type="hidden" id="ip_address" value="{{$ip_address}}" />

                    <div class="container" style="width: 100%;">

                        <!-- begin:latest -->

                        <div class="row" style="margin: 0;">

                            <div style="padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="row company-boxes">

                                    @foreach($filters as $key)

                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 sub">
                                            <h1 style="font-size: 20px;" class="grad">{{$key->title}}</h1>
                                            <label class="row">
                                                <input style="display: none;" value="{{$key->id}}" type="radio" name="radio">
                                                <div style="width: 100%;" class="row-child">
                                                    <img style="width: 100%;height: 200px;border-radius: 10px;" src="{{$key->image ? asset('upload/'.$key->image) : asset('upload/noImage.png')}}" />
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach

                                </div>

                            </div>

                            <div style="padding: 0;border-top: 1px solid #cfcfcf;margin-top: 20px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="row company-boxes sm-bx">

                                    @foreach($places as $key)

                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 sub">
                                            <label class="row">
                                                <input style="display: none;" value="{{$key->id}}" type="radio" name="radio1">
                                                <div class="row-child">
                                                    <img style="width: 100%;height: 120px;border-radius: 10px;padding: 20px;" src="{{$key->image ? asset('upload/'.$key->image) : asset('upload/noImage.png')}}" />
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach

                                </div>

                            </div>

                            <div style="margin-top: 20px;padding: 0;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="row company-boxes company-boxes1">

                                    @foreach($content as $key)

                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 res-float">
                                            <article style="margin-bottom: 45px;">
                                                <div class="property-container" style="margin: 0;min-height: 480px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">

                                                    <a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="">

                                                        <div class="property-image">

                                                            <img src="{{$key->image ? asset('upload/'.$key->image) : asset('upload/noImage.png') }}" style="width: 100%;height: 250px;border-top-left-radius: 3px;border-top-right-radius: 3px;">

                                                        </div>

                                                    </a>

                                                    <div class="property-content description-content">

                                                        <div style="display: flex;justify-content: space-between;">

                                                            <form action="{{ url('save-place') }}" method="POST" style="display: inline-block;">

                                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                                <input type="hidden" name="content_id" value="{{$key->id}}">

                                                                <button type="submit" class="new-button" title="" style="outline: none;">

                                                                    @if($key->savings->contains('ip', $ip_address))

                                                                        <i class="fa fa-heart heart" style="vertical-align: middle;font-size: 16px;display: flex;color: black;" aria-hidden="true">
                                                                            <span style="display: block;margin-left: 7px;">{{$key->saved}}</span>
                                                                        </i>

                                                                    @else

                                                                        <i class="far fa-heart heart" style="vertical-align: middle;font-size: 16px;display: flex;color: black;" aria-hidden="true">
                                                                            <span style="display: block;margin-left: 7px;">{{$key->saved}}</span>
                                                                        </i>

                                                                    @endif

                                                                </button>

                                                            </form>

                                                            <div style="width: 100%;display: flex;justify-content: flex-end;">

                                                                <a target="_blank" href="mailto:?subject=Deze woning heb ik gevonden op Zoekjehuisje.nl, kijk zelf maar!&amp;body=" class="new-icons" title="Delen" style="border-radius: 100px;position: relative;width: 35px !important;height: 35px !important;line-height: 0 !important;display: flex;flex-direction: column;justify-content: flex-start;text-decoration: none;">
                                                                    <i class="fas fa-share-alt" style="vertical-align: middle;margin-right: 2px;font-size: 15px;" aria-hidden="true"></i>
                                                                </a>

                                                                <i class="far fa-eye" style="vertical-align: middle;font-size: 16px;display: flex;color: #37bc9b;" aria-hidden="true">
                                                                    <span style="display: block;margin-left: 7px;">{{$key->views}}</span>
                                                                </i>

                                                            </div>

                                                        </div>

                                                        <p style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 5;-webkit-box-orient: vertical;overflow: hidden;line-height: 2;font-size: 15px;margin-top: 15px;font-weight: 600;">{!! $key->description !!}</p>

                                                    </div>
                                                </div>
                                            </article>
                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        </div>
                        <!-- end:latest -->

                    </div>

                </div>
                <!-- end:content -->

            </div>

        </div>

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>

    <style>

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

        .sm-bx .row
        {
            align-items: flex-start !important;
        }

        input[type="radio"]:checked ~ .row-child
        {
            border: 1px solid #91a9e6;
            box-shadow: 0px 0px 4px 0px #9cbedf;
        }

        [type="checkbox"]:not(:checked),
        [type="checkbox"]:checked {
            position: absolute;
            left: -9999px;
        }
        [type="checkbox"]:not(:checked) + label,
        [type="checkbox"]:checked + label {
            position: relative;
            padding-left: 1.3em;
            cursor: pointer;
            font-weight: 600;
        }

        /* checkbox aspect */
        [type="checkbox"]:not(:checked) + label:before,
        [type="checkbox"]:checked + label:before {
            content: '';
            position: absolute;
            left: 0; top: 9px;
            width: 13px; height: 13px;
            border: 1px solid #c8c8c8;
            background: #fff;
            border-radius: 2px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
        }
        /* checked mark aspect */
        [type="checkbox"]:not(:checked) + label:after,
        [type="checkbox"]:checked + label:after {
            content: '\2713\0020';
            position: absolute;
            top: 9.5px; left: 0px;
            font-size: 1.2em;
            line-height: 0.8;
            color: #00b8ef;
            transition: all .2s;
            font-family: 'Lucida Sans Unicode', 'Arial Unicode MS', Arial;
        }
        /* checked mark aspect changes */
        [type="checkbox"]:not(:checked) + label:after {
            opacity: 0;
            transform: scale(0);
        }
        [type="checkbox"]:checked + label:after {
            opacity: 1;
            transform: scale(0.7);
        }
        /* disabled checkbox */
        [type="checkbox"]:disabled:not(:checked) + label:before,
        [type="checkbox"]:disabled:checked + label:before {
            box-shadow: none;
            border-color: #bbb;
            background-color: #ddd;
        }
        [type="checkbox"]:disabled:checked + label:after {
            color: #999;
        }
        [type="checkbox"]:disabled + label {
            color: #aaa;
        }
        /* accessibility */
        /*[type="checkbox"]:checked:focus + label:before,
        [type="checkbox"]:not(:checked):focus + label:before {
            border: 2px dotted blue;
        }*/

        /* hover style just for information */
        label.bg:hover:before {
            border: 1px solid #4778d9!important;
        }

        .bulgy-radios {
            width: 38rem;
            padding: 0rem 0 0rem 0rem;
            border-radius: 1rem;
            text-align: center;
        }
        .bulgy-radios label {
            display: block;
            position: relative;
            height: 35px;
            padding-left: 20px;
            margin-bottom: 0;
            cursor: pointer;
            font-size: 18px;
            user-select: none;
            color: #555;
            letter-spacing: 1px;
        }
        .bulgy-radios label:hover input:not(:checked) ~ .radio {
            opacity: 0.8;
        }
        .bulgy-radios .label {
            display: flex;
            align-items: center;
            padding: 7px 30px 0px 10px;
            color: #0bae72;
            font-size: 20px;
        }
        .bulgy-radios .label span {
            line-height: 1em;
        }
        .bulgy-radios [type="radio"] {
            position: absolute;
            cursor: pointer;
            height: 0;
            width: 0;
            left: -2000px;
        }
        .bulgy-radios input:checked ~ .radio {
            background-color: #0ac07d;
            transition: background 0.3s;
        }
        .bulgy-radios input:checked ~ .radio::after {
            opacity: 1;
        }
        .bulgy-radios input:checked ~ .label {
            color: #0bae72;
        }
        .bulgy-radios input:checked ~ .label span {
            animation: bulge 0.75s forwards;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(1) {
            animation-delay: 0.025s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(2) {
            animation-delay: 0.05s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(3) {
            animation-delay: 0.075s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(4) {
            animation-delay: 0.1s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(5) {
            animation-delay: 0.125s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(6) {
            animation-delay: 0.15s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(7) {
            animation-delay: 0.175s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(8) {
            animation-delay: 0.2s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(9) {
            animation-delay: 0.225s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(10) {
            animation-delay: 0.25s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(11) {
            animation-delay: 0.275s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(12) {
            animation-delay: 0.3s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(13) {
            animation-delay: 0.325s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(14) {
            animation-delay: 0.35s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(15) {
            animation-delay: 0.375s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(16) {
            animation-delay: 0.4s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(17) {
            animation-delay: 0.425s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(18) {
            animation-delay: 0.45s;
        }
        .bulgy-radios input:checked ~ .label span:nth-child(19) {
            animation-delay: 0.475s;
        }
        .radio {
            position: absolute;
            top: 0;
            left: 0;
            height: 15px;
            width: 15px;
            min-height: 0px;
            background: #c9ded6;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .radio::after {
            content: '';
            position: relative;
            opacity: 0;
            width: 7px;
            height: 7px;
            border-radius: 100%;
            background: #fff;
            margin-right: 0.3px;
            margin-bottom: 0.4px;
        }
        @keyframes bulge {
            50% {
                transform: rotate(4deg);
                font-size: 1.5em;
                font-weight: bold;
            }
            100% {
                transform: rotate(0);
                font-size: 1em;
                font-weight: bold;
            }
        }

        @media (max-width: 768px)
        {
            .sm-bx .row
            {
                align-items: center !important;
            }

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

            .res-head
            {
                font-size: 14px;
            }
        }

        .fas{display:inline-block;font-family:FontAwesome;font-style:normal;font-weight:normal;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}

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

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus
        {
            background-color: transparent;
            border: 0;
            border-bottom: 3px solid #E42F8B !important;
            padding: 10px 0 !important;
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
        }

        .wrap
        {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
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
            width: 100%;
            min-height: 160px;
            padding: 0;
            margin-top: 10px;
        }

        .company-boxes .row .row-child
        {
            border-radius: 10px;
            border: 1px solid #d0d0d0;
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

        function filter1(filter,place)
        {
            $.ajax({

                type: 'POST',

                url: "<?php echo url('filter-place') ?>",

                headers: {
                    'X-CSRF-TOKEN': "<?php echo csrf_token() ?>",
                },

                data: {
                    filter: filter,
                    place: place
                },

                success: function (data) {

                    $('.company-boxes1').children().remove();

                    $("#overlay").fadeIn(300);

                    setTimeout(function(){

                        $("#overlay").fadeOut(300);

                        $.each(data, function (key, value) {

                            var flag = 0;

                            $.each(value.savings, function (key1, value1)
                            {
                                if(value1.ip == ip)
                                {
                                    flag = 1;
                                }

                            });

                            $('.company-boxes1').append('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 res-float">\n' +
                                '                            <article style="margin-bottom: 45px;">\n' +
                                '                                <div class="property-container" style="margin: 0;min-height: 480px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">\n' +
                                '\n' +
                                '                                    <a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="">\n' +
                                '\n' +
                                '                                        <div class="property-image">\n' +
                                '\n' +
                                '                                            <img src="'+ (value.image ? "upload/" + value.image : "upload/noImage.png") +'" style="width: 100%;height: 250px;border-top-left-radius: 3px;border-top-right-radius: 3px;">\n' +
                                '\n' +
                                '                                        </div>\n' +
                                '\n' +
                                '                                    </a>\n' +
                                '\n' +
                                '                                    <div class="property-content description-content">\n' +
                                '\n' +
                                '                                        <div style="display: flex;justify-content: space-between;">\n' +
                                '\n' +
                                '                                            <form action="{{ url('save-place') }}" method="POST" style="display: inline-block;">\n' +
                                '\n' +
                                '                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>\n' +
                                '\n' +
                                '                                                <input type="hidden" name="content_id" value="'+value.id+'">\n' +
                                '\n' +
                                '                                                <button type="submit" class="new-button" title="{{__("text.Add Favorite")}}" style="outline: none;">\n' +
                                '\n' +
                                (flag == 1 ? '<i class="fa fa-heart heart" style="vertical-align: middle;font-size: 16px;display: flex;color: black;" aria-hidden="true">\n' +
                                '                                                                    <span style="display: block;margin-left: 7px;">'+value.saved+'</span>\n' +
                                '                                                                </i>' : ' <i class="far fa-heart heart" style="vertical-align: middle;font-size: 16px;display: flex;color: black;" aria-hidden="true">\n' +
                                '                                                        <span style="display: block;margin-left: 7px;">'+value.saved+'</span>\n' +
                                '                                                    </i>\n') +
                                '\n' +
                                '\n' +
                                '                                                </button>\n' +
                                '\n' +
                                '                                            </form>\n' +
                                '\n' +
                                '                                            <div style="width: 100%;display: flex;justify-content: flex-end;">\n' +
                                '\n' +
                                '                                                <a target="_blank" href="mailto:?subject=&amp;body=" class="new-icons" title="{{__("text.Share")}}" style="border-radius: 100px;position: relative;width: 35px !important;height: 35px !important;line-height: 0 !important;display: flex;flex-direction: column;justify-content: flex-start;text-decoration: none;">\n' +
                                '                                                    <i class="fas fa-share-alt" style="vertical-align: middle;margin-right: 2px;font-size: 15px;"></i>\n' +
                                '                                                </a>\n' +
                                '\n' +
                                '                                                <i class="far fa-eye" style="vertical-align: middle;font-size: 16px;display: flex;color: #37bc9b;" aria-hidden="true">\n' +
                                '                                                    <span style="display: block;margin-left: 7px;">'+value.views+'</span>\n' +
                                '                                                </i>\n' +
                                '\n' +
                                '                                            </div>\n' +
                                '\n' +
                                '                                        </div>\n' +
                                '\n' +
                                value.description +
                                '\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </article>\n' +
                                '                        </div>\n');

                        });

                    },500);
                }
            });
        }

        $("[name='radio']").change( function(){

            var filter = $(this).val();
            var place = $("[name='radio1']:checked").val();
            var ip = $('#ip_address').val();

            if(filter && place)
            {
                filter1(filter,place);
            }

        });

        $("[name='radio1']").change( function(){

            var place = $(this).val();
            var filter = $("[name='radio']:checked").val();
            var ip = $('#ip_address').val();

            if(filter && place)
            {
                filter1(filter,place);
            }

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
