<div class="lg:col-span-4">
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-8">
        @foreach ($staff as $person)
            <li>
                <div style="opacity: 1; transform: none;">
                    <div class="group relative overflow-hidden bg-neutral-100">
                        <img alt="Headshot of {{ $person->name }}" loading="lazy" width="1800" height="1800" decoding="async" data-nimg="1" class="h-96 w-full object-cover grayscale motion-safe:group-hover:grayscale-0 transition duration-500 motion-safe:group-hover:scale-105" src="{{ $person->image }}" style="color: transparent;">
                        <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black to-black/0 to-40% p-6">
                            <p class="font-display text-base/6 font-semibold tracking-wide text-white font-poppins">
                                {{ $person->name }}
                            </p>
                            <p class="mt-2 text-sm text-white">
                                {{ $person->title }}
                            </p>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
