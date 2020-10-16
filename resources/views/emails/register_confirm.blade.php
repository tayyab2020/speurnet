<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	</head>

    @if(Config::get('app.locale') == 'en')

	<body>
		<p>HELLO {{$name}},</p>
		 <p>Thanks for joining {{getcong('site_name')}}.</p>
		<p>You can use the below included login details to manage your property alerts on {{getcong('site_name')}}.</p>
		<p>Here is your login ID & password for {{getcong('site_name')}}</p>

		<p>Login ID : {{$email}}</p>
		<p>Password :{{$password}}</p>

		<p>Please verify your email id by clicking on the following link (or copy it into a browser):</p>
		<p>{!! link_to('auth/confirm/' . $confirmation_code) !!}.<br></p>
	</body>

    @else

        <body>
        <p>Beste woningzoeker,</p>
        <p>Welkom bij bij Zoekjehuisje.nl. Doe of je thuis bent!</p>
        <p>Je kunt nu inloggen met de volgende gegevens</p>

        <p>Gebruikersnaam: {{$email}}</p>
        <p>Wachtwoord: {{$password}}</p>

        <p>We vragen je alleen nog om je e-mailadres te verifiëren door op de onderstaande link te klikken:</p>
        <p>{!! link_to('auth/confirm/' . $confirmation_code) !!}.<br></p>
        <p>Als je problemen ervaart met het inloggen, neem dan gerust contact met ons op.</p>
        <p>Huiselijke groet,</p>
        <p>Het team van Zoekjehuisje.nl</p>
        </body>

    @endif
</html>
