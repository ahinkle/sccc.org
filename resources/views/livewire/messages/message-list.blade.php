<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 px-4 lg:px-0">
    <div class="col-span-1 lg:col-span-4 xl:col-span-3">
        <form wire:submit class="bg-gray-100 py-10 -mt-16 shadow-lg">
            <div class="px-4">
                <h2 class="text-black pb-5 uppercase text-sm">Filters</h2>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-y-4">
                    <x-inputs.input
                        name="search"
                        wire:model.live="search"
                        type="search"
                        placeholder="Name of Message"
                        hideLabel
                    />
                    <div>
                        <div class="pb-3">
                            <x-inputs.label for="date-range">Date Range</x-inputs.label>
                        </div>
                        <div class="grid sm:grid-cols-9 pt-5 sm:pt-0 gap-y-2 sm:gap-y-0">
                            <div class="sm:col-span-4">
                                <x-inputs.input
                                    name="startDate"
                                    wire:model.live="startDate"
                                    type="date"
                                    hideLabel
                                />
                            </div>
                            <div class="sm:col-span-1 place-self-center">
                                <span class="text-black font-poppins">to</span>
                            </div>
                            <div class="sm:col-span-4">
                                <x-inputs.input
                                    name="endDate"
                                    wire:model.live="endDate"
                                    type="date"
                                    hideLabel
                                />
                            </div>
                        </div>
                    </div>
                    <x-inputs.select name="speaker" wire:model.live="speaker">
                        <option value="">All Speakers</option>
                        @foreach ($speakers as $speaker)
                            <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
            </div>
        </form>
    </div>

    <div class="col-span-1 lg:col-span-8 xl:col-span-9">
        @if ($isSearching)
            <div class="mt-5">
                @if ($messages->count() === 0)
                    <h3 class="text-2xl font-semibold font-sen text-black uppercase">
                        No Results Found <a wire:click.prevent="resetFilters" class="text-green-900 hover:text-green-700 text-xs pt-2 cursor-pointer">Clear</a>
                        <span class="block text-base max-w-xl py-2">
                            Sorry, we couldn't find any messages matching your search criteria.
                        </span>
                    </h3>
                @else
                    <h3 class="text-2xl font-semibold font-sen text-black uppercase">
                        {{ $messages->count() }} results <a wire:click.prevent="resetFilters" class="text-green-900 hover:text-green-700 text-xs pt-2 cursor-pointer">Clear</a>
                    </h3>
                @endif
            </div>
        @endif
        <ul class="grid grid-cols-1 gap-y-14 mt-10 gap-x-6 max-w-[100rem] pr-2">
            @foreach ($messages as $message)
                <li wire:key="{{ $message->id }}">
                    <div class="grid grid-cols-12">
                        <div class="col-span-3 text-center border-r border-b border-l bg-no-repeat bg-center bg-cover" style="background-image: url('{{ $message->image }}'); min-height: 200px;"></div>

                        <div class="col-span-9 border-t border-b border-r">
                            <div class="p-4">
                                <div class="grid grid-cols-1 gap-y-4">
                                    <h2 class="text-xl font-semibold font-sen text-green-900">
                                        {{ $message->title }}
                                    </h2>

                                    <p class="text-sm text-gray-700">
                                        {{ $message->message_date->format('F j, Y') }}
                                        @if ($message->speakers->count() > 0)
                                            |
                                        @endif
                                        {{ $message->speakers->pluck('name')->join(', ', ', and ') }}
                                    </p>

                                    <p class="max-w-xl">
                                        {{ $message->description }}
                                    </p>

                                    <x-inputs.button :href="$message->youtube_url" target="_blank">
                                        <x-fas-video class="w-4 h-4 mr-2 inline-block" />
                                        Watch on YouTube
                                    </x-inputs.button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        @if ($messages->hasPages())
            <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between pt-5 max-w-[100rem] pr-2">
                <span>
                    @if ($messages->onFirstPage())
                        <x-inputs.button disabled>&laquo; Previous</x-inputs.button>
                    @else
                        <x-inputs.button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">&laquo; Previous</x-inputs.button>
                    @endif
                </span>

                <span>
                    @if ($messages->onLastPage())
                        <x-inputs.button disabled>Next &raquo;</x-inputs.button>
                    @else
                        <x-inputs.button wire:click="nextPage" wire:loading.attr="disabled" rel="next">Next &raquo;</x-inputs.button>
                    @endif
                </span>
            </nav>
        @endif
    </div>
</div>
