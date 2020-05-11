@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ Auth::user()->name }}</h2>
		<a href="{{ URL::to('admin/dashboard') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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
    <div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account</a>
        </li>
        <li role="presentation">
            <a href="#ac_password" aria-controls="ac_password" role="tab" data-toggle="tab">Password</a>
        </li>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content tab-content-default">
        <div role="tabpanel" class="tab-pane active" id="account">
            {!! Form::open(array('url' => 'admin/profile','class'=>'form-horizontal padding-15','name'=>'account_form','id'=>'account_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">Profile Picture</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(Auth::user()->image_icon)

									<img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" width="80" alt="person">
								@endif

                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="user_icon" class="filestyle">
                                {{--<small class="text-muted bold">Size 80x80px</small>--}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" value="">
                    </div>
                </div>
				 <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Fax</label>
                    <div class="col-sm-9">
                        <input type="text" name="fax" value="{{ Auth::user()->fax }}" class="form-control" value="">
                    </div>
                </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Address</label>
                <div class="col-sm-9">

                    <input type="text" id="address-input" placeholder="Enter Address" name="address" @if(Auth::user()->address) value="{{Auth::user()->address}}" @endif   class="form-control map-input">
                    <input type="hidden" name="address_latitude" id="address-latitude" @if(Auth::user()->address_latitude) value="{{Auth::user()->address_latitude}}" @else value="52.3666969" @endif />
                    <input type="hidden" name="address_longitude" id="address-longitude" @if(Auth::user()->address_longitude) value="{{Auth::user()->address_longitude}}" @else value="4.8945398"  @endif  />

                </div>

            </div>


            <div class="form-group">

                <div class="col-sm-9" style="float: right">

                    <div id="address-map-container" style="width:100%;height:400px; ">
                        <div style="width: 100%; height: 100%" id="address-map"></div>
                    </div>

                </div>
            </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">

                        <input type="text" value="{{Auth::user()->city}}" readonly id="city_name" name="city" class="form-control" >

                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">About</label>
                    <div class="col-sm-9">

						<textarea name="about" cols="50" rows="5" class="form-control">{{ Auth::user()->about }}</textarea>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" name="facebook" value="{{ Auth::user()->facebook }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" name="twitter" value="{{ Auth::user()->twitter }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Google Plus</label>
                    <div class="col-sm-9">
                        <input type="text" name="gplus" value="{{ Auth::user()->gplus }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Linkedin</label>
                    <div class="col-sm-9">
                        <input type="text" name="linkedin" value="{{ Auth::user()->linkedin }}" class="form-control" value="">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">Save Changes <i class="md md-lock-open"></i></button>

                    </div>
                </div>

            {!! Form::close() !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="ac_password">

            {!! Form::open(array('url' => 'admin/profile_pass','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">New Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" value="" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password_confirmation" value="" class="form-control" value="">
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">Save Changes <i class="md md-lock-open"></i></button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
</div>
</div>

    <script>

        $(document).ready(function() {

            initialize();

            function initialize() {

                $('form').on('keyup keypress', function(e) {
                    var keyCode = e.keyCode || e.which;
                    if (keyCode === 13) {
                        e.preventDefault();
                        return false;
                    }
                });
                const locationInputs = document.getElementsByClassName("map-input");

                var options = {

                    componentRestrictions: {country: "nl"}

                };

                const autocompletes = [];
                const geocoder = new google.maps.Geocoder;
                for (let i = 0; i < locationInputs.length; i++) {

                    const input = locationInputs[i];
                    const fieldKey = input.id.replace("-input", "");
                    const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                    const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || 52.3666969;
                    const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 4.8945398;

                    const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                        center: {lat: latitude, lng: longitude},
                        zoom: 13
                    });

                    var base_url = window.location.origin;

                    var home_icon = base_url + '/assets/img/home_pin.png';


                    const marker = new google.maps.Marker({
                        map: map,
                        position: {lat: latitude, lng: longitude},
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        icon: {url:home_icon, scaledSize: new google.maps.Size(45, 50)}
                    });

                    google.maps.event.addListener(marker, 'dragend', function(marker) {
                        var latLng = marker.latLng;
                        document.getElementById('address-latitude').value = latLng.lat();
                        document.getElementById('address-longitude').value = latLng.lng();

                        geocoder.geocode({'latLng': this.getPosition()}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {

                                    var city_check = 0;

                                    $('#address-input').val(results[0].formatted_address);

                                    for(var a=0; a < results[0]['address_components'].length; a++)
                                    {

                                        if(results[0]['address_components'][a]['types'][0] == 'locality')
                                        {

                                            $('#city_name').val(results[0]['address_components'][a]['long_name']);

                                            city_check = 1;

                                        }

                                    }

                                    if(city_check == 0)
                                    {

                                        for(var b=0; b < results[0]['address_components'].length; b++)
                                        {

                                            if(results[0]['address_components'][b]['types'][0] == 'administrative_area_level_2')
                                            {


                                                $('#city_name').val(results[0]['address_components'][b]['long_name']);

                                                city_check = 1;

                                            }

                                        }

                                    }

                                    if(city_check == 0)
                                    {

                                        for(var c=0; c < results[0]['address_components'].length; c++)
                                        {

                                            if(results[0]['address_components'][c]['types'][0] == 'postal_town')
                                            {


                                                $('#city_name').val(results[0]['address_components'][c]['long_name']);

                                                city_check = 1;

                                            }

                                        }

                                    }

                                    if(city_check == 0)
                                    {
                                        $('#city_name').val();
                                    }

                                }

                                else
                                {
                                    $('#address-input').val();
                                    $('#city_name').val();

                                }
                            }
                        });

                    });

                    marker.setVisible(isEdit);

                    const autocomplete = new google.maps.places.Autocomplete(input,options);
                    autocomplete.key = fieldKey;
                    autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
                }

                for (let i = 0; i < autocompletes.length; i++) {
                    const input = autocompletes[i].input;
                    const autocomplete = autocompletes[i].autocomplete;
                    const map = autocompletes[i].map;
                    const marker = autocompletes[i].marker;

                    google.maps.event.addListener(autocomplete, 'place_changed', function () {
                        marker.setVisible(false);
                        const place = autocomplete.getPlace();

                        geocoder.geocode({'placeId': place.place_id}, function (results, status) {



                            if (status === google.maps.GeocoderStatus.OK) {

                                if (results[0]) {


                                    const lat = results[0].geometry.location.lat();
                                    const lng = results[0].geometry.location.lng();
                                    setLocationCoordinates(autocomplete.key, lat, lng);

                                    var city_check1 = 0;

                                    for(var e=0; e < results[0]['address_components'].length; e++)
                                    {

                                        if(results[0]['address_components'][e]['types'][0] == 'locality')
                                        {

                                            $('#city_name').val(results[0]['address_components'][e]['long_name']);

                                            city_check1 = 1;

                                        }

                                    }

                                    if(city_check1 == 0)
                                    {
                                        for(var x=0; x < results[0]['address_components'].length; x++)
                                        {

                                            if(results[0]['address_components'][x]['types'][0] == 'administrative_area_level_2')
                                            {

                                                $('#city_name').val(results[0]['address_components'][x]['long_name']);

                                                city_check1 = 1;

                                            }

                                        }
                                    }



                                    if(city_check1 == 0)
                                    {

                                        for(var y=0; y < results[0]['address_components'].length; y++)
                                        {

                                            if(results[0]['address_components'][y]['types'][0] == 'postal_town')
                                            {


                                                $('#city_name').val(results[0]['address_components'][y]['long_name']);

                                                city_check1 = 1;

                                            }

                                        }

                                    }

                                    if(city_check1 == 0)
                                    {
                                        $('#city_name').val();
                                    }
                                }
                                else
                                {

                                    $('#city_name').val();

                                }

                            }
                        });

                        if (!place.geometry) {
                            window.alert("No details available for input: '" + place.name + "'");
                            input.value = "";
                            return;
                        }

                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);

                    });
                }
            }

            function setLocationCoordinates(key, lat, lng) {
                const latitudeField = document.getElementById(key + "-" + "latitude");
                const longitudeField = document.getElementById(key + "-" + "longitude");
                latitudeField.value = lat;
                longitudeField.value = lng;
            }

        });

    </script>

@endsection
