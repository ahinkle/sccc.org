<x-layout.app>
    <x-slot name="seo">
        <title>{{ $event->name }} | Santa Claus Christian Church</title>
        <meta name="description" content="We are a group of people who love Jesus and love people. We are here to serve you and help you grow in your relationship with Jesus.">
    </x-slot>

    <x-hero.page-hero>
        <div class="w-full">
            <h1 class="text-5xl font-bold text-white font-sen border-b-4 pb-2 uppercase w-fit">{{ $event->name }}</h1>
            <h2 class="text-xl text-white font-sen pt-5">{{ $event->starts_at->format('F j, Y') }}</h2>
        </div>
    </x-hero.page-hero>
    <div class="py-10">
        <div class="grid grid-cols-3 max-w-7xl mx-auto">
            <div class="col-span-2">
                <p class="text-lg font-poppins pr-4">
                    {{ $event->description }}
                </p>
            </div>
            <div class="bg-white py-10 -mt-40 shadow-lg">
                <div class="px-4">
                    <img class="w-full h-36 object-cover rounded-lg" src="{{ asset($event->image) }}" alt="{{ $event->name }}">
                    <div class="py-2 border-t mt-5 grid grid-cols-1 gap-y-3">
                        <div>
                            <h3 class="uppercase text-lg font-semibold font-sen text-green-900">
                                When
                            </h3>
                            <p class="text-sm font-poppins">
                                {{ $event->starts_at->format('F j, Y') }}
                                @if ($event->starts_at->format('H:i:s') !== '00:00:00')
                                    <span> - {{ $event->starts_at->format('g:i A') }}</span>
                                @endif
                                @if ($event->ends_at && $event->ends_at->format('H:i:s') !== '00:00:00')
                                    <span> - {{ $event->ends_at->format('g:i A') }}</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <h3 class="uppercase text-lg font-semibold font-sen text-green-900">
                                Where
                            </h3>
                            <p class="text-sm font-poppins">
                                {{ $event->location }}
                            </p>
                            <div class="pt-2 pl-0.5">
                                <p class="text-sm font-poppins">
                                    {{ $event->address }}
                                </p>
                                <p class="text-sm font-poppins">
                                    {{ $event->city }}, {{ $event->state }} {{ $event->zip_code }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layout.app>
