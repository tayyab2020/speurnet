<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{getcong('site_name')}}</title>


    <style>

        @media (max-width: 768px)
        {
            #res
            {
                width: 90% !important;
            }
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

</head>
<body>

<div style="background: #eeeeef;padding: 50px 0px;border-radius: 20px;" id="res">

    <table style="max-width:640px" border="0" cellspacing="0" cellpadding="0" align="center">

        <tbody>

        <tr>
        <td style="padding:40px 30px 30px 30px" align="center" bgcolor="#33333e"><h1 style="color:#fff">Property Alert</h1>
        </td>
        </tr>

        <tr>
        <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">

        <table border="0" cellpadding="0" cellspacing="0" width="100%">

            <tbody>

            @if(count($properties))
                <tr><td>Hello! Following are the properties for which you have subscribed at {{getcong('site_name')}}</td></tr>

                <tr><td style="padding:10px 0 0 0"><p>Property Alert Parameters: </p>

                        @if($parameters->address)
                            <span class="button-applied-filter span-heading">{{$parameters->address}}</span>

                            <span class="button-applied-filter span-heading">{{$parameters->radius}} KM</span>

                        @endif

                        @if($parameters->property_type)
                            <span class="button-applied-filter span-heading">{{ getPropertyTypeName($parameters->property_type)->types }}</span>
                        @else
                            <span class="button-applied-filter span-heading">All Property Types</span>
                        @endif

                        @if($parameters->property_purpose)
                            <span class="button-applied-filter span-heading">For {{$parameters->property_purpose}}</span>
                        @endif

                        @if($parameters->type_of_construction)
                            <span class="button-applied-filter span-heading">{{$parameters->type_of_construction}} Property</span>
                        @endif


                        @if($parameters->min_price != '' || $parameters->max_price != '')

                            @if($parameters->min_price != '' && $parameters->max_price != '')
                                <span class="button-applied-filter span-heading">€ {{$parameters->min_price}} - € {{$parameters->max_price}}</span>
                            @elseif($parameters->min_price != '')
                                <span class="button-applied-filter span-heading">€ {{$parameters->min_price}}+</span>
                            @elseif($parameters->max_price != '')
                                <span class="button-applied-filter span-heading">€ 0 - € {{$parameters->max_price}}</span>
                            @endif

                        @endif

                        @if($parameters->bedrooms)
                            <span class="button-applied-filter span-heading">{{$parameters->bedrooms}}@if($parameters->bedrooms!=1) Bedrooms @else Bedroom @endif</span>
                        @endif

                        @if($parameters->bathrooms)
                            <span class="button-applied-filter span-heading">{{$parameters->bathrooms}}@if($parameters->bathrooms!=1) Bathrooms @else Bathrooms @endif</span>
                        @endif

                        @if($parameters->min_area != '' || $parameters->max_area != '')

                            @if($parameters->min_area != '' && $parameters->max_area != '')
                                <span class="button-applied-filter span-heading">{{$parameters->min_area}} m² - {{$parameters->max_area}} m² (Plot Area)</span>
                            @elseif($parameters->min_area != '')
                                <span class="button-applied-filter span-heading">{{$parameters->min_area}}+ m² (Plot Area)</span>
                            @elseif($parameters->max_area != '')
                                <span class="button-applied-filter span-heading">0 m² - {{$parameters->max_area}} m² (Plot Area)</span>
                            @endif

                        @endif

                        @if($parameters->keywords)
                            <span class="button-applied-filter span-heading">{{$parameters->keywords}}</span>
                        @endif

                        @if($parameters->wheelchair)
                            <span class="button-applied-filter span-heading">Wheelchair Friendly</span>
                        @endif

                    </td></tr>

                <tr><td style="padding:10px 0 0 0">

                        <table cellpadding="0px" cellspacing="0px">

                            <tbody>

                @foreach($properties as $i => $property)

                                <tr><td style="padding:5px 0 0 0"><a href="{{URL::to('properties/'.$property->property_slug)}}" target="_blank">{{$property->property_name}}</a></td></tr>

                @endforeach

                                </tbody>

                    </table>

                        </td></tr>

                <tr><td style="padding:10px 0 0 0">Properties Count: {{count($properties)}}</td></tr>
                <tr><td style="padding:10px 0 0 0">Alert Frequency: @if($type == 1)Daily @else Weekly @endif</td></tr>
                <tr><td style="padding:10px 0 0 0">To unsubscribe property alert: <a href="{{URL::to('properties/alerts/delete/'.$id)}}" target="_blank">Unsubscribe</a></td></tr>

            @else
                <tr><td><p>Hi User, We couldn't find any property for your Saved Property Alert with Parameters: </p>
                        @if($parameters->address)
                            <span class="button-applied-filter span-heading">{{$parameters->address}}</span>

                            <span class="button-applied-filter span-heading">{{$parameters->radius}} KM</span>

                        @endif

                        @if($parameters->property_type)
                            <span class="button-applied-filter span-heading">{{ getPropertyTypeName($parameters->property_type)->types }}</span>
                        @else
                            <span class="button-applied-filter span-heading">All Property Types</span>
                        @endif

                        @if($parameters->property_purpose)
                            <span class="button-applied-filter span-heading">For {{$parameters->property_purpose}}</span>
                        @endif

                        @if($parameters->type_of_construction)
                            <span class="button-applied-filter span-heading">{{$parameters->type_of_construction}} Property</span>
                        @endif


                        @if($parameters->min_price != '' || $parameters->max_price != '')

                            @if($parameters->min_price != '' && $parameters->max_price != '')
                                <span class="button-applied-filter span-heading">€ {{$parameters->min_price}} - € {{$parameters->max_price}}</span>
                            @elseif($parameters->min_price != '')
                                <span class="button-applied-filter span-heading">€ {{$parameters->min_price}}+</span>
                            @elseif($parameters->max_price != '')
                                <span class="button-applied-filter span-heading">€ 0 - € {{$parameters->max_price}}</span>
                            @endif

                        @endif

                        @if($parameters->bedrooms)
                            <span class="button-applied-filter span-heading">{{$parameters->bedrooms}}@if($parameters->bedrooms!=1) Bedrooms @else Bedroom @endif</span>
                        @endif

                        @if($parameters->bathrooms)
                            <span class="button-applied-filter span-heading">{{$parameters->bathrooms}}@if($parameters->bathrooms!=1) Bathrooms @else Bathrooms @endif</span>
                        @endif

                        @if($parameters->min_area != '' || $parameters->max_area != '')

                            @if($parameters->min_area != '' && $parameters->max_area != '')
                                <span class="button-applied-filter span-heading">{{$parameters->min_area}} m² - {{$parameters->max_area}} m² (Plot Area)</span>
                            @elseif($parameters->min_area != '')
                                <span class="button-applied-filter span-heading">{{$parameters->min_area}}+ m² (Plot Area)</span>
                            @elseif($parameters->max_area != '')
                                <span class="button-applied-filter span-heading">0 m² - {{$parameters->max_area}} m² (Plot Area)</span>
                            @endif

                        @endif

                        @if($parameters->keywords)
                            <span class="button-applied-filter span-heading">{{$parameters->keywords}}</span>
                        @endif
                    </td></tr>
            @endif


            </tbody>

        </table>

        </td></tr>

        <tr><td style="background-color:#ffffff;padding:30px 30px 30px 30px">

                <table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody>

                    <tr><td style="font-family:Arial,sans-serif;font-size:14px">® {{getcong('site_name')}}, {{date("Y")}}</td></tr>

                    </tbody></table>

            </td></tr></tbody></table>


</div>


</body>
</html>
