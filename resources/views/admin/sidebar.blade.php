<!-- Sidebar Left -->
  <div class="sidebar left-side" id="sidebar-left">
	 <div class="sidebar-user">
		<div class="media sidebar-padding">
			<div class="media-left media-middle">

				@if(Auth::user()->image_icon)
                    <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="60" alt="person" class="img-circle">
                @else
                    <img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle" width="60"/>
                @endif
			</div>
			<div class="media-body media-middle">

				<a href="{{ URL::to('admin/profile') }}" class="h4 margin-none">{{ Auth::user()->name }}</a>
				<ul class="list-unstyled list-inline margin-none">
					<li><a href="{{ URL::to('admin/profile') }}"><i class="md-person-outline"></i></a></li>
					@if(Auth::User()->usertype=="Admin")
					<li><a href="{{ URL::to('admin/settings') }}"><i class="md-settings"></i></a></li>
					@endif
					<li><a href="{{ URL::to('admin/logout') }}"><i class="md-exit-to-app"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Wrapper Reqired by Nicescroll (start scroll from here) -->
	<div class="nicescroll">
		<div class="wrapper" style="margin-bottom:90px">
			<ul class="nav nav-sidebar" id="sidebar-menu">

               @if(Auth::user()->usertype=='Admin')

               		<li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

	                <li class="{{classActivePath('types')}}"><a href="{{ URL::to('admin/types') }}"><i class="fa fa-tags"></i>Property Types</a></li>

	                <li class="{{classActivePath('properties')}}"><a href="{{ URL::to('admin/properties') }}"><i class="md md-pin-drop"></i>Properties</a></li>

                    <li class="{{classActivePath('new_constructions')}}"><a href="{{ URL::to('admin/new_constructions') }}"><i class="md md-pin-drop"></i>New Constructions</a></li>

                    <li class="{{classActivePath('home_exchange')}}"><a href="{{ URL::to('admin/home_exchange') }}"><i class="md md-pin-drop"></i>Home Exchange Properties</a></li>

					<li class="{{classActivePath('featuredproperties')}}"><a href="{{ URL::to('admin/featuredproperties') }}"><i class="md md-star"></i>Featured</a></li>

                    <li class="{{classActivePath('viewings')}}"><a href="{{ URL::to('admin/viewings') }}"><i class="md md-pin-drop"></i>Requested Viewings</a></li>

					<li class="{{classActivePath('inquiries')}}"><a href="{{ URL::to('admin/inquiries') }}"><i class="fa fa-send"></i>Inquiries</a></li>

                    <li class="{{classActivePath('homepage-icons')}}"><a href="{{ URL::to('admin/homepage-icons') }}"><i class="fa fa-bars"></i>While you are here content</a></li>

                    <li class="{{classActivePath('favourite-properties')}}"><a href="{{ URL::to('admin/favourite-properties') }}"><i class="md md-favorite"></i>Favourite Properties</a></li>

	                <li class="{{classActivePath('slider')}}"><a href="{{ URL::to('admin/slider') }}"><i class="fa fa-sliders"></i>Home Slider</a></li>

					<li class="{{classActivePath('testimonials')}}"><a href="{{ URL::to('admin/testimonials') }}"><i class="fa fa-list"></i>Testimonials</a></li>

                    <li class="{{classActivePath('blogs')}}"><a href="{{ URL::to('admin/blogs') }}"><i class="fa fa-list"></i>Blogs</a></li>

                    <li class="{{classActivePath('moving-tips')}}"><a href="{{ URL::to('admin/moving-tips') }}"><i class="fa fa-list"></i>Moving Tips</a></li>

                    <li class="{{classActivePath('expats')}}"><a href="{{ URL::to('admin/expats') }}"><i class="fa fa-list"></i>Expats</a></li>

					<li class="{{classActivePath('partners')}}"><a href="{{ URL::to('admin/partners') }}"><i class="fa fa-bookmark-o"></i>Partners</a></li>

					<li class="{{classActivePath('subscriber')}}"><a href="{{ URL::to('admin/subscriber') }}"><i class="md md-email"></i>Subscribers</a></li>

					<li class="{{classActivePath('cities')}}"><a href="{{ URL::to('admin/cities') }}"><i class="md md-location-city"></i>Cities</a></li>

					<li class="{{classActivePath('users')}}"><a href="{{ URL::to('admin/users') }}"><i class="fa fa-users"></i>Users</a></li>

	                <li class="{{classActivePath('settings')}}"><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i>Settings</a></li>
                @else
               		 <li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

               		 <li class="{{classActivePath('properties')}}"><a href="{{ URL::to('admin/properties') }}"><i class="md md-pin-drop"></i>My Properties</a></li>

                    @if(Auth::user()->usertype =='Users')

                     <li class="{{classActivePath('home_exchange')}}"><a href="{{ URL::to('admin/home_exchange') }}"><i class="md md-pin-drop"></i>Home Exchange Properties</a></li>

                    @endif

               		 <li class="{{classActivePath('favourite-properties')}}"><a href="{{ URL::to('admin/favourite-properties') }}"><i class="md md-favorite"></i>Favourite Properties</a></li>

                @if(Auth::user()->usertype !='Users')

               		 <li class="{{classActivePath('hidden-properties')}}"><a href=""><i class="md md-location-disabled"></i>Hidden Properties</a></li>


                     <li class="{{classActivePath('property-notes')}}"><a href=""><i class="md md-speaker-notes"></i>Property Notes</a></li>

                    @endif

                     <li class="{{classActivePath('viewings')}}"><a href="{{ URL::to('admin/viewings') }}"><i class="md md-pin-drop"></i>Requested Viewings</a></li>

                     <li class="{{classActivePath('reviews')}}"><a href=""><i class="md md-star"></i>Reviews</a></li>

                    @if(Auth::user()->usertype !='Users')

                     <li class="{{classActivePath('alerts-searches')}}"><a href=""><i class="md md-save"></i>Alerts & Searches</a></li>

                    @endif

               		 <li class="{{classActivePath('inquiries')}}"><a href="{{ URL::to('admin/inquiries') }}"><i class="md md-perm-phone-msg"></i>Inquiries</a></li>

                    @if(Auth::user()->usertype !='Users')

               		 <li class="{{classActivePath('packages')}}"><a href=""><i class="md md-check-box-outline-blank"></i>Packages</a></li>

                    @endif

               		 <li class="{{classActivePath('admin')}}"><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> Account</a></li>
                @endif


			</ul>


		</div>
	</div>
