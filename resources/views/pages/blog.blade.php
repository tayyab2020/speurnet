@extends("app")
@section("content")

    <!-- begin:content -->
    <div id="content">

        @if(Session::has('flash_message'))
            <div class="alert alert-success alert-box" style="text-align: center;font-size: 16px;position: fixed;top: 20%;z-index: 1000;padding-right: 35px;background-color: rgb(0 0 0);color: rgb(255 255 255);border: 0;max-width: 400px;border-radius: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute;top: 5px;right: 8px;font-size: 28px;line-height: 0.5;opacity: 0.8;font-weight: 100;text-shadow: none;color: #ffffff;">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif


        <div class="container">


            <div class="row">
                <div class="col-md-12">
                    <div class="post_img">

                        @if(Route::currentRouteName() == 'front-blog')

                            <h1 class="post_title" style="font-weight: 100;text-align: center;">
                                {{$blog->title}}
                            </h1>

                            <?php setlocale(LC_TIME, 'Dutch');
                            $date = $blog->created_at->formatLocalized('%d %B %Y');
                            ?>

                            <div class="post_meta_top" style="text-align: center;margin-bottom: 20px;">
                                <span class="post_meta_date">{{$date}}</span>
                            </div>

                            @if($blog->image)

                                <img class="blog-img" src="{{ URL::asset('upload/blogs/'.$blog->image) }}" style="width: 100%;height: 500px;" alt="{{$blog->title}}">

                            @else

                                <img class="blog-img" src="{{ URL::asset('upload/noImage.png') }}" style="width: 100%;height: 500px;" alt="{{$blog->title}}">

                            @endif

                            <span style="display: block;float: right;margin-top: 10px;">
                                <i class="far fa-eye" style="vertical-align: middle;font-size: 16px;display: flex;color: #37bc9b;" aria-hidden="true">
                                    <span style="display: block;margin-left: 7px;">{{number_format($blog->views, 0, ',', '.')}}</span>
                                </i>
                            </span>

                        @elseif(Route::currentRouteName() == 'front-homes-inspiration')

                            @if($blog->image)

                                <img class="blog-img" src="{{ URL::asset('upload/homes-inspiration/'.$blog->image) }}" style="width: 100%;height: 500px;" alt="{{$blog->title}}">

                            @endif

                        @else

                            {{--<h1 class="post_title" style="font-weight: 100;text-align: center;margin-bottom: 40px;">
                                {{$blog->title}}
                            </h1>--}}

                            @if($blog->image)

                                <img class="blog-img" src="{{ URL::asset('upload/footer-pages/'.$blog->image) }}" style="width: 100%;height: 500px;" alt="{{$blog->title}}">

                            @endif

                        @endif


                    </div>
                </div>
            </div>


            <div class="row" style="margin-top: 30px;display: flex;">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">
                    <div class="blog_posts stander_blog_single_post">
                        <article>

                            <div class="post_content description-content" style="margin-top: 40px;">
                                {!! $blog->description !!}
                            </div>

                        </article>
                    </div>
                </div>
            </div>

            @if(isset($custom) && $custom == 1)

                <div class="row" style="margin-top: 30px;display: flex;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">
                        <div class="blog_posts stander_blog_single_post">
                            <article>

                                <div class="post_content description-content" style="margin-top: 40px;">

                                    <h3 style="color: #3c63a7;font-weight: 700;">Zo werkt het</h3>
                                    <img id="res-img" style="margin: 10px 0 0 0;width: 100%;height: 200px;" src="{{URL::asset('assets/img/allecijfers.nl.png')}}">

                                </div>

                            </article>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 30px;display: flex;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">
                        <div class="blog_posts stander_blog_single_post">
                            <article>

                                <div style="width: 100%;">
                                    <div id="res-text" style="background-color: #ffd60a;text-align: center;font-size: 25px;font-weight: 600;color: black;padding: 10px 5px;">Jouw koppeling is binnen no-time geregeld. Ideaal, toch?</div>
                                    <form action="{{route('form-submit')}}" method="POST">

                                        <input type="hidden" name="_token" value="{{@csrf_token()}}">
                                        <input type="hidden" name="form_type" value="1">

                                        <div style="background-color: #25a5ff;width: 100%;display: inline-block;padding: 20px 10px;">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label style="color: white;">Naam makelaarskantoor</label>
                                                    <input name="name" required style="background-color: transparent;border: 0;border-bottom: 1px solid #f6f6f6;box-shadow: none;color: white;" class="form-control res-input" type="text">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label style="color: white;">E-mailadres</label>
                                                    <input name="email" required style="background-color: transparent;border: 0;border-bottom: 1px solid #f6f6f6;box-shadow: none;color: white;" class="form-control res-input" type="email">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label style="color: white;">Telefoonnummer</label>
                                                    <input name="phone" required style="background-color: transparent;border: 0;border-bottom: 1px solid #f6f6f6;box-shadow: none;color: white;" class="form-control res-input" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label class="res-label" style="color: white;font-size: 20px;margin-bottom: 10px;">Kies jouw XML koppeling</label>

                                                    <span style="display: inline-block;width: 100%;">
                                                        <input required class="search-input" type="radio" id="eigen" name="xml_link" value="Eigen XML-koppeling" style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;">
                                                        <label class="search-label" for="eigen" style="margin-left: 2px;font-size: 18px;cursor: pointer;color: white;font-weight: 400;">Eigen XML-koppeling</label>
                                                    </span>

                                                    <span style="display: inline-block;width: 100%;">
                                                        <input required class="search-input" type="radio" id="real_works" name="xml_link" value="Realworks" style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;">
                                                        <label class="search-label" for="real_works" style="margin-left: 2px;font-size: 18px;cursor: pointer;color: white;font-weight: 400;">Realworks</label>
                                                    </span>

                                                    <span style="display: inline-block;width: 100%;">
                                                        <input required class="search-input" type="radio" id="yes_co" name="xml_link" value="Yes-co" checked style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;">
                                                        <label class="search-label" for="yes_co" style="margin-left: 2px;font-size: 18px;cursor: pointer;color: white;font-weight: 400;">Yes-co</label>
                                                    </span>

                                                    <span style="display: inline-block;width: 100%;">
                                                        <input required class="search-input" type="radio" id="kolibri" name="xml_link" value="Kolibri" style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;">
                                                        <label class="search-label" for="kolibri" style="margin-left: 2px;font-size: 18px;cursor: pointer;color: white;font-weight: 400;">Kolibri</label>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label style="color: white;">Opmerking</label>
                                                    <textarea required name="note" rows="6" style="background-color: white;color: black;resize: vertical;" class="form-control"></textarea>
                                                    <button style="font-size: 20px;float: right;margin-top: 30px;outline: none;" type="submit" class="btn btn-danger sub">Verzoek versturen</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </article>
                        </div>
                    </div>
                </div>

            @elseif(isset($custom) && $custom == 2)

                <div class="row" style="margin-top: 30px;display: flex;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">
                        <div class="blog_posts stander_blog_single_post">
                            <article>

                                <div style="width: 100%;">
                                    <span class="res-head" style="line-height: 1;font-weight: 600;font-size: 33px;color: orange;display: block;margin-bottom: 20px;">Bepaal gratis de waarde van jouw huis!</span>

                                    <form style="border: 1px solid #cacaca;border-bottom: 0;border-radius: 20px;" action="{{route('form-submit')}}" method="POST">

                                        <input type="hidden" name="_token" value="{{@csrf_token()}}">
                                        <input type="hidden" name="form_type" value="2">

                                        <div style="width: 100%;display: inline-block;padding: 20px 10px;padding-bottom: 0;">

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                                <div class="bulgy-radios" role="radiogroup" aria-labelledby="bulgy-radios-label" style="width: 100%;text-align: left;/*min-height: 50px;*/">

                                                    <label style="margin-left: 5px;">
                                                        <input type="radio" name="reason" class="usertype" value="Ik ben van plan om mijn huis te verkopen" checked />
                                                        <span class="radio"></span>
                                                        <span class="label">Ik ben van plan om mijn huis te verkopen</span>
                                                    </label>

                                                    <label style="margin-left: 5px;">
                                                        <input type="radio" name="reason" class="usertype" value="Andere reden" />
                                                        <span class="radio"></span>
                                                        <span class="label">Andere reden</span>
                                                    </label>

                                                </div>

                                            </div>

                                            <div style="text-align: right;" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                                <img class="res-img-hide" src="{{URL::asset('assets/img/separate icons1.png')}}">
                                                <img class="res-img-hide" src="{{URL::asset('assets/img/separate icons.png')}}">

                                            </div>


                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                                <h3 style="font-weight: 600;">Aanvullende informatie</h3>

                                                <textarea style="resize: vertical;width: 100%;border: 1px solid lightgrey;border-radius: 7px;outline: none;" name="information" rows="10"></textarea>

                                            </div>


                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                                <div class="bulgy-radios res-radio" role="radiogroup" aria-labelledby="bulgy-radios-label" style="width: 100%;text-align: left;/*min-height: 50px;*/">

                                                    <label style="margin-left: 5px;display: inline-block;">
                                                        <input type="radio" name="gender" class="usertype" value="Dhr." checked />
                                                        <span class="radio"></span>
                                                        <span class="label">Dhr.</span>
                                                    </label>

                                                    <label style="margin-left: 5px;display: inline-block;">
                                                        <input type="radio" name="gender" class="usertype" value="Mevr." />
                                                        <span class="radio"></span>
                                                        <span class="label">Mevr.</span>
                                                    </label>

                                                </div>

                                                <div style="margin-top: 20px;" class="form-group">

                                                    <div style="width: 100%;display: flex;border: 2px solid #4fc1e9;margin: auto;background: white;">

                                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">
                                                                <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">
                                                                    <i class="fas fa-user res-icon" style="font-size: 15px;" aria-hidden="true"></i>
                                                                </span>
                                                        </div>

                                                        <input type="text" name="name" id="name" placeholder="{{__('text.Name')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;" class="form-control res-inp" required>

                                                    </div>

                                                </div>

                                                <div style="margin-top: 20px;" class="form-group">

                                                    <div style="width: 100%;display: flex;border: 2px solid #4fc1e9;margin: auto;background: white;">

                                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">
                                                                <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">
                                                                    <i class="fas fa-id-badge res-icon" style="font-size: 15px;" aria-hidden="true"></i>
                                                                </span>
                                                        </div>

                                                        <input type="text" name="last_name" id="last_name" placeholder="{{__('text.Last Name')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;" class="form-control res-inp" required>

                                                    </div>
                                                </div>

                                                <div style="margin-top: 20px;" class="form-group">

                                                    <div style="width: 100%;display: flex;border: 2px solid #4fc1e9;margin: auto;background: white;">

                                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">
                                                                <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">
                                                                    <i class="far fa-envelope res-icon" style="font-size: 15px;" aria-hidden="true"></i>
                                                                </span>
                                                        </div>

                                                        <input type="email" name="email" id="email" placeholder="{{__('text.Email Address')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;" class="form-control res-inp" required>

                                                    </div>
                                                </div>

                                                <div style="margin-top: 20px;" class="form-group">

                                                    <div style="width: 100%;display: flex;border: 2px solid #4fc1e9;margin: auto;background: white;">

                                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">
                                                                <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">
                                                                    <i class="fas fa-map-marker-alt res-icon" style="font-size: 15px;" aria-hidden="true"></i>
                                                                </span>
                                                        </div>

                                                        <input type="text" name="address" id="address" placeholder="{{__('text.Address')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;" class="form-control res-inp" required>

                                                    </div>
                                                </div>

                                                <div style="margin-top: 20px;" class="form-group">

                                                    <div style="width: 100%;display: flex;border: 2px solid #4fc1e9;margin: auto;background: white;">

                                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">
                                                                <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">
                                                                    <i class="fas fa-map-marker-alt res-icon" style="font-size: 15px;" aria-hidden="true"></i>
                                                                </span>
                                                        </div>

                                                        <input type="text" name="postcode" id="postcode" placeholder="Postcode en woonplaats" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;" class="form-control res-inp" required>

                                                    </div>
                                                </div>

                                                <div style="margin-top: 20px;" class="form-group">

                                                    <div style="width: 100%;display: flex;border: 2px solid #4fc1e9;margin: auto;background: white;">

                                                        <div class="icon-con" style="width:15%;float: left;text-align: center;vertical-align: middle;border-right: 1px solid #dbdbdb;display: flex;">
                                                                <span style="width: 100%;display: flex;justify-content: center;flex-direction: column;">
                                                                    <i class="fas fa-phone res-icon" style="font-size: 15px;" aria-hidden="true"></i>
                                                                </span>
                                                        </div>

                                                        <input type="text" name="phone" id="phone" placeholder="{{__('text.Phone')}}" style="box-shadow: none;border: 0;margin: 0;float: left;width: 85%;left: 0;height: 35px;text-align: left;" class="form-control res-inp" required>

                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                        <div style="width: 100%;">

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <img class="res-img-hide" style="margin-right: 20px;height: 55px;" src="{{URL::asset('assets/img/separate icons2.png')}}">
                                                <img class="res-img-hide" style="margin-right: 20px;height: 55px;" src="{{URL::asset('assets/img/separate icons3.png')}}">
                                                <img class="res-img-hide" style="height: 55px;" src="{{URL::asset('assets/img/separate icons4.png')}}">
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 res-footer">
                                                <div style="margin: 0;" class="form-group">

                                                    <input name="terms" value="1" type="checkbox" required id="terms" style="position: relative;top: 2px;display: block;height: 0px;">

                                                    <label class="bg" for="terms" style="margin: 0;font-weight: 500;">

                                                        <span class="search-span" style="position: relative;top: 2px;font-size: 13px;color: #6b6e80;">Ik ga akkoord dat Zoekjehuisje.nl mijn aanvraag doorstuurt naar een gespecialiseerde makelaar.</span>

                                                    </label>

                                                </div>
                                            </div>

                                        </div>

                                        <div style="margin-bottom: 0;background-color: #edcc2b;width: 100%;border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;height: 65px;display: flex;justify-content: flex-end;align-items: center;" class="form-group">

                                            <button style="margin-right: 10px;border-radius: 20px;padding: 12px 30px;outline: none;" type="submit" class="btn btn-danger">Verzend jouw aanvraag</button>

                                        </div>

                                    </form>
                                </div>

                            </article>
                        </div>
                    </div>
                </div>

            @endif


        </div>
    </div>
    <!-- end:content -->

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>


        <style>

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

                .res-radio
                {
                    margin-top: 15px;
                }

                .res-footer
                {
                    margin-bottom: 10px;
                }

                .res-img-hide
                {
                    display: none;
                }

                .res-head
                {
                    font-size: 21px !important;
                }

                .bulgy-radios .label
                {
                    font-size: 16px;
                }

                .radio
                {
                    width: 12px !important;
                    height: 12px !important;
                }

                .radio::after
                {
                    margin-right: 0 !important;
                    margin-bottom: 0.2px !important;
                }

                .blog-img
                {
                    height: auto !important;
                }

                #res-img
                {
                    height: 130px !important;
                }

                #res-text
                {
                    font-size: 18px !important;
                }

                .res-input
                {
                    height: 20px;
                    padding: 0;
                    font-size: 15px;
                }

                .res-label
                {
                    font-size: 17px !important;
                }

                textarea
                {
                    height: 100px !important;
                }

                .sub
                {
                    font-size: 14px !important;
                }
            }

            .description-content img
            {
                margin-left: 5px;
            }

            .description-content blockquote:before
            {
                content: '\f10d';
                font-family: 'FontAwesome';
                position: relative;
                left: -1em;
                top: 0;
                display: block;
                width: 20px;
                height: 20px;
                color: black;
                font-size: 10px;
            }

        </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>

        $( document ).ready(function() {
            $('.alert-box').delay(5000).fadeOut('slow');
        });

    </script>

@endsection
