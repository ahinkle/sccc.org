<!doctype html>
<html lang="en">
    <head>
        <x-layout.seo-meta>
            {{ $seo }}
        </x-layout.seo-meta>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- TODO: Locally host these fonts. --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Nunito+Sans:opsz,wght@6..12,400;6..12,600;6..12,700&family=Poppins:ital,wght@0,400;0,600;0,700;1,400;1,700&family=Sen:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        @if (app()->isLocal())
            <x-dev.dev-toolbar />
        @endif

        <x-layout.header />
            {{ $slot }}
        <x-layout.footer />
    </body>
</html>
