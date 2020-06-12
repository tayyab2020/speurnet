<!-- begin:header -->
    <div id="header" class="header-slide">

        <div class="container" style="margin-top: 195px;">
            <div class="row" style="display: flex;">
                <div class="col-md-10 col-xs-12" style="margin: auto;padding: 0;">
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
                                <div class="form-group search-bar" style="display: flex;flex-direction: row;height: 75px;">

                                    {{--<label for="address">Address</label>--}}

                                    <div style="flex-grow: 2;height: 100%;border: 1px solid #d7d7d7;">
                                        <input style="border: 0;height: 100%;box-shadow: none;" class="form-control city-input" type="text" placeholder="City, State, Address" name="city_name" id="city-input" autocomplete="off">

                                        <input type="hidden" name="city_latitude" id="city-latitude"  />
                                        <input type="hidden" name="city_longitude" id="city-longitude"  />

                                    </div>

                                    <button type="button" value="Filters" href="#myModal" data-toggle="modal" class="btn btn-primary filter-button" style="position: absolute;right: 200px;top: 17px;color: black;background: white;border-color: #9f9c9c;height: 40px;padding-top: 8px;outline: none;"><span><i class="fa fa-filter" aria-hidden="true" style="margin-right: 10px;"></i> <span>Filters</span></span></button>

                                    <button type="submit" name="submit" value="Search" class="btn btn-primary search-button" style="padding: 0px 35px;"><span><i class="fa fa-search" aria-hidden="true" style="margin-right: 10px;"></i> <span>Search</span></span></button>

                                </div>



                            </div>


                            <!-- break -->



                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-full" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Filters</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-4" id="result">

                                            <div class="row" style="display: flex;">

                                                <div class="col-sm-4 col-md-4 col-lg-4" style="margin: auto;">

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
                                                            <label for="type">Type</label>
                                                            <select class="form-control" name="type">
                                                                <option value="">All</option>
                                                                @foreach(\App\Types::orderBy('types')->get() as $type)
                                                                    <option value="{{$type->id}}">{{$type->types}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="maxprice">Max Price</label>
                                                            <input type="number" name="max_price" class="form-control" placeholder="800000">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="minprice">Min Price</label>
                                                            <input type="number" name="min_price" class="form-control" placeholder="20000">
                                                        </div>

                                                    <div class="form-group">
                                                        <label for="bedrooms">Bedrooms</label>
                                                        <input type="number" name="bedrooms" class="form-control" placeholder="No. of Bedrooms">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="bethrooms">Bethrooms</label>
                                                        <input type="number" name="bathrooms" class="form-control" placeholder="No. of Bathrooms">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="minprice">Type of Construction</label>
                                                        <select class="form-control" name="type_of_construction">
                                                            <option value="">All</option>
                                                            <option value="New">New</option>
                                                            <option value="Old">Old</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="minprice">Keywords</label>
                                                        <input type="text" name="keywords" class="form-control" placeholder="Search by Keywords">
                                                    </div>


                                                </div>
                                            </div>



                                        </div>
                                        <div class="modal-footer" style="display: flex;">
                                            <div class="col-md-4 col-sm-5 col-xs-12" style="margin: auto;"><button type="submit" name="submit" value="Search" class="btn btn-primary btn-lg btn-block">Search</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .modal-full {
                                    min-width: 100%;
                                }

                                .modal-full .modal-content {
                                    min-height: 100vh;
                                }

                                .header-slide
                                {
                                    z-index: auto !important;
                                }

                                .modal-dialog
                                {
                                    margin: 0;
                                }

                                .modal-header
                                {
                                    display: inline-block;
                                    width: 100%;
                                }

                                .modal-title
                                {
                                    float: left;
                                    font-size: 20px;
                                    margin-top: 20px;
                                }

                                .modal-header button
                                {
                                    float: right;
                                }

                                .modal-header button span
                                {
                                    font-size: 60px;
                                }

                                @media (max-width: 768px)
                                {
                                    .quick-search
                                    {
                                        padding: 15px;
                                    }

                                    .search-bar
                                    {
                                        height: 50px !important;
                                    }

                                    .filter-button
                                    {
                                        right: 82px !important;
                                        top: 13px !important;
                                        height: 25px !important;
                                        padding: 4px 10px !important;
                                        font-size: 12px !important;

                                    }

                                    .filter-button span i
                                    {
                                        font-size: 11px;
                                        margin-right: 5px !important;
                                    }

                                    .search-button
                                    {

                                        padding: 0px 18px !important;

                                    }

                                    .search-button i
                                    {
                                        margin-right: 0px !important;
                                    }

                                    .search-button span span
                                    {
                                        display: none;
                                    }

                                }

                            </style>

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
