<?php

use App\Jobs\Events\PublishRecurringEventsJob;
use Illuminate\Support\Facades\Queue;

it('queues job from command execution', function () {
    Queue::fake();

    $this->artisan('events:recurring')
        ->expectsConfirmation('This will launch a background task to publish recurring events from the prior day. Are you sure you want to continue?', 'yes')
        ->expectsOutput('Publishing recurring events from the prior day...')
        ->expectsOutput('Successfully launched task.')
        ->assertExitCode(0);

    Queue::assertPushed(PublishRecurringEventsJob::class);
});
