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

    @if(Config::get('app.locale') == 'en')

        <table style="max-width:640px" border="0" cellspacing="0" cellpadding="0" align="center">

            <tbody>

            <tr>
                <td style="padding:40px 30px 30px 30px" align="center" bgcolor="#d6d63e"><h1 style="color:#fff">Ticket Message</h1>
                </td>
            </tr>

            <tr>
                <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">

                <table border="0" cellpadding="0" cellspacing="0" width="100%">

                    <tbody>

                    <tr><td>Hello {{$parameters->tk_rec_name}}, You have received a message regarding {{$ticket_id}} at {{getcong('site_name')}}</td></tr>

                    <tr><td style="padding:10px 0 0 0"><p>Ticket Subject: </p>

                            <span class="button-applied-filter span-heading">{{$parameters->tk_subject}}</span>

                        </td></tr>

                    <tr><td style="padding:10px 0 0 0"><p>Ticket Issue: </p>

                            <span class="button-applied-filter span-heading">"{{$parameters->tk_issue}}"</span>

                        </td></tr>

                    <tr><td style="padding:10px 0 0 0"><p>Ticket Priority: </p>

                            <span class="button-applied-filter span-heading">{{$parameters->tk_priority}}</span>

                        </td></tr>

                    <tr><td style="padding:10px 0 0 0"><p>Ticket Status: </p>

                            <span class="button-applied-filter span-heading">{{$parameters->tk_status}}</span>

                        </td></tr>


                        <tr><td style="padding:10px 0 0 0"><p>Message: </p>

                                <span class="button-applied-filter span-heading">"{{$parameters->tk_message}}"</span>

                            </td></tr>


                    </tbody>

                </table>

                </td></tr>

            <tr><td style="background-color:#ffffff;padding:30px 30px 30px 30px">

                    <table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody>

                        <tr><td style="font-family:Arial,sans-serif;font-size:14px">?? {{getcong('site_name')}}, {{date("Y")}}</td></tr>

                        </tbody></table>

                </td></tr></tbody></table>

                    @else

                        <table style="max-width:640px" border="0" cellspacing="0" cellpadding="0" align="center">

                            <tbody>

                            <tr>
                                <td style="padding:40px 30px 30px 30px" align="center" bgcolor="#d6d63e"><h1 style="color:#fff">Ticket bericht</h1>
                                </td>
                            </tr>

                            <tr>
                                <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%">

                        <tbody>

                        <tr><td>Hallo {{$parameters->tk_rec_name}}, Je hebt een bericht ontvangen van {{getcong('site_name')}} over je ticket {{$ticket_id}}</td></tr>

                        <tr><td style="padding:10px 0 0 0"><p>Ticket Subject: </p>

                                <span class="button-applied-filter span-heading">{{$parameters->tk_subject}}</span>

                            </td></tr>

                        <tr><td style="padding:10px 0 0 0"><p>Ticket Issue: </p>

                                <span class="button-applied-filter span-heading">"{{$parameters->tk_issue}}"</span>

                            </td></tr>

                        <tr><td style="padding:10px 0 0 0"><p>Ticket Priority: </p>

                                <span class="button-applied-filter span-heading">{{__('text.'.$parameters->tk_priority)}}</span>

                            </td></tr>

                        <tr><td style="padding:10px 0 0 0"><p>Ticket Status: </p>

                                <span class="button-applied-filter span-heading">{{__('text.'.$parameters->tk_status)}}</span>

                            </td></tr>


                        <tr><td style="padding:10px 0 0 0"><p>Message: </p>

                                <span class="button-applied-filter span-heading">"{{$parameters->tk_message}}"</span>

                            </td></tr>


                        </tbody>

                    </table>

                                </td></tr>

                            <tr><td style="background-color:#ffffff;padding:30px 30px 30px 30px">

                                    <table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody>

                                        <tr><td style="font-family:Arial,sans-serif;font-size:14px">?? {{getcong('site_name')}}, {{date("Y")}}</td></tr>

                                        </tbody></table>

                                </td></tr></tbody></table>

                @endif


</div>


</body>
</html>
