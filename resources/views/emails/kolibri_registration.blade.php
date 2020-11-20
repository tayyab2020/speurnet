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
    <p>HELLO {{$name}},</p>
    <p>Thanks for joining {{getcong('site_name')}}.</p>
    <p>Your account has been created on {{getcong('site_name')}} through <b>Kolibri</b> contract. From now on your Real Estate Properties can be seen on {{getcong('site_name')}}. You can use the below included login details to manage your property alerts.</p></p>
    <p>Here is your login ID & password for {{getcong('site_name')}}</p>

    <p>Login ID : {{$email}}</p>
    <p>Password : {{$password}}</p>

    <p>If you are having trouble logging in, please feel free to contact us.</p>

    <p>Homely greetings,</p>

    <p>The team of {{getcong('site_name')}}</p>
    </body>

@endif

</html>
