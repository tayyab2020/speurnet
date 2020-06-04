<div class="col-md-3 col-md-pull-9 sidebar">
            <div class="widget widget-white">
              <div class="widget-header">
                <h3>Advance Search</h3>
              </div>

                @if(count($properties) != 0)

                <button type="button" class="btn btn-warning btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="width: 100%;font-size: 14px;margin-bottom: 20px;white-space: break-spaces;padding: 10px 0px;outline: none;"><i class="fa fa-bullhorn" aria-hidden="true"></i>&nbsp;Create Alert for this Result</button>

                @endif

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Property Alert Creation</h4>
                            </div>
                            <div class="modal-body" style="display: inline-block;width: 100%;">
                                {!! Form::open(array('url' => array('savepropertyalert'),'class'=>'form-horizontal padding-15','name'=>'job_form','id'=>'job_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                                <label>Email Address: </label>
                                <input class="form-control" name="email" title="You will receive Emails on this Address" type="email" required placeholder="Enter Email for Job Alert Receiving" value="{{isset(Auth::user()->email)?Auth::user()->email:''}}">
                                <input name="property_type" type="hidden" value="{{$property_type}}">
                                <input name="property_purpose" type="hidden" value="{{$purpose}}">
                                <input name="radius" type="hidden" value="{{$radius}}">
                                <input name="address" type="hidden" value="{{$address}}">
                                <input name="longitude" type="hidden" value="{{$address_longitude}}">
                                <input name="latitude" type="hidden" value="{{$address_latitude}}">
                                <input name="max_price" type="hidden" value="{{$max_price}}">
                                <input name="min_price" type="hidden" value="{{$min_price}}">
                                <input name="bedrooms" type="hidden" value="">
                                <input name="bathrooms" type="hidden" value="">
                                <input name="area" type="hidden" value="">

                                <br>

                                <div>

                                <label>Property Alert Type: &nbsp</label>

                                <p style="margin-top: 10px;">
                                    <input type="radio" id="test1" name="type" value="1" checked>
                                    <label for="test1">Weekly</label>
                                </p>

                                <p>
                                    <input type="radio" id="test2" name="type" value="2">
                                    <label for="test2">Monthly</label>
                                </p>

                                </div>


                                <button class="btn btn-success" type="submit" style="float: right">Create Property Alert</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

              {!! Form::open(array('url' => array('searchproperties'),'class'=>'advance-search','name'=>'search_form','id'=>'search_form','role'=>'form')) !!}
               <div class="form-group">
                      <label for="city">City</label>

                   <input class="form-control city-input" value="{{$address}}" type="text" placeholder="City, State, Address" name="city_name" id="city-input" autocomplete="off">

                   <input type="hidden" value="{{$address_latitude}}" name="city_latitude" id="city-latitude"  />
                   <input type="hidden" value="{{$address_longitude}}" name="city_longitude" id="city-longitude"  />

                    </div>

                <div class="form-group">
                    <label for="purpose">Radius</label>
                    <select class="form-control" name="radius">
                        <option value="0" @if($radius == 0) selected @endif>0 KM</option>
                        <option value="1" @if($radius == 1) selected @endif>1 KM</option>
                        <option value="2" @if($radius == 2) selected @endif>2 KM</option>
                        <option value="5" @if($radius == 5) selected @endif>5 KM</option>
                        <option value="10" @if($radius == 10) selected @endif>10 KM</option>
                        <option value="15" @if($radius == 15) selected @endif>15 KM</option>
                        <option value="30" @if($radius == 30) selected @endif>30 KM</option>
                        <option value="50" @if($radius == 50) selected @endif>50 KM</option>
                        <option value="100" @if($radius == 100) selected @endif>100 KM</option>
                    </select>
                </div>

                <div class="form-group">
                      <label for="purpose">Purpose</label>
                      <select class="form-control" name="purpose">
                        <option value="Sale" @if($purpose == 'Sale') selected @endif>For Sale</option>
                        <option value="Rent" @if($purpose == 'Rent') selected @endif>For Rent</option>
                      </select>
               </div>
               <div class="form-group">
                      <label for="type">Type</label>
                      <select class="form-control" name="type">

                        @foreach(\App\Types::orderBy('types')->get() as $type)
                        <option value="{{$type->id}}" @if($property_type == $type->id) selected @endif>{{$type->types}}</option>
						@endforeach

                      </select>
              </div>

                <div class="form-group">
                      <label for="minprice">Min Price</label>
                      <input type="text" name="min_price" value="{{$min_price}}" class="form-control" placeholder="Min Price (number)">
                </div>
                <div class="form-group">
                      <label for="maxprice">Max Price</label>
                      <input type="text" name="max_price" value="{{$max_price}}" class="form-control" placeholder="Max Price (number)">
                    </div>

                <input type="submit" name="submit" value="Search" class="btn btn-primary btn-block">
              {!! Form::close() !!}
            </div>
            <!-- break -->
            <div class="widget widget-sidebar widget-white">
              <div class="widget-header">
                <h3>Property Type</h3>
              </div>
              <ul class="list-check">
                @foreach(\App\Types::orderBy('types')->get() as $type)

                <li><a href="{{URL::to('type/'.$type->slug.'')}}">{{$type->types}}</a>&nbsp;({{countPropertyType($type->id)}})</li>

                @endforeach


              </ul>
            </div>

            <!-- break -->
          </div>

<style>
    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }
    [type="radio"]:checked + label,
    [type="radio"]:not(:checked) + label
    {
        position: relative;
        padding-left: 22px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
    }
    [type="radio"]:checked + label:before,
    [type="radio"]:not(:checked) + label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 18px;
        height: 18px;
        border: 2px solid #b0aaaa;
        border-radius: 100%;
        background: #fff;
    }
    [type="radio"]:checked + label:after,
    [type="radio"]:not(:checked) + label:after {
        content: '';
        width: 10px;
        height: 10px;
        background: #676b6c;
        position: absolute;
        top: 4px;
        left: 4px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    [type="radio"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    [type="radio"]:checked + label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }
</style>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

<script>

    $( document ).ready(function() {

        $('.city-input').on('keyup keypress', function(e) {

            var keyCode = e.keyCode || e.which;

            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }



            const locationInputs = $(this);


            var options = {

                componentRestrictions: {country: "nl"}

            };

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;

            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");



                const autocomplete = new google.maps.places.Autocomplete(input,options);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, autocomplete: autocomplete});
            }

            for (let i = 0; i < autocompletes.length; i++) {

                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;


                google.maps.event.addListener(autocomplete, 'place_changed', function () {

                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {



                        if (status === google.maps.GeocoderStatus.OK) {

                            if (results[0]) {

                                const lat = results[0].geometry.location.lat();
                                const lng = results[0].geometry.location.lng();


                                $(input).parent().children('#city-latitude').val(lat);
                                $(input).parent().children('#city-longitude').val(lng);

                                var value = $(input).val();

                            }
                            else
                            {

                                alert("No results found!");

                            }

                        }

                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }



                });
            }


        });

    });



</script>
