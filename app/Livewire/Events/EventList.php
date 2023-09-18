<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EventList extends Component
{
    use WithPagination;

    /**
     * The start date search range for events.
     */
    #[Rule(['required', 'date'])]
    #[Url]
    public ?string $startDate = null;

    /**
     * The end date search range for events.
     */
    #[Rule(['nullable', 'date', 'after_or_equal:startDate'])]
    #[Url]
    public ?string $endDate = null;

    /**
     * The search term for events.
     */
    #[Rule(['nullable', 'string', 'max:255'])]
    #[Url]
    public ?string $search = null;

    public function mount(): void
    {
        $this->startDate = today()->format('Y-m-d');
    }

    public function render(): View
    {
        return view('livewire.events.event-list', [
            'events' => $this->events(),
            'isSearching' => $this->isSearching(),
        ]);
    }

    /**
     * Clear the search parameters.
     */
    public function resetFilters(): void
    {
        $this->reset(['startDate' => today()->format('Y-m-d'), 'endDate', 'search']);
    }

    /**
     * Get the events for the event list.
     */
    protected function events(): LengthAwarePaginator
    {
        return Event::query()
            ->when($this->startDate, fn ($query) => $query->whereDate('starts_at', '>=', $this->startDate))
            ->when($this->endDate, fn ($query) => $query->whereDate('starts_at', '<=', $this->endDate))
            ->when($this->search, fn ($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->orderBy('starts_at')
            ->paginate(10);
    }

    /**
     * Determine if the user has performed a search.
     */
    protected function isSearching(): bool
    {
        if ($this->endDate || $this->search) {
            return true;
        }

        if ($this->startDate) {
            return $this->startDate !== today()->format('Y-m-d');
        }

        return false;
    }
}
