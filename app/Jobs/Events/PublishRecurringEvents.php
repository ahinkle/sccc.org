<?php

namespace App\Jobs\Events;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PublishRecurringEvents implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $events = Event::query()->recurring()->hasStarted()->notEnded()->get();

        $events->each(fn (Event $event) => $this->publishNextOccurrence($event));
    }

    /**
     * Publish the next occurrence of the event.
     */
    protected function publishNextOccurrence(Event $event): void
    {
        $event->replicate()
            ->fill(['starts_at' => $event->repeat_frequency->nextOccurance($event->starts_at)])
            ->save();
    }
}