</div>
  <!-- // Sidebar -->

  <!-- Sidebar Right -->
  <div class="sidebar right-side" id="sidebar-right">
	<!-- Wrapper Reqired by Nicescroll -->
	<div class="nicescroll">
		<div class="wrapper">
			<div class="block-primary">
				<div class="media">
					<div class="media-left media-middle">
						<a href="#">
							 @if(Auth::user()->image_icon)
                                <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="60" alt="person" class="img-circle border-white">
							@else
    							<img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle border-white" width="60"/>
							@endif
						</a>
					</div>
					<div class="media-body media-middle">
						<a href="{{ URL::to('admin/profile') }}" class="h4">{{ Auth::user()->name }}</a>
						<a href="{{ URL::to('admin/logout') }}" class="logout pull-right"><i class="md md-exit-to-app"></i></a>
					</div>
				</div>
			</div>
			<ul class="nav nav-sidebar" id="sidebar-menu">
				<li><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> Account</a></li>

				@if(Auth::user()->usertype=='Admin')

				<li><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i> Settings</a></li>

				@endif

				<li><a href="{{ URL::to('admin/logout') }}"><i class="md md-exit-to-app"></i> Logout</a></li>
			</ul>
		</div>
	</div>
</div>
  <!-- // Sidebar -->
