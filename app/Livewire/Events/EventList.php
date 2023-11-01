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
     * The search term for events.
     */
    #[Rule(['nullable', 'string', 'max:255'])]
    #[Url]
    public ?string $search = null;

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
        $this->search = null;
    }

    /**
     * Get the events for the event list.
     */
    protected function events(): LengthAwarePaginator
    {
        return Event::query()
            ->where('starts_at', '>=', today())
            ->when($this->search, fn ($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->orderBy('starts_at')
            ->paginate(10);
    }

    /**
     * Determine if the user has performed a search.
     */
    protected function isSearching(): bool
    {
        return $this->search !== null;
    }
}
