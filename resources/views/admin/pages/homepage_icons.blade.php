@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">

            <div class="pull-right">

                @if(Route::currentRouteName() == 'homepage-icons')

                    <a href="{{URL::to('admin/homepage-icons/changeheading')}}" class="btn btn-success">Change Heading Text<i class="fa fa-edit" style="margin-left: 8px;"></i></a>
                    <a href="{{URL::to('admin/homepage-icons/addcontent')}}" class="btn btn-primary">Add Content <i class="fa fa-plus" style="margin-left: 8px;"></i></a>

                @else

                    <a href="{{URL::to('admin/our-tips/addcontent')}}" class="btn btn-primary">Add Content <i class="fa fa-plus" style="margin-left: 8px;"></i></a>

                @endif

            </div>

            <h2>@if(Route::currentRouteName() == 'homepage-icons') While you are here content @else Our Tips @endif</h2>

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
                        <th>URL</th>

                        <th class="text-center width-100">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($all as $i => $slide)
                        <tr>
                            <td>

                                @if($slide->image)

                                    @if(Route::currentRouteName() == 'homepage-icons')

                                        <img src="{{ URL::asset('upload/homepage_icons/'.$slide->image) }}" width="80" alt="">

                                    @else

                                        <img src="{{ URL::asset('upload/tips/'.$slide->image) }}" width="80" alt="">

                                    @endif

                                @else

                                    <img src="{{ URL::asset('upload/noImage.png') }}" width="80" alt="">

                                @endif

                            </td>
                            <td>{{ $slide->title }}</td>
                            <td>{{ $slide->url }}</td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                        @if(Route::currentRouteName() == 'homepage-icons')

                                            <li><a href="{{ url('admin/homepage-icons/addcontent/'.$slide->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                            <li><a href="{{ url('admin/homepage-icons/delete/'.$slide->id) }}"><i class="md md-delete"></i> Delete</a></li>

                                        @else

                                            <li><a href="{{ url('admin/our-tips/addcontent/'.$slide->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                            <li><a href="{{ url('admin/our-tips/delete/'.$slide->id) }}"><i class="md md-delete"></i> Delete</a></li>

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
