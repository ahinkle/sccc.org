<?php

use App\Jobs\Livestream\PublishLivestreamAsMessageJob;
use App\Models\Message;

it('publishes livestream', function () {
    expect(Message::count())->toBe(0);

    cache()->put('livestream.sunday', 'D6krCJFvp_E');
    PublishLivestreamAsMessageJob::dispatch();

    expect(Message::count())->toBe(1);

    $message = Message::first();
    expect($message->title)->toBe('Grounded | 9:00 AM Sunday, September 17, 2023');
});

it('doesnt publish duplicate', function () {
    $m = Message::factory()->create([
        'youtube_id' => 'D6krCJFvp_E',
    ]);

    cache()->put('livestream.sunday', 'D6krCJFvp_E');
    PublishLivestreamAsMessageJob::dispatch();

    expect(Message::count())->toBe(1);
});
