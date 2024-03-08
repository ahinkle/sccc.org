<?php

namespace App\Console\Commands\Events;

use App\Jobs\Events\VerifyEventsExistenceJob;
use Illuminate\Console\Command;

class VerifyEventsExistenceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify that events still exist in Elexio';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        VerifyEventsExistenceJob::dispatch(today(), today()->addMonths(6)->endOfDay());

        return 0;
    }
}
