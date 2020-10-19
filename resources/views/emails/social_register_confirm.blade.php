<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>

@if(Config::get('app.locale') == 'en')


        <body>
        <p>HELLO {{$name}},</p>
        <p>Thanks for joining {{getcong('site_name')}}.</p>
        <p>If you are having trouble logging in, please feel free to contact us.</p>

        <p>Homely greetings,</p>

        <p>The team of {{getcong('site_name')}}</p>
        </body>


@else

        <body>
        <p>Beste woningzoeker,</p>
        <p>Welkom bij bij {{getcong('site_name')}}. Doe of je thuis bent!</p>
        <p>Als je problemen ervaart met het inloggen, neem dan gerust contact met ons op.</p>

        <p>Huiselijke groet,</p>
        <p>Het team van {{getcong('site_name')}}</p>
        </body>

@endif
</html>
