<div class="pt-20 px-2">
    <h2 class="text-4xl font-poppins font-semibold">Upcoming Events</h2>

    <div class="overflow-x-scroll py-10">
        <div class="flex flex-nowrap">
            @foreach($upcomingEvents as $event)
                <div class="flex-shrink-0 w-[300px] mr-4 rounded-lg shadow">
                    <div class="relative">
                        <a href="#">
                            <img class="w-full h-36 object-cover rounded-t-lg" src="{{ $event->image }}" alt="{{ $event->name }}">
                        </a>
                    </div>
                    <div class="px-1 rounded-b-lg">
                        <div class="grid grid-cols-12">
                            <div class="text-center py-4 col-span-3 border-r">
                                <div class="grid grid-cols-1 gap-y-2">
                                    <div class="row-span-1">
                                        <p class="text-xl font-semibold font-poppins text-green-900">{{ $event->event_start->format('j') }}</p>
                                    </div>
                                    <div class="row-span-1">
                                        <p class="text-sm font-semibold font-poppins uppercase">{{ $event->event_start->format('M') }}</p>
                                    </div>
                                    <div class="row-span-1">
                                        @if ($event->event_start->format('H:i:s') !== '00:00:00')
                                            <span class="text-xs font-poppins py-2 text-green-900">{{ $event->event_start->format('g:i A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-9">
                                <div class="mt-2 px-2 grid gap-y-2">
                                    <a href="#">
                                        <h3 class="text-sm font-semibold font-poppins">{{ $event->name }}</h3>
                                    </a>
                                    <p class="text-xs font-poppins italic text-black opacity-80">
                                        Santa Claus Christian Church
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="text-center">
        <x-inputs.button href="/events" class="my-5">View All Events</x-inputs.button>
    </div>
</div>
