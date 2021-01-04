@extends("app")

@section('head_title', 'Voor de beste verhuistips ga je snel naar Zoekjehuisje.nl')
@section('head_keywords', 'verhuistips, wat te doen bij verhuizen, stappen bij verhuizen, gratis verhuistips, verhuisadvies, wat moet ik doen bij verhuizen, verhuizen, verhuizing')
@section('head_description', 'Voor de een is verhuizen misschien de eerste verhuizing en voor de ander de zoveelste, maar we hebben alle zaken waaraan je moet denken voor je op een rij gezet. Lees de tips op Zoekjehuisje.nl')

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

            @foreach($m_e as $key)

                <div class="row">
                    <div class="col-md-12">
                        <div class="post_img">

                                <h1 class="post_title" style="font-weight: 100;text-align: center;margin-bottom: 40px;">
                                    {{$key->title}}
                                </h1>


                            @if(Route::currentRouteName() == 'front-moving-tips')

                                @if($key->image)

                                    <img src="{{ URL::asset('upload/moving-tips/'.$key->image) }}" style="width: 100%;" alt="{{$key->title}}">

                                @endif


                            @else

                                @if($key->image)

                                    <img src="{{ URL::asset('upload/expats/'.$key->image) }}" style="width: 100%;" alt="{{$key->title}}">

                                @endif

                            @endif

                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 30px;display: flex;flex-direction: column;">

                    @if(Route::currentRouteName() == 'front-moving-tips')

                        @if(count($content) > 0)

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex;">

                        <div style="margin: auto;" data-testid="key-services" class="css-htlmaj col-lg-10 col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <div class="domain-home_ down is-visible">

                                    <h2 class="css-ce6ko1">{{$heading->m_t_heading}}</h2>

                                    <ul class="css-48sroz" style="list-style: none;padding: 0;">

                                        @foreach($content as $temp)

                                            <li>

                                                @if($temp->image)

                                                    <a target="_blank" href="@if($temp->url){{$temp->url}} @else {{URL::to('/')}} @endif">

                                                        <img src="{{ URL::asset('upload/moving-tips/'.$temp->image) }}">{{$temp->title}}

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

                            @endif

                    @endif

                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="margin: auto;">
                        <div class="blog_posts stander_blog_single_post">
                            <article>

                                <div class="post_content description-content" style="margin-top: 40px;">
                                    {!! $key->description !!}
                                </div>

                            </article>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>
    </div>
    <!-- end:content -->

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/flaticon.css') }}"/>


    <style>

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

        .css-ce6ko1{font-size:25px;font-weight:bold;margin-bottom:18px;}

        @media(min-width:624px){.css-48sroz{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:flex-start;}}

        @media(min-width:1021px){.css-48sroz{border-radius:3px;/*border:1px solid #fff;*/-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;/*box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);*/}}

        .css-48sroz li{font-weight:bold;margin-bottom:12px;background-color:#fff;box-shadow:0 1px 3px 0 rgba(30,41,61,0.1),0 1px 2px 0 rgba(30,41,61,0.2);}

        .css-48sroz li:hover,.css-48sroz li:focus{box-shadow:0 3px 6px 0 rgba(30,41,61,0.15),0 5px 10px 0 rgba(30,41,61,0.15);-webkit-transition:box-shadow ease-in 100ms;transition:box-shadow ease-in 100ms;z-index:1;}

        @media(min-width:624px){
            .css-48sroz li{-webkit-flex-basis:calc(50% - 6px);-ms-flex-preferred-size:calc(50% - 6px);flex-basis:calc(50% - 6px);}
        }

        @media(min-width:1021px){

            .css-48sroz li{-webkit-box-flex:1;-webkit-flex-grow:0.2;-ms-flex-positive:1;flex-grow:0.2;-webkit-flex-basis:15%;-ms-flex-preferred-size:20%;flex-basis:15%;font-size:18px;text-align:center;box-shadow:none;border-right:1px solid #e6e9ed;margin-top:-1px;margin-bottom:-1px;}
            .css-48sroz li:last-child{border-right-width:0;}
        }

        .css-48sroz a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;padding:12px;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;font-size: 70%;}

        @media (max-width: 624px){.css-48sroz a{font-size: 90%;}}

        @media(min-width:1021px){.css-48sroz a{display:block;padding:20px 18px;height:100%;}}

        .css-48sroz img{color:#0ea800;width:65px !important;height:55px !important;margin-right:25px;}

        @media(min-width:1021px){.css-48sroz img{display:block;margin:0 auto 20px auto;width:80% !important;height:100px !important;}}

        .css-jeyium{stroke-linejoin:round;stroke-linecap:round;fill:none;vertical-align:middle;width:24px;height:24px;}

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


@endsection
