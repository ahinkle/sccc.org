<?php

/*
|--------------------------------------------------------------------------
| Configuration for the Elexio API.
|--------------------------------------------------------------------------
|
| Here is where you can set your configuration inluding
| username and password for the Elexio API.
|
| https://santaclauscc.elexiochms.com/api_documentation#!
*/

return [
    'username' => env('ELEXIO_USERNAME', 'YOUR_USERNAME'),
    'password' => env('ELEXIO_PASSWORD', 'YOUR_PASSWORD'),

    'events' => [
        'view' => env('ELEXIO_EVENTS_VIEW', 'YOUR_EVENTS_VIEW'),
    ],
];
