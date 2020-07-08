@extends("app")

@section('head_title', $agent->name .' | '.getcong('site_name') )
@section('head_description', substr(strip_tags($agent->description),0,200))
@section('head_image', asset('/upload/members/'.$agent->image_icon.'-b.jpg'))
@section('head_url', Request::url())

@section("content")


    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        <h2>{{$agent->name}}</h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                        <li><a href="{{ URL::to('agents/') }}">Agents</a></li>
                        <li class="active">{{$agent->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end:header -->
    <!-- begin:content -->
    <div id="content">
        <div class="container" style="width: 100%;">
            <div class="row mobile-row">

                <!-- begin:article -->
                <div class="col-md-9 main-content">
                    <div class="row">
                        <div class="col-md-12 single-post">
                            <ul id="myTab" class="nav nav-tabs nav-justified">
                                <li class="property-tab active"><a href="#detail" id="left-tab" data-toggle="tab"><i class="fa fa-university"></i> Property Detail</a></li>

                                <li class="contact-tab"><a href="#location" id="right-tab" data-toggle="tab"><i class="fa fa-paper-plane-o"></i> Contact</a></li>

                            </ul>

                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade in active" id="detail">

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="team-container team-dark" style="border-color: transparent;">
                                                <div class="team-image">
                                                    @if($agent->image_icon)
                                                        <img src="{{ URL::asset('upload/members/'.$agent->image_icon.'-b.jpg') }}" alt="{{$agent->name}}">
                                                    @else
                                                        <img src="{{ URL::asset('assets/img/team03.jpg') }}" alt="{{$agent->name}}">
                                                    @endif
                                                </div>
                                                <div class="team-description">
                                                    <h3><a style="color: white;" href="{{URL::to('agents/')}}">{{$agent->name}}</a></h3>
                                                    <p><i class="fa fa-phone"></i> Office : {{$agent->phone}}<br></p>
                                                    <p><i class="fa fa-envelope"></i>&nbsp Email : {{$agent->email}}</p>
                                                    <p>{{$agent->about}}</p>


                                                    <div class="team-social">
                                                        <span><a href="{{$agent->twitter}}" title="Twitter" rel="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a></span>
                                                        <span><a href="{{$agent->facebook}}" title="Facebook" rel="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a></span>
                                                        <span><a href="{{$agent->gplus}}" title="Google Plus" rel="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a></span>
                                                        <span><a href="{{$agent->linkedin}}" title="LinkedIn" rel="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- break -->
                                <div class="tab-pane fade" id="location">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Contact </h3>
                                        </div>
                                    </div>
                                    <div class="row" style="display:inline-block;width: 100%;margin: 0;">
                                        @if($agent->address_latitude != '' && $agent->address_longitude != '' && $agent->address != '')

                                            <input type="hidden" id="agent_map_check" value="1" >

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                                <h3>Location of Agent:</h3>

                                                <input type="hidden" name="agent_latitude" id="agent_latitude" value="{{$agent->address_latitude}}" />
                                                <input type="hidden" name="agent_longitude" id="agent_longitude" value="{{$agent->address_longitude}}" />
                                                <input type="hidden" name="agent_address" id="agent_address" value="{{$agent->address}}" />

                                                <div id="agent-map-container" style="width:100%;height:400px; ">
                                                    <div style="width: 100%; height: 100%" id="agent-map"></div>
                                                </div>

                                            </div>

                                        @else

                                            <input type="hidden" id="agent_map_check" value="0" >

                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:article -->

            </div>

        </div>


    </div>
    <!-- end:content -->

    @if (count($errors) > 0 or Session::has('flash_message'))
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>


        <script type="text/javascript">
            $(window).load(function(){
                $('#modal-error').modal('show');
            });


        </script>
    @endif

    <style>

        .sidebar .widget, .apus-sidebar .widget{margin:0 0 30px;padding:15px;background:#fff;border:1px solid #ebebeb;border-radius:6px;-webkit-border-radius:6px;-moz-border-radius:6px;-ms-border-radius:6px;-o-border-radius:6px}

        .widget .widget-title, .widget .widgettitle, .widget .widget-heading{font-size:22px;margin:0 0 15px}

        .agent-content-wrapper .agent-thumbnail{border: 1px solid lightgrey;width:70px;height:70px;overflow:hidden;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;display:-webkit-box;display:-webkit-flex;display:-moz-flex;display:-ms-flexbox;display:flex;align-items:center;-webkit-align-items:center}

        .agent-content-wrapper .agent-content{padding-left: 20px;width: calc(100% - 70px);}

        .agent-content-wrapper{margin-bottom: 30px;}

        .button{position: relative;color: #fff;background-color: #ff5a5f;border-color: #ff5a5f;outline: none;display: block;width: 100%;margin-bottom:0;text-align:center;vertical-align:middle;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap;letter-spacing:0;padding:12px 30px;font-size:14px;line-height:1.75;border-radius:6px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-transition:all 0.3s ease-in-out 0s;-o-transition:all 0.3s ease-in-out 0s;transition:all 0.3s ease-in-out 0s}

        .button:hover, .button:focus{background-color: #ff272e;border-color: #ff272e;color: white;}

        #myTab li a{background-color: white;color: black;border: 1px solid lightgrey;}

        #myTab > .active > a{background-color: black;color: white;}

        @media (max-width: 480px){

            .request{text-align: center !important;}

            .request button{width: 100%;}


        }

        @media (max-width: 1200px){

            #heart{font-size: 13px !important;}

        }

        @media (min-width: 1200px){

            .sidebar-property{margin-top: 858px;}

            .sidebar .widget, .apus-sidebar .widget{padding:30px}

            .widget .widget-title, .widget .widgettitle, .widget .widget-heading
            {
                margin: 0 0 25px;
            }

            .agent-content-wrapper .agent-thumbnail{width: 90px;height: 90px;}

            .agent-content-wrapper .agent-content{width: calc(100% - 90px);}

            .contact-form-agent .btn{font-size: 16px;padding: 10px 30px;}
        }

        @media (max-width: 1200px) {

            .sidebar-property {
                margin-top: 830px;
            }
        }

        @media (max-width: 991px) {

            .sidebar-property {
                margin-top: 0px;
            }
        }

        aside{display: block;}

        .widget{margin-bottom:30px;position:relative;padding:0px;background:transparent}

        .flex-middle{display:-webkit-flex;-webkit-align-items:center;display:flex;align-items:center}

        .image-wrapper{max-height: 100%;}

        .agent-content-wrapper
        h3{margin:0;font-size:16px;font-weight:700}

        .agent-content-wrapper
        h3 a{outline: none !important;color:#484848;}

        .agent-content-wrapper
        h3 a:hover{color:#48cfad;}

        .agent-content-wrapper .phone-wrapper{margin: 2px 0;}

        .contact-form-agent textarea.contact-control{height: 170px;resize: none;}

        .slick-prev:before, .slick-next:before
        {
            font-size: 35px;
        }

        .contact-control{outline: none;display:block;width:100%;height:50px;padding:12px
        30px;font-size:14px;line-height:1.75;color:#484848;background-color:#fff;background-image:none;border:1px
        solid #d8d8d8;border-radius:6px;-webkit-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out}

        .slick-prev
        {
            left: -50px;
        }

        .slick-next
        {
            right: -35px;
        }



        .bulgy-radios {
            width: 38rem;
            background: #fff;
            padding: 0rem 0 0rem 0rem;
            border-radius: 1rem;
            text-align: center;
        }
        .bulgy-radios label {
            display: inline-block;
            position: relative;
            height: 35px;
            padding-left: 20px;
            margin-bottom: 0;
            cursor: pointer;
            font-size: 25px;
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
            padding: 10px 30px 0px 0px;
            color: #0bae72;
        }
        .bulgy-radios .label span {
            line-height: 1em;
        }
        .bulgy-radios input {
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
            top: 0.2rem;
            left: 0;
            height: 15px;
            width: 15px;
            min-height: 0px;
            background: #c9ded6;
            border-radius: 50%;
        }
        .radio::after {
            content: '';
            position: absolute;
            opacity: 0;
            top: 4px;
            left: 4px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #fff;
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


        .modal-dialog-centered
        {
            display: flex;
            display: -webkit-box;
            display: -ms-flexbox;
            -webkit-box-align:center;
            -ms-flex-align: center;
            align-items: center;
            min-height: calc(100% - (.5rem * 2));
        }

        @media (min-width: 768px)
        {
            .modal-dialog
            {
                width: 500px;
            }
        }

        @media (min-width: 576px)
        {
            .modal-dialog-centered{
                min-height: calc(100% - (1.75rem * 2));
            }
        }

        .dropdown-menu{ position:absolute;top:100%;left:0;z-index:1000;display:none;
            float:left;min-width:160px;padding:5px 0;margin:2px 0 0;font-size:14px;
            text-align:left;list-style:none;background-color:#48cfad;-webkit-background-clip:padding-box;
            background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,.15);
            border-radius:4px;-webkit-box-shadow:0 6px 12px rgba(0,0,0,.175);
            box-shadow:0 6px 12px rgba(0,0,0,.175) }


        .carousel-inner, #player-window{
            height: 180px;
        }

        @media (min-width: 700px)
        {

            .carousel-inner, #player-window
            {
                height: 500px;
            }

        }

        #map-second-row
        {
            height: 385px;
        }

        @media (min-width: 700px)
        {

            #map-box
            {
                height: 500px;
            }

            #map-first-row
            {
                height: 20%;
            }

            #map-second-row
            {
                height: 80%;
            }

        }

        .carousel-inner > .item
        {
            height: 100%;
        }

        #slider-property .carousel-inner .item img
        {
            height: 100%;
        }


        #map {
            height: 100%;
            background-color: grey;
        }

        .box {
            width: 150px;
            height: 75px;
            background-color: transparent;
            border-right: 1px solid #e3e3e3;
        }
        .box a {
            color: #461e52;
            display: block;
            width: 100%;
            height: 100%;
            font-size: 16px;
            font-weight: 700;
            padding: 10% 0px 0 0px;
            text-align: center;
            transition: none;
            line-height: 1;
            font-family: 'Open Sans Condensed', Arial, Verdana, sans-serif;
            outline: none;
        }
        .box:hover{
            background-color: #461e52;
            cursor: pointer;
        }

        .background-active{
            background-color: #461e52;
        }

        .background-active a{
            color:#fff;
            text-decoration:none;
        }


        .box:hover a{
            color:#fff;
            text-decoration:none;
        }
        .mission-next-arrow {
            position: absolute;
            background: url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/nextarrow2.png) no-repeat center;
            background-size: contain;
            top: 50%;
            transform: translateY(-50%);
            right: 10%;
            height: 17px;
            width: 10px;
            border:none;
            outline: none;
        }
        .mission-next-arrow:hover {
            cursor: pointer;
        }
        .mission-prev-arrow {
            background: url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/prevarrow2.png) no-repeat center;
            background-size: contain;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10%;
            height: 17px;
            width: 10px;
            border:none;
            outline: none;
        }
        .mission-prev-arrow:hover {
            cursor: pointer;
        }
        .box a.more-links {
            color: #fff;
            padding: 70px 110px 0 20px;
            background: #a89269 url(https://raw.githubusercontent.com/solodev/icon-box-slider/master/rightarrow.png) no-repeat 155px 170px;
        }

        .slick-list
        {
            width: 75%;
            margin: auto;
        }

        .similarProperties .slick-list
        {
            padding-top: 25px !important;
        }

        @media (max-width: 995px)
        {
            .similarProperties .slick-list
            {
                width: 100%;
            }

        }

        .slick-slide
        {
            outline: none;
        }

        #myTab li{display: block;}

        @media (min-width: 768px)
        {
            #myTab li{display: table-cell;}
        }

        @media (max-width: 479px){
            .box{
                height: 65px;
            }

            .box a{
                font-size: 12px;
                padding: 23% 0px 0 0px;
            }

            .box a i{
                font-size: 13px !important;
            }

            #panel{
                top: 20% !important;
            }
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>


    <script>

        $( document ).ready(function() {


            let pos;
            let map;
            let bounds;
            let infoWindow;
            let currentInfoWindow;
            let service;
            let infoPane;
            var markers = new Array();
            var type = $('#type').val();




            let pos1;
            let map1;
            let bounds1;
            let infoWindow1;
            let currentInfoWindow1;
            let service1;
            let infoPane1;


            let pos2;
            let bounds2;
            let infoWindow2;
            let currentInfoWindow2;
            let service2;
            let infoPane2;


            function agent_initMap() {
                // Initialize variables
                bounds1 = new google.maps.LatLngBounds();
                infoWindow1 = new google.maps.InfoWindow;
                currentInfoWindow1 = infoWindow1;
                /* TODO: Step 4A3: Add a generic sidebar */
                agent_handleLocationError(false, infoWindow1,type);
            }



            var agent_map_check = $('#agent_map_check').val();

            if(agent_map_check == 1)
            {
                agent_initMap();
            }



            function agent_handleLocationError(browserHasGeolocation1, infoWindow1, type1) {


                var lat1 = parseFloat(document.getElementById('agent_latitude').value);
                var lng1 = parseFloat(document.getElementById('agent_longitude').value);

                pos1 = { lat: lat1, lng: lng1 };

                map1 = new google.maps.Map(document.getElementById('agent-map'), {
                    center: pos1,
                    zoom: 15
                });

                var base_url1 = window.location.origin;

                var home_icon1 = base_url1 + '/assets/img/home_pin.png';

                const marker1 = new google.maps.Marker({
                    map: map1,
                    position: {lat: lat1, lng: lng1},
                    draggable: false,
                    icon: {url:home_icon1, scaledSize: new google.maps.Size(40, 45)}
                });


                marker1.addListener('click', function() {

                    var location1 = $('#agent_address').val();

                    infoWindow1.setContent(location1);
                    infoWindow1.open(map1, marker1);
                    map1.setZoom(15);
                    map1.setCenter(marker1.getPosition());

                });

                // Display an InfoWindow at the map center
                infoWindow1.setPosition(pos1);
                /*infoWindow.setContent(browserHasGeolocation ?
                    'Geolocation permissions denied. Using default location.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);*/
                currentInfoWindow1 = infoWindow1;

                // Call Places Nearby Search on the default location
                // getNearbyPlaces(pos,type);
            }



        });

    </script>

@endsection
