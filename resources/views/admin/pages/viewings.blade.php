@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">
            <h2>@if(Auth::User()->usertype != "Admin") {{__('text.Requested Viewings')}} @else Requested Viewings @endif</h2>
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

                <table id="data-table1" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>@if(Auth::User()->usertype != "Admin"){{__('text.Property ID')}}@else Property ID @endif</th>
                        <th>@if(Auth::User()->usertype != "Admin"){{__('text.Agent')}}@else Agent @endif</th>
                        <th>@if(Auth::User()->usertype != "Admin"){{__('text.Name')}}@else Name @endif</th>
                        <th>Email</th>
                        <th>@if(Auth::User()->usertype != "Admin"){{__('text.Phone')}}@else Phone @endif</th>
                        <th>@if(Auth::User()->usertype != "Admin"){{__('text.Preferred Day')}}@else Preferred Day @endif</th>
                        <th>@if(Auth::User()->usertype != "Admin"){{__('text.Preferred Moment')}}@else Preferred Moment @endif</th>
                        <th>@if(Auth::User()->usertype != "Admin"){{__('text.Sent On')}}@else Posting Date @endif</th>
                        <th>@if(Auth::User()->usertype != "Admin"){{__('text.Message')}}@else Message @endif</th>
                        <th class="text-center width-100">@if(Auth::User()->usertype != "Admin"){{__('text.Action')}}@else Action @endif</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($viewingslist as $i => $viewings)

                        <?php
                        $date=date_create($viewings->created_at);
                        $date = date_format($date,"d-F-Y");
                        ?>

                        @if(isset($viewings->user->name))

                        <tr>

                            <td>{{ $viewings->property_id }}</td>
                            <td>{{ $viewings->user->name }}</td>
                            <td>{{ $viewings->name }}</td>
                            <td>{{ $viewings->email }}</td>
                            <td>{{ $viewings->phone }}</td>
                            <td>{{ $viewings->day }}</td>
                            <td>{{ $viewings->moment }}</td>
                            <td>{{ $date }}</td>
                            <td>{{ $viewings->message }}</td>
                            <td class="text-center">
                                <a href="{{ url('admin/viewings/delete/'.$viewings->id) }}" class="btn btn-default btn-rounded"><i class="md md-delete"></i></a>
                            </td>

                        </tr>

                        @endif

                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){

            @if(Auth::User()->usertype == "Admin")

            $('#data-table1').dataTable({
                "lengthChange": false,
                "order": [[ 0, "desc" ]] // Order on init. # is the column, starting at 0
            });

            @else

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

            @endif

            $('#data-table1 tr').click(function () {

                if($('#data-table1 tr').hasClass("bg_color"))
                {
                    $('#data-table1 tr').removeClass("bg_color");
                }
                else
                {
                    $(this).addClass("bg_color");
                }


            });

        });
    </script>


    <style>

        tr.bg_color  {
            background-color: #edf671 !important;
        }

    </style>

@endsection
