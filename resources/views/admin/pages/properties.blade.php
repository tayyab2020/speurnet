@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">

		<div class="pull-right">
			<a href="{{URL::to('admin/properties/addproperty')}}" class="btn btn-primary">Add Property <i class="fa fa-plus"></i></a>
		</div>
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
                    @if(Auth::user()->usertype=='Admin')
	                <th>Agent</th>
                    @endif
	                <th>Property Name</th>
					<th>Type</th>
                    <th>Posting Date</th>
					<th>Purpose</th>
	                <th class="text-center">Status</th>
	                <th class="text-center width-100">Action</th>
	            </tr>
            </thead>

            <tbody>

            <?php $i = 0; ?>

            @foreach($propertieslist as $i => $property)

                <?php
                $date=date_create($property->created_at);
                $date = date_format($date,"d-F-Y");
                ?>

         	   <tr>

				<td style="padding-left: 20px;">{{ $property->id }}</td>
                   @if(Auth::user()->usertype=='Admin')
				<td>{{ getUserInfo($property->user_id)->name }}</td>
                   @endif
                <td><a href="{{URL::to('properties/'.$property->property_slug)}}">{{ $property->property_name }}</a>

                <form method="POST" action="{{URL::to('admin/checkboxes')}}" role="form" id="form">

                    <input type="hidden" name="id" value="{{$property->id}}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <ul style="list-style: none;padding: 15px 0px;font-size: 13px;">

                    @if( $property->property_purpose == "Sale" )

                        <li><input name="sold" @if($property->is_sold) checked @endif @if($property->is_negotiation || $property->is_under_offer || $property->available_immediately) disabled @endif type="checkbox" id="sold{{$i}}" style="position: relative;top: 2px;"><label @if(!$property->is_negotiation && !$property->is_under_offer && !$property->available_immediately) class="bg" @endif for="sold{{$i}}">MARK AS SOLD</label></li>

                    @elseif( $property->property_purpose == "Rent" )

                        <li><input name="rented" @if($property->is_rented) checked @endif @if($property->is_negotiation || $property->available_immediately) disabled @endif  type="checkbox" id="rent{{$i}}" style="position: relative;top: 2px;"><label @if(!$property->is_negotiation && !$property->available_immediately) class="bg" @endif for="rent{{$i}}">MARK AS RENTOUT</label></li>

                    @endif

                        <li><input name="negotiation" @if($property->is_negotiation) checked @endif @if($property->is_sold || $property->is_rented || $property->is_under_offer || $property->available_immediately) disabled @endif  type="checkbox" id="negotiation{{$i}}" style="position: relative;top: 2px;"><label @if(!$property->is_sold && !$property->is_rented && !$property->is_under_offer && !$property->available_immediately) class="bg" @endif for="negotiation{{$i}}">MARK AS IN NEGOTIATION</label></li>

                        @if( $property->property_purpose == "Sale" )

                            <li><input name="under_offer" @if($property->is_under_offer) checked @endif @if($property->is_sold || $property->is_negotiation || $property->available_immediately) disabled @endif  type="checkbox" id="under_offer{{$i}}" style="position: relative;top: 2px;"><label @if(!$property->is_sold && !$property->is_negotiation && !$property->available_immediately) class="bg" @endif for="under_offer{{$i}}">MARK AS UNDER OFFER</label></li>

                        @endif

                    <li><input name="available" @if($property->available_immediately) checked @endif @if($property->is_sold || $property->is_rented || $property->is_negotiation || $property->is_under_offer) disabled @endif  type="checkbox" id="available{{$i}}" style="position: relative;top: 2px;"><label @if(!$property->is_sold && !$property->is_rented && !$property->is_negotiation && !$property->is_under_offer) class="bg" @endif for="available{{$i}}">MARK AVAILABLE IMMEDIATELY</label></li>

                    <li style="margin-top: 5px;padding-left: 12px;">

                        <a style="color:#786d6d;font-weight: 700;text-decoration: underline;font-size: 15px;" href="{{ URL::to('admin/inquiries/show') }}/{{$property->id}}">Received Inquiries</a>

                        <b style="position: relative;bottom: 1px;background: #555;color: white;border-radius: 20px;padding: 0px 8px;display: inline-block;margin-left: 5px;font-size: 9px;line-height: 16px;">{{$property->enquiries_count}}</b>

                    </li>

                    <li style="margin-top: 5px;padding-left: 12px;">

                        <a style="color:#786d6d;font-weight: 700;text-decoration: underline;font-size: 15px;" href="{{ URL::to('admin/viewings/show') }}/{{$property->id}}">Received Viewings</a>

                        <b style="position: relative;bottom: 1px;background: #555;color: white;border-radius: 20px;padding: 0px 8px;display: inline-block;margin-left: 5px;font-size: 9px;line-height: 16px;">{{$property->viewings_count}}</b>

                    </li>

                </ul>


                </form>




                </td>
				<td>{{ getPropertyTypeName($property->property_type)->types }}</td>
                <td>{{$date}}</td>
				<td>{{ $property->property_purpose }}</td>
				<td class="text-center">
						@if($property->status==1)
							<span class="icon-circle bg-green">
								<i class="md md-check"></i>
							</span>
						@else
							<span class="icon-circle bg-orange">
								<i class="md md-close"></i>
							</span>
						@endif
            	</td>
                <td class="text-center">
                <div class="btn-group">
								<button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Actions <span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="{{ url('admin/properties/addproperty/'.$property->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>


									<li>
										@if($property->featured_property==0)
					                	<a href="{{ url('admin/properties/featuredproperty/'.$property->id) }}"><i class="md md-star"></i> Set as Featured</a>
					                	@else
					                	<a href="{{ url('admin/properties/featuredproperty/'.$property->id) }}"><i class="md md-check"></i> Unset from Featured</a>
					                	@endif
									</li>


									<li>
										@if($property->status==1)
					                	<a href="{{ url('admin/properties/status/'.$property->id) }}"><i class="md md-close"></i> Unpublish</a>
					                	@else
					                	<a href="{{ url('admin/properties/status/'.$property->id) }}"><i class="md md-check"></i> Publish</a>
					                	@endif
									</li>
									<li><a href="{{ url('admin/properties/delete/'.$property->id) }}" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="md md-delete"></i> Delete</a></li>
								</ul>
							</div>

            </td>

            </tr>

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


        $("input:checkbox").change( function(){


            $(this).closest('form').submit();
        });

        $('#data-table1 tr').click(function () {

            if($(this).hasClass("bg_color"))
            {
                $(this).removeClass("bg_color");
            }
            else
            {
                $('#data-table1 tr').removeClass("bg_color");
                $(this).addClass("bg_color");
            }


        });

        $('#data-table1').dataTable({
            "order": [[ 0, "desc" ]] // Order on init. # is the column, starting at 0
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
