@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">

            @if(Route::currentRouteName() == 'blogs')

            <div class="pull-right">
                <a href="{{URL::to('admin/blogs/addblog')}}" class="btn btn-primary">Add Blog <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-plus"></i></a>
            </div>

            <h2>Blogs</h2>

                @elseif(Route::currentRouteName() == 'moving-tips')

                <div class="pull-right">
                    <a href="{{URL::to('admin/moving-tips/moving-tips-content')}}" class="btn btn-success">Moving Tips Content <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-book"></i></a>
                    <a href="{{URL::to('admin/moving-tips/addmovingtip')}}" class="btn btn-primary">Add Moving Tip <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-plus"></i></a>
                </div>

                <h2>Moving Tips</h2>

            @elseif(Route::currentRouteName() == 'expats')

                <div class="pull-right">
                    <a href="{{URL::to('admin/expats/addexpat')}}" class="btn btn-primary">Add Expat <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-plus"></i></a>
                </div>

                <h2>Expats</h2>

            @else

                <div class="pull-right">
                    <a href="{{URL::to('admin/footer-pages/add-footer-page')}}" class="btn btn-primary">Add Footer Page <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-plus"></i></a>
                </div>

                <h2>Footer Pages</h2>

            @endif

        </div>

        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>

                        @if(Route::currentRouteName() == 'footer-pages')

                        <th>Heading</th>

                        @endif

                        <th class="text-center width-100">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($allblogs as $i => $blog)
                        <tr>
                            <td>

                                @if(Route::currentRouteName() == 'blogs')

                                    @if($blog->image)

                                        <img src="{{ URL::asset('upload/blogs/'.$blog->image) }}" width="80" alt="">

                                    @else

                                        <img src="{{ URL::asset('upload/noImage.png') }}" width="80" alt="">

                                    @endif

                                @elseif(Route::currentRouteName() == 'moving-tips')

                                    @if($blog->image)

                                        <img src="{{ URL::asset('upload/moving-tips/'.$blog->image) }}" width="80" alt="">

                                        @else

                                        <img src="{{ URL::asset('upload/noImage.png') }}" width="80" alt="">

                                    @endif

                                @elseif(Route::currentRouteName() == 'expats')

                                    @if($blog->image)

                                        <img src="{{ URL::asset('upload/expats/'.$blog->image) }}" width="80" alt="">

                                        @else

                                        <img src="{{ URL::asset('upload/noImage.png') }}" width="80" alt="">

                                    @endif

                                @else

                                    @if($blog->image)

                                        <img src="{{ URL::asset('upload/footer-pages/'.$blog->image) }}" width="80" alt="">

                                    @else

                                        <img src="{{ URL::asset('upload/noImage.png') }}" width="80" alt="">

                                    @endif

                                @endif

                            </td>

                            <td>

                                @if(Route::currentRouteName() == 'blogs')

                                <a href="{{ url('blogs/'.$blog->id) }}">{{ $blog->title }}</a>

                                @elseif(Route::currentRouteName() == 'moving-tips')

                                    <a href="{{ url('moving-tips/'.$blog->id) }}">{{ $blog->title }}</a>

                                @elseif(Route::currentRouteName() == 'expats')

                                    <a href="{{ url('expats/'.$blog->id) }}">{{ $blog->title }}</a>

                                @else

                                    <a href="{{ url('footer-pages/'.$blog->id) }}">{{ $blog->title }}</a>

                                @endif

                            </td>

                            @if(Route::currentRouteName() == 'footer-pages')

                                @if($blog->heading)

                                    <td>
                                        {{$blog->heading}}
                                    </td>

                                @elseif($blog->heading_id == 0)

                                    <td>Company</td>

                                @else

                                    <td>Not Linked</td>

                                @endif



                            @endif

                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                        @if(Route::currentRouteName() == 'blogs')

                                            <li><a href="{{ url('admin/blogs/addblog/'.$blog->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                            <li><a href="{{ url('admin/blogs/delete/'.$blog->id) }}"><i class="md md-delete"></i> Delete</a></li>

                                        @elseif(Route::currentRouteName() == 'moving-tips')

                                            <li><a href="{{ url('admin/moving-tips/addmovingtip/'.$blog->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                            <li><a href="{{ url('admin/moving-tips/delete/'.$blog->id) }}"><i class="md md-delete"></i> Delete</a></li>

                                        @elseif(Route::currentRouteName() == 'expats')

                                            <li><a href="{{ url('admin/expats/addexpat/'.$blog->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                            <li><a href="{{ url('admin/expats/delete/'.$blog->id) }}"><i class="md md-delete"></i> Delete</a></li>

                                        @else

                                            <li><a href="{{ url('admin/footer-pages/add-footer-page/'.$blog->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                            <li><a href="{{ url('admin/footer-pages/delete/'.$blog->id) }}"><i class="md md-delete"></i> Delete</a></li>

                                        @endif

                                    </ul>
                                </div>

                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>



@endsection
