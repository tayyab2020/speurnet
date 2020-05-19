<div class="col-md-3 col-md-pull-9 sidebar">
            <div class="widget widget-white">
              <div class="widget-header">
                <h3>Advance Search</h3>
              </div>

              {!! Form::open(array('url' => array('searchproperties'),'class'=>'advance-search','name'=>'search_form','id'=>'search_form','role'=>'form')) !!}
               <div class="form-group">
                      <label for="city">City</label>

                   <input class="form-control city-input" type="text" placeholder="City, State, Address" name="city_name" id="city-input" autocomplete="off">

                   <input type="hidden" name="city_latitude" id="city-latitude"  />
                   <input type="hidden" name="city_longitude" id="city-longitude"  />

                    </div>

                <div class="form-group">
                    <label for="purpose">Radius</label>
                    <select class="form-control" name="radius">
                        <option value="0">0 KM</option>
                        <option value="1">1 KM</option>
                        <option value="2">2 KM</option>
                        <option value="5">5 KM</option>
                        <option value="10">10 KM</option>
                        <option value="15">15 KM</option>
                        <option value="30">30 KM</option>
                        <option value="50">50 KM</option>
                        <option value="100">100 KM</option>
                    </select>
                </div>

                <div class="form-group">
                      <label for="purpose">Purpose</label>
                      <select class="form-control" name="purpose">
                        <option value="Sale">For Sale</option>
                        <option value="Rent">For Rent</option>
                      </select>
               </div>
               <div class="form-group">
                      <label for="type">Type</label>
                      <select class="form-control" name="type">

                        @foreach(\App\Types::orderBy('types')->get() as $type)
                        <option value="{{$type->id}}">{{$type->types}}</option>
						@endforeach

                      </select>
              </div>

                <div class="form-group">
                      <label for="minprice">Min Price</label>
                      <input type="text" name="min_price" class="form-control" placeholder="Min Price (number)">
                </div>
                <div class="form-group">
                      <label for="maxprice">Max Price</label>
                      <input type="text" name="max_price" class="form-control" placeholder="Max Price (number)">
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
