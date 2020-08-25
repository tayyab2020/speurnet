@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">


            <h2>Properties</h2>
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
                        <th style="width: 100px;">Property ID</th>
                        @if(Auth::user()->usertype=='Admin' || Auth::user()->usertype=='Users')
                            <th>Agent</th>
                        @endif

                        @if(Auth::user()->usertype=='Admin' || Auth::user()->usertype=='Agents')
                            <th>Client</th>
                        @endif
                        <th>Property Name</th>
                        <th>Type</th>
                        <th>Posting Date</th>
                        <th>Purpose</th>
                        @if(Auth::user()->usertype=='Users')
                        <th class="text-center width-100">Action</th>
                        @endif
                    </tr>
                    </thead>

                    <tbody>

                    <?php $i = 0; ?>

                    @foreach($propertieslist as $i => $property)

                        <?php
                        $date=date_create($property->created_at);
                        $date = date_format($date,"d-F-Y");
                        ?>

                        @if($property->id)

                        <tr>

                            <td style="padding-left: 20px;">{{ $property->id }}</td>
                            @if(Auth::user()->usertype=='Admin' || Auth::user()->usertype=='Users')
                                <td>{{ getUserInfo($property->user_id)->name }}</td>
                            @endif

                            @if(Auth::user()->usertype=='Admin' || Auth::user()->usertype=='Agents')
                                <td>{{ $property->client_name }}</td>
                            @endif

                            <td>

                                <a href="{{URL::to('properties/'.$property->property_slug)}}">{{ $property->property_name }}</a>

                            </td>
                            <td>{{ getPropertyTypeName($property->property_type)->types }}</td>
                            <td>{{$date}}</td>
                            <td>{{ $property->property_purpose }}</td>

                            @if(Auth::user()->usertype=='Users')

                            <td class="text-center">

                                <a href="{{ url('admin/saved-properties/delete/'.$property->saved_id) }}" onclick="return confirm('Are you sure? You will not be able to recover this.')" class="btn btn-default btn-rounded"><i class="md md-delete"></i></a>


                            </td>

                            @endif

                        </tr>

                        @endif

                        <?php $i = $i + 1; ?>

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

            $('#data-table1').dataTable({
                "order": [[ 0, "desc" ]] // Order on init. # is the column, starting at 0
            });


            $("input:checkbox").change( function(){


                $(this).closest('form').submit();
            });

            $('#data-table tr').click(function () {

                if($('#data-table tr').hasClass("bg_color"))
                {
                    $('#data-table tr').removeClass("bg_color");
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

        [type="checkbox"]:not(:checked),
        [type="checkbox"]:checked {
            position: absolute;
            left: -9999px;
        }
        [type="checkbox"]:not(:checked) + label,
        [type="checkbox"]:checked + label {
            position: relative;
            padding-left: 1.95em;
            cursor: pointer;
        }

        /* checkbox aspect */
        [type="checkbox"]:not(:checked) + label:before,
        [type="checkbox"]:checked + label:before {
            content: '';
            position: absolute;
            left: 0; top: 2px;
            width: 1.25em; height: 1.25em;
            border: 2px solid #ccc;
            background: #fff;
            border-radius: 4px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
        }
        /* checked mark aspect */
        [type="checkbox"]:not(:checked) + label:after,
        [type="checkbox"]:checked + label:after {
            content: '\2713\0020';
            position: absolute;
            top: .25em; left: .1em;
            font-size: 1.3em;
            line-height: 0.8;
            color: #09ad7e;
            transition: all .2s;
            font-family: 'Lucida Sans Unicode', 'Arial Unicode MS', Arial;
        }
        /* checked mark aspect changes */
        [type="checkbox"]:not(:checked) + label:after {
            opacity: 0;
            transform: scale(0);
        }
        [type="checkbox"]:checked + label:after {
            opacity: 1;
            transform: scale(0.7);
        }
        /* disabled checkbox */
        [type="checkbox"]:disabled:not(:checked) + label:before,
        [type="checkbox"]:disabled:checked + label:before {
            box-shadow: none;
            border-color: #bbb;
            background-color: #ddd;
        }
        [type="checkbox"]:disabled:checked + label:after {
            color: #999;
        }
        [type="checkbox"]:disabled + label {
            color: #aaa;
        }
        /* accessibility */
        /*[type="checkbox"]:checked:focus + label:before,
        [type="checkbox"]:not(:checked):focus + label:before {
            border: 2px dotted blue;
        }*/

        /* hover style just for information */
        label.bg:hover:before {
            border: 2px solid #4778d9!important;
        }
    </style>

@endsection
