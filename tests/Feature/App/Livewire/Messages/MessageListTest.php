<?php

use App\Livewire\Messages\MessageList;
use App\Models\Message;
use App\Models\Person;
use Livewire\Livewire;

it('shows message listing', function () {
    $m = Message::factory()->create();

    Livewire::test(MessageList::class)
        ->assertOk()
        ->assertSee($m->title);
});

it('shows message with speaker', function () {
    $m = Message::factory()
        ->has(Person::factory()->count(1), 'speakers')
        ->create();

    Livewire::test(MessageList::class)
        ->assertOk()
        ->assertSee($m->speakers->first()->name);
});

it('filters messages by search title', function () {
    $m = Message::factory()->create();
    $dontSee = Message::factory()->create();

    Livewire::test(MessageList::class)
        ->set('search', $m->title)
        ->assertOk()
        ->assertSee($m->title)
        ->assertDontSee($dontSee->title);
});

it('filters by speaker', function () {
    $m = Message::factory()
        ->has(Person::factory()->count(1), 'speakers')
        ->create();
    $dontSee = Message::factory()
        ->has(Person::factory()->count(1), 'speakers')
        ->create();

    Livewire::test(MessageList::class)
        ->set('speaker', $m->speakers->first()->id)
        ->assertOk()
        ->assertSee($m->title)
        ->assertDontSee($dontSee->title);
});

it('filters by date', function () {
    $m = Message::factory()->create([
        'message_date' => now()->subDays(1),
    ]);
    $dontSee = Message::factory()->create([
        'message_date' => now()->subDays(2),
    ]);

    Livewire::test(MessageList::class)
        ->set('startDate', now()->subDays(1)->format('Y-m-d'))
        ->assertOk()
        ->assertSee($m->title)
        ->assertDontSee($dontSee->title);
});
