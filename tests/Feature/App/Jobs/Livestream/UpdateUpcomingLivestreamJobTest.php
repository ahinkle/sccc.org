<?php

use Alaouy\Youtube\Facades\Youtube;
use App\Jobs\Livestream\UpdateUpcomingLivestreamJob;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use function Pest\Faker\fake;
use function Pest\Laravel\travelTo;

it('updates livestream links from YouTube', function () {
    // Traditionally, Livestreams are refreshed on Fridays.
    travelTo(Carbon::parse('2020-07-31 00:00:00'));

    // Expected dates to be returned from YouTube.
    $sunday = Carbon::parse('2020-08-02 09:00:00');
    $wednesday = Carbon::parse('2020-08-05 17:00:00');
    $weekBeforeSunday = Carbon::parse('2020-07-26 09:00:00');
    $weekAfterSunday = Carbon::parse('2020-08-09 09:00:00');

    Youtube::shouldReceive('searchAdvanced')
        ->once()
        ->andReturn([
            fakeVideo($weekBeforeSunday),
            $expectedSunday = fakeVideo($sunday),
            $expectedWednesday = fakeVideo($wednesday),
            fakeVideo($weekAfterSunday),
        ]);

    UpdateUpcomingLivestreamJob::dispatch();

    expect(Cache::get('livestream.sunday'))->toBe($expectedSunday->id->videoId);
    expect(Cache::get('livestream.wednesday'))->toBe($expectedWednesday->id->videoId);
});

it('current date is sunday; get todays livestream -- not next sunday', function () {
    travelTo(Carbon::parse('2020-08-02 00:00:00'));

    // Expected dates to be returned from YouTube.
    $sunday = Carbon::parse('2020-08-02 09:00:00');
    $wednesday = Carbon::parse('2020-08-05 17:00:00');
    $weekBeforeSunday = Carbon::parse('2020-07-26 09:00:00');
    $weekAfterSunday = Carbon::parse('2020-08-09 09:00:00');

    Youtube::shouldReceive('searchAdvanced')
        ->once()
        ->andReturn([
            fakeVideo($weekBeforeSunday),
            $expectedSunday = fakeVideo($sunday),
            $expectedWednesday = fakeVideo($wednesday),
            fakeVideo($weekAfterSunday),
        ]);

    UpdateUpcomingLivestreamJob::dispatch();

    expect(Cache::get('livestream.sunday'))->toBe($expectedSunday->id->videoId);
    expect(Cache::get('livestream.wednesday'))->toBe($expectedWednesday->id->videoId);
});

it('throws exception if no livestreams are found', function () {
    Youtube::shouldReceive('searchAdvanced')
        ->once()
        ->andReturn([]);

    UpdateUpcomingLivestreamJob::dispatch();
})->throws(Exception::class, 'No upcoming livestreams found.');

it('throws exception if sunday isnt found', function () {
    travelTo(Carbon::parse('2020-07-31 00:00:00'));
    $wednesday = Carbon::parse('2020-08-05 17:00:00');

    Youtube::shouldReceive('searchAdvanced')
        ->once()
        ->andReturn([
            fakeVideo($wednesday),
        ]);

    UpdateUpcomingLivestreamJob::dispatch();
})->throws(Exception::class, 'Could not find upcoming livestreams for Sunday and/or Wednesday.');

it('throws exception if wednesday isnt found', function () {
    travelTo(Carbon::parse('2020-07-31 00:00:00'));
    $sunday = $sunday = Carbon::parse('2020-08-02 09:00:00');

    Youtube::shouldReceive('searchAdvanced')
        ->once()
        ->andReturn([
            fakeVideo($sunday),
        ]);

    UpdateUpcomingLivestreamJob::dispatch();
})->throws(Exception::class, 'Could not find upcoming livestreams for Sunday and/or Wednesday.');

/**
 * Mock an API response from YouTube.
 */
function fakeVideo(Carbon $titleDate): stdClass
{
    $video = new \stdClass();
    $video->id = new \stdClass();
    $video->id->videoId = fake()->uuid;
    $video->snippet = new \stdClass();
    $video->snippet->title = 'Grounded | '.$titleDate->format('g:i A l, F j, Y');

    return $video;
}
