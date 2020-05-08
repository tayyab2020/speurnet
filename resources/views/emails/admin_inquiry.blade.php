<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Zoekjehuisje</title>


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

<div style="background: #dce36d;width: 50%;padding: 20px;border-radius: 20px;" id="res">

    <p style="color: black;">Hi Admin,</p>
    <p style="color: black;">{{$gender}} {{$username}} has just posted a inquiry for property  "{{$property_name}}" on your website.</p>
    <p style="color: black;">You can contact the person who requested for viewing or the broker using the following information:</p>

    <img src="{{ $message->embed(public_path() . '/assets/img/signs.png') }}" style="width: 13px;margin-right: 4px;display: block;float: left;margin-top: 4px;"><b style="color: black;">Customer Email Address: </b><span style="color: #7474d3;font-weight: 700;">{{$email}}</span><br><br>

    @if($phone)

        <img src="{{ $message->embed(public_path() . '/assets/img/communications.png') }}" style="width: 13px;margin-right: 4px;display: block;float: left;margin-top: 4px;"><b style="color: black;">Phone Number: </b><span style="color: #7474d3;font-weight: 700;">{{$phone}}</span><br><br>

    @endif

    <img src="{{ $message->embed(public_path() . '/assets/img/business.png') }}" style="width: 13px;margin-right: 4px;display: block;float: left;margin-top: 4px;"><b style="color: black;">Broker Name: </b><span style="color: #7474d3;font-weight: 700;">{{$broker_name}}</span><br><br>

    <img src="{{ $message->embed(public_path() . '/assets/img/signs.png') }}" style="width: 13px;margin-right: 4px;display: block;float: left;margin-top: 4px;"><b style="color: black;">Broker Email Address: </b><span style="color: #7474d3;font-weight: 700;">{{$broker_email}}</span><br><br>

    @if($broker_phone)

        <img src="{{ $message->embed(public_path() . '/assets/img/communications.png') }}" style="width: 13px;margin-right: 4px;display: block;float: left;margin-top: 4px;"><b style="color: black;">Broker Phone Number: </b><span style="color: #7474d3;font-weight: 700;">{{$broker_phone}}</span>

    @endif

</div>


</body>
</html>
