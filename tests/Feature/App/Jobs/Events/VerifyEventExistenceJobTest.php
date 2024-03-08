<?php

use App\Jobs\Events\VerifyEventExistenceJob;
use App\Models\Event;
use Illuminate\Support\Facades\Http;

it('removes event that is no longer in elexio', function () {
    $event = Event::factory()->create([
        'elexio_id' => 123,
    ]);

    Http::fake([
        'https://santaclauscc.elexiochms.com/api/calendar/event/123*' => Http::response([], 404),
    ]);

    VerifyEventExistenceJob::dispatch($event->elexio_id);

    expect(Event::where('elexio_id', 123)->exists())->toBeFalse();
});

it('keeps event that is still in elexio', function () {
    $event = Event::factory()->create([
        'elexio_id' => 123,
    ]);

    Http::fake([
        'https://santaclauscc.elexiochms.com/api/calendar/event/123*' => Http::response([], 200),
    ]);

    VerifyEventExistenceJob::dispatch($event->elexio_id);

    expect(Event::where('elexio_id', 123)->exists())->toBeTrue();
});
