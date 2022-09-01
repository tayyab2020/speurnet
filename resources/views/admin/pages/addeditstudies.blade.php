@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> {{ isset($slide->name) ? 'Edit: '. $slide->title : 'Add' }}</h2>

            <a href="{{ URL::to('admin/studies') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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

            {!! Form::open(array('url' => array('admin/study/addstudy'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($slide->id) ? $slide->id : null }}">

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Title*</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" value="{{ isset($slide->title) ? $slide->title : null }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Venue</label>
                    <div class="col-sm-9">
                        <input type="text" name="venue" value="{{ isset($slide->venue) ? $slide->venue : null }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Address*</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" value="{{ isset($slide->address) ? $slide->address : null }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Date & Time*</label>
                    <div class="col-sm-9">
                        <input readonly style="background: transparent;" type="text" name="date_time" value="{{ isset($slide->date_time) ? $slide->date_time : null }}" class="form-control datetimepicker4">
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea name="description" rows="10" class="form-control summernote">{{ isset($slide->description) ? $slide->description : null }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-size: 20px;" for="" class="col-sm-3 control-label">Category*</label>
                    <div class="col-sm-9">

                        <select class="category" name="category">
                            
                            <option value="">Select Category</option>
                            
                            @foreach($categories as $key)

                                <option {{isset($slide->category) ? ($key->id == $slide->category ? 'selected' : null) : null}} value="{{$key->id}}">{{$key->title}}</option>

                            @endforeach

                        </select>

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

                            <?php $category_ids = explode(',',$slide->types); ?>

                            @foreach($category_ids as $x => $temp)

                                <tr data-id="{{$x+1}}">
                                    <td>
                                        <select class="types" name="types[]">

                                            <option value="">Select Filter</option>

                                            @foreach($types as $key)

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
                                    <select class="types" name="types[]">

                                        <option value="">Select Filter</option>

                                        @foreach($types as $key)

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

                    <h4 style="border-bottom: 1px solid #dadada;padding-bottom: 20px;color: #444444;text-align: center;">Features</h4>

                </div>

                <div class="table table2 form-group">

                    <table style="margin: auto;">

                        <thead>
                        <tr>
                            <th style="border-top-left-radius: 9px;">Image</th>
                            <th>Title 1</th>
                            <th>Title 2</th>
                            <th style="width: 10%;border-top-right-radius: 9px;"></th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(isset($features))

                            @foreach($features as $x => $temp)

                                <tr data-id="{{$x+1}}">
                                    <td>

                                        @if($temp->image)

                                            <img style="margin-bottom: 10px;" src="{{ URL::asset('upload/'.$temp->image) }}" width="200" alt="person">

                                        @endif

                                        <input type="file" name="feature_images[]" class="filestyle">
                                    </td>
                                    <td>
                                        <input type="text" name="feature_headings1[]" value="{{ isset($temp->heading1) ? $temp->heading1 : null }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="feature_headings2[]" value="{{ isset($temp->heading2) ? $temp->heading2 : null }}" class="form-control">
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
                                    <input type="file" name="feature_images[]" class="filestyle">
                                </td>
                                <td>
                                    <input type="text" name="feature_headings1[]" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="feature_headings2[]" class="form-control">
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

                <div style="margin: 50px 0 0 0;" class="row">

                    <h4 style="border-bottom: 1px solid #dadada;padding-bottom: 20px;color: #444444;text-align: center;">Links</h4>

                </div>

                <div class="table table3 form-group">

                    <table style="margin: auto;">

                        <thead>
                        <tr>
                            <th style="border-top-left-radius: 9px;">Image</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th style="width: 10%;border-top-right-radius: 9px;"></th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(isset($links))

                            @foreach($links as $x => $temp)

                                <tr data-id="{{$x+1}}">
                                    <td>
                                        
                                        @if($temp->image)

                                            <img style="margin-bottom: 10px;" src="{{ URL::asset('upload/'.$temp->image) }}" width="200" alt="person">

                                        @endif
                                        
                                        <input type="file" name="link_images[]" class="filestyle">
                                    </td>
                                    <td>
                                        <input type="text" name="link_titles[]" value="{{ isset($temp->title) ? $temp->title : null }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="link_urls[]" value="{{ isset($temp->link) ? $temp->link : null }}" class="form-control">
                                    </td>
                                    <td style="text-align: center;">

                                        <span id="next-row-span" class="tooltip1 add-row2" data-id="" style="cursor: pointer;font-size: 20px;">
                                            <i id="next-row-icon" class="fa fa-fw fa-plus"></i>
                                        </span>

                                        <span data-id="" id="next-row-span" class="tooltip1 remove-row2" style="cursor: pointer;font-size: 20px;margin-left: 10px;">
                                            <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>
                                        </span>

                                    </td>
                                </tr>

                            @endforeach

                        @else

                            <tr data-id="1">
                                <td>
                                    <input type="file" name="link_images[]" class="filestyle">
                                </td>
                                <td>
                                    <input type="text" name="link_titles[]" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="link_urls[]" class="form-control">
                                </td>
                                <td style="text-align: center;">

                                    <span id="next-row-span" class="tooltip1 add-row2" data-id="" style="cursor: pointer;font-size: 20px;">
                                        <i id="next-row-icon" class="fa fa-fw fa-plus"></i>
                                    </span>

                                    <span data-id="" id="next-row-span" class="tooltip1 remove-row2" style="cursor: pointer;font-size: 20px;margin-left: 10px;">
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

        $('.datetimepicker4').datetimepicker({format: 'DD-MM-YYYY HH:mm',locale: 'nl',ignoreReadonly: true,sideBySide: true,});

        $('.category').select2({
            width: '100%',
        });

        $('.types').select2({
            width: '100%',
        });

        $(document).on('change', '.types', function () {

            var id = this.value;

            if(id)
            {
                if ($('.types').find('option[value=' + id + ']:selected').length > 1) {

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

        $(document).on('click', '.add-row', function () {

            var row = $('.table1 table tbody tr:last').data('id');
            row = row + 1;

            $(".table1 table tbody").append('<tr data-id="'+row+'">\n' +
                '                                                                                        <td>\n' +
                '                                                                                            <select class="types" name="types[]">\n' +
                '\n' +
                '                                                                                               <option value="">Select Filter</option>\n' +
                '\n' +
                '                                                                                               @foreach($types as $key)\n' +
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

            $('.types').select2({
                width: '100%',
            });

            $(document).on('change', '.types', function () {

                var id = this.value;

                if(id)
                {
                    if ($('.types').find('option[value=' + id + ']:selected').length > 1) {

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
                '\n' +
                '                                                                                            <input type="file" name="feature_images[]" class="filestyle">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="text" name="feature_headings1[]" class="form-control">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="text" name="feature_headings2[]" class="form-control">\n' +
                '\n' +
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

                $('.filestyle').filestyle({
                    input:false,
                    icon:false,
                    buttonText:'Upload',
                    buttonName:'btn-default'
                });

        });

        $(document).on('click', '.add-row2', function () {

            var row = $('.table3 table tbody tr:last').data('id');
            row = row + 1;

            $(".table3 table tbody").append('<tr data-id="'+row+'">\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="file" name="link_images[]" class="filestyle">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="text" name="link_titles[]" class="form-control">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="text" name="link_urls[]" class="form-control">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td style="text-align: center;">\n' +
                '                                                                                           <span id="next-row-span" class="tooltip1 add-row2" style="cursor: pointer;font-size: 20px;">\n' +
                '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-plus"></i>\n' +
                '                                                                                           </span>\n' +
                '\n' +
                '                                                                                           <span data-id="" id="next-row-span" class="tooltip1 remove-row2" style="cursor: pointer;font-size: 20px;margin-left: 10px;">\n' +
                '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>\n' +
                '                                                                                           </span>\n' +
                '                                                                                        </td>\n' +
                '                                                                </tr>');

                $('.filestyle').filestyle({
                    input:false,
                    icon:false,
                    buttonText:'Upload',
                    buttonName:'btn-default'
                });

        });


        $(document).on('click', '.remove-row', function () {

            $(this).parent().parent().remove();

            if($('.table1').find("table tbody tr").length == 0)
            {

                $(".table1 table tbody").append('<tr data-id="1">\n' +
                    '                                                                                        <td>\n' +
                    '                                                                                            <select class="types" name="types[]">\n' +
                    '\n' +
                    '                                                                                               <option value="">Select Filter</option>\n' +
                    '\n' +
                    '                                                                                               @foreach($types as $key)\n' +
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

                $('.types').select2({
                    width: '100%',
                });

                $(document).on('change', '.types', function () {

                    var id = this.value;

                    if(id)
                    {
                        if ($('.types').find('option[value=' + id + ']:selected').length > 1) {

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
                '\n' +
                '                                                                                            <input type="file" name="feature_images[]" class="filestyle">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="text" name="feature_headings1[]" class="form-control">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="text" name="feature_headings2[]" class="form-control">\n' +
                '\n' +
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

                $('.filestyle').filestyle({
                    input:false,
                    icon:false,
                    buttonText:'Upload',
                    buttonName:'btn-default'
                });
            }

        });

        $(document).on('click', '.remove-row2', function () {

            $(this).parent().parent().remove();

            if($('.table3').find("table tbody tr").length == 0)
            {

                $(".table3 table tbody").append('<tr data-id="1">\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="file" name="link_images[]" class="filestyle">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="text" name="link_titles[]" class="form-control">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td>\n' +
                '\n' +
                '                                                                                            <input type="text" name="link_urls[]" class="form-control">\n' +
                '\n' +
                '                                                                                        </td>\n' +
                '\n' +
                '                                                                                        <td style="text-align: center;">\n' +
                '                                                                                           <span id="next-row-span" class="tooltip1 add-row2" style="cursor: pointer;font-size: 20px;">\n' +
                '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-plus"></i>\n' +
                '                                                                                           </span>\n' +
                '\n' +
                '                                                                                           <span data-id="" id="next-row-span" class="tooltip1 remove-row2" style="cursor: pointer;font-size: 20px;margin-left: 10px;">\n' +
                '                                                                                               <i id="next-row-icon" class="fa fa-fw fa-trash-o"></i>\n' +
                '                                                                                           </span>\n' +
                '                                                                                        </td>\n' +
                '                                                                </tr>');

                $('.filestyle').filestyle({
                    input:false,
                    icon:false,
                    buttonText:'Upload',
                    buttonName:'btn-default'
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
