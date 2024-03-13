<?php

use App\Jobs\Events\PublishEventsFromFeedJob;
use App\Jobs\Livestream\PublishLivestreamAsMessageJob;
use App\Jobs\Livestream\UpdateUpcomingLivestreamJob;
use App\Jobs\NewsletterContacts\PruneUnverifiedNewsletterContactsJob;
use Illuminate\Support\Facades\Schedule;

Schedule::command('queue:prune-batches')->daily();
Schedule::command('events:purge')->everySixHours();
Schedule::command('events:verify')->everySixHours();

Schedule::job(new PublishEventsFromFeedJob(today(), today()->addWeek()->endOfDay()))->hourly();
Schedule::job(new PublishEventsFromFeedJob(today()->addDays(8), today()->addMonths(6)->endOfDay()))->everySixHours();
Schedule::job(new PruneUnverifiedNewsletterContactsJob())->daily();
Schedule::job(new UpdateUpcomingLivestreamJob())->weeklyOn(6, '9:00');
Schedule::job(new PublishLivestreamAsMessageJob())->weeklyOn(0, '11:00');
