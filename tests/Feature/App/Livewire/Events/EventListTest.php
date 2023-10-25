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

it('can filter by date range of event', function () {
    $e = Event::factory()->past()->create();
    $dontSee = Event::factory()->upcoming()->create();

    Livewire::test(EventList::class)
        ->set('startDate', $e->starts_at->subDays(1)->format('Y-m-d'))
        ->set('endDate', $e->starts_at->addDays(1)->format('Y-m-d'))
        ->assertOk()
        ->assertSee($e->name)
        ->assertDontSee($dontSee->name);
});

it('all day events more than 5 days at a time should only show start and end dates in listings', function () {
    //
});

it('all day events 5 days or less displays every day in date listing', function () {
    //
});
