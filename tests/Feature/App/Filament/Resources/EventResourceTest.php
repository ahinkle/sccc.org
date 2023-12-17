<?php

use App\Filament\Resources\EventResource\Pages\ListEvents;
use App\Models\Event;
use Filament\Pages\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

use function Pest\Livewire\livewire;

it('can list events', function () {
    $events = Event::factory()->count(10)->create();

    livewire(ListEvents::class)
        ->assertCanSeeTableRecords($events);
});

it('can edit event', function () {
    $event = Event::factory()->upcoming()->create();

    livewire(ListEvents::class)
        ->callTableAction(EditAction::class, $event, data: [
            'name' => $name = fake()->words(asText: true),
        ])
        ->assertHasNoTableActionErrors();

    expect($event->refresh())
        ->name->toBe($name);
});

it('can delete event', function () {
    $event = Event::factory()->upcoming()->create();

    livewire(ListEvents::class)
        ->callTableAction(DeleteAction::class, $event);

    $this->assertModelMissing($event);
});

it('can duplicate event', function () {
    $event = Event::factory()->upcoming()->create();

    livewire(ListEvents::class)
        ->callTableAction('duplicate', $event, data: [
            'starts_at' => now()->addWeek(),
            'ends_at' => now()->addWeeks(2),
        ]);

    expect(Event::count())->toBe(2);
});
