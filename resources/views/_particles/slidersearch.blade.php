<!-- begin:header -->
    <div id="header" style="border-bottom: 1px solid #f3f3f3;" class="header-slide">

    </div>


    <!-- end:header -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

<script>

    function initMap()
    {
        const locationInputs = $('.city-input');


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
    }

    $( document ).ready(function() {

        initMap();

    });

</script>
