<?php

use App\Models\Event;
use App\Models\User;

it('tracks user updates on save', function () {
    $e = Event::factory()->create();
    expect($e->last_updated_id)->toBeNull();

    $u = User::factory()->create();
    $this->actingAs($u);

    $e->save();
    expect($e->last_updated_id)->toEqual($u->id);
});

it('uses last user id when on unauthentication save', function () {
    $u = User::factory()->create();
    $e = Event::factory()->create([
        'last_updated_id' => $u,
    ]);
    $e->save();

    expect($e->last_updated_id)->toEqual($u->id);
});
