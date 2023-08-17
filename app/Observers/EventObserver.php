<?php

namespace App\Observers;

use App\Models\Event;

class EventObserver
{
    /**
     * Handle the Event "saving" event.
     */
    public function saving(Event $event): void
    {
        $event->last_updated_id = auth()->id() ?? $event->last_updated_id;
    }
}
