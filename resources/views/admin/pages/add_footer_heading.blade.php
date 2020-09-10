@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">

            <h2> {{ isset($footer_heading->id) ? 'Edit Footer Heading' : 'Add Footer Heading' }}</h2>

            <a href="{{ URL::to('admin/footer-headings') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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

                {!! Form::open(array('url' => array('admin/footer-headings/add-footer-heading'),'class'=>'form-horizontal padding-15','name'=>'addfooterheading_form','id'=>'addfooterheading_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($footer_heading->id) ? $footer_heading->id : null }}">


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Footer Heading</label>
                    <div class="col-sm-9">
                        <input type="text" name="heading" value="{{ isset($footer_heading->heading) ? $footer_heading->heading : null }}" class="form-control">
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
                        <button type="submit" class="btn btn-primary">{{ isset($footer_heading->id) ? 'Edit Footer Heading' : 'Add Footer Heading' }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


    </div>

@endsection
