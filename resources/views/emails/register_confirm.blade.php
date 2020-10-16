<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	</head>

    @if(Config::get('app.locale') == 'en')

        @if($user_type == 'Agents' || $user_type == 'landlord')

	<body>
		<p>HELLO {{$name}},</p>
		 <p>Thanks for joining Zoekjehuisje.nl.</p>
		<p>You can use the below included login details to manage your property alerts on Zoekjehuisje.nl.</p>
		<p>Here is your login ID & password for Zoekjehuisje.nl</p>

		<p>Login ID : {{$email}}</p>
		<p>Password : {{$password}}</p>

		<p>Please verify your email id by clicking on the following link (or copy it into a browser):</p>
		<p>{!! link_to('auth/confirm/' . $confirmation_code) !!}.<br></p>
        <p>If you are having trouble logging in, please feel free to contact us.</p>

        <p>Homely greetings,</p>

        <p>The team of Zoekjehuisje.nl</p>
	</body>

        @else

            <body>
            <p>HELLO {{$name}},</p>
            <p>Thanks for joining Zoekjehuisje.nl.</p>
            <p>You can use the below included login details to manage your property alerts on Zoekjehuisje.nl.</p>
            <p>Here is your login ID & password for Zoekjehuisje.nl</p>

            <p>Login ID : {{$email}}</p>
            <p>Password : {{$password}}</p>

            <p>Please verify your email id by clicking on the following link (or copy it into a browser):</p>
            <p>{!! link_to('auth/confirm/' . $confirmation_code) !!}.<br></p>
            <p>From now on you can respond at any time to properties that are interesting for you.</p>
            <p>We wish you success in finding your dream home!</p>

            <p>The team of Zoekjehuisje.nl</p>
            </body>

        @endif

    @else

        @if($user_type == 'Agents' || $user_type == 'landlord')

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

        @else

            <body>
            <p>Beste woningzoeker,</p>
            <p>Welkom bij bij Zoekjehuisje.nl. Doe of je thuis bent!</p>
            <p>Je kunt nu inloggen met de volgende gegevens</p>

            <p>Gebruikersnaam: {{$email}}</p>
            <p>Wachtwoord: {{$password}}</p>

            <p>We vragen je alleen nog om je e-mailadres te verifiëren door op de onderstaande link te klikken:</p>
            <p>{!! link_to('auth/confirm/' . $confirmation_code) !!}.<br></p>
            <p>Vanaf nu kunt jij op elk moment reageren op voor jou interessante woningen.</p>
            <p>Wij wensen je succes met het vinden van jouw droomwoning!</p>

            <p>Het team van Zoekjehuisje.nl</p>
            </body>

        @endif

    @endif
</html>
