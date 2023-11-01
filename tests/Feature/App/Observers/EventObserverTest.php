<?php

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Carbon;

it('updates last updated by user id on saving', function () {
    $u = User::factory()->create();
    $this->actingAs($u);

    $e = Event::factory()->create();
    expect($e->last_updated_id)->toBe($u->id);
});

it('sets slug on save', function () {
    $e = Event::factory()->create([
        'name' => 'My Event',
        'starts_at' => Carbon::parse('2021-01-01 12:00:00'),
    ]);

    expect($e->slug)->toBe('events/my-event-jan-1-2021');
});

it('sets places end time in slug when end time is established', function () {
    $e = Event::factory()->create([
        'name' => 'My Event',
        'starts_at' => Carbon::parse('2021-01-01 12:00:00'),
        'ends_at' => Carbon::parse('2021-01-01 13:00:00'),
    ]);

    expect($e->slug)->toBe('events/my-event-jan-1-2021-1200pm-to-jan-1-2021-0100pm');
});
