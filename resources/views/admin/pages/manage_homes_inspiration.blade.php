@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">

            <h2>Manage Homes Inspiration</h2>

            <a href="{{ URL::to('admin/homes-inspiration') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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

                {!! Form::open(array('url' => array('admin/homes-inspiration/manage-homes-inspiration'),'class'=>'form-horizontal padding-15','name'=>'manage_homes_inspiration_form','id'=>'manage_homes_inspiration_form','role'=>'form','enctype' => 'multipart/form-data')) !!}


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Meta Keywords</label>
                    <div class="col-sm-9">
                        <input type="text" name="meta_keywords" value="{{ isset($blog->meta_keywords) ? $blog->meta_keywords : null }}" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Meta Sub Keywords</label>
                    <div class="col-sm-9">
                        <input type="text" name="meta_sub_keywords" value="{{ isset($blog->meta_sub_keywords) ? $blog->meta_sub_keywords : null }}" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Meta Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="meta_title" value="{{ isset($blog->meta_title) ? $blog->meta_title : null }}" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Meta Description</label>
                    <div class="col-sm-9">
                        <input type="text" name="meta_description" value="{{ isset($blog->meta_description) ? $blog->meta_description : null }}" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" value="{{ isset($blog->title) ? $blog->title : null }}" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">

                        <textarea name="description" rows="10" class="form-control summernote">{{ isset($blog->description) ? $blog->description : null }}</textarea>
                    </div>
                </div>


                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">

                        <button type="submit" class="btn btn-primary">Manage Home Inspiration</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
