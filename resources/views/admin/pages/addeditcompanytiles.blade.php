@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> {{ isset($slide->name) ? 'Edit: '. $slide->name : 'Add Company Tile' }}</h2>

            <a href="{{ URL::to('admin/company-tiles') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">

            {!! Form::open(array('url' => array('admin/company-tiles/addcontent'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($slide->id) ? $slide->id : null }}">


                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Heading</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" value="{{ isset($slide->title) ? $slide->title : null }}" class="form-control">
                    </div>
                </div>


                <div style="margin: 50px 0 0 0;" class="row">

                    <h4 style="border-bottom: 1px solid #dadada;padding-bottom: 20px;color: #444444;text-align: center;">Company Titles</h4>

                </div>

                <div class="table form-group">

                    <table style="margin: auto;">

                        <thead>
                        <tr>
                            <th style="border-top-left-radius: 9px;">Title</th>
                            <th>URL</th>
                            <th style="width: 10%;border-top-right-radius: 9px;"></th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(isset($slide) && count($slide->details) > 0)


                            @foreach($slide->details as $x => $key)

                                <tr data-id="{{$x+1}}">
                                    <td>
                                        <input value="{{$key->title}}" class="form-control title" name="tile_titles[]" id="blood_group_slug" placeholder="Title" type="text">
                                    </td>
                                    <td>
                                        <input value="{{$key->url}}" class="form-control url" name="tile_urls[]" id="blood_group_slug" placeholder="URL" type="text">
                                    </td>
                                    <td style="text-align: center;">

                                        <span id="next-row-span" class="tooltip1 add-row" data-id="" style="cursor: pointer;font-size: 20px;">
                                            <i id="next-row-icon" class="fa fa-fw fa-plus"></i>
                                        </span>

                                        <span data-id="" id="next-row-span" class="tooltip1 remove-row" style="cursor: pointer;font-size: 20px;margin-left: 10px;">
                                            <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>
                                        </span>

                                    </td>
                                </tr>

                            @endforeach

                        @else

                            <tr data-id="1">
                                <td>
                                    <input class="form-control title" name="tile_titles[]" id="blood_group_slug" placeholder="Title" type="text">
                                </td>
                                <td>
                                    <input class="form-control url" name="tile_urls[]" id="blood_group_slug" placeholder="URL" type="text">
                                </td>
                                <td style="text-align: center;">

                                <span id="next-row-span" class="tooltip1 add-row" data-id="" style="cursor: pointer;font-size: 20px;">
                                    <i id="next-row-icon" class="fa fa-fw fa-plus"></i>
                                </span>

                                    <span data-id="" id="next-row-span" class="tooltip1 remove-row" style="cursor: pointer;font-size: 20px;margin-left: 10px;">
                                    <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>
                                </span>

                                </td>
                            </tr>

                        @endif

                        </tbody>

                    </table>

                </div>


                <hr>
                <div class="form-group">
                    <div class="col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{ isset($slide->id) ? 'Edit Company' : 'Save Company' }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


    </div>

    <script>

        $(document).on('click', '.add-row', function () {

            var row = $('.table table tbody tr:last').data('id');
            row = row + 1;

            $(".table table tbody").append('<tr data-id="'+row+'">\n' +
                '                                                                                        <td>\n' +
                '                                                                                            <input class="form-control title" name="tile_titles[]" id="blood_group_slug" placeholder="Title" type="text">\n' +
                '                                                                                        </td>\n' +
                '                                                                                        <td>\n' +
                '                                                                                            <input class="form-control url" name="tile_urls[]" id="blood_group_slug" placeholder="URL" type="text">\n' +
                '                                                                                        </td>\n' +
                '                                                                                        <td style="text-align: center;">\n' +
                '                                                                                           <span id="next-row-span" class="tooltip1 add-row" style="cursor: pointer;font-size: 20px;">\n' +
                '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-plus"></i>\n' +
                '                                                                                           </span>\n' +
                '\n' +
                '                                                                                           <span data-id="" id="next-row-span" class="tooltip1 remove-row" style="cursor: pointer;font-size: 20px;margin-left: 10px;">\n' +
                '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>\n' +
                '                                                                                           </span>\n' +
                '                                                                                        </td>\n' +
                '                                                                </tr>');

        });


        $(document).on('click', '.remove-row', function () {

            $(this).parent().parent().remove();

            if($('.table').find("table tbody tr").length == 0)
            {

                $(".table table tbody").append('<tr data-id="1">\n' +
                    '                                                                                        <td>\n' +
                    '                                                                                            <input class="form-control title" name="tile_titles[]" id="blood_group_slug" placeholder="Title" type="text">\n' +
                    '                                                                                        </td>\n' +
                    '                                                                                        <td>\n' +
                    '                                                                                            <input class="form-control url" name="tile_urls[]" id="blood_group_slug" placeholder="URL" type="text">\n' +
                    '                                                                                        </td>\n' +
                    '                                                                                        <td style="text-align: center;">\n' +
                    '                                                                                           <span id="next-row-span" class="tooltip1 add-row" style="cursor: pointer;font-size: 20px;">\n' +
                    '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-plus"></i>\n' +
                    '                                                                                           </span>\n' +
                    '\n' +
                    '                                                                                           <span data-id="" id="next-row-span" class="tooltip1 remove-row" style="cursor: pointer;font-size: 20px;margin-left: 10px;">\n' +
                    '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>\n' +
                    '                                                                                           </span>\n' +
                    '                                                                                        </td>\n' +
                    '                                                                </tr>');
            }

        });

    </script>

    <style type="text/css">

        .table{width: 100%;margin: 40px 0 !important;}
        .table table{border-collapse: inherit;text-align: left;width: 100%;border: 1px solid #d6d6d6;border-radius: 10px;}
        .table table thead th{font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;}
        .table table tbody td{padding: 10px;border-bottom: 1px solid #d3d3d3;color: #3a3a3a;vertical-align: middle;}
        .table table tbody tr:last-child td{ border-bottom: none; }

    </style>

@endsection
