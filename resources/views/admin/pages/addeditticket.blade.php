@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2><?php if(Auth::User()->usertype != "Admin"){ if(isset($ticket->id)) { echo __('text.Edit') . ' ticket'; } else { echo __('text.Save') . ' ticket'; } } else { if(isset($ticket->id)) { echo 'Edit Ticket'; } else { echo 'Save Ticket'; } } ?></h2>

            <a href="{{ URL::to('admin/tickets') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> @if(Auth::User()->usertype != "Admin") {{__('text.Back')}} @else Back @endif</a>

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
                    <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.Ticket Subject')}} @else Ticket Subject @endif</label>
                    <div class="col-sm-9">
                        <input type="text" required @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Ticket Subject')}}" @else placeholder="Ticket Subject" @endif name="ticket_subject" value="{{ isset($ticket->subject) ? $ticket->subject : old('ticket_subject') }}" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin") {{__('text.Priority')}} @else Priority @endif</label>
                    <div class="col-sm-9">
                        <select name="priority" class="form-control">
                            <option {{ isset($ticket->priority) ? ($ticket->priority == 'High') ? 'selected' : null : null }} value="High">@if(Auth::User()->usertype != "Admin"){{__('text.High')}}@else High @endif</option>
                            <option {{ isset($ticket->priority) ? ($ticket->priority == 'Medium') ? 'selected' : null : null }} value="Medium">@if(Auth::User()->usertype != "Admin"){{__('text.Medium')}}@else Medium @endif</option>
                            <option {{ isset($ticket->priority) ? ($ticket->priority == 'Low') ? 'selected' : null : null }} value="Low">@if(Auth::User()->usertype != "Admin"){{__('text.Low')}}@else Low @endif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin"){{__('text.Description')}}@else Description @endif</label>
                    <div class="col-sm-9">
                        <textarea required rows="7" name="ticket_issue" class="form-control" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Description')}}" @else placeholder="Description" @endif>{{ isset($ticket->issue) ? $ticket->issue : old('ticket_issue') }}</textarea>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 30px;">
                    <label for="avatar" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin"){{__('text.Ticket Images')}}@else Ticket Images @endif</label>
                    <div class="col-sm-9">
                        <div class="media">
                                @if(isset($ticket_images))
                                <div class="media-left" style="display: block;margin-bottom: 10px;">
                                    @foreach($ticket_images as $key)
                                        <a target="_blank" href="{{ URL::asset('upload/tickets/'.$key->image) }}">
                                            <img style="width: 250px;height: 150px;" src="{{ URL::asset('upload/tickets/'.$key->image) }}" width="200" alt="person">
                                        </a>
                                    @endforeach
                                </div>
                                @endif

                            <div class="media-body media-middle">
                                <input type="file" multiple name="images[]" class="filestyle">
                                <small style="display: block;margin-top: 10px;">@if(Auth::User()->usertype != "Admin"){{__('text.Press &amp; hold CTRL key to select multiple files.')}}@else Press &amp; hold CTRL key to select multiple files. @endif</small>
                            </div>
                        </div>

                    </div>
                </div>



                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary"><?php if(Auth::User()->usertype != "Admin"){ if(isset($ticket->id)) { echo __('text.Edit'); } else { echo __('text.Save'); } } else { if(isset($ticket->id)) { echo 'Edit'; } else { echo 'Save'; } } ?></button>

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
