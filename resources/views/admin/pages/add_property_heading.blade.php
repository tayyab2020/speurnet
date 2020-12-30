@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">

            <h2> {{ isset($heading->id) ? 'Edit Property Heading' : 'Add Property Heading' }}</h2>

            <a href="{{ URL::to('admin/properties-headings') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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

                {!! Form::open(array('url' => array('admin/properties-headings/add-properties-heading'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($heading->id) ? $heading->id : null }}">

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Heading *</label>
                    <div class="col-sm-9">
                        <input type="text" name="heading" required value="{{ isset($heading->title) ? $heading->title : null }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Heading Order</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="heading_order">

                            <option @if(isset($heading)) @if($heading->heading_order == 1) selected @endif @endif>1</option>
                            <option @if(isset($heading)) @if($heading->heading_order == 2) selected @endif @endif>2</option>
                            <option @if(isset($heading)) @if($heading->heading_order == 3) selected @endif @endif>3</option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Heading Background Color *</label>
                    <div class="col-sm-9">
                        <div id="cp2" class="input-group colorpicker-component">
                            <input value="{{ isset($heading->color) ? $heading->color : null }}" id="cp1" type="text" name="color" required="" class="form-control"/>
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                </div>

                <style>

                    .checkbox input[type="checkbox"]
                    {
                        opacity: 1;
                    }

                    .checkbox label::before {
                        display: none;
                    }

                </style>


                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{ isset($heading->id) ? 'Edit Properties Heading' : 'Add Properties Heading' }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


    </div>

    <script>

        $('#cp1').colorpicker();
        $('#cp2').colorpicker();

    </script>

@endsection
