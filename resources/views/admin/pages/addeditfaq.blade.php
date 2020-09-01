@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">

                <h2> {{ isset($faq->question) ? 'Edit FAQ' : 'Add FAQ' }}</h2>

                <a href="{{ URL::to('admin/faqs') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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

                    {!! Form::open(array('url' => array('admin/faqs/addfaq'),'class'=>'form-horizontal padding-15','name'=>'addfaq_form','id'=>'addfaq_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($faq->id) ? $faq->id : null }}">


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Question</label>
                    <div class="col-sm-9">
                        <input type="text" name="question" value="{{ isset($faq->question) ? $faq->question : null }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Answer</label>
                    <div class="col-sm-9">
                        <textarea name="answer" rows="10" class="form-control summernote">{{ isset($faq->answer) ? $faq->answer : null }}</textarea>
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
                        <button type="submit" class="btn btn-primary">{{ isset($faq->question) ? 'Edit Faq' : 'Add Faq' }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


    </div>

@endsection
