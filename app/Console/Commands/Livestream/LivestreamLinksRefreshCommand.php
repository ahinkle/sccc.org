<?php

namespace App\Console\Commands\Livestream;

use Illuminate\Console\Command;

class LivestreamLinksRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'livestream:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the upcoming livestream links from the YouTube API.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        return 0;
    }
}
