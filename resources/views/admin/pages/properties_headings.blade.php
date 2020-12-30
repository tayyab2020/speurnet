@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">

            <div class="pull-right">
                <a href="{{URL::to('admin/properties-headings/add-properties-heading')}}" class="btn btn-primary">Add Properties Heading <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-plus"></i></a>
            </div>

            <h2>Properties Headings</h2>

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
                        <th>Heading</th>
                        <th>Order</th>
                        <th>Background Color</th>
                        <th class="text-center width-100">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($headings as $i => $heading)

                        <tr>
                            <td>{{$i + 1}}</td>

                            <td>
                                <a href="{{ url('admin/properties-headings/add-properties-heading/'.$heading->id) }}">{{$heading->title}}</a>
                            </td>

                            <td>
                                {{$heading->heading_order}}
                            </td>

                            <td>
                                <div class="cp2 input-group colorpicker-component">
                                    <input value="{{$heading->color}}" class="cp1" type="hidden" disabled />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="{{ url('admin/properties-headings/add-properties-heading/'.$heading->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                        <li><a href="{{ url('admin/properties-headings/delete/'.$heading->id) }}"><i class="md md-delete"></i> Delete</a></li>
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

    <style>

        .input-group-addon
        {
            width: auto;
            background: transparent;
            border: 0;
        }

    </style>

    <script>

        $('.cp1').colorpicker();
        $('.cp2').colorpicker();

    </script>

@endsection
