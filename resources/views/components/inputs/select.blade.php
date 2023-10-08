 <div>
    @if (! $hideLabel) <div class="pb-3"> @endif
        <x-inputs.label :for="$name" :hide-label="$hideLabel">
            {{ $label }} @if ($attributes->has('required')) <span>*</span> @endif
        </x-inputs.label>
    @if (! $hideLabel) </div> @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes }}
        @class([
            'w-full min-w-0 appearance-none border-0 bg-white px-3 py-4 text-base text-gray-900 shadow-sm ring-1 ring-inset
            ring-black placeholder:text-gray-400 sm:text-sm sm:leading-6',
            'ring-red-500' => $errors->has($name),
            $class,
        ])
    >
        {{ $slot }}
    </select>
</div>
