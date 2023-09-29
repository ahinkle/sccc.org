<?php

namespace App\Jobs\Livestream;

use Alaouy\Youtube\Facades\Youtube;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishLivestreamAsMessageJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->messageAlreadyExists()) {
            return;
        }

        $livestream = $this->videoDetailsFromYouTube();

        Message::create([
            'title' => $livestream->snippet->title,
            'youtube_id' => cache()->get('livestream.sunday'),
            'message_date' => today(),
        ]);
    }

    /**
     * Determine if the message has already been published.
     */
    protected function messageAlreadyExists(): bool
    {
        return Message::where('youtube_id', cache()->get('livestream.sunday'))->exists();
    }

    /**
     * Get the details of the livestream from YouTube.
     */
    protected function videoDetailsFromYouTube(): \StdClass
    {
        return Youtube::getVideoInfo(cache()->get('livestream.sunday'));
    }
}
