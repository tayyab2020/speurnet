<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>

@if(Config::get('app.locale') == 'en')

        <body>
        <p>HELLO {{$name}},</p>
        <p>Thanks for joining {{getcong('site_name')}}.</p>
        <p>Your account has been created on {{getcong('site_name')}} in reference to <b>Kolibri</b> contract. From now on your Real Estate Properties can be seen on {{getcong('site_name')}}. You can use the below included login details to manage your property alerts.</p></p>
        <p>Here is your login ID & password for {{getcong('site_name')}}</p>

        <p>Login ID : {{$email}}</p>
        <p>Password : {{$password}}</p>

        <p>If you are having trouble logging in, please feel free to contact us.</p>

        <p>Homely greetings,</p>

        <p>The team of {{getcong('site_name')}}</p>
        </body>

@else

    <body>
    <p>Beste makelaardij {{$name}},</p>
    <p>Welkom!</p>
    <p>Vanaf nu zijn jouw woningen zichtbaar op {{getcong('site_name')}}.</p>
    <p>Je kunt de onderstaande inloggevens gebruiken om je woningen te beheren en je bedrijfslogo te uploaden.</p>
    <p><b>Jouw inloggegevens</b></p>

    <p>Gebruikersnaam : {{$email}}</p>
    <p>Wachtwoord : {{$password}}</p>

    <p>Mocht je problemen hebben met inloggen, dan kun je contact opnemen met ons via info@zoekjehuisje.nl</p>

    <p>Met huiselijke groet,</p>

    <p>Het team van {{getcong('site_name')}}</p>

    <p>Van ‘te koop’ naar ‘verkocht!’ Van ‘te huur’ naar ‘verhuurd.’ Welkom thuis!
        www.zoekjehuisje.nl
        info@zoekjehuisje.nl
    </p>
    </body>

@endif

</html>
