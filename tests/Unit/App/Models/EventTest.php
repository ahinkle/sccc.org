<?php

use App\Enums\EventFrequency;
use App\Models\Concerns\CreatesRedirects;
use App\Models\Concerns\TracksUserUpdates;
use App\Models\Event;

it('should use redirects trait', function () {
    expect(Event::class)->toUse(CreatesRedirects::class);
});

it('should use track user updates trait', function () {
    expect(Event::class)->toUse(TracksUserUpdates::class);
});

it('appropriately gets slug', function () {
    $e = Event::factory()->create([
        'name' => 'Test Event',
        'starts_at' => '2000-01-01 00:00:00',
    ]);

    expect($e->slug)->toBe('events/test-event-jan-1-2000');
});

it('appropriately gets next occurance', function () {
    $nonRecurring = Event::factory()->create();
    $weekly = Event::factory()->repeats(EventFrequency::WEEKLY)->create();
    $biweekly = Event::factory()->repeats(EventFrequency::BIWEEKLY)->create();
    $monthly = Event::factory()->repeats(EventFrequency::MONTHLY)->create();
    $quarterly = Event::factory()->repeats(EventFrequency::QUARTERLY)->create();
    $yearly = Event::factory()->repeats(EventFrequency::YEARLY)->create();

    expect($nonRecurring->nextOccurance)->toBeNull();
    expect($weekly->nextOccurance->format('Y-m-d H:i:s'))->toBe($weekly->starts_at->addWeek()->format('Y-m-d H:i:s'));
    expect($biweekly->nextOccurance->format('Y-m-d H:i:s'))->toBe($biweekly->starts_at->addWeeks(2)->format('Y-m-d H:i:s'));
    expect($monthly->nextOccurance->format('Y-m-d H:i:s'))->toBe($monthly->starts_at->addMonth()->format('Y-m-d H:i:s'));
    expect($quarterly->nextOccurance->format('Y-m-d H:i:s'))->toBe($quarterly->starts_at->addMonths(3)->format('Y-m-d H:i:s'));
    expect($yearly->nextOccurance->format('Y-m-d H:i:s'))->toBe($yearly->starts_at->addYear()->format('Y-m-d H:i:s'));
});

it('appropriately determines if event has passed', function () {
    $past = Event::factory()->past()->create();
    $upcoming = Event::factory()->upcoming()->create();
    $activeButHasNotEnded = Event::factory()->create([
        'starts_at' => now()->subHour(),
        'ends_at' => now()->addHour(),
    ]);
    $activeWithoutEndDatetime = Event::factory()->create([
        'starts_at' => now()->subHour(),
    ]);
    $earlierToday = Event::factory()->create([
        'starts_at' => now()->subHours(2),
        'ends_at' => now()->subHour(),
    ]);
    $allDayToday = Event::factory()->create([
        'starts_at' => today(),
    ]);

    expect($past->hasPassed())->toBeTrue();
    expect($upcoming->hasPassed())->toBeFalse();
    expect($activeButHasNotEnded->hasPassed())->toBeFalse();
    expect($activeWithoutEndDatetime->hasPassed())->toBeTrue();
    expect($earlierToday->hasPassed())->toBeTrue();
    expect($allDayToday->hasPassed())->toBeFalse();
});
