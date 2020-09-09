@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> {{ isset($ticket->id) ? 'Edit Ticket: '. $ticket->id : 'Add Ticket' }}</h2>

            <a href="{{ URL::to('admin/tickets') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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
                {!! Form::open(array('url' => array('admin/tickets/addticket'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <input type="hidden" name="id" value="{{ isset($ticket->id) ? $ticket->id : null }}">

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Ticket Subject</label>
                    <div class="col-sm-9">
                        <input type="text" required placeholder="Ticket Subject" name="ticket_subject" value="{{ isset($ticket->subject) ? $ticket->subject : old('ticket_subject') }}" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Priority</label>
                    <div class="col-sm-9">
                        <select name="priority" class="form-control">
                            <option {{ isset($ticket->priority) ? ($ticket->priority == 'High') ? 'selected' : null : null }} value="High">High</option>
                            <option {{ isset($ticket->priority) ? ($ticket->priority == 'Medium') ? 'selected' : null : null }} value="Medium">Medium</option>
                            <option {{ isset($ticket->priority) ? ($ticket->priority == 'Low') ? 'selected' : null : null }} value="Low">Low</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea required rows="7" name="ticket_issue" class="form-control" placeholder="Ticket Description">{{ isset($ticket->issue) ? $ticket->issue : old('ticket_issue') }}</textarea>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 30px;">
                    <label for="avatar" class="col-sm-3 control-label">Ticket Images</label>
                    <div class="col-sm-9">
                        <div class="media">
                                @if(isset($ticket_images))
                                <div class="media-left" style="display: block;margin-bottom: 10px;">
                                    @foreach($ticket_images as $key)
                                    <img style="width: 250px;height: 150px;" src="{{ URL::asset('upload/tickets/'.$key->image) }}" width="200" alt="person">
                                    @endforeach
                                </div>
                                @endif

                            <div class="media-body media-middle">
                                <input type="file" multiple name="images[]" class="filestyle">
                                <small style="position: relative;top: 5px;">Press &amp; hold CTRL key to select multiple files.</small>
                            </div>
                        </div>

                    </div>
                </div>



                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{ isset($ticket->id) ? 'Edit Ticket' : 'Save Ticket' }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>

    <style>

        .group-span-filestyle
        {
            outline: none;
        }

    </style>

@endsection
