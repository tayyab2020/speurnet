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

                            <?php $date = $blog->created_at;
                            $date = date("M d, Y", strtotime($date)); ?>


                            <div class="post_meta_top" style="text-align: center;margin-bottom: 20px;">
                                <span class="post_meta_date">{{$date}}</span>
                            </div>

                            @if($blog->image)

                                <img class="blog-img" src="{{ URL::asset('upload/blogs/'.$blog->image) }}" style="width: 100%;height: 500px;" alt="{{$blog->title}}">

                            @else

                                <img class="blog-img" src="{{ URL::asset('upload/noImage.png') }}" style="width: 100%;height: 500px;" alt="{{$blog->title}}">

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
                                                        <input required class="search-input" type="radio" id="real_works" name="xml_link" value="Eigen XML-koppeling" style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;">
                                                        <label class="search-label" for="real_works" style="margin-left: 2px;font-size: 18px;cursor: pointer;color: white;font-weight: 400;">Eigen XML-koppeling</label>
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

            @endif


        </div>
    </div>
    <!-- end:content -->

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>


        <style>

            @media (max-width: 768px)
            {
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
