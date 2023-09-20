<?php

use App\Models\Event;
use App\Models\Redirect;

it('creates a redirect when slug changes', function () {
    $e = Event::factory()->create([
        'starts_at' => '2000-01-01 00:00:00',
    ]);
    $original = $e->slug;

    $e->update(['name' => 'New Name']);

    $this->assertDatabaseHas(Redirect::class, [
        'from' => $original,
        'to' => 'events/new-name-jan-1-2000',
    ]);
});

it('does not create a redirect when slug does not change', function () {
    $e = Event::factory()->create();
    $e->update(['name' => $e->name]);

    expect(Redirect::count())->toBe(0);
});
