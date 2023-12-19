<?php

namespace App\Console\Commands\Elexio;

use App\Models\Event;
use Illuminate\Console\Command;

class ElexioEventsPurgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purges orphaned Event records in the database from Elexio';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $latestSyncedEvent = Event::orderBy('elexio_updated_at', 'desc')->first();

        if (! $latestSyncedEvent) {
            $this->info('No events found in the database. Nothing to purge.');

            return;
        }

        // Remove events in the future that have not
        // synced with Elexio in the past 12 hrs.
        Event::upcoming()
            ->where('elexio_updated_at', '<', $latestSyncedEvent->elexio_updated_at->subHours(12))
            ->delete();
    }
}
