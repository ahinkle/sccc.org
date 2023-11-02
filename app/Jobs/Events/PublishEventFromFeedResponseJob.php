<?php

namespace App\Jobs\Events;

use App\Enums\State;
use App\Models\Event;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PublishEventFromFeedResponseJob implements ShouldQueue
{
    use Batchable,
        Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Any missing event details that we want to include.
     */
    public ?Event $eventDetailsOverride;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $data,
        public string $batch_id,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->shouldBeIgnored()) {
            return;
        }

        if ($this->eventHasPassed()) {
            return;
        }

        $this->attemptToFindOverrideValuesFromPreviousEvent();
        $this->createOrUpdateEvent();
    }

    /**
     * Determine if the event should be ignored.
     */
    protected function shouldBeIgnored(): bool
    {
        $ignoredTitles = [
            'Holiday World',
        ];

        return collect($ignoredTitles)
            ->contains(fn ($title) => str_contains($this->data['title'], $title));
    }

    /**
     * Determine if the event has passed.
     */
    protected function eventHasPassed(): bool
    {
        return Carbon::parse($this->data['end'])->isPast();
    }

    /**
     * Attempt to find any missing details (image, description, location, etc.) provided from a previous event.
     * This is mostly for recurring events - say we manually include an image or override a description.
     */
    protected function attemptToFindOverrideValuesFromPreviousEvent(): self
    {
        $this->eventDetailsOverride = Event::where('name', $this->data['title'])
            ->whereNotNull('last_updated_id')
            ->latest()
            ->first();

        return $this;
    }

    /**
     * Create or update the event.
     */
    protected function createOrUpdateEvent(): void
    {
        $location = $this->location();

        Event::updateOrCreate([
            'elexio_id' => $this->data['instanceId'],
        ], [
            'elexio_batch_id' => $this->batch_id,
            'elexio_updated_at' => now(),
            'name' => $this->data['title'],
            'description' => $this->eventDetailsOverride?->description ?? strip_tags($this->data['description']),
            'image' => $this->eventDetailsOverride?->image,
            'location' => $location['location'],
            'address' => $location['address'],
            'city' => $location['city'],
            'state' => $location['state'],
            'zip_code' => $location['zip_code'],
            'starts_at' => Carbon::parse($this->data['start']),
            'ends_at' => Carbon::parse($this->data['end']),
            'more_information' => $this->data['contact']
                ? 'Contact '.$this->resolveContactFirstName().' '.$this->data['contact']['lname'].' ('.$this->data['contact']['email'].')'
                : null,
        ]);
    }

    /**
     * Get the location.
     */
    protected function location(): array
    {
        if ($this->eventDetailsOverride) {
            return [
                'location' => $this->eventDetailsOverride->location,
                'address' => $this->eventDetailsOverride->address,
                'city' => $this->eventDetailsOverride->city,
                'state' => $this->eventDetailsOverride->state,
                'zip_code' => $this->eventDetailsOverride->zip_code,
            ];
        }

        return [
            'location' => $this->resolveLocationName(),
            'address' => '351 N Holiday Blvd',
            'city' => 'Santa Claus',
            'state' => State::IN,
            'zip_code' => '47579',
        ];
    }

    /**
     * Resolve the location name.
     */
    protected function resolveLocationName(): string
    {
        $rooms = collect($this->data['buildings'])
            ->map(fn ($building) => collect($building['rooms']))
            ->flatten()
            ->filter(fn ($item) => is_string($item))
            ->filter(fn ($item) => preg_match('/[A-Z]\d\s-\s/', $item) === 1)
            ->map(fn ($item) => Str::before($item, ' - '));

        return ($rooms->count() > 0)
            ? 'Santa Claus Christian Church - '.$rooms->join(', ', ', and ')
            : 'Santa Claus Christian Church';
    }

    /**
     * Determine the contact's first name.
     */
    protected function resolveContactFirstName(): string
    {
        if (! $this->data['contact']) {
            return '';
        }

        if ($this->data['contact']['preferredName']) {
            return $this->data['contact']['preferredName'];
        }

        return $this->data['contact']['fname'];
    }
}
