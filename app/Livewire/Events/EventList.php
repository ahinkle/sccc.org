<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class EventList extends Component
{
    use WithPagination;

    /**
     * The start date search range for events.
     */
    #[Rule(['required', 'date', 'gte:today'])]
    #[Url]
    public ?Carbon $startDate = null;

    /**
     * The end date search range for events.
     */
    #[Rule(['nullable', 'date', 'after_or_equal:startDate'])]
    #[Url]
    public ?Carbon $endDate = null;

    /**
     * The search term for events.
     */
    #[Rule(['nullable', 'string'])]
    #[Url]
    public ?string $search = null;

    public function mount(): void
    {
        $this->startDate = now()->startOfDay();
    }

    public function render()
    {
        return view('livewire.events.event-list', [
            'events' => $this->events(),
        ]);
    }

    /**
     * Get the events for the event list.
     */
    protected function events(): LengthAwarePaginator
    {
        return Event::query()
            ->when($this->startDate, fn ($query) => $query->whereDate('event_start', '>=', $this->startDate))
            ->when($this->endDate, fn ($query) => $query->whereDate('event_end', '<=', $this->endDate))
            ->when($this->search, fn ($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->orderBy('event_start')
            ->paginate(10);
    }
}