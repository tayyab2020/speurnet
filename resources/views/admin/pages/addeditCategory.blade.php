@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> {{ isset($slide->name) ? 'Edit: '. $slide->name : 'Add Category' }}</h2>

            <a href="{{ URL::to('admin/categories') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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

            {!! Form::open(array('url' => array('admin/categories/addcontent'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($slide->id) ? $slide->id : null }}">

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" value="{{ isset($slide->title) ? $slide->title : null }}" class="form-control">
                    </div>
                </div>


                <div style="margin: 50px 0 0 0;" class="row">

                    <h4 style="border-bottom: 1px solid #dadada;padding-bottom: 20px;color: #444444;text-align: center;">Headings</h4>

                </div>

                <div class="table form-group">

                    <table style="margin: auto;">

                        <thead>
                        <tr>
                            <th style="border-top-left-radius: 9px;">Title</th>                            
                            <th style="width: 10%;border-top-right-radius: 9px;"></th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(isset($slide))

                            <?php $heading_ids = explode(',',$slide->heading_ids); ?>

                            @foreach($heading_ids as $x => $temp)

                                <tr data-id="{{$x+1}}">
                                    <td>
                                        <select class="headings" name="headings[]">

                                            <option value="">Select Heading</option>

                                            @foreach($headings as $key)

                                                <option {{$key->id == $temp ? 'selected' : null}} value="{{$key->id}}">{{$key->heading}}</option>

                                            @endforeach

                                        </select>
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
                                    <select class="headings" name="headings[]">

                                        <option value="">Select Heading</option>

                                        @foreach($headings as $key)

                                            <option value="{{$key->id}}">{{$key->heading}}</option>

                                        @endforeach
                                    
                                    </select>
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
                        <button type="submit" class="btn btn-primary">{{ isset($slide->id) ? 'Edit Category' : 'Save Category' }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


    </div>

    <style>

        .select2-selection, .select2-selection__arrow
        {
            height: 40px !important;
        }

        .select2-selection__rendered
        {
            line-height: 40px !important;
        }
        
    </style>

    <script>

        $('.headings').select2({
            width: '100%',
        });

        $(document).on('change', '.headings', function () {

            var id = this.value;

            if(id)
            {
                if ($('.headings').find('option[value=' + id + ']:selected').length > 1) {

                    alert('This heading is already selected!');
                    this.options[0].selected = true;

                    $(this).val('');

                    $(this).select2("destroy");

                    $(this).select2({
                        width: '100%',
                    });
                }
            }

        });

        $(document).on('click', '.add-row', function () {

            var row = $('.table table tbody tr:last').data('id');
            row = row + 1;

            $(".table table tbody").append('<tr data-id="'+row+'">\n' +
                '                                                                                        <td>\n' +
                '                                                                                            <select class="headings" name="headings[]" required>\n' +
                '\n' +
                '                                                                                               <option value="">Select Heading</option>\n' +
                '\n' +
                '                                                                                               @foreach($headings as $key)\n' +
                '\n' +
                '                                                                                                 <option value="{{$key->id}}">{{$key->heading}}</option>\n' +
                '\n' +
                '                                                                                               @endforeach\n' +
                '\n' +
                '                                                                                            </select>\n' +
                '                                                                                        </td>\n' +
                '\n' +
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

            $('.headings').select2({
                width: '100%',
            });

            $(document).on('change', '.headings', function () {

                var id = this.value;

                if(id)
                {
                    if ($('.headings').find('option[value=' + id + ']:selected').length > 1) {

                        alert('This heading is already selected!');
                        this.options[0].selected = true;

                        $(this).val('');

                        $(this).select2("destroy");

                        $(this).select2({
                            width: '100%',
                        });
                    }
                }

            });

        });


        $(document).on('click', '.remove-row', function () {

            $(this).parent().parent().remove();

            if($('.table').find("table tbody tr").length == 0)
            {

                $(".table table tbody").append('<tr data-id="1">\n' +
                    '                                                                                        <td>\n' +
                    '                                                                                            <select class="headings" name="headings[]" required>\n' +
                    '\n' +
                    '                                                                                               <option value="">Select Heading</option>\n' +
                    '\n' +
                    '                                                                                               @foreach($headings as $key)\n' +
                    '\n' +
                    '                                                                                                 <option value="{{$key->id}}">{{$key->heading}}</option>\n' +
                    '\n' +
                    '                                                                                               @endforeach\n' +
                    '\n' +
                    '                                                                                            </select>\n' +
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

                $('.headings').select2({
                    width: '100%',
                });

                $(document).on('change', '.headings', function () {

                    var id = this.value;

                    if(id)
                    {
                        if ($('.headings').find('option[value=' + id + ']:selected').length > 1) {

                            alert('This heading is already selected!');
                            this.options[0].selected = true;

                            $(this).val('');

                            $(this).select2("destroy");

                            $(this).select2({
                                width: '100%',
                            });
                        }
                    }

                });
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
