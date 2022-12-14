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

					<li class="{{classActivePath('blog-categories')}}"><a href="{{ URL::to('admin/blog-categories') }}"><i class="fa fa-list"></i>Blog Categories</a></li>

					<li class="{{classActivePath('blogs')}}"><a href="{{ URL::to('admin/blogs') }}"><i class="fa fa-list"></i>Blogs</a></li>

					<li class="{{classActivePath('vactury-categories')}}"><a href="{{ URL::to('admin/vactury-categories') }}"><i class="fa fa-bars"></i>Vactury Categories</a></li>

					<li class="{{classActivePath('vactury-provinces')}}"><a href="{{ URL::to('admin/vactury-provinces') }}"><i class="fa fa-bars"></i>Vactury Provinces</a></li>
					   
					<li class="{{classActivePath('vactury')}}"><a href="{{ URL::to('admin/vactury') }}"><i class="fa fa-bars"></i>Vactury</a></li>

					<li class="{{classActivePath('offer-content')}}"><a href="{{ URL::to('admin/offer-content') }}"><i class="fa fa-bars"></i>Offer Content</a></li>

					<li class="{{classActivePath('slider')}}"><a href="{{ URL::to('admin/slider') }}"><i class="fa fa-sliders"></i>Home Slider</a></li>

					<li class="{{classActivePath('place-to-be-filters')}}"><a href="{{ URL::to('admin/place-to-be-filters') }}"><i class="fa fa-bars"></i>Place To Be Filters</a></li>
					
					<li class="{{classActivePath('place-to-be-places')}}"><a href="{{ URL::to('admin/place-to-be-places') }}"><i class="fa fa-bars"></i>Place to Be Places</a></li>

					<li class="{{classActivePath('place-to-be-contents')}}"><a href="{{ URL::to('admin/place-to-be-contents') }}"><i class="fa fa-bars"></i>Place To Be Content</a></li>
					
					<li class="{{classActivePath('study-filters')}}"><a href="{{ URL::to('admin/study-filters') }}"><i class="fa fa-bars"></i>Study Filters</a></li>

					<li class="{{classActivePath('study-categories')}}"><a href="{{ URL::to('admin/study-categories') }}"><i class="fa fa-bars"></i>Study Categories</a></li>

					<li class="{{classActivePath('studies')}}"><a href="{{ URL::to('admin/studies') }}"><i class="fa fa-bars"></i>Study</a></li>

					<li class="{{classActivePath('categories-headings')}}"><a href="{{ URL::to('admin/categories-headings') }}"><i class="fa fa-bars"></i>Categories</a></li>

					<li class="{{classActivePath('zoekhet-categories')}}"><a href="{{ URL::to('admin/zoekhet-categories') }}"><i class="fa fa-bars"></i>Zoekhet Categories</a></li>

					<li class="{{classActivePath('zoekhet')}}"><a href="{{ URL::to('admin/zoekhet') }}"><i class="fa fa-bars"></i>Zoekhet</a></li>

					<!-- <li class="{{classActivePath('categories')}}"><a href="{{ URL::to('admin/categories') }}"><i class="fa fa-bars"></i>Categories</a></li> -->

					<li class="{{classActivePath('companies')}}"><a href="{{ URL::to('admin/companies') }}"><i class="fa fa-bars"></i>Companies</a></li>
					
					<li class="{{classActivePath('trendings')}}"><a href="{{ URL::to('admin/trendings') }}"><i class="fa fa-bars"></i>Trendings</a></li>

					<li class="{{classActivePath('subscriber')}}"><a href="{{ URL::to('admin/subscriber') }}"><i class="md md-email"></i>Subscribers</a></li>

					<li class="{{classActivePath('homepage-boxes')}}"><a href="{{ URL::to('admin/homepage-boxes') }}"><i class="fa fa-bars"></i>Homepage Boxes</a></li>

					<li class="{{classActivePath('company-tiles')}}"><a href="{{ URL::to('admin/company-tiles') }}"><i class="fa fa-bars"></i>Company Tiles</a></li>

					<li class="{{classActivePath('our-favourites')}}"><a href="{{ URL::to('admin/our-favourites') }}"><i class="fa fa-bars"></i>Our Favourites</a></li>

                    <li class="{{classActivePath('footer-headings')}}"><a href="{{ URL::to('admin/footer-headings') }}"><i class="fa fa-header"></i> Footer Headings</a></li>

                    <li class="{{classActivePath('footer-pages')}}"><a href="{{ URL::to('admin/footer-pages') }}"><i class="fa fa-list"></i> Footer Pages</a></li>

					<li class="{{classActivePath('homepage-icons')}}"><a href="{{ URL::to('admin/homepage-icons') }}"><i class="fa fa-bars"></i>While you are here content</a></li>

	                <li class="{{classActivePath('settings')}}"><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i>Settings</a></li>

                @else

                    <li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="{{classActivePath('tickets')}}"><a href="{{ URL::to('admin/tickets') }}"><i class="fa fa-ticket"></i> Tickets</a></li>

                    @if(Auth::user()->usertype !='Users')

                    <li class="{{classActivePath('properties')}}"><a href="{{ URL::to('admin/properties') }}"><i class="md md-pin-drop"></i>{{__('text.My Properties')}}</a></li>

                    @endif

                    @if(Auth::user()->usertype =='Users')

                        <li style="background-color: #0e800e;" class="{{classActivePath('home_exchange')}}"><a style="color: white;" href="{{ URL::to('admin/home_exchange') }}"><i class="md md-pin-drop"></i>{{__('text.Home Exchange Properties')}}</a></li>

                    @endif

                    <li class="{{classActivePath('favourite-properties')}}"><a href="{{ URL::to('admin/favourite-properties') }}"><i class="md md-favorite"></i>{{__('text.Favourite Properties')}}</a></li>

                    @if(Auth::user()->usertype !='Users')

                        <li class="{{classActivePath('hidden-properties')}}"><a href=""><i class="md md-location-disabled"></i>{{__('text.Hidden Properties')}}</a></li>

                        <li class="{{classActivePath('property-notes')}}"><a href=""><i class="md md-speaker-notes"></i>{{__('text.Property Notes')}}</a></li>

                    @endif

                    <li class="{{classActivePath('viewings')}}"><a href="{{ URL::to('admin/viewings') }}"><i class="md md-pin-drop"></i>{{__('text.Requested Viewings')}}</a></li>

                    <li class="{{classActivePath('reviews')}}"><a href=""><i class="md md-star"></i>Reviews</a></li>

                    @if(Auth::user()->usertype !='Users')

                        <li class="{{classActivePath('alerts-searches')}}"><a href=""><i class="md md-save"></i>{{__('text.Alerts & Searches')}}</a></li>

                    @endif

                    <li class="{{classActivePath('inquiries')}}"><a href="{{ URL::to('admin/inquiries') }}"><i class="md md-perm-phone-msg"></i>{{__('text.Inquiries')}}</a></li>

                    @if(Auth::user()->usertype !='Users')

                        <li class="{{classActivePath('packages')}}"><a href=""><i class="md md-check-box-outline-blank"></i>{{__('text.Packages')}}</a></li>

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

<style>

    .sidebar .nav-sidebar > li > a
    {
        padding: 20px 0px 20px 55px;
    }
</style>
