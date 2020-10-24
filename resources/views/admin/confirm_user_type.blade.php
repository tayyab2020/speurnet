<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{getcong('site_name')}} Admin</title>

    <link href="{{ URL::asset('upload/'.getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />

    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/style.css') }}">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/unicons.css">

    <script src="{{ URL::asset('admin_assets/js/jquery.js') }}"></script>
    <script src="https://kit.fontawesome.com/29532268c4.js" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css" id="theme-styles">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>
<body>
<div class="container-fluid">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="position:relative;z-index: 1000;display: flex;">

    <a class="navbar-brand" href="{{ URL::to('/') }}" style="padding-right: 0px;height: auto;margin: auto;">

        @if(getcong('site_logo')) <img src="{{ URL::asset('upload/'.getcong('site_logo')) }}" style="width: 100%;" alt=""> @else {{getcong('site_name')}} @endif

    </a>
    </div>

    <div id="main" style="display: inline-block;width: 100%;">
        <div class="row">
            <div class="col-md-12">
                <div class="section over-hide z-bigger">

                    <input class="checkbox" type="checkbox" name="general" id="general" checked>
                    <label class="for-checkbox" for="general" style="display: none;"></label>

                    <div class="background-color"></div>

                    <div class="section over-hide z-bigger" style="margin-top: 20px;">
                        <div class="container pb-5">
                            <div class="row justify-content-center pb-5">

                                <form action="{{url('admin/confirm-type')}}" method="POST" role="form" id="form">

                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                <div class="col-12 pt-5">
                                    <p class="mb-4 pb-2">{{__('text.Select Account Type')}}</p>
                                </div>

                                    <div class="col-12 pb-5" style="display: flex;justify-content: space-around;margin-top: 20px;">

                                        <input class="checkbox-tools" type="radio" name="type" id="tool-1" value="Agents" >
                                        <label class="for-checkbox-tools" for="tool-1">
                                            <i class="fas fa-user-edit" style="font-size: 24px;display: block;position:relative;top: 15px;"></i>
                                            {{__('text.Agent')}}
                                        </label>

                                        <input class="checkbox-tools" type="radio" name="type" id="tool-3" value="landlord" >
                                        <label class="for-checkbox-tools" for="tool-3">
                                            <i class="fas fa-user-edit" style="font-size: 24px;display: block;position:relative;top: 15px;"></i>
                                            {{__('text.Private Landlord1')}}
                                        </label>

                                        <input class="checkbox-tools" type="radio" name="type" id="tool-2" value="Users">
                                        <label class="for-checkbox-tools" for="tool-2">
                                            <i class="fas fa-user" style="font-size: 24px;display: block;position:relative;top: 15px;"></i>
                                            {{__('text.User')}}
                                            <span style="font-size: 9px;line-height: 3;display: block;text-align: left;">{{__('text.User extra text')}}
                                        </span>
                                        </label>

                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


</div>

<script>
    $(document).ready(function(){

        $(".checkbox-tools").change(function() {



            Swal.fire({
                title: "<?php echo __('text.Are you sure?'); ?>",
                text: "<?php echo __("text.You won't be able to revert this!"); ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo __('text.Yes'); ?>',
                cancelButtonText: '<?php echo __('text.No'); ?>'
            }).then((result) => {
                if (result.value) {

                    $('#form').submit();

                }
            })
        });


        });

    </script>

