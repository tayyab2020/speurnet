@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">

            <div class="pull-right">

                <a href="{{URL::to('admin/zoekhet/description')}}" class="btn btn-primary">Add Description <i class="fa fa-plus" style="margin-left: 8px;"></i></a>
                <a href="{{URL::to('admin/zoekhet/add')}}" class="btn btn-primary">Add Content <i class="fa fa-plus" style="margin-left: 8px;"></i></a>

            </div>

            <h2>Zoekhet Content</h2>

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
                        <th>ID</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th class="text-center width-100">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($all as $i => $slide)
                        <tr>
                            <td>{{ $slide->id }}</td>
                            <td>
                                @if($slide->image)

                                    <img src="{{ URL::asset('upload/'.$slide->image) }}" width="80" alt="">

                                @else

                                    <img src="{{ URL::asset('upload/noImage.png') }}" width="80" alt="">

                                @endif
                            </td>
                            <td>{!! $slide->description !!}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                        <li><a href="{{ url('admin/zoekhet/add/'.$slide->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                        <li><a href="{{ url('admin/zoekhet/delete/'.$slide->id) }}"><i class="md md-delete"></i> Delete</a></li>

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
