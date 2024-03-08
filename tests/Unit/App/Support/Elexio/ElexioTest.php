<?php

use App\Support\Elexio\Elexio as ElexioClient;
use App\Support\Elexio\ElexioFacade as Elexio;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

it('logs in and captures session id', function () {
    Http::fake([
        'https://santaclauscc.elexiochms.com/api/user/login' => Http::response([
            'data' => [
                'session_id' => '1234567890',
            ],
        ]),
    ]);

    $sessionId = Elexio::login('foo', 'bar');

    expect($sessionId)->toBe('1234567890');
});

it('throws exception when API is down', function () {
    Http::fake([
        'https://santaclauscc.elexiochms.com/api/user/login' => Http::response([], 500),
    ]);

    Elexio::login('foo', 'bar');
})->throws(Exception::class, 'Elexio authentication failed.');

it('caches session id and does not repeatedly hit API', function () {
    Cache::put('elexio_session_id', '1234567890', 60 * 10);

    $result = fn () => with(new ReflectionClass(new ElexioClient()), function ($r) {
        $m = $r->getMethod('session');
        $m->setAccessible(true);

        return $m->invoke(new ElexioClient());
    });

    expect($result())->toBe('1234567890');
});

it('session gets new session id from API when expired', function () {
    Http::fake([
        'https://santaclauscc.elexiochms.com/api/user/login' => Http::response([
            'data' => [
                'session_id' => '1234567890',
            ],
        ]),
    ]);

    $result = fn () => with(new ReflectionClass(new ElexioClient()), function ($r) {
        $m = $r->getMethod('session');
        $m->setAccessible(true);

        return $m->invoke(new ElexioClient());
    });

    expect($result())->toBe('1234567890');
});

it('gets events from Elexio', function () {
    Cache::put('elexio_session_id', '1234567890', 60 * 10);

    Http::preventStrayRequests();

    Http::fake([
        'https://santaclauscc.elexiochms.com/api/calendar/events*' => Http::response([
            'data' => [],
        ]),
    ]);

    $events = Elexio::events(now(), now()->addDay());

    expect($events)->toBeArray();
});

it('throws exception on failed events API call from Elexio', function () {
    Cache::put('elexio_session_id', '1234567890', 60 * 10);

    Http::preventStrayRequests();

    Http::fake([
        'https://santaclauscc.elexiochms.com/api/calendar/events*' => Http::response([], 500),
    ]);

    Elexio::events(now(), now()->addDay());
})->throws(Exception::class, 'Elexio events request failed.');

it('gets event by ID from Elexio', function () {
    Cache::put('elexio_session_id', '1234567890', 60 * 10);

    Http::preventStrayRequests();

    Http::fake([
        'https://santaclauscc.elexiochms.com/api/calendar/event/1*' => Http::response([
            'data' => [],
        ]),
    ]);

    $events = Elexio::event('1');

    expect($events->ok())->toBeTrue();
});
