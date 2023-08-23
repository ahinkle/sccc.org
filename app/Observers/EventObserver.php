<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Str;

class EventObserver
{
    /**
     * Handle the Event "saving" event.
     */
    public function saving(Event $event): void
    {
        $event->last_updated_id = auth()->id() ?? $event->last_updated_id;
        $event->slug = Str::slug($event->name.'-'.$event->starts_at->format('M-j-Y'));
    }
}
