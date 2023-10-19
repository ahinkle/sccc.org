<?php

use App\Models\Message;

it('redirects to latest youtube video', function () {
    $olderMessage = Message::factory()->create([
        'message_date' => '2020-01-01 00:00:00',
    ]);

    $latestMessage = Message::factory()->create([
        'message_date' => now(),
    ]);

    $this->get('/messages/latest')
        ->assertRedirect($latestMessage->youtube_url);
});
