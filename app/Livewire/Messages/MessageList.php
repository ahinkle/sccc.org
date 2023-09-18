<?php

namespace App\Livewire\Messages;

use App\Models\Message;
use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MessageList extends Component
{
    use WithPagination;

    /**
     * The search term for messages.
     */
    #[Rule(['nullable', 'string', 'max:255'])]
    #[Url]
    public ?string $search = null;

    /**
     * The start date search range for messages.
     */
    #[Rule(['required', 'date'])]
    #[Url]
    public ?string $startDate = null;

    /**
     * The end date search range for messages.
     */
    #[Rule(['nullable', 'date', 'after_or_equal:startDate'])]
    #[Url]
    public ?string $endDate = null;

    /**
     * The selected speaker for messages.
     */
    #[Rule(['nullable', 'string', 'max:255', 'exists:people,id'])]
    #[Url]
    public ?string $speaker = null;

    /**
     * Render the message list component.
     */
    public function render(): View
    {
        return view('livewire.messages.message-list', [
            'messages' => $this->sermonMessages(),
            'speakers' => $this->speakers(),
            'isSearching' => $this->isSearching(),
        ]);
    }

    /**
     * Get the messages for the message list.
     */
    protected function sermonMessages(): LengthAwarePaginator
    {
        return Message::query()
            ->with('speakers')
            ->when($this->search, fn ($query, $search) => $query->where('title', 'like', "%{$search}%"))
            ->when($this->speaker, function ($query, $speaker) {
                return $query->whereHas('speakers', fn ($query) => $query->where('id', $speaker));
            })
            ->when($this->startDate, fn ($query, $startDate) => $query->where('message_date', '>=', $startDate))
            ->when($this->endDate, fn ($query, $endDate) => $query->where('message_date', '<=', $endDate))
            ->orderBy('message_date', 'desc')
            ->paginate(10);
    }

    /**
     * Get the available speakers for messages.
     */
    protected function speakers(): Collection
    {
        return Person::query()
            ->has('messages')
            ->withCount('messages')
            ->orderBy('messages_count', 'desc')
            ->get();
    }

    /**
     * Determine if the user has performed a search.
     */
    protected function isSearching(): bool
    {
        return $this->startDate || $this->endDate || $this->search || $this->speaker;
    }
}
