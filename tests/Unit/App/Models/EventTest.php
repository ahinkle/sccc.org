<?php

use App\Models\Event;

it('gets slug', function () {
    $e = Event::factory()->create([
        'name' => 'Test Event',
        'starts_at' => '2000-01-01 00:00:00',
    ]);

    expect($e->slug)->toBe('events/test-event-jan-1-2000');
});

it('determines if event has passed', function () {
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
