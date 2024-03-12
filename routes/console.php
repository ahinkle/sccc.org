<?php

use App\Jobs\Events\PublishEventsFromFeedJob;
use App\Jobs\Livestream\PublishLivestreamAsMessageJob;
use App\Jobs\Livestream\UpdateUpcomingLivestreamJob;
use App\Jobs\NewsletterContacts\PruneUnverifiedNewsletterContactsJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('queue:prune-batches')->daily();
Artisan::command('events:purge')->everySixHours();
Artisan::command('events:verify')->everySixHours();

Schedule::call(new PublishEventsFromFeedJob(today(), today()->addWeek()->endOfDay()))->hourly();
Schedule::call(new PublishEventsFromFeedJob(today()->addDays(8), today()->addMonths(6)->endOfDay()))->everySixHours();
Schedule::call(new PruneUnverifiedNewsletterContactsJob())->daily();
Schedule::call(new UpdateUpcomingLivestreamJob())->weeklyOn(6, '9:00');
Schedule::call(new PublishLivestreamAsMessageJob())->weeklyOn(0, '11:00');
