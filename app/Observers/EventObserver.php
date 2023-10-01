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
        $event->slug = $event->ends_at
            ? Str::slug($event->name.'-'.$event->starts_at->format('M-j-Y-hia').'-to-'.$event->ends_at->format('M-j-Y-hia'))
            : Str::slug($event->name.'-'.$event->starts_at->format('M-j-Y'));
    }
}
