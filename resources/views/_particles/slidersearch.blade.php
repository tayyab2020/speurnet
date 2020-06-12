<!-- begin:header -->
    <div id="header" class="header-slide">

        <div class="container" style="margin-top: 195px;">
            <div class="row" style="display: flex;">
                <div class="col-md-10" style="margin: auto;">
                    <div class="quick-search">
                        <div class="row">

                            {!! Form::open(array('url' => array('searchproperties'),'name'=>'search_form','id'=>'search_form','role'=>'form')) !!}


                            <div class="col-md-12 col-sm-12 col-xs-12">
                                        <span style="display: inline-block;min-width: 75px;">
                                            <input type="radio" id="buy" name="purpose" value="Sale" style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;" checked>
                                            <label for="buy" style="margin-left: 2px;font-size: 18px;cursor: pointer;">Buy</label>
                                        </span>

                                        <span style="display: inline-block;min-width: 75px;">
                                            <input type="radio" id="rent" name="purpose" value="Rent" style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;">
                                            <label for="rent" style="margin-left: 2px;font-size: 18px;cursor: pointer;">Rent</label>
                                        </span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group" style="display: flex;flex-direction: row;height: 75px;">

                                    {{--<label for="address">Address</label>--}}

                                    <div style="flex-grow: 2;height: 100%;border: 1px solid #d7d7d7;">
                                        <input style="border: 0;height: 100%;box-shadow: none;" class="form-control city-input" type="text" placeholder="City, State, Address" name="city_name" id="city-input" autocomplete="off">

                                        <input type="hidden" name="city_latitude" id="city-latitude"  />
                                        <input type="hidden" name="city_longitude" id="city-longitude"  />

                                    </div>

                                    <button type="button" value="Filters" class="btn btn-primary" style="position: absolute;right: 200px;top: 17px;color: black;background: transparent;border-color: #9f9c9c;height: 40px;padding-top: 8px;outline: none;"><span><i class="fa fa-filter" aria-hidden="true" style="margin-right: 10px;"></i> Filters</span></button>

                                    <button type="submit" name="submit" value="Search" class="btn btn-primary" style="padding: 0px 35px;"><span><i class="fa fa-search" aria-hidden="true" style="margin-right: 10px;"></i> Search</span></button>

                                </div>

                                {{--<div class="form-group">
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
                                </div>--}}

                            </div>


                            <!-- break -->


                            {{--<div class="col-md-6 col-sm-6 col-xs-6">

                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" name="type">
                                        @foreach(\App\Types::orderBy('types')->get() as $type)
                                            <option value="{{$type->id}}">{{$type->types}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="maxprice">Max Price</label>
                                    <input type="text" name="max_price" class="form-control" placeholder="800000">
                                </div>

                                <div class="form-group">
                                    <label for="minprice">Min Price</label>
                                    <input type="text" name="min_price" class="form-control" placeholder="20000">
                                </div>


                            </div>--}}


                            {{--<div class="col-md-12 col-sm-12 col-xs-12"><input type="submit" name="submit" value="Search" class="btn btn-primary btn-lg btn-block"></div>--}}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- end:header -->

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
