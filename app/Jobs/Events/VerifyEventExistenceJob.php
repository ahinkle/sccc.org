<?php

namespace App\Jobs\Events;

use App\Models\Event;
use App\Support\Elexio\ElexioFacade as Elexio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VerifyEventExistenceJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $elexioId,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Elexio::event($this->elexioId);

        if ($response->failed()) {
            Event::where('elexio_id', $this->elexioId)->delete();
        }
    }
}
