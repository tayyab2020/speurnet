@extends("admin.admin_app")

@section("content")


    <div id="main">
        <div class="page-header">

            <div class="pull-right">
                <a href="{{URL::to('admin/tickets/addticket')}}" class="btn btn-primary">@if(Auth::User()->usertype != "Admin") {{__('text.Add Ticket')}} @else Add Ticket @endif <i style="margin-left: 5px;position: relative;top: 1px;" class="fa fa-plus"></i></a>
            </div>

            <h2>Tickets @if(Auth::User()->usertype != "Admin") <small style="font-size: 15px;color: #b4b4b4;vertical-align: middle;margin-left: 5px;">{{__('text.Ticket Heading')}}</small> @endif</h2>
        </div>

        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                @if(Auth::User()->usertype == "Admin")

                    <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">

                        @else

                            <table id="data-table1" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">

                                @endif

                    <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>@if(Auth::User()->usertype != "Admin") {{__('text.Ticket Subject')}} @else Ticket Subject @endif</th>
                        <th>@if(Auth::User()->usertype != "Admin") {{__('text.Posted By')}} @else Posted By @endif</th>
                        <th>Email</th>
                        <th>@if(Auth::User()->usertype != "Admin") {{__('text.Created At')}} @else Created At @endif</th>
                        <th>@if(Auth::User()->usertype != "Admin") {{__('text.Priority')}} @else Priority @endif</th>
                        <th>Status</th>
                        <th class="text-center width-100">@if(Auth::User()->usertype != "Admin") {{__('text.Action')}} @else Action @endif</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($tickets as $i => $ticket)
                        <tr class="data-row">

                            <input type="hidden" id="ticket_id" value="{{$ticket->id}}">
                            <input type="hidden" id="ticket_code" value="{{$ticket->ticket_id}}">
                            <input type="hidden" id="subject" value="{{$ticket->subject}}">
                            <input type="hidden" id="name" value="{{$ticket->name}}">
                            <input type="hidden" id="email" value="{{$ticket->email}}">
                            @if(Auth::User()->usertype == "Admin")
                            <input type="hidden" id="ticket_priority" value="{{$ticket->priority}}">
                            <input type="hidden" id="ticket_status" value="{{$ticket->status}}">
                            @endif
                            <input type="hidden" id="issue" value="{{$ticket->issue}}">

                            <td>
                                <a href="{{ url('admin/tickets/addticket/'.$ticket->id) }}">{{$ticket->ticket_id}}</a>
                            </td>

                            <td>
                                {{$ticket->subject}}
                            </td>

                            <td>{{$ticket->name}}</td>

                            <td>{{$ticket->email}}</td>


                            <?php $date = date_format($ticket->created_at,"d M Y H:i"); ?>

                            <td>{{$date}}</td>

                            <td><div class="dropdown">

                                    @if(Auth::User()->usertype == "Admin")

                                        <button style="background: white;border: 1px solid #cccccc;border-radius: 50px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if($ticket->priority == 'High')  <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-danger"></i> @elseif($ticket->priority == 'Medium') <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-warning"></i> @else <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-success"></i>  @endif {{$ticket->priority}}
                                        </button>
                                        <div data-value="{{$ticket->priority}}" class="dropdown-menu menu-priority" aria-labelledby="dropdownMenuButton">
                                            <a data-id="{{$i}}" data-value="High" class="dropdown-item dropdown-priority" href="#"><i class="fa fa-dot-circle-o text-danger"></i> High</a>
                                            <a data-id="{{$i}}" data-value="Medium" class="dropdown-item dropdown-priority" href="#"><i class="fa fa-dot-circle-o text-warning"></i> Medium</a>
                                            <a data-id="{{$i}}" data-value="Low" class="dropdown-item dropdown-priority" href="#"><i class="fa fa-dot-circle-o text-success"></i> Low</a>
                                        </div>

                                    @else

                                        <button style="background: white;border: 1px solid #cccccc;border-radius: 50px;" class="btn btn-secondary" type="button" aria-haspopup="true" aria-expanded="false">
                                            @if($ticket->priority == 'High') <?php $priority = __('text.High'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-danger"></i> @elseif($ticket->priority == 'Medium') <?php $priority = __('text.Medium'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-warning"></i> @else <?php $priority = __('text.Low'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-success"></i>  @endif {{$priority}}
                                        </button>

                                    @endif

                                </div></td>

                            <td><div class="dropdown">

                                    @if(Auth::User()->usertype == "Admin")

                                        <button style="background: white;border: 1px solid #cccccc;border-radius: 50px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if($ticket->status == 'Open')  <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-info"></i> @elseif($ticket->status == 'Reopened') <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-info"></i> @elseif($ticket->status == 'On Hold') <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-danger"></i> @elseif($ticket->status == 'Closed') <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-success"></i> @elseif($ticket->status == 'In Progress') <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-success"></i> @else <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-danger"></i>  @endif {{$ticket->status}}
                                        </button>

                                        <div data-value="{{$ticket->status}}" class="dropdown-menu menu-status" aria-labelledby="dropdownMenuButton">
                                            <a data-id="{{$i}}" data-value="Open" class="dropdown-item dropdown-status" href="#"><i class="fa fa-dot-circle-o text-info"></i> Open</a>
                                            <a data-id="{{$i}}" data-value="Reopened" class="dropdown-item dropdown-status" href="#"><i class="fa fa-dot-circle-o text-info"></i> Reopened</a>
                                            <a data-id="{{$i}}" data-value="On Hold" class="dropdown-item dropdown-status" href="#"><i class="fa fa-dot-circle-o text-danger"></i> On Hold</a>
                                            <a data-id="{{$i}}" data-value="Closed" class="dropdown-item dropdown-status" href="#"><i class="fa fa-dot-circle-o text-success"></i> Closed</a>
                                            <a data-id="{{$i}}" data-value="In Progress" class="dropdown-item dropdown-status" href="#"><i class="fa fa-dot-circle-o text-success"></i> In Progress</a>
                                            <a data-id="{{$i}}" data-value="Cancelled" class="dropdown-item dropdown-status" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Cancelled</a>
                                        </div>

                                        @else

                                        <button style="background: white;border: 1px solid #cccccc;border-radius: 50px;" class="btn btn-secondary" type="button" aria-haspopup="true" aria-expanded="false">
                                            @if($ticket->status == 'Open') <?php $status = __('text.Open'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-info"></i> @elseif($ticket->status == 'Reopened') <?php $status = __('text.Reopened'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-info"></i> @elseif($ticket->status == 'On Hold') <?php $status = __('text.On Hold'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-danger"></i> @elseif($ticket->status == 'Closed') <?php $status = __('text.Closed'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-success"></i> @elseif($ticket->status == 'In Progress') <?php $status = __('text.In Progress'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-success"></i> @else <?php $status = __('text.Cancelled'); ?> <i style="margin-right: 5px;" class="fa fa-dot-circle-o text-danger"></i>  @endif {{$status}}
                                        </button>

                                    @endif

                                </div></td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        @if(Auth::user()->usertype != 'Admin'){{__('text.Action')}}s @else Actions @endif <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a class="send-mail" style="cursor: pointer;"><i class="md md-mail"></i> {{__('text.Send Email')}}</a></li>
                                        <li><a href="{{ url('admin/tickets/addticket/'.$ticket->id) }}"><i class="md md-edit"></i> {{__('text.Edit Editor')}}</a></li>
                                        <li><a href="{{ url('admin/tickets/delete/'.$ticket->id) }}"><i class="md md-delete"></i> {{__('text.Delete')}}</a></li>
                                    </ul>
                                </div>

                            </td>

                            @if(Auth::User()->usertype != "Admin")
                                <input type="hidden" id="ticket_priority" value="{{$priority}}">
                                <input type="hidden" id="ticket_status" value="{{$status}}">
                            @endif
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>

            <div id="myModal" class="modal fade" role="dialog">

                <div class="modal-dialog">

                {!! Form::open(array('url' => array('admin/tickets/update'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'update_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Status / Priority</h4>
                        </div>

                        <div class="modal-body">

                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="rec_name" id="rec_name">
                            <input type="hidden" name="type" id="type">
                            <input type="hidden" name="ticket_subject" id="ticket_subject">
                            <input type="hidden" name="ticket_issue" id="ticket_issue">
                            <input type="hidden" name="code" id="code">

                                <div class="form-group" style="display: inline-block;width: 100%;margin: 5px 0px;">
                                    <label style="margin-bottom: 5px;" for="" class="col-sm-3 control-label">Ticket Priority</label>
                                    <div class="col-sm-12">
                                        <input readonly type="text" placeholder="Ticket Priority" name="priority" id="priority"  class="form-control">
                                    </div>
                                </div>

                                <div class="form-group" style="display: inline-block;width: 100%;margin: 5px 0px;">
                                    <label style="margin-bottom: 5px;" for="" class="col-sm-3 control-label">Ticket Status</label>
                                    <div class="col-sm-12">
                                        <input readonly type="text" placeholder="Ticket Status" name="status" id="status" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group" style="display: inline-block;width: 100%;margin: 5px 0px;">
                                    <label style="margin-bottom: 5px;" for="" class="col-sm-3 control-label">Recipient Email</label>
                                    <div class="col-sm-12">
                                        <input required type="email" placeholder="Recipient Email" id="email_to" name="email_to" class="form-control id1">
                                    </div>
                                </div>

                                <div class="form-group" style="display: inline-block;width: 100%;margin: 5px 0px;">
                                    <label style="margin-bottom: 5px;" for="" class="col-sm-3 control-label">Message</label>
                                    <div class="col-sm-12">
                                        <textarea rows="6" placeholder="Message" name="message" class="form-control"></textarea>
                                    </div>
                                </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="save" class="btn btn-success" data-dismiss="modal">Save</button>
                            <button type="button" id="send" class="btn btn-success"><i class="fa fa-send" style="margin-right: 5px;"></i>Send</button>
                        </div>

                    </div>

                    {!! Form::close() !!}

                </div>

            </div>


            <div id="mailModal" class="modal fade" role="dialog">

                <div class="modal-dialog">

                {!! Form::open(array('url' => array('admin/tickets/send-mail'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'mail_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">@if(Auth::User()->usertype != "Admin"){{__('text.Send Email to ask your query')}}@else Send Email to ask your query @endif</h4>
                        </div>

                        <div class="modal-body">

                            <input type="hidden" name="id" id="tk_id">
                            <input type="hidden" name="tk_rec_name" id="tk_rec_name">
                            <input type="hidden" name="tk_subject" id="tk_subject">
                            <input type="hidden" name="tk_issue" id="tk_issue">
                            <input type="hidden" name="tk_code" id="tk_code">

                            <div class="form-group" style="display: inline-block;width: 100%;margin: 5px 0px;">
                                <label style="margin-bottom: 5px;" for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin"){{__('text.Ticket Priority')}}@else Ticket Priority @endif</label>
                                <div class="col-sm-12">
                                    <input type="text" readonly id="fk_priority" class="form-control">
                                    <input type="hidden" placeholder="Ticket Priority" name="tk_priority" id="tk_priority" class="form-control">
                                </div>
                            </div>

                            <div class="form-group" style="display: inline-block;width: 100%;margin: 5px 0px;">
                                <label style="margin-bottom: 5px;" for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin"){{__('text.Ticket Status')}}@else Ticket Status @endif</label>
                                <div class="col-sm-12">
                                    <input type="text" readonly id="fk_status" class="form-control">
                                    <input type="hidden" placeholder="Ticket Status" name="tk_status" id="tk_status" class="form-control">
                                </div>
                            </div>

                            @if(Auth::user()->usertype == 'Admin')

                            <div class="form-group" style="display: inline-block;width: 100%;margin: 5px 0px;">
                                <label style="margin-bottom: 5px;" for="" class="col-sm-3 control-label">Recipient Email</label>
                                <div class="col-sm-12">
                                    <input readonly type="email" placeholder="Recipient Email" id="tk_email_to" name="tk_email_to" class="form-control">
                                </div>
                            </div>

                            @endif

                            <div class="form-group" style="display: inline-block;width: 100%;margin: 5px 0px;">
                                <label style="margin-bottom: 5px;" for="" class="col-sm-3 control-label">@if(Auth::User()->usertype != "Admin"){{__('text.Message')}}@else Message @endif</label>
                                <div class="col-sm-12">
                                    <textarea required rows="6" @if(Auth::User()->usertype != "Admin") placeholder="{{__('text.Message')}}" @else placeholder="Message" @endif name="tk_message" class="form-control id2"></textarea>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="send-mail-btn" class="btn btn-success"><i class="fa fa-send" style="margin-right: 5px;"></i>Send</button>
                        </div>

                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>

    </div>

    <style>

        .dropdown .dropdown-toggle::after
        {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;

        }


        .dropdown-menu a{
            display: block;
            padding: 5px 10px;
            width: 100%;
            white-space: nowrap;
            text-decoration: none;
            color: #212529;
        }

        .dropdown-menu a i{ margin-right: 5px; }

        .text-danger
        {
            color: #f62d51 !important;
        }

        .text-warning
        {
            color: #ffbc34 !important;
        }

        .text-success
        {
            color: #55ce63 !important;
        }

        .text-info
        {
            color: #009efb !important;
        }

        .validation
        {
            border: 1px solid red !important;
        }


    </style>

    <script>

        $(document).ready(function(){ //Make script DOM ready

            $('#data-table1').dataTable( {
                "lengthChange": false,
                "oLanguage": {
                    "sLengthMenu": "<?php echo __('text.Show') . ' _MENU_ ' . __('text.records'); ?>",
                    "sSearch": "<?php echo __('text.Search') . ':' ?>",
                    "sInfo": "<?php echo __('text.Showing') . ' _START_ ' . __('text.to') . ' _END_ ' . __('text.of') . ' _TOTAL_ ' . __('text.items'); ?>",
                    "oPaginate": {
                        "sPrevious": "<?php echo __('text.Previous'); ?>",
                        "sNext": "<?php echo __('text.Next'); ?>"
                    },
                    "sEmptyTable": '<?php echo __('text.No data available in table'); ?>'
                }
            });

            $('#save').click(function() {

                $('#type').val(0);

                var inpObj = $('.id1');

                if (!inpObj.val()) {
                    inpObj.addClass('validation');
                }
                else
                {
                    inpObj.removeClass('validation');
                    $('#update_form').submit();
                }

            });

            $('#send').click(function() {

                $('#type').val(1);

                var inpObj = $('.id1');

                if(!inpObj.val()) {

                    inpObj.addClass('validation');
                }
                else
                {
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                    if(!regex.test(inpObj.val()))
                    {
                        inpObj.addClass('validation');
                    }
                    else
                    {
                        inpObj.removeClass('validation');
                        $('#update_form').submit();
                    }

                }

            });

            $('#send-mail-btn').click(function() {

                var inpObj = $('.id2');

                if (!inpObj.val()) {
                    inpObj.addClass('validation');
                }
                else
                {
                    inpObj.removeClass('validation');
                    $('#mail_form').submit();
                }

            });

            $('.dropdown-priority').click(function() {

                var priority = $(this).data('value');

                var status = $(this).closest('tr').children('#ticket_status').val();

                var email = $(this).closest("tr").children('#email').val();

                var id = $(this).closest('tr').children("#ticket_id").val();

                var name = $(this).closest('tr').children("#name").val();

                var subject = $(this).closest('tr').children("#subject").val();

                var issue = $(this).closest('tr').children("#issue").val();

                var ticket_code = $(this).closest('tr').children("#ticket_code").val();


                $("#id").val(id);
                $("#rec_name").val(name);
                $("#email_to").val(email);
                $("#priority").val(priority);
                $("#status").val(status);
                $("#ticket_subject").val(subject);
                $("#ticket_issue").val(issue);
                $("#code").val(ticket_code);

                $('#myModal').modal("show"); //Open Modal


            });

            $('.dropdown-status').click(function() {

                var status = $(this).data('value');

                var priority = $(this).closest('tr').children('#ticket_priority').val();

                var email = $(this).closest("tr").children('#email').val();

                var id = $(this).closest('tr').children("#ticket_id").val();

                var name = $(this).closest('tr').children("#name").val();

                var subject = $(this).closest('tr').children("#subject").val();

                var issue = $(this).closest('tr').children("#issue").val();

                var ticket_code = $(this).closest('tr').children("#ticket_code").val();

                $("#id").val(id);
                $("#rec_name").val(name);
                $("#email_to").val(email);
                $("#priority").val(priority);
                $("#status").val(status);
                $("#ticket_subject").val(subject);
                $("#ticket_issue").val(issue);
                $("#code").val(ticket_code);

                $('#myModal').modal("show"); //Open Modal


            });


            $('.send-mail').click(function() {

                var priority = $(this).closest('tr').children('#ticket_priority').val();

                var status = $(this).closest('tr').children('#ticket_status').val();

                var email = $(this).closest("tr").children('#email').val();

                var id = $(this).closest('tr').children("#ticket_id").val();

                var name = $(this).closest('tr').children("#name").val();

                var subject = $(this).closest('tr').children("#subject").val();

                var issue = $(this).closest('tr').children("#issue").val();

                var ticket_code = $(this).closest('tr').children("#ticket_code").val();


                $("#tk_id").val(id);
                $("#tk_rec_name").val(name);
                $("#tk_email_to").val(email);
                $("#tk_priority").val(priority);
                $("#fk_priority").val(priority);
                $("#tk_status").val(status);
                $("#fk_status").val(status);
                $("#tk_subject").val(subject);
                $("#tk_issue").val(issue);
                $("#tk_code").val(ticket_code);

                $('#mailModal').modal("show"); //Open Modal


            });

        });

    </script>


@endsection
