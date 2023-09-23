<?php

use App\Models\MeetingTopic;
use App\Models\User;

it('sets slug on save', function () {
    $meetingTopic = MeetingTopic::factory()->create([
        'name' => 'My First Meeting Topic',
    ]);

    expect($meetingTopic->slug)->toBe('resources/topic/my-first-meeting-topic');
});

it('sets last user id on save', function () {
    $this->actingAs($user = User::factory()->create());

    $meetingTopic = MeetingTopic::factory()->create([
        'updated_by_id' => null,
    ]);

    expect($meetingTopic->updated_by_id)->toBe($user->id);
});
