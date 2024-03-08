<?php

use App\Jobs\Events\VerifyEventExistenceJob;
use App\Jobs\Events\VerifyEventsExistenceJob;
use App\Models\Event;
use Illuminate\Support\Facades\Queue;

it('resolves events within date period', function () {
    Queue::fake();

    $e = Event::factory()->create([
        'elexio_id' => 123,
        'starts_at' => now(),
        'ends_at' => now()->addHour(),
    ]);

    $j = VerifyEventsExistenceJob::dispatch(today(), today()->addWeek());
    $j->handle();

    Queue::assertPushed(VerifyEventExistenceJob::class);
});

it('does not include event outside of date range', function () {
    Queue::fake();

    $e = Event::factory()->create([
        'elexio_id' => 123,
        'starts_at' => now()->subWeeks(2),
        'ends_at' => now()->subWeeks(2)->addHour(),
    ]);

    $j = VerifyEventsExistenceJob::dispatch(today(), today()->addWeek());
    $j->handle();

    Queue::assertNothingPushed();
});
