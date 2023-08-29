<?php

namespace App\Console\Commands\Livestream;

use Illuminate\Console\Command;

class LivestreamLinksStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'livestream:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show the status of the upcoming livestream links';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->table(['Day', 'Link'], [
            [
                'Sunday',
                cache()->has('livestream.sunday')
                    ? 'https://youtu.be/'.cache()->get('livestream.sunday')
                    : 'Not Found',
            ],
            [
                'Wednesday',
                cache()->has('livestream.wednesday')
                    ? 'https://youtu.be/'.cache()->get('livestream.wednesday')
                    : 'Not Found',
            ],
        ]);

        return 0;
    }
}
