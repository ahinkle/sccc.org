<?php

namespace App\View\Components\Events;

use Ahinkle\AutoResolvableComponents\AutoResolvableComponent;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class UpcomingEventsSlider extends AutoResolvableComponent
{
    public function __construct(
        public ?Collection $upcomingEvents,
    ) {
        $this->upcomingEvents = $this->upcomingEvents();
    }

    /**
     * Get the upcoming events.
     */
    protected function upcomingEvents(): Collection
    {
        return Event::upcoming()->orderBy('event_start')->limit(7)->get();
    }
}
