<x-mail::message>
# Failed to Locate Livestream

Our system has detected an issue with the scheduled YouTube livestreams for the upcoming services. It appears that the link may not have been scheduled or displayed as intended.

We will make {{ $attempt }} to update the YouTube livestream link within the next 24 hours.

<x-mail::table>
| Looking For | Found |
| ----------- | ----- |
| {{ $sunday->format('l, F j, Y') }} | {{ cache('livestream.sunday') ? 'https://youtu.be/' . cache('livestream.sunday') : 'Not Found' }} |
| {{ $wednesday->format('l, F j, Y') }} | {{ cache('livestream.wednesday') ? 'https://youtu.be/' . cache('livestream.wednesday') : 'Not Found' }} |
</x-mail::table>

Here are the scheduled livestreams our system found but did not match the expected date:

<x-mail::table>
| Title | Link |
| ----------- | ----- |
@foreach ($videos as $video)
| {{ str_replace('|', '', $video->snippet->title) }} | https://youtu.be/{{ $video->id->videoId }} |
@endforeach
</x-mail::table>

</x-mail::message>
