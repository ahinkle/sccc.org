<?php

use App\Enums\EventFrequency;
use App\Jobs\Events\PublishRecurringEventsJob;
use App\Models\Event;

it('publishes a weekly event', function () {
    $e = Event::factory()->create([
        'repeat_frequency' => EventFrequency::WEEKLY,
        'starts_at' => now()->subDay(),
    ]);

    PublishRecurringEventsJob::dispatch();

    expect(Event::count())->toBe(2);
    expect(Event::latest('id')->first()->starts_at->format('Y-m-d H:i:s'))
        ->toBe($e->starts_at->addWeek()->format('Y-m-d H:i:s'));
});

it('publishes a biweekly event', function () {
    $e = Event::factory()
        ->past()
        ->repeats(EventFrequency::BIWEEKLY)
        ->create();

    PublishRecurringEventsJob::dispatch();

    expect(Event::count())->toBe(2);
    expect(Event::latest('id')->first()->starts_at->format('Y-m-d H:i:s'))
        ->toBe($e->starts_at->addWeeks(2)->format('Y-m-d H:i:s'));
});

it('publishes a monthly event', function () {
    $e = Event::factory()
        ->past()
        ->repeats(EventFrequency::MONTHLY)
        ->create();

    PublishRecurringEventsJob::dispatch();

    expect(Event::count())->toBe(2);
    expect(Event::latest('id')->first()->starts_at->format('Y-m-d H:i:s'))
        ->toBe($e->starts_at->addMonth()->format('Y-m-d H:i:s'));
});

it('publishes a quarterly event', function () {
    $e = Event::factory()
        ->past()
        ->repeats(EventFrequency::QUARTERLY)
        ->create();

    PublishRecurringEventsJob::dispatch();

    expect(Event::count())->toBe(2);
    expect(Event::latest('id')->first()->starts_at->format('Y-m-d H:i:s'))
        ->toBe($e->starts_at->addMonths(3)->format('Y-m-d H:i:s'));
});

it('publishes a yearly event', function () {
    $e = Event::factory()
        ->past()
        ->repeats(EventFrequency::YEARLY)
        ->create();

    PublishRecurringEventsJob::dispatch();

    expect(Event::count())->toBe(2);
    expect(Event::latest('id')->first()->starts_at->format('Y-m-d H:i:s'))
        ->toBe($e->starts_at->addYear()->format('Y-m-d H:i:s'));
});

it('doesnt publish non-repeat event', function () {
    Event::factory()->past()->create();
    PublishRecurringEventsJob::dispatch();
    expect(Event::count())->toBe(1);
});

it('doesnt publish expired event', function () {
    Event::factory()
        ->past()
        ->expired()
        ->repeats(EventFrequency::WEEKLY)
        ->create();

    PublishRecurringEventsJob::dispatch();
    expect(Event::count())->toBe(1);
});

it('doesnt publish event that hasnt started yet', function () {
    Event::factory()->upcoming()->create();
    PublishRecurringEventsJob::dispatch();
    expect(Event::count())->toBe(1);
});
