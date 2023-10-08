<?php

namespace App\Jobs\Events;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
            ->fill(['starts_at' => $event->nextOccurance()])
            ->save();
    }
}
