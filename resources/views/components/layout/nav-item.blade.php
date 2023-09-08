<li class="list-none group relative">
    <a href="{{ $href }}"
        @class([
            'whitespace-nowrap pb-2',
            "before:content-[''] before:absolute before:block before:w-full before:h-[2px] before:bottom-0 before:left-0 before:bg-green-700 before:hover:scale-x-100 before:scale-x-0 before:origin-top-left before:transition before:ease-in-out before:duration-500" => ! $preventUnderline,
        ])
    >
        {{ $title }}
        @if ($slot->isNotEmpty())
            <span>
                <x-fas-chevron-down class="w-3 h-3 inline-block mb-1 group-hover:rotate-180 group-hover:ml-1 transition ease-in-out duration-300" />
            </span>
        @endif
    </a>

    {{-- Determine if the navigation item has children. --}}
    @if ($slot->isNotEmpty())
        <div class="hidden group-hover:block absolute text-base font-semibold normal-case z-10">
            <ul class="left-0 mt-2.5 w-auto rounded bg-white shadow z-10 mx-auto px-5 py-2.5 grid gap-y-4">
                {{ $slot }}
            </ul>
        </div>
    @endif
</li>
