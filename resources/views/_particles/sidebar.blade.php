<div class="{{$class ?? 'col-md-3 col-md-pull-9'}} sidebar">
            <div class="widget widget-white">
              <div class="widget-header">
                <h3>Advance Search</h3>
              </div>


                @if(Route::currentRouteName() == 'searchproperties')

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

                            @if(Route::currentRouteName() == 'searchproperties')


                            <div class="modal-body" style="display: inline-block;width: 100%;">

                                <div class="form-group">

                                    <p>
                                        By saving your search you will receive notifications based on the following search criteria:
                                    </p>

                                    @if($address)
                                            <span class="button-applied-filter span-heading">{{$address}}</span>

                                            <span class="button-applied-filter span-heading">{{$radius}} KM</span>

                                    @endif

                                    @if($property_type)
                                            <span class="button-applied-filter span-heading">{{ getPropertyTypeName($property_type)->types }}</span>
                                        @else
                                            <span class="button-applied-filter span-heading">All Property Types</span>
                                    @endif

                                    @if($purpose)
                                            <span class="button-applied-filter span-heading">For {{$purpose}}</span>
                                    @endif

                                    @if($type_of_construction)
                                        <span class="button-applied-filter span-heading">{{$type_of_construction}} Property</span>
                                    @endif


                                    @if($min_price != '' || $max_price != '')

                                        @if($min_price != '' && $max_price != '')
                                        <span class="button-applied-filter span-heading">€ {{$min_price}} - € {{$max_price}}</span>
                                        @elseif($min_price != '')
                                        <span class="button-applied-filter span-heading">€ {{$min_price}}+</span>
                                        @elseif($max_price != '')
                                        <span class="button-applied-filter span-heading">€ 0 - € {{$max_price}}</span>
                                        @endif

                                    @endif

                                    @if($bedrooms)
                                        <span class="button-applied-filter span-heading">{{$bedrooms}}@if($bedrooms!=1) Bedrooms @else Bedroom @endif</span>
                                    @endif

                                    @if($bathrooms)
                                        <span class="button-applied-filter span-heading">{{$bathrooms}}@if($bathrooms!=1) Bathrooms @else Bathrooms @endif</span>
                                    @endif

                                    @if($min_area != '' || $max_area != '')

                                        @if($min_area != '' && $max_area != '')
                                            <span class="button-applied-filter span-heading">{{$min_area}} m² - {{$max_area}} m² (Plot Area)</span>
                                        @elseif($min_area != '')
                                            <span class="button-applied-filter span-heading">{{$min_area}}+ m² (Plot Area)</span>
                                        @elseif($max_area != '')
                                            <span class="button-applied-filter span-heading">0 m² - {{$max_area}} m² (Plot Area)</span>
                                        @endif

                                    @endif

                                    @if($keywords)
                                        <span class="button-applied-filter span-heading">{{$keywords}}</span>
                                    @endif

                                    @if($wheelchair)
                                        <span class="button-applied-filter span-heading">Wheelchair Friendly</span>
                                    @endif

                                </div>

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
                                <input name="bedrooms" type="hidden" value="{{$bedrooms}}">
                                <input name="bathrooms" type="hidden" value="{{$bathrooms}}">
                                <input name="min_area" type="hidden" value="{{$min_area}}">
                                <input name="max_area" type="hidden" value="{{$max_area}}">
                                <input name="type_of_construction" type="hidden" value="{{$type_of_construction}}">
                                <input name="keywords" type="hidden" value="{{$keywords}}">
                                <input name="wheelchair" type="hidden" value="{{$wheelchair}}">

                                <br>


                                <br>

                                <div>

                                <label>Property Alert Type: &nbsp</label>

                                <p style="margin-top: 10px;">
                                    <input type="radio" id="test1" name="type" value="1" checked>
                                    <label for="test1">Daily</label>
                                </p>

                                <p>
                                    <input type="radio" id="test2" name="type" value="2">
                                    <label for="test2">Weekly</label>
                                </p>

                                </div>


                                <button class="btn btn-success" type="submit" style="float: right;outline: none;">Create Property Alert</button>
                                {!! Form::close() !!}
                            </div>

                                @endif


                        </div>
                    </div>
                </div>

                @if(Route::currentRouteName() != 'newconstructions-front' && Route::currentRouteName() != 'searchnewconstructions' && Route::currentRouteName() != 'newconstruction-single')

              {!! Form::open(array('url' => array('searchproperties'),'class'=>'advance-search','name'=>'search_form','id'=>'search_form','role'=>'form')) !!}

                @else

              {!! Form::open(array('url' => array('searchnewconstructions'),'class'=>'advance-search','name'=>'search_form','id'=>'search_form','role'=>'form')) !!}

                    @endif

               <div class="form-group">
                      <label for="city">City</label>

                   <input class="form-control city-input" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$address}}" @else value="" @endif type="text" placeholder="City, State, Address" name="city_name" id="city-input" autocomplete="off">

                   <input type="hidden" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$address_latitude}}" @else value="" @endif name="city_latitude" id="city-latitude"  />
                   <input type="hidden" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$address_longitude}}" @else value="" @endif name="city_longitude" id="city-longitude"  />

                    </div>

                <div class="form-group">
                    <label for="purpose">Radius</label>
                    <select class="form-control" name="radius">
                        <option value="0" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 0) selected @endif @endif>0 KM</option>
                        <option value="1" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 1) selected @endif @endif>1 KM</option>
                        <option value="2" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 2) selected @endif @endif>2 KM</option>
                        <option value="5" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 5) selected @endif @endif>5 KM</option>
                        <option value="10" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 10) selected @endif @endif>10 KM</option>
                        <option value="15" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 15) selected @endif @endif>15 KM</option>
                        <option value="30" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 30) selected @endif @endif>30 KM</option>
                        <option value="50" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 50) selected @endif @endif>50 KM</option>
                        <option value="100" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($radius == 100) selected @endif @endif>100 KM</option>
                    </select>
                </div>

                @if(Route::currentRouteName() != 'newconstructions-front' && Route::currentRouteName() != 'searchnewconstructions' && Route::currentRouteName() != 'newconstruction-single')

                <div class="form-group">
                      <label for="purpose">Purpose</label>
                      <select class="form-control" name="purpose">
                        <option value="Sale" @if(Route::currentRouteName() == 'searchproperties') @if($purpose == 'Sale') selected @endif @endif>For Sale</option>
                        <option value="Rent" @if(Route::currentRouteName() == 'searchproperties') @if($purpose == 'Rent') selected @endif @endif>For Rent</option>
                      </select>
               </div>

                    @else

                    <div class="form-group">
                        <label for="minprice">Kind of Type</label>
                        <select class="form-control" name="kind_of_type">
                            <option value="For Sale" @if(Route::currentRouteName() == 'searchnewconstructions') @if($kind_of_type == 'For Sale') selected @endif @endif>For Sale</option>
                            <option value="To Rent Social" @if(Route::currentRouteName() == 'searchnewconstructions') @if($kind_of_type == 'To Rent Social') selected @endif @endif>To Rent Social</option>
                            <option value="To Rent Free" @if(Route::currentRouteName() == 'searchnewconstructions') @if($kind_of_type == 'To Rent Free') selected @endif @endif>To Rent Free</option>
                        </select>
                    </div>

                @endif

               <div class="form-group">
                      <label for="type">Property Type</label>
                      <select class="form-control" name="type">
                          <option value="">All</option>
                        @foreach(\App\Types::orderBy('types')->get() as $type)
                        <option value="{{$type->id}}" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($property_type == $type->id) selected @endif @endif>{{$type->types}}</option>
						@endforeach

                      </select>
              </div>


                <div class="form-group">
                      <label for="minprice">Min Price</label>
                      <input type="number" name="min_price" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$min_price}}" @else value="" @endif class="form-control" placeholder="Min Price (number)">
                </div>

                <div class="form-group">
                      <label for="maxprice">Max Price</label>
                      <input type="number" name="max_price" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$max_price}}" @else value="" @endif class="form-control" placeholder="Max Price (number)">
                </div>

                <div class="form-group">
                    <label for="minprice">Bedrooms</label>
                    <input type="number" name="bedrooms" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$bedrooms}}" @else value="" @endif class="form-control" placeholder="No. of Bedrooms">
                </div>

                <div class="form-group">
                    <label for="minprice">Bathrooms</label>
                    <input type="number" name="bathrooms" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$bathrooms}}" @else value="" @endif class="form-control" placeholder="No. of Bathrooms">
                </div>

                <div class="form-group">
                    <label for="minprice">Min Area (m2)</label>
                    <input type="number" name="min_area" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$min_area}}" @else value="" @endif class="form-control" placeholder="Minimum SQFT Area (m2)">
                </div>

                <div class="form-group">
                    <label for="minprice">Max Area (m2)</label>
                    <input type="number" name="max_area" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$max_area}}" @else value="" @endif class="form-control" placeholder="Maximum SQFT Area (m2)">
                </div>

                @if(Route::currentRouteName() != 'newconstructions-front' && Route::currentRouteName() != 'searchnewconstructions' && Route::currentRouteName() != 'newconstruction-single')

                <div class="form-group">
                    <label for="minprice">Type of Construction</label>
                    <select class="form-control" name="type_of_construction">
                        <option value="">All</option>
                        <option value="New" @if(Route::currentRouteName() == 'searchproperties') @if($type_of_construction == 'New') selected @endif @endif>New</option>
                        <option value="Old" @if(Route::currentRouteName() == 'searchproperties') @if($type_of_construction == 'Old') selected @endif @endif>Old</option>
                    </select>
                </div>

                @endif

                <div class="form-group">
                    <label for="minprice">Keywords</label>
                    <input type="text" name="keywords" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') value="{{$keywords}}" @else value="" @endif class="form-control" placeholder="Search by Keywords">
                </div>

                <div class="form-group">

                    <label>Wheelchair friendly home for people with walking difficulties</label>

                    <p style="margin-top: 10px;">
                        <input type="radio" id="wh1" name="wheelchair" value="1" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($wheelchair == 1) checked @endif @endif>
                        <label for="wh1">Yes</label>
                    </p>

                    <p>
                        <input type="radio" id="wh2" name="wheelchair" value="0" @if(Route::currentRouteName() == 'searchproperties' || Route::currentRouteName() == 'searchnewconstructions') @if($wheelchair == 0) checked @endif @else checked @endif>
                        <label for="wh2">No</label>
                    </p>

                </div>

                <input type="submit" name="submit" value="Search" class="btn btn-primary btn-block" style="outline: none;">
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

    .span-heading
    {
        text-align: center;
        background-color: #e6f2f7;
        color: #0071b3;
        line-height: 2;
        padding: 0 1rem 0 1rem;
        margin: 0 .375rem .375rem 0;
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 100%;
        height: auto;
        border: 0;
        font-family: sans-serif;
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
