<?php

use Alaouy\Youtube\Facades\Youtube;
use App\Jobs\Livestream\PublishLivestreamAsMessageJob;
use App\Models\Message;
use Illuminate\Support\Carbon;

it('publishes livestream as message', function () {
    cache()->put('livestream.sunday', 'hKza3UAB3qc');

    Youtube::shouldReceive('getVideoInfo')
        ->once()
        ->andReturn(fakeYouTubeVideo(Carbon::parse('2023-10-29 09:00:00'), 'hKza3UAB3qc'));

    PublishLivestreamAsMessageJob::dispatch();

    tap(Message::where('youtube_id', 'hKza3UAB3qc')->first(), function ($message) {
        expect($message)->not()->toBeNull();
        expect($message->title)->toBe('Grounded | 9:00 AM Sunday, October 29, 2023');
        expect($message->youtube_id)->toBe('hKza3UAB3qc');
    });
});

it('doesnt publish livestream that is already published', function () {
    cache()->put('livestream.sunday', 'hKza3UAB3qc');
    Message::factory()->create(['youtube_id' => 'hKza3UAB3qc']);

    PublishLivestreamAsMessageJob::dispatch();

    expect(Message::where('youtube_id', 'hKza3UAB3qc')->count())->toBe(1);
});
