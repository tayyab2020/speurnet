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

                <tr><td style="padding:10px 0 0 0">Property Alert Title: <b>{{$title}}</b></td></tr>

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
                <tr><td>Hi User, We couldn't find any property for your Saved Property Alert with Title: <b>{{$title}}</b></td></tr>
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
