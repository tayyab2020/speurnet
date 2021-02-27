@extends("app")

@section('head_title', 'Login | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")

<!-- begin:content -->
    <div id="content" style="display: flex;padding: 0;">

        <div class="col-lg-7 col-md-6 col-sm-6" style="background-image: url('{{ URL::asset('assets/img/hero_bg_1.jpg') }}');background-repeat: no-repeat;background-size: cover;background-position: center;position: relative;padding: 0;"></div>

        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12" style="padding: 0;">

            <div class="blog-container" style="margin-bottom: 0;display: flex;flex-direction: column;">

                <div style="width: 85%;margin: auto;display: flex;justify-content: center;margin-top: 20px;">

                    <span class="kolibri-text" style="margin-right: 10px;">Wij zijn gekoppeld met</span>
                    <img class="kolibri-img" src="{{ URL::asset('assets/img/kolibri_logo.png') }}" style="height: 40px;float: left;" />
                    <span class="kolibri-text" style="margin-left: 10px;">CRM</span>

                </div>

                <div class="blog-content col-lg-10 col-md-11 col-sm-11 col-xs-10" style="background: #fff;margin: 40px auto;padding: 30px 45px 30px 45px;font-family: 'Roboto', sans-serif;border-radius: 8px;box-shadow: 0px 0px 7px 5px #efefef;margin-top: 5px;">
                    <div class="blog-title" style="text-align: center;padding: 0;">

                        <h3 style="font-family: 'Roboto', sans-serif;font-weight: 600;">{{__('text.Access to your account')}}</h3>
                        <h3 style="font-family: 'Roboto', sans-serif;font-weight: 600;">{{__('text.Login to Zoekjehuisje.nl')}}</h3>

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

                                <div class="form-group checkbox">

                                    <a href="redirect/facebook" class="social-button" id="facebook-connect"> <span>{{__('text.Sign in with Facebook')}}</span></a>


                                    <a href="redirect/google" class="social-button" id="google-connect"> <span>{{__('text.Sign in with Google')}}</span></a>


                                </div>

                                <h4><span>{{__('text.Or')}}</span></h4>

                                {!! Form::open(array('url' => 'login','class'=>'','id'=>'loginform','role'=>'form')) !!}


                                <div class="form-group">

                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="far fa-envelope res-icon" aria-hidden="true" style="font-size: 20px;"></i>

                                    </span>

                                        </div>

                                        <input type="email" class="form-control res-inp" name="email" id="email" placeholder="{{__('text.Enter email')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 50px;text-align: left;">

                                    </div>

                                </div>


                                <div class="form-group">

                                    <div style="width: 100%;display: flex;border: 1px solid #d7d7d7;margin: auto;background: white;">

                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">

                                    <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">

                                        <i class="fas fa-unlock-alt res-icon" aria-hidden="true" style="font-size: 20px;"></i>

                                    </span>

                                        </div>

                                        <input type="password" class="form-control res-inp" name="password" id="password" placeholder="{{__('text.Enter password')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 50px;text-align: left;">

                                    </div>

                                </div>


                                <div class="form-group checkbox" style="margin: 30px 0px;">

                                    <label style="margin-left: 3px;">
                                        <input style="position: relative;top: 1.5px;" type="checkbox" name="remember" id="checkbox1" /> {{__('text.Keep me signed in')}}
                                    </label>

                                    <a style="float: right;" href="{{ URL::to('admin/password/email') }}">{{__('text.Forgot password?')}}</a>


                                </div>


                                <div class="form-group">
                                    <button style="width: 100%;background-color: #3f9dca;border-color: #3f9dca;outline: none;font-size: 18px;" type="submit" name="submit" class="btn btn-warning">Login</button>
                                </div>

                                {!! Form::close() !!}

                                <div class="form-group checkbox" style="margin-top: 30px;">
                                    <p style="text-align: center;">{{__('text.Don\'t have account?')}} <a href="{{ URL::to('accountaanmaken') }}">{{__('text.Sign up here')}}</a>                <br/>
                                        <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #575454;"><a href="{{ URL::asset('assets/terms-and-conditions-template.pdf') }}" target="_blank">{{__('text.Terms of Services')}}</a>&nbsp;{{__('text.and')}}&nbsp;<a href="{{ URL::asset('assets/privacy_policy.pdf') }}" target="_blank">{{__('text.Privacy Policy')}}</a></span>
                                    </p>
                                </div>

                                <div style="margin-top: 25px;">

                                    <p style="font-weight: bold;font-size: 16px;">Woningen plaatsen als makelaar?</p>

                                    <p>
                                        Je bent niet voor niets een goede makelaar.
                                        <br>
                                        Plaats gratis jouw woningen binnen een paar seconden en wie weet heb je in no-time al je woningen verhuurd of verkocht.
                                        <br>
                                        Hoe mooi is dat?
                                    </p>

                                    <a target="_blank" href="{{ url('footer-pages/26') }}" class="btn btn-danger">Ik ben benieuwd</a>

                                </div>

                            </div>

                        </div>
                    </div>



                </div>
            </div>

        </div>

    </div>
    <!-- end:content -->

<style>

    .kolibri-text
    {
        float: left;
        color: #253256;
        font-size: 13px;
        align-self: flex-end;
        font-weight: 500;
    }

    @media (max-width: 500px)
    {
        .kolibri-text
        {
            font-size: 11px;
            line-height: 1.5;
        }

        .kolibri-img
        {
            height: 25px !important;
        }

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

    /*h4 {
        overflow: hidden;
        text-align: center;
        font-weight: 500;
        margin: 30px 0px;
    }

    h4:before,
    h4:after {
        background-color: #cecece;
        content: "";
        display: inline-block;
        height: 1px;
        position: relative;
        vertical-align: middle;
        width: 50%;
    }

    h4:before {
        right: 0.5em;
        margin-left: -50%;
    }

    h4:after {
        left: 0.5em;
        margin-right: -50%;
    }*/

    .social-button {
        background-position: 25px 0px;
        box-sizing: border-box;
        color: rgb(255, 255, 255);
        cursor: pointer;
        display: inline-block;
        height: 50px;
        line-height: 50px;
        text-align: left;
        text-decoration: none;
        text-transform: uppercase;
        vertical-align: middle;
        width: 100%;
        border-radius: 3px;
        margin: 10px auto;
        outline: rgb(255, 255, 255) none 0px;
        padding-left: 20%;
        transition: all 0.2s cubic-bezier(0.72, 0.01, 0.56, 1) 0s;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        -ms-transition: all .3s ease;
        -o-transition: all .3s ease;
        transition: all .3s ease;
        font-size: 17px;
    }

    #facebook-connect {
        background: rgb(255, 255, 255) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/facebook.svg?sanitize=true') no-repeat scroll 5px 0px / 30px 50px padding-box border-box;
        border: 1px solid rgb(60, 90, 154);
    }

    #facebook-connect:hover {
        border-color: rgb(60, 90, 154);
        background: rgb(60, 90, 154) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/facebook-white.svg?sanitize=true') no-repeat scroll 5px 0px / 30px 50px padding-box border-box;
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
        text-transform: none;
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
        background: rgb(255, 255, 255) url('https://i.pinimg.com/originals/39/21/6d/39216d73519bca962bd4a01f3e8f4a4b.png') no-repeat scroll 5px 0px / 30px 50px padding-box border-box;
        border: 1px solid #a30d0d;
        background-size: 35px;
        background-position-y: 7px;
    }

    #google-connect:hover {
        border-color: #dddddd;
        background: #fcfcfc url('https://i.pinimg.com/originals/39/21/6d/39216d73519bca962bd4a01f3e8f4a4b.png') no-repeat scroll 5px 0px / 30px 50px padding-box border-box;
        background-size: 35px;
        background-position-y: 7px;
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
        text-transform: none;
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

    @media (max-width: 995px)
    {
        .social-button
        {
            font-size: 13px;
        }
    }

</style>

@endsection
