@extends("app")
@section("content")

    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">

                    @if(Route::currentRouteName() == 'front-blogs')

                        <div class="page-title">
                            <h2>Blogs</h2>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li class="active">Blogs</li>
                        </ol>

                        @elseif(Route::currentRouteName() == 'front-moving-tips')

                        <div class="page-title">
                            <h2>Moving Tips</h2>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li class="active">Moving Tips</li>
                        </ol>

                        @else

                        <div class="page-title">
                            <h2>Expats</h2>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                            <li class="active">Expats</li>
                        </ol>

                        @endif


                </div>
            </div>
        </div>
    </div>
    <!-- end:header -->

    <!-- begin:content -->
    <div id="content">
        <div class="container">

            <div class="row mobile-row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <!-- begin:article -->

                @if(count($blogs))

                    <!-- begin:product -->
                        <div class="row" style="margin: 0;">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

                            <?php $i = 0; ?>

                            @foreach($blogs as $i => $blog)

                                    <?php $description = $blog->description;

                                    $description = preg_replace(array('#<[^>]+>#','#&nbsp;#'), ' ', $description);

                                    $date = $blog->created_at;
                                    $date = date("M d, Y", strtotime($date));
                                    ?>

                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-10 res-float" style="margin: auto;">
                                        <article style="margin-bottom: 45px;">
                                            <div class="property-container" style="margin: 0;min-height: 433px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                                                <div class="property-image">

                                                    @if(Route::currentRouteName() == 'front-blogs')

                                                        <img src="{{ URL::asset('upload/blogs/'.$blog->image) }}" style="width: 100%;height: 250px;border-top-left-radius: 3px;border-top-right-radius: 3px;" >

                                                    @elseif(Route::currentRouteName() == 'front-moving-tips')

                                                        <img src="{{ URL::asset('upload/moving-tips/'.$blog->image) }}" style="width: 100%;height: 250px;border-top-left-radius: 3px;border-top-right-radius: 3px;" >

                                                    @else

                                                        <img src="{{ URL::asset('upload/expats/'.$blog->image) }}" style="width: 100%;height: 250px;border-top-left-radius: 3px;border-top-right-radius: 3px;" >

                                                    @endif


                                                </div>

                                                <div class="property-content description-content">

                                                    <h3>

                                                        @if(Route::currentRouteName() == 'front-blogs')

                                                            <a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{ url('blogs/'.$blog->id) }}">{{$blog->title}}</a>

                                                        @elseif(Route::currentRouteName() == 'front-moving-tips')

                                                            <a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{ url('moving-tips/'.$blog->id) }}">{{$blog->title}}</a>

                                                        @else

                                                            <a style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;outline: none;" href="{{ url('expats/'.$blog->id) }}">{{$blog->title}}</a>

                                                        @endif

                                                        <small style="color: #acacac;font-style: normal;">{{$date}}</small>

                                                    </h3>

                                                    <p style="text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;line-height: 2;font-size: 15px;margin-top: 15px;">{{$description}}</p>

                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                            @endforeach

                            </div>
                                    </div>
                                    <!-- end:product -->

                                @else

                        @if(Route::currentRouteName() == 'front-blogs')

                            <h2 style="text-align: center;margin-top: 30px;margin-bottom: 30px;">No Blogs found...</h2>

                        @elseif(Route::currentRouteName() == 'front-moving-tips')

                            <h2 style="text-align: center;margin-top: 30px;margin-bottom: 30px;">No Moving Tips found...</h2>

                        @else

                            <h2 style="text-align: center;margin-top: 30px;margin-bottom: 30px;">No Expats found...</h2>

                        @endif


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

        @media (max-width: 767px)
        {
            .res-float
            {
                float: none;
            }
        }

    </style>

@endsection
