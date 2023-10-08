<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 px-4 lg:px-0">
    <div class="col-span-1 lg:col-span-4 xl:col-span-3">
        <form wire:submit class="bg-gray-100 py-10 -mt-16 shadow-lg">
            <div class="px-4">
                <h2 class="text-black pb-5 uppercase text-sm font-poppins">Search</h2>

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
                        placeholder="Name of Event"
                        hideLabel
                    />
                    <div class="grid sm:grid-cols-9 pt-5 sm:pt-0 gap-y-2 sm:gap-y-0">
                        <div class="sm:col-span-4">
                            <x-inputs.input
                                name="startDate"
                                wire:model.live="startDate"
                                type="date"
                                placeholder="Name of Event"
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
                                placeholder="Name of Event"
                                hideLabel
                            />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-span-1 lg:col-span-8 xl:col-span-9">
        @if ($isSearching)
            <div class="mt-5">
                @if ($events->count() === 0)
                    <h3 class="text-2xl font-semibold font-sen text-black uppercase ">
                        No Results Found <a wire:click.prevent="resetFilters" class="text-green-900 hover:text-green-700 text-xs pt-2 cursor-pointer">Clear</a>
                        <span class="block text-base max-w-xl py-2">
                            We couldn't find any results. Please utilize the available filters to refine your search.
                        </span>
                    </h3>
                @else
                    <h3 class="text-2xl font-semibold font-sen text-black uppercase">
                        {{ $events->count() }} results <a wire:click.prevent="resetFilters" class="text-green-900 hover:text-green-700 text-xs pt-2 cursor-pointer">Clear</a>
                    </h3>
                @endif
            <div>
        @endif
        <ul class="grid grid-cols-1 xl:grid-cols-2 gap-y-14 mt-10 gap-x-6">
            @foreach ($events as $event)
                <li wire:key="{{ $event->id }}">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 sm:col-span-3 text-center lg:border-r lg:border-b lg:border-l">
                            <a href="{{ $event->slug }}">
                                <img class="w-full h-36 object-cover rounded-t-lg" src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->name }}">
                            </a>
                            <div class="hidden sm:grid grid-cols-1 gap-y-2 py-2">
                                <div class="row-span-1">
                                    <p class="text-2xl font-semibold font-poppins text-green-900">{{ $event->starts_at->format('j') }}</p>
                                </div>
                                <div class="row-span-1">
                                    <p class="text-base font-semibold font-poppins uppercase">{{ $event->starts_at->format('M') }}</p>
                                </div>
                                <div class="row-span-1">
                                    @if ($event->starts_at->format('H:i:s') !== '00:00:00')
                                        <span class="text-sm font-poppins py-2 text-green-900">{{ $event->starts_at->format('g:i A') }}</span>
                                    @endif
                                    @if ($event->ends_at && $event->ends_at->format('H:i:s') !== '00:00:00')
                                        <span class="text-sm font-poppins py-2 text-green-900">- {{ $event->ends_at->format('g:i A') }}</span>
                                    @endif
                                    @if ($event->hasPassed())
                                        <span class="text-xs font-poppins py-2 text-red-500 block">(this event has passed)</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 sm:col-span-9 lg:border-t border-b lg:border-r">
                            <div class="p-4">
                                <div class="grid grid-cols-1 gap-y-4">
                                    <h2 @class([
                                        'text-xl font-semibold font-sen text-green-900',
                                        'line-through' => $event->hasPassed(),
                                    ])>
                                        <a href="{{ $event->slug }}">
                                            {{ $event->name }}
                                        </a>
                                    </h2>

                                    <div class="block sm:hidden">
                                        <span class="text-sm font-poppins py-2 text-green-900">{{ $event->starts_at->format('l, F j') }}</span>
                                        @if ($event->starts_at->format('H:i:s') !== '00:00:00')
                                            <span class="text-sm font-poppins py-2 text-green-900">at {{ $event->starts_at->format('g:i A') }}</span>
                                        @endif
                                        @if ($event->ends_at && $event->ends_at->format('H:i:s') !== '00:00:00')
                                            <span class="text-sm font-poppins py-2 text-green-900">- {{ $event->ends_at->format('g:i A') }}</span>
                                        @endif
                                        @if ($event->hasPassed())
                                            <span class="text-xs font-poppins py-2 text-red-500 block">(this event has passed)</span>
                                        @endif
                                    </div>

                                    <div>
                                        <p class="whitespace-pre-line text-sm italic font-poppins">
                                            {{ $event->location }}
                                        </p>
                                    </div>

                                    <p>
                                        {{ \Illuminate\Support\Str::limit($event->description, 150) }} <a href="{{ $event->slug }}" class="text-green-900 hover:text-green-700 text-xs">read more</a>
                                    </p>

                                    <x-inputs.button :href="$event->slug">
                                        <x-fas-calendar class="w-4 h-4 mr-2 inline-block" />
                                        View Details
                                    </x-inputs.button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        @if ($events->hasPages())
            <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between pt-5 pr-2">
                <span>
                    @if ($events->onFirstPage())
                        <x-inputs.button disabled>&laquo; Previous</x-inputs.button>
                    @else
                        <x-inputs.button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">&laquo; Previous</x-inputs.button>
                    @endif
                </span>

                <span>
                    @if ($events->onLastPage())
                        <x-inputs.button disabled>Next &raquo;</x-inputs.button>
                    @else
                        <x-inputs.button wire:click="nextPage" wire:loading.attr="disabled" rel="next">Next &raquo;</x-inputs.button>
                    @endif
                </span>
            </nav>
        @endif
    </div>
</div>
