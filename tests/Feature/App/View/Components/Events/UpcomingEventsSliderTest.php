<?php

use App\Models\Event;

test('it shows upcoming event', function () {
    $e = Event::factory()->upcoming()->create();

    $component = $this->blade('<x-events.upcoming-events-slider />');

    $component->assertSee($e->name);
});

test('it does not show past event', function () {
    $e = Event::factory()->past()->create();

    $component = $this->blade('<x-events.upcoming-events-slider />');

    $component->assertDontSee($e->name);
});

it('all day events more than 5 days at a time should only show start and end dates in listings', function () {
    //
});
