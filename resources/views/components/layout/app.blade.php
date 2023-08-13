<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <meta name="theme-color" content="#142648">
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:site_name" content="Santa Claus Christian Church" />
        <meta name="twitter:site" content="@SCCC_org" />
        <meta name="twitter:creator" content="@SCCC_org" />
        <meta property="og:locale" content="en_US" />
        <meta name="twitter:card" content="summary" />
        <meta name="geo.region" content="US-IN" />
        <meta name="geo.placename" content="Santa Claus" />
        <meta name="geo.position" content="38.1201;-86.9142" />
        <meta name="ICBM" content="38.1201, -86.9142" />
        <link rel="icon" type="image/x-icon" href="favicon.ico" />

        @vite(['resources/css/site.css', 'resources/js/site.js'])
        {{ $header }}
    </head>
    <body>
        {{ $slot }}
    </body>
</html>
