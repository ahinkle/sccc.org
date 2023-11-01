<?php

use App\Livewire\Events\EventList;
use App\Models\Event;
use Livewire\Livewire;

it('shows events', function () {
    $e = Event::factory()->upcoming()->create();

    Livewire::test(EventList::class)
        ->assertOk()
        ->assertSee($e->name);
});

it('entry event display doesnt show past events', function () {
    $e = Event::factory()->past()->create();

    Livewire::test(EventList::class)
        ->assertOk()
        ->assertDontSee($e->name);
});

it('can filter by name of event', function () {
    $e = Event::factory()->upcoming()->create();
    $dontSee = Event::factory()->upcoming()->create();

    Livewire::test(EventList::class)
        ->set('search', $e->name)
        ->assertOk()
        ->assertSee($e->name)
        ->assertDontSee($dontSee->name);
});
