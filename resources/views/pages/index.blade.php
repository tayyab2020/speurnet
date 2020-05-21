@extends("app")
@section("content")

@include("_particles.slidersearch")

<!-- begin:content -->
    <div id="content">
      <div class="container" style="width: 100%;">
        <!-- begin:latest -->

        <div class="row">

            <div class="col-md-2 col-sm-12">

                <div class="col-md-12 col-sm-12"><div class="heading-title">
                        <h2 style="font-size: 18px;">Top Memebrs</h2>
                    </div></div>

                @foreach($top_members as $temp)

                    <div class="col-md-12 col-sm-6 col-xs-12" style="box-shadow: 0 0rem 1.2rem -3px #c2c2c2;margin-bottom: 30px;padding: 0;">
                        <div class="property-container" style="margin-bottom: 0;">
                            <div class="property-image">

                                @if($temp->image_icon)

                                <img src="{{ URL::asset('upload/members/'.$temp->image_icon.'-b.jpg') }}" style="width: 100%;height: 200px;" >

                                    @else

                                    <img src="{{ URL::asset('upload/members/user.png') }}" style="width: 100%;height: 200px;" >

                                @endif

                            </div>

                            <div class="property-features">
                                <span><i class="fa fa-home"></i> {{$temp->properties_count}}</span>
                            </div>

                            <div class="property-content">
                                <h3><a>{{$temp->name}}</a> <small>{{$temp->email}}</small></h3>
                            </div>
                        </div>
                    </div>

                    @endforeach


            </div>

            <div class="col-md-8 col-sm-12">

                <div class="col-md-12 col-sm-12">
                    <div class="heading-title">
                        <h2>Latest Properties</h2>
                    </div>
                </div>

         @foreach($propertieslist as $i => $property)


            <div class="col-md-4 col-sm-6 col-xs-12">

            <div class="property-container">
              <div class="property-image">

                <img src="{{ URL::asset('upload/properties/'.$property->featured_image.'-s.jpg') }}" alt="{{ $property->property_name }}">
                <div class="property-price">
                  <h4>{{ getPropertyTypeName($property->property_type)->types }}</h4>
                  <span>{{getcong('currency_sign')}}@if($property->sale_price) {{$property->sale_price}} @else {{$property->rent_price}} @endif</span>
                </div>
                <div class="property-status">
                  <span>For {{$property->property_purpose}}</span>
                </div>
              </div>
              <div class="property-features">
                <span><i class="fa fa-home"></i> {{$property->area}}</span>
                <span><i class="fa fa-hdd-o"></i> {{$property->bedrooms}}</span>
                <span><i class="fa fa-male"></i> {{$property->bathrooms}}</span>
              </div>
              <div class="property-content">
                <h3><a href="{{URL::to('properties/'.$property->property_slug)}}">{{ Str::limit($property->property_name,35) }}</a> <small>{{ Str::limit($property->address,40) }}</small></h3>
              </div>
            </div>
          </div>
          <!-- break -->
		@endforeach


        </div>

            <div class="col-md-2 cols-sm-12">

                <div class="col-md-12 col-sm-12"><div class="heading-title">
                        <h2 style="font-size: 18px;">Top Properties</h2>
                    </div></div>

                @foreach($top_properties as $temp)

                    <div class="col-md-12 col-sm-6 col-xs-12" style="box-shadow: 0 0rem 1.2rem -3px #c2c2c2;margin-bottom: 30px;padding: 0;">
                        <div class="property-container" style="margin-bottom: 0;">
                            <div class="property-image">

                                <img src="{{ URL::asset('upload/properties/'.$temp->featured_image.'-s.jpg') }}" alt="{{ $property->property_name }}">
                                <div class="property-price">
                                    <h4>{{ getPropertyTypeName($temp->property_type)->types }}</h4>
                                    <span>{{getcong('currency_sign')}}@if($temp->sale_price) {{$temp->sale_price}} @else {{$temp->rent_price}} @endif</span>
                                </div>
                                <div class="property-status">
                                    <span>For {{$temp->property_purpose}}</span>
                                </div>
                            </div>
                            <div class="property-features">
                                <span><i class="fa fa-home"></i> {{$temp->area}}</span>
                                <span><i class="fa fa-hdd-o"></i> {{$temp->bedrooms}}</span>
                                <span><i class="fa fa-male"></i> {{$temp->bathrooms}}</span>
                            </div>
                            <div class="property-content">
                                <h3><a href="{{URL::to('properties/'.$temp->property_slug)}}">{{ Str::limit($temp->property_name,35) }}</a> <small>{{ Str::limit($temp->address,40) }}</small></h3>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>


        </div>
        <!-- end:latest -->


      </div>
    </div>
    <!-- end:content -->

    @include("_particles.testimonials")

    @include("_particles.partners")

	@include("_particles.subscribe")



@endsection
