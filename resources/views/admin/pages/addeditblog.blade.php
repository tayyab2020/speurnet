@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> {{ isset($blog->name) ? 'Edit: '. $blog->name : 'Add Blog' }}</h2>

            <a href="{{ URL::to('admin/blogs') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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
                {!! Form::open(array('url' => array('admin/blogs/addblog'),'class'=>'form-horizontal padding-15','name'=>'addblog_form','id'=>'addblog_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <input type="hidden" name="id" value="{{ isset($blog->id) ? $blog->id : null }}">


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

                <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>


                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($blog->image))

                                    <img src="{{ URL::asset('upload/blogs/'.$blog->image) }}" width="100" alt="person">
                                @endif

                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="image" class="filestyle">
                            </div>
                        </div>

                    </div>
                </div>



                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{ isset($blog->title) ? 'Edit Blog' : 'Add Blog' }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


    </div>

@endsection
