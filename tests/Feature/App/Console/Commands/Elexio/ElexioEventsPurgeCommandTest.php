<?php

use App\Models\Event;

it('deletes orphaned events on event purge', function () {
    $orphaned = Event::factory()->upcoming()->create([
        'elexio_updated_at' => now()->subHours(13),
    ]);
    $e = Event::factory()->upcoming()->create([
        'elexio_updated_at' => now(),
    ]);

    $this->artisan('events:purge')
        ->assertExitCode(0);

    expect($orphaned->fresh())->toBeNull();
    expect(Event::count())->toBe(1);
});

it('doesnt delete non-orphaned events on event purge', function () {
    $event = Event::factory()->upcoming()->create([
        'elexio_updated_at' => now()->subHours(3),
    ]);
    $event2 = Event::factory()->upcoming()->create([
        'elexio_updated_at' => now(),
    ]);

    $this->artisan('events:purge')
        ->assertExitCode(0);

    expect(Event::count())->toBe(2);
});

it('doesnt purge past events on event purge', function () {
    $past = Event::factory()->past()->create([
        'elexio_updated_at' => now()->subHours(13),
    ]);
    $e = Event::factory()->upcoming()->create([
        'elexio_updated_at' => now(),
    ]);

    $this->artisan('events:purge')
        ->assertExitCode(0);

    expect(Event::count())->toBe(2);
});

it('successfully runs when no events are available on event purge', function () {
    $this->artisan('events:purge')
        ->assertExitCode(0);
});
