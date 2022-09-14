@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">

            @if(Route::currentRouteName() == 'blogs')

                <div class="pull-right">
                    <a href="{{URL::to('admin/blogs/description')}}" class="btn btn-success">Description <i class="fa fa-plus" style="margin-left: 8px;"></i></a>
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

            @elseif(Route::currentRouteName() == 'homes-inspiration')

                <div class="pull-right">
                    <a href="{{URL::to('admin/homes-inspiration/add-homes-inspiration')}}" class="btn btn-primary">Add Homes Inspiration <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-plus"></i></a>
                </div>

                <h2>Homes Inspiration Articles</h2>

            @elseif(Route::currentRouteName() == 'manage-pages')

                <div class="pull-right">
                    <a href="{{URL::to('admin/manage-pages/add-manage-pages')}}" class="btn btn-primary">Manage Page <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-plus"></i></a>
                </div>

                <h2>Pages Content</h2>

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

                        @if(Route::currentRouteName() != 'manage-pages')

                            <th>Image</th>

                        @endif

                        <th>Title</th>

                        @if(Route::currentRouteName() == 'homes-inspiration')

                            <th>Views</th>
                            <th>Type</th>

                        @endif

                        @if(Route::currentRouteName() == 'footer-pages')

                            <th>Heading</th>
                            <th>URL</th>

                        @endif


                        @if(Route::currentRouteName() == 'manage-pages')

                            <th>Page</th>
                            <th>Page Description</th>
                            <th>Bottom Description</th>

                        @endif

                        <th class="text-center width-100">Action</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($allblogs as $i => $blog)
                        <tr>

                            @if(Route::currentRouteName() != 'manage-pages')

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

                                    @elseif(Route::currentRouteName() == 'homes-inspiration')

                                        @if($blog->image)

                                            <img src="{{ URL::asset('upload/homes-inspiration/'.$blog->image) }}" width="80" alt="">

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

                            @endif

                            <td>

                                @if(Route::currentRouteName() == 'blogs')

                                    <a href="{{ url('blogs/'.$blog->title) }}">{{ $blog->title }}</a>

                                @elseif(Route::currentRouteName() == 'moving-tips')

                                    <a href="{{ url('verhuistips/'.$blog->id) }}">{{ $blog->title }}</a>

                                @elseif(Route::currentRouteName() == 'expats')

                                    <a href="{{ url('expats/'.$blog->id) }}">{{ $blog->title }}</a>

                                @elseif(Route::currentRouteName() == 'homes-inspiration')

                                    <a href="{{ url('wooninspiratie/'.$blog->title) }}">{{ $blog->title }}</a>

                                @elseif(Route::currentRouteName() == 'manage-pages')

                                    <a href="{{ url($blog->page) }}">{{ $blog->title }}</a>

                                @else

                                    <a href="{{$blog->meta_url ? $blog->meta_url : url('nl/'.$blog->title) }}">{{ $blog->title }}</a>

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

                                <td>
                                    <a href="{{$blog->meta_url ? $blog->meta_url : url('nl/'.$blog->title) }}">{{$blog->meta_url ? $blog->meta_url : url('nl/'.$blog->title) }}</a>
                                </td>

                            @endif


                            @if(Route::currentRouteName() == 'homes-inspiration')

                                <td>{{$blog->views}}</td>
                                <td>{{$blog->type == 1 ? "Indoors" : "Outdoors"}}</td>

                            @endif


                            @if(Route::currentRouteName() == 'manage-pages')

                                    <?php

                                    $description = $blog->description;

                                    $description = preg_replace(array('#<[^>]+>#','#&nbsp;#'), ' ', $description);

                                    $bottom_description = $blog->bottom_description;

                                    $bottom_description = preg_replace(array('#<[^>]+>#','#&nbsp;#'), ' ', $bottom_description);

                                    ?>

                                    <td>{{$blog->page}}</td>
                                    <td><div style="text-overflow: ellipsis;display: -webkit-box;width: 100%;visibility: visible;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;line-height: 2;font-size: 15px;">{!! $description !!}</div></td>
                                    <td><div style="text-overflow: ellipsis;display: -webkit-box;width: 100%;visibility: visible;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;line-height: 2;font-size: 15px;">{!! $bottom_description !!}</div></td>

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

                                        @elseif(Route::currentRouteName() == 'homes-inspiration')

                                            <li><a href="{{ url('admin/homes-inspiration/add-homes-inspiration/'.$blog->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                            <li><a href="{{ url('admin/homes-inspiration/delete/'.$blog->id) }}"><i class="md md-delete"></i> Delete</a></li>

                                        @elseif(Route::currentRouteName() == 'manage-pages')

                                            <li><a href="{{ url('admin/manage-pages/add-manage-pages/'.$blog->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                            <li><a href="{{ url('admin/manage-pages/delete/'.$blog->id) }}"><i class="md md-delete"></i> Delete</a></li>

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
