@extends("app")
@section("content")

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- begin:content -->
    <div id="content">
        <div class="container">

            <div class="row mobile-row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="row" style="margin: 0;margin-bottom: 20px;">

                        <ul style="display:flex;align-items: flex-end;" class="nav nav-tabs res-ul">

                            <span class="res-span" style="display: inline-block;width: 60%;margin-right: 30px;">
                                <h4 class="res-head">De mooiste woontrens & inspiratie onder één dak.</h4>
                                <p style="margin: 0;">Bekijk hier de mooiste en leukste woontreds en laat je inspireren. We hebben zowel de trends binnenshuis als buitenshuis voor je verzameld. Blijf ons volgen voor meer tips en ideeën.</p>
                            </span>

                            <li class="active"><a class="res-tab" data-toggle="tab" href="#home" aria-expanded="true">Binnenshuis</a></li>
                            <li class=""><a class="res-tab" data-toggle="tab" href="#menu1" aria-expanded="false">Buitenshuis</a></li>

                            <form style="margin-bottom: 10px;position: absolute;" id="search_form" method="GET" action="{{route('front-homes-inspiration')}}">
                                <input value="{{$search}}" autocomplete="off" name="search" type="search">
                                <i id="form-submit" style="display: flex;justify-content: center;align-items: center;" class="fa fa-search search-icon"></i>
                            </form>
                        </ul>

                    </div>

                    @if(count($blogs))

                        <!-- begin:product -->
                            <div class="row" style="margin: 0;">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                                    @foreach($blogs as $i => $blog)

                                        <?php

                                        $description = $blog->description;
                                        $description = preg_replace(array('#<[^>]+>#','#&nbsp;#'), ' ', $description);

                                        ?>


                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 res-float" style="margin: auto;">
                                                <article style="margin-bottom: 45px;">
                                                    <div class="property-container" style="margin: 0;min-height: 433px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">

                                                        <a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{ url('homes-inspiration/'.$blog->title) }}">

                                                            <div class="property-image">

                                                                @if($blog->image)

                                                                    <img src="{{ URL::asset('upload/homes-inspiration/'.$blog->image) }}" style="width: 100%;height: 250px;border-top-left-radius: 3px;border-top-right-radius: 3px;" >

                                                                @else

                                                                    <img src="{{ URL::asset('upload/noImage.png') }}" style="width: 100%;height: 250px;border-top-left-radius: 3px;border-top-right-radius: 3px;">

                                                                @endif

                                                            </div>

                                                        </a>

                                                        <div class="property-content description-content">

                                                            <div style="display: flex;justify-content: space-between;">

                                                                @if(isset(Auth::user()->usertype) && Auth::user()->usertype != 'Admin')

                                                                    <form action="{{ URL::to('admin/save-homes-inspiration') }}" method="POST" style="display: inline-block;">

                                                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                                                        <input type="hidden" name="blog_id" value="{{$blog->id}}">

                                                                        <button type="submit" class="new-button" title="{{__('text.Add Favorite')}}" style="outline: none;">

                                                                            @if($saved[$i])

                                                                                <i class="fas fa-heart heart" style="vertical-align: middle;font-size: 16px;display: flex;color: black;" aria-hidden="true">
                                                                                    <span style="display: block;margin-left: 7px;">{{number_format($blog->saved, 0, ',', '.')}}</span>
                                                                                </i>

                                                                            @else

                                                                                <i class="far fa-heart heart" style="vertical-align: middle;font-size: 16px;display: flex;color: black;" aria-hidden="true">
                                                                                    <span style="display: block;margin-left: 7px;">{{number_format($blog->saved, 0, ',', '.')}}</span>
                                                                                </i>

                                                                            @endif


                                                                        </button>

                                                                    </form>

                                                                @else

                                                                    <a style="text-decoration: none;" href="{{ URL::to('/login') }}" title="{{__('text.Add Favorite')}}">

                                                                        <i class="far fa-heart heart" style="vertical-align: middle;font-size: 16px;display: flex;color: black;">
                                                                            <span style="display: block;margin-left: 7px;">{{number_format($blog->saved, 0, ',', '.')}}</span>
                                                                        </i>
                                                                    </a>

                                                                @endif

                                                                <i class="far fa-eye" style="vertical-align: middle;font-size: 16px;display: flex;color: #37bc9b;" aria-hidden="true">
                                                                    <span style="display: block;margin-left: 7px;">{{number_format($blog->views, 0, ',', '.')}}</span>
                                                                </i>

                                                            </div>

                                                            <p style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical;overflow: hidden;line-height: 2;font-size: 15px;margin-top: 15px;font-weight: 700;">{{$description}}</p>

                                                        </div>
                                                    </div>
                                                </article>
                                            </div>

                                    @endforeach

                                </div>
                            </div>
                            <!-- end:product -->

                        @else

                            <h2 style="text-align: center;margin-top: 30px;margin-bottom: 30px;">No Article found...</h2>

                    @endif

                <!-- begin:pagination -->
                {{ $blogs->appends(request()->query())->links() }}
                <!-- end:pagination -->
                </div>
                <!-- end:article -->


            </div>
        </div>
    </div>
    <!-- end:content -->

    <style>

        @media (min-width: 1200px)
        {
            .res-float:nth-child(3n+1) {
                padding-left: 0;
            }

            .res-float:nth-child(3n+3) {
                padding-right: 0;
            }
        }

        @media (max-width: 1199px)
        {
            .res-float:nth-child(3n+1) {
                padding-left: 0;
            }

            .res-float:nth-child(3n+2) {
                padding-right: 0;
            }
        }

        @media (max-width: 768px)
        {
            .res-float:nth-child(3n+1) {
                padding-left: 15px;
            }

            .res-float:nth-child(3n+2) {
                padding-right: 15px;
            }

            .res-ul
            {
                display: block !important;
                position: relative;
            }

            .res-span
            {
                width: 100% !important;
            }

            #search_form
            {
                bottom: 3px;
                margin-bottom: 0 !important;
            }

            .res-head
            {
                font-size: 16px;
            }
        }

        .res-tab
        {
            border: 0 !important;
            font-size: 18px;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus
        {
            background-color: transparent;
            border: 0;
            border-bottom: 3px solid #E42F8B !important;
            padding: 10px 0 !important;
        }

        .new-button{border:0 !important;background-color: transparent;padding: 0;}

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

    </style>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

    <script>

        $('#form-submit').click(function(){

            $('#search_form').submit();

        });

        $('.heart').hover(function () {

            if($(this).hasClass('far fa-heart'))
            {
                $(this).removeClass('far fa-heart');
                $(this).addClass('fas fa-heart');
            }
            else
            {
                $(this).removeClass('fas fa-heart');
                $(this).addClass('far fa-heart');
            }

        });

    </script>

@endsection
