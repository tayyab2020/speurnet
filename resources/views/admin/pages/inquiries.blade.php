@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">

		<h2>Inquiries</h2>
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

        <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
	            <tr>
	                <th>Property ID</th>
                    <th>Agent Name</th>
	                <th>Name</th>
	                <th>Email</th>
	                <th>Phone</th>
                    <th>Posting Date</th>
	                <th>Message</th>

	                <th class="text-center width-100">Action</th>
	            </tr>
            </thead>

            <tbody>
            @foreach($inquirieslist as $i => $inquiries)

                <?php
                $date=date_create($inquiries->created_at);
                $date = date_format($date,"d-F-Y");
                ?>

         	   <tr>

                <td>{{ $inquiries->property_id }}</td>
                <td>{{ $inquiries->user->name }}</td>
                <td>{{ $inquiries->name }}</td>
                <td>{{ $inquiries->email }}</td>
                <td>{{ $inquiries->phone }}</td>
                <td>{{ $date }}</td>
                <td>{{ $inquiries->message }}</td>
                <td class="text-center">
                	<a href="{{ url('admin/inquiries/delete/'.$inquiries->id) }}" class="btn btn-default btn-rounded"><i class="md md-delete"></i></a>


            </td>

            </tr>
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

    </style>


@endsection
