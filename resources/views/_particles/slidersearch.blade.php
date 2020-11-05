<!-- begin:header -->
    <div id="header" class="header-slide">

        <div class="container" style="margin-top: 210px;">

            <h2 style="margin: 0;text-align: center;color: white;text-shadow: -3px 2px 11px #252424;font-size: 36px;position: relative;bottom: 120px;" class="css-ce6ko1 top-heading">Van ‘te koop’ naar ‘verkocht!’ Van ‘te huur’ naar ‘verhuurd.’ Welkom thuis!</h2>

            <div class="row" style="display: flex;">
                <div class="col-md-9 col-xs-12" style="margin: auto;padding: 0;">
                    <div class="quick-search" style="background:rgba(255, 255, 255, 0.59);">
                        <div class="row">

                            {!! Form::open(array('url' => array('searchproperties'),'name'=>'search_form','id'=>'search_form','role'=>'form')) !!}


                            <div class="col-md-12 col-sm-12 col-xs-12">
                                        <span style="display: inline-block;min-width: 75px;">
                                            <input class="search-input" type="radio" id="buy" name="purpose" value="Sale" style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;" checked>
                                            <label class="search-label" for="buy" style="margin-left: 2px;font-size: 18px;cursor: pointer;">{{__('text.Buy')}}</label>
                                        </span>

                                        <span style="display: inline-block;min-width: 75px;">
                                            <input class="search-input" type="radio" id="rent" name="purpose" value="Rent" style="width: 16px;height: 16px;position: relative;top: 1px;cursor: pointer;">
                                            <label class="search-label" for="rent" style="margin-left: 2px;font-size: 18px;cursor: pointer;">{{__('text.Rent')}}</label>
                                        </span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group search-bar" style="display: flex;flex-direction: row;height: 55px;margin-bottom: 0;">

                                    {{--<label for="address">Address</label>--}}

                                    <div style="flex-grow: 2;height: 100%;border: 1px solid #d7d7d7;">
                                        <input style="border: 0;height: 100%;box-shadow: none;" class="form-control city-input" type="text" placeholder="{{__('text.City, State, Address')}}" name="city_name" id="city-input" autocomplete="off">

                                        <input type="hidden" name="city_latitude" id="city-latitude"  />
                                        <input type="hidden" name="city_longitude" id="city-longitude"  />

                                    </div>

                                    <button type="button" value="Filters" href="#myModal" data-toggle="modal" class="btn btn-primary filter-button" style="position: absolute;right: 185px;top: 8px;color: black;background: white;border-color: #9f9c9c;height: 40px;padding-top: 7px;outline: none;"><span><img src="{{ URL::asset('assets/img/Filter-512.png') }}" aria-hidden="true" style="margin-right: 10px;width: 20px;margin-top: -3px;" /> <span style="font-size: 16px;">Filters</span></span></button>

                                    <button type="submit" name="submit" value="Search" class="btn btn-primary search-button" style="width: 18%;white-space: break-spaces;padding: 0px;font-size: 16px;outline: none;"><span><i class="fa fa-search" aria-hidden="true" style="margin-right: 10px;"></i> <span>{{__('text.Search Property')}}</span></span></button>

                                </div>


                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                <a style="padding: 0;margin: 0px;text-align: left;color: #2a2929;">

                                    <input name="wheelchair" value="1" type="checkbox" id="wheelchair" style="position: relative;top: 2px;display: block;height: 0px;">


                                    <label class="bg" for="wheelchair" style="margin: 0;">

                                        <img src="{{ URL::asset('assets/img/signaling.png') }}" style="width: 17px;position:relative;top: -1px;margin-right: 3px;" class="icon-feature" />

                                        <span class="search-span" style="position: relative;top: 3px;font-size: 14px;color: #4b4848;">{{__('text.Wheelchair friendly home for people with walking difficulties')}}</span>

                                    </label>


                                </a>
                            </div>

                            <style>

                                #header
                                {
                                    height: 650px;
                                }

                                .quick-search
                                {
                                    padding: 20px 20px;
                                }

                                [type="checkbox"]:not(:checked),
                                [type="checkbox"]:checked {
                                    position: absolute;
                                    left: -9999px;
                                }
                                [type="checkbox"]:not(:checked) + label,
                                [type="checkbox"]:checked + label {
                                    position: relative;
                                    padding-left: 1.3em;
                                    cursor: pointer;
                                    font-weight: 600;
                                }

                                /* checkbox aspect */
                                [type="checkbox"]:not(:checked) + label:before,
                                [type="checkbox"]:checked + label:before {
                                    content: '';
                                    position: absolute;
                                    left: 0; top: 8px;
                                    width: 13px; height: 13px;
                                    border: 1px solid #7e7e7e;
                                    background: #fff;
                                    border-radius: 4px;
                                    box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
                                }
                                /* checked mark aspect */
                                [type="checkbox"]:not(:checked) + label:after,
                                [type="checkbox"]:checked + label:after {
                                    content: '\2713\0020';
                                    position: absolute;
                                    top: 8.5px; left: 0px;
                                    font-size: 1.2em;
                                    line-height: 0.8;
                                    color: #00b8ef;
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
                                    border: 1px solid #4778d9!important;
                                }

                            </style>
                            <!-- break -->


                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-full" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Filters</h5>
                                            <button style="outline: none;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-4" id="result">

                                            <div class="row" style="display: flex;">

                                                <div class="col-sm-4 col-md-4 col-lg-4" style="margin: auto;">

                                                    <div class="form-group">
                                                        <label for="purpose">{{__('text.Radius')}}</label>
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
                                                            <label for="type">{{__('text.Property Type')}}</label>
                                                            <select class="form-control" name="type">
                                                                <option value="">{{__('text.All')}}</option>
                                                                @foreach(\App\Types::orderBy('types')->get() as $type)
                                                                    <option value="{{$type->id}}">{{$type->types}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="maxprice">{{__('text.Max Price')}}</label>
                                                            <input type="number" name="max_price" class="form-control" placeholder="800000">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="minprice">{{__('text.Min Price')}}</label>
                                                            <input type="number" name="min_price" class="form-control" placeholder="20000">
                                                        </div>

                                                    <div class="form-group">
                                                        <label for="bedrooms">{{__('text.Bedrooms')}}</label>
                                                        <input type="number" name="bedrooms" class="form-control" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="bethrooms">{{__('text.Bathrooms')}}</label>
                                                        <input type="number" name="bathrooms" class="form-control" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="minprice">{{__('text.Type of Construction')}}</label>
                                                        <select class="form-control" name="type_of_construction">
                                                            <option value="">{{__('text.All')}}</option>
                                                            <option value="New">{{__('text.New')}}</option>
                                                            <option value="Old">{{__('text.Old')}}</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="minprice">{{__('text.Keywords')}}</label>
                                                        <input type="text" name="keywords" class="form-control" placeholder="{{__('text.Search by Keywords')}}">
                                                    </div>


                                                </div>
                                            </div>



                                        </div>
                                        <div class="modal-footer" style="display: flex;">
                                            <div class="col-md-4 col-sm-5 col-xs-12" style="margin: auto;"><button style="outline: none;" type="submit" name="submit" value="{{__('text.Search')}}" class="btn btn-primary btn-lg btn-block">{{__('text.Search')}}</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <style>

                                @media (max-width: 768px)
                                {
                                    .top-heading
                                    {
                                        font-size: 23px !important;
                                        bottom: 45px !important;
                                    }
                                }

                                #myModal
                                {
                                    padding: 0 !important;
                                }

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
                                    .search-label
                                    {
                                        font-size: 14px !important;
                                    }

                                    .search-input
                                    {
                                        width: 12px !important;
                                        height: 12px !important;
                                    }

                                    [type="checkbox"]:not(:checked) + label:before, [type="checkbox"]:checked + label:before
                                    {
                                        width: 10px !important;
                                        height: 10px !important;
                                    }

                                    .icon-feature{
                                        width: 12px !important;
                                    }

                                    .search-span
                                    {
                                        top: 0px !important;
                                        font-size: 10px !important;
                                    }

                                    #header
                                    {
                                        height: 400px !important;
                                    }

                                    #header .container
                                    {
                                        margin-top: 0px !important;
                                        position: absolute;
                                        top: 125px;
                                    }

                                    .quick-search
                                    {
                                        padding: 15px;
                                        background: rgba(255, 255, 255, 0.91) !important;
                                    }

                                    .search-bar
                                    {
                                        height: 50px !important;
                                    }

                                    .filter-button
                                    {
                                        right: 24% !important;
                                        top: 13px !important;
                                        height: 25px !important;
                                        padding: 4px 10px !important;
                                        font-size: 12px !important;

                                    }

                                    .filter-button span img
                                    {
                                        width: 15px !important;
                                        margin-right: 5px !important;
                                    }

                                    .filter-button span span
                                    {
                                        font-size: 12px !important;
                                    }

                                    .search-button
                                    {

                                        padding: 0px 18px !important;

                                    }

                                    .city-input,
                                    .city-input::-webkit-input-placeholder {
                                        font-size: 9px;
                                        line-height: 3;
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
