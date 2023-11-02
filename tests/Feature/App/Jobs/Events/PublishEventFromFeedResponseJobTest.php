<?php

use App\Jobs\Events\PublishEventFromFeedResponseJob;
use App\Models\Event;
use Illuminate\Bus\Batchable;

it('is batchable', function () {
    expect(PublishEventFromFeedResponseJob::class)->toUse(Batchable::class);
});

it('publishes a event from feed', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => '',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    $event = Event::first();
    expect($event->name)->toBe('Test Event');
    expect($event->starts_at->toIso8601String())->toBe(today()->toIso8601String());
    expect($event->ends_at->toIso8601String())->toBe(today()->endOfDay()->toIso8601String());
    expect($event->elexio_id)->toBe(123);
    expect($event->elexio_batch_id)->toBe('batch-id-example');
    expect($event->location)->toBe('Santa Claus Christian Church');
});

it('updates event date/time', function () {
    $e = Event::factory()->withElexio()->create();

    $data = [
        'title' => $e->name,
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => $e->elexio_id,
        'description' => '',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect($e->refresh()->starts_at->toIso8601String())->toBe(today()->toIso8601String());
    expect($e->refresh()->ends_at->toIso8601String())->toBe(today()->endOfDay()->toIso8601String());
});

it('updates title', function () {
    $e = Event::factory()->withElexio()->create();

    $data = [
        'title' => 'foo',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => $e->elexio_id,
        'description' => '',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect($e->refresh()->name)->toBe('foo');
});

it('does not duplicate events', function () {
    $e = Event::factory()->withElexio()->create();

    $data = [
        'title' => $e->name,
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => $e->elexio_id,
        'description' => '',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
});

it('does not publish events that have passed', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->subDay()->toIso8601String(),
        'end' => today()->subDay()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => '',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(0);
});

it('uses previous event description if there is a match', function () {
    $e = Event::factory()->hasUserEdit()->create([
        'name' => 'Test Event',
        'description' => 'foo',
        'starts_at' => today()->subWeek()->toIso8601String(),
        'ends_at' => today()->subWeek()->endOfDay()->toIso8601String(),
    ]);

    $data = [
        'title' => 'Test Event',
        'start' => today()->addDay()->toIso8601String(),
        'end' => today()->addDay()->endOfDay()->toIso8601String(),
        'instanceId' => 9999,
        'description' => '',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::where('description', 'foo')->count())->toBe(2);
});

it('uses previous event image', function () {
    $e = Event::factory()->hasUserEdit()->create([
        'name' => 'Test Event',
        'starts_at' => today()->subWeek()->toIso8601String(),
        'ends_at' => today()->subWeek()->endOfDay()->toIso8601String(),
        'image' => 'foo.jpg',
    ]);

    $data = [
        'title' => 'Test Event',
        'start' => today()->addDay()->toIso8601String(),
        'end' => today()->addDay()->endOfDay()->toIso8601String(),
        'instanceId' => 9999,
        'description' => '',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::where('image', 'foo.jpg')->count())->toBe(2);
});

it('uses contact information if provided', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => '',
        'contact' => [
            'fname' => 'Jesus',
            'lname' => 'Christ',
            'preferredName' => '',
            'phoneHome' => '1-800-heaven',
            'phoneCell' => '1-800-heaven',
            'email' => 'jesus@christ.com',
            'uid' => 1,
        ],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect(Event::first()->more_information)->toBe('Contact Jesus Christ (jesus@christ.com)');
});

it('uses contact preferred name if provided', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => '',
        'contact' => [
            'fname' => 'Samuel',
            'lname' => 'Jackson',
            'preferredName' => 'Sam',
            'phoneHome' => '1-800-heaven',
            'phoneCell' => '1-800-heaven',
            'email' => 'sam@jackson.com',
            'uid' => 1,
        ],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect(Event::first()->more_information)->toBe('Contact Sam Jackson (sam@jackson.com)');
});

it('uses provided description if provided and no previous description was ever found', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => 'Foo',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect(Event::first()->description)->toBe('Foo');
});

it('uses provided location', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => 'Foo',
        'contact' => [],
        'buildings' => [
            [
                'name' => 'Santa Claus Christian Church',
                'id' => 1,
                'rooms' => [
                    [
                        'id' => 1,
                        'name' => 'L3 - Nursery',
                    ],
                ],
            ],
        ],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect(Event::first()->location)->toBe('Santa Claus Christian Church - L3');
});

it('uses previous event location', function () {
    $e = Event::factory()->hasUserEdit()->create([
        'name' => 'Test Event',
        'starts_at' => today()->subWeek()->toIso8601String(),
        'ends_at' => today()->subWeek()->endOfDay()->toIso8601String(),
        'location' => 'foo',
    ]);

    $data = [
        'title' => 'Test Event',
        'start' => today()->addDay()->toIso8601String(),
        'end' => today()->addDay()->endOfDay()->toIso8601String(),
        'instanceId' => 9999,
        'description' => '',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::where('location', 'foo')->count())->toBe(2);
});

it('displays two room numbers', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => 'Foo',
        'contact' => [],
        'buildings' => [
            [
                'name' => 'Santa Claus Christian Church',
                'id' => 1,
                'rooms' => [
                    [
                        'id' => 1,
                        'name' => 'U1 - Worship Center \/ Sanctuary',
                    ],
                    [
                        'id' => 2,
                        'name' => 'L3 - Nursery',
                    ],
                ],
            ],
        ],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect(Event::first()->location)->toBe('Santa Claus Christian Church - U1, and L3');
});

it('displays multiple room numbers', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => 'Foo',
        'contact' => [],
        'buildings' => [
            [
                'name' => 'Santa Claus Christian Church',
                'id' => 1,
                'rooms' => [
                    [
                        'id' => 1,
                        'name' => 'Worship Center \/ Sanctuary',
                    ],
                    [
                        'id' => 2,
                        'name' => 'L3 - Nursery',
                    ],
                    [
                        'id' => 3,
                        'name' => 'L4 - Toddler Classroom',
                    ],
                    [
                        'id' => 3,
                        'name' => 'L5 - Toddler Classroom',
                    ],
                ],
            ],
        ],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect(Event::first()->location)->toBe('Santa Claus Christian Church - L3, L4, and L5');
});

it('updates location when api provides location update', function () {
    $e = Event::factory()->withElexio()->create([
        'name' => 'Test Event',
        'location' => 'foo',
    ]);

    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => $e->elexio_id,
        'description' => 'Foo',
        'contact' => [],
        'buildings' => [
            [
                'name' => 'Santa Claus Christian Church',
                'id' => 1,
                'rooms' => [
                    [
                        'id' => 1,
                        'name' => 'L3 - Nursery',
                    ],
                ],
            ],
        ],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect($e->refresh()->location)->toBe('Santa Claus Christian Church - L3');
});

it('defaults to worship center if no location is provided', function () {
    $data = [
        'title' => 'Test Event',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => 'Foo',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(1);
    expect(Event::first()->location)->toBe('Santa Claus Christian Church');
});

it('ignores specific events by name', function () {
    $data = [
        'title' => 'Holiday World Podcast',
        'start' => today()->toIso8601String(),
        'end' => today()->endOfDay()->toIso8601String(),
        'instanceId' => 123,
        'description' => 'Foo',
        'contact' => [],
        'buildings' => [],
    ];

    PublishEventFromFeedResponseJob::dispatch($data, 'batch-id-example');

    expect(Event::count())->toBe(0);
});
