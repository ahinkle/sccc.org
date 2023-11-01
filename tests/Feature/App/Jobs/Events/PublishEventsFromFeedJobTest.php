<?php

use App\Jobs\Events\PublishEventsFromFeedJob;
use Illuminate\Bus\PendingBatch;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

it('gets events and feeds them to publish event from feed response job', function () {
    Bus::fake();

    Cache::put('elexio_session_id', '1234567890', 60 * 10);

    Http::preventStrayRequests();

    Http::fake([
        'https://santaclauscc.elexiochms.com/api/calendar/events*' => Http::response([
            'data' => [
                [
                    'eventId' => 1,
                    'title' => 'Event Title',
                    'start' => now()->addDay()->format('Y-m-d\TH:i:sP'),
                    'end' => now()->addHours(1)->format('Y-m-d\TH:i:sP'),
                ],
                [
                    'eventId' => 2,
                    'title' => 'Second Event',
                    'start' => now()->addDay()->format('Y-m-d\TH:i:sP'),
                    'end' => now()->addHours(1)->format('Y-m-d\TH:i:sP'),
                ],
            ],
        ]),
    ]);

    $job = new PublishEventsFromFeedJob(now(), now()->addDays(7));
    $job->handle();

    Bus::assertBatched(function (PendingBatch $batch) {
        return $batch->jobs->count() === 2;
    });
});

it('handles empty events response', function () {
    Bus::fake();

    Cache::put('elexio_session_id', '1234567890', 60 * 10);

    Http::preventStrayRequests();

    Http::fake([
        'https://santaclauscc.elexiochms.com/api/calendar/events*' => Http::response([
            'data' => [],
        ]),
    ]);

    $job = new PublishEventsFromFeedJob(now(), now()->addDays(7));
    $job->handle();

    Bus::assertBatched(function (PendingBatch $batch) {
        return $batch->jobs->count() === 0;
    });
});
