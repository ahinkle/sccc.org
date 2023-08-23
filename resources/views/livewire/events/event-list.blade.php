<div class="grid grid-cols-12 gap-6">
    <div class="col-span-3">
        <form wire:submit class="bg-gray-100 py-10 -mt-16 shadow-lg">
            <h2 class="sr-only">Filters</h2>
            <div class="grid grid-cols-1 gap-y-4 px-4">
                <x-inputs.input
                     name="search"
                     type="search"
                     placeholder="Name of Event"
                     hideLabel
                />
            </div>
        </form>
    </div>

    <ul class="grid grid-cols-2 gap-y-14 mt-10 col-span-9 gap-x-6">
        @forelse ($events as $event)
            <li>
                <div class="grid grid-cols-12">
                     <div class="col-span-3 text-center border-r border-b border-l">
                        <img class="w-full h-36 object-cover rounded-t-lg" src="{{ $event->image }}" alt="{{ $event->name }}">
                        <div class="grid grid-cols-1 gap-y-2 py-2">
                            <div class="row-span-1">
                                <p class="text-2xl font-semibold font-poppins text-green-900">{{ $event->event_start->format('j') }}</p>
                            </div>
                            <div class="row-span-1">
                                <p class="text-base font-semibold font-poppins uppercase">{{ $event->event_start->format('M') }}</p>
                            </div>
                            <div class="row-span-1">
                                @if ($event->event_start->format('H:i:s') !== '00:00:00')
                                    <span class="text-sm font-poppins py-2 text-green-900">{{ $event->event_start->format('g:i A') }}</span>
                                @endif
                            </div>
                        </div>
                     </div>

                     <div class="col-span-9 border-t border-b border-r">
                        <div class="p-4">
                            <div class="grid grid-cols-1 gap-y-4">
                                <h2 class="text-xl font-semibold font-sen text-green-900">
                                    {{ $event->name }}
                                </h2>

                                <p>
                                    {{ $event->description }} .. <a href="#" class="text-green-900 hover:text-green-700 text-sm">read more</a>
                                </p>

                             <p class="whitespace-pre-line text-sm italic font-poppins">
                                {{ $event->location }}
                            </p>
                            </div>
                        </div>
                     </div>
                </div>
            </li>
        @empty

        @endif
    </ul>
</div>
