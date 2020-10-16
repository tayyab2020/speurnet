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

@if(Config::get('app.locale') == 'en')

<div style="background: #dce36d;width: 50%;padding: 20px;border-radius: 20px;" id="res">

    <p style="color: black;">Dear {{$broker_name}},</p>
    <p style="color: black;">You have received a request of viewing for you property  "{{$property_name}}" by {{$gender}} {{$username}}.</p>
    <p style="color: black;">You can contact the person who requested for viewing using the following information:</p>
    <img src="{{ $message->embed(public_path() . '/assets/img/signs.png') }}" style="width: 13px;margin-right: 8px;display: block;float: left;margin-top: 4px;"><b style="color: black;">Email Address: </b><span style="color: #7474d3;font-weight: 700;">{{$email}}</span><br><br>

    @if($phone)

        <img src="{{ $message->embed(public_path() . '/assets/img/communications.png') }}" style="width: 13px;margin-right: 8px;display: block;float: left;margin-top: 4px;"><b style="color: black;">Telephone Number: </b><span style="color: #7474d3;font-weight: 700;">{{$phone}}</span>

    @endif

</div>

@else

    <?php if($gender == 'Mr.'){ $gender = 'meneer'; $gender1 = 'Dhr.'; }else{ $gender = 'mevrouw'; $gender1 = 'mevrouw.'; } ?>

    <div style="background: #dce36d;width: 50%;padding: 20px;border-radius: 20px;" id="res">

        <p style="color: black;">Beste makelaar,</p>
        <p style="color: black;">Je hebt een bezichtigingsverzoek ontvangen van {{$gender}} {{$username}} voor de "{{$property_name}}".</p>
        <p style="color: black;">Je kunt met de volgende gegevens contact opnemen met {{$gender}} {{$username}} om de bezichtiging te plannen:</p>
        <p>{{$gender1}} {{$username}}</p>
        <img src="{{ $message->embed(public_path() . '/assets/img/signs.png') }}" style="width: 13px;margin-right: 8px;display: block;float: left;margin-top: 4px;"><b style="color: black;">E-mail: </b><span style="color: #7474d3;font-weight: 700;">{{$email}}</span><br><br>

        @if($phone)

            <img src="{{ $message->embed(public_path() . '/assets/img/communications.png') }}" style="width: 13px;margin-right: 8px;display: block;float: left;margin-top: 4px;"><b style="color: black;">Telefoonnummer: </b><span style="color: #7474d3;font-weight: 700;">{{$phone}}</span>

        @endif

    </div>


@endif


</body>
</html>
