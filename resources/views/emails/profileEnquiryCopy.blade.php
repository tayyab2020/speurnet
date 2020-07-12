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
                width: 95% !important;
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
            <td style="padding:40px 30px 30px 30px" align="center" bgcolor="#33333e"><h1 style="color:#fff">Agent Enquiry</h1>
            </td>
        </tr>

        <tr>
            <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">

                <table border="0" cellpadding="0" cellspacing="0" width="100%">

                    <tbody>

                    <tr><td>Hi <span style="text-decoration: underline;">Mr/Mrs {{$parameters->first_name}} {{$parameters->last_name}}</span>, your enquiry has been posted to <span style="text-decoration: underline;">Mr/Mrs {{$parameters->agent_name}}</span> at {{getcong('site_name')}}. The agent will get in touch with you shortly regarding this enquiry.</td></tr>

                    @if($parameters->selling || $parameters->leasing || $parameters->rent_property || $parameters->property_appraisal || $parameters->buy_property)

                        <tr><td style="padding:10px 0 0 0"><p style="font-size: 15px;"><b>Services Required: </b></p>

                                @if($parameters->selling)

                                    <span class="button-applied-filter span-heading">Selling my property</span>

                                @endif

                                @if($parameters->leasing)
                                    <span class="button-applied-filter span-heading">Leasing my property</span>
                                @endif

                                @if($parameters->rent_property)
                                    <span class="button-applied-filter span-heading">Looking to rent a property</span>
                                @endif

                                @if($parameters->property_appraisal)
                                    <span class="button-applied-filter span-heading">Property Appraisal</span>
                                @endif

                                @if($parameters->buy_property)
                                    <span class="button-applied-filter span-heading">Looking to buy a property</span>
                                @endif


                            </td></tr>

                    @endif

                    <tr><td style="padding:10px 0 0 0">

                            <table cellpadding="0px" cellspacing="0px">

                                <tbody>

                                <tr><td style="padding:15px 0 0 0">
                                        <img src="{{ $message->embed(public_path() . '/assets/img/email.png') }}" style="width: 13px;margin-right: 8px;display: block;float: left;margin-top: 2px;"><b style="color: black;">Your Message: </b><span style="color: #7474d3;font-weight: 700;">"{!! $parameters->message !!}"</span>
                                    </td></tr>

                                <tr><td style="padding:15px 0 0 0">
                                        <img src="{{ $message->embed(public_path() . '/assets/img/signs.png') }}" style="width: 13px;margin-right: 8px;display: block;float: left;margin-top: 2px;"><b style="color: black;">Agent Email Address: </b><span style="color: #7474d3;font-weight: 700;">{{$parameters->agent_email}}</span>
                                    </td></tr>

                                @if($parameters->phone)

                                    <tr><td style="padding:15px 0 0 0">
                                            <img src="{{ $message->embed(public_path() . '/assets/img/communications.png') }}" style="width: 15px;margin-right: 6px;display: block;float: left;"><b style="color: black;">Your Phone Number: </b><span style="color: #7474d3;font-weight: 700;">{{$parameters->phone}}</span>
                                        </td></tr>

                                @endif

                                @if($parameters->postcode)

                                    <tr><td style="padding:15px 0 0 0">
                                            <img src="{{ $message->embed(public_path() . '/assets/img/pin.png') }}" style="width: 15px;margin-right: 6px;display: block;float: left;"><b style="color: black;">Your Postcode: </b><span style="color: #7474d3;font-weight: 700;">{{$parameters->postcode}}</span>
                                        </td></tr>

                                @endif

                                </tbody>

                            </table>

                        </td></tr>

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
