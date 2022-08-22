@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> {{ isset($slide->name) ? 'Edit: '. $slide->title : 'Add' }}</h2>

            <a href="{{ URL::to('admin/place-to-do-contents') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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

            {!! Form::open(array('url' => array('admin/place-to-do-content/add'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($slide->id) ? $slide->id : null }}">

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Title*</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" value="{{ isset($slide->title) ? $slide->title : null }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Description*</label>
                    <div class="col-sm-9">
                        <textarea name="description" rows="10" class="form-control summernote">{{ isset($slide->description) ? $slide->description : null }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($slide->image))

                                    @if($slide->image)

                                        <img src="{{ URL::asset('upload/'.$slide->image) }}" width="200" alt="person">

                                    @else

                                        <img src="{{ URL::asset('upload/noImage.png') }}" width="200" alt="person">

                                    @endif

                                @endif
                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="image" class="filestyle">
                            </div>
                        </div>

                    </div>
                </div>

                <div style="margin: 50px 0 0 0;" class="row">

                    <h4 style="border-bottom: 1px solid #dadada;padding-bottom: 20px;color: #444444;text-align: center;">Filters</h4>

                </div>

                <div class="table table1 form-group">

                    <table style="margin: auto;">

                        <thead>
                        <tr>
                            <th style="border-top-left-radius: 9px;">Title</th>                            
                            <th style="width: 10%;border-top-right-radius: 9px;"></th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(isset($slide))

                            <?php $filter_ids = explode(',',$slide->filter_ids); ?>

                            @foreach($filter_ids as $x => $temp)

                                <tr data-id="{{$x+1}}">
                                    <td>
                                        <select class="filters" name="filters[]" required>

                                            <option value="">Select Filter</option>

                                            @foreach($filters as $key)

                                                <option {{$key->id == $temp ? 'selected' : null}} value="{{$key->id}}">{{$key->title}}</option>

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
                                    <select class="filters" name="filters[]" required>

                                        <option value="">Select Filter</option>

                                        @foreach($filters as $key)

                                            <option value="{{$key->id}}">{{$key->title}}</option>

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

                <div style="margin: 50px 0 0 0;" class="row">

                    <h4 style="border-bottom: 1px solid #dadada;padding-bottom: 20px;color: #444444;text-align: center;">Places</h4>

                </div>

                <div class="table table2 form-group">

                    <table style="margin: auto;">

                        <thead>
                        <tr>
                            <th style="border-top-left-radius: 9px;">Title</th>                            
                            <th style="width: 10%;border-top-right-radius: 9px;"></th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(isset($slide))

                            <?php $place_ids = explode(',',$slide->place_ids); ?>

                            @foreach($place_ids as $x => $temp)

                                <tr data-id="{{$x+1}}">
                                    <td>
                                        <select class="places" name="places[]" required>

                                            <option value="">Select Place</option>

                                            @foreach($places as $key)

                                                <option {{$key->id == $temp ? 'selected' : null}} value="{{$key->id}}">{{$key->title}}</option>

                                            @endforeach

                                        </select>
                                    </td>
                                    <td style="text-align: center;">

                                        <span id="next-row-span" class="tooltip1 add-row1" data-id="" style="cursor: pointer;font-size: 20px;">
                                            <i id="next-row-icon" class="fa fa-fw fa-plus"></i>
                                        </span>

                                        <span data-id="" id="next-row-span" class="tooltip1 remove-row1" style="cursor: pointer;font-size: 20px;margin-left: 10px;">
                                            <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>
                                        </span>

                                    </td>
                                </tr>

                            @endforeach

                        @else

                            <tr data-id="1">
                                <td>
                                    <select class="places" name="places[]" required>

                                        <option value="">Select Place</option>

                                        @foreach($places as $key)

                                            <option value="{{$key->id}}">{{$key->title}}</option>

                                        @endforeach
                                    
                                    </select>
                                </td>
                                <td style="text-align: center;">

                                    <span id="next-row-span" class="tooltip1 add-row1" data-id="" style="cursor: pointer;font-size: 20px;">
                                        <i id="next-row-icon" class="fa fa-fw fa-plus"></i>
                                    </span>

                                    <span data-id="" id="next-row-span" class="tooltip1 remove-row1" style="cursor: pointer;font-size: 20px;margin-left: 10px;">
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
                        <button type="submit" class="btn btn-primary">{{ isset($slide->id) ? 'Edit' : 'Save' }}</button>

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

        $('.filters').select2({
            width: '100%',
        });

        $('.places').select2({
            width: '100%',
        });

        $(document).on('change', '.filters', function () {

            var id = this.value;

            if(id)
            {
                if ($('.filters').find('option[value=' + id + ']:selected').length > 1) {

                    alert('This filter is already selected!');
                    this.options[0].selected = true;

                    $(this).val('');

                    $(this).select2("destroy");

                    $(this).select2({
                        width: '100%',
                    });
                }
            }

        });

        $(document).on('change', '.places', function () {

            var id = this.value;

            if(id)
            {
                if ($('.places').find('option[value=' + id + ']:selected').length > 1) {

                    alert('This place is already selected!');
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

            var row = $('.table1 table tbody tr:last').data('id');
            row = row + 1;

            $(".table1 table tbody").append('<tr data-id="'+row+'">\n' +
                '                                                                                        <td>\n' +
                '                                                                                            <select class="filters" name="filters[]" required>\n' +
                '\n' +
                '                                                                                               <option value="">Select Filter</option>\n' +
                '\n' +
                '                                                                                               @foreach($filters as $key)\n' +
                '\n' +
                '                                                                                                 <option value="{{$key->id}}">{{$key->title}}</option>\n' +
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

            $('.filters').select2({
                width: '100%',
            });

            $(document).on('change', '.filters', function () {

                var id = this.value;

                if(id)
                {
                    if ($('.filters').find('option[value=' + id + ']:selected').length > 1) {

                        alert('This filter is already selected!');
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


        $(document).on('click', '.add-row1', function () {

            var row = $('.table2 table tbody tr:last').data('id');
            row = row + 1;

            $(".table2 table tbody").append('<tr data-id="'+row+'">\n' +
                '                                                                                        <td>\n' +
                '                                                                                            <select class="places" name="places[]" required>\n' +
                '\n' +
                '                                                                                               <option value="">Select Place</option>\n' +
                '\n' +
                '                                                                                               @foreach($places as $key)\n' +
                '\n' +
                '                                                                                                 <option value="{{$key->id}}">{{$key->title}}</option>\n' +
                '\n' +
                '                                                                                               @endforeach\n' +
                '\n' +
                '                                                                                            </select>\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td style="text-align: center;">\n' +
                '                                                                                           <span id="next-row-span" class="tooltip1 add-row1" style="cursor: pointer;font-size: 20px;">\n' +
                '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-plus"></i>\n' +
                '                                                                                           </span>\n' +
                '\n' +
                '                                                                                           <span data-id="" id="next-row-span" class="tooltip1 remove-row1" style="cursor: pointer;font-size: 20px;margin-left: 10px;">\n' +
                '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>\n' +
                '                                                                                           </span>\n' +
                '                                                                                        </td>\n' +
                '                                                                </tr>');

            $('.places').select2({
                width: '100%',
            });

            $(document).on('change', '.places', function () {

                var id = this.value;

                if(id)
                {
                    if ($('.places').find('option[value=' + id + ']:selected').length > 1) {

                        alert('This place is already selected!');
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

            if($('.table1').find("table tbody tr").length == 0)
            {

                $(".table1 table tbody").append('<tr data-id="1">\n' +
                    '                                                                                        <td>\n' +
                    '                                                                                            <select class="filters" name="filters[]" required>\n' +
                    '\n' +
                    '                                                                                               <option value="">Select Filter</option>\n' +
                    '\n' +
                    '                                                                                               @foreach($filters as $key)\n' +
                    '\n' +
                    '                                                                                                 <option value="{{$key->id}}">{{$key->title}}</option>\n' +
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

                $('.filters').select2({
                    width: '100%',
                });

                $(document).on('change', '.filters', function () {

                    var id = this.value;

                    if(id)
                    {
                        if ($('.filters').find('option[value=' + id + ']:selected').length > 1) {

                            alert('This filter is already selected!');
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


        $(document).on('click', '.remove-row1', function () {

            $(this).parent().parent().remove();

            if($('.table2').find("table tbody tr").length == 0)
            {

                $(".table2 table tbody").append('<tr data-id="1">\n' +
                    '                                                                                        <td>\n' +
                    '                                                                                            <select class="places" name="places[]" required>\n' +
                    '\n' +
                    '                                                                                               <option value="">Select Place</option>\n' +
                    '\n' +
                    '                                                                                               @foreach($places as $key)\n' +
                    '\n' +
                    '                                                                                                 <option value="{{$key->id}}">{{$key->title}}</option>\n' +
                    '\n' +
                    '                                                                                               @endforeach\n' +
                    '\n' +
                    '                                                                                            </select>\n' +
                    '                                                                                        </td>\n' +
                    '                                                                                        <td style="text-align: center;">\n' +
                    '                                                                                           <span id="next-row-span" class="tooltip1 add-row1" style="cursor: pointer;font-size: 20px;">\n' +
                    '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-plus"></i>\n' +
                    '                                                                                           </span>\n' +
                    '\n' +
                    '                                                                                           <span data-id="" id="next-row-span" class="tooltip1 remove-row1" style="cursor: pointer;font-size: 20px;margin-left: 10px;">\n' +
                    '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>\n' +
                    '                                                                                           </span>\n' +
                    '                                                                                        </td>\n' +
                    '                                                                </tr>');

                $('.places').select2({
                    width: '100%',
                });

                $(document).on('change', '.places', function () {

                    var id = this.value;

                    if(id)
                    {
                        if ($('.places').find('option[value=' + id + ']:selected').length > 1) {

                            alert('This place is already selected!');
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
