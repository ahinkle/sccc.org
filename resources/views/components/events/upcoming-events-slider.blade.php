<div class="pt-20 px-2">
    <h2 class="text-4xl font-poppins font-semibold px-8 xl:px-0">Upcoming Events</h2>

    <div class="overflow-x-scroll py-10 px-8 xl:px-0">
        <div class="flex flex-nowrap">
            @forelse($upcomingEvents as $event)
                <div class="flex-shrink-0 w-[300px] mr-4 shadow">
                    <div class="relative">
                        <a href="{{ $event->slug }}">
                            <img class="w-full h-36 object-cover" src="{{ $event->image ? asset('storage/'.$event->image) : asset('img/background/SCCC_HighAngle-min.jpg') }}" alt="{{ $event->name }}">
                        </a>
                    </div>
                    <div class="px-1">
                        <div class="grid grid-cols-12">
                            <div class="text-center py-8 col-span-3 border-r">
                                <div class="grid grid-cols-1 gap-y-2">
                                    <div class="row-span-1">
                                        <p class="text-xl font-semibold font-poppins text-green-900">{{ $event->starts_at->format('j') }}</p>
                                    </div>
                                    <div class="row-span-1">
                                        <p class="text-sm font-semibold font-poppins uppercase">{{ $event->starts_at->format('M') }}</p>
                                    </div>
                                    <div class="row-span-1">
                                        @if ($event->starts_at->format('H:i:s') !== '00:00:00')
                                            <span class="text-xs font-poppins py-2 text-green-900">
                                                {{ $event->starts_at->format('g:i A') }}
                                                @if ($event->ends_at && $event->ends_at->format('H:i:s') !== '00:00:00')
                                                    <span class="text-xs font-poppins py-2 text-green-900">- {{ $event->ends_at->format('g:i A') }}</span>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-9">
                                <div class="mt-2 px-2 grid gap-y-2 pb-4">
                                    <a href="{{ $event->slug }}">
                                        <h3 class="text-sm font-semibold font-poppins">{{ $event->name }}</h3>
                                    </a>

                                    <p class="text-xs font-poppins italic text-black opacity-80">
                                        {{ $event->location }}
                                    </p>

                                    <p class="text-xs font-poppins">
                                        {{ \Illuminate\Support\Str::limit($event->description, 75) }} <a href="{{ $event->slug }}" class="text-green-900 hover:text-green-700 text-xs">read more</a>
                                    </p>

                                    <a href="{{ $event->slug }}" class="text-xs font-poppins text-green-900 hover:text-green-700">Learn More &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    <p class="text-center">No upcoming events.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="text-center">
        <x-inputs.button href="/events" class="my-5">View All Events</x-inputs.button>
    </div>
</div>
