<x-layout.app>
    <x-slot name="seo">
        <title>{{ $event->name }} | Santa Claus Christian Church</title>
        <meta name="description" content="{{ $event->name}} is taking place at {{ $event->location }} on {{ $event->starts_at->format('F j, Y') }}">

    <x-hero.page-hero>
        <div class="w-full">
            <h1 class="text-5xl font-bold text-white font-sen border-b-4 pb-2 uppercase w-fit">{{ $event->name }}</h1>
            <h2 class="text-xl text-white font-sen pt-5">{{ $event->starts_at->format('F j, Y') }}</h2>
        </div>
    </x-hero.page-hero>
    <div class="py-10">
        @if ($event->hasPassed())
            <div class="bg-white block xl:hidden border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 font-sen ml-4 lg:ml-0 mr-4" role="alert">
                <strong class="font-bold">Warning:</strong>
                <span class="block sm:inline">This event has passed and some information may be out of date. Contact the church office at <a href="tel:812-937-2938" class="underline">812-937-2938</a> if you have any questions.</span>
            </div>
        @endif
        <div class="grid grid-cols-3 max-w-7xl mx-auto">
            <div class="col-span-3 xl:col-span-2 order-2 xl:order-1 px-4 xl:px-0">
                @if ($event->hasPassed())
                    <div class="bg-white hidden xl:block border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 font-sen ml-4 lg:ml-0 mr-4" role="alert">
                        <strong class="font-bold">Warning:</strong>
                        <span class="block sm:inline">This event has passed and some information may be out of date. Contact the church office at <a href="tel:812-937-2938" class="underline">812-937-2938</a> if you have any questions.</span>
                    </div>
                @endif
                @if ($event->description)
                    <p class="text-base xl:text-lg font-poppins pr-10 whitespace-pre-wrap">{{ $event->description }}</p>
                @else
                    <p class="text-base xl:text-lg font-poppins pr-10 whitespace-pre-wrap">No additional details have been provided for this event.
                    <p class="text-base xl:text-lg font-poppins pr-10 whitespace-pre-wrap">Contact the church office at <a href="tel:812-937-2938" class="underline">812-937-2938</a> if you have any questions.</p>
                @endif
                @if ($event->link)
                <x-inputs.button href="{{ $event->link }}" class="mt-5" target="_blank">
                    {{ $event->button_link_text ?? 'Sign-up' }}
                </x-inputs.button>
                @endif
            </div>
            <div class="bg-white py-10 xl:-mt-40 xl:shadow-lg order-1 xl:order-2 col-span-3 xl:col-span-1">
                <div class="px-4">
                    <img class="w-full h-36 object-cover rounded-lg" src="{{ $event->image ? asset('storage/'.$event->image) : asset('img/background/SCCC_HighAngle-min.jpg') }}" alt="{{ $event->name }}">
                    <div class="py-2 border-t mt-5 grid grid-cols-1 gap-y-3">
                        <div>
                            <h3 class="uppercase text-lg font-semibold font-sen text-green-900">
                                When
                            </h3>
                            <p class="text-sm font-poppins">
                                {{ $event->starts_at->format('F j, Y') }}
                                @if ($event->starts_at->format('H:i:s') !== '00:00:00')
                                    <span> - {{ $event->starts_at->format('g:i A') }}</span>
                                    @if ($event->ends_at && $event->ends_at->format('H:i:s') !== '00:00:00')
                                        <span> - {{ $event->ends_at->format('g:i A') }}</span>
                                    @endif
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
                        <div>
                            <h3 class="uppercase text-lg font-semibold font-sen text-green-900">
                                Questions
                            </h3>
                            <p class="text-sm font-poppins">
                                @if ($event->more_information)
                                    {{ $event->more_information }} or contact the church office at <a href="tel:812-937-2938" class="underline">812-937-2938</a>
                                @else
                                    Contact the church office at <a href="tel:812-937-2938" class="underline">812-937-2938</a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layout.app>
