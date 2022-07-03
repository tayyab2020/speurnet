@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2>{{__('text.Overview Heading')}}</h2>
	</div>

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            {{ Session::get('flash_message') }}
        </div>
    @endif


<div class="row widgets-row">

  	@if(Auth::user()->usertype=='Admin')

    	<!-- <a href="{{ URL::to('admin/properties') }}">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">Properties</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$properties_count}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/featuredproperties') }}">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-green panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">Featured</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$featured_properties}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-star fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/properties') }}">
        <div class="col-sm-6 col-md-3">
        <div class="panel panel-primary panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">Publish</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$publish_properties}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>

    <a href="{{ URL::to('admin/properties') }}">
        <div class="col-sm-6 col-md-3">
        <div class="panel panel-grey panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">UnPublish</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$unpublish_properties}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{ URL::to('admin/inquiries') }}">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-primary panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">Inquiries</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$inquiries}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-send fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>

    <a href="{{ URL::to('admin/users') }}">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-default panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">Agents</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$agents}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-users fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>

    <a href="{{ URL::to('admin/testimonials') }}">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-grey panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">Testimonials</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$testimonials}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-list fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a> -->

    <a href="{{ URL::to('admin/subscriber') }}">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-default panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">Subscribers</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$subscriber}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-envelope fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>

    <!-- <a href="{{ URL::to('admin/partners') }}">
    	<div class="col-sm-6 col-md-3">
        <div class="panel panel-orange panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">Partners</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$partners}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-bookmark-o fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a> -->

    @elseif(Auth::user()->usertype == 'Agents')

        <style>

            @media (min-width: 992px)
            {
                .widgets-row{display: flex;margin: 0;}
            }

            .widgets-row .media-left{
                width: 70%;
                display: inline-block;
                float: left;
            }

            .widgets-row .media-body
            {
                width: 30%;
                display: inline-block;
                float: left;
            }

            .widgets-row .width-100
            {
                width: 100%;
            }

            .widgets-row .width-150
            {
                width: 100%;
            }

            .panel{height: 75%;}

            #graphWeek-a{margin-top: 5px;}

        </style>

        <div class="col-sm-6 col-md-3">
            <a style="text-decoration: none;" href="{{ URL::to('admin/properties') }}">
                <div class="panel panel-orange panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">{{__('text.My Properties')}}</h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{$properties_count}}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="pull-right width-150">
                                <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    	<div class="col-sm-6 col-md-3">
            <a style="text-decoration: none;" href="{{ URL::to('admin/properties') }}">
            <div class="panel panel-green panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{__('text.Publish')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$publish_properties}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
            </div>
            </a>
    </div>


    	<div class="col-sm-6 col-md-3">
            <a style="text-decoration: none;" href="{{ URL::to('admin/properties') }}">
            <div class="panel panel-grey panel-shadow">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{__('text.UnPublish')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$unpublish_properties}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="pull-right width-150">
                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                    </div>
                </div>
            </div>
            </div>
            </a>
    </div>


    	<div class="col-sm-6 col-md-3">
            <a style="text-decoration: none;" href="{{ URL::to('admin/inquiries') }}">
                <div class="panel panel-primary panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">{{__('text.Dashboard Inquiries')}}</h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{$inquiries}}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="pull-right width-150">
                                <i class="fa fa-send fa-4x" style="margin: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    @else

        <style>

            @media (min-width: 992px)
            {
                .widgets-row{display: flex;margin: 0;}
            }

            .widgets-row .media-left{
                width: 100%;
                display: inline-block;
                padding: 0;
            }

            .widgets-row .media-body
            {
                width: 30%;
                display: inline-block;
                float: left;
            }

            .widgets-row .width-100
            {
                width: 100%;
            }

            .widgets-row .width-150
            {
                width: 100%;
            }

            .panel{height: 75%;}

            #graphWeek-a{margin-top: 5px;}

        </style>

        <div class="col-sm-6 col-md-3">
            <a style="text-decoration: none;" href="{{ URL::to('admin/properties/addhomeexchange') }}">
                <div style="background: #27ae27;" class="panel panel-orange panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">Klik hier om woningruil te plaatsen</h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
        </div>


    @endif




</div>

</div>

@endsection
