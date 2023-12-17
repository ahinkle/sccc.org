<?php

use App\Models\Event;

it('renders event page index', function () {
    $e = Event::factory()->create();

    $this->get(route('events.index'))
        ->assertOk()
        ->assertSee($e->title);
});

it('renders event page index without any events', function () {
    $e = Event::factory()->past()->create();

    $this->get(route('events.index'))
        ->assertOk()
        ->assertDontSee($e->title);
});

it('renders event show page', function () {
    $e = Event::factory()->create();

    $this->get($e->slug)
        ->assertOk()
        ->assertSee($e->title);
});

it('unknown event returns 404', function () {
    $this->get('/events/unknown')
        ->assertNotFound();
});
