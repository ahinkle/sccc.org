<?php

namespace Tests\Feature\Components\Events;

use App\Models\Event;
use Tests\TestCase;

class UpcomingEventsSliderTest extends TestCase
{
    public function test_it_shows_upcoming_event(): void
    {
        $e = Event::factory()->upcoming()->create();

        $component = $this->blade('<x-events.upcoming-events-slider />');

        $component->assertSee($e->name);
    }

    public function test_it_does_not_show_past_event(): void
    {
        $e = Event::factory()->past()->create();

        $component = $this->blade('<x-events.upcoming-events-slider />');

        $component->assertDontSee($e->name);
    }
}
