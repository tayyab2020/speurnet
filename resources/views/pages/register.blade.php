@extends("app")

@section('head_title', 'Create a new account | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

<!-- begin:content -->
    <div id="content" style="display: flex;padding: 0;">

        <div class="col-lg-7 col-md-6 col-sm-6" style="background-image: url('{{ URL::asset('assets/img/hero_bg_2.jpg') }}');background-repeat: no-repeat;background-size: cover;background-position: center;position: relative;padding: 0;"></div>
        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">

            <div class="blog-container" style="margin-bottom: 0;display: flex;">
                <div class="blog-content col-lg-10 col-md-11 col-sm-11 col-xs-10" style="background: #fff;margin: 30px auto;padding: 15px 45px 15px 45px;font-family: 'Roboto', sans-serif;border-radius: 8px;box-shadow: 0px 0px 7px 5px #efefef;">
                    <div class="blog-title" style="padding: 0;margin-bottom: 0;">
                        <h4 style="font-family: 'Roboto', sans-serif;font-weight: bold;color: #18ace5;">{{__('text.Register an account for free')}}</h4>
                        <p>{!! nl2br(e(__('text.Register description')))!!}</p>
                    </div>

                    <div class="blog-text contact" style="padding: 0;">
                        <div class="row">

                            @if(Session::has('flash_message'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    {{ Session::get('flash_message') }}
                                </div>
                            @endif
                            <div class="message">
                            <!--{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}-->
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-12">
                                {!! Form::open(array('url' => 'register','class'=>'','id'=>'registerform','role'=>'form')) !!}

                                <div class="form-group" style="margin-top: 20px;">

                                    <label for="email">Account Type</label>

                                    <div class="bulgy-radios" role="radiogroup" aria-labelledby="bulgy-radios-label" style="width: 100%;text-align: left;/*min-height: 50px;*/">

                                        <label style="margin-left: 5px;">
                                            <input type="radio" name="usertype" class="usertype" value="Agents" checked />
                                            <span class="radio"></span>
                                            <span class="label">{{__('text.Agent')}}</span>
                                        </label>

                                        <label style="margin-left: 5px;">
                                            <input type="radio" name="usertype" class="usertype" value="landlord" />
                                            <span class="radio"></span>
                                            <span class="label">{{__('text.Private Landlord')}}</span>
                                        </label>

                                        <label style="margin-left: 5px;">
                                            <input type="radio" name="usertype" class="usertype" value="Users" />
                                            <span class="radio"></span>
                                            <span class="label">{{__('text.User')}}</span>
                                        </label>

                                    </div>
                                </div>

                                <div class="form-group">

                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="fas fa-user res-icon" style="font-size: 15px;" aria-hidden="true"></i>

                                    </span>

                                        </div>

                                        <input type="text" name="name" id="name" placeholder="{{__('text.Name Contact Person')}}" data-placeholder="{{__('text.Your Name')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;" class="form-control res-inp">


                                    </div>

                                </div>

                                <div class="form-group company_name">


                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="fas fa-id-badge res-icon" style="font-size: 15px;" aria-hidden="true"></i>

                                    </span>

                                        </div>

                                        <input type="text" name="company_name" placeholder="{{__('text.Company name')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;" class="form-control res-inp">


                                    </div>

                                </div>


                                <div class="form-group">

                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="far fa-envelope res-icon" style="font-size: 15px;" aria-hidden="true"></i>

                                    </span>

                                        </div>

                                        <input type="email" class="form-control res-inp" name="email" id="email" placeholder="{{__('text.Email Address')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;">

                                    </div>

                                </div>


                                <div class="form-group">


                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="fas fa-unlock-alt res-icon" style="font-size: 15px;" aria-hidden="true"></i>

                                    </span>

                                        </div>

                                        <input type="password" class="form-control res-inp" name="password" id="password" placeholder="{{__('text.Password')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="fas fa-unlock-alt res-icon" style="font-size: 15px;" aria-hidden="true"></i>

                                    </span>

                                        </div>

                                        <input type="password" class="form-control res-inp" name="password_confirmation" id="password_confirmation" placeholder="{{__('text.Confirm Password')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;">

                                    </div>

                                </div>


                                <div class="form-group">


                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="fas fa-phone res-icon" style="font-size: 15px;" aria-hidden="true"></i>

                                    </span>

                                        </div>

                                        <input type="text" class="form-control res-inp" name="phone" id="phone" placeholder="{{__('text.Mobile No')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;">

                                    </div>

                                </div>


                                <div class="form-group">


                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="fas fa-map-marker-alt res-icon" style="font-size: 15px;" aria-hidden="true"></i>

                                    </span>

                                        </div>

                                        <input type="text" class="form-control res-inp" autocomplete="off" name="city" id="city-input" placeholder="{{__('text.Place of establishment')}}" data-placeholder="{{__('text.Residence')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;">

                                    </div>

                                </div>

                                <div class="form-group" style="margin: 15px 0px 15px 5px;">

                                    <input name="terms" value="1" type="checkbox" required id="terms" style="position: relative;top: 2px;display: block;height: 0px;">

                                    <label class="bg" for="terms" style="margin: 0;font-weight: 500;">

                                        <span class="search-span" style="position: relative;top: 2px;font-size: 11px;color: #6b6e80;">{{__('text.I agree to the')}} <a href="{{ URL::asset('assets/terms-and-conditions-template.pdf') }}" style="display: inline-flex;" target="_blank">{{__('text.Terms of Conditions')}}</a>&nbsp;{{__('text.and')}}&nbsp;<a href="{{ URL::asset('assets/privacy_policy.pdf') }}" style="text-transform: lowercase;" target="_blank">{{__('text.Privacy Policy')}}</a></span>

                                    </label>

                                </div>

                                <div class="form-group checkbox" style="margin-top: 30px;">

                                    <p style="margin-left: 3px;margin-bottom: 0;">{{__('text.Already have account?')}} <a href="{{ URL::to('login') }}">{{__('text.Sign in here')}}</a></p>

                                    <a href="redirect/facebook" class="social-button" id="facebook-connect"> <span>{{__('text.Sign in with Facebook')}}</span></a>


                                    <a href="redirect/google" class="social-button" id="google-connect"> <span>{{__('text.Sign in with Google')}}</span></a>


                                </div>


                                <div class="form-group" style="margin: 15px 0px;">
                                    <button style="width: 100%;background-color: #3f9dca;border-color: #3f9dca;outline: none;font-size: 16px;white-space: break-spaces;" type="submit" name="submit" class="btn btn-warning">{{__('text.Sign Up Account')}}</button>
                                </div>


                                {!! Form::close() !!} <br>
                            </div>

                        </div>
                    </div>



                </div>
            </div>

        </div>


    </div>
    <!-- end:content -->

    <style>

        @media (max-width: 500px)
        {
            .res-icon
            {
                font-size: 17px !important;
            }

            .icon-con
            {
                width: 20% !important;
            }

            .res-inp
            {
                width: 80% !important;
            }

            .blog-content
            {
                padding: 30px 30px 30px 30px !important;
            }
        }

        .social-button {
            font-size: 11px;
            background-position: 25px 0px;
            box-sizing: border-box;
            color: rgb(255, 255, 255);
            cursor: pointer;
            display: inline-block;
            height: 30px;
            line-height: 30px;
            text-align: left;
            text-decoration: none;
            text-transform: uppercase;
            vertical-align: middle;
            width: 100%;
            border-radius: 3px;
            margin: 10px auto;
            outline: rgb(255, 255, 255) none 0px;
            padding-left: 33%;
            transition: all 0.2s cubic-bezier(0.72, 0.01, 0.56, 1) 0s;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        @media (max-width: 600px)
        {
            .social-button
            {
                padding-left: 22%;
                font-size: 9px;
            }
            .btn-warning
            {
                font-size: 11px !important;
            }
        }

        #facebook-connect {
            background: rgb(255, 255, 255) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/facebook.svg?sanitize=true') no-repeat scroll 5px 3px / 23px 25px padding-box border-box;
            border: 1px solid rgb(60, 90, 154);
        }

        #facebook-connect:hover {
            border-color: rgb(60, 90, 154);
            background: rgb(60, 90, 154) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/facebook-white.svg?sanitize=true') no-repeat scroll 5px 3px / 23px 25px padding-box border-box;
            -webkit-transition: all .8s ease-out;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease-out;
        }

        #facebook-connect span {
            box-sizing: border-box;
            color: rgb(60, 90, 154);
            cursor: pointer;
            text-align: center;
            text-transform: uppercase;
            border: 0px none rgb(255, 255, 255);
            outline: rgb(255, 255, 255) none 0px;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        #facebook-connect:hover span {
            color: #FFF;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        #google-connect {
            background: rgb(255, 255, 255) url('https://i.pinimg.com/originals/39/21/6d/39216d73519bca962bd4a01f3e8f4a4b.png') no-repeat scroll 7px 0px / 30px 50px padding-box border-box;
            border: 1px solid #a30d0d;
            background-size: 25px;
            background-position-y: 2px;
        }

        #google-connect:hover {
            border-color: #dddddd;
            background: #fcfcfc url('https://i.pinimg.com/originals/39/21/6d/39216d73519bca962bd4a01f3e8f4a4b.png') no-repeat scroll 7px 0px / 30px 50px padding-box border-box;
            background-size: 25px;
            background-position-y: 2px;
            -webkit-transition: all .8s ease-out;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease-out;
        }

        #google-connect span {
            box-sizing: border-box;
            color: #a30d0d;
            cursor: pointer;
            text-align: center;
            text-transform: uppercase;
            border: 0px none rgb(255, 255, 255);
            outline: rgb(255, 255, 255) none 0px;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        #google-connect:hover span {
            color: #010101;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }


        #content
        {
            background: #f8f8f8;
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
            top: 0;
            left: 0;
            height: 12px;
            width: 12px;
            min-height: 0px;
            background: #c9ded6;
            border-radius: 50%;
        }
        .radio::after {
            content: '';
            position: absolute;
            opacity: 0;
            top: 3px;
            left: 3px;
            width: 6px;
            height: 6px;
            border-radius: 100%;
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

        /* Shared */
        .loginBtn {
            box-sizing: border-box;
            position: relative;
            /* width: 13em;  - apply for fixed size */
            margin: 0.2em;
            padding: 0 15px 0 46px;
            border: none;
            text-align: left;
            line-height: 34px;
            white-space: nowrap;
            border-radius: 0.2em;
            font-size: 16px;
            color: #FFF;
        }
        .loginBtn:before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            top: 0;
            left: 0;
            width: 34px;
            height: 100%;
        }
        .loginBtn:focus {
            outline: none;
        }
        .loginBtn:active {
            box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
        }


        /* Facebook */
        .loginBtn--facebook {
            background-color: #4C69BA;
            background-image: linear-gradient(#4C69BA, #3B55A0);
            /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
            text-shadow: 0 -1px 0 #354C8C;
        }
        .loginBtn--facebook:before {
            border-right: #364e92 1px solid;
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
        }
        .loginBtn--facebook:hover,
        .loginBtn--facebook:focus {
            background-color: #5B7BD5;
            background-image: linear-gradient(#5B7BD5, #4864B1);
        }


        /* Google */
        .loginBtn--google {
            /*font-family: "Roboto", Roboto, arial, sans-serif;*/
            background: #DD4B39;
        }
        .loginBtn--google:before {
            border-right: #BB3F30 1px solid;
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
        }
        .loginBtn--google:hover,
        .loginBtn--google:focus {
            background: #E74B37;
        }

    </style>


<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

    <script>

        $( document ).ready(function() {

            $('input[type=radio][name=usertype]').change(function() {

                var type = $(this).val();

                if(type == 'Agents' || type == 'landlord')
                {

                }
                else
                {
                    $(".res-inp").each(function() {

                        var placeholder = $(this).attr('placeholder');
                        var new_placeholder = $(this).data('placeholder');

                        $(this).attr("placeholder", new_placeholder);
                        $(this).data("placeholder", placeholder);
                    });
                }

            });

            $('#city-input').on('keyup keypress', function(e) {

                var keyCode = e.keyCode || e.which;

                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }



                const locationInputs = $(this);


                var options = {

                    componentRestrictions: {country: "nl"}

                };

                const autocompletes = [];
                const geocoder = new google.maps.Geocoder;

                for (let i = 0; i < locationInputs.length; i++) {

                    const input = locationInputs[i];
                    const fieldKey = input.id.replace("-input", "");



                    const autocomplete = new google.maps.places.Autocomplete(input,options);
                    autocomplete.key = fieldKey;
                    autocompletes.push({input: input, autocomplete: autocomplete});
                }

                for (let i = 0; i < autocompletes.length; i++) {

                    const input = autocompletes[i].input;
                    const autocomplete = autocompletes[i].autocomplete;


                    google.maps.event.addListener(autocomplete, 'place_changed', function () {

                        const place = autocomplete.getPlace();

                        geocoder.geocode({'placeId': place.place_id}, function (results, status) {



                            if (status === google.maps.GeocoderStatus.OK) {

                                if (results[0]) {

                                    const lat = results[0].geometry.location.lat();
                                    const lng = results[0].geometry.location.lng();


                                }
                                else
                                {

                                    alert("No results found!");

                                }

                            }

                        });

                        if (!place.geometry) {
                            window.alert("No details available for input: '" + place.name + "'");
                            input.value = "";
                            return;
                        }



                    });
                }


            });

            $('.usertype').change(function() {

                if (this.value == 'Users') {
                    $('.company_name').hide();
                }
                else if (this.value == 'Agents' || this.value == 'landlord') {
                    $('.company_name').show();
                }
            });

            const labels = document.querySelectorAll('.label');
            labels.forEach(label => {
                const chars = label.textContent.split('');
                label.innerHTML = '';
                chars.forEach(char => {
                    label.innerHTML += `<span>${char === ' ' ? '&nbsp' : char}</span>`;
                });
            });

        });


    </script>

@endsection