<style>

    .for-checkbox-tools
    {
        display: flex !important;
        flex-direction: column;
        justify-content: center;
    }

    @media (max-width: 800px)
    {
        .pb-5
        {
            flex-direction: column;
            align-items: center;
        }

        .for-checkbox-tools
        {
            margin: 15px 0px !important;
        }
    }

    .swal2-popup
    {
        font-size: 15px;
    }


    /* Please ❤ this if you like it! */


    @import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext');


    :root {
        --white: #ffffff;
        --light: #f0eff3;
        --black: #000000;
        --dark-blue: #1f2029;
        --dark-light: #353746;
        --red: #da2c4d;
        --yellow: #f8ab37;
        --grey: #ecedf3;
    }

    /* #Primary
    ================================================== */

    body{
        width: 100%;
        overflow-x: hidden;
        background: var(--white);
        font-family: 'Poppins', sans-serif;
        font-size: 17px;
        line-height: 30px;
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    p{
        font-family: 'Poppins', sans-serif;
        font-size: 17px;
        line-height: 30px;
        color: var(--white);
        letter-spacing: 1px;
        font-weight: 500;
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    ::selection {
        color: var(--white);
        background-color: var(--black);
    }
    ::-moz-selection {
        color: var(--white);
        background-color: var(--black);
    }
    mark{
        color: var(--white);
        background-color: var(--black);
    }
    .section {
        position: relative;
        width: 100%;
        display: block;
        text-align: center;
        margin: 0 auto;
    }
    .over-hide {
        overflow: hidden;
    }
    .z-bigger {
        z-index: 100 !important;
    }


    .background-color{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--dark-blue);
        z-index: 1;
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    .checkbox:checked ~ .background-color{
        background-color: var(--white);
    }


    [type="checkbox"]:checked,
    [type="checkbox"]:not(:checked),
    [type="radio"]:checked,
    [type="radio"]:not(:checked){
        position: absolute;
        left: -9999px;
        width: 0;
        height: 0;
        visibility: hidden;
    }
    .checkbox:checked + label,
    .checkbox:not(:checked) + label{
        position: relative;
        width: 70px;
        display: inline-block;
        padding: 0;
        margin: 0 auto;
        text-align: center;
        margin: 17px 0;
        margin-top: 100px;
        height: 6px;
        border-radius: 4px;
        background-image: linear-gradient(298deg, var(--red), var(--yellow));
        z-index: 100 !important;
    }
    .checkbox:checked + label:before,
    .checkbox:not(:checked) + label:before {
        position: absolute;
        font-family: 'unicons';
        cursor: pointer;
        top: -17px;
        z-index: 2;
        font-size: 20px;
        line-height: 40px;
        text-align: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    .checkbox:not(:checked) + label:before {
        content: '\eac1';
        left: 0;
        color: var(--grey);
        background-color: var(--dark-light);
        box-shadow: 0 4px 4px rgba(0,0,0,0.15), 0 0 0 1px rgba(26,53,71,0.07);
    }
    .checkbox:checked + label:before {
        content: '\eb8f';
        left: 30px;
        color: var(--yellow);
        background-color: var(--dark-blue);
        box-shadow: 0 4px 4px rgba(26,53,71,0.25), 0 0 0 1px rgba(26,53,71,0.07);
    }

    .checkbox:checked ~ .section .container .row .col-12 p{
        color: var(--dark-blue);
    }


    .checkbox-tools:checked + label,
    .checkbox-tools:not(:checked) + label{
        position: relative;
        display: inline-block;
        padding: 20px;
        width: 300px;
        font-size: 14px;
        line-height: 75px;
        letter-spacing: 1px;
        margin: 0 auto;
        margin-left: 5px;
        margin-right: 5px;
        margin-bottom: 10px;
        text-align: center;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        text-transform: uppercase;
        color: var(--white);
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    .checkbox-tools:not(:checked) + label{
        background-color: var(--dark-light);
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    }
    .checkbox-tools:checked + label{
        background-color: transparent;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    .checkbox-tools:not(:checked) + label:hover{
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    .checkbox-tools:checked + label::before,
    .checkbox-tools:not(:checked) + label::before{
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 4px;
        background-image: linear-gradient(298deg, var(--red), var(--yellow));
        z-index: -1;
    }
    .checkbox-tools:checked + label .uil,
    .checkbox-tools:not(:checked) + label .uil{
        font-size: 24px;
        line-height: 24px;
        display: block;
        padding-bottom: 10px;
    }

    .checkbox:checked ~ .section .container .row .col-12 .checkbox-tools:not(:checked) + label{
        background-color: var(--light);
        color: var(--dark-blue);
        box-shadow: 0 1x 4px 0 rgba(0, 0, 0, 0.05);
    }

    .checkbox-budget:checked + label,
    .checkbox-budget:not(:checked) + label{
        position: relative;
        display: inline-block;
        padding: 0;
        padding-top: 20px;
        padding-bottom: 20px;
        width: 260px;
        font-size: 52px;
        line-height: 52px;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0 auto;
        margin-left: 5px;
        margin-right: 5px;
        margin-bottom: 10px;
        text-align: center;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        text-transform: uppercase;
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
        -webkit-text-stroke: 1px var(--white);
        text-stroke: 1px var(--white);
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        color: transparent;
    }
    .checkbox-budget:not(:checked) + label{
        background-color: var(--dark-light);
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    }
    .checkbox-budget:checked + label{
        background-color: transparent;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    .checkbox-budget:not(:checked) + label:hover{
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    .checkbox-budget:checked + label::before,
    .checkbox-budget:not(:checked) + label::before{
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 4px;
        background-image: linear-gradient(138deg, var(--red), var(--yellow));
        z-index: -1;
    }
    .checkbox-budget:checked + label span,
    .checkbox-budget:not(:checked) + label span{
        position: relative;
        display: block;
    }
    .checkbox-budget:checked + label span::before,
    .checkbox-budget:not(:checked) + label span::before{
        position: absolute;
        content: attr(data-hover);
        top: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        -webkit-text-stroke: transparent;
        text-stroke: transparent;
        -webkit-text-fill-color: var(--white);
        text-fill-color: var(--white);
        color: var(--white);
        -webkit-transition: max-height 0.3s;
        -moz-transition: max-height 0.3s;
        transition: max-height 0.3s;
    }
    .checkbox-budget:not(:checked) + label span::before{
        max-height: 0;
    }
    .checkbox-budget:checked + label span::before{
        max-height: 100%;
    }

    .checkbox:checked ~ .section .container .row .col-xl-10 .checkbox-budget:not(:checked) + label{
        background-color: var(--light);
        -webkit-text-stroke: 1px var(--dark-blue);
        text-stroke: 1px var(--dark-blue);
        box-shadow: 0 1x 4px 0 rgba(0, 0, 0, 0.05);
    }

    .checkbox-booking:checked + label,
    .checkbox-booking:not(:checked) + label{
        position: relative;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-align-items: center;
        -moz-align-items: center;
        -ms-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        -moz-justify-content: center;
        -ms-justify-content: center;
        justify-content: center;
        -ms-flex-pack: center;
        text-align: center;
        padding: 0;
        padding: 6px 25px;
        font-size: 14px;
        line-height: 30px;
        letter-spacing: 1px;
        margin: 0 auto;
        margin-left: 6px;
        margin-right: 6px;
        margin-bottom: 16px;
        text-align: center;
        border-radius: 4px;
        cursor: pointer;
        color: var(--white);
        text-transform: uppercase;
        background-color: var(--dark-light);
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    .checkbox-booking:not(:checked) + label::before{
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    }
    .checkbox-booking:checked + label::before{
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    .checkbox-booking:not(:checked) + label:hover::before{
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    .checkbox-booking:checked + label::before,
    .checkbox-booking:not(:checked) + label::before{
        position: absolute;
        content: '';
        top: -2px;
        left: -2px;
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        border-radius: 4px;
        z-index: -2;
        background-image: linear-gradient(138deg, var(--red), var(--yellow));
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    .checkbox-booking:not(:checked) + label::before{
        top: -1px;
        left: -1px;
        width: calc(100% + 2px);
        height: calc(100% + 2px);
    }
    .checkbox-booking:checked + label::after,
    .checkbox-booking:not(:checked) + label::after{
        position: absolute;
        content: '';
        top: -2px;
        left: -2px;
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        border-radius: 4px;
        z-index: -2;
        background-color: var(--dark-light);
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    .checkbox-booking:checked + label::after{
        opacity: 0;
    }
    .checkbox-booking:checked + label .uil,
    .checkbox-booking:not(:checked) + label .uil{
        font-size: 20px;
    }
    .checkbox-booking:checked + label .text,
    .checkbox-booking:not(:checked) + label .text{
        position: relative;
        display: inline-block;
        -webkit-transition: opacity 300ms linear;
        transition: opacity 300ms linear;
    }
    .checkbox-booking:checked + label .text{
        opacity: 0.6;
    }
    .checkbox-booking:checked + label .text::after,
    .checkbox-booking:not(:checked) + label .text::after{
        position: absolute;
        content: '';
        width: 0;
        left: 0;
        top: 50%;
        margin-top: -1px;
        height: 2px;
        background-image: linear-gradient(138deg, var(--red), var(--yellow));
        z-index: 1;
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    .checkbox-booking:not(:checked) + label .text::after{
        width: 0;
    }
    .checkbox-booking:checked + label .text::after{
        width: 100%;
    }

    .checkbox:checked ~ .section .container .row .col-12 .checkbox-booking:not(:checked) + label,
    .checkbox:checked ~ .section .container .row .col-12 .checkbox-booking:checked + label{
        background-color: var(--light);
        color: var(--dark-blue);
    }
    .checkbox:checked ~ .section .container .row .col-12 .checkbox-booking:checked + label::after,
    .checkbox:checked ~ .section .container .row .col-12 .checkbox-booking:not(:checked) + label::after{
        background-color: var(--light);
    }




    .link-to-page {
        position: fixed;
        top: 30px;
        right: 30px;
        z-index: 20000;
        cursor: pointer;
        width: 30px;
    }
    .link-to-page img{
        width: 100%;
        height: auto;
        display: block;
    }
</style>

<!-- Plugins -->
<script src="{{ URL::asset('admin_assets/js/plugins.js') }}"></script>

<!-- App Scripts -->
<script src="{{ URL::asset('admin_assets/js/scripts.js') }}"></script>

</body>

</html>
